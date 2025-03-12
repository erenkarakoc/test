<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Algorithm extends Model
{
    protected $fillable = [
        'title',
        'subtitle',
        'description',
        'icon',
        'profit_contribution',
        'category',
    ];
}
