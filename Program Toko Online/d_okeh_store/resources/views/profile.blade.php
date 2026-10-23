@extends('layouts.app')

@section('content')
<div style="max-width: 600px; margin: 30px auto; padding: 25px; background: #ffffff; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); font-family: sans-serif;">
    <h2 style="margin-top: 0; color: #2d3748; border-bottom: 2px solid #edf2f7; padding-bottom: 10px;">Profil Pengguna</h2>

    <!-- Informasi Akun Login Saat Ini (Read-Only) -->
    <div style="margin-bottom: 15px;">
        <label style="display: block; font-size: 13px; color: #718096; margin-bottom: 5px;">ID Akun Anda</label>
        <input type="text" value="{{ $user->id_user }}" readonly style="width: 100%; padding: 8px 12px; background: #f7fafc; border: 1px solid #e2e8f0; border-radius: 4px; color: #4a5568; outline: none; box-sizing: border-box;">
    </div>

    <div style="margin-bottom: 15px;">
        <label style="display: block; font-size: 13px; color: #718096; margin-bottom: 5px;">Nama Lengkap</label>
        <input type="text" value="{{ $user->nama_lengkap ?? $user->name ?? '-' }}" readonly style="width: 100%; padding: 8px 12px; background: #f7fafc; border: 1px solid #e2e8f0; border-radius: 4px; color: #4a5568; outline: none; box-sizing: border-box;">
    </div>

    <div style="margin-bottom: 15px;">
        <label style="display: block; font-size: 13px; color: #718096; margin-bottom: 5px;">Email / Username</label>
        <input type="text" value="{{ $user->email ?? $user->username ?? '-' }}" readonly style="width: 100%; padding: 8px 12px; background: #f7fafc; border: 1px solid #e2e8f0; border-radius: 4px; color: #4a5568; outline: none; box-sizing: border-box;">
    </div>

    <div style="margin-bottom: 25px;">
        <label style="display: block; font-size: 13px; color: #718096; margin-bottom: 5px;">Role Anda Saat Ini</label>
        <input type="text" value="{{ $user->role }}" readonly style="width: 100%; padding: 8px 12px; background: #edf2f7; border: 1px solid #cbd5e0; border-radius: 4px; color: #2b6cb0; font-weight: bold; outline: none; box-sizing: border-box;">
    </div>

    <hr style="border: none; border-top: 1px dashed #cbd5e0; margin: 25px 0;">

    <!-- Form Pengujian Role -->
    <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 6px; padding: 20px;">
        <h3 style="margin-top: 0; font-size: 16px; color: #2d3748;">Pengujian Role Management</h3>

        <!-- Notifikasi Berhasil -->
        @if(session('status'))
            <div style="margin-bottom: 15px; padding: 10px; background: #c6f6d5; border: 1px solid #9ae6b4; color: #22543d; border-radius: 4px; font-size: 14px;">
                <strong>Berhasil:</strong> {{ session('status') }}
            </div>
        @endif

        <!-- Notifikasi Gagal / Validasi Error -->
        @if($errors->any())
            <div style="margin-bottom: 15px; padding: 10px; background: #fed7d7; border: 1px solid #feb2b2; color: #742a2a; border-radius: 4px; font-size: 14px;">
                <strong>Gagal:</strong>
                <ul style="margin: 5px 0 0 20px; padding: 0;">
                    @foreach($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form id="formTesRole" method="POST" action="/admin/users/USR003/role">
            @csrf
            @method('PATCH')

            <div style="margin-bottom: 15px;">
                <label style="display: block; font-size: 13px; color: #4a5568; margin-bottom: 5px;">ID User Target</label>
                <input type="text" id="targetId" placeholder="Contoh: USR003" style="width: 100%; padding: 8px 12px; border: 1px solid #cbd5e0; border-radius: 4px; box-sizing: border-box;">
            </div>

            <div style="margin-bottom: 15px;">
                <label style="display: block; font-size: 13px; color: #4a5568; margin-bottom: 5px;">Role Baru yang Dikirim</label>
                <input type="text" name="role" placeholder="customer / staff / admin" style="width: 100%; padding: 8px 12px; border: 1px solid #cbd5e0; border-radius: 4px; box-sizing: border-box;">
            </div>

            <button type="submit" style="background: #3182ce; color: #ffffff; border: none; padding: 10px 18px; border-radius: 4px; cursor: pointer; font-size: 14px; font-weight: 600;">
                Kirim Request PATCH
            </button>
        </form>
    </div>
</div>

<script>
    const targetInput = document.getElementById('targetId');
    const formRole = document.getElementById('formTesRole');

    function updateActionUrl() {
        formRole.action = '/admin/users/' + encodeURIComponent(targetInput.value.trim()) + '/role';
    }

    targetInput.addEventListener('input', updateActionUrl);
    formRole.addEventListener('submit', updateActionUrl);
</script>
@endsection