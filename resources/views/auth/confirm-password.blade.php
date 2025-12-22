<x-guest-layout> {{-- Menggunakan layout khusus tamu (GuestLayout) sebagai pembungkus halaman. --}}
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400"> {{-- Container pesan info: margin bawah 4, teks kecil,
        warna abu responsif (terang/gelap). --}}
        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }} {{--
        Menampilkan pesan: "Ini area aman. Harap konfirmasi password sebelum lanjut." --}}
    </div> {{-- Penutup div pesan info. --}}

    <form method="POST" action="{{ route('password.confirm') }}"> {{-- Form pembuka: Menggunakan metode POST ke route
        'password.confirm'. --}}
        @csrf {{-- Token keamanan CSRF (Wajib untuk setiap form POST di Laravel). --}}

        {{-- Komentar HTML standar: Penanda bagian input password. --}}
        <div> {{-- Wrapper untuk elemen input password. --}}
            <x-input-label for="password" :value="__('Password')" /> {{-- Komponen Label: Menampilkan label "Password".
            --}}

            <x-text-input id="password" class="block mt-1 w-full" {{-- Komponen Input Teks: ID password, tampilan block,
                margin atas 1, lebar penuh. --}} type="password" {{-- Tipe input adalah password (karakter
                disembunyikan). --}} name="password" {{-- Nama atribut untuk dikirim ke server. --}} required
                autocomplete="current-password" /> {{-- Atribut: Wajib diisi, browser boleh menyarankan password saat
            ini. --}}

            <x-input-error :messages="$errors->get('password')" class="mt-2" /> {{-- Komponen Error: Menampilkan pesan
            kesalahan validasi untuk field password. --}}
        </div> {{-- Penutup wrapper input. --}}

        <div class="flex justify-end mt-4"> {{-- Container tombol: Flexbox rata kanan, margin atas 4. --}}
            <x-primary-button> {{-- Komponen Tombol Utama (PrimaryButton). --}}
                {{ __('Confirm') }} {{-- Teks pada tombol: "Confirm" (Konfirmasi). --}}
            </x-primary-button> {{-- Penutup komponen tombol. --}}
        </div> {{-- Penutup container tombol. --}}
    </form> {{-- Penutup tag form. --}}
</x-guest-layout> {{-- Penutup komponen layout tamu. --}}