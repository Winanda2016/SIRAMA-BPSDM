@extends('admin.themes.app')
@php
$ar_judul = ['No','Nama Ruangan','Nama Gedung','Harga','Kapasitas','Status','Aksi'];
$no = 1;
@endphp
@section('content')
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Kelola Ruangan</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">Kelola Ruangan</li>
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
                                <div style="width: 40%;">
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
                                <a href="{{ route('tambah_ruangan') }}" type="button" class="btn btn-primary waves-effect btn-label waves-light">
                                    <i class="bx bx-plus label-icon"></i>
                                    Tambah Ruangan
                                </a>

                                <!-- filter gedung -->
                                <div class="btn-group dropend" style="margin: 5px;">
                                    <button type="button" class="btn btn-info waves-effect waves-light">
                                        Filter
                                    </button>
                                    <button type="button" class="btn btn-info waves-effect waves-light dropdown-toggle-split dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="mdi mdi-chevron-right"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        {{-- <a selected hidden >{{request('search')}}</a> --}}
                                        <a class="dropdown-item" href="{{ route('kelola_ruangan') }}">All</a>
                                        @foreach ($gedung as $gd)
                                        <a class="dropdown-item" href="{{ route('kelola_ruangan', ['gedung_id' => $gd->id]) }}">
                                            {{ $gd->nama_gedung }}
                                        </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->

                    <div class="table-responsive">
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
                                    <td style="width: 1%;"><a href="javascript: void(0);" class="text-body fw-medium">{{ $no++ }}</a> </td>
                                    <td><a href="javascript: void(0);" class="text-body fw-medium">{{ $r->nama_ruangan }}</a> </td>
                                    <td> {{ $r->nama_gedung}} </td>
                                    <td> Rp.{{ $r->formatted_harga}}</td>
                                    <td> {{ $r->kapasitas }} orang </td>
                                    <td>
                                        @if ($r->status === 'kosong')
                                        <div class="badge badge-soft-success font-size-12">Kosong</div>
                                        @elseif ($r->status === 'terisi')
                                        <div class="badge badge-soft-danger font-size-12">Terisi</div>
                                        @elseif ($r->status === 'reservasi')
                                        <div class="badge badge-soft-warning font-size-12">Reservasi</div>
                                        @elseif ($r->status === 'perbaikan')
                                        <div class="badge badge-soft-secondary font-size-12">Perbaikan</div>
                                        @endif
                                    </td>
                                    <td>
                                        <a type="button" class="btn btn-primary waves-effect waves-light p-1" href="{{ route('detail_ruangan', $r->ruangan_id) }}" style="width: 35px; height:30px; margin-right:5px">
                                            <i class="bx bx-file font-size-16 align-middle"></i>
                                        </a>
                                        <a type="button" class="btn btn-warning waves-effect waves-light p-1" href="{{ route('edit_ruangan', $r->ruangan_id) }}" style="width: 35px; height:30px; margin-right:5px">
                                            <i class="bx bxs-edit font-size-16 align-middle"></i>
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