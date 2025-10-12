@extends('layouts.app')

@section('content')
<div class="bg-slate-50 min-h-screen flex items-center">
    <div class="container mx-auto px-4 py-12">

        <div class="max-w-2xl mx-auto bg-white p-8 md:p-10 rounded-xl shadow-lg">

            {{-- ... (Pesan Sukses tidak perlu diubah) ... --}}
            @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg mb-8" role="alert">
                    <p class="font-bold">Pesanan Berhasil Dibuat!</p>
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-gray-800">Bukti Pesanan Anda</h1>
                <p class="text-gray-500 mt-2">Satu langkah lagi untuk menyelesaikan pesanan Anda.</p>
            </div>

            {{-- Detail Struk --}}
            <div class="border-2 border-dashed rounded-lg p-6 space-y-4 mb-8">
                <div class="flex justify-between">
                    <span class="font-semibold text-gray-500">No. Pesanan</span>
                    <span class="font-bold text-gray-800">#{{ $booking->id }}</span>
                </div>

                {{-- === TAMBAHKAN BLOK INI === --}}
                <div class="flex justify-between">
                    <span class="font-semibold text-gray-500">Nama Penyewa</span>
                    <span class="font-bold text-gray-800">{{ $booking->user->name }}</span>
                </div>
                {{-- ========================= --}}

                <hr>
                <div class="flex justify-between">
                    <span class="font-semibold text-gray-500">Produk</span>
                    <span class="font-bold text-gray-800">{{ $booking->product->name }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="font-semibold text-gray-500">Tanggal Mulai</span>
                    <span class="font-medium text-gray-800">{{ \Carbon\Carbon::parse($booking->start_date)->format('d M Y, H:i') }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="font-semibold text-gray-500">Tanggal Selesai</span>
                    <span class="font-medium text-gray-800">{{ \Carbon\Carbon::parse($booking->end_date)->format('d M Y, H:i') }}</span>
                </div>
                <hr>
                <div class="flex justify-between text-xl">
                    <span class="font-bold text-gray-800">Total Pembayaran</span>
                    <span class="font-bold text-indigo-600">Rp {{ number_format($booking->total_price) }}</span>
                </div>
            </div>

            {{-- ... (Tombol Aksi tidak perlu diubah) ... --}}
            <div class="text-center space-y-4">
                <a href="{{ $whatsappLink }}" target="_blank" class="inline-flex items-center justify-center w-full md:w-auto bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-8 rounded-lg text-lg transition-colors">
                    <svg class="w-6 h-6 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10.01 2.005a8.003 8.003 0 00-7.865 9.478l-.63 2.265a.666.666 0 00.798.798l2.265-.63a8.003 8.003 0 105.432-12.21zM5.18 12.39a6.67 6.67 0 01-1.2-4.145 6.665 6.665 0 0110.88-4.992 6.665 6.665 0 01-1.393 10.563l-1.932.515-.366 1.285.515-1.932a6.67 6.67 0 01-6.504-1.294zm3.11-1.428a.563.563 0 00-.78.113l-.545.717a.563.563 0 01-.78.113 4.493 4.493 0 01-2.22-2.22.563.563 0 01.113-.78l.717-.545a.563.563 0 00.113-.78 4.493 4.493 0 01-1.11-2.655.563.563 0 00-.65-.545L4.44 5.33a.563.563 0 00-.432.532c-.015.22-.015.447.06.667.333.932.84 1.78 1.5 2.53.66.75 1.498 1.258 2.43 1.59.22.075.447.075.667.06a.563.563 0 00.532-.432l.27-.99a.563.563 0 00-.545-.65 4.493 4.493 0 01-2.655-1.11z"></path></svg>
                    Lanjutkan via WhatsApp
                </a>
                <a href="{{ route('booking.downloadInvoice', $booking->id) }}" class="inline-flex items-center justify-center w-full md:w-auto bg-gray-700 hover:bg-gray-800 text-white font-bold py-3 px-8 rounded-lg text-lg transition-colors">
                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                    Download Bukti Pesanan
                </a>
            </div>

        </div>
    </div>
</div>
@endsection
