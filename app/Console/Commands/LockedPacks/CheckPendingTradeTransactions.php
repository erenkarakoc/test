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
            $fiveMinutesAgo       = Carbon::now()->subMinutes(0);

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
                $entryDirection    = $originalDirection; // Use original direction directly
                $directionText     = $entryDirection ? 'LONG' : 'SHORT';

                try {
                    $symbol = $transaction->asset . 'USDT';

                    // Get more data to find suitable movements
                    $response = Http::get('https://api.binance.com/api/v3/klines', [
                        'symbol'   => $symbol,
                        'interval' => '1m',
                        'limit'    => 300, // Get more data to find a good match
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
                    $foundMovement     = false;
                    $entryIndex        = null;
                    $exitIndex         = null;
                    $entryPrice        = null;
                    $exitPrice         = null;
                    $entryTimestamp    = null;
                    $exitTimestamp     = null;
                    $priceMovementData = [];

                    // Scan through price data to find matching movement
                    for ($i = 0; $i < count($prices) - 2; $i++) {
                        // Get entry price from within the candle's range
                        $entryHighLowRange   = $prices[$i]['high'] - $prices[$i]['low'];
                        $potentialEntryPrice = $prices[$i]['low'] + (mt_rand() / mt_getrandmax()) * $entryHighLowRange;

                        // Calculate target exit price based on entry price and target percentage
                        $targetExitPrice = $potentialEntryPrice;
                        if ($entryDirection) {
                            // LONG trade
                            if ($success) {
                                // Successful LONG: price should increase by target%
                                $targetExitPrice *= (1 + ($targetPercentage / 100));
                            } else {
                                // Failed LONG: price should decrease by target%
                                $targetExitPrice *= (1 - ($targetPercentage / 100));
                            }
                        } else {
                            // SHORT trade
                            if ($success) {
                                // Successful SHORT: price should decrease by target%
                                $targetExitPrice *= (1 - ($targetPercentage / 100));
                            } else {
                                // Failed SHORT: price should increase by target%
                                $targetExitPrice *= (1 + ($targetPercentage / 100));
                            }
                        }

                        // Look forward to find if target price was reached
                        for ($j = $i + 2; $j < min($i + 11, count($prices)); $j++) {
                            // Check if target price falls within this candle's range
                            if ($targetExitPrice >= $prices[$j]['low'] && $targetExitPrice <= $prices[$j]['high']) {
                                $foundMovement  = true;
                                $entryIndex     = $i;
                                $exitIndex      = $j;
                                $entryPrice     = $potentialEntryPrice;
                                $exitPrice      = $targetExitPrice;
                                $entryTimestamp = $prices[$i]['timestamp'];
                                $exitTimestamp  = $prices[$j]['timestamp'];
                                break 2;
                            }
                        }
                    }

                    if ($foundMovement) {
                        // Get price data for 5 minutes before entry and 5 minutes after exit
                        $startIndex = max(0, $entryIndex - 5);
                        $endIndex   = min(count($prices) - 1, $exitIndex + 5);

                        // Collect price movement data
                        $priceMovementData = [];
                        for ($i = $startIndex; $i <= $endIndex; $i++) {
                            $priceMovementData[] = [
                                'timestamp' => date('Y-m-d H:i:s', $prices[$i]['timestamp'] / 1000),
                                'open'      => $prices[$i]['open'],
                                'high'      => $prices[$i]['high'],
                                'low'       => $prices[$i]['low'],
                                'close'     => $prices[$i]['close'],
                                'average'   => ($prices[$i]['high'] + $prices[$i]['low']) / 2,
                                'is_entry'  => $i === $entryIndex,
                                'is_exit'   => $i === $exitIndex,
                            ];
                        }

                        $actualPercentage = (($exitPrice - $entryPrice) / $entryPrice) * 100;
                        if (! $entryDirection) {
                            $actualPercentage = -$actualPercentage;
                        }

                        $tradeInfo = [
                            'direction'         => $originalDirection,
                            'profit_rate'       => $targetPercentage,
                            'success'           => $success,
                            'symbol'            => $symbol,
                            'entry_time'        => date('Y-m-d H:i:s', $entryTimestamp / 1000),
                            'entry_price'       => $entryPrice,
                            'exit_time'         => date('Y-m-d H:i:s', $exitTimestamp / 1000),
                            'exit_price'        => $exitPrice,
                            'actual_percentage' => $success ? abs($actualPercentage) : -abs($actualPercentage),
                            'price_movement'    => $priceMovementData,
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
                            ($success ? 'profit' : 'loss') . " of {$targetPercentage}%");
                    } else {
                        $this->info("Could not find suitable price movement for transaction #{$transaction->id}.");
                    }

                } catch (\Exception $e) {
                    $this->error("Error processing transaction #{$transaction->id}: " . $e->getMessage());
                }
            }
        }

        $this->info('Pending transactions checked successfully!');
    }
}
