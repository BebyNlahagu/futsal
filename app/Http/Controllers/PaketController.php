<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use RealRashid\SweetAlert\Facades\Alert;

class PaketController extends Controller
{
    public function index()
    {
        $paket = Paket::all();
        return view('admin.paket.index', compact('paket'));
    }

    public function store(Request $request)
    {
        Paket::create($request->all());

        Alert::success('Berhasil', 'Data Paket Berhasil Di tambahkan');
        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'paket' => 'required',
            'durasi' => 'required',
            'harga' => 'required|numeric'
        ]);

        $paket = Paket::findOrFail($id);
        $paket->update($validate);

        Alert::success('Berhasil', 'Data Paket Berhasil Diperbarui');
        return redirect()->back();
    }

    public function edit($id)
    {
        $paket = Paket::findOrFail($id);

        return Redirect()->route('paket.index', compact('paket'));
    }

    public function destroy($id)
    {
        Paket::findOrFail($id)->delete();

        Alert::warning('Berhasil','Data Berhasil Di hapus');
        return Redirect()->back();
    }
}
