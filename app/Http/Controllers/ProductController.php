<?php

namespace App\Http\Controllers; // Menentukan namespace (alamat logis) file ini.

use App\Models\Category; // Mengimpor Model Category untuk fitur filter/daftar kategori.
use App\Models\Product;  // Mengimpor Model Product untuk mengambil data produk.
use Illuminate\View\View; // Mengimpor tipe data kembalian View.

class ProductController extends Controller // Controller untuk halaman Publik (Customer).
{
    /**
     * Menampilkan daftar semua produk ke pengunjung website.
     */
    public function index(): View // Method index wajib mengembalikan View.
    {
        // Mengambil data produk dengan Eager Loading ('with').
        // 'with(\'category\')' : Ambil data kategori sekaligus untuk mencegah query berulang (N+1 Problem).
        // 'latest()'         : Urutkan dari produk yang paling baru ditambahkan.
        // 'get()'            : Eksekusi query.
        $products = Product::with('category')->latest()->get();

        // Mengambil semua data kategori.
        // Biasanya digunakan untuk membuat sidebar filter kategori di halaman depan.
        $categories = Category::all();

        // Mengembalikan view 'resources/views/products/index.blade.php'.
        // Mengirimkan variabel $products dan $categories ke view tersebut.
        return view('products.index', compact('products', 'categories'));
    }

    /**
     * Menampilkan halaman detail satu produk.
     */
    public function show(Product $product): View // Route Model Binding.
    {
        // Penjelasan Route Model Binding:
        // Karena kita memberi type-hint 'Product $product' di parameter,
        // Laravel otomatis mencari produk di database berdasarkan ID yang ada di URL.
        // Jika URLnya: /products/1, Laravel otomatis menjalankan: Product::findOrFail(1).

        // Mengembalikan view detail 'resources/views/products/show.blade.php'.
        return view('products.show', compact('product'));
    }
}
