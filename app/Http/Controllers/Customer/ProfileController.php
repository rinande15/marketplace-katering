<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function edit()
    {
        $merchant = auth()->user()->merchant;

        return view('merchant.profile.edit', compact('merchant'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama_perusahaan' => 'required|string|max:255',
            'alamat' => 'required|string',
            'kontak' => 'required|string|max:20',
            'deskripsi' => 'nullable|string',
        ]);

        $merchant = auth()->user()->merchant;

        if (!$merchant) {
            return redirect()->route('merchant.profile.edit')
                ->with('error', 'Merchant tidak ditemukan.');
        }

        $merchant->update([
            'company_name' => $request->nama_perusahaan,
            'address' => $request->alamat,
            'phone' => $request->kontak,
            'description' => $request->deskripsi,
        ]);

        return redirect()->route('merchant.dashboard')
            ->with('success', 'Profile berhasil diupdate.');
    }

    public function show()
    {
        $merchant = auth()->user()->merchant;

        if (!$merchant) {
            return redirect()->route('merchant.profile.edit')
                ->with('error', 'Lengkapi profil merchant terlebih dahulu.');
        }

        return view('merchant.profile.show', compact('merchant'));
    }
}
