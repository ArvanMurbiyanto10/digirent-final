<x-app-layout> {{-- Menggunakan layout utama aplikasi (AppLayout) sebagai pembungkus. --}}

    {{-- {{-- ======================================================== --}} {{-- Komentar asli Anda: Header penting. --}}
    {{-- {{-- == [PENTING] PANGGIL CSS & JS MANUAL DARI cPANEL == --}} {{-- Komentar asli Anda: Penjelasan aset. --}}
    {{-- {{-- ======================================================== --}} {{-- Komentar asli Anda: Penutup header. --}}
    {{-- {{-- Pastikan file ini ada di public_html/build/assets/ --}} {{-- Komentar asli Anda: Catatan lokasi file. --}}
    <link rel="stylesheet" href="https://mycell.web.id/build/assets/style.css"> {{-- Memuat CSS manual (solusi hosting). --}}
    <script src="https://mycell.web.id/build/assets/script.js" defer></script> {{-- Memuat JS manual dengan 'defer'. --}}
    {{-- {{-- ======================================================== --}} {{-- Komentar asli Anda: Penutup blok aset. --}}

    {{-- {{-- CSS TAMBAHAN UNTUK ANIMASI & ELEMEN KHUSUS --}} {{-- Komentar asli Anda: Header CSS inline. --}}
    <style> {{-- Pembuka tag style CSS. --}}
        /* Animasi Marquee */ /* Komentar CSS: Judul bagian marquee. */
        @keyframes marquee-left { /* Keyframe untuk animasi gerak ke kiri. */
            0% { /* Kondisi awal. */
                transform: translateX(0%); /* Posisi normal. */
            } /* Penutup 0%. */

            100% { /* Kondisi akhir. */
                transform: translateX(-100%); /* Geser ke kiri sejauh 100% lebar elemen. */
            } /* Penutup 100%. */
        } /* Penutup keyframe marquee-left. */

        .animate-marquee-left { /* Class untuk menerapkan animasi ke kiri. */
            display: flex; /* Layout Flexbox. */
            width: 200%; /* Lebar 2x lipat container (agar looping mulus). */
            animation: marquee-left 50s linear infinite; /* Jalankan animasi selama 50 detik, linear, selamanya. */
        } /* Penutup .animate-marquee-left. */

        @keyframes marquee-right { /* Keyframe untuk animasi gerak ke kanan. */
            0% { /* Kondisi awal. */
                transform: translateX(-100%); /* Mulai dari posisi tergeser ke kiri. */
            } /* Penutup 0%. */

            100% { /* Kondisi akhir. */
                transform: translateX(0%); /* Kembali ke posisi normal (gerak ke kanan). */
            } /* Penutup 100%. */
        } /* Penutup keyframe marquee-right. */

        .animate-marquee-right { /* Class untuk menerapkan animasi ke kanan. */
            display: flex; /* Flexbox. */
            width: 200%; /* Lebar 200%. */
            animation: marquee-right 50s linear infinite; /* Animasi 50s. */
        } /* Penutup .animate-marquee-right. */

        .marquee-group { /* Wrapper untuk grup elemen yang di-loop. */
            width: 50%; /* Lebar setengah dari parent (yang 200%), jadi ukurannya pas 100% layar. */
            flex-shrink: 0; /* Jangan menyusut. */
            display: flex; /* Flexbox. */
            justify-content: space-around; /* Jarak merata antar item. */
            align-items: center; /* Rata tengah vertikal. */
        } /* Penutup .marquee-group. */

        [x-cloak] { /* Utilitas Alpine.js. */
            display: none !important; /* Sembunyikan elemen sebelum Alpine siap (mencegah kedip). */
        } /* Penutup x-cloak. */

        /* Pattern Background */ /* Komentar CSS: Background pola titik. */
        .bg-dots-pattern { /* Class pola titik-titik. */
            background-image: radial-gradient(circle, rgba(224, 231, 255, 0.6) 1px, transparent 1px); /* Gradien radial membentuk titik. */
            background-size: 1.2rem 1.2rem; /* Ukuran perulangan pola. */
        } /* Penutup .bg-dots-pattern. */

        /* Shape Divider Styling */ /* Komentar CSS: Pemisah bentuk gelombang. */
        .shape-divider-bottom svg { /* SVG di bagian bawah. */
            position: absolute; /* Posisi absolut. */
            bottom: 0; /* Tempel di bawah. */
            left: 0; /* Tempel di kiri. */
            width: 100%; /* Lebar penuh. */
            height: 80px; /* Tinggi gelombang. */
            pointer-events: none; /* Klik tembus ke bawahnya. */
        } /* Penutup bottom svg. */

        .shape-divider-top svg { /* SVG di bagian atas. */
            position: absolute; /* Absolut. */
            top: 0; /* Tempel di atas. */
            left: 0; /* Kiri. */
            width: 100%; /* Lebar penuh. */
            height: 80px; /* Tinggi. */
            transform: rotate(180deg); /* Putar 180 derajat (membalik gelombang). */
            pointer-events: none; /* Klik tembus. */
        } /* Penutup top svg. */

        /* Warna Shape Divider */ /* Komentar CSS: Warna isi SVG. */
        .shape-fill-white { /* Class isi warna putih. */
            fill: #ffffff; /* Putih. */
        } /* Penutup fill-white. */

        .shape-fill-indigo { /* Class isi warna indigo muda. */
            fill: #eef2ff; /* Indigo sangat muda. */
        } /* Penutup fill-indigo. */

        /* ================================================= */ /* Komentar CSS: Separator. */
        /* === [BAGIAN CSS LOGO BRAND - PILIHAN 1] === */ /* Komentar CSS: Judul bagian logo. */
        /* ================================================= */ /* Komentar CSS: Separator. */
        .brand-box { /* Kotak pembungkus logo brand. */
            /* Layout & Ukuran */ /* Komentar CSS. */
            display: flex; /* Flexbox. */
            align-items: center; /* Rata tengah vertikal. */
            justify-content: center; /* Rata tengah horizontal. */
            width: 160px; /* Lebar tetap. */
            /* Lebar tetap */ /* Komentar asli. */
            height: 80px; /* Tinggi tetap. */
            /* Tinggi tetap */ /* Komentar asli. */
            margin: 0 1rem; /* Margin kiri-kanan. */
            /* Jarak antar logo */ /* Komentar asli. */
            padding: 1rem; /* Padding dalam. */
            flex-shrink: 0; /* Jangan menyusut. */

            /* Tampilan Kotak Modern */ /* Komentar CSS. */
            background-color: #ffffff; /* Background putih. */
            border: 2px solid #e2e8f0; /* Border abu muda. */
            /* Garis tepi abu muda */ /* Komentar asli. */
            border-radius: 0.5rem; /* Sudut melengkung. */
            /* Sudut melengkung */ /* Komentar asli. */
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); /* Shadow halus. */
            /* Bayangan halus */ /* Komentar asli. */

            /* Animasi */ /* Komentar CSS. */
            transition: all 0.3s ease; /* Transisi halus 0.3 detik. */
        } /* Penutup .brand-box. */

        /* Efek saat Mouse Diarahkan (Hover) */ /* Komentar CSS. */
        .brand-box:hover { /* State hover pada box. */
            transform: translateY(-5px); /* Geser naik 5px. */
            /* Naik sedikit */ /* Komentar asli. */
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1); /* Pertebal bayangan. */
            /* Bayangan menebal */ /* Komentar asli. */
            border-color: #7c3aed; /* Ubah border jadi ungu. */
            /* Berubah jadi UNGU */ /* Komentar asli. */
        } /* Penutup hover. */

        /* Agar Gambar Logo Rapi di Tengah */ /* Komentar CSS. */
        .brand-box img { /* Target gambar dalam box. */
            max-height: 100%; /* Tinggi maks 100% dari box. */
            max-width: 100%; /* Lebar maks 100%. */
            object-fit: contain; /* Gambar pas tanpa terpotong/gepeng. */
        } /* Penutup img. */
    </style> {{-- Penutup tag style. --}}

    {{-- {{-- Notifikasi Login Berhasil (Animasi Pojok Kanan Atas) --}} {{-- Komentar asli Anda: Penanda notifikasi. --}}
    @if (session('status') === 'just-logged-in') {{-- Cek session flash: Jika user baru saja login. --}}
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show" {{-- Alpine.js: Tampil, lalu sembunyi otomatis setelah 4 detik. --}}
            x-transition:enter="transition ease-out duration-300" {{-- Animasi masuk. --}}
            x-transition:enter-start="opacity-0 transform translate-x-4" {{-- Mulai dari transparan dan geser kanan. --}}
            x-transition:enter-end="opacity-100 transform translate-x-0" {{-- Akhir di posisi normal. --}}
            x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100" {{-- Animasi keluar. --}}
            x-transition:leave-end="opacity-0" {{-- Akhir transparan. --}}
            class="fixed top-20 right-5 bg-white border-l-4 border-green-500 text-slate-700 p-4 rounded-lg shadow-xl z-50" {{-- Styling notifikasi: fixed pojok kanan, border hijau kiri. --}}
            role="alert"> {{-- Role aksesibilitas. --}}
            <div class="flex items-center"> {{-- Flex container isi notifikasi. --}}
                <div class="text-green-500 mr-3"> <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" {{-- Ikon Centang Hijau. --}}
                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg> </div> {{-- Penutup ikon. --}}
                <div> {{-- Wrapper teks. --}}
                    <p class="font-bold">Login Berhasil!</p> {{-- Judul pesan. --}}
                    <p class="text-sm">Selamat Datang kembali, {{ Auth::user()->name }}!</p> {{-- Pesan personal dengan nama user. --}}
                </div> {{-- Penutup wrapper teks. --}}
            </div> {{-- Penutup flex. --}}
        </div> {{-- Penutup div notifikasi. --}}
    @endif {{-- Penutup if session. --}}

    {{-- {{-- ============================================= --}} {{-- Komentar asli Anda: Separator Hero. --}}
    {{-- {{-- == HERO SECTION == --}} {{-- Komentar asli Anda: Judul Hero. --}}
    {{-- {{-- ============================================= --}} {{-- Komentar asli Anda. --}}
    <div class="relative bg-white overflow-hidden"> {{-- Wrapper Hero: Relatif, overflow hidden. --}}
        <div class="max-w-7xl mx-auto"> {{-- Container lebar maksimum 7xl. --}}
            <div class="relative z-10 pb-8 bg-white sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32"> {{-- Konten Kiri (Teks): Background putih, z-index tinggi agar di atas gambar. --}}
                {{-- {{-- Dekorasi Segitiga Kanan --}} {{-- Komentar asli Anda: Dekorasi SVG. --}}
                <svg class="hidden lg:block absolute right-0 inset-y-0 h-full w-48 text-white transform translate-x-1/2" {{-- SVG Segitiga pemisah: Hanya tampil di layar besar (lg:block). --}}
                    fill="currentColor" viewBox="0 0 100 100" preserveAspectRatio="none" aria-hidden="true">
                    <polygon points="50,0 100,0 50,100 0,100" /> {{-- Bentuk segitiga. --}}
                </svg> {{-- Penutup SVG. --}}

                <main class="mt-10 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28"> {{-- Main Content Hero: Padding responsif. --}}
                    <div class="sm:text-center lg:text-left"> {{-- Teks rata tengah di HP, kiri di Desktop. --}}
                        <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-6xl"> {{-- Judul Besar Hero. --}}
                            <span class="block xl:inline">Sewa Gadget</span> {{-- Baris 1: Hitam. --}}
                            <span class="block text-indigo-600 xl:inline">Impianmu di Sini</span> {{-- Baris 2: Ungu Indigo. --}}
                        </h1> {{-- Penutup h1. --}}
                        <p
                            class="mt-3 text-base text-gray-500 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0"> {{-- Paragraf deskripsi Hero. --}}
                            Handphone, Laptop terbaru siap menemanimu. Temukan gadget impianmu dengan mudah, cepat, dan
                            aman di MY cell. {{-- Isi teks. --}}
                        </p> {{-- Penutup p. --}}
                        <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start"> {{-- Wrapper tombol Call to Action. --}}
                            <div class="rounded-md shadow"> {{-- Tombol Katalog. --}}
                                <a href="{{ route('products.index') }}" {{-- Link ke halaman produk. --}}
                                    class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-purple-600 hover:bg-purple-700 md:py-4 md:text-lg md:px-10"> {{-- Styling tombol ungu besar. --}}
                                    Lihat Katalog {{-- Teks tombol. --}}
                                </a> {{-- Penutup link. --}}
                            </div> {{-- Penutup div tombol. --}}
                        </div> {{-- Penutup wrapper tombol. --}}
                    </div> {{-- Penutup div teks. --}}
                </main> {{-- Penutup main hero. --}}
            </div> {{-- Penutup konten kiri. --}}
        </div> {{-- Penutup container. --}}
        <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2"> {{-- Wrapper Gambar Hero (Kanan): Absolut di desktop, lebar setengah. --}}
            <img class="h-56 w-full object-cover sm:h-72 md:h-96 lg:w-full lg:h-full" {{-- Gambar Hero: Object cover agar proporsional. --}}
                src="https://png.pngtree.com/thumb_back/fw800/background/20220427/pngtree-used-gadgets-sale-gadget-exchange-image_1091441.jpg" {{-- URL Gambar. --}}
                alt="Sewa Gadget Laptop dan Kamera"> {{-- Alt text. --}}
        </div> {{-- Penutup wrapper gambar. --}}
    </div> {{-- Penutup Hero Section. --}}

    {{-- {{-- LOGO TICKER / MARQUEE BRANDS --}} {{-- Komentar asli Anda: Bagian logo brand. --}}
    <div class="bg-slate-50 py-16 z-20 overflow-hidden border-t border-slate-100"> {{-- Container Marquee: Background slate tipis, border atas. --}}
        <div class="container mx-auto px-6"> {{-- Container isi. --}}
            <h3 class="text-center text-lg font-semibold text-slate-700 mb-10">Tersedia Brand Teknologi Terkemuka</h3> {{-- Judul bagian brand. --}}

            {{-- {{-- Marquee Bergerak ke Kiri --}} {{-- Komentar asli Anda. --}}
            <div class="relative w-full overflow-hidden mb-8"> {{-- Wrapper baris 1 (Kiri). --}}
                <div class="animate-marquee-left"> {{-- Container animasi gerak kiri. --}}
                    <div class="marquee-group"> {{-- Grup logo pertama (asli). --}}
                        <div class="brand-box"><img src="{{ asset('storage/logo/apple-logo.jpeg') }}" alt="Apple"></div> {{-- Logo Apple. --}}
                        <div class="brand-box"><img src="{{ asset('storage/logo/samsung-logo.jpeg') }}" alt="Samsung"> {{-- Logo Samsung. --}}
                        </div> {{-- Penutup div. --}}
                        <div class="brand-box"><img src="{{ asset('storage/logo/Xiaomi-Logo.jpeg') }}" alt="Xiaomi"> {{-- Logo Xiaomi. --}}
                        </div> {{-- Penutup div. --}}
                        <div class="brand-box"><img src="{{ asset('storage/logo/oppo-logo.jpeg') }}" alt="Oppo"></div> {{-- Logo Oppo. --}}
                        <div class="brand-box"><img src="{{ asset('storage/logo/vivo-logo.jpeg') }}" alt="Vivo"></div> {{-- Logo Vivo. --}}
                        <div class="brand-box"><img src="{{ asset('storage/logo/asus-logo.jpeg') }}" alt="Asus"></div> {{-- Logo Asus. --}}
                    </div> {{-- Penutup grup 1. --}}
                    <div class="marquee-group" aria-hidden="true"> {{-- Grup logo kedua (duplikat untuk loop), disembunyikan dari screen reader. --}}
                        <div class="brand-box"><img src="{{ asset('storage/logo/apple-logo.jpeg') }}" alt="Apple"></div> {{-- Duplikat Apple. --}}
                        <div class="brand-box"><img src="{{ asset('storage/logo/samsung-logo.jpeg') }}" alt="Samsung"> {{-- Duplikat Samsung. --}}
                        </div> {{-- Penutup div. --}}
                        <div class="brand-box"><img src="{{ asset('storage/logo/Xiaomi-Logo.jpeg') }}" alt="Xiaomi"> {{-- Duplikat Xiaomi. --}}
                        </div> {{-- Penutup div. --}}
                        <div class="brand-box"><img src="{{ asset('storage/logo/oppo-logo.jpeg') }}" alt="Oppo"></div> {{-- Duplikat Oppo. --}}
                        <div class="brand-box"><img src="{{ asset('storage/logo/vivo-logo.jpeg') }}" alt="Vivo"></div> {{-- Duplikat Vivo. --}}
                        <div class="brand-box"><img src="{{ asset('storage/logo/asus-logo.jpeg') }}" alt="Asus"></div> {{-- Duplikat Asus. --}}
                    </div> {{-- Penutup grup 2. --}}
                </div> {{-- Penutup container animasi. --}}
            </div> {{-- Penutup wrapper baris 1. --}}

            {{-- {{-- Marquee Bergerak ke Kanan --}} {{-- Komentar asli Anda. --}}
            <div class="relative w-full overflow-hidden"> {{-- Wrapper baris 2 (Kanan). --}}
                <div class="animate-marquee-right"> {{-- Container animasi gerak kanan. --}}
                    <div class="marquee-group"> {{-- Grup logo pertama (asli). --}}
                        <div class="brand-box"><img src="{{ asset('storage/logo/gopix-logo.jpeg') }}" alt="Gopix"></div> {{-- Logo Gopix. --}}
                        <div class="brand-box"><img src="{{ asset('storage/logo/rog-logo.jpeg') }}" alt="ROG"></div> {{-- Logo ROG. --}}
                        <div class="brand-box"><img src="{{ asset('storage/logo/macbook-logo.jpeg') }}" alt="MacBook"> {{-- Logo MacBook. --}}
                        </div> {{-- Penutup div. --}}
                        <div class="brand-box"><img src="{{ asset('storage/logo/Xiaomi-Logo.jpeg') }}" alt="Xiaomi"> {{-- Logo Xiaomi (lagi). --}}
                        </div> {{-- Penutup div. --}}
                        <div class="brand-box"><img src="{{ asset('storage/logo/samsung-logo.jpeg') }}" alt="Samsung"> {{-- Logo Samsung (lagi). --}}
                        </div> {{-- Penutup div. --}}
                        <div class="brand-box"><img src="{{ asset('storage/logo/apple-logo.jpeg') }}" alt="Apple"></div> {{-- Logo Apple (lagi). --}}
                    </div> {{-- Penutup grup 1. --}}
                    <div class="marquee-group" aria-hidden="true"> {{-- Grup logo kedua (duplikat). --}}
                        <div class="brand-box"><img src="{{ asset('storage/logo/gopix-logo.jpeg') }}" alt="Gopix"></div> {{-- Duplikat Gopix. --}}
                        <div class="brand-box"><img src="{{ asset('storage/logo/rog-logo.jpeg') }}" alt="ROG"></div> {{-- Duplikat ROG. --}}
                        <div class="brand-box"><img src="{{ asset('storage/logo/macbook-logo.jpeg') }}" alt="MacBook"> {{-- Duplikat MacBook. --}}
                        </div> {{-- Penutup div. --}}
                        <div class="brand-box"><img src="{{ asset('storage/logo/Xiaomi-Logo.jpeg') }}" alt="Xiaomi"> {{-- Duplikat Xiaomi. --}}
                        </div> {{-- Penutup div. --}}
                        <div class="brand-box"><img src="{{ asset('storage/logo/samsung-logo.jpeg') }}" alt="Samsung"> {{-- Duplikat Samsung. --}}
                        </div> {{-- Penutup div. --}}
                        <div class="brand-box"><img src="{{ asset('storage/logo/apple-logo.jpeg') }}" alt="Apple"></div> {{-- Duplikat Apple. --}}
                    </div> {{-- Penutup grup 2. --}}
                </div> {{-- Penutup container animasi. --}}
            </div> {{-- Penutup wrapper baris 2. --}}
        </div> {{-- Penutup container marquee. --}}
    </div> {{-- Penutup section marquee. --}}

    {{-- {{-- Berita Gadget Terbaru Section --}} {{-- Komentar asli Anda: Penanda berita. --}}
    <div class="py-16 pb-24 bg-gradient-to-b from-indigo-100 via-purple-50 to-white relative"> {{-- Container Berita: Background gradasi vertikal. --}}
        <div class="container mx-auto px-6"> {{-- Container isi. --}}
            <div class="text-center mb-12"> {{-- Header Berita: Rata tengah. --}}
                <h2 class="text-3xl font-bold text-indigo-700">Berita Gadget Terbaru</h2> {{-- Judul Section. --}}
                <p class="text-gray-600 mt-2">Ikuti perkembangan teknologi terkini bersama kami.</p> {{-- Sub-judul. --}}
            </div> {{-- Penutup header berita. --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8"> {{-- Grid Berita: 1 kolom (HP), 2 kolom (Desktop). --}}
                @forelse ($newsItems as $item) {{-- Loop Forelse: Ambil data berita dari controller. --}}
                    <div {{-- Wrapper Kartu Berita. --}}
                        class="bg-white rounded-lg shadow-md overflow-hidden transition-all duration-300 hover:shadow-xl hover:-translate-y-1"> {{-- Styling kartu: Shadow, animasi hover naik. --}}
                        <a href="{{ $item->link_url }}" target="_blank" class="flex h-full"> {{-- Link ke artikel asli (target blank). --}}
                            {{-- {{-- Menggunakan Storage::url untuk gambar dinamis --}} {{-- Komentar asli Anda. --}}
                            <img class="w-2/5 object-cover" src="{{ Storage::url($item->image_path) }}" {{-- Gambar Berita: Lebar 40% (2/5). --}}
                                alt="{{ $item->title }}"> {{-- Alt text gambar. --}}
                            <div class="p-5 w-3/5 flex flex-col justify-center"> {{-- Konten Teks: Lebar 60% (3/5), padding 5. --}}
                                <h4 class="font-bold text-lg text-indigo-700">{{ $item->title }}</h4> {{-- Judul Berita. --}}
                                <p class="text-gray-600 mt-2 text-sm">{{ Str::limit($item->description, 100) }}</p> {{-- Deskripsi Singkat: Dibatasi 100 karakter. --}}
                            </div> {{-- Penutup div konten. --}}
                        </a> {{-- Penutup link. --}}
                    </div> {{-- Penutup div kartu. --}}
                @empty {{-- Jika tidak ada berita. --}}
                    <p class="text-center text-gray-500 lg:col-span-2">Belum ada berita terbaru.</p> {{-- Pesan kosong. --}}
                @endforelse {{-- Akhir loop. --}}
            </div> {{-- Penutup grid. --}}
        </div> {{-- Penutup container. --}}

        {{-- {{-- Shape Divider di Bawah Berita --}} {{-- Komentar asli Anda: Pemisah visual bawah. --}}
        <div class="shape-divider-bottom" style="bottom: -1px;"> {{-- Wrapper SVG. --}}
            <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" {{-- Tag SVG Gelombang. --}}
                preserveAspectRatio="none">
                <path
                    d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z"
                    class="shape-fill shape-fill-indigo"></path> {{-- Path gelombang warna indigo. --}}
            </svg> {{-- Penutup SVG. --}}
        </div> {{-- Penutup div divider. --}}
    </div> {{-- Penutup section berita. --}}

    {{-- {{-- Section Kenapa Memilih MY cell --}} {{-- Komentar asli Anda: Section fitur/keunggulan. --}}
    <div class="py-16 bg-gradient-to-br from-indigo-50 via-purple-50 to-white bg-dots-pattern relative overflow-hidden"> {{-- Container Features: Background gradasi + pola titik. --}}
        {{-- {{-- Efek Blur Background --}} {{-- Komentar asli Anda. --}}
        <div {{-- Elemen dekoratif blur (glowing blob). --}}
            class="absolute top-1/4 left-1/4 w-96 h-96 bg-purple-200 rounded-full opacity-20 filter blur-3xl -translate-x-1/2 -translate-y-1/2 z-0">
        </div> {{-- Penutup div blur. --}}

        <div class="container mx-auto px-6 text-center relative z-10 pt-8"> {{-- Container konten: z-index 10 agar di atas background blur. --}}
            <h2 class="text-3xl font-bold text-indigo-700 mb-4">Kenapa Memilih MY cell?</h2> {{-- Judul Section. --}}
            <p class="text-gray-600 mb-12 max-w-2xl mx-auto">Kami menawarkan lebih dari sekadar penyewaan. Kami
                memberikan kemudahan, fleksibilitas, dan akses ke teknologi terkini tanpa beban.</p> {{-- Deskripsi Section. --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10"> {{-- Grid 3 Kolom untuk Fitur. --}}
                <div class="p-6 bg-white/50 backdrop-blur-sm rounded-lg shadow-sm hover:shadow-lg transition"> {{-- Kartu Fitur 1: Efek kaca (backdrop-blur). --}}
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" {{-- Ikon Hemat Biaya (Dompet/Uang). --}}
                        stroke="currentColor" class="text-indigo-600 w-16 h-16 mx-auto mb-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg> {{-- Penutup SVG. --}}
                    <h3 class="text-xl font-bold text-slate-800 mb-2">Hemat Biaya</h3> {{-- Judul Fitur 1. --}}
                    <p class="text-gray-600">Gunakan gadget flagship tanpa perlu membelinya...</p> {{-- Deskripsi Fitur 1. --}}
                </div> {{-- Penutup Kartu 1. --}}
                <div class="p-6 bg-white/50 backdrop-blur-sm rounded-lg shadow-sm hover:shadow-lg transition"> {{-- Kartu Fitur 2. --}}
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" {{-- Ikon Up-to-date (Roket/Panah). --}}
                        stroke="currentColor" class="text-indigo-600 w-16 h-16 mx-auto mb-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09zM18.259 8.715L18 9.75l-.259-1.035a3.375 3.375 0 00-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 002.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 002.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 00-2.456 2.456zM16.898 20.562L16.25 22.5l-.648-1.938a3.375 3.375 0 00-2.696-2.696L11.25 18l1.938-.648a3.375 3.375 0 002.696-2.696L16.25 13l.648 1.938a3.375 3.375 0 002.696 2.696L21 18l-1.938.648a3.375 3.375 0 00-2.696 2.696z" />
                    </svg> {{-- Penutup SVG. --}}
                    <h3 class="text-xl font-bold text-slate-800 mb-2">Selalu Up-to-date</h3> {{-- Judul Fitur 2. --}}
                    <p class="text-gray-600">Ingin mencoba iPhone atau MacBook terbaru...</p> {{-- Deskripsi Fitur 2. --}}
                </div> {{-- Penutup Kartu 2. --}}
                <div class="p-6 bg-white/50 backdrop-blur-sm rounded-lg shadow-sm hover:shadow-lg transition"> {{-- Kartu Fitur 3. --}}
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" {{-- Ikon Fleksibel (Tangan/Jabat). --}}
                        stroke="currentColor" class="text-indigo-600 w-16 h-16 mx-auto mb-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg> {{-- Penutup SVG. --}}
                    <h3 class="text-xl font-bold text-slate-800 mb-2">Fleksibel & Mudah</h3> {{-- Judul Fitur 3. --}}
                    <p class="text-gray-600">Proses pemesanan cepat dan sepenuhnya online...</p> {{-- Deskripsi Fitur 3. --}}
                </div> {{-- Penutup Kartu 3. --}}
            </div> {{-- Penutup grid fitur. --}}
        </div> {{-- Penutup container fitur. --}}
    </div> {{-- Penutup section fitur. --}}

    {{-- {{-- FAQ (Tanya Jawab) --}} {{-- Komentar asli Anda: Section FAQ. --}}
    <div id="faq-section" class="relative py-24 bg-gradient-to-t from-purple-100 via-indigo-50 to-white"> {{-- Container FAQ: Background gradasi terbalik. --}}

        {{-- {{-- Shape Divider Top --}} {{-- Komentar asli Anda. --}}
        <div class="shape-divider-top" style="top: -1px;"> {{-- SVG Gelombang Atas. --}}
            <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" {{-- Tag SVG. --}}
                preserveAspectRatio="none">
                <path
                    d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z"
                    class="shape-fill shape-fill-white"></path> {{-- Path warna putih. --}}
            </svg> {{-- Penutup SVG. --}}
        </div> {{-- Penutup divider. --}}

        <div class="container mx-auto px-6 pt-12"> {{-- Container konten FAQ. --}}
            <div class="text-center mb-16"> {{-- Header FAQ. --}}
                <h2 class="text-4xl font-extrabold text-indigo-700">Tanya Jawab (FAQ)</h2> {{-- Judul FAQ. --}}
                <p class="text-gray-600 mt-3 text-lg">Pertanyaan yang paling sering diajukan seputar MY cell.</p> {{-- Sub-judul. --}}
            </div> {{-- Penutup header FAQ. --}}

            <div class="max-w-3xl mx-auto" x-data="{ open: null }"> {{-- Accordion Container: Alpine.js state 'open'. --}}
                <div class="border-b border-slate-300"> {{-- Item FAQ 1. --}}
                    <button @click="open = open === 1 ? null : 1" {{-- Toggle state 1. --}}
                        class="w-full flex justify-between items-center py-6 text-left"> {{-- Styling tombol header accordion. --}}
                        <span class="text-xl font-semibold text-slate-800">Apa saja syarat untuk menyewa di MY
                            cell?</span> {{-- Pertanyaan 1. --}}
                        <span class="text-purple-600 transition-transform duration-300" {{-- Wrapper Ikon Panah. --}}
                            :class="{ 'rotate-180': open === 1 }"> {{-- Rotasi ikon jika terbuka. --}}
                            <svg class="w-6 h-6" fill="none" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24"> {{-- SVG Chevron. --}}
                                <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5">
                                </path>
                            </svg>
                        </span>
                    </button>
                    <div x-show="open === 1" x-collapse x-cloak class="pb-6"> {{-- Konten Jawaban 1: Animasi collapse. --}}
                        <p class="text-slate-600">Untuk menyewa, Anda hanya perlu menyiapkan identitas diri (KTP/SIM)
                            yang masih berlaku dan melakukan pembayaran sesuai tagihan. Untuk beberapa item khusus,
                            mungkin diperlukan jaminan tambahan.</p> {{-- Jawaban 1. --}}
                    </div>
                </div> {{-- Penutup Item 1. --}}

                <div class="border-b border-slate-300"> {{-- Item FAQ 2. --}}
                    <button @click="open = open === 2 ? null : 2" {{-- Toggle state 2. --}}
                        class="w-full flex justify-between items-center py-6 text-left">
                        <span class="text-xl font-semibold text-slate-800">Bagaimana jika gadget yang saya sewa
                            rusak?</span> {{-- Pertanyaan 2. --}}
                        <span class="text-purple-600 transition-transform duration-300"
                            :class="{ 'rotate-180': open === 2 }">
                            <svg class="w-6 h-6" fill="none" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5">
                                </path>
                            </svg>
                        </span>
                    </button>
                    <div x-show="open === 2" x-collapse x-cloak class="pb-6"> {{-- Konten Jawaban 2. --}}
                        <p class="text-slate-600">Kami memahami bahwa kecelakaan bisa terjadi. Jika terjadi kerusakan
                            ringan karena pemakaian wajar, biasanya tidak ada biaya tambahan. Namun, untuk kerusakan
                            berat atau kehilangan, Anda mungkin akan dikenakan biaya perbaikan atau penggantian sesuai
                            syarat dan ketentuan.</p> {{-- Jawaban 2. --}}
                    </div>
                </div> {{-- Penutup Item 2. --}}

                <div class="border-b border-slate-300"> {{-- Item FAQ 3. --}}
                    <button @click="open = open === 3 ? null : 3" {{-- Toggle state 3. --}}
                        class="w-full flex justify-between items-center py-6 text-left">
                        <span class="text-xl font-semibold text-slate-800">Apakah saya bisa memperpanjang masa
                            sewa?</span> {{-- Pertanyaan 3. --}}
                        <span class="text-purple-600 transition-transform duration-300"
                            :class="{ 'rotate-180': open === 3 }">
                            <svg class="w-6 h-6" fill="none" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5">
                                </path>
                            </svg>
                        </span>
                    </button>
                    <div x-show="open === 3" x-collapse x-cloak class="pb-6"> {{-- Konten Jawaban 3. --}}
                        <p class="text-slate-600">Tentu saja! Anda bisa mengajukan perpanjangan sewa melalui dashboard
                            akun Anda atau menghubungi customer service kami sebelum masa sewa berakhir, selama item
                            tersebut belum dipesan oleh orang lain.</p> {{-- Jawaban 3. --}}
                    </div>
                </div> {{-- Penutup Item 3. --}}

                <div class="border-b border-slate-300"> {{-- Item FAQ 4. --}}
                    <button @click="open = open === 4 ? null : 4" {{-- Toggle state 4. --}}
                        class="w-full flex justify-between items-center py-6 text-left">
                        <span class="text-xl font-semibold text-slate-800">Apakah gadget bisa diantar ke lokasi
                            saya?</span> {{-- Pertanyaan 4. --}}
                        <span class="text-purple-600 transition-transform duration-300"
                            :class="{ 'rotate-180': open === 4 }">
                            <svg class="w-6 h-6" fill="none" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5">
                                </path>
                            </svg>
                        </span>
                    </button>
                    <div x-show="open === 4" x-collapse x-cloak class="pb-6"> {{-- Konten Jawaban 4. --}}
                        <p class="text-slate-600">Ya, kami melayani pengantaran dan penjemputan untuk area Kota Tegal
                            dengan biaya tambahan yang terjangkau. Anda juga bisa mengambil dan mengembalikan langsung
                            ke lokasi kami.</p> {{-- Jawaban 4. --}}
                    </div>
                </div> {{-- Penutup Item 4. --}}
            </div> {{-- Penutup Accordion. --}}
        </div> {{-- Penutup container FAQ. --}}
    </div> {{-- Penutup section FAQ. --}}
</x-app-layout> {{-- Penutup layout. --}}
