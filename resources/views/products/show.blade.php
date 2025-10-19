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
                                <p class="text-sm text-gray-500">per hari</p>
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

                    <div class="mt-10">
                        @if($product->stock > 0)
                            {{-- MODIFIKASI: Warna tombol diubah menjadi ungu --}}
                            <a href="{{ route('booking.create', $product) }}" class="w-full block text-center bg-purple-600 text-white text-lg font-bold py-4 rounded-lg shadow-md hover:bg-purple-700 transition-colors duration-300">
                                Sewa Sekarang
                            </a>
                        @else
                            <button class="w-full block text-center bg-gray-400 text-white text-lg font-semibold py-4 rounded-lg cursor-not-allowed" disabled>
                                Stok Habis
                            </button>
                        @endif
                    </div>
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
