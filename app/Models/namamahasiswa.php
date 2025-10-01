<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Namamahasiswa extends Model
{
    use HasFactory;

    /**
     * [PENTING] Menentukan nama tabel database secara eksplisit.
     * Laravel secara default akan mencari tabel 'namamahasiswas' (plural).
     * Kode Anda sepertinya menargetkan tabel 'mahasiswa'.
     */
    protected $table = 'mahasiswa';

    /**
     * [PENTING] Atribut yang boleh diisi secara massal (mass assignable).
     * Tanpa ini, method create() dan update() tidak akan berfungsi.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'NAMA',
        'NIM',
        'Alamat',
        'email',
        'spp',
        'fotomahasiswa',
    ];
}
