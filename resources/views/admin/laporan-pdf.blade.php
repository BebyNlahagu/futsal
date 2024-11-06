<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Transaksi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            position: relative;
        }
        .logo {
            position: absolute;
            left: 50px;
            top: -5px;
            width: 80px;
        }
        .kop-surat {
            text-align: center;
        }
        .kop-surat h2 {
            margin: 0;
            font-size: 3rem;
            color: #08b430;
            font-weight: bold
        }
        .kop-surat p {
            margin: 0;
            font-size: 1rem;
            color: #555;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #08b430;
            text-align: left;
            font-weight: bold;
            color: #333;
        }
        td {
            text-align: left;
            color: #555;
        }
        .text-center {
            text-align: center;
        }
        .text-right {
            text-align: right;
        }
        .signature {
            margin-top: 40px;
            text-align: right;
            padding-right: 20px;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo">
            <img src="{{ public_path('masuk/futsal.png') }}" alt="Logo" style="width: 150%;">
        </div>
        <div class="kop-surat" style="padding-left: 5rem;">
            <h2>Aw Soccer Park</h2>
            <p>Alamat: Jl. Setia Budi Ps. II, Tj. Sari, Kec. Medan Selayang, <br>Kota Medan, Sumatera Utara 20132 <br>HP/WA: +6282134997287 </p>
        </div>
    </div>

    <hr style="height: 2px solid black">

    <div class="header">
        <h2 style="font-weight: bold;">Laporan Transaksi</h2>
        @if(request()->has('bulan') || request()->has('tahun') || request()->has('hari'))
            Filter:
            @if(request()->has('bulan'))
                Bulan: {{ date("F", mktime(0, 0, 0, request('bulan'), 1)) }}
            @endif
            @if(request()->has('tahun'))
                Tahun: {{ request('tahun') }}
            @endif
            @if(request()->has('hari'))
                Hari: {{ request('hari') }}
            @endif
        @else
            Semua Data
        @endif
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>User</th>
                <th>No Hp</th>
                <th>Tanggal Main</th>
                <th>Harga Total</th>
            </tr>
        </thead>
        <tbody>
            @php
                $no = 1;
                $totalHarga = 0;
            @endphp
            @foreach ($bayar as $t)
            @php
                $totalHarga += $t->total;
            @endphp
                <tr>
                    <td class="text-center">{{ $no++ }}</td>
                    <td>{{ $t->user->name }}</td>
                    <td>{{ $t->user->no_hp }}</td>
                    <td>{{ $t->user->alamat }}</td>
                    <td>{{ $t->tanggal_main }}</td>
                    <td class="text-right">Rp.{{ number_format($t->total, 0, ',', '.') }},-</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="4" class="text-center">Jumlah Total</td>
                <td class="text-right" style="font-weight: 900;">Rp. {{ number_format($totalHarga, 0, ',', '.') }} ,-</td>
            </tr>
        </tbody>
    </table>

    <div class="signature">
        <p style="padding-right:6rem;">Medan, {{ date('d-m-Y') }}</p>
        <p style="padding-right: 5.5rem;">Penanggung Jawab,</p>
        <br><br>
        <p style="padding-right: 9rem; font-weight:bold;"><u>{{ $user->name }}</u></p>
    </div>
</body>
</html>
