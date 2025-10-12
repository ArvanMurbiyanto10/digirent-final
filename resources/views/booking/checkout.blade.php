<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Konfirmasi & Pembayaran
        </h2>
    </x-slot>

    {{-- Script untuk Midtrans Snap --}}
    @push('scripts')
        <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
            data-client-key="{{ config('midtrans.client_key') }}"></script>
    @endpush

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 md:p-12 text-gray-900 dark:text-gray-100">

                    <h1 class="text-3xl font-bold text-center mb-2">Satu Langkah Lagi!</h1>
                    <p class="text-center text-gray-500 dark:text-gray-400 mb-8">Pesanan Anda berhasil dibuat. Silakan
                        selesaikan pembayaran untuk mengkonfirmasi pesanan Anda.</p>

                    {{-- Detail Struk Pesanan --}}
                    <div class="border-2 border-dashed dark:border-gray-700 rounded-lg p-6 space-y-4 mb-8">
                        <div class="flex justify-between">
                            <span class="font-semibold text-gray-500 dark:text-gray-400">No. Pesanan</span>
                            <span class="font-bold">#{{ $booking->id }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="font-semibold text-gray-500 dark:text-gray-400">Nama Penyewa</span>
                            <span class="font-bold">{{ $booking->user->name }}</span>
                        </div>
                        <hr class="dark:border-gray-700">
                        <div class="flex justify-between">
                            <span class="font-semibold text-gray-500 dark:text-gray-400">Produk</span>
                            <span class="font-bold">{{ $booking->product->name }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="font-semibold text-gray-500 dark:text-gray-400">Tanggal Mulai</span>
                            <span class="font-medium">{{ $booking->start_date->format('d M Y, H:i') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="font-semibold text-gray-500 dark:text-gray-400">Tanggal Selesai</span>
                            <span class="font-medium">{{ $booking->end_date->format('d M Y, H:i') }}</span>
                        </div>
                        <hr class="dark:border-gray-700">
                        <div class="flex justify-between text-xl">
                            <span class="font-bold">Total Pembayaran</span>
                            <span class="font-bold text-indigo-600 dark:text-indigo-400">Rp
                                {{ number_format($booking->total_price) }}</span>
                        </div>
                    </div>

                    {{-- Tombol Pembayaran --}}
                    <div class="text-center">
                        <button id="pay-button"
                            class="w-full md:w-auto inline-block bg-indigo-600 text-white text-lg font-semibold py-3 px-12 rounded-lg shadow-md hover:bg-indigo-700 transition-colors duration-300">
                            Bayar Sekarang
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- JavaScript untuk memanggil popup Midtrans --}}
    @push('scripts')
        <script type="text/javascript">
            // Ambil tombol pembayaran
            var payButton = document.getElementById('pay-button');
            payButton.addEventListener('click', function () {
                // Panggil snap.pay() dengan snapToken yang didapat dari controller
                window.snap.pay('{{ $snapToken }}', {
                    onSuccess: function (result) {
                        // Arahkan ke halaman struk pembayaran yang baru
                        window.location.href = '{{ route("booking.success", $booking) }}';
                    },
                    onPending: function (result) {
                        /* Anda bisa menambahkan logika di sini */
                        alert("Menunggu pembayaran!");
                    },
                    onError: function (result) {
                        /* Anda bisa menambahkan logika di sini */
                        alert("Pembayaran gagal!");
                    },
                    onClose: function () {
                        /* Pop-up ditutup tanpa menyelesaikan pembayaran */
                        alert('Anda menutup jendela pembayaran.');
                    }
                });
            });
        </script>
    @endpush
</x-app-layout>
