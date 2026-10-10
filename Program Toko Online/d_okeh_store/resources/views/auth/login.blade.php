<!-- resources/views/auth/login.blade.php -->
@extends('layouts.app')
@section('content')
<div class="row justify-content-center py-5">
    <div class="col-md-5">
        <div class="card shadow-sm p-4">
            <h4 class="fw-bold text-center mb-3">Masuk ke D'Okeh Store</h4>
            <form action="{{ route('login.post') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label small fw-semibold">Username</label>
                    <input type="text" name="username" class="form-control" required placeholder="tania">
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-semibold">Password</label>
                    <input type="password" name="password" class="form-control" required placeholder="******">
                </div>
                <button type="submit" class="btn btn-warning w-100 fw-bold">Login</button>
            </form>
            <div class="text-center mt-3 small">
                Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a>
            </div>
        </div>
    </div>
</div>
@endsection