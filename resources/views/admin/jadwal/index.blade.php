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
                                <th>Jam Operasional</th>
                                <th>Harga Hari Biasa</th>
                                <th>Harga Akhir Pekan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                                $currentLapanganId = null;
                            @endphp
                            @foreach ($jadwal as $index => $l)
                                @if ($currentLapanganId !== $l->lapangan_id)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $l->lapangan->nama_lapangan ?? 'N/A' }}</td>
                                        <td>{{ \Carbon\Carbon::parse($l->star_time)->format('h:i A') }} - {{ \Carbon\Carbon::parse($l->end_time)->format('h:i A') }}</td>
                                        <td>Rp.{{ number_format($l->harga_hari_biasa) }},-</td>
                                        <td>Rp.{{ number_format($l->harga_hari_pekan) }},-</td>
                                        <td>
                                            <a href="{{ route('jadwal.edit', ['jadwal' => $l->id]) }}" class="btn btn-success btn-sm" data-toggle="modal" data-target="#edit{{ $l->id }}"> <i class='fa fa-edit'></i>
                                            </a>
                                            <form action="{{ route('jadwal.destroy', $l->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    @php
                                        $currentLapanganId = $l->lapangan_id; // Set ID lapangan saat ini
                                    @endphp
                                @else
                                    <tr>
                                        <td colspan="2"></td>
                                        <td>{{ \Carbon\Carbon::parse($l->star_time)->format('h:i A') }} - {{ \Carbon\Carbon::parse($l->end_time)->format('h:i A') }}</td>
                                        <td>Rp.{{ number_format($l->harga_hari_biasa) }},-</td>
                                        <td>Rp.{{ number_format($l->harga_hari_pekan) }},-</td>
                                        <td>
                                            <a href="{{ route('jadwal.edit', ['jadwal' => $l->id]) }}" class="btn btn-success btn-sm" data-toggle="modal" data-target="#edit{{ $l->id }}"> <i class='fa fa-edit'></i>
                                            </a>
                                            <form action="{{ route('jadwal.destroy', $l->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
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
                            <!-- Initial Row -->
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
                                    <label for="star_time" class="form-label">Waktu Mulai</label>
                                    <input type="time" name="star_time[]" class="form-control" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="end_time" class="form-label">Waktu Selesai</label>
                                    <input type="time" name="end_time[]" class="form-control" required>
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

    <!-- JS -->
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#lapanganTable').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Indonesian.json"
                }
            });

            // Add Row Event
            $('#addRow').click(function() {
                var newRow = `
                <div class="row mb-3">
                    <div class="col-md-4">
                        <input type="time" name="star_time[]" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <input type="time" name="end_time[]" class="form-control" required>
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
                </div>
            `;
                $('#dynamicForm').append(newRow); // Append the new row
            });

            // Remove Row Event (using event delegation)
            $('#dynamicForm').on('click', '.removeRow', function() {
                $(this).closest('.row').remove(); // Remove the closest row when clicked
            });
        });
    </script>



@endsection
