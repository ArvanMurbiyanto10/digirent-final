<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    {{-- Vite directive harus di bawah link font --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>

<body class="font-sans antialiased">
    {{-- MODIFIKASI: Tambahkan 'flex flex-col' untuk layout vertikal --}}
    <div class="min-h-screen bg-white flex flex-col">
        @include('layouts.navigation')

        @isset($header)
            <header class="bg-indigo-100 shadow-md">.
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        {{-- MODIFIKASI: Tambahkan 'flex-grow' agar area ini mengisi sisa ruang --}}
        <main class="flex-grow">
            @if (isset($slot))
                {{ $slot }}
            @else
                @yield('content')
            @endif
        </main>

        @include('layouts.footer')
    </div>

    {{-- =================================== --}}
    {{-- == [KODE CHATBOT (VERSI PILIHAN GANDA)] == --}}
    {{-- =================================== --}}
    <div x-data="chatbot()" x-cloak class="fixed bottom-5 right-5 z-50 flex flex-col items-end">

        {{-- Jendela Chat --}}
        <div x-show="chatOpen" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 translate-y-4"
            class="w-80 sm:w-96 bg-white dark:bg-gray-800 rounded-lg shadow-xl border dark:border-gray-700 overflow-hidden mb-3 flex flex-col"
            style="height: 60vh; max-height: 500px;"> {{-- Atur tinggi chatbox --}}

            {{-- Header Chat --}}
            <div
                class="flex-shrink-0 flex justify-between items-center bg-indigo-50 dark:bg-gray-700 px-4 py-3 border-b dark:border-gray-600">
                <h3 class="font-semibold text-gray-800 dark:text-gray-200">DigiBot Assistant</h3>
                <button @click="toggleChat()" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                    </svg>
                </button>
            </div>

            {{-- Area Pesan --}}
            <div class="p-4 flex-grow overflow-y-auto space-y-4" x-ref="chatbox">
                {{-- Pesan Bot Awal --}}
                <div class="flex">
                    <div
                        class="bg-gray-100 dark:bg-gray-600 text-gray-800 dark:text-gray-200 p-3 rounded-lg max-w-[85%] text-sm">
                        Halo! Ada yang bisa saya bantu? Silakan pilih salah satu pertanyaan di bawah ini.
                    </div>
                </div>
                {{-- Pesan dinamis --}}
                <template x-for="(message, index) in messages" :key="index">
                    <div class="flex"
                        :class="{ 'justify-end': message.sender === 'user', 'justify-start': message.sender === 'bot' }">
                        <div class="p-3 rounded-lg max-w-[85%] text-sm shadow-sm"
                            :class="{ 'bg-indigo-600 text-white': message.sender === 'user', 'bg-gray-100 dark:bg-gray-600 text-gray-800 dark:text-gray-200': !message.isResetButton, 'bg-white dark:bg-gray-800': message.isResetButton }">

                            {{-- Tampilkan teks atau tombol reset --}}
                            <template x-if="!message.isResetButton">
                                <span x-html="message.text"></span>
                            </template>
                            <template x-if="message.isResetButton">
                                <button @click="resetChat()"
                                    class="text-sm text-indigo-600 dark:text-indigo-400 font-semibold underline">
                                    Tanyakan hal lain?
                                </button>
                            </template>
                        </div>
                    </div>
                </template>
            </div>

            {{-- == [PERUBAHAN INPUT] == Input diganti menjadi Tombol Pilihan --}}
            <div x-show="showQuestions"
                class="p-4 border-t dark:border-gray-600 bg-gray-50 dark:bg-gray-700 overflow-y-auto flex-shrink-0"
                style="max-height: 40%;">
                <div class="space-y-2">
                    <template x-for="(question, i) in questionButtons" :key="i">
                        <button @click="askQuestion(question)"
                            class="w-full text-left text-sm text-indigo-700 dark:text-indigo-300 font-medium p-2 bg-indigo-100 dark:bg-gray-600 hover:bg-indigo-200 dark:hover:bg-gray-500 rounded-md transition-colors">
                            <span x-text="question"></span>
                        </button>
                    </template>
                </div>
            </div>

        </div>

        {{-- Tombol Floating --}}
        <button @click="toggleChat()" title="Buka Chat Bantuan"
            class="bg-indigo-600 hover:bg-indigo-700 text-white rounded-full p-4 shadow-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition transform duration-300 hover:scale-110">
            <svg x-show="!chatOpen" class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M8.625 12a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375M21 12c0 4.556-3.04 8.287-6.97 8.931c-.1.014-.2.019-.3.019H7.27c-.1-.001-.196-.005-.297-.019C3.04 20.287 0 16.556 0 12c0-4.556 3.04-8.287 6.97-8.931c.1-.014.2-.019-.3.019h9.46c.1 0 .2.005.3.019C17.96 3.713 21 7.444 21 12z" />
            </svg>
            <svg x-show="chatOpen" class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

    </div>
    {{-- =================================== --}}
    {{-- == [AKHIR KODE CHATBOT] == --}}
    {{-- =================================== --}}
    {{-- Script tambahan jika ada --}}
    @stack('scripts')
</body>

</html>
