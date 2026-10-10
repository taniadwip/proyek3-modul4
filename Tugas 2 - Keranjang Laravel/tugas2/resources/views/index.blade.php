<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Toko Alat Tulis</title>
    <style>
        body { font-family: sans-serif; padding: 2rem; max-width: 600px; margin: auto; }
        .header { display: flex; justify-content: space-between; align-items: center; border-bottom: 2px solid #333; padding-bottom: 10px; margin-bottom: 1.5rem; }
        .btn-cart { background: #eee; border: 1px solid #999; padding: 6px 12px; text-decoration: none; color: #000; font-weight: bold; border-radius: 4px; }
        .item { display: flex; align-items: center; justify-content: space-between; padding: 10px 0; border-bottom: 1px dashed #ccc; }
        .item-left { display: flex; align-items: center; gap: 15px; }
        .img-box { width: 50px; height: 50px; background: #ddd; display: flex; align-items: center; justify-content: center; font-size: 11px; border: 1px solid #bbb; }
        .btn-add { background: #f0f0f0; border: 1px solid #777; padding: 6px 10px; cursor: pointer; border-radius: 4px; }
        .btn-add:hover { background: #e0e0e0; }
    </style>
</head>
<body>
    <div class="header">
        <h2 style="margin:0;">Toko Alat Tulis</h2>
        <a href="{{ route('keranjang.index') }}" class="btn-cart">[ Keranjang ({{ $totalItem }}) ]</a>
    </div>

    <h3>Daftar barang</h3>

    @foreach($barangs as $b)
        <div class="item">
            <div class="item-left">
                <div class="img-box">[img]</div>
                <div>
                    <strong>{{ $b->nama }}</strong><br>
                    <span>Rp {{ number_format($b->harga, 0, ',', '.') }}</span>
                </div>
            </div>
            <form action="{{ route('cart.add', $b->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn-add">[Masukkan ke keranjang]</button>
            </form>
        </div>
    @endforeach
</body>
</html>