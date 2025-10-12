<x-guest-layout>
    <div class="w-full sm:max-w-4xl bg-white shadow-2xl overflow-hidden sm:rounded-2xl flex">

        {{-- Kolom Kiri: Informasi dengan Gradasi --}}
        <div class="hidden md:flex md:w-1/2 bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-600 p-12 text-white flex-col justify-center">
            <h1 class="text-4xl font-black leading-tight mb-4">
                Bergabung dengan DigiRent
            </h1>
            <p class="text-purple-200 mb-8">
                Buat akun untuk mulai menyewa gadget impianmu dengan mudah, cepat, dan aman.
            </p>
            <div class="border-t border-purple-400 opacity-50"></div>
            <p class="mt-8 text-purple-200">
                Sudah punya akun? <a href="{{ route('login') }}" class="font-bold text-white hover:underline">Login di sini!</a>
            </p>
        </div>

        {{-- Kolom Kanan: Formulir Registrasi --}}
        <div class="w-full md:w-1/2 p-8">
            <div class="mb-6 text-center">
                <a href="/" class="text-2xl font-bold text-gray-800">
                    DigiRent
                </a>
                <p class="text-gray-500 mt-2">Buat Akun Baru Anda</p>
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div>
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="block mt-1 w-full"
                                    type="password"
                                    name="password"
                                    required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                    <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                    type="password"
                                    name="password_confirmation" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>

                    <x-primary-button class="ms-4 bg-purple-600 hover:bg-purple-700 focus:bg-purple-700 active:bg-purple-800">
                        {{ __('Register') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
