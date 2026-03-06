<?php

namespace App\Http\Controllers\Merchant;


use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Order;
use App\Models\Review;

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

        $weeklyRevenue = Order::where('merchant_id', auth()->user()->merchant->id)
            ->selectRaw('DATE(created_at) as date, SUM(total_price) as total')
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->take(7)
            ->get();

        $rating = Review::avg('rating');

        $orderStats = [
            'pending' => Order::where('status', 'pending')->count(),
            'diproses' => Order::where('status', 'diproses')->count(),
            'selesai' => Order::where('status', 'selesai')->count(),
        ];

        return view('merchant.dashboard', compact(
            'merchant',
            'totalMenu',
            'topMenus',
            'totalOrder',
            'totalRevenue',
            'pendingCount',
            'rating',
            'weeklyRevenue',
            'latestOrders',
            'orderStats'
        ));
    }
}
