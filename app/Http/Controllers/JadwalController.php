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
            'star_time' => 'required|time',
            'Star_tme.*' => 'required|time',
            'end_time' => 'required|time',
            'end_tme.*' => 'required|time',
            'harga_hari_biasa' => 'required|array',
            'harga_hari_biasa.*' => 'required|integer',
            'harga_hari_pekan' => 'required|array',
            'harga_hari_pekan.*' => 'required|integer',
        ]);

        foreach ($request->jam as $index => $jam) {
            Jadwal::create([
                'jam' => $jam,
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
