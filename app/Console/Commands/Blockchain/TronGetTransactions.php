<?php
namespace App\Console\Commands\Blockchain;

use App\Http\Controllers\TransactionController;
use App\Models\Blockchains\GeneratedTronWallet;
use App\Models\Transaction;
use App\Models\User;
use App\Models\UserBalances;
use App\Services\UserBalancesService;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\View;

class TronGetTransactions extends Command {
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

    protected $userBalancesService;

    public function __construct() {
        parent::__construct();

        $this->fullNode            = new \IEXBase\TronAPI\Provider\HttpProvider('https://api.shasta.trongrid.io');
        $this->solidityNode        = new \IEXBase\TronAPI\Provider\HttpProvider('https://api.shasta.trongrid.io');
        $this->userBalancesService = new UserBalancesService;
    }

    /**
     * Get the transactions to an address
     */
    public function handle(UserBalancesService $userBalancesService, TransactionController $transactionController, UserBalances $userBalances, User $userModel) {
        $client           = new Client;
        $generatedWallets = GeneratedTronWallet::all();
        $marketDataPrices = View::getShared()['marketDataPrices'];

        foreach ($generatedWallets as $wallet) {
            $url      = "https://api.shasta.trongrid.io/v1/accounts/{$wallet->address_hex}/transactions";
            $response = $client->get($url);

            if ($response->getStatusCode() === 200) {
                $transactions = json_decode($response->getBody(), true)['data'];

                foreach ($transactions as $transaction) {
                    $existingTransaction = Transaction::where('hash_id', $transaction['txID'])->first();

                    if (! isset($existingTransaction)) {
                        $toAddress = $transaction['raw_data']['contract'][0]['parameter']['value']['to_address'];
                        $type      = $toAddress === $wallet->address_base58 ? 'received' : 'sent';
                        $amount    = $transaction['raw_data']['contract'][0]['parameter']['value']['amount'] / 1000000;

                        $trxBalance       = $userBalances->where('user_id', $wallet->user_id)->where('wallet', 'TRX')->value('balance');
                        $trxLockedBalance = $userBalances->where('user_id', $wallet->user_id)->where('wallet', 'TRX')->value('locked_balance');

                        [$totalBalance, $totalLockedBalance] = $userBalancesService->calculateUserTotalBalance($wallet->user_id);

                        $newTransaction = [
                            'tnx_id'                     => mt_rand(10000000, 99999999),
                            'user_id'                    => $wallet->user_id,
                            'ref_user_id'                => $userModel->where('id', $wallet->user_id)->value('ref_user_id'),
                            'type'                       => $type,
                            'amount_in_asset'            => $amount,
                            'amount_in_usd'              => $amount * $marketDataPrices['TRX'],
                            'asset'                      => 'TRX',
                            'asset_price'                => $marketDataPrices['TRX'],
                            'asset_balance_after'        => $trxBalance,
                            'asset_locked_balance_after' => $trxLockedBalance,
                            'total_balance_after'        => $totalBalance,
                            'total_locked_balance_after' => $totalLockedBalance,
                            'strategy_pack_id'           => null,
                            'status'                     => 'pending',
                            'hash_id'                    => $transaction['txID'],
                            'trade_info'                 => json_encode([]),
                        ];

                        $transactionController->createTransaction($newTransaction);
                    }
                }
            }
        }

        $this->info('Fetched Tron transactions.');
    }

    /**
     * Get the latest USDT (TRC-20) transactions to an address
     */
    private function getLatestUsdtTransaction($address) {
        $client = new Client;

        $url = "https://api.shasta.trongrid.io/v1/accounts/{$address}/transactions/trc20";

        $response = $client->get($url);

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
