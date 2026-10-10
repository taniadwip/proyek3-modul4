<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\User;

class CheckoutController extends Controller {
    public function process(Request $request) {
        if (!session()->has('user_id')) {
            return redirect()->route('login');
        }

        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang belanja masih kosong!');
        }

        $user = User::findOrFail(session('user_id'));

        try {
            DB::beginTransaction();

            $totalHarga = 0;
            // Validasi ketersediaan stok aktual
            foreach ($cart as $id => $item) {
                $product = Product::where('id_barang', $id)->lockForUpdate()->first();
                if (!$product || $product->stok < $item['jumlah']) {
                    throw new \Exception("Stok untuk item {$item['nama_barang']} tidak mencukupi.");
                }
                $totalHarga += $product->harga * $item['jumlah'];
            }

            // Generate format ID Order unik: ORD-YYYYMMDD-XXX
            $today = date('Ymd');
            $countToday = Order::whereDate('tanggal_order', today())->count() + 1;
            $orderId = 'ORD' . $today . str_pad($countToday, 3, '0', STR_PAD_LEFT);

            // Simpan Data Header Order
            $order = Order::create([
                'id_order' => $orderId,
                'id_user' => $user->id_user,
                'tanggal_order' => now(),
                'total_harga' => $totalHarga,
                'alamat_pengiriman' => $user->alamat ?? 'Alamat Belum Diatur'
            ]);

            // Simpan Detail Order dan Potong Stok Produk
            foreach ($cart as $id => $item) {
                $product = Product::findOrFail($id);

                OrderDetail::create([
                    'id_order' => $orderId,
                    'id_barang' => $id,
                    'harga_satuan' => $product->harga,
                    'jumlah_beli' => $item['jumlah']
                ]);

                $product->decrement('stok', $item['jumlah']);
            }

            DB::commit();

            // Kosongkan Keranjang Session
            session()->forget('cart');

            return redirect()->route('orders.show', $orderId)->with('success', 'Checkout berhasil! Pesanan Anda telah diproses.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('cart.index')->with('error', 'Checkout gagal: ' . $e->getMessage());
        }
    }
}