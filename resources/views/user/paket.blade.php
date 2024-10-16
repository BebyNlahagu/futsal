@extends('layouts.home')

@section('title', 'Dartar paket')
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
            <div class="section-title text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <h1 class="display-6">List Harga</h1>
            </div>
            <div class="row g-4 justify-content-center">
                <div class="col-lg-12 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="card shadow-sm border-0"> <!-- Tambahkan shadow dan hilangkan border -->
                        <div class="card-body p-4">
                            <table class="table table-hover table-bordered text-center align-middle"> <!-- Tambahkan table-hover dan align-middle untuk gaya lebih modern -->
                                <thead class="table-dark"> <!-- Ubah header tabel menjadi gelap -->
                                    <tr>
                                        <th>Jam</th>
                                        <th>Harga Hari Biasa</th>
                                        <th>Harga Akhir Pekan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jadwal as $j)
                                        <tr>
                                            <td>{{ $j->jam }}</td>
                                            <td>{{ $j->harga_hari_biasa }}</td>
                                            <td>{{ $j->harga_hari_pekan }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection
