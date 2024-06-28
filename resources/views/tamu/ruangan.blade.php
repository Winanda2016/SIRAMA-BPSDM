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
                        <a href="{{ url('/tamu-dashboard') }}">Halaman Utama</a>
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
            <div class="col-lg-4 col-md-6">
                <div class="room-item">
                    <div class="card" style="width: 100%; height: 250px; overflow: hidden; display: flex;">
                        <img src="{{ asset('tamu/assets/img/room/room-1.jpg') }}" alt="" style="height: 100%; width: 100%; object-fit: cover;">
                    </div>
                    <div class="ri-text">
                        <h4>Premium King Room</h4>
                        <h3>159$<span>/Pernight</span></h3>
                        <table>
                            <tbody>
                                <tr>
                                    <td class="r-o">Size:</td>
                                    <td>30 ft</td>
                                </tr>
                                <tr>
                                    <td class="r-o">Capacity:</td>
                                    <td>Max persion 3</td>
                                </tr>
                                <tr>
                                    <td class="r-o">Bed:</td>
                                    <td>King Beds</td>
                                </tr>
                                <tr>
                                    <td class="r-o">Services:</td>
                                    <td>Wifi, Television, Bathroom,...</td>
                                </tr>
                            </tbody>
                        </table>
                        <a href="{{ url('/ruangan/detail') }}" class="primary-btn">Detail Selengkapnya</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="room-item">
                    <img src="{{ asset('tamu/assets/img/room/room-2.jpg') }}" alt="">
                    <div class="ri-text">
                        <h4>Deluxe Room</h4>
                        <h3>159$<span>/Pernight</span></h3>
                        <table>
                            <tbody>
                                <tr>
                                    <td class="r-o">Size:</td>
                                    <td>30 ft</td>
                                </tr>
                                <tr>
                                    <td class="r-o">Capacity:</td>
                                    <td>Max persion 5</td>
                                </tr>
                                <tr>
                                    <td class="r-o">Bed:</td>
                                    <td>King Beds</td>
                                </tr>
                                <tr>
                                    <td class="r-o">Services:</td>
                                    <td>Wifi, Television, Bathroom,...</td>
                                </tr>
                            </tbody>
                        </table>
                        <a href="#" class="primary-btn">More Details</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="room-item">
                    <img src="{{ asset('tamu/assets/img/room/room-6.jpg') }}" alt="">
                    <div class="ri-text">
                        <h4>Small View</h4>
                        <h3>159$<span>/Pernight</span></h3>
                        <table>
                            <tbody>
                                <tr>
                                    <td class="r-o">Size:</td>
                                    <td>30 ft</td>
                                </tr>
                                <tr>
                                    <td class="r-o">Capacity:</td>
                                    <td>Max persion 2</td>
                                </tr>
                                <tr>
                                    <td class="r-o">Bed:</td>
                                    <td>King Beds</td>
                                </tr>
                                <tr>
                                    <td class="r-o">Services:</td>
                                    <td>Wifi, Television, Bathroom,...</td>
                                </tr>
                            </tbody>
                        </table>
                        <a href="#" class="primary-btn">More Details</a>
                    </div>
                </div>
            </div>
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