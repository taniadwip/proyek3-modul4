<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;

class BarangController extends Controller {
    // 1. Halaman Daftar Barang
    public function index() {
        $barangs = Barang::all();
        $cart = session()->get('keranjang', []);

        // Hitung total kuantitas barang di keranjang
        $totalItem = array_sum($cart);

        return view('index', compact('barangs', 'totalItem'));
    }

    // 2. Tambah Barang ke Keranjang
    public function tambahKeKeranjang($id) {
        $barang = Barang::findOrFail($id);
        $cart = session()->get('keranjang', []);

        if (isset($cart[$id])) {
            $cart[$id]++;
        } else {
            $cart[$id] = 1;
        }

        session()->put('keranjang', $cart);
        return redirect()->route('barang.index');
    }

    // 3. Halaman Keranjang Belanja
    public function keranjang() {
        $cart = session()->get('keranjang', []);
        $items = [];
        $totalHarga = 0;

        if (!empty($cart)) {
            $barangs = Barang::whereIn('id', array_keys($cart))->get()->keyBy('id');
            foreach ($cart as $id => $jumlah) {
                if (isset($barangs[$id])) {
                    $b = $barangs[$id];
                    $subtotal = $b->harga * $jumlah;
                    $totalHarga += $subtotal;
                    $items[] = [
                        'id' => $id,
                        'nama' => $b->nama,
                        'harga' => $b->harga,
                        'jumlah' => $jumlah,
                        'subtotal' => $subtotal,
                    ];
                }
            }
        }

        return view('keranjang', compact('items', 'totalHarga'));
    }

    // 4. Tambah Jumlah (+)
    public function tambahJumlah($id) {
        $cart = session()->get('keranjang', []);
        if (isset($cart[$id])) {
            $cart[$id]++;
            session()->put('keranjang', $cart);
        }
        return redirect()->route('keranjang.index');
    }

    // 5. Kurang Jumlah (-)
    public function kurangJumlah($id) {
        $cart = session()->get('keranjang', []);
        if (isset($cart[$id])) {
            $cart[$id]--;
            if ($cart[$id] <= 0) {
                unset($cart[$id]);
            }
            session()->put('keranjang', $cart);
        }
        return redirect()->route('keranjang.index');
    }

    // 6. Hapus Satu Item
    public function hapusItem($id) {
        $cart = session()->get('keranjang', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('keranjang', $cart);
        }
        return redirect()->route('keranjang.index');
    }

    // 7. Kosongkan Seluruh Keranjang
    public function kosongkan() {
        session()->forget('keranjang');
        return redirect()->route('keranjang.index');
    }
}