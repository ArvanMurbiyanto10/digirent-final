<x-app-layout> {{-- Menggunakan komponen layout utama aplikasi (AppLayout). --}}
    <div class="py-12"> {{-- Wrapper utama dengan padding vertikal (atas-bawah) sebesar 12 satuan. --}}
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8"> {{-- Container lebar maksimum 3xl (lebih sempit agar fokus),
            rata tengah. --}}
            <div class="bg-gray-100 overflow-hidden shadow-lg rounded-lg p-8"> {{-- Kotak utama: background abu-abu
                muda, shadow besar, padding 8. --}}

                <div class="flex flex-col items-center text-center"> {{-- Bagian header sukses: Flex column, rata tengah
                    horizontal & teks. --}}
                    <svg class="w-16 h-16 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"> {{-- Ikon Centang Sukses: SVG warna
                        hijau, ukuran 16x16. --}}
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /> {{-- Path data untuk ikon
                        centang dalam lingkaran. --}}
                    </svg> {{-- Penutup tag SVG. --}}
                    <h2 class="text-3xl font-bold text-gray-800 mt-4">Pembayaran Sukses!</h2> {{-- Judul halaman:
                    "Pembayaran Sukses!", font besar tebal. --}}
                    <p class="text-gray-600 mt-2"> {{-- Pesan konfirmasi di bawah judul, warna abu-abu. --}}
                        Terima kasih telah melakukan pembayaran. Pesanan Anda telah kami konfirmasi dan sedang kami
                        proses.
                    </p> {{-- Penutup paragraf pesan. --}}
                </div> {{-- Penutup div header sukses. --}}

                <hr class="my-6 border-gray-300"> {{-- Garis pemisah horizontal dengan margin vertikal. --}}

                <div class="mt-6"> {{-- Container detail pesanan. --}}
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Detail Pesanan</h3> {{-- Sub-judul "Detail
                    Pesanan". --}}

                    @if (isset($booking)) {{-- Mengecek apakah variabel $booking tersedia (dikirim dari controller).
                        --}}
                        <div class="space-y-3"> {{-- Wrapper baris detail dengan jarak vertikal antar elemen. --}}
                            <div class="flex justify-between text-gray-700"> {{-- Baris ID Pesanan: Flexbox kiri-kanan. --}}
                                <span>ID Pesanan</span> {{-- Label kiri. --}}
                                <span class="font-medium text-gray-900">#{{ $booking->id }}</span> {{-- Value kanan: ID
                                Booking. --}}
                            </div> {{-- Penutup baris. --}}
                            <div class="flex justify-between text-gray-700"> {{-- Baris Produk. --}}
                                <span>Produk</span> {{-- Label kiri. --}}
                                <span class="font-medium text-gray-900">{{ $booking->product->name }}</span> {{-- Value
                                kanan: Nama Produk. --}}
                            </div> {{-- Penutup baris. --}}
                            <div class="flex justify-between text-gray-700"> {{-- Baris Mulai Sewa. --}}
                                <span>Mulai Sewa</span> {{-- Label kiri. --}}
                                <span
                                    class="font-medium text-gray-900">{{ \Carbon\Carbon::parse($booking->start_date)->format('d F Y, H:i') }}</span>
                                {{-- Value kanan: Format tanggal start. --}}
                            </div> {{-- Penutup baris. --}}
                            <div class="flex justify-between text-gray-700"> {{-- Baris Selesai Sewa. --}}
                                <span>Selesai Sewa</span> {{-- Label kiri. --}}
                                <span
                                    class="font-medium text-gray-900">{{ \Carbon\Carbon::parse($booking->end_date)->format('d F Y, H:i') }}</span>
                                {{-- Value kanan: Format tanggal end. --}}
                            </div> {{-- Penutup baris. --}}

                            <div class="border-t border-gray-300 pt-3"> {{-- Garis pemisah tipis di atas total. --}}
                                <div class="flex justify-between items-center text-gray-900"> {{-- Baris Total Pembayaran.
                                    --}}
                                    <span class="text-lg font-bold">Total Pembayaran</span> {{-- Label Total: Font besar
                                    tebal. --}}
                                    <span class="text-xl font-bold text-purple-600"> {{-- Value Total: Lebih besar, warna
                                        ungu. --}}
                                        Rp {{ number_format($booking->total_price, 0, ',', '.') }} {{-- Format angka rupiah.
                                        --}}
                                    </span> {{-- Penutup span nilai. --}}
                                </div> {{-- Penutup div baris total. --}}
                            </div> {{-- Penutup container total. --}}
                        </div> {{-- Penutup space-y. --}}
                    @else {{-- Jika variabel $booking TIDAK ada (error case). --}}
                        <p class="text-center text-red-500">Gagal memuat detail pesanan.</p> {{-- Tampilkan pesan error
                        merah. --}}
                    @endif {{-- Penutup logika if. --}}
                </div> {{-- Penutup container detail. --}}

                <div class="mt-8"> {{-- Container tombol aksi dengan margin atas. --}}
                    <div class="flex flex-col sm:flex-row sm:justify-center sm:space-x-4 space-y-3 sm:space-y-0"> {{--
                        Layout tombol: Kolom di HP, Baris di Desktop. --}}

                        {{-- {{-- === [ TOMBOL PDF DITAMBAHKAN DI SINI ] === --}} {{-- Komentar asli Anda: Penanda
                        tombol PDF. --}}
                        <a href="{{ route('booking.downloadInvoice', $booking) }}" {{-- Link ke route download invoice
                            PDF. --}} target="_blank" {{-- Membuka di tab baru. --}}
                            class="w-full sm:w-auto inline-block text-center px-6 py-3 bg-gray-700 text-white font-semibold rounded-lg shadow-md hover:bg-gray-800 transition-colors duration-300">
                            {{-- Styling tombol: Warna abu gelap. --}}
                            Download Struk (PDF) {{-- Teks tombol. --}}
                        </a> {{-- Penutup link download. --}}
                        {{-- {{-- ============================================== --}} {{-- Penutup penanda blok PDF.
                        --}}

                        <a href="{{ route('dashboard') }}" {{-- Link ke dashboard user. --}}
                            class="w-full sm:w-auto inline-block text-center px-6 py-3 bg-purple-600 text-white font-semibold rounded-lg shadow-md hover:bg-purple-700 transition-colors duration-300">
                            {{-- Styling tombol: Warna ungu utama. --}}
                            Lihat Dashboard Saya {{-- Teks tombol. --}}
                        </a> {{-- Penutup link dashboard. --}}

                        <a href="https://wa.me/6285175394607?text=Halo%20Admin%20DigiRent%2C%0A%0ASaya%20sudah%20berhasil%20melakukan%20pembayaran%20untuk%20pesanan%20berikut%20dan%20ingin%20melanjutkan%20proses%20sewa%3A%0A%0ADetail%20Pesanan%0ANo.%20Pesanan%3A%20%23{{ $booking->id ?? '...' }}%0AProduk%3A%20{{ $booking->product->name ?? '...' }}%0A%0ATerima%20kasih."
                            {{-- Link WA API dengan pesan otomatis berisi detail pesanan. --}} target="_blank" {{-- Buka
                            di tab baru. --}}
                            class="w-full sm:w-auto inline-block text-center px-6 py-3 bg-green-600 text-white font-semibold rounded-lg shadow-md hover:bg-green-700 transition-colors duration-300">
                            {{-- Styling tombol: Warna hijau WhatsApp. --}}
                            <svg class="w-5 h-5 inline-block mr-1 -mt-1" fill="currentColor" viewBox="0 0 24 24"> {{--
                                Ikon SVG WhatsApp. --}}
                                <path
                                    d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.0-6.556 5.333-11.891 11.893-11.891 3.181.001 6.167 1.24 8.417 3.488 2.249 2.248 3.487 5.235 3.487 8.417 0 6.556-5.333 11.89-11.893 11.89h-.001c-2.096 0-4.14-.545-5.947-1.587L.057 24zm6.591-3.803c.333.19.734.306 1.15.306.282 0 .56-.039.83-.118.27-.08.529-.19.776-.328.247-.138.48-.303.696-.493.216-.19.42-.408.611-.644.191-.236.36-.502.506-.784.146-.282.256-.589.329-.906.073-.317.111-.644.111-.971 0-.327-.038-.654-.111-.971-.073-.317-.183-.624-.329-.906-.146-.282-.315-.548-.506-.784-.191-.236-.395-.454-.611-.644-.216-.19-.449-.355-.696-.493-.247-.138-.506-.248-.776-.328-.27-.08-.548-.118-.83-.118-.416 0-.817.116-1.15.306-.333.19-.64.41-.913.66-.273.25-.516.529-.728.831-.212.302-.396.63-.546.98-.15.35-.27.717-.354 1.1-.084.383-.128.78-.128 1.18 0 .4.044.797.128 1.18.084.383.204.75.354 1.1.15.35.334.678.546.98.212.302.455.581.728.831.273.25.58.47.913.66zM11.893 2.951c-4.903 0-8.891 3.988-8.891 8.893 0 1.961.638 3.805 1.772 5.304L3.12 21.01l3.018-1.584c1.449.954 3.141 1.464 4.896 1.464h.001c4.903 0 8.891-3.988 8.891-8.893 0-4.904-3.988-8.893-8.891-8.893z" />
                                {{-- Path SVG WA. --}}
                            </svg> {{-- Penutup SVG. --}}
                            Chat Admin (WA) {{-- Teks tombol WA. --}}
                        </a> {{-- Penutup link WA. --}}

                    </div> {{-- Penutup container tombol. --}}
                </div> {{-- Penutup wrapper tombol mt-8. --}}

            </div> {{-- Penutup kotak utama. --}}
        </div> {{-- Penutup container max-width. --}}
    </div> {{-- Penutup wrapper utama. --}}
</x-app-layout> {{-- Penutup komponen layout. --}}