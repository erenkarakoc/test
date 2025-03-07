<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model {
    protected $fillable = [
        'user_id',
        'type',
        'icon',
        'title',
        'html_content',
        'text_content',
        'read',
        'link',
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getNotifications($user_id) {
        return $this->where('user_id', $user_id)->orderBy('created_at', 'desc')->get();
    }
}
