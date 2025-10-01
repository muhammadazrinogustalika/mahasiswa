<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Selamat Datang di Universitas Telkom Purwokerto</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700,800" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        </head>
    <body class="antialiased font-sans bg-gray-900">
        
        <div class="absolute top-0 left-0 w-full h-full z-0">
            <img src="https://images.pexels.com/photos/1709003/pexels-photo-1709003.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2" 
                 alt="Latar Belakang Kampus Modern" 
                 class="w-full h-full object-cover">
            
            <div class="absolute top-0 left-0 w-full h-full bg-gradient-to-b from-black/60 via-black/70 to-black/80"></div>
        </div>

        {{-- Wadah utama di atas latar belakang --}}
        <div class="relative min-h-screen text-gray-200 overflow-hidden z-10">
            
            {{-- Header untuk Navigasi Login/Register --}}
            @if (Route::has('login'))
                <header class="absolute top-0 p-6 w-full z-20">
                    <div class="flex justify-end items-center gap-4">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-200 hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500 transition-colors">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="font-semibold text-gray-200 hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500 transition-colors">Login</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="font-semibold text-gray-200 hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500 transition-colors">Daftar</a>
                            @endif
                        @endauth

                        </div>
                </header>
            @endif

            {{-- Konten Utama (Hero Section) --}}
            <main class="relative z-10 flex items-center justify-center min-h-screen p-6">
                <div class="text-center max-w-4xl">
                    
                    {{-- Logo dengan Efek Glassmorphism --}}
                    <div class="flex justify-center mb-8 animate-fade-in-down">
                        <div class="bg-white/10 backdrop-blur-md p-4 rounded-2xl shadow-lg border border-white/20">
                            {{-- Pilihan Logo Putih (sesuai saran sebelumnya) --}}
                            <img src="https://upload.wikimedia.org/wikipedia/id/thumb/c/c5/TUP_Vertikal.png/250px-TUP_Vertikal.png" alt="Logo Universitas Telkom Purwokerto" class="h-20 w-auto">
                        </div>
                    </div>

                    {{-- Judul Utama dengan Teks Gradien --}}
                    <h1 class="text-4xl md:text-6xl font-extrabold tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-red-500 via-orange-400 to-red-500 drop-shadow-lg animate-fade-in-down" style="animation-delay: 0.2s;">
                        Gerbang Inovasi Menuju Karir Global
                    </h1>

                    {{-- Deskripsi --}}
                    <p class="mt-6 text-lg text-gray-300 max-w-2xl mx-auto animate-fade-in-down drop-shadow-md" style="animation-delay: 0.4s;">
                        Di Universitas Telkom Purwokerto, kami mempersiapkan Anda untuk menjadi pemimpin di era digital. Dengan kurikulum terdepan, fasilitas modern, dan lingkungan akademik yang suportif, mari raih masa depan gemilang Anda bersama kami.
                    </p>

                    {{-- Tombol Call to Action --}}
                    <div class="mt-10 flex flex-col sm:flex-row items-center justify-center gap-4 animate-fade-in-up" style="animation-delay: 0.6s;">
                        @auth
                             <a href="{{ url('/dashboard') }}" class="group inline-flex items-center justify-center w-full sm:w-auto bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-8 rounded-lg transition-all duration-300 transform hover:scale-105 shadow-lg">
                                 Buka Dashboard
                                 <svg class="ml-2 w-5 h-5 transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                             </a>
                        @else
                            <a href="{{ route('register') }}" class="group inline-flex items-center justify-center w-full sm:w-auto bg-gradient-to-r from-red-600 to-orange-500 hover:from-red-700 hover:to-orange-600 text-white font-bold py-3 px-8 rounded-lg transition-all duration-300 transform hover:scale-105 shadow-lg">
                                Daftar Sekarang
                                <svg class="ml-2 w-5 h-5 transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                            </a>
                            {{-- [MODIFIKASI] Class dark: telah dihapus dan digabungkan --}}
                            <a href="{{ route('login') }}" class="w-full sm:w-auto bg-gray-800/30 hover:bg-gray-700/50 backdrop-blur-sm text-gray-100 font-semibold py-3 px-8 border border-gray-600 rounded-lg transition-colors duration-300 shadow-sm">
                                Info Pendaftaran
                            </a>
                        @endauth
                    </div>
                </div>
            </main>

            {{-- Footer --}}
            {{-- [MODIFIKASI] Class dark: telah dihapus --}}
            <footer class="absolute bottom-0 w-full text-center p-6 text-sm text-gray-400">
                &copy; {{ date('Y') }} Universitas Telkom Purwokerto. Hak Cipta Dilindungi.
            </footer>
        </div>

        </body>
</html>