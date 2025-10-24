<x-app-layout>

    {{-- CSS TAMBAHAN UNTUK ANIMASI & ELEMEN BARU --}}
    <style>
        /* ... (CSS Animasi Marquee, Dot Pattern, Shape Divider Anda tetap sama) ... */
        @keyframes marquee-left { 0% { transform: translateX(0%); } 100% { transform: translateX(-100%); } }
        .animate-marquee-left { display: flex; width: 200%; animation: marquee-left 50s linear infinite; }
        @keyframes marquee-right { 0% { transform: translateX(-100%); } 100% { transform: translateX(0%); } }
        .animate-marquee-right { display: flex; width: 200%; animation: marquee-right 50s linear infinite; }
        .marquee-group { width: 50%; flex-shrink: 0; display: flex; justify-content: space-around; align-items: center; }
        [x-cloak] { display: none !important; }

        .bg-dots-pattern {
            background-image: radial-gradient(circle, rgba(224, 231, 255, 0.6) 1px, transparent 1px);
            background-size: 1.2rem 1.2rem;
        }
        .shape-divider-bottom svg { position: absolute; bottom: 0; left: 0; width: 100%; height: 80px; pointer-events: none; }
        .shape-divider-bottom .shape-fill { fill: #FFFFFF; }
        .shape-divider-top svg { position: absolute; top: 0; left: 0; width: 100%; height: 80px; transform: rotate(180deg); pointer-events: none; }
        .shape-divider-top .shape-fill { fill: #eef2ff; }

        /* ... (CSS Brand Box Anda tetap sama) ... */
        .brand-box { border: 2px solid #cbd5e1; }
        .brand-apple { background-color: #FFFFFF; }
        .brand-samsung { background-color: #f3f4f6; }
        .brand-xiaomi { background-color: #FFF7ED; }
        .brand-oppo { background-color: #ECFDF5; }
        .brand-vivo { background-color: #EFF6FF; }
        .brand-asus { background-color: #FFFFFF; }
        .brand-gopix { background-color: #FFFFFF; }
        .brand-rog { background-color: #f3f4f6; }
        .brand-macbook { background-color: #FFFFFF; }
        .brand-box {
            @apply mx-4 flex-shrink-0 rounded-lg shadow-md p-4 flex items-center justify-center h-20 w-40 transition hover:shadow-lg border-2;
            img { @apply max-h-full max-w-full object-contain; }
        }
    </style>

    {{-- Fitur Notifikasi Animasi --}}
    @if (session('status') === 'just-logged-in')
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-x-4" x-transition:enter-end="opacity-100 transform translate-x-0" x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed top-20 right-5 bg-white border-l-4 border-green-500 text-slate-700 p-4 rounded-lg shadow-xl z-50" role="alert"> <div class="flex items-center"> <div class="text-green-500 mr-3"> <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg> </div> <div> <p class="font-bold">Login Berhasil!</p> <p class="text-sm">Selamat Datang kembali, {{ Auth::user()->name }}!</p> </div> </div> </div>
    @endif

    {{-- ============================================= --}}
    {{-- == [HERO SECTION DENGAN TEKS REFERENSI BARU] == --}}
    {{-- ============================================= --}}
    <div class="min-h-screen relative flex flex-col justify-center items-center text-white text-center px-6 overflow-hidden">

        {{-- 1. Gambar Latar Belakang (Tetap Sama) --}}
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1712555000742-84faee058b5e?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MzAyfHxwdXJwbGUlMjBnYWRnZXR8ZW58MHx8MHx8fDA%3D&auto=format&fit=crop&q=60&w=600"
                 alt="Background Gadget"
                 class="w-full h-full object-cover">
            {{-- 2. Overlay Gelap (Tetap Sama) --}}
            <div class="absolute inset-0 bg-gray-900 opacity-60"></div>
        </div>

        {{-- 3. Konten Teks & Tombol (Sesuai `Screenshot 2025-10-25...`) --}}
        <div class="relative z-10 container mx-auto">
            {{-- Judul Utama (Sesuai Screenshot 2025-10-25...) --}}
            <h1 class="text-5xl md:text-6xl font-extrabold">
                Sewa Gadget Impianmu
            </h1>
            {{-- Subjudul --}}
            <p class="mt-4 text-lg md:text-xl text-slate-100 max-w-2xl mx-auto">
                Handphone, Laptop terbaru siap menemanimu.
            </p>
            {{-- Tombol Lihat Semua Produk --}}
            <a href="{{ route('products.index') }}"
               class="mt-8 inline-block bg-white hover:bg-slate-100 text-purple-600 font-bold py-3 px-8 rounded-lg transition duration-300 shadow-md text-lg">
                Lihat Semua Produk
            </a>
        </div>

        {{-- Ikon panah scroll down (Tetap Sama) --}}
        <div class="absolute bottom-10 animate-bounce">
            <svg class="w-8 h-8 text-white opacity-70" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
              <path d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
            </svg>
        </div>
    </div>
    {{-- ============================================= --}}
    {{-- == [AKHIR DARI MODIFIKASI HERO] == --}}
    {{-- ============================================= --}}


    {{-- LOGO TICKER / MARQUEE BRANDS (KONTEN LAMA ANDA) --}}
    <div class="bg-slate-50 py-16 z-20 overflow-hidden">
        <div class="container mx-auto px-6">
            <div class="border-b border-slate-200 mb-10 w-1/4 mx-auto"></div>
            <h3 class="text-center text-lg font-semibold text-slate-700 mb-10"> Tersedia Brand Teknologi Terkemuka </h3>
            {{-- (Kode Marquee Anda di sini...) --}}
            <div class="relative w-full overflow-hidden mb-8">
                <div class="animate-marquee-left">
                    <div class="marquee-group">
                        <div class="brand-box brand-apple mx-4 flex-shrink-0 rounded-lg shadow-md p-4 flex items-center justify-center h-20 w-40 transition hover:shadow-lg"> <img src="storage/logo/apple-logo.jpeg" alt="Apple" class="max-h-full max-w-full object-contain"> </div>
                        <div class="brand-box brand-samsung mx-4 flex-shrink-0 rounded-lg shadow-md p-4 flex items-center justify-center h-20 w-40 transition hover:shadow-lg"> <img src="storage/logo/samsung-logo.jpeg" alt="Samsung" class="max-h-full max-w-full object-contain"> </div>
                        <div class="brand-box brand-xiaomi mx-4 flex-shrink-0 rounded-lg shadow-md p-4 flex items-center justify-center h-20 w-40 transition hover:shadow-lg"> <img src="storage/logo/Xiaomi-Logo.jpeg" alt="Xiaomi" class="max-h-full max-w-full object-contain"> </div>
                        <div class="brand-box brand-oppo mx-4 flex-shrink-0 rounded-lg shadow-md p-4 flex items-center justify-center h-20 w-40 transition hover:shadow-lg"> <img src="storage/logo/oppo-logo.jpeg" alt="Oppo" class="max-h-full max-w-full object-contain"> </div>
                        <div class="brand-box brand-vivo mx-4 flex-shrink-0 rounded-lg shadow-md p-4 flex items-center justify-center h-20 w-40 transition hover:shadow-lg"> <img src="storage/logo/vivo-logo.jpeg" alt="Vivo" class="max-h-full max-w-full object-contain"> </div>
                        <div class="brand-box brand-asus mx-4 flex-shrink-0 rounded-lg shadow-md p-4 flex items-center justify-center h-20 w-40 transition hover:shadow-lg"> <img src="storage/logo/asus-logo.jpeg" alt="Asus" class="max-h-full max-w-full object-contain"> </div>
                    </div>
                    <div class="marquee-group" aria-hidden="true">
                        <div class="brand-box brand-apple mx-4 flex-shrink-0 rounded-lg shadow-md p-4 flex items-center justify-center h-20 w-40 transition hover:shadow-lg"> <img src="storage/logo/apple-logo.jpeg" alt="Apple" class="max-h-full max-w-full object-contain"> </div>
                        <div class="brand-box brand-samsung mx-4 flex-shrink-0 rounded-lg shadow-md p-4 flex items-center justify-center h-20 w-40 transition hover:shadow-lg"> <img src="storage/logo/samsung-logo.jpeg" alt="Samsung" class="max-h-full max-w-full object-contain"> </div>
                        <div class="brand-box brand-xiaomi mx-4 flex-shrink-0 rounded-lg shadow-md p-4 flex items-center justify-center h-20 w-40 transition hover:shadow-lg"> <img src="storage/logo/Xiaomi-Logo.jpeg" alt="Xiaomi" class="max-h-full max-w-full object-contain"> </div>
                        <div class="brand-box brand-oppo mx-4 flex-shrink-0 rounded-lg shadow-md p-4 flex items-center justify-center h-20 w-40 transition hover:shadow-lg"> <img src="storage/logo/oppo-logo.jpeg" alt="Oppo" class="max-h-full max-w-full object-contain"> </div>
                        <div class="brand-box brand-vivo mx-4 flex-shrink-0 rounded-lg shadow-md p-4 flex items-center justify-center h-20 w-40 transition hover:shadow-lg"> <img src="storage/logo/vivo-logo.jpeg" alt="Vivo" class="max-h-full max-w-full object-contain"> </div>
                        <div class="brand-box brand-asus mx-4 flex-shrink-0 rounded-lg shadow-md p-4 flex items-center justify-center h-20 w-40 transition hover:shadow-lg"> <img src="storage/logo/asus-logo.jpeg" alt="Asus" class="max-h-full max-w-full object-contain"> </div>
                    </div>
                </div>
            </div>
            <div class="relative w-full overflow-hidden">
                <div class="animate-marquee-right">
                    <div class="marquee-group">
                        <div class="brand-box brand-gopix mx-4 flex-shrink-0 rounded-lg shadow-md p-4 flex items-center justify-center h-20 w-40 transition hover:shadow-lg"> <img src="storage/logo/gopix-logo.jpeg" alt="Gopix" class="max-h-full max-w-full object-contain"> </div>
                        <div class="brand-box brand-rog mx-4 flex-shrink-0 rounded-lg shadow-md p-4 flex items-center justify-center h-20 w-40 transition hover:shadow-lg"> <img src="storage/logo/rog-logo.jpeg" alt="ROG" class="max-h-full max-w-full object-contain"> </div>
                        <div class="brand-box brand-macbook mx-4 flex-shrink-0 rounded-lg shadow-md p-4 flex items-center justify-center h-20 w-40 transition hover:shadow-lg"> <img src="storage/logo/macbook-logo.jpeg" alt="MacBook" class="max-h-full max-w-full object-contain"> </div>
                        <div class="brand-box brand-xiaomi mx-4 flex-shrink-0 rounded-lg shadow-md p-4 flex items-center justify-center h-20 w-40 transition hover:shadow-lg"> <img src="storage/logo/Xiaomi-Logo.jpeg" alt="Xiaomi" class="max-h-full max-w-full object-contain"> </div>
                        <div class="brand-box brand-samsung mx-4 flex-shrink-0 rounded-lg shadow-md p-4 flex items-center justify-center h-20 w-40 transition hover:shadow-lg"> <img src="storage/logo/samsung-logo.jpeg" alt="Samsung" class="max-h-full max-w-full object-contain"> </div>
                        <div class="brand-box brand-apple mx-4 flex-shrink-0 rounded-lg shadow-md p-4 flex items-center justify-center h-20 w-40 transition hover:shadow-lg"> <img src="storage/logo/apple-logo.jpeg" alt="Apple" class="max-h-full max-w-full object-contain"> </div>
                    </div>
                    <div class="marquee-group" aria-hidden="true">
                        <div class="brand-box brand-gopix mx-4 flex-shrink-0 rounded-lg shadow-md p-4 flex items-center justify-center h-20 w-40 transition hover:shadow-lg"> <img src="storage/logo/gopix-logo.jpeg" alt="Gopix" class="max-h-full max-w-full object-contain"> </div>
                        <div class="brand-box brand-rog mx-4 flex-shrink-0 rounded-lg shadow-md p-4 flex items-center justify-center h-20 w-40 transition hover:shadow-lg"> <img src="storage/logo/rog-logo.jpeg" alt="ROG" class="max-h-full max-w-full object-contain"> </div>
                        <div class="brand-box brand-macbook mx-4 flex-shrink-0 rounded-lg shadow-md p-4 flex items-center justify-center h-20 w-40 transition hover:shadow-lg"> <img src="storage/logo/macbook-logo.jpeg" alt="MacBook" class="max-h-full max-w-full object-contain"> </div>
                        <div class="brand-box brand-xiaomi mx-4 flex-shrink-0 rounded-lg shadow-md p-4 flex items-center justify-center h-20 w-40 transition hover:shadow-lg"> <img src="storage/logo/Xiaomi-Logo.jpeg" alt="Xiaomi" class="max-h-full max-w-full object-contain"> </div>
                        <div class="brand-box brand-samsung mx-4 flex-shrink-0 rounded-lg shadow-md p-4 flex items-center justify-center h-20 w-40 transition hover:shadow-lg"> <img src="storage/logo/samsung-logo.jpeg" alt="Samsung" class="max-h-full max-w-full object-contain"> </div>
                        <div class="brand-box brand-apple mx-4 flex-shrink-0 rounded-lg shadow-md p-4 flex items-center justify-center h-20 w-40 transition hover:shadow-lg"> <img src="storage/logo/apple-logo.jpeg" alt="Apple" class="max-h-full max-w-full object-contain"> </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Berita Gadget Terbaru Section --}}
     <div class="py-16 pb-24 bg-gradient-to-b from-indigo-100 via-purple-50 to-white relative">
        <div class="container mx-auto px-6">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-indigo-700">Berita Gadget Terbaru</h2>
                <p class="text-gray-600 mt-2">Ikuti perkembangan teknologi terkini bersama kami.</p>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                 @forelse ($newsItems as $item)
                     <div class="bg-white rounded-lg shadow-md overflow-hidden transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                         <a href="{{ $item->link_url }}" target="_blank" class="flex h-full">
                             <img class="w-2/5 object-cover" src="{{ Storage::url($item->image_path) }}" alt="{{ $item->title }}">
                             <div class="p-5 w-3/5 flex flex-col justify-center">
                                 <h4 class="font-bold text-lg text-indigo-700">{{ $item->title }}</h4>
                                 <p class="text-gray-600 mt-2 text-sm">{{ Str::limit($item->description, 100) }}</p>
                             </div>
                         </a>
                     </div>
                 @empty
                     <p class="text-center text-gray-500 lg:col-span-2">Belum ada berita terbaru.</p>
                 @endforelse
             </div>
        </div>
         <div class="shape-divider-bottom" style="bottom: -1px;">
            <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="shape-fill"></path>
            </svg>
        </div>
    </div>

    {{-- Kenapa Memilih DigiRent Section --}}
     <div class="py-16 bg-gradient-to-br from-indigo-50 via-purple-50 to-white bg-dots-pattern relative overflow-hidden">
        <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-purple-200 rounded-full opacity-20 filter blur-3xl -translate-x-1/2 -translate-y-1/2 z-0"></div>
        <div class="container mx-auto px-6 text-center relative z-10 pt-8">
            <h2 class="text-3xl font-bold text-indigo-700 mb-4">Kenapa Memilih DigiRent?</h2>
            <p class="text-gray-600 mb-12 max-w-2xl mx-auto">Kami menawarkan lebih dari sekadar penyewaan. Kami memberikan kemudahan, fleksibilitas, dan akses ke teknologi terkini tanpa beban.</p>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                 <div class="p-6 bg-white/50 backdrop-blur-sm rounded-lg shadow-sm hover:shadow-lg transition"> <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="text-indigo-600 w-16 h-16 mx-auto mb-4"> <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" /> </svg> <h3 class="text-xl font-bold text-slate-800 mb-2">Hemat Biaya</h3> <p class="text-gray-600">Gunakan gadget flagship tanpa perlu membelinya...</p> </div>
                 <div class="p-6 bg-white/50 backdrop-blur-sm rounded-lg shadow-sm hover:shadow-lg transition"> <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="text-indigo-600 w-16 h-16 mx-auto mb-4"> <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09zM18.259 8.715L18 9.75l-.259-1.035a3.375 3.375 0 00-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 002.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 002.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 00-2.456 2.456zM16.898 20.562L16.25 22.5l-.648-1.938a3.375 3.375 0 00-2.696-2.696L11.25 18l1.938-.648a3.375 3.375 0 002.696-2.696L16.25 13l.648 1.938a3.375 3.375 0 002.696 2.696L21 18l-1.938.648a3.375 3.375 0 00-2.696 2.696z" /> </svg> <h3 class="text-xl font-bold text-slate-800 mb-2">Selalu Up-to-date</h3> <p class="text-gray-600">Ingin mencoba iPhone atau MacBook terbaru...</p> </div>
                 <div class="p-6 bg-white/50 backdrop-blur-sm rounded-lg shadow-sm hover:shadow-lg transition"> <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="text-indigo-600 w-16 h-16 mx-auto mb-4"> <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /> </svg> <h3 class="text-xl font-bold text-slate-800 mb-2">Fleksibel & Mudah</h3> <p class="text-gray-600">Proses pemesanan cepat dan sepenuhnya online...</p> </div>
            </div>
        </div>
    </div>

    {{-- FAQ (Tanya Jawab) --}}
    <div id="faq-section" class="py-24 bg-indigo-50 relative">
        <div class="shape-divider-top" style="top: -1px;">
            <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="shape-fill"></path>
            </svg>
        </div>

    <div class="py-24 bg-gradient-to-t from-purple-100 via-indigo-50 to-white relative">
        <div class="shape-divider-top" style="top: -1px;">
            <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="shape-fill"></path>
            </svg>
        </div>

        <div class="container mx-auto px-6 pt-12">

            <div class="text-center mb-16">
                <h2 class="text-4xl font-extrabold text-indigo-700">Tanya Jawab (FAQ)</h2>
                <p class="text-gray-600 mt-3 text-lg">Pertanyaan yang paling sering diajukan seputar DigiRent.</p>
            </div>

            <div class="max-w-3xl mx-auto" x-data="{ open: null }">
                <div class="border-b border-slate-300"> <button @click="open = open === 1 ? null : 1" class="w-full flex justify-between items-center py-6 text-left"> <span class="text-xl font-semibold text-slate-800">Apa saja syarat untuk menyewa di DigiRent?</span> <span class="text-indigo-600 transition-transform duration-300" :class="{ 'rotate-180': open === 1 }"> <svg class="w-6 h-6" fill="none" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"></path></svg> </span> </button> <div x-show="open === 1" x-collapse x-cloak class="pb-6"> <p class="text-slate-600"> Untuk menyewa, Anda hanya perlu menyiapkan identitas diri (KTP/SIM) yang masih berlaku dan melakukan pembayaran sesuai tagihan. Untuk beberapa item khusus, mungkin diperlukan jaminan tambahan.</p> </div> </div>
                <div class="border-b border-slate-300"> <button @click="open = open === 2 ? null : 2" class="w-full flex justify-between items-center py-6 text-left"> <span class="text-xl font-semibold text-slate-800">Bagaimana jika gadget yang saya sewa rusak?</span> <span class="text-indigo-600 transition-transform duration-300" :class="{ 'rotate-180': open === 2 }"> <svg class="w-6 h-6" fill="none" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"></path></svg> </span> </button> <div x-show="open === 2" x-collapse x-cloak class="pb-6"> <p class="text-slate-600"> Kami memahami bahwa kecelakaan bisa terjadi. Jika terjadi kerusakan ringan karena pemakaian wajar, biasanya tidak ada biaya tambahan. Namun, untuk kerusakan berat atau kehilangan, Anda mungkin akan dikenakan biaya perbaikan atau penggantian sesuai syarat dan ketentuan.</p> </div> </div>
                <div class="border-b border-slate-300"> <button @click="open = open === 3 ? null : 3" class="w-full flex justify-between items-center py-6 text-left"> <span class="text-xl font-semibold text-slate-800">Apakah saya bisa memperpanjang masa sewa?</span> <span class="text-indigo-600 transition-transform duration-300" :class="{ 'rotate-180': open === 3 }"> <svg class="w-6 h-6" fill="none" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"></path></svg> </span> </button> <div x-show="open === 3" x-collapse x-cloak class="pb-6"> <p class="text-slate-600"> Tentu saja! Anda bisa mengajukan perpanjangan sewa melalui dashboard akun Anda atau menghubungi customer service kami sebelum masa sewa berakhir, selama item tersebut belum dipesan oleh orang lain..</p> </div> </div>
                <div class="border-b border-slate-300"> <button @click="open = open === 4 ? null : 4" class="w-full flex justify-between items-center py-6 text-left"> <span class="text-xl font-semibold text-slate-800">Apakah gadget bisa diantar ke lokasi saya?</span> <span class="text-indigo-600 transition-transform duration-300" :class="{ 'rotate-180': open === 4 }"> <svg class="w-6 h-6" fill="none" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"></path></svg> </span> </button> <div x-show="open === 4" x-collapse x-cloak class="pb-6"> <p class="text-slate-600"> Ya, kami melayani pengantaran dan penjemputan untuk area Purwokerto dengan biaya tambahan yang terjangkau. Anda juga bisa mengambil dan mengembalikan langsung ke lokasi kami.</p> </div> </div>
            </div>
        </div>
    </div>

    {{-- (Kelas .brand-box tetap di sini) --}}
    <style>
    .brand-box {
        @apply mx-4 flex-shrink-0 rounded-lg shadow-md p-4 flex items-center justify-center h-20 w-40 transition hover:shadow-lg border-2;
        img {
            @apply max-h-full max-w-full object-contain;
        }
    }
    </style>

</x-app-layout>
