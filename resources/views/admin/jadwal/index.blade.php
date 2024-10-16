@extends('layouts.admin')

@section('title', 'Lapangan')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">

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
                                <th>Id</th>
                                <th>Nama Lapangan</th>
                                <th>Jam Mulai</th>
                                <th>Harga Hari Biasa</th>
                                <th>Harga Akhir Pekan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                                $currentLapanganId = null; // Inisialisasi ID lapangan saat ini
                            @endphp
                            @foreach ($jadwal as $index => $l)
                                @if ($currentLapanganId !== $l->lapangan_id)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $l->lapangan->nama_lapangan ?? 'N/A' }}</td>
                                        <td>{{ $l->jam }}</td>
                                        <td>{{ $l->harga_hari_biasa }}</td>
                                        <td>{{ $l->harga_hari_pekan }}</td>
                                        <td>
                                            <a href="{{ route('jadwal.edit', ['jadwal' => $l->id]) }}"
                                                class="btn btn-success" data-toggle="modal"
                                                data-target="#edit{{ $l->id }}">
                                                <i class='fa fa-edit'></i>
                                            </a>
                                            <form action="{{ route('jadwal.destroy', $l->id) }}" method="POST"
                                                style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @php
                                        $currentLapanganId = $l->lapangan_id; // Set ID lapangan saat ini
                                    @endphp
                                @else
                                    <tr>
                                        <td></td> <!-- Kosongkan kolom untuk nomor urut -->
                                        <td></td> <!-- Kosongkan kolom untuk nama lapangan -->
                                        <td>{{ $l->jam }}</td>
                                        <td>{{ $l->harga_hari_biasa }}</td>
                                        <td>{{ $l->harga_hari_pekan }}</td>
                                        <td>
                                            <a href="{{ route('jadwal.edit', ['jadwal' => $l->id]) }}"
                                                class="btn btn-success" data-toggle="modal"
                                                data-target="#edit{{ $l->id }}">
                                                <i class='fa fa-edit'></i>
                                            </a>
                                            <form action="{{ route('jadwal.destroy', $l->id) }}" method="POST"
                                                style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                            </form>
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

    <!-- Modal Tambah Data -->
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
                    <form action="{{ route('jadwal.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div id="dynamicForm" class="mb-3">
                            <div class="row mb-3">

                                <div class="col-md-4">
                                    <label for="lapangan_id" class="form-label">Pilih Lapangan</label>
                                    <select name="lapangan_id" class="form-control" required>
                                        @foreach ($lapangan as $lapangan)
                                            <option value="{{ $lapangan->id }}">{{ $lapangan->nama_lapangan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="jam" class="form-label">Jam</label>
                                    <input type="text" name="jam[]" class="form-control"
                                        placeholder="Contoh: 06:00 - 07:00" required>
                                </div>
                                <div class="col-md-3">
                                    <label for="harga_hari_biasa" class="form-label">Harga Hari Biasa</label>
                                    <input type="number" name="harga_hari_biasa[]" class="form-control"
                                        placeholder="Harga hari biasa" required>
                                </div>
                                <div class="col-md-3">
                                    <label for="harga_hari_pekan" class="form-label">Harga Akhir Pekan</label>
                                    <input type="number" name="harga_hari_pekan[]" class="form-control"
                                        placeholder="Harga akhir pekan" required>
                                </div>
                                <div class="col-md-2 d-flex align-items-end">
                                    <button type="button" class="btn btn-success" id="addRow">Tambah Jam</button>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal Edit Data -->
    @foreach ($jadwal as $l)
        <div class="modal fade" id="editLapangan{{ $l->id }}" data-backdrop="static" data-keyboard="false"
            tabindex="-1" aria-labelledby="editLapanganLabel{{ $l->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editLapanganLabel{{ $l->id }}">Edit Lapangan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('jadwal.update', $l->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div id="dynamicFormEdit" class="mb-3">
                                <div class="row mb-3">

                                    <div class="col-md-4">
                                        <label for="lapangan_id" class="form-label">Pilih Lapangan</label>
                                        <select name="lapangan_id" class="form-control" required>

                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="jam" class="form-label">Jam</label>
                                        <input type="text" name="jam[]" class="form-control"
                                            value="{{ $l->jam }}" placeholder="Contoh: 06:00 - 07:00" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="harga_hari_biasa" class="form-label">Harga Hari Biasa</label>
                                        <input type="number" name="harga_hari_biasa[]" class="form-control"
                                            value="{{ $l->harga_hari_biasa }}" placeholder="Harga hari biasa" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="harga_hari_pekan" class="form-label">Harga Akhir Pekan</label>
                                        <input type="number" name="harga_hari_pekan[]" class="form-control"
                                            value="{{ $l->harga_hari_pekan }}" placeholder="Harga akhir pekan" required>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary">Perbarui</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#lapanganTable').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Indonesian.json"
                }
            });
        });

        function previewImage(input, imgPreviewId) {
            const file = input.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById(imgPreviewId).src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        }
    </script>

    <script>
        document.getElementById('addRow').addEventListener('click', function() {
            // Element yang akan ditambahkan
            var newRow = `
        <div class="row mb-3">
            <div class="col-md-4">
                <input type="text" name="jam[]" class="form-control" placeholder="Contoh: 06:00 - 07:00" required>
            </div>
            <div class="col-md-3">
                <input type="number" name="harga_hari_biasa[]" class="form-control" placeholder="Harga hari biasa" required>
            </div>
            <div class="col-md-3">
                <input type="number" name="harga_hari_pekan[]" class="form-control" placeholder="Harga akhir pekan" required>
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button type="button" class="btn btn-danger removeRow">Hapus</button>
            </div>
        </div>`;

            // Tambahkan elemen baru ke dalam div dynamicForm
            document.getElementById('dynamicForm').insertAdjacentHTML('beforeend', newRow);

            // Tambahkan event listener untuk tombol Hapus
            var removeButtons = document.querySelectorAll('.removeRow');
            removeButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    this.closest('.row').remove(); // Hapus row terkait
                });
            });
        });
    </script>
@endsection
