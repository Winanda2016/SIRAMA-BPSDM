@extends('admin.themes.app')
@php
$ar_judul = ['No','Username','Email','NIK','No.HP','Role','Aksi'];
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
                                <a type="button" href="{{ url('/registrasi-user') }}" class="btn btn-primary waves-effect btn-label waves-light">
                                    <i class="bx bx-plus label-icon"></i>
                                    Tambah Pengguna
                                </a>
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
                                    <td>{{ $ku->username }}</td>
                                    <td>{{ $ku->email }}</td>
                                    <td>{{ $ku->nik }}</td>
                                    <td>{{ $ku->no_hp }}</td>
                                    <td>{{ $ku->role }}</td>
                                    <td>
                                        <button type="button" class="btn btn-danger waves-effect waves-light p-1" title="hapus" data-bs-toggle="modal" data-bs-target="#hapusPengguna{{ $ku->id }}" style="width: 35px; height:30px; margin-right:5px">
                                            <i class="bx bx-trash font-size-16 align-middle"></i>
                                        </button>
                                        <!-- Modal Hapus Instansi -->
                                        <div class="modal fade" id="hapusPengguna{{ $ku->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content border-danger" style="width: fit-content;">
                                                    <div class="modal-header bg-danger">
                                                        <h5 class="modal-title text-white" id="hapusPenggunaLabel">PERINGATAN!!!</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body m-2">
                                                        <h6>Yakin akan menghapus pengguna dengan username "{{ $ku->username }}"?</h6>
                                                        <p>(Data yang dihapus tidak dapat dikembalikan lagi.)</p>
                                                        <div align="right">
                                                            <button type="reset" class="btn btn-secondary m-1" data-bs-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn btn-danger m-1">Hapus</button>
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