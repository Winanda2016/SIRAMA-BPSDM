@extends('admin.themes.app')
@php
$ar_judul = ['No','Username','Email','No.HP','Role','Aksi'];
$no = 1;
@endphp
@section('content')
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Kelola Pengguna</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ url('/kelola-users') }}">Kelola pengguna</a></li>
                        <li class="breadcrumb-item active">Daftar Pengguna</li>
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

                                <button type="button" class="btn btn-primary waves-effect btn-label waves-light" data-bs-toggle="modal" data-bs-target="#tambahJInstansi">
                                    <i class="bx bx-plus label-icon"></i>
                                    Tambah Pengguna
                                </button>

                                <!-- Modal Tambah Users -->
                                <div class="modal fade" id="tambahJInstansi" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="tambahJInstansiLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content border-primary">
                                            <div class="modal-header bg-gradient bg-primary">
                                                <h5 class="modal-title text-white" id="tambahJInstansiLabel">Tambah Pengguna</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form class="row" method="POST" action="{{ route('kelola-users.store') }}">
                                                    @csrf
                                                    <div class="row mb-3">
                                                        <div class="col-3">
                                                            <label for="name" class="form-label">Nama</label>
                                                        </div>
                                                        <div class="col-9">
                                                            <input type="text" class="form-control" id="name" name="name" :value="old('name')" required autofocus autocomplete="name">
                                                        </div>
                                                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-3">
                                                            <label for="email" class="form-label">Email</label>
                                                        </div>
                                                        <div class="col-9">
                                                            <input type="email" class="form-control" id="email" name="email" :value="old('email')" required autocomplete="email">
                                                        </div>
                                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-3">
                                                            <label for="no_hp" class="form-label">Nomor HP</label>
                                                        </div>
                                                        <div class="col-9">
                                                            <input type="no_hp" class="form-control" id="no_hp" name="no_hp" :value="old('no_hp')" required autocomplete="no_hp">
                                                        </div>
                                                        <x-input-error :messages="$errors->get('no_hp')" class="mt-2" />
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-3">
                                                            <label for="password" class="form-label">Password</label>
                                                        </div>
                                                        <div class="col-9">
                                                            <input type="password" class="form-control" id="password" name="password" required autocomplete="new-password" />
                                                        </div>
                                                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-3">
                                                            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                                                        </div>
                                                        <div class="col-9">
                                                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required autocomplete="new-password" />
                                                        </div>
                                                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                                    </div>
                                                    <div class="mt-3 mb-3">
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
                    <!-- end row -->

                    <div class="table-responsive">
                        <table class="table align-middle table-bordered datatable dt-responsive table-check nowrap" style=" width: 100%;">
                            <thead class="table-primary">
                                @foreach($ar_judul as $jdl)
                                <th style="text-align: center;">{{ $jdl }}</th>
                                @endforeach
                            </thead>
                            <tbody align="center">
                                <tr>
                                    @foreach($kuser as $ku)
                                    <td style="width: 1%;"><a href="javascript: void(0);" class="text-body fw-medium">{{ $no++ }}</a> </td>
                                    <td>{{ $ku->name }}</td>
                                    <td>{{ $ku->email }}</td>
                                    <td>{{ $ku->no_hp }}</td>
                                    <td>{{ $ku->role }}</td>
                                    <td>
                                        @php
                                        $no_hp = $ku->no_hp;
                                        if (!preg_match('/^\+\d+/', $no_hp)) {
                                        $no_hp = '+62' . ltrim($no_hp, '0');
                                        }
                                        @endphp
                                        <a href="https://wa.me/{{ $no_hp }}" class="btn btn-success waves-effect waves-light m-1"><i class="bx bxl-whatsapp font-size-20 align-middle"></i></a>

                                        <button type="button" class="btn btn-warning waves-effect waves-light m-1" title="edit" data-bs-toggle="modal" data-bs-target="#editJInstansi{{ $ku->id }}">
                                            <i class="bx bxs-edit font-size-20 align-middle"></i>
                                        </button>
                                        <!-- Modal Edit JInstansi -->
                                        <div class="modal fade" id="editJInstansi{{ $ku->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="editJInstansiLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content border-primary">
                                                    <div class="modal-header bg-gradient bg-primary">
                                                        <h5 class="modal-title text-white" id="editJInstansiLabel">FORM EDIT JENIS INSTANSI</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body" align="left">
                                                        <form class="row" method="POST" action="{{ route('kelola-users.update', ['kelola_user' => $ku->id]) }}">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="mb-3">
                                                                <label for="name" class="form-label">Nama</label>
                                                                <input class="form-control" type="text" name="name" value="{{ $ku->name }}" id="name">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="eemail" class="form-label">Jenis Instansi</label>
                                                                <input class="form-control" type="text" name="email" value="{{ $ku->email }}" id="email">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="no_hp" class="form-label">Nomor HP</label>
                                                                <input class="form-control" type="text" name="no_hp" value="{{ $ku->no_hp }}" id="no_hp">
                                                            </div>
                                                            <div class="mt-3 mb-3">
                                                                <button type="reset" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                                                                <button type="submit" class="btn btn-primary mx-2">Simpan</button>
                                                            </div>
                                                        </form>
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