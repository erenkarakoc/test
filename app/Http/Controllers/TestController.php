<?php
namespace App\Http\Controllers;

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
        $mainWallets            = config('blockchains.main_tron_addresses');
        $mainWalletsWithBalance = [];

        foreach ($mainWallets as $wallet) {
            $mainWalletsWithBalance[] = [
                'address' => $wallet['hex'],
                'balance' => $this->tron->getBalance($wallet['hex']),
            ];
        }

        dd($mainWalletsWithBalance);
    }
}
