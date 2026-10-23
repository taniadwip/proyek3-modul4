<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;                    
use Illuminate\Support\Facades\Gate;     

class CartController extends Controller {
    private function checkAuth() {
        if (!session()->has('user_id')) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu untuk mengakses keranjang.');
        }

        $user = \App\Models\User::find(session('user_id'));

        if (!$user || \Illuminate\Support\Facades\Gate::forUser($user)->denies('use-cart')) {
            abort(403, 'Aksi ini hanya diperbolehkan untuk customer.');
        }

        return null;
    }

    public function index() {
        if ($redirect = $this->checkAuth()) return $redirect;

        $cart = session()->get('cart', []);
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['harga'] * $item['jumlah'];
        }

        return view('cart.index', compact('cart', 'total'));
    }

    public function add(Request $request, $id) {
        if ($redirect = $this->checkAuth()) return $redirect;

        $product = Product::findOrFail($id);

        if ($product->stok <= 0) {
            return back()->with('error', 'Maaf, stok barang sedang habis!');
        }

        $cart = session()->get('cart', []);
        $currentQty = isset($cart[$id]) ? $cart[$id]['jumlah'] : 0;

        if ($currentQty + 1 > $product->stok) {
            return back()->with('error', 'Jumlah beli tidak boleh melebihi stok yang tersedia (' . $product->stok . ').');
        }

        $cart[$id] = [
            'id_barang' => $product->id_barang,
            'nama_barang' => $product->nama_barang,
            'harga' => $product->harga,
            'jumlah' => $currentQty + 1,
            'stok_maks' => $product->stok
        ];

        session()->put('cart', $cart);
        return redirect()->route('cart.index')->with('success', 'Barang berhasil dimasukkan ke keranjang!');
    }

    public function update(Request $request, $id) {
        if ($redirect = $this->checkAuth()) return $redirect;

        $product = Product::findOrFail($id);
        $qty = (int)$request->input('jumlah', 1);

        if ($qty <= 0) {
            return $this->remove($id);
        }

        if ($qty > $product->stok) {
            return back()->with('error', 'Kuantitas melebihi batas stok barang (' . $product->stok . ').');
        }

        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            $cart[$id]['jumlah'] = $qty;
            session()->put('cart', $cart);
        }

        return back()->with('success', 'Jumlah barang berhasil diperbarui.');
    }

    public function remove($id) {
        if ($redirect = $this->checkAuth()) return $redirect;

        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return back()->with('success', 'Barang berhasil dihapus dari keranjang.');
    }
}