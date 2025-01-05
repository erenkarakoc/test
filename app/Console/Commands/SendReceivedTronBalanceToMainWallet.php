<?php

namespace App\Console\Commands;

use App\Models\GeneratedTronWallet;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use kornrunner\Secp256k1;
use kornrunner\Signature\Signature;

class SendReceivedTronBalanceToMainWallet extends Command
{
    protected $signature = 'send:received-tron-balance-to-main-wallet';

    protected $description = 'Sends received Tron balances from GeneratedWallet to main wallet';

    protected $client;

    protected $mainTronWalletAddress;

    public function __construct()
    {
        parent::__construct();

        $this->client = new Client;
        $this->mainTronWalletAddress = env('MAIN_TRON_WALLET_ADDRESS');
    }

    public function handle()
    {
        $generatedWallets = GeneratedTronWallet::where('status', 'paid-user')->get();

        foreach ($generatedWallets as $wallet) {
            $data = [
                'owner_address' => $wallet->address_base58,
                'to_address' => $this->mainTronWalletAddress,
                'amount' => 1,
            ];

            $transaction = $this->postToTronGrid('/wallet/createtransaction', $data);
            $signature = $this->signTransaction($transaction['txID'], $wallet->private_key);
            $transaction['signature'] = [$signature];

            dd($transaction);
            $broadcastedTransacton = $this->postToTronGrid('/wallet/broadcasttransaction', ['transaction' => $transaction]);

            dd($broadcastedTransacton);
        }

        $this->info('Sent received Tron balances to main wallet.');
    }

    private function postToTronGrid($endpoint, $data)
    {
        $response = $this->client->post('https://api.shasta.trongrid.io'.$endpoint, ['json' => $data, 'headers' => ['Content-Type' => 'application/json']]);

        return json_decode($response->getBody()->getContents(), true);
    }

    private function signTransaction(string $message, string $privateKey): string
    {
        $secp = new Secp256k1;

        /** @var Signature $sign */
        $sign = $secp->sign($message, $privateKey, ['canonical' => false]);

        return $sign->toHex().bin2hex(implode('', array_map('chr', [$sign->getRecoveryParam()])));
    }

    private function calculateBandwidth($transaction)
    {
        $howManyBandwidthNeed = strlen($transaction['raw_data_hex']) / 2;

        foreach ($transaction['signatur'] as $signature) {
            $howManyBandwidthNeed += strlen($signature);
        }

        $howManyBandwidthNeed = ceil($howManyBandwidthNeed) + 68;

        return $howManyBandwidthNeed;
    }
}
