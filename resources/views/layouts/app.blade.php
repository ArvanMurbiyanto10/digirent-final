<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'DigiRent') }}</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    {{-- ======================================================== --}}
    {{-- == SOLUSI ALTERNATIF (MENAMBAHKAN /public/) == --}}
    {{-- ======================================================== --}}
    
    {{-- Coba Link 1: Lewat path public --}}
    <link rel="stylesheet" href="https://mycell.web.id/public/build/assets/style.css">
    
    {{-- Alpine JS via CDN (Agar Chatbot PASTI JALAN) --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    {{-- Script JS Bawaan (Opsional) --}}
    <script src="https://mycell.web.id/public/build/assets/script.js" defer></script>

    @stack('styles')
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-white flex flex-col">
        
        @include('layouts.navigation')

        @isset($header)
            <header class="bg-indigo-100 shadow-md">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

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
    {{-- == [CHATBOT UI] == --}}
    {{-- =================================== --}}
    <div x-data="chatbotData()" x-cloak class="fixed bottom-5 right-5 z-50 flex flex-col items-end">

        {{-- Jendela Chat --}}
        <div x-show="chatOpen" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 translate-y-4"
            class="w-80 sm:w-96 bg-white dark:bg-gray-800 rounded-lg shadow-xl border dark:border-gray-700 overflow-hidden mb-3 flex flex-col"
            style="height: 60vh; max-height: 500px;"> 

            {{-- Header Chat --}}
            <div class="flex-shrink-0 flex justify-between items-center bg-indigo-50 dark:bg-gray-700 px-4 py-3 border-b dark:border-gray-600">
                <h3 class="font-semibold text-gray-800 dark:text-gray-200">MY cell Assistant</h3>
                <button @click="toggleChat()" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                    </svg>
                </button>
            </div>

            {{-- Area Pesan --}}
            <div class="p-4 flex-grow overflow-y-auto space-y-4 bg-white dark:bg-gray-800" x-ref="chatbox">
                {{-- Pesan Bot Awal --}}
                <div class="flex">
                    <div class="bg-gray-100 dark:bg-gray-600 text-gray-800 dark:text-gray-200 p-3 rounded-lg max-w-[85%] text-sm shadow-sm">
                        Halo! Ada yang bisa saya bantu? Silakan pilih salah satu pertanyaan di bawah ini.
                    </div>
                </div>
                {{-- Pesan dinamis --}}
                <template x-for="(message, index) in messages" :key="index">
                    <div class="flex" :class="{ 'justify-end': message.sender === 'user', 'justify-start': message.sender === 'bot' }">
                        <div class="p-3 rounded-lg max-w-[85%] text-sm shadow-sm"
                            :class="{ 'bg-indigo-600 text-white': message.sender === 'user', 'bg-gray-100 dark:bg-gray-600 text-gray-800 dark:text-gray-200': !message.isResetButton, 'bg-white dark:bg-gray-800': message.isResetButton }">

                            <template x-if="!message.isResetButton">
                                <span x-html="message.text"></span>
                            </template>
                            <template x-if="message.isResetButton">
                                <button @click="resetChat()" class="text-sm text-indigo-600 dark:text-indigo-400 font-semibold underline hover:text-indigo-800">
                                    Tanyakan hal lain?
                                </button>
                            </template>
                        </div>
                    </div>
                </template>
            </div>

            {{-- Pilihan Pertanyaan (FIXED: Pastikan Background Terlihat) --}}
            <div x-show="showQuestions" class="p-4 border-t border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 overflow-y-auto flex-shrink-0" style="max-height: 40%;">
                <div class="space-y-2">
                    <template x-for="(question, i) in questionButtons" :key="i">
                       <button @click="askQuestion(question)"
                            class="w-full text-left text-sm font-medium p-3 rounded-md shadow-sm transition-all border
                                   text-white bg-indigo-600 hover:bg-indigo-700 border-indigo-500
                                   dark:text-white dark:bg-indigo-600 dark:hover:bg-indigo-500 dark:border-indigo-400">
                            <span x-text="question"></span>
                        </button>
                    </template>
                </div>
            </div>

        </div>

        {{-- Tombol Floating Chat --}}
        <button @click="toggleChat()" title="Buka Chat Bantuan"
            class="bg-indigo-600 hover:bg-indigo-700 text-white rounded-full p-4 shadow-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition transform duration-300 hover:scale-110">
            <svg x-show="!chatOpen" class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 12a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375M21 12c0 4.556-3.04 8.287-6.97 8.931c-.1.014-.2.019-.3.019H7.27c-.1-.001-.196-.005-.297-.019C3.04 20.287 0 16.556 0 12c0-4.556 3.04-8.287 6.97-8.931c.1-.014.2-.019-.3.019h9.46c.1 0 .2.005.3.019C17.96 3.713 21 7.444 21 12z" />
            </svg>
            <svg x-show="chatOpen" class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

    </div>

    {{-- =================================== --}}
    {{-- == [LOGIKA CHATBOT DITANAM DISINI] == --}}
    {{-- == (Agar tidak perlu build JS ulang) == --}}
    {{-- =================================== --}}
    <script>
        function chatbotData() {
            return {
                chatOpen: false,
                showQuestions: true,
                messages: [],
                questionButtons: [
                    'Bagaimana cara menyewa gadget?',
                    'Apa syarat penyewaan?',
                    'Metode pembayaran apa yang tersedia?',
                    'Apakah ada biaya keterlambatan?',
                    'Hubungi Customer Service'
                ],
                answers: {
                    'Bagaimana cara menyewa gadget?': 'Caranya mudah! <br>1. Login ke akun Anda.<br>2. Pilih produk di Katalog.<br>3. Klik "Sewa" dan tentukan tanggal.',
                    'Apa syarat penyewaan?': 'Syarat utamanya adalah KTP asli dan akun yang sudah terverifikasi.',
                    'Metode pembayaran apa yang tersedia?': 'Kami menerima Transfer Bank (BCA, Mandiri) dan E-Wallet (Gopay, OVO).',
                    'Apakah ada biaya keterlambatan?': 'Ya, keterlambatan dikenakan denda harian 5% dari harga sewa.',
                    'Hubungi Customer Service': 'Hubungi WA: <strong>08996122211</strong> atau Email: <strong>admin@mycell.web.id</strong>.'
                },
                toggleChat() {
                    this.chatOpen = !this.chatOpen;
                    if (this.chatOpen) { this.$nextTick(() => { this.scrollToBottom(); }); }
                },
                askQuestion(question) {
                    this.messages.push({ sender: 'user', text: question, isResetButton: false });
                    this.showQuestions = false;
                    this.$nextTick(() => { this.scrollToBottom(); });

                    setTimeout(() => {
                        const answerText = this.answers[question] || "Maaf, saya tidak mengerti.";
                        this.messages.push({ sender: 'bot', text: answerText, isResetButton: false });
                        this.messages.push({ sender: 'bot', text: '', isResetButton: true });
                        this.$nextTick(() => { this.scrollToBottom(); });
                    }, 500);
                },
                resetChat() {
                    this.messages = [];
                    this.showQuestions = true;
                },
                scrollToBottom() {
                    const chatbox = this.$refs.chatbox;
                    if (chatbox) chatbox.scrollTop = chatbox.scrollHeight;
                }
            }
        }
    </script>

    @stack('scripts')
</body>
</html>