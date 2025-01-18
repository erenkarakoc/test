<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SimulateGdzPrice extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crypto:simulate-price';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Simulate realistic cryptocurrency price changes';

    /**
     * Base prices, volatility, and control variables for cryptocurrencies.
     *
     * @var array
     */
    protected $cryptos = [
        'BTC' => [
            'price' => 50000,
            'volatility' => 0.02,
            'isGoingUp' => true,
            'targetPrice' => 51000,
        ]
    ];

    /**
     * Execute the console command.
     */
    public function handle()
    {
        foreach ($this->cryptos as $crypto => $data) {
            $currentPrice = $data['price'];
            $volatility = $data['volatility'];
            $isGoingUp = $data['isGoingUp'];
            $targetPrice = $data['targetPrice'];

            // Adjust the price towards the target price
            $adjustment = ($targetPrice - $currentPrice) * 0.1; // Move 10% closer to the target each iteration

            // Add some volatility noise
            $noise = $volatility * $currentPrice * (rand(-50, 50) / 100); // Random noise

            // Apply upward or downward trend based on isGoingUp
            $newPrice = $currentPrice + $adjustment + $noise;

            // Ensure the price moves closer to the target
            if (($isGoingUp && $newPrice > $targetPrice) || (! $isGoingUp && $newPrice < $targetPrice)) {
                $newPrice = $targetPrice; // Cap it at the target price
            }

            // Prevent price from going below a minimum value
            $newPrice = max(0.1, $newPrice);

            // Update the price in the array
            $this->cryptos[$crypto]['price'] = $newPrice;

            // Example: Save to a database
            // Cryptocurrency::updateOrCreate(['name' => $crypto], ['price' => $newPrice]);
        }

        $this->info('Cryptocurrency prices updated with manual control!');
    }
}
