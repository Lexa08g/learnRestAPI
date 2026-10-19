<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center space-x-2">
                        <span class="w-9 h-9 rounded-lg bg-emerald-600 text-white flex items-center justify-center font-bold text-lg">
                            <i class="fas fa-seedling"></i>
                        </span>
                        <span class="font-bold text-lg text-emerald-800 hidden sm:inline-block">SIM Petani</span>
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                        Beranda
                    </x-nav-link>
                    <x-nav-link :href="route('katalog')" :active="request()->routeIs('katalog')">
                        Daftar Petani
                    </x-nav-link>
                    <x-nav-link :href="route('promo')" :active="request()->routeIs('promo')">
                        Program Tani
                    </x-nav-link>
                    <x-nav-link :href="route('tentang')" :active="request()->routeIs('tentang')">
                        Tentang
                    </x-nav-link>
                    <x-nav-link :href="route('petani.index')" :active="request()->routeIs('petani.*')">
                        Kelola Data
                    </x-nav-link>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6 space-x-4">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ route('petani.index') }}" class="text-sm font-semibold text-emerald-700 hover:text-emerald-900">
                            Dashboard Admin
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-semibold text-gray-700 hover:text-emerald-700">
                            Masuk
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-xs font-semibold rounded-lg text-white bg-emerald-600 hover:bg-emerald-700 shadow-sm transition">
                                Daftar
                            </a>
                        @endif
                    @endauth
                @endif
            </div>

            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">
                Beranda
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('katalog')" :active="request()->routeIs('katalog')">
                Daftar Petani
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('promo')" :active="request()->routeIs('promo')">
                Program Tani
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('tentang')" :active="request()->routeIs('tentang')">
                Tentang
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('petani.index')" :active="request()->routeIs('petani.*')">
                Kelola Data
            </x-responsive-nav-link>
        </div>

        <div class="pt-4 pb-3 border-t border-gray-200">
            @if (Route::has('login'))
                <div class="space-y-1">
                    @auth
                        <div class="px-4 mb-2">
                            <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                            <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                        </div>
                        <x-responsive-nav-link :href="route('petani.index')">
                            Dashboard Admin
                        </x-responsive-nav-link>
                    @else
                        <x-responsive-nav-link :href="route('login')">
                            Masuk
                        </x-responsive-nav-link>
                        @if (Route::has('register'))
                            <x-responsive-nav-link :href="route('register')">
                                Daftar Akun
                            </x-responsive-nav-link>
                        @endif
                    @endauth
                </div>
            @endif
        </div>
    </div>
</nav>
