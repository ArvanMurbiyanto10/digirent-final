<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; // Mengimpor Controller utama
use App\Models\Booking;               // Mengimpor model Booking
use Illuminate\Contracts\View\View;   // Mengimpor tipe return untuk view
use Illuminate\Http\RedirectResponse;  // Mengimpor tipe return untuk redirect

class AdminController extends Controller
{
    /**
     * Menampilkan halaman dashboard admin dengan semua data pesanan.
     * @return View  // Mengembalikan tampilan dashboard admin
     */
    public function dashboard(): View
    {
        $bookings = Booking::with(['user', 'product']) // Mengambil relasi user dan product
            ->latest()                                  // Mengurutkan berdasarkan terbaru
            ->get();                                     // Mengambil seluruh data

        return view('admin.dashboard', compact('bookings')); // Mengembalikan view dashboard
    }

    /**
     * Mengubah status booking menjadi 'confirmed'.
     * @param Booking $booking // Parameter binding model Booking
     * @return RedirectResponse // Mengembalikan respon redirect
     */
    public function confirmBooking(Booking $booking): RedirectResponse
    {
        $booking->status = 'confirmed';  // Mengubah status pesanan menjadi confirmed
        $booking->save();                // Menyimpan perubahan ke database

        return redirect()                // Redirect ke halaman dashboard
            ->route('admin.dashboard')   // Menggunakan route admin.dashboard
            ->with('success', 'Status pesanan berhasil diubah menjadi Sudah Bayar (Confirmed).'); // Flash message
    }
}
