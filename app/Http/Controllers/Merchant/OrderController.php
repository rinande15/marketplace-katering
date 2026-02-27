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
        $merchant = auth()->user()->merchant;

        $order = Order::where('merchant_id', $merchant->id)
            ->with(['customer', 'menu'])
            ->findOrFail($id);

        return view('merchant.orders.show', compact('order'));
    }
}
