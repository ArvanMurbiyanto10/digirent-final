<x-guest-layout>
    <div class="w-full sm:max-w-4xl bg-white shadow-2xl overflow-hidden sm:rounded-2xl flex">

        {{-- Kolom Kiri: Informasi dengan Gradasi --}}
        <div class="hidden md:flex md:w-1/2 bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-600 p-12 text-white flex-col justify-center">
            <h1 class="text-4xl font-black leading-tight mb-4">
                Selamat Datang Kembali!
            </h1>
            <p class="text-purple-200 mb-8">
                Masuk untuk melanjutkan sewa gadget impianmu.
            </p>
            {{-- [DIHAPUS] Link "Daftar di sini!" juga dihapus dari sini --}}
            {{--
            <div class="border-t border-purple-400 opacity-50"></div>
            <p class="mt-8 text-purple-200">
                Belum punya akun? <a href="{{ route('register') }}" class="font-bold text-white hover:underline">Daftar di sini!</a>
            </p>
            --}}
        </div>

        {{-- Kolom Kanan: Formulir Login --}}
        <div class="w-full md:w-1/2 p-8 flex flex-col justify-center">
            <div class="mb-6 text-center">
                <a href="/" class="text-2xl font-bold text-gray-800">
                    DigiRent
                </a>
                <p class="text-gray-500 mt-2">Login ke Akun Anda</p>
            </div>

            <x-auth-session-status class="mb-4" :status="session('status')" />

            {{-- Tampilkan error jika login Google gagal --}}
            @if (session('error'))
                <div class="mb-4 font-medium text-sm text-red-600">
                    {{ session('error') }}
                </div>
            @endif

            {{-- [DIHAPUS] Form login manual dihapus --}}
            {{--
            <form method="POST" action="{{ route('login') }}">
                ... (form email/password) ...
            </form>
            --}}

            <!-- Tombol Login Google dari Langkah 6 -->
            <div class="w-full">
                <a href="{{ route('auth.google.redirect') }}"
                   class="w-full flex items-center justify-center px-4 py-3 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-red-600 hover:bg-red-700">
                    <!-- (Opsional) Anda bisa tambahkan ikon Google di sini -->
                    <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#fff"/><path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/><path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z" fill="#FBBC05"/><path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/></svg>
                    Login dengan Google
                </a>
            </div>

            {{-- [DIHAPUS] Link "Belum punya akun?" juga dihapus dari sini --}}
            {{--
            <div class="flex items-center justify-center mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('register') }}">
                    Belum punya akun? Daftar
                </a>
            </div>
            --}}
        </div>
    </div>
</x-guest-layout>
