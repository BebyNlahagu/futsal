<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Cek apakah pengguna terautentikasi
        if (auth()->check()) {
            // Dapatkan role pengguna
            $role = Auth::user()->role;

            // Tampilkan view berdasarkan role
            switch ($role) {
                case 1:
                    return view('admin.index');
                case 2:
                    return view('kasir.index');
                default:
                    return view('user.index');
            }
        }

        // Jika pengguna tidak terautentikasi, bisa redirect ke halaman login atau lainnya
        return redirect()->route('login'); // atau halaman lainnya
    }
}
