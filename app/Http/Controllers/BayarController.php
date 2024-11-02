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
        $bayars = Bayar::with(['jadwal', 'user'])->get();

        $tanggalMain = request('tanggal_main');
        $durasi = request('durasi', 1);
        $jadwalTerpesan = [];

        if ($tanggalMain) {
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
                            $isConflict = false;
                            for ($j = 0; $j < $durasi; $j++) {
                                $checkHour = clone $startHour;
                                $checkHour->modify("+{$j} hour");
                                if (
                                    in_array($conflictJadwal->id, $jadwalTerpesan) || Bayar::where('jadwal_id', $conflictJadwal->id)
                                    ->whereDate('tanggal_main', $tanggalMain)
                                    ->exists()
                                ) {
                                    $isConflict = true;
                                    break;
                                }
                            }
                            if (!$isConflict) {
                                $jadwalTerpesan[] = $conflictJadwal->id;
                            }
                        }
                    }
                }
            }
        }

        return view('kasir.transaksi.index', compact('bayars', 'jadwals', 'users', 'jadwalTerpesan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jadwal_id' => 'required|exists:jadwals,id',
            'user_id' => 'required|exists:users,id',
            'tanggal_main' => 'required|date',
            'durasi' => 'required|integer|min:1',
            'bayar' => 'required|numeric|min:0',
            'bukti_pembayaran' => 'nullable|image|mimes:jpeg,png,jpg,gif'
        ]);

        $existingBooking = Bayar::where('jadwal_id', $request->jadwal_id)
            ->whereDate('tanggal_main', $request->tanggal_main)
            ->first();

        if ($existingBooking) {
            Alert::error('Jadwal Sudah Dipesan', 'Pilih Jadwal Lain');
            return redirect()->back();
        }

        if ($request->hasFile('bukti_pembayaran')) {
            $file = $request->file('bukti_pembayaran');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads/bukti_pembayaran', $fileName, 'public');
        } else {
            $filePath = null;
        }

        $jadwal = Jadwal::findOrFail($request->jadwal_id);

        $tanggal = new \Carbon\Carbon($request->tanggal_main);
        $isAkhirPekan = $tanggal->isWeekend();
        $harga = $isAkhirPekan ? $jadwal->harga_hari_pekan : $jadwal->harga_hari_biasa;

        $total = $harga * $request->durasi;

        $bayar = $request->bayar;
        $sisa = $total - $bayar;
        $status = $sisa <= 0 ? 'Lunas' : 'Belum Lunas';

        $bayarData = Bayar::create([
            'jadwal_id' => $request->jadwal_id,
            'user_id' => $request->user_id,
            'tanggal_main' => $request->tanggal_main,
            'durasi' => $request->durasi,
            'total' => $total,
            'dp' => $total * 0.25,
            'bayar' => $bayar,
            'sisa' => max($sisa, 0),
            'status' => $status,
            'bukti_pembayaran' => $filePath
        ]);

        $jadwal->update(['status' => 'sudah di booking']);

        Alert::success('Success', 'Pembayaran berhasil disimpan!');
        return redirect()->back();
    }

    public function lunasi($id)
    {
        $bayar = Bayar::find($id);

        if (!$bayar || $bayar->user_id !== auth()->user()->id) {

            Alert::error('Gagal', 'Data pembayaran tidak ditemukan atau akses ditolak.');
            return redirect()->back();
        }

        $bayar->status = 'lunas';
        $bayar->sisa = 0;
        $bayar->save();

        Alert::Success('Berhasil', 'pembayaran Berhasil');
        return redirect()->back();
    }

    public function updateStatus($id)
    {
        $bayar = Bayar::findOrFail($id);

        $bayar->status = 'lunas';
        $bayar->sisa = 0;
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

        $jadwal = Jadwal::findOrFail($request->jadwal_id);

        $tanggal = new \Carbon\Carbon($request->tanggal_main);
        $isAkhirPekan = ($tanggal->isWeekend());
        $harga = $isAkhirPekan ? $jadwal->harga_hari_pekan : $jadwal->harga_hari_biasa;

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

    public function batal($id)
    {
        $bayar = Bayar::findOrFail($id);

        if ($bayar->status !== 'dibatalkan') {
            $bayar->status = 'dibatalkan';
            $bayar->save();

            $jadwal = Jadwal::where('id', $bayar->jadwal_id)->first();
            if ($jadwal) {
                $jadwal->status = 'belum dipesan';
                $jadwal->save();
            }

            return redirect()->back()->with('success', 'Booking berhasil dibatalkan.');
        }
        return redirect()->back()->with('error', 'Booking tidak dapat dibatalkan.');
    }

    public function destroy($id)
    {
        Bayar::findOrFail($id)->delete();

        Alert::success('Berhasil', 'Data Pembayaran di Hapus');
        return redirect()->route('transaksi.index');
    }
}
