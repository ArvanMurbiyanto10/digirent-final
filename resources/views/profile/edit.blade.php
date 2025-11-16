<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold text-gray-800">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{--
                PERUBAHAN DI SINI:
                Menggunakan tema 'bg-indigo-100' dari dashboard.blade.php.
                Semua kelas dark mode dan border dihapus, diganti dengan style card dashboard.
            --}}
            <div class="bg-indigo-100 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 sm:p-8">
                    <div class="max-w-xl">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
