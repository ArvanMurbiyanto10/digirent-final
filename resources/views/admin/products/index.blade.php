<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl font-bold text-gray-800">
            {{ __('Kelola Produk') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    {{-- Menampilkan pesan sukses --}}
                    @if (session('success'))
                        <div class="bg-green-100 dark:bg-green-900/50 border-l-4 border-green-500 text-green-700 dark:text-green-300 p-4 mb-6"
                            role="alert">
                            <p>{{ session('success') }}</p>
                        </div>
                    @endif

                    {{-- PERBAIKAN #1: Tombol "Tambah Produk Baru" yang benar --}}
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-2xl font-bold">Daftar Produk</h3>
                        <a href="{{ route('admin.products.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-md">
                            + Tambah Produk Baru
                        </a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white dark:bg-gray-800">
                            <thead class="bg-gray-100 dark:bg-gray-700">
                                <tr>
                                    <th class="py-3 px-4 text-left">Nama Produk</th>
                                    <th class="py-3 px-4 text-left">Kategori</th>
                                    <th class="py-3 px-4 text-left">Harga/Hari</th>
                                    <th class="py-3 px-4 text-center">Stok</th>
                                    <th class="py-3 px-4 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse ($products as $product)
                                    <tr>
                                        <td class="py-4 px-4 flex items-center">
                                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                                class="w-16 h-16 object-cover rounded-md mr-4">
                                            <span class="font-medium">{{ $product->name }}</span>
                                        </td>
                                        <td class="py-4 px-4">{{ $product->category->name }}</td>
                                        <td class="py-4 px-4">Rp {{ number_format($product->price_per_day) }}</td>
                                        <td class="py-4 px-4 text-center">{{ $product->stock }}</td>
                                        <td class="py-4 px-4 text-center">

                                            {{-- PERBAIKAN #2: Tombol "Edit" yang benar, diletakkan di dalam loop --}}
                                            <a href="{{ route('admin.products.edit', $product) }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400">Edit</a>

                                            <span class="text-gray-300 dark:text-gray-600 mx-1">|</span>

                                            <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-400 font-medium">
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
