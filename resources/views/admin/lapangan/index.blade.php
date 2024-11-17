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
                    <button type="button" class="btn btn-primary ms-auto" data-toggle="modal" data-target="#staticBackdrop">
                        + ADD
                    </button>
                </div>
                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush" id="dataTable">
                        <thead class="thead-light">
                            <tr>
                                <th>Id</th>
                                <th>Nama Lapangan</th>
                                <th>Gambar Lapangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($lapangan as $l)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $l->nama_lapangan }}</td>
                                    <td>
                                        @if ($l->gambar)
                                            <img src="{{ Storage::url('images/' . $l->gambar) }}" alt="Image"
                                                style="max-width: 50px; max-height: 50px; object-fit: cover;">
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.lapangan.edit', ['lapangan' => $l->id]) }}" class="btn btn-success btn-sm" data-toggle="modal"data-target="#edit{{ $l->id }}"><i class='fa fa-edit'></i></a>

                                        <form action="{{ route('admin.lapangan.destroy', $l->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
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

    <!-- Modal Tambah Data -->
    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Tambah Lapangan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.lapangan.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="nama_lapangan">Nama Lapangan</label>
                            <input type="text" name="nama_lapangan" class="form-control" id="nama_lapangan" required>
                        </div>
                        <div class="form-group">
                            <label for="gambar">Gambar Lapangan</label>
                            <input type="file" name="gambar" class="form-control" id="gambar" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Data -->
    @foreach ($lapangan as $l)
        <div class="modal fade" id="edit{{ $l->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Edit Data</h5>
                        <button type="button" class="btn btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin.lapangan.update', ['lapangan' => $l->id]) }}" method="post" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <label for="nama_lapangan">Nama Lapangan</label>
                                <input type="text" name="nama_lapangan" class="form-control" id="nama_lapangan" value="{{ $l->nama_lapangan }}" required>
                            </div>
                            <div class="form-group">
                                <label for="gambar">Gambar Lapangan</label>
                                <input type="file" name="gambar" id="gambar" class="form-control" onchange="previewImage(this, 'previewEdit{{ $l->id }}')">
                                <img id="previewEdit{{ $l->id }}" src="{{ Storage::url('images/' . $l->gambar) }}" alt="Preview Gambar" style="max-width: 80px; height: 60px; margin-top: 10px;">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Edit</button>
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
@endsection
