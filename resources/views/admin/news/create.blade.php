<x-app-layout> {{-- Membungkus halaman dengan layout utama aplikasi (AppLayout). --}}
    <x-slot name="header"> {{-- Mendefinisikan slot 'header' untuk bagian judul di atas halaman. --}}
        <h2 class="font-semibold text-xl font-bold text-gray-800"> {{-- Judul halaman dengan font tebal dan warna
            abu-abu gelap. --}}
            {{ __('Tambah Berita Baru') }} {{-- Menampilkan teks judul yang mendukung fitur terjemahan. --}}
        </h2> {{-- Penutup tag h2. --}}
    </x-slot> {{-- Penutup slot header. --}}

    <div class="py-12"> {{-- Container utama dengan padding vertikal (atas-bawah) sebesar 12 satuan. --}}
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8"> {{-- Mengatur lebar maksimum konten (4xl) agar lebih sempit dari
            dashboard, rata tengah. --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg"> {{-- Kotak kartu (card)
                dengan latar putih/gelap, shadow, dan sudut membulat. --}}
                <div class="p-6 md:p-8 text-gray-900 dark:text-gray-100"> {{-- Container isi form dengan padding yang
                    responsif (lebih besar di layar medium). --}}

                    {{-- {{-- Menampilkan error validasi jika ada --}} {{-- Komentar asli Anda: Penjelasan blok error.
                    --}}
                    @if ($errors->any()) {{-- Logika Blade: Mengecek apakah ada error validasi dari controller. --}}
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6"
                            role="alert"> {{-- Kotak alert berwarna merah untuk menampilkan pesan error. --}}
                            <strong class="font-bold">Oops!</strong> {{-- Teks tebal "Oops!" sebagai pembuka pesan error.
                            --}}
                            <span class="block sm:inline">Ada beberapa masalah dengan input Anda.</span> {{-- Pesan umum
                            bahwa input bermasalah. --}}
                            <ul class="mt-3 list-disc list-inside"> {{-- Membuka list (daftar) error dengan bullet points.
                                --}}
                                @foreach ($errors->all() as $error) {{-- Melakukan looping untuk setiap pesan error yang
                                    ada. --}}
                                    <li>{{ $error }}</li> {{-- Menampilkan teks pesan error dalam item list. --}}
                                @endforeach {{-- Mengakhiri looping error. --}}
                            </ul> {{-- Penutup list error. --}}
                        </div> {{-- Penutup div alert error. --}}
                    @endif {{-- Mengakhiri logika pengecekan error. --}}

                    <form action="{{ route('admin.news-items.store') }}" method="POST" enctype="multipart/form-data">
                        {{-- Form pembuka: Mengarah ke route store, metode POST, mendukung upload file (multipart). --}}
                        @csrf {{-- Token keamanan CSRF (Wajib untuk semua form POST di Laravel). --}}
                        <div class="space-y-6"> {{-- Memberikan jarak vertikal (margin-top) antar elemen form sebesar 6
                            satuan. --}}

                            <div> {{-- Wrapper untuk input Judul. --}}
                                <label for="title" class="block text-sm font-medium">Judul Berita</label> {{-- Label
                                untuk field judul. --}}
                                <input type="text" name="title" id="title" value="{{ old('title') }}" required
                                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                {{-- Input text judul: me-retain value lama (old), required, dengan styling Tailwind
                                lengkap. --}}
                            </div> {{-- Penutup wrapper input Judul. --}}

                            <div> {{-- Wrapper untuk input URL Link. --}}
                                <label for="link_url" class="block text-sm font-medium">URL Tautan Berita (Link
                                    Eksternal)</label> {{-- Label untuk field URL. --}}
                                <input type="url" name="link_url" id="link_url" value="{{ old('link_url') }}" required
                                    placeholder="https://contohberita.com/..."
                                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                {{-- Input tipe URL: validasi format URL, required, ada placeholder, me-retain value
                                lama. --}}
                            </div> {{-- Penutup wrapper input URL. --}}

                            <div> {{-- Wrapper untuk input Deskripsi. --}}
                                <label for="description" class="block text-sm font-medium">Deskripsi Singkat</label>
                                {{-- Label untuk field deskripsi. --}}
                                <textarea name="description" id="description" rows="3" required
                                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('description') }}</textarea>
                                {{-- Textarea deskripsi: tinggi 3 baris, required, isi default dari input lama (old).
                                --}}
                            </div> {{-- Penutup wrapper input Deskripsi. --}}

                            <div> {{-- Wrapper untuk input Gambar. --}}
                                <label for="image" class="block text-sm font-medium">Gambar Berita</label> {{-- Label
                                untuk field upload gambar. --}}
                                <input type="file" name="image" id="image" required
                                    class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 dark:file:bg-indigo-900 file:text-indigo-700 dark:file:text-indigo-300 hover:file:bg-indigo-100 dark:hover:file:bg-indigo-800">
                                {{-- Input file: styling khusus untuk tombol "Choose File" menggunakan class `file:...`.
                                --}}
                            </div> {{-- Penutup wrapper input Gambar. --}}

                            <div class="flex items-center justify-end space-x-4 pt-4 border-t dark:border-gray-700">
                                {{-- Wrapper tombol aksi: Flexbox, rata kanan, ada garis pemisah atas (border-t). --}}
                                <a href="{{ route('admin.news-items.index') }}"
                                    class="bg-gray-200 dark:bg-gray-600 hover:bg-gray-300 dark:hover:bg-gray-500 text-gray-800 dark:text-gray-200 font-bold py-2 px-4 rounded-md">
                                    {{-- Tombol Batal: Berupa link kembali ke halaman index, warna abu-abu. --}}
                                    Batal {{-- Teks tombol batal. --}}
                                </a> {{-- Penutup link batal. --}}
                                <button type="submit"
                                    class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-md">
                                    {{-- Tombol Submit: Warna indigo utama, font tebal. --}}
                                    Simpan Berita {{-- Teks tombol simpan. --}}
                                </button> {{-- Penutup tombol submit. --}}
                            </div> {{-- Penutup wrapper tombol aksi. --}}
                        </div> {{-- Penutup div spacing form. --}}
                    </form> {{-- Penutup tag form. --}}
                </div> {{-- Penutup container isi form. --}}
            </div> {{-- Penutup card utama. --}}
        </div> {{-- Penutup wrapper max-width. --}}
    </div> {{-- Penutup wrapper padding utama. --}}
</x-app-layout> {{-- Penutup komponen layout aplikasi. --}}