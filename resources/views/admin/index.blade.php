@extends('layouts.admin')

@section('title', 'Halaman Admin')
@section('name')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
        </ol>
    </div>
@endsection
@section('content')
    <div class="row mb-3">
        <!-- Earnings (Annual) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Total Transaksi</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. {{ number_format($total) }},-</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Earnings (Annual) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Pelanggan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jumlahuser }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- New User Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Trasaksi</div>
                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $transaksi }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-people fa-2x text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Pending Requests Card Example -->

        <div class="col-xl-12 col-lg-7">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Rekap Laporan Transaksi</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Filtern:</div>
                            <a class="dropdown-item filter-option" data-value="harian">Harian</a>
                            <a class="dropdown-item filter-option" data-value="bulanan">Bulanan</a>
                            <a class="dropdown-item filter-option" data-value="tahunan">Tahunan</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="myAreaChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var transaksiBulanan = @json($transaksi_bulanan);
            var transaksiHarian = @json($transaksi_harian);
            var transaksiTahunan = @json($transaksi_tahunan);

            var labelsBulan = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
            var labelsTahun = Array.from({
                length: 6
            }, (_, i) => (new Date().getFullYear() - 5 + i).toString());

            // Fungsi untuk mendapatkan jumlah hari dalam bulan
            function getDaysInMonth(month, year) {
                return new Date(year, month, 0).getDate();
            }

            // Buat label hari berdasarkan bulan saat ini
            var currentYear = new Date().getFullYear();
            var currentMonth = new Date().getMonth() + 1; // Januari = 1
            var labelsHari = Array.from({
                length: getDaysInMonth(currentMonth, currentYear)
            }, (_, i) => (i + 1).toString());

            var ctx = document.getElementById("myAreaChart").getContext('2d');
            var myAreaChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labelsBulan, // Label awal (bulan)
                    datasets: [{
                        label: "Total Transaksi",
                        data: transaksiBulanan, // Data awal (bulanan)
                        backgroundColor: "rgba(78, 115, 223, 0.2)",
                        borderColor: "rgba(78, 115, 223, 1)",
                        fill: true,
                        lineTension: 0.3,
                        pointRadius: 3,
                        pointBackgroundColor: "rgba(78, 115, 223, 1)",
                        pointBorderColor: "rgba(78, 115, 223, 1)",
                        pointHoverRadius: 3,
                        pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                        pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                        pointHitRadius: 10,
                        pointBorderWidth: 2,
                    }],
                },
                options: {
                    maintainAspectRatio: false,
                    scales: {
                        xAxes: [{
                            time: {
                                unit: 'month' // Set awal sebagai bulanan
                            },
                            gridLines: {
                                display: false,
                                drawBorder: false
                            },
                            ticks: {
                                maxTicksLimit: 12
                            }
                        }],
                        yAxes: [{
                            ticks: {
                                maxTicksLimit: 5,
                                padding: 10,
                                callback: function(value, index, values) {
                                    return 'Rp' + value.toLocaleString();
                                }
                            },
                            gridLines: {
                                color: "rgba(234, 236, 244, 1)",
                                zeroLineColor: "rgba(234, 236, 244, 1)",
                                drawBorder: false,
                            }
                        }],
                    },
                }
            });

            // Event listener untuk filter harian, bulanan, dan tahunan
            document.querySelectorAll('.filter-option').forEach(function(item) {
                item.addEventListener('click', function() {
                    var filter = this.getAttribute('data-value');
                    updateChart(filter);
                });
            });

            // Fungsi untuk update chart berdasarkan filter
            function updateChart(filter) {
                var newLabels, newData;

                if (filter === 'harian') {
                    // Update label harian sesuai dengan bulan saat ini
                    var daysInCurrentMonth = getDaysInMonth(currentMonth, currentYear);
                    newLabels = Array.from({
                        length: daysInCurrentMonth
                    }, (_, i) => (i + 1).toString());
                    newData = transaksiHarian;
                } else if (filter === 'bulanan') {
                    newLabels = labelsBulan;
                    newData = transaksiBulanan;
                } else if (filter === 'tahunan') {
                    newLabels = labelsTahun;
                    newData = transaksiTahunan;
                }

                // Update label dan data chart
                myAreaChart.data.labels = newLabels;
                myAreaChart.data.datasets[0].data = newData;
                myAreaChart.update();
            }
        });
    </script>

@endsection
