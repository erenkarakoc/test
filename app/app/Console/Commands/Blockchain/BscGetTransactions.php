<?php
namespace App\Console\Commands\Blockchain;

use App\Http\Controllers\TransactionController;
use App\Models\Blockchains\GeneratedBscWallet;
use App\Models\Transaction;
use App\Models\User;
use App\Models\UserBalances;
use App\Services\UserBalancesService;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\View;

class BscGetTransactions extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bsc:get-transactions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Gets transactions of all BSC addresses';

    protected $userBalancesService;

    protected $bscScanApiKey;

    public function __construct() {
        parent::__construct();

        $this->userBalancesService = new UserBalancesService;
        $this->bscScanApiKey       = config('blockchains.bscscan_api_key');
    }

    /**
     * Get the transactions to an address
     */
    public function handle(UserBalancesService $userBalancesService, TransactionController $transactionController, UserBalances $userBalances, User $userModel) {
        $client           = new Client;
        $generatedWallets = GeneratedBscWallet::all();
        $marketDataPrices = View::getShared()['marketDataPrices'];

        foreach ($generatedWallets as $wallet) {
            $url      = "https://api-testnet.bscscan.com/api?module=account&action=txlist&address={$wallet->address}&startblock=0&endblock=99999999&sort=asc&apikey={$this->bscScanApiKey}";
            $response = $client->get($url);

            if ($response->getStatusCode() === 200) {
                $transactions = json_decode($response->getBody(), true)['result'];

                foreach ($transactions as $transaction) {
                    $existingTransaction = Transaction::where('hash_id', $transaction['hash'])->first();

                    if (! isset($existingTransaction)) {
                        $toAddress = $transaction['to'];
                        $type      = $toAddress === $wallet->address ? 'received' : 'sent';
                        $amount    = bcdiv($transaction['value'], '1000000000000000000', 18);

                        $bnbBalance       = $userBalances->where('user_id', $wallet->user_id)->where('wallet', 'BNB')->value('balance');
                        $bnbLockedBalance = $userBalances->where('user_id', $wallet->user_id)->where('wallet', 'BNB')->value('locked_balance');

                        [$totalBalance, $totalLockedBalance] = $userBalancesService->calculateUserTotalBalance($wallet->user_id);

                        $newTransaction = [
                            'tnx_id'                     => mt_rand(10000000, 99999999),
                            'user_id'                    => $wallet->user_id,
                            'ref_user_id'                => $userModel->where('id', $wallet->user_id)->value('ref_user_id'),
                            'type'                       => $type,
                            'amount_in_asset'            => $amount,
                            'amount_in_usd'              => $amount * $marketDataPrices['BNB'],
                            'asset'                      => 'BNB',
                            'asset_price'                => $marketDataPrices['BNB'],
                            'asset_balance_after'        => $bnbBalance,
                            'asset_locked_balance_after' => $bnbLockedBalance,
                            'total_balance_after'        => $totalBalance,
                            'total_locked_balance_after' => $totalLockedBalance,
                            'strategy_pack_id'           => null,
                            'status'                     => 'pending',
                            'hash_id'                    => $transaction['hash'],
                        ];

                        $transactionController->createTransaction($newTransaction);
                    }
                }
            }
        }

        $this->info('Checked BNB transactions.');
    }
}
