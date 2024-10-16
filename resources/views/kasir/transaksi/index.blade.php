@extends('layouts.bayar')

@section('title', 'Trasaksi')
@section('name')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">@yield('title')</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">@yield('title')</li>
        </ol>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6>
                    <button type="button" class="btn btn-primary ms-auto" data-toggle="modal"
                        data-target="#staticBackdrop">
                        + ADD
                    </button>
                </div>
                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush" id="lapanganTable">
                        <thead class="thead-light">
                            <tr>
                                <th>ID</th>
                                <th>User</th>
                                <th>Jadwal</th>
                                <th>Tanggal Main</th>
                                <th>Durasi (Jam)</th>
                                <th>Total</th>
                                <th>DP</th>
                                <th>Bayar</th>
                                <th>Sisa</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bayars as $bayar)
                                <tr>
                                    <td>{{ $bayar->id }}</td>
                                    <td>{{ $bayar->user->name }}</td>
                                    <td>{{ $bayar->jadwal->jam }}</td>
                                    <td>{{ $bayar->tanggal_main }}</td>
                                    <td>{{ $bayar->durasi }}</td>
                                    <td>{{ number_format($bayar->total, 0, ',', '.') }}</td>
                                    <td>{{ number_format($bayar->dp, 0, ',', '.') }}</td>
                                    <td>{{ number_format($bayar->bayar, 0, ',', '.') }}</td>
                                    <td>{{ number_format($bayar->sisa, 0, ',', '.') }}</td>
                                    <td>{{ $bayar->status }}</td>
                                    <td>
                                        @if ($bayar->status !== 'lunas')
                                            <form action="{{ route('bayars.updateStatus', $bayar->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-success btn-sm">Konfirmasi
                                                    Lunas</button>
                                            </form>
                                        @endif
                                        <a href="{{ route('transaksi.edit', $bayar->id) }}"
                                            class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('transaksi.destroy', $bayar->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Tambah Jadwal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('transaksi.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="tanggal_main" class="form-label">Tanggal Main</label>
                            <input type="date" name="tanggal_main" id="tanggal_main" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="jadwal_id" class="form-label">Jadwal</label>
                            <select name="jadwal_id" id="jadwal_id" class="form-select" required>
                                <option value="">Pilih Jadwal</option>
                                @foreach ($jadwals as $jadwal)
                                    <option value="{{ $jadwal->id }}" data-harga-biasa="{{ $jadwal->harga_hari_biasa }}"
                                        data-harga-akhir-pekan="{{ $jadwal->harga_akhir_pekan }}">
                                        {{ $jadwal->jam }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="user_id" class="form-label">User</label>
                            <select name="user_id" id="user_id" class="form-select" required>
                                <option value="">Pilih User</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="durasi" class="form-label">Durasi (Jam)</label>
                            <input type="number" name="durasi" id="durasi" class="form-control" min="1"
                                required>
                        </div>

                        <div class="mb-3">
                            <label for="total_harga" class="form-label">Total Harga</label>
                            <input type="text" id="total_harga" class="form-control" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="dp" class="form-label">Uang Muka (DP)</label>
                            <input type="text" id="dp" class="form-control" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="bayar" class="form-label">Jumlah Bayar</label>
                            <input type="number" name="bayar" id="bayar" class="form-control" min="0"
                                required>
                        </div>
                        <div class="form-footer">
                            <button type="submit" class="btn btn-primary">Simpan Pembayaran</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const jadwalSelect = document.getElementById('jadwal_id');
            const tanggalInput = document.getElementById('tanggal_main');
            const durasiInput = document.getElementById('durasi');
            const totalHargaInput = document.getElementById('total_harga');
            const dpInput = document.getElementById('dp');

            function calculateTotal() {
                const selectedOption = jadwalSelect.options[jadwalSelect.selectedIndex];
                const hargaBiasa = parseInt(selectedOption.getAttribute('data-harga-biasa'));
                const hargaAkhirPekan = parseInt(selectedOption.getAttribute('data-harga-akhir-pekan'));
                const durasi = parseInt(durasiInput.value);
                const tanggal = new Date(tanggalInput.value);
                const isAkhirPekan = (tanggal.getDay() === 6 || tanggal.getDay() === 0); // 6: Sabtu, 0: Minggu

                const hargaPerJam = isAkhirPekan ? hargaAkhirPekan : hargaBiasa;
                const total = hargaPerJam * durasi;

                totalHargaInput.value = total ? total.toLocaleString() : 0; // Format angka

                // Menghitung DP (25% dari total harga)
                const dp = total * 0.25; // Misalnya 25%
                dpInput.value = dp ? dp.toLocaleString() : 0; // Format angka
            }

            jadwalSelect.addEventListener('change', calculateTotal);
            tanggalInput.addEventListener('change', calculateTotal);
            durasiInput.addEventListener('input', calculateTotal);
        });
    </script>

@endsection
