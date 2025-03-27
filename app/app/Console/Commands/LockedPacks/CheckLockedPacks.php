<?php
namespace App\Console\Commands\LockedPacks;

use App\Http\Controllers\NotificationController;
use App\Http\Controllers\TransactionController;
use App\Models\Asset;
use App\Models\LockedPack;
use App\Models\User;
use App\Models\UserBalances;
use App\Services\UserBalancesService;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\View;

class CheckLockedPacks extends Command
{
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
  public function __construct()
  {
    parent::__construct();
  }

  /**
   * Execute the console command.
   */
  public function handle()
  {
    $pendingPacks = LockedPack::where('status', 'pending')->where('created_at', '<', Carbon::now()->subMinutes(5))->get();
    $executingPacks = LockedPack::where('status', 'executing')->get();

    foreach ($pendingPacks as $pendingPack) {
      $estimatedProfitRate = $pendingPack->estimated_profit_rate;

      $numDivisions = rand($pendingPack->period * 7, $pendingPack->period * 13);
      $startDate = Carbon::parse($pendingPack->created_at);
      $endDate = $startDate->copy()->addDays($pendingPack->period);

      // Create balanced profit parts
      $profitParts = [];
      $variance = 5;
      $baseAmount = bcdiv($estimatedProfitRate, (string) $numDivisions, 8);

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

        // Calculate positive factor base value
        $positiveFactor = (string) (1.1 + (mt_rand(0, 200) / 1000) * $variance);

        // For negative values, make them 40%-60% of the positive value
        $negativePercent = mt_rand(40, 60) / 100; // Random value between 0.4 and 0.6
        $negativeFactor = (string) (-1 * bcmul($positiveFactor, $negativePercent, 8));

        // Choose with 55% probability for positive values
        $factor = mt_rand(1, 100) <= 55 ? $positiveFactor : $negativeFactor;

        $profitParts[] = bcmul($baseAmount, $factor, 8);
      }

      // Create schedule with random dates
      $profitSchedule = array_map(function ($amount) use ($startDate, $endDate) {
        return [
          'amount' => $amount,
          'date' => Carbon::createFromTimestamp(
            mt_rand($startDate->timestamp + 300, $endDate->timestamp)
          )->format('Y-m-d H:i:s'),
          'checked' => false,
        ];
      }, $profitParts);

      // Sort by date (newest first)
      usort($profitSchedule, fn($a, $b) => strtotime($b['date']) - strtotime($a['date']));

      // Save trade info
      $pendingPack->trade_info = json_encode([
        'current_profit_rate' => 0,
        'remaining_profit_rate' => $estimatedProfitRate,
        'profit_schedule' => $profitSchedule,
      ]);
      $pendingPack->status = 'executing';
      $pendingPack->save();

      $notificationController = new NotificationController;
      $notificationController->sendNotification(
        $pendingPack->user_id,
        'locked_pack',
        $pendingPack->id . ' is now running.',
        'Pack ' . $pendingPack->id . ' started executing trades.',
        'Pack ' . $pendingPack->id . ' started executing trades.',
        route('page-bundled-packs') . '?pack_id=' . $pendingPack->id
      );
    }

    $transactionController = new TransactionController;
    $userBalancesService = new UserBalancesService;

    foreach ($executingPacks as $executingPack) {
      $tradeInfo = json_decode($executingPack->trade_info, true);
      $randomAsset = Asset::where('symbol', '!=', 'USDT')->inRandomOrder()->first()->symbol;
      $randomAssetPrice = View::getShared()['marketDataPrices'][$randomAsset];

      $today = Carbon::now();
      $endDate = Carbon::parse($executingPack->created_at)->addDays($executingPack->period);

      // Check if the pack has reached its end date
      if ($today->isAfter($endDate)) {
        $executingPack->status = 'completed';
        $executingPack->save();

        $userUsdBalance = UserBalances::where('user_id', $executingPack->user_id)->where('wallet', 'USD')->first();

        $userUsdBalance->balance += $executingPack->amount;
        $userUsdBalance->locked_balance -= $executingPack->amount;
        $userUsdBalance->save();

        continue;
      }

      $currentProfitRate = $tradeInfo['current_profit_rate'];
      $remainingProfitRate = $tradeInfo['remaining_profit_rate'];
      $profitSchedule = array_values(array_filter($tradeInfo['profit_schedule'], function ($profit) {
        return $profit['checked'] === false;
      }));

      $now = Carbon::now();
      $latestPastProfit = null;
      $latestPastIndex = null;

      // Get the original profit schedule
      $originalSchedule = $tradeInfo['profit_schedule'];

      // Filter to get only unchecked profits
      $uncheckedProfits = array_values(array_filter($originalSchedule, function ($profit) {
        return empty($profit['checked']) || $profit['checked'] === false;
      }));

      // Sort unchecked profits by date (oldest first for processing chronologically)
      usort($uncheckedProfits, function ($a, $b) {
        return strtotime($a['date']) - strtotime($b['date']);
      });

      // Find the first past date
      foreach ($uncheckedProfits as $profit) {
        $profitDate = Carbon::parse($profit['date']);

        if ($profitDate->lessThanOrEqualTo($now)) {
          $latestPastProfit = $profit;
          break;
        }
      }

      // Process only if we found a past profit
      if ($latestPastProfit !== null) {
        $currentProfitRate = bcadd($currentProfitRate, $latestPastProfit['amount'], 8);
        $remainingProfitRate = bcsub($remainingProfitRate, $latestPastProfit['amount'], 8);

        // Update the checked status in the original schedule
        foreach ($tradeInfo['profit_schedule'] as $key => $profit) {
          if (
            $profit['date'] === $latestPastProfit['date'] &&
            $profit['amount'] === $latestPastProfit['amount'] &&
            empty($profit['checked'])
          ) {
            $tradeInfo['profit_schedule'][$key]['checked'] = true;
            break;
          }
        }

        [$totalBalance, $totalLockedBalance] = $userBalancesService->calculateUserTotalBalance($executingPack->user_id);

        $tnxTradeInfo = [
          'profit_rate' => $currentProfitRate,
          'success' => $latestPastProfit['amount'] > 0,
        ];

        // Create transaction for this profit
        $transactionController->createTransaction([
          'tnx_id' => mt_rand(10000000, 99999999),
          'user_id' => $executingPack->user_id,
          'ref_user_id' => User::where('id', $executingPack->user_id)->value('ref_user_id'),
          'type' => 'trade',
          'amount_in_asset' => bcdiv($latestPastProfit['amount'], $randomAssetPrice, 8),
          'amount_in_usd' => $latestPastProfit['amount'],
          'asset' => $randomAsset,
          'asset_price' => $randomAssetPrice,
          'asset_balance_after' => bcadd(
            UserBalances::where('user_id', $executingPack->user_id)
              ->where('wallet', $randomAsset)
              ->value('balance'),
            bcdiv((string) $latestPastProfit['amount'], (string) $randomAssetPrice, 8),
            8
          ),
          'asset_locked_balance_after' => UserBalances::where('user_id', $executingPack->user_id)->where('wallet', $randomAsset)->value('locked_balance'),
          'total_balance_after' => bcadd((string) $totalBalance, (string) $latestPastProfit['amount'], 8),
          'total_locked_balance_after' => $totalLockedBalance,
          'locked_pack_id' => $executingPack->id,
          'status' => 'pending',
          'hash_id' => null,
          'trade_info' => json_encode($tnxTradeInfo),
        ]);

        // Update trade info with modified profit schedule
        $tradeInfo['current_profit_rate'] = $currentProfitRate;
        $tradeInfo['remaining_profit_rate'] = $remainingProfitRate;
        $executingPack->trade_info = json_encode($tradeInfo);
        $executingPack->save();
      }
    }

    $this->info('Locked packs checked successfully!');
  }
}
