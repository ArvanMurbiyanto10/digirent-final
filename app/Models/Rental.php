<?php // Tag pembuka untuk memulai eksekusi skrip PHP.

namespace App\Models; // Menentukan namespace agar kelas ini dikenali berada dalam folder App\Models.

use Illuminate\Database\Eloquent\Factories\HasFactory; // Mengimpor trait HasFactory untuk mendukung pembuatan data dummy (testing).
use Illuminate\Database\Eloquent\Model; // Mengimpor kelas dasar Model dari framework Laravel Eloquent.

class Rental extends Model // Mendefinisikan kelas 'Rental' yang mewarisi semua fitur dari kelas 'Model'.
{ // Kurung kurawal pembuka untuk memulai blok kode kelas Rental.
    /** @use HasFactory<\Database\Factories\RentalFactory> */ // Komentar dokumentasi yang menjelaskan factory apa yang digunakan model ini.
    use HasFactory; // Mengaktifkan trait HasFactory untuk mempermudah pembuatan instance model ini saat testing.
} // Kurung kurawal penutup untuk mengakhiri blok kode kelas Rental.
