<footer class="bg-gray-800 text-white"> {{-- Element Footer: Latar belakang abu-abu gelap (800) dan teks putih untuk
    kontras tinggi. --}}
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8"> {{-- Container utama: Lebar maks 7xl, rata tengah
        (mx-auto), padding vertikal 12, padding horizontal responsif. --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8"> {{-- Grid Layout: 1 kolom di HP, 3 kolom di layar medium
            (tablet/desktop), jarak antar kolom 8 satuan. --}}

            {{-- {{-- Kolom 1: Tentang MY cell --}} {{-- Komentar asli Anda: Penanda kolom pertama. --}}
            <div> {{-- Wrapper kolom 1. --}}
                {{-- {{-- Judul Brand dengan warna merah --}} {{-- Komentar asli Anda: Penanda judul brand. --}}
                <h3 class="text-2xl font-bold mb-2 text-red-500">MY cell</h3> {{-- Judul Toko: Font besar (2xl), tebal,
                margin bawah 2, warna teks MERAH (sesuai request). --}}
                <p class="text-gray-400 max-w-md"> {{-- Deskripsi: Warna abu-abu terang (400) agar tidak terlalu
                    mencolok, lebar dibatasi (max-w-md). --}}
                    Platform penyewaan gadget di Kota Tegal. Kami menyediakan kemudahan dan akses ke teknologi
                    terkini. {{-- Isi teks deskripsi singkat tentang toko. --}}
                </p> {{-- Penutup paragraf deskripsi. --}}
            </div> {{-- Penutup kolom 1. --}}

            {{-- {{-- Kolom 2: Kontak --}} {{-- Komentar asli Anda: Penanda kolom kedua. --}}
            <div> {{-- Wrapper kolom 2. --}}
                <h4 class="text-lg font-semibold mb-4 tracking-wider uppercase">Contact Us</h4> {{-- Header Kontak: Font
                agak besar, semi-bold, margin bawah 4, huruf kapital semua, spasi huruf renggang. --}}
                <ul class="space-y-3 text-gray-400"> {{-- List Kontak: Jarak vertikal antar item 3 satuan, warna teks
                    abu-abu. --}}
                    {{-- {{-- Nomor Telepon --}} {{-- Komentar asli Anda: Penanda item telepon. --}}
                    <li class="flex items-center"> {{-- Item List: Flexbox untuk mensejajarkan ikon dan teks secara
                        vertikal (tengah). --}}
                        <svg class="w-5 h-5 mr-3 flex-shrink-0 text-red-500" fill="none" stroke="currentColor" {{-- Ikon
                            Telepon: SVG ukuran 5x5, margin kanan 3, warna MERAH, tidak menyusut (flex-shrink-0). --}}
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                            </path> {{-- Path ikon telepon handset. --}}
                        </svg> {{-- Penutup tag SVG. --}}
                        <span>08996122211 (Admin MY cell)</span> {{-- Teks nomor telepon. --}}
                    </li> {{-- Penutup item telepon. --}}

                    {{-- {{-- Alamat --}} {{-- Komentar asli Anda: Penanda item alamat. --}}
                    <li class="flex items-start"> {{-- Item List: Flexbox rata atas (items-start) karena alamat biasanya
                        lebih dari satu baris. --}}
                        {{-- {{-- Ikon Lokasi / Map Pin --}} {{-- Komentar asli Anda. --}}
                        <svg class="w-5 h-5 mr-3 flex-shrink-0 mt-1 text-red-500" fill="none" stroke="currentColor" {{--
                            Ikon Lokasi: Warna MERAH, margin atas 1 (mt-1) agar sejajar baris pertama teks. --}}
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                            </path> {{-- Bagian atas pin lokasi. --}}
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path> {{-- Titik tengah pin lokasi. --}}
                        </svg> {{-- Penutup tag SVG. --}}
                        <span>Jalan Batanghari No. 7, Kecamatan Tegal Timur, Kota Tegal, Jawa Tengah</span> {{-- Teks
                        alamat lengkap. --}}
                    </li> {{-- Penutup item alamat. --}}
                </ul> {{-- Penutup list kontak. --}}
            </div> {{-- Penutup kolom 2. --}}

            {{-- {{-- Kolom 3: Informasi --}} {{-- Komentar asli Anda: Penanda kolom ketiga. --}}
            <div> {{-- Wrapper kolom 3. --}}
                <h4 class="text-lg font-semibold mb-4 tracking-wider uppercase">Informasi</h4> {{-- Header Informasi:
                Styling sama dengan header kontak. --}}
                <ul class="space-y-2 inline-block text-left"> {{-- List Link: Jarak vertikal 2, inline-block agar rapi.
                    --}}
                    <li> {{-- Item link 1. --}}
                        {{-- {{-- Hover diganti ke warna merah (text-red-500) --}} {{-- Komentar asli Anda: Penjelasan
                        efek hover. --}}
                        <a href="{{ route('terms.show') }}" {{-- Link ke route halaman Syarat & Ketentuan. --}}
                            class="text-gray-400 hover:text-red-500 hover:underline transition-colors duration-200">
                            {{-- Styling Link: Default abu-abu, hover jadi MERAH dan garis bawah, transisi halus. --}}
                            Syarat & Ketentuan {{-- Teks link. --}}
                        </a> {{-- Penutup tag link. --}}
                    </li> {{-- Penutup item 1. --}}
                    <li> {{-- Item link 2. --}}
                        <a href="{{ route('privacy.show') }}" {{-- Link ke route halaman Kebijakan Privasi. --}}
                            class="text-gray-400 hover:text-red-500 hover:underline transition-colors duration-200">
                            {{-- Styling sama dengan link di atas. --}}
                            Kebijakan Privasi {{-- Teks link. --}}
                        </a> {{-- Penutup tag link. --}}
                    </li> {{-- Penutup item 2. --}}
                </ul> {{-- Penutup list informasi. --}}
            </div> {{-- Penutup kolom 3. --}}
        </div> {{-- Penutup grid layout utama. --}}

        <div class="mt-8 border-t border-gray-700 pt-8 text-center"> {{-- Bagian Copyright: Margin atas, garis pemisah
            atas (border-gray-700), padding atas, teks rata tengah. --}}
            <p class="text-base text-gray-400">&copy; {{ date('Y') }} MY cell. All Rights Reserved.</p> {{-- Teks
            Copyright: Menggunakan PHP date('Y') agar tahun otomatis update. --}}
        </div> {{-- Penutup div copyright. --}}
    </div> {{-- Penutup container max-width. --}}
</footer> {{-- Penutup elemen footer. --}}