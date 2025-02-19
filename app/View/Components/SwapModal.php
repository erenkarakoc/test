<?php
namespace App\View\Components;

use App\Models\Asset;
use App\Models\UserBalances;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class SwapModal extends Component {
    public $assets;
    public $userBalances;

    public function __construct() {
        $user               = Auth::user();
        $this->assets       = Asset::all();
        $this->userBalances = UserBalances::where('user_id', $user->id)->get();
    }

    public function render() {
        return view('components.swap-modal');
    }
}