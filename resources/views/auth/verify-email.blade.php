<x-guest-layout> {{-- Menggunakan layout khusus tamu (GuestLayout) sebagai pembungkus halaman verifikasi. --}}
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400"> {{-- Container teks informasi: Margin bawah 4, teks
        kecil, warna abu-abu (responsif dark mode). --}}
        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
        {{-- Menampilkan pesan instruksi verifikasi email yang dapat diterjemahkan. --}}
    </div> {{-- Penutup div informasi. --}}

    @if (session('status') == 'verification-link-sent') {{-- Logika Blade: Mengecek apakah ada status sesi
        'verification-link-sent' (artinya email baru saja dikirim). --}}
        <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400"> {{-- Container pesan sukses: Warna teks
            hijau menandakan keberhasilan. --}}
            {{ __('A new verification link has been sent to the email address you provided during registration.') }} {{--
            Pesan bahwa link verifikasi baru telah dikirim. --}}
        </div> {{-- Penutup div pesan sukses. --}}
    @endif {{-- Penutup logika if. --}}

    <div class="mt-4 flex items-center justify-between"> {{-- Container tombol aksi: Margin atas 4, Flexbox dengan jarak
        di antara elemen (kiri-kanan). --}}
        <form method="POST" action="{{ route('verification.send') }}"> {{-- Form 1: Method POST, mengarah ke route untuk
            mengirim ulang email verifikasi. --}}
            @csrf {{-- Token keamanan CSRF (Wajib untuk form POST). --}}

            <div> {{-- Wrapper tombol kirim ulang. --}}
                <x-primary-button> {{-- Komponen Tombol Utama. --}}
                    {{ __('Resend Verification Email') }} {{-- Teks tombol: "Kirim Ulang Email Verifikasi". --}}
                </x-primary-button> {{-- Penutup komponen tombol. --}}
            </div> {{-- Penutup wrapper tombol. --}}
        </form> {{-- Penutup form kirim ulang. --}}

        <form method="POST" action="{{ route('logout') }}"> {{-- Form 2: Method POST, mengarah ke route logout (jika
            user ingin ganti akun/keluar). --}}
            @csrf {{-- Token keamanan CSRF. --}}

            <button type="submit"
                class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                {{-- Tombol Logout: Teks dengan garis bawah, styling link sederhana. --}}
                {{ __('Log Out') }} {{-- Teks tombol: "Keluar". --}}
            </button> {{-- Penutup tag button. --}}
        </form> {{-- Penutup form logout. --}}
    </div> {{-- Penutup container aksi. --}}
</x-guest-layout> {{-- Penutup layout. --}}