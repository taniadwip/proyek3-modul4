@extends('layouts.app')

@section('content')
<div class="row mb-4">
    <div class="col-md-12">
        <h2 class="fw-bold mb-3">Katalog Produk D'Okeh</h2>
        <!-- Form Pencarian dan Filter -->
        <form method="GET" action="{{ route('products.index') }}" class="card p-3 shadow-sm mb-4">
            <div class="row g-2 align-items-end">
                <div class="col-md-5">
                    <label class="form-label small fw-semibold">Cari Barang</label>
                    <input type="text" name="q" class="form-control form-control-sm" placeholder="Contoh: Original, Geprek, Nasi..." value="{{ request('q') }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label small fw-semibold">Status Stok</label>
                    <select name="stok_status" class="form-select form-select-sm">
                        <option value="">Semua Stok</option>
                        <option value="tersedia" {{ request('stok_status') == 'tersedia' ? 'selected' : '' }}>Stok Tersedia</option>
                        <option value="habis" {{ request('stok_status') == 'habis' ? 'selected' : '' }}>Stok Habis</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label small fw-semibold">Harga Maksimal (Rp)</label>
                    <input type="number" name="max_harga" class="form-control form-control-sm" placeholder="Maksimal" value="{{ request('max_harga') }}">
                </div>
                <div class="col-md-2 d-flex gap-1">
                    <button type="submit" class="btn btn-sm btn-primary w-100">Filter</button>
                    <a href="{{ route('products.index') }}" class="btn btn-sm btn-secondary">Reset</a>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="row g-4">
    @forelse($products as $p)
        <div class="col-6 col-md-4 col-lg-3">
            <div class="card h-100 shadow-sm border-0 position-relative">
                <!-- Tampilan Foto Produk -->
                <img src="{{ asset('images/' . $p->gambar) }}" 
                     class="card-img-top" 
                     alt="{{ $p->nama_barang }}" 
                     style="height: 180px; object-fit: cover; border-top-left-radius: .375rem; border-top-right-radius: .375rem;"
                     onerror="this.onerror=null; this.src='https://placehold.co/300x180?text=Menu+D-Okeh';">

                <div class="card-body d-flex flex-column">
                    <h6 class="card-title fw-bold mb-1">{{ $p->nama_barang }}</h6>
                    <p class="card-text text-muted small flex-grow-1">{{ $p->deskripsi }}</p>
                    <div class="d-flex justify-content-between align-items-center my-2">
                        <span class="text-primary fw-bold">Rp {{ number_format($p->harga, 0, ',', '.') }}</span>
                        @if($p->stok > 0)
                            <span class="badge bg-success">Stok: {{ $p->stok }}</span>
                        @else
                            <span class="badge bg-danger">Habis</span>
                        @endif
                    </div>
                    @if($p->stok > 0)
                        <form action="{{ route('cart.add', $p->id_barang) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-warning w-100 fw-semibold">🛒 + Keranjang</button>
                        </form>
                    @else
                        <button class="btn btn-sm btn-secondary w-100" disabled>Barang Habis</button>
                    @endif
                </div>
            </div>
        </div>
    @empty
        <div class="col-12"><div class="alert alert-info">Tidak ada produk yang cocok dengan pencarian Anda.</div></div>
    @endforelse
</div>
@endsection