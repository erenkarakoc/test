<?php
namespace App\Console\Commands\LockedPacks;

use App\Models\Transaction;
use App\Models\UserBalances;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class CheckPendingTradeTransactions extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:pending-trade-transactions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checks pending trade transactions';

    /**
     * Constructor.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle() {
        $transactions = Transaction::where('type', 'trade')->where('status', 'pending')->get();

        foreach ($transactions as $transaction) {
            $transactionCreatedAt = Carbon::parse($transaction->created_at);
            $fiveMinutesAgo       = Carbon::now()->subMinutes(5);

            if ($transactionCreatedAt->lessThanOrEqualTo($fiveMinutesAgo)) {
                // Get trade info or initialize if empty
                $tradeInfo = json_decode($transaction->trade_info, true) ?: [
                    'direction'   => mt_rand(0, 1),                    // Random direction (0=SHORT, 1=LONG)
                    'profit_rate' => abs($transaction->amount_in_usd), // Use transaction amount as target
                    'success'     => $transaction->amount_in_usd > 0,  // Success if positive amount
                ];

                $targetPercentage  = abs(floatval($tradeInfo['profit_rate']));
                $success           = isset($tradeInfo['success']) ? $tradeInfo['success'] : ($transaction->amount_in_usd > 0);
                $originalDirection = isset($tradeInfo['direction']) ? $tradeInfo['direction'] : mt_rand(0, 1);
                $entryDirection    = $success ? $originalDirection : ! $originalDirection;
                $directionText     = $entryDirection ? 'LONG' : 'SHORT';

                try {
                    $symbol = $transaction->asset . 'USDT';

                    // Get more data to find suitable movements
                    $response = Http::get('https://api.binance.com/api/v3/klines', [
                        'symbol'   => $symbol,
                        'interval' => '1m',
                        'limit'    => 120, // Get more data to find a good match
                    ]);

                    $klines = $response->json();

                    // Process the price data
                    $prices = [];
                    foreach ($klines as $kline) {
                        $prices[] = [
                            'timestamp' => $kline[0], // Open time
                            'open'      => floatval($kline[1]),
                            'high'      => floatval($kline[2]),
                            'low'       => floatval($kline[3]),
                            'close'     => floatval($kline[4]),
                        ];
                    }

                    // Find a price movement matching the target percentage
                    $foundMovement = false;
                    $entryIndex    = null;
                    $exitIndex     = null;
                    $entryPrice    = null;
                    $exitPrice     = null;

                    // Scan through price data to find matching movement
                    for ($i = 0; $i < count($prices) - 2; $i++) {
                        $potentialEntryPrice = $prices[$i]['open'];

                        // Look forward up to 10 candles to find a matching exit
                        for ($j = $i + 1; $j < min($i + 11, count($prices)); $j++) {
                            $potentialExitPrice = $prices[$j]['close'];
                            $percentageChange   = (($potentialExitPrice - $potentialEntryPrice) / $potentialEntryPrice) * 100;

                            // For LONG trades
                            if ($entryDirection) {
                                // LONG + success = price increase of target%
                                // LONG + failure = price decrease of target%
                                $targetChange = $success ? $targetPercentage : -$targetPercentage;

                                // Check if we found a close match
                                if (abs($percentageChange - $targetChange) < 0.1) {
                                    $entryIndex    = $i;
                                    $exitIndex     = $j;
                                    $entryPrice    = $potentialEntryPrice;
                                    $exitPrice     = $potentialExitPrice;
                                    $foundMovement = true;
                                    break 2;
                                }
                            }
                            // For SHORT trades
                            else {
                                // SHORT + success = price decrease of target%
                                // SHORT + failure = price increase of target%
                                $targetChange = $success ? -$targetPercentage : $targetPercentage;

                                // Check if we found a close match
                                if (abs($percentageChange - $targetChange) < 0.1) {
                                    $entryIndex    = $i;
                                    $exitIndex     = $j;
                                    $entryPrice    = $potentialEntryPrice;
                                    $exitPrice     = $potentialExitPrice;
                                    $foundMovement = true;
                                    break 2;
                                }
                            }
                        }
                    }

                    // If we couldn't find a natural movement, keep transaction as pending
                    if (! $foundMovement) {
                        $this->info("No matching price movement found for transaction #{$transaction->id} " .
                            "with {$directionText} target of {$targetPercentage}%. Keeping as pending.");

                        // Store the search criteria for next attempt
                        $pendingTradeInfo = [
                            'direction'      => $originalDirection,
                            'profit_rate'    => $targetPercentage,
                            'success'        => $success,
                            'symbol'         => $symbol,
                            'attempted_at'   => Carbon::now()->format('Y-m-d H:i:s'),
                            'pending_reason' => 'No matching price movement found',
                        ];

                        // Update transaction with search criteria but keep pending
                        $transaction->trade_info = json_encode($pendingTradeInfo);
                        $transaction->save();

                        // Skip to next transaction
                        continue;
                    }

                    // Process transaction only if we found a natural movement
                    $actualPercentage = (($exitPrice - $entryPrice) / $entryPrice) * 100;
                    if (! $entryDirection) {
                        // For SHORT, invert the percentage
                        $actualPercentage = -$actualPercentage;
                    }

                    // Final trade details
                    $tradeInfo = [
                        'direction'              => $originalDirection,
                        'profit_rate'            => $targetPercentage,
                        'success'                => $success,
                        'symbol'                 => $symbol,
                        'entry_time'             => date('Y-m-d H:i:s', $prices[$entryIndex]['timestamp'] / 1000),
                        'entry_price'            => $entryPrice,
                        'exit_time'              => date('Y-m-d H:i:s', $prices[$exitIndex]['timestamp'] / 1000),
                        'exit_price'             => $exitPrice,
                        'actual_percentage'      => $success ? abs($actualPercentage) : -abs($actualPercentage),
                        'found_natural_movement' => $foundMovement,
                    ];

                    // Update transaction
                    $transaction->trade_info = json_encode($tradeInfo);

                    // Update user balance if positive amount
                    if ($transaction->amount_in_usd > 0) {
                        $userBalance = UserBalances::where('user_id', $transaction->user_id)
                            ->where('wallet', 'USD')
                            ->first();

                        if ($userBalance) {
                            $userBalance->balance = bcadd($userBalance->balance, $transaction->amount_in_usd, 8);
                            $userBalance->save();
                        }
                    }

                    // Mark transaction as completed
                    $transaction->status = 'completed';
                    $transaction->save();

                    $this->info("Processed transaction #{$transaction->id} with {$directionText} " .
                        ($success ? 'profit' : 'loss') . " of {$targetPercentage}% " .
                        ($foundMovement ? '(natural movement)' : '(synthetic movement)'));

                } catch (\Exception $e) {
                    $this->error("Error processing transaction #{$transaction->id}: " . $e->getMessage());
                }
            }
        }

        $this->info('Pending transactions checked successfully!');
    }
}
