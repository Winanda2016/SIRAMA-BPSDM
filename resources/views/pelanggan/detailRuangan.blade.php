@extends('pelanggan.themes.app')
@section('content')
<!-- Breadcrumb Section Begin -->
<div class="breadcrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text">
                    <h2>Detail Ruangan</h2>
                    <div class="bt-option">
                        <a href="{{ url('/pelanggan-dashboard') }}">Halaman Utama</a>
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
        <div class="card p-2">
            <div class="row">
                <div class="col-lg-7" style=" width: 100%; height: 400px; overflow: hidden; display: flex; flex-direction: column; margin-right:20px;">
                    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel" style=" height: 100%;">
                        <ol class="carousel-indicators">
                            <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></li>
                            <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></li>
                            <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner" role="listbox" style="height: 100%; display: flex;">
                            <div class="carousel-item active">
                                <img class="d-block img-fluid w-100" src="{{ asset('pelanggan/assets/img/logo.png') }}" alt="First slide" style="height: 100%; width: 100%; object-fit: cover;">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block img-fluid w-100" src="{{ asset('admin/assets/images/small/img-2.jpg') }}" alt="Second slide">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block img-fluid w-100" src="{{ asset('admin/assets/images/small/img-1.jpg') }}" alt="Third slide">
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div><!-- end carousel -->
                </div>

                <div class="col-lg-4">
                    <div class="room-details-item">
                        <div class="rd-text">
                            <div class="rd-title">
                                <div class="rdt-left">
                                    <a href="{{ url('/ruangan/reservasi') }}">Reservasi</a>
                                </div>
                            </div>
                            <h2>159$<span>/Pernight</span></h2>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <h3 class="my-3"><b>Deskripsi</b></h3>
        <p class="f-para">Motorhome or Trailer that is the question for you. Here are some of the
            advantages and disadvantages of both, so you will be confident when purchasing an RV.
            When comparing Rvs, a motorhome or a travel trailer, should you buy a motorhome or fifth
            wheeler? The advantages and disadvantages of both are studied so that you can make your
            choice wisely when purchasing an RV. Possessing a motorhome or fifth wheel is an
            achievement of a lifetime. It can be similar to sojourning with your residence as you
            search the various sites of our great land, America.</p>
        <p>The two commonly known recreational vehicle classes are the motorized and towable.
            Towable rvs are the travel trailers and the fifth wheel. The rv travel trailer or fifth
            wheel has the attraction of getting towed by a pickup or a car, thus giving the
            adaptability of possessing transportation for you when you are parked at your campsite.
        </p>
    </div>
</section>
<!-- Room Details Section End -->

@endsection