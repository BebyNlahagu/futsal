@extends('layouts.admin')
@section('content')
    <div class="row mb-3">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6>
                    <form action="{{ route('admin.laporan') }}" method="GET" class="d-flex">
                        <select name="bulan" class="form-control mr-2">
                            <option value="">Pilih Bulan</option>
                            @for ($i = 1; $i <= 12; $i++)
                                <option value="{{ $i }}">{{ date("F", mktime(0, 0, 0, $i, 1)) }}</option>
                            @endfor
                        </select>
                        <select name="tahun" class="form-control mr-2">
                            <option value="">Pilih Tahun</option>
                            @for ($i = now()->year; $i >= 2000; $i--)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                        <input type="date" name="hari" class="form-control mr-2" placeholder="Pilih Hari">
                        <button type="submit" class="btn btn-primary">Filter</button>
                        <a class="btn ml-2" style="background: greenyellow;"
                            href="{{ route('admin.laporan-pdf', request()->query()) }}"><i class="fa fa-download"> Cetak</i></a>
                    </form>
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
                            @php $no = 1; @endphp
                            @foreach ($bayar as $t)
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
