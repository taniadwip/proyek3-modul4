<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Product;

class DatabaseSeeder extends Seeder {
    public function run(): void {
        // 1. Akun Pengguna Demo
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

        // 2. Daftar 10 Menu Ayam D'Okeh (Sesuai File Foto Asli)
        $items = [
            [
                'id_barang' => 'BRG001',
                'nama_barang' => 'Chicken Original',
                'deskripsi' => 'Ayam krispi original gurih dan renyah.',
                'harga' => 10000,
                'stok' => 30,
                'gambar' => 'ChikenOriginal.jpeg'
            ],
            [
                'id_barang' => 'BRG002',
                'nama_barang' => 'Chicken Geprek',
                'deskripsi' => 'Ayam + Sambel Geprek pedas nampol.',
                'harga' => 14000,
                'stok' => 25,
                'gambar' => 'ChikenGeprek.jpeg'
            ],
            [
                'id_barang' => 'BRG003',
                'nama_barang' => 'Chicken Barbeque',
                'deskripsi' => 'Ayam + Saos Sadas Barbeque lezat.',
                'harga' => 14500,
                'stok' => 20,
                'gambar' => 'ChikenBarbeque.jpeg'
            ],
            [
                'id_barang' => 'BRG004',
                'nama_barang' => 'Original Paket Nasi',
                'deskripsi' => 'Nasi pulen hangat + Ayam krispi.',
                'harga' => 14500,
                'stok' => 25,
                'gambar' => 'PaketOriginalNasi.jpeg'
            ],
            [
                'id_barang' => 'BRG005',
                'nama_barang' => 'Paket Geprek Nasi',
                'deskripsi' => 'Nasi + Ayam Geprek sambal segar.',
                'harga' => 16500,
                'stok' => 20,
                'gambar' => 'PaketGeprekNasi.jpeg'
            ],
            [
                'id_barang' => 'BRG006',
                'nama_barang' => 'Paket Chicken Barbeque',
                'deskripsi' => 'Nasi + Ayam saos Barbeque.',
                'harga' => 17000,
                'stok' => 15,
                'gambar' => 'PaketBarbequeNasi.jpeg'
            ],

            // 4 Menu Pelengkap Tambahan (Bisa pakai foto yang ada atau gambar pendukung)
            [
                'id_barang' => 'BRG007',
                'nama_barang' => "Kulit Crispy D'Okeh",
                'deskripsi' => 'Kulit ayam goreng ekstra renyah berbumbu.',
                'harga' => 12000,
                'stok' => 15,
                'gambar' => 'ChikenOriginal.jpeg'
            ],
            [
                'id_barang' => 'BRG008',
                'nama_barang' => 'Nasi Putih Tambahan',
                'deskripsi' => 'Nasi putih pulen hangat porsi pas.',
                'harga' => 5000,
                'stok' => 40,
                'gambar' => 'PaketOriginalNasi.jpeg'
            ],
            [
                'id_barang' => 'BRG009',
                'nama_barang' => "Es Teh Manis D'Okeh",
                'deskripsi' => 'Es teh manis segar pelepas dahaga.',
                'harga' => 4000,
                'stok' => 50,
                'gambar' => 'ChikenOriginal.jpeg'
            ],
            [
                'id_barang' => 'BRG010',
                'nama_barang' => 'Chicken Saos Keju',
                'deskripsi' => 'Ayam krispi saos keju creamy lumer (Stok Habis).',
                'harga' => 16000,
                'stok' => 0, // Syarat stok 0
                'gambar' => 'ChikenGeprek.jpeg'
            ],
        ];

        foreach ($items as $item) {
            Product::updateOrCreate(['id_barang' => $item['id_barang']], $item);
        }
    }
}