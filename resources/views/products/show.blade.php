<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Produk: {{ $product->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 md:p-12 text-gray-900">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-12">

                        {{-- Kolom Kiri: Gambar Produk --}}
                        <div>
                            {{-- PERBAIKAN: Cek jika gambar ada, jika tidak, tampilkan placeholder --}}
                            @if($product->image)
                                <img class="w-full h-auto rounded-lg object-cover shadow-lg" src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                            @else
                                <div class="w-full h-96 bg-gray-200 rounded-lg flex items-center justify-center">
                                    <span class="text-gray-500">Gambar tidak tersedia</span>
                                </div>
                            @endif
                        </div>

                        {{-- Kolom Kanan: Detail Produk --}}
                        <div>
                            <span class="text-sm font-medium text-indigo-600">{{ $product->category->name }}</span>
                            <h1 class="text-4xl font-bold text-gray-900 mt-2">{{ $product->name }}</h1>

                            <p class="text-2xl font-semibold text-gray-800 mt-4">
                                Rp {{ number_format($product->price_per_day, 0, ',', '.') }}
                                <span class="text-lg font-normal text-gray-500">/ hari</span>
                            </p>

                            <p class="mt-6 text-gray-600 leading-relaxed">{{ $product->description }}</p>

                            <div class="mt-8 border-t border-gray-200 pt-6">
                                <dl class="grid grid-cols-2 gap-x-4 gap-y-2 text-sm">
                                    <dt class="text-gray-500">Stok Tersedia</dt>
                                    <dd class="text-gray-800 font-medium">{{ $product->stock }} unit</dd>
                                </dl>
                            </div>

                            <div class="mt-8">
                                @if($product->stock > 0)
                                    <a href="{{ route('booking.create', $product) }}" class="w-full block text-center bg-indigo-600 text-white text-lg font-semibold py-3 rounded-lg shadow-md hover:bg-indigo-700 transition-colors duration-300">
                                        Sewa Sekarang
                                    </a>
                                @else
                                    <button class="w-full block text-center bg-gray-400 text-white text-lg font-semibold py-3 rounded-lg cursor-not-allowed" disabled>
                                        Stok Habis
                                    </button>
                                @endif
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
