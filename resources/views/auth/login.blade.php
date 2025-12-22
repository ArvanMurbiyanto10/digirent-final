<x-guest-layout> {{-- Menggunakan layout khusus tamu (GuestLayout) sebagai pembungkus halaman login. --}}
    <div class="w-full sm:max-w-4xl bg-white shadow-2xl overflow-hidden sm:rounded-2xl flex"> {{-- Container utama:
        responsif (sm), lebar maks 4xl, background putih, shadow besar, rounded, layout flexbox. --}}

        {{-- {{-- Kolom Kiri: Informasi dengan Gradasi --}} {{-- Komentar asli Anda: Penanda kolom kiri. --}}
        <div
            class="hidden md:flex md:w-1/2 bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-600 p-12 text-white flex-col justify-center">
            {{-- Kolom Kiri (Hanya Desktop): Lebar 1/2, background gradasi warna-warni, padding 12, teks putih, rata
            tengah vertikal. --}}
            <h1 class="text-4xl font-black leading-tight mb-4"> {{-- Judul Besar: Ukuran 4xl, font sangat tebal (black),
                margin bawah 4. --}}
                Selamat Datang Kembali! {{-- Teks sapaan. --}}
            </h1> {{-- Penutup h1. --}}
            <p class="text-purple-200 mb-8"> {{-- Paragraf deskripsi: Warna ungu muda, margin bawah 8. --}}
                Masuk untuk melanjutkan sewa gadget impianmu. {{-- Teks ajakan. --}}
            </p> {{-- Penutup p. --}}
            {{-- {{-- [DIHAPUS] Link "Daftar di sini!" juga dihapus dari sini --}} {{-- Komentar asli Anda: Catatan
            penghapusan link daftar. --}}
            {{-- {{-- --}}
            {{-- <div class="border-t border-purple-400 opacity-50"></div> --}} {{-- Baris kode komentar asli
            (non-aktif). --}}
            {{-- <p class="mt-8 text-purple-200"> --}} {{-- Baris kode komentar asli (non-aktif). --}}
                {{-- Belum punya akun? <a href="{{ route('register') }}"
                    class="font-bold text-white hover:underline">Daftar di sini!</a> --}} {{-- Baris kode komentar asli
                (non-aktif). --}}
                {{-- </p> --}} {{-- Baris kode komentar asli (non-aktif). --}}
            {{-- --}} {{-- Penutup blok komentar asli. --}}
        </div> {{-- Penutup kolom kiri. --}}

        {{-- {{-- Kolom Kanan: Formulir Login --}} {{-- Komentar asli Anda: Penanda kolom kanan. --}}
        <div class="w-full md:w-1/2 p-8 flex flex-col justify-center"> {{-- Kolom Kanan: Lebar penuh di HP, setengah di
            Desktop, padding 8, rata tengah vertikal. --}}
            <div class="mb-6 text-center"> {{-- Header Login: Margin bawah 6, teks rata tengah. --}}
                <a href="/" class="text-2xl font-bold text-gray-800"> {{-- Link Logo: Mengarah ke home, font besar dan
                    tebal. --}}
                    DigiRent {{-- Nama aplikasi. --}}
                </a> {{-- Penutup link. --}}
                <p class="text-gray-500 mt-2">Login ke Akun Anda</p> {{-- Sub-judul kecil. --}}
            </div> {{-- Penutup header login. --}}

            <x-auth-session-status class="mb-4" :status="session('status')" /> {{-- Komponen Status Session: Menampilkan
            pesan status (misal reset password sukses). --}}

            {{-- {{-- Tampilkan error jika login Google gagal --}} {{-- Komentar asli Anda: Logika error handling. --}}
            @if (session('error')) {{-- Cek apakah ada session flash message 'error'. --}}
                <div class="mb-4 font-medium text-sm text-red-600"> {{-- Container Error: Margin bawah 4, teks merah tebal
                    sedang. --}}
                    {{ session('error') }} {{-- Tampilkan pesan error. --}}
                </div> {{-- Penutup div error. --}}
            @endif {{-- Penutup logika if. --}}

            {{-- {{-- [DIHAPUS] Form login manual dihapus --}} {{-- Komentar asli Anda: Catatan penghapusan form manual.
            --}}
            {{-- {{-- --}}
            {{-- <form method="POST" action="{{ route('login') }}"> --}} {{-- Baris kode komentar asli (non-aktif). --}}
                {{-- ... (form email/password) ... --}} {{-- Baris kode komentar asli (non-aktif). --}}
                {{-- </form> --}} {{-- Baris kode komentar asli (non-aktif). --}}
            {{-- --}} {{-- Penutup blok komentar asli. --}}

            {{-- Komentar HTML: Penanda tombol Google. --}}
            <div class="w-full"> {{-- Wrapper tombol lebar penuh. --}}
                <a href="{{ route('auth.google.redirect') }}" {{-- Link: Mengarah ke route redirect Google OAuth. --}}
                    class="w-full flex items-center justify-center px-4 py-3 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-red-600 hover:bg-red-700">
                    {{-- Styling Tombol: Flexbox, merah Google, rounded, shadow. --}}
                    {{-- Komentar HTML: Placeholder ikon. --}}
                    <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"
                            fill="#fff" />
                        <path
                            d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"
                            fill="#34A853" />
                        <path
                            d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z"
                            fill="#FBBC05" />
                        <path
                            d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"
                            fill="#EA4335" />
                    </svg> {{-- Ikon SVG Google. --}}
                    Login dengan Google {{-- Teks tombol. --}}
                </a> {{-- Penutup link login. --}}
            </div> {{-- Penutup wrapper tombol. --}}

            {{-- {{-- [DIHAPUS] Link "Belum punya akun?" juga dihapus dari sini --}} {{-- Komentar asli Anda: Catatan
            penghapusan link register. --}}
            {{-- {{-- --}}
            {{-- <div class="flex items-center justify-center mt-4"> --}} {{-- Baris kode komentar asli (non-aktif).
                --}}
                {{-- <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('register') }}"> --}}
                    {{-- Baris kode komentar asli (non-aktif). --}}
                    {{-- Belum punya akun? Daftar --}} {{-- Baris kode komentar asli (non-aktif). --}}
                    {{-- </a> --}} {{-- Baris kode komentar asli (non-aktif). --}}
                {{-- </div> --}} {{-- Baris kode komentar asli (non-aktif). --}}
            {{-- --}} {{-- Penutup blok komentar asli. --}}
        </div> {{-- Penutup kolom kanan. --}}
    </div> {{-- Penutup container utama. --}}
</x-guest-layout> {{-- Penutup komponen layout. --}}