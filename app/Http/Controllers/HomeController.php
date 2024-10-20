<?php

namespace App\Http\Controllers;

use App\Models\Bayar;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (auth()->check()) {
            $role = Auth::user()->role;

            switch ($role) {
                case 1:
                    $jumlahuser = User::where('role', 0)->count();
                    $transaksi = Bayar::count();
                    $total = Bayar::sum('total');

                    // Data transaksi bulanan
                    $transaksi_per_bulan = Bayar::selectRaw('MONTH(created_at) as bulan, SUM(total) as total')
                        ->groupBy('bulan')
                        ->pluck('total', 'bulan')->toArray();

                    $transaksi_bulanan = [];
                    for ($i = 1; $i <= 12; $i++) {
                        $transaksi_bulanan[] = $transaksi_per_bulan[$i] ?? 0;
                    }

                    // Data transaksi harian (misalnya untuk bulan ini)
                    $transaksi_per_hari = Bayar::selectRaw('DAY(created_at) as hari, SUM(total) as total')
                        ->whereMonth('created_at', date('m'))
                        ->groupBy('hari')
                        ->pluck('total', 'hari')->toArray();

                    $transaksi_harian = [];
                    for ($i = 1; $i <= 31; $i++) {
                        $transaksi_harian[] = $transaksi_per_hari[$i] ?? 0;
                    }

                    // Data transaksi tahunan
                    $transaksi_per_tahun = Bayar::selectRaw('YEAR(created_at) as tahun, SUM(total) as total')
                        ->groupBy('tahun')
                        ->pluck('total', 'tahun')->toArray();

                    $transaksi_tahunan = [];
                    for ($i = date('Y') - 5; $i <= date('Y'); $i++) {
                        $transaksi_tahunan[] = $transaksi_per_tahun[$i] ?? 0;
                    }

                    return view('admin.index', compact('jumlahuser', 'transaksi', 'total', 'transaksi_bulanan', 'transaksi_harian', 'transaksi_tahunan'));

                case 2:
                    $jumlahuser = User::where('role', 0)->count();
                    $jumlah = Bayar::count();
                    $total = Bayar::sum('total');

                    $transaksi_per_bulan = Bayar::selectRaw('MONTH(created_at) as bulan, SUM(total) as total')->groupBy('bulan')->pluck('total', 'bulan')->toArray();

                    $transaksi_bulanan = [];
                    for ($i = 1; $i <= 12; $i++) {
                        $transaksi_bulanan[] = $transaksi_per_bulan[$i] ?? 0;
                    }

                    $transaksi_per_hari = Bayar::selectRaw('DAY(created_at) as hari, SUM(total) as total')->whereMonth('created_at', date('m'))->groupBy('hari')->pluck('total', 'hari')->toArray();

                    $transaksi_harian = [];
                    for ($i = 1; $i <= 31; $i++) {
                        $transaksi_harian[] = $transaksi_per_hari[$i] ?? 0;
                    }

                    $transaksi_per_tahun = Bayar::selectRaw('YEAR(created_at) as tahun, SUM(total) as total')->groupBy('tahun')->pluck('total', 'tahun')->toArray();

                    $transaksi_tahunan = [];
                    for ($i = date('Y') - 5; $i <= date('Y'); $i++) {
                        $transaksi_tahunan[] = $transaksi_per_tahun[$i] ?? 0;
                    }

                    return view('kasir.index', compact('jumlahuser', 'jumlah', 'total', 'transaksi_bulanan', 'transaksi_harian', 'transaksi_tahunan'));
                default:
                    return view('user.index');
            }
        }

        return redirect()->route('halaman.index'); // atau halaman lainnya
    }
}
