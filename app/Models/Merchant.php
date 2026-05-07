<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Merchant extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'store_name',
        'city',
        'whatsapp_number',
        'description',
        'is_verified',
        'logo'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->hasMany(\App\Models\Product::class);
    }

    // 🔥 helper biar gampang dipakai di blade
    public function getLogoUrlAttribute()
    {
        return $this->logo
            ? asset('storage/'.$this->logo)
            : asset('default-store.png');
    }
}