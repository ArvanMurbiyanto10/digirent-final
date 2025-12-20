<x-app-layout>
    {{-- Menggunakan CSS yang sama dari halaman Syarat & Ketentuan --}}
    <x-slot name="header">
        <style>
            .terms-gradient-banner {
                background: linear-gradient(90deg, rgba(109,40,217,1) 0%, rgba(190,24,93,1) 100%);
                padding: 4rem 1.5rem;
                border-radius: 12px;
                text-align: center;
                color: white;
                margin-top: 2rem;
                margin-bottom: 1.5rem;
            }
            .terms-gradient-banner h1 {
                font-size: 2.75rem;
                font-weight: 800;
                line-height: 1.2;
            }
            .terms-gradient-banner p {
                font-size: 1.125rem;
                margin-top: 0.5rem;
                opacity: 0.8;
            }
            .terms-content {
                max-width: 800px;
                margin: 0 auto;
                padding: 2rem 0;
                color: #374151;
            }
            .updated-date {
                text-align: center;
                color: #6b7280;
                margin-bottom: 2.5rem;
            }
            .terms-content h2 {
                font-size: 1.75rem;
                font-weight: 700;
                color: #6d28d9;
                margin-top: 2.5rem;
                margin-bottom: 1rem;
                padding-bottom: 0.5rem;
                border-bottom: 2px solid #e5e7eb;
            }
            .terms-content p, .terms-content li {
                font-size: 1rem;
                line-height: 1.75;
                text-align: justify;
            }
            .terms-content ul {
                list-style-position: inside;
                list-style-type: disc;
                padding-left: 1rem;
            }
            .terms-content strong {
                color: #111827;
            }
            .back-button {
                display: inline-block;
                margin-top: 3rem;
                padding: 0.75rem 1.5rem;
                background-color: #6d28d9;
                color: #ffffff;
                border-radius: 8px;
                text-decoration: none;
                font-weight: 600;
                transition: background-color 0.2s ease;
                border: none;
            }
            .back-button:hover {
                background-color: #5b21b6;
            }
        </style>
    </x-slot>

    <div class="bg-white">
        <div class="container mx-auto px-6">
            {{-- BANNER GRADIENT --}}
            <div class="terms-gradient-banner">
                <h1>Kebijakan Privasi</h1>
                <p>Kami menghargai dan melindungi privasi Anda.</p>
            </div>

            <div class="terms-content">
                <p class="updated-date">Terakhir diperbarui: 2 Oktober 2025</p>

                <p>Kebijakan Privasi ini menjelaskan bagaimana informasi Anda dikumpulkan, digunakan, dan dibagikan saat Anda menggunakan layanan MY cell.</p>

                <h2>1. Informasi yang Kami Kumpulkan</h2>
                <p>Kami mengumpulkan informasi yang Anda berikan langsung kepada kami, seperti:</p>
                <ul>
                    <li><strong>Informasi Akun:</strong> Nama, alamat email, nomor telepon, dan kata sandi saat Anda mendaftar.</li>
                    <li><strong>Informasi Identitas:</strong> Foto KTP/SIM/Kartu Mahasiswa untuk keperluan verifikasi penyewaan.</li>
                    <li><strong>Informasi Transaksi:</strong> Detail produk yang Anda sewa, durasi sewa, dan riwayat pembayaran.</li>
                </ul>

                <h2>2. Bagaimana Kami Menggunakan Informasi Anda</h2>
                <p>Informasi yang kami kumpulkan digunakan untuk:</p>
                <ul>
                    <li>Menyediakan, memelihara, dan meningkatkan Layanan kami.</li>
                    <li>Memproses transaksi dan mengirimkan informasi terkait, termasuk konfirmasi pemesanan dan faktur.</li>
                    <li>Memverifikasi identitas Anda untuk mencegah penipuan.</li>
                    <li>Berkomunikasi dengan Anda mengenai produk, layanan, penawaran, dan promosi.</li>
                </ul>

                <h2>3. Keamanan Data</h2>
                <p>Kami mengambil langkah-langkah yang wajar untuk membantu melindungi informasi Anda dari kehilangan, pencurian, penyalahgunaan, serta akses, pengungkapan, perubahan, dan perusakan yang tidak sah.</p>

                <div class="text-center">
                    <a href="{{ url('/') }}" class="back-button">&larr; Kembali ke Halaman Utama</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
