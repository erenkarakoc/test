<?php

namespace App\Models\Blockchains;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneratedTronWallet extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'trx_balance',
        'usdt_balance',
        'private_key',
        'public_key',
        'address_hex',
        'address_base58',
        'qr_code',
    ];
}
