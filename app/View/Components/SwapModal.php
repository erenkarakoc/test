<?php
namespace App\View\Components;

use App\Models\Asset;
use App\Models\MarketData;
use App\Models\UserBalances;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\View\Component;

class SwapModal extends Component {
    public $assets;
    public $userBalances;

    public function __construct() {
        $user               = Auth::user();
        $this->assets       = Asset::all();
        $this->userBalances = UserBalances::where('user_id', $user->id)->get();
    }

    public function swap(Request $request) {
        $validated = $request->validate([
            'swapAmount'    => 'numeric|required',
            'isSwapToAsset' => 'boolean|required',
            'swapAsset'     => 'string|required',
        ]);

        $swapAmount    = $validated['swapAmount'];
        $isSwapToAsset = $validated['isSwapToAsset'];
        $swapAsset     = $validated['swapAsset'];

        $assetPrice       = MarketData::where('asset', $swapAsset)->value('price');
        $userAssetBalance = UserBalances::where('user_id', Auth::user()->id)->where('wallet', $swapAsset)->first();
        $userUsdBalance   = UserBalances::where('user_id', Auth::user()->id)->where('wallet', 'USD')->first();

        $amountInUsd = $swapAmount * $assetPrice;

        if ($isSwapToAsset) {
            if ($userUsdBalance->balance >= $amountInUsd) {
                $userUsdBalance->balance -= $amountInUsd;
                $userUsdBalance->save();

                if ($userAssetBalance) {
                    $userAssetBalance->balance += $swapAmount;
                    $userAssetBalance->save();
                } else {
                    UserBalances::create([
                        'user_id' => Auth::user()->id,
                        'wallet'  => $swapAsset,
                        'balance' => $swapAmount,
                    ]);
                }

                sleep(2);

                return response()->json([
                    'status'  => 'success',
                    'message' => 'Swapped successfully!',
                ]);
            } else {
                return response()->json([
                    'status'  => 'error',
                    'message' => 'Insufficient balance!',
                ]);
            }
        } else {
            if ($userAssetBalance->balance >= $swapAmount) {
                $userAssetBalance->balance -= $swapAmount;
                $userAssetBalance->save();

                if ($userUsdBalance) {
                    $userUsdBalance->balance += $amountInUsd;
                    $userUsdBalance->save();
                } else {
                    UserBalances::create([
                        'user_id' => Auth::user()->id,
                        'wallet'  => 'USD',
                        'balance' => $amountInUsd,
                    ]);
                }

                sleep(2);

                return response()->json([
                    'status'  => 'success',
                    'message' => 'Swapped successfully!',
                ]);
            } else {
                return response()->json([
                    'status'  => 'error',
                    'message' => 'Insufficient balance!',
                ]);
            }
        }
    }

    public function render() {
        return view('components.swap-modal');
    }
}