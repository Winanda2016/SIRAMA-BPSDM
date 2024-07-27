@extends('admin.themes.app')
@section('content')
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Detail Permintaan Reservasi</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Permintaan Reservasi</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">List Permintaan</a></li>
                        <li class="breadcrumb-item active">Detail</li>
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
                    <div class="invoice-title">
                        <div class="d-flex align-items-start">
                            <div class="flex-grow-1">
                                <div class="mb-4">
                                    <img src="{{ asset('admin/assets/images/users/avatar-9.jpg') }}" alt="" height="24"><span class="logo-txt">{{ $data->nama_users }}</span>
                                </div>
                            </div>
                            <div class="flex-shrink-0">
                                <div class="mb-4">
                                    @if ($jenis_transaksi === 'kamar')
                                    <h4 class="float-end font-size-16">Kamar</h4>
                                    @elseif ($jenis_transaksi === 'ruangan')
                                    <h4 class="float-end font-size-16">{{ $data->nama_ruangan }}</h4>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- <p class="mb-1">Umum</p> -->
                        <p class="mb-1"><i class="mdi mdi-email align-middle me-1"></i> {{ $data->email_users }} </p>
                        <p><i class="mdi mdi-phone align-middle me-1"></i> {{ $data->nohp_users }}</p>
                    </div>
                    <hr class="my-4">
                    <div class="row">
                        <div class="col-sm-4">
                            <div>
                                <h5 class="font-size-15 mb-3">Reservasi:</h5>
                                <h5 class="font-size-14 mb-2">{{ $data->nama }}</h5>
                                <p class="mb-1">{{ $data->nama_instansi }}</p>
                                <p class="mb-1">{{ $data->nohp }}</p>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div>
                                <div>
                                    <h5 class="font-size-15">Tanggal Reservasi:</h5>
                                    <p>{{ $data->tgl_reservasi }}</p>
                                </div>

                                <div class="mt-4">
                                    <h5 class="font-size-15">Tanggal Check in:</h5>
                                    <p>{{ $data->tgl_checkin }}</p>
                                </div>

                                <div class="mt-4">
                                    <h5 class="font-size-15">Tanggal Check out:</h5>
                                    <p>{{ $data->tgl_checkout }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div>
                                <div>
                                    <h5 class="font-size-15">Jumlah Orang:</h5>
                                    <p>{{ $data->jumlah_orang }} Orang</p>
                                </div>

                                @if ($jenis_transaksi === 'kamar')
                                <div class="mt-4">
                                    <h5 class="font-size-15">Nomor Kamar:</h5>
                                    <p>101</p>
                                </div>
                                @elseif ($jenis_transaksi === 'ruangan')
                                <div class="mt-4">
                                    <h5 class="font-size-15">Nama Ruangan:</h5>
                                    <p>{{ $data->nama_ruangan }}</p>
                                </div>
                                @endif

                                <div class="mt-4">
                                    <h5 class="font-size-15">Nama Gedung:</h5>
                                    <p>{{ $data->nama_gedung }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="py-2">
                        <h5 class="font-size-15">Dokumen Reservasi :</h5>
                        <a type="button" class="mb-1">
                            <i class="bx bxs-file-pdf font-size-20 align-middle" style="color: red;"></i>
                            --
                        </a>
                    </div>

                    <div class="py-2 mt-3">
                        <h5 class="font-size-15">Ringkasan Reservasi</h5>
                    </div>
                    <div class="p-4 border rounded">
                        <div class="table-responsive">
                            <table class="table table-nowrap align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th style="width: 70px;">No.</th>
                                        <th>Harga</th>
                                        <th>Jumlah Orang</th>
                                        <th>Jumlah Hari</th>
                                        <th class="text-end" style="width: 120px;">Total Harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">01</th>
                                        <td>
                                            <h5 class="font-size-15 mb-1">Rp.{{ $data->harga }}</h5>
                                        </td>
                                        <td>
                                            <h5 class="font-size-15 mb-1">{{ $data->jumlah_orang }} Orang</h5>
                                        </td>
                                        <td>
                                            <h5 class="font-size-15 mb-1">{{ $data->total_hari }} Hari</h5>
                                        </td>
                                        <td class="text-end">Rp.{{ $data->formatted_harga }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row" colspan="4" class="border-0 text-end">
                                            Diskon</th>
                                        <td class="text-end">0 %</td>
                                    </tr>
                                    <tr>
                                        <th scope="row" colspan="4" class="border-0 text-end">Total</th>
                                        <td class="border-0 text-end">
                                            <h4 class="m-0">Rp.{{ $data->formatted_harga }},00</h4>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="d-print-none mt-3">
                        <div class="float-end">
                            <a href="#" class="btn btn-success waves-effect waves-light me-1" title="whatsapp"><i class="bx bxl-whatsapp font-size-20 align-middle"></i></a>
                            @if ($jenis_transaksi === 'kamar')
                            <button type="button" class="btn btn-success waves-effect waves-light" style="width: 70px;" data-bs-toggle="modal" data-bs-target="#tambahKamar">Terima</button>

                            <!-- Modal Tambah Kamar -->
                            <div class="modal fade" id="tambahKamar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="tambahKamarLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="tambahKamarLabel">Form Tambah Gedung</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form class="row g-3" method="POST" action="{{ route('gedung.store') }}">
                                                @csrf
                                                <div class="mb-3">
                                                    <label for="example-text-input" class="form-label">Nama Gedung</label>
                                                    <select class="form-control choices" name="choices-multiple-remove-button" id="choices-multiple-remove-button" placeholder="This is a placeholder" multiple>
                                                        <option value="Choice 1" selected>Choice 1</option>
                                                        <option value="Choice 2">Choice 2</option>
                                                        <option value="Choice 3">Choice 3</option>
                                                        <option value="Choice 4">Choice 4</option>
                                                    </select>
                                                    <input class="form-control" type="text" name="nama_gedung" id="example-text-input">
                                                </div>
                                                <div class="mb-3">
                                                    <button type="reset" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-success">Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @elseif ($jenis_transaksi === 'ruangan')
                            <button type="button" class="btn btn-success waves-effect waves-light" style="width: 70px;" data-bs-toggle="modal" data-bs-target="#terimaRRuangan">Terima</button>

                            <!-- Modal Tambah Kamar -->
                            <div class="modal fade" id="terimaRRuangan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="terimaRRuanganLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="terimaRRuanganLabel">Peringatan!</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <h6>Terima Reservasi atas nama {{ $data->nama }}?</h6>

                                            <div align="right">
                                                <form method="POST" action="method=" POST" action=" ">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary">Terima</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif

                            <button type="button" class="btn btn-danger waves-effect waves-light" style="width: 70px;" data-bs-toggle="modal" data-bs-target="#tolakReservasi">Tolak</button>

                            <!-- Modal Tambah Kamar -->
                            <div class="modal fade" id="tolakReservasi" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="tolakReservasiLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="tolakReservasiLabel">Peringatan!</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <h6>Tolak Reservasi atas nama {{ $data->nama }}?</h6>

                                            <div align="right">
                                                <form method="POST" action="method=" POST" action=" ">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-danger">Tolak</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('#multiple-select').mobiscroll().select({
        inputElement: document.getElementById('my-input'),
        touchUi: false
    });
</script>
@endsection