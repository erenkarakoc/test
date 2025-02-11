<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AlgorithmController extends Controller {
    public function calculateAlgorithmSummary(Request $request) {
        $validated = $request->validate([
            'chosen_algorithms' => 'required|array',
            'amount'            => 'required|numeric',
            'period'            => 'required|numeric', // period in days
        ]);

        $chosenAlgorithms = $validated['chosen_algorithms'];
        $amount           = $validated['amount'];
        $period           = $validated['period']; // period represents the number of days

                                    // Base rates
        $baseAlgorithmCost = 0.4;   // cost per algorithm unit
        $baseIncomeRate    = 0.015; // income per algorithm unit per day

        // Conflict map: key is a category whose algorithms conflict with the listed categories.
        $conflictMap = [
            'MR'  => ['TF'], // Mean Reversion conflicts with Trend-Following
            'MLP' => ['MR'], // Machine Learning & Predictive conflicts with Mean Reversion
            'MSE' => ['TF'], // Market Structure/Execution conflicts with Trend-Following
        ];

        // Initialize totals
        $totalAlgorithmCost = 0;
        $totalIncome        = 0;
        $totalContribution  = 0;

        // Loop over each chosen algorithm
        foreach ($chosenAlgorithms as $index => $algo) {
            // Normalize category: if given as "MS", convert it to "MSE" so it matches our maps.
            $category = $algo['category'];
            if ($category === 'MS') {
                $category = 'MSE';
            }
            $contribution = $algo['contribution'];

            // Base cost and income for this algorithm (without adjustments)
            $cost = $baseAlgorithmCost * $contribution;
            // Since income is per day, multiply by the number of days (period)
            $income = $baseIncomeRate * $contribution * $period;

            // Check for conflicts with any other chosen algorithm.
            $conflictFound = false;
            foreach ($chosenAlgorithms as $j => $other) {
                if ($j === $index) {
                    continue;
                }
                $otherCategory = $other['category'];
                if ($otherCategory === 'MS') {
                    $otherCategory = 'MSE';
                }
                // Check if current algorithm (by its category) conflicts with the other
                if (isset($conflictMap[$category]) && in_array($otherCategory, $conflictMap[$category])) {
                    $conflictFound = true;
                    break;
                }
                // Also check the reverse: if the other algorithm’s category conflicts with the current one.
                if (isset($conflictMap[$otherCategory]) && in_array($category, $conflictMap[$otherCategory])) {
                    $conflictFound = true;
                    break;
                }
            }

            // If any conflict is found, we assume that algorithm will not generate income,
            // but you still incur its cost plus an extra penalty.
            if ($conflictFound) {
                $income = 0;
                // For example, add a penalty of 10% of the base algorithm cost
                $penalty = 0.1 * $baseAlgorithmCost * $contribution;
            } else {
                $penalty = 0;
            }

            // Add this algorithm's adjusted cost and income to the totals.
            $totalAlgorithmCost += $cost + $penalty;
            $totalIncome += $income;
            $totalContribution += $contribution;
        }

        // Calculate income rate per unit contribution
        $incomeRatePerUnit = $totalIncome / $totalContribution;

        // Calculate income based on the invested amount
        $incomeValue = $incomeRatePerUnit * $amount;

        // Final calculations:
        // Deduct the algorithm unlocking cost from the initial amount.
        $amountAfterUnlockValue = $amount - $totalAlgorithmCost;
        $finalBalance           = $amountAfterUnlockValue + $incomeValue;
        $finalPercentage        = (($finalBalance - $amount) / $amount) * 100;

        // Return the computed summary as a JSON response.
        return response()->json([
            'totalAlgorithmCost'     => $totalAlgorithmCost,
            'totalIncome'            => $totalIncome,
            'amountAfterUnlockValue' => $amountAfterUnlockValue,
            'incomeValue'            => $incomeValue,
            'finalBalance'           => $finalBalance,
            'finalPercentage'        => $finalPercentage,
        ]);
    }

    public function lockAmountWithChosenAlgorithms(Request $request) {
        $validated = $request->validate([
            'chosen_algorithms' => 'required|array',
            'amount'            => 'required|numeric',
            'period'            => 'required|numeric',
        ]);

        $chosenAlgorithms = $validated['chosen_algorithms'];
        $amount           = $validated['amount'];
        $period           = $validated['period'];

        return response()->json([
            'message' => 'Amount locked with chosen algorithms',
        ]);
    }
}
