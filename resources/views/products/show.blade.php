<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Produk: {{ $product->name }}
        </h2>
    </x-slot>

    <div class="bg-white">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
            {{-- Bagian Produk Utama --}}
            {{-- MODIFIKASI: Mengubah perbandingan kolom grid --}}
            <div class="grid grid-cols-1 md:grid-cols-5 gap-12 items-start">

                {{-- Kolom Kiri: Gambar Produk (Dibuat lebih besar) --}}
                <div class="md:col-span-3 flex justify-center">
                    @if($product->image)
                        <img class="w-full h-auto rounded-lg object-contain shadow-lg" src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                    @else
                        <div class="w-full h-96 bg-gray-200 rounded-lg flex items-center justify-center">
                            <span class="text-gray-500">Gambar tidak tersedia</span>
                        </div>
                    @endif
                </div>

                {{-- Kolom Kanan: Detail, Harga, dan Aksi (Dibuat lebih kecil) --}}
                <div class="md:col-span-2">
                    <h1 class="text-4xl font-bold text-gray-900">{{ $product->name }}</h1>
                    <p class="mt-4 text-gray-600 leading-relaxed">{{ $product->description }}</p>

                    <div class="mt-8">
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Harga Sewa</h3>
                        <div class="flex items-end space-x-4">
                            <div>
                                {{-- MODIFIKASI: Warna harga diubah menjadi ungu --}}
                                <p class="text-3xl font-bold text-purple-600">Rp {{ number_format($product->price_per_day) }}</p>

                                <p class="text-sm text-gray-500 mb-2">per hari</p>

                                {{-- KODE STATUS KETERSEDIAAN --}}
                                @if($product->stock > 0)
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                        <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                            <path clip-rule="evenodd" fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16Zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"></path>
                                        </svg>
                                        Tersedia
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                        <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                            <path clip-rule="evenodd" fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z"></path>
                                        </svg>
                                        Stok Kosong
                                    </span>
                                @endif
                                {{-- BATAS KODE STATUS --}}
                            </div>
                        </div>
                    </div>

                    <div class="mt-8">
                        <h3 class="text-lg font-semibold text-gray-800">Fasilitas Termasuk</h3>
                        <ul class="list-disc list-inside text-gray-600 mt-2">
                            <li>Kabel Charger</li>
                            <li>Casing Pelindung</li>
                        </ul>
                    </div>

                    {{--
                      MODIFIKASI LOGIKA TOMBOL SEWA
                      Kita tambahkan pengecekan untuk role admin
                    --}}
                    <div class="mt-10">
                        @if($product->stock <= 0)
                            {{-- 1. Jika Stok Habis, tombol mati untuk semua --}}
                            <button class="w-full block text-center bg-gray-400 text-white text-lg font-semibold py-4 rounded-lg cursor-not-allowed" disabled>
                                Stok Habis
                            </button>
                        @elseif(auth()->check() && auth()->user()->role == 'admin')
                            {{-- 2. Jika Stok Ada, TAPI user adalah admin, tombol mati --}}
                            <button class="w-full block text-center bg-purple-300 text-white text-lg font-bold py-4 rounded-lg cursor-not-allowed"
                                    disabled title="Admin tidak dapat melakukan pemesanan">
                                Admin Tidak Bisa Memesan
                            </button>
                        @else
                            {{-- 3. Jika Stok Ada & user BUKAN admin (atau guest), tombol aktif --}}
                            <a href="{{ route('booking.create', $product) }}" class="w-full block text-center bg-purple-600 text-white text-lg font-bold py-4 rounded-lg shadow-md hover:bg-purple-700 transition-colors duration-300">
                                Sewa Sekarang
                            </a>
                        @endif
                    </div>
                    {{-- BATAS MODIFIKASI --}}

                </div>
            </div>

            {{-- Bagian Informasi Detail --}}
            {{-- MODIFIKASI: Warna latar diubah menjadi ungu muda --}}
            <div class="mt-16 pt-12 border-t bg-purple-50 p-8 rounded-lg">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="md:col-span-1">
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">Kondisi Unit</h2>
                        <div class="space-y-4 text-gray-600">
                            <p>Unit yang kami sediakan hadir dengan kondisi fisik mulus dan performa optimal. Semua perangkat menggunakan baterai yang sehat dan siap digunakan kapan saja.</p>
                        </div>
                    </div>

                    <div class="md:col-span-2">
                        @if($product->specifications)
                            <table class="min-w-full">
                                <tbody>
                                    @foreach($product->specifications as $spec => $value)
                                    <tr class="border-b">
                                        <td class="py-3 pr-4 font-medium text-gray-500">{{ $spec }}</td>
                                        <td class="py-3 font-semibold text-gray-800">{{ $value }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
