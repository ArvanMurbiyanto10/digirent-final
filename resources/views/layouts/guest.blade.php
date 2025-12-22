<!DOCTYPE html> {{-- Deklarasi standar dokumen HTML5. --}}
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"> {{-- Tag HTML pembuka dengan atribut bahasa yang dinamis
sesuai konfigurasi Laravel. --}}

<head> {{-- Bagian kepala dokumen untuk metadata dan aset. --}}
    <meta charset="utf-8"> {{-- Mengatur encoding karakter UTF-8. --}}
    <meta name="viewport" content="width=device-width, initial-scale=1"> {{-- Mengatur viewport agar responsif di
    perangkat mobile. --}}
    <meta name="csrf-token" content="{{ csrf_token() }}"> {{-- Menyimpan token CSRF untuk keamanan request AJAX. --}}

    <title>{{ config('app.name', 'DigiRent') }}</title> {{-- Judul halaman browser, default 'DigiRent' jika config
    kosong. --}}

    <link rel="preconnect" href="https://fonts.bunny.net"> {{-- Optimasi koneksi ke server font Bunny. --}}
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" /> {{-- Memuat
    font 'Figtree' dengan variasi ketebalan tertentu. --}}

    {{-- {{-- Kita ganti @vite dengan link langsung ke file yang sudah di-rename --}} {{-- Komentar asli Anda:
    Penjelasan perubahan aset. --}}
    <link rel="stylesheet" href="https://mycell.web.id/build/assets/style.css"> {{-- Memuat CSS secara manual dari URL
    absolut (menggantikan Vite). --}}
    <script src="https://mycell.web.id/build/assets/script.js" defer></script> {{-- Memuat JS secara manual dengan
    'defer' (dijalankan setelah HTML selesai di-parse). --}}
</head> {{-- Penutup tag head. --}}

<body class="font-sans text-gray-900 antialiased"> {{-- Body: Font default sans-serif, teks abu-abu gelap, antialiasing
    agar teks halus. --}}
    {{-- {{-- Layout asli kamu tetap dipertahankan di sini --}} {{-- Komentar asli Anda: Penanda struktur layout. --}}
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-white"> {{-- Wrapper utama:
        Tinggi minimal setara layar, Flexbox kolom, rata tengah (vertikal & horizontal), background putih. --}}
        {{ $slot }} {{-- Slot Dinamis: Tempat konten (Form Login/Register) akan disisipkan di sini. --}}
    </div> {{-- Penutup div wrapper. --}}
</body> {{-- Penutup body. --}}

</html> {{-- Penutup HTML. --}}