<?php

namespace App\Http\Controllers;

use App\Models\Bayar;
use App\Models\Jadwal;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class BayarController extends Controller
{
    public function index()
    {
        $jadwals = Jadwal::all();
        $users = User::where('role', 0)->get();
        $bayars = Bayar::with(['jadwal', 'user'])->get(); // Mengambil data pembayaran beserta relasi jadwal dan user
        return view('kasir.transaksi.index', compact('bayars', 'jadwals', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jadwal_id' => 'required|exists:jadwals,id',
            'user_id' => 'required|exists:users,id',
            'tanggal_main' => 'required|date',
            'durasi' => 'required|integer|min:1',
            'bayar' => 'required|numeric|min:0',
            'bukti_pembayaran' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048'
        ]);

        if ($request->hasFile('bukti_pembayaran')) {
            // Simpan file dan ambil path-nya
            $file = $request->file('bukti_pembayaran');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads/bukti_pembayaran', $fileName, 'public');
        } else {
            $filePath = null; // Jika tidak ada file yang diunggah
        }

        // Ambil jadwal yang dipilih
        $jadwal = Jadwal::findOrFail($request->jadwal_id);

        // Tentukan harga berdasarkan hari
        $tanggal = new \Carbon\Carbon($request->tanggal_main);
        $isAkhirPekan = ($tanggal->isWeekend()); // Mengecek apakah akhir pekan
        $harga = $isAkhirPekan ? $jadwal->harga_hari_pekan : $jadwal->harga_hari_biasa;

        // Hitung total harga
        $total = $harga * $request->durasi;

        // Hitung sisa dan status
        $bayar = $request->bayar;
        $sisa = $total - $bayar;
        $status = $sisa <= 0 ? 'Lunas' : 'Belum Lunas';

        // Simpan data ke tabel bayars
        Bayar::create([
            'jadwal_id' => $request->jadwal_id,
            'user_id' => $request->user_id,
            'tanggal_main' => $request->tanggal_main,
            'durasi' => $request->durasi,
            'total' => $total,
            'dp' => $total * 0.25, // Misalnya 25%
            'bayar' => $bayar,
            'sisa' => max($sisa, 0), // Sisa tidak boleh negatif
            'status' => $status,
            'bukti_pembayaran' => $filePath
        ]);

        Alert::success('success', 'Pembayaran berhasil disimpan!');
        return redirect()->back();
    }

    public function updateStatus($id)
    {
        $bayar = Bayar::findOrFail($id);

        // Update status menjadi 'lunas'
        $bayar->status = 'lunas';
        $bayar->sisa = 0; // Set sisa menjadi 0 jika sudah lunas
        $bayar->save();

        Alert::success('Berhasil', 'Pembayaran Lunas');
        return redirect()->route('transaksi.index');
    }

    public function edit($id)
    {
        $bayar = Bayar::findOrFail($id);

        return redirect()->route('transaksi.index', compact('bayar'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jadwal_id' => 'required|exists:jadwals,id',
            'user_id' => 'required|exists:users,id',
            'tanggal_main' => 'required|date',
            'durasi' => 'required|integer|min:1',
            'bayar' => 'required|numeric|min:0',
            'bukti_pembayaran' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048'
        ]);

        $bayar = Bayar::findOrFail($id);

        if ($request->hasFile('bukti_pembayaran')) {
            if ($bayar->bukti_pembayaran) {
                Storage::disk('public')->delete($bayar->bukti_pembayaran);
            }

            $file = $request->file('bukti_pembayaran');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads/bukti_pembayaran', $fileName, 'public');
        } else {
            $filePath = $bayar->bukti_pembayaran;
        }

        // Ambil jadwal yang dipilih
        $jadwal = Jadwal::findOrFail($request->jadwal_id);

        // Tentukan harga berdasarkan hari
        $tanggal = new \Carbon\Carbon($request->tanggal_main);
        $isAkhirPekan = ($tanggal->isWeekend());
        $harga = $isAkhirPekan ? $jadwal->harga_hari_pekan : $jadwal->harga_hari_biasa;

        // Hitung total harga
        $total = $harga * $request->durasi;

        $bayarAmount = $request->bayar;
        $sisa = $total - $bayarAmount;
        $status = $sisa <= 0 ? 'Lunas' : 'Belum Lunas';

        $bayar->update([
            'jadwal_id' => $request->jadwal_id,
            'user_id' => $request->user_id,
            'tanggal_main' => $request->tanggal_main,
            'durasi' => $request->durasi,
            'total' => $total,
            'dp' => $total * 0.25,
            'bayar' => $bayarAmount,
            'sisa' => max($sisa, 0),
            'status' => $status,
            'bukti_pembayaran' => $filePath
        ]);

        Alert::success('success', 'Pembayaran berhasil diperbarui!');
        return redirect()->back();
    }

    public function destroy($id)
    {
        Bayar::findOrFail($id)->delete();

        Alert::success('Berhasil', 'Data Pembayaran di Hapus');
        return redirect()->route('transaksi.index');
    }
}
