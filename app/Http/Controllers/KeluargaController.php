<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Keluarga;
use App\Models\Namamahasiswa;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule; // [TAMBAHAN] Import Rule untuk validasi yang lebih baik

class KeluargaController extends Controller
{
    /**
     * Menampilkan daftar semua data keluarga mahasiswa.
     */
    public function index()
    {
        // [PERBAIKAN] Eager load relasi 'mahasiswa' untuk efisiensi query
        $keluarga = Keluarga::with('mahasiswa')->latest()->paginate(10);
        return view('namakeluarga.index', compact('keluarga'));
    }

    /**
     * Menampilkan form untuk membuat data keluarga baru.
     */
    public function create()
    {
        // Mengambil data mahasiswa yang BELUM memiliki data keluarga
        $mahasiswa = Namamahasiswa::whereNotIn('NIM', function($query) {
            $query->select('NIM')->from('keluarga');
        })->get();
        return view('namakeluarga.create', compact('mahasiswa'));
    }

    /**
     * Menyimpan data keluarga baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            // [PERBAIKAN] Validasi NIM harus ada di tabel mahasiswa dan unik di tabel keluarga
            'NIM' => 'required|string|max:255|exists:mahasiswa,NIM|unique:keluarga,NIM',
            'NAMA_AYAH' => 'required|string|max:255',
            'hubungan_ayah' => 'required|string|max:255',
            'NAMA_IBU' => 'required|string|max:255',
            'hubungan_ibu' => 'required|string|max:255',
            'buktikk' => 'nullable|file|mimes:pdf|max:102400',
        ]);

        $path = null;
        if ($request->hasFile('buktikk')) {
            $path = $request->file('buktikk')->store('buktikk', 'public');
        }

        Keluarga::create([
            'NIM' => $request->NIM,
            'NAMA_AYAH' => $request->NAMA_AYAH,
            'hubungan_ayah' => $request->hubungan_ayah,
            'NAMA_IBU' => $request->NAMA_IBU,
            'hubungan_ibu' => $request->hubungan_ibu,
            'buktikk' => $path,
        ]);

        return redirect()->route('namakeluarga.index')->with('success', 'Data Keluarga Mahasiswa berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit data keluarga mahasiswa.
     */
    public function edit(Keluarga $namakeluarga)
    {
        return view('namakeluarga.edit', ['keluarga' => $namakeluarga]);
    }

    /**
     * Memperbarui data keluarga mahasiswa di database.
     */
    public function update(Request $request, Keluarga $namakeluarga)
    {
        $request->validate([
            // [PERBAIKAN] NIM tidak bisa diubah, jadi tidak perlu divalidasi
            'NAMA_AYAH' => 'required|string|max:255',
            'hubungan_ayah' => 'required|string|max:255',
            'NAMA_IBU' => 'required|string|max:255',
            'hubungan_ibu' => 'required|string|max:255',
            'buktikk' => 'nullable|file|mimes:pdf|max:102400',
        ]);

        $path = $namakeluarga->buktikk;
        if ($request->hasFile('buktikk')) {
            if ($path) {
                Storage::disk('public')->delete($path);
            }
            $path = $request->file('buktikk')->store('buktikk', 'public');
        }

        $namakeluarga->update([
            'NAMA_AYAH' => $request->NAMA_AYAH,
            'hubungan_ayah' => $request->hubungan_ayah,
            'NAMA_IBU' => $request->NAMA_IBU,
            'hubungan_ibu' => $request->hubungan_ibu,
            'buktikk' => $path,
        ]);

        return redirect()->route('namakeluarga.index')->with('success', 'Data Keluarga Mahasiswa berhasil diperbarui.');
    }

    /**
     * Menghapus data keluarga dari database.
     */
    public function destroy(Keluarga $namakeluarga)
    {
        if ($namakeluarga->buktikk) {
            Storage::disk('public')->delete($namakeluarga->buktikk);
        }

        $namakeluarga->delete();
        return redirect()->route('namakeluarga.index')->with('success', 'Data Keluarga Mahasiswa berhasil dihapus.');
    }
}

