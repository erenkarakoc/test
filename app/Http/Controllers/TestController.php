<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class TestController extends Controller
{
    protected $client;
    protected $apiKey;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function test()
    {
      $response = Http::withHeaders([
        'x-api-key' => 't-6797a4fd758217afa9cf4c55-4d684a2c1de042ac9a6d0c46',
        'content-type' => 'application/json',
        'accept' => 'application/json'
      ])->get('https://api.tatum.io/v3/tron/wallet');

      $walletData = $response->json();

      dd($walletData);
    }
}
