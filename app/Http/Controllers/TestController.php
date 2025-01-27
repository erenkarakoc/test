<?php

namespace App\Http\Controllers;

use App\Services\BitcoinRPC;
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
        $bitcoin = new BitcoinRPC();
        $response = $bitcoin->call('getnewaddress');
        dd($response);
    }
}
