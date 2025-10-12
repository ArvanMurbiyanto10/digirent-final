<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User; // <-- Pastikan baris ini ada
use App\Models\Product; // <-- Pastikan baris ini ada

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
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Mendapatkan data user (penyewa) yang membuat booking.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
