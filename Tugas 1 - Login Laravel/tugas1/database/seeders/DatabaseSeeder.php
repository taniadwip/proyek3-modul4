<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder {
    public function run(): void {
        User::create([
            'username' => 'budi',
            'password' => Hash::make('rahasia123'),
            'nama_lengkap' => 'Budi Santoso',
        ]);

        User::create([
            'username' => 'ratna',
            'password' => Hash::make('password456'),
            'nama_lengkap' => 'Ratna Permata',
        ]);
    }
}