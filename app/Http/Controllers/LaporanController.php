<?php

namespace App\Http\Controllers;

use App\Models\Bayar;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        $bayar = Bayar::where('status', 'lunas')->get();

        return view('admin.laporan',compact('bayar'));
    }

    public function filter(Request $request)
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

        $bayar = $query->get();

        return view('admin.laporan', compact('bayar'));
    }

    public function pdf(Request $request)
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

        $bayar = $query->get();

        $pdf = PDF::loadView('admin.laporan-pdf', compact('bayar'));
        return $pdf->download('laporan_transaksi.pdf');
    }
}
