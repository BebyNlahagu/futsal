<?php

namespace App\Http\Controllers;

use App\Models\Bayar;
use App\Models\User;
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
        if (auth()->check()) {
            $role = Auth::user()->role;

            switch ($role) {
                case 1:
                    $jumlahuser = User::where('role',0)->count();
                    $transaksi = Bayar::count();
                    return view('admin.index',compact('jumlahuser','transaksi'));
                case 2:
                    $jumlahuser = User::where('role',0)->count();
                    $jumlah = Bayar::count();
                    return view('kasir.index',compact('jumlah','jumlahuser'));
                default:
                    return view('user.index');
            }
        }

        return redirect()->route('halaman.index'); // atau halaman lainnya
    }
}
