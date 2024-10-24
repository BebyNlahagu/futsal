<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Rating;
use App\Models\User;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index()
    {
        $nilai = Rating::with('user')->get();
        $users = User::where('role', 0)->get();
        $averageRating = $nilai->avg('rating');

        return view('halaman.index', compact('nilai', 'users'));
    }


    public function about()
    {
        return view('halaman.about');
    }

    public function paket()
    {
        $jadwal = Jadwal::all();
        return view('halaman.paket',compact('jadwal'));
    }
}
