<?php

namespace App\Console\Commands\Blockchain;

use App\Http\Controllers\TransactionController;
use App\Models\Transaction;
use App\Services\UserBalancesService;
use GuzzleHttp\Client;
use Illuminate\Console\Command;

class BscCheckConfirms extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'bsc:check-confirms';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Check transaction statuses and if confirmed, sets status as "completed".';

  protected $userBalancesService;

  public function __construct()
  {
    parent::__construct();

    $this->userBalancesService = new UserBalancesService;
  }

  public function handle(TransactionController $transactionController)
  {
    $client = new Client;
    $pendingTransactions = Transaction::where('status', 'pending')
      ->where('asset', 'BNB')
      ->get();

    foreach ($pendingTransactions as $transaction) {
      $response = $client->post("https://api.bscscan.com/api?module=proxy&action=eth_getTransactionByHash&txhash={$transaction->hash_id}&apikey={$this->bscScanApiKey}", [
        'json' => ['value' => $transaction->hash_id],
        'headers' => [
          'Accept' => 'application/json',
          'Content-Type' => 'application/json',
        ],
      ]);

      if ($response->getStatusCode() === 200) {
        $responseData = json_decode($response->getBody(), true);

        if (!empty($responseData)) {
          $transactionController->setTransactionStatus($transaction->tnx_id, 'completed');
        }
      }
    }
  }
}
