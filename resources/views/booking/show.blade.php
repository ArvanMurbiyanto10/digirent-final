<x-app-layout>
    <x-slot name="header">
        <h2 class="w-full text-center font-bold text-3xl text-gray-800 leading-tight">
            Bukti Pesanan Anda
        </h2>
    </x-slot>

    {{-- Latar belakang halaman dipaksa jadi bg-gray-100 --}}
    <div class="py-12 bg-gray-100">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            {{-- Kotak invoice utama berwarna putih --}}
            <div class="bg-white overflow-hidden shadow-lg rounded-lg">
                <div class="p-8 text-gray-900">

                    <div class="text-center">
                        {{-- Ikon Struk --}}
                        <svg class="w-16 h-16 mx-auto text-indigo-600 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>

                        <h1 class="text-3xl font-bold mb-2">Invoice Pesanan</h1>
                        <p class="text-gray-500 mb-6">Berikut adalah rincian pesanan Anda.</p>

                        <p class="text-lg font-semibold mb-8 text-gray-800">
                            Status Pesanan:
                            <span class="px-3 py-1 text-sm font-semibold rounded-full
                                {{-- Logika Warna Status --}}
                                @if($booking->status == 'pending')
                                    bg-yellow-500 text-white
                                @elseif($booking->status == 'confirmed')
                                    bg-green-500 text-white
                                @else
                                    bg-red-500 text-white
                                @endif
                            ">
                                {{-- Logika Teks Status --}}
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

                    {{-- Detail Struk Clean --}}
                    <div class="mt-6">
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">Detail Pesanan</h3>
                        <div class="space-y-3">
                            <div class="flex justify-between text-gray-700">
                                <span class="font-semibold">No. Pesanan</span>
                                <span class="font-medium text-gray-900">#{{ $booking->id }}</span>
                            </div>
                            <div class="flex justify-between text-gray-700">
                                <span class="font-semibold">Nama Penyewa</span>
                                <span class="font-medium text-gray-900">{{ $booking->user->name }}</span>
                            </div>
                            <div class="flex justify-between text-gray-700">
                                <span class="font-semibold">Produk</span>
                                <span class="font-medium text-gray-900">{{ $booking->product->name }}</span>
                            </div>
                            <div class="flex justify-between text-gray-700">
                                <span class="font-semibold">Tanggal Mulai</span>
                                <span class="font-medium text-gray-900">{{ $booking->start_date->format('d M Y, H:i') }}</span>
                            </div>
                            <div class="flex justify-between text-gray-700">
                                <span class="font-semibold">Tanggal Selesai</span>
                                <span class="font-medium text-gray-900">{{ $booking->end_date->format('d M Y, H:i') }}</span>
                            </div>

                            {{-- Garis Pemisah untuk Total --}}
                            <div class="border-t border-gray-300 pt-3">
                                <div class="flex justify-between items-center text-gray-900">
                                    <span class="text-lg font-bold">Total Pembayaran</span>
                                    <span class="text-xl font-bold text-purple-600">
                                        Rp {{ number_format($booking->total_price) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Tombol Aksi (Logika Telah Diperbaiki) --}}
                    <div class="mt-8">
                        <div class="flex flex-col sm:flex-row sm:justify-center sm:space-x-4 space-y-3 sm:space-y-0">

                            {{-- KUNCI 1: Tombol hanya tampil jika status pending DAN snap_token ada --}}
                            @if ($booking->status == 'pending' && $booking->snap_token)
                                <button id="pay-button" class="w-full sm:w-auto inline-block bg-purple-600 text-white font-semibold py-3 px-8 rounded-lg hover:bg-purple-700 transition-colors">
                                    Lanjutkan Pembayaran
                                </button>
                            @elseif ($booking->status == 'confirmed')
                                <a href="{{ route('booking.downloadInvoice', $booking) }}" target="_blank" class="w-full sm:w-auto inline-block text-center bg-gray-700 text-white font-semibold py-3 px-8 rounded-lg hover:bg-gray-800 transition-colors">
                                    Download Struk (PDF)
                                </a>
                            @endif

                            {{-- Tombol Kembali ke Dashboard --}}
                            <a href="{{ route('dashboard') }}" class="w-full sm:w-auto inline-block text-center
                                @if($booking->status == 'pending')
                                    bg-gray-500 hover:bg-gray-600
                                @else
                                    bg-purple-600 hover:bg-purple-700
                                @endif
                                text-white font-semibold py-3 px-8 rounded-lg transition-colors">
                                Kembali ke Dashboard
                            </a>

                            {{-- Tombol Chat Admin (WA) --}}
                            <a href="https://wa.me/6285175394607?text=Halo%20Admin%20DigiRent%2C%0A%0ASaya%20ingin%20bertanya%20mengenai%20pesanan%20%23{{ $booking->id ?? '...' }}%0AProduk%3A%20{{ $booking->product->name ?? '...' }}%0A%0ATerima%20kasih."
                               target="_blank"
                               class="w-full sm:w-auto inline-block text-center px-6 py-3 bg-green-600 text-white font-semibold rounded-lg shadow-md hover:bg-green-700 transition-colors duration-300">
                                <svg class="w-5 h-5 inline-block mr-1 -mt-1" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.0-6.556 5.333-11.891 11.893-11.891 3.181.001 6.167 1.24 8.417 3.488 2.249 2.248 3.487 5.235 3.487 8.417 0 6.556-5.333 11.89-11.893 11.89h-.001c-2.096 0-4.14-.545-5.947-1.587L.057 24zm6.591-3.803c.333.19.734.306 1.15.306.282 0 .56-.039.83-.118.27-.08.529-.19.776-.328.247-.138.48-.303.696-.493.216-.19.42-.408.611-.644.191-.236.36-.502.506-.784.146-.282.256-.589.329-.906.073-.317.111-.644.111-.971 0-.327-.038-.654-.111-.971-.073-.317-.183-.624-.329-.906-.146-.282-.315-.548-.506-.784-.191-.236-.395-.454-.611-.644-.216-.19-.449-.355-.696-.493-.247-.138-.506-.248-.776-.328-.27-.08-.548-.118-.83-.118-.416 0-.817.116-1.15.306-.333.19-.64.41-.913.66-.273.25-.516.529-.728.831-.212.302-.396.63-.546.98-.15.35-.27.717-.354 1.1-.084.383-.128.78-.128 1.18 0 .4.044.797.128 1.18.084.383.204.75.354 1.1.15.35.334.678.546.98.212.302.455.581.728.831.273.25.58.47.913.66zM11.893 2.951c-4.903 0-8.891 3.988-8.891 8.893 0 1.961.638 3.805 1.772 5.304L3.12 21.01l3.018-1.584c1.449.954 3.141 1.464 4.896 1.464h.001c4.903 0 8.891-3.988 8.891-8.893 0-4.904-3.988-8.893-8.891-8.893z"/>
                                </svg>
                                Chat Admin (WA)
                            </a>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- KUNCI 2: Blok Script Lengkap di Bawah --}}
    @push('scripts')
        {{-- Fungsi ini akan dipanggil oleh 'onload' di bawah --}}
        <script type="text/javascript">
            function attachSnapListener() {
                var payButton = document.getElementById('pay-button');

                if (payButton) {
                    payButton.addEventListener('click', function () {
                        // Ubah tombol jadi loading
                        payButton.disabled = true;
                        payButton.innerHTML = 'Memuat...';

                        // Panggil Snap
                        window.snap.pay('{{ $booking->snap_token }}', {
                            onSuccess: function(result){
                                // Arahkan ke halaman sukses
                                window.location.href = '{{ route("booking.success", $booking) }}';
                            },
                            onPending: function(result){
                                alert("Menunggu pembayaran Anda!");
                                // Kembalikan tombol seperti semula
                                payButton.disabled = false;
                                payButton.innerHTML = 'Lanjutkan Pembayaran';
                            },
                            onError: function(result){
                                alert("Pembayaran gagal! Silakan coba lagi.");
                                // Kembalikan tombol seperti semula
                                payButton.disabled = false;
                                payButton.innerHTML = 'Lanjutkan Pembayaran';
                            },
                            onClose: function(){
                                // Pop-up ditutup, kembalikan tombol seperti semula
                                payButton.disabled = false;
                                payButton.innerHTML = 'Lanjutkan Pembayaran';
                            }
                        });
                    });
                }
            }
        </script>

        {{-- KUNCI 3: Script Midtrans (TYPO DIPERBAIKI) --}}
        {{-- Ini hanya akan di-load jika $booking->snap_token ada --}}
        @if ($booking->snap_token)
            <script
                src="https://app.sandbox.midtrans.com/snap/snap.js"
                data-client-key="{{ config('midtrans.client_key') }}"
                onload="attachSnapListener()"
            ></script>
            {{-- 'onload' akan memanggil fungsi 'attachSnapListener' SETELAH script ini selesai di-load --}}
        @endif
    @endpush

</x-app-layout>
