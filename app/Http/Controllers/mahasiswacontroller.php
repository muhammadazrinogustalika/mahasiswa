<?php

namespace App\Http\Controllers;

use App\Models\Namamahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MahasiswaController extends Controller
{
    /**
     * Menampilkan daftar semua data mahasiswa.
     */
    public function index()
    {
        $mahasiswa = Namamahasiswa::latest()->paginate(10);
        return view('mahasiswanama.index', compact('mahasiswa'));
    }

public function dashboard()
{
    // Hitung data untuk cards
    $totalmahasiswa   = Namamahasiswa::count();
    $totalNama = Namamahasiswa::distinct('NAMA')->count('NAMA');
    $totalspp     = Namamahasiswa::where('spp', '<=', 5)->count();
    $totalNIM = Namamahasiswa::whereDate('created_at', now()->toDateString())->count();

    // Ambil data mahasiswa untuk tabel
    $mahasiswa = Namamahasiswa::latest()->paginate(10);

    return view('dashboard', compact(
        'totalmahasiswa',
        'totalNama',
        'totalspp',
        'totalNIM',
        'mahasiswa'
    ));
}



    /**
     * Menampilkan form untuk membuat data mahasiswa baru.
     */
    public function create()
    {
        return view('mahasiswanama.create');
    }

    /**
     * Menyimpan data mahasiswa baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'NAMA' => 'required|string|max:255',
            // [PERBAIKAN] Mengubah validasi NIM menjadi string untuk mencocokkan skema database
            'NIM' => 'required|string|max:255|unique:mahasiswa,NIM',
            'Alamat' => 'required|string|max:255',
            'email' => 'required|email|unique:mahasiswa,email',
            'spp' => 'required|numeric',
            'fotomahasiswa' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $path = null;
        if ($request->hasFile('fotomahasiswa')) {
            $path = $request->file('fotomahasiswa')->store('fotomahasiswa', 'public');
        }

        // [PERBAIKAN] Membersihkan input SPP dari karakter non-digit sebelum disimpan
        $sppClean = preg_replace('/[^0-9]/', '', $request->spp);

        Namamahasiswa::create([
            'NAMA' => $request->NAMA,
            'NIM' => $request->NIM,
            'Alamat' => $request->Alamat,
            'email' => $request->email,
            'spp' => $sppClean, // Menggunakan nilai SPP yang sudah bersih
            'fotomahasiswa' => $path,
        ]);

        return redirect()->route('mahasiswanama.index')->with('success', 'Data Mahasiswa berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit data mahasiswa.
     */
    public function edit(Namamahasiswa $mahasiswanama)
    {
        return view('mahasiswanama.edit', compact('mahasiswanama'));
    }

    /**
     * Memperbarui data mahasiswa di database.
     */
    public function update(Request $request, Namamahasiswa $mahasiswanama)
    {
        $request->validate([
            'NAMA' => 'required|string|max:255',
            // [PERBAIKAN] Mengubah validasi NIM menjadi string dan memperbaiki aturan unique
            'NIM' => 'required|string|max:255|unique:mahasiswa,NIM,' . $mahasiswanama->id,
            'Alamat' => 'required|string|max:255',
            'email' => 'required|email|unique:mahasiswa,email,' . $mahasiswanama->id,
            'spp' => 'required|numeric',
            'fotomahasiswa' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $path = $mahasiswanama->fotomahasiswa;
        if ($request->hasFile('fotomahasiswa')) {
            if ($path) {
                Storage::disk('public')->delete($path);
            }
            $path = $request->file('fotomahasiswa')->store('fotomahasiswa', 'public');
        }

        // [PERBAIKAN] Membersihkan input SPP dari karakter non-digit sebelum disimpan
        $sppClean = preg_replace('/[^0-9]/', '', $request->spp);

        $mahasiswanama->update([
            'NAMA' => $request->NAMA,
            'NIM' => $request->NIM,
            'Alamat' => $request->Alamat,
            'email' => $request->email,
            'spp' => $sppClean, // Menggunakan nilai SPP yang sudah bersih
            'fotomahasiswa' => $path,
        ]);

        return redirect()->route('mahasiswanama.index')->with('success', 'Data Mahasiswa berhasil diperbarui.');
    }

    /**
     * Menghapus data mahasiswa dari database.
     */
    public function destroy(Namamahasiswa $mahasiswanama) // [PERBAIKAN] Type-hint harus 'Namamahasiswa'
    {
        // Hapus file foto jika ada
        if ($mahasiswanama->fotomahasiswa) {
            Storage::disk('public')->delete($mahasiswanama->fotomahasiswa);
        }

        $mahasiswanama->delete();
        return redirect()->route('mahasiswanama.index')->with('success', 'Data Mahasiswa berhasil dihapus.');
    }
}

