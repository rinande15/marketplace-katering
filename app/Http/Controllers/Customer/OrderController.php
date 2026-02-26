<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Menu;

class OrderController extends Controller
{
    public function store(Request $request, $menuId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
            'delivery_date' => 'required|date|after_or_equal:today'
        ]);

        $menu = Menu::findOrFail($menuId);

        $total = $menu->price * $request->quantity;

        Order::create([
            'menu_id' => $menu->id,
            'merchant_id' => $menu->merchant_id,
            'customer_id' => auth()->id(),
            'quantity' => $request->quantity,
            'delivery_date' => $request->delivery_date,
            'total_price' => $total,
            'invoice_number' => 'INV-' . date('Ymd') . '-' . rand(1000, 9999),
        ]);

        return redirect()->back()->with('success', 'Pesanan berhasil dibuat.');
    }
}
