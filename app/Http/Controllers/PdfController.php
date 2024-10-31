<?php

namespace App\Http\Controllers;

use App\Models\Bayar;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    public function pdf()
    {
        $transaksi = Bayar::all();

        $pdf = Pdf::loadView('admin.PDF',['bayar' => $transaksi]);
        return $pdf->download('laporan-transaksi.pdf');
    }
}
