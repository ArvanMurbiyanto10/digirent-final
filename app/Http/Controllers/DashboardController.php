<?php

namespace App\Http\Controllers; // Menentukan namespace lokasi file ini dalam struktur folder aplikasi

use Illuminate\Support\Facades\Auth; // Mengimpor Facade Auth untuk mengambil data user yang sedang login
use Illuminate\View\View; // <-- Tambahkan import ini // Mengimpor kelas View untuk menetapkan tipe data kembalian (Return Type)

class DashboardController extends Controller // Definisi kelas controller yang mewarisi sifat Controller induk
{
    // Method index untuk menampilkan halaman utama dashboard
    public function index(): View // <-- Tambahkan tipe return : View // Menetapkan bahwa fungsi ini WAJIB mengembalikan sebuah View
    {
        /** @var \App\Models\User $user */ // <-- Tambahkan baris ini agar PHPStan tahu user tidak null // PHPDoc: Memberi petunjuk ke IDE/Static Analyzer bahwa $user adalah objek User, bukan null
        $user = Auth::user(); // Mengambil objek pengguna yang sedang login saat ini

        // Mengambil booking milik user, beserta data produk, diurutkan dari yang terbaru
        // 1. $user->bookings() : Mengambil relasi 'bookings' (HasMany) dari model User
        // 2. ->with('product') : Eager Loading. Mengambil data produk sekalian agar hemat query database (mencegah N+1 problem)
        // 3. ->latest()        : Mengurutkan berdasarkan 'created_at' (paling baru di atas)
        // 4. ->get()           : Mengeksekusi query dan mengambil hasilnya dalam bentuk Collection
        $bookings = $user->bookings()->with('product')->latest()->get();

        // Mengembalikan file view 'resources/views/dashboard.blade.php'
        // compact('bookings') : Mengirim variabel $bookings ke view agar bisa diloop (foreach)
        return view('dashboard', compact('bookings'));
    }
}
