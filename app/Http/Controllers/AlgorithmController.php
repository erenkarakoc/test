<?php
namespace App\Http\Controllers;

use App\Models\LockedPack;
use App\Models\UserBalances;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

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

        // Algoritma Kâr Oranı
        $totalContributionRate = 0;
        foreach ($chosenAlgorithms as $algorithm) {
            $totalContributionRate += $algorithm['contribution'];
        }

        // Algoritma Maliyeti
        $algorithmCost = $amount * ($totalContributionRate * $baseAlgorithmCost) * ($period / 365);

        // Uzun Dönem Algoritma Ödülü
        foreach ($chosenAlgorithms as $algorithm) {
            if ($algorithm['category'] === 'TF' || $algorithm['category'] === 'MR') {
                $totalContributionRate += ($period * 0.02);
            }
        }

        // Maliyet Sonrası Bakiye
        $amountAfterPurchase = $amount - $algorithmCost;

        // Çakışma Kontrolü
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
                if ($totalContribution < $conflictingCategoryContributions[$category]) {
                    $conflictedContribution += $totalContribution;
                }
            }
        }

        $totalContributionRate - $conflictedContribution;

        // Günlük Kâr Oranı
        $dailyIncome = 0.01 * $totalContributionRate * $baseIncomeRate + $baseIncomeRate;

        $income                    = ($dailyIncome * $amount) * $period;
        $totalAmountAfterUnlock    = $income + $amount;
        $totalAmountAfterUnlockPct = $income + $amount;

        return response()->json([
            'algorithmCost'             => $algorithmCost,
            'amountAfterPurchase'       => $amountAfterPurchase,
            'income'                    => $income,
            'totalAmountAfterUnlock'    => $totalAmountAfterUnlock,
            'totalAmountAfterUnlockPct' => $totalAmountAfterUnlockPct,
        ]);
    }

    public function checkBalancesForLock(Request $request) {
        $validated = $request->validate([
            'amount' => 'required|numeric',
        ]);

        $userTotalBalance = View::getShared('userTotalBalance');
        dd($userTotalBalance);

        if ($userTotalBalance < $validated['amount']) {
            return response()->json(['status' => 'error', 'message' => 'Insufficient balance']);
        }
    }

    public function lockPack(Request $request) {
        $validated = $request->validate([
            'strategy_pack_id'  => 'nullable|numeric',
            'chosen_algorithms' => 'required|array',
            'amount'            => 'required|numeric',
            'period'            => 'required|numeric',
        ]);

        $user              = Auth::user();
        $calculatedSummary = $this->calculateAlgorithmSummary($request)->getData(true);
        $userBalances      = UserBalances::where('user_id', $user->id)->get();
        $marketDataPrices  = View::getShared('marketDataPrices');

        foreach ($userBalances as $balance) {

        }

        $lockedPack = LockedPack::create([
            'user_id'               => $user->id,
            'strategy_pack_id'      => $validated['strategy_pack_id'] ?? null,
            'chosen_algorithms'     => $validated['chosen_algorithms'],
            'amount'                => $validated['amount'],
            'period'                => $validated['period'],
            'algorithms_cost'       => $calculatedSummary['totalAlgorithmCost'],
            'estimated_profit_rate' => $calculatedSummary['finalPercentage'],
            'status'                => 'pending',
        ]);

        return response()->json([
            'status'      => 'success',
            'message'     => 'Amount locked with chosen algorithms',
            'locked_pack' => $lockedPack,
        ]);
    }
}
