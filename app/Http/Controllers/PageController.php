<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function terms()
    {
        return view('pages.terms');
    }

    // TAMBAHKAN FUNGSI BARU DI BAWAH INI
    public function privacy()
    {
        return view('pages.privacy');
    }
}
