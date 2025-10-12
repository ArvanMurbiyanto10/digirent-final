<x-guest-layout>
    <div class="w-full sm:max-w-4xl bg-white shadow-2xl overflow-hidden sm:rounded-2xl flex">

        {{-- Kolom Kiri: Informasi dengan Gradasi --}}
        <div class="hidden md:flex md:w-1/2 bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-600 p-12 text-white flex-col justify-center">
            <h1 class="text-4xl font-black leading-tight mb-4">
                Lupa Password?
            </h1>
            <p class="text-purple-200">
                Tidak masalah. Cukup beri tahu kami alamat email Anda dan kami akan mengirimkan link untuk mengatur ulang password Anda.
            </p>
        </div>

        {{-- Kolom Kanan: Formulir --}}
        <div class="w-full md:w-1/2 p-8 flex flex-col justify-center">
            <div class="mb-6 text-center">
                <a href="/" class="text-2xl font-bold text-gray-800">
                    DigiRent
                </a>
                <p class="text-gray-500 mt-2">Reset Password Akun</p>
            </div>

            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-primary-button class="w-full justify-center bg-purple-600 hover:bg-purple-700 focus:bg-purple-700 active:bg-purple-800">
                        {{ __('Kirim Link Reset Password') }}
                    </x-primary-button>
                </div>

                 <div class="text-center mt-4">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                        Kembali ke Login
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
