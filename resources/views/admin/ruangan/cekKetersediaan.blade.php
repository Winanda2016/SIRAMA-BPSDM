@extends('admin.themes.app')
@php
$ar_judul = ['No','Nama Ruangan','Nama Gedung','Kapasitas','Status'];
$no = 1;
@endphp
@section('content')
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Cek Ketersediaan Ruangan</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">Cek Ketersediaan Ruangan</li>
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
                        <a type="button" href="{{ route('admin_reservasi.create', ['jenis_transaksi' => 'ruangan']) }}" class="btn btn-primary waves-effect btn-label waves-light m-1">
                            <i class="bx bx-plus label-icon"></i>
                            Reservasi
                        </a>
                    </div>
                    <div style="background-color: #f8f9fa; padding:10px; margin:10px">
                        <form method="GET" action="{{ route('cek_ruangan') }}">
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
                                        Cek Ruangan
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
                                @foreach($ruangan as $r)
                                <tr>
                                    <td><a href="javascript: void(0);" class="text-body fw-medium">{{ $no++ }}</a> </td>
                                    <td><a href="javascript: void(0);" class="text-body fw-medium">{{ $r->nama_ruangan }}</a> </td>
                                    <td>{{ $r->nama_gedung }}</td>
                                    <td>{{ $r->kapasitas }} orang</td>
                                    <td>
                                        @if ($r->status_ruangan === 'kosong' && $r->status_transaksi === 'kosong')
                                        <div class="badge badge-soft-success font-size-12">Kosong</div>
                                        @elseif ($r->status_ruangan === 'terisi')
                                        <div class="badge badge-soft-danger font-size-12">Terisi</div>
                                        @elseif ($r->status_ruangan === 'kosong' && $r->status_transaksi === 'terima')
                                        <div class="badge badge-soft-warning font-size-12">Reservasi</div>
                                        @elseif ($r->status_ruangan === 'perbaikan')
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
@endsection