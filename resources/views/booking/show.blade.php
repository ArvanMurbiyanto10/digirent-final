<x-app-layout> {{-- Menggunakan komponen layout utama aplikasi (AppLayout) sebagai pembungkus halaman. --}}
    <x-slot name="header"> {{-- Membuka slot bernama 'header' untuk menyisipkan konten judul di bagian atas. --}}
        <h2 class="w-full text-center font-bold text-3xl text-gray-800 leading-tight"> {{-- Styling judul: lebar penuh, rata tengah, tebal, ukuran 3xl, warna abu gelap. --}}
            Bukti Pesanan Anda {{-- Teks judul halaman yang akan ditampilkan. --}}
        </h2> {{-- Penutup tag h2. --}}
    </x-slot> {{-- Penutup slot header. --}}

    {{-- {{-- Latar belakang halaman dipaksa jadi bg-gray-100 --}} {{-- Komentar asli Anda: Catatan tentang background color. --}}
    <div class="py-12 bg-gray-100"> {{-- Wrapper utama konten dengan padding vertikal 12 dan background abu-abu muda. --}}
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8"> {{-- Container pembatas lebar max 3xl (tampil seperti struk), rata tengah. --}}

            {{-- {{-- Kotak invoice utama berwarna putih --}} {{-- Komentar asli Anda: Penanda kotak utama. --}}
            <div class="bg-white overflow-hidden shadow-lg rounded-lg"> {{-- Card utama: Background putih, shadow besar (lg), sudut bulat. --}}
                <div class="p-8 text-gray-900"> {{-- Padding dalam cukup besar (8) untuk kesan lega, teks warna gelap. --}}

                    <div class="text-center"> {{-- Wrapper untuk konten bagian atas agar rata tengah. --}}
                        {{-- {{-- Ikon Struk --}} {{-- Komentar asli Anda: Penanda ikon. --}}
                        <svg class="w-16 h-16 mx-auto text-indigo-600 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"> {{-- Ikon SVG Struk: Ukuran 16x16, warna indigo, margin bawah. --}}
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /> {{-- Path data gambar ikon dokumen. --}}
                        </svg> {{-- Penutup tag SVG. --}}

                        <h1 class="text-3xl font-bold mb-2">Invoice Pesanan</h1> {{-- Judul Invoice dengan font besar dan tebal. --}}
                        <p class="text-gray-500 mb-6">Berikut adalah rincian pesanan Anda.</p> {{-- Deskripsi singkat di bawah judul. --}}

                        <p class="text-lg font-semibold mb-8 text-gray-800"> {{-- Wrapper status pesanan: Font agak besar, margin bawah. --}}
                            Status Pesanan: {{-- Label status. --}}
                            <span class="px-3 py-1 text-sm font-semibold rounded-full {{-- Badge status: Padding, font kecil tebal, bulat penuh. --}}
                                {{-- {{-- Logika Warna Status --}} {{-- Komentar asli Anda: Logika pemilihan warna badge. --}}
                                @if($booking->status == 'pending') {{-- Jika status pending... --}}
                                    bg-yellow-500 text-white {{-- Gunakan warna kuning. --}}
                                @elseif($booking->status == 'confirmed') {{-- Jika status confirmed... --}}
                                    bg-green-500 text-white {{-- Gunakan warna hijau. --}}
                                @else {{-- Jika status lainnya (cancelled/failed)... --}}
                                    bg-red-500 text-white {{-- Gunakan warna merah. --}}
                                @endif {{-- Penutup logika warna. --}}
                            ">
                                {{-- {{-- Logika Teks Status --}} {{-- Komentar asli Anda: Logika teks yang ditampilkan. --}}
                                @if($booking->status == 'pending') {{-- Jika pending... --}}
                                    Menunggu Pembayaran {{-- Teks: Menunggu Pembayaran. --}}
                                @elseif($booking->status == 'confirmed') {{-- Jika confirmed... --}}
                                    Telah Dikonfirmasi {{-- Teks: Telah Dikonfirmasi. --}}
                                @else {{-- Jika lainnya... --}}
                                    Dibatalkan {{-- Teks: Dibatalkan. --}}
                                @endif {{-- Penutup logika teks. --}}
                            </span> {{-- Penutup span badge status. --}}
                        </p> {{-- Penutup paragraf status. --}}
                    </div> {{-- Penutup wrapper center. --}}

                    {{-- {{-- Detail Struk Clean --}} {{-- Komentar asli Anda: Bagian detail pesanan. --}}
                    <div class="mt-6"> {{-- Container detail dengan margin atas. --}}
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">Detail Pesanan</h3> {{-- Sub-judul bagian detail. --}}
                        <div class="space-y-3"> {{-- Memberikan jarak vertikal antar baris detail. --}}
                            <div class="flex justify-between text-gray-700"> {{-- Baris No Pesanan: Flexbox kiri-kanan. --}}
                                <span class="font-semibold">No. Pesanan</span> {{-- Label kiri. --}}
                                <span class="font-medium text-gray-900">#{{ $booking->id }}</span> {{-- Value kanan: ID Booking. --}}
                            </div> {{-- Penutup baris. --}}
                            <div class="flex justify-between text-gray-700"> {{-- Baris Nama Penyewa. --}}
                                <span class="font-semibold">Nama Penyewa</span> {{-- Label kiri. --}}
                                <span class="font-medium text-gray-900">{{ $booking->user->name }}</span> {{-- Value kanan: Nama User. --}}
                            </div> {{-- Penutup baris. --}}
                            <div class="flex justify-between text-gray-700"> {{-- Baris Produk. --}}
                                <span class="font-semibold">Produk</span> {{-- Label kiri. --}}
                                <span class="font-medium text-gray-900">{{ $booking->product->name }}</span> {{-- Value kanan: Nama Produk. --}}
                            </div> {{-- Penutup baris. --}}
                            <div class="flex justify-between text-gray-700"> {{-- Baris Tanggal Mulai. --}}
                                <span class="font-semibold">Tanggal Mulai</span> {{-- Label kiri. --}}
                                <span class="font-medium text-gray-900">{{ $booking->start_date->format('d M Y, H:i') }}</span> {{-- Value kanan: Format tanggal. --}}
                            </div> {{-- Penutup baris. --}}
                            <div class="flex justify-between text-gray-700"> {{-- Baris Tanggal Selesai. --}}
                                <span class="font-semibold">Tanggal Selesai</span> {{-- Label kiri. --}}
                                <span class="font-medium text-gray-900">{{ $booking->end_date->format('d M Y, H:i') }}</span> {{-- Value kanan: Format tanggal. --}}
                            </div> {{-- Penutup baris. --}}

                            {{-- {{-- Garis Pemisah untuk Total --}} {{-- Komentar asli Anda: Pemisah visual. --}}
                            <div class="border-t border-gray-300 pt-3"> {{-- Garis atas abu-abu, padding top 3. --}}
                                <div class="flex justify-between items-center text-gray-900"> {{-- Flexbox untuk baris total. --}}
                                    <span class="text-lg font-bold">Total Pembayaran</span> {{-- Label Total: Font besar tebal. --}}
                                    <span class="text-xl font-bold text-purple-600"> {{-- Value Total: Lebih besar, warna ungu. --}}
                                        Rp {{ number_format($booking->total_price) }} {{-- Format angka rupiah. --}}
                                    </span> {{-- Penutup span nilai. --}}
                                </div> {{-- Penutup flexbox total. --}}
                            </div> {{-- Penutup container total. --}}
                        </div> {{-- Penutup space-y. --}}
                    </div> {{-- Penutup section detail. --}}

                    {{-- {{-- Tombol Aksi (Logika Telah Diperbaiki) --}} {{-- Komentar asli Anda: Section tombol. --}}
                    <div class="mt-8"> {{-- Container tombol dengan margin atas besar. --}}
                        <div class="flex flex-col sm:flex-row sm:justify-center sm:space-x-4 space-y-3 sm:space-y-0"> {{-- Flexbox: Kolom di HP (vertical stack), Baris di layar besar (horizontal) dengan jarak. --}}

                            {{-- {{-- KUNCI 1: Tombol hanya tampil jika status pending DAN snap_token ada --}} {{-- Komentar asli Anda: Logika tombol bayar. --}}
                            @if ($booking->status == 'pending' && $booking->snap_token) {{-- Cek kondisi: Status pending DAN token tersedia. --}}
                                <button id="pay-button" class="w-full sm:w-auto inline-block bg-purple-600 text-white font-semibold py-3 px-8 rounded-lg hover:bg-purple-700 transition-colors"> {{-- Tombol Bayar: ID 'pay-button' untuk JS, warna ungu. --}}
                                    Lanjutkan Pembayaran {{-- Teks tombol. --}}
                                </button> {{-- Penutup button. --}}
                            @elseif ($booking->status == 'confirmed') {{-- Jika status confirmed (sudah lunas). --}}
                                <a href="{{ route('booking.downloadInvoice', $booking) }}" target="_blank" class="w-full sm:w-auto inline-block text-center bg-gray-700 text-white font-semibold py-3 px-8 rounded-lg hover:bg-gray-800 transition-colors"> {{-- Tombol Download: Link ke route download PDF, warna abu gelap. --}}
                                    Download Struk (PDF) {{-- Teks tombol. --}}
                                </a> {{-- Penutup link. --}}
                            @endif {{-- Penutup logika if status. --}}

                            {{-- {{-- Tombol Kembali ke Dashboard --}} {{-- Komentar asli Anda: Tombol navigasi. --}}
                            <a href="{{ route('dashboard') }}" class="w-full sm:w-auto inline-block text-center {{-- Tombol Kembali: Link ke dashboard. --}}
                                @if($booking->status == 'pending') {{-- Jika pending... --}}
                                    bg-gray-500 hover:bg-gray-600 {{-- Warna abu-abu (agar tombol bayar lebih menonjol). --}}
                                @else {{-- Jika status lain (misal confirmed)... --}}
                                    bg-purple-600 hover:bg-purple-700 {{-- Warna ungu (menjadi tombol utama). --}}
                                @endif {{-- Penutup logika warna. --}}
                                text-white font-semibold py-3 px-8 rounded-lg transition-colors"> {{-- Styling umum tombol. --}}
                                Kembali ke Dashboard {{-- Teks tombol. --}}
                            </a> {{-- Penutup link dashboard. --}}

                            {{-- {{-- Tombol Chat Admin (WA) --}} {{-- Komentar asli Anda: Tombol WhatsApp. --}}
                            <a href="https://wa.me/6285175394607?text=Halo%20Admin%20DigiRent%2C%0A%0ASaya%20ingin%20bertanya%20mengenai%20pesanan%20%23{{ $booking->id ?? '...' }}%0AProduk%3A%20{{ $booking->product->name ?? '...' }}%0A%0ATerima%20kasih." {{-- Link WA API dengan pesan pre-filled dinamis. --}}
                               target="_blank" {{-- Buka di tab baru. --}}
                               class="w-full sm:w-auto inline-block text-center px-6 py-3 bg-green-600 text-white font-semibold rounded-lg shadow-md hover:bg-green-700 transition-colors duration-300"> {{-- Styling tombol WA: Warna hijau khas WA. --}}
                                <svg class="w-5 h-5 inline-block mr-1 -mt-1" fill="currentColor" viewBox="0 0 24 24"> {{-- Ikon SVG WhatsApp. --}}
                                    <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.0-6.556 5.333-11.891 11.893-11.891 3.181.001 6.167 1.24 8.417 3.488 2.249 2.248 3.487 5.235 3.487 8.417 0 6.556-5.333 11.89-11.893 11.89h-.001c-2.096 0-4.14-.545-5.947-1.587L.057 24zm6.591-3.803c.333.19.734.306 1.15.306.282 0 .56-.039.83-.118.27-.08.529-.19.776-.328.247-.138.48-.303.696-.493.216-.19.42-.408.611-.644.191-.236.36-.502.506-.784.146-.282.256-.589.329-.906.073-.317.111-.644.111-.971 0-.327-.038-.654-.111-.971-.073-.317-.183-.624-.329-.906-.146-.282-.315-.548-.506-.784-.191-.236-.395-.454-.611-.644-.216-.19-.449-.355-.696-.493-.247-.138-.506-.248-.776-.328-.27-.08-.548-.118-.83-.118-.416 0-.817.116-1.15.306-.333.19-.64.41-.913.66-.273.25-.516.529-.728.831-.212.302-.396.63-.546.98-.15.35-.27.717-.354 1.1-.084.383-.128.78-.128 1.18 0 .4.044.797.128 1.18.084.383.204.75.354 1.1.15.35.334.678.546.98.212.302.455.581.728.831.273.25.58.47.913.66zM11.893 2.951c-4.903 0-8.891 3.988-8.891 8.893 0 1.961.638 3.805 1.772 5.304L3.12 21.01l3.018-1.584c1.449.954 3.141 1.464 4.896 1.464h.001c4.903 0 8.891-3.988 8.891-8.893 0-4.904-3.988-8.893-8.891-8.893z"/> {{-- Path SVG WA. --}}
                                </svg> {{-- Penutup SVG. --}}
                                Chat Admin (WA) {{-- Teks tombol WA. --}}
                            </a> {{-- Penutup link WA. --}}

                        </div> {{-- Penutup flex tombol. --}}
                    </div> {{-- Penutup container tombol. --}}

                </div> {{-- Penutup konten padding. --}}
            </div> {{-- Penutup card utama. --}}
        </div> {{-- Penutup container max-width. --}}
    </div> {{-- Penutup wrapper utama. --}}

    {{-- {{-- KUNCI 2: Blok Script Lengkap di Bawah --}} {{-- Komentar asli Anda: Penanda blok script. --}}
    @push('scripts') {{-- Mendorong script ke stack 'scripts' di layout utama. --}}
        {{-- {{-- Fungsi ini akan dipanggil oleh 'onload' di bawah --}} {{-- Komentar asli Anda: Penjelasan fungsi JS. --}}
        <script type="text/javascript"> {{-- Membuka tag script JS. --}}
            function attachSnapListener() { {{-- Definisi fungsi global attachSnapListener. --}}
                var payButton = document.getElementById('pay-button'); {{-- Mengambil elemen tombol bayar. --}}

                if (payButton) { {{-- Cek apakah tombol ada (hanya ada jika status pending). --}}
                    payButton.addEventListener('click', function () { {{-- Tambahkan event click. --}}
                        // Ubah tombol jadi loading {{-- Komentar JS: Tampilkan status loading. --}}
                        payButton.disabled = true; {{-- Matikan tombol agar tidak di-klik ganda. --}}
                        payButton.innerHTML = 'Memuat...'; {{-- Ubah teks tombol. --}}

                        // Panggil Snap {{-- Komentar JS: Memulai proses pembayaran. --}}
                        window.snap.pay('{{ $booking->snap_token }}', { {{-- Fungsi Snap Midtrans dengan token. --}}
                            onSuccess: function(result){ {{-- Callback Sukses. --}}
                                // Arahkan ke halaman sukses {{-- Komentar JS: Redirect user. --}}
                                window.location.href = '{{ route("booking.success", $booking) }}'; {{-- Redirect ke route sukses. --}}
                            }, {{-- Penutup onSuccess. --}}
                            onPending: function(result){ {{-- Callback Pending. --}}
                                alert("Menunggu pembayaran Anda!"); {{-- Alert info. --}}
                                // Kembalikan tombol seperti semula {{-- Komentar JS: Reset tombol. --}}
                                payButton.disabled = false; {{-- Hidupkan tombol. --}}
                                payButton.innerHTML = 'Lanjutkan Pembayaran'; {{-- Kembalikan teks asli. --}}
                            }, {{-- Penutup onPending. --}}
                            onError: function(result){ {{-- Callback Error. --}}
                                alert("Pembayaran gagal! Silakan coba lagi."); {{-- Alert error. --}}
                                // Kembalikan tombol seperti semula {{-- Komentar JS: Reset tombol. --}}
                                payButton.disabled = false; {{-- Hidupkan tombol. --}}
                                payButton.innerHTML = 'Lanjutkan Pembayaran'; {{-- Kembalikan teks asli. --}}
                            }, {{-- Penutup onError. --}}
                            onClose: function(){ {{-- Callback Close (User menutup popup). --}}
                                // Pop-up ditutup, kembalikan tombol seperti semula {{-- Komentar JS: Reset tombol. --}}
                                payButton.disabled = false; {{-- Hidupkan tombol. --}}
                                payButton.innerHTML = 'Lanjutkan Pembayaran'; {{-- Kembalikan teks asli. --}}
                            } {{-- Penutup onClose. --}}
                        }); {{-- Penutup fungsi snap.pay. --}}
                    }); {{-- Penutup event listener. --}}
                } {{-- Penutup if payButton. --}}
            } {{-- Penutup fungsi attachSnapListener. --}}
        </script> {{-- Penutup tag script. --}}

        {{-- {{-- KUNCI 3: Script Midtrans (TYPO DIPERBAIKI) --}} {{-- Komentar asli Anda: Penanda load script Midtrans. --}}
        {{-- {{-- Ini hanya akan di-load jika $booking->snap_token ada --}} {{-- Komentar asli Anda: Logika conditional script. --}}
        @if ($booking->snap_token) {{-- Cek jika token tersedia. --}}
            <script {{-- Tag script untuk library Snap.js. --}}
                src="https://app.sandbox.midtrans.com/snap/snap.js" {{-- URL library sandbox Midtrans. --}}
                data-client-key="{{ config('midtrans.client_key') }}" {{-- Client key dari config Laravel. --}}
                onload="attachSnapListener()" {{-- Event OnLoad: Panggil fungsi listener setelah script siap. --}}
            ></script> {{-- Penutup tag script. --}}
            {{-- {{-- 'onload' akan memanggil fungsi 'attachSnapListener' SETELAH script ini selesai di-load --}} {{-- Komentar asli Anda: Penjelasan onload. --}}
        @endif {{-- Penutup if token. --}}
    @endpush {{-- Penutup push scripts. --}}

</x-app-layout> {{-- Penutup komponen layout. --}}
