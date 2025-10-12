<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Invoice #{{ $booking->id }} - DigiRent</title>
    <style>
        /* Ganti warna utama di sini */
        :root {
            --primary-color: #3B82F6; /* Biru */
            --secondary-color: #f3f4f6; /* Abu-abu muda */
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
            font-size: 100px;
            color: #f3f4f6; /* Warna watermark */
            font-weight: bold;
            opacity: 0.8;
            z-index: -1;
        }
        .header {
            background-color: var(--primary-color);
            color: #fff;
            padding: 40px 30px;
            text-align: left;
        }
        .header h1 {
            margin: 0;
            font-size: 36px;
            font-weight: bold;
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
        .details-section .billed-to, .details-section .invoice-info {
            width: 48%;
        }
        .details-section .billed-to { float: left; }
        .details-section .invoice-info { float: right; text-align: right; }
        .details-section h3 {
            margin: 0 0 5px 0;
            font-size: 14px;
            color: #6b7280;
            text-transform: uppercase;
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
        .status-pending { background-color: #f59e0b; } /* Kuning */
        .status-confirmed { background-color: #10b981; } /* Hijau */
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
        .items-table .text-right { text-align: right; }
        .summary-section {
            float: right;
            width: 45%;
        }
        .summary-table {
            width: 100%;
        }
        .summary-table td { padding: 5px 8px; }
        .summary-table .grand-total td {
            font-size: 20px;
            font-weight: bold;
            padding-top: 15px;
        }
        .summary-table .grand-total .total-amount { color: var(--primary-color); }
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
        <div class="watermark">DigiRent</div>
        <div class="header">
            <h1>DigiRent</h1>
            <p>Jalan Teknologi No. 123, Purwokerto, Jawa Tengah</p>
        </div>

        <div class="content">
            <div class="details-section">
                {{-- === BAGIAN YANG DITAMBAHKAN KEMBALI === --}}
                <div class="billed-to">
                    <h3>Ditagihkan Kepada</h3>
                    <strong>{{ $booking->user->name }}</strong><br>
                    {{ $booking->user->email }}
                </div>
                {{-- ====================================== --}}
                <div class="invoice-info">
                    <h3>Nomor Invoice</h3>
                    <strong>#{{ $booking->id }}</strong><br>
                    {{ $booking->created_at->format('d F Y') }}
                </div>
            </div>

            @php
                $statusClass = 'status-confirmed';
                if ($booking->status == 'confirmed') $statusClass = 'status-confirmed';
            @endphp
            <p>Status: <span class="status-badge {{ $statusClass }}">{{ $booking->status }}</span></p>

            <table class="items-table">
                <thead>
                    <tr>
                        <th>Deskripsi Sewa</th>
                        <th class="text-right">Durasi</th>
                        <th class="text-right">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <strong>{{ $booking->product->name }}</strong><br>
                            <small>Mulai: {{ $booking->start_date->format('d M Y, H:i') }} | Selesai: {{ $booking->end_date->format('d M Y, H:i') }}</small>
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
                        <td>Pajak (0%)</td>
                        <td class="text-right">Rp 0</td>
                    </tr>
                    <tr class="grand-total">
                        <td>Total Pembayaran</td>
                        <td class="text-right total-amount">Rp {{ number_format($booking->total_price) }}</td>
                    </tr>
                </table>
            </div>

            <div style="clear: both;"></div>
        </div>

        <div class="footer">
            <p>Terima kasih telah memilih DigiRent!</p>
        </div>
    </div>
</body>
</html>
