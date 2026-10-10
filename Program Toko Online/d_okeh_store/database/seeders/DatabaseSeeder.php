<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Product;

class DatabaseSeeder extends Seeder {
    public function run(): void {
        // Buat Akun Pengguna Demo
        User::updateOrCreate(
            ['username' => 'tania'],
            [
                'id_user' => 'USR001',
                'nama_lengkap' => 'Tania Dwi Pangesti',
                'email' => 'tania@d-okeh.com',
                'password' => Hash::make('password123'),
                'no_hp' => '081234567890',
                'alamat' => 'Jl. Gegerkalong Hilir No. 45, Bandung',
            ]
        );

        // 10 Barang Toko D'Okeh (Sesuai Aturan Minimal 10 Barang)
        $items = [
            ['id_barang' => 'BRG001', 'nama_barang' => "Kaos D'Okeh Signature Hitam", 'deskripsi' => 'Bahan combed 30s premium lembut dan adem.', 'harga' => 95000, 'stok' => 25, 'gambar' => 'kaos_hitam.jpg'],
            ['id_barang' => 'BRG002', 'nama_barang' => "Hoodie D'Okeh Classic Navy", 'deskripsi' => 'Hoodie fleece tebal nyaman dipakai harian.', 'harga' => 185000, 'stok' => 15, 'gambar' => 'hoodie_navy.jpg'],
            ['id_barang' => 'BRG003', 'nama_barang' => "Topi Snapback D'Okeh Street", 'deskripsi' => 'Topi bordir logo D-Okeh kualitas tinggi.', 'harga' => 65000, 'stok' => 8, 'gambar' => 'topi_snapback.jpg'],
            ['id_barang' => 'BRG004', 'nama_barang' => "Totebag Kanvas D'Okeh Eco", 'deskripsi' => 'Tas kanvas tebal ramah lingkungan serbaguna.', 'harga' => 45000, 'stok' => 30, 'gambar' => 'totebag_kanvas.jpg'],
            ['id_barang' => 'BRG005', 'nama_barang' => "Tumbler Termos D'Okeh 500ml", 'deskripsi' => 'Menjaga suhu panas dan dingin hingga 12 jam.', 'harga' => 85000, 'stok' => 12, 'gambar' => 'tumbler.jpg'],
            ['id_barang' => 'BRG006', 'nama_barang' => "Gantungan Kunci D'Okeh Akrilik", 'deskripsi' => 'Gantungan kunci akrilik 2 sisi eksklusif.', 'harga' => 15000, 'stok' => 50, 'gambar' => 'keychain.jpg'],
            ['id_barang' => 'BRG007', 'nama_barang' => "Buku Catatan Agenda D'Okeh A5", 'deskripsi' => 'Kertas bookpaper bergaris isi 100 lembar.', 'harga' => 35000, 'stok' => 20, 'gambar' => 'notebook.jpg'],
            ['id_barang' => 'BRG008', 'nama_barang' => "Sticker Pack D'Okeh Vinyl", 'deskripsi' => 'Paket stiker tahan air isi 10 pcs berbagai desain.', 'harga' => 20000, 'stok' => 40, 'gambar' => 'sticker_pack.jpg'],
            ['id_barang' => 'BRG009', 'nama_barang' => "Lanyard ID Card D'Okeh Pro", 'deskripsi' => 'Tali gantungan kartu motif full print halus.', 'harga' => 25000, 'stok' => 18, 'gambar' => 'lanyard.jpg'],
            ['id_barang' => 'BRG010', 'nama_barang' => "Jaket Coach D'Okeh Limited", 'deskripsi' => 'Jaket parasut windbreaker edisi terbatas (Stok Kosong).', 'harga' => 220000, 'stok' => 0, 'gambar' => 'jaket_coach.jpg'],
        ];

        foreach ($items as $item) {
            Product::updateOrCreate(['id_barang' => $item['id_barang']], $item);
        }
    }
}