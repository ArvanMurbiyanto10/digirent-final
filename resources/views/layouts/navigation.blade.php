<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Wrapper Utama --}}
        <div class="flex justify-between h-16 relative">
            
            {{-- BAGIAN KIRI: LOGO --}}
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <span class="text-xl font-bold text-red-600">
                        MY cell
                    </span>
                </div>
            </div>

            {{-- BAGIAN TENGAH: MENU UTAMA --}}
            <div class="hidden md:flex absolute left-1/2 -translate-x-1/2 h-full">
                <div class="flex items-center space-x-4">
                    {{-- 1. Home --}}
                    <a href="{{ route('home') }}" class="px-5 py-2 rounded-full text-sm font-semibold transition-colors duration-300
                        {{ request()->routeIs('home')
                        ? 'bg-purple-600 text-white shadow-md'
                        : 'text-gray-500 hover:text-purple-700' }}">
                        Home
                    </a>

                    {{-- 2. Produk --}}
                    <a href="{{ route('products.index') }}" class="px-5 py-2 rounded-full text-sm font-semibold transition-colors duration-300
                        {{ request()->routeIs('products.index') || request()->routeIs('products.show')
                        ? 'bg-purple-600 text-white shadow-md'
                        : 'text-gray-500 hover:text-purple-700' }}">
                        Produk
                    </a>

                    {{-- 3. MENU ADMIN (DROPDOWN) - Tetap di Tengah --}}
                    @auth
                        @if (Auth::user()->role === 'admin')
                            <div class="relative" x-data="{ openDashboard: false }" @click.outside="openDashboard = false" @close.stop="openDashboard = false">
                                <button @click="openDashboard = ! openDashboard" 
                                    class="flex items-center px-5 py-2 rounded-full text-sm font-semibold transition-colors duration-300 focus:outline-none
                                    {{ request()->routeIs('admin.*') 
                                        ? 'bg-purple-600 text-white shadow-md' 
                                        : 'text-gray-500 hover:text-purple-700' }}">
                                    <span>Dashboard</span>
                                    <svg class="ms-1 h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </button>

                                <div x-show="openDashboard"
                                     x-transition:enter="transition ease-out duration-200"
                                     x-transition:enter-start="opacity-0 scale-95"
                                     x-transition:enter-end="opacity-100 scale-100"
                                     x-transition:leave="transition ease-in duration-75"
                                     x-transition:leave-start="opacity-100 scale-100"
                                     x-transition:leave-end="opacity-0 scale-95"
                                     class="absolute z-50 mt-2 w-48 rounded-md shadow-lg origin-top-right bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
                                     style="display: none;">
                                    <div class="py-1">
                                        <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-50 font-semibold text-purple-700' : '' }}">
                                            Kelola Pesanan
                                        </a>
                                        <a href="{{ route('admin.products.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 {{ request()->routeIs('admin.products.*') ? 'bg-gray-50 font-semibold text-purple-700' : '' }}">
                                            Kelola Produk
                                        </a>
                                        <a href="{{ route('admin.news-items.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 {{ request()->routeIs('admin.news-items.*') ? 'bg-gray-50 font-semibold text-purple-700' : '' }}">
                                            Kelola Berita
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endauth
                </div>
            </div>

            {{-- BAGIAN KANAN: USER CART & PROFILE --}}
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @auth
                    {{-- [BARU] IKON KERANJANG (Hanya untuk User Biasa) --}}
                    @if (Auth::user()->role !== 'admin')
                        <a href="{{ route('dashboard') }}" 
                           class="relative p-2 me-3 text-gray-500 hover:text-purple-700 transition-colors duration-300" 
                           title="Keranjang Saya">
                            {{-- SVG Icon Keranjang (Cart) --}}
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                            </svg>
                        </a>
                    @endif

                    {{-- Dropdown Profile --}}
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }}</div>
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    {{-- Tombol Login --}}
                    <a href="{{ route('login') }}" class="px-5 py-2 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition shadow-md shadow-blue-200">
                        Log in
                    </a>
                @endauth
            </div>

            {{-- Hamburger Mobile --}}
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- MENU RESPONSIVE (MOBILE) --}}
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">
                {{ __('Home') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('products.index')" :active="request()->routeIs('products.index')">
                {{ __('Produk') }}
            </x-responsive-nav-link>

            {{-- Dashboard di Mobile --}}
            @auth
                @if (Auth::user()->role === 'admin')
                    <div class="border-t border-gray-100 mt-2 pt-2">
                        <div class="px-4 text-xs font-semibold text-gray-400 uppercase">Menu Admin</div>
                        <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                            {{ __('Kelola Pesanan') }}
                        </x-responsive-nav-link>
                        <x-responsive-nav-link :href="route('admin.products.index')" :active="request()->routeIs('admin.products.*')">
                            {{ __('Kelola Produk') }}
                        </x-responsive-nav-link>
                        <x-responsive-nav-link :href="route('admin.news-items.index')" :active="request()->routeIs('admin.news-items.*')">
                            {{ __('Kelola Berita') }}
                        </x-responsive-nav-link>
                    </div>
                @else
                    {{-- Dashboard User (Keranjang) di Mobile --}}
                    <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Keranjang Saya') }}
                    </x-responsive-nav-link>
                @endif
            @endauth
        </div>

        {{-- Mobile Settings --}}
        <div class="pt-4 pb-1 border-t border-gray-200">
            @auth
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">{{ __('Profile') }}</x-responsive-nav-link>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            @else
                <div class="pt-2 pb-3 space-y-1">
                    <x-responsive-nav-link :href="route('login')">{{ __('Log In') }}</x-responsive-nav-link>
                </div>
            @endauth
        </div>
    </div>
</nav>