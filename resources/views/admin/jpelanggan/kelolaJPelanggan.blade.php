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
                <h4 class="mb-sm-0 font-size-18">Data Jenis Pelanggan</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">Kelola Data Jenis Pelanggan</li>
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
                                    @if($errors->has('nama_jenis'))
                                    <div class="alert alert-danger">
                                        <!-- <p>{{ $errors->first('nama_jenis') }}</p> -->
                                        <p>kjhgufyrtetsrdxtfcgvhbjk</p>
                                    </div>
                                    @endif
                                </div>

                                <button type="button" class="btn btn-primary waves-effect btn-label waves-light" data-bs-toggle="modal" data-bs-target="#tambahJPelanggan">
                                    <i class="bx bx-plus label-icon"></i>
                                    Tambah
                                </button>

                                <!-- Modal Tambah Jenis Pelanggan -->
                                <div class="modal fade" id="tambahJPelanggan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="tambahJPelangganLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content border-primary">
                                            <div class="modal-header bg-gradient bg-primary">
                                                <h5 class="modal-title text-white" id="tambahGJPelangganLabel">FORMULIR TAMBAH JENIS PELANGGAN</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form class="row" method="POST" action="{{ route('jenis-pelanggan.store') }}">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <label for="example-text-input" class="form-label">Jenis Pelanggan</label>
                                                        <input class="form-control" type="text" name="nama_jenis" id="example-text-input">
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
                                @foreach($jpelanggan as $jp)
                                <tr>
                                    <td style="width: 1%;"><a href="javascript: void(0);" class="text-body fw-medium">{{ $no++ }}</a> </td>
                                    <td style="width: 74%;">{{ $jp->nama_jenis }}</td>
                                    <td style="width: 74%;">{{ $jp->harga }}</td>
                                    <td style="width: 25%;">
                                        <div class="d-flex justify-content-center" align="center">
                                            <button type="button" class="btn btn-warning waves-effect waves-light p-1" title="edit" data-bs-toggle="modal" data-bs-target="#editJPelanggan{{ $jp->id }}" style="width: 35px; height:30px; margin-right:15px">
                                                <i class="bx bxs-edit font-size-16 align-middle"></i>
                                            </button>
                                            <!-- Modal Edit Jenis Pelanggan -->
                                            <div class="modal fade" id="editJPelanggan{{ $jp->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="editJPelangganLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content border-primary">
                                                        <div class="modal-header bg-gradient bg-primary">
                                                            <h5 class="modal-title text-white" id="editJPelangganLabel">FORM EDIT JENIS PELANGGAN</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body" align="left">
                                                            <form class="row" method="POST" action="{{ route('jenis-pelanggan.update', ['jenis_pelanggan' => $jp->id]) }}">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="mb-3">
                                                                    <label for="example-text-input" class="form-label">Jenis Pelanggan</label>
                                                                    <input class="form-control" type="text" name="nama_jenis" value="{{ $jp->nama_jenis }}" id="example-text-input">
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

                                            <button type="button" class="btn btn-danger waves-effect waves-light p-1" title="hapus" data-bs-toggle="modal" data-bs-target="#hapusJPelanggan{{ $jp->id }}" style="width: 35px; height:30px; margin-right:5px">
                                                <i class="bx bx-trash font-size-16 align-middle"></i>
                                            </button>
                                            <!-- Modal Hapus Jenis Pelanggan -->
                                            <div class="modal fade" id="hapusJPelanggan{{ $jp->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content border-danger" style="width: fit-content;">
                                                        <div class="modal-header bg-gradient bg-danger">
                                                            <h5 class="modal-title text-white" id="hapusPenggunaLabel">PERINGATAN!!!</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <h6>Yakin akan menghapus "{{ $jp->nama_jenis }}"?</h6>
                                                            <p>(Data yang dihapus tidak dapat dikembalikan lagi.)</p>

                                                            <div align="right">
                                                                <form method="POST" action="{{ route('jenis-pelanggan.destroy', $jp->id) }}">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                                </form>
                                                            </div>
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