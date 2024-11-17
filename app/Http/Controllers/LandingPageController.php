<?php

namespace App\Http\Controllers;

use App\Models\Bayar;
use App\Models\Jadwal;
use App\Models\Rating;
use App\Models\User;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index()
    {
        $nilai = Rating::with('user')->get();
        $users = User::where('role', 0)->get();
        $averageRating = $nilai->avg('rating');

        return view('halaman.index', compact('nilai', 'users'));
    }


    public function about()
    {
        return view('halaman.about');
    }

    public function paket(Request $request)
    {
        $tanggal_main = $request->input('tanggal_main', now()->toDateString());
        $durasiUser = $request->input('durasi', 1); // Durasi yang dipilih pengguna, default 1 jam

        $jadwal = Jadwal::with(['bayar' => function ($query) use ($tanggal_main) {
            $query->whereDate('tanggal_main', $tanggal_main)
                ->where('status', '!=', 'dibatalkan');
        }])->get();

        foreach ($jadwal as $j) {
            $startTime = \Carbon\Carbon::parse($j->star_time);
            $isBooked = false;

            // Cek setiap interval jam berdasarkan durasi pengguna
            for ($i = 0; $i < $durasiUser; $i++) {
                $currentStartTime = $startTime->copy()->addHours($i);
                $currentEndTime = $currentStartTime->copy()->addHour();

                $bookings = Bayar::where('jadwal_id', $j->id)
                    ->whereDate('tanggal_main', '=', $tanggal_main)
                    ->get();

                foreach ($bookings as $booking) {
                    if ($booking->status === 'dibatalkan') {
                        continue; // Lewati booking yang dibatalkan
                    }

                    $bookingStartTime = \Carbon\Carbon::parse($booking->tanggal_main . ' ' . $booking->jadwal->star_time);
                    $bookingEndTime = $bookingStartTime->copy()->addHours($booking->durasi);

                    if (
                        ($currentStartTime->between($bookingStartTime, $bookingEndTime->subSecond()) ||
                            $currentEndTime->between($bookingStartTime, $bookingEndTime->subSecond())) ||
                        ($bookingStartTime->between($currentStartTime, $currentEndTime->subSecond()) ||
                            $bookingEndTime->between($currentStartTime, $currentEndTime->subSecond()))
                    ) {
                        $isBooked = true;
                        break 2; // Jika ada konflik, keluar dari loop durasi
                    }
                }
            }

            // Atur status jadwal sebagai "Terboking" atau "Tersedia"
            $j->setAttribute('status', $isBooked ? 'Terboking' : 'Tersedia');
        }

        return view('halaman.paket', compact('jadwal', 'tanggal_main', 'durasiUser'));
    }
}
