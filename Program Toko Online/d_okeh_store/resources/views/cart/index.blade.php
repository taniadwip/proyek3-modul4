@extends('layouts.app')

@section('content')
<h2 class="fw-bold mb-4">Keranjang Belanja Anda</h2>

@if(empty($cart))
    <div class="card p-5 text-center shadow-sm">
        <h5>Keranjang Anda masih kosong.</h5>
        <p class="text-muted">Temukan produk favorit Anda di katalog!</p>
        <div><a href="{{ route('products.index') }}" class="btn btn-warning">Belanja Sekarang</a></div>
    </div>
@else
    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow-sm p-3 mb-4">
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th>Barang</th>
                                <th>Harga</th>
                                <th style="width: 140px;">Jumlah</th>
                                <th>Subtotal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cart as $id => $item)
                                <tr>
                                    <td><strong>{{ $item['nama_barang'] }}</strong></td>
                                    <td>Rp {{ number_format($item['harga'], 0, ',', '.') }}</td>
                                    <td>
                                        <form action="{{ route('cart.update', $id) }}" method="POST" class="d-flex gap-1">
                                            @csrf
                                            <input type="number" name="jumlah" class="form-control form-control-sm" min="1" max="{{ $item['stok_maks'] }}" value="{{ $item['jumlah'] }}">
                                            <button type="submit" class="btn btn-sm btn-outline-primary">✓</button>
                                        </form>
                                        <small class="text-muted" style="font-size: 11px;">Maks: {{ $item['stok_maks'] }}</small>
                                    </td>
                                    <td class="fw-bold">Rp {{ number_format($item['harga'] * $item['jumlah'], 0, ',', '.') }}</td>
                                    <td>
                                        <form action="{{ route('cart.remove', $id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card shadow-sm p-3">
                <h5 class="fw-bold mb-3">Ringkasan Pesanan</h5>
                <div class="d-flex justify-content-between mb-2">
                    <span>Total Belanja:</span>
                    <strong class="fs-5 text-primary">Rp {{ number_format($total, 0, ',', '.') }}</strong>
                </div>
                <p class="small text-muted">* Ongkos kirim gratis (diabaikan sesuai ketentuan).</p>
                <form action="{{ route('checkout.process') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success w-100 py-2 fw-bold" onclick="return confirm('Konfirmasi checkout belanjaan?')">Checkout Sekarang</button>
                </form>
            </div>
        </div>
    </div>
@endif
@endsection