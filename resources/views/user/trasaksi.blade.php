@extends('layouts.home')

@section('title','Transaksi')
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
                    <p class="fs-5 fw-medium fst-italic text-primary">Trasaksi</p>
                    <h1 class="display-6">AW Soccer Park</h1>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row g-5 d-flex justify-content-center">
                <div class="col-lg-6 wow fadeIn" data-wow-delay="1">
                    <h3 class="text-center">Buat Transaksi</h3>
                    <form action="" method="post">
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control" name="nama" id="nama">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
