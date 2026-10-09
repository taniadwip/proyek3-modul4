<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <style>
        body { font-family: sans-serif; padding: 2rem; background: #fafafa; }
        .container { max-width: 600px; margin: auto; background: #fff; padding: 2rem; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.08); }
        .header { display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #eee; padding-bottom: 1rem; margin-bottom: 1rem; }
        button.logout-btn { background: none; border: 1px solid #dc2626; color: #dc2626; padding: 6px 12px; border-radius: 4px; cursor: pointer; font-weight: bold; }
        button.logout-btn:hover { background: #dc2626; color: #fff; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2 style="margin:0;">Dashboard</h2>
            <form action="{{ route('logout') }}" method="POST" style="margin:0;">
                @csrf
                <button type="submit" class="logout-btn">[ Logout ]</button>
            </form>
        </div>
        <h3>Selamat datang, {{ $user->nama_lengkap }}!</h3>
        <p>Halaman ini hanya bisa dibuka setelah login.</p>
        <p><strong>Username:</strong> {{ $user->username }}</p>
    </div>
</body>
</html>