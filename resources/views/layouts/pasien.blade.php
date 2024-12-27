<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Poliklinik - @yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    @stack('styles')
</head>
<body class="bg-gray-50 font-sans">
    <!-- Fixed Navbar -->
    <nav class="fixed top-0 left-0 right-0 z-50 bg-gradient-to-r from-blue-600 to-blue-800 border-b border-blue-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <!-- Logo and Brand -->
                <div class="flex items-center">
                    <a href="{{ route('pasien.dashboard') }}" class="flex items-center space-x-3">
                        <i class="fas fa-hospital-user text-white text-2xl"></i>
                        <span class="text-white font-bold text-xl">Poliklinik</span>
                    </a>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex md:items-center md:space-x-8">
                    <a href="{{ route('pasien.dashboard') }}" class="text-gray-100 hover:bg-blue-700 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200">
                        <i class="fas fa-home mr-2"></i>Home
                    </a>
                    <a href="{{ route('pasien.daftar-poli') }}" class="text-gray-100 hover:bg-blue-700 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200">
                        <i class="fas fa-clipboard-list mr-2"></i>Daftar Poli
                    </a>
                    <a href="{{ route('pasien.riwayat') }}" class="text-gray-100 hover:bg-blue-700 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200">
                        <i class="fas fa-history mr-2"></i>Riwayat
                    </a>
                    <a href="{{ route('pasien.profil') }}" class="text-gray-100 hover:bg-blue-700 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200">
                        <i class="fas fa-user-circle mr-2"></i>Profil
                    </a>
                    <form action="{{ route('logout') }}" method="POST" class="inline-block">
                        @csrf
                        <button type="submit" class="text-gray-100 hover:bg-blue-700 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200">
                            <i class="fas fa-sign-out-alt mr-2"></i>Logout
                        </button>
                    </form>
                </div>

                <!-- Mobile menu button -->
                <div class="flex items-center md:hidden">
                    <button id="menu-toggle" class="text-gray-100 hover:bg-blue-700 p-2 rounded-md">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div class="md:hidden hidden" id="mobile-menu">
                <div class="px-2 pt-2 pb-3 space-y-1">
                    <a href="{{ route('pasien.dashboard') }}" class="block text-gray-100 hover:bg-blue-700 px-3 py-2 rounded-md text-base font-medium">
                        <i class="fas fa-home mr-2"></i>Home
                    </a>
                    <a href="{{ route('pasien.daftar-poli') }}" class="block text-gray-100 hover:bg-blue-700 px-3 py-2 rounded-md text-base font-medium">
                        <i class="fas fa-clipboard-list mr-2"></i>Daftar Poli
                    </a>
                    <a href="{{ route('pasien.riwayat') }}" class="block text-gray-100 hover:bg-blue-700 px-3 py-2 rounded-md text-base font-medium">
                        <i class="fas fa-history mr-2"></i>Riwayat
                    </a>
                    <a href="{{ route('pasien.profil') }}" class="block text-gray-100 hover:bg-blue-700 px-3 py-2 rounded-md text-base font-medium">
                        <i class="fas fa-user-circle mr-2"></i>Profil
                    </a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full text-left text-gray-100 hover:bg-blue-700 px-3 py-2 rounded-md text-base font-medium">
                            <i class="fas fa-sign-out-alt mr-2"></i>Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Spacer for fixed navbar -->
    <div class="h-16"></div>

    <!-- Page Header -->
    <div class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h1 class="text-2xl font-bold text-gray-900">@yield('header')</h1>
        </div>
    </div>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="px-4 py-6 sm:px-0">
            <div class="bg-white rounded-lg shadow p-6">
                @yield('content')
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800">
        <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
            <p class="text-center text-gray-400 text-sm">&copy; 2024 Poliklinik. Semua Hak Dilindungi.</p>
        </div>
    </footer>

    <script>
        // Mobile menu toggle
        const menuToggle = document.getElementById('menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');

        menuToggle.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    </script>
    @stack('scripts')
</body>
</html>