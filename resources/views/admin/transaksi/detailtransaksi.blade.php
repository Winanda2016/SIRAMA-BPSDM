@extends('admin.themes.app')
@section('content')
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Detail Transaksi</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ url('/riwayat-transaksi') }}">Transaksi</a></li>
                        <li class="breadcrumb-item active">Detail Transaksi</li>
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
                                    <img src="{{ asset('tamu/assets/img/profile/no_profile.png') }}" alt="" height="24"><span class="logo-txt">{{ $data->nama_users }} | </span>

                                    @if ($data->status_transaksi === 'pending')
                                    <div class="badge badge-soft-secondary font-size-12">pending</div>
                                    @elseif ($data->status_transaksi === 'checkin')
                                    <div class="badge badge-soft-primary font-size-12">check in</div>
                                    @elseif ($data->status_transaksi === 'checkout')
                                    <div class="badge badge-soft-danger font-size-12">check out</div>
                                    @elseif ($data->status_transaksi === 'terima')
                                    <div class="badge badge-soft-success font-size-12">di terima</div>
                                    @elseif ($data->status_transaksi === 'tolak')
                                    <div class="badge badge-soft-danger font-size-12">di tolak</div>
                                    @elseif ($data->status_transaksi === 'batal')
                                    <div class="badge badge-soft-danger font-size-12">di batalkan</div>
                                    @endif
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
                                <h5 class="font-size-15 mb-3">
                                    Transaksi:
                                </h5>
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
                                <div>
                                    <h5 class="font-size-15">Jumlah Ruangan:</h5>
                                    <p>{{ $data->jumlah_ruangan }} Ruangan</p>
                                </div>

                                @if ($jenis_transaksi === 'kamar')
                                <div class="mt-4">
                                    <h5 class="font-size-15">Kamar:</h5>
                                    <table>
                                        @foreach ($kamar as $k)
                                        <tr>
                                            <td>
                                                <h5 class="font-size-15 m-0 mx-2">{{ $k->nomor_kamar }}</h5>
                                            </td>
                                            <td>
                                                <p class="m-0 mx-2">|| {{ $k->nama_gedung }}</p>
                                            </td>
                                            @if ( $data->status_transaksi === 'terima' || $data->status_transaksi === 'checkin')
                                            <td>
                                                <form action="{{ route('hapus_kamar_transaksi', ['jenis_transaksi' => $jenis_transaksi, 'id' => $k->detail_id]) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger waves-effect waves-light" title="hapus" style="width: 25px; height:25px;padding:0px">
                                                        <i class="bx bx-trash font-size-14 align-middle"></i>
                                                    </button>
                                                </form>
                                            </td>
                                            @endif
                                        </tr>
                                        @endforeach
                                    </table>
                                    @if ( $data->status_transaksi === 'terima' || $data->status_transaksi === 'checkin')
                                    <button type="button" class="btn btn-primary waves-effect waves-light px-1 mt-2" data-bs-toggle="modal" data-bs-target="#tambahKamar" style="width: fit-content; height:25px;padding:0px">
                                        tambah kamar
                                    </button>

                                    <!-- Modal Tambah Kamar -->
                                    <div class="modal fade" id="tambahKamar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="tambahKamarLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content border-primary">
                                                <div class="modal-header bg-gradient bg-primary">
                                                    <h5 class="modal-title text-white" id="tambahKamarLabel">Tambahkan Kamar!</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('tambah_kamar_transaksi', ['jenis_transaksi' => $jenis_transaksi, 'id' => $data->transaksi_id]) }}" method="POST" id="formSimpanKamar">
                                                        @csrf
                                                        <input type="hidden" name="transaksi_id" value="{{ $data->id }}">
                                                        <input type="hidden" name="jinstansi_id" value="{{ $data->jinstansi_id }}">
                                                        <div class="mb-3">
                                                            <label for="example-text-input" class="form-label">Pilih kamar :</label>
                                                            <select id="kamar_ids" name="kamar_ids[]" class="selectpicker" multiple data-live-search="true" data-width="75%" data-size="5">
                                                                @foreach ($AddKamar as $ak)
                                                                @if (($ak->status_transaksi === 'pending' || $ak->status_transaksi === 'kosong') && $ak->status_kamar === 'kosong')
                                                                <option value="{{ $ak->kamar_id }}" @if (in_array($ak->kamar_id, old('kamar_ids', []))) selected @endif>
                                                                    {{ $ak->nomor_kamar }} | {{ $ak->nama_gedung }}
                                                                </option>
                                                                @else
                                                                <option class="bg-light" disabled>
                                                                    {{ $ak->nomor_kamar }} | {{ $ak->nama_gedung }}
                                                                </option>
                                                                @endif
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div align="right">
                                                            <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn btn-primary">Selesai</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                                @elseif ($jenis_transaksi === 'ruangan')
                                <div class="mt-4">
                                    <h5 class="font-size-15">Nama Ruangan:</h5>
                                    <p>{{ $data->nama_ruangan }}</p>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="py-2">
                        <h5 class="font-size-15">Dokumen Reservasi :</h5>
                        <a type="button" class="mb-1">
                            <i class="bx bxs-file-pdf font-size-20 align-middle" style="color: red;"></i>
                            @if($data->dokumen_reservasi)
                            @php
                            $filePath = asset($data->dokumen_reservasi);
                            $fileName = basename($data->dokumen_reservasi);
                            @endphp
                            <a href="{{ $filePath }}" download="{{ $fileName }}" style="font-size: 12px;">
                                <u>{{ $fileName }}</u>
                            </a>
                            @else
                            <span class="text-danger" style="font-size: 12px;"><u>dokumen reservasi tidak tersedia.</u></span>
                            @endif
                        </a>
                    </div>
                    <div class="py-2">
                        <h5 class="font-size-15">Bukti Bayar :</h5>
                        <a type="button" class="mb-1">
                            <i class="bx bxs-file-jpg font-size-20 align-middle" style="color: rgba(75, 166, 239, 0.4);"></i>
                            @if($data->bukti_bayar)
                            @php
                            $filePath = asset($data->bukti_bayar);
                            $fileName = basename($data->bukti_bayar);
                            @endphp
                            <a href="{{ $filePath }}" download="{{ $fileName }}" style="font-size: 12px;">
                                <u>{{ $fileName }}</u>
                            </a>
                            @else
                            <span class="text-info" style="font-size: 12px;"><u>bukti bayar tidak tersedia.</u></span>
                            @endif
                        </a>
                    </div>

                    <div class="py-2 mt-3">
                        <h5 class="font-size-15">Ringkasan Transaksi</h5>
                    </div>
                    <div class="p-4 border rounded">
                        <div class="table-responsive">
                            <table class="table table-nowrap align-middle mb-0">
                                <thead>
                                    <tr align="center">
                                        <th>Jenis Transaksi</th>
                                        <th>Jenis Instansi</th>
                                        <th>Harga</th>
                                        <th>Jumlah Orang</th>
                                        <th>Jumlah Hari</th>
                                        <th class="text-end" style="width: 120px;">Total Harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr align="center">
                                        @if ($jenis_transaksi === 'kamar')
                                        <th scope="row">Kamar</th>
                                        @elseif ($jenis_transaksi === 'ruangan')
                                        <th scope="row">{{ $data->nama_ruangan }}</th>
                                        @endif
                                        <th scope="row">{{ $data->jinstansi }}</th>
                                        @if ($jenis_transaksi === 'kamar')
                                        <td>Rp.{{ $data->jinstansi_harga }}</td>
                                        @elseif ($jenis_transaksi === 'ruangan')
                                        <td>Rp.{{ $data->ruangan_harga }}</td>
                                        @endif
                                        <td>{{ $data->jumlah_orang }} Orang</td>
                                        <td>{{ $total_hari }} Hari</td>
                                        <td class="text-end">Rp. {{ $data->harga }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row" colspan="5" class="border-0 text-end">
                                            Diskon</th>
                                        <td class="text-end">{{ $data->diskon }} %</td>
                                    </tr>
                                    <tr>
                                        <th scope="row" colspan="5" class="border-0 text-end">Total</th>
                                        <td class="border-0 text-end">
                                            <h4 class="m-0">{{ $data->formatted_harga }},00</h4>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="d-print-none mt-3">
                        <div class="float-end">
                            @php
                            $whatsappNumber = $data->no_hp;
                            if (!str_starts_with($whatsappNumber, '+62')) {
                            $whatsappNumber = '+62' . ltrim($whatsappNumber, '0');
                            }
                            @endphp
                            <a href="https://wa.me/{{ $whatsappNumber }}" class="btn btn-success waves-effect waves-light m-1"><i class="bx bxl-whatsapp font-size-20 align-middle"></i></a>

                            <!-- ============================================================= -->
                            @if( Auth::user()->role == 'pegawa')
                            @if ($data->status_transaksi === 'terima')
                            <!-- == Edit Reservasi == -->
                            @if ($jenis_transaksi === 'kamar')
                            <a href="{{ route('admin_reservasiKamar.edit', $data->transaksi_id) }}" class="btn btn-warning waves-effect waves-light m-1" title="edit"><i class="bx bx-edit-alt font-size-20 align-middle"></i></a>
                            @elseif ($jenis_transaksi === 'ruangan')
                            <a href="{{ route('admin_reservasiRuangan.edit', ['id' => $data->transaksi_id]) }}" class="btn btn-warning waves-effect waves-light m-1" title="edit"><i class="bx bx-edit-alt font-size-20 align-middle"></i></a>
                            @endif

                            <button type="button" class="btn btn-primary waves-effect waves-light m-1" data-bs-toggle="modal" data-bs-target="#checkin"><b>Check In</b></button>
                            <!-- == Modal Check In == -->
                            <div class="modal fade" id="checkin" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="checkinLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content border-primary">
                                        <div class="modal-header bg-gradient bg-primary">
                                            <h5 class="modal-title text-white" id="staticBackdropLabel">Peringatan Check In!</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <br>
                                            <p align="center">Check In Reservasi atas nama <b>"{{ $data->nama }}"</b> ?</p><br>
                                            <div align="right">
                                                <form method="POST" action="{{ route('checkin', ['jenis_transaksi' => $jenis_transaksi, 'id' => $data->transaksi_id]) }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="reset" class="btn btn-danger mx-2" data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary">Check In</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button type="button" class="btn btn-danger waves-effect waves-ligh m-1" data-bs-toggle="modal" data-bs-target="#cancel"><b>Cancel</b></button>
                            <!-- == Modal Cancel == -->
                            <div class="modal fade" id="cancel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="cancelLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content border-primary">
                                        <div class="modal-header bg-gradient bg-primary">
                                            <h5 class="modal-title text-white" id="staticBackdropLabel">Peringatan Cancel Reservasi!</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <br>
                                            <p align="center">Cancel (batalkan) Reservasi atas nama <b>"{{ $data->nama }}"</b> ?</p><br>
                                            <div align="right">
                                                <form id="cancelForm" action="{{ route('cancel_reservasi', ['id' => $data->transaksi_id]) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="reset" class="btn btn-secondary mx-2" data-bs-dismiss="modal">Kembali</button>
                                                    <button type="submit" class="btn btn-danger">Cancel</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- ============================================================= -->

                            @elseif ($data->status_transaksi === 'pending')
                            @if ($jenis_transaksi === 'kamar')
                            <button type="button" class="btn btn-success waves-effect waves-light m-1" style="width: 70px;" data-bs-toggle="modal" data-bs-target="#terimaRKamar">Terima</button>

                            <!-- Modal Terima Reservasi Kamar -->
                            <div class="modal fade" id="terimaRKamar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="terimaRKamarLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content border-primary">
                                        <div class="modal-header bg-gradient bg-primary">
                                            <h5 class="modal-title text-white" id="terimaRKamarLabel">Tambahkan Kamar!</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('tambah_kamar_transaksi', ['jenis_transaksi' => $jenis_transaksi,'id' => $data->transaksi_id]) }}" method="POST" id="formSimpanKamar">
                                                @csrf
                                                <input type="hidden" name="transaksi_id" value="{{ $data->id }}">
                                                <input type="hidden" name="jinstansi_id" value="{{ $data->jinstansi_id }}">
                                                <div class="mb-3">
                                                    <label for="example-text-input" class="form-label">Pilih kamar :</label>
                                                    <select id="kamar_ids" name="kamar_ids[]" class="selectpicker" multiple data-live-search="true" data-width="75%" data-size="5">
                                                        @foreach ($AddKamar as $ak)
                                                        @if (($ak->status_transaksi === 'pending' || $ak->status_transaksi === 'kosong') && $ak->status_kamar === 'kosong')
                                                        <option value="{{ $ak->kamar_id }}" @if (in_array($ak->kamar_id, old('kamar_ids', []))) selected @endif>
                                                            {{ $ak->nomor_kamar }} | {{ $ak->nama_gedung }}
                                                        </option>
                                                        @else
                                                        <option class="bg-light" disabled>
                                                            {{ $ak->nomor_kamar }} | {{ $ak->nama_gedung }}
                                                        </option>
                                                        @endif
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div align="right">
                                                    <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary">Selesai</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @elseif ($jenis_transaksi === 'ruangan')
                            <button type="button" class="btn btn-success waves-effect waves-light m-1" style="width: 70px;" data-bs-toggle="modal" data-bs-target="#terimaRRuangan">Terima</button>

                            <!-- Modal Terima Reservasi Ruangan -->
                            <div class="modal fade" id="terimaRRuangan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="terimaRRuanganLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content border-primary">
                                        <div class="modal-header bg-gradient bg-primary">
                                            <h5 class="modal-title text-white" id="terimaRRuanganLabel">Peringatan!</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p align="center">Terima reservasi <b>{{ $data->nama_ruangan }}</b> atas nama <b>{{ $data->nama }}</b> ?</p>

                                            <div align="right">
                                                <form method="POST" action="{{ route('terima_reservasiRuangan', ['jenis_transaksi' => $jenis_transaksi, 'id' => $data->transaksi_id]) }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary">Terima</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif

                            <button type="button" class="btn btn-danger waves-effect waves-light m-1" style="width: 70px;" data-bs-toggle="modal" data-bs-target="#tolakReservasi">Tolak</button>
                            <!-- Modal Tolak Reservasi -->
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
                                                <form method="POST" action="{{ route('tolak_reservasi', ['id' => $data->transaksi_id]) }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-danger">Tolak</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button type="button" class="btn btn-danger waves-effect waves-light m-1" data-bs-toggle="modal" data-bs-target="#cancel"><b>Cancel</b></button>
                            <!-- == Modal Cancel == -->
                            <div class="modal fade" id="cancel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="cancelLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content border-primary">
                                        <div class="modal-header bg-gradient bg-primary">
                                            <h5 class="modal-title text-white" id="staticBackdropLabel">Peringatan Cancel Reservasi!</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <br>
                                            <p align="center">Cancel (batalkan) Reservasi atas nama <b>"{{ $data->nama }}"</b> ?</p><br>
                                            <div align="right">
                                                <form id="cancelForm" action="{{ route('cancel_reservasi', ['id' => $data->transaksi_id]) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="reset" class="btn btn-secondary mx-2" data-bs-dismiss="modal">Kembali</button>
                                                    <button type="submit" class="btn btn-danger">Cancel</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- ============================================================= -->

                            @elseif ($data->status_transaksi === 'checkin')
                            <button type="button" class="btn btn-warning waves-effect waves-light m-1" data-bs-toggle="modal" data-bs-target="#diskon"><b>Diskon</b></button>

                            <!-- Modal Diskon -->
                            <div class="modal fade" id="diskon" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="diskonLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content border-primary">
                                        <div class="modal-header bg-gradient bg-primary">
                                            <h5 class="modal-title text-white"" id=" diskonLabel">Diskon Transaksi</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body"><br>
                                            <form method="POST" action="{{ route('diskon_transaksi', ['jenis_transaksi' => $jenis_transaksi, 'id' => $data->transaksi_id]) }}">
                                                @csrf
                                                @method('PUT')
                                                <div class="mb-3">
                                                    <label for="example-text-input" class="form-label">Diskon (%)</label>
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <input class="form-control" type="number" name="diskon" value="{{ $data->diskon }}" id="example-text-input">
                                                        </div>
                                                        <div class="col-8" align="right">
                                                            <button type="reset" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn btn-success mx-2">Simpan</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- == Edit Reservasi == -->
                            @if ($jenis_transaksi === 'kamar')
                            <a href="{{ route('admin_reservasiKamar.edit', $data->transaksi_id) }}" class="btn btn-warning waves-effect waves-light me-1" title="edit"><i class="bx bx-edit-alt font-size-20 align-middle"></i></a>
                            @elseif ($jenis_transaksi === 'ruangan')
                            <a href="{{ route('edit_RRuangan', ['id' => $data->transaksi_id]) }}" class="btn btn-warning waves-effect waves-light me-1" title="edit"><i class="bx bx-edit-alt font-size-20 align-middle"></i></a>
                            @endif

                            <button type="button" class="btn btn-danger waves-effect waves-light m-1" data-bs-toggle="modal" data-bs-target="#checkout"><b>Check Out</b></button>

                            <!-- Modal Tolak Reservasi -->
                            <div class="modal fade" id="checkout" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="checkoutLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content border-primary">
                                        <div class="modal-header bg-gradient bg-primary">
                                            <h5 class="modal-title text-white"" id=" checkoutLabel">Peringatan!</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body"><br>
                                            <p align="center">Check Out transaksi atas nama <b>"{{ $data->nama }}"</b> ?</p><br>
                                            <div align="right">
                                                <form method="POST" action="{{ route('checkout', ['jenis_transaksi' => $jenis_transaksi, 'id' => $data->transaksi_id]) }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="reset" class="btn btn-secondary me-1" data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-danger">Check Out</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- ============================================================= -->
                            @endif
                            @elseif ($data->status_transaksi === 'checkout')
                            
                            <button type="button" class="btn btn-info waves-effect btn-label waves-light m-1" data-bs-toggle="modal" data-bs-target="#bukti_bayar">
                                <i class="bx bxs-file-jpg label-icon"></i>
                                Bukti Bayar
                            </button>
                            <!-- Modal Bukti Bayar -->
                            <div class="modal fade" id="bukti_bayar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="bukti_bayarLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content border-primary">
                                        <div class="modal-header bg-gradient bg-primary">
                                            <h5 class="modal-title text-white"" id=" bukti_bayarLabel">Tambah Bukti Bayar</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body"><br>
                                            <form id="bbayarForm" action="{{ route('bukti_bayar', ['jenis_transaksi' => $jenis_transaksi, 'id' => $data->transaksi_id]) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="mb-3">
                                                    <label for="bukti_bayar" class="form-label">Bukti Bayar</label>
                                                    <input type="file" class="form-control" id="bukti_bayar" name="bukti_bayar">
                                                    <div class="text-muted" style="font-size: 11px;">*file berupa JPEG/PNG/JPG/dan sebagainya.</div>
                                                </div>
                                                <div class="mb-3" align="right">
                                                    <button type="reset" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-success mx-2">Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button type="button" class="btn btn-primary waves-effect btn-label waves-light m-1" data-bs-toggle="modal" data-bs-target="#faktur">
                                <i class="bx bx-printer label-icon"></i>
                                Faktur
                            </button>

                            <!-- Modal Faktur -->
                            <div class="modal fade" id="faktur" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="fakturLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content border-primary">
                                        <div class="modal-header bg-gradient bg-primary">
                                            <h5 class="modal-title text-white"" id=" fakturLabel">Faktur Transaksi</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body"><br>
                                            <p align="center">Cetak atau Kirim Faktur transaksi ?</p><br>
                                            <div align="right">
                                                <a href="{{ route('faktur_wa', ['id' => $data->transaksi_id]) }}" class="btn btn-success waves-effect btn-label waves-light me-1">
                                                    <i class="bx bxl-whatsapp label-icon"></i>
                                                    Kirim
                                                </a>
                                                <a href="{{ route('transaksi.faktur.download', $data->transaksi_id) }}" type="button" class="btn btn-primary waves-effect btn-label waves-light">
                                                    <i class="bx bx-printer label-icon"></i>
                                                    Cetak
                                                </a>
                                                <a type="reset" class="btn btn-secondary waves-effect waves-light mx-1" onclick="kembali()">Kembali</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            <a type="reset" class="btn btn-secondary waves-effect waves-light m-1" onclick="kembali()">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection