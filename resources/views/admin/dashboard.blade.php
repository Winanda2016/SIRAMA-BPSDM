@extends('admin.themes.app')
@section('content')
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Dashboard</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-xl-2 col-lg-6">
            <div class="card">
                <div class="card-body p-2">
                    <span class="text-muted mb-2 lh-1 d-block text-truncate">Kamar kosong</span>
                    <div class="d-flex align-items-center overflow-hidden">
                        <div class="flex-shrink-0 me-3">
                            <div class="avatar">
                                <div class="avatar-title rounded bg-success bg-gradient">
                                    <i class="fas fa-user-check"></i>
                                </div>
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <h2 class="text-muted mb-0">{{ $totalKKosong }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-2 col-lg-6">
            <div class="card">
                <div class="card-body p-2">
                    <span class="text-muted mb-2 lh-1 d-block text-truncate">Kamar Terisi</span>
                    <div class="d-flex align-items-center overflow-hidden">
                        <div class="flex-shrink-0 me-3">
                            <div class="avatar">
                                <div class="avatar-title rounded bg-danger bg-gradient">
                                    <i class="fas fa-user-clock"></i>
                                </div>
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <h2 class="text-muted mb-0">{{ $totalKTerisi }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-2 col-lg-6">
            <div class="card">
                <div class="card-body p-2">
                    <span class="text-muted mb-2 lh-1 d-block text-truncate">Kamar Reservasi</span>
                    <div class="d-flex align-items-center overflow-hidden">
                        <div class="flex-shrink-0 me-3">
                            <div class="avatar">
                                <div class="avatar-title rounded bg-warning bg-gradient">
                                    <i class="fas fa-tags"></i>
                                </div>
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <h2 class="text-muted mb-0">{{ $totalKReservasi }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-2 col-lg-6">
            <div class="card">
                <div class="card-body p-2">
                    <span class="text-muted mb-2 lh-1 d-block text-truncate">Kamar Perbaikan</span>
                    <div class="d-flex align-items-center overflow-hidden">
                        <div class="flex-shrink-0 me-3">
                            <div class="avatar">
                                <div class="avatar-title rounded bg-secondary bg-gradient">
                                    <i class="fas fa-cogs"></i>
                                </div>
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <h2 class="text-muted mb-0">{{ $totalKPerbaikan }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-xl-2 col-lg-6">
            <div class="card">
                <div class="card-body p-2">
                    <span class="text-muted mb-2 lh-1 d-block text-truncate">Total Transaksi Kamar</span>
                    <div class="d-flex align-items-center overflow-hidden">
                        <div class="flex-shrink-0 me-3">
                            <div class="avatar">
                                <div class="avatar-title rounded bg-info bg-gradient">
                                    <i class=" fas fa-file-invoice "></i>
                                </div>
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <h2 class="text-muted mb-0">{{ $totalTransaksiKamar }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-2 col-lg-6">
            <div class="card">
                <div class="card-body p-2">
                    <span class="text-muted mb-2 lh-1 d-block text-truncate">Total Transaksi Ruangan</span>
                    <div class="d-flex align-items-center overflow-hidden">
                        <div class="flex-shrink-0 me-3">
                            <div class="avatar">
                                <div class="avatar-title rounded bg-primary bg-gradient">
                                    <i class=" fas fa-file-invoice-dollar "></i>
                                </div>
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <h2 class="text-muted mb-0">{{ $totalTransaksiRuangan }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div><!-- end row-->

    <div class="row">
        <div class="col-xl-4">
            <div class="card card-h-100">
                <div class="card-body">
                    <div class="d-flex flex-wrap align-items-center">
                        <h5 class="card-title me-2">Total Transaksi Ruangan</h5>
                    </div>
                    <hr>
                    <canvas id="perbandingan_total" class="chartjs-chart" data-colors='["#777aca", "#5156be","#6f42c1", "#a8aada"]'></canvas>
                </div>
            </div>
        </div>

        <div class="col-xl-8">
            <div class="card card-h-100">
                <div class="card-body">
                    <div class="d-flex flex-wrap align-items-center">
                        <h5 class="card-title me-2">
                            Total transaksi kamar dan ruangan perbulan pada tahun
                            <select id="yearFilter">
                                @for ($year = date('Y'); $year >= date('Y') - 5; $year--)
                                <option value="{{ $year }}" @if($year==request('year', date('Y'))) selected @endif>{{ $year }}</option>
                                @endfor
                            </select>
                        </h5>
                    </div>
                    <hr>
                    <div id="transaksi_status" data-colors='["#2ab57d", "#fd625e"]' class="apex-charts" dir="ltr"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- <div class="row">
        <div class="col-xl-4">
            <div class="card card-h-100">
                <div class="card-body">
                    <div class="d-flex flex-wrap align-items-center">
                        <h5 class="card-title me-2">Total transaksi pada tahun 2020</h5>
                    </div>
                    <hr>
                    <canvas id="total_perbulan" height="300px" width="272px" class="chartjs-chart" data-colors='["#5156be", "#5156be"]'></canvas>
                </div>
            </div>
        </div>

        <div class="col-xl-4">
            <div class="card card-h-100">
                <div class="card-body">
                    <div class="d-flex flex-wrap align-items-center">
                        <h5 class="card-title me-2">Total transaksi kamar pada tahun 2020</h5>
                    </div>
                    <hr>
                    <canvas id="kamar_perbulan" height="300px" width="272px" class="chartjs-chart" data-colors='["#f1734f", "#f1734f"]'></canvas>
                </div>
            </div>
        </div>

        <div class="col-xl-4">
            <div class="card card-h-100">
                <div class="card-body">
                    <div class="d-flex flex-wrap align-items-center">
                        <h5 class="card-title me-2">Total transaksi ruangan pada tahun 2020</h5>
                    </div>
                    <hr>
                    <canvas id="ruangan_perbulan" height="300px" width="272px" class="chartjs-chart" data-colors='["#4ba6ef", "#4ba6ef"]'></canvas>
                </div>
            </div>
        </div>
    </div> -->
</div><!-- end row-->

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    //PIE CHART
    var pieChartColors = <?php echo json_encode($pieChartData['backgroundColor']); ?>;
    var labels = <?php echo json_encode($pieChartData['labels']); ?>;
    var data = <?php echo json_encode($pieChartData['data']); ?>;

    var ctx = document.getElementById('perbandingan_total').getContext('2d');
    var pieChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: labels,
            datasets: [{
                data: data,
                backgroundColor: pieChartColors,
                hoverBackgroundColor: pieChartColors,
                hoverBorderColor: '#fff',
            }]
        },
    });
</script>

<script>
    document.getElementById('yearFilter').addEventListener('change', function() {
        var selectedYear = this.value;
        window.location.href = '?year=' + selectedYear;
    });

    //COLUMN CHART
    document.addEventListener('DOMContentLoaded', function() {
        var columnColors = getChartColorsArrayFromDOM("transaksi_status");

        var options = {
            chart: {
                height: 350,
                type: "bar",
                toolbar: {
                    show: false
                }
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: "45%"
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ["transparent"]
            },
            series: <?php echo json_encode($series); ?>,
            colors: columnColors,
            xaxis: {
                categories: <?php echo json_encode($categories); ?>
            },
            yaxis: {
                title: {
                    text: "Jumlah Transaksi",
                    style: {
                        fontWeight: "500"
                    }
                },
            },
            grid: {
                borderColor: "#f1f1f1"
            },
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return val + " Transaksi"
                    }
                },
            },
        };

        var chart = new ApexCharts(
            document.querySelector("#transaksi_status"),
            options
        );
        chart.render();
    });
</script>
@endsection