<section> {{-- Wrapper utama (section) untuk mengelompokkan konten formulir ini. --}}
    <header> {{-- Bagian header untuk judul dan deskripsi formulir. --}}
        {{-- {{-- Teks header (Sudah 'text-indigo-800') --}} {{-- Komentar asli Anda: Konfirmasi warna teks header. --}}
        <h2 class="text-lg font-medium text-indigo-800"> {{-- Judul: Ukuran besar, font medium, warna ungu tua (indigo-800). --}}
            {{ __('Profile Information') }} {{-- Teks judul "Profile Information" (bisa diterjemahkan). --}}
        </h2> {{-- Penutup tag h2. --}}

        {{-- {{-- --}}
        {{--   PERUBAHAN DI SINI: --}} {{-- Komentar asli Anda: Penanda perubahan. --}}
        {{--   'text-indigo-700' diubah menjadi 'text-indigo-800' agar lebih gelap dan jelas. --}} {{-- Komentar asli Anda: Alasan perubahan warna. --}}
        {{-- --}} {{-- Penutup blok komentar asli. --}}
        <p class="mt-1 text-sm text-indigo-800"> {{-- Paragraf deskripsi: Margin atas kecil, teks kecil, warna ungu tua. --}}
            {{ __("Update your account's profile information and email address.") }} {{-- Teks deskripsi formulir. --}}
        </p> {{-- Penutup tag p. --}}
    </header> {{-- Penutup header. --}}

    <form id="send-verification" method="post" action="{{ route('verification.send') }}"> {{-- Form tersembunyi: Digunakan khusus untuk mengirim ulang email verifikasi. --}}
        @csrf {{-- Token keamanan CSRF (Wajib untuk form POST). --}}
    </form> {{-- Penutup form verifikasi. --}}

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6"> {{-- Form Utama: Method POST, aksi ke route update profil, jarak vertikal antar elemen 6 satuan. --}}
        @csrf {{-- Token CSRF. --}}
        @method('patch') {{-- Method Spoofing: Mengubah POST menjadi PATCH (standar update data parsial). --}}

        {{-- {{-- Field Nama --}} {{-- Komentar asli Anda: Penanda input nama. --}}
        <div> {{-- Wrapper input Nama. --}}
            <x-input-label for="name" :value="__('Name')" /> {{-- Label untuk input nama. --}}
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" /> {{-- Input Teks: Mengisi nilai dari old input atau database ($user->name), autofocus aktif. --}}
            <x-input-error class="mt-2" :messages="$errors->get('name')" /> {{-- Menampilkan error validasi jika nama bermasalah. --}}
        </div> {{-- Penutup wrapper nama. --}}

        {{-- {{-- Field Email --}} {{-- Komentar asli Anda: Penanda input email. --}}
        <div> {{-- Wrapper input Email. --}}
            <x-input-label for="email" :value="__('Email')" /> {{-- Label untuk input email. --}}
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" /> {{-- Input Email: Tipe email, value dari database/old input. --}}
            <x-input-error class="mt-2" :messages="$errors->get('email')" /> {{-- Menampilkan error validasi email. --}}

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail()) {{-- Cek Logika: Jika fitur verifikasi email aktif DAN user belum verifikasi. --}}
                <div> {{-- Wrapper pesan peringatan verifikasi. --}}
                    {{-- {{-- Teks verifikasi email (sudah 'text-indigo-800') --}} {{-- Komentar asli Anda: Konfirmasi warna teks. --}}
                    <p class="text-sm mt-2 text-indigo-800"> {{-- Paragraf peringatan: Teks kecil, warna ungu tua. --}}
                        {{ __('Your email address is unverified.') }} {{-- Pesan: Email belum diverifikasi. --}}

                        <button form="send-verification" class="underline text-sm text-indigo-600 hover:text-indigo-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"> {{-- Tombol Kirim Ulang: Memicu form ID 'send-verification' di atas. --}}
                            {{ __('Click here to re-send the verification email.') }} {{-- Teks tombol. --}}
                        </button> {{-- Penutup tombol. --}}
                    </p> {{-- Penutup paragraf. --}}

                    @if (session('status') === 'verification-link-sent') {{-- Cek Session: Jika email baru saja dikirim. --}}
                        <p class="mt-2 font-medium text-sm text-green-600"> {{-- Pesan Sukses: Warna hijau. --}}
                            {{ __('A new verification link has been sent to your email address.') }} {{-- Teks konfirmasi pengiriman. --}}
                        </p> {{-- Penutup pesan sukses. --}}
                    @endif {{-- Akhir cek session. --}}
                </div> {{-- Penutup wrapper verifikasi. --}}
            @endif {{-- Akhir cek status verifikasi user. --}}
        </div> {{-- Penutup wrapper email. --}}

        {{-- {{-- Field Telepon --}} {{-- Komentar asli Anda: Penanda input telepon. --}}
        <div> {{-- Wrapper input Telepon. --}}
            <x-input-label for="phone" :value="__('Phone Number')" /> {{-- Label nomor telepon. --}}
            <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" :value="old('phone', $user->phone)" autocomplete="tel" /> {{-- Input Teks: Value dari kolom 'phone' di database. --}}
            <x-input-error class="mt-2" :messages="$errors->get('phone')" /> {{-- Menampilkan error validasi telepon. --}}
        </div> {{-- Penutup wrapper telepon. --}}

        {{-- {{-- Field Alamat --}} {{-- Komentar asli Anda: Penanda input alamat. --}}
        <div> {{-- Wrapper input Alamat. --}}
            <x-input-label for="address" :value="__('Address')" /> {{-- Label alamat. --}}
            <textarea id="address" name="address" class="border-gray-300 dark:border-gray-700 dark:bg-white dark:text-gray-900 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full" rows="3">{{ old('address', $user->address) }}</textarea> {{-- Textarea: Manual styling (karena bukan komponen x-text-input), menampilkan alamat user. --}}
            <x-input-error class="mt-2" :messages="$errors->get('address')" /> {{-- Menampilkan error validasi alamat. --}}
        </div> {{-- Penutup wrapper alamat. --}}

        {{-- {{-- Tombol Save --}} {{-- Komentar asli Anda: Penanda tombol simpan. --}}
        <div class="flex items-center gap-4"> {{-- Container tombol: Flexbox, item rata tengah vertikal, jarak 4. --}}
            <x-primary-button>{{ __('Save') }}</x-primary-button> {{-- Tombol Submit Utama. --}}

            @if (session('status') === 'profile-updated') {{-- Cek Session: Jika controller mengirim status 'profile-updated'. --}}
                {{-- {{-- --}}
                {{--   PERUBAHAN DI SINI: --}} {{-- Komentar asli Anda: Penanda modifikasi. --}}
                {{--   Teks 'Saved.' juga diubah ke 'text-indigo-800' agar seragam. --}} {{-- Komentar asli Anda: Penjelasan warna teks notifikasi. --}}
                {{-- --}} {{-- Penutup blok komentar asli. --}}
                <p {{-- Paragraf notifikasi 'Saved'. --}}
                    x-data="{ show: true }" {{-- Alpine.js: Inisialisasi state show = true. --}}
                    x-show="show" {{-- Alpine.js: Tampilkan elemen jika show == true. --}}
                    x-transition {{-- Alpine.js: Efek transisi halus (fade). --}}
                    x-init="setTimeout(() => show = false, 2000)" {{-- Alpine.js: Set timer 2 detik, lalu sembunyikan pesan. --}}
                    class="text-sm text-indigo-800" {{-- Styling: Teks kecil, warna ungu tua (indigo-800). --}}
                >{{ __('Saved.') }}</p> {{-- Teks "Saved." --}}
            @endif {{-- Akhir cek session. --}}
        </div> {{-- Penutup container tombol. --}}
    </form> {{-- Penutup form utama. --}}
</section> {{-- Penutup section. --}}
