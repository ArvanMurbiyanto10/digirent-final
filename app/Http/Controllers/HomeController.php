<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\NewsItem;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $products = Product::latest()->take(10)->get();

        // PERBAIKAN: Ubah nama variabel dari $news menjadi $newsItems
        // agar cocok dengan yang diminta oleh file welcome.blade.php
        $newsItems = NewsItem::latest()->take(4)->get();

        // Jangan lupa ubah di dalam compact() juga
        return view('welcome', compact('products', 'newsItems'));
    }
}
