<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AlgorithmController extends Controller
{
    public function calculateAlgorithmSummary(Request $request)
    {
        $validated = $request->validate([
            'chosen_algorithms' => 'required|array',
            'amount' => 'required|numeric',
            'period' => 'required|numeric',
        ]);

        $chosenAlgorithms = $validated['chosen_algorithms'];
        $amount = $validated['amount'];
        $period = $validated['period'];

        // Base rates
        $baseAlgorithmCost = 1.8;
        $baseIncomeRate = 0.0015;

        // Conflict map
        $conflictMap = [
            'MR' => ['TF'],
            'MLP' => ['MR'],
            'MSE' => ['TF'],
        ];

        // Period map
        $periodMap = [
            'TF' => 'long',
            'MR' => 'long',
            'MSE' => 'short',
        ];

        // Adjust contribution rates based on conflicts
        $adjustedAlgorithms = array_map(function ($algorithm) use ($chosenAlgorithms, $conflictMap) {
            $adjustedAlgorithm = $algorithm;

            foreach ($chosenAlgorithms as $otherAlgorithm) {
                if ($algorithm !== $otherAlgorithm) {
                    $conflicts = $conflictMap[$algorithm['category']] ?? [];
                    if (in_array($otherAlgorithm['category'], $conflicts)) {
                        $adjustedAlgorithm['contribution'] *= 0.5;
                    }
                }
            }

            return $adjustedAlgorithm;
        }, $chosenAlgorithms);

        // Calculate algorithm costs
        $algorithmCostValues = array_map(function ($algorithm) use ($baseAlgorithmCost, $adjustedAlgorithms, $period) {
            $cost = $baseAlgorithmCost * $algorithm['contribution'];

            // Dynamic penalty based on number of algorithms
            $algorithmCount = count($adjustedAlgorithms);
            $penaltyFactor = log($algorithmCount + 2);
            $cost *= 1 + $penaltyFactor * 0.1;

            // Period-based discount
            $periodDiscount = log($period + 1) / 10;
            $cost *= 1 - $periodDiscount;

            return $cost;
        }, $adjustedAlgorithms);

        // Total algorithm cost
        $totalAlgorithmCost = array_sum($algorithmCostValues);

        // Calculate income
        $totalIncome = array_reduce($adjustedAlgorithms, function ($sum, $algorithm) use ($baseIncomeRate, $periodMap, $period, $amount) {
            $incomeRate = $baseIncomeRate * $algorithm['contribution'];

            $preferredPeriod = $periodMap[$algorithm['category']] ?? null;
            if ($preferredPeriod === 'long') {
                $longPeriodBoost = log($period + 1) / 100;
                $incomeRate *= 1 + $longPeriodBoost;
            } elseif ($preferredPeriod === 'short') {
                $shortPeriodPenalty = log($period + 1) / 100;
                $incomeRate *= 1 - $shortPeriodPenalty;
            }

            return $sum + $incomeRate * $amount;
        }, 0);

        // Calculate final values
        $amountAfterUnlockValue = $amount - $totalAlgorithmCost;
        $incomeValue = $totalIncome * $period;
        $finalBalance = $amountAfterUnlockValue + $incomeValue;
        $finalPercentage = (($finalBalance - $amount) / $amount) * 100;

        sleep(1);

        // Return results
        return response()->json([
            'totalAlgorithmCost' => $totalAlgorithmCost,
            'totalIncome' => $totalIncome,
            'amountAfterUnlockValue' => $amountAfterUnlockValue,
            'incomeValue' => $incomeValue,
            'finalBalance' => $finalBalance,
            'finalPercentage' => $finalPercentage,
        ]);
    }

    public function lockAmountWithChosenAlgorithms(Request $request)
    {
        $validated = $request->validate([
            'chosen_algorithms' => 'required|array',
            'amount' => 'required|numeric',
            'period' => 'required|numeric',
        ]);

        $chosenAlgorithms = $validated['chosen_algorithms'];
        $amount = $validated['amount'];
        $period = $validated['period'];

        return response()->json([
            'message' => 'Amount locked with chosen algorithms',
        ]);
    }
}
