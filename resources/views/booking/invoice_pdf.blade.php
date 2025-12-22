<!DOCTYPE html> {{-- Deklarasi tipe dokumen HTML5. --}}
<html lang="id"> {{-- Tag pembuka HTML dengan pengaturan bahasa Indonesia. --}}

<head> {{-- Bagian kepala dokumen untuk metadata dan style. --}}
    <meta charset="UTF-8"> {{-- Pengaturan encoding karakter UTF-8. --}}
    {{-- {{-- [UBAH] Judul Tab/File --}} {{-- Komentar asli Anda: Penanda bagian judul. --}}
    <title>Bukti Pembayaran #{{ $booking->id }} - MY cell</title> {{-- Judul halaman/PDF: Dinamis menggunakan ID Booking dan nama toko. --}}
    <style> {{-- Pembuka tag CSS untuk styling halaman. --}}
        :root { /* Mendefinisikan variabel CSS global (root). */
            /* Warna Merah MY cell */ /* Komentar asli Anda: Keterangan warna. */
            --primary-color: #e53935; /* Variabel warna utama (merah). */
            --secondary-color: #f3f4f6; /* Variabel warna sekunder (abu-abu muda). */
        } /* Penutup selektor :root. */

        body { /* Styling untuk body halaman. */
            font-family: 'Helvetica', 'Arial', sans-serif; /* Font family yang aman untuk PDF (Helvetica/Arial). */
            color: #374151; /* Warna teks utama (abu-abu gelap). */
            font-size: 14px; /* Ukuran font dasar. */
            line-height: 1.6; /* Jarak antar baris teks agar mudah dibaca. */
            background-color: #fff; /* Latar belakang putih. */
        } /* Penutup styling body. */

        .invoice-box { /* Styling untuk container utama invoice. */
            width: 100%; /* Lebar penuh. */
            max-width: 800px; /* Lebar maksimal 800px agar rapi. */
            margin: auto; /* Posisi tengah (auto margin). */
            padding: 0; /* Tanpa padding (padding diatur di elemen dalam). */
            position: relative; /* Posisi relatif untuk referensi elemen absolut (seperti watermark). */
        } /* Penutup styling .invoice-box. */

        .watermark { /* Styling untuk teks watermark latar belakang. */
            position: absolute; /* Posisi absolut terhadap .invoice-box. */
            top: 35%; /* Posisi vertikal 35% dari atas. */
            left: 50%; /* Posisi horizontal 50% dari kiri (tengah). */
            transform: translate(-50%, -50%) rotate(-45deg); /* Geser ke tengah sempurna dan putar 45 derajat. */
            font-size: 80px; /* Ukuran font sangat besar. */
            /* Ukuran disesuaikan agar muat */ /* Komentar asli Anda. */
            color: #f3f4f6; /* Warna abu-abu sangat muda (samar). */
            font-weight: bold; /* Ketebalan font tebal. */
            opacity: 0.8; /* Transparansi 80%. */
            z-index: -1; /* Letakkan di belakang konten lain. */
            text-align: center; /* Rata tengah. */
            width: 100%; /* Lebar penuh. */
        } /* Penutup styling .watermark. */

        .header { /* Styling untuk bagian kepala invoice (header). */
            background-color: var(--primary-color); /* Background merah (dari variabel). */
            color: #fff; /* Warna teks putih. */
            padding: 40px 30px; /* Padding atas-bawah 40px, kiri-kanan 30px. */
            text-align: left; /* Teks rata kiri. */
        } /* Penutup styling .header. */

        .header h1 { /* Styling untuk judul h1 di header. */
            margin: 0; /* Hapus margin default. */
            font-size: 28px; /* Ukuran font judul besar. */
            /* Sedikit diperkecil agar tidak terlalu panjang */ /* Komentar asli Anda. */
            font-weight: bold; /* Font tebal. */
            text-transform: uppercase; /* Ubah teks menjadi huruf kapital semua. */
            letter-spacing: 1px; /* Jarak antar huruf. */
        } /* Penutup styling .header h1. */

        .header p { /* Styling untuk paragraf di header (alamat). */
            margin: 5px 0 0 0; /* Margin atas 5px, sisanya 0. */
            font-size: 14px; /* Ukuran font alamat. */
        } /* Penutup styling .header p. */

        .content { /* Styling untuk area konten utama. */
            padding: 30px; /* Padding di sekeliling konten. */
        } /* Penutup styling .content. */

        .details-section { /* Styling untuk bagian detail informasi (bill to & info). */
            margin-bottom: 40px; /* Jarak bawah. */
            overflow: hidden; /* Mencegah overflow float (clearfix sederhana). */
        } /* Penutup styling .details-section. */

        .details-section .billed-to, /* Selektor untuk bagian "Diterima Dari". */
        .details-section .invoice-info { /* Selektor untuk bagian "Info Invoice". */
            width: 48%; /* Lebar masing-masing kolom (hampir setengah). */
        } /* Penutup styling kolom detail. */

        .details-section .billed-to { /* Styling khusus kolom kiri. */
            float: left; /* Mengambang ke kiri. */
        } /* Penutup styling .billed-to. */

        .details-section .invoice-info { /* Styling khusus kolom kanan. */
            float: right; /* Mengambang ke kanan. */
            text-align: right; /* Teks rata kanan. */
        } /* Penutup styling .invoice-info. */

        .details-section h3 { /* Styling judul h3 di section detail. */
            margin: 0 0 5px 0; /* Margin bawah 5px. */
            font-size: 12px; /* Ukuran font kecil. */
            color: #6b7280; /* Warna abu-abu medium. */
            text-transform: uppercase; /* Huruf kapital. */
            letter-spacing: 0.5px; /* Spasi antar huruf. */
        } /* Penutup styling h3. */

        .status-badge { /* Styling dasar untuk badge status. */
            display: inline-block; /* Perilaku inline-block. */
            padding: 2px 8px; /* Padding kecil. */
            /* REVISI: Padding diperkecil agar lebih ramping */ /* Komentar asli Anda. */
            border-radius: 4px; /* Sudut sedikit membulat. */
            /* REVISI: Radius dikurangi agar tidak terlalu bulat (opsional) */ /* Komentar asli Anda. */
            color: #fff; /* Warna teks putih. */
            font-weight: bold; /* Font tebal. */
            font-size: 11px; /* Ukuran font kecil. */
            /* REVISI: Font sedikit diperkecil agar proporsional */ /* Komentar asli Anda. */
            text-transform: capitalize; /* Huruf pertama kapital. */
            line-height: 1.2; /* Tinggi baris. */
            /* REVISI: Line-height ditambahkan untuk kerapian vertikal */ /* Komentar asli Anda. */
            vertical-align: middle; /* Penjajaran vertikal tengah. */
            /* REVISI: Menjaga posisi teks tetap di tengah baris */ /* Komentar asli Anda. */
        } /* Penutup styling dasar badge. */

        .status-badge { /* Redefinisi/Override styling badge (kode Anda memiliki duplikasi di sini). */
            display: inline-block; /* Inline block. */
            padding: 4px 12px; /* Padding lebih besar dari sebelumnya. */
            border-radius: 9999px; /* Sudut sangat bulat (pill shape). */
            color: #fff; /* Teks putih. */
            font-weight: bold; /* Tebal. */
            font-size: 12px; /* Ukuran font. */
            text-transform: capitalize; /* Kapitalisasi. */
        } /* Penutup override badge. */

        .status-pending { /* Styling khusus status 'pending'. */
            background-color: #f59e0b; /* Warna oranye/kuning. */
        } /* Penutup styling pending. */

        .status-confirmed { /* Styling khusus status 'confirmed'. */
            background-color: #10b981; /* Warna hijau. */
        } /* Penutup styling confirmed. */

        .items-table { /* Styling tabel item barang. */
            width: 100%; /* Lebar penuh. */
            border-collapse: collapse; /* Gabungkan border sel. */
            margin-bottom: 30px; /* Jarak bawah. */
        } /* Penutup styling .items-table. */

        .items-table th { /* Styling header tabel item. */
            padding: 12px 8px; /* Padding sel header. */
            text-align: left; /* Rata kiri. */
            font-weight: bold; /* Font tebal. */
            border-bottom: 2px solid #e5e7eb; /* Garis bawah header tebal. */
        } /* Penutup styling th. */

        .items-table td { /* Styling sel data tabel item. */
            padding: 15px 8px; /* Padding sel data. */
            border-bottom: 1px solid #e5e7eb; /* Garis bawah tipis antar baris. */
        } /* Penutup styling td. */

        .items-table tr:nth-child(even) { /* Styling baris genap (zebra striping). */
            background-color: var(--secondary-color); /* Warna latar abu-abu muda. */
        } /* Penutup styling baris genap. */

        .items-table .text-right { /* Helper class rata kanan dalam tabel. */
            text-align: right; /* Rata kanan. */
        } /* Penutup styling text-right. */

        .summary-section { /* Styling container ringkasan harga. */
            float: right; /* Mengambang ke kanan. */
            width: 50%; /* Lebar setengah container. */
        } /* Penutup styling summary-section. */

        .summary-table { /* Styling tabel ringkasan. */
            width: 100%; /* Lebar penuh. */
        } /* Penutup styling summary-table. */

        .summary-table td { /* Styling sel tabel ringkasan. */
            padding: 5px 8px; /* Padding kecil. */
        } /* Penutup styling td summary. */

        .summary-table .grand-total td { /* Styling baris Total Akhir. */
            font-size: 18px; /* Font besar. */
            font-weight: bold; /* Font tebal. */
            padding-top: 15px; /* Jarak atas ekstra. */
            border-top: 2px solid #e5e7eb; /* Garis pemisah atas tebal. */
        } /* Penutup styling grand-total. */

        .summary-table .grand-total .total-amount { /* Styling nominal total akhir. */
            color: var(--primary-color); /* Warna merah utama. */
        } /* Penutup styling total-amount. */

        .footer { /* Styling bagian kaki invoice. */
            margin-top: 50px; /* Jarak atas besar. */
            padding-top: 20px; /* Padding atas. */
            border-top: 1px solid #e5e7eb; /* Garis pemisah atas tipis. */
            text-align: center; /* Rata tengah. */
            font-size: 12px; /* Font kecil. */
            color: #9ca3af; /* Warna abu-abu pudar. */
        } /* Penutup styling footer. */
    </style> {{-- Penutup tag CSS. --}}
</head> {{-- Penutup tag head. --}}

<body> {{-- Pembuka body dokumen. --}}
    <div class="invoice-box"> {{-- Wrapper utama invoice. --}}
        {{-- {{-- Watermark --}} {{-- Komentar asli Anda: Penanda watermark. --}}
        <div class="watermark">LUNAS</div> {{-- Teks watermark "LUNAS" di background. --}}

        <div class="header"> {{-- Bagian header berwarna merah. --}}
            {{-- {{-- [UBAH] Judul Utama --}} {{-- Komentar asli Anda: Penanda judul utama. --}}
            <h1>Bukti Pembayaran MY cell</h1> {{-- Judul toko/invoice. --}}
            <p>Jalan Batanghari No. 7, Kecamatan Tegal Timur, Kota Tegal, Jawa Tengah</p> {{-- Alamat toko. --}}
        </div> {{-- Penutup header. --}}

        <div class="content"> {{-- Bagian konten isi invoice. --}}
            <div class="details-section"> {{-- Bagian detail informasi pelanggan & invoice. --}}
                <div class="billed-to"> {{-- Kolom Kiri: Informasi Pelanggan. --}}
                    <h3>Diterima Dari</h3> {{-- Label section. --}}
                    <strong>{{ $booking->user->name }}</strong><br> {{-- Nama user dari relasi booking. --}}
                    {{ $booking->user->email }}<br> {{-- Email user. --}}
                    {{-- {{-- Menampilkan No HP jika ada (opsional) --}} {{-- Komentar asli Anda: Catatan tentang No HP. --}}
                    {{ $booking->user->phone ?? '-' }} {{-- Menampilkan No HP atau strip jika null. --}}
                </div> {{-- Penutup kolom pelanggan. --}}
                <div class="invoice-info"> {{-- Kolom Kanan: Informasi Invoice. --}}
                    {{-- {{-- [UBAH] Label Nomor --}} {{-- Komentar asli Anda. --}}
                    <h3>Nomor Bukti Pembayaran</h3> {{-- Label nomor invoice. --}}
                    <strong>#{{ $booking->id }}</strong><br> {{-- ID Booking sebagai nomor invoice. --}}
                    {{ $booking->created_at->format('d F Y') }} {{-- Tanggal pembuatan invoice. --}}
                </div> {{-- Penutup kolom invoice info. --}}
            </div> {{-- Penutup section detail. --}}

            @php {{-- Blok PHP untuk logika penentuan class CSS status. --}}
                if ($booking->status == 'confirmed') { {{-- Jika status confirmed... --}}
                    $statusClass = 'status-confirmed'; {{-- Gunakan class hijau. --}}
                } elseif ($booking->status == 'pending') { {{-- Jika status pending... --}}
                    $statusClass = 'status-pending'; {{-- Gunakan class oranye. --}}
                } else { {{-- Jika status lainnya... --}}
                    $statusClass = 'status-pending'; {{-- Default ke oranye (bisa diubah ke gray jika perlu). --}}
                } {{-- Penutup logika if. --}}
            @endphp {{-- Penutup blok PHP. --}}

            <p>Status Pembayaran: <span class="status-badge {{ $statusClass }}">{{ $booking->status }}</span></p> {{-- Menampilkan badge status pembayaran. --}}

            <table class="items-table"> {{-- Tabel rincian barang sewaan. --}}
                <thead> {{-- Header tabel. --}}
                    <tr> {{-- Baris header. --}}
                        <th>Keterangan</th> {{-- Kolom Keterangan. --}}
                        <th class="text-right">Durasi</th> {{-- Kolom Durasi (rata kanan). --}}
                        <th class="text-right">Jumlah</th> {{-- Kolom Jumlah Harga (rata kanan). --}}
                    </tr> {{-- Penutup baris header. --}}
                </thead> {{-- Penutup header tabel. --}}
                <tbody> {{-- Badan tabel. --}}
                    <tr> {{-- Baris data item. --}}
                        <td> {{-- Sel keterangan. --}}
                            <strong>Sewa {{ $booking->product->name }}</strong><br> {{-- Nama produk dicetak tebal. --}}
                            <small>Periode: {{ $booking->start_date->format('d M Y') }} - {{-- Teks kecil periode sewa. --}}
                                {{ $booking->end_date->format('d M Y') }}</small> {{-- Tanggal selesai sewa. --}}
                        </td> {{-- Penutup sel keterangan. --}}
                        <td class="text-right">{{ $durationInDays }} Hari</td> {{-- Menampilkan durasi dalam hari (variabel dikirim dari controller). --}}
                        <td class="text-right">Rp {{ number_format($booking->total_price) }}</td> {{-- Menampilkan total harga dengan format angka. --}}
                    </tr> {{-- Penutup baris data. --}}
                </tbody> {{-- Penutup badan tabel. --}}
            </table> {{-- Penutup tabel item. --}}

            <div class="summary-section"> {{-- Bagian ringkasan total harga (kanan bawah). --}}
                <table class="summary-table"> {{-- Tabel ringkasan. --}}
                    <tr> {{-- Baris Subtotal. --}}
                        <td>Subtotal</td> {{-- Label Subtotal. --}}
                        <td class="text-right">Rp {{ number_format($booking->total_price) }}</td> {{-- Nilai subtotal. --}}
                    </tr> {{-- Penutup baris subtotal. --}}
                    <tr> {{-- Baris Biaya Admin. --}}
                        <td>Biaya Admin</td> {{-- Label Biaya Admin. --}}
                        <td class="text-right">Rp 0</td> {{-- Nilai 0 (hardcoded). --}}
                    </tr> {{-- Penutup baris admin. --}}
                    <tr class="grand-total"> {{-- Baris Total Akhir (Grand Total). --}}
                        <td>Total Dibayar</td> {{-- Label Total. --}}
                        <td class="text-right total-amount">Rp {{ number_format($booking->total_price) }}</td> {{-- Nilai Total Akhir berwarna merah. --}}
                    </tr> {{-- Penutup baris total. --}}
                </table> {{-- Penutup tabel ringkasan. --}}
            </div> {{-- Penutup div summary-section. --}}

            <div style="clear: both;"></div> {{-- Elemen clear untuk membersihkan float (penting untuk layout PDF/HTML lama). --}}
        </div> {{-- Penutup div content. --}}

        <div class="footer"> {{-- Bagian footer dokumen. --}}
            <p>Terima kasih atas kepercayaan Anda kepada MY cell.</p> {{-- Pesan ucapan terima kasih. --}}
            <p style="font-size: 10px; margin-top: 5px;">Bukti pembayaran ini sah dan diterbitkan secara otomatis oleh sistem.</p> {{-- Disclaimer sistem. --}}
        </div> {{-- Penutup div footer. --}}
    </div> {{-- Penutup div invoice-box. --}}
</body> {{-- Penutup body. --}}

</html> {{-- Penutup tag html. --}}
