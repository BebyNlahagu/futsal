@extends('layouts.home')

@section('title','Halaman Home')
@section('gambar')
<div class="container-fluid px-0 mb-5">
    <div id="header-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="w-100" src="{{  asset('admin/img/1.jpg')}}" alt="Image">
                <div class="carousel-caption">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7 text-center">
                                <p class="fs-4 text-white animated zoomIn">Selamat Datang <strong class="text-white">Futsal Selayang</strong></p>
                                <h1 class="display-1 text-white mb-4 animated zoomIn">Lihat dan Pilih Paket</h1>
                                <a href="{{ route('user.paket') }}" class="btn btn-light rounded-pill py-3 px-5 animated zoomIn">Lihat Paket</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<!-- About Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-12 wow fadeIn" data-wow-delay="0.5s">
                <div class="section-title">
                    <p class="fs-5 fw-medium fst-italic text-primary">Tentang Kami</p>
                    <h1 class="display-6">AW Soccer Park</h1>
                </div>
                <div class="row g-3 mb-4">
                    <div class="col-sm-4">
                        <img class="img-fluid bg-white w-100" src="{{  asset('admin/img/bg.jpg')}}" alt="">
                    </div>
                    <div class="col-sm-8">
                        <h5>Lapangan Nyaman dan Menyenangkan Bagi Pemain</h5>
                        <p class="mb-0"> Perkembangan futsal di Kota Medan tidak lepas dari pengaruh perkembangan futsal di Jakarta, hal ini disebabkan Jakarta masih menjadi barometer bagi daerah- daerah lainnya di Indonesia. Setelah futsal masuk dan berkembang di Indonesia pada tahun 2004, Kota Medan juga turut mengembangkan olahraga futsal melalui kehadiran lapangan futsal sebagai sarana untuk latihan dan bertanding serta melalui kemampuan pemain futsal yang pada awalnya merupakan pemain sepakbola, dengan adanya kehadiran pemain sepakbola dalam perkembangan futsal hal ini menjadikan futsal dengan cepat berkembang dikalangan anak muda Kota Medan. Hal ini terjadi karena pengguna atau pemain olahraga futsal tidak lain adalah para anak anak remaja terutama mahasiswa maupun pelajar tingkat pendidikan lainnya.</p>
                    </div>
                </div>
                <div class="border-top mb-4"></div>
            </div>
        </div>
    </div>
</div>
<!-- About End -->

<!-- Store Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="section-title text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
            <p class="fs-5 fw-medium fst-italic text-primary">View Lapangan</p>
            <h1 class="display-6"></h1>
        </div>
        <div class="row g-4 d-flex justify-content-center">
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="store-item justify-center position-relative text-center">
                    <img class="img-fluid" src="{{  asset('admin/img/aw.jpg')}}" alt="">
                    <div class="p-4">
                        <h4 class="mb-3">Aw Soccer Park</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Store End -->

<!-- Contact Start -->
<div class="container-xxl contact py-5">
    <div class="container">
        <div class="section-title text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
            <p class="fs-5 fw-medium fst-italic text-primary">Hubungin Kami</p>
            <h1 class="display-6">Silahkan Hubungi kami</h1>
        </div>
        <div class="row justify-content-center wow fadeInUp" data-wow-delay="0.1s">
            <div class="col-lg-6">
                <p class="text-center mb-5">Kami Dengan Ramah Mendengarkan Suara Anda</p>
                <div class="row g-5">
                    <div class="col-md-6 text-center wow fadeInUp" data-wow-delay="0.3s">
                        <div class="btn-square mx-auto mb-3">
                            <a href="https://www.instagram.com/awsoccerpark" target="_blank"><i class="bi bi-instagram fa-2x text-white"></i></a>
                        </div>
                    </div>
                    <div class="col-md-6 text-center wow fadeInUp" data-wow-delay="0.4s">
                        <div class="btn-square mx-auto mb-3">
                            <a href="https://wa.me/6282134997287" target="_blank"><i class="bi bi-whatsapp fa-2x text-white"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Contact Start -->

@endsection

