<x-app-layout> {{-- Menggunakan komponen layout utama aplikasi (AppLayout) sebagai pembungkus halaman. --}}
    <x-slot name="header"> {{-- Membuka slot bernama 'header' untuk menyisipkan konten judul di bagian atas layout. --}}
        <h2 class="text-xl font-bold text-gray-800"> {{-- Judul halaman "Profile" dengan font besar, tebal, dan warna
            abu gelap. --}}
            {{ __('Profile') }} {{-- Menampilkan teks "Profile" yang mendukung fitur terjemahan Laravel. --}}
        </h2> {{-- Penutup tag judul h2. --}}
    </x-slot> {{-- Penutup slot header. --}}

    <div class="py-12"> {{-- Wrapper utama konten dengan padding vertikal (atas-bawah) sebesar 12 satuan. --}}
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6"> {{-- Container pembatas lebar max 7xl, rata tengah,
            padding responsif, dan jarak antar elemen (space-y-6). --}}

            {{-- {{-- --}}
            {{-- PERUBAHAN DI SINI: --}} {{-- Komentar asli Anda: Penanda bagian yang dimodifikasi. --}}
            {{-- Menggunakan tema 'bg-indigo-100' dari dashboard.blade.php. --}} {{-- Komentar asli Anda: Penjelasan
            penggunaan tema warna indigo. --}}
            {{-- Semua kelas dark mode dan border dihapus, diganti dengan style card dashboard. --}} {{-- Komentar asli
            Anda: Penjelasan penghapusan style lama. --}}
            {{-- --}} {{-- Penutup blok komentar asli. --}}
            <div class="bg-indigo-100 overflow-hidden shadow-sm sm:rounded-lg"> {{-- Kartu kontainer: Background indigo
                muda, konten meluap disembunyikan, shadow halus, sudut membulat. --}}
                <div class="p-4 sm:p-8"> {{-- Container isi dengan padding 4 (atau 8 di layar medium ke atas). --}}
                    <div class="max-w-xl"> {{-- Membatasi lebar konten formulir agar tidak terlalu lebar (maksimum XL).
                        --}}
                        @include('profile.partials.update-profile-information-form') {{-- Memuat file partial (pecahan
                        view) yang berisi form update profil. --}}
                    </div> {{-- Penutup pembatas lebar konten. --}}
                </div> {{-- Penutup container padding. --}}
            </div> {{-- Penutup kartu kontainer. --}}

        </div> {{-- Penutup container max-width. --}}
    </div> {{-- Penutup wrapper utama. --}}
</x-app-layout> {{-- Penutup komponen layout. --}}