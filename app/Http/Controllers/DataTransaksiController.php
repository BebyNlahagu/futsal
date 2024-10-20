<?php

namespace App\Http\Controllers;

use App\Models\Bayar;
use Illuminate\Http\Request;

class DataTransaksiController extends Controller
{
    public function index()
    {
        $bayars = Bayar::with(['jadwal', 'user'])->get();
        return view('admin.transaksi',compact('bayars'));
    }
}
