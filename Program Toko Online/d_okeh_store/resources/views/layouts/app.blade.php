<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>D'Okeh Store - Toko Online Resmi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body.dark-mode { background-color: #121212; color: #e0e0e0; }
        body.dark-mode .card { background-color: #1e1e1e; color: #fff; border-color: #333; }
        body.dark-mode .table { color: #e0e0e0; --bs-table-bg: #1e1e1e; }
        body.dark-mode .bg-light { background-color: #242424 !important; }
        body.dark-mode .form-control, body.dark-mode .form-select { background-color: #2a2a2a; color: #fff; border-color: #444; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold text-warning" href="{{ route('products.index') }}">D'OKEH STORE</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navContent">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('products.index') }}">Katalog Barang</a></li>
                    @if(session()->has('user_id'))
                        <li class="nav-item"><a class="nav-link" href="{{ route('cart.index') }}">Keranjang Belanja</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('orders.index') }}">Riwayat Pesanan</a></li>
                    @endif
                </ul>
                <div class="d-flex align-items-center gap-3">
                    <button class="btn btn-sm btn-outline-warning" id="themeToggleBtn">🌓 Ganti Tema</button>
                    @if(session()->has('user_id'))
                        <span class="text-white-50 small">Hai, <strong>{{ session('nama_lengkap') }}</strong></span>
                        <form action="{{ route('logout') }}" method="POST" class="m-0">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-danger">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-sm btn-outline-light">Masuk</a>
                        <a href="{{ route('register') }}" class="btn btn-sm btn-warning">Daftar</a>
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <div class="container py-4">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">{{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show">{{ session('error') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
        @endif

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // IMPLEMENTASI LOCAL STORAGE: Pengaturan Tema Gelap / Terang (Client-Side)
        const themeBtn = document.getElementById('themeToggleBtn');
        function applyTheme(theme) {
            document.body.classList.toggle('dark-mode', theme === 'dark');
        }
        applyTheme(localStorage.getItem('d_okeh_theme') || 'light');
        themeBtn.addEventListener('click', () => {
            const current = document.body.classList.contains('dark-mode') ? 'light' : 'dark';
            localStorage.setItem('d_okeh_theme', current);
            applyTheme(current);
        });
    </script>
</body>
</html>