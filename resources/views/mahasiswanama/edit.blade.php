<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Data Mahasiswa') }}: {{ $mahasiswanama->NAMA }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('mahasiswanama.update', $mahasiswanama->id) }}" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            {{-- Kolom Kiri --}}
                            <div class="space-y-6">
                                <div>
                                    <x-input-label for="NAMA" :value="__('Nama Lengkap')" />
                                    {{-- [PERBAIKAN] Menampilkan data lama dari database --}}
                                    <x-text-input id="NAMA" class="block mt-1 w-full" type="text" name="NAMA" :value="old('NAMA', $mahasiswanama->NAMA)" required autofocus autocomplete="name" />
                                    <x-input-error :messages="$errors->get('NAMA')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="NIM" :value="__('NIM (Nomor Induk Mahasiswa)')" />
                                    {{-- [PERBAIKAN] Menampilkan data lama dari database --}}
                                    <x-text-input id="NIM" class="block mt-1 w-full" type="number" name="NIM" :value="old('NIM', $mahasiswanama->NIM)" required />
                                    <x-input-error :messages="$errors->get('NIM')" class="mt-2" />
                                </div>
                                
                                <div>
                                    <x-input-label for="spp" :value="__('Biaya SPP (Rp)')" />
                                    {{-- [PERBAIKAN] Menampilkan data lama dari database --}}
                                    <x-text-input id="spp" class="block mt-1 w-full" type="number" name="spp" :value="old('spp', $mahasiswanama->spp)" required placeholder="Contoh: 5000000" />
                                    <x-input-error :messages="$errors->get('spp')" class="mt-2" />
                                </div>
                            </div>

                            {{-- Kolom Kanan --}}
                            <div class="space-y-6">
                                <div>
                                    <x-input-label for="email" :value="__('Alamat Email')" />
                                    {{-- [PERBAIKAN] Menampilkan data lama dari database --}}
                                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $mahasiswanama->email)" required autocomplete="email" />
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>
                                
                                {{-- [PERBAIKAN] Menambahkan input untuk Alamat --}}
                                <div>
                                    <x-input-label for="Alamat" :value="__('Alamat Lengkap')" />
                                    {{-- [PERBAIKAN] Menampilkan data lama dari database --}}
                                    <textarea id="Alamat" name="Alamat" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" rows="3" required>{{ old('Alamat', $mahasiswanama->Alamat) }}</textarea>
                                    <x-input-error :messages="$errors->get('Alamat')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="fotomahasiswa" :value="__('Ganti Foto Mahasiswa (Opsional)')" />
                                    <input id="fotomahasiswa" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" type="file" name="fotomahasiswa">
                                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">Kosongkan jika tidak ingin mengganti foto.</p>
                                    <x-input-error :messages="$errors->get('fotomahasiswa')" class="mt-2" />
                                    @if($mahasiswanama->fotomahasiswa)
                                        <div class="mt-4">
                                            <p class="text-sm font-medium text-gray-700 dark:text-gray-300">Foto Saat Ini:</p>
                                            <img src="{{ asset('storage/' . $mahasiswanama->fotomahasiswa) }}" alt="Foto {{ $mahasiswanama->NAMA }}" class="mt-2 h-24 w-24 rounded-md object-cover">
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-4 space-x-4">
                            <a href="{{ route('mahasiswanama.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-gray-800 dark:text-gray-200 uppercase tracking-widest hover:bg-gray-300 dark:hover:bg-gray-700">
                                {{ __('Batal') }}
                            </a>
                            <x-primary-button>
                                {{ __('Update') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
