<!DOCTYPE html> {{-- Deklarasi tipe dokumen HTML5. --}}
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"> {{-- Tag pembuka HTML, mengatur bahasa sesuai konfigurasi Laravel. --}}

<head> {{-- Bagian kepala dokumen (metadata, style, script). --}}
    <meta charset="utf-8"> {{-- Mengatur encoding karakter ke UTF-8. --}}
    <meta name="viewport" content="width=device-width, initial-scale=1"> {{-- Mengatur viewport agar responsif di perangkat mobile. --}}
    <meta name="csrf-token" content="{{ csrf_token() }}"> {{-- Token CSRF untuk keamanan request AJAX (jika diperlukan). --}}
    <title>{{ config('app.name', 'DigiRent') }}</title> {{-- Judul halaman browser, mengambil dari config atau default 'DigiRent'. --}}

    <link rel="preconnect" href="https://fonts.bunny.net"> {{-- Optimasi koneksi ke server font Bunny. --}}
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" /> {{-- Memuat font 'Figtree'. --}}

    {{-- {{-- ======================================================== --}} {{-- Komentar Asli: Header bagian solusi path. --}}
    {{-- {{-- == SOLUSI ALTERNATIF (MENAMBAHKAN /public/) == --}} {{-- Komentar Asli: Menjelaskan solusi hosting. --}}
    {{-- {{-- ======================================================== --}} {{-- Komentar Asli: Penutup header. --}}

    {{-- {{-- Coba Link 1: Lewat path public --}} {{-- Komentar Asli: Penanda link CSS manual. --}}
    {{-- Memuat file CSS langsung dari folder public (Solusi untuk shared hosting/masalah Vite). --}}
    <link rel="stylesheet" href="https://mycell.web.id/public/build/assets/style.css">

    {{-- {{-- Alpine JS via CDN (Agar Chatbot PASTI JALAN) --}} {{-- Komentar Asli: Penanda script Alpine. --}}
    {{-- Memuat Alpine.js dari CDN agar logika Chatbot berjalan tanpa perlu build npm run build. --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    {{-- {{-- Script JS Bawaan (Opsional) --}} {{-- Komentar Asli: Penanda script JS manual. --}}
    {{-- Memuat file JS utama aplikasi (jika ada logika global lain). --}}
    <script src="https://mycell.web.id/public/build/assets/script.js" defer></script>

    @stack('styles') {{-- Slot untuk menyisipkan CSS tambahan dari view anak (child views). --}}
</head> {{-- Penutup tag head. --}}

<body class="font-sans antialiased"> {{-- Body dengan font default sans-serif dan antialiasing agar teks halus. --}}
    <div class="min-h-screen bg-white flex flex-col"> {{-- Wrapper utama: tinggi minimal setara layar, background putih, layout Flexbox kolom (untuk sticky footer). --}}

        @include('layouts.navigation') {{-- Memasukkan komponen Navbar (menu atas). --}}

        @isset($header) {{-- Cek jika variabel $header didefinisikan di view anak. --}}
            <header class="bg-indigo-100 shadow-md"> {{-- Header halaman (misal: Dashboard Title), background indigo muda. --}}
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8"> {{-- Container header dengan padding responsif. --}}
                    {{ $header }} {{-- Menampilkan isi slot header. --}}
                </div> {{-- Penutup container header. --}}
            </header> {{-- Penutup tag header. --}}
        @endisset {{-- Akhir pengecekan isset header. --}}

        <main class="flex-grow"> {{-- Bagian konten utama: 'flex-grow' membuat area ini mengisi ruang kosong agar footer terdorong ke bawah. --}}
            @if (isset($slot)) {{-- Cek jika menggunakan Component Layout ($slot). --}}
                {{ $slot }} {{-- Tampilkan konten slot. --}}
            @else {{-- Jika tidak menggunakan slot (menggunakan Template Inheritance @section). --}}
                @yield('content') {{-- Tampilkan bagian 'content'. --}}
            @endif {{-- Akhir pengecekan konten. --}}
        </main> {{-- Penutup tag main. --}}

        @include('layouts.footer') {{-- Memasukkan komponen Footer. --}}
    </div> {{-- Penutup wrapper utama. --}}

    {{-- {{-- =================================== --}} {{-- Komentar Asli: Header Chatbot UI. --}}
    {{-- {{-- == [CHATBOT UI] == --}} {{-- Komentar Asli: Judul Chatbot. --}}
    {{-- {{-- =================================== --}} {{-- Komentar Asli: Penutup header. --}}
    {{-- Container Chatbot: x-data inisialisasi state, x-cloak sembunyikan sebelum load, fixed di pojok kanan bawah. --}}
    <div x-data="chatbotData()" x-cloak class="fixed bottom-5 right-5 z-50 flex flex-col items-end">

        {{-- {{-- Jendela Chat --}} {{-- Komentar Asli: Penanda jendela chat. --}}
        {{-- Wrapper Jendela: Muncul jika chatOpen=true, animasi transisi (naik/turun), styling shadow dan border. --}}
        <div x-show="chatOpen" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 translate-y-4"
            class="w-80 sm:w-96 bg-white dark:bg-gray-800 rounded-lg shadow-xl border dark:border-gray-700 overflow-hidden mb-3 flex flex-col"
            style="height: 60vh; max-height: 500px;"> {{-- Inline style untuk membatasi tinggi maksimal jendela chat. --}}

            {{-- {{-- Header Chat --}} {{-- Komentar Asli: Penanda header chat. --}}
            <div class="flex-shrink-0 flex justify-between items-center bg-indigo-50 dark:bg-gray-700 px-4 py-3 border-b dark:border-gray-600"> {{-- Baris Judul Chat: Background beda, border bawah. --}}
                <h3 class="font-semibold text-gray-800 dark:text-gray-200">MY cell Assistant</h3> {{-- Nama Bot. --}}
                <button @click="toggleChat()" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300"> {{-- Tombol X (Close) di header. --}}
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"> {{-- Ikon Chevron Down/Close. --}}
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" /> {{-- Path ikon. --}}
                    </svg> {{-- Penutup SVG. --}}
                </button> {{-- Penutup tombol close. --}}
            </div> {{-- Penutup header chat. --}}

            {{-- {{-- Area Pesan --}} {{-- Komentar Asli: Penanda area scrolling pesan. --}}
            {{-- Container Pesan: Bisa discroll (overflow-y-auto), background putih/gelap. --}}
            <div class="p-4 flex-grow overflow-y-auto space-y-4 bg-white dark:bg-gray-800" x-ref="chatbox">
                {{-- {{-- Pesan Bot Awal --}} {{-- Komentar Asli: Pesan greeting default. --}}
                <div class="flex"> {{-- Wrapper pesan bot (rata kiri). --}}
                    <div class="bg-gray-100 dark:bg-gray-600 text-gray-800 dark:text-gray-200 p-3 rounded-lg max-w-[85%] text-sm shadow-sm"> {{-- Bubble chat bot. --}}
                        Halo! Ada yang bisa saya bantu? Silakan pilih salah satu pertanyaan di bawah ini. {{-- Teks sapaan. --}}
                    </div> {{-- Penutup bubble. --}}
                </div> {{-- Penutup wrapper pesan. --}}
                {{-- {{-- Pesan dinamis --}} {{-- Komentar Asli: Loop pesan chat. --}}
                <template x-for="(message, index) in messages" :key="index"> {{-- Loop array 'messages' dari Alpine.js. --}}
                    <div class="flex" :class="{ 'justify-end': message.sender === 'user', 'justify-start': message.sender === 'bot' }"> {{-- Pengaturan posisi: User (Kanan), Bot (Kiri). --}}
                        <div class="p-3 rounded-lg max-w-[85%] text-sm shadow-sm" {{-- Bubble chat umum. --}}
                            :class="{ 'bg-indigo-600 text-white': message.sender === 'user', 'bg-gray-100 dark:bg-gray-600 text-gray-800 dark:text-gray-200': !message.isResetButton, 'bg-white dark:bg-gray-800': message.isResetButton }"> {{-- Styling dinamis berdasarkan pengirim. --}}

                            <template x-if="!message.isResetButton"> {{-- Jika BUKAN tombol reset. --}}
                                <span x-html="message.text"></span> {{-- Tampilkan teks pesan (mendukung HTML break line <br>). --}}
                            </template> {{-- Akhir template teks biasa. --}}
                            <template x-if="message.isResetButton"> {{-- Jika INI adalah tombol reset. --}}
                                <button @click="resetChat()" class="text-sm text-indigo-600 dark:text-indigo-400 font-semibold underline hover:text-indigo-800"> {{-- Tombol Reset Chat. --}}
                                    Tanyakan hal lain? {{-- Teks tombol. --}}
                                </button> {{-- Penutup tombol reset. --}}
                            </template> {{-- Akhir template tombol reset. --}}
                        </div> {{-- Penutup bubble chat. --}}
                    </div> {{-- Penutup wrapper per pesan. --}}
                </template> {{-- Akhir loop pesan. --}}
            </div> {{-- Penutup area pesan. --}}

            {{-- {{-- Pilihan Pertanyaan (FIXED: Pastikan Background Terlihat) --}} {{-- Komentar Asli: Area tombol pilihan. --}}
            {{-- Area tombol pertanyaan: Muncul hanya jika 'showQuestions' true. --}}
            <div x-show="showQuestions" class="p-4 border-t border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 overflow-y-auto flex-shrink-0" style="max-height: 40%;">
                <div class="space-y-2"> {{-- Jarak vertikal antar tombol. --}}
                    <template x-for="(question, i) in questionButtons" :key="i"> {{-- Loop array pertanyaan. --}}
                       <button @click="askQuestion(question)" {{-- Event Click: Kirim pertanyaan ke fungsi askQuestion. --}}
                           class="w-full text-left text-sm font-medium p-3 rounded-md shadow-sm transition-all border
                                  text-white bg-indigo-600 hover:bg-indigo-700 border-indigo-500
                                  dark:text-white dark:bg-indigo-600 dark:hover:bg-indigo-500 dark:border-indigo-400"> {{-- Styling tombol pertanyaan (Indigo). --}}
                           <span x-text="question"></span> {{-- Teks pertanyaan. --}}
                       </button> {{-- Penutup button. --}}
                    </template> {{-- Akhir loop pertanyaan. --}}
                </div> {{-- Penutup space-y. --}}
            </div> {{-- Penutup area tombol pertanyaan. --}}

        </div> {{-- Penutup Jendela Chat Utama. --}}

        {{-- {{-- Tombol Floating Chat --}} {{-- Komentar Asli: Tombol bulat mengambang. --}}
        <button @click="toggleChat()" title="Buka Chat Bantuan" {{-- Tombol Pemicu: Toggle chatOpen. --}}
            class="bg-indigo-600 hover:bg-indigo-700 text-white rounded-full p-4 shadow-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition transform duration-300 hover:scale-110"> {{-- Styling tombol bulat besar, ungu, shadow, animasi hover. --}}
            <svg x-show="!chatOpen" class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"> {{-- Ikon Chat Bubble (Muncul saat chat tutup). --}}
                <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 12a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375M21 12c0 4.556-3.04 8.287-6.97 8.931c-.1.014-.2.019-.3.019H7.27c-.1-.001-.196-.005-.297-.019C3.04 20.287 0 16.556 0 12c0-4.556 3.04-8.287 6.97-8.931c.1-.014.2-.019-.3.019h9.46c.1 0 .2.005.3.019C17.96 3.713 21 7.444 21 12z" /> {{-- Path ikon bubble. --}}
            </svg> {{-- Penutup SVG bubble. --}}
            <svg x-show="chatOpen" class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"> {{-- Ikon X / Silang (Muncul saat chat buka). --}}
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /> {{-- Path ikon silang. --}}
            </svg> {{-- Penutup SVG silang. --}}
        </button> {{-- Penutup button floating. --}}

    </div> {{-- Penutup container chatbot. --}}

    {{-- {{-- =================================== --}} {{-- Komentar Asli: Header Logika JS. --}}
    {{-- {{-- == [LOGIKA CHATBOT DITANAM DISINI] == --}} {{-- Komentar Asli: Penjelasan inlining JS. --}}
    {{-- {{-- == (Agar tidak perlu build JS ulang) == --}} {{-- Komentar Asli: Alasan teknis. --}}
    {{-- {{-- =================================== --}} {{-- Komentar Asli: Penutup header. --}}
    <script> {{-- Pembuka Script JS. --}}
        function chatbotData() { {{-- Definisi fungsi data Alpine.js. --}}
            return { {{-- Mengembalikan objek data. --}}
                chatOpen: false, {{-- Status chat: false (tertutup) defaultnya. --}}
                showQuestions: true, {{-- Status tombol pertanyaan: true (terlihat) defaultnya. --}}
                messages: [], {{-- Array kosong untuk menampung riwayat chat. --}}
                questionButtons: [ {{-- Daftar pertanyaan yang bisa dipilih user. --}}
                    'Bagaimana cara menyewa gadget?', {{-- Pertanyaan 1. --}}
                    'Apa syarat penyewaan?', {{-- Pertanyaan 2. --}}
                    'Metode pembayaran apa yang tersedia?', {{-- Pertanyaan 3. --}}
                    'Apakah ada biaya keterlambatan?', {{-- Pertanyaan 4. --}}
                    'Hubungi Customer Service' {{-- Pertanyaan 5. --}}
                ], {{-- Penutup array pertanyaan. --}}
                answers: { {{-- Objek pemetaan (Mapping) Pertanyaan => Jawaban. --}}
                    'Bagaimana cara menyewa gadget?': 'Caranya mudah! <br>1. Login ke akun Anda.<br>2. Pilih produk di Katalog.<br>3. Klik "Sewa" dan tentukan tanggal.', {{-- Jawaban 1. --}}
                    'Apa syarat penyewaan?': 'Syarat utamanya adalah KTP asli dan akun yang sudah terverifikasi.', {{-- Jawaban 2. --}}
                    'Metode pembayaran apa yang tersedia?': 'Kami menerima Transfer Bank (BCA, Mandiri) dan E-Wallet (Gopay, OVO).', {{-- Jawaban 3. --}}
                    'Apakah ada biaya keterlambatan?': 'Ya, keterlambatan dikenakan denda harian 5% dari harga sewa.', {{-- Jawaban 4. --}}
                    'Hubungi Customer Service': 'Hubungi WA: <strong>08996122211</strong> atau Email: <strong>admin@mycell.web.id</strong>.' {{-- Jawaban 5 (Info Kontak). --}}
                }, {{-- Penutup objek jawaban. --}}
                toggleChat() { {{-- Fungsi untuk buka/tutup chat. --}}
                    this.chatOpen = !this.chatOpen; {{-- Toggle nilai boolean. --}}
                    if (this.chatOpen) { this.$nextTick(() => { this.scrollToBottom(); }); } {{-- Jika dibuka, scroll ke bawah otomatis. --}}
                }, {{-- Penutup toggleChat. --}}
                askQuestion(question) { {{-- Fungsi saat user klik pertanyaan. --}}
                    this.messages.push({ sender: 'user', text: question, isResetButton: false }); {{-- Tambahkan pesan user ke array. --}}
                    this.showQuestions = false; {{-- Sembunyikan daftar tombol pertanyaan. --}}
                    this.$nextTick(() => { this.scrollToBottom(); }); {{-- Scroll ke bawah. --}}

                    setTimeout(() => { {{-- Simulasi loading bot (delay 500ms). --}}
                        const answerText = this.answers[question] || "Maaf, saya tidak mengerti."; {{-- Ambil jawaban dari mapping. --}}
                        this.messages.push({ sender: 'bot', text: answerText, isResetButton: false }); {{-- Tambahkan pesan jawaban bot. --}}
                        this.messages.push({ sender: 'bot', text: '', isResetButton: true }); {{-- Tambahkan tombol "Tanyakan hal lain" sebagai pesan terpisah. --}}
                        this.$nextTick(() => { this.scrollToBottom(); }); {{-- Scroll ke bawah lagi. --}}
                    }, 500); {{-- Waktu delay. --}}
                }, {{-- Penutup askQuestion. --}}
                resetChat() { {{-- Fungsi untuk reset chat. --}}
                    this.messages = []; {{-- Kosongkan riwayat pesan. --}}
                    this.showQuestions = true; {{-- Tampilkan kembali tombol pertanyaan awal. --}}
                }, {{-- Penutup resetChat. --}}
                scrollToBottom() { {{-- Fungsi utilitas scroll. --}}
                    const chatbox = this.$refs.chatbox; {{-- Ambil elemen chatbox via x-ref. --}}
                    if (chatbox) chatbox.scrollTop = chatbox.scrollHeight; {{-- Set scroll position ke paling bawah. --}}
                } {{-- Penutup scrollToBottom. --}}
            } {{-- Penutup return object. --}}
        } {{-- Penutup fungsi chatbotData. --}}
    </script> {{-- Penutup tag script. --}}

    @stack('scripts') {{-- Slot untuk menyisipkan Script tambahan dari view anak. --}}
</body> {{-- Penutup body. --}}
</html> {{-- Penutup HTML. --}}
