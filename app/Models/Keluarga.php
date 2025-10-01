<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

// [PERBAIKAN] Nama class mengikuti standar PascalCase
class Keluarga extends Model
{
    use HasFactory;

    protected $table = 'keluarga';
    
    protected $fillable = [
        'NIM',
        'NAMA_AYAH',
        'hubungan_ayah',
        'NAMA_IBU',
        'hubungan_ibu',
        'buktikk',
    ];

    /**
     * [TAMBAHAN] Membuat relasi ke model Namamahasiswa.
     * Ini memungkinkan kita untuk mengambil data mahasiswa (seperti nama)
     * dari data keluarga dengan mudah.
     */
    public function mahasiswa(): BelongsTo
    {
        // Relasi 'belongsTo' ke model Namamahasiswa
        // Kunci lokal di tabel 'keluarga' adalah 'NIM'
        // Kunci di tabel 'mahasiswa' juga 'NIM'
        return $this->belongsTo(Namamahasiswa::class, 'NIM', 'NIM');
    }
}
