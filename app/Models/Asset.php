<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    protected $fillable = [
        'title',
        'symbol',
        'min_deposit',
        'max-deposit',
        'min_withdraw',
        'max-withdraw',
    ];
}
