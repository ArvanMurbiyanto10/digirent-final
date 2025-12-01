<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo; // <--- INI YANG PENTING DITAMBAHKAN

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'start_date',
        'end_date',
        'total_price',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    /**
     * Mendapatkan data produk yang dibooking.
     */
    public function product(): BelongsTo // <--- Tambahkan ": BelongsTo" agar PHPStan senang
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Mendapatkan data user (penyewa) yang membuat booking.
     */
    public function user(): BelongsTo // <--- Tambahkan ": BelongsTo" di sini juga
    {
        return $this->belongsTo(User::class);
    }
}
