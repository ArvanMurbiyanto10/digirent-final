{{-- resources/views/pages/terms.blade.php --}} {{-- Komentar file path: Lokasi file view ini. --}}

<x-app-layout> {{-- Menggunakan layout utama aplikasi (AppLayout) sebagai pembungkus halaman. --}}
    {{-- {{-- CSS Kustom untuk halaman Syarat & Ketentuan --}} {{-- Komentar asli Anda: Penjelasan style khusus. --}}
    <x-slot name="header"> {{-- Membuka slot 'header' untuk menyisipkan konten (style) ke bagian head layout. --}}
        <style> {{-- Pembuka tag CSS. --}}
            .terms-gradient-banner { /* Class untuk banner judul di atas dengan gradasi. */
                background: linear-gradient(90deg, rgba(109,40,217,1) 0%, rgba(190,24,93,1) 100%); /* Warna gradasi ungu ke pink. */
                padding: 4rem 1.5rem; /* Padding atas-bawah besar (4rem), kiri-kanan sedang. */
                border-radius: 12px; /* Sudut membulat untuk estetika modern. */
                text-align: center; /* Teks rata tengah. */
                color: white; /* Warna teks putih agar kontras dengan background. */
                margin-top: 2rem; /* Jarak dari header */ /* Komentar CSS asli. */
                margin-bottom: 1.5rem; /* Jarak ke tanggal update */ /* Komentar CSS asli. */
            }
            .terms-gradient-banner h1 { /* Styling untuk judul h1 di dalam banner. */
                font-size: 2.75rem; /* 44px */ /* Ukuran font besar dan mencolok. */
                font-weight: 800; /* Ketebalan font extra-bold. */
                line-height: 1.2; /* Jarak antar baris judul. */
            }
            .terms-gradient-banner p { /* Styling untuk deskripsi p di dalam banner. */
                font-size: 1.125rem; /* 18px */ /* Ukuran font sedang. */
                margin-top: 0.5rem; /* Jarak atas dari judul h1. */
                opacity: 0.8; /* Transparansi sedikit agar tidak secerah judul. */
            }
            .terms-content { /* Container utama untuk isi teks syarat & ketentuan. */
                max-width: 800px; /* Lebar maksimum dibatasi agar nyaman dibaca. */
                margin: 0 auto; /* Posisi rata tengah secara horizontal. */
                padding: 2rem 0; /* Padding atas bawah untuk konten */ /* Komentar CSS asli. */
                color: #374151; /* Warna teks gelap */ /* Warna abu-abu gelap (slate-700). */
            }
            .updated-date { /* Styling untuk teks tanggal update. */
                text-align: center; /* Rata tengah. */
                color: #6b7280; /* Warna abu-abu */ /* Warna abu-abu sedang (gray-500). */
                margin-bottom: 2.5rem; /* Jarak bawah cukup jauh sebelum masuk poin 1. */
            }
            .terms-content h2 { /* Styling untuk sub-judul poin (1, 2, 3...). */
                font-size: 1.75rem; /* 28px */ /* Ukuran font besar. */
                font-weight: 700; /* Tebal (bold). */
                color: #6d28d9; /* Warna ungu primer dari tema */ /* Ungu violet-700. */
                margin-top: 2.5rem; /* Jarak atas besar sebagai pemisah seksi. */
                margin-bottom: 1rem; /* Jarak bawah sedang. */
                padding-bottom: 0.5rem; /* Ruang di bawah teks sebelum border. */
                border-bottom: 2px solid #e5e7eb; /* Garis bawah tipis */ /* Garis pemisah abu-abu muda. */
            }
            .terms-content p, .terms-content li { /* Styling umum untuk paragraf dan list item. */
                font-size: 1rem; /* Ukuran standar. */
                line-height: 1.75; /* Jarak antar baris agak renggang (relaxed). */
                text-align: justify; /* Teks rata kiri-kanan. */
            }
            .terms-content ul { /* Styling untuk daftar bullet points. */
                list-style-position: inside; /* Bullet point ada di dalam area konten (tidak menjorok keluar). */
                list-style-type: disc; /* Bentuk bullet lingkaran padat. */
                padding-left: 1rem; /* Indentasi kiri untuk hierarki. */
            }
            .terms-content strong { /* Styling untuk teks tebal. */
                color: #111827; /* Warna hitam untuk teks tebal */ /* Hitam pekat (gray-900). */
            }
            .back-button { /* Styling tombol "Kembali". */
                display: inline-block; /* Agar properti padding/margin berfungsi seperti blok. */
                margin-top: 3rem; /* Jarak atas besar dari konten terakhir. */
                padding: 0.75rem 1.5rem; /* Padding dalam tombol. */
                background-color: #6d28d9; /* Warna ungu primer */ /* Warna latar tombol. */
                color: #ffffff; /* Warna teks tombol putih. */
                border-radius: 8px; /* Sudut membulat. */
                text-decoration: none; /* Hilangkan garis bawah link. */
                font-weight: 600; /* Font tebal. */
                transition: background-color 0.2s ease; /* Transisi halus saat hover. */
                border: none; /* Tanpa border garis. */
            }
            .back-button:hover { /* Efek saat kursor di atas tombol. */
                background-color: #5b21b6; /* Warna ungu lebih gelap saat hover */ /* Efek visual interaktif. */
            }
        </style> {{-- Penutup tag CSS. --}}
    </x-slot> {{-- Penutup slot header. --}}

    <div class="bg-white"> {{-- Wrapper utama konten dengan background putih penuh. --}}
        <div class="container mx-auto px-6"> {{-- Container responsif, rata tengah, padding kiri-kanan. --}}
            {{-- {{-- BANNER GRADIENT BARU --}} {{-- Komentar asli Anda: Penanda banner. --}}
            <div class="terms-gradient-banner"> {{-- Menggunakan class CSS banner gradasi. --}}
                <h1>Syarat & Ketentuan</h1> {{-- Judul Utama Halaman. --}}
                <p>Pahami aturan main untuk pengalaman sewa terbaik.</p> {{-- Sub-judul/Slogan. --}}
            </div> {{-- Penutup div banner. --}}

            <div class="terms-content"> {{-- Container untuk isi teks (lebar terbatas 800px). --}}
                <p class="updated-date">Terakhir diperbarui: 2 Oktober 2025</p> {{-- Informasi tanggal pembaruan dokumen. --}}

                <p>Harap baca Syarat dan Ketentuan ini dengan seksama sebelum menggunakan layanan MY cell yang beroperasi di Kota Tegal. Akses Anda ke dan penggunaan Layanan kami bergantung pada penerimaan dan kepatuhan Anda terhadap Ketentuan ini.</p> {{-- Paragraf pembuka. --}}

                <h2>1. Definisi</h2> {{-- Poin 1: Judul Seksi. --}}
                <ul> {{-- Daftar definisi istilah. --}}
                    <li><strong>Penyewa:</strong> Individu atau pihak yang menyewa produk dari MY cell.</li> {{-- Definisi Penyewa. --}}
                    <li><strong>Produk:</strong> Perangkat elektronik (gadget) yang disewakan oleh MY cell.</li> {{-- Definisi Produk. --}}
                    <li><strong>Periode Sewa:</strong> Durasi waktu yang disepakati untuk penyewaan produk.</li> {{-- Definisi Periode. --}}
                </ul> {{-- Penutup list. --}}

                <h2>2. Kewajiban Penyewa</h2> {{-- Poin 2: Judul Seksi. --}}
                <ul> {{-- Daftar kewajiban. --}}
                    <li>Penyewa wajib memberikan data identitas yang valid (KTP/SIM/Kartu Mahasiswa) saat proses penyewaan.</li> {{-- Kewajiban 1: Identitas. --}}
                    <li>Penyewa bertanggung jawab penuh atas produk yang disewa selama Periode Sewa.</li> {{-- Kewajiban 2: Tanggung jawab. --}}
                    <li>Penyewa wajib menggunakan produk sesuai dengan fungsinya dan merawatnya dengan baik.</li> {{-- Kewajiban 3: Penggunaan. --}}
                    <li>Dilarang membongkar, memodifikasi, atau memperbaiki produk tanpa persetujuan dari MY cell.</li> {{-- Kewajiban 4: Larangan modifikasi. --}}
                </ul> {{-- Penutup list. --}}

                <h2>3. Kerusakan dan Kehilangan</h2> {{-- Poin 3: Judul Seksi. --}}
                <p>Jika terjadi kerusakan atau kehilangan produk karena kelalaian Penyewa, maka Penyewa wajib mengganti biaya perbaikan atau mengganti produk dengan nilai yang setara, sesuai dengan kebijakan yang ditentukan oleh MY cell.</p> {{-- Penjelasan sanksi kerusakan/kehilangan. --}}

                <div class="text-center"> {{-- {{-- Agar tombol di tengah --}} {{-- Wrapper tombol, rata tengah. --}}
                    <a href="{{ url('/') }}" class="back-button">&larr; Kembali ke Halaman Utama</a> {{-- Tombol kembali ke home ('/'). --}}
                </div> {{-- Penutup wrapper tombol. --}}
            </div> {{-- Penutup terms-content. --}}
        </div> {{-- Penutup container. --}}
    </div> {{-- Penutup bg-white. --}}
</x-app-layout> {{-- Penutup layout utama. --}}
