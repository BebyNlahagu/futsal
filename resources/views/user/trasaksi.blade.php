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
                                                            <td>{{ $no++ }}</td>
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
                                                                    <img src="{{ Storage::url($bayar->bukti_pembayaran) }}"
                                                                        alt="" style="width: 50px" height="auto">
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if ($bayar->status == 'dibatalkan')
                                                                    <span class="text-danger">Booking telah dibatalkan</span>
                                                                @elseif ($bayar->status !== 'lunas')
                                                                    <span class="text-warning">Menunggu konfirmasi kasir</span>
                                                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#lunasiModal{{ $bayar->id }}">
                                                                        Lunasi
                                                                    </button>
                                                                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmBatal({{ $bayar->id }})">
                                                                        Batal
                                                                    </button>
                                                                @else
                                                                    <span class="text-success">Lunas</span>
                                                                @endif
                                                            </td>

                                                            <form id="batalForm{{ $bayar->id }}" action="{{ route('booking.batal', $bayar->id) }}" method="POST" style="display: none;">
                                                                @csrf
                                                                @method('PATCH')
                                                            </form>

                                                            <script>
                                                                function confirmBatal(id) {
                                                                    Swal.fire({
                                                                        title: 'Apakah Anda yakin?',
                                                                        text: "Booking ini akan dibatalkan!",
                                                                        icon: 'warning',
                                                                        showCancelButton: true,
                                                                        confirmButtonColor: '#3085d6',
                                                                        cancelButtonColor: '#d33',
                                                                        confirmButtonText: 'Ya, batalkan!',
                                                                        cancelButtonText: 'Batal'
                                                                    }).then((result) => {
                                                                        if (result.isConfirmed) {
                                                                            document.getElementById('batalForm' + id).submit();
                                                                        }
                                                                    });
                                                                }
                                                            </script>

                                                        </tr>
                                                    @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div style="font-style: italic">
                                    *Harap datang 10 Menit sebelum bertanding
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

                                        <form action="{{ route('user.transaksi') }}" method="POST" id="transaksiForm"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="user_id" class="form-label">User</label>
                                                <input type="hidden" name="user_id" id="user_id"
                                                    value="{{ Auth::user()->id }}">
                                                <input type="text" class="form-control" value="{{ Auth::user()->name }}"
                                                    readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label for="tanggal_main" class="form-label">Tanggal Main</label>
                                                <input type="date" name="tanggal_main" id="tanggal_main"
                                                    class="form-control" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="jadwal_id" class="form-label">Jadwal</label>
                                                <select name="jadwal_id" id="jadwal_id" class="form-control" required>
                                                    <option value="">Pilih Jadwal</option>
                                                    @foreach ($jadwals as $jadwal)
                                                        <option value="{{ $jadwal->id }}" data-jam="{{ $jadwal->jam }}"
                                                            data-harga-biasa="{{ $jadwal->harga_hari_biasa }}"
                                                            data-harga-pekan="{{ $jadwal->harga_hari_pekan }}"
                                                            {{ in_array($jadwal->id, $jadwalTerpesan) ? 'disabled' : '' }}>
                                                            {{ $jadwal->jam }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label for="durasi" class="form-label">Durasi (Jam)</label>
                                                <input type="number" name="durasi" id="durasi" class="form-control"
                                                    min="1" max="4" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="total" class="form-label">Total Harga</label>
                                                <input type="text" name="total" id="total" class="form-control"
                                                    readonly>
                                            </div>

                                            <div class="mb-3">
                                                <label for="dp" class="form-label">Uang Muka (25%)</label>
                                                <input type="text" name="dp" id="dp" class="form-control"
                                                    readonly>
                                            </div>

                                            <div class="mb-3">
                                                <label for="bayar" class="form-label">Bayar</label>
                                                <input type="text" name="bayar" id="bayar" class="form-control"
                                                    required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="no-rek" class="form-label">No. Rek</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="no-rek"
                                                        name="no_rek" value="72108877778" readonly>
                                                    <button class="btn btn-outline-secondary" type="button"
                                                        onclick="copyToClipboard()">Salin</button>
                                                </div>
                                                <div class="form-text">BSI a/n Alif Syarif</div>
                                            </div>

                                            <div class="mb-3">
                                                <label for="bukti_pembayaran" class="form-label">Foto Bukti</label>
                                                <input type="file" name="bukti_pembayaran" id="bukti_pembayaran"
                                                    class="form-control">
                                            </div>

                                            <script>
                                                function copyToClipboard() {
                                                    const input = document.getElementById('no-rek');
                                                    input.select();
                                                    document.execCommand('copy');

                                                    Swal.fire({
                                                        title: 'Sukses!',
                                                        text: 'Nomor rekening telah disalin!',
                                                        icon: 'success',
                                                        confirmButtonText: 'OK'
                                                    });
                                                }
                                            </script>

                                            <input type="hidden" name="status" id="status">

                                            <div class="form-footer">
                                                <button type="submit" class="btn btn-primary">Simpan Transaksi</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const jadwalSelect = document.getElementById('jadwal_id');
                                const durasiInput = document.getElementById('durasi');
                                const tanggalInput = document.getElementById('tanggal_main');
                                const totalHargaInput = document.getElementById('total');
                                const dpInput = document.getElementById('dp');
                                const bayarInput = document.getElementById('bayar');
                                const statusInput = document.getElementById('status');
                                const transaksiForm = document.getElementById('transaksiForm');

                                const calculatePrice = () => {
                                    const selectedOption = jadwalSelect.options[jadwalSelect.selectedIndex];
                                    const durasi = parseInt(durasiInput.value);

                                    if (!selectedOption || isNaN(durasi) || durasi <= 0) {
                                        totalHargaInput.value = '';
                                        dpInput.value = '';
                                        statusInput.value = '';
                                        return;
                                    }

                                    const isWeekend = [0, 6].includes(new Date(tanggalInput.value).getDay());
                                    const hargaPerJam = isWeekend ?
                                        parseInt(selectedOption.getAttribute('data-harga-pekan')) :
                                        parseInt(selectedOption.getAttribute('data-harga-biasa'));

                                    const totalHarga = hargaPerJam * durasi;
                                    totalHargaInput.value = totalHarga.toLocaleString('id-ID', {
                                        style: 'currency',
                                        currency: 'IDR'
                                    });

                                    const dp = totalHarga * 0.25;
                                    dpInput.value = dp.toLocaleString('id-ID', {
                                        style: 'currency',
                                        currency: 'IDR'
                                    });

                                    updatePaymentStatus(totalHarga);
                                };

                                const updatePaymentStatus = (total) => {
                                    const bayar = parseFloat(bayarInput.value.replace(/[^0-9.-]+/g, ""));
                                    statusInput.value = (!isNaN(bayar) && bayar >= total) ? 'Lunas' : 'Belum Lunas';
                                };

                                const validateDP = () => {
                                    const bayar = parseFloat(bayarInput.value.replace(/[^0-9.-]+/g, ""));
                                    const dp = parseFloat(dpInput.value.replace(/[^0-9.-]+/g, ""));

                                    if (isNaN(bayar) || bayar < dp) {
                                        Swal.fire({
                                            title: 'Peringatan!',
                                            text: 'Jumlah bayar harus minimal sebesar DP (25%) dari total harga.',
                                            icon: 'warning',
                                            confirmButtonText: 'OK'
                                        });
                                        return false;
                                    }
                                    return true;
                                };

                                transaksiForm.addEventListener('submit', function(e) {
                                    if (!validateDP()) {
                                        e.preventDefault();
                                    }
                                });

                                const updateUnavailableSlots = () => {
                                    const selectedOption = jadwalSelect.options[jadwalSelect.selectedIndex];
                                    const durasi = parseInt(durasiInput.value);
                                    const jadwalElements = jadwalSelect.options;

                                    for (let option of jadwalElements) {
                                        option.disabled = false;
                                    }

                                    if (selectedOption && !isNaN(durasi) && durasi > 0) {
                                        const selectedJam = new Date(tanggalInput.value + ' ' + selectedOption.getAttribute(
                                            'data-jam'));
                                        for (let i = 0; i < durasi; i++) {
                                            const jamBaru = new Date(selectedJam);
                                            jamBaru.setHours(selectedJam.getHours() + i);

                                            for (let option of jadwalElements) {
                                                const jam = new Date(tanggalInput.value + ' ' + option.getAttribute('data-jam'));
                                                if (jam.getTime() === jamBaru.getTime() || {{ json_encode($jadwalTerpesan) }}
                                                    .includes(option.value)) {
                                                    option.disabled = true;
                                                }
                                            }
                                        }
                                    }
                                };

                                jadwalSelect.addEventListener('change', () => {
                                    calculatePrice();
                                    updateUnavailableSlots();
                                });
                                durasiInput.addEventListener('input', () => {
                                    calculatePrice();
                                    updateUnavailableSlots();
                                });
                                tanggalInput.addEventListener('input', () => {
                                    calculatePrice();
                                    updateUnavailableSlots();
                                });
                                bayarInput.addEventListener('input', () => updatePaymentStatus(parseFloat(totalHargaInput.value.replace(
                                    /[^0-9.-]+/g, ""))));
                            });
                        </script>


                        <!-- Modal -->
                       @foreach ($bayars as $bayar)
                       <div class="modal fade" id="lunasiModal{{ $bayar->id }}" tabindex="-1"
                        aria-labelledby="lunasiModalLabel{{ $bayar->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="lunasiModalLabel{{ $bayar->id }}">Konfirmasi
                                        Pelunasan</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p><strong>Total Bayar:</strong> Rp{{ number_format($bayar->total, 0, ',', '.') }}
                                    </p>
                                    <p><strong>DP:</strong> Rp{{ number_format($bayar->dp, 0, ',', '.') }}</p>
                                    <p><strong>Jumlah Bayar:</strong> Rp{{ number_format($bayar->bayar, 0, ',', '.') }}
                                    </p>
                                    <p><strong>Sisa Bayar:</strong> Rp{{ number_format($bayar->sisa, 0, ',', '.') }}
                                    </p>

                                    <div class="mb-3">
                                        <label for="bayar{{ $bayar->id }}" class="form-label">Masukkan
                                            Jumlah Pembayaran:</label>
                                        <input type="number" class="form-control"
                                            id="bayar{{ $bayar->id }}" name="bayar" min="0"
                                            max="{{ $bayar->sisa }}" required>
                                        <div class="form-text">Masukkan jumlah yang ingin Anda bayar. Maksimal:
                                            Rp{{ number_format($bayar->sisa, 0, ',', '.') }}</div>
                                    </div>

                                    <p>Apakah Anda yakin ingin melunasi pembayaran ini?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Batal</button>
                                    <form action="{{ route('bayar.lunasi', $bayar->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="bayar"
                                            value="{{ old('bayar', 0) }}">
                                        <button type="submit" class="btn btn-primary">Lunasi</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                       @endforeach


                    </div>
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
