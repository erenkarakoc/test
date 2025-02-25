<?php
namespace App\Console\Commands\Blockchain;

use App\Models\Blockchains\GeneratedTronWallet;
use App\Models\UserBalances;
use Illuminate\Console\Command;

class TronCheckWallets extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tron:check-wallets';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checks generated Tron wallet balances and inputs in database';

    protected $fullNode;

    protected $solidityNode;

    protected $eventServer;

    public function __construct() {
        parent::__construct();

        $this->fullNode     = new \IEXBase\TronAPI\Provider\HttpProvider('https://api.shasta.trongrid.io');
        $this->solidityNode = new \IEXBase\TronAPI\Provider\HttpProvider('https://api.shasta.trongrid.io');
    }

    /**
     * Execute the console command.
     */
    public function handle() {
        $generatedWallets = GeneratedTronWallet::all();
        $tron             = new \IEXBase\TronAPI\Tron($this->fullNode, $this->solidityNode, $this->eventServer);
        $trc20            = new \IEXBase\TronAPI\TRC20Contract($tron, 'TG3XXyExBkPp9nzdajDZsozEu4BkaSJozs'); // USDT Contract Address

        foreach ($generatedWallets as $wallet) {
            // Retrieve TRX balance
            $trxBalance = $tron->getBalance($wallet->address_hex, true);

            // Retrieve USDT balance
            $usdtBalance = $trc20->balanceOf($wallet->address_hex);

            // Update wallet balances
            $wallet->trx_balance  = $trxBalance;
            $wallet->usdt_balance = $usdtBalance;
            $wallet->save();

            // Update user TRX balance
            $userTRXBalance = UserBalances::where('user_id', $wallet->user_id)
                ->where('wallet', 'TRX')
                ->first();
            if ($userTRXBalance) {
                $userTRXBalance->balance = $trxBalance;
                $userTRXBalance->save();
            }

            // Update user USDT balance
            $userUSDTBalance = UserBalances::where('user_id', $wallet->user_id)
                ->where('wallet', 'USDT')
                ->first();
            if ($userUSDTBalance) {
                $userUSDTBalance->balance = $usdtBalance;
                $userUSDTBalance->save();
            }
        }

        $this->info('Checked generated Tron wallets.');
    }
}
