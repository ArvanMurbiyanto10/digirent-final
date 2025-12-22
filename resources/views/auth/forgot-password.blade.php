<x-guest-layout> {{-- Menggunakan layout 'guest' sebagai pembungkus halaman (biasanya untuk halaman non-login). --}}
    <div class="w-full sm:max-w-4xl bg-white shadow-2xl overflow-hidden sm:rounded-2xl flex"> {{-- Container utama:
        Kartu lebar, bayangan tebal, rounded, layout flexbox. --}}

        {{-- {{-- Kolom Kiri: Informasi dengan Gradasi --}} {{-- Komentar asli Anda: Penanda kolom kiri. --}}
        <div
            class="hidden md:flex md:w-1/2 bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-600 p-12 text-white flex-col justify-center">
            {{-- Kolom kiri (hanya tampil di desktop): Background gradasi, teks putih, konten rata tengah vertikal. --}}
            <h1 class="text-4xl font-black leading-tight mb-4"> {{-- Judul besar di sisi kiri. --}}
                Lupa Password? {{-- Teks judul. --}}
            </h1> {{-- Penutup tag h1. --}}
            <p class="text-purple-200"> {{-- Paragraf deskripsi dengan warna ungu sangat muda. --}}
                Tidak masalah. Cukup beri tahu kami alamat email Anda dan kami akan mengirimkan link untuk mengatur
                ulang password Anda. {{-- Teks penjelasan fitur. --}}
            </p> {{-- Penutup tag p. --}}
        </div> {{-- Penutup div kolom kiri. --}}

        {{-- {{-- Kolom Kanan: Formulir --}} {{-- Komentar asli Anda: Penanda kolom kanan. --}}
        <div class="w-full md:w-1/2 p-8 flex flex-col justify-center"> {{-- Kolom kanan: Lebar penuh di HP, setengah di
            Desktop, padding 8. --}}
            <div class="mb-6 text-center"> {{-- Bagian Header Logo: Margin bawah 6, rata tengah. --}}
                <a href="/" class="text-2xl font-bold text-gray-800"> {{-- Link Logo: Mengarah ke home, font besar dan
                    tebal. --}}
                    DigiRent {{-- Nama aplikasi. --}}
                </a> {{-- Penutup link logo. --}}
                <p class="text-gray-500 mt-2">Reset Password Akun</p> {{-- Sub-judul kecil di bawah logo. --}}
            </div> {{-- Penutup header logo. --}}

            <x-auth-session-status class="mb-4" :status="session('status')" /> {{-- Komponen Status: Menampilkan pesan
            sukses kirim email (jika ada). --}}

            <form method="POST" action="{{ route('password.email') }}"> {{-- Form pembuka: Method POST, aksi ke route
                'password.email'. --}}
                @csrf {{-- Token keamanan CSRF (Wajib untuk form POST). --}}

                <div> {{-- Wrapper untuk input Email. --}}
                    <x-input-label for="email" :value="__('Email')" /> {{-- Label input untuk field 'email'. --}}
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                        required autofocus /> {{-- Input teks: Tipe email, value old (jika error), required, autofocus.
                    --}}
                    <x-input-error :messages="$errors->get('email')" class="mt-2" /> {{-- Menampilkan pesan error
                    validasi email. --}}
                </div> {{-- Penutup wrapper input. --}}

                <div class="flex items-center justify-end mt-4"> {{-- Container tombol: Flexbox, rata kanan, margin atas
                    4. --}}
                    <x-primary-button
                        class="w-full justify-center bg-purple-600 hover:bg-purple-700 focus:bg-purple-700 active:bg-purple-800">
                        {{-- Tombol Submit: Lebar penuh, warna ungu, efek hover/focus. --}}
                        {{ __('Kirim Link Reset Password') }} {{-- Teks tombol. --}}
                    </x-primary-button> {{-- Penutup tag tombol. --}}
                </div> {{-- Penutup container tombol. --}}

                <div class="text-center mt-4"> {{-- Container link kembali: Rata tengah, margin atas 4. --}}
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}"> {{--
                        Link "Kembali ke Login": Garis bawah, teks kecil abu-abu. --}}
                        Kembali ke Login {{-- Teks link. --}}
                    </a> {{-- Penutup tag link. --}}
                </div> {{-- Penutup div link kembali. --}}
            </form> {{-- Penutup form. --}}
        </div> {{-- Penutup div kolom kanan. --}}
    </div> {{-- Penutup container utama flex. --}}
</x-guest-layout> {{-- Penutup komponen layout. --}}