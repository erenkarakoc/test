<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    // The table associated with the model
    protected $table = 'countries';

    protected $fillable = [
        'name',
    ];

    public function getNameAttribute($value)
    {
        return ucfirst($value);
    }

    protected $casts = [
        'translations' => 'array',
    ];

    public function getTranslation($language)
    {
        return $this->translations[$language] ?? $this->name;
    }
}
