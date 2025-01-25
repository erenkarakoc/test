<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;

class TestController extends Controller
{
    protected $client;
    protected $apiKey;

    public function __construct()
    {
        $this->client = new Client();
        $this->apiKey = "0de0611b106ffc86621ea94688fc8f8dff84ba7f";
    }

    public function test()
    {
      $response = $this->client->get('https://rest.cryptoapis.io/wallet-as-a-service/wallets/60c9d9921c38030006675ff6/ethereum/sepolia/addresses?context=yourExampleString&limit=50&offset=0', [
          'headers' => [
              'Content-Type' => 'application/json',
              'X-API-Key' => $this->apiKey,
          ],
          'json' => [],
      ]);

      dd($response);
    }
}
