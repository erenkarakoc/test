<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $casts = [
        'amount_in_asset' => 'float',
        'amount_in_usd' => 'float',
        'asset_balance_after' => 'float',
        'asset_locked_balance_after' => 'float',
        'total_balance_after' => 'float',
        'total_locked_balance_after' => 'float',
    ];

    protected $fillable = [
        'tnx_id',
        'user_id',
        'ref_user_id',
        'type',
        'amount_in_asset',
        'amount_in_usd',
        'asset',
        'asset_balance_after',
        'asset_locked_balance_after',
        'total_balance_after',
        'total_locked_balance_after',
        'strategy_id',
        'status',
        'hash_id',
    ];

    /**
     * Get the user associated with the transaction.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the referrer user associated with the transaction (if any).
     */
    public function refUser()
    {
        return $this->belongsTo(User::class, 'ref_user_id');
    }

    /**
     * Scope a query to only include completed transactions.
     */
    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    /**
     * Scope a query to only include pending transactions.
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }
}
