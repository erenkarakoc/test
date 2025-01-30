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

  protected $bscScanApiKey;

  public function __construct()
  {
    parent::__construct();

    $this->userBalancesService = new UserBalancesService;
    $this->bscScanApiKey = config('blockchains.bscscan_api_key');
  }

  public function handle(TransactionController $transactionController)
  {
    $client = new Client;
    $pendingTransactions = Transaction::where('status', 'pending')
      ->where('asset', 'BNB')
      ->get();

    foreach ($pendingTransactions as $transaction) {
      $bscTransaction = $client->post("https://api-testnet.bscscan.com/api?module=proxy&action=eth_getTransactionByHash&txhash={$transaction->hash_id}&apikey={$this->bscScanApiKey}", [
        'json' => ['value' => $transaction->hash_id],
        'headers' => [
          'Accept' => 'application/json',
          'Content-Type' => 'application/json',
        ],
      ]);

      $blockNumberHex = json_decode($bscTransaction->getBody(), true)['result']['blockNumber'];
      $currentBlockHex = json_decode($client->post("https://api-testnet.bscscan.com/api?module=proxy&action=eth_blockNumber&apikey={$this->bscScanApiKey}")->getBody(), true)['result'];

      // Convert hexadecimal block numbers to decimal
      $blockNumber = hexdec($blockNumberHex);
      $currentBlock = hexdec($currentBlockHex);

      // Calculate the number of confirmations
      $confirmations = $currentBlock - $blockNumber;

      if ($confirmations > 13) {
        $transactionController->setTransactionStatus($transaction->tnx_id, 'completed');
      }
    }
  }
}
