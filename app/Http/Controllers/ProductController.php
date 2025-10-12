<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->latest()->get();
        $categories = Category::all();
        return view('products.index', compact('products', 'categories'));
    }

    /**
     * TAMBAHKAN METHOD INI
     * Menampilkan halaman detail untuk satu produk.
     */
    public function show(Product $product)
    {
        // $product sudah otomatis diambil dari database berdasarkan slug di URL
        return view('products.show', compact('product'));
    }
}
