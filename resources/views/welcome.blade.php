<x-app-layout>

    {{-- CSS TAMBAHAN UNTUK ANIMASI & ELEMEN BARU --}}
    <style>
        /* ... (Animasi float, pulse, marquee tetap sama) ... */
        @keyframes float { 0% { transform: translateY(0px); } 50% { transform: translateY(-15px); } 100% { transform: translateY(0px); } }
        .animate-float { animation: float 6s ease-in-out infinite; }
        @keyframes pulse-light { 0%, 100% { box-shadow: 0 0 15px 0px rgba(99, 102, 241, 0.5); } 50% { box-shadow: 0 0 25px 10px rgba(99, 102, 241, 0.2); } }
        .animate-pulse-light { animation: pulse-light 4s ease-in-out infinite; }
        @keyframes marquee-left { 0% { transform: translateX(0%); } 100% { transform: translateX(-100%); } }
        .animate-marquee-left { display: flex; width: 200%; animation: marquee-left 50s linear infinite; }
        @keyframes marquee-right { 0% { transform: translateX(-100%); } 100% { transform: translateX(0%); } }
        .animate-marquee-right { display: flex; width: 200%; animation: marquee-right 50s linear infinite; }
        .marquee-group { width: 50%; flex-shrink: 0; display: flex; justify-content: space-around; align-items: center; }
        [x-cloak] { display: none !important; }

        /* CSS untuk Dot Pattern */
        .bg-dots-pattern {
            background-image: radial-gradient(circle, rgba(224, 231, 255, 0.6) 1px, transparent 1px);
            background-size: 1.2rem 1.2rem;
        }

        /* [MODIFIKASI] CSS untuk Shape Divider (Gelombang) */
        .shape-divider-bottom svg {
            position: absolute; /* Ubah ke absolute */
            bottom: 0; /* Letakkan di bawah */
            left: 0;
            width: 100%;
            height: 80px; /* Sesuaikan tinggi gelombang jika perlu */
            pointer-events: none; /* Agar tidak mengganggu klik */
        }
        .shape-divider-bottom .shape-fill {
            fill: #FFFFFF; /* Warna background section di bawahnya (putih) */
        }
         .shape-divider-top svg {
            position: absolute; /* Ubah ke absolute */
            top: 0; /* Letakkan di atas */
            left: 0;
            width: 100%;
            height: 80px; /* Sesuaikan tinggi gelombang jika perlu */
            transform: rotate(180deg); /* Balik SVG untuk bagian atas */
            pointer-events: none; /* Agar tidak mengganggu klik */
        }
        .shape-divider-top .shape-fill {
             fill: #eef2ff; /* Warna background section di atasnya (indigo-50) */
             /* Jika section atas adalah slate-100, gunakan #f1f5f9 */
        }


    </style>

    {{-- Fitur Notifikasi Animasi --}}
    @if (session('status') === 'just-logged-in')
        {{-- ... (Kode Notifikasi Tetap Sama) ... --}}
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-x-4" x-transition:enter-end="opacity-100 transform translate-x-0" x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed top-20 right-5 bg-white border-l-4 border-green-500 text-slate-700 p-4 rounded-lg shadow-xl z-50" role="alert"> <div class="flex items-center"> <div class="text-green-500 mr-3"> <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg> </div> <div> <p class="font-bold">Login Berhasil!</p> <p class="text-sm">Selamat Datang kembali, {{ Auth::user()->name }}!</p> </div> </div> </div>
    @endif

    {{-- Hero Section --}}
    <div class="text-white bg-gradient-to-br from-indigo-800 via-purple-800 to-pink-800">
        {{-- ... (Isi Hero Section Tetap Sama) ... --}}
        <div class="container mx-auto px-6 py-24 text-center"> <h1 class="text-5xl font-extrabold">Sewa Gadget Impianmu</h1> <p class="mt-4 text-lg text-slate-300">Handphone, Laptop terbaru siap menemanimu.</p> <a href="{{ route('products.index') }}" class="mt-8 inline-block bg-indigo-500 hover:bg-indigo-600 text-white font-bold py-3 px-6 rounded-lg transition duration-300"> Lihat Semua Produk </a> </div>
    </div>


    {{-- LOGO TICKER / MARQUEE BRANDS --}}
    <div class="bg-slate-100 py-16 z-20 overflow-hidden">
        {{-- ... (Isi Logo Ticker Tetap Sama) ... --}}
         <div class="container mx-auto px-6"> <h3 class="text-center text-lg font-semibold text-slate-700 mb-10"> Didukung oleh Brand Teknologi Terkemuka </h3> <div class="relative w-full overflow-hidden mb-8"> <div class="animate-marquee-left"> <div class="marquee-group"> <div class="mx-4 flex-shrink-0 bg-white rounded-lg shadow-md p-4 flex items-center justify-center h-20 w-40 transition hover:shadow-lg"> <img src="storage/logo/apple-logo.jpeg" alt="Apple" class="h-10 max-w-full object-contain"> </div> <div class="mx-4 flex-shrink-0 bg-white rounded-lg shadow-md p-4 flex items-center justify-center h-20 w-40 transition hover:shadow-lg"> <img src="storage/logo/samsung-logo.jpeg" alt="Samsung" class="h-8 max-w-full object-contain"> </div> <div class="mx-4 flex-shrink-0 bg-white rounded-lg shadow-md p-4 flex items-center justify-center h-20 w-40 transition hover:shadow-lg"> <img src="storage/logo/Xiaomi-Logo.jpeg" alt="Xiaomi" class="h-10 max-w-full object-contain"> </div> <div class="mx-4 flex-shrink-0 bg-white rounded-lg shadow-md p-4 flex items-center justify-center h-20 w-40 transition hover:shadow-lg"> <img src="storage/logo/oppo-logo.jpeg" alt="Oppo" class="h-12 max-w-full object-contain"> </div> <div class="mx-4 flex-shrink-0 bg-white rounded-lg shadow-md p-4 flex items-center justify-center h-20 w-40 transition hover:shadow-lg"> <img src="storage/logo/vivo-logo.jpeg" alt="Vivo" class="h-10 max-w-full object-contain"> </div> <div class="mx-4 flex-shrink-0 bg-white rounded-lg shadow-md p-4 flex items-center justify-center h-20 w-40 transition hover:shadow-lg"> <img src="storage/logo/asus-logo.jpeg" alt="Asus" class="h-8 max-w-full object-contain"> </div> </div> <div class="marquee-group" aria-hidden="true"> <div class="mx-4 flex-shrink-0 bg-white rounded-lg shadow-md p-4 flex items-center justify-center h-20 w-40 transition hover:shadow-lg"> <img src="storage/logo/apple-logo.jpeg" alt="Apple" class="h-10 max-w-full object-contain"> </div> <div class="mx-4 flex-shrink-0 bg-white rounded-lg shadow-md p-4 flex items-center justify-center h-20 w-40 transition hover:shadow-lg"> <img src="storage/logo/samsung-logo.jpeg" alt="Samsung" class="h-8 max-w-full object-contain"> </div> <div class="mx-4 flex-shrink-0 bg-white rounded-lg shadow-md p-4 flex items-center justify-center h-20 w-40 transition hover:shadow-lg"> <img src="storage/logo/Xiaomi-Logo.jpeg" alt="Xiaomi" class="h-10 max-w-full object-contain"> </div> <div class="mx-4 flex-shrink-0 bg-white rounded-lg shadow-md p-4 flex items-center justify-center h-20 w-40 transition hover:shadow-lg"> <img src="storage/logo/oppo-logo.jpeg" alt="Oppo" class="h-12 max-w-full object-contain"> </div> <div class="mx-4 flex-shrink-0 bg-white rounded-lg shadow-md p-4 flex items-center justify-center h-20 w-40 transition hover:shadow-lg"> <img src="storage/logo/vivo-logo.jpeg" alt="Vivo" class="h-10 max-w-full object-contain"> </div> <div class="mx-4 flex-shrink-0 bg-white rounded-lg shadow-md p-4 flex items-center justify-center h-20 w-40 transition hover:shadow-lg"> <img src="storage/logo/asus-logo.jpeg" alt="Asus" class="h-8 max-w-full object-contain"> </div> </div> </div> </div> <div class="relative w-full overflow-hidden"> <div class="animate-marquee-right"> <div class="marquee-group"> <div class="mx-4 flex-shrink-0 bg-white rounded-lg shadow-md p-4 flex items-center justify-center h-20 w-40 transition hover:shadow-lg"> <img src="storage/logo/gopix-logo.jpeg" alt="Gopix" class="h-7 max-w-full object-contain"> </div> <div class="mx-4 flex-shrink-0 bg-white rounded-lg shadow-md p-4 flex items-center justify-center h-20 w-40 transition hover:shadow-lg"> <img src="storage/logo/rog-logo.jpeg" alt="rog" class="h-8 max-w-full object-contain"> </div> <div class="mx-4 flex-shrink-0 bg-white rounded-lg shadow-md p-4 flex items-center justify-center h-20 w-40 transition hover:shadow-lg"> <img src="storage/logo/macbook-logo.jpeg" alt="DJI" class="h-9 max-w-full object-contain"> </div> <div class="mx-4 flex-shrink-0 bg-white rounded-lg shadow-md p-4 flex items-center justify-center h-20 w-40 transition hover:shadow-lg"> <img src="storage/logo/Xiaomi-Logo.jpeg" alt="xiaomi" class="h-6 max-w-full object-contain"> </div> <div class="mx-4 flex-shrink-0 bg-white rounded-lg shadow-md p-4 flex items-center justify-center h-20 w-40 transition hover:shadow-lg"> <img src="storage/logo/samsung-logo.jpeg" alt="samsung" class="h-6 max-w-full object-contain"> </div> <div class="mx-4 flex-shrink-0 bg-white rounded-lg shadow-md p-4 flex items-center justify-center h-20 w-40 transition hover:shadow-lg"> <img src="storage/logo/apple-logo.jpeg" alt="apple" class="h-8 max-w-full object-contain"> </div> </div> <div class="marquee-group" aria-hidden="true"> <div class="mx-4 flex-shrink-0 bg-white rounded-lg shadow-md p-4 flex items-center justify-center h-20 w-40 transition hover:shadow-lg"> <img src="storage/logo/gopix-logo.jpeg" alt="Gopix" class="h-7 max-w-full object-contain"> </div> <div class="mx-4 flex-shrink-0 bg-white rounded-lg shadow-md p-4 flex items-center justify-center h-20 w-40 transition hover:shadow-lg"> <img src="storage/logo/rog-logo.jpeg" alt="rog" class="h-8 max-w-full object-contain"> </div> <div class="mx-4 flex-shrink-0 bg-white rounded-lg shadow-md p-4 flex items-center justify-center h-20 w-40 transition hover:shadow-lg"> <img src="storage/logo/macbook-logo.jpeg" alt="DJI" class="h-9 max-w-full object-contain"> </div> <div class="mx-4 flex-shrink-0 bg-white rounded-lg shadow-md p-4 flex items-center justify-center h-20 w-40 transition hover:shadow-lg"> <img src="storage/logo/Xiaomi-Logo.jpeg" alt="xiaomi" class="h-6 max-w-full object-contain"> </div> <div class="mx-4 flex-shrink-0 bg-white rounded-lg shadow-md p-4 flex items-center justify-center h-20 w-40 transition hover:shadow-lg"> <img src="storage/logo/samsung-logo.jpeg" alt="samsung" class="h-6 max-w-full object-contain"> </div> <div class="mx-4 flex-shrink-0 bg-white rounded-lg shadow-md p-4 flex items-center justify-center h-20 w-40 transition hover:shadow-lg"> <img src="storage/logo/apple-logo.jpeg" alt="apple" class="h-8 max-w-full object-contain"> </div> </div> </div> </div> </div>
    </div>

    {{-- Berita Gadget Terbaru Section --}}
    {{-- [MODIFIKASI] Background gradient, relative, padding bottom lebih besar --}}
    <div class="py-16 pb-24 bg-gradient-to-b from-indigo-100 via-purple-50 to-white relative"> {{-- pb-24 untuk ruang shape divider --}}
        <div class="container mx-auto px-6">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-indigo-700">Berita Gadget Terbaru</h2>
                <p class="text-gray-600 mt-2">Ikuti perkembangan teknologi terkini bersama kami.</p>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                {{-- ... (Isi Kartu Berita Tetap Sama) ... --}}
                <div class="bg-white rounded-lg shadow-md overflow-hidden transition-all duration-300 hover:shadow-xl hover:-translate-y-1"> <a href="..." target="_blank" class="flex h-full"> <img class="w-2/5 object-cover" src="{{ asset('images/berita/kamera-mobile.jpg') }}" alt="..."> <div class="p-5 w-3/5 flex flex-col justify-center"> <h4 class="font-bold text-lg text-indigo-700">Era Baru Fotografi Mobile</h4> <p class="text-gray-600 mt-2 text-sm"> Sensor kamera 1 inci kini menjadi tren...</p> </div> </a> </div>
                <div class="bg-white rounded-lg shadow-md overflow-hidden transition-all duration-300 hover:shadow-xl hover:-translate-y-1"> <a href="..." target="_blank" class="flex h-full"> <img class="w-2/5 object-cover" src="{{ asset('images/berita/laptop-ai.jpg') }}" alt="..."> <div class="p-5 w-3/5 flex flex-col justify-center"> <h4 class="font-bold text-lg text-indigo-700">Laptop dengan Tenaga AI</h4> <p class="text-gray-600 mt-2 text-sm"> Chipset terbaru dengan NPU terintegrasi...</p> </div> </a> </div>
                <div class="bg-white rounded-lg shadow-md overflow-hidden transition-all duration-300 hover:shadow-xl hover:-translate-y-1"> <a href="..." target="_blank" class="flex h-full"> <img class="w-2/5 object-cover" src="{{ asset('images/berita/xiaomi-rilis.jpg') }}" alt="..."> <div class="p-5 w-3/5 flex flex-col justify-center"> <h4 class="font-bold text-lg text-indigo-700">Intel perluas portofolio prosesor...</h4> <p class="text-gray-600 mt-2 text-sm"> Intel memperluas portofolio AI PC...</p> </div> </a> </div>
                <div class="bg-white rounded-lg shadow-md overflow-hidden transition-all duration-300 hover:shadow-xl hover:-translate-y-1"> <a href="..." target="_blank" class="flex h-full"> <img class="w-2/5 object-cover" src="{{ asset('images/berita/foldable-phone.jpg') }}" alt="..."> <div class="p-5 w-3/5 flex flex-col justify-center"> <h4 class="font-bold text-lg text-indigo-700">Masa Depan Layar Lipat</h4> <p class="text-gray-600 mt-2 text-sm"> Generasi terbaru dari Apple akan hadir...</p> </div> </a> </div>
            </div>
        </div>
         {{-- [MODIFIKASI] Shape Divider Gelombang di bawah Berita --}}
        <div class="shape-divider-bottom" style="bottom: -1px;"> {{-- Sedikit offset agar tidak ada celah --}}
            <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="shape-fill"></path>
            </svg>
        </div>
    </div>

    {{-- Kenapa Memilih DigiRent Section --}}
    {{-- [MODIFIKASI] Tambah bg-dots-pattern, gradient & relative --}}
    <div class="py-16 bg-gradient-to-br from-indigo-50 via-purple-50 to-white bg-dots-pattern relative overflow-hidden">
         {{-- Blob dekoratif --}}
        <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-purple-200 rounded-full opacity-20 filter blur-3xl -translate-x-1/2 -translate-y-1/2 z-0"></div>

        <div class="container mx-auto px-6 text-center relative z-10 pt-8"> {{-- Tambah padding top sedikit --}}
            <h2 class="text-3xl font-bold text-indigo-700 mb-4">Kenapa Memilih DigiRent?</h2>
            <p class="text-gray-600 mb-12 max-w-2xl mx-auto">Kami menawarkan lebih dari sekadar penyewaan. Kami memberikan kemudahan, fleksibilitas, dan akses ke teknologi terkini tanpa beban.</p>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                {{-- ... (Isi Kartu Kenapa Memilih Tetap Sama) ... --}}
                 <div class="p-6 bg-white/50 backdrop-blur-sm rounded-lg shadow-sm hover:shadow-lg transition"> <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="text-indigo-600 w-16 h-16 mx-auto mb-4"> <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" /> </svg> <h3 class="text-xl font-bold text-slate-800 mb-2">Hemat Biaya</h3> <p class="text-gray-600">Gunakan gadget flagship tanpa perlu membelinya...</p> </div>
                 <div class="p-6 bg-white/50 backdrop-blur-sm rounded-lg shadow-sm hover:shadow-lg transition"> <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="text-indigo-600 w-16 h-16 mx-auto mb-4"> <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09zM18.259 8.715L18 9.75l-.259-1.035a3.375 3.375 0 00-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 002.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 002.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 00-2.456 2.456zM16.898 20.562L16.25 22.5l-.648-1.938a3.375 3.375 0 00-2.696-2.696L11.25 18l1.938-.648a3.375 3.375 0 002.696-2.696L16.25 13l.648 1.938a3.375 3.375 0 002.696 2.696L21 18l-1.938.648a3.375 3.375 0 00-2.696 2.696z" /> </svg> <h3 class="text-xl font-bold text-slate-800 mb-2">Selalu Up-to-date</h3> <p class="text-gray-600">Ingin mencoba iPhone atau MacBook terbaru...</p> </div>
                 <div class="p-6 bg-white/50 backdrop-blur-sm rounded-lg shadow-sm hover:shadow-lg transition"> <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="text-indigo-600 w-16 h-16 mx-auto mb-4"> <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /> </svg> <h3 class="text-xl font-bold text-slate-800 mb-2">Fleksibel & Mudah</h3> <p class="text-gray-600">Proses pemesanan cepat dan sepenuhnya online...</p> </div>
            </div>
        </div>
    </div>

    {{-- FAQ (Tanya Jawab) --}}
    {{-- [MODIFIKASI] Background gradient & relative --}}
    <div class="py-24 bg-gradient-to-t from-purple-100 via-indigo-50 to-white relative">
        {{-- [MODIFIKASI] Shape Divider Gelombang di atas FAQ --}}
        <div class="shape-divider-top" style="top: -1px;"> {{-- Sedikit offset --}}
            <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="shape-fill"></path>
            </svg>
        </div>

        <div class="container mx-auto px-6 pt-12">

            <div class="text-center mb-16">
                 {{-- [MODIFIKASI] Warna judul section --}}
                <h2 class="text-4xl font-extrabold text-indigo-700">Tanya Jawab (FAQ)</h2>
                <p class="text-gray-600 mt-3 text-lg">Pertanyaan yang paling sering diajukan seputar DigiRent.</p>
            </div>

            <div class="max-w-3xl mx-auto" x-data="{ open: null }">
                {{-- ... (Isi FAQ Tetap Sama) ... --}}
                <div class="border-b border-slate-300"> <button @click="open = open === 1 ? null : 1" class="w-full flex justify-between items-center py-6 text-left"> <span class="text-xl font-semibold text-slate-800">Apa saja syarat untuk menyewa di DigiRent?</span> <span class="text-indigo-600 transition-transform duration-300" :class="{ 'rotate-180': open === 1 }"> <svg class="w-6 h-6" fill="none" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"></path></svg> </span> </button> <div x-show="open === 1" x-collapse x-cloak class="pb-6"> <p class="text-slate-600"> Untuk menyewa, Anda hanya perlu menyiapkan identitas diri...</p> </div> </div>
                <div class="border-b border-slate-300"> <button @click="open = open === 2 ? null : 2" class="w-full flex justify-between items-center py-6 text-left"> <span class="text-xl font-semibold text-slate-800">Bagaimana jika gadget yang saya sewa rusak?</span> <span class="text-indigo-600 transition-transform duration-300" :class="{ 'rotate-180': open === 2 }"> <svg class="w-6 h-6" fill="none" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"></path></svg> </span> </button> <div x-show="open === 2" x-collapse x-cloak class="pb-6"> <p class="text-slate-600"> Kami memahami bahwa kecelakaan bisa terjadi...</p> </div> </div>
                <div class="border-b border-slate-300"> <button @click="open = open === 3 ? null : 3" class="w-full flex justify-between items-center py-6 text-left"> <span class="text-xl font-semibold text-slate-800">Apakah saya bisa memperpanjang masa sewa?</span> <span class="text-indigo-600 transition-transform duration-300" :class="{ 'rotate-180': open === 3 }"> <svg class="w-6 h-6" fill="none" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"></path></svg> </span> </button> <div x-show="open === 3" x-collapse x-cloak class="pb-6"> <p class="text-slate-600"> Tentu saja! Anda bisa mengajukan perpanjangan...</p> </div> </div>
                <div class="border-b border-slate-300"> <button @click="open = open === 4 ? null : 4" class="w-full flex justify-between items-center py-6 text-left"> <span class="text-xl font-semibold text-slate-800">Apakah gadget bisa diantar ke lokasi saya?</span> <span class="text-indigo-600 transition-transform duration-300" :class="{ 'rotate-180': open === 4 }"> <svg class="w-6 h-6" fill="none" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"></path></svg> </span> </button> <div x-show="open === 4" x-collapse x-cloak class="pb-6"> <p class="text-slate-600"> Ya, kami melayani pengantaran dan penjemputan...</p> </div> </div>
            </div>
        </div>
    </div>

</x-app-layout>
