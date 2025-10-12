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
            <div class="border-t border-purple-400 opacity-50"></div>
            <p class="mt-8 text-purple-200">
                Belum punya akun? <a href="{{ route('register') }}" class="font-bold text-white hover:underline">Daftar di sini!</a>
            </p>
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

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div>
                    <x-input-label for="email" value="Email" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="password" value="Password" />
                    <x-text-input id="password" class="block mt-1 w-full"
                                    type="password"
                                    name="password"
                                    required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                        <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <div class="flex items-center justify-between mt-4">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                            Lupa password?
                        </a>
                    @endif

                    <x-primary-button class="ms-4 bg-purple-600 hover:bg-purple-700 focus:bg-purple-700 active:bg-purple-800">
                        Log in
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
