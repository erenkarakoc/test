<?php
namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class BitcoinRPC {
    protected $client;
    protected $rpcUser;
    protected $rpcPassword;

    public function __construct() {
        $this->client = new Client(['base_uri' => 'http://127.0.0.1:18332/']);
        $this->rpcUser = config('bitcoin.rpc_user');
        $this->rpcPassword = config('bitcoin.rpc_password');
    }

    public function call($method, $params = []) {
        try {
            $response = $this->client->post('', [
                'auth' => [$this->rpcUser, $this->rpcPassword],
                'json' => [
                    'jsonrpc' => '2.0',
                    'method' => $method,
                    'params' => $params,
                    'id' => 1
                ]
            ]);
            return json_decode($response->getBody(), true);
        } catch (GuzzleException $e) {
            return ['error' => $e->getMessage()];
        }
    }
}
