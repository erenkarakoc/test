<?php
namespace App\Console\Commands;

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
            $period              = $pendingPack->period;
            $estimatedProfitRate = $pendingPack->estimated_profit_rate;

            // Randomize estimated profit rate
            $baseRate            = $pendingPack->estimated_profit_rate;
            $randomFactor        = (mt_rand(-300, 200) / 1000);
            $adjustment          = bcmul($baseRate, (string) $randomFactor, 8);
            $estimatedProfitRate = bcadd($baseRate, $adjustment, 8);

            // Generate random number of divisions (e.g., between 11-26 each day)
            $numDivisions = rand($period * 11, $period * 26);

            // Create array of random parts that sum up to estimatedProfitRate
            $profitParts     = [];
            $remainingProfit = $estimatedProfitRate;

            for ($i = 0; $i < $numDivisions - 1; $i++) {
                // Generate random portion of remaining profit
                $randomPart = bcmul(
                    $remainingProfit,
                    (string) (mt_rand(10, 40) / 100),
                    8
                );
                $profitParts[]   = $randomPart;
                $remainingProfit = bcsub($remainingProfit, $randomPart, 8);
            }

            // Add the remaining profit as the last part
            $profitParts[] = $remainingProfit;

            // Generate random dates between created_at and end date
            $startDate = Carbon::parse($pendingPack->created_at);
            $endDate   = $startDate->copy()->addDays($period);

            $sumAmounts = 0;

            $profitSchedule = [];
            foreach ($profitParts as $profit) {
                // Generate random timestamp between start and end date
                $randomTimestamp = mt_rand($startDate->timestamp, $endDate->timestamp);
                $randomDate      = Carbon::createFromTimestamp($randomTimestamp);

                $profitSchedule[] = [
                    'amount' => $profit,
                    'date'   => $randomDate->format('Y-m-d H:i:s'),
                ];

                $sumAmounts += $profit;
            }

            // Sort by date
            usort($profitSchedule, function ($a, $b) {
                return strtotime($a['date']) - strtotime($b['date']);
            });

            $tradeInfo = [
                'current_profit_rate'   => 0,
                'remaining_profit_rate' => $estimatedProfitRate,
                'profit_schedule'       => $profitSchedule,
            ];

            // $pendingPack->status     = 'executing';
            $pendingPack->trade_info = json_encode($tradeInfo);
            $pendingPack->save();
        }

        $transactionController = new TransactionController;

        foreach ($executingPacks as $executingPack) {
            $tradeInfo        = json_decode($executingPack->trade_info, true);
            $randomAsset      = Asset::where('symbol', '!=', 'USDT')->inRandomOrder()->first()->symbol;
            $randomAssetPrice = View::getShared()['marketDataPrices'][$randomAsset];

            $currentProfitRate   = $tradeInfo['current_profit_rate'];
            $remainingProfitRate = $tradeInfo['remaining_profit_rate'];

            $userReferral                        = User::where('id', $executingPack->user_id)->value('ref_user_id');
            $assetBalanceAfter                   = UserBalances::where('user_id', $executingPack->user_id)->where('wallet', $randomAsset)->value('balance');
            $assetLockedBalanceAfter             = UserBalances::where('user_id', $executingPack->user_id)->where('wallet', $randomAsset)->value('locked_balance');
            $userBalancesService                 = new UserBalancesService;
            [$totalBalance, $totalLockedBalance] = $userBalancesService->calculateUserTotalBalance($executingPack->user_id);

            if ($currentProfitRate <= $remainingProfitRate) {
                $profitSchedule = $tradeInfo['profit_schedule'];

                foreach ($profitSchedule as $profit) {
                    $today = Carbon::now();

                    if ($today->isAfter($profit['date'])) {
                        $currentProfitRate += $profit['amount'];
                        $remainingProfitRate -= $profit['amount'];

                        $transaction = [
                            'tnx_id'                     => mt_rand(10000000, 99999999),
                            'user_id'                    => $executingPack->user_id,
                            'ref_user_id'                => $userReferral,
                            'type'                       => 'trade',
                            'swap_to_asset'              => mt_rand(0, 1),
                            'amount_in_asset'            => $profit['amount'] * $randomAssetPrice,
                            'amount_in_usd'              => $profit['amount'],
                            'asset'                      => $randomAsset,
                            'asset_price'                => $randomAssetPrice,
                            'asset_balance_after'        => $assetBalanceAfter,
                            'asset_locked_balance_after' => $assetLockedBalanceAfter,
                            'total_balance_after'        => $totalBalance,
                            'total_locked_balance_after' => $totalLockedBalance,
                            'strategy_pack_id'           => $executingPack->id,
                            'status'                     => 'pending',
                            'hash_id'                    => null,
                        ];

                        $transactionController->createTransaction($transaction);
                    }
                }
            }

            $this->info($currentProfitRate);
            $this->info($remainingProfitRate);
        }

        $this->info('Locked packs checked successfully!');
    }
}
