<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index()
    {
        return view('halaman.index');
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
