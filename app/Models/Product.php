<?php // Tag pembuka untuk memulai eksekusi kode PHP.

namespace App\Models; // Menentukan namespace file ini agar berada dalam folder logika App\Models.

use Illuminate\Database\Eloquent\Factories\HasFactory; // Mengimpor trait HasFactory untuk keperluan testing dan data dummy.
use Illuminate\Database\Eloquent\Model; // Mengimpor kelas dasar Model dari Eloquent Laravel.
use Illuminate\Database\Eloquent\Relations\BelongsTo; // Mengimpor kelas BelongsTo untuk mendefinisikan relasi "dimiliki oleh".

class Product extends Model // Mendefinisikan kelas 'Product' sebagai representasi tabel 'products' di database.
{ // Kurung kurawal pembuka untuk memulai blok kode kelas Product.
    /** @use HasFactory<\Database\Factories\ProductFactory> */ // Komentar dokumentasi untuk memberi tahu IDE tentang Factory yang digunakan.
    use HasFactory; // Mengaktifkan fitur factory pada model ini.

    protected $fillable = [ // Properti '$fillable' mendaftar kolom apa saja yang aman untuk diisi secara massal (mass assignment).
        'title', // Mengizinkan kolom 'title' (nama produk) untuk diisi.
        'slug', // Mengizinkan kolom 'slug' (versi URL-friendly dari judul) untuk diisi.
        'description', // Mengizinkan kolom 'description' (deskripsi detail produk) untuk diisi.
        'price_per_day', // Mengizinkan kolom 'price_per_day' (harga sewa harian) untuk diisi.
        'category_id', // Mengizinkan kolom 'category_id' (ID kategori terkait) untuk diisi.
        'image', // Mengizinkan kolom 'image' (nama file gambar) untuk diisi.
        'brand', // Mengizinkan kolom 'brand' (merek produk) untuk diisi.
        'model', // Mengizinkan kolom 'model' (tipe model produk) untuk diisi.
        'year', // Mengizinkan kolom 'year' (tahun pembuatan) untuk diisi.
        'condition', // Mengizinkan kolom 'condition' (kondisi fisik barang) untuk diisi.
        'grade', // Mengizinkan kolom 'grade' (tingkat kualitas/grade barang) untuk diisi.
    ]; // Penutup array untuk properti $fillable.

    /**
     * @var array<string, string>
     */ // Komentar PHPDoc untuk menjelaskan tipe data properti di bawah ini.
    protected $casts = [ // Properti '$casts' untuk mengubah tipe data kolom secara otomatis saat diambil dari database.
        'specifications' => 'array', // Mengubah kolom 'specifications' (biasanya JSON di DB) menjadi array PHP secara otomatis.
    ]; // Penutup array untuk properti $casts.

    /**
     * @return BelongsTo<Category, $this>
     */ // Komentar PHPDoc yang menjelaskan bahwa fungsi ini mengembalikan objek relasi BelongsTo ke model Category.
    public function category(): BelongsTo // Mendefinisikan metode 'category' untuk relasi database.
    { // Pembuka blok fungsi category.
        return $this->belongsTo(Category::class); // Mengembalikan definisi relasi bahwa Product ini "dimiliki oleh" satu Category.
    } // Penutup blok fungsi category.
} // Kurung kurawal penutup untuk mengakhiri blok kode kelas Product.
