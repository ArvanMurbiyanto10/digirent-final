<?php

namespace App\Http\Controllers\Admin; // Menentukan namespace (lokasi folder logis) agar kelas ini bisa dipanggil dengan benar oleh Laravel

use App\Http\Controllers\Controller; // Mengimpor kelas Controller induk bawaan Laravel
use App\Models\Booking;              // Mengimpor Model Booking agar kita bisa mengakses data di tabel 'bookings'
use Illuminate\Contracts\View\View;   // Mengimpor interface View untuk menetapkan tipe data kembalian (return type)
use Illuminate\Http\RedirectResponse;  // Mengimpor kelas RedirectResponse untuk menetapkan tipe data kembalian redirect

class AdminController extends Controller // Mendefinisikan kelas AdminController yang mewarisi (extends) fitur-fitur dari Controller utama
{
    /**
     * Menampilkan halaman dashboard admin dengan semua data pesanan.
     * @return View  // Dokumentasi PHPDoc: Metode ini mengembalikan objek View
     */
    public function dashboard(): View // Mendefinisikan method public bernama 'dashboard' yang wajib mengembalikan sebuah View
    {
        $bookings = Booking::with(['user', 'product']) // Memulai query Eloquent: Ambil data Booking beserta relasi 'user' dan 'product' (Eager Loading untuk performa)
            ->latest()                                  // Mengurutkan hasil berdasarkan kolom 'created_at' secara menurun (data terbaru muncul paling atas)
            ->get();                                    // Mengeksekusi query dan mengambil seluruh hasilnya dalam bentuk Collection

        return view('admin.dashboard', compact('bookings')); // Mengembalikan view yang ada di 'resources/views/admin/dashboard.blade.php' dan mengirimkan variabel $bookings ke sana
    }

    /**
     * Mengubah status booking menjadi 'confirmed'.
     * @param Booking $booking // Laravel otomatis mencari data Booking berdasarkan ID di URL (Route Model Binding)
     * @return RedirectResponse // Dokumentasi PHPDoc: Metode ini mengembalikan respon Redirect
     */
    public function confirmBooking(Booking $booking): RedirectResponse // Mendefinisikan method 'confirmBooking' yang menerima parameter model Booking
    {
        $booking->status = 'confirmed';  // Mengubah nilai properti/kolom 'status' pada objek booking tersebut menjadi 'confirmed'
        $booking->save();                // Menyimpan perubahan data tersebut ke dalam database (melakukan query UPDATE)

        return redirect()                // Memulai pembuatan respon redirect (pengalihan halaman)
            ->route('admin.dashboard')   // Mengarahkan pengguna kembali ke route yang bernama 'admin.dashboard'
            ->with('success', 'Status pesanan berhasil diubah menjadi Sudah Bayar (Confirmed).'); // Menyimpan pesan sukses ke dalam session flash (hanya muncul sekali) untuk notifikasi
    }
}
