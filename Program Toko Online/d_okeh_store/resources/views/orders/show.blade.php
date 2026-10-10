<!-- resources/views/orders/show.blade.php -->
@extends('layouts.app')
@section('content')
<div class="card shadow-sm p-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-bold m-0">Detail Pesanan: {{ $order->id_order }}</h4>
        <a href="{{ route('orders.index') }}" class="btn btn-sm btn-secondary">&laquo; Kembali</a>
    </div>
    <p class="text-muted small mb-1">Tanggal: {{ $order->tanggal_order }} | Pembeli: {{ session('nama_lengkap') }}</p>
    <p class="text-muted small mb-3">Alamat Pengiriman: {{ $order->alamat_pengiriman }}</p>

    <table class="table table-bordered mt-2">
        <thead class="table-light">
            <tr>
                <th>Nama Barang</th>
                <th>Harga Satuan</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->details as $d)
                <tr>
                    <td>{{ $d->product->nama_barang ?? $d->id_barang }}</td>
                    <td>Rp {{ number_format($d->harga_satuan, 0, ',', '.') }}</td>
                    <td>{{ $d->jumlah_beli }}</td>
                    <td>Rp {{ number_format($d->harga_satuan * $d->jumlah_beli, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3" class="text-end">Total Pembayaran:</th>
                <th class="text-primary">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</th>
            </tr>
        </tfoot>
    </table>
</div>
@endsection