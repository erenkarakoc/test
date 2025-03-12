<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LockedPack extends Model {
    protected $fillable = ['user_id', 'strategy_pack_id', 'chosen_algorithms', 'amount', 'period', 'algorithms_cost', 'estimated_profit_rate', 'status', 'trade_info'];

    protected $casts = [
        'chosen_algorithms' => 'array',
        'trade_info'        => 'array',
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
