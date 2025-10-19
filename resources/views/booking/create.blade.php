<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Formulir Sewa: {{ $product->name }}
        </h2>
    </x-slot>

    {{-- 1. Memuat CSS untuk kalender Flatpickr --}}
    @push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    @endpush

    <div class="py-12 bg-gray-50">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 md:p-8">

                    <div class="flex items-center space-x-6 mb-8 pb-8 border-b">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-24 h-24 object-cover rounded-md shadow-md">
                        <div>
                            <p class="text-sm text-gray-500">Anda akan menyewa:</p>
                            <h4 class="text-2xl font-bold text-gray-800">{{ $product->name }}</h4>
                        </div>
                    </div>

                    <form action="{{ route('booking.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                        <div class="space-y-8">
                            <div>
                                <h2 class="text-xl font-semibold text-gray-700 mb-3">1. Atur Durasi & Waktu Sewa</h2>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label for="start_date" class="block text-sm font-medium text-gray-600">Mulai Sewa (Tanggal & Jam)</label>
                                        <input type="text" id="start_date" name="start_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500" placeholder="Pilih tanggal & waktu..." required>
                                    </div>
                                    <div>
                                        <label for="end_date" class="block text-sm font-medium text-gray-600">Selesai Sewa (Tanggal & Jam)</label>
                                        <input type="text" id="end_date" name="end_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500" placeholder="Pilih tanggal & waktu..." required>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <h2 class="text-xl font-semibold text-gray-700 mb-4">2. Rincian Pesanan</h2>
                                <div class="space-y-4 bg-purple-50 border-2 border-dashed border-purple-200 rounded-lg p-6">
                                    <div class="flex justify-between text-gray-600">
                                        <span>Harga per hari (24 jam)</span>
                                        <span id="harga_per_hari" data-price="{{ $product->price_per_day }}" class="font-medium">Rp {{ number_format($product->price_per_day) }}</span>
                                    </div>
                                    <div class="flex justify-between text-gray-600">
                                        <span>Durasi Sewa</span>
                                        <span id="rental_duration" class="font-medium">- hari</span>
                                    </div>
                                    <hr class="my-2 border-purple-200">
                                    <div class="flex justify-between text-xl font-bold text-gray-800">
                                        <span>Total Pembayaran</span>
                                        <span id="total_payment" class="text-purple-600">Rp 0</span>
                                    </div>
                                </div>
                            </div>

                            <div class="pt-4">
                                <button type="submit" id="submit_button" class="w-full text-white text-lg font-semibold py-3 rounded-lg shadow-md transition-colors duration-300 bg-purple-600 hover:bg-purple-700 disabled:bg-purple-300 disabled:cursor-not-allowed" disabled>
                                    Lanjutkan ke Pembayaran
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- 2. Memuat JS untuk Flatpickr dan logika kalkulasi --}}
    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const startDateEl = document.getElementById('start_date');
            const endDateEl = document.getElementById('end_date');
            const durationEl = document.getElementById('rental_duration');
            const totalEl = document.getElementById('total_payment');
            const submitButton = document.getElementById('submit_button');
            const hargaPerHariEl = document.getElementById('harga_per_hari');
            const pricePerDay = parseFloat(hargaPerHariEl.getAttribute('data-price'));

            function calculateAndUpdate() {
                const startDate = fpStart.selectedDates[0];
                const endDate = fpEnd.selectedDates[0];

                durationEl.textContent = '- hari';
                totalEl.textContent = 'Rp 0';
                submitButton.disabled = true;

                if (startDate && endDate && endDate > startDate) {
                    const diffTime = endDate.getTime() - startDate.getTime();
                    const diffHours = diffTime / (1000 * 3600);
                    const diffDays = diffHours > 0 ? Math.ceil(diffHours / 24) : 1;
                    const totalCost = diffDays * pricePerDay;

                    durationEl.textContent = `${diffDays} hari`;
                    totalEl.textContent = `Rp ${totalCost.toLocaleString('id-ID')}`;
                    submitButton.disabled = false;
                }
            }

            const flatpickrConfig = {
                enableTime: true,
                dateFormat: "Y-m-d H:i",
                minDate: "today",
                time_24hr: true,
            };

            const fpStart = flatpickr(startDateEl, {
                ...flatpickrConfig,
                onChange: function(selectedDates) {
                    if (selectedDates[0]) {
                        fpEnd.set('minDate', selectedDates[0]);
                    }
                    calculateAndUpdate();
                }
            });

            const fpEnd = flatpickr(endDateEl, {
                ...flatpickrConfig,
                onChange: calculateAndUpdate
            });
        });
    </script>
    @endpush
</x-app-layout>
