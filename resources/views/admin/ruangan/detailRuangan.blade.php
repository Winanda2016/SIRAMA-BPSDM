@extends('admin.themes.app')
@section('content')
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Detail Ruangan</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ url('/kelola-ruangan') }}">Kelola Ruangan</a></li>
                        <li class="breadcrumb-item active">Detail Ruangan</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body"  style="text-transform: capitalize;">
                    <h4 align="center">Detail </br> {{ $ruangan->nama_ruangan }} | {{ $ruangan->nama_gedung }}</h4>
                    <hr>
                    <div>
                                    @if($message = Session::get('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <i class="mdi mdi-check-all me-2"></i>
                                        {{ $message }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                    @endif
                                    @if($message = Session::get('error'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <i class="mdi mdi-block-helper me-2"></i>
                                        {{ $message }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                    @endif
                                </div>
                    <a href="{{ route('edit_ruangan', $ruangan->ruangan_id) }}" type="button" class="btn btn-warning waves-effect btn-label waves-light">
                        <i class="bx bxs-edit label-icon"></i>
                        <b>Edit Ruangan</b>
                    </a>
                    <div class="row mt-3">
                        <div class="col-lg-5">
                            <img src="{{ asset($ruangan->foto) }}" alt="Foto Ruangan" class="img-thumbnail me-2">
                        </div><br>
                        <div class="col-lg-7">
                            <div class="row">
                                <div class="col mb-2">
                                    @if ($ruangan->status === 'kosong')
                                    <div class="badge badge-soft-success font-size-12">Kosong</div>
                                    @elseif ($ruangan->status === 'terisi')
                                    <div class="badge badge-soft-danger font-size-12">Terisi</div>
                                    @elseif ($ruangan->status === 'perbaikan')
                                    <div class="badge badge-soft-secondary font-size-12">Perbaikan</div>
                                    @endif
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <h6>Nama Rungan</h6>
                                </div>
                                <div class="col-md-8">
                                    <p> : {{ $ruangan->nama_ruangan }}</p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <h6>Nama Gedung</h6>
                                </div>
                                <div class="col-md-8">
                                    <p> : {{ $ruangan->nama_gedung }}</p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <h6>Harga</h6>
                                </div>
                                <div class="col-md-8">
                                    <p> : Rp. {{ $ruangan->formatted_harga }}</p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <h6>Kapasitas</h6>
                                </div>
                                <div class="col-md-8">
                                    <p> : {{ $ruangan->kapasitas }} Orang</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="mb-3">
                        <h6>Fasilitas :</h6>
                        <p>{!! nl2br(e($ruangan->fasilitas)) !!}</p>
                    </div><br>
                    <div class="mb-3">
                        <h6>Deskripsi :</h6>
                        <p>{!! nl2br(e($ruangan->deskripsi)) !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection