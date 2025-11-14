<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Pembayaran Berhasil
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 md:p-12 text-gray-900 dark:text-gray-100">

                    <div class="text-center">
                        {{-- Ikon Ceklis --}}
                        <svg class="w-16 h-16 mx-auto text-green-500 mb-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <h1 class="text-3xl font-bold mb-2">Pembayaran Sukses!</h1>
                        <p class="text-gray-500 dark:text-gray-400 mb-8">Terima kasih, pesanan Anda telah dikonfirmasi. Berikut adalah rinciannya.</p>
                    </div>

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
                            <span class="font-bold text-indigo-600 dark:text-indigo-400">Rp {{ number_format($booking->total_price) }}</span>
                        </div>
                    </div>

                    {{-- Tombol Aksi --}}
                    {{-- MODIFIKASI: Mengganti div container dengan flex-wrap dan gap --}}
                    <div class="text-center flex flex-wrap justify-center gap-4">
                        <a href="{{ route('booking.downloadInvoice', $booking) }}" class="w-full md:w-auto inline-block bg-gray-700 text-white font-semibold py-3 px-8 rounded-lg hover:bg-gray-800 transition-colors">
                            Cetak Struk (PDF)
                        </a>
                        <a href="{{ $whatsappLink }}" target="_blank" class="w-full md:w-auto inline-block bg-green-500 text-white font-semibold py-3 px-8 rounded-lg hover:bg-green-600 transition-colors">
                            Lanjutkan via WhatsApp
                        </a>

                        {{-- KODE TAMBAHAN 1: Dashboard Pesanan --}}
                        <a href="{{ route('dashboard') }}" class="w-full md:w-auto inline-block bg-indigo-600 text-white font-semibold py-3 px-8 rounded-lg hover:bg-indigo-700 transition-colors">
                            Dashboard Pesanan
                        </a>

                        {{-- KODE TAMBAHAN 2: Kembali ke Home --}}
                        <a href="{{ route('home') }}" class="w-full md:w-auto inline-block bg-gray-200 text-gray-800 font-semibold py-3 px-8 rounded-lg hover:bg-gray-300 transition-colors">
                            Kembali ke Home
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
