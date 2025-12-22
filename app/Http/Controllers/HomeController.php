<?php

namespace App\Http\Controllers; // Menentukan namespace agar kelas ini dikenali oleh autoloader Laravel

use Illuminate\Http\Request; // Mengimpor class Request (standar, meski belum dipakai di method ini)
use App\Models\Product;      // Mengimpor Model Product untuk mengambil data produk dari database
use App\Models\NewsItem;     // Mengimpor Model NewsItem untuk mengambil data berita
use Illuminate\View\View;    // Mengimpor tipe data kembalian (Return Type) untuk view

class HomeController extends Controller // Definisi kelas HomeController yang mewarisi fitur dasar Controller
{
    public function index(): View // Method 'index' yang akan dipanggil saat user membuka halaman utama
    {
        // Mengambil data produk: Urutkan dari yang terbaru (latest), ambil 10 saja (take), lalu eksekusi (get)
        $products = Product::latest()->take(10)->get();

        // {{-- PERBAIKAN: Ubah nama variabel dari $news menjadi $newsItems --}}
        // {{-- agar cocok dengan yang diminta oleh file welcome.blade.php --}}
        // Mengambil data berita: Urutkan terbaru, ambil 4 item, lalu eksekusi query
        $newsItems = NewsItem::latest()->take(4)->get();

        // {{-- Jangan lupa ubah di dalam compact() juga --}}
        // Mengembalikan file view 'resources/views/welcome.blade.php'
        // Fungsi compact() mengubah variabel $products dan $newsItems menjadi array untuk dikirim ke view
        return view('welcome', compact('products', 'newsItems'));
    }
}
