<x-app-layout> {{-- Menggunakan komponen layout utama aplikasi. --}}
    <x-slot name="header"> {{-- Membuka slot 'header' untuk judul halaman. --}}
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"> {{-- Styling judul halaman:
            font tebal, ukuran XL, warna adaptif (gelap/terang). --}}
            {{ __('Tambah Produk Baru') }} {{-- Menampilkan teks judul "Tambah Produk Baru" yang mendukung terjemahan.
            --}}
        </h2> {{-- Penutup tag judul h2. --}}
    </x-slot> {{-- Penutup slot header. --}}

    <div class="py-12"> {{-- Wrapper utama dengan padding vertikal (atas-bawah) sebesar 12 satuan. --}}
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8"> {{-- Mengatur lebar maksimum konten (4xl) dan rata tengah. --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg"> {{-- Kotak (card) dengan
                background putih/gelap, shadow, dan sudut membulat. --}}
                <div class="p-6 md:p-8 text-gray-900 dark:text-gray-100"> {{-- Container isi form dengan padding yang
                    responsif. --}}

                    {{-- {{-- Menampilkan error validasi jika ada --}} {{-- Komentar asli Anda: Penanda blok error
                    validasi. --}}
                    @if ($errors->any()) {{-- Logika Blade: Mengecek apakah ada error validasi dari controller. --}}
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6"
                            role="alert"> {{-- Alert box merah untuk menampilkan pesan kesalahan. --}}
                            <strong class="font-bold">Oops!</strong> {{-- Teks tebal "Oops!" sebagai perhatian awal. --}}
                            <span class="block sm:inline">Ada beberapa masalah dengan input Anda.</span> {{-- Pesan umum
                            kesalahan input. --}}
                            <ul class="mt-3 list-disc list-inside"> {{-- Membuka daftar (list) kesalahan dengan bullet
                                points. --}}
                                @foreach ($errors->all() as $error) {{-- Melakukan looping semua pesan error yang ada. --}}
                                    <li>{{ $error }}</li> {{-- Menampilkan pesan error per baris. --}}
                                @endforeach {{-- Mengakhiri loop error. --}}
                            </ul> {{-- Penutup tag ul. --}}
                        </div> {{-- Penutup div alert error. --}}
                    @endif {{-- Mengakhiri logika pengecekan error. --}}

                    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data"> {{--
                        Tag Form: Mengarah ke route store, method POST, mendukung upload file (multipart). --}}
                        @csrf {{-- Token keamanan CSRF (Wajib untuk semua form POST di Laravel). --}}
                        <div class="space-y-6"> {{-- Memberikan jarak vertikal (spacing) antar elemen form sebesar 6
                            satuan. --}}

                            <div> {{-- Wrapper untuk input Nama Produk. --}}
                                <label for="name" class="block text-sm font-medium">Nama Produk</label> {{-- Label input
                                nama. --}}
                                <input type="text" name="name" id="name" value="{{ old('name') }}" required
                                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                {{-- Input text: value diambil dari old input (jika gagal validasi), required. --}}
                            </div> {{-- Penutup wrapper input Nama Produk. --}}

                            <div> {{-- Wrapper untuk input Kategori. --}}
                                <label for="category_id" class="block text-sm font-medium">Kategori</label> {{-- Label
                                input kategori. --}}
                                <select name="category_id" id="category_id" required
                                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    {{-- Dropdown select untuk memilih kategori. --}}
                                    <option value="">Pilih Kategori</option> {{-- Opsi default placeholder. --}}
                                    @foreach ($categories as $category) {{-- Loop melalui data kategori yang dikirim
                                        dari controller. --}}
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}> {{-- Opsi kategori: Mengecek apakah opsi ini yang dipilih
                                            sebelumnya (old input). --}}
                                            {{ $category->name }} {{-- Menampilkan nama kategori. --}}
                                        </option> {{-- Penutup tag option. --}}
                                    @endforeach {{-- Mengakhiri loop kategori. --}}
                                </select> {{-- Penutup tag select. --}}
                            </div> {{-- Penutup wrapper input Kategori. --}}

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6"> {{-- Menggunakan Grid Layout: 1 kolom di
                                HP, 2 kolom di layar medium (MD). --}}
                                <div> {{-- Wrapper kolom 1: Harga. --}}
                                    <label for="price_per_day" class="block text-sm font-medium">Harga / Hari
                                        (Rp)</label> {{-- Label input harga. --}}
                                    <input type="number" name="price_per_day" id="price_per_day"
                                        value="{{ old('price_per_day') }}" required
                                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    {{-- Input number: untuk harga, mempertahankan nilai lama (old). --}}
                                </div> {{-- Penutup wrapper kolom 1. --}}
                                <div> {{-- Wrapper kolom 2: Stok. --}}
                                    <label for="stock" class="block text-sm font-medium">Stok</label> {{-- Label input
                                    stok. --}}
                                    <input type="number" name="stock" id="stock" value="{{ old('stock') }}" required
                                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    {{-- Input number: untuk stok, mempertahankan nilai lama (old). --}}
                                </div> {{-- Penutup wrapper kolom 2. --}}
                            </div> {{-- Penutup div Grid. --}}

                            <div> {{-- Wrapper untuk input Deskripsi. --}}
                                <label for="description" class="block text-sm font-medium">Deskripsi</label> {{-- Label
                                input deskripsi. --}}
                                <textarea name="description" id="description" rows="4" required
                                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('description') }}</textarea>
                                {{-- Textarea: 4 baris, isi default diambil dari old('description'). --}}
                            </div> {{-- Penutup wrapper input Deskripsi. --}}

                            <div> {{-- Wrapper untuk input Gambar. --}}
                                <label for="image" class="block text-sm font-medium">Gambar Produk</label> {{-- Label
                                input gambar. --}}
                                <input type="file" name="image" id="image" required
                                    class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                                {{-- Input file: Wajib diisi (required), styling tombol 'choose file' menggunakan
                                Tailwind. --}}
                            </div> {{-- Penutup wrapper input Gambar. --}}

                            <div class="flex items-center justify-end space-x-4 pt-4 border-t dark:border-gray-700">
                                {{-- Wrapper tombol aksi: Flexbox rata kanan, ada garis batas atas. --}}
                                <a href="{{ route('admin.products.index') }}"
                                    class="bg-gray-200 dark:bg-gray-600 hover:bg-gray-300 dark:hover:bg-gray-500 text-gray-800 dark:text-gray-200 font-bold py-2 px-4 rounded-md">
                                    {{-- Tombol Batal: Berupa link kembali ke index produk. --}}
                                    Batal {{-- Teks tombol batal. --}}
                                </a> {{-- Penutup tag link batal. --}}
                                <button type="submit"
                                    class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-md">
                                    {{-- Tombol Submit: Warna indigo utama, font tebal. --}}
                                    Simpan Produk {{-- Teks tombol simpan. --}}
                                </button> {{-- Penutup tag button submit. --}}
                            </div> {{-- Penutup wrapper tombol aksi. --}}
                        </div> {{-- Penutup div spacing form. --}}
                    </form> {{-- Penutup tag form. --}}
                </div> {{-- Penutup container konten padding. --}}
            </div> {{-- Penutup card utama. --}}
        </div> {{-- Penutup wrapper max-width. --}}
    </div> {{-- Penutup wrapper padding utama. --}}
</x-app-layout> {{-- Penutup komponen layout aplikasi. --}}