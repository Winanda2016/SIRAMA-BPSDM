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
    </div><!-- end row-->

    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h6>Tamu yang akan Check-Out hari ini</h6>
                    <hr>
                    <div class="table-responsive">
                        <table class="table align-middle table-bordered table-check nowrap" style=" width: 100%;">
                            <thead>
                                <tr class="table-primary">
                                    <th style=" width: 1%;text-align: center;">No</th>
                                    <th style="text-align: center;">Nomor Kamar</th>
                                    <th style="text-align: center;">Nama Tamu</th>
                                    <th style="text-align: center;">Action</th>
                                </tr>
                            </thead>
                            <tbody align="center">
                                <tr>
                                    <td>1</td>
                                    <td>101</td>
                                    <td>Connie Franco</td>
                                    <td>
                                        <a type="button" class="btn btn-danger waves-effect waves-light p-1">Check Out</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- end table responsive -->
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->

        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">

                    <h6>Permintaan Reservasi yang belum di Konfirmasi</h6>
                    <hr>

                    <div class="table-responsive">
                        <table class="table align-middle table-bordered table-check nowrap" style=" width: 100%;">
                            <thead>
                                <tr class="table-primary">
                                    <th style=" width: 1%;text-align: center;">No</th>
                                    <th style="text-align: center;">Nama Tamu</th>
                                    <th style="text-align: center;">Tanggal Reservasi</th>
                                    <th style="text-align: center;">Action</th>
                                </tr>
                            </thead>
                            <tbody align="center">
                                <tr>
                                    <td>1</td>
                                    <td>101</td>
                                    <td>Connie Franco</td>
                                    <td>
                                        <a type="button" class="btn btn-primary waves-effect btn-label waves-light" href="{{ url('/detail-permintaan-reservasi') }}">
                                            <i class="bx bx-file label-icon"></i>
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- end table responsive -->
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-2">
                            <!-- filter gedung -->
                            <div class="btn-group dropend mb-3">
                                <button type="button" class="btn btn-info waves-effect waves-light">
                                    Filter
                                </button>
                                <button type="button" class="btn btn-info waves-effect waves-light dropdown-toggle-split dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="mdi mdi-chevron-right"></i>
                                </button>
                                <div class="dropdown-menu">
                                    {{-- <a selected hidden >{{request('search')}}</a> --}}
                                    <a class="dropdown-item" href="{{ route('dashboard_pegawai') }}">Semua</a>
                                    @foreach ($gedung as $gd)
                                    <a class="dropdown-item" href="{{ route('dashboard_pegawai', ['gedung_id' => $gd->id]) }}">
                                        {{ $gd->nama_gedung }}
                                    </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 d-flex flex-wrap align-items-center">
                        <span class="badge rounded-pill badge-soft-success me-3 p-1">Kosong</span>
                        <span class="badge rounded-pill badge-soft-warning me-3 p-1">Reservasi</span>
                        <span class="badge rounded-pill badge-soft-danger me-3 p-1">Terisi</span>
                        <span class="badge rounded-pill badge-soft-secondary me-3 p-1">Perbaikan</span>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        @foreach ($kamar as $k)
                        @if ($k->status_kamar === 'kosong')
                        <a type="button" class="btn btn-success waves-effect waves-light p-1 m-2" style="width: 45px; height:30px;" href="#">
                            <h5 class="text-white">{{ $k->nomor_kamar }}</h5>
                        </a>
                        @elseif ( $k->status_kamar === 'kosong' && $k->status_transaksi === 'terima')
                        <a type="button" class="btn btn-warning waves-effect waves-light p-1 m-2" style="width: 45px; height:30px;" href="#">
                            <h5 class="text-white">{{ $k->nomor_kamar }}</h5>
                        </a>
                        @elseif ( $k->status_kamar === 'terisi')
                        <a type="button" class="btn btn-danger waves-effect waves-light p-1 m-2" style="width: 45px; height:30px;" href="#">
                            <h5 class="text-white">{{ $k->nomor_kamar }}</h5>
                        </a>
                        @elseif ( $k->status_kamar === 'perbaikan')
                        <a type="button" class="btn btn-secondary waves-effect waves-light p-1 m-2" style="width: 45px; height:30px;" href="#">
                            <h5 class="text-white">{{ $k->nomor_kamar }}</h5>
                        </a>
                        @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<!-- container-fluid -->
@endsection