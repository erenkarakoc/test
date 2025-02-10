<?php
namespace App\Console\Commands;

use App\Models\Algorithm;
use Illuminate\Console\Command;

class SeedAlgorithms extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seed:algorithms';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seeds algorithms on initial setup';

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
        if (! Algorithm::where('title', 'MR')->exists()) {
            Algorithm::Create([
                'title'               => 'MR',
                'subtitle'            => 'Mean Reversion',
                'description'         => 'Identifies when an asset\'s price deviates significantly from its historical average, assuming it will revert to the mean over time.',
                'icon'                => '2',
                'profit_contribution' => 0.8,
                'category'            => 'MR',
            ]);
        }
        if (! Algorithm::where('title', 'BB')->exists()) {
            Algorithm::Create([
                'title'               => 'BB',
                'subtitle'            => 'Bollinger Bands',
                'description'         => 'Trades based on price movements relative to Bollinger Bands. Buys when the price touches the lower band and sells when it touches the upper band.',
                'icon'                => '2',
                'profit_contribution' => 0.6,
                'category'            => 'MR',
            ]);
        }
        if (! Algorithm::where('title', 'FR')->exists()) {
            Algorithm::Create([
                'title'               => 'FR',
                'subtitle'            => 'Fibonacci Retracement',
                'description'         => 'Uses Fibonacci retracement levels to identify potential support and resistance levels for buying and selling.',
                'icon'                => '2',
                'profit_contribution' => 0.6,
                'category'            => 'MR',
            ]);
        }
        if (! Algorithm::where('title', 'MM')->exists()) {
            Algorithm::Create([
                'title'               => 'MM',
                'subtitle'            => 'Market Making',
                'description'         => 'Places both buy and sell orders around the current market price to profit from the bid-ask spread.',
                'icon'                => '3',
                'profit_contribution' => 1.4,
                'category'            => 'MSE',
            ]);
        }
        if (! Algorithm::where('title', 'GT')->exists()) {
            Algorithm::Create([
                'title'               => 'GT',
                'subtitle'            => 'Grid Trading',
                'description'         => 'Places buy and sell orders at regular intervals above and below a set price level to profit from market fluctuations within a range.',
                'icon'                => '3',
                'profit_contribution' => 1,
                'category'            => 'MSE',
            ]);
        }
        if (! Algorithm::where('title', 'VWAP')->exists()) {
            Algorithm::Create([
                'title'               => 'VWAP',
                'subtitle'            => 'Volume-Weighted Average Price',
                'description'         => 'Executes trades gradually to ensure the average trade price is close to the VWAP, often used by institutional traders to minimize market impact.',
                'icon'                => '3',
                'profit_contribution' => 1.2,
                'category'            => 'MSE',
            ]);
        }
        if (! Algorithm::where('title', 'TWAP')->exists()) {
            Algorithm::Create([
                'title'               => 'TWAP',
                'subtitle'            => 'Time-Weighted Average Price',
                'description'         => 'Splits orders into smaller portions and executes them over a specific time to minimize market impact.',
                'icon'                => '3',
                'profit_contribution' => 1.1,
                'category'            => 'MSE',
            ]);
        }
        if (! Algorithm::where('title', 'NNP')->exists()) {
            Algorithm::Create([
                'title'               => 'NNP',
                'subtitle'            => 'Neural Network Prediction',
                'description'         => 'Uses our machine learning model using all other algorithms to predict future price movements based on historical data, volume, sentiment, and other factors.',
                'icon'                => '4',
                'profit_contribution' => 2.1,
                'category'            => 'MLP',
            ]);
        }
        if (! Algorithm::where('title', 'MVO')->exists()) {
            Algorithm::Create([
                'title'               => 'MVO',
                'subtitle'            => 'Mean Variance Optimization',
                'description'         => 'Allocates capital to a portfolio of cryptocurrencies by optimizing for maximum returns and minimum risk based on historical data.',
                'icon'                => '4',
                'profit_contribution' => 1.6,
                'category'            => 'MLP',
            ]);
        }
        if (! Algorithm::where('title', 'BT')->exists()) {
            Algorithm::Create([
                'title'               => 'BT',
                'subtitle'            => 'Breakout Trading',
                'description'         => 'Identifies breakout levels based on resistance or support zones and trades in the direction of the breakout.',
                'icon'                => '2',
                'profit_contribution' => 0.9,
                'category'            => 'TF',
            ]);
        }
        if (! Algorithm::where('title', 'MT')->exists()) {
            Algorithm::Create([
                'title'               => 'MT',
                'subtitle'            => 'Momentum Trading',
                'description'         => 'Identifies cryptocurrencies showing strong upward or downward trends and trades in the direction of the momentum.',
                'icon'                => '2',
                'profit_contribution' => 1,
                'category'            => 'TF',
            ]);
        }
        if (! Algorithm::where('title', 'MAC')->exists()) {
            Algorithm::Create([
                'title'               => 'MAC',
                'subtitle'            => 'Moving Average Crossover',
                'description'         => 'Uses short-term and long-term moving averages. A buy signal is generated when the short-term moving average crosses above the long-term moving average, and vice versa for a sell signal.',
                'icon'                => '2',
                'profit_contribution' => 0.7,
                'category'            => 'TF',
            ]);
        }
        if (! Algorithm::where('title', 'MACD')->exists()) {
            Algorithm::Create([
                'title'               => 'MACD',
                'subtitle'            => 'Moving Average Convergence Divergence',
                'description'         => 'Uses short-term and long-term moving averages. A buy signal is generated when the short-term moving average crosses above the long-term moving average, and vice versa for a sell signal.',
                'icon'                => '2',
                'profit_contribution' => 0.8,
                'category'            => 'TF',
            ]);
        }
        if (! Algorithm::where('title', 'NSA')->exists()) {
            Algorithm::Create([
                'title'               => 'NSA',
                'subtitle'            => 'News Sentiment Analysis',
                'description'         => 'Analyzes news articles, social media, and other sources to gauge market sentiment and make trades based on positive or negative trends.',
                'icon'                => '1',
                'profit_contribution' => 0.3,
                'category'            => 'BASIC',
            ]);
        }
        if (! Algorithm::where('title', 'AR')->exists()) {
            Algorithm::Create([
                'title'               => 'AR',
                'subtitle'            => 'Arbitrage',
                'description'         => 'Exploits price differences for the same cryptocurrency across multiple exchanges by buying low on one exchange and selling high on another.',
                'icon'                => '1',
                'profit_contribution' => 0.4,
                'category'            => 'BASIC',
            ]);
        }
        if (! Algorithm::where('title', 'HFT')->exists()) {
            Algorithm::Create([
                'title'               => 'HFT',
                'subtitle'            => 'High-Frequency Trading',
                'description'         => 'Executes trades at extremely high speeds to capitalize on small price discrepancies and liquidity imbalances in milliseconds.',
                'icon'                => '1',
                'profit_contribution' => 0.4,
                'category'            => 'BASIC',
            ]);
        }
        if (! Algorithm::where('title', 'SC')->exists()) {
            Algorithm::Create([
                'title'               => 'SC',
                'subtitle'            => 'Scalping',
                'description'         => 'Executes numerous small trades within short time frames to capitalize on minor price fluctuations.',
                'icon'                => '1',
                'profit_contribution' => 0.4,
                'category'            => 'BASIC',
            ]);
        }
        if (! Algorithm::where('title', 'LM')->exists()) {
            Algorithm::Create([
                'title'               => 'LM',
                'subtitle'            => 'Liquidity Mining',
                'description'         => 'Participates in decentralized finance (DeFi) liquidity pools to earn rewards while dynamically balancing impermanent loss risks.',
                'icon'                => '2',
                'profit_contribution' => 0.8,
                'category'            => 'BASIC',
            ]);
        }
        if (! Algorithm::where('title', 'PT')->exists()) {
            Algorithm::Create([
                'title'               => 'PT',
                'subtitle'            => 'Pair Trading',
                'description'         => 'Trades correlated cryptocurrency pairs. Buys the underperforming asset and sells the outperforming one, assuming they will revert to their historical correlation.',
                'icon'                => '2',
                'profit_contribution' => 0.8,
                'category'            => 'BASIC',
            ]);
        }

        $this->info('Algorithms seeded successfully!');
    }
}
