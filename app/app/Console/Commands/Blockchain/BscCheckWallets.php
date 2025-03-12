<?php
namespace App\Console\Commands\Blockchain;

use App\Models\Blockchains\GeneratedBscWallet;
use App\Models\UserBalances;
use GuzzleHttp\Client;
use Illuminate\Console\Command;

class BscCheckWallets extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bsc:check-wallets';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checks generated BSC wallet balances and inputs in database';

    protected $bscScanApiKey;

    public function __construct() {
        parent::__construct();

        $this->bscScanApiKey = config('blockchains.bscscan_api_key');
    }

    /**
     * Execute the console command.
     */
    public function handle() {
        $generatedWallets = GeneratedBscWallet::all();
        $client           = new Client();

        foreach ($generatedWallets as $wallet) {
            // Retrieve BNB balance
            $url      = "https://api-testnet.bscscan.com/api?module=account&action=balance&address={$wallet->address}&apikey={$this->bscScanApiKey}";
            $response = $client->get($url);
            $data     = json_decode($response->getBody(), true);

            if (isset($data['status']) && $data['status'] == '1') {
                // Balance is returned in wei; convert to BNB
                $balanceInWei = $data['result'];
                $balanceInBnb = bcdiv($balanceInWei, '1000000000000000000', 18);

                // Update wallet balances
                $wallet->balance = $balanceInBnb;
                $wallet->save();

                // Update user BNB balance
                $userBNBBalance = UserBalances::where('user_id', $wallet->user_id)
                    ->where('wallet', 'BNB')
                    ->first();
                if ($userBNBBalance) {
                    $userBNBBalance->balance = $balanceInBnb;
                    $userBNBBalance->save();
                }
            } else {
                $this->error("Failed to retrieve balance for wallet: {$wallet->address}");
            }
        }

        $this->info('Checked generated BNB wallets.');
    }
}
