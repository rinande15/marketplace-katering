<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Menu;

class OrderController extends Controller
{
    public function store(Request $request, Menu $menu)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
            'delivery_date' => 'required|date'
        ]);

        $total = $menu->price * $request->quantity;

        $order = Order::create([
            'customer_id' => auth()->id(),
            'merchant_id' => $menu->merchant_id,
            'menu_id' => $menu->id,
            'quantity' => $request->quantity,
            'delivery_date' => $request->delivery_date,
            'total_price' => $total,
            'invoice_number' => 'INV-' . strtoupper(uniqid()),
            'status' => 'pending'
        ]);

        return redirect()->route('customer.orders.show', $order->id);
    }

    public function index()
    {
        $orders = Order::with('menu', 'merchant')
            ->where('customer_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('customer.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with('menu', 'merchant')
            ->where('customer_id', auth()->id())
            ->findOrFail($id);

        return view('customer.orders.show', compact('order'));
    }
}
