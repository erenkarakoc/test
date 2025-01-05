<?php

namespace App\Console\Commands;

use App\Models\GeneratedTronWallet;
use Illuminate\Console\Command;

class SendReceivedTronBalanceToMainWallet extends Command
{
    protected $signature = 'send:received-tron-balance-to-main-wallet';

    protected $description = 'Sends received Tron balances from GeneratedWallet to main wallet';

    protected $fullNode;

    protected $solidityNode;

    protected $eventServer;

    public function __construct()
    {
        parent::__construct();

        $this->fullNode = new \IEXBase\TronAPI\Provider\HttpProvider('https://api.shasta.trongrid.io');
        $this->solidityNode = new \IEXBase\TronAPI\Provider\HttpProvider('https://api.shasta.trongrid.io');
    }

    public function handle()
    {
        $generatedWallets = GeneratedTronWallet::where('status', 'paid-user')->get();

        foreach ($generatedWallets as $wallet) {
            $tron = new \IEXBase\TronAPI\Tron($this->fullNode, $this->solidityNode, $this->eventServer);
            $tron->setAddress($wallet->address_hex);
            $tron->setPrivateKey($wallet->private_key);
            $tronBalance = $tron->getBalance($wallet->address_hex) / 1000000;

            if ($tronBalance) {
                try {
                    $transaction = $tron->getTransactionBuilder()->sendTrx(env('MAIN_TRON_WALLET_HEX'), $tronBalance, $wallet->address_hex);
                    $signedTransaction = $tron->signTransaction($transaction);

                    // $estimatedBandwith = $this->calculateBandwidth($signedTransaction);

                    $tron->send(env('MAIN_TRON_WALLET_HEX'), $tronBalance);

                    $wallet->status = 'sent-balance';
                    $wallet->save();
                    $this->info('Sent received Tron balances to main wallet.');
                } catch (\Exception $e) {
                    $wallet->status = 'errored';
                    $wallet->save();
                    $this->error('Caught exception: ', $e->getMessage(), "\n");
                }
            }
        }
    }

    private function calculateBandwidth($transaction)
    {
        $howManyBandwidthNeed = strlen($transaction['raw_data_hex']) / 2;
        foreach ($transaction['signature'] as $signature) {
            $howManyBandwidthNeed += strlen($signature);
        }
        $howManyBandwidthNeed = ceil($howManyBandwidthNeed) + 68;

        return $howManyBandwidthNeed;
    }
}
