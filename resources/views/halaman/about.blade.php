@extends('layouts.user')

@section('title','Tentang kami')
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
                    <p class="fs-5 fw-medium fst-italic text-primary">Tentang Kami</p>
                    <h1 class="display-6">AW Soccer Park</h1>
                </div>
                <div class="row g-3 mb-4">
                    <div class="col-sm-4">
                        <img class="img-fluid bg-white w-100" src="{{  asset('admin/img/bg.jpg')}}" alt="">
                    </div>
                    <div class="col-sm-8">
                        <h5>Lapangan Nyaman dan Menyenangkan Bagi Pemain</h5>
                        <p class="mb-0" style="text-align: justify;">Bagi para pecinta sepak bola, bermain sepak bola merupakan kewajiban yang tidak boleh dilewatkan. Menyukai sepak bola tanpa memainkannya serasa ada yang kurang. Namun, datang pula masalah dari minimnya lapangan mini soccer yang tersedia di kota Medan.
                            AW Soccer Park hadir sebagai jawaban para pecinta bola untuk memfasilitasi para penikmat sepak bola. AW Soccer Park merupakan lapangan sepak bola mini yang berada di Jalan Setia Budi Pasar II Kota Medan. Dengan lokasi yang strategis, AW Soccer Park berada di tengah-tengah kota Medan dan mudah dijangkau.
                            Sobat dapat menikmati lapangan rumput dengan kualitas modern yang sangat nyaman. Tidak hanya itu, AW Soccer Park juga menyediakan 1 set rompi yang terdiri dari 8 buah selama permainan berlangsung. Jam operasional AW Soccer Park sendiri mulai dari pukul 06.00-24.00 WIB.
                            Dari segi harga sendiri, AW Soccer menawarkan versi harga yang berbeda sesuai jam dan hari operasionalnya. Harga yang ditawarkan berlaku untuk waktu 1×60 menit permainan dan buka harga mulai dari Rp100.000-Rp350.000.
                            Fasilitas yang tersedia juga tidak kalah dari lapangan bola yang lebih dulu ada, mulai dari bench cadangan pemain dengan kualitas liga profesional dan tribun mini yang tersedia untuk Sobat yang bermain ditemani keluarga, teman, dan juga kekasih. Satu yang tak ketinggalan, AW Soccer Park menyediakan kantin dengan aneka minuman yang beragam.
                            Tunggu apalagi, Sobat yang hobi bermain sepak bola disarankan bermain di AW Soccer Park. Untuk pemesanan lapangan bisa melalui contact person yang tersedia di sosial media AW Soccer Park @awsoccerpark</p>
                    </div>
                </div>
                <div class="border-top mb-4"></div>
            </div>
        </div>
    </div>
</div>

<div class="container-xxl contact py-5">
    <div class="container">
        <div class="section-title text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
            <p class="fs-5 fw-medium fst-italic text-primary">Kontak Kami</p>
            <h1 class="display-6">Jika Ada Pertanyaan Silahkan Hubungi Kami</h1>
        </div>
        <div class="row g-5 mb-5">
            <div class="col-md-3 text-center wow fadeInUp" data-wow-delay="0.3s">
                <div class="btn-square mx-auto mb-3">
                    <i class="bi bi-instagram fa-2x text-white"></i>
                </div>
                <p class="mb-2">Aw soccer Park</p>
            </div>
            <div class="col-md-3 text-center wow fadeInUp" data-wow-delay="0.4s">
                <div class="btn-square mx-auto mb-3">
                    <i class="fa fa-phone-alt fa-2x text-white"></i>
                </div>
                <p class="mb-0">+6282134997287</p>
            </div>
            <div class="col-md-3 text-center wow fadeInUp" data-wow-delay="0.4s">
                <div class="btn-square mx-auto mb-3">
                    <i class="bi bi-whatsapp fa-2x text-white"></i>
                </div>
                <p class="mb-0">+6282134997287</p>
            </div>
            <div class="col-md-3 text-center wow fadeInUp" data-wow-delay="0.5s">
                <div class="btn-square mx-auto mb-3">
                    <i class="fa fa-map-marker-alt fa-2x text-white"></i>
                </div>
                <p class="mb-2">Jl. Setia Budi Ps. II, Tj. Sari, Kec. Medan Selayang, Kota Medan, Sumatera Utara 20132</p>
            </div>
        </div>
        <div class="row g-5">
            <div class="col-lg-12 wow fadeInUp" data-wow-delay="0.5s">
                <div class="h-100">
                    <iframe class="w-100 rounded" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3982.1415191567107!2d98.6309371!3d3.5548466999999997!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30312feab86af897%3A0x50fa071ab47e292a!2sAW%20Soccer%20Park!5e0!3m2!1sen!2sid!4v1728710895444!5m2!1sen!2sid"  style="height: 100%; min-height: 300px; border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
