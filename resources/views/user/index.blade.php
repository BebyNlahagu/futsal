@extends('layouts.home')

@section('title', 'Halaman Home')
@section('gambar')
    <div class="container-fluid px-0 mb-5">
        <div id="header-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="w-100" src="{{ asset('admin/img/1.jpg') }}" style="height: 30rem;" alt="Image">
                    <div class="carousel-caption">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-7 text-center">
                                    <p class="fs-4 text-white animated zoomIn">Selamat Datang <strong class="text-white">AW
                                            Soccer Park</strong></p>
                                    <h1 class="display-1 text-white mb-4 animated zoomIn">Lihat dan Pilih Paket</h1>
                                    <a href="{{ route('user.paket') }}"
                                        class="btn tombol py-3 px-5 animated zoomIn">Lihat Paket</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<style>
    .star {
        font-size: 30px;
        color: #ccc;
        cursor: pointer;
    }

    .star.selected {
        color: gold;
    }

    .star-rating {
        display: flex;
    }
</style>

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
                            <p class="mb-0" style="text-align: justify;"> Bagi para pecinta sepak bola, bermain sepak bola merupakan kewajiban yang
                                tidak boleh dilewatkan. Menyukai sepak bola tanpa memainkannya serasa ada yang kurang.
                                Namun, datang pula masalah dari minimnya lapangan mini soccer yang tersedia di kota Medan.
                                AW Soccer Park hadir sebagai jawaban para pecinta bola untuk memfasilitasi para penikmat
                                sepak bola. AW Soccer Park merupakan lapangan sepak bola mini yang berada di Jalan Setia
                                Budi Pasar II Kota Medan. Dengan lokasi yang strategis, AW Soccer Park berada di
                                tengah-tengah kota Medan dan mudah dijangkau. Sobat dapat menikmati lapangan rumput dengan
                                kualitas modern yang sangat nyaman. Tidak hanya itu, AW Soccer Park juga menyediakan 1 set
                                rompi yang terdiri dari 8 buah selama permainan berlangsung. Jam operasional AW Soccer Park
                                sendiri mulai dari pukul 06.00-24.00 WIB. Dari segi harga sendiri, AW Soccer menawarkan
                                versi harga yang berbeda sesuai jam dan hari operasionalnya. Harga yang ditawarkan berlaku
                                untuk waktu 1×60 menit permainan dan buka harga mulai dari Rp100.000-Rp350.000. Fasilitas
                                yang tersedia juga tidak kalah dari lapangan bola yang lebih dulu ada, mulai dari bench
                                cadangan pemain dengan kualitas liga profesional dan tribun mini yang tersedia untuk Sobat
                                yang bermain ditemani keluarga, teman, dan juga kekasih. Satu yang tak ketinggalan, AW
                                Soccer Park menyediakan kantin dengan aneka minuman yang beragam. Tunggu apalagi, Sobat yang
                                hobi bermain sepak bola disarankan bermain di AW Soccer Park. Untuk pemesanan lapangan bisa
                                melalui contact person yang tersedia di sosial media AW Soccer Park <a target="_blank"
                                    href="https://www.instagram.com/awsoccerpark">@awsoccerpark</a></p>
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
            <div class="border-top mb-4"></div>
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
                                <a href="https://www.instagram.com/awsoccerpark" target="_blank"><i
                                        class="bi bi-instagram fa-2x text-white"></i></a>
                            </div>
                        </div>
                        <div class="col-md-6 text-center wow fadeInUp" data-wow-delay="0.4s">
                            <div class="btn-square mx-auto mb-3">
                                <a href="https://wa.me/6282134997287" target="_blank"><i
                                        class="bi bi-whatsapp fa-2x text-white"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="border-top mb-4"></div>
            </div>
        </div>
    </div>
    <!-- Contact Start -->

    <!--Rating Dan Comentar-->
    <div class="container-xxl contact  py-5">
        <div class="container">
            <div class="section-title text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <h1 class="display-6">Silahkan Tinggalkan Komentar Anda</h1>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <form action="{{ route('user.rating') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->name }}">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="rating">Rating:</label>
                                <div class="star-rating" id="starRating">
                                    <!-- Icon Bintang -->
                                    <span class="star" data-value="1">&#9733;</span>
                                    <span class="star" data-value="2">&#9733;</span>
                                    <span class="star" data-value="3">&#9733;</span>
                                    <span class="star" data-value="4">&#9733;</span>
                                    <span class="star" data-value="5">&#9733;</span>
                                </div>
                                <!-- Input Hidden untuk Mengirimkan Nilai Rating -->
                                <input type="hidden" name="rating" id="starRatingInput" required>
                            </div>

                            <div class="mb-3">
                                <label for="komentar">Komentar : </label>
                                <textarea name="komentar" class="form-control" id="komentar" cols="30" rows="3"></textarea>
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-info"><i class="fa fa-save"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        @foreach($rating as $review)
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">{{ $review->user->name }}</h5>
                    <div class="star-rating">
                        @for ($i = 1; $i <= 5; $i++)
                            <span class="star {{ $i <= $review->rating ? 'selected' : '' }}">&starf;</span>
                        @endfor
                    </div>
                    <p class="card-text">{{ $review->komentar }}</p>

                    <p class="card-text"><small class="text-muted">Dibuat pada: {{ $review->created_at->format('d M Y H:i') }}</small></p>
                </div>
            </div>
        @endforeach
    </div>

    <style>
        .star {
            font-size: 20px;
            color: #ccc;
        }

        .star.selected {
            color: gold;
        }

        .star-rating {
            display: flex;
        }
    </style>

    <script>
        const stars = document.querySelectorAll('.star');
        const starInput = document.getElementById('starRatingInput');

        stars.forEach(star => {
            star.addEventListener('click', function() {
                const value = this.getAttribute('data-value');
                starInput.value = value;
                highlightStars(value);
            });
        });

        function highlightStars(value) {
            stars.forEach(star => {
                if (star.getAttribute('data-value') <= value) {
                    star.classList.add('selected');
                } else {
                    star.classList.remove('selected');
                }
            });
        }
    </script>


@endsection
