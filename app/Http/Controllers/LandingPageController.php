<?php

namespace App\Http\Controllers;

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
        return view('halaman.paket');
    }
}
