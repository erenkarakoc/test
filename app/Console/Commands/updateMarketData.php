<?php

namespace App\Console\Commands;

use App\Models\Asset;
use App\Models\MarketData;
use Illuminate\Console\Command;

class UpdateMarketData extends Command
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
     * Constructor.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $assets = Asset::all();

        foreach ($assets as $asset) {
            try {
              $price = convertAssetToUsd(1, $asset->symbol);
              if (is_numeric($price) && $price > 0) {
                  MarketData::updateOrCreate(
                      ['asset' => $asset->symbol],
                      ['price' => $price]
                  );
              }
            } catch(\Exception $e) {
              MarketData::updateOrCreate(
                  ['asset' => $asset->symbol],
                  ['price' => 1.00]
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
        try {
          MarketData::updateOrCreate(
            ['asset' => 'EUR'],
            ['price' => convertUsdToEur(1)]
          );
        } catch(\Exception $e) {
          MarketData::updateOrCreate(
            ['asset' => 'EUR'],
            ['price' => 1.00]
        );
        }
    }
}
