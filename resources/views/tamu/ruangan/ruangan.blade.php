@extends('tamu.themes.app')
@section('content')
<!-- Breadcrumb Section Begin -->
<div class="breadcrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text">
                    <h2>Ruangan</h2>
                    <div class="bt-option">
                        <a href="{{ url('/') }}">Halaman Utama</a>
                        <span>Ruangan</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Section End -->

<!-- Rooms Section Begin -->
<section class="rooms-section spad">
    <div class="container">
        <div class="row">
            @foreach ($ruangan as $r)
            <div class="col-lg-4 col-md-6">
                <div class="room-item">
                    <div class="card" style="width: 100%; height: 250px; overflow: hidden; display: flex;">
                        @if ($r->foto)
                        <img src="{{ asset($r->foto) }}" alt="{{ $r->nama_ruangan }}" style="height: 100%; width: 100%; object-fit: cover;">
                        @else
                        <img src="{{ asset('tamu/assets/img/ruangan/no_image.jpg') }}" alt="Default Image" style="height: 100%; width: 100%; object-fit: cover;">
                        @endif
                    </div>
                    <div class="ri-text">
                        <h4>{{ $r->nama_ruangan}}</h4>
                        <h3>Rp.{{ $r->formatted_harga }}<span>/Hari</span></h3>
                        <table>
                            <tbody>
                                <tr>
                                    <td class="r-o">Kapasitas: </td>
                                    <td>{{ $r->kapasitas }} Orang</td>
                                </tr>
                                <tr>
                                    <td class="r-o">Fasilitas:</td>
                                    <td>{{ $r->fasilitas }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <a href="{{ route('detail_ruangan_tamu', $r->id) }}" class="primary-btn">Detail Selengkapnya</a>
                    </div>
                </div>
            </div>
            @endforeach
            <div class="col-lg-12">
                <div class="room-pagination">
                    <a href="#">1</a>
                    <a href="#">2</a>
                    <a href="#">Next <i class="fa fa-long-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Rooms Section End -->
@endsection