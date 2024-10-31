@extends('layouts.admin')

@section('title', 'Data Transaksi')
@section('name')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">@yield('title')</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">@yield('title')</li>
        </ol>
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6>
                    <a class="btn" style="background: greenyellow;" href="{{ route('admin.pdf') }}"><i class="fa fa-download"> Cetak</i></a>
                </div>
                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush" id="dataTable">
                        <thead class="thead-light">
                            <tr>
                                <th>Id</th>
                                <th>User</th>
                                <th>Jadwal</th>
                                <th>Tanggal Main</th>
                                <th>Durasi</th>
                                <th>Harga Total</th>
                                <th>DP</th>
                                <th>Jumlah Bayar</th>
                                <th>Sisa Bayar</th>
                                <th>Status</th>
                                <th>Bukti Pembayaran</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($bayars as $t)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $t->user->name }}</td>
                                    <td>{{ $t->jadwal->jam }}</td>
                                    <td>{{ $t->tanggal_main }}</td>
                                    <td>{{ $t->durasi }} Jam</td>
                                    <td>{{ number_format($t->total, 0, ',', '.') }}</td>
                                    <td>{{ number_format($t->dp, 0, ',', '.') }}</td>
                                    <td>{{ number_format($t->bayar, 0, ',', '.') }}</td>
                                    <td>{{ number_format($t->sisa, 0, ',', '.') }}</td>
                                    <td>{{ $t->status }}</td>
                                    <td>
                                        @if ($t->bukti_pembayaran)
                                            <img src="{{ asset('storage/' . $t->bukti_pembayaran) }}" alt=""
                                                style="width: 50px" height="auto">
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

@endsection
