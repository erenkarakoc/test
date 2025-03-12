<?php
namespace App\Http\Controllers;

use App\Models\LockedPack;

class TestController extends Controller {
    protected $fullNode;
    protected $solidityNode;
    protected $eventServer;
    protected $tron;

    public function __construct() {
        $this->fullNode     = new \IEXBase\TronAPI\Provider\HttpProvider('https://api.shasta.trongrid.io');
        $this->solidityNode = new \IEXBase\TronAPI\Provider\HttpProvider('https://api.shasta.trongrid.io');
        $this->tron         = new \IEXBase\TronAPI\Tron($this->fullNode, $this->solidityNode, $this->eventServer);
    }

    public function test() {
        $lockedPacks = LockedPack::all();

        foreach ($lockedPacks as $lockedPack) {
            $lockedPack->trade_info = null;
            $lockedPack->status     = 'pending';
            $lockedPack->save();
        }
    }
}
