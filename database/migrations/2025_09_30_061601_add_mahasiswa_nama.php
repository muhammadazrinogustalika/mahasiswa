<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->id(); // Membuat kolom 'id' auto-increment primary key
            $table->string('NAMA');
            $table->string('NIM')->unique(); // NIM harus unik
            $table->text('Alamat');
            $table->string('email')->unique(); // Email harus unik
            $table->bigInteger('spp');
            $table->string('fotomahasiswa')->nullable(); // Boleh kosong (nullable)
            $table->timestamps(); // [PENTING] Membuat kolom 'created_at' dan 'updated_at'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswa');
    }
};
