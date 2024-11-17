<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Lapangan;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index()
    {
        $jadwal = Jadwal::with('lapangan')->get();
        $lapangan = Lapangan::all();
        return view('admin.jadwal.index', compact('jadwal', 'lapangan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'star_time' => 'required|array',
            'star_time.*' => 'required|date_format:H:i',
            'end_time' => 'required|array',
            'end_time.*' => 'required|date_format:H:i',
            'harga_hari_biasa' => 'required|array',
            'harga_hari_biasa.*' => 'required|integer',
            'harga_hari_pekan' => 'required|array',
            'harga_hari_pekan.*' => 'required|integer',
        ]);

        foreach ($request->star_time as $index => $star_time) {
            Jadwal::create([
                'star_time' => $star_time,
                'end_time' => $request->end_time[$index],
                'harga_hari_biasa' => $request->harga_hari_biasa[$index],
                'harga_hari_pekan' => $request->harga_hari_pekan[$index],
                'lapangan_id' => $request->lapangan_id,
            ]);
        }

        return redirect()->back()->with('success', 'Data berhasil disimpan!');
    }

    public function edit($id)
    {
        $jadwal = Jadwal::with('lapangan')->findOrFail($id);
        $lapangan = Lapangan::all();

        return redirect()->route('jadwal.index', compact('jadwal', 'lapangan'));
    }


    public function destroy($id)
    {
        Jadwal::findOrFail($id)->delete();

        return redirect()->back();
    }
}
