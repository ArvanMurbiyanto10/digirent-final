<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Menggunakan guarded agar lebih fleksibel saat menambah kolom baru
    protected $guarded = ['id'];

    /**
     * PERBAIKAN: Beritahu Laravel cara menangani kolom 'specifications'.
     *
     * @var array
     */
    protected $casts = [
        'specifications' => 'array',
    ];

    /**
     * Relasi ke model Category.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
