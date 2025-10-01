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
        Schema::create('keluarga', function (Blueprint $table) {
            $table->id(); // Membuat kolom 'id' auto-increment primary key
            $table->string('NIM');
            $table->string('NAMA_AYAH'); // NIM harus unik
            $table->string('hubungan_ayah');
            $table->string('NAMA_IBU'); // 
            $table->string('hubungan_ibu');
            $table->string('buktikk')->nullable();
            $table->timestamps(); // [PENTING] Membuat kolom 'created_at' dan 'updated_at'

            $table->foreign('NIM')->references('NIM')->on('mahasiswa')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keluarga');
    }
};
