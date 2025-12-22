<?php // Tag pembuka untuk memulai kode PHP.

namespace App\Models; // Menentukan lokasi namespace file ini, yaitu di dalam folder App\Models.

use Illuminate\Database\Eloquent\Factories\HasFactory; // Mengimpor trait HasFactory untuk keperluan testing atau membuat data palsu (seeder).
use Illuminate\Database\Eloquent\Model; // Mengimpor kelas dasar Model milik Eloquent Laravel.
use Illuminate\Database\Eloquent\Relations\BelongsTo; // Mengimpor kelas BelongsTo untuk mendefinisikan relasi antar tabel database.

class Booking extends Model // Mendefinisikan kelas 'Booking' yang mewarisi semua fitur dari kelas 'Model'. Ini mewakili tabel 'bookings'.
{ // Pembuka blok kode untuk kelas Booking.

    protected $fillable = [ // Properti '$fillable' menentukan kolom mana saja yang diizinkan untuk diisi secara massal (mass assignment).
        'user_id', // Mengizinkan kolom 'user_id' untuk diisi (biasanya ID dari pengguna yang memesan).
        'product_id', // Mengizinkan kolom 'product_id' untuk diisi (ID dari produk yang dipesan).
        'start_date', // Mengizinkan kolom 'start_date' untuk diisi (tanggal mulai sewa).
        'end_date', // Mengizinkan kolom 'end_date' untuk diisi (tanggal selesai sewa).
        'total_price', // Mengizinkan kolom 'total_price' untuk diisi (total harga pemesanan).
        'status', // Mengizinkan kolom 'status' untuk diisi (misalnya: pending, paid, cancelled).
        'snap_token', // Mengizinkan kolom 'snap_token' untuk diisi (token pembayaran dari gateway Midtrans).
    ]; // Penutup array untuk properti $fillable.

    /**
     * @var array<string, string>
     */ // Komentar PHPDoc yang menjelaskan bahwa properti di bawah ini adalah array string.
    protected $casts = [ // Properti '$casts' digunakan untuk mengubah tipe data kolom secara otomatis saat diambil dari database.
        'start_date' => 'datetime', // Mengonversi kolom 'start_date' menjadi objek Carbon (objek tanggal/waktu PHP) secara otomatis.
        'end_date' => 'datetime', // Mengonversi kolom 'end_date' menjadi objek Carbon (objek tanggal/waktu PHP) secara otomatis.
    ]; // Penutup array untuk properti $casts.

    /**
     * @return BelongsTo<Product, $this>
     */ // Komentar PHPDoc menjelaskan bahwa fungsi ini mengembalikan relasi 'BelongsTo' ke model Product.
    public function product(): BelongsTo // Mendefinisikan metode bernama 'product' untuk relasi database.
    { // Pembuka blok fungsi product.
        return $this->belongsTo(Product::class); // Mengembalikan definisi relasi bahwa satu data Booking "dimiliki oleh" satu Product.
    } // Penutup blok fungsi product.

    /**
     * @return BelongsTo<User, $this>
     */ // Komentar PHPDoc menjelaskan bahwa fungsi ini mengembalikan relasi 'BelongsTo' ke model User.
    public function user(): BelongsTo // Mendefinisikan metode bernama 'user' untuk relasi database.
    { // Pembuka blok fungsi user.
        return $this->belongsTo(User::class); // Mengembalikan definisi relasi bahwa satu data Booking "dimiliki oleh" satu User (pemesan).
    } // Penutup blok fungsi user.
} // Penutup blok kode kelas Booking.
