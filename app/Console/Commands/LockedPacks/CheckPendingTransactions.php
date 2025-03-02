<?php
namespace App\Console\Commands\LockedPacks;

use App\Http\Controllers\TransactionController;
use App\Models\Asset;
use App\Models\LockedPack;
use App\Models\User;
use App\Models\UserBalances;
use App\Services\UserBalancesService;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\View;

class CheckLockedPacks extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:locked-packs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checks locked packs and executes trades';

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
        $pendingPacks   = LockedPack::where('status', 'pending')->get();
        $executingPacks = LockedPack::where('status', 'executing')->get();

        foreach ($pendingPacks as $pendingPack) {
            // Randomize profit rate with ±30% variation
            $estimatedProfitRate = bcmul(
                $pendingPack->estimated_profit_rate,
                (string) (1 + mt_rand(-300, 200) / 1000),
                8
            );

            // Generate divisions and dates
            $numDivisions = rand($pendingPack->period * 4, $pendingPack->period * 13);
            $startDate    = Carbon::parse($pendingPack->created_at);
            $endDate      = $startDate->copy()->addDays($pendingPack->period);

            // Create balanced profit parts
            $profitParts = [];
            $variance    = 5;
            $baseAmount  = bcdiv($estimatedProfitRate, (string) $numDivisions, 8);

            // Generate parts
            for ($i = 0; $i < $numDivisions; $i++) {
                // Last part adjustment to hit target
                if ($i == $numDivisions - 1) {
                    $currentSum = array_reduce($profitParts, function ($carry, $item) {
                        return bcadd($carry, $item, 8);
                    }, '0');
                    $profitParts[] = bcsub($estimatedProfitRate, $currentSum, 8);
                    continue;
                }

                // Generate part with variance
                $factor = mt_rand(0, 1) ?
                (string) (1.1 + (mt_rand(0, 200) / 1000) * $variance) :
                (string) (-1.1 - (mt_rand(0, 200) / 1000) * $variance);
                $profitParts[] = bcmul($baseAmount, $factor, 8);
            }

            // Create schedule with random dates
            $profitSchedule = array_map(function ($amount) use ($startDate, $endDate) {
                return [
                    'amount' => $amount,
                    'date'   => Carbon::createFromTimestamp(
                        mt_rand($startDate->timestamp, $endDate->timestamp)
                    )->format('Y-m-d H:i:s'),
                ];
            }, $profitParts);

            // Sort by date
            usort($profitSchedule, fn($a, $b) => strtotime($a['date']) - strtotime($b['date']));

            // Save trade info
            $pendingPack->trade_info = json_encode([
                'current_profit_rate'   => 0,
                'remaining_profit_rate' => $estimatedProfitRate,
                'profit_schedule'       => $profitSchedule,
            ]);
            $pendingPack->status = 'executing';
            $pendingPack->save();
        }

        $transactionController = new TransactionController;
        $userBalancesService   = new UserBalancesService;

        foreach ($executingPacks as $executingPack) {
            $tradeInfo        = json_decode($executingPack->trade_info, true);
            $randomAsset      = Asset::where('symbol', '!=', 'USDT')->inRandomOrder()->first()->symbol;
            $randomAssetPrice = View::getShared()['marketDataPrices'][$randomAsset];

            $today   = Carbon::now();
            $endDate = Carbon::parse($executingPack->created_at)->addDays($executingPack->period);

            // Check if the pack has reached its end date
            if ($today->isAfter($endDate)) {
                $executingPack->status = 'completed';
                $executingPack->save();
                continue;
            }

            $currentProfitRate   = $tradeInfo['current_profit_rate'];
            $remainingProfitRate = $tradeInfo['remaining_profit_rate'];
            $profitSchedule      = $tradeInfo['profit_schedule'];

            $now = Carbon::now();

            $latestPastProfit = null;
            $latestPastIndex  = null;

            // Sort profit schedule by date in descending order (newest first)
            usort($profitSchedule, function ($a, $b) {
                return strtotime($b['date']) - strtotime($a['date']);
            });

            // Loop through dates newest to oldest
            foreach ($profitSchedule as $key => $profit) {
                $profitDate = Carbon::parse($profit['date']);

                if ($profitDate->lessThanOrEqualTo($now)) {
                    $latestPastProfit = $profit;
                    $latestPastIndex  = $key;
                    break;
                }
            }

            // Process only the latest past profit if found
            if ($latestPastProfit !== null) {
                $currentProfitRate   = bcadd($currentProfitRate, $latestPastProfit['amount'], 8);
                $remainingProfitRate = bcsub($remainingProfitRate, $latestPastProfit['amount'], 8);

                [$totalBalance, $totalLockedBalance] = $userBalancesService->calculateUserTotalBalance($executingPack->user_id);

                // Create transaction for this profit
                $transaction = [
                    'tnx_id'                     => mt_rand(10000000, 99999999),
                    'user_id'                    => $executingPack->user_id,
                    'ref_user_id'                => User::where('id', $executingPack->user_id)->value('ref_user_id'),
                    'type'                       => 'trade',
                    'swap_to_asset'              => mt_rand(0, 1),
                    'amount_in_asset'            => bcdiv($latestPastProfit['amount'], $randomAssetPrice, 8),
                    'amount_in_usd'              => $latestPastProfit['amount'],
                    'asset'                      => $randomAsset,
                    'asset_price'                => $randomAssetPrice,
                    'asset_balance_after'        => UserBalances::where('user_id', $executingPack->user_id)
                        ->where('wallet', $randomAsset)->value('balance'),
                    'asset_locked_balance_after' => UserBalances::where('user_id', $executingPack->user_id)
                        ->where('wallet', $randomAsset)->value('locked_balance'),
                    'total_balance_after'        => $totalBalance,
                    'total_locked_balance_after' => $totalLockedBalance,
                    'strategy_pack_id'           => $executingPack->id,
                    'status'                     => 'pending',
                    'hash_id'                    => null,
                ];

                $transactionController->createTransaction($transaction);

                // Remove this profit from the schedule
                unset($tradeInfo['profit_schedule'][$latestPastIndex]);

                // Reindex the array and update the trade_info
                $tradeInfo['profit_schedule']       = array_values($tradeInfo['profit_schedule']);
                $tradeInfo['current_profit_rate']   = $currentProfitRate;
                $tradeInfo['remaining_profit_rate'] = $remainingProfitRate;
                $executingPack->trade_info          = json_encode($tradeInfo);
                $executingPack->save();
            }
        }

        $this->info('Locked packs checked successfully!');
    }
}
