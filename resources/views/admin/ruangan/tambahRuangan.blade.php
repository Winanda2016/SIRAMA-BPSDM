@extends('admin.themes.app')
@section('content')
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h3 class="mb-sm-0">Tambah Ruangan</h3>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ url('/kelola-ruangan') }}">Kelola Ruangan</a></li>
                        <li class="breadcrumb-item active">Tambah Ruangan</li>
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
                    <h4 align="center">Formulir Tambah Ruangan</h4>
                    <hr><br>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Nama Gedung</label>
                                <select required class="form-control form-select">
                                    <option value="">Select Type</option>
                                    <option value="wr">Writing</option>
                                    <option value="ph">Photography</option>
                                    <option value="cy">Cycling</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="example-text-input" class="form-label">Nama Ruangan</label>
                                <input class="form-control" type="text" value="Artisanal kale" id="example-text-input">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="example-text-input" class="form-label">Harga</label>
                                <input class="form-control" type="text" value="Artisanal kale" id="example-text-input">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="example-text-input" class="form-label">Kapasitas</label>
                                <input class="form-control" type="text" value="Artisanal kale" id="example-text-input">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="basicpill-address-input" class="form-label">Fasilitas</label>
                                <textarea id="basicpill-address-input" class="form-control" rows="2" placeholder="Enter your Address"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="formrow-firstname-input" class="form-label">Foto</label>
                                <input type="file" class="form-control" id="formrow-Foto-input" name="foto">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="basicpill-address-input" class="form-label">Deskripsi</label>
                                <textarea id="basicpill-address-input" class="form-control" rows="2" placeholder="Enter your Address"></textarea>
                            </div>
                        </div>
                    </div> <br>
                    <a type="button" class="btn btn-danger waves-effect waves-light m-1" href="#"><b>Batal</b></a>
                    <a type="button" class="btn btn-success waves-effect waves-light m-1" href="#"><b>Simpan</b></a>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection