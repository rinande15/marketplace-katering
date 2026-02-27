<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Merchant extends Model
{
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function menus()
    {
        return $this->hasMany(\App\Models\Menu::class);
    }

    public function orders()
    {
        return $this->hasMany(\App\Models\Order::class);
    }

    protected $fillable = [
        'user_id',
        'company_name',
        'address',
        'phone',
        'description',
    ];
}
