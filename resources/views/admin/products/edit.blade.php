<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Edit Produk: {{ $product->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 md:p-8 text-gray-900 dark:text-gray-100">

                    {{-- Menampilkan error validasi jika ada --}}
                    @if ($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
                            <strong class="font-bold">Oops!</strong>
                            <span class="block sm:inline">Ada beberapa masalah dengan input Anda.</span>
                            <ul class="mt-3 list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT') {{-- PENTING: Method untuk proses update --}}

                        <div class="space-y-6">

                            <div>
                                <label for="name" class="block text-sm font-medium">Nama Produk</label>
                                <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" required class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>

                            <div>
                                <label for="category_id" class="block text-sm font-medium">Kategori</label>
                                <select name="category_id" id="category_id" required class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="price_per_day" class="block text-sm font-medium">Harga / Hari (Rp)</label>
                                    <input type="number" name="price_per_day" id="price_per_day" value="{{ old('price_per_day', $product->price_per_day) }}" required class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                </div>
                                <div>
                                    <label for="stock" class="block text-sm font-medium">Stok</label>
                                    <input type="number" name="stock" id="stock" value="{{ old('stock', $product->stock) }}" required class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                </div>
                            </div>

                            <div>
                                <label for="description" class="block text-sm font-medium">Deskripsi</label>
                                <textarea name="description" id="description" rows="4" required class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('description', $product->description) }}</textarea>
                            </div>

                            <div>
                                <label for="image" class="block text-sm font-medium">Ganti Gambar Produk (Opsional)</label>
                                <input type="file" name="image" id="image" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                                <p class="text-xs text-gray-500 mt-1">Kosongkan jika tidak ingin mengganti gambar.</p>
                                @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="Gambar saat ini" class="mt-4 h-32 w-32 object-cover rounded-md">
                                @endif
                            </div>

                            <div class="flex items-center justify-end space-x-4 pt-4 border-t dark:border-gray-700">
                                <a href="{{ route('admin.products.index') }}" class="bg-gray-200 dark:bg-gray-600 hover:bg-gray-300 dark:hover:bg-gray-500 text-gray-800 dark:text-gray-200 font-bold py-2 px-4 rounded-md">
                                    Batal
                                </a>
                                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-md">
                                    Simpan Perubahan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
