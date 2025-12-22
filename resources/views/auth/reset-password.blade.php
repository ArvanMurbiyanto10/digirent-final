<x-guest-layout> {{-- Menggunakan layout khusus tamu (GuestLayout) sebagai pembungkus halaman reset password. --}}
    <form method="POST" action="{{ route('password.store') }}"> {{-- Form pembuka: Method POST, mengarah ke route
        'password.store' untuk memproses reset. --}}
        @csrf {{-- Token keamanan CSRF (Wajib untuk setiap form POST di Laravel). --}}

        {{-- Komentar HTML: Penanda input token. --}}
        <input type="hidden" name="token" value="{{ $request->route('token') }}"> {{-- Input tersembunyi (hidden) yang
        menyimpan token reset dari URL. --}}

        {{-- Komentar HTML: Penanda bagian input email. --}}
        <div> {{-- Wrapper untuk input email. --}}
            <x-input-label for="email" :value="__('Email')" /> {{-- Komponen Label: Menampilkan teks "Email". --}}
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" /> {{-- Input Email: Mengisi otomatis nilai
            dari request (URL) atau input sebelumnya (old), fokus otomatis. --}}
            <x-input-error :messages="$errors->get('email')" class="mt-2" /> {{-- Komponen Error: Menampilkan pesan
            error jika validasi email gagal. --}}
        </div> {{-- Penutup wrapper email. --}}

        {{-- Komentar HTML: Penanda bagian input password baru. --}}
        <div class="mt-4"> {{-- Wrapper input password dengan margin atas 4. --}}
            <x-input-label for="password" :value="__('Password')" /> {{-- Komponen Label: Menampilkan teks "Password".
            --}}
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="new-password" /> {{-- Input Password: Tipe password, wajib diisi, autocomplete untuk
            password baru. --}}
            <x-input-error :messages="$errors->get('password')" class="mt-2" /> {{-- Komponen Error: Menampilkan pesan
            error validasi password. --}}
        </div> {{-- Penutup wrapper password. --}}

        {{-- Komentar HTML: Penanda bagian konfirmasi password. --}}
        <div class="mt-4"> {{-- Wrapper input konfirmasi password dengan margin atas 4. --}}
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" /> {{-- Komponen Label:
            Menampilkan teks "Confirm Password". --}}

            <x-text-input id="password_confirmation" class="block mt-1 w-full" {{-- Input Konfirmasi: ID
                password_confirmation (penting untuk validasi 'confirmed' Laravel). --}} type="password" {{-- Tipe input
                password. --}} name="password_confirmation" required autocomplete="new-password" /> {{-- Nama field,
            wajib diisi. --}}

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" /> {{-- Komponen Error:
            Menampilkan pesan jika password tidak cocok. --}}
        </div> {{-- Penutup wrapper konfirmasi. --}}

        <div class="flex items-center justify-end mt-4"> {{-- Container tombol: Flexbox rata kanan, margin atas 4. --}}
            <x-primary-button> {{-- Komponen Tombol Utama (PrimaryButton). --}}
                {{ __('Reset Password') }} {{-- Teks pada tombol: "Reset Password". --}}
            </x-primary-button> {{-- Penutup komponen tombol. --}}
        </div> {{-- Penutup container tombol. --}}
    </form> {{-- Penutup tag form. --}}
</x-guest-layout> {{-- Penutup komponen layout tamu. --}}