@extends('admin.themes.app')
@php
$ar_judul = ['No','Nomor Kamar','Nama Gedung','Kapasitas','Status'];
$no = 1;
@endphp
@section('content')
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Cek Ketersediaan Kamar</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">Cek Ketersediaan Kamar</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="mb-4">
                        <a type="button" href="{{ route('admin_reservasi.create', ['jenis_transaksi' => 'kamar']) }}" class="btn btn-primary waves-effect btn-label waves-light m-1">
                            <i class="bx bx-plus label-icon"></i>
                            Reservasi
                        </a>
                        <a type="button" href="{{ route('kamar_checkin.create') }}" class="btn btn-info waves-effect btn-label waves-light m-1">
                            <i class="bx bx-plus label-icon"></i>
                            Check In
                        </a>
                    </div>
                    <div style="background-color: #f8f9fa; padding:10px; margin:10px">
                        <form method="GET" action="{{ route('cek_kamar') }}">
                            <div class="row mb-4">
                                <div class="col-sm-2">
                                    <label for="tgl_checkin" class="form-label mr-2">Tanggal Check In:</label>
                                    <input class="form-control form-control-sm" type="date" name="tgl_checkin" id="tgl_checkin" value="{{ request('tgl_checkin', old('tgl_checkin')) }}" required>
                                </div>
                                <div class="col-sm-2">
                                    <label for="tgl_checkout" class="form-label mr-2">Tanggal Check Out:</label>
                                    <input class="form-control form-control-sm" type="date" name="tgl_checkout" id="tgl_checkout" value="{{ request('tgl_checkout', old('tgl_checkout')) }}" required>
                                </div>
                                <div class="col-sm-2">
                                    <br>
                                    <button type="submit" class="btn btn-primary waves-effect waves-light px-1 mt-2" style="width: 100px; height:28px;padding:0px">
                                        Cek Kamar
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>


                    <div class="table-responsive m-3">
                        <table class="table align-middle table-bordered datatable dt-responsive table-check nowrap" style="text-transform: capitalize; width:100%">
                            <thead>
                                <tr class="table-primary">
                                    @foreach($ar_judul as $jdl)
                                    <th style="text-align: center;">{{ $jdl }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody align="center">
                                @foreach($kamar as $k)
                                <tr>
                                    <td><a href="javascript: void(0);" class="text-body fw-medium">{{ $no++ }}</a> </td>
                                    <td><a href="javascript: void(0);" class="text-body fw-medium">{{ $k->nomor_kamar }}</a> </td>
                                    <td> {{ $k->nama_gedung }} </td>
                                    <td>{{ $k->kapasitas }} orang</td>
                                    <td>
                                        @if ($k->status_kamar === 'kosong' && $k->status_transaksi === 'kosong')
                                        <div class="badge badge-soft-success font-size-12">Kosong</div>
                                        @elseif ($k->status_kamar === 'terisi')
                                        <div class="badge badge-soft-danger font-size-12">Terisi</div>
                                        @elseif ($k->status_kamar === 'kosong' && $k->status_transaksi === 'terima')
                                        <div class="badge badge-soft-warning font-size-12">Reservasi</div>
                                        @elseif ($k->status_kamar === 'perbaikan')
                                        <div class="badge badge-soft-secondary font-size-12">Perbaikan</div>
                                        @endif
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

<!-- <div class="card-body" id="kamarContainer">
    @foreach ($kamar as $k)
    @if ($k->status_kamar === 'kosong')
    <a type="button" class="btn btn-success waves-effect waves-light p-1 m-2" style="width: 45px; height:30px;" href="#" title="{{ $k->nama_gedung }}">
        <h5 class="text-white">{{ $k->nomor_kamar }}</h5>
    </a>
    @elseif ( $k->status_kamar === 'kosong' && $k->status_transaksi === 'terima')
    <a type="button" class="btn btn-warning waves-effect waves-light p-1 m-2" style="width: 45px; height:30px;" href="#" title="{{ $k->nama_gedung }}">
        <h5 class="text-white">{{ $k->nomor_kamar }}</h5>
    </a>
    @elseif ( $k->status_kamar === 'terisi')
    <a type="button" class="btn btn-danger waves-effect waves-light p-1 m-2" style="width: 45px; height:30px;" href="#" title="{{ $k->nama_gedung }}">
        <h5 class="text-white">{{ $k->nomor_kamar }}</h5>
    </a>
    @elseif ( $k->status_kamar === 'perbaikan')
    <a type="button" class="btn btn-secondary waves-effect waves-light p-1 m-2" style="width: 45px; height:30px;" href="#" title="{{ $k->nama_gedung }}">
        <h5 class="text-white">{{ $k->nomor_kamar }}</h5>
    </a>
    @endif
    @endforeach
</div> -->
@endsection