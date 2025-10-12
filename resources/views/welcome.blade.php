<x-app-layout>

    {{-- Fitur Notifikasi Animasi Setelah Login/Register --}}
    @if (session('status') === 'just-logged-in')
        <div
            x-data="{ show: true }"
            x-init="setTimeout(() => show = false, 4000)"
            x-show="show"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform translate-x-4"
            x-transition:enter-end="opacity-100 transform translate-x-0"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed top-20 right-5 bg-white border-l-4 border-green-500 text-slate-700 p-4 rounded-lg shadow-xl z-50"
            role="alert">

            <div class="flex items-center">
                <div class="text-green-500 mr-3">
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <p class="font-bold">Login Berhasil!</p>
                    <p class="text-sm">Selamat Datang kembali, {{ Auth::user()->name }}!</p>
                </div>
            </div>
        </div>
    @endif

    {{-- Hero Section --}}
    <div class="text-white bg-gradient-to-br from-indigo-800 via-purple-800 to-pink-800">
        <div class="container mx-auto px-6 py-24 text-center">
            <h1 class="text-5xl font-extrabold">Sewa Gadget Impianmu</h1>
            <p class="mt-4 text-lg text-slate-300">Handphone, Laptop terbaru siap menemanimu.</p>
            <a href="{{ route('products.index') }}"
                class="mt-8 inline-block bg-indigo-500 hover:bg-indigo-600 text-white font-bold py-3 px-6 rounded-lg transition duration-300">
                Lihat Semua Produk
            </a>
        </div>
    </div>

    {{-- Berita Gadget Terbaru Section --}}
    <div class="py-16 bg-slate-50">
        <div class="container mx-auto px-6">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-slate-800">Berita Gadget Terbaru</h2>
                <p class="text-gray-600 mt-2">Ikuti perkembangan teknologi terkini bersama kami.</p>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <div class="bg-white rounded-lg shadow-md overflow-hidden transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                    <a href="https://digital.viva.co.id/hp/4254-10-hp-dengan-sensor-kamera-1-inci-terbaik-2025-foto-setajam-dslr-bokeh-lebih-natural" target="_blank" class="flex h-full">
                        <img class="w-2/5 object-cover" src="{{ asset('images/berita/kamera-mobile.jpg') }}" alt="Kamera Smartphone 1 inci">
                        <div class="p-5 w-3/5 flex flex-col justify-center">
                            <h4 class="font-bold text-lg text-indigo-700">Era Baru Fotografi Mobile</h4>
                            <p class="text-gray-600 mt-2 text-sm">
                                Sensor kamera 1 inci kini menjadi tren, menjanjikan kualitas setara kamera profesional.
                            </p>
                        </div>
                    </a>
                </div>
                <div class="bg-white rounded-lg shadow-md overflow-hidden transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                    <a href="https://www.kompas.com/biz/read/2025/04/22/152921628/asus-luncurkan-laptop-berkapasitas-npu-45-tops-bisa-jalankan-program-ai-tanpa" target="_blank" class="flex h-full">
                        <img class="w-2/5 object-cover" src="{{ asset('images/berita/laptop-ai.jpg') }}" alt="Laptop dengan AI">
                        <div class="p-5 w-3/5 flex flex-col justify-center">
                            <h4 class="font-bold text-lg text-indigo-700">Laptop dengan Tenaga AI</h4>
                            <p class="text-gray-600 mt-2 text-sm">
                                Chipset terbaru dengan NPU terintegrasi membuat laptop lebih cepat dalam tugas-tugas berbasis AI.
                            </p>
                        </div>
                    </a>
                </div>
                <div class="bg-white rounded-lg shadow-md overflow-hidden transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                    <a href="https://www.antaranews.com/berita/4692253/intel-perluas-portofolio-prosesor-ai-intel-core-ultra-series-2" target="_blank" class="flex h-full">
                        <img class="w-2/5 object-cover" src="{{ asset('images/berita/xiaomi-rilis.jpg') }}" alt="Xiaomi Rilis">
                        <div class="p-5 w-3/5 flex flex-col justify-center">
                            <h4 class="font-bold text-lg text-indigo-700">Intel perluas portofolio prosesor AI Intel Core Ultra</h4>
                            <p class="text-gray-600 mt-2 text-sm">
                                Intel memperluas portofolio AI PC komersial dengan merilis prosesor Intel Core Ultra 200U, 200H, 200HX, dan 200S series beserta dengan Intel Core Ultra 200V series dalam ajang Mobile World Congress (MWC) 2025.
                            </p>
                        </div>
                    </a>
                </div>
                <div class="bg-white rounded-lg shadow-md overflow-hidden transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                    <a href="https://www.kompas.com/kalimantan-timur/read/2025/09/11/204500488/iphone-17-rilis-di-indonesia-awal-oktober-model-paling-tipis" target="_blank" class="flex h-full">
                        <img class="w-2/5 object-cover" src="{{ asset('images/berita/foldable-phone.jpg') }}" alt="Ponsel Lipat">
                        <div class="p-5 w-3/5 flex flex-col justify-center">
                            <h4 class="font-bold text-lg text-indigo-700">Masa Depan Layar Lipat</h4>
                            <p class="text-gray-600 mt-2 text-sm">
                                    Generasi terbaru dari Apple akan hadir di indonesia dengan peningkatan kamera signifikan dan bodi lebih tipis.
                            </p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Kenapa Memilih DigiRent Section --}}
    <div class="py-16 bg-white">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-3xl font-bold text-slate-800 mb-4">Kenapa Memilih DigiRent?</h2>
            <p class="text-gray-600 mb-12 max-w-2xl mx-auto">Kami menawarkan lebih dari sekadar penyewaan. Kami
                memberikan kemudahan, fleksibilitas, dan akses ke teknologi terkini tanpa beban.</p>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <div class="p-6">
                    <div class="text-indigo-600 w-16 h-16 mx-auto mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-800 mb-2">Hemat Biaya</h3>
                    <p class="text-gray-600">Gunakan gadget flagship tanpa perlu membelinya. Jauh lebih hemat untuk
                        kebutuhan jangka pendek atau sekadar mencoba.</p>
                </div>
                <div class="p-6">
                    <div class="text-indigo-600 w-16 h-16 mx-auto mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09zM18.259 8.715L18 9.75l-.259-1.035a3.375 3.375 0 00-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 002.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 002.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 00-2.456 2.456zM16.898 20.562L16.25 22.5l-.648-1.938a3.375 3.375 0 00-2.696-2.696L11.25 18l1.938-.648a3.375 3.375 0 002.696-2.696L16.25 13l.648 1.938a3.375 3.375 0 002.696 2.696L21 18l-1.938.648a3.375 3.375 0 00-2.696 2.696z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-800 mb-2">Selalu Up-to-date</h3>
                    <p class="text-gray-600">Ingin mencoba iPhone atau MacBook terbaru saat baru rilis? DigiRent selalu
                        menyediakan model-model paling mutakhir.</p>
                </div>
                <div class="p-6">
                    <div class="text-indigo-600 w-16 h-16 mx-auto mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-800 mb-2">Fleksibel & Mudah</h3>
                    <p class="text-gray-600">Proses pemesanan cepat dan sepenuhnya online. Sewa harian, mingguan, atau
                        bulanan sesuai kebutuhan Anda.</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
