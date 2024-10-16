<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class KasirKontroller extends Controller
{
    public function __construct()
    {
        $this->middleware('role:1'); // Middleware hanya untuk admin
    }

    public function index()
    {
        $kasir = User::all();
        return view('admin.casir.index', compact('kasir'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 2,
        ]);

        return redirect()->route('casir.index')->with('success', 'Kasir berhasil ditambahkan.');
    }
}
