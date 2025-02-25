<?php
namespace App\Console\Commands\SwapCheck;

use App\Http\Controllers\TransactionController;
use App\Models\Transaction;
use App\Models\UserBalances;
use App\Services\UserBalancesService;
use GuzzleHttp\Client;
use Illuminate\Console\Command;

class SwapTronCheck extends Command {
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
    protected $transactionController;
    protected $userBalancesService;

    public function __construct() {
        parent::__construct();

        $this->client                = new Client;
        $this->transactionController = new TransactionController;
        $this->userBalancesService   = new UserBalancesService;
    }

    /**
     * Execute the console command.
     */
    public function handle() {
        $pendingSwapTransactions = Transaction::where('type', 'swap')->where('status', 'pending')->get();

        if ($pendingSwapTransactions->isNotEmpty()) {
            foreach ($pendingSwapTransactions as $transaction) {
                $response = $this->client->post('https://api.shasta.trongrid.io/walletsolidity/gettransactionbyid', [
                    'json'    => ['value' => $transaction->hash_id],
                    'headers' => [
                        'Accept'       => 'application/json',
                        'Content-Type' => 'application/json',
                    ],
                ]);

                if ($response->getStatusCode() === 200) {
                    $responseData = json_decode($response->getBody(), true);

                    if (! empty($responseData)) {
                        $totalBalance = $this->userBalancesService->calculateUserTotalBalance($transaction->user_id)[0];

                        $trxBalance = UserBalances::where('user_id', $transaction['user_id'])->where('wallet', 'TRX')->first();
                        $usdBalance = UserBalances::where('user_id', $transaction['user_id'])->where('wallet', 'USD')->first();

                        if ($transaction->swap_to_asset) {
                            $trxBalance->balance += $transaction->amount_in_asset;
                            $trxBalance->save();

                            $usdBalance->balance -= $transaction->ammount_in_usd;
                            $usdBalance->save();

                            $this->info('usd amount: ' . $usdBalance->balance);
                        } else {
                            $trxBalance->balance -= $transaction->amount_in_asset;
                            $trxBalance->save();

                            $usdBalance->balance += $transaction->amount_in_usd;
                            $usdBalance->save();
                        }

                        $transaction->total_balance_after = $totalBalance;
                        $transaction->asset_balance_after = $trxBalance->balance;
                        $transaction->status              = 'completed';
                        $transaction->save();
                    }
                }
            }
        }

        $this->info('Checked Tron swaps.');
    }
}
