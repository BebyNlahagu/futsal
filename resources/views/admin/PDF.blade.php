<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Transaksi</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Menambahkan border untuk elemen tabel */
        table.table {
            border-collapse: collapse;
            width: 100%;
        }

        table.table,
        table.table th,
        table.table td {
            border: 1px solid #000 !important;
        }

        /* Style untuk tampilan cetak */
        @media print {
            .table-bordered {
                border: 1px solid #000;
            }
            .table-bordered th,
            .table-bordered td {
                border: 1px solid #000;
            }
        }
    </style>
</head>

<body>

    <div class="container my-4">
        <h2 class="text-center mb-4">Data Transaksi</h2>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>User</th>
                        <th>Jadwal</th>
                        <th>Tanggal Main</th>
                        <th>Durasi</th>
                        <th>Harga Total</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @forelse ($bayar as $index => $t)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $t->user->name }}</td>
                            <td>{{ $t->jadwal->jam }}</td>
                            <td>{{ $t->tanggal_main }}</td>
                            <td>{{ $t->durasi }} Jam</td>
                            <td>Rp {{ number_format($t->total, 0, ',', '.') }}</td>
                            <td>
                                <span class="badge {{ $t->status == 'Lunas' ? 'bg-success' : 'bg-warning' }}">
                                    {{ $t->status }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Data tidak tersedia</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
