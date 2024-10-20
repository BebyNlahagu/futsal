@extends('layouts.bayar')

@section('title', 'Transaksi')
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
                    <button type="button" class="btn btn-primary ms-auto" data-toggle="modal" data-target="#staticBackdrop">
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
                                <th>Tanggal Dibuat</th>
                                <th>Tanggal Main</th>
                                <th>Durasi (Jam)</th>
                                <th>Total</th>
                                <th>DP</th>
                                <th>Bayar</th>
                                <th>Sisa</th>
                                <th>Status</th>
                                <th>Lihat Bukti</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($bayars as $bayar)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $bayar->user->name }}</td>
                                    <td>{{ $bayar->jadwal->jam }}</td>
                                    <td>{{ $bayar->created_at }}</td>
                                    <td>{{ $bayar->tanggal_main }}</td>
                                    <td>{{ $bayar->durasi }} Jam</td>
                                    <td>{{ number_format($bayar->total, 0, ',', '.') }}</td>
                                    <td>{{ number_format($bayar->dp, 0, ',', '.') }}</td>
                                    <td>{{ number_format($bayar->bayar, 0, ',', '.') }}</td>
                                    <td>{{ number_format($bayar->sisa, 0, ',', '.') }}</td>
                                    <td>{{ $bayar->status }}</td>
                                    <td>
                                        @if ($bayar->bukti_pembayaran)
                                            <a href="{{ asset('storage/' . $bayar->bukti_pembayaran) }}" target="_blank">Lihat Bukti</a>
                                        @else
                                            <span class="text-danger">Belum ada bukti</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($bayar->status !== 'lunas')
                                            <form action="{{ route('bayars.updateStatus', $bayar->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-success btn-sm">Konfirmasi Lunas</button>
                                            </form>
                                        @endif
                                        <div class="d-flex">
                                            <a href="{{ route('transaksi.edit', $bayar->id) }}" class="btn btn-warning btn-sm me-2" data-toggle="modal" data-target="#edit{{ $bayar->id }}"><i class="fa fa-edit"></i></a>
                                            <form action="{{ route('transaksi.destroy', $bayar->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah -->
    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                            <select name="jadwal_id" id="jadwal_id" class="form-control" required>
                                <option value="">Pilih Jadwal</option>
                                @foreach ($jadwals as $jadwal)
                                    <option value="{{ $jadwal->id }}" data-harga-biasa="{{ $jadwal->harga_hari_biasa }}" data-harga-akhir-pekan="{{ $jadwal->harga_hari_pekan }}">
                                        {{ $jadwal->jam }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="user_id" class="form-label">User</label>
                            <select name="user_id" id="user_id" class="form-control" required>
                                <option value="">Pilih User</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="durasi" class="form-label">Durasi (Jam)</label>
                            <input type="number" name="durasi" id="durasi" class="form-control" min="1" required>
                        </div>

                        <div class="mb-3">
                            <label for="total" class="form-label">Total Harga</label>
                            <input type="text" id="total" class="form-control" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="dp" class="form-label">Uang Muka (DP)</label>
                            <input type="text" id="dp" class="form-control" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="bayar" class="form-label">Jumlah Bayar</label>
                            <input type="number" name="bayar" id="bayar" class="form-control" min="0" required>
                        </div>

                        <div class="form-footer">
                            <button type="submit" class="btn btn-primary">Simpan Pembayaran</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    @foreach ($bayars as $bayar)
    <div class="modal fade" id="edit{{ $bayar->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="updateJadwalModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateJadwalModalLabel">Update Jadwal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('transaksi.update', $bayar->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="tanggal_main_update{{ $bayar->id }}" class="form-label">Tanggal Main</label>
                            <input type="date" class="form-control" name="tanggal_main" id="tanggal_main_update{{ $bayar->id }}" value="{{ $bayar->tanggal_main }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="jadwal_id_update{{ $bayar->id }}" class="form-label">Jadwal</label>
                            <select name="jadwal_id" id="jadwal_id_update{{ $bayar->id }}" class="form-control" required>
                                @foreach ($jadwals as $jadwal)
                                    <option value="{{ $jadwal->id }}" data-harga-biasa="{{ $jadwal->harga_hari_biasa }}" data-harga-akhir-pekan="{{ $jadwal->harga_hari_pekan }}" @if ($jadwal->id === $bayar->jadwal_id) selected @endif>
                                        {{ $jadwal->jam }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="user_id_update{{ $bayar->id }}" class="form-label">User</label>
                            <select name="user_id" id="user_id_update{{ $bayar->id }}" class="form-control" required>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" @if ($user->id === $bayar->user_id) selected @endif>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="durasi_update{{ $bayar->id }}" class="form-label">Durasi (Jam)</label>
                            <input type="number" class="form-control" name="durasi" id="durasi_update{{ $bayar->id }}" min="1" value="{{ $bayar->durasi }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="total_update{{ $bayar->id }}" class="form-label">Total Harga</label>
                            <input type="text" id="total_update{{ $bayar->id }}" class="form-control" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="dp_update{{ $bayar->id }}" class="form-label">Uang Muka (DP)</label>
                            <input type="text" id="dp_update{{ $bayar->id }}" class="form-control" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="bayar_update{{ $bayar->id }}" class="form-label">Jumlah Bayar</label>
                            <input type="number" name="bayar" id="bayar_update{{ $bayar->id }}" class="form-control" min="0" value="{{ $bayar->bayar }}" required>
                        </div>

                        <div class="form-footer">
                            <button type="submit" class="btn btn-primary">Update Pembayaran</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const jadwalSelect = document.getElementById('jadwal_id');
            const tanggalInput = document.getElementById('tanggal_main');
            const durasiInput = document.getElementById('durasi');
            const totalHargaInput = document.getElementById('total');
            const dpInput = document.getElementById('dp');

            const calculateTotal = () => {
                const selectedOption = jadwalSelect.options[jadwalSelect.selectedIndex];
                if (!selectedOption.value || !tanggalInput.value || !durasiInput.value) {
                    totalHargaInput.value = '';
                    dpInput.value = '';
                    return;
                }

                const hargaBiasa = parseInt(selectedOption.getAttribute('data-harga-biasa'));
                const hargaAkhirPekan = parseInt(selectedOption.getAttribute('data-harga-akhir-pekan'));
                const durasi = parseInt(durasiInput.value);
                const tanggal = new Date(tanggalInput.value);
                const isAkhirPekan = (tanggal.getDay() === 6 || tanggal.getDay() === 0);

                const hargaPerJam = isAkhirPekan ? hargaAkhirPekan : hargaBiasa;
                const total = hargaPerJam * durasi;

                totalHargaInput.value = total ? total.toLocaleString() : 0;
                const dp = total * 0.25; // Uang muka 25%
                dpInput.value = dp ? dp.toLocaleString() : 0;
            };

            jadwalSelect.addEventListener('change', calculateTotal);
            tanggalInput.addEventListener('change', calculateTotal);
            durasiInput.addEventListener('input', calculateTotal);
        });

        @foreach ($bayars as $bayar)
        document.addEventListener('DOMContentLoaded', function() {
            const jadwalSelect = document.getElementById('jadwal_id_update{{ $bayar->id }}');
            const tanggalInput = document.getElementById('tanggal_main_update{{ $bayar->id }}');
            const durasiInput = document.getElementById('durasi_update{{ $bayar->id }}');
            const totalHargaInput = document.getElementById('total_update{{ $bayar->id }}');
            const dpInput = document.getElementById('dp_update{{ $bayar->id }}');

            const calculateTotal = () => {
                const selectedOption = jadwalSelect.options[jadwalSelect.selectedIndex];
                if (!selectedOption.value || !tanggalInput.value || !durasiInput.value) {
                    totalHargaInput.value = '';
                    dpInput.value = '';
                    return;
                }

                const hargaBiasa = parseInt(selectedOption.getAttribute('data-harga-biasa'));
                const hargaAkhirPekan = parseInt(selectedOption.getAttribute('data-harga-akhir-pekan'));
                const durasi = parseInt(durasiInput.value);
                const tanggal = new Date(tanggalInput.value);
                const isAkhirPekan = (tanggal.getDay() === 6 || tanggal.getDay() === 0);

                const hargaPerJam = isAkhirPekan ? hargaAkhirPekan : hargaBiasa;
                const total = hargaPerJam * durasi;

                totalHargaInput.value = total ? total.toLocaleString() : 0;
                const dp = total * 0.25; // Uang muka 25%
                dpInput.value = dp ? dp.toLocaleString() : 0;
            };

            jadwalSelect.addEventListener('change', calculateTotal);
            tanggalInput.addEventListener('change', calculateTotal);
            durasiInput.addEventListener('input', calculateTotal);
        });
        @endforeach
    </script>
@endsection

