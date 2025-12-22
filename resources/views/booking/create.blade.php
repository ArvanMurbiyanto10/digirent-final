<x-app-layout> {{-- Menggunakan komponen layout utama aplikasi (AppLayout). --}}
    <x-slot name="header"> {{-- Membuka slot bernama 'header' untuk judul halaman. --}}
        <h2 class="font-semibold text-xl text-gray-800 leading-tight"> {{-- Styling judul: font tebal, ukuran XL, warna abu gelap. --}}
            Formulir Sewa: {{ $product->name }} {{-- Menampilkan judul halaman "Formulir Sewa" diikuti nama produk. --}}
        </h2> {{-- Penutup tag judul h2. --}}
    </x-slot> {{-- Penutup slot header. --}}

    {{-- {{-- 1. Memuat CSS untuk kalender Flatpickr --}} {{-- Komentar asli Anda: Penjelasan section CSS. --}}
    @push('styles') {{-- Mendorong link CSS ini ke stack 'styles' di layout utama. --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css"> {{-- Memuat file CSS library Flatpickr dari CDN. --}}
    @endpush {{-- Penutup directive push styles. --}}

    <div class="py-12 bg-gray-50"> {{-- Wrapper utama: padding vertikal 12, background abu-abu muda. --}}
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8"> {{-- Container max-width 4xl, rata tengah, padding responsif. --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg"> {{-- Kartu background putih dengan shadow dan sudut membulat. --}}
                <div class="p-6 md:p-8"> {{-- Container konten dengan padding 6 (atau 8 di layar medium). --}}

                    <div class="flex items-center space-x-6 mb-8 pb-8 border-b"> {{-- Header info produk: Flexbox, jarak antar item, border bawah. --}}
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-24 h-24 object-cover rounded-md shadow-md"> {{-- Gambar produk: Ukuran 24x24, object-cover, rounded. --}}
                        <div> {{-- Wrapper teks info produk. --}}
                            <p class="text-sm text-gray-500">Anda akan menyewa:</p> {{-- Label kecil "Anda akan menyewa:". --}}
                            <h4 class="text-2xl font-bold text-gray-800">{{ $product->name }}</h4> {{-- Nama produk dengan font besar dan tebal. --}}
                        </div> {{-- Penutup wrapper teks. --}}
                    </div> {{-- Penutup header info produk. --}}

                    <form action="{{ route('booking.store') }}" method="POST"> {{-- Form pembuka: Mengarah ke route booking.store, method POST. --}}
                        @csrf {{-- Token keamanan CSRF (Wajib untuk form POST). --}}
                        <input type="hidden" name="product_id" value="{{ $product->id }}"> {{-- Input hidden: Mengirim ID produk yang disewa. --}}

                        <div class="space-y-8"> {{-- Wrapper elemen form dengan jarak vertikal antar elemen. --}}
                            <div> {{-- Bagian 1: Input Durasi. --}}
                                <h2 class="text-xl font-semibold text-gray-700 mb-3">1. Atur Durasi & Waktu Sewa</h2> {{-- Judul bagian 1. --}}
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4"> {{-- Grid layout: 1 kolom di HP, 2 kolom di Medium. --}}
                                    <div> {{-- Kolom Start Date. --}}
                                        <label for="start_date" class="block text-sm font-medium text-gray-600">Mulai Sewa (Tanggal & Jam)</label> {{-- Label input mulai sewa. --}}
                                        <input type="text" id="start_date" name="start_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500" placeholder="Pilih tanggal & waktu..." required> {{-- Input text untuk kalender (Flatpickr), border ungu saat fokus. --}}
                                    </div> {{-- Penutup kolom start date. --}}
                                    <div> {{-- Kolom End Date. --}}
                                        <label for="end_date" class="block text-sm font-medium text-gray-600">Selesai Sewa (Tanggal & Jam)</label> {{-- Label input selesai sewa. --}}
                                        <input type="text" id="end_date" name="end_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500" placeholder="Pilih tanggal & waktu..." required> {{-- Input text untuk kalender selesai. --}}
                                    </div> {{-- Penutup kolom end date. --}}
                                </div> {{-- Penutup grid input tanggal. --}}
                            </div> {{-- Penutup bagian 1. --}}

                            <div> {{-- Bagian 2: Rincian Pesanan. --}}
                                <h2 class="text-xl font-semibold text-gray-700 mb-4">2. Rincian Pesanan</h2> {{-- Judul bagian 2. --}}
                                <div class="space-y-4 bg-purple-50 border-2 border-dashed border-purple-200 rounded-lg p-6"> {{-- Kotak rincian: Background ungu muda, border putus-putus ungu. --}}
                                    <div class="flex justify-between text-gray-600"> {{-- Baris rincian: Flexbox kiri-kanan. --}}
                                        <span>Harga per hari (24 jam)</span> {{-- Label kiri. --}}
                                        <span id="harga_per_hari" data-price="{{ $product->price_per_day }}" class="font-medium">Rp {{ number_format($product->price_per_day) }}</span> {{-- Value kanan: Harga produk dari database. --}}
                                    </div> {{-- Penutup baris harga. --}}
                                    <div class="flex justify-between text-gray-600"> {{-- Baris rincian durasi. --}}
                                        <span>Durasi Sewa</span> {{-- Label kiri. --}}
                                        <span id="rental_duration" class="font-medium">- hari</span> {{-- Value kanan: Placeholder durasi (akan diupdate JS). --}}
                                    </div> {{-- Penutup baris durasi. --}}
                                    <hr class="my-2 border-purple-200"> {{-- Garis pemisah horizontal warna ungu. --}}
                                    <div class="flex justify-between text-xl font-bold text-gray-800"> {{-- Baris Total: Font besar dan tebal. --}}
                                        <span>Total Pembayaran</span> {{-- Label kiri total. --}}
                                        <span id="total_payment" class="text-purple-600">Rp 0</span> {{-- Value kanan total: Warna teks ungu (akan diupdate JS). --}}
                                    </div> {{-- Penutup baris total. --}}
                                </div> {{-- Penutup kotak rincian. --}}
                            </div> {{-- Penutup bagian 2. --}}

                            <div class="pt-4"> {{-- Container tombol submit. --}}
                                <button type="submit" id="submit_button" class="w-full text-white text-lg font-semibold py-3 rounded-lg shadow-md transition-colors duration-300 bg-purple-600 hover:bg-purple-700 disabled:bg-purple-300 disabled:cursor-not-allowed" disabled> {{-- Tombol Submit: Awalnya disabled, warna ungu, efek hover, lebar penuh. --}}
                                    Lanjutkan ke Pembayaran {{-- Teks tombol. --}}
                                </button> {{-- Penutup tag button. --}}
                            </div> {{-- Penutup container tombol. --}}
                        </div> {{-- Penutup wrapper spacing form. --}}
                    </form> {{-- Penutup form. --}}
                </div> {{-- Penutup konten padding. --}}
            </div> {{-- Penutup kartu. --}}
        </div> {{-- Penutup container. --}}
    </div> {{-- Penutup wrapper utama. --}}

    {{-- {{-- 2. Memuat JS untuk Flatpickr dan logika kalkulasi --}} {{-- Komentar asli Anda: Penjelasan section JS. --}}
    @push('scripts') {{-- Mendorong script JS ini ke stack 'scripts' layout utama. --}}
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script> {{-- Memuat library JS Flatpickr dari CDN. --}}
    <script> {{-- Membuka tag script kustom. --}}
        document.addEventListener('DOMContentLoaded', function () { {{-- Event listener: Menunggu halaman selesai dimuat sepenuhnya. --}}
            const startDateEl = document.getElementById('start_date'); {{-- Mengambil elemen input start_date. --}}
            const endDateEl = document.getElementById('end_date'); {{-- Mengambil elemen input end_date. --}}
            const durationEl = document.getElementById('rental_duration'); {{-- Mengambil elemen span durasi. --}}
            const totalEl = document.getElementById('total_payment'); {{-- Mengambil elemen span total pembayaran. --}}
            const submitButton = document.getElementById('submit_button'); {{-- Mengambil tombol submit. --}}
            const hargaPerHariEl = document.getElementById('harga_per_hari'); {{-- Mengambil elemen span harga per hari. --}}
            const pricePerDay = parseFloat(hargaPerHariEl.getAttribute('data-price')); {{-- Mengambil harga dari atribut data-price dan mengubah ke float. --}}

            function calculateAndUpdate() { {{-- Fungsi untuk menghitung durasi dan total harga. --}}
                const startDate = fpStart.selectedDates[0]; {{-- Mengambil tanggal yang dipilih dari Flatpickr Start. --}}
                const endDate = fpEnd.selectedDates[0]; {{-- Mengambil tanggal yang dipilih dari Flatpickr End. --}}

                durationEl.textContent = '- hari'; {{-- Reset teks durasi. --}}
                totalEl.textContent = 'Rp 0'; {{-- Reset teks total harga. --}}
                submitButton.disabled = true; {{-- Nonaktifkan tombol submit. --}}

                if (startDate && endDate && endDate > startDate) { {{-- Cek validasi: Tanggal ada dan End > Start. --}}
                    const diffTime = endDate.getTime() - startDate.getTime(); {{-- Hitung selisih waktu dalam milidetik. --}}
                    const diffHours = diffTime / (1000 * 3600); {{-- Konversi milidetik ke jam. --}}
                    const diffDays = diffHours > 0 ? Math.ceil(diffHours / 24) : 1; {{-- Hitung hari (pembulatan ke atas), minimal 1 hari. --}}
                    const totalCost = diffDays * pricePerDay; {{-- Hitung total biaya. --}}

                    durationEl.textContent = `${diffDays} hari`; {{-- Update teks durasi di HTML. --}}
                    totalEl.textContent = `Rp ${totalCost.toLocaleString('id-ID')}`; {{-- Update teks total harga dengan format Rupiah. --}}
                    submitButton.disabled = false; {{-- Aktifkan tombol submit. --}}
                } {{-- Penutup blok if. --}}
            } {{-- Penutup fungsi calculateAndUpdate. --}}

            const flatpickrConfig = { {{-- Konfigurasi dasar untuk Flatpickr. --}}
                enableTime: true, {{-- Aktifkan pemilihan jam/waktu. --}}
                dateFormat: "Y-m-d H:i", {{-- Format tanggal input: Tahun-Bulan-Hari Jam:Menit. --}}
                minDate: "today", {{-- Tanggal minimal adalah hari ini. --}}
                time_24hr: true, {{-- Gunakan format waktu 24 jam. --}}
            }; {{-- Penutup objek config. --}}

            const fpStart = flatpickr(startDateEl, { {{-- Inisialisasi Flatpickr pada input Start Date. --}}
                ...flatpickrConfig, {{-- Gunakan config dasar di atas. --}}
                onChange: function(selectedDates) { {{-- Event handler saat tanggal mulai berubah. --}}
                    if (selectedDates[0]) { {{-- Jika tanggal dipilih... --}}
                        fpEnd.set('minDate', selectedDates[0]); {{-- Set tanggal minimal End Date sama dengan Start Date. --}}
                    } {{-- Penutup blok if. --}}
                    calculateAndUpdate(); {{-- Panggil fungsi hitung ulang. --}}
                } {{-- Penutup event handler. --}}
            }); {{-- Penutup inisialisasi fpStart. --}}

            const fpEnd = flatpickr(endDateEl, { {{-- Inisialisasi Flatpickr pada input End Date. --}}
                ...flatpickrConfig, {{-- Gunakan config dasar. --}}
                onChange: calculateAndUpdate {{-- Panggil fungsi hitung ulang saat tanggal berubah. --}}
            }); {{-- Penutup inisialisasi fpEnd. --}}
        }); {{-- Penutup event listener DOMContentLoaded. --}}
    </script> {{-- Penutup tag script. --}}
    @endpush {{-- Penutup directive push scripts. --}}
</x-app-layout> {{-- Penutup komponen layout. --}}
