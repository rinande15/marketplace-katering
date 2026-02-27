<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    public function merchant()
    {
        return $this->belongsTo(Merchant::class);
    }

    protected $fillable = [
        'merchant_id',
        'name',
        'description',
        'price',
        'photo',
    ];

    public function orders()
    {
        return $this->hasMany(\App\Models\Order::class);
    }
}
