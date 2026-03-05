<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Merchant;
use App\Models\Customer;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:merchant,customer'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        // 🔥 kalau merchant, auto bikin record merchant
        if ($request->role === 'merchant') {
            Merchant::create([
                'user_id' => $user->id,
                'company_name' => 'Isi Nama Perusahaan',
                'address' => '-',
                'phone' => '-',
                'description' => null,
            ]);
        } elseif ($request->role === 'customer') {
            // 🔥 kalau customer, auto bikin record customer
            Customer::create([
                'user_id' => $user->id,
                'name' => $request->name,
                'address' => '-',
                'phone' => '-',
                'description' => null,
            ]);
        }

        event(new Registered($user));

        Auth::login($user);

        // 🔥 redirect sesuai role
        if ($user->role === 'merchant') {
            return redirect()->route('merchant.dashboard');
        }

        if ($user->role === 'customer') {
            return redirect()->route('customer.dashboard');
        }

        return redirect('/');
    }
}
