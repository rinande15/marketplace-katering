<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    public function index()
    {
        $merchant = auth()->user()->merchant;
        $menus = $merchant->menus()->latest()->paginate(10);

        return view('merchant.menus.index', compact('menus'));
    }

    public function create()
    {
        return view('merchant.menus.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|numeric|min:0',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $merchant = auth()->user()->merchant;

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('menus', 'public');
        }

        $merchant->menus()->create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'photo' => $photoPath
        ]);

        return redirect()->route('merchant.menus.index')
            ->with('success', 'Menu berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $menu = Menu::where('merchant_id', auth()->user()->merchant->id)
            ->findOrFail($id);

        return view('merchant.menus.edit', compact('menu'));
    }

    public function update(Request $request, $id)
    {
        $menu = Menu::where('merchant_id', auth()->user()->merchant->id)
            ->findOrFail($id);

        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|numeric|min:0',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        if ($request->hasFile('photo')) {

            // delete foto lama
            if ($menu->photo) {
                Storage::disk('public')->delete($menu->photo);
            }

            $menu->photo = $request->file('photo')->store('menus', 'public');
        }

        $menu->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'photo' => $menu->photo
        ]);

        return redirect()->route('merchant.menus.index')
            ->with('success', 'Menu berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $menu = Menu::where('merchant_id', auth()->user()->merchant->id)
            ->findOrFail($id);

        if ($menu->photo) {
            Storage::disk('public')->delete($menu->photo);
        }

        $menu->delete();

        return redirect()->route('merchant.menus.index')
            ->with('success', 'Menu berhasil dihapus.');
    }
}
