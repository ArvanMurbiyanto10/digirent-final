<x-app-layout>
    {{-- Banner Gradasi --}}
    <div class="text-center bg-gradient-to-r from-indigo-500 via-purple-600 to-pink-600 py-20 px-6 shadow-xl">
        <h1 class="text-4xl sm:text-5xl font-black text-white leading-tight tracking-tight">
            Katalog <span class="text-purple-200">Gadget</span> Pilihan
        </h1>
        <p class="mt-4 text-lg text-purple-100 max-w-2xl mx-auto">
            Temukan dan sewa perangkat impianmu untuk segala kebutuhan, mulai dari pekerjaan hingga hiburan.
        </p>
    </div>

    {{-- Konten Utama dengan Latar Belakang Putih --}}
    <div class="bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-16">

            {{-- Kolom Pencarian --}}
            <div class="mb-8 max-w-lg mx-auto">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" /></svg>
                    </div>
                    <input type="text" id="search-input" placeholder="Cari produk (misal: iPhone 15 Pro)..." class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-full shadow-sm focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition bg-white text-gray-900">
                </div>
            </div>

            {{-- Filter Kategori --}}
            <div class="flex justify-center flex-wrap gap-2 sm:gap-4 mb-12 pb-2">
                <button class="filter-btn active" data-filter="all">Semua</button>
                @foreach ($categories as $category)
                    <button class="filter-btn" data-filter="{{ $category->name }}">{{ $category->name }}</button>
                @endforeach
            </div>

            {{-- Grid Produk --}}
            <div id="product-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @forelse ($products as $product)
                    <div class="product-card bg-white rounded-xl shadow-md overflow-hidden group transition-all duration-300 hover:shadow-2xl hover:-translate-y-2" data-category="{{ $product->category->name }}" data-name="{{ $product->name }}">
                        <div class="relative">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-56 object-cover transition-transform duration-300 group-hover:scale-110">
                            {{-- ... (Badge Kategori & Stok) ... --}}
                        </div>
                        <div class="p-5 flex flex-col">
                                <h3 class="text-lg font-bold text-gray-800 truncate group-hover:text-purple-600 transition-colors duration-300">{{ $product->name }}</h3>
                            <p class="text-sm text-gray-500 mt-1 h-10">{{ Str::limit($product->description, 50) }}</p>
                            <div class="mt-4 pt-4 border-t border-gray-100">
                                <span class="text-2xl font-bold text-gray-900">Rp {{ number_format($product->price_per_day) }}</span>
                                <span class="text-sm text-gray-500">/ hari</span>
                            </div>
                            <a href="{{ route('products.show', $product) }}" class="flex items-center justify-center w-full bg-purple-600 text-white py-2.5 rounded-lg mt-4 font-semibold hover:bg-purple-700 transition-all duration-300">Lihat Detail</a>
                        </div>
                    </div>
                @empty
                    <p class="col-span-full text-center text-gray-500 text-lg">Saat ini belum ada produk yang tersedia.</p>
                @endforelse
            </div>
        </div>
    </div>

    @push('styles')
        <style>
            /* --- PERUBAHAN PADA TOMBOL FILTER --- */
            .filter-btn {
                padding: 0.6rem 1.5rem;
                font-weight: 600;
                color: #4b5563;
                border-radius: 9999px;
                border: 2px solid #e5e7eb;
                background-color: white;
                /* Tambahkan transisi untuk semua properti */
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            }
            .filter-btn:hover {
                color: #7e22ce;
                border-color: #d8b4fe; /* Warna border ungu muda saat hover */
                transform: translateY(-2px);
            }
            .filter-btn.active {
                color: white;
                border-color: #9333ea;
                background-color: #9333ea;
                box-shadow: 0 4px 12px rgba(147, 51, 234, 0.3);
                /* Tambahkan efek scaling agar tombol aktif lebih menonjol */
                transform: scale(1.05);
            }

            /* --- PERUBAHAN PADA KARTU PRODUK DAN ANIMASI --- */
            .product-card {
                /* Tambahkan transisi untuk opacity dan transform agar fade-out terlihat */
                transition: opacity 0.3s ease, transform 0.4s ease;
            }
            .product-card.hidden {
                display: none;
            }
            .product-card.is-hiding {
                /* State sementara saat kartu akan disembunyikan */
                opacity: 0;
                transform: scale(0.95);
            }
            .animate-in {
                /* Animasi baru saat kartu muncul */
                animation: cardEnter 0.5s cubic-bezier(0.4, 0, 0.2, 1) forwards;
            }
            @keyframes cardEnter {
                from {
                    opacity: 0;
                    transform: translateY(20px) scale(0.98);
                }
                to {
                    opacity: 1;
                    transform: translateY(0) scale(1);
                }
            }
        </style>
    @endpush

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const filterButtons = document.querySelectorAll('.filter-btn');
                const allProductCards = document.querySelectorAll('.product-card');
                const searchInput = document.getElementById('search-input');
                let searchDebounce;

                function applyFilters() {
                    const categoryFilter = document.querySelector('.filter-btn.active').getAttribute('data-filter');
                    const searchTerm = searchInput.value.toLowerCase();

                    // --- LOGIKA ANIMASI BARU ---

                    // 1. Tandai kartu mana yang akan hilang
                    allProductCards.forEach(card => {
                        const categoryMatch = categoryFilter === 'all' || card.getAttribute('data-category') === categoryFilter;
                        const searchMatch = card.getAttribute('data-name').toLowerCase().includes(searchTerm);

                        if (!categoryMatch || !searchMatch) {
                            card.classList.add('is-hiding'); // Tambahkan kelas untuk fade-out
                        } else {
                            card.classList.remove('is-hiding');
                        }
                    });

                    // 2. Tunggu animasi fade-out selesai, baru sembunyikan dan tampilkan yang baru
                    setTimeout(() => {
                        let visibleCards = [];
                        allProductCards.forEach(card => {
                            if (card.classList.contains('is-hiding')) {
                                card.classList.add('hidden');
                            } else {
                                card.classList.remove('hidden');
                                visibleCards.push(card);
                            }
                        });

                        // 3. Terapkan animasi masuk (fade-in) secara berurutan
                        visibleCards.forEach((card, index) => {
                            card.style.animationDelay = `${index * 75}ms`;
                            card.classList.remove('animate-in');
                            void card.offsetWidth; // Memicu reflow
                            card.classList.add('animate-in');
                        });
                    }, 300); // Waktu (ms) harus cocok dengan durasi transisi di CSS
                }

                filterButtons.forEach(button => {
                    button.addEventListener('click', function () {
                        filterButtons.forEach(btn => btn.classList.remove('active'));
                        this.classList.add('active');
                        applyFilters();
                    });
                });

                searchInput.addEventListener('input', function() {
                    clearTimeout(searchDebounce);
                    searchDebounce = setTimeout(applyFilters, 300);
                });

                // Terapkan animasi saat halaman pertama kali dimuat
                allProductCards.forEach((card, index) => {
                    card.style.animationDelay = `${index * 100}ms`;
                    card.classList.add('animate-in');
                });
            });
        </script>
    @endpush
</x-app-layout>
