<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Data Keluarga Mahasiswa Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-6">
                        Formulir Data Keluarga Mahasiswa
                    </h3>

                    <form method="POST" action="{{ route('namakeluarga.store') }}" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        
                        {{-- [PERBAIKAN] Menambahkan field untuk memilih NIM Mahasiswa --}}
                        <div>
                            <x-input-label for="NIM" :value="__('Pilih Mahasiswa (NIM)')" />
                            <select name="NIM" id="NIM" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                                <option value="" disabled selected>-- Pilih NIM Mahasiswa --</option>
                                @foreach($mahasiswa as $mhs)
                                    <option value="{{ $mhs->NIM }}" {{ old('NIM') == $mhs->NIM ? 'selected' : '' }}>
                                        {{ $mhs->NIM }} - {{ $mhs->NAMA }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('NIM')" class="mt-2" />
                        </div>


                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            {{-- Kolom Kiri --}}
                            <div class="space-y-6">
                                <div>
                                    <x-input-label for="NAMA_AYAH" :value="__('Nama Lengkap Ayah')" />
                                    <x-text-input id="NAMA_AYAH" class="block mt-1 w-full" type="text" name="NAMA_AYAH" :value="old('NAMA_AYAH')" required autofocus />
                                    <x-input-error :messages="$errors->get('NAMA_AYAH')" class="mt-2" />
                                </div>
                                
                                <div>
                                    <x-input-label for="hubungan_ayah" :value="__('Status Hubungan Ayah')" />
                                    <x-text-input id="hubungan_ayah" class="block mt-1 w-full" type="text" name="hubungan_ayah" :value="old('hubungan_ayah')" required placeholder="Contoh: Ayah Kandung"/>
                                    <x-input-error :messages="$errors->get('hubungan_ayah')" class="mt-2" />
                                </div>

                            </div>

                            {{-- Kolom Kanan --}}
                            <div class="space-y-6">
                               <div>
                                    <x-input-label for="NAMA_IBU" :value="__('Nama Lengkap Ibu')" />
                                    <x-text-input id="NAMA_IBU" class="block mt-1 w-full" type="text" name="NAMA_IBU" :value="old('NAMA_IBU')" required />
                                    <x-input-error :messages="$errors->get('NAMA_IBU')" class="mt-2" />
                                </div>
                                
                                <div>
                                    <x-input-label for="hubungan_ibu" :value="__('Status Hubungan Ibu')" />
                                    <x-text-input id="hubungan_ibu" class="block mt-1 w-full" type="text" name="hubungan_ibu" :value="old('hubungan_ibu')" required placeholder="Contoh: Ibu Kandung"/>
                                    <x-input-error :messages="$errors->get('hubungan_ibu')" class="mt-2" />
                                </div>

                            </div>
                        </div>
                        
                        {{-- Input file di luar grid --}}
                        <div class="pt-6">
                            <x-input-label for="buktikk" :value="__('Upload Bukti KK (.pdf)')" />
                            <input id="buktikk" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" type="file" name="buktikk" accept=".pdf">
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">PDF (MAX. 100MB).</p>
                            <x-input-error :messages="$errors->get('buktikk')" class="mt-2" />
                        </div>


                        {{-- Tombol Aksi --}}
                        <div class="flex items-center justify-end pt-6 border-t border-gray-200 dark:border-gray-700 space-x-4">
                            <a href="{{ route('namakeluarga.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-gray-800 dark:text-gray-200 uppercase tracking-widest hover:bg-gray-300 dark:hover:bg-gray-500 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
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
