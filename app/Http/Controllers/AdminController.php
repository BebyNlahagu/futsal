<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function kasir(Request $request)
    {
        if(auth()->user()->role == 1)
        {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:8|confirmed',
            ]);

            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role' => User::KASIR,
            ]);

            return redirect()->back()->with('success', 'Kasir berhasil ditambahkan.');
        }

        return redirect()->back()->with('error', 'gagal.');
    }
}
