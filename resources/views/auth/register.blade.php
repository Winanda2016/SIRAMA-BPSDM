@extends('auth.app')
@section('content_Auth')
<div class="auth-content my-auto">
    <div class="text-center">
        <h5 class="mb-0">Register Account</h5>
        <p class="text-muted mt-2">Get your free Minia account now.</p>
    </div>
    <form method="POST" action="{{ route('register') }}" class="needs-validation mt-4 pt-2" novalidate>
        @csrf
        <!-- Name -->
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" :value="old('name')" required autofocus autocomplete="name">
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" :value="old('email')" required autocomplete="email">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- No HP -->
        <div class="mb-3">
            <label for="no_hp" class="form-label">Nomor HP</label>
            <input type="no_hp" class="form-control" id="no_hp" name="no_hp" :value="old('no_hp')" required autocomplete="no_hp">
            <x-input-error :messages="$errors->get('no_hp')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required autocomplete="new-password"/>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>
        <div class="mb-3">
            <button class="btn btn-primary w-100 waves-effect waves-light" type="submit">Register</button>
        </div>
    </form>

    <div class="mt-5 text-center">
        <p class="text-muted mb-0">Sudah Memiliki Akun ? <a href="{{ route('login') }}" class="text-primary fw-semibold"> Login </a> </p>
    </div>
</div>
@endsection