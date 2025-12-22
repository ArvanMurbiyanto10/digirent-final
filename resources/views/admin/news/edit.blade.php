<x-app-layout> {{-- Menggunakan layout utama aplikasi sebagai pembungkus halaman. --}}
    <x-slot name="header"> {{-- Membuka slot header untuk menempatkan judul halaman. --}}
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"> {{-- Judul halaman dengan
            styling font tebal dan warna responsif (terang/gelap). --}}
            {{ __('Edit Berita') }}: {{ $newsItem->title }} {{-- Menampilkan teks 'Edit Berita' diikuti dengan judul
            berita yang sedang diedit. --}}
        </h2> {{-- Penutup tag judul h2. --}}
    </x-slot> {{-- Penutup slot header. --}}

    <div class="py-12"> {{-- Container utama dengan padding vertikal (atas-bawah) 12 satuan. --}}
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8"> {{-- Wrapper pembatas lebar maksimum (4xl) agar form tidak
            terlalu lebar, rata tengah. --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg"> {{-- Kartu background
                putih/gelap dengan bayangan dan sudut membulat. --}}
                <div class="p-6 md:p-8 text-gray-900 dark:text-gray-100"> {{-- Area konten di dalam kartu dengan padding
                    yang nyaman. --}}

                    {{-- {{-- Menampilkan error validasi jika ada --}} {{-- Komentar asli Anda: Penjelasan blok error.
                    --}}
                    @if ($errors->any()) {{-- Mengecek apakah ada error validasi yang dikirim dari controller. --}}
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6"
                            role="alert"> {{-- Container alert merah untuk menampilkan daftar error. --}}
                            <strong class="font-bold">Oops!</strong> {{-- Teks tebal pembuka peringatan error. --}}
                            <span class="block sm:inline">Ada beberapa masalah dengan input Anda.</span> {{-- Pesan umum
                            kesalahan input. --}}
                            <ul class="mt-3 list-disc list-inside"> {{-- List dengan bullet points untuk rincian error. --}}
                                @foreach ($errors->all() as $error) {{-- Loop untuk setiap pesan error yang ada. --}}
                                    <li>{{ $error }}</li> {{-- Menampilkan item pesan error. --}}
                                @endforeach {{-- Mengakhiri loop error. --}}
                            </ul> {{-- Penutup list error. --}}
                        </div> {{-- Penutup div alert. --}}
                    @endif {{-- Mengakhiri blok pengecekan error. --}}

                    {{-- {{-- Form menunjuk ke route 'update' dan menggunakan method 'PUT' --}} {{-- Komentar asli Anda:
                    Penjelasan form update. --}}
                    <form action="{{ route('admin.news-items.update', $newsItem) }}" method="POST"
                        enctype="multipart/form-data"> {{-- Tag Form: Arah aksi ke route update dengan parameter ID
                        berita, method POST (HTML default). --}}
                        @csrf {{-- Token keamanan CSRF wajib untuk form Laravel. --}}
                        @method('PUT') {{-- {{-- PENTING untuk update --}} {{-- Directive Blade untuk memalsukan method
                        menjadi PUT (standar RESTful update). --}}

                        <div class="space-y-6"> {{-- Memberikan jarak vertikal antar elemen form sebesar 6 satuan. --}}

                            <div> {{-- Wrapper input Judul. --}}
                                <label for="title" class="block text-sm font-medium">Judul Berita</label> {{-- Label
                                input judul. --}}
                                {{-- {{-- Menampilkan data lama menggunakan old() atau $newsItem->title --}} {{--
                                Komentar asli Anda: Penjelasan pengisian nilai value. --}}
                                <input type="text" name="title" id="title" value="{{ old('title', $newsItem->title) }}"
                                    required
                                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                {{-- Input Judul: value diisi old input atau data dari database ($newsItem->title). --}}
                            </div> {{-- Penutup wrapper input Judul. --}}

                            <div> {{-- Wrapper input URL. --}}
                                <label for="link_url" class="block text-sm font-medium">URL Tautan Berita (Link
                                    Eksternal)</label> {{-- Label input URL. --}}
                                <input type="url" name="link_url" id="link_url"
                                    value="{{ old('link_url', $newsItem->link_url) }}" required
                                    placeholder="https://contohberita.com/..."
                                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                {{-- Input URL: value diisi old input atau data database, tipe url untuk validasi
                                browser. --}}
                            </div> {{-- Penutup wrapper input URL. --}}

                            <div> {{-- Wrapper input Deskripsi. --}}
                                <label for="description" class="block text-sm font-medium">Deskripsi Singkat</label>
                                {{-- Label input deskripsi. --}}
                                <textarea name="description" id="description" rows="3" required
                                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('description', $newsItem->description) }}</textarea>
                                {{-- Textarea: Isi diapit tag textarea, mengambil dari old atau database. --}}
                            </div> {{-- Penutup wrapper input Deskripsi. --}}

                            <div> {{-- Wrapper input Gambar. --}}
                                <label for="image" class="block text-sm font-medium">Ganti Gambar (Opsional)</label>
                                {{-- Label input gambar. --}}
                                <input type="file" name="image" id="image"
                                    class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 dark:file:bg-indigo-900 file:text-indigo-700 dark:file:text-indigo-300 hover:file:bg-indigo-100 dark:hover:file:bg-indigo-800">
                                {{-- Input File: Tidak required karena update gambar opsional. Styling tombol file
                                custom. --}}
                                <p class="text-xs text-gray-500 mt-2">Kosongkan jika tidak ingin mengganti gambar.</p>
                                {{-- Pesan bantuan kecil di bawah input. --}}

                                {{-- {{-- Menampilkan gambar saat ini --}} {{-- Komentar asli Anda: Penanda bagian
                                preview gambar. --}}
                                @if ($newsItem->image_path) {{-- Mengecek apakah berita ini sudah memiliki gambar
                                    sebelumnya. --}}
                                    <div class="mt-4"> {{-- Container preview gambar dengan margin atas. --}}
                                        <p class="text-sm font-medium mb-2">Gambar Saat Ini:</p> {{-- Label preview. --}}
                                        <img src="{{ Storage::url($newsItem->image_path) }}" alt="Gambar lama"
                                            class="h-20 w-auto rounded-md"> {{-- Menampilkan gambar thumbnail dari storage.
                                        --}}
                                    </div> {{-- Penutup container preview. --}}
                                @endif {{-- Mengakhiri cek gambar. --}}
                            </div> {{-- Penutup wrapper input Gambar. --}}

                            <div class="flex items-center justify-end space-x-4 pt-4 border-t dark:border-gray-700">
                                {{-- Bagian tombol aksi: Flexbox, rata kanan, garis batas atas. --}}
                                <a href="{{ route('admin.news-items.index') }}"
                                    class="bg-gray-200 dark:bg-gray-600 hover:bg-gray-300 dark:hover:bg-gray-500 text-gray-800 dark:text-gray-200 font-bold py-2 px-4 rounded-md">
                                    {{-- Tombol Batal: Link kembali ke index. --}}
                                    Batal {{-- Teks tombol batal. --}}
                                </a> {{-- Penutup tag link batal. --}}
                                <button type="submit"
                                    class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-md">
                                    {{-- Tombol Submit: Menyimpan perubahan. --}}
                                    Simpan Perubahan {{-- Teks tombol simpan. --}}
                                </button> {{-- Penutup tag button simpan. --}}
                            </div> {{-- Penutup container tombol aksi. --}}
                        </div> {{-- Penutup div spacing form. --}}
                    </form> {{-- Penutup tag form. --}}
                </div> {{-- Penutup container konten padding. --}}
            </div> {{-- Penutup card utama. --}}
        </div> {{-- Penutup wrapper max-width. --}}
    </div> {{-- Penutup wrapper padding utama. --}}
</x-app-layout> {{-- Penutup komponen layout. --}}