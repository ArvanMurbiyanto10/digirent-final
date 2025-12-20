<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    {{-- [UBAH] Judul Tab/File --}}
    <title>Bukti Pembayaran #{{ $booking->id }} - MY cell</title>
    <style>
        :root {
            /* Warna Merah MY cell */
            --primary-color: #e53935;
            --secondary-color: #f3f4f6;
        }

        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            color: #374151;
            font-size: 14px;
            line-height: 1.6;
            background-color: #fff;
        }

        .invoice-box {
            width: 100%;
            max-width: 800px;
            margin: auto;
            padding: 0;
            position: relative;
        }

        .watermark {
            position: absolute;
            top: 35%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            font-size: 80px;
            /* Ukuran disesuaikan agar muat */
            color: #f3f4f6;
            font-weight: bold;
            opacity: 0.8;
            z-index: -1;
            text-align: center;
            width: 100%;
        }

        .header {
            background-color: var(--primary-color);
            color: #fff;
            padding: 40px 30px;
            text-align: left;
        }

        .header h1 {
            margin: 0;
            font-size: 28px;
            /* Sedikit diperkecil agar tidak terlalu panjang */
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .header p {
            margin: 5px 0 0 0;
            font-size: 14px;
        }

        .content {
            padding: 30px;
        }

        .details-section {
            margin-bottom: 40px;
            overflow: hidden;
        }

        .details-section .billed-to,
        .details-section .invoice-info {
            width: 48%;
        }

        .details-section .billed-to {
            float: left;
        }

        .details-section .invoice-info {
            float: right;
            text-align: right;
        }

        .details-section h3 {
            margin: 0 0 5px 0;
            font-size: 12px;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-badge {
            display: inline-block;
            padding: 2px 8px;
            /* REVISI: Padding diperkecil agar lebih ramping */
            border-radius: 4px;
            /* REVISI: Radius dikurangi agar tidak terlalu bulat (opsional) */
            color: #fff;
            font-weight: bold;
            font-size: 11px;
            /* REVISI: Font sedikit diperkecil agar proporsional */
            text-transform: capitalize;
            line-height: 1.2;
            /* REVISI: Line-height ditambahkan untuk kerapian vertikal */
            vertical-align: middle;
            /* REVISI: Menjaga posisi teks tetap di tengah baris */
        }

        .status-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 9999px;
            color: #fff;
            font-weight: bold;
            font-size: 12px;
            text-transform: capitalize;
        }

        .status-pending {
            background-color: #f59e0b;
        }

        .status-confirmed {
            background-color: #10b981;
        }

        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        .items-table th {
            padding: 12px 8px;
            text-align: left;
            font-weight: bold;
            border-bottom: 2px solid #e5e7eb;
        }

        .items-table td {
            padding: 15px 8px;
            border-bottom: 1px solid #e5e7eb;
        }

        .items-table tr:nth-child(even) {
            background-color: var(--secondary-color);
        }

        .items-table .text-right {
            text-align: right;
        }

        .summary-section {
            float: right;
            width: 50%;
        }

        .summary-table {
            width: 100%;
        }

        .summary-table td {
            padding: 5px 8px;
        }

        .summary-table .grand-total td {
            font-size: 18px;
            font-weight: bold;
            padding-top: 15px;
            border-top: 2px solid #e5e7eb;
        }

        .summary-table .grand-total .total-amount {
            color: var(--primary-color);
        }

        .footer {
            margin-top: 50px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
            text-align: center;
            font-size: 12px;
            color: #9ca3af;
        }
    </style>
</head>

<body>
    <div class="invoice-box">
        {{-- Watermark --}}
        <div class="watermark">LUNAS</div>

        <div class="header">
            {{-- [UBAH] Judul Utama --}}
            <h1>Bukti Pembayaran MY cell</h1>
            <p>Jalan Batanghari No. 7, Kecamatan Tegal Timur, Kota Tegal, Jawa Tengah</p>
        </div>

        <div class="content">
            <div class="details-section">
                <div class="billed-to">
                    <h3>Diterima Dari</h3>
                    <strong>{{ $booking->user->name }}</strong><br>
                    {{ $booking->user->email }}<br>
                    {{-- Menampilkan No HP jika ada (opsional) --}}
                    {{ $booking->user->phone ?? '-' }}
                </div>
                <div class="invoice-info">
                    {{-- [UBAH] Label Nomor --}}
                    <h3>Nomor Bukti Pembayaran</h3>
                    <strong>#{{ $booking->id }}</strong><br>
                    {{ $booking->created_at->format('d F Y') }}
                </div>
            </div>

            @php
                if ($booking->status == 'confirmed') {
                    $statusClass = 'status-confirmed';
                } elseif ($booking->status == 'pending') {
                    $statusClass = 'status-pending';
                } else {
                    $statusClass = 'status-pending';
                }
            @endphp

            <p>Status Pembayaran: <span class="status-badge {{ $statusClass }}">{{ $booking->status }}</span></p>

            <table class="items-table">
                <thead>
                    <tr>
                        <th>Keterangan</th>
                        <th class="text-right">Durasi</th>
                        <th class="text-right">Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <strong>Sewa {{ $booking->product->name }}</strong><br>
                            <small>Periode: {{ $booking->start_date->format('d M Y') }} -
                                {{ $booking->end_date->format('d M Y') }}</small>
                        </td>
                        <td class="text-right">{{ $durationInDays }} Hari</td>
                        <td class="text-right">Rp {{ number_format($booking->total_price) }}</td>
                    </tr>
                </tbody>
            </table>

            <div class="summary-section">
                <table class="summary-table">
                    <tr>
                        <td>Subtotal</td>
                        <td class="text-right">Rp {{ number_format($booking->total_price) }}</td>
                    </tr>
                    <tr>
                        <td>Biaya Admin</td>
                        <td class="text-right">Rp 0</td>
                    </tr>
                    <tr class="grand-total">
                        <td>Total Dibayar</td>
                        <td class="text-right total-amount">Rp {{ number_format($booking->total_price) }}</td>
                    </tr>
                </table>
            </div>

            <div style="clear: both;"></div>
        </div>

        <div class="footer">
            <p>Terima kasih atas kepercayaan Anda kepada MY cell.</p>
            <p style="font-size: 10px; margin-top: 5px;">Bukti pembayaran ini sah dan diterbitkan secara otomatis oleh
                sistem.</p>
        </div>
    </div>
</body>

</html>