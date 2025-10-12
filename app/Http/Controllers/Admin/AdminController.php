<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Menampilkan halaman dashboard admin dengan semua data pesanan.
     */
    public function dashboard()
    {
        $bookings = Booking::with(['user', 'product'])->latest()->get();
        return view('admin.dashboard', compact('bookings'));
    }

    /**
     * Mengubah status booking menjadi 'confirmed'.
     */
    public function confirmBooking(Booking $booking)
    {
        $booking->status = 'confirmed';
        $booking->save();

        return redirect()->route('admin.dashboard')->with('success', 'Status pesanan berhasil diubah menjadi Sudah Bayar (Confirmed).');
    }
}
