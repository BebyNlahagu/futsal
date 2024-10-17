@extends('layouts.bayar')
@section('title', 'Profile')
@section('name')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">@yield('title')</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('kasir.index') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">@yield('title')</li>
        </ol>
    </div>
@endsection
@section('content')
    <div class="row mb-3">
        <div class="col-xl-4 col-lg-5">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold align-items-center text-primary">Profile</h6>
                </div>
                <div class="card-body py-3 d-flex flex-column align-items-center justify-content-center text-center">
                    <img src="{{ Storage::url(Auth::user()->img) }}" alt="User profile picture" class="rounded-circle"
                        style="width: 150px; height: 150px; object-fit: cover; box-shadow: 0 6px 12px rgba(0, 0, 0, 0.4);">
                    <h3 class="mt-3">
                        {{ Auth::user()->name }}
                    </h3>
                    <div class="d-flex justify-content-center">
                        <a href="https://wa.me/1234567890" target="_blank" class="text-decoration-none"
                            style="margin-right: 20px;">
                            <i class="fab fa-whatsapp fa-2x"></i>
                        </a>
                        <a href="https://instagram.com/username" target="_blank" class="text-decoration-none"
                            style="margin-right: 20px;">
                            <i class="fab fa-instagram fa-2x"></i>
                        </a>
                        <a href="mailto:example@example.com" class="text-decoration-none">
                            <i class="fas fa-envelope fa-2x"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-8 col-lg-7 mb-4">
            <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Edit Profile</h6>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="{{ route('profil.update', Auth::user()->id) }}" method="post"
                        enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <div class="form-group row">
                            <label for="img" class="col-sm-3 col-form-label">Foto Profil</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control" name="img" id="img" accept="image/*"
                                    onchange="previewImage(event)">
                                <div class="mt-3">
                                    <img id="imgPreview" src="#" alt="Image preview"
                                        style="display: none; max-width: 50%; height: 50%;">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-sm-3 col-form-label">Nama</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="name" id="name"
                                    value="{{ Auth::user()->name }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="email" id="email"
                                    value="{{ Auth::user()->email }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tempat_lahir" class="col-sm-3 col-form-label">Tempat Lahir</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir"
                                    value="{{ Auth::user()->tempat_lahir }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tanggal_lahir" class="col-sm-3 col-form-label">Tanggal Lahir</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir"
                                    value="{{ Auth::user()->tanggal_lahir }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                            <div class="col-sm-9">
                                <textarea name="alamat" class="form-control" id="alamat" cols="30" rows="3">{{ Auth::user()->alamat }}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="no_hp" class="col-sm-3 col-form-label">No Handpone</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="no_hp" id="no_hp"
                                    value="{{ Auth::user()->no_hp }}">
                            </div>
                        </div>
                        <div class="d-flex justify-content-end mt-3">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function previewImage(event) {
            const input = event.target;
            const file = input.files[0];
            const preview = document.getElementById('imgPreview');

            if (file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };

                reader.readAsDataURL(file);
            } else {
                preview.src = '#';
                preview.style.display = 'none';
            }
        }
    </script>

@endsection
