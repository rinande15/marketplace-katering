<?php

namespace App\Http\Controllers\Merchant;

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Order;

class DashboardController extends Controller
{
    public function index()
    {
        $merchant = auth()->user()->merchant;

        if (!$merchant) {
            return redirect()->route('merchant.profile.edit')
                ->with('error', 'Lengkapi profil merchant terlebih dahulu.');
        }

        $totalMenu = $merchant->menus()->count();

        // Ambil 5 menu dengan penjualan terbanyak
        $topMenus = $merchant->menus()
            ->withCount('orders')
            ->orderByDesc('orders_count')
            ->take(5)
            ->get();

        // Total Order
        $totalOrder = Order::where('merchant_id', $merchant->id)->count();

        // Total Revenue
        $totalRevenue = Order::where('merchant_id', $merchant->id)
            ->sum('total_price');

        // Pending Count
        $pendingCount = Order::where('merchant_id', $merchant->id)
            ->where('status', 'pending')
            ->count();

        // 5 Order Terbaru
        $latestOrders = Order::with('customer')
            ->where('merchant_id', $merchant->id)
            ->latest()
            ->take(5)
            ->get();

        return view('merchant.dashboard', compact(
            'merchant',
            'totalMenu',
            'topMenus',
            'totalOrder',
            'totalRevenue',
            'pendingCount',
            'latestOrders'
        ));
    }
}
