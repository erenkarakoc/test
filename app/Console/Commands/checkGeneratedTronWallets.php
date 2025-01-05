<?php

namespace App\Console\Commands;

use App\Models\GeneratedTronWallet;
use GuzzleHttp\Client;
use Illuminate\Console\Command;

class CheckGeneratedTronWallets extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:generated-tron-wallets';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checks generated Tron wallet balances and inputs in database';

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
     * Execute the console command.
     */
    public function handle()
    {
        $generatedWallets = GeneratedTronWallet::where('status', 'generated')->get();
        $tron = new \IEXBase\TronAPI\Tron($this->fullNode, $this->solidityNode, $this->eventServer);

        foreach ($generatedWallets as $wallet) {
            $tron->setAddress($wallet->address_hex);
            $trc20 = new \IEXBase\TronAPI\TRC20Contract($tron, 'TG3XXyExBkPp9nzdajDZsozEu4BkaSJozs');

            $wallet->trx_balance = $tron->getBalance(null, true);
            $wallet->usdt_balance = $trc20->balanceOf($wallet->address_hex);

            if ((float) $tron->getBalance(null, true)) {
                $latestTransaction = $this->getLatestTransaction($wallet->address_hex, 1);
                $wallet->hash_id = $latestTransaction[0]['txID'];
                $wallet->status = 'received-balance';
            }

            if ((float) $trc20->balanceOf($wallet->address_hex)) {
                $latestTransaction = $this->getLatestUsdtTransaction($wallet->address_hex, 1);
                $wallet->hash_id = $latestTransaction[0]['txID'];
                $wallet->status = 'received-balance';
            }

            $wallet->save();
        }

        $this->info('Checked generated Tron wallets.');
    }

    /**
     * Get the transactions to an address
     */
    private function getLatestTransaction($address, $limit, $onlyToThisAddress = true)
    {
        $client = new Client;

        $url = "https://api.shasta.trongrid.io/v1/accounts/{$address}/transactions";

        $query = [
            'only_to' => $onlyToThisAddress,
            'limit' => $limit,
        ];

        $response = $client->get($url, [
            'query' => $query,
        ]);

        if ($response->getStatusCode() === 200) {
            $data = json_decode($response->getBody(), true);

            return $data['data'];
        }

        return [];
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
