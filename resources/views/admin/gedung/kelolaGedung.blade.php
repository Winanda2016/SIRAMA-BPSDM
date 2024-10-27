@extends('admin.themes.app')
@php
$ar_judul = ['No','Nama','Aksi'];
$no = 1;
@endphp
@section('content')
<div class="container-fluid">

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Kelola Gedung</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">Kelola Gedung</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm">
                            <div class="mb-4">
                                <div>
                                    @if($message = Session::get('success'))
                                    <div class="alert alert-success alert-dismissible">
                                        <p>{{ $message }}</p>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    @endif
                                    @if($message = Session::get('error'))
                                    <div class="alert alert-danger alert-dismissible">
                                        <p>{{ $message }}</p>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    @endif
                                </div>

                                <button type="button" class="btn btn-primary waves-effect btn-label waves-light" data-bs-toggle="modal"
                                    data-bs-target="#tambahGedung">
                                    <i class="bx bx-plus label-icon"></i>
                                    Tambah Gedung
                                </button>

                                <!-- Modal Tambah Gedung -->
                                <div class="modal fade" id="tambahGedung" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                    role="dialog" aria-labelledby="tambahGedungLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content border-primary">
                                            <div class="modal-header  bg-gradient bg-primary">
                                                <h5 class="modal-title text-white" id="tambahGedungLabel">Form Tambah Gedung</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form class="row g-3" method="POST" action="{{ route('gedung.store') }}">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <label for="nama_gedung" class="form-label">Nama Gedung</label>
                                                        <input class="form-control" type="text" name="nama_gedung" id="nama_gedung">
                                                    </div>
                                                    <div class="mb-3">
                                                        <button type="reset" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-success mx-2">Simpan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

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
                                @foreach($ar_gedung as $gd)
                                <tr>
                                    <td style="width: 1%;"><a href="javascript: void(0);" class="text-body fw-medium">{{ $no++ }}</a> </td>
                                    <td style="width: 74%;">{{ $gd->nama_gedung }}</td>
                                    <td style="width: 25%;">
                                        <div class="d-flex justify-content-center" align="center">
                                            <button type="button" class="btn btn-warning waves-effect waves-light p-1" title="edit" data-bs-toggle="modal"
                                                data-bs-target="#editGedung{{ $gd->id }}" style="width: 35px; height:30px; margin-right:15px">
                                                <i class="bx bxs-edit font-size-16 align-middle"></i>
                                            </button>

                                            <!-- Modal Edit Gedung -->
                                            <div class="modal fade" id="editGedung{{ $gd->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                                role="dialog" aria-labelledby="editGedungLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content border-primary">
                                                        <div class="modal-header bg-gradient bg-primary">
                                                            <h5 class="modal-title text-white" id="editGedungLabel">Form Edit Gedung</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body" align="left">
                                                            <form class="row g-3" method="POST" action="{{ route('gedung.update', ['gedung' => $gd->id]) }}">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="mb-3">
                                                                    <label for="nama_gedung" class="form-label">Nama Gedung</label>
                                                                    <input class="form-control" type="text" name="nama_gedung" value="{{ $gd->nama_gedung }}"
                                                                        id="example-text-input">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <button type="reset" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                                                                    <button type="submit" class="btn btn-success mx-2">Simpan</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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