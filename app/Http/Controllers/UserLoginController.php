<?php

namespace App\Http\Controllers;

use App\Models\Bayar;
use App\Models\Jadwal;
use App\Models\User;
use Illuminate\Http\Request;

class UserLoginController extends Controller
{
    public function index()
    {
        return view('user.index');
    }

    public function about()
    {
        return view('user.about');
    }

    public function paket()
    {
        $jadwal = Jadwal::all();
        return view('user.paket',compact('jadwal'));
    }

    public function transaksi()
    {
        $jadwals = Jadwal::all();
        $users = User::where('role', 0)->get();
        $bayars = Bayar::with(['jadwal', 'user'])->get();
        return view('user.trasaksi',compact('bayars','jadwals','users'));
    }
}
