<nav x-data="{ open: false }" class="bg-white border-b border-gray-100"> {{-- Navigasi utama dengan Alpine.js (x-data) untuk state mobile menu. --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8"> {{-- Container utama nav: lebar maksimal, padding responsif. --}}
        {{-- {{-- Wrapper Utama --}} {{-- Komentar asli Anda: Penanda wrapper. --}}
        <div class="flex justify-between h-16 relative"> {{-- Flex container: memisahkan kiri/tengah/kanan, tinggi 16, posisi relatif. --}}

            {{-- {{-- BAGIAN KIRI: LOGO --}} {{-- Komentar asli Anda: Penanda bagian logo. --}}
            <div class="flex"> {{-- Wrapper logo. --}}
                <div class="shrink-0 flex items-center"> {{-- Logo container: tidak menyusut, vertikal tengah. --}}
                    <span class="text-xl font-bold text-red-600"> {{-- Teks Logo: Ukuran XL, tebal, warna merah. --}}
                        MY cell {{-- Nama toko. --}}
                    </span> {{-- Penutup span logo. --}}
                </div> {{-- Penutup div logo. --}}
            </div> {{-- Penutup wrapper kiri. --}}

            {{-- {{-- BAGIAN TENGAH: MENU UTAMA --}} {{-- Komentar asli Anda: Penanda menu tengah. --}}
            <div class="hidden md:flex absolute left-1/2 -translate-x-1/2 h-full"> {{-- Menu Tengah: Hidden di mobile, posisi absolut di tengah layar (trik left-50% translate-50%). --}}
                <div class="flex items-center space-x-4"> {{-- Flex container menu items: jarak horizontal antar item. --}}
                    {{-- {{-- 1. Home --}} {{-- Komentar asli Anda: Item menu Home. --}}
                    <a href="{{ route('home') }}" class="px-5 py-2 rounded-full text-sm font-semibold transition-colors duration-300 {{-- Link Home: Padding pil, font semi-bold, transisi warna. --}}
                        {{ request()->routeIs('home') {{-- Logika Blade: Cek jika route aktif adalah 'home'. --}}
                        ? 'bg-purple-600 text-white shadow-md' {{-- Jika aktif: Background ungu, teks putih, shadow. --}}
                        : 'text-gray-500 hover:text-purple-700' }}"> {{-- Jika tidak aktif: Abu-abu, hover ungu. --}}
                        Home {{-- Teks menu. --}}
                    </a> {{-- Penutup link home. --}}

                    {{-- {{-- 2. Produk --}} {{-- Komentar asli Anda: Item menu Produk. --}}
                    <a href="{{ route('products.index') }}" class="px-5 py-2 rounded-full text-sm font-semibold transition-colors duration-300 {{-- Link Produk: Styling sama dengan Home. --}}
                        {{ request()->routeIs('products.index') || request()->routeIs('products.show') {{-- Logika Blade: Cek jika route index ATAU show produk aktif. --}}
                        ? 'bg-purple-600 text-white shadow-md' {{-- Jika aktif. --}}
                        : 'text-gray-500 hover:text-purple-700' }}"> {{-- Jika tidak aktif. --}}
                        Produk {{-- Teks menu. --}}
                    </a> {{-- Penutup link produk. --}}

                    {{-- {{-- 3. MENU ADMIN (DROPDOWN) - Tetap di Tengah --}} {{-- Komentar asli Anda: Penanda menu admin. --}}
                    @auth {{-- Cek jika user sudah login. --}}
                        @if (Auth::user()->role === 'admin') {{-- Cek jika role user adalah 'admin'. --}}
                            <div class="relative" x-data="{ openDashboard: false }" @click.outside="openDashboard = false" @close.stop="openDashboard = false"> {{-- Wrapper Dropdown Admin: Alpine x-data state lokal. --}}
                                <button @click="openDashboard = ! openDashboard" {{-- Tombol Trigger: Toggle state openDashboard. --}}
                                    class="flex items-center px-5 py-2 rounded-full text-sm font-semibold transition-colors duration-300 focus:outline-none {{-- Styling tombol dropdown. --}}
                                    {{ request()->routeIs('admin.*') {{-- Cek jika sedang di halaman admin (wildcard *). --}}
                                    ? 'bg-purple-600 text-white shadow-md' {{-- Jika aktif. --}}
                                    : 'text-gray-500 hover:text-purple-700' }}"> {{-- Jika tidak aktif. --}}
                                    <span>Dashboard</span> {{-- Teks tombol. --}}
                                    <svg class="ms-1 h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"> {{-- Ikon panah bawah (Chevron). --}}
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /> {{-- Path ikon. --}}
                                    </svg> {{-- Penutup SVG. --}}
                                </button> {{-- Penutup tombol trigger. --}}

                                <div x-show="openDashboard" {{-- Isi Dropdown: Muncul jika openDashboard true. --}}
                                     x-transition:enter="transition ease-out duration-200" {{-- Animasi masuk. --}}
                                     x-transition:enter-start="opacity-0 scale-95" {{-- Start animasi. --}}
                                     x-transition:enter-end="opacity-100 scale-100" {{-- End animasi. --}}
                                     x-transition:leave="transition ease-in duration-75" {{-- Animasi keluar. --}}
                                     x-transition:leave-start="opacity-100 scale-100" {{-- Start keluar. --}}
                                     x-transition:leave-end="opacity-0 scale-95" {{-- End keluar. --}}
                                     class="absolute z-50 mt-2 w-48 rounded-md shadow-lg origin-top-right bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" {{-- Container dropdown: Posisi absolut, z-index tinggi, background putih. --}}
                                     style="display: none;"> {{-- Style default hidden (untuk x-show). --}}
                                    <div class="py-1"> {{-- Padding dalam dropdown. --}}
                                        <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-50 font-semibold text-purple-700' : '' }}"> {{-- Menu Admin: Kelola Pesanan. --}}
                                            Kelola Pesanan {{-- Teks menu. --}}
                                        </a> {{-- Penutup link. --}}
                                        <a href="{{ route('admin.products.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 {{ request()->routeIs('admin.products.*') ? 'bg-gray-50 font-semibold text-purple-700' : '' }}"> {{-- Menu Admin: Kelola Produk. --}}
                                            Kelola Produk {{-- Teks menu. --}}
                                        </a> {{-- Penutup link. --}}
                                        <a href="{{ route('admin.news-items.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 {{ request()->routeIs('admin.news-items.*') ? 'bg-gray-50 font-semibold text-purple-700' : '' }}"> {{-- Menu Admin: Kelola Berita. --}}
                                            Kelola Berita {{-- Teks menu. --}}
                                        </a> {{-- Penutup link. --}}
                                    </div> {{-- Penutup container item dropdown. --}}
                                </div> {{-- Penutup div dropdown content. --}}
                            </div> {{-- Penutup wrapper dropdown admin. --}}
                        @endif {{-- Penutup cek role admin. --}}
                    @endauth {{-- Penutup cek auth. --}}
                </div> {{-- Penutup container flex menu. --}}
            </div> {{-- Penutup wrapper menu tengah. --}}

            {{-- {{-- BAGIAN KANAN: USER CART & PROFILE --}} {{-- Komentar asli Anda: Penanda bagian kanan. --}}
            <div class="hidden sm:flex sm:items-center sm:ms-6"> {{-- Container kanan: Hidden di mobile, flex di desktop. --}}
                @auth {{-- Cek jika user login. --}}
                    {{-- {{-- [BARU] IKON KERANJANG (Hanya untuk User Biasa) --}} {{-- Komentar asli Anda: Logika keranjang. --}}
                    @if (Auth::user()->role !== 'admin') {{-- Cek jika BUKAN admin (User biasa). --}}
                        <a href="{{ route('dashboard') }}" {{-- Link ke dashboard user (biasanya berisi riwayat/keranjang). --}}
                           class="relative p-2 me-3 text-gray-500 hover:text-purple-700 transition-colors duration-300" {{-- Styling ikon keranjang. --}}
                           title="Keranjang Saya"> {{-- Tooltip native browser. --}}
                            {{-- {{-- SVG Icon Keranjang (Cart) --}} {{-- Komentar asli. --}}
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"> {{-- Ikon Cart SVG. --}}
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" /> {{-- Path ikon. --}}
                            </svg> {{-- Penutup SVG. --}}
                        </a> {{-- Penutup link keranjang. --}}
                    @endif {{-- Penutup cek role user. --}}

                    {{-- {{-- Dropdown Profile --}} {{-- Komentar asli Anda: Dropdown user profile. --}}
                    <x-dropdown align="right" width="48"> {{-- Komponen Dropdown Blade: Aligment kanan. --}}
                        <x-slot name="trigger"> {{-- Slot Trigger: Tombol yang diklik. --}}
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"> {{-- Styling tombol nama user. --}}
                                <div>{{ Auth::user()->name }}</div> {{-- Tampilkan nama user. --}}
                                <div class="ms-1"> {{-- Wrapper ikon panah kecil. --}}
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"> {{-- Ikon panah. --}}
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /> {{-- Path ikon. --}}
                                    </svg> {{-- Penutup SVG. --}}
                                </div> {{-- Penutup wrapper ikon. --}}
                            </button> {{-- Penutup tombol trigger. --}}
                        </x-slot> {{-- Penutup slot trigger. --}}

                        <x-slot name="content"> {{-- Slot Content: Isi dropdown. --}}
                            <x-dropdown-link :href="route('profile.edit')"> {{-- Link Edit Profil. --}}
                                {{ __('Profile') }} {{-- Teks Profil. --}}
                            </x-dropdown-link> {{-- Penutup link profil. --}}

                            <form method="POST" action="{{ route('logout') }}"> {{-- Form Logout (Method POST). --}}
                                @csrf {{-- Token CSRF. --}}
                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();"> {{-- Link Logout: JS preventDefault untuk submit form. --}}
                                    {{ __('Log Out') }} {{-- Teks Logout. --}}
                                </x-dropdown-link> {{-- Penutup link logout. --}}
                            </form> {{-- Penutup form logout. --}}
                        </x-slot> {{-- Penutup slot content. --}}
                    </x-dropdown> {{-- Penutup komponen dropdown. --}}
                @else {{-- Jika user BELUM login (Tamu). --}}
                    {{-- {{-- Tombol Login --}} {{-- Komentar asli Anda: Tombol login. --}}
                    <a href="{{ route('login') }}" class="px-5 py-2 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition shadow-md shadow-blue-200"> {{-- Link Login: Tombol biru menonjol. --}}
                        Log in {{-- Teks Login. --}}
                    </a> {{-- Penutup link login. --}}
                @endauth {{-- Penutup cek auth. --}}
            </div> {{-- Penutup container kanan. --}}

            {{-- {{-- Hamburger Mobile --}} {{-- Komentar asli Anda: Tombol menu mobile. --}}
            <div class="-me-2 flex items-center sm:hidden"> {{-- Container Hamburger: Hanya tampil di mobile (sm:hidden). --}}
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out"> {{-- Tombol: Toggle state 'open'. --}}
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24"> {{-- Ikon Hamburger/Close. --}}
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" /> {{-- Ikon Garis 3 (Hamburger). --}}
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /> {{-- Ikon Silang (Close). --}}
                    </svg> {{-- Penutup SVG. --}}
                </button> {{-- Penutup tombol hamburger. --}}
            </div> {{-- Penutup container hamburger. --}}
        </div> {{-- Penutup wrapper utama h-16. --}}
    </div> {{-- Penutup container max-w-7xl. --}}

    {{-- {{-- MENU RESPONSIVE (MOBILE) --}} {{-- Komentar asli Anda: Menu dropdown mobile. --}}
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden"> {{-- Wrapper Menu Mobile: Tampil jika 'open' true. --}}
        <div class="pt-2 pb-3 space-y-1"> {{-- Container item menu utama mobile. --}}
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')"> {{-- Link Mobile Home. --}}
                {{ __('Home') }} {{-- Teks Home. --}}
            </x-responsive-nav-link> {{-- Penutup link home. --}}
            <x-responsive-nav-link :href="route('products.index')" :active="request()->routeIs('products.index')"> {{-- Link Mobile Produk. --}}
                {{ __('Produk') }} {{-- Teks Produk. --}}
            </x-responsive-nav-link> {{-- Penutup link produk. --}}

            {{-- {{-- Dashboard di Mobile --}} {{-- Komentar asli Anda: Penanda dashboard mobile. --}}
            @auth {{-- Cek login. --}}
                @if (Auth::user()->role === 'admin') {{-- Jika Admin. --}}
                    <div class="border-t border-gray-100 mt-2 pt-2"> {{-- Separator. --}}
                        <div class="px-4 text-xs font-semibold text-gray-400 uppercase">Menu Admin</div> {{-- Label Menu Admin. --}}
                        <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')"> {{-- Link Kelola Pesanan. --}}
                            {{ __('Kelola Pesanan') }} {{-- Teks. --}}
                        </x-responsive-nav-link> {{-- Penutup link. --}}
                        <x-responsive-nav-link :href="route('admin.products.index')" :active="request()->routeIs('admin.products.*')"> {{-- Link Kelola Produk. --}}
                            {{ __('Kelola Produk') }} {{-- Teks. --}}
                        </x-responsive-nav-link> {{-- Penutup link. --}}
                        <x-responsive-nav-link :href="route('admin.news-items.index')" :active="request()->routeIs('admin.news-items.*')"> {{-- Link Kelola Berita. --}}
                            {{ __('Kelola Berita') }} {{-- Teks. --}}
                        </x-responsive-nav-link> {{-- Penutup link. --}}
                    </div> {{-- Penutup block admin mobile. --}}
                @else {{-- Jika User Biasa. --}}
                    {{-- {{-- Dashboard User (Keranjang) di Mobile --}} {{-- Komentar asli Anda. --}}
                    <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"> {{-- Link Keranjang. --}}
                        {{ __('Keranjang Saya') }} {{-- Teks. --}}
                    </x-responsive-nav-link> {{-- Penutup link. --}}
                @endif {{-- Akhir cek role. --}}
            @endauth {{-- Akhir cek auth. --}}
        </div> {{-- Penutup container menu utama mobile. --}}

        {{-- {{-- Mobile Settings --}} {{-- Komentar asli Anda: Bagian profil mobile. --}}
        <div class="pt-4 pb-1 border-t border-gray-200"> {{-- Separator bagian profil. --}}
            @auth {{-- Jika login. --}}
                <div class="px-4"> {{-- Info user. --}}
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div> {{-- Nama User. --}}
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div> {{-- Email User. --}}
                </div> {{-- Penutup info user. --}}

                <div class="mt-3 space-y-1"> {{-- Menu User Mobile. --}}
                    <x-responsive-nav-link :href="route('profile.edit')">{{ __('Profile') }}</x-responsive-nav-link> {{-- Link Edit Profil. --}}
                    <form method="POST" action="{{ route('logout') }}"> {{-- Form Logout Mobile. --}}
                        @csrf {{-- Token CSRF. --}}
                        <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();"> {{-- Link Logout. --}}
                            {{ __('Log Out') }} {{-- Teks Logout. --}}
                        </x-responsive-nav-link> {{-- Penutup link. --}}
                    </form> {{-- Penutup form. --}}
                </div> {{-- Penutup menu user. --}}
            @else {{-- Jika tamu (belum login). --}}
                <div class="pt-2 pb-3 space-y-1"> {{-- Container tombol login mobile. --}}
                    <x-responsive-nav-link :href="route('login')">{{ __('Log In') }}</x-responsive-nav-link> {{-- Link Login Mobile. --}}
                </div> {{-- Penutup container login. --}}
            @endauth {{-- Akhir cek auth mobile. --}}
        </div> {{-- Penutup wrapper profil mobile. --}}
    </div> {{-- Penutup wrapper mobile menu. --}}
</nav> {{-- Penutup tag nav. --}}
