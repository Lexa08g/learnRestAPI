<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Admin Petani</title>

    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        .bg-sidebar { background: #166534; }
        .active-nav-link { background: #14532d; }
        .nav-item:hover { background: #15803d; }
    </style>
</head>

<body class="bg-gray-100 font-sans flex">

    <aside class="relative bg-sidebar h-screen w-64 hidden sm:block shadow-xl flex-shrink-0">
        <div class="p-6">
            <a href="{{ route('petani.index') }}" class="text-white text-2xl font-bold uppercase tracking-wider flex items-center space-x-2">
                <i class="fas fa-tractor text-emerald-300"></i>
                <span>SIM Petani</span>
            </a>
            <div class="mt-2 text-xs text-emerald-200">Panel Manajemen Pertanian</div>
        </div>
        <nav class="text-white text-base font-semibold pt-3">
            <a href="{{ route('petani.index') }}" class="flex items-center text-white opacity-85 hover:opacity-100 py-4 pl-6 nav-item {{ request()->routeIs('petani.*') ? 'active-nav-link' : '' }}">
                <i class="fas fa-users mr-3"></i>
                Data Petani
            </a>
            <a href="{{ route('dashboard') }}" class="flex items-center text-white opacity-85 hover:opacity-100 py-4 pl-6 nav-item {{ request()->routeIs('dashboard') ? 'active-nav-link' : '' }}">
                <i class="fas fa-chart-line mr-3"></i>
                Dashboard
            </a>
            <a href="{{ route('home') }}" class="flex items-center text-white opacity-85 hover:opacity-100 py-4 pl-6 nav-item">
                <i class="fas fa-globe mr-3"></i>
                Halaman Publik
            </a>
        </nav>
    </aside>

    <div class="w-full flex flex-col h-screen overflow-y-hidden">
        <header class="w-full items-center bg-white py-3 px-6 hidden sm:flex justify-between shadow-sm">
            <div class="text-sm font-semibold text-gray-600">
                Sistem Informasi Pertanian & Binaan Petani
            </div>
            <div x-data="{ isOpen: false }" class="relative flex justify-end">
                <button @click="isOpen = !isOpen" class="flex items-center space-x-3 text-sm font-semibold text-gray-700 hover:text-gray-900 focus:outline-none">
                    <img class="w-9 h-9 rounded-full object-cover border" src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name ?? 'Admin') }}&background=166534&color=fff" alt="Avatar">
                    <span>{{ Auth::user()->name ?? 'Admin' }}</span>
                    <i class="fas fa-chevron-down text-xs text-gray-400"></i>
                </button>
                <div x-show="isOpen" @click.away="isOpen = false" class="absolute w-44 bg-white rounded-lg shadow-lg py-2 mt-12 z-20 border border-gray-100">
                    @auth
                        <div class="px-4 py-2 border-b border-gray-100 text-xs text-gray-500">
                            Masuk sebagai <strong>{{ Auth::user()->role ?? 'admin' }}</strong>
                        </div>
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Profil Saya</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-rose-600 hover:bg-rose-50">Keluar</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Login</a>
                    @endauth
                </div>
            </div>
        </header>

        <header x-data="{ isOpen: false }" class="w-full bg-sidebar py-4 px-6 sm:hidden">
            <div class="flex items-center justify-between">
                <a href="{{ route('petani.index') }}" class="text-white text-xl font-bold flex items-center space-x-2">
                    <i class="fas fa-tractor text-emerald-300"></i>
                    <span>SIM Petani</span>
                </a>
                <button @click="isOpen = !isOpen" class="text-white text-2xl focus:outline-none">
                    <i x-show="!isOpen" class="fas fa-bars"></i>
                    <i x-show="isOpen" class="fas fa-times"></i>
                </button>
            </div>

            <nav :class="isOpen ? 'flex': 'hidden'" class="flex flex-col pt-4">
                <a href="{{ route('petani.index') }}" class="flex items-center text-white py-2 pl-4 nav-item {{ request()->routeIs('petani.*') ? 'active-nav-link' : '' }}">
                    <i class="fas fa-users mr-3"></i>
                    Data Petani
                </a>
                <a href="{{ route('dashboard') }}" class="flex items-center text-white py-2 pl-4 nav-item">
                    <i class="fas fa-chart-line mr-3"></i>
                    Dashboard
                </a>
                <a href="{{ route('home') }}" class="flex items-center text-white py-2 pl-4 nav-item">
                    <i class="fas fa-globe mr-3"></i>
                    Halaman Publik
                </a>
            </nav>
        </header>

        <div class="w-full overflow-x-hidden border-t flex flex-col flex-grow">
            <main class="w-full flex-grow p-6">
                {{ $slot }}
            </main>
        </div>
    </div>

</body>
</html>
