<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * BARU: Tambahkan properti ini.
     * Atribut yang diizinkan untuk diisi secara massal.
     */
    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'image',
        'price_per_day',
        'stock',
    ];

    /**
     * Mendefinisikan relasi bahwa produk ini milik satu kategori.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
