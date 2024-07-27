@extends('admin.themes.app')
@php
$ar_judul = ['No','Jenis Transaksi','Tanggal Reservasi','Nama','Instansi','Tanggal Check In','Tanggal Check Out','Aksi'];
$no = 1;
@endphp
@section('content')
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Permintaan Reservasi</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Permintaan Reservasi</a></li>
                        <li class="breadcrumb-item active">List Permintaan Reservasi</li>
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
                                <a type="button" href="{{ url('/tambah-reservasi') }}" class="btn btn-primary waves-effect btn-label waves-light">
                                    <i class="bx bx-plus label-icon"></i>
                                    Tambah Reservasi
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->

                    <div class="table-responsive">
                        <table class="table align-middle table-bordered datatable dt-responsive table-check nowrap" style=" width: 100%;">
                            <thead>
                                <tr class="bg-transparent" align="center">
                                    @foreach($ar_judul as $jdl)
                                    <th>{{ $jdl }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody align="center">
                                @foreach($transaksi as $t)
                                <tr style="text-transform: capitalize;">
                                    <td><a href="javascript: void(0);" class="text-body fw-medium">{{ $no++ }}</a> </td>
                                    @if ($t->jenis_transaksi === 'ruangan')
                                    <td>{{ $t->nama_transaksi }}</td>
                                    @elseif ($t->jenis_transaksi === 'kamar')
                                    <td>Kamar</td>
                                    @endif
                                    <td>{{ $t->tgl_reservasi }}</td>
                                    <td>{{ $t->nama }}</td>
                                    <td>{{ $t->nama_instansi }}</td>
                                    <td>{{ $t->tgl_reservasi }}</td>
                                    <td>{{ $t->tgl_checkout }}</td>
                                    <td>
                                        <a type="button" class="btn btn-primary waves-effect btn-label waves-light" href="{{ route('detail_PReservasi', ['jenis_transaksi' => $t->jenis_transaksi, 'id' => $t->detail_id]) }}">
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