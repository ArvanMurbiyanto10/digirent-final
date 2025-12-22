<x-app-layout> {{-- Menggunakan komponen layout utama aplikasi (AppLayout). --}}
    <x-slot name="header"> {{-- Membuka slot bernama 'header' untuk bagian judul di atas. --}}
        <h2 class="font-semibold text-xl text-gray-800 leading-tight"> {{-- Styling judul header: Font tebal, ukuran XL, warna abu gelap. --}}
            Detail Produk: {{ $product->name }} {{-- Menampilkan teks "Detail Produk" diikuti nama produk yang sedang dilihat. --}}
        </h2> {{-- Penutup tag H2. --}}
    </x-slot> {{-- Penutup slot header. --}}

    <div class="bg-white"> {{-- Wrapper utama dengan latar belakang putih. --}}
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12"> {{-- Container: Lebar maks 7xl, rata tengah, padding vertikal 12. --}}
            {{-- {{-- Bagian Produk Utama --}} {{-- Komentar asli Anda: Penanda bagian produk utama. --}}
            {{-- {{-- MODIFIKASI: Mengubah perbandingan kolom grid --}} {{-- Komentar asli Anda: Catatan perubahan grid. --}}
            <div class="grid grid-cols-1 md:grid-cols-5 gap-12 items-start"> {{-- Grid Layout: 1 kolom (HP), 5 kolom (MD ke atas), gap 12, item rata atas. --}}

                {{-- {{-- Kolom Kiri: Gambar Produk (Dibuat lebih besar) --}} {{-- Komentar asli Anda: Penanda kolom gambar. --}}
                <div class="md:col-span-3 flex justify-center"> {{-- Kolom Kiri: Mengambil 3 dari 5 bagian grid (60% lebar), konten rata tengah. --}}
                    @if($product->image) {{-- Logika Blade: Cek apakah produk memiliki data gambar. --}}
                        <img class="w-full h-auto rounded-lg object-contain shadow-lg" src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"> {{-- Tampilkan gambar: Lebar penuh, aspek rasio terjaga, rounded, ada bayangan. --}}
                    @else {{-- Jika tidak ada gambar. --}}
                        <div class="w-full h-96 bg-gray-200 rounded-lg flex items-center justify-center"> {{-- Placeholder: Kotak abu-abu tinggi 96 unit. --}}
                            <span class="text-gray-500">Gambar tidak tersedia</span> {{-- Teks keterangan placeholder. --}}
                        </div> {{-- Penutup div placeholder. --}}
                    @endif {{-- Penutup logika if gambar. --}}
                </div> {{-- Penutup kolom kiri. --}}

                {{-- {{-- Kolom Kanan: Detail, Harga, dan Aksi (Dibuat lebih kecil) --}} {{-- Komentar asli Anda: Penanda kolom detail. --}}
                <div class="md:col-span-2"> {{-- Kolom Kanan: Mengambil 2 dari 5 bagian grid (40% lebar). --}}
                    <h1 class="text-4xl font-bold text-gray-900">{{ $product->name }}</h1> {{-- Judul Produk: Font sangat besar (4xl) dan tebal. --}}
                    <p class="mt-4 text-gray-600 leading-relaxed">{{ $product->description }}</p> {{-- Deskripsi Produk: Margin atas 4, teks abu-abu, jarak baris santai. --}}

                    <div class="mt-8"> {{-- Wrapper bagian harga & stok dengan margin atas 8. --}}
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Harga Sewa</h3> {{-- Label "Harga Sewa". --}}
                        <div class="flex items-end space-x-4"> {{-- Flexbox: Menjajarkan harga dan stok, rata bawah (items-end). --}}
                            <div> {{-- Wrapper harga. --}}
                                {{-- {{-- MODIFIKASI: Warna harga diubah menjadi ungu --}} {{-- Komentar asli Anda: Catatan warna harga. --}}
                                <p class="text-3xl font-bold text-purple-600">Rp {{ number_format($product->price_per_day) }}</p> {{-- Harga: Font besar (3xl), tebal, warna ungu, format angka rupiah. --}}

                                <p class="text-sm text-gray-500 mb-2">per hari</p> {{-- Teks satuan "per hari" kecil di bawah harga. --}}

                                {{-- {{-- KODE STATUS KETERSEDIAAN --}} {{-- Komentar asli Anda: Penanda logika stok. --}}
                                @if($product->stock > 0) {{-- Cek jika stok lebih dari 0 (Tersedia). --}}
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800"> {{-- Badge Hijau: Tersedia. --}}
                                        <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"> {{-- Ikon Centang (SVG). --}}
                                            <path clip-rule="evenodd" fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16Zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"></path> {{-- Path ikon centang. --}}
                                        </svg> {{-- Penutup tag SVG. --}}
                                        Tersedia {{-- Teks badge. --}}
                                    </span> {{-- Penutup badge hijau. --}}
                                @else {{-- Jika stok 0 atau kurang (Kosong). --}}
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800"> {{-- Badge Merah: Stok Kosong. --}}
                                        <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"> {{-- Ikon X (SVG). --}}
                                            <path clip-rule="evenodd" fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z"></path> {{-- Path ikon X. --}}
                                        </svg> {{-- Penutup tag SVG. --}}
                                        Stok Kosong {{-- Teks badge. --}}
                                    </span> {{-- Penutup badge merah. --}}
                                @endif {{-- Penutup logika stok. --}}
                                {{-- {{-- BATAS KODE STATUS --}} {{-- Komentar asli Anda: Penutup bagian status. --}}
                            </div> {{-- Penutup wrapper harga. --}}
                        </div> {{-- Penutup flexbox harga & stok. --}}
                    </div> {{-- Penutup wrapper bagian harga. --}}

                    <div class="mt-8"> {{-- Wrapper fasilitas dengan margin atas 8. --}}
                        <h3 class="text-lg font-semibold text-gray-800">Fasilitas Termasuk</h3> {{-- Judul bagian fasilitas. --}}
                        <ul class="list-disc list-inside text-gray-600 mt-2"> {{-- List item dengan bullet points, warna abu-abu. --}}
                            <li>Kabel Charger</li> {{-- Item fasilitas 1. --}}
                            <li>Casing Pelindung</li> {{-- Item fasilitas 2. --}}
                        </ul> {{-- Penutup list. --}}
                    </div> {{-- Penutup wrapper fasilitas. --}}

                    {{-- {{-- --}}
                    {{--   MODIFIKASI LOGIKA TOMBOL SEWA --}} {{-- Komentar asli Anda: Judul blok logika tombol. --}}
                    {{--   Kita tambahkan pengecekan untuk role admin --}} {{-- Komentar asli Anda: Penjelasan logika admin. --}}
                    {{-- --}} {{-- Penutup komentar blok. --}}
                    <div class="mt-10"> {{-- Wrapper tombol aksi dengan margin atas 10. --}}
                        @if($product->stock <= 0) {{-- Kondisi 1: Cek apakah stok habis. --}}
                            {{-- {{-- 1. Jika Stok Habis, tombol mati untuk semua --}} {{-- Komentar asli Anda: Penjelasan kondisi 1. --}}
                            <button class="w-full block text-center bg-gray-400 text-white text-lg font-semibold py-4 rounded-lg cursor-not-allowed" disabled> {{-- Tombol Disabled: Warna abu-abu, kursor 'not-allowed'. --}}
                                Stok Habis {{-- Teks tombol. --}}
                            </button> {{-- Penutup tombol. --}}
                        @elseif(auth()->check() && auth()->user()->role == 'admin') {{-- Kondisi 2: Jika stok ada, TAPI user login sebagai ADMIN. --}}
                            {{-- {{-- 2. Jika Stok Ada, TAPI user adalah admin, tombol mati --}} {{-- Komentar asli Anda: Penjelasan kondisi 2. --}}
                            <button class="w-full block text-center bg-purple-300 text-white text-lg font-bold py-4 rounded-lg cursor-not-allowed" {{-- Tombol Disabled Admin: Warna ungu pudar. --}}
                                    disabled title="Admin tidak dapat melakukan pemesanan"> {{-- Atribut disabled dan tooltip title. --}}
                                Admin Tidak Bisa Memesan {{-- Teks tombol. --}}
                            </button> {{-- Penutup tombol. --}}
                        @else {{-- Kondisi 3: Stok ada DAN user bukan admin (user biasa atau guest). --}}
                            {{-- {{-- 3. Jika Stok Ada & user BUKAN admin (atau guest), tombol aktif --}} {{-- Komentar asli Anda: Penjelasan kondisi 3. --}}
                            <a href="{{ route('booking.create', $product) }}" class="w-full block text-center bg-purple-600 text-white text-lg font-bold py-4 rounded-lg shadow-md hover:bg-purple-700 transition-colors duration-300"> {{-- Link Aktif: Menuju halaman booking create, warna ungu cerah, efek hover. --}}
                                Sewa Sekarang {{-- Teks tombol. --}}
                            </a> {{-- Penutup link. --}}
                        @endif {{-- Penutup logika if-else tombol. --}}
                    </div> {{-- Penutup wrapper tombol aksi. --}}
                    {{-- {{-- BATAS MODIFIKASI --}} {{-- Komentar asli Anda: Penanda akhir modifikasi. --}}

                </div> {{-- Penutup kolom kanan. --}}
            </div> {{-- Penutup grid utama. --}}

            {{-- {{-- Bagian Informasi Detail --}} {{-- Komentar asli Anda: Penanda section bawah. --}}
            {{-- {{-- MODIFIKASI: Warna latar diubah menjadi ungu muda --}} {{-- Komentar asli Anda: Catatan warna background. --}}
            <div class="mt-16 pt-12 border-t bg-purple-50 p-8 rounded-lg"> {{-- Container Detail Bawah: Margin atas besar, border atas, background ungu muda (purple-50), padding 8. --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8"> {{-- Grid Layout Bawah: 1 kolom (HP), 3 kolom (MD). --}}
                    <div class="md:col-span-1"> {{-- Kolom Kiri Bawah (1/3 bagian). --}}
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">Kondisi Unit</h2> {{-- Judul bagian kondisi. --}}
                        <div class="space-y-4 text-gray-600"> {{-- Konten teks kondisi dengan spasi vertikal. --}}
                            <p>Unit yang kami sediakan hadir dengan kondisi fisik mulus dan performa optimal. Semua perangkat menggunakan baterai yang sehat dan siap digunakan kapan saja.</p> {{-- Teks deskripsi kondisi. --}}
                        </div> {{-- Penutup div teks kondisi. --}}
                    </div> {{-- Penutup kolom kiri bawah. --}}

                    <div class="md:col-span-2"> {{-- Kolom Kanan Bawah (2/3 bagian). --}}
                        @if($product->specifications) {{-- Cek apakah produk memiliki data spesifikasi (array/json). --}}
                            <table class="min-w-full"> {{-- Tabel spesifikasi lebar penuh. --}}
                                <tbody> {{-- Badan tabel. --}}
                                    @foreach($product->specifications as $spec => $value) {{-- Loop setiap item spesifikasi (Key => Value). --}}
                                    <tr class="border-b"> {{-- Baris tabel dengan border bawah. --}}
                                        <td class="py-3 pr-4 font-medium text-gray-500">{{ $spec }}</td> {{-- Kolom Nama Spesifikasi (Key). --}}
                                        <td class="py-3 font-semibold text-gray-800">{{ $value }}</td> {{-- Kolom Nilai Spesifikasi (Value). --}}
                                    </tr> {{-- Penutup baris tabel. --}}
                                    @endforeach {{-- Akhir loop foreach. --}}
                                </tbody> {{-- Penutup badan tabel. --}}
                            </table> {{-- Penutup tag tabel. --}}
                        @endif {{-- Penutup logika if spesifikasi. --}}
                    </div> {{-- Penutup kolom kanan bawah. --}}
                </div> {{-- Penutup grid bawah. --}}
            </div> {{-- Penutup container detail bawah. --}}
        </div> {{-- Penutup container max-width. --}}
    </div> {{-- Penutup wrapper bg-white. --}}
</x-app-layout> {{-- Penutup komponen layout. --}}
