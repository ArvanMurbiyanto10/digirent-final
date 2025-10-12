<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Formulir Sewa: {{ $product->name }}
        </h2>
    </x-slot>

    {{-- Memuat CSS untuk kalender Flatpickr --}}
    @push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    @endpush

    <div class="py-12 bg-slate-50 dark:bg-gray-900">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 lg:gap-12">

                {{-- Kolom Kiri: Formulir --}}
                <div class="lg:col-span-2 bg-white dark:bg-gray-800 p-8 rounded-lg shadow-lg">
                    <form action="{{ route('booking.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                        <h1 class="text-4xl font-bold text-indigo-600 dark:text-indigo-400 mb-2">Formulir Sewa</h1>
                        <p class="text-gray-500 dark:text-gray-400 mb-8">Lengkapi detail di bawah untuk melanjutkan pesanan Anda.</p>

                        <div class="space-y-8">
                            {{-- 1. Atur Durasi & Waktu Sewa --}}
                            <div>
                                <h2 class="text-xl font-semibold text-gray-700 dark:text-gray-300 mb-3">1. Atur Durasi & Waktu Sewa</h2>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label for="start_date" class="block text-sm font-medium text-gray-600 dark:text-gray-400">Mulai Sewa (Tanggal & Jam)</label>
                                        <input type="text" id="start_date" name="start_date" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="Pilih tanggal & waktu..." required>
                                    </div>
                                    <div>
                                        <label for="end_date" class="block text-sm font-medium text-gray-600 dark:text-gray-400">Selesai Sewa (Tanggal & Jam)</label>
                                        <input type="text" id="end_date" name="end_date" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="Pilih tanggal & waktu..." required>
                                    </div>
                                </div>
                            </div>

                            {{-- 2. Rincian Pesanan (Akan terisi otomatis) --}}
                            <div>
                                <h2 class="text-xl font-semibold text-gray-700 dark:text-gray-300 mb-4">2. Rincian Pesanan</h2>
                                <div class="space-y-3 bg-indigo-50 dark:bg-indigo-900/20 border border-indigo-200 dark:border-indigo-800 p-6 rounded-lg">
                                    <div class="flex justify-between text-gray-600 dark:text-gray-400">
                                        <span>Harga per hari (24 jam)</span>
                                        <span id="harga_per_hari" data-price="{{ $product->price_per_day }}" class="font-medium">Rp {{ number_format($product->price_per_day) }}</span>
                                    </div>
                                    <div class="flex justify-between text-gray-600 dark:text-gray-400">
                                        <span>Durasi Sewa</span>
                                        <span id="rental_duration" class="font-medium">- hari</span>
                                    </div>
                                    <hr class="my-2 border-indigo-200 dark:border-indigo-800">
                                    <div class="flex justify-between text-2xl font-bold text-indigo-700 dark:text-indigo-400">
                                        <span>Total Pembayaran</span>
                                        <span id="total_payment">Rp 0</span>
                                    </div>
                                </div>
                            </div>

                            {{-- Tombol Aksi --}}
                            <div class="pt-4">
                                <button type="submit" id="submit_button" class="w-full text-white text-lg font-semibold py-3 rounded-lg shadow-md transition-colors duration-300 bg-indigo-600 hover:bg-indigo-700 disabled:bg-indigo-300 dark:disabled:bg-gray-600 disabled:cursor-not-allowed" disabled>
                                    Lanjutkan ke Pembayaran
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                {{-- Kolom Kanan: Ringkasan Produk --}}
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg self-start">
                    <h3 class="text-xl font-semibold text-gray-700 dark:text-gray-300 mb-4 border-b dark:border-gray-700 pb-3">Ringkasan Pesanan</h3>
                    <div class="flex items-center space-x-4">
                        @if ($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-24 h-24 object-cover rounded-md">
                        @else
                            <div class="w-24 h-24 bg-gray-200 dark:bg-gray-700 rounded-md flex items-center justify-center text-gray-500">?</div>
                        @endif
                        <div>
                            <h4 class="font-bold text-gray-800 dark:text-gray-200">{{ $product->name }}</h4>
                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $product->category->name }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Memuat library Flatpickr (JS) dan logika kalkulasi --}}
    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Mengambil elemen-elemen dari HTML
            const startDateEl = document.getElementById('start_date');
            const endDateEl = document.getElementById('end_date');
            const durationEl = document.getElementById('rental_duration');
            const totalEl = document.getElementById('total_payment');
            const submitButton = document.getElementById('submit_button');
            const hargaPerHariEl = document.getElementById('harga_per_hari');
            const pricePerDay = parseFloat(hargaPerHariEl.getAttribute('data-price'));

            // Fungsi utama untuk menghitung durasi dan total biaya
            function calculateAndUpdate() {
                const startDate = fpStart.selectedDates[0];
                const endDate = fpEnd.selectedDates[0];

                // Reset tampilan jika tanggal belum lengkap
                durationEl.textContent = '- hari';
                totalEl.textContent = 'Rp 0';
                submitButton.disabled = true;

                // Lakukan kalkulasi jika tanggal mulai dan selesai sudah diisi
                if (startDate && endDate && endDate > startDate) {
                    const diffTime = endDate.getTime() - startDate.getTime();
                    const diffHours = diffTime / (1000 * 3600);
                    const diffDays = diffHours > 0 ? Math.ceil(diffHours / 24) : 1;
                    const totalCost = diffDays * pricePerDay;

                    // Update tampilan dengan hasil kalkulasi
                    durationEl.textContent = `${diffDays} hari`;
                    totalEl.textContent = `Rp ${totalCost.toLocaleString('id-ID')}`;
                    submitButton.disabled = false;
                }
            }

            // Konfigurasi dasar untuk Flatpickr
            const flatpickrConfig = {
                enableTime: true,
                dateFormat: "Y-m-d H:i",
                minDate: "today",
                time_24hr: true,
            };

            // Inisialisasi Flatpickr untuk tanggal mulai
            const fpStart = flatpickr(startDateEl, {
                ...flatpickrConfig,
                onChange: function(selectedDates) {
                    if (selectedDates[0]) {
                        fpEnd.set('minDate', selectedDates[0]);
                    }
                    calculateAndUpdate();
                }
            });

            // Inisialisasi Flatpickr untuk tanggal selesai
            const fpEnd = flatpickr(endDateEl, {
                ...flatpickrConfig,
                onChange: calculateAndUpdate
            });
        });
    </script>
    @endpush
</x-app-layout>
