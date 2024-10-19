@extends('layouts.home')
@section('title','Halaman Profil')
@section('gambar')
<div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container text-center py-5">
        <h1 class="display-2 text-white mb-4 animated slideInDown">@yield('title')</h1>
    </div>
</div>
@endsection

@section('content')
<div class="container-xxl contact py-5">
    <div class="container">
        <div class="section-title text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
            <p class="fs-5 fw-medium fst-italic text-primary">Ganti Profil</p>
            <h1 class="display-6">Silahkan Update Profilmu</h1>
        </div>
        <div class="row g-5">
            <div class="col-lg-12 wow fadeInUp" data-wow-delay="0.1s">
                <h3 class="mb-4">Isikan Form Di bawah Ini</h3>
                <form action="{{ route('user.data.update', Auth::user()->id) }}" method="post" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="form-floating">
                                <input type="file" class="form-control" name="img" id="img" accept="image/*" onchange="previewImage(event)">
                                <label for="img">Foto Profil</label>
                            </div>
                            <div class="mt-3">
                                <img id="imgPreview" src="#" alt="Image preview"
                                    style="display: none; max-width: 50%; height: 50%;">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}">
                                <label for="name">Nama</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}">
                                <label for="email">Email</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="{{ Auth::user()->tempat_lahir }}">
                                <label for="tempat_lahir">Tempat Lahir</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="{{ Auth::user()->tanggal_lahir }}">
                                <label for="tanggal_lahir">Tanggal Lahir</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <textarea class="form-control" name="alamat" id="alamat" style="height: 100px">{{ Auth::user()->alamat }}</textarea>
                                <label for="alamat">Alamat</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="no_hp" name="no_hp" value="{{ Auth::user()->no_hp }}">
                                <label for="no_hp">No. Hp/WA</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary rounded-pill py-3 px-5" type="submit">Update Profil</button>
                        </div>
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
