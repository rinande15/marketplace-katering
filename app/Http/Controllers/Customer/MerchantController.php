<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Merchant;

class MerchantController extends Controller
{
    public function index(Request $request)
    {
        $query = Merchant::query();

        // Filter lokasi
        if ($request->filled('location')) {
            $query->where('address', 'like', '%' . $request->location . '%');
        }

        // Filter kategori
        // Filter berdasarkan nama menu
        if ($request->menu) {
            $query->whereHas('menus', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->menu . '%');
            });
        }

        $merchants = $query->latest()->paginate(6)->withQueryString();

        return view('customer.merchants.index', compact('merchants'));
    }

    public function show(Merchant $merchant)
    {
        return view('customer.merchants.show', compact('merchant'));
    }
}
