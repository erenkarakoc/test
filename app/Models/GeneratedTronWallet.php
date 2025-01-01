<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneratedTronWallet extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tnx_id',
        'trx_balance',
        'usdt_balance',
        'amount_in_usd',
        'asset_price',
        'private_key',
        'public_key',
        'address_hex',
        'address_base58',
        'status',
        'hash_id',
    ];
}
