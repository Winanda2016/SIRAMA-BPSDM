@extends('admin.themes.app')
@php
$ar_judul = ['No','Nama','Instansi','Jenis Transaksi','Tanggal Check In','Tanggal Check Out','Jumlah Orang','Aksi'];
$no = 1;
@endphp
@section('content')
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h2 class="mb-sm-0">Daftar Tamu</h2>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">Daftar Tamu</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card card-h-100">
                <div class="card-body">
                    <!-- <div class="row">
                        <div class="col-sm">
                            <div class="mb-4">
                                <a type="button" href="{{ route('kamar_checkin.create') }}" class="btn btn-primary waves-effect btn-label waves-light">
                                    <i class="bx bx-plus label-icon"></i>
                                    Tambah Transaksi Kamar
                                </a>
                            </div>
                        </div>
                    </div> -->

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
                                @foreach($transaksi as $t)
                                <tr>
                                    <td><a href="javascript: void(0);" class="text-body fw-medium">{{ $no++ }}</a> </td>
                                    <td>{{ $t->nama }}</td>
                                    <td>{{ $t->nama_instansi }}</td>
                                    @if ($t->jenis_transaksi === 'ruangan')
                                    <td>Ruangan</td>
                                    @elseif ($t->jenis_transaksi === 'kamar')
                                    <td>Kamar</td>
                                    @endif
                                    <td>{{ $t->tgl_checkin }}</td>
                                    <td>{{ $t->tgl_checkout }}</td>
                                    <td>{{ $t->jumlah_orang }} Orang</td>
                                    <td>
                                        <a type="button" class="btn btn-primary waves-effect btn-label waves-light" href="{{ route('detail_transaksi', ['jenis_transaksi' => $t->jenis_transaksi, 'id' => $t->transaksi_id]) }}">
                                            <i class="bx bx-file label-icon"></i>
                                            Detail
                                        </a>
                                        <!-- <a type="button" class="btn btn-danger waves-effect waves-light p-1" href="{{ url('/tamu/checkout') }}">Check Out</a> -->
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- end table responsive -->
                </div>
            </div>
        </div>
    </div>

</div>
@endsection