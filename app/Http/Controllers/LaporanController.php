<?php

namespace App\Http\Controllers;

use App\Models\Bayar;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{

    public function index(Request $request)
    {
        $query = Bayar::query();

        if ($request->filled('bulan')) {
            $query->whereMonth('tanggal_main', $request->bulan);
        }
        if ($request->filled('tahun')) {
            $query->whereYear('tanggal_main', $request->tahun);
        }
        if ($request->filled('hari')) {
            $query->whereDate('tanggal_main', $request->hari);
        }

        $query->where('status', 'lunas');

        $bayar = $query->get();

        return view('admin.laporan', compact('bayar'));
    }

    public function pdf(Request $request)
    {
        $user = User::where('role', 1)->first();

        $query = Bayar::query();

        if ($request->filled('bulan')) {
            $query->whereMonth('tanggal_main', $request->bulan);
        }
        if ($request->filled('tahun')) {
            $query->whereYear('tanggal_main', $request->tahun);
        }
        if ($request->filled('hari')) {
            $query->whereDate('tanggal_main', $request->hari);
        }

        $query->where('status', 'lunas');
        $bayar = $query->get();

        $pdf = PDF::loadView('admin.laporan-pdf', compact('bayar','user'));
        return $pdf->download('laporan_transaksi.pdf');
    }
}
