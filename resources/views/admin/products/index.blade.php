<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl font-bold text-indigo-800">
            {{ __('Kelola Produk') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{--
              KOTAK UTAMA: Tetap PUTIH BERSIH
            --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    @if (session('success'))
                        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6"
                            role="alert">
                            <p>{{ session('success') }}</p>
                        </div>
                    @endif

                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-2xl font-bold">Daftar Produk</h3>

                        {{-- TOMBOL AKSEN: Tetap Indigo --}}
                        <a href="{{ route('admin.products.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-md shadow-md transition duration-300">
                            + Tambah Produk Baru
                        </a>
                    </div>

                    {{--
                      PERUBAHAN DI SINI:
                      Kita tambahkan shadow dan rounded-lg di wrapper tabel
                    --}}
                    <div class="overflow-x-auto shadow-md rounded-lg">
                        <table class="min-w-full bg-white">
                            {{--
                              PERUBAHAN "TIDAK POLOS":
                              Header tabel diubah dari gray-100 menjadi indigo-100 (biru muda)
                              Teks header diubah dari gray-500 menjadi indigo-800 (biru tua)
                            --}}
                            <thead class="bg-indigo-100">
                                <tr>
                                    <th class="py-3 px-4 text-left text-xs font-medium text-indigo-800 uppercase tracking-wider">Nama Produk</th>
                                    <th class="py-3 px-4 text-left text-xs font-medium text-indigo-800 uppercase tracking-wider">Kategori</th>
                                    <th class="py-3 px-4 text-left text-xs font-medium text-indigo-800 uppercase tracking-wider">Harga/Hari</th>
                                    <th class="py-3 px-4 text-center text-xs font-medium text-indigo-800 uppercase tracking-wider">Stok</th>
                                    <th class="py-3 px-4 text-center text-xs font-medium text-indigo-800 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse ($products as $product)
                                    <tr>
                                        <td class="py-4 px-4 flex items-center">
                                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                                class="w-16 h-16 object-cover rounded-md mr-4">
                                            <span class="font-medium text-gray-900">{{ $product->name }}</span>
                                        </td>
                                        <td class="py-4 px-4 text-sm text-gray-700">{{ $product->category->name }}</td>
                                        <td class="py-4 px-4 text-sm text-gray-700">Rp {{ number_format($product->price_per_day) }}</td>
                                        <td class="py-4 px-4 text-center text-sm text-gray-700">{{ $product->stock }}</td>
                                        <td class="py-4 px-4 text-center">

                                            {{-- LINK AKSEN: Tetap Indigo --}}
                                            <a href="{{ route('admin.products.edit', $product) }}" class="text-indigo-600 hover:text-indigo-900 font-medium">Edit</a>

                                            <span class="text-gray-300 mx-1">|</span>

                                            <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900 font-medium">
                                                    Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-10 text-gray-500">
                                            Belum ada produk. Silakan tambahkan produk baru.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
