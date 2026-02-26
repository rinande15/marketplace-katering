<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('merchant.profile.edit');
    }

    public function update(Request $request)
    {
        return back()->with('success', 'Profile updated');
    }
}
