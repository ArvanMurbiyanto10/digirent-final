<x-app-layout> {{-- Menggunakan layout utama aplikasi sebagai pembungkus halaman. --}}
    {{-- {{-- Menggunakan CSS yang sama dari halaman Syarat & Ketentuan --}} {{-- Komentar asli Anda. --}}
    <x-slot name="header"> {{-- Membuka slot header untuk menyisipkan style khusus halaman ini. --}}
        <style>
            /* Class untuk banner judul dengan background gradasi */
            .terms-gradient-banner {
                background: linear-gradient(90deg, rgba(109, 40, 217, 1) 0%, rgba(190, 24, 93, 1) 100%);
                /* Warna gradasi ungu ke pink */
                padding: 4rem 1.5rem;
                /* Ruang dalam atas-bawah besar, kiri-kanan sedang */
                border-radius: 12px;
                /* Sudut membulat */
                text-align: center;
                /* Teks rata tengah */
                color: white;
                /* Warna teks putih */
                margin-top: 2rem;
                /* Jarak luar atas */
                margin-bottom: 1.5rem;
                /* Jarak luar bawah */
            }

            /* Styling judul h1 di dalam banner */
            .terms-gradient-banner h1 {
                font-size: 2.75rem;
                /* Ukuran font sangat besar */
                font-weight: 800;
                /* Ketebalan font sangat tebal */
                line-height: 1.2;
                /* Jarak antar baris */
            }

            /* Styling deskripsi p di dalam banner */
            .terms-gradient-banner p {
                font-size: 1.125rem;
                /* Ukuran font agak besar */
                margin-top: 0.5rem;
                /* Jarak dari judul */
                opacity: 0.8;
                /* Transparansi sedikit agar tidak secerah judul */
            }

            /* Container utama untuk teks konten kebijakan */
            .terms-content {
                max-width: 800px;
                /* Lebar maksimal 800px agar nyaman dibaca (tidak terlalu lebar) */
                margin: 0 auto;
                /* Posisi rata tengah secara horizontal */
                padding: 2rem 0;
                /* Padding vertikal */
                color: #374151;
                /* Warna teks abu-abu gelap */
            }

            /* Styling tanggal update */
            .updated-date {
                text-align: center;
                /* Rata tengah */
                color: #6b7280;
                /* Warna abu-abu sedang */
                margin-bottom: 2.5rem;
                /* Jarak bawah cukup jauh sebelum masuk ke poin 1 */
            }

            /* Styling sub-judul (Poin 1, 2, 3) */
            .terms-content h2 {
                font-size: 1.75rem;
                /* Ukuran font besar */
                font-weight: 700;
                /* Tebal */
                color: #6d28d9;
                /* Warna ungu utama */
                margin-top: 2.5rem;
                /* Jarak atas */
                margin-bottom: 1rem;
                /* Jarak bawah */
                padding-bottom: 0.5rem;
                /* Ruang di bawah teks sebelum garis */
                border-bottom: 2px solid #e5e7eb;
                /* Garis bawah tipis warna abu-abu */
            }

            /* Styling paragraf dan list item */
            .terms-content p,
            .terms-content li {
                font-size: 1rem;
                /* Ukuran standar */
                line-height: 1.75;
                /* Jarak antar baris agak renggang agar mudah dibaca */
                text-align: justify;
                /* Rata kiri-kanan */
            }

            /* Styling daftar bullet points */
            .terms-content ul {
                list-style-position: inside;
                /* Bullet point ada di dalam area konten */
                list-style-type: disc;
                /* Bentuk bullet lingkaran padat */
                padding-left: 1rem;
                /* Indentasi kiri */
            }

            /* Styling teks tebal di dalam konten */
            .terms-content strong {
                color: #111827;
                /* Warna hitam pekat */
            }

            /* Styling tombol kembali */
            .back-button {
                display: inline-block;
                /* Agar properti padding berfungsi */
                margin-top: 3rem;
                /* Jarak atas */
                padding: 0.75rem 1.5rem;
                /* Padding tombol */
                background-color: #6d28d9;
                /* Warna latar ungu */
                color: #ffffff;
                /* Teks putih */
                border-radius: 8px;
                /* Sudut membulat */
                text-decoration: none;
                /* Hilangkan garis bawah link */
                font-weight: 600;
                /* Font semi-bold */
                transition: background-color 0.2s ease;
                /* Efek transisi halus saat hover */
                border: none;
                /* Tanpa border */
            }

            /* Efek hover pada tombol kembali */
            .back-button:hover {
                background-color: #5b21b6;
                /* Warna ungu lebih gelap saat disentuh kursor */
            }
        </style> {{-- Penutup tag style. --}}
    </x-slot> {{-- Penutup slot header. --}}

    <div class="bg-white"> {{-- Wrapper background putih penuh. --}}
        <div class="container mx-auto px-6"> {{-- Container responsif dengan padding kiri-kanan. --}}
            {{-- {{-- BANNER GRADIENT --}} {{-- Komentar asli Anda: Penanda banner. --}}
            <div class="terms-gradient-banner"> {{-- Menggunakan class CSS banner gradasi di atas. --}}
                <h1>Kebijakan Privasi</h1> {{-- Judul Halaman. --}}
                <p>Kami menghargai dan melindungi privasi Anda.</p> {{-- Sub-judul. --}}
            </div> {{-- Penutup div banner. --}}

            <div class="terms-content"> {{-- Mulai area konten teks (lebar max 800px). --}}
                <p class="updated-date">Terakhir diperbarui: 2 Oktober 2025</p> {{-- Tanggal pembaruan dokumen. --}}

                <p>Kebijakan Privasi ini menjelaskan bagaimana informasi Anda dikumpulkan, digunakan, dan dibagikan saat
                    Anda menggunakan layanan MY cell.</p> {{-- Paragraf pembuka. --}}

                <h2>1. Informasi yang Kami Kumpulkan</h2> {{-- Sub-bab 1. --}}
                <p>Kami mengumpulkan informasi yang Anda berikan langsung kepada kami, seperti:</p>
                <ul> {{-- List poin informasi yang dikumpulkan. --}}
                    <li><strong>Informasi Akun:</strong> Nama, alamat email, nomor telepon, dan kata sandi saat Anda
                        mendaftar.</li>
                    <li><strong>Informasi Identitas:</strong> Foto KTP/SIM/Kartu Mahasiswa untuk keperluan verifikasi
                        penyewaan.</li>
                    <li><strong>Informasi Transaksi:</strong> Detail produk yang Anda sewa, durasi sewa, dan riwayat
                        pembayaran.</li>
                </ul> {{-- Penutup list. --}}

                <h2>2. Bagaimana Kami Menggunakan Informasi Anda</h2> {{-- Sub-bab 2. --}}
                <p>Informasi yang kami kumpulkan digunakan untuk:</p>
                <ul> {{-- List penggunaan data. --}}
                    <li>Menyediakan, memelihara, dan meningkatkan Layanan kami.</li>
                    <li>Memproses transaksi dan mengirimkan informasi terkait, termasuk konfirmasi pemesanan dan faktur.
                    </li>
                    <li>Memverifikasi identitas Anda untuk mencegah penipuan.</li>
                    <li>Berkomunikasi dengan Anda mengenai produk, layanan, penawaran, dan promosi.</li>
                </ul> {{-- Penutup list. --}}

                <h2>3. Keamanan Data</h2> {{-- Sub-bab 3. --}}
                <p>Kami mengambil langkah-langkah yang wajar untuk membantu melindungi informasi Anda dari kehilangan,
                    pencurian, penyalahgunaan, serta akses, pengungkapan, perubahan, dan perusakan yang tidak sah.</p>
                {{-- Paragraf keamanan. --}}

                <div class="text-center"> {{-- Wrapper tombol rata tengah. --}}
                    <a href="{{ url('/') }}" class="back-button">&larr; Kembali ke Halaman Utama</a> {{-- Tombol kembali
                    ke home ('/'). --}}
                </div> {{-- Penutup wrapper tombol. --}}
            </div> {{-- Penutup terms-content. --}}
        </div> {{-- Penutup container. --}}
    </div> {{-- Penutup bg-white. --}}
</x-app-layout> {{-- Penutup layout utama. --}}