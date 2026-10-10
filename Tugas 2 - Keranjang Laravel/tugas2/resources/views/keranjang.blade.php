<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Keranjang Belanja</title>
    <style>
        body { font-family: sans-serif; padding: 2rem; max-width: 600px; margin: auto; }
        .header { border-bottom: 2px solid #333; padding-bottom: 8px; margin-bottom: 1.5rem; }
        .item-row { display: flex; justify-content: space-between; align-items: center; padding: 12px 0; border-bottom: 1px dashed #ccc; }
        .action-btns { display: flex; align-items: center; gap: 5px; }
        button { padding: 3px 8px; cursor: pointer; border: 1px solid #888; background: #f4f4f4; border-radius: 3px; }
        .total-row { display: flex; justify-content: space-between; font-weight: bold; font-size: 1.1rem; margin-top: 1.5rem; padding-top: 10px; border-top: 2px solid #333; }
        .btn-clear { background: none; border: 1px solid #c00; color: #c00; font-weight: bold; padding: 6px 12px; margin-top: 1.5rem; border-radius: 4px; }
        .back-link { display: inline-block; margin-bottom: 1rem; text-decoration: none; color: #0066cc; }
    </style>
</head>
<body>
    <a href="{{ route('barang.index') }}" class="back-link">&laquo; Kembali ke Daftar Barang</a>

    <div class="header">
        <h2 style="margin:0;">Keranjang belanja</h2>
        <small style="color:#666;">Tanpa login</small>
    </div>

    @if(empty($items))
        <p style="text-align: center; color: #888; margin: 2rem 0;">Keranjang belanja Anda masih kosong.</p>
    @else
        @foreach($items as $item)
            <div class="item-row">
                <div>
                    <strong>{{ $item['nama'] }}</strong><br>
                    <span style="color:#555;">Rp {{ number_format($item['harga'], 0, ',', '.') }} x {{ $item['jumlah'] }} = </span>
                    <strong>Rp {{ number_format($item['subtotal'], 0, ',', '.') }}</strong>
                </div>
                <div class="action-btns">
                    <form action="{{ route('cart.minus', $item['id']) }}" method="POST" style="margin:0;">
                        @csrf
                        <button type="submit">[-]</button>
                    </form>
                    <span style="font-weight:bold; min-width: 20px; text-align: center; display: inline-block;">{{ $item['jumlah'] }}</span>
                    <form action="{{ route('cart.plus', $item['id']) }}" method="POST" style="margin:0;">
                        @csrf
                        <button type="submit">[+]</button>
                    </form>
                    <form action="{{ route('cart.delete', $item['id']) }}" method="POST" style="margin:0;">
                        @csrf
                        <button type="submit">[hapus]</button>
                    </form>
                </div>
            </div>
        @endforeach

        <div class="total-row">
            <span>Total</span>
            <span>Rp {{ number_format($totalHarga, 0, ',', '.') }}</span>
        </div>

        <form action="{{ route('cart.clear') }}" method="POST">
            @csrf
            <button type="submit" class="btn-clear">[ Kosongkan keranjang ]</button>
        </form>
    @endif
</body>
</html>