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
        $tanggal_main = $request->input('tanggal_main', now()->toDateString());

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
                $jadwal = Jadwal::find($jadwalId);
                if ($jadwal) {
                    $startHour = new \DateTime($jadwal->jam);

                    for ($i = 0; $i < $durasi; $i++) {
                        $newHour = clone $startHour;
                        $newHour->modify("+{$i} hour");

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
