@extends('admin.themes.app')
@php
$ar_judul = ['No','Nama','Harga','Aksi'];
$no = 1;
@endphp
@section('content')
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Data Instansi</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">Kelola Data Instansi</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-6">
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
                                    @if($errors->has('nama_instansi'))
                                    <div class="alert alert-danger">
                                        <!-- <p>{{ $errors->first('nama_instansi') }}</p> -->
                                        <p>kjhgufyrtetsrdxtfcgvhbjk</p>
                                    </div>
                                    @endif
                                </div>

                                <button type="button" class="btn btn-primary waves-effect btn-label waves-light" data-bs-toggle="modal" data-bs-target="#tambahInstansi">
                                    <i class="bx bx-plus label-icon"></i>
                                    Tambah
                                </button>

                                <!-- Modal Tambah Instansi -->
                                <div class="modal fade" id="tambahInstansi" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="tambahInstansiLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content border-primary">
                                            <div class="modal-header bg-gradient bg-primary">
                                                <h5 class="modal-title text-white" id="tambahGInstansiLabel">FORMULIR TAMBAH Instansi</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form class="row" method="POST" action="{{ route('instansi.store') }}">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <label for="example-text-input" class="form-label">Nama Instansi</label>
                                                        <input class="form-control" type="text" name="nama_instansi" id="example-text-input">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="example-text-input" class="form-label">Harga</label>
                                                        <input class="form-control" type="text" name="harga" id="example-text-input">
                                                    </div>
                                                    <div class="mt-3 mb-3">
                                                        <button type="reset" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-success">Simpan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
                                @foreach($instansi as $jp)
                                <tr>
                                    <td style="width: 1%;"><a href="javascript: void(0);" class="text-body fw-medium">{{ $no++ }}</a> </td>
                                    <td style="width: 74%;">{{ $jp->nama_instansi }}</td>
                                    <td style="width: 74%;">Rp. {{ $jp->formatted_harga }}</td>
                                    <td style="width: 25%;">
                                        <div class="d-flex justify-content-center" align="center">
                                            <button type="button" class="btn btn-warning waves-effect waves-light p-1" title="edit" data-bs-toggle="modal" data-bs-target="#editInstansi{{ $jp->id }}" style="width: 35px; height:30px;">
                                                <i class="bx bxs-edit font-size-16 align-middle"></i>
                                            </button>
                                            <!-- Modal Edit Instansi -->
                                            <div class="modal fade" id="editInstansi{{ $jp->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="editInstansiLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content border-primary">
                                                        <div class="modal-header bg-gradient bg-primary">
                                                            <h5 class="modal-title text-white" id="editInstansiLabel">FORM EDIT INSTANSI</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body" align="left">
                                                            <form class="row" method="POST" action="{{ route('instansi.update', ['instansi' => $jp->id]) }}">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="mb-3">
                                                                    <label for="example-text-input" class="form-label">Instansi</label>
                                                                    <input class="form-control" type="text" name="nama_instansi" value="{{ $jp->nama_instansi }}" id="example-text-input">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="example-text-input" class="form-label">Harga</label>
                                                                    <input class="form-control" type="text" name="harga" value="{{ $jp->harga }}" id="example-text-input">
                                                                </div>
                                                                <div class="mt-3 mb-3">
                                                                    <button type="reset" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                                                                    <button type="submit" class="btn btn-primary">Simpan</button>
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