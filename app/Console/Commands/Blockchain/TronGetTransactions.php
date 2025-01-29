<?php

namespace App\Console\Commands\Blockchain;

use App\Models\Blockchains\GeneratedTronWallet;
use GuzzleHttp\Client;
use Illuminate\Console\Command;

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
  private function handle()
  {
    $client = new Client;
    $tron = new \IEXBase\TronAPI\Tron($this->fullNode, $this->solidityNode, $this->eventServer);

    $generatedWallets = GeneratedTronWallet::all();

    foreach ($generatedWallets as $wallet) {
      $url = "https://api.shasta.trongrid.io/v1/accounts/{$wallet->address}/transactions";
      $response = $client->get($url, );

      if ($response->getStatusCode() === 200) {
        $data = json_decode($response->getBody(), true);

        dd($data);

        return $data['data'];
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


