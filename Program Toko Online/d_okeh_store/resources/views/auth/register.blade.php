<!-- resources/views/auth/register.blade.php -->
@extends('layouts.app')
@section('content')
<div class="row justify-content-center py-4">
    <div class="col-md-6">
        <div class="card shadow-sm p-4">
            <h4 class="fw-bold text-center mb-3">Daftar Akun Baru</h4>
            <form action="{{ route('register.post') }}" method="POST">
                @csrf
                <div class="mb-2">
                    <label class="form-label small fw-semibold">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" class="form-control form-control-sm" required>
                </div>
                <div class="mb-2">
                    <label class="form-label small fw-semibold">Email</label>
                    <input type="email" name="email" class="form-control form-control-sm" required>
                </div>
                <div class="mb-2">
                    <label class="form-label small fw-semibold">Username</label>
                    <input type="text" name="username" class="form-control form-control-sm" required>
                </div>
                <div class="mb-2">
                    <label class="form-label small fw-semibold">Password</label>
                    <input type="password" name="password" class="form-control form-control-sm" required>
                </div>
                <div class="mb-2">
                    <label class="form-label small fw-semibold">Nomor HP</label>
                    <input type="text" name="no_hp" class="form-control form-control-sm" required>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-semibold">Alamat</label>
                    <textarea name="alamat" class="form-control form-control-sm" rows="2" required></textarea>
                </div>
                <button type="submit" class="btn btn-warning w-100 fw-bold">Daftar</button>
            </form>
            <div class="text-center mt-3 small">
                Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a>
            </div>
        </div>
    </div>
</div>
@endsection