<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        // Tabel Users sesuai spesifikasi PDF Tugas Toko Online
        Schema::create('users', function (Blueprint $table) {
            $table->string('id_user', 15)->primary();
            $table->string('nama_lengkap', 100);
            $table->string('email', 100)->unique();
            $table->string('username', 50)->unique();
            $table->string('password', 255);
            $table->string('no_hp', 15)->nullable();
            $table->text('alamat')->nullable();
            $table->timestamps();
        });

        // Tabel Sessions bawaan Laravel (mencegah error sessions missing)
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    public function down(): void {
        Schema::dropIfExists('users');
        Schema::dropIfExists('sessions');
    }
};