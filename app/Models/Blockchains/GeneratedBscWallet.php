<?php

namespace App\Models\Blockchains;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneratedBscWallet extends Model
{
  use HasFactory;

  protected $fillable = [
    'user_id',
    'balance',
    'address',
    'private_key',
    'qr_code',
  ];
}
