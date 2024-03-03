@extends('admin.themes.app')
@section('content')
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Kelola Gedung</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">Kelola Gedung</li>
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
                                <button type="button" class="btn btn-primary waves-effect btn-label waves-light" data-bs-toggle="modal" data-bs-target="#tambahGedung">
                                    <i class="bx bx-plus label-icon"></i>
                                    Tambah Gedung
                                </button>

                                <!-- Static Backdrop Modal -->
                                <div class="modal fade" id="tambahGedung" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="tambahGedungLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="tambahGedungLabel">Form Tambah Gedung</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="example-text-input" class="form-label">Nama Gedung</label>
                                                    <input class="form-control" type="text" value="Artisanal kale" id="example-text-input">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                                                <button type="button" class="btn btn-success">Simpan</button>
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
                                <tr class="bg-transparent">
                                    <th style="text-align: center;">No</th>
                                    <th style="text-align: center;">Nama Gedung</th>
                                    <th style="text-align: center;">Action</th>
                                </tr>
                            </thead>
                            <tbody align="center">
                                <tr>
                                    <td style="width: 1%;"><a href="javascript: void(0);" class="text-body fw-medium">1</a> </td>
                                    <td style="width: 74%;"> mmmmmmm </td>
                                    <td style="width: 25%;">
                                        <button type="button" class="btn btn-warning waves-effect waves-light  p-1" data-bs-toggle="modal" data-bs-target="#editGedung" style="width: 35px; height:30px; margin-right:5px">
                                            <i class="bx bxs-edit font-size-16 align-middle"></i>
                                        </button>

                                        <!-- Static Backdrop Modal -->
                                        <div class="modal fade" id="editGedung" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="editGedungLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editGedungLabel">Form Edit Gedung</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="example-text-input" class="form-label">Nama Gedung</label>
                                                            <input class="form-control" type="text" value="Artisanal kale" id="example-text-input">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                                                        <button type="button" class="btn btn-success">Simpan</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <a type="button" class="btn btn-danger waves-effect waves-light p-1" href="#" style="width: 35px; height:30px; margin-right:5px">
                                            <i class="bx bx-trash font-size-16 align-middle"></i>
                                        </a>
                                    </td>
                                </tr>
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