@extends('layouts.home')

@section('title','Daftar Paket')
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

        <!-- Form Filter Tanggal -->
        <form action="{{ route('user.paket') }}" method="GET" class="mb-4 text-center">
            <label for="tanggal_main" class="form-label">Pilih Tanggal:</label>
            <input type="date" id="tanggal_main" name="tanggal_main" value="{{ $tanggal_main }}" class="form-control w-auto d-inline">
            <button type="submit" class="btn btn-primary">Filter</button>
        </form>

        <!-- Tampilkan tanggal yang dipilih -->
        <h4 class="text-center">Tanggal: {{ \Carbon\Carbon::parse($tanggal_main)->format('d-m-Y') }}</h4>

        <div class="row g-4 justify-content-center">
            <div class="col-lg-12 wow fadeInUp" data-wow-delay="0.7s">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">
                        <table class="table table-hover table-bordered text-center align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th>Jam</th>
                                    <th>Harga Hari Biasa</th>
                                    <th>Harga Akhir Pekan</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jadwal as $j)
                                    <tr>
                                        <td>{{ $j->jam }}</td>
                                        <td>{{ $j->harga_hari_biasa }}</td>
                                        <td>{{ $j->harga_hari_pekan }}</td>
                                        <td>
                                            @if($j->bayar->isNotEmpty())
                                                <span class="badge bg-success">Terboking</span>
                                            @else
                                                <span class="badge bg-danger">Tersedia</span>
                                            @endif
                                        </td>
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
