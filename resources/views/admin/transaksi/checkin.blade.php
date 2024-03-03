@extends('admin.themes.app')
@section('content')
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Detail Reservasi</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ url('/daftar-reservasi') }}">Daftar Reservasi</a></li>
                        <li class="breadcrumb-item active">Detail</li>
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
                    <h4 align="center">Formulir Check In</h4><hr>
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Nama</label>
                        <input class="form-control" type="text" value="Artisanal kale" id="example-text-input">
                    </div>
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Instansi</label>
                        <input class="form-control" type="text" value="Artisanal kale" id="example-text-input">
                        <div class="text-muted" style="font-size: 11px;">*Jika umum silahkan dikosongkan</div>
                    </div>
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Nomor Handphone</label>
                        <input class="form-control" type="text" value="Artisanal kale" id="example-text-input">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="formrow-email-input">Tanggal Check In</label>
                                <input class="form-control" type="date" value="2019-08-19" id="example-date-input">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="formrow-password-input">Tanggal Check Out</label>
                                <input class="form-control" type="date" value="2019-08-19" id="example-date-input">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Jumlah Orang</label>
                        <input class="form-control" type="text" value="Artisanal kale" id="example-text-input">
                        <div class="text-muted" style="font-size: 11px;">*hitung berdasarkan kebutuhan tempat tidur</div>
                    </div><br>

                    <a type="button" class="btn btn-danger waves-effect waves-light" href="#"><b>Batal</b></a>
                    <a type="button" class="btn btn-info waves-effect waves-light" href="#"><b>Check In</b></a>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection