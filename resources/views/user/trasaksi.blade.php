@extends('layouts.home')

@section('title', 'Transaksi')
@section('gambar')
    <div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center py-5">
            <h1 class="display-2 text-white mb-4 animated slideInDown">@yield('title')</h1>
        </div>
    </div>
@endsection
@section('content')
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-12 wow fadeIn" data-wow-delay="0.5s">
                    <div class="section-title">
                        <p class="fs-5 fw-medium fst-italic text-primary">Transaksi</p>
                        <h1 class="display-6">AW Soccer Park</h1>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row g-5 d-flex justify-content-center">
                    <div class="col-lg-6 wow fadeIn" data-wow-delay="1">
                        <h3 class="text-center">Buat Transaksi</h3>
                    </div>
                </div>

                @if (auth()->user()->role == 0)
                    <div class="row g-5 d-flex justify-content-center">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card mb-4">
                                    <div
                                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6>
                                        <button type="button" class="btn btn-primary ms-auto" data-bs-toggle="modal"
                                            data-bs-target="#staticBackdrop">
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
                                                    <th>Bukti Pembayaran</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $no = 1;
                                                @endphp
                                                @foreach ($bayars as $bayar)
                                                    @if ($bayar->user_id == auth()->user()->id && auth()->user()->role == 0)
                                                        <!-- Hanya menampilkan data user login dengan role 0 -->
                                                        <tr>
                                                            <td>{{ $no++}}</td>
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
                                                                @if ($bayar->bukti_pembayaran)
                                                                    <img src="{{ asset('storage/' . $bayar->bukti_pembayaran) }}" alt="" style="width: 50px" height="auto">
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if ($bayar->status !== 'lunas')
                                                                    <span class="text-warning">Menunggu konfirmasi
                                                                        kasir</span>
                                                                @else
                                                                    <span class="text-success">Lunas</span>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            </tbody>


                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal untuk tambah transaksi -->


                        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">Tambah Jadwal</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div>
                                            @if ($errors->any())
                                                <div class="alert alert-danger">
                                                    <ul>
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif
                                        </div>

                                        <form action="{{ route('user.transaksi') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="tanggal_main" class="form-label">Tanggal Main</label>
                                                <input type="date" name="tanggal_main" id="tanggal_main"
                                                    class="form-control" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="jadwal_id" class="form-label">Jadwal</label>
                                                <select name="jadwal_id" id="jadwal_id" class="form-select" required>
                                                    <option value="">Pilih Jadwal</option>
                                                    @foreach ($jadwals as $jadwal)
                                                        <option value="{{ $jadwal->id }}"
                                                            data-harga-biasa="{{ $jadwal->harga_hari_biasa }}"
                                                            data-harga-akhir-pekan="{{ $jadwal->harga_akhir_pekan }}">
                                                            {{ $jadwal->jam }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label for="user_id" class="form-label">User</label>
                                                <select name="user_id" id="user_id" class="form-select" required>
                                                    <option value="{{ auth()->user()->id }}">{{ auth()->user()->name }}
                                                    </option>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label for="durasi" class="form-label">Durasi (Jam)</label>
                                                <input type="number" name="durasi" id="durasi" class="form-control"
                                                    min="1" required>
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
                                                <input type="number" name="bayar" id="bayar" class="form-control"
                                                    min="0" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="" class="form-label">No Rekening</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" readonly
                                                        value="7210887778">
                                                    <button class="btn btn-primary" type="button"
                                                        onclick="copyRekening()">Copy</button>
                                                </div>
                                                <small class="form-text text-muted">BSI a/n Alif Syarif</small>
                                            </div>

                                            <div class="mb-3">
                                                <label for="bukti_pembayaran" class="form-label">Bukti Pembayaran</label>
                                                <input type="file" name="bukti_pembayaran" id="bukti_pembayaran" class="form-control" accept="image/*" required>
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
                    </div>
                @else
                    <div class="alert alert-danger">Anda tidak memiliki akses untuk melakukan transaksi ini.</div>
                @endif
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function copyRekening() {
            var rekeningInput = document.getElementById("no_rekening");
            rekeningInput.select();
            rekeningInput.setSelectionRange(0, 99999); // Untuk mobile devices
            document.execCommand("copy");

            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Nomor rekening berhasil disalin ke clipboard.',
                showConfirmButton: false,
                timer: 1500
            });
        }
    </script>
@endsection
