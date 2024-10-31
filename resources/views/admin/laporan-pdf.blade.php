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
        }
        .header h2 {
            margin: 0;
            font-size: 24px;
            color: #007bff;
        }
        .header p {
            margin: 0;
            font-size: 14px;
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
            background-color: #f8f9fc;
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
    </style>
</head>
<body>
    <div class="header">
        <h2>Laporan Transaksi</h2>
        <p>
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
        </p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>User</th>
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
                    <td>{{ $t->tanggal_main }}</td>
                    <td class="text-right">Rp.{{ number_format($t->total, 0, ',', '.') }},-</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="3" class="text-center">Jumlah Total</td>
                <td class="text-right bold">Rp.{{ number_format($totalHarga, 0, ',', '.') }},-</td>
            </tr>
        </tbody>
    </table>
</body>
</html>
