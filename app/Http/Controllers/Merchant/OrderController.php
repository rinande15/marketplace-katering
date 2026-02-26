<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $merchant = auth()->user()->merchant;

        $orders = Order::with('menu', 'merchant', 'customer')
            ->where('merchant_id', $merchant->id)
            ->latest()
            ->paginate(10);

        return view('merchant.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with('menu', 'merchant', 'customer')
            ->where('merchant_id', auth()->user()->merchant->id)
            ->findOrFail($id);

        return view('merchant.orders.show', compact('order'));

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
    }
}
