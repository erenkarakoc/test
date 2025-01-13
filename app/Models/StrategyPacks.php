<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StrategyPacks extends Model
{
    protected $fillable = [
        'title',
        'description',
        'algorithms',
        'total_contribution_rate',
        'daily_income_rate',
    ];
}
