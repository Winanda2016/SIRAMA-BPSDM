@extends('admin.themes.app')
@section('content')
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Tambah Kamar</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ url('/kelola-kamar') }}">Kelola Kamar</a></li>
                        <li class="breadcrumb-item active">Tambah Kamar</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-6">
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
            <div class="card">
                <div class="card-body">
                    <h4 align="center">Formulir Tambah Kamar</h4>
                    <hr><br>
                    <form method="POST" action="/kelola-kamar" enctype="multipart/form-data">
                        @csrf
                        <div class="row">

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Nama Gedung</label>
                                    <select name="gedung_id" required class="form-control form-select">
                                        <option selected>Choose...</option>
                                        @foreach ($gedung as $g)
                                        <option value="{{ $g->id }}">{{ $g->nama_gedung }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nomor_kamar" class="form-label">Nomor Kamar</label>
                                    <input class="form-control" type="text" name="nomor_kamar" id="nomor_kamar">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="kapasitas" class="form-label">Kapasitas</label>
                                    <input class="form-control" type="text" name="kapasitas" id="kapasitas">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label for="status" class="form-label">Status Kamar</label>
                            <div class="col-md-2">
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="radio" name="status" id="status_kosong" value="kosong" checked>
                                    <label class="form-check-label" for="status_kosong">Kosong</label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="radio" name="status" id="status_terisi" value="Terisi">
                                    <label class="form-check-label" for="status_terisi">Terisi</label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="radio" name="status" id="status_reservasi" value="reservasi">
                                    <label class="form-check-label" for="status_reservasi">Reservasi</label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="radio" name="status" id="status_perbaikan" value="perbaikan">
                                    <label class="form-check-label" for="status_perbaikan">Perbaikan</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="fasilitas" class="form-label">Fasilitas</label>
                                    <textarea id="fasilitas" name="fasilitas" class="form-control" rows="5"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="foto" class="form-label">Foto</label>
                                    <input type="file" class="form-control" id="foto" name="foto">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="basicpill-address-input" class="form-label">Deskripsi Tambahan</label>
                                    <textarea id="basicpill-address-input" name="keterangan" class="form-control" rows="3"></textarea>
                                    <p>*kosongkan jika tidak ada</p>
                                </div>
                            </div>
                        </div>

                        <a type="reset" class="btn btn-danger waves-effect waves-light m-1"><b>Batal</b></a>
                        <button type="submit" class="btn btn-success waves-effect waves-light m-1">Simpan</button>
                    </form> <br>
                    <!-- <a type="submit" class="btn btn-success waves-effect waves-light m-1" value="Simpan"><b>Simpan</b></a> -->
                </div>



            </div>
        </div>
    </div>
</div>
</div>
@endsection