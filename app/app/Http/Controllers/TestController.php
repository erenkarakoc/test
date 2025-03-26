<?php
namespace App\Http\Controllers;

use App\Models\LockedPack;

class TestController extends Controller
{
  protected $fullNode;
  protected $solidityNode;
  protected $eventServer;
  protected $tron;

  public function __construct()
  {
    $this->fullNode = new \IEXBase\TronAPI\Provider\HttpProvider('https://api.shasta.trongrid.io');
    $this->solidityNode = new \IEXBase\TronAPI\Provider\HttpProvider('https://api.shasta.trongrid.io');
    $this->tron = new \IEXBase\TronAPI\Tron($this->fullNode, $this->solidityNode, $this->eventServer);
  }

  public function test()
  {
    $lockedPack = LockedPack::where('id', 33)->first();

    $tradeInfo = json_decode($lockedPack->trade_info, true);
    $profitSchedule = $tradeInfo['profit_schedule'];

$sum = 0;

    foreach ($profitSchedule as $profit) {
      $sum += $profit['amount'];
    }

    dd($sum);
  }
}
