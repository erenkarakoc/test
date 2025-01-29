<?php

namespace App\Console\Commands\Blockchain;

use App\Http\Controllers\TransactionController;
use App\Models\Blockchains\GeneratedTronWallet;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class TronGetTransactions extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'tron:get-transactions';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Gets transactions of all Tron addresses';

  protected $fullNode;

  protected $solidityNode;

  protected $eventServer;

  public function __construct()
  {
    parent::__construct();

    $this->fullNode = new \IEXBase\TronAPI\Provider\HttpProvider('https://api.shasta.trongrid.io');
    $this->solidityNode = new \IEXBase\TronAPI\Provider\HttpProvider('https://api.shasta.trongrid.io');
  }

  /**
   * Get the transactions to an address
   */
  public function handle()
  {
    $client = new Client;
    $generatedWallets = GeneratedTronWallet::all();

    foreach ($generatedWallets as $wallet) {
      $url = "https://api.shasta.trongrid.io/v1/accounts/{$wallet->address_hex}/transactions";
      $response = $client->get($url);

      if ($response->getStatusCode() === 200) {
        $transactions = json_decode($response->getBody(), true)['data'];

        $transactionController = new TransactionController();
        foreach ($transactions as $transaction) {
          $toAddress = $transaction['raw_data']['contract'][0]['parameter']['value']['to_address'];
          $type = $toAddress === $wallet->address_base58 ? 'received' : 'sent';
          $amount = $transaction['raw_data']['contract'][0]['parameter']['value']['amount'] / 1000000;
          $marketDataPrices = View::getShared()['marketDataPrices'];
          $userTotalBalance = View::getShared();

          dd($userTotalBalance);

          $newTransaction = [
            'tnx_id' => mt_rand(10000000, 99999999),
            'user_id' => Auth::user()->id,
            'ref_user_id' => Auth::user()->ref_id,
            'type' => $type,
            'amount_in_asset' => $amount,
            'amount_in_usd' => $amount * $marketDataPrices['TRX'],
            'asset' => 'TRX',
            'asset_price' => $marketDataPrices['TRX'],
            'asset_balance_after' => 0,
            'asset_locked_balance_after' => 0,
            'total_balance_after' => 0,
            'total_locked_balance_after' => 0,
            'strategy_pack_id' => null,
            'status' => 'completed',
            'hash_id' => $transaction['txID'],
          ];

          $transactionController->createTransaction($newTransaction);
        }
      }
    }
  }

  /**
   * Get the latest USDT (TRC-20) transactions to an address
   */
  private function getLatestUsdtTransaction($address, $limit, $onlyToThisAddress = true)
  {
    $client = new Client;

    $url = "https://api.shasta.trongrid.io/v1/accounts/{$address}/transactions/trc20";

    $query = [
      'only_to' => $onlyToThisAddress,
      'limit' => $limit,
    ];

    $response = $client->get($url, [
      'query' => $query,
    ]);

    $trc20ContractAddress = 'TG3XXyExBkPp9nzdajDZsozEu4BkaSJozs';

    if ($response->getStatusCode() === 200) {
      $data = json_decode($response->getBody(), true);

      $filteredTransactions = array_filter($data['data'], function ($transaction) use ($trc20ContractAddress) {
        return isset($transaction['to']) && strtolower($transaction['to']) === strtolower($trc20ContractAddress);
      });

      return array_values($filteredTransactions);
    }

    return [];
  }
}


