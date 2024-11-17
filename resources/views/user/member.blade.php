@extends('layouts.home')
@section('title','Membership')
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
                    <p class="fs-5 fw-medium fst-italic text-primary">Transaksi</p>
                    <h1 class="display-6">AW Soccer Park</h1>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row g-5 d-flex justify-content-center">
                <div class="col-lg-6 wow fadeIn" data-wow-delay="1">
                    <h3 class="text-center">Buat Transaksi</h3>
                </div>
            </div>
            <div class="row g-5 d-flex justify-content-center">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card mb-4">
                            <div
                                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6>
                                <button type="button" class="btn btn-primary ms-auto" data-bs-toggle="modal"
                                    data-bs-target="#staticBackdrop">
                                    + ADD
                                </button>
                            </div>
                            <div class="table-responsive p-3">
                                <table class="table align-items-center table-flush" id="lapanganTable">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>ID</th>
                                            <th>User</th>
                                            <th>Jadwal</th>
                                            <th>Tanggal Pesan</th>
                                            <th>Tanggal Mulai</th>
                                            <th>Tanggal Berakhir</th>
                                            <th>Jenis Paket</th>
                                            <th>Durasi</th>
                                            <th>Harga</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach ($member as $m)
                                            <td>{{ $no++ }}</td>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
