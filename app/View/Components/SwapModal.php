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

        $assetPrice = MarketData::where('asset', $validated['swapAsset'])->value('price');

        dd($assetPrice);

        if ($validated['isSwapToAsset']) {
            $userUsdBalance = UserBalances::where('user_id', Auth::user()->id)->where('wallet', 'USD')->first();

            if ($userUsdBalance->balance >= $validated['swapAmount']) {

                return response()->json([
                    'status' => 'success',
                ]);
            } else {
                return response()->json([
                    'status'  => 'error',
                    'message' => 'Insufficient balance!',
                ]);
            }
        } else {
            $userAssetBalance = UserBalances::where('user_id', Auth::user()->id)->where('wallet', $validated['swapAsset'])->first();

            if ($userAssetBalance->balance >= $validated['swapAmount']) {
                return response()->json([
                    'status' => 'success',
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