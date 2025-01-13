@extends('tamu.themes.app')
@section('content')
<div class="breadcrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text">
                    <h2>Profil</h2>
                    <div class="bt-option">
                        <a href="{{ url('/') }}">Halaman Utama</a>
                        <span>Profil</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Contact Section Begin -->
<section class="contact-section spad pt-0 pb-6">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 p-2">
                <div class="card p-4">
                    <h4><b>Informasi Profil</b></h4>
                    <p>Silahkan edit informasi akun kamu di bawah jika diperlukan</p>

                    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
                        @csrf
                        @method('patch')
                        <div class="text-input mb-3">
                            <label for="name">Nama</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-sm-7">
                                <div class="text-input mb-3">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <div class="text-input mb-3">
                                    <label for="no_hp">No HP</label>
                                    <input type="text" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp" name="no_hp" value="{{ old('no_hp', $user->no_hp) }}">
                                    @error('no_hp')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="button-container">
                            <button type="submit" class="BPrimary">Simpan</button>
                        </div>
                    </form>
                </div>

            </div>
            <div class="col-lg-6 p-2">
                <div class="card p-4">
                    <h4><b>Ubah Password</b></h4>
                    <p>Silahkan inputkan password yang baru jika diperlukan</p>
                    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
                        @csrf
                        @method('put')
                        <div class="text-input mb-3">
                            <label for="update_password_password">Password Baru</label>
                            <input class="form-control @error('password') is-invalid @enderror" id="update_password_password" name="password" type="password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                        <div class="text-input mb-3">
                            <label for="update_password_password_confirmation">Konfirmasi Password</label>
                            <input class="form-control @error('password_confirmation') is-invalid @enderror" id="update_password_password_confirmation" name="password_confirmation" type="password">
                            @error('password_confirmation')
                            <span class="invalid-feedback" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>

                        <div class="button-container">
                            <button type="submit" class="BPrimary">Simpan</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</section>
<!-- Contact Section End -->

@endsection