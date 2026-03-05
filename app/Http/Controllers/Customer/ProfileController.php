<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function edit()
    {
        $customer = auth()->user()->customer;

        return view('customer.profile.edit', compact('customer'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'kontak' => 'required|string|max:20',
            'deskripsi' => 'nullable|string',
        ]);

        $customer = auth()->user()->customer;

        if (!$customer) {
            return redirect()->route('customer.profile.edit')
                ->with('error', 'Customer tidak ditemukan.');
        }

        $customer->update([
            'name' => $request->nama,
            'address' => $request->alamat,
            'phone' => $request->kontak,
            'description' => $request->deskripsi,
        ]);

        return redirect()->route('customer.dashboard')
            ->with('success', 'Profile berhasil diupdate.');
    }

    public function show()
    {
        $merchant = auth()->user()->merchant;

        if (!$merchant) {
            return redirect()->route('customer.profile.edit')
                ->with('error', 'Lengkapi profil customer terlebih dahulu.');
        }

        return view('customer.profile.show', compact('customer'));
    }
}
