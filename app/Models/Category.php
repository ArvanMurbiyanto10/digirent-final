<?php // Tag pembuka untuk memulai kode PHP.

namespace App\Models; // Menentukan namespace lokasi file ini berada, yaitu App\Models.

use Illuminate\Database\Eloquent\Factories\HasFactory; // Mengimpor trait HasFactory untuk mendukung pembuatan data dummy (factory).
use Illuminate\Database\Eloquent\Model; // Mengimpor kelas dasar Model dari Eloquent Laravel.

class Category extends Model // Mendefinisikan kelas 'Category' yang mewarisi semua fungsionalitas dari kelas 'Model'.
{ // Tanda kurung kurawal pembuka untuk memulai blok kode kelas Category.
    /** @use HasFactory<\Database\Factories\CategoryFactory> */ // Komentar PHPDoc yang menjelaskan tipe Factory yang digunakan oleh model ini.
    use HasFactory; // Menggunakan trait HasFactory di dalam kelas ini untuk mengaktifkan fitur factory.
} // Tanda kurung kurawal penutup untuk mengakhiri blok kode kelas Category.
