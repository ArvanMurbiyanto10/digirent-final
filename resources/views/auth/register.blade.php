<x-guest-layout> {{-- Menggunakan layout khusus tamu (GuestLayout) sebagai pembungkus halaman registrasi. --}}
    <div class="w-full sm:max-w-4xl bg-white shadow-2xl overflow-hidden sm:rounded-2xl flex"> {{-- Container utama:
        responsif (sm), lebar maks 4xl, background putih, shadow besar, rounded, layout flexbox. --}}

        {{-- {{-- Kolom Kiri: Informasi dengan Gradasi --}} {{-- Komentar asli Anda: Penanda kolom kiri. --}}
        <div
            class="hidden md:flex md:w-1/2 bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-600 p-12 text-white flex-col justify-center">
            {{-- Kolom Kiri (Desktop): Lebar 1/2, background gradasi, padding 12, teks putih, rata tengah vertikal. --}}
            <h1 class="text-4xl font-black leading-tight mb-4"> {{-- Judul Besar: Ukuran 4xl, font sangat tebal (black),
                margin bawah 4. --}}
                Bergabung dengan DigiRent {{-- Teks judul. --}}
            </h1> {{-- Penutup h1. --}}
            <p class="text-purple-200 mb-8"> {{-- Paragraf deskripsi: Warna ungu muda, margin bawah 8. --}}
                Buat akun untuk mulai menyewa gadget impianmu dengan mudah, cepat, dan aman. {{-- Teks ajakan. --}}
            </p> {{-- Penutup p. --}}
            <div class="border-t border-purple-400 opacity-50"></div> {{-- Garis pemisah horizontal tipis warna ungu
            pudar. --}}
            <p class="mt-8 text-purple-200"> {{-- Paragraf link login: Margin atas 8, warna ungu muda. --}}
                Sudah punya akun? <a href="{{ route('login') }}" class="font-bold text-white hover:underline">Login di
                    sini!</a> {{-- Link ke halaman login: Teks tebal putih, garis bawah saat hover. --}}
            </p> {{-- Penutup p. --}}
        </div> {{-- Penutup kolom kiri. --}}

        {{-- {{-- Kolom Kanan: Formulir Registrasi --}} {{-- Komentar asli Anda: Penanda kolom kanan. --}}
        <div class="w-full md:w-1/2 p-8"> {{-- Kolom Kanan: Lebar penuh di HP, setengah di Desktop, padding 8. --}}
            <div class="mb-6 text-center"> {{-- Header Register: Margin bawah 6, rata tengah. --}}
                <a href="/" class="text-2xl font-bold text-gray-800"> {{-- Link Logo: Ke home, font besar tebal. --}}
                    DigiRent {{-- Nama aplikasi. --}}
                </a> {{-- Penutup link. --}}
                <p class="text-gray-500 mt-2">Buat Akun Baru Anda</p> {{-- Sub-judul kecil. --}}
            </div> {{-- Penutup header register. --}}

            <form method="POST" action="{{ route('register') }}"> {{-- Form Register: Method POST, aksi ke route
                register. --}}
                @csrf {{-- Token keamanan CSRF (Wajib). --}}

                <div> {{-- Wrapper input Nama. --}}
                    <x-input-label for="name" :value="__('Name')" /> {{-- Label 'Name'. --}}
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                        required autofocus autocomplete="name" /> {{-- Input teks nama: Value old, autofocus. --}}
                    <x-input-error :messages="$errors->get('name')" class="mt-2" /> {{-- Error handling nama. --}}
                </div> {{-- Penutup wrapper nama. --}}

                <div class="mt-4"> {{-- Wrapper input Email: Margin atas 4. --}}
                    <x-input-label for="email" :value="__('Email')" /> {{-- Label 'Email'. --}}
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                        required autocomplete="username" /> {{-- Input email. --}}
                    <x-input-error :messages="$errors->get('email')" class="mt-2" /> {{-- Error handling email. --}}
                </div> {{-- Penutup wrapper email. --}}

                <div class="mt-4"> {{-- Wrapper input Password: Margin atas 4. --}}
                    <x-input-label for="password" :value="__('Password')" /> {{-- Label 'Password'. --}}
                    <x-text-input id="password" class="block mt-1 w-full" {{-- Input password: Lebar penuh. --}}
                        type="password" {{-- Tipe password. --}} name="password" {{-- Nama field. --}} required
                        autocomplete="new-password" /> {{-- Atribut required dan autocomplete. --}}
                    <x-input-error :messages="$errors->get('password')" class="mt-2" /> {{-- Error handling password.
                    --}}
                </div> {{-- Penutup wrapper password. --}}

                <div class="mt-4"> {{-- Wrapper input Konfirmasi Password. --}}
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" /> {{-- Label 'Confirm
                    Password'. --}}
                    <x-text-input id="password_confirmation" class="block mt-1 w-full" {{-- Input konfirmasi password.
                        --}} type="password" {{-- Tipe password. --}} name="password_confirmation" required
                        autocomplete="new-password" /> {{-- Nama field harus 'password_confirmation' agar cocok dengan
                    validasi Laravel 'confirmed'. --}}
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" /> {{-- Error handling
                    konfirmasi. --}}
                </div> {{-- Penutup wrapper konfirmasi. --}}

                <div class="flex items-center justify-end mt-4"> {{-- Container tombol: Flexbox, rata kanan, margin atas
                    4. --}}
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        href="{{ route('login') }}"> {{-- Link "Already registered?": Kecil, garis bawah. --}}
                        {{ __('Already registered?') }} {{-- Teks link. --}}
                    </a> {{-- Penutup link login. --}}

                    <x-primary-button
                        class="ms-4 bg-purple-600 hover:bg-purple-700 focus:bg-purple-700 active:bg-purple-800"> {{--
                        Tombol Register: Margin kiri (ms-4), warna ungu. --}}
                        {{ __('Register') }} {{-- Teks tombol. --}}
                    </x-primary-button> {{-- Penutup tombol register. --}}
                </div> {{-- Penutup container tombol. --}}
            </form> {{-- Penutup form. --}}
        </div> {{-- Penutup kolom kanan. --}}
    </div> {{-- Penutup container utama. --}}
</x-guest-layout> {{-- Penutup layout. --}}