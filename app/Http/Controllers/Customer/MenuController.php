<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $menus = \App\Models\Menu::with('merchant')->latest()->get();

        return view('customer.menus.index', compact('menus'));
    }
}
