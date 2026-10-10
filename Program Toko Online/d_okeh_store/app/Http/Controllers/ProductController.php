<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller {
    public function index(Request $request) {
        $query = Product::query();

        // 1. Pencarian Kata Kunci
        if ($request->filled('q')) {
            $query->where('nama_barang', 'like', '%' . $request->q . '%');
        }

        // 2. Filter Status Ketersediaan Stok
        if ($request->filled('stok_status')) {
            if ($request->stok_status === 'tersedia') {
                $query->where('stok', '>', 0);
            } elseif ($request->stok_status === 'habis') {
                $query->where('stok', '=', 0);
            }
        }

        // 3. Filter Rentang Harga
        if ($request->filled('max_harga')) {
            $query->where('harga', '<=', (float)$request->max_harga);
        }

        $products = $query->get();

        // IMPLEMENTASI COOKIE: Menyimpan preferensi pencarian terakhir selama 7 hari
        $cookie = null;
        if ($request->filled('q')) {
            $cookie = cookie('last_search_dokeh', $request->q, 60 * 24 * 7);
        }

        $response = response()->view('products.index', compact('products'));
        return $cookie ? $response->withCookie($cookie) : $response;
    }
}