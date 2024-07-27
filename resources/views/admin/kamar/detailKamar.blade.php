@extends('admin.themes.app')
@section('content')
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Detail Kamar</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ url('/kelola-kamar') }}">Kelola Kamar</a></li>
                        <li class="breadcrumb-item active">Detail Kamar</li>
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
                    <h4 align="center">Detail </br> Kamar {{ $kamar->nomor_kamar }} | {{ $kamar->nama_gedung }}</h4>
                    <hr><br>

                    <div class="row" align="center">
                        <div class="col-4">
                            <h6>Nomor Kamar</h6>
                            <p>{{ $kamar->nomor_kamar }}</p>
                        </div>
                        <div class="col-4">
                            <h6>Nama Gedung</h6>
                            <p>{{ $kamar->nama_gedung }}</p>
                        </div>
                        <div class="col-4">
                            <h6>Status</h6>
                            @if ($kamar->status === 'kosong')
                            <div class="badge badge-soft-success font-size-12">Kosong</div>
                            @elseif ($kamar->status === 'terisi')
                            <div class="badge badge-soft-danger font-size-12">Terisi</div>
                            @elseif ($kamar->status === 'perbaikan')
                            <div class="badge badge-soft-secondary font-size-12">Perbaikan</div>
                            @endif
                        </div>
                    </div><br>
                    <div class="mb-3">
                        <h6>Fasilitas :</h6>
                        <p>{{ $kamar->fasilitas }}</p>
                    </div><br>
                    <div class="mb-3">
                        <h6>Deskripsi :</h6>
                        <p>{{ $kamar->deskripsi }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection