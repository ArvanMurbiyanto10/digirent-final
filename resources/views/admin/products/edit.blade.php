<x-app-layout> {{-- Menggunakan komponen layout utama aplikasi (AppLayout) sebagai pembungkus. --}}
    <x-slot name="header"> {{-- Membuka slot 'header' untuk menempatkan judul di bagian atas. --}}
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"> {{-- Styling judul: font
            tebal, ukuran XL, warna adaptif. --}}
            Edit Produk: {{ $product->name }} {{-- Menampilkan teks 'Edit Produk' diikuti nama produk yang sedang
            diedit. --}}
        </h2> {{-- Penutup tag judul h2. --}}
    </x-slot> {{-- Penutup slot header. --}}

    <div class="py-12"> {{-- Wrapper utama dengan padding vertikal (atas-bawah) 12 satuan. --}}
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8"> {{-- Container max-width 4xl (lebih sempit dari dashboard), rata
            tengah. --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg"> {{-- Card container:
                Background putih/gelap, shadow, sudut bulat. --}}
                <div class="p-6 md:p-8 text-gray-900 dark:text-gray-100"> {{-- Area konten padding 6 (atau 8 di layar
                    medium), teks kontras. --}}

                    {{-- {{-- Menampilkan error validasi jika ada --}} {{-- Komentar asli Anda: Penanda blok error
                    validasi. --}}
                    @if ($errors->any()) {{-- Mengecek apakah ada error validasi yang dikirim dari controller. --}}
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6"
                            role="alert"> {{-- Alert box merah untuk pesan error. --}}
                            <strong class="font-bold">Oops!</strong> {{-- Teks tebal perhatian. --}}
                            <span class="block sm:inline">Ada beberapa masalah dengan input Anda.</span> {{-- Pesan umum
                            error input. --}}
                            <ul class="mt-3 list-disc list-inside"> {{-- Membuka list error dengan bullet points. --}}
                                @foreach ($errors->all() as $error) {{-- Loop setiap pesan error. --}}
                                    <li>{{ $error }}</li> {{-- Menampilkan pesan error per item. --}}
                                @endforeach {{-- Mengakhiri loop error. --}}
                            </ul> {{-- Penutup list. --}}
                        </div> {{-- Penutup alert box. --}}
                    @endif {{-- Mengakhiri blok pengecekan error. --}}

                    <form action="{{ route('admin.products.update', $product) }}" method="POST"
                        enctype="multipart/form-data"> {{-- Tag Form: Arah ke route update (bawa parameter product),
                        Method POST. --}}
                        @csrf {{-- Token keamanan CSRF wajib untuk form Laravel. --}}
                        @method('PUT') {{-- {{-- PENTING: Method untuk proses update --}} {{-- Directive Blade untuk
                        memalsukan method POST menjadi PUT (standar RESTful update). --}}

                        <div class="space-y-6"> {{-- Memberikan jarak vertikal antar elemen form sebesar 6 satuan. --}}

                            <div> {{-- Wrapper input Nama Produk. --}}
                                <label for="name" class="block text-sm font-medium">Nama Produk</label> {{-- Label untuk
                                input nama. --}}
                                <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}"
                                    required
                                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                {{-- Input Text: Value prioritas old input, jika tidak ada ambil dari $product->name.
                                --}}
                            </div> {{-- Penutup wrapper input Nama. --}}

                            <div> {{-- Wrapper input Kategori. --}}
                                <label for="category_id" class="block text-sm font-medium">Kategori</label> {{-- Label
                                untuk input kategori. --}}
                                <select name="category_id" id="category_id" required
                                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    {{-- Dropdown select kategori. --}}
                                    @foreach ($categories as $category) {{-- Loop semua kategori untuk opsi dropdown.
                                        --}}
                                        <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}> {{-- Opsi: Tandai
                                            'selected' jika ID cocok dengan old input atau data database. --}}
                                            {{ $category->name }} {{-- Menampilkan nama kategori. --}}
                                        </option> {{-- Penutup tag option. --}}
                                    @endforeach {{-- Mengakhiri loop kategori. --}}
                                </select> {{-- Penutup tag select. --}}
                            </div> {{-- Penutup wrapper input Kategori. --}}

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6"> {{-- Layout Grid: 1 kolom (HP), 2 kolom
                                (Medium ke atas). --}}
                                <div> {{-- Kolom 1: Harga. --}}
                                    <label for="price_per_day" class="block text-sm font-medium">Harga / Hari
                                        (Rp)</label> {{-- Label input harga. --}}
                                    <input type="number" name="price_per_day" id="price_per_day"
                                        value="{{ old('price_per_day', $product->price_per_day) }}" required
                                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    {{-- Input Number: Value dari old atau database, required. --}}
                                </div> {{-- Penutup kolom 1. --}}
                                <div> {{-- Kolom 2: Stok. --}}
                                    <label for="stock" class="block text-sm font-medium">Stok</label> {{-- Label input
                                    stok. --}}
                                    <input type="number" name="stock" id="stock"
                                        value="{{ old('stock', $product->stock) }}" required
                                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    {{-- Input Number: Value dari old atau database, required. --}}
                                </div> {{-- Penutup kolom 2. --}}
                            </div> {{-- Penutup div grid. --}}

                            <div> {{-- Wrapper input Deskripsi. --}}
                                <label for="description" class="block text-sm font-medium">Deskripsi</label> {{-- Label
                                input deskripsi. --}}
                                <textarea name="description" id="description" rows="4" required
                                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('description', $product->description) }}</textarea>
                                {{-- Textarea: Isi value diambil dari old atau $product->description. --}}
                            </div> {{-- Penutup wrapper input Deskripsi. --}}

                            <div> {{-- Wrapper input Gambar. --}}
                                <label for="image" class="block text-sm font-medium">Ganti Gambar Produk
                                    (Opsional)</label> {{-- Label input gambar. --}}
                                <input type="file" name="image" id="image"
                                    class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                                {{-- Input File: Tidak required (opsional saat edit). --}}
                                <p class="text-xs text-gray-500 mt-1">Kosongkan jika tidak ingin mengganti gambar.</p>
                                {{-- Pesan bantuan (hint). --}}
                                @if($product->image) {{-- Mengecek apakah produk ini memiliki gambar di database. --}}
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="Gambar saat ini"
                                        class="mt-4 h-32 w-32 object-cover rounded-md"> {{-- Menampilkan preview gambar saat
                                    ini dari storage. --}}
                                @endif {{-- Penutup blok if gambar. --}}
                            </div> {{-- Penutup wrapper input Gambar. --}}

                            <div class="flex items-center justify-end space-x-4 pt-4 border-t dark:border-gray-700">
                                {{-- Container tombol aksi: Rata kanan, border atas. --}}
                                <a href="{{ route('admin.products.index') }}"
                                    class="bg-gray-200 dark:bg-gray-600 hover:bg-gray-300 dark:hover:bg-gray-500 text-gray-800 dark:text-gray-200 font-bold py-2 px-4 rounded-md">
                                    {{-- Tombol Batal: Link kembali ke index. --}}
                                    Batal {{-- Teks tombol batal. --}}
                                </a> {{-- Penutup link batal. --}}
                                <button type="submit"
                                    class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-md">
                                    {{-- Tombol Submit: Simpan perubahan. --}}
                                    Simpan Perubahan {{-- Teks tombol simpan. --}}
                                </button> {{-- Penutup button submit. --}}
                            </div> {{-- Penutup container tombol. --}}
                        </div> {{-- Penutup div spacing form. --}}
                    </form> {{-- Penutup tag form. --}}
                </div> {{-- Penutup container isi form. --}}
            </div> {{-- Penutup card utama. --}}
        </div> {{-- Penutup wrapper max-width. --}}
    </div> {{-- Penutup wrapper padding utama. --}}
</x-app-layout> {{-- Penutup komponen layout. --}}