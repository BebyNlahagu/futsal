@extends('layouts.user')

@section('title', 'Halaman Home')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@section('gambar')
    <div class="container-fluid px-0 mb-5">
        <div id="header-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="w-100" src="{{ asset('admin/img/1.jpg') }}" style="height: 30rem" alt="Image">
                    <div class="carousel-caption">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-7 text-center">
                                    <p class="fs-4 text-white animated zoomIn"
                                        style="font-family: 'Akaya Kanadaka', system-ui;">Selamat Datang <strong
                                            class="text-white">Aw Soccer Park</strong></p>
                                    <h1 class="display-1 text-white mb-4 animated zoomIn">Lihat dan Pilih Paket</h1>
                                    <a href="{{ route('halaman.paket') }}"
                                        class="btn tombol py-3 px-5 animated zoomIn">Lihat paket</a>
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
                            <img class="img-fluid bg-white w-100" src="{{ asset('admin/img/bg.jpg') }}" alt="">
                        </div>
                        <div class="col-sm-8">
                            <h5>Lapangan Nyaman dan Menyenangkan Bagi Pemain</h5>
                            <p class="mb-0" style="text-align: justify">Bagi para pecinta sepak bola, bermain sepak bola
                                merupakan kewajiban yang tidak boleh dilewatkan. Menyukai sepak bola tanpa memainkannya
                                serasa ada yang kurang. Namun, datang pula masalah dari minimnya lapangan mini soccer yang
                                tersedia di kota Medan.
                                AW Soccer Park hadir sebagai jawaban para pecinta bola untuk memfasilitasi para penikmat
                                sepak bola. AW Soccer Park merupakan lapangan sepak bola mini yang berada di Jalan Setia
                                Budi Pasar II Kota Medan. Dengan lokasi yang strategis, AW Soccer Park berada di
                                tengah-tengah kota Medan dan mudah dijangkau.
                                Sobat dapat menikmati lapangan rumput dengan kualitas modern yang sangat nyaman. Tidak hanya
                                itu, AW Soccer Park juga menyediakan 1 set rompi yang terdiri dari 8 buah selama permainan
                                berlangsung. Jam operasional AW Soccer Park sendiri mulai dari pukul 06.00-24.00 WIB.
                                Dari segi harga sendiri, AW Soccer menawarkan versi harga yang berbeda sesuai jam dan hari
                                operasionalnya. Harga yang ditawarkan berlaku untuk waktu 1×60 menit permainan dan buka
                                harga mulai dari Rp100.000-Rp350.000.
                                Fasilitas yang tersedia juga tidak kalah dari lapangan bola yang lebih dulu ada, mulai dari
                                bench cadangan pemain dengan kualitas liga profesional dan tribun mini yang tersedia untuk
                                Sobat yang bermain ditemani keluarga, teman, dan juga kekasih. Satu yang tak ketinggalan, AW
                                Soccer Park menyediakan kantin dengan aneka minuman yang beragam.
                                Tunggu apalagi, Sobat yang hobi bermain sepak bola disarankan bermain di AW Soccer Park.
                                Untuk pemesanan lapangan bisa melalui contact person yang tersedia di sosial media AW Soccer
                                Park @awsoccerpark</p>
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
                        <img class="img-fluid" src="{{ asset('admin/img/aw.jpg') }}" alt="">
                        <div class="p-4">
                            <h4 class="mb-3">Aw Soccer Park</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Store End -->

    <div class="container-fluid testimonial py-5">
        <div class="container">
            <div class="section-title text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <p class="fs-5 fw-medium fst-italic text-primary">Testimoni</p>
                <h1 class="display-6">Apa Yang Mereka Katakan</h1>
            </div>
            <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.5s">
                @foreach ($nilai as $n)
                    <div class="testimonial-item p-4 p-lg-5">
                        <h5>{{ $n->user->name }}</h5>
                        <div class="d-flex align-items-center justify-content-center">
                            <div class="col-md-2 justify-content-center align-items-center">
                                <img class="img-fluid flex-shrink-0" src="{{ Storage::url($n->user->img) }}"
                                    alt="Foto Profil {{ $n->user->name }}">
                            </div>
                            <div class="col-md-8 text-center">
                                <div class="text-start ms-3">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $n->rating)
                                            <span class="text-primary"><i class="fas fa-star"></i></span>
                                        @else
                                            <span><i class="far fa-star"></i></span>
                                        @endif
                                    @endfor
                                    <p class="mb-4" style="font-style: italic;">"{{ $n->komentar }}"</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Contact Start -->
    <div class="container-xxl contact py-5">
        <div class="container">
            <div class="section-title text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <p class="fs-5 fw-medium fst-italic text-primary">Hubungin Kami</p>
                <h1 class="display-6">Silahkan Hubungi kami</h1>
            </div>
            <p class="text-center mb-5">Kami Dengan Ramah Mendengarkan Suara Anda</p>
            <div class="d-flex justify-content-center gap-4 wow fadeInUp" data-wow-delay="0.1s">
                <div class="text-center">
                    <div class="btn-square mb-3">
                        <a href="https://www.instagram.com/awsoccerpark" target="_blank"><i class="bi bi-instagram fa-2x text-white"></i></a>
                    </div>
                </div>
                <div class="text-center">
                    <div class="btn-square mb-3">
                        <a href="tel:082134997287" target="_blank"><i class="fa fa-phone-alt fa-2x text-white"></i></a>
                    </div>
                </div>
                <div class="text-center">
                    <div class="btn-square mb-3">
                        <a href="https://wa.me/6282134997287" target="_blank"><i class="bi bi-whatsapp fa-2x text-white"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Contact Start -->

@endsection
