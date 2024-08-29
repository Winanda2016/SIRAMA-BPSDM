@extends('admin.themes.app')
@php
$ar_judul = ['No','Jenis Transaksi','Nama','Instansi','Tanggal Check In','Tanggal Check Out','Aksi'];
$no = 1;
@endphp
@section('content')
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Daftar Reservasi</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ url('/daftar-reservasi') }}">Daftar Reservasi</a></li>
                        <li class="breadcrumb-item active">List Daftar Reservasi</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm">
                            <div class="mb-4">
                                <a type="button" href="{{ url('/tambah-reservasi-kamar') }}" class="btn btn-primary waves-effect btn-label waves-light">
                                    <i class="bx bx-plus label-icon"></i>
                                    Reservasi Kamar
                                </a>
                                <a type="button" href="{{ url('/tambah-reservasi') }}" class="btn btn-info waves-effect btn-label waves-light mx-2">
                                    <i class="bx bx-plus label-icon"></i>
                                    Reservasi Ruangan
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table align-middle table-bordered datatable dt-responsive table-check nowrap" style=" width: 100%;">
                            <thead>
                                <tr class="table-primary">
                                    @foreach($ar_judul as $jdl)
                                    <th align="center">{{ $jdl }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody align="center">
                                @foreach($transaksi as $t)
                                <tr style="text-transform: capitalize;">
                                    <td><a href="javascript: void(0);" class="text-body fw-medium">{{ $no++ }}</a> </td>
                                    @if ($t->jenis_transaksi === 'ruangan')
                                    <td>Ruangan</td>
                                    @elseif ($t->jenis_transaksi === 'kamar')
                                    <td>Kamar</td>
                                    @endif
                                    <td>{{ $t->nama }}</td>
                                    <td>{{ $t->nama_instansi }}</td>
                                    <td>{{ $t->tgl_checkin }}</td>
                                    <td>{{ $t->tgl_checkout }}</td>
                                    <td>
                                        <a type="button" class="btn btn-primary waves-effect btn-label waves-light" href="{{ route('detail_transaksi', ['jenis_transaksi' => $t->jenis_transaksi, 'id' => $t->transaksi_id]) }}">
                                            <i class="bx bx-file label-icon"></i>
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
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
</div>
@endsection