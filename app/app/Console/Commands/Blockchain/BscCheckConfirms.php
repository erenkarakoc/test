<?php
namespace App\Console\Commands\Blockchain;

use App\Http\Controllers\NotificationController;
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
      // Use GET instead of POST to call the BscScan API
      $bscTransactionResponse = $client->get('https://api-testnet.bscscan.com/api', [
        'query' => [
          'module' => 'proxy',
          'action' => 'eth_getTransactionByHash',
          'txhash' => $transaction->hash_id,
          'apikey' => $this->bscScanApiKey,
        ],
        'headers' => [
          'Accept' => 'application/json',
        ],
      ]);

      $transactionData = json_decode($bscTransactionResponse->getBody(), true);

      // Make sure that we have a valid block number before proceeding
      if (!isset($transactionData['result']['blockNumber'])) {
        // Skip this transaction if blockNumber is not present (transaction might still be pending)
        continue;
      }
      $blockNumberHex = $transactionData['result']['blockNumber'];

      // Get the current block number using a GET request
      $currentBlockResponse = $client->get('https://api-testnet.bscscan.com/api', [
        'query' => [
          'module' => 'proxy',
          'action' => 'eth_blockNumber',
          'apikey' => $this->bscScanApiKey,
        ],
        'headers' => [
          'Accept' => 'application/json',
        ],
      ]);

      $currentBlockData = json_decode($currentBlockResponse->getBody(), true);
      if (!isset($currentBlockData['result'])) {
        // If for some reason the current block is not available, skip this iteration.
        continue;
      }
      $currentBlockHex = $currentBlockData['result'];

      // Convert hexadecimal block numbers to decimal values
      $blockNumber = hexdec($blockNumberHex);
      $currentBlock = hexdec($currentBlockHex);

      // Calculate the number of confirmations
      $confirmations = $currentBlock - $blockNumber;

      if ($confirmations > 13) {
        $transactionController->setTransactionStatus($transaction->tnx_id, 'completed');

        if ($transaction->type === 'received') {
          $notificationTitle = 'Received';
        } else if ($transaction->type === 'sent') {
          $notificationTitle = 'Sent';
        }

        $notificationController = new NotificationController();
        $notificationController->sendNotification(
          $transaction->user_id,
          $transaction->type,
          $notificationTitle . ' ' . $transaction->asset,
          '',
          $notificationTitle . ' ' . $transaction->amount_in_asset . ' ' . $transaction->asset . ' successfully.',
          route('page-transactions') . '?tnx_id=' . $transaction->tnx_id,
        );
      }
    }

    $this->info('Checked BNB transaction confirms.');
  }
}
