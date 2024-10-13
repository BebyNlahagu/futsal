<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LapanganController extends Controller
{
    public function index()
    {
        return view('admin.lapangan.index');
    }
}
