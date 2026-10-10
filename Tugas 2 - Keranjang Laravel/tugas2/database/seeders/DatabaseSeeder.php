<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Barang;

class DatabaseSeeder extends Seeder {
    public function run(): void {
        $daftarBarang = [
            ['nama' => 'Buku Tulis', 'harga' => 5000, 'stok' => 20],
            ['nama' => 'Pulpen', 'harga' => 3000, 'stok' => 25],
            ['nama' => 'Penggaris', 'harga' => 4000, 'stok' => 15],
            ['nama' => 'Pensil 2B', 'harga' => 2500, 'stok' => 30],
            ['nama' => 'Penghapus', 'harga' => 1500, 'stok' => 10],
        ];

        foreach ($daftarBarang as $b) {
            Barang::create($b);
        }
    }
}