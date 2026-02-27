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
                ->with('error', 'Lengkapi profil merchant dulu.');
        }

        $menus = $merchant->menus()->latest()->get();
        $orders = $merchant->orders()->latest()->get();

        return view('merchant.dashboard', compact('merchant', 'menus', 'orders'));
    }
}
