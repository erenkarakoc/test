<?php
namespace App\View\Components;

use App\Models\Asset;
use App\Models\User;
use App\Models\UserBalances;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\View\Component;

class SwapModal extends Component {
    public $assets;
    public $userBalances;

    protected $client;

    protected $fullNode;
    protected $solidityNode;
    protected $eventServer;
    protected $tron;
    protected $tronApiController;

    protected $bscScanApiKey;
    protected $bscApiController;

    public function __construct() {
        $user = Auth::user();

        $this->assets       = Asset::all();
        $this->userBalances = UserBalances::where('user_id', $user->id)->get();
    }

    public function render() {
        return view('components.swap-modal', ['userBalances' => $this->userBalances], ['assets' => $this->assets]);
    }

}