<?php

namespace App\Http\Controllers;

use App\Models\NewsItem;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::latest()->take(10)->get();
        $newsItems = NewsItem::latest()->take(10)->get(); // Ambil maksimal 10 berita terbaru

        return view('welcome', compact('products', 'newsItems')); // Kirim newsItems ke view
    }
}
