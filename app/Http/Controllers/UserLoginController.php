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


        return view('user.index', compact('rating', 'users'));
    }

    public function about()
    {
        return view('user.about');
    }

    public function paket(Request $request)
    {
        // Dapatkan tanggal dari input user atau gunakan tanggal hari ini sebagai default
        $tanggal_main = $request->input('tanggal_main', now()->toDateString());

        // Ambil jadwal dan cek pemesanan di tanggal yang dipilih dengan status 'Lunas'
        $jadwal = Jadwal::with(['bayar' => function ($query) use ($tanggal_main) {
            $query->where('status', 'Lunas')
                ->whereDate('tanggal_main', $tanggal_main);
        }])->get();

        return view('user.paket', compact('jadwal', 'tanggal_main'));
    }

    public function transaksi()
    {
        $jadwals = Jadwal::all();
        $users = User::where('role', 0)->get();
        $bayars = Bayar::with(['jadwal', 'user'])->get();

        $tanggalMain = request('tanggal_main');
        $durasi = request('durasi', 1); // Default durasi 1 jika tidak ada input
        $jadwalTerpesan = [];

        if ($tanggalMain) {
            // Ambil semua jadwal yang sudah dipesan untuk tanggal tertentu
            $bookedSlots = Bayar::whereDate('tanggal_main', $tanggalMain)
                ->pluck('jadwal_id')
                ->toArray();

            foreach ($bookedSlots as $jadwalId) {
                // Cari jam dari jadwal yang sudah dipesan
                $jadwal = Jadwal::find($jadwalId);
                if ($jadwal) {
                    $startHour = new \DateTime($jadwal->jam);

                    // Tambahkan semua jam dalam durasi ke array jadwal terpesan
                    for ($i = 0; $i < $durasi; $i++) {
                        $newHour = clone $startHour;
                        $newHour->modify("+{$i} hour");

                        // Cari jadwal berdasarkan jam baru dan masukkan ID ke jadwalTerpesan jika belum ada
                        $conflictJadwal = Jadwal::where('jam', $newHour->format('H:i'))->first();
                        if ($conflictJadwal && !in_array($conflictJadwal->id, $jadwalTerpesan)) {
                            $jadwalTerpesan[] = $conflictJadwal->id;
                        }
                    }
                }
            }
        }
        return view('user.trasaksi', compact('bayars', 'jadwals', 'users', 'jadwalTerpesan'));
    }
}
