<!-- resources/views/orders/index.blade.php -->
@extends('layouts.app')
@section('content')
<h2 class="fw-bold mb-4">Riwayat Pesanan Saya</h2>
<div class="card shadow-sm p-3">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>ID Pesanan</th>
                <th>Tanggal Order</th>
                <th>Total Bayar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $o)
                <tr>
                    <td><strong>{{ $o->id_order }}</strong></td>
                    <td>{{ $o->tanggal_order }}</td>
                    <td>Rp {{ number_format($o->total_harga, 0, ',', '.') }}</td>
                    <td><a href="{{ route('orders.show', $o->id_order) }}" class="btn btn-sm btn-outline-primary">Lihat Detail</a></td>
                </tr>
            @empty
                <tr><td colspan="4" class="text-center text-muted">Belum ada riwayat pesanan.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection