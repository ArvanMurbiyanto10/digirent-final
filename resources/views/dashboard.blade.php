<x-app-layout> {{-- Memanggil komponen layout utama aplikasi (AppLayout). --}}
    <x-slot name="header"> {{-- Mendefinisikan slot bernama 'header' untuk bagian atas halaman. --}}
        {{-- PERUBAHAN #1: Teks header diubah jadi 'text-indigo-800' --}} {{-- Komentar asli Anda: Catatan perubahan warna teks. --}}
        <h2 class="font-semibold text-xl font-bold text-indigo-800"> {{-- Judul halaman dengan gaya font tebal, ukuran XL, dan warna ungu indigo-800. --}}
            {{ __('Dashboard') }} {{-- Menampilkan teks 'Dashboard' dengan fungsi terjemahan Laravel. --}}
        </h2> {{-- Penutup tag h2. --}}
    </x-slot> {{-- Penutup slot header. --}}

    <div class="py-12"> {{-- Wrapper utama konten dengan padding vertikal (atas-bawah) sebesar 12 satuan (3rem). --}}
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8"> {{-- Mengatur lebar maksimum container, margin auto (tengah), dan padding horizontal responsif. --}}
            <div class="bg-indigo-100 overflow-hidden shadow-sm sm:rounded-lg mb-6"> {{-- Kotak pertama (Welcome): Background indigo muda, shadow, sudut membulat, margin bawah. --}}
                <div class="p-6 text-gray-900"> {{-- Container isi dengan padding 6 dan teks berwarna abu-abu gelap. --}}
                    {{ __("Selamat datang! Kelola semua penyewaan Anda di sini.") }} {{-- Menampilkan pesan selamat datang yang bisa diterjemahkan. --}}
                </div> {{-- Penutup div isi pesan selamat datang. --}}
            </div> {{-- Penutup div kotak welcome. --}}

            {{-- {{-- Pembuka komentar blok Blade. --}}
            {{--   KOTAK 2: "Pesanan Saya" (Selalu Putih + Aksen Indigo) --}} {{-- Catatan: Penjelasan tentang kotak kedua untuk daftar pesanan. --}}
            {{-- --}} {{-- Penutup komentar blok Blade. --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg"> {{-- Kotak kedua (Daftar Pesanan): Background putih, shadow, sudut membulat. --}}
                <div class="p-6 text-gray-900"> {{-- Container isi dengan padding 6 dan teks abu-abu gelap. --}}
                    <h3 class="text-2xl font-bold mb-6">Pesanan Saya</h3> {{-- Judul bagian 'Pesanan Saya' dengan font besar dan tebal. --}}

                    {{-- Wrapper tabel dengan shadow dan rounded --}} {{-- Komentar asli Anda: Penjelasan wrapper tabel. --}}
                    <div class="overflow-x-auto shadow-md rounded-lg"> {{-- Wrapper tabel agar bisa discroll horizontal (responsive) dengan shadow dan sudut bulat. --}}
                        <table class="min-w-full bg-white"> {{-- Memulai tabel dengan lebar penuh dan latar belakang putih. --}}
                            {{-- HEADER TABEL: Aksen 'indigo-100' --}} {{-- Komentar asli Anda: Catatan warna header tabel. --}}
                            <thead class="bg-indigo-100"> {{-- Bagian kepala tabel dengan background warna indigo muda. --}}
                                <tr> {{-- Baris header tabel. --}}
                                    <th class="py-3 px-4 text-left text-xs font-medium text-indigo-800 uppercase tracking-wider">Produk</th> {{-- Kolom 'Produk': Teks kiri, kecil, uppercase, warna indigo tua. --}}
                                    <th class="py-3 px-4 text-left text-xs font-medium text-indigo-800 uppercase tracking-wider">Tanggal Sewa</th> {{-- Kolom 'Tanggal Sewa': Teks kiri, kecil, uppercase, warna indigo tua. --}}
                                    <th class="py-3 px-4 text-left text-xs font-medium text-indigo-800 uppercase tracking-wider">Total Harga</th> {{-- Kolom 'Total Harga': Teks kiri, kecil, uppercase, warna indigo tua. --}}
                                    <th class="py-3 px-4 text-center text-xs font-medium text-indigo-800 uppercase tracking-wider">Status</th> {{-- Kolom 'Status': Teks tengah, kecil, uppercase, warna indigo tua. --}}
                                    <th class="py-3 px-4 text-center text-xs font-medium text-indigo-800 uppercase tracking-wider">Aksi</th> {{-- Kolom 'Aksi': Teks tengah, kecil, uppercase, warna indigo tua. --}}
                                </tr> {{-- Penutup baris header. --}}
                            </thead> {{-- Penutup kepala tabel. --}}
                            <tbody class="divide-y divide-gray-200"> {{-- Badan tabel dengan garis pemisah antar baris berwarna abu-abu. --}}
                                @forelse ($bookings as $booking) {{-- Loop Forelse: Mengecek apakah variabel $bookings ada isinya. --}}
                                    <tr class="hover:bg-gray-50"> {{-- Baris data: Memberikan efek background abu-abu tipis saat kursor diarahkan (hover). --}}
                                        <td class="py-4 px-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $booking->product->name }}</td> {{-- Sel Nama Produk: Mengambil nama produk dari relasi booking. --}}
                                        {{-- {{-- Pembuka komentar blok Blade. --}}
                                        {{--   CATATAN: Ini bergantung pada perbaikan Model 'Booking' --}} {{-- Komentar asli Anda: Mengingatkan dependensi pada Model. --}}
                                        {{--   yang kita lakukan sebelumnya ($casts) --}} {{-- Komentar asli Anda: Mengacu pada casting datetime. --}}
                                        {{-- --}} {{-- Penutup komentar blok Blade. --}}
                                        <td class="py-4 px-4 whitespace-nowrap text-sm text-gray-700">{{ $booking->start_date->format('d M Y') }} - {{ $booking->end_date->format('d M Y') }}</td> {{-- Sel Tanggal: Menampilkan rentang tanggal yang diformat (hari bulan tahun). --}}
                                        <td class="py-4 px-4 whitespace-nowrap text-sm text-gray-700">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</td> {{-- Sel Harga: Menampilkan harga total dengan format mata uang Indonesia (ribuan dipisah titik). --}}
                                        <td class="py-4 px-4 whitespace-nowrap text-center"> {{-- Sel Status: Teks rata tengah. --}}
                                            @if($booking->status == 'confirmed') {{-- Logika IF: Jika status pesanan adalah 'confirmed'. --}}
                                                <span class="bg-green-200 text-green-800 font-semibold py-1 px-3 rounded-full text-xs"> {{-- Badge hijau untuk status sukses/konfirmasi. --}}
                                                    Dikonfirmasi {{-- Teks badge: Dikonfirmasi. --}}
                                                </span> {{-- Penutup span badge. --}}
                                            @elseif($booking->status == 'pending') {{-- Logika ELSE IF: Jika status pesanan adalah 'pending'. --}}
                                                <span class="bg-yellow-200 text-yellow-800 font-semibold py-1 px-3 rounded-full text-xs"> {{-- Badge kuning untuk status menunggu. --}}
                                                    Belum Bayar {{-- Teks badge: Belum Bayar. --}}
                                                </span> {{-- Penutup span badge. --}}
                                            @else {{-- Logika ELSE: Jika status lainnya (misal: cancelled). --}}
                                                <span class="bg-gray-200 text-gray-800 font-semibold py-1 px-3 rounded-full text-xs"> {{-- Badge abu-abu untuk status umum lainnya. --}}
                                                    {{ ucfirst($booking->status) }} {{-- Menampilkan status asli dengan huruf depan kapital. --}}
                                                </span> {{-- Penutup span badge. --}}
                                            @endif {{-- Penutup logika IF. --}}
                                        </td> {{-- Penutup sel status. --}}
                                        <td class="py-4 px-4 whitespace-nowrap text-center text-sm font-medium"> {{-- Sel Aksi: Rata tengah. --}}
                                            <a href="{{ route('booking.show', $booking) }}" class="text-indigo-600 hover:text-indigo-900"> {{-- Link menuju halaman detail booking, warna teks indigo. --}}
                                                Lihat Detail {{-- Teks link. --}}
                                            </a> {{-- Penutup tag link. --}}
                                        </td> {{-- Penutup sel aksi. --}}
                                    </tr> {{-- Penutup baris data tabel. --}}
                                @empty {{-- Bagian EMPTY: Dijalankan jika variabel $bookings KOSONG (tidak ada data). --}}
                                    <tr> {{-- Membuat baris khusus pesan kosong. --}}
                                        <td colspan="5" class="text-center py-10 text-gray-500"> {{-- Menggabungkan 5 kolom jadi 1, rata tengah, padding besar. --}}
                                            Anda belum memiliki pesanan. {{-- Pesan yang ditampilkan jika tidak ada data. --}}
                                        </td> {{-- Penutup sel pesan kosong. --}}
                                    </tr> {{-- Penutup baris pesan kosong. --}}
                                @endforelse {{-- Penutup loop Forelse. --}}
                            </tbody> {{-- Penutup badan tabel. --}}
                        </table> {{-- Penutup tag tabel. --}}
                    </div> {{-- Penutup wrapper tabel (overflow/shadow). --}}
                </div> {{-- Penutup container padding isi. --}}
            </div> {{-- Penutup div kotak kedua (Pesanan Saya). --}}
        </div> {{-- Penutup container layout max-width. --}}
    </div> {{-- Penutup wrapper utama (py-12). --}}
</x-app-layout> {{-- Penutup komponen layout utama. --}}
