<?php

namespace App\Http\Controllers; // Pastikan namespace-nya BENAR

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

    public function show(Product $product)
    {
        // The $product variable is automatically fetched from the database
        // based on the slug in the URL.
        return view('products.show', compact('product'));
    }
}
