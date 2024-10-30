@extends('admin.themes.app')
@section('content')
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Edit Ruangan</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ url('/kelola-ruangan') }}">Kelola Ruangan</a></li>
                        <li class="breadcrumb-item active">Edit Ruangan</li>
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
                    <h4 align="center">Formulir Edit </br> {{ $ruangan->nama_ruangan }} | {{ $ruangan->nama_gedung }}</h4>
                    <hr><br>
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
                    <form method="POST" action="{{ route('update_ruangan', ['id' => $ruangan->ruangan_id]) }}" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Nama Gedung</label>
                                    <select name="gedung_id" required class="form-control form-select">
                                        @foreach ($gedung as $g)
                                        <option value="{{ $g->id }}" {{ $g->id == $ruangan->gedung_id ? 'selected' : '' }}>
                                            {{ $g->nama_gedung }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="nama_ruangan" class="form-label">Nama Ruangan</label>
                                    <input class="form-control" type="text" name="nama_ruangan" id="nama_ruangan" value="{{ $ruangan->nama_ruangan }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="harga" class="form-label">Harga</label>
                                    <input class="form-control" type="text" name="harga" id="harga" value="{{ $ruangan->harga }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="kapasitas" class="form-label">Kapasitas</label>
                                    <input class="form-control" type="text" name="kapasitas" id="kapasitas" value="{{ $ruangan->kapasitas }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="fasilitas" class="form-label">Fasilitas</label>
                                    <textarea id="basicpill-address-input" name="fasilitas" class="form-control" rows="5" value="{{ $ruangan->fasilitas }}"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label for="status" class="form-label">Status Ruangan</label>
                            <div class="col-md-2">
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="radio" name="status" id="status_kosong" value="kosong" checked>
                                    <label class="form-check-label" for="status_kosong">Kosong</label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="radio" name="status" id="status_terisi" value="terisi">
                                    <label class="form-check-label" for="status_terisi">Terisi</label>
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
                                    <label for="foto" class="form-label">Foto</label>
                                    <div class="row">
                                        <div class="col-4 mb-3">
                                            @if($ruangan->foto)
                                            <img src="{{ asset($ruangan->foto) }}" alt="Foto Ruangan" class="img-thumbnail me-2">
                                            @else
                                            <span class="text-danger"><u>Tidak ada foto.</u></span>
                                            @endif
                                        </div>
                                    </div>
                                    <input type="file" class="form-control" id="foto" name="foto">
                                    <p class="text-secondary">*upload foto baru jika perlu</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="deskripsi" class="form-label">Deskripsi</label>
                                    <textarea id="deskripsi" class="form-control" name="deskripsi" rows="5" value="{{ $ruangan->deskripsi }}"></textarea>
                                </div>
                            </div>
                        </div> <br>

                        <a type="reset" class="btn btn-danger waves-effect waves-light m-1" href="{{ url('/kelola-ruangan') }}"><b>Batal</b></a>
                        <button type="submit" class="btn btn-success waves-effect waves-light m-1"><b>Simpan</b></button>
                    </form>
                </div>



            </div>
        </div>
    </div>
</div>
</div>
@endsection