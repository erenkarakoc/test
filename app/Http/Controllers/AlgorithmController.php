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

        $baseAlgorithmCost = 0.7;
        $baseIncomeRate    = 0.005;

        $conflictMap = [
            'MR'  => ['TF'],
            'MLP' => ['MR'],
            'MSE' => ['TF'],
        ];

        $periodMap = [
            'TF' => 'long',
            'MR' => 'long',
        ];

        $totalContributionRate = 0;
        $totalAlgorithmCost    = 5;

        foreach ($chosenAlgorithms as $algorithm) {
            $totalContributionRate += $algorithm->contribution_rate;
        }

        $totalIncome = $totalContributionRate;

        return response()->json([
            // 'totalAlgorithmCost'     => $totalAlgorithmCost,
            // 'totalIncome'            => $totalIncome,
            // 'amountAfterUnlockValue' => $amountAfterUnlockValue,
            // 'incomeValue'            => $incomeValue,
            // 'finalBalance'           => $finalBalance,
            // 'finalPercentage'        => $finalPercentage,
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
