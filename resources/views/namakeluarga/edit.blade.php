<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manajemen Data Keluarga Mahasiswa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-2xl font-semibold text-gray-900 dark:text-gray-100">Daftar Data Keluarga Mahasiswa</h3>
                        <a href="{{ route('namakeluarga.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                            Tambah Data Keluarga
                        </a>
                    </div>

                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 dark:bg-green-700 dark:border-green-600 dark:text-green-100 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="py-3 px-6">No.</th>
                                    <th scope="col" class="py-3 px-6">NIM Mahasiswa</th>
                                    <th scope="col" class="py-3 px-6">Nama Mahasiswa</th>
                                    <th scope="col" class="py-3 px-6">Nama Ayah</th>
                                    <th scope="col" class="py-3 px-6">Nama Ibu</th>
                                    <th scope="col" class="py-3 px-6">Bukti KK</th>
                                    <th scope="col" class="py-3 px-6 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($keluarga as $index => $item)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td class="py-4 px-6">{{ $keluarga->firstItem() + $index }}</td>
                                    {{-- [PERBAIKAN] Menggunakan relasi untuk menampilkan data mahasiswa --}}
                                    <td class="py-4 px-6 font-medium text-gray-900 dark:text-white">{{ $item->NIM }}</td>
                                    <td class="py-4 px-6">{{ $item->mahasiswa->NAMA ?? 'N/A' }}</td>
                                    <td class="py-4 px-6">{{ $item->NAMA_AYAH }}</td>
                                    <td class="py-4 px-6">{{ $item->NAMA_IBU }}</td>
                                    <td class="py-4 px-6">
                                        @if ($item->buktikk)
                                            {{-- [PERBAIKAN] Menampilkan link PDF, bukan gambar --}}
                                            <a href="{{ asset('storage/' . $item->buktikk) }}" target="_blank" class="text-indigo-600 dark:text-indigo-400 hover:underline">
                                                Lihat File
                                            </a>
                                        @else
                                            <span>N/A</span>
                                        @endif
                                    </td>
                                    <td class="py-4 px-6">
                                        <div class="flex justify-center items-center space-x-2">
                                            <a href="{{ route('namakeluarga.edit', $item->id) }}" class="p-2 bg-yellow-500 text-white rounded-md hover:bg-yellow-600" title="Edit">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.5L16.732 3.732z"></path></svg>
                                            </a>
                                            <form action="{{ route('namakeluarga.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data Keluarga mahasiswa ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-2 bg-red-500 text-white rounded-md hover:bg-red-600" title="Hapus">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="py-4 px-6 text-center text-gray-500 dark:text-gray-400">
                                        Data Keluarga Mahasiswa belum tersedia.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $keluarga->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
