<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View; // <-- Tambahkan import ini

class DashboardController extends Controller
{
    public function index(): View // <-- Tambahkan tipe return : View
    {
        /** @var \App\Models\User $user */ // <-- Tambahkan baris ini agar PHPStan tahu user tidak null
        $user = Auth::user();

        // Mengambil booking milik user, beserta data produk, diurutkan dari yang terbaru
        $bookings = $user->bookings()->with('product')->latest()->get();

        return view('dashboard', compact('bookings'));
    }
}
