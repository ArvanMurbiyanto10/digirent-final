<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class PageController extends Controller
{
   public function terms()
    {
        return view('pages.terms');
    }

    // Fungsi untuk menampilkan halaman Kebijakan Privasi
    public function privacy()
    {
        return view('pages.privacy');
    }
}

