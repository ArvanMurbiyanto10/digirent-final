import './bootstrap';

import Alpine from 'alpinejs';
import intersect from '@alpinejs/intersect';

// --- MULAI KODE CHATBOT ---

// Data FAQ (diambil dari welcome.blade.php Anda)
const faqData = [
    {
        question: "Apa saja syarat untuk menyewa di DigiRent?",
        keywords: ["syarat", "sewa", "identitas", "ktp", "jaminan"],
        answer: "Untuk menyewa, Anda hanya perlu menyiapkan identitas diri (KTP/SIM) yang masih berlaku dan melakukan pembayaran sesuai tagihan. Untuk beberapa item khusus, mungkin diperlukan jaminan tambahan."
    },
    {
        question: "Bagaimana jika gadget yang saya sewa rusak?",
        keywords: ["rusak", "gadget", "kerusakan", "tanggung jawab", "biaya", "ganti", "hilang"],
        answer: "Kami memahami bahwa kecelakaan bisa terjadi. Jika terjadi kerusakan ringan karena pemakaian wajar, biasanya tidak ada biaya tambahan. Namun, untuk kerusakan berat atau kehilangan, Anda mungkin akan dikenakan biaya perbaikan atau penggantian sesuai syarat dan ketentuan."
    },
    {
        question: "Apakah saya bisa memperpanjang masa sewa?",
        keywords: ["perpanjang", "sewa", "masa", "waktu", "tambah", "durasi"],
        answer: "Tentu saja! Anda bisa mengajukan perpanjangan sewa melalui dashboard akun Anda atau menghubungi customer service kami sebelum masa sewa berakhir, selama item tersebut belum dipesan oleh orang lain."
    },
    {
        question: "Apakah gadget bisa diantar ke lokasi saya?",
        keywords: ["antar", "jemput", "lokasi", "pengiriman", "cod", "kirim"],
        answer: "Ya, kami melayani pengantaran dan penjemputan untuk area Purwokerto dengan biaya tambahan yang terjangkau. Anda juga bisa mengambil dan mengembalikan langsung ke lokasi kami."
    },
    // == TAMBAHAN PERTANYAAN BARU ANDA ==
    {
        question: "Apa syarat dan ketentuan?",
        keywords: ["syarat", "ketentuan", "terms"],
        answer: "Anda dapat membaca Syarat & Ketentuan lengkap kami di halaman <a href='/syarat-ketentuan' target='_blank' class='text-indigo-600 dark:text-indigo-400 underline'>Syarat & Ketentuan</a>."
    },
    {
        question: "Apa kebijakan privasi?",
        keywords: ["privasi", "kebijakan", "data", "aman"],
        answer: "Kami menjaga data Anda. Silakan baca detail lengkapnya di halaman <a href='/kebijakan-privasi' target='_blank' class='text-indigo-600 dark:text-indigo-400 underline'>Kebijakan Privasi</a>."
    },
    {
        question: "Dimana lokasi penyewaan?",
        keywords: ["lokasi", "alamat", "tempat", "dimana"],
        answer: "Lokasi kami berada di [**ISI ALAMAT LENGKAP ANDA DI SINI**]. Anda bisa mengambil dan mengembalikan gadget langsung ke lokasi kami."
    },
    {
        question: "Kenapa memilih DigiRent?",
        keywords: ["kenapa", "keunggulan", "memilih", "benefits"],
        answer: "Kami menawarkan gadget berkualitas premium, proses sewa yang mudah dan fleksibel, serta harga yang terjangkau. Fokus kami adalah kepuasan Anda!"
    },
    {
        question: "Tersedia brand apa saja?",
        keywords: ["brand", "merek", "tersedia", "apple", "samsung", "asus"],
        answer: "Kami menyediakan berbagai brand terkemuka seperti Apple, Samsung, Xiaomi, Oppo, Vivo, Asus, ROG, dan lainnya. Cek halaman produk untuk katalog lengkap."
    }
];

// Definisikan fungsi chatbot
function chatbot() {
    return {
        chatOpen: false,
        messages: [], // Array untuk menyimpan riwayat chat
        faq: faqData,
        showQuestions: true, // Status untuk menampilkan tombol pertanyaan

        // Daftar pertanyaan untuk tombol
        questionButtons: [
            "Apa saja syarat untuk menyewa di DigiRent?",
            "Bagaimana jika gadget yang saya sewa rusak?",
            "Apakah saya bisa memperpanjang masa sewa?",
            "Apakah gadget bisa diantar ke lokasi saya?",
            "Apa syarat dan ketentuan?",
            "Apa kebijakan privasi?",
            "Dimana lokasi penyewaan?",
            "Kenapa memilih DigiRent?",
            "Tersedia brand apa saja?"
        ],

        toggleChat() {
            this.chatOpen = !this.chatOpen;
            if (this.chatOpen) {
                this.resetChat(); // Selalu reset saat dibuka
            }
        },

        // Fungsi baru untuk mengirim pertanyaan dari tombol
        askQuestion(questionText) {
            // 1. Tampilkan pertanyaan pengguna
            this.messages.push({ sender: 'user', text: this.escapeHtml(questionText) });
            this.showQuestions = false; // Sembunyikan tombol pertanyaan
            this.scrollToBottom();

            // 2. Cari dan tampilkan jawaban bot
            this.findAnswer(questionText);
        },

        findAnswer(questionText) {
            const lowerUserText = questionText.toLowerCase();
            let botResponse = '';

            // Cari jawaban berdasarkan teks pertanyaan yang sama persis
            const foundFaq = this.faq.find(item => item.question.toLowerCase() === lowerUserText);

            if (foundFaq) {
                botResponse = foundFaq.answer;
            } else {
                // Jawaban fallback jika (seharusnya tidak terjadi)
                botResponse = "Maaf, terjadi kesalahan. Silakan coba pertanyaan lain.";
            }

            // Tampilkan jawaban bot
            setTimeout(() => {
                this.messages.push({ sender: 'bot', text: botResponse });
                this.scrollToBottom();

                // (Opsional) Tampilkan tombol "Tanya lagi?" setelah jawaban
                setTimeout(() => {
                    this.messages.push({ sender: 'bot', text: 'Ada lagi yang bisa saya bantu?', isResetButton: true });
                    this.scrollToBottom();
                }, 800);

            }, 600);
        },

        // Fungsi baru untuk mereset chat ke tampilan awal
        resetChat() {
            this.messages = [];
            this.showQuestions = true;
            this.scrollToBottom();
        },

        // Fungsi bantu scroll
        scrollToBottom() {
            this.$nextTick(() => {
                if(this.$refs.chatbox) {
                    this.$refs.chatbox.scrollTop = this.$refs.chatbox.scrollHeight;
                }
            });
        },

        // Fungsi bantu escape HTML
        escapeHtml(unsafe) {
            if (!unsafe) return '';
            return unsafe
                 .replace(/&/g, "&amp;")
                 .replace(/</g, "&lt;")
                 .replace(/>/g, "&gt;")
                 .replace(/"/g, "&quot;")
                 .replace(/'/g, "&#039;");
        }
    }
}

// Daftarkan 'chatbot' ke Alpine
Alpine.data('chatbot', chatbot);

// --- AKHIR KODE CHATBOT ---

window.Alpine = Alpine;
Alpine.plugin(intersect);
Alpine.start();
