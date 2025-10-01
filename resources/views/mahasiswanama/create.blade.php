<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Data Mahasiswa Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-6">
                        Formulir Data Mahasiswa
                    </h3>

                    <form method="POST" action="{{ route('mahasiswanama.store') }}" enctype="multipart/form-data" class="space-y-6">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            {{-- Kolom Kiri --}}
                            <div class="space-y-6">
                                <div>
                                    <x-input-label for="NAMA" :value="__('Nama Lengkap')" />
                                    <x-text-input id="NAMA" class="block mt-1 w-full" type="text" name="NAMA" :value="old('NAMA')" required autofocus autocomplete="name" />
                                    <x-input-error :messages="$errors->get('NAMA')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="NIM" :value="__('NIM (Nomor Induk Mahasiswa)')" />
                                    <x-text-input id="NIM" class="block mt-1 w-full" type="number" name="NIM" :value="old('NIM')" required />
                                    <x-input-error :messages="$errors->get('NIM')" class="mt-2" />
                                </div>
                                
                                <div>
                                    <x-input-label for="spp" :value="__('Biaya SPP (Rp)')" />
                                    <x-text-input id="spp" class="block mt-1 w-full" type="number" name="spp" :value="old('spp')" required placeholder="Contoh: 5000000" />
                                    <x-input-error :messages="$errors->get('spp')" class="mt-2" />
                                </div>
                            </div>

                            {{-- Kolom Kanan --}}
                            <div class="space-y-6">
                                <div>
                                    <x-input-label for="email" :value="__('Alamat Email')" />
                                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="email" />
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>
                                
                                {{-- [PERBAIKAN] Menambahkan input untuk Alamat yang wajib diisi di controller --}}
                                <div>
                                    <x-input-label for="Alamat" :value="__('Alamat Lengkap')" />
                                    <textarea id="Alamat" name="Alamat" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" rows="3" required>{{ old('Alamat') }}</textarea>
                                    <x-input-error :messages="$errors->get('Alamat')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="fotomahasiswa" :value="__('Upload Foto Mahasiswa (Opsional)')" />
                                    <input id="fotomahasiswa" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" type="file" name="fotomahasiswa">
                                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">PNG, JPG, atau WEBP (MAX. 2MB).</p>
                                    <x-input-error :messages="$errors->get('fotomahasiswa')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        {{-- Tombol Aksi --}}
                        <div class="flex items-center justify-end pt-6 border-t border-gray-200 dark:border-gray-700 space-x-4">
                            <a href="{{ route('mahasiswanama.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-gray-800 dark:text-gray-200 uppercase tracking-widest hover:bg-gray-300 dark:hover:bg-gray-500 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                {{ __('Batal') }}
                            </a>
                            <x-primary-button>
                                {{ __('Simpan Data') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
