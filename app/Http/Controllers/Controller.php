<?php

namespace App\Http\Controllers; // Menentukan lokasi namespace file ini agar bisa dimuat otomatis (autoload)

// Kelas ini didefinisikan sebagai 'abstract' karena tidak dimaksudkan untuk diinisialisasi langsung (new Controller).
// Kelas ini hanya berfungsi sebagai induk (parent) yang akan di-extend oleh controller lain.
abstract class Controller
{
    // Area ini biasanya digunakan untuk menaruh Traits atau method global.
    // Contoh: use AuthorizesRequests, ValidatesRequests;
}
