<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class DashboardController extends Controller
{
    public function index()
    {
        $orders = Order::where('customer_id', auth()->id())
            ->latest()
            ->take(5)
            ->get();

        return view('customer.dashboard', compact('orders'));
    }
}
