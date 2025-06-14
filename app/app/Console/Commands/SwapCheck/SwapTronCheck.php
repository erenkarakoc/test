<?php
namespace App\Console\Commands\SwapCheck;

use App\Http\Controllers\NotificationController;
use App\Models\Transaction;
use App\Models\UserBalances;
use App\Services\UserBalancesService;
use GuzzleHttp\Client;
use Illuminate\Console\Command;

class SwapTronCheck extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'swap-check:tron';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Checks swap transactions, marks as completed if completed, adjusts balance accordingly.';

  protected $client;

  public function __construct()
  {
    parent::__construct();
  }

  /**
   * Execute the console command.
   */
  public function handle()
  {
    $client = new Client();
    $userBalancesService = new UserBalancesService;

    $pendingSwapTransactions = Transaction::where('type', 'swap')->where('status', 'pending')->get();

    if ($pendingSwapTransactions->isNotEmpty()) {
      foreach ($pendingSwapTransactions as $transaction) {
        $response = $client->post('https://api.shasta.trongrid.io/walletsolidity/gettransactionbyid', [
          'json' => ['value' => $transaction->hash_id],
          'headers' => [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
          ],
        ]);

        if ($response->getStatusCode() === 200) {
          $responseData = json_decode($response->getBody(), true);

          if (!empty($responseData)) {
            $totalBalance = $userBalancesService->calculateUserTotalBalance($transaction->user_id)[0];

            $trxBalance = UserBalances::where('user_id', $transaction['user_id'])->where('wallet', 'TRX')->first();
            $usdBalance = UserBalances::where('user_id', $transaction['user_id'])->where('wallet', 'USD')->first();

            if ($transaction->swap_to_asset) {
              $usdBalance->balance -= $transaction->amount_in_usd;
              $usdBalance->save();
            } else {
              $usdBalance->balance += $transaction->amount_in_usd;
              $usdBalance->save();
            }

            $transaction->asset_balance_after = $trxBalance->balance;
            $transaction->total_balance_after = $totalBalance;
            $transaction->status = 'completed';
            $transaction->save();

            $notificationController = new NotificationController();
            $notificationController->sendNotification(
              $transaction->user_id,
              $transaction->type,
              'Swapped ' . $transaction->asset,
              '',
              'Swapped ' . $transaction->amount_in_asset . ' ' . $transaction->asset . ' successfully.',
              route('page-transactions') . '?tnx_id=' . $transaction->tnx_id,
            );
          }
        }
      }
    }

    $this->info('Checked Tron swaps.');
  }
}
