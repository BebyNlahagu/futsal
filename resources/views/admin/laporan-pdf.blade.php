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
                <th>Jadwal</th>
                <th>Tanggal Main</th>
                <th>Durasi</th>
                <th>Harga Total</th>
                <th>DP</th>
                <th>Jumlah Bayar</th>
                <th>Sisa Bayar</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach ($bayar as $t)
                <tr>
                    <td class="text-center">{{ $no++ }}</td>
                    <td>{{ $t->user->name }}</td>
                    <td>{{ $t->jadwal->jam }}</td>
                    <td>{{ $t->tanggal_main }}</td>
                    <td>{{ $t->durasi }} Jam</td>
                    <td class="text-right">{{ number_format($t->total, 0, ',', '.') }}</td>
                    <td class="text-right">{{ number_format($t->dp, 0, ',', '.') }}</td>
                    <td class="text-right">{{ number_format($t->bayar, 0, ',', '.') }}</td>
                    <td class="text-right">{{ number_format($t->sisa, 0, ',', '.') }}</td>
                    <td>{{ $t->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
