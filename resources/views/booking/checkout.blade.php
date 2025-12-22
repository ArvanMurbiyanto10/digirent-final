<x-app-layout> {{-- Menggunakan komponen layout utama aplikasi (AppLayout). --}}
    <x-slot name="header"> {{-- Membuka slot 'header' untuk judul halaman. --}}
        <h2 class="font-semibold text-xl text-gray-800 leading-tight"> {{-- Styling judul: font tebal, ukuran XL, warna
            abu gelap. --}}
            Konfirmasi & Pembayaran {{-- Judul halaman: Konfirmasi & Pembayaran. --}}
        </h2> {{-- Penutup tag judul h2. --}}
    </x-slot> {{-- Penutup slot header. --}}

    {{-- {{-- Script for Midtrans Snap --}} {{-- Komentar asli Anda: Penanda script Midtrans. --}}
    @push('scripts') {{-- Mendorong script ini ke stack 'scripts' di layout utama (agar dimuat di bawah). --}}
        <script type="text/javascript" {{-- Tag pembuka script JS untuk Midtrans Snap. --}}
            src="https://app.sandbox.midtrans.com/snap/snap.js" {{-- URL source script library Midtrans Sandbox. --}}
            data-client-key="{{ config('midtrans.client_key') }}"></script> {{-- Client Key diambil dari config Laravel.
        --}}
    @endpush {{-- Penutup directive push. --}}

    <div class="py-12 bg-gray-50"> {{-- Wrapper utama: padding vertikal 12, background abu-abu sangat muda. --}}
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8"> {{-- Container max-width 2xl (lebih kecil/fokus), rata tengah.
            --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg"> {{-- Kartu putih dengan shadow dan sudut
                membulat. --}}
                <div class="p-6 md:p-8 text-gray-900"> {{-- Padding dalam 6 (atau 8 di layar medium), teks gelap. --}}

                    <h1 class="text-3xl font-bold text-center mb-2">Satu Langkah Lagi!</h1> {{-- Judul besar (H1) rata
                    tengah: "Satu Langkah Lagi!". --}}
                    <p class="text-center text-gray-500 mb-8">Pesanan Anda berhasil dibuat. Silakan selesaikan
                        pembayaran untuk mengonfirmasi pesanan Anda.</p> {{-- Pesan instruksi rata tengah, warna
                    abu-abu. --}}

                    {{-- {{-- Order Receipt Details --}} {{-- Komentar asli Anda: Bagian rincian struk pesanan. --}}
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 space-y-4 mb-8"> {{-- Kotak struk:
                        Border garis putus-putus, padding 6, jarak antar elemen vertikal. --}}
                        <div class="flex justify-between"> {{-- Baris rincian: Flexbox kiri-kanan. --}}
                            <span class="font-semibold text-gray-500">No. Pesanan</span> {{-- Label kiri: No. Pesanan.
                            --}}
                            <span class="font-bold text-gray-800">#{{ $booking->id }}</span> {{-- Value kanan: ID
                            Booking. --}}
                        </div> {{-- Penutup baris rincian. --}}
                        <div class="flex justify-between"> {{-- Baris rincian baru. --}}
                            <span class="font-semibold text-gray-500">Nama Penyewa</span> {{-- Label kiri: Nama Penyewa.
                            --}}
                            <span class="font-bold text-gray-800">{{ $booking->user->name }}</span> {{-- Value kanan:
                            Nama User. --}}
                        </div> {{-- Penutup baris rincian. --}}
                        <hr> {{-- Garis pemisah horizontal (horizontal rule). --}}
                        <div class="flex justify-between"> {{-- Baris rincian baru. --}}
                            <span class="font-semibold text-gray-500">Produk</span> {{-- Label kiri: Produk. --}}
                            <span class="font-bold text-gray-800">{{ $booking->product->name }}</span> {{-- Value kanan:
                            Nama Produk. --}}
                        </div> {{-- Penutup baris rincian. --}}
                        <div class="flex justify-between"> {{-- Baris rincian baru. --}}
                            <span class="font-semibold text-gray-500">Tanggal Mulai</span> {{-- Label kiri: Tanggal
                            Mulai. --}}
                            <span
                                class="font-medium text-gray-800">{{ $booking->start_date->format('d M Y, H:i') }}</span>
                            {{-- Value kanan: Format tanggal & jam mulai. --}}
                        </div> {{-- Penutup baris rincian. --}}
                        <div class="flex justify-between"> {{-- Baris rincian baru. --}}
                            <span class="font-semibold text-gray-500">Tanggal Selesai</span> {{-- Label kiri: Tanggal
                            Selesai. --}}
                            <span
                                class="font-medium text-gray-800">{{ $booking->end_date->format('d M Y, H:i') }}</span>
                            {{-- Value kanan: Format tanggal & jam selesai. --}}
                        </div> {{-- Penutup baris rincian. --}}
                        <hr> {{-- Garis pemisah horizontal lagi. --}}
                        <div class="flex justify-between text-xl"> {{-- Baris Total: Ukuran font lebih besar (XL). --}}
                            <span class="font-bold text-gray-800">Total Pembayaran</span> {{-- Label kiri: Total
                            Pembayaran. --}}
                            <span class="font-bold text-purple-600">Rp {{ number_format($booking->total_price) }}</span>
                            {{-- Value kanan: Total harga, warna ungu. --}}
                        </div> {{-- Penutup baris total. --}}
                    </div> {{-- Penutup kotak struk. --}}

                    {{-- {{-- Payment Button --}} {{-- Komentar asli Anda: Bagian tombol bayar. --}}
                    <div class="text-center"> {{-- Wrapper tombol rata tengah. --}}
                        <button id="pay-button"
                            class="w-full md:w-auto inline-block bg-purple-600 text-white text-lg font-semibold py-3 px-12 rounded-lg shadow-md hover:bg-purple-700 transition-colors duration-300">
                            {{-- Tombol Bayar: ID 'pay-button', warna ungu, responsif (full width di HP), shadow. --}}
                            Bayar Sekarang {{-- Teks tombol. --}}
                        </button> {{-- Penutup tag button. --}}
                    </div> {{-- Penutup wrapper tombol. --}}

                </div> {{-- Penutup area konten padding. --}}
            </div> {{-- Penutup kartu putih. --}}
        </div> {{-- Penutup container max-width. --}}
    </div> {{-- Penutup wrapper utama. --}}

    {{-- {{-- JavaScript to call Midtrans popup --}} {{-- Komentar asli Anda: Script logika popup Midtrans. --}}
    @push('scripts') {{-- Mendorong script JS ini ke stack 'scripts'. --}}
        <script type="text/javascript"> { { --Membuka tag script JS. -- } }
            var payButton = document.getElementById('pay-button'); { { --Mengambil elemen tombol bayar berdasarkan ID. -- } }
            payButton.addEventListener('click', function () {
                { { --Menambahkan event listener 'click' pada tombol. -- } }
                window.snap.pay('{{ $snapToken }}', { {{-- Memanggil fungsi snap.pay Midtrans dengan token dari controller. --}}
                onSuccess: function (result) {
                    { { --Callback jika pembayaran SUKSES. -- } }
                    // INI ADALAH BAGIAN YANG MEMPERBAIKINYA {{-- Komentar asli JS: Penanda bagian redirect sukses. --}}
                    window.location.href = '{{ route("booking.success", $booking) }}'; { { --Redirect user ke halaman sukses booking. -- } }
                }, {{-- Penutup blok onSuccess. --}}
                onPending: function (result) {
                    { { --Callback jika pembayaran PENDING. -- } }
                    alert("Menunggu pembayaran!"); { { --Tampilkan alert menunggu. -- } }
                }, {{-- Penutup blok onPending. --}}
                onError: function (result) {
                    { { --Callback jika pembayaran ERROR / GAGAL. -- } }
                    alert("Pembayaran gagal!"); { { --Tampilkan alert gagal. -- } }
                }, {{-- Penutup blok onError. --}}
                onClose: function () {
                    { { --Callback jika user MENUTUP popup tanpa bayar. -- } }
                    alert('Anda menutup jendela pembayaran.'); { { --Tampilkan alert penutupan. -- } }
                } {{-- Penutup blok onClose. --}}
            }); { { --Penutup fungsi snap.pay. -- } }
          }); { { --Penutup event listener. -- } }
        </script> {{-- Penutup tag script. --}}
    @endpush {{-- Penutup directive push script. --}}
</x-app-layout> {{-- Penutup komponen layout utama. --}}