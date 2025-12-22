<?php // Tag pembuka untuk memulai eksekusi skrip PHP.

namespace App\Models; // Mendefinisikan namespace file ini agar berada dalam lingkup App\Models.

use Illuminate\Database\Eloquent\Factories\HasFactory; // Mengimpor trait HasFactory untuk keperluan pembuatan data dummy (testing).
use Illuminate\Database\Eloquent\Model; // Mengimpor kelas utama Model dari framework Laravel Eloquent.

class NewsItem extends Model // Mendefinisikan kelas 'NewsItem' yang mewarisi fungsi-fungsi dari kelas 'Model'.
{ // Kurung kurawal pembuka untuk memulai blok kode kelas NewsItem.
    /** @use HasFactory<\Database\Factories\NewsItemFactory> */ // Komentar dokumentasi yang menjelaskan factory yang digunakan oleh model ini.
    use HasFactory; // Mengaktifkan fitur factory di dalam model ini menggunakan trait HasFactory.

    protected $fillable = [ // Properti array '$fillable' menentukan daftar kolom yang diizinkan untuk diisi secara massal (mass assignment).
        'title', // Mengizinkan kolom 'title' (judul berita) untuk diisi ke database.
        'description', // Mengizinkan kolom 'description' (isi/deskripsi berita) untuk diisi ke database.
        'image_path', // Mengizinkan kolom 'image_path' (lokasi file gambar) untuk diisi ke database.
        'link_url', // Mengizinkan kolom 'link_url' (tautan eksternal berita) untuk diisi ke database.
    ]; // Penutup array untuk properti $fillable.
} // Kurung kurawal penutup untuk mengakhiri blok kode kelas NewsItem.
