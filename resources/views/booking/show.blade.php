<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Bukti Pesanan Anda
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 md:p-12 text-gray-900 dark:text-gray-100">

                    <div class="text-center">
                        {{-- Ikon Struk --}}
                        <svg class="w-16 h-16 mx-auto text-indigo-500 mb-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                        </svg>

                        <h1 class="text-3xl font-bold mb-2">Invoice Pesanan</h1>
                        <p class="text-gray-500 dark:text-gray-400 mb-4">Berikut adalah rincian pesanan Anda.</p>

                        {{-- Status Pesanan --}}
                        <p class="text-lg font-semibold mb-8">
                            Status Pesanan:
                            <span class="px-3 py-1 rounded-full text-sm
                                @if($booking->status == 'pending')
                                    bg-yellow-100 text-yellow-800
                                @elseif($booking->status == 'confirmed')
                                    bg-green-100 text-green-800
                                @else
                                    bg-red-100 text-red-800
                                @endif
                            ">
                                @if($booking->status == 'pending')
                                    Menunggu Pembayaran
                                @elseif($booking->status == 'confirmed')
                                    Telah Dikonfirmasi
                                @else
                                    Dibatalkan
                                @endif
                            </span>
                        </p>
                    </div>

                    {{-- Detail Struk Pesanan --}}
                    <div class="border-2 border-dashed dark:border-gray-700 rounded-lg p-6 space-y-4 mb-10">
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
                            <span class="font-bold text-indigo-600 dark:text-indigo-400">Rp {{ number_format($booking->total_price) }}</span>
                        </div>
                    </div>

                    {{-- Tombol Aksi --}}
                    <div class="text-center flex flex-wrap justify-center gap-4">

                        {{-- Tombol Lanjutkan Pembayaran (Hanya muncul jika status pending) --}}
                        @if ($booking->status == 'pending')
                            <button id="pay-button" class="w-full md:w-auto inline-block bg-purple-600 text-white font-semibold py-3 px-8 rounded-lg hover:bg-purple-700 transition-colors">
                                Lanjutkan Pembayaran
                            </button>
                        @endif

                        <a href="{{ route('booking.downloadInvoice', $booking) }}" target="_blank" class="w-full md:w-auto inline-block bg-gray-700 text-white font-semibold py-3 px-8 rounded-lg hover:bg-gray-800 transition-colors">
                            Download Struk (PDF)
                        </a>

                        {{-- [PERBAIKAN WARNA] Tombol abu-abu diganti tema Indigo --}}
                        <a href="{{ route('dashboard') }}" class="w-full md:w-auto inline-block bg-indigo-100 text-indigo-700 font-semibold py-3 px-8 rounded-lg hover:bg-indigo-200 dark:bg-indigo-900 dark:text-indigo-200 dark:hover:bg-indigo-800 transition-colors">
                            Kembali ke Dashboard
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{--
      [PERBAIKAN FUNGSI KLIK]
      Semua skrip kita letakkan di sini dengan urutan yang benar.
    --}}
    @push('scripts')

        {{-- 1. PERTAMA: Definisikan fungsi 'pemicu' nya --}}
        <script type="text/javascript">
            function attachSnapListener() {
                // Fungsi ini HANYA akan berjalan SETELAH snap.js SIAP
                var payButton = document.getElementById('pay-button');

                if (payButton) {
                    payButton.addEventListener('click', function () {
                        // 'snap' di sini PASTI sudah ada
                        window.snap.pay('{{ $booking->snap_token }}', {
                          onSuccess: function(result){
                            window.location.href = '{{ route("booking.success", $booking) }}';
                          },
                          onPending: function(result){
                            alert("Menunggu pembayaran!");
                          },
                          onError: function(result){
                            alert("Pembayaran gagal!");
                          },
                          onClose: function(){
                            // Tidak perlu alert
                          }
                        });
                    });
                }
            }
        </script>

        {{-- 2. KEDUA: Muat library Midtrans dan tambahkan 'onload' untuk memanggil fungsi di atas --}}
        <script type="text/javascript"
          src="https://app.sandbox.midtrans.com/snap/snap.js"
          data-client-key="{{ config('midtrans.client_key') }}"
          onload="attachSnapListener()" {{-- Ini adalah kuncinya --}}
        ></script>
    @endpush
</x-app-layout>
