@extends('admin.themes.app')
@php
$ar_judul = ['No','Nama','Instansi','Aksi'];
$ar_judultc = ['No','Nama','Jenis Transaksi','Aksi'];
@endphp
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
        <div class="col-xl-3 col-md-6">
            <!-- card -->
            <div class="card card-h-100 bg-success bg-gradient border-primary text-white-50">
                <!-- card body -->
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <span class="text-muted mb-3 lh-1 d-block text-truncate"><b>Kamar kosong</b></span>
                            <h1 class="mb-3 text-white">{{ $totalKKosong }}</h1>
                        </div>
                        <div class="col-6">
                            <i class="fas fa-user-check" style="font-size: 80px; padding:5px"></i>
                        </div>
                    </div>
                </div><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col-->

        <div class="col-xl-3 col-md-6">
            <!-- card -->
            <div class="card card-h-100 bg-danger bg-gradient border-primary text-white-50">
                <!-- card body -->
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <span class="text-muted mb-3 lh-1 d-block text-truncate"><b>Kamar Terisi</b></span>
                            <h1 class="mb-3 text-white">{{ $totalKTerisi }}</h1>
                        </div>
                        <div class="col-6">
                            <i class="fas fa-user-clock" style="font-size: 80px; padding:5px"></i>
                        </div>
                    </div>
                </div><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col-->

        <div class="col-xl-3 col-md-6">
            <!-- card -->
            <div class="card card-h-100 bg-warning bg-gradient border-primary text-white-50">
                <!-- card body -->
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <span class="text-muted mb-3 lh-1 d-block text-truncate"><b>Kamar Reservasi</b></span>
                            <h1 class="mb-3 text-white">{{ $totalKReservasi }}</h1>
                        </div>
                        <div class="col-6">
                            <i class="fas fa-tags" style="font-size: 80px; padding:5px"></i>
                        </div>
                    </div>
                </div><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col-->

        <div class="col-xl-3 col-md-6">
            <!-- card -->
            <div class="card card-h-100 bg-secondary bg-gradient border-primary text-white-50">
                <!-- card body -->
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <span class="text-muted mb-3 lh-1 d-block text-truncate"><b>Kamar Perbaikan</b></span>
                            <h1 class="mb-3 text-white">{{ $totalKPerbaikan }}</h1>
                        </div>
                        <div class="col-6">
                            <i class="fas fa-cogs" style="font-size: 80px; padding:5px"></i>
                        </div>
                    </div>
                </div><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col-->
    </div><br><!-- end row-->


    <div class="row">
        <div class="mb-4">
            <a type="button" href="{{ route('admin_reservasi.create', ['jenis_transaksi' => 'kamar']) }}" class="btn btn-primary waves-effect btn-label waves-light m-1">
                <i class="bx bx-plus label-icon"></i>
                Reservasi Kamar
            </a>
            <a type="button" href="{{ route('admin_reservasi.create', ['jenis_transaksi' => 'ruangan']) }}" class="btn btn-info waves-effect btn-label waves-light m-1">
                <i class="bx bx-plus label-icon"></i>
                Reservasi Ruangan
            </a>
            <a type="button" href="{{ route('kamar_checkin.create') }}" class="btn btn-primary waves-effect btn-label waves-light m-1">
                <i class="bx bx-plus label-icon"></i>
                Check In Kamar
            </a>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h6>Tamu yang akan Check-Out</h6>
                        <hr>
                        <div class="table-responsive">
                            <table class="table align-middle table-bordered datatable dt-responsive table-check nowrap" style=" width: 100%; text-transform:capitalize">
                                <thead>
                                    <tr class="table-primary">
                                        @foreach($ar_judultc as $jdltc)
                                        <th style="text-align: center;">{{ $jdltc }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody align="center">
                                    @foreach ($transaksiCheckIn as $key => $tc)
                                    <tr>
                                        <td><a href="javascript: void(0);" class="text-body fw-medium">{{ $key + 1 }}</a> </td>
                                        <td>{{ $tc->nama }}</td>
                                        <td>{{ $tc->jenis_transaksi }}</td>
                                        <td>
                                            <a href="{{ route('detail_transaksi', ['jenis_transaksi' => $tc->jenis_transaksi, 'id' => $tc->transaksi_id]) }}" type="button" class="btn btn-danger waves-effect waves-light p-1">Check Out</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">

                        <h6>Permintaan Reservasi yang belum di Konfirmasi</h6>
                        <hr>

                        <div class="table-responsive">
                            <table class="table align-middle table-bordered datatable dt-responsive table-check nowrap" style=" width: 100%;">
                                <thead>
                                    <tr class="table-primary">
                                        @foreach($ar_judul as $jdl)
                                        <th style="text-align: center;">{{ $jdl }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody align="center">
                                    @foreach ($transaksiPending as $key => $tp)
                                    <tr>
                                        <td><a href="javascript: void(0);" class="text-body fw-medium">{{ $key + 1 }}</a> </td>
                                        <td>{{ $tp->nama }}</td>
                                        <td>{{ $tp->nama_instansi }}</td>
                                        <td>
                                            <a href="{{ route('detail_transaksi', ['jenis_transaksi' => $tp->jenis_transaksi, 'id' => $tp->transaksi_id]) }}" type="button" class="btn btn-info waves-effect waves-light p-1">Konfirmasi</a>
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
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function showFilter(filterId) {
        // Sembunyikan semua form filter
        $('.filter-data').hide();

        // Tampilkan form filter yang dipilih
        $('#' + filterId).show();
    }
</script>
@endsection