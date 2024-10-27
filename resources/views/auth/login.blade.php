@extends('auth.app')
@section('content_Auth')
<div class="auth-content mb-2 mt-2">
    <div class="text-center">
        <h3 class="mb-0">Selamat Datang !</h3>
        <p class="text-muted mt-2">Log In untuk melanjutkan ke SIRAMA.</p>
    </div>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <!-- Email Address -->
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" :value="old('email')" required autofocus autocomplete="username">
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" />
        </div>

        <!-- Password -->
        <div class="mb-3">
            <div class="d-flex align-items-start">
                <div class="flex-grow-1">
                    <label for="password" class="form-label">Password</label>
                </div>
                <div class="flex-shrink-0">
                    <div class="">
                        @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-muted">Lupa password?</a>
                        @endif
                    </div>
                </div>
            </div>

            <div class="input-group auth-pass-inputgroup">
                <input type="password" id="password" class="form-control" name="password" required autocomplete="current-password" placeholder="Enter password" aria-label="Password" aria-describedby="password-addon">
                <button class="btn btn-light shadow-none ms-0" type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="row mb-4">
            <div class="col">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="remember_me" name="remember">
                    <label class="form-check-label" for="remember_me">
                        Remember me
                    </label>
                </div>
            </div>
        </div>
        <div class="mb-3">
            <button class="btn btn-primary w-100 waves-effect waves-light" type="submit" style="background-color:#4c5c7e ;">Log In</button>
        </div>

        <!-- <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div> -->
    </form>
    <div class="mt-1 text-center">
        <p class="text-muted mb-0">Belum memiliki akun ?
            @if (Route::has('register'))
            <a href="{{ route('register') }}" class="fw-semibold" style="color:#4c5c7e ;"> Daftar disni </a>
            @endif
        </p>
    </div>
</div>
@endsection