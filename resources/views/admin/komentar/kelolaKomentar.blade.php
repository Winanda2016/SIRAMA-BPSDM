@extends('admin.themes.app')
@php
$ar_judul = ['No','Nama','Tanggal','Saran/Pengaduan','Balasan','Aksi'];
$no = 1;
@endphp
@section('content')
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Kelola Saran dan Pengaduan</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">Saran dan Pegaduan</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg">
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
                                @foreach($komentar as $km)
                                <tr>
                                    <td style="width: 1%"><a href="javascript: void(0);" class="text-body fw-medium">{{ $no++ }}</a> </td>
                                    <td style="width: 19%;">{{ $km->nama_user }}</td>
                                    <td style="width: 10%;">{{ $km->tanggal }}</td>
                                    <td style="width: 30%;  word-wrap: break-word; white-space: normal;">{{ $km->komentar }}</td>
                                    <td style="width: 30%;  word-wrap: break-word; white-space: normal;">{{ $km->balasan }}</td>
                                    <td style="width: 10%;">
                                        <div class="d-flex justify-content-center" align="center">
                                            <button type="button" class="btn btn-warning waves-effect waves-light p-1" title="edit" data-bs-toggle="modal" data-bs-target="#editSP{{ $km->komentar_id }}" style="width: 35px; height:30px; margin-right:15px">
                                                <i class="bx bxs-edit font-size-16 align-middle"></i>
                                            </button>

                                            <!-- Modal Saran dan pengaduan -->
                                            <div class="modal fade" id="editSP{{ $km->komentar_id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="editSPLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content border-primary">
                                                        <div class="modal-header bg-gradient bg-primary">
                                                            <h5 class="modal-title text-white" id="editSPLabel">Form Edit Saran dan Pengaduan</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body" align="left">
                                                            <form class="row g-3" method="POST" action="{{ route('komentar.update', ['komentar' => $km->komentar_id]) }}">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="mb-3">
                                                                    <label for="example-text-input" class="form-label">Saran dan Pengaduan</label>
                                                                    <textarea id="fasilitas" name="komentar" class="form-control" rows="3" readonly>{{ $km->komentar }}</textarea>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="example-text-input" class="form-label">Inputkan Balasan</label>
                                                                    <textarea id="fasilitas" name="balasan" class="form-control" rows="3">{{ $km->balasan }}</textarea>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <button type="reset" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                                                                    <button type="submit" class="btn btn-success mx-2">Simpan</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <button type="button" class="btn btn-danger waves-effect waves-light p-1" title="hapus" data-bs-toggle="modal" data-bs-target="#hapusSP{{ $km->komentar_id }}" style="width: 35px; height:30px; margin-right:5px">
                                                <i class="bx bx-trash font-size-16 align-middle"></i>
                                            </button>
                                            <!-- Modal Hapus Geudng -->
                                            <div class="modal fade" id="hapusSP{{ $km->komentar_id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="hapusSPLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content" style="width: fit-content;">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="staticBackdropLabel">Peringatan Hapus!</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <h6>Hapus Saran dan Pengaduan oleh "{{ $km->nama_user }}"?</h6>
                                                            <p>(Data yang dihapus tidak dapat dikembalikan lagi.)</p>

                                                            <div align="right">
                                                                <form method="POST" action="{{ route('komentar.destroy', $km->komentar_id) }}">
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