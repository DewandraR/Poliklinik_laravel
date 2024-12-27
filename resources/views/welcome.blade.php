<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Poliklinik BK - Healthcare Innovation</title>
    @vite('resources/css/app.css')
    <!-- Tambahkan Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .bg-pattern {
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%234299e1' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }
    </style>
</head>
<body class="bg-pattern">
    <!-- Navbar dengan glassmorphism effect -->
    <nav class="fixed w-full z-50 backdrop-blur-md bg-white/80 shadow">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex justify-between h-20">
                <div class="flex items-center gap-2">
                    <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center">
                        <span class="text-xl font-bold text-white">P</span>
                    </div>
                    <span class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-blue-800 bg-clip-text text-transparent">
                        Poliklinik BK
                    </span>
                </div>
                
                <div class="flex items-center gap-6">
                    @auth
                        <a href="{{ url('/dashboard') }}" 
                           class="relative group">
                            <span class="text-gray-700 font-medium group-hover:text-blue-600 transition-colors">
                                Dashboard
                            </span>
                            <span class="absolute bottom-0 left-0 w-full h-0.5 bg-blue-600 transform scale-x-0 group-hover:scale-x-100 transition-transform origin-left"></span>
                        </a>
                    @else
                        <a href="{{ route('login') }}" 
                           class="relative group">
                            <span class="text-gray-700 font-medium group-hover:text-blue-600 transition-colors">
                                Login
                            </span>
                            <span class="absolute bottom-0 left-0 w-full h-0.5 bg-blue-600 transform scale-x-0 group-hover:scale-x-100 transition-transform origin-left"></span>
                        </a>
                        <a href="{{ route('register') }}" 
                           class="bg-gradient-to-r from-blue-600 to-blue-800 text-white px-6 py-2.5 rounded-full font-medium hover:shadow-lg hover:shadow-blue-500/30 transition-all">
                            Register
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section dengan Animated Shapes -->
    <div class="relative overflow-hidden pt-32 pb-24">
        <!-- Animated Background Shapes -->
        <div class="absolute top-0 left-0 w-full h-full">
            <div class="absolute top-1/4 left-1/4 w-64 h-64 bg-blue-200 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-float" style="animation-delay: 0s;"></div>
            <div class="absolute top-1/3 right-1/4 w-64 h-64 bg-purple-200 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-float" style="animation-delay: 2s;"></div>
            <div class="absolute bottom-1/4 right-1/3 w-64 h-64 bg-pink-200 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-float" style="animation-delay: 4s;"></div>
        </div>

        <!-- Hero Content -->
        <div class="max-w-7xl mx-auto px-6 relative">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="text-center lg:text-left">
                    <h1 class="text-5xl lg:text-6xl font-bold">
                        <span class="bg-gradient-to-r from-blue-600 to-blue-800 bg-clip-text text-transparent">
                            Inovasi Kesehatan
                        </span>
                        <br>
                        untuk Masa Depan
                    </h1>
                    <p class="mt-6 text-xl text-gray-600 leading-relaxed">
                        Layanan kesehatan modern dengan teknologi terdepan dan tim medis profesional untuk kesehatan Anda.
                    </p>
                    <div class="mt-10 flex gap-6 justify-center lg:justify-start">
                        <a href="{{ route('register') }}" 
                           class="group relative px-8 py-4 bg-blue-600 text-white rounded-full font-medium hover:shadow-lg hover:shadow-blue-500/30 transition-all duration-300">
                            <span class="relative z-10">Mulai Sekarang</span>
                            <div class="absolute inset-0 h-full w-full rounded-full bg-gradient-to-r from-blue-600 to-blue-800 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        </a>
                        <a href="#layanan" 
                           class="group px-8 py-4 border-2 border-blue-600 text-blue-600 rounded-full font-medium hover:bg-blue-50 transition-all">
                            Lihat Layanan
                            <span class="inline-block transition-transform group-hover:translate-x-1">→</span>
                        </a>
                    </div>
                </div>
                <div class="hidden lg:block relative">
                    <div class="relative">
                        <div class="absolute inset-0 bg-gradient-to-r from-blue-500 to-purple-500 rounded-3xl rotate-3 scale-105 opacity-20"></div>
                        <img src="https://images.unsplash.com/photo-1576091160550-2173dba999ef?auto=format&fit=crop&q=80" 
                             alt="Modern Healthcare" 
                             class="rounded-3xl shadow-2xl relative z-10">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Layanan Section dengan Animated Cards -->
    <section id="layanan" class="py-24">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center">
                <h2 class="text-4xl font-bold bg-gradient-to-r from-blue-600 to-blue-800 bg-clip-text text-transparent">
                    Layanan Unggulan
                </h2>
                <p class="mt-4 text-xl text-gray-600">
                    Solusi kesehatan komprehensif untuk keluarga Anda
                </p>
            </div>

            <div class="mt-16 grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($polis->take(3) as $poli)
                    <div class="group relative">
                        <div class="absolute inset-0 bg-gradient-to-r from-blue-500 to-purple-500 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="relative bg-white p-8 rounded-xl shadow-lg group-hover:translate-y-[-5px] transition-all duration-300">
                            <div class="w-14 h-14 bg-blue-100 rounded-lg flex items-center justify-center mb-6">
                                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-900">{{ $poli->nama_poli }}</h3>
                            <p class="mt-4 text-gray-600">{{ $poli->keterangan ?? 'Layanan kesehatan spesialisasi dengan tenaga medis profesional dan peralatan modern.' }}</p>
                            <a href="{{ route('register') }}" 
                            class="mt-6 inline-flex items-center text-blue-600 font-medium hover:text-blue-800 transition-colors">
                                Daftar Konsultasi
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            @if($polis->count() > 3)
                <div class="mt-12 text-center">
                    <p class="text-gray-600">
                        Kami juga memiliki layanan poli lainnya:
                        <span class="font-medium text-gray-800">
                            {{ $polis->skip(3)->pluck('nama_poli')->implode(', ') }}
                        </span>
                    </p>
                    <a href="{{ route('register') }}" 
                    class="mt-6 inline-flex items-center px-6 py-3 bg-blue-50 text-blue-600 rounded-lg font-medium hover:bg-blue-100 transition-all">
                        Lihat Semua Layanan
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                </div>
            @endif
        </div>
    </section>

    <!-- CTA Section dengan Gradient & Pattern -->
    <section class="relative py-24 overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-blue-600 to-blue-800"></div>
        <div class="absolute inset-0 opacity-10 bg-pattern"></div>
        <div class="relative max-w-7xl mx-auto px-6 text-center">
            <h2 class="text-4xl font-bold text-white">
                Mulai Perjalanan Kesehatan Anda
            </h2>
            <p class="mt-6 text-xl text-blue-100">
                Bergabung sekarang dan dapatkan akses ke layanan kesehatan terbaik
            </p>
            <a href="{{ route('register') }}" 
               class="mt-10 inline-flex items-center px-8 py-4 bg-white text-blue-600 rounded-full font-medium hover:shadow-xl hover:shadow-black/10 transition-all">
                Daftar Sekarang
                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>
    </section>

    <!-- Footer dengan Glassmorphism -->
    <footer class="bg-gray-900 text-white relative overflow-hidden">
        <div class="absolute inset-0 bg-pattern opacity-5"></div>
        <div class="relative max-w-7xl mx-auto px-6 py-16">
            <div class="grid md:grid-cols-3 gap-12">
                <div>
                    <h3 class="text-lg font-semibold mb-4">Poliklinik BK</h3>
                    <p class="text-gray-400 leading-relaxed">
                        Menyediakan layanan kesehatan terbaik dengan teknologi terdepan dan tenaga profesional untuk seluruh keluarga Anda.
                    </p>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Layanan Utama</h3>
                    <ul class="space-y-2">
                        @foreach($polis->take(3) as $poli)
                            <li>
                                <a href="#" class="text-gray-400 hover:text-white transition">
                                    {{ $poli->nama_poli }}
                                </a>
                            </li>
                        @endforeach
                        @if($polis->count() > 3)
                            <li>
                                <span class="text-gray-500 text-sm">
                                    Dan {{ $polis->count() - 3 }} layanan lainnya
                                </span>
                            </li>
                        @endif
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Kontak</h3>
                    <p class="text-gray-400">Jl. Imam Bonjol No 207, Semarang Tengah, Kota Semarang</p>
                    <p class="text-gray-400">Email: info@poliklinikbk.com</p>
                    <p class="text-gray-400">Telepon: +628-21-5878-3230</p>
                </div>
            </div>
            <div class="mt-12 text-center text-gray-500">
                <p>&copy; 2024 Poliklinik BK. Semua Hak Dilindungi.</p>
            </div>
        </div>
    </footer>
    
</body>
</html>

