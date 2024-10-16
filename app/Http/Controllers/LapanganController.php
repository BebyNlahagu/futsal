<?php

namespace App\Http\Controllers;

use App\Models\Lapangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Psy\Command\EditCommand;
use RealRashid\SweetAlert\Facades\Alert;

class LapanganController extends Controller
{
    public function index()
    {
        $lapangan = Lapangan::all();
        return view('admin.lapangan.index', compact('lapangan'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([

            'nama_lapangan' => 'required|string',
            'gambar' => 'required|image',
        ]);

        Session::flash('nama_lapangan', $request->nama_lapangan);

        $image = $request->file('gambar');
        $image_ex = $image->getClientOriginalExtension();
        $imageNama = now()->format('YmdHis') . '.' . $image_ex;
        $image->storeAs('public/images', $imageNama);

        $data = [
            'nama_lapangan' => $request->input('nama_lapangan'),
            'gambar' => $imageNama,
        ];

        Lapangan::create($data);

        Alert::success('Berhasil', 'Data berhasil ditambahkan dan notifikasi sudah dikirim ke manager.');
        return redirect()->route('admin.lapangan.index');
    }

    public function edit($id)
    {
        $lapangan = Lapangan::findOrFail($id);
        return redirect()->route('admin.lapangan.index',compact('lapangan'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'nama_lapangan' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,jpg,png,gif',
        ]);

        $lapangan = Lapangan::findOrFail($id);

        if ($request->hasFile('gambar')) {
            if (Storage::exists('public/images/' . $lapangan->gambar)) {
                Storage::delete('public/images/' . $lapangan->gambar);
            }

            $image = $request->file('gambar');
            $image_ex = $image->extension();
            $imageNama = date('ymdhis') . "." . $image_ex;
            $image->storeAs('public/images', $imageNama);
        } else {
            $imageNama = $lapangan->gambar;
        }

        $lapangan->nama_lapangan = $request->input('nama_lapangan');
        $lapangan->gambar = $imageNama;
        $lapangan->save();

        Alert::success('Berhasil', 'Data berhasil diperbaharui.');
        return redirect()->route('admin.lapangan.index');
    }

    public function destroy($id)
    {
        Lapangan::findOrFail($id)->delete();

        Alert::success('Berhasil', 'Data berhasil diHapus.');
        return redirect()->route('admin.lapangan.index');
    }
}
