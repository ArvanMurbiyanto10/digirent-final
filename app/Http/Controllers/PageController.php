<?php

namespace App\Http\Controllers;

use Illuminate\View\View; // <-- Tambahkan import ini

class PageController extends Controller
{
    public function terms(): View // <-- Tambahkan tipe return : View
    {
        return view('pages.terms');
    }

    // Fungsi untuk menampilkan halaman Kebijakan Privasi
    public function privacy(): View // <-- Tambahkan tipe return : View
    {
        return view('pages.privacy');
    }
}
