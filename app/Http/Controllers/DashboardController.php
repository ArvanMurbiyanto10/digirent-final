<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Mengambil booking milik user, beserta data produk, diurutkan dari yang terbaru
        $bookings = $user->bookings()->with('product')->latest()->get();

        return view('dashboard', compact('bookings'));
    }
}
