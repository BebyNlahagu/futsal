<?php

namespace App\Http\Controllers;

use App\Models\Bayar;
use App\Models\Jadwal;
use App\Models\Rating;
use App\Models\User;
use Illuminate\Http\Request;

class UserLoginController extends Controller
{
    public function index()
    {
        $rating = Rating::all();
        $users = User::where('role', 0)->get();
        return view('user.index',compact('rating','users'));
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
