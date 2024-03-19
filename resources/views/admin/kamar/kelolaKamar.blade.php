@extends('admin.themes.app')
@php
$ar_judul = ['No','Nomor Kamar','Nama Gedung','Kapasitas','Status','Aksi'];
$no = 1;
@endphp
@section('content')
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Kelola Kamar</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">Kelola Kamar</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm">
                            <div class="mb-4">
                                <div>
                                    @if($message = Session::get('success'))
                                    <div class="alert alert-success">
                                        <p>{{ $message }}</p>
                                    </div>
                                    @endif
                                    @if($message = Session::get('error'))
                                    <div class="alert alert-danger">
                                        <p>{{ $message }}</p>
                                    </div>
                                    @endif
                                </div>
                                <a href="{{ url('/kelola-kamar/tambah-kamar') }}" type="button" class="btn btn-primary waves-effect btn-label waves-light">
                                    <i class="bx bx-plus label-icon"></i>
                                    Tambah Kamar
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->

                    <div class="table-responsive">
                        <table class="table align-middle table-bordered datatable dt-responsive table-check nowrap" style="width: 100%;">
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
                                        @if ($k->status === 'kosong')
                                        <div class="badge badge-soft-success font-size-12">Kosong</div>
                                        @elseif ($k->status === 'terisi')
                                        <div class="badge badge-soft-danger font-size-12">Terisi</div>
                                        @elseif ($k->status === 'reservasi')
                                        <div class="badge badge-soft-warning font-size-12">Reservasi</div>
                                        @elseif ($k->status === 'perbaikan')
                                        <div class="badge badge-soft-secondary font-size-12">Perbaikan</div>
                                        @endif
                                    </td>
                                    <td>
                                        <a type="button" class="btn btn-primary waves-effect waves-light p-1" href="{{ url('/detail-kamar') }}" style="width: 35px; height:30px; margin-right:5px">
                                            <i class="bx bx-file font-size-16 align-middle"></i>
                                        </a>
                                        <a type="button" class="btn btn-warning waves-effect waves-light  p-1" href="/kelola-kamar/{{ $k->id }}/edit" style="width: 35px; height:30px; margin-right:5px">
                                            <i class="bx bxs-edit font-size-16 align-middle"></i>
                                        </a>
                                        <a type="button" class="btn btn-danger waves-effect waves-light p-1" href="#" style="width: 35px; height:30px; margin-right:5px">
                                            <i class="bx bx-trash font-size-16 align-middle"></i>
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