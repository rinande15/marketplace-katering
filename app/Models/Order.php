<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function merchant()
    {
        return $this->belongsTo(Merchant::class);
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function customer()
    {
        return $this->belongsTo(\App\Models\User::class, 'customer_id');
    }

    protected $fillable = [
        'menu_id',
        'merchant_id',
        'customer_id',
        'quantity',
        'delivery_date',
        'total_price',
        'invoice_number',
        'status'
    ];
}
