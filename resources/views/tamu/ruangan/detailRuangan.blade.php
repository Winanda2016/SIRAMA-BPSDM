@extends('tamu.themes.app')
@section('content')
<!-- Breadcrumb Section Begin -->
<div class="breadcrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text">
                    <h2>Detail Ruangan</h2>
                    <div class="bt-option">
                        <a href="{{ url('/') }}">Halaman Utama</a>
                        <a href="{{ url('/ruangan') }}">Ruangan</a>
                        <span>Detail Ruangan</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Section End -->

<!-- Room Details Section Begin -->
<section class="room-details-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="room-details-item">
                    <div class="card p-2 mb-4" style=" width: 100%; height: 400px; overflow: hidden; display: flex; flex-direction: column;">
                        @if ($ruangan->foto)
                        <img src="{{ asset($ruangan->foto) }}" alt="{{ $ruangan->nama_ruangan }}" style="height: 100%; width: 100%; object-fit: cover;">
                        @else
                        <img src="{{ asset('tamu/assets/img/ruangan/no_image.jpg') }}" alt="Default Image" style="height: 100%; width: 100%; object-fit: cover;">
                        @endif
                    </div>
                    <div class="rd-text">
                        <div class="rd-title">
                            <h3>{{ $ruangan->nama_ruangan }}</h3>
                            <div class="rdt-right">
                                <a href="{{ route('reservasi_ruangan', $ruangan->id) }}">Reservasi</a>
                            </div>
                        </div>
                        <h2>RP. {{ $ruangan->formatted_harga}}<span>/ Hari</span></h2>
                        <table style="font-size: 16px;">
                            <tbody>
                                <tr>
                                    <td class="r-o">Kapasitas</td>
                                    <td>: {{ $ruangan->kapasitas }} Orang</td>
                                </tr>
                                <tr>
                                    <td class="r-o">Fasilitas:</td>
                                    <td>: {{ $ruangan->fasilitas }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <hr>

                <h4 class="my-4">Keterangan</h4>
                <p class="f-para">1. Setiap kamar terdiri dari 2 buah bed single</p>
                <p class="f-para">2. Untuk melakukan reservasi silahkan hitung pemesanan berdasarkan jumlah bed yang dibutuhkan</p>
                <p class="f-para">3. Harga yang tertera merupakan harga per bed</p>
                <p class="f-para">4. Satu bed hanya dapat di tempati maksimal oleh satu orang dewasa</p>
                <p class="f-para">5. Jika anda hanya menyewa untuk satu bed saja, tidak akan ada kemungkinan
                    untuk anda menempati kamar yang sama dengan orang lain</p>
                @include('tamu.komentar.komentar')
            </div>
            <div class="col-lg-4">
                <div class="card" style="padding: 44px 10px 50px 10px;">
                    <div class="room-booking">
                        <h4>Cek Ketersediaan Kamar</h4>
                        <hr>
                        <form action="#">
                            <div class="row">
                                <div class="col-6">
                                    <div class="tanggal">
                                        <label for="date-in">Check In:</label>
                                        <input type="date" id="date-in" placeholder="YYYY-MM-DD">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="tanggal">
                                        <label for="date-out">Check Out:</label>
                                        <input type="date" id="date-out" placeholder="YYYY-MM-DD">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="cek-ketersediaan">Cek Ketersediaan</button>
                        </form>
                        <p>"Ruangan Tersedia"</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
<!-- Room Details Section End -->


@endsection