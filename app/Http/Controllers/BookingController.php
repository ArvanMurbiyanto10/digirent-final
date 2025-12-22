<?php

namespace App\Http\Controllers; // Menentukan namespace lokasi file ini.

use App\Http\Controllers\Controller; // Mengimpor Controller induk.
use App\Models\Booking; // Mengimpor Model Booking untuk simpan data pesanan.
use App\Models\Product; // Mengimpor Model Product untuk ambil data harga/produk.
use Carbon\Carbon; // Mengimpor Carbon untuk manipulasi tanggal (hitung durasi).
use Illuminate\Http\RedirectResponse; // Tipe data kembalian redirect.
use Illuminate\Http\Request; // Class Request untuk menangani input form.
use Illuminate\Support\Facades\Auth; // Facade Auth untuk ambil data user login.
use Illuminate\View\View; // Tipe data kembalian view.

class BookingController extends Controller // Definisi kelas controller.
{
    /**
     * Menampilkan form booking untuk produk tertentu.
     */
    public function create(Product $product): View // Method create menerima model Product (Route Model Binding).
    {
        return view('bookings.create', compact('product')); // Tampilkan view form dan kirim data produk.
    }

    /**
     * Memproses penyimpanan booking dan request ke Midtrans.
     */
    public function store(Request $request): RedirectResponse // Method store menerima Request.
    {
        // Validasi input dari form sewa.
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id', // ID Produk wajib ada di tabel products.
            'start_date' => 'required|date|after_or_equal:today', // Tgl mulai harus hari ini atau sesudahnya.
            'end_date' => 'required|date|after:start_date', // Tgl selesai harus setelah tgl mulai.
        ]);

        /** @var \App\Models\Product $product */ // Hinting untuk IDE bahwa ini model Product.
        $product = Product::findOrFail($validated['product_id']); // Cari produk berdasarkan ID, jika tidak ada -> 404.

        // ✅ PHPStan AMAN: start_date & end_date diubah dari string ke objek Carbon.
        $startDate = Carbon::parse($validated['start_date']); // Parsing tanggal mulai.
        $endDate = Carbon::parse($validated['end_date']); // Parsing tanggal selesai.

        // Menghitung durasi sewa dalam hari.
        $days = $startDate->diffInDays($endDate); // Hitung selisih hari.
        if ($days < 1) { // Jika selisih 0 (sewa & kembali hari yang sama), hitung 1 hari.
            $days = 1; // Set minimal 1 hari.
        }

        // Menghitung total harga sewa.
        $totalPrice = $days * (int) $product->price_per_day; // Durasi dikali harga per hari.

        /** @var \App\Models\User $user */ // Hinting user model.
        $user = Auth::user(); // Ambil data user yang sedang login.

        // ==========================================
        // KONFIGURASI MIDTRANS
        // ==========================================
        \Midtrans\Config::$serverKey = config('midtrans.server_key'); // Set Server Key dari file .env/config.
        \Midtrans\Config::$isProduction = config('midtrans.is_production'); // Set environment (Sandbox/Production).
        \Midtrans\Config::$isSanitized = true; // Aktifkan sanitasi data (bersihkan input berbahaya).
        \Midtrans\Config::$is3ds = true; // Aktifkan 3D Secure untuk keamanan kartu kredit.

        // Membuat Order ID Unik: RENT-TIMESTAMP-USERID.
        $orderId = 'RENT-' . time() . '-' . $user->id; // Contoh: RENT-17099999-5.

        // Menyiapkan parameter untuk dikirim ke API Midtrans.
        $params = [
            'transaction_details' => [ // Detail transaksi utama.
                'order_id' => $orderId, // ID Order unik.
                'gross_amount' => $totalPrice, // Total harga yang harus dibayar.
            ],
            'customer_details' => [ // Data pelanggan.
                'first_name' => $user->name, // Nama user.
                'email' => $user->email, // Email user.
                'phone' => $user->phone ?? '08123456789', // No HP (Default dummy jika null).
            ],
            'item_details' => [ // Detail item (Opsional tapi bagus untuk rincian).
                [
                    'id' => $product->id, // ID Produk.
                    'price' => (int) $product->price_per_day, // Harga satuan.
                    'quantity' => $days, // Jumlah hari dianggap quantity.
                    'name' => substr($product->name ?? 'Produk', 0, 50), // Nama produk (dipotong max 50 char).
                ]
            ]
        ];

        // Meminta Snap Token dari Midtrans berdasarkan parameter di atas.
        $snapToken = \Midtrans\Snap::getSnapToken($params); // Token ini dipakai untuk popup pembayaran.

        // Simpan data Booking ke database aplikasi kita.
        Booking::create([
            'user_id' => $user->id, // ID User penyewa.
            'product_id' => $product->id, // ID Produk yang disewa.
            'start_date' => $startDate, // Tanggal mulai.
            'end_date' => $endDate, // Tanggal selesai.
            'total_price' => $totalPrice, // Total harga.
            'status' => 'pending', // Status awal 'pending' (belum bayar).
            'snap_token' => $snapToken, // Simpan token Midtrans.
        ]);

        // Redirect user ke Dashboard dengan pesan sukses.
        return redirect()
            ->route('dashboard') // Arahkan ke route dashboard.
            ->with('success', 'Booking berhasil dibuat! Silakan lakukan pembayaran.'); // Flash message.
    }

    /**
     * Menampilkan detail booking (Biasanya untuk halaman bayar).
     */
    public function show(Booking $booking): View // Route Model Binding.
    {
        // Pastikan hanya pemilik booking atau admin yang bisa lihat.
        if ($booking->user_id !== Auth::id() && Auth::user()->role !== 'admin') {
            abort(403); // Akses ditolak.
        }

        return view('bookings.show', compact('booking')); // Tampilkan detail booking.
    }
}
