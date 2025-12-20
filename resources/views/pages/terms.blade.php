{{-- resources/views/pages/terms.blade.php --}}

<x-app-layout>
    {{-- CSS Kustom untuk halaman Syarat & Ketentuan --}}
    <x-slot name="header">
        <style>
            .terms-gradient-banner {
                background: linear-gradient(90deg, rgba(109,40,217,1) 0%, rgba(190,24,93,1) 100%);
                padding: 4rem 1.5rem;
                border-radius: 12px;
                text-align: center;
                color: white;
                margin-top: 2rem; /* Jarak dari header */
                margin-bottom: 1.5rem; /* Jarak ke tanggal update */
            }
            .terms-gradient-banner h1 {
                font-size: 2.75rem; /* 44px */
                font-weight: 800;
                line-height: 1.2;
            }
            .terms-gradient-banner p {
                font-size: 1.125rem; /* 18px */
                margin-top: 0.5rem;
                opacity: 0.8;
            }
            .terms-content {
                max-width: 800px;
                margin: 0 auto;
                padding: 2rem 0; /* Padding atas bawah untuk konten */
                color: #374151; /* Warna teks gelap */
            }
            .updated-date {
                text-align: center;
                color: #6b7280; /* Warna abu-abu */
                margin-bottom: 2.5rem;
            }
            .terms-content h2 {
                font-size: 1.75rem; /* 28px */
                font-weight: 700;
                color: #6d28d9; /* Warna ungu primer dari tema */
                margin-top: 2.5rem;
                margin-bottom: 1rem;
                padding-bottom: 0.5rem;
                border-bottom: 2px solid #e5e7eb; /* Garis bawah tipis */
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
                color: #111827; /* Warna hitam untuk teks tebal */
            }
            .back-button {
                display: inline-block;
                margin-top: 3rem;
                padding: 0.75rem 1.5rem;
                background-color: #6d28d9; /* Warna ungu primer */
                color: #ffffff;
                border-radius: 8px;
                text-decoration: none;
                font-weight: 600;
                transition: background-color 0.2s ease;
                border: none;
            }
            .back-button:hover {
                background-color: #5b21b6; /* Warna ungu lebih gelap saat hover */
            }
        </style>
    </x-slot>

    <div class="bg-white">
        <div class="container mx-auto px-6">
            {{-- BANNER GRADIENT BARU --}}
            <div class="terms-gradient-banner">
                <h1>Syarat & Ketentuan</h1>
                <p>Pahami aturan main untuk pengalaman sewa terbaik.</p>
            </div>

            <div class="terms-content">
                <p class="updated-date">Terakhir diperbarui: 2 Oktober 2025</p>

                <p>Harap baca Syarat dan Ketentuan ini dengan seksama sebelum menggunakan layanan MY cell yang beroperasi di Kota Tegal. Akses Anda ke dan penggunaan Layanan kami bergantung pada penerimaan dan kepatuhan Anda terhadap Ketentuan ini.</p>

                <h2>1. Definisi</h2>
                <ul>
                    <li><strong>Penyewa:</strong> Individu atau pihak yang menyewa produk dari MY cell.</li>
                    <li><strong>Produk:</strong> Perangkat elektronik (gadget) yang disewakan oleh MY cell.</li>
                    <li><strong>Periode Sewa:</strong> Durasi waktu yang disepakati untuk penyewaan produk.</li>
                </ul>

                <h2>2. Kewajiban Penyewa</h2>
                <ul>
                    <li>Penyewa wajib memberikan data identitas yang valid (KTP/SIM/Kartu Mahasiswa) saat proses penyewaan.</li>
                    <li>Penyewa bertanggung jawab penuh atas produk yang disewa selama Periode Sewa.</li>
                    <li>Penyewa wajib menggunakan produk sesuai dengan fungsinya dan merawatnya dengan baik.</li>
                    <li>Dilarang membongkar, memodifikasi, atau memperbaiki produk tanpa persetujuan dari MY cell.</li>
                </ul>

                <h2>3. Kerusakan dan Kehilangan</h2>
                <p>Jika terjadi kerusakan atau kehilangan produk karena kelalaian Penyewa, maka Penyewa wajib mengganti biaya perbaikan atau mengganti produk dengan nilai yang setara, sesuai dengan kebijakan yang ditentukan oleh MY cell.</p>

                <div class="text-center"> {{-- Agar tombol di tengah --}}
                    <a href="{{ url('/') }}" class="back-button">&larr; Kembali ke Halaman Utama</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
