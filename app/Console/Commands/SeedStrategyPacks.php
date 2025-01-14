<?php

namespace App\Console\Commands;

use App\Models\StrategyPacks;
use Illuminate\Console\Command;

class SeedStrategyPacks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seed:strategy-packs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seeds Strategy Packs on initial setup';

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
        StrategyPacks::Create([
            'title' => 'Momentum',
            'description' => 'Focuses on momentum and reversal strategies. Includes algorithms for identifying mean reversion opportunities and trading within trends and short-term momentum for consistent but low-risk returns.',
            'algorithms' => json_encode(['MT', 'MAC', 'MACD']),
            'total_contribution_rate' => 6.7,
            'daily_income_rate' => 0.199285714,

        ]);
        StrategyPacks::Create([
            'title' => 'Scalper',
            'description' => 'Combines breakout and scalping strategies with a focus on market fluctuations. Includes tools for breakout trading, grid trading, and volume-weighted price execution while capturing price momentum.',
            'algorithms' => json_encode(['BT', 'MR', 'BB', 'FR', 'MM', 'GT', 'VWAP', 'TWAP']),
            'total_contribution_rate' => 10.7,
            'daily_income_rate' => 0.220714286,
        ]);
        StrategyPacks::Create([
            'title' => 'Swift',
            'description' => 'Integrates AI-driven predictions and advanced optimization strategies. Employs neural networks for predictive analytics, mean-variance optimization and market-making for high-frequency opportunities.',
            'algorithms' => json_encode(['MM', 'VWAP', 'TWAP', 'NNP', 'MVO']),
            'total_contribution_rate' => 11.6,
            'daily_income_rate' => 0.322857143,
        ]);

        $this->info('Strategy Packs seeded successfully!');
    }
}
