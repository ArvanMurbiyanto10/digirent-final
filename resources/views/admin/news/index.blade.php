<x-app-layout> {{-- Menggunakan komponen layout utama aplikasi (AppLayout) sebagai pembungkus. --}}
    <x-slot name="header"> {{-- Membuka slot bernama 'header' untuk menempatkan judul di bagian atas layout. --}}
        {{-- {{-- --}}
        {{-- PERBAIKAN #1: --}} {{-- Komentar asli Anda: Catatan perbaikan nomor 1. --}}
        {{-- Kembalikan ke format <x-slot> yang benar. --}} {{-- Komentar asli Anda: Penjelasan mengenai format slot.
            --}}
            {{-- Teks diubah menjadi 'text-white' agar menyatu dengan header bar indigo. --}} {{-- Komentar asli Anda:
            Penjelasan mengenai perubahan warna teks. --}}
            {{-- --}} {{-- Penutup blok komentar asli. --}}
            <h2 class="font-semibold text-xl font-bold text-indigo-800"> {{-- Judul halaman dengan font tebal, ukuran
                XL, dan warna teks indigo-800 (sesuai request). --}}
                {{ __('Kelola Berita') }} {{-- Menampilkan teks "Kelola Berita" yang mendukung multibahasa. --}}
            </h2> {{-- Penutup tag H2. --}}
        </x-slot> {{-- Penutup slot header. --}}

        <div class="py-12"> {{-- Wrapper utama konten dengan padding vertikal (atas-bawah) sebesar 12 satuan. --}}
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8"> {{-- Container pembatas lebar (max-width 7xl), rata tengah
                (mx-auto), dengan padding horizontal. --}}
                {{-- {{-- --}}
                {{-- PERBAIKAN #2: Kotak luar diubah menjadi selalu PUTIH --}} {{-- Komentar asli Anda: Catatan
                perbaikan kotak background putih. --}}
                {{-- --}} {{-- Penutup komentar blok. --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg"> {{-- Kotak konten utama: Background
                    putih, konten meluap disembunyikan, bayangan, sudut bulat. --}}
                    {{-- {{-- --}}
                    {{-- PERBAIKAN #3: Teks di dalam kotak menjadi selalu HITAM/ABU --}} {{-- Komentar asli Anda:
                    Catatan perbaikan warna teks konten. --}}
                    {{-- --}} {{-- Penutup komentar blok. --}}
                    <div class="p-6 text-gray-900"> {{-- Area konten dalam dengan padding 6 dan warna teks abu-abu gelap
                        (kontras dengan putih). --}}
                        <div class="flex justify-between items-center mb-6"> {{-- Container Flexbox: Menyebar konten
                            (judul kiri, tombol kanan) dan rata tengah vertikal. --}}
                            <h3 class="text-2xl font-bold">Daftar Berita</h3> {{-- Sub-judul halaman "Daftar Berita"
                            dengan font besar dan tebal. --}}
                            {{-- {{-- Tombol "Tambah" --}} {{-- Komentar asli: Penanda tombol tambah. --}}
                            <a href="{{ route('admin.news-items.create') }}"
                                class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-md shadow-md transition duration-300">
                                {{-- Tombol Link menuju halaman Create: Warna indigo, ada efek hover, shadow, dan
                                transisi halus. --}}
                                + Tambah Berita Baru {{-- Teks tombol. --}}
                            </a> {{-- Penutup tag link tombol. --}}
                        </div> {{-- Penutup container flex header. --}}

                        @if (session('success')) {{-- Mengecek apakah ada flash message 'success' dari session (misal
                            setelah simpan data). --}}
                            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert"> {{--
                                Alert Box: Latar hijau muda, border kiri tebal, teks hijau tua. --}}
                                <p>{{ session('success') }}</p> {{-- Menampilkan isi pesan sukses. --}}
                            </div> {{-- Penutup alert box. --}}
                        @endif {{-- Mengakhiri blok pengecekan session. --}}

                        {{-- {{-- --}}
                        {{-- PERBAIKAN #4: Wrapper tabel diberi shadow dan rounded --}} {{-- Komentar asli Anda: Catatan
                        styling wrapper tabel. --}}
                        {{-- --}} {{-- Penutup komentar blok. --}}
                        <div class="overflow-x-auto shadow-md rounded-lg"> {{-- Wrapper Tabel: Scroll horizontal jika
                            layar kecil, ada shadow, dan sudut bulat. --}}
                            <table class="min-w-full bg-white"> {{-- Element Tabel: Lebar minimal 100%, background
                                putih. --}}
                                {{-- {{-- --}}
                                {{-- PERBAIKAN #5: Header tabel diberi aksen INDIGO-100 --}} {{-- Komentar asli Anda:
                                Catatan warna header tabel. --}}
                                {{-- --}} {{-- Penutup komentar blok. --}}
                                <thead class="bg-indigo-100"> {{-- Kepala Tabel (Thead): Background warna indigo muda.
                                    --}}
                                    <tr> {{-- Baris header tabel. --}}
                                        {{-- {{-- Teks header diberi aksen INDIGO-800 --}} {{-- Komentar asli Anda:
                                        Catatan warna teks header. --}}
                                        <th
                                            class="py-3 px-4 text-left text-xs font-medium text-indigo-800 uppercase tracking-wider">
                                            Gambar</th> {{-- Kolom Gambar: Styling teks kecil, uppercase, warna indigo
                                        tua. --}}
                                        <th
                                            class="py-3 px-4 text-left text-xs font-medium text-indigo-800 uppercase tracking-wider">
                                            Judul</th> {{-- Kolom Judul. --}}
                                        <th
                                            class="py-3 px-4 text-left text-xs font-medium text-indigo-800 uppercase tracking-wider">
                                            Link</th> {{-- Kolom Link. --}}
                                        <th
                                            class="py-3 px-4 text-center text-xs font-medium text-indigo-800 uppercase tracking-wider">
                                            Aksi</th> {{-- Kolom Aksi (Edit/Hapus): Rata tengah. --}}
                                    </tr> {{-- Penutup baris header. --}}
                                </thead> {{-- Penutup kepala tabel. --}}
                                {{-- {{-- --}}
                                {{-- PERBAIKAN #6: Body tabel dibuat selalu cerah --}} {{-- Komentar asli Anda: Catatan
                                styling body tabel. --}}
                                {{-- --}} {{-- Penutup komentar blok. --}}
                                <tbody class="divide-y divide-gray-200"> {{-- Badan Tabel: Garis pemisah antar baris
                                    warna abu-abu. --}}
                                    @forelse ($newsItems as $item) {{-- Loop Forelse: Iterasi array $newsItems, handle
                                        jika kosong. --}}
                                        <tr class="hover:bg-gray-50"> {{-- Baris Data: Efek hover background abu-abu sangat
                                            muda. --}}
                                            <td class="py-4 px-4 whitespace-nowrap"> {{-- Sel Gambar: Padding 4, konten
                                                tidak wrap ke bawah. --}}
                                                {{-- {{-- Pastikan Storage::url() digunakan jika image_path adalah path
                                                relatif --}} {{-- Komentar asli Anda: Pengingat fungsi Storage. --}}
                                                <img src="{{ Storage::url($item->image_path) }}" alt="{{ $item->title }}"
                                                    class="h-12 w-20 object-cover rounded shadow-sm"> {{-- Menampilkan
                                                gambar thumbnail (h-12 w-20) dengan object-cover agar rapi. --}}
                                            </td> {{-- Penutup sel gambar. --}}
                                            <td class="py-4 px-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ $item->title }}</td> {{-- Sel Judul: Menampilkan judul berita. --}}
                                            <td class="py-4 px-4 whitespace-nowrap text-sm text-gray-700"> {{-- Sel Link.
                                                --}}
                                                <a href="{{ $item->link_url }}" target="_blank"
                                                    class="text-indigo-600 hover:text-indigo-900 hover:underline">{{ Str::limit($item->link_url, 35) }}</a>
                                                {{-- Link eksternal: Membuka tab baru (target blank), teks dipotong (limit)
                                                jika > 35 karakter. --}}
                                            </td> {{-- Penutup sel link. --}}
                                            <td class="py-4 px-4 whitespace-nowrap text-center text-sm font-medium"> {{--
                                                Sel Aksi: Rata tengah. --}}
                                                {{-- {{-- --}}
                                                {{-- PERBAIKAN #7: Tombol Edit/Hapus disamakan (menjadi link teks) --}} {{--
                                                Komentar asli Anda: Catatan styling aksi. --}}
                                                {{-- --}} {{-- Penutup komentar blok. --}}
                                                <a href="{{ route('admin.news-items.edit', $item) }}"
                                                    class="text-indigo-600 hover:text-indigo-900 font-medium">Edit</a> {{--
                                                Tombol Edit: Link teks warna indigo menuju route edit. --}}

                                                <span class="text-gray-300 mx-1">|</span> {{-- Pemisah (Separator) vertikal
                                                antar tombol edit dan hapus. --}}

                                                <form action="{{ route('admin.news-items.destroy', $item) }}" method="POST"
                                                    class="inline-block"
                                                    onsubmit="return confirm('Yakin ingin menghapus berita ini?');"> {{--
                                                    Form Hapus: Mengarah ke route destroy, konfirmasi JS sebelum submit.
                                                    --}}
                                                    @csrf {{-- Token CSRF keamanan. --}}
                                                    @method('DELETE') {{-- Method spoofing DELETE untuk RESTful controller.
                                                    --}}
                                                    <button type="submit"
                                                        class="text-red-600 hover:text-red-900 font-medium"> {{-- Tombol
                                                        Submit Hapus: Teks warna merah. --}}
                                                        Hapus {{-- Teks tombol. --}}
                                                    </button> {{-- Penutup tombol hapus. --}}
                                                </form> {{-- Penutup form hapus. --}}
                                            </td> {{-- Penutup sel aksi. --}}
                                        </tr> {{-- Penutup baris data. --}}
                                    @empty {{-- Blok Empty: Dijalankan jika $newsItems kosong. --}}
                                        <tr> {{-- Baris khusus pesan kosong. --}}
                                            <td colspan="4"
                                                class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">Belum
                                                ada berita.</td> {{-- Pesan "Belum ada berita" rata tengah, span 4 kolom.
                                            --}}
                                        </tr> {{-- Penutup baris kosong. --}}
                                    @endforelse {{-- Akhir loop forelse. --}}
                                </tbody> {{-- Penutup badan tabel. --}}
                            </table> {{-- Penutup tag tabel. --}}
                        </div> {{-- Penutup wrapper tabel. --}}

                        <div class="mt-6"> {{-- Container Pagination: Margin atas 6 satuan. --}}
                            {{ $newsItems->links() }} {{-- Menampilkan link pagination Laravel otomatis. --}}
                        </div> {{-- Penutup container pagination. --}}
                    </div> {{-- Penutup area konten padding. --}}
                </div> {{-- Penutup card utama. --}}
            </div> {{-- Penutup container max-width. --}}
        </div> {{-- Penutup wrapper utama padding. --}}
</x-app-layout> {{-- Penutup komponen layout. --}}