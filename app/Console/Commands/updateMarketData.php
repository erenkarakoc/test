<?php

namespace App\Console\Commands;

use App\Models\Asset;
use App\Models\MarketData;
use Illuminate\Console\Command;

class updateMarketData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:market-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updates market data periodically using Rest API';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $assets = Asset::all();

        foreach ($assets as $asset) {
            $price = convertAssetToUsd(1, $asset->symbol);
            if (is_numeric($price) && $price > 0) {
                MarketData::updateOrCreate(
                    ['asset' => $asset->symbol],
                    ['price' => $price]
                );
            }
        }

        MarketData::updateOrCreate(
            ['asset' => 'GDZ'],
            ['price' => 24.23]
        );
        MarketData::updateOrCreate(
            ['asset' => 'USD'],
            ['price' => 1]
        );
    }
}
