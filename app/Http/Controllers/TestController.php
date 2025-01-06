<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;

class TestController extends Controller
{
    protected $client;

    protected $apiUrl = 'https://api.blockchain.com/v3/exchange';

    public function __construct()
    {
        $this->client = new Client;
    }

    public function test()
    {
        $response = $this->client->post("{$this->apiUrl}/exchange/accounts", [
            'headers' => [
                'X-API-Token' => 'Bearer '.env('BLOCKCHAIN_API_KEY'),
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'password' => 'e3A6pzaW07O0qBl7GJ',
                'label' => 'MyWallet',
            ],
        ]);

        $data = json_decode($response->getBody()->getContents(), true);

        dd($data);

        return $data;
    }
}
