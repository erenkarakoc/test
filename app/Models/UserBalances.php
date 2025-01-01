<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// UserBalances model
class UserBalances extends Model
{
    protected $fillable = ['user_id', 'title', 'wallet', 'balance', 'locked_balance'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
