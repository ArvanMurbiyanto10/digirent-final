<?php

namespace App\Http\Controllers\Admin; // Menentukan lokasi namespace file ini agar bisa dipanggil oleh Laravel.

use App\Http\Controllers\Controller; // Mengimpor Controller induk (base controller).
use App\Models\Booking;              // Mengimpor Model Booking untuk berinteraksi dengan tabel 'bookings'.
use Illuminate\Contracts\View\View;   // Mengimpor interface View untuk menetapkan tipe return method dashboard.
use Illuminate\Http\RedirectResponse;  // Mengimpor tipe return untuk redirect (setelah update status).

class AdminController extends Controller // Definisi kelas AdminController.
{
    /**
     * Menampilkan halaman dashboard admin dengan statistik dan daftar pesanan.
     * @return View
     */
    public function dashboard(): View // Method 'dashboard' wajib mengembalikan tampilan (View).
    {
        // 1. MENGAMBIL DATA DAFTAR PESANAN
        $bookings = Booking::with(['user', 'product']) // Eager Loading: Ambil data relasi 'user' dan 'product' sekaligus biar query cepat.
            ->latest()                                  // Urutkan data berdasarkan 'created_at' (paling baru di atas).
            ->get();                                    // Eksekusi query dan ambil semua hasilnya menjadi Collection.

        // 2. MENGHITUNG TOTAL PENDAPATAN (Financial Metric)
        // Kita hanya menjumlahkan 'total_price' jika statusnya 'confirmed' (sudah bayar).
        // Pesanan 'pending' atau batal tidak boleh dihitung sebagai omzet.
        $totalRevenue = Booking::where('status', 'confirmed')->sum('total_price');

        // 3. MENGHITUNG JUMLAH ORDER PENDING (Operational Metric)
        // Ini berguna untuk notifikasi badge atau kartu peringatan admin bahwa ada X pesanan yang butuh tindakan.
        $pendingCount = Booking::where('status', 'pending')->count();

        // 4. MENGHITUNG TOTAL TRANSAKSI SUKSES (Performance Metric)
        // Menghitung berapa kali penyewaan berhasil dilakukan.
        $successCount = Booking::where('status', 'confirmed')->count();

        // Mengembalikan file view 'resources/views/admin/dashboard.blade.php'.
        // Fungsi compact() membungkus semua variabel ($bookings, $totalRevenue, dll) menjadi array untuk dikirim ke View.
        return view('admin.dashboard', compact('bookings', 'totalRevenue', 'pendingCount', 'successCount'));
    }

    /**
     * Mengubah status booking menjadi 'confirmed' (Manual Confirmation).
     * @param Booking $booking (Route Model Binding: cari booking by ID otomatis)
     * @return RedirectResponse
     */
    public function confirmBooking(Booking $booking): RedirectResponse // Method ini mengembalikan RedirectResponse.
    {
        // Mengubah properti status pada objek booking yang dipilih menjadi 'confirmed'.
        $booking->status = 'confirmed';

        // Menyimpan perubahan tersebut ke database (SQL UPDATE).
        $booking->save();

        // Mengembalikan admin ke halaman dashboard setelah sukses.
        return redirect()
            ->route('admin.dashboard') // Arahkan ke route admin dashboard.
            ->with('success', 'Status pesanan berhasil diubah menjadi Sudah Bayar (Confirmed).'); // Kirim pesan notifikasi sukses (Flash Message).
    }
}
