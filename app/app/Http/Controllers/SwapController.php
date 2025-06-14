<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Blockchains\BscApiController;
use App\Http\Controllers\Blockchains\TronApiController;
use App\Models\Blockchains\GeneratedBscWallet;
use App\Models\Blockchains\GeneratedTronWallet;
use App\Models\MarketData;
use App\Models\Transaction;
use App\Models\User;
use App\Models\UserBalances;
use App\Services\UserBalancesService;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class SwapController extends Controller {
    protected $client;

    protected $fullNode;
    protected $solidityNode;
    protected $eventServer;
    protected $tron;
    protected $tronApiController;

    protected $bscScanApiKey;
    protected $bscApiController;

    public function __construct() {
        $this->client = new Client;

        $this->fullNode          = new \IEXBase\TronAPI\Provider\HttpProvider('https://api.shasta.trongrid.io');
        $this->solidityNode      = new \IEXBase\TronAPI\Provider\HttpProvider('https://api.shasta.trongrid.io');
        $this->tron              = new \IEXBase\TronAPI\Tron($this->fullNode, $this->solidityNode, $this->eventServer);
        $this->tronApiController = new TronApiController;

        $this->bscScanApiKey    = config('blockchains.bscscan_api_key');
        $this->bscApiController = new BscApiController;
    }

    public function swap(Request $request) {
        $validated = $request->validate([
            'swapAmount'    => 'numeric|required',
            'isSwapToAsset' => 'boolean|required',
            'swapAsset'     => 'string|required',
        ]);

        $user_id            = Auth::user()->id;
        $userHasPendingSwap = Transaction::where('user_id', $user_id)->where('type', 'swap')->where('status', 'pending')->get();

        if ($userHasPendingSwap->isNotEmpty()) {
            return [
                'status'  => 'error',
                'message' => 'You have a pending swap currently, please wait a few minutes and try again!',
            ];
        }

        sleep(2);

        $swapAmount    = $validated['swapAmount'];
        $isSwapToAsset = $validated['isSwapToAsset'];
        $swapAsset     = $validated['swapAsset'];

        $assetPrice       = MarketData::where('asset', $swapAsset)->value('price');
        $userAssetBalance = UserBalances::where('user_id', $user_id)->where('wallet', $swapAsset)->first();
        $userUsdBalance   = UserBalances::where('user_id', $user_id)->where('wallet', 'USD')->first();

        $amountInUsd = $swapAmount * $assetPrice;

        if ($isSwapToAsset) {
            if ($userUsdBalance->balance >= $amountInUsd) {
                $receiveToMain = $this->sendToUser($swapAsset, $swapAmount);

                if ($receiveToMain['success']) {
                    return response()->json([
                        'status'  => 'success',
                        'message' => 'Swapped successfully!',
                        'tnx_id'  => $receiveToMain['tnx_id'],
                    ]);
                } else {
                    return response()->json([
                        'status'  => 'error',
                        'message' => 'Something went wrong, please try again later.',
                    ]);
                }
            } else {
                return response()->json([
                    'status'  => 'error',
                    'message' => 'Insufficient balance!',
                ]);
            }
        } else {
            if ($userAssetBalance->balance >= $swapAmount) {
                $sendToMain = $this->sendToMain($swapAsset, $swapAmount);

                if ($sendToMain['success']) {
                    return response()->json([
                        'status'  => 'success',
                        'message' => 'Swapped successfully!',
                        'tnx_id'  => $sendToMain['tnx_id'],
                    ]);
                } else {
                    if ($sendToMain['message']) {
                        return response()->json([
                            'status'  => 'error',
                            'message' => $sendToMain['message'],
                        ]);
                    } else {
                        return response()->json([
                            'status'  => 'error',
                            'message' => 'Something went wrong, please try again later.',
                        ]);
                    }
                }
            } else {
                return response()->json([
                    'status'  => 'error',
                    'message' => 'Insufficient balance!',
                ]);
            }
        }
    }

    private function sendToMain($swapAsset, $swapAmount) {
        $user_id = Auth::user()->id;

        if ($swapAsset === 'TRX') {
            $userTrxAddress   = GeneratedTronWallet::where('user_id', $user_id)->first()->value('address_hex');
            $userTrxAddressPk = GeneratedTronWallet::where('address_hex', $userTrxAddress)->value('private_key');

            $randomAddresses        = config('blockchains.main_tron_addresses');
            $randomAddressId        = array_rand($randomAddresses);
            $randomReceivingAddress = $randomAddresses[$randomAddressId]['hex'];

            $transaction = $this->tronApiController->createTransaction($userTrxAddress, $randomReceivingAddress, $swapAmount);

            if (isset($transaction['Error'])) {
                return [
                    'success' => false,
                    'message' => 'Insufficient TRX balance to cover fees!',
                ];
            }

            $fee              = $this->tronApiController->calculateTrxTransactionFee($transaction);
            $amountWithoutFee = $swapAmount - $fee;

            $this->tron->setAddress($userTrxAddress);
            $this->tron->setPrivateKey($userTrxAddressPk);

            $broadcastedTransaction = $this->tron->send($randomReceivingAddress, $amountWithoutFee);
            if ($broadcastedTransaction['result']) {
                $tnx_id = $this->createSwapTransactionForTron($broadcastedTransaction, $user_id, false);
                return [
                    'success' => true,
                    'tnx_id'  => $tnx_id,
                ];
            } else {
                return [
                    'success' => false,
                ];
            }
        } else {
            return [
                'success' => false,
            ];
        }
    }

    private function sendToUser($swapAsset, $swapAmount) {
        $user_id = Auth::user()->id;

        if ($swapAsset === 'TRX') {
            $userTrxAddress = GeneratedTronWallet::where('user_id', $user_id)->first()->value('address_hex');

            $mainWallets = config('blockchains.main_tron_addresses');
            $addresses   = [];

            foreach ($mainWallets as $wallet) {
                $addresses[] = [
                    'address' => $wallet['hex'],
                    'balance' => $this->tron->getBalance($wallet['hex']),
                    'pk'      => $wallet['pk'],
                ];
            }

            $addressWithHighestBalanceIdx = array_search(max(array_column($addresses, 'balance')), array_column($addresses, 'balance'));
            $addressWithHighestBalance    = $addresses[$addressWithHighestBalanceIdx]['address'];
            $addressWithHighestBalancePk  = $addresses[$addressWithHighestBalanceIdx]['pk'];

            $this->tron->setAddress($addressWithHighestBalance);
            $this->tron->setPrivateKey($addressWithHighestBalancePk);

            $broadcastedTransaction = $this->tron->send($userTrxAddress, $swapAmount);

            if ($broadcastedTransaction['result']) {
                $tnx_id = $this->createSwapTransactionForTron($broadcastedTransaction, $user_id, true);
                return [
                    'success' => true,
                    'tnx_id'  => $tnx_id,
                ];
            } else {
                return [
                    'success' => false,
                ];
            }
        } else if ($swapAmount === 'BNB') {
            $userBscAddress = GeneratedBscWallet::wher('user_id', $user_id)->first()->value('address');

            $mainWallets = config('blockchains.main_bsc_addresses');
            $addresses   = [];

            foreach ($mainWallets as $wallet) {
                $addresses[] = [
                    'address' => $wallet['hex'],
                    'balance' => $this->bscApiController->getBalance($wallet['hex']),
                    'pk'      => $wallet['pk'],
                ];
            }

            $addressWithHighestBalanceIdx = array_search(max(array_column($addresses, 'balance')), array_column($addresses, 'balance'));
            $addressWithHighestBalance    = $addresses[$addressWithHighestBalanceIdx]['address'];
            $addressWithHighestBalancePk  = $addresses[$addressWithHighestBalanceIdx]['pk'];

            $broadcastedTransaction = $this->bscApiController->sendFundsRequest($user_id, $swapAmount, $addressWithHighestBalance);

            if ($broadcastedTransaction['success']) {
                $tnx_id = $this->createSwapTransactionForBsc($broadcastedTransaction, $user_id, true);
                return [
                    'success' => true,
                    'tnx_id'  => $tnx_id,
                ];
            } else {
                return [
                    'success' => false,
                ];
            }
        } else {
            return [
                'success' => false,
            ];
        }
    }

    private function createSwapTransactionForTron($transaction, $user_id, $isSwapToAsset) {
        $existingTransaction   = Transaction::where('hash_id', $transaction['txID'])->first();
        $transactionController = new TransactionController;
        $userModel             = new User();
        $userBalances          = new UserBalances;
        $userBalancesService   = new UserBalancesService;

        $amount           = $transaction['raw_data']['contract'][0]['parameter']['value']['amount'] / 1000000;
        $marketDataPrices = View::getShared()['marketDataPrices'];
        $tnx_id           = mt_rand(10000000, 99999999);

        $trxBalance       = $userBalances->where('user_id', $user_id)->where('wallet', 'TRX')->value('balance');
        $trxLockedBalance = $userBalances->where('user_id', $user_id)->where('wallet', 'TRX')->value('locked_balance');

        [$totalBalance, $totalLockedBalance] = $userBalancesService->calculateUserTotalBalance($user_id);

        $refUserId = $userModel->where('id', $user_id)->value('ref_user_id') ?? null;

        if (! isset($existingTransaction)) {
            $transactionController->createTransaction([
                'tnx_id'                     => $tnx_id,
                'user_id'                    => $user_id,
                'ref_user_id'                => $refUserId,
                'type'                       => 'swap',
                'swap_to_asset'              => $isSwapToAsset,
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
                'trade_info'                 => json_encode([])
            ]);

            return $tnx_id;
        } else {
            $existingTx                             = Transaction::where('hash_id', $transaction['txID'])->first();
            $existingTx->type                       = 'swap';
            $existingTx->swap_to_asset              = $isSwapToAsset;
            $existingTx->amount_in_asset            = $amount;
            $existingTx->amount_in_usd              = $amount * $marketDataPrices['TRX'];
            $existingTx->asset_price                = $marketDataPrices['TRX'];
            $existingTx->asset_balance_after        = $trxBalance;
            $existingTx->asset_locked_balance_after = $trxLockedBalance;
            $existingTx->total_balance_after        = $totalBalance;
            $existingTx->total_locked_balance_after = $totalLockedBalance;
            $existingTx->status                     = 'pending';
            $existingTx->save();

            return $existingTx->tnx_id;
        }
    }

    private function createSwapTransactionForBsc($transaction, $user_id, $isSwapToAsset) {
        $tnx_id = mt_rand(10000000, 99999999);
        return $tnx_id;
    }
}
