<?php
namespace App\Http\Controllers;

use App\Models\LockedPack;
use App\Models\UserBalances;
use App\Services\UserBalancesService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlgorithmController extends Controller {
    public function calculateAlgorithmSummary(Request $request) {
        $validated = $request->validate([
            'chosen_algorithms' => 'required|array',
            'amount'            => 'required|numeric',
            'period'            => 'required|numeric',
        ]);

        $chosenAlgorithms = $validated['chosen_algorithms'];
        $amount           = $validated['amount'];
        $period           = $validated['period'];

        $baseIncomeRate    = 0.001017683;
        $baseAlgorithmCost = 0.004147923;

        $totalContributionRate = 0;
        foreach ($chosenAlgorithms as $algorithm) {
            $totalContributionRate += $algorithm['contribution'];
        }

        $algorithmCost = $amount * ($totalContributionRate * $baseAlgorithmCost) * ($period / 365);

        foreach ($chosenAlgorithms as $algorithm) {
            if ($algorithm['category'] === 'TF' || $algorithm['category'] === 'MR') {
                $totalContributionRate += ($period * 0.02);
            }
        }

        $amountAfterPurchase = $amount - $algorithmCost;

        $conflictMap = [
            'MR'  => ['TF'],
            'MLP' => ['MR'],
            'MSE' => ['TF'],
        ];

        $conflictingAlgorithms = [];
        $categoryToAlgorithms  = [];

        foreach ($chosenAlgorithms as $algorithm) {
            $category = $algorithm['category'];
            if (! isset($categoryToAlgorithms[$category])) {
                $categoryToAlgorithms[$category] = [];
            }
            $categoryToAlgorithms[$category][] = $algorithm;
        }

        foreach ($categoryToAlgorithms as $category => $algorithms) {
            if (isset($conflictMap[$category])) {
                foreach ($conflictMap[$category] as $conflictingCategory) {
                    if (isset($categoryToAlgorithms[$conflictingCategory])) {
                        foreach ($algorithms as $algorithm) {
                            $conflictingAlgorithms[$algorithm['title']] = $algorithm;
                        }
                        foreach ($categoryToAlgorithms[$conflictingCategory] as $conflictingAlgorithm) {
                            $conflictingAlgorithms[$conflictingAlgorithm['title']] = $conflictingAlgorithm;
                        }
                    }
                }
            }
        }

        $conflictedContribution = 0;

        $categoryContributions            = [];
        $conflictingCategoryContributions = [];

        foreach ($conflictingAlgorithms as $algorithm) {
            $category = $algorithm['category'];
            if (! isset($categoryContributions[$category])) {
                $categoryContributions[$category] = 0;
            }
            $categoryContributions[$category] += $algorithm['contribution'];
        }

        foreach ($categoryContributions as $category => $totalContribution) {
            if (isset($conflictMap[$category])) {
                foreach ($conflictMap[$category] as $conflictingCategory) {
                    if (isset($categoryContributions[$conflictingCategory])) {
                        if (! isset($conflictingCategoryContributions[$category])) {
                            $conflictingCategoryContributions[$category] = 0;
                        }
                        $conflictingCategoryContributions[$category] += $categoryContributions[$conflictingCategory];
                    }
                }
            }
        }

        foreach ($categoryContributions as $category => $totalContribution) {
            if (isset($conflictingCategoryContributions[$category])) {
                if ($totalContribution <= $conflictingCategoryContributions[$category]) {
                    $conflictedContribution += $totalContribution;
                }
            }
        }

        $totalContributionRate = $totalContributionRate - $conflictedContribution;

        // Günlük Kâr Oranı
        $dailyIncome = 0.01 * $totalContributionRate * $baseIncomeRate + $baseIncomeRate;

        $income                    = ($dailyIncome * $amount) * $period;
        $totalAmountAfterUnlock    = $income + $amount;
        $totalAmountAfterUnlockPct = (($income + $amount) / $amount - 1) * 100;

        return response()->json([
            'algorithmCost'             => $algorithmCost,
            'amountAfterPurchase'       => $amountAfterPurchase,
            'income'                    => $income,
            'totalAmountAfterUnlock'    => $totalAmountAfterUnlock,
            'totalAmountAfterUnlockPct' => $totalAmountAfterUnlockPct,
        ]);
    }

    public function lockPack(Request $request, TransactionController $transactionController, UserBalancesService $userBalancesService) {
        $validated = $request->validate([
            'strategy_pack_id'  => 'nullable|numeric',
            'chosen_algorithms' => 'required|array',
            'amount'            => 'required|numeric',
            'period'            => 'required|numeric',
        ]);

        $strategyPackId = $validated['strategy_pack_id'] ?? null;
        $amount         = $validated['amount'];
        $period         = $validated['period'];

        // Process algorithms correctly
        $chosenAlgorithms = $validated['chosen_algorithms'];
        if ($strategyPackId) {
            $chosenAlgorithms = array_map(function ($algorithm) {
                return [
                    'title'        => $algorithm['title'],
                    'contribution' => $algorithm['contribution'],
                    'icon'         => $algorithm['icon'],
                    'category'     => $algorithm['category'],
                ];
            }, $chosenAlgorithms);
        }

        $user              = Auth::user();
        $calculatedSummary = $this->calculateAlgorithmSummary($request)->getData(true);
        $userUsdBalance    = UserBalances::where('user_id', $user->id)->where('wallet', 'USD')->first();

        if ($userUsdBalance->balance < $amount) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Insufficient balance!',
            ]);
        }

        // Calculate new balances first
        $newBalance       = $userUsdBalance->balance - $amount;
        $newLockedBalance = $userUsdBalance->locked_balance + $amount;

        // Update user balance
        $userUsdBalance->balance        = $newBalance;
        $userUsdBalance->locked_balance = $newLockedBalance;
        $userUsdBalance->save();

        // Get total balances
        [$totalBalance, $totalLockedBalance] = $userBalancesService->calculateUserTotalBalance($user->id);

        $lockedPack = LockedPack::create([
            'user_id'               => $user->id,
            'strategy_pack_id'      => $strategyPackId,
            'chosen_algorithms'     => json_encode($chosenAlgorithms),
            'amount'                => $amount - $calculatedSummary['algorithmCost'],
            'period'                => $period,
            'algorithms_cost'       => $calculatedSummary['algorithmCost'],
            'estimated_profit_rate' => $calculatedSummary['totalAmountAfterUnlockPct'],
            'status'                => 'pending',
            'trade_info'            => null,
        ]);

        $lockedPackTnxId       = mt_rand(10000000, 99999999);
        $lockedPackTransaction = [
            'tnx_id'                     => $lockedPackTnxId,
            'user_id'                    => $user->id,
            'type'                       => 'locked',
            'amount_in_asset'            => $amount,
            'amount_in_usd'              => $amount,
            'asset'                      => 'USD',
            'asset_price'                => 1,
            'asset_balance_after'        => $newBalance,
            'asset_locked_balance_after' => $newLockedBalance,
            'total_balance_after'        => $totalBalance,
            'total_locked_balance_after' => $totalLockedBalance,
            'locked_pack_id'             => $lockedPack->id,
            'status'                     => 'completed',
        ];
        $transactionController->createTransaction($lockedPackTransaction);

        $notificationController = new NotificationController();
        $notificationLink       = route('page-transactions') . '?tab=locked&tnx_id=' . $lockedPackTnxId;
        $notificationController->sendNotification(
            $user->id,
            'bundled_pack_deployed',
            'Deployed Pack ' . $lockedPack->id,
            null, // will be added for mail
            'Pack ' . $lockedPack->id . ' deployed successfully, it will start executing trades shortly!',
            $notificationLink
        );
        return response()->json([
            'status'      => 'success',
            'message'     => 'Pack locked successfully!',
            'locked_pack' => $lockedPack,
        ]);
    }
}
