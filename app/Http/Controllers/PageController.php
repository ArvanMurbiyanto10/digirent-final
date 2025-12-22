<?php

namespace App\Http\Controllers; // Menentukan lokasi namespace file ini agar bisa dipanggil oleh Route

use Illuminate\View\View; // <-- Tambahkan import ini // Mengimpor kelas View untuk menetapkan tipe data kembalian (Return Type)

class PageController extends Controller // Definisi kelas Controller untuk halaman-halaman statis
{
    // Method untuk menampilkan halaman Syarat & Ketentuan
    public function terms(): View // <-- Tambahkan tipe return : View // Mendefinisikan method 'terms' yang WAJIB mengembalikan sebuah View
    {
        return view('pages.terms'); // Mengembalikan file view yang ada di: resources/views/pages/terms.blade.php
    }

    // Fungsi untuk menampilkan halaman Kebijakan Privasi
    public function privacy(): View // <-- Tambahkan tipe return : View // Mendefinisikan method 'privacy'
    {
        return view('pages.privacy'); // Mengembalikan file view yang ada di: resources/views/pages/privacy.blade.php
    }
}
