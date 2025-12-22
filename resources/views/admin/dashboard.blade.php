<x-app-layout> {{-- Menggunakan layout utama aplikasi (yang memuat Navbar, Sidebar, dan Script dasar) --}}

    {{-- Slot Header: Area judul halaman di bagian atas konten --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }} {{-- Menampilkan teks "Admin Dashboard" --}}
        </h2>
    </x-slot>

    {{-- Container Utama: Memberikan jarak vertikal (padding-y) sebesar 3rem (12) --}}
    <div class="py-12">
        {{-- Wrapper: Membatasi lebar maksimum konten dan membuatnya rata tengah (mx-auto) --}}
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- ==================================================== --}}
            {{-- BAGIAN 1: KARTU STATISTIK --}}
            {{-- ==================================================== --}}

            {{-- Grid Container: Mengatur tata letak menjadi 1 kolom di HP dan 3 kolom di layar medium ke atas --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">

                {{-- KARTU 1: TOTAL PENDAPATAN (Warna Hijau) --}}
                <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-green-500"> {{-- Kotak putih dengan
                    border kiri hijau tebal --}}
                    <div class="flex items-center"> {{-- Flexbox untuk menyandingkan ikon dan teks --}}
                        {{-- Wrapper Ikon Uang --}}
                        <div class="p-3 rounded-full bg-green-100 text-green-500 mr-4">
                            {{-- SVG Icon Uang --}}
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Total Pendapatan</p> {{-- Label Statistik --}}
                            <p class="text-2xl font-bold text-gray-800">
                                {{-- Menampilkan variabel $totalRevenue dengan format mata uang (contoh: 1.000.000) --}}
                                Rp {{ number_format($totalRevenue, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>
                </div>

                {{-- KARTU 2: MENUNGGU KONFIRMASI (Warna Kuning) --}}
                <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-yellow-500"> {{-- Kotak putih dengan
                    border kiri kuning tebal --}}
                    <div class="flex items-center">
                        {{-- Wrapper Ikon Jam --}}
                        <div class="p-3 rounded-full bg-yellow-100 text-yellow-500 mr-4">
                            {{-- SVG Icon Jam --}}
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Perlu Konfirmasi</p> {{-- Label Statistik --}}
                            <p class="text-2xl font-bold text-gray-800">{{ $pendingCount }} Pesanan</p> {{-- Menampilkan
                            jumlah order pending --}}
                        </div>
                    </div>
                </div>

                {{-- KARTU 3: TOTAL SEWA SUKSES (Warna Biru) --}}
                <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-blue-500"> {{-- Kotak putih dengan
                    border kiri biru tebal --}}
                    <div class="flex items-center">
                        {{-- Wrapper Ikon Ceklis --}}
                        <div class="p-3 rounded-full bg-blue-100 text-blue-500 mr-4">
                            {{-- SVG Icon Ceklis --}}
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Sewa Sukses</p> {{-- Label Statistik --}}
                            <p class="text-2xl font-bold text-gray-800">{{ $successCount }}x</p> {{-- Menampilkan jumlah
                            order sukses --}}
                        </div>
                    </div>
                </div>

            </div>

            {{-- ==================================================== --}}
            {{-- BAGIAN 2: TABEL DAFTAR PESANAN --}}
            {{-- ==================================================== --}}

            {{-- Wrapper Tabel: Background putih dengan shadow halus --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900"> {{-- Padding dalam konten tabel --}}

                    <h3 class="text-lg font-bold mb-4">Daftar Semua Pesanan</h3> {{-- Judul Tabel --}}

                    {{-- Blok Pengecekan Session: Apakah ada pesan sukses dari controller? --}}
                    @if(session('success'))
                        {{-- Menampilkan Alert Hijau jika ada pesan sukses --}}
                        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="overflow-x-auto"> {{-- Wrapper agar tabel bisa digeser (scroll) horizontal jika layar
                        sempit --}}
                        <table class="min-w-full bg-white border border-gray-200"> {{-- Tag Tabel Utama --}}
                            <thead> {{-- Kepala Tabel --}}
                                <tr class="bg-gray-100"> {{-- Baris Header dengan background abu-abu --}}
                                    <th class="py-2 px-4 border-b text-left">ID</th>
                                    <th class="py-2 px-4 border-b text-left">Penyewa</th>
                                    <th class="py-2 px-4 border-b text-left">Produk</th>
                                    <th class="py-2 px-4 border-b text-left">Tanggal</th>
                                    <th class="py-2 px-4 border-b text-left">Total Harga</th>
                                    <th class="py-2 px-4 border-b text-left">Status</th>
                                    <th class="py-2 px-4 border-b text-left">Aksi</th>
                                </tr>
                            </thead>
                            <tbody> {{-- Badan Tabel --}}
                                {{-- Melakukan Looping (Perulangan) pada data $bookings --}}
                                @foreach($bookings as $booking)
                                    <tr class="hover:bg-gray-50"> {{-- Baris data: berubah warna saat kursor di atasnya
                                        (hover) --}}

                                        {{-- Kolom 1: Menampilkan ID Booking --}}
                                        <td class="py-2 px-4 border-b">#{{ $booking->id }}</td>

                                        {{-- Kolom 2: Menampilkan Nama dan Email Penyewa --}}
                                        <td class="py-2 px-4 border-b">
                                            {{ $booking->user->name ?? 'User Terhapus' }} <br> {{-- Nama User (Fallback jika
                                            user dihapus) --}}
                                            <span class="text-xs text-gray-500">{{ $booking->user->email ?? '-' }}</span>
                                            {{-- Email User (kecil) --}}
                                        </td>

                                        {{-- Kolom 3: Menampilkan Nama Produk --}}
                                        <td class="py-2 px-4 border-b">{{ $booking->product->name ?? 'Produk Terhapus' }}
                                        </td>

                                        {{-- Kolom 4: Menampilkan Rentang Tanggal Sewa --}}
                                        <td class="py-2 px-4 border-b text-sm">
                                            {{ \Carbon\Carbon::parse($booking->start_date)->format('d M') }} - {{-- Tanggal
                                            Mulai (misal: 10 Jan) --}}
                                            {{ \Carbon\Carbon::parse($booking->end_date)->format('d M Y') }} {{-- Tanggal
                                            Selesai (misal: 12 Jan 2024) --}}
                                        </td>

                                        {{-- Kolom 5: Menampilkan Total Harga --}}
                                        <td class="py-2 px-4 border-b font-bold">
                                            Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                                        </td>

                                        {{-- Kolom 6: Menampilkan Badge Status (Warna-warni) --}}
                                        <td class="py-2 px-4 border-b">
                                            @php
                                                // Normalisasi status menjadi huruf kecil semua dan hapus spasi agar konsisten
                                                $statusBadge = strtolower(trim($booking->status));
                                            @endphp

                                            @if($statusBadge == 'pending' || $statusBadge == 'unpaid')
                                                {{-- Jika Pending: Tampilkan Badge Kuning --}}
                                                <span
                                                    class="bg-yellow-100 text-yellow-800 text-xs font-semibold px-2.5 py-0.5 rounded">
                                                    {{ ucfirst($booking->status) }}
                                                </span>
                                            @elseif($statusBadge == 'confirmed' || $statusBadge == 'lunas' || $statusBadge == 'paid')
                                                {{-- Jika Lunas: Tampilkan Badge Hijau --}}
                                                <span
                                                    class="bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded">
                                                    Lunas
                                                </span>
                                            @else
                                                {{-- Jika Status Lain: Tampilkan Badge Abu-abu --}}
                                                <span
                                                    class="bg-gray-100 text-gray-800 text-xs font-semibold px-2.5 py-0.5 rounded">
                                                    {{ ucfirst($booking->status) }}
                                                </span>
                                            @endif
                                        </td>

                                        {{-- Kolom 7: Kolom Aksi (Tombol Konfirmasi) --}}
                                        <td class="py-2 px-4 border-b">
                                            @php
                                                // Normalisasi status lagi khusus untuk logika tombol aksi
                                                $statusAction = strtolower(trim($booking->status));
                                            @endphp

                                            {{-- Cek apakah statusnya pending/belum bayar/unpaid --}}
                                            @if($statusAction == 'pending' || $statusAction == 'unpaid' || $statusAction == 'belum bayar')

                                                {{-- Jika Pending: Tampilkan Form Tombol Konfirmasi --}}
                                                <form action="{{ route('admin.bookings.confirm', $booking->id) }}" method="POST"
                                                    onsubmit="return confirm('Yakin ingin konfirmasi pesanan ini sudah dibayar?');">
                                                    @csrf {{-- Token Keamanan Wajib Laravel --}}
                                                    @method('PATCH') {{-- Method Spoofing karena HTML Form hanya support
                                                    GET/POST --}}

                                                    <button type="submit"
                                                        class="bg-blue-600 hover:bg-blue-800 text-white font-bold py-1 px-3 rounded text-sm shadow transition duration-150">
                                                        Konfirmasi Bayar
                                                    </button>
                                                </form>

                                                {{-- Jika statusnya sudah lunas/confirmed/paid --}}
                                            @elseif($statusAction == 'confirmed' || $statusAction == 'lunas' || $statusAction == 'paid')
                                                {{-- Tampilkan teks "Selesai" dengan ikon centang --}}
                                                <span class="text-green-600 font-bold text-sm flex items-center">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M5 13l4 4L19 7"></path>
                                                    </svg>
                                                    Selesai
                                                </span>

                                                {{-- Jika status lain (misal: cancelled) --}}
                                            @else
                                                <span class="text-gray-400 text-xs italic">
                                                    {{ ucfirst($booking->status) }} {{-- Tampilkan teks status saja --}}
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach

                                {{-- Pengecekan jika tidak ada data sama sekali di database --}}
                                @if($bookings->isEmpty())
                                    <tr>
                                        {{-- Tampilkan baris kosong dengan pesan --}}
                                        <td colspan="7" class="text-center py-4 text-gray-500">Belum ada pesanan masuk.</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div> {{-- Penutup Overflow Wrapper --}}
                </div>
            </div>

        </div>
    </div>
</x-app-layout>