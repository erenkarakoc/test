<?php
namespace App\Console\Commands;

use App\Models\Asset;
use Illuminate\Console\Command;

class SeedAssets extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seed:assets';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seeds assets on initial setup';

    /**
     * Constructor.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle() {
        $assets           = Asset::all();
        $assetsToGenerate = [
            ['title' => 'Tether', 'symbol' => 'USDT', 'network' => 'TRC-20'],
            ['title' => 'Tron', 'symbol' => 'TRX', 'network' => 'TRC-20'],
            ['title' => 'Bitcoin', 'symbol' => 'BTC', 'network' => 'Bitcoin'],
            ['title' => 'Ethereum', 'symbol' => 'ETH', 'network' => 'ERC-20'],
            ['title' => 'Ethereum Classic', 'symbol' => 'ETC', 'network' => 'ERC-20'],
            ['title' => 'Binance Coin', 'symbol' => 'BNB', 'network' => 'BEP-20'],
            ['title' => 'Litecoin', 'symbol' => 'LTC', 'network' => 'Litecoin'],
        ];

        foreach ($assetsToGenerate as $newAsset) {
            if (! $assets->where('symbol', $newAsset['symbol'])->first()) {
                Asset::create([
                    'title'   => $newAsset['title'],
                    'symbol'  => $newAsset['symbol'],
                    'network' => $newAsset['network'],
                ]);
            }

        }

        $this->info('Assets seeded successfully!');
    }
}
