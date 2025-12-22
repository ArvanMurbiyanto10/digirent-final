<section> {{-- Wrapper utama (section) untuk memisahkan bagian ini dari bagian lain di halaman. --}}
    <header> {{-- Bagian header untuk judul dan deskripsi formulir. --}}
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100"> {{-- Judul dengan font medium, ukuran besar, warna adaptif (gelap/terang). --}}
            {{ __('Update Password') }} {{-- Teks "Update Password" yang mendukung fitur terjemahan. --}}
        </h2> {{-- Penutup tag h2. --}}

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400"> {{-- Paragraf deskripsi dengan margin atas kecil dan teks abu-abu. --}}
            {{ __('Ensure your account is using a long, random password to stay secure.') }} {{-- Pesan saran keamanan untuk pengguna. --}}
        </p> {{-- Penutup tag p. --}}
    </header> {{-- Penutup header. --}}

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6"> {{-- Form: Method POST, aksi ke route update password, margin atas 6, jarak antar elemen 6. --}}
        @csrf {{-- Token keamanan CSRF (Wajib untuk semua form POST di Laravel). --}}
        @method('put') {{-- Method Spoofing: Mengubah method POST menjadi PUT (standar RESTful untuk update). --}}

        <div> {{-- Wrapper untuk input Password Saat Ini. --}}
            <x-input-label for="update_password_current_password" :value="__('Current Password')" /> {{-- Label input: Mengarah ke ID input di bawahnya. --}}
            <x-text-input {{-- Komponen input teks bawaan Breeze. --}}
                id="update_password_current_password" {{-- ID unik (prefix 'update_password' agar tidak bentrok dengan form lain). --}}
                name="current_password" {{-- Nama field yang divalidasi di controller. --}}
                type="password" {{-- Tipe input password (teks tersembunyi). --}}
                class="mt-1 block w-full" {{-- Styling: Margin atas, blok penuh. --}}
                autocomplete="current-password" {{-- Membantu browser menyarankan password yang tersimpan. --}}
            /> {{-- Self-closing tag input. --}}
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" /> {{-- Menampilkan error validasi khusus dari error bag 'updatePassword'. --}}
        </div> {{-- Penutup div input current password. --}}

        <div> {{-- Wrapper untuk input Password Baru. --}}
            <x-input-label for="update_password_password" :value="__('New Password')" /> {{-- Label input Password Baru. --}}
            <x-text-input {{-- Komponen input. --}}
                id="update_password_password" {{-- ID unik. --}}
                name="password" {{-- Nama field 'password' (akan divalidasi 'confirmed'). --}}
                type="password" {{-- Tipe password. --}}
                class="mt-1 block w-full" {{-- Styling lebar penuh. --}}
                autocomplete="new-password" {{-- Memberitahu browser ini password baru (jangan isi otomatis password lama). --}}
            /> {{-- Self-closing tag input. --}}
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" /> {{-- Menampilkan error jika validasi password baru gagal. --}}
        </div> {{-- Penutup div input password baru. --}}

        <div> {{-- Wrapper untuk input Konfirmasi Password. --}}
            <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" /> {{-- Label Konfirmasi. --}}
            <x-text-input {{-- Komponen input. --}}
                id="update_password_password_confirmation" {{-- ID unik. --}}
                name="password_confirmation" {{-- Nama wajib 'password_confirmation' agar validasi Laravel bekerja otomatis. --}}
                type="password" {{-- Tipe password. --}}
                class="mt-1 block w-full" {{-- Styling lebar penuh. --}}
                autocomplete="new-password" {{-- Autocomplete password baru. --}}
            /> {{-- Self-closing tag input. --}}
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" /> {{-- Menampilkan error jika konfirmasi tidak cocok. --}}
        </div> {{-- Penutup div konfirmasi. --}}

        <div class="flex items-center gap-4"> {{-- Container tombol dan pesan sukses: Flexbox, item rata tengah, jarak 4. --}}
            <x-primary-button>{{ __('Save') }}</x-primary-button> {{-- Tombol Submit utama dengan teks "Save". --}}

            @if (session('status') === 'password-updated') {{-- Cek session flash: Jika controller mengirim status 'password-updated'. --}}
                <p {{-- Paragraf notifikasi sukses. --}}
                    x-data="{ show: true }" {{-- Alpine.js: Inisialisasi data 'show' = true. --}}
                    x-show="show" {{-- Alpine.js: Tampilkan elemen hanya jika 'show' true. --}}
                    x-transition {{-- Alpine.js: Efek transisi halus (fade in/out). --}}
                    x-init="setTimeout(() => show = false, 2000)" {{-- Alpine.js: Set timeout 2 detik, lalu ubah 'show' jadi false (hilangkan pesan). --}}
                    class="text-sm text-gray-600 dark:text-gray-400" {{-- Styling teks kecil abu-abu. --}}
                >{{ __('Saved.') }}</p> {{-- Teks "Saved." --}}
            @endif {{-- Penutup logika if session. --}}
        </div> {{-- Penutup container tombol. --}}
    </form> {{-- Penutup form. --}}
</section> {{-- Penutup section utama. --}}
