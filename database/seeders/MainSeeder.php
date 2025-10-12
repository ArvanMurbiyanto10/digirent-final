<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class MainSeeder extends Seeder
{
    public function run(): void
    {
        // Kosongkan tabel untuk menghindari data duplikat saat seeder dijalankan ulang
        Schema::disableForeignKeyConstraints();
        Product::truncate();
        Category::truncate();
        User::truncate();
        Schema::enableForeignKeyConstraints();

        // 1. Buat User Admin
        User::create([
            'name' => 'Admin DigiRent',
            'email' => 'admin@digirent.com',
            'password' => 'password',
            'role' => 'admin', // <-- PASTIKAN BARIS INI ADA DAN AKTIF
        ]);

        // 2. Buat Kategori dan simpan dalam variabel
        $handphone = Category::create(['name' => 'Handphone', 'slug' => 'handphone']);
        $laptop = Category::create(['name' => 'Laptop', 'slug' => 'laptop']);

        // === PRODUK HANDPHONE (15 UNIT) - Daftar Baru ===
        Product::create(['category_id' => $handphone->id, 'name' => 'iPhone XR', 'slug' => Str::slug('iPhone XR'), 'description' => 'Layar 6.1" | Chip A12 Bionic | 64GB', 'price_per_day' => 75000, 'stock' => 10, 'image' => 'products/iphone-xr.jpg',]);
        Product::create(['category_id' => $handphone->id, 'name' => 'iPhone 11', 'slug' => Str::slug('iPhone 11'), 'description' => 'Layar 6.1" | Chip A13 Bionic | 128GB', 'price_per_day' => 85000, 'stock' => 8, 'image' => 'products/iphone-11.jpg',]);
        Product::create(['category_id' => $handphone->id, 'name' => 'iPhone 13', 'slug' => Str::slug('iPhone 13'), 'description' => 'Layar 6.1" | Chip A15 Bionic | 128GB', 'price_per_day' => 100000, 'stock' => 7, 'image' => 'products/iphone-13.jpg',]);
        Product::create(['category_id' => $handphone->id, 'name' => 'iPhone 14 Pro', 'slug' => Str::slug('iPhone 14 Pro'), 'description' => 'Layar 6.1" | Chip A16 Bionic | 256GB', 'price_per_day' => 135000, 'stock' => 5, 'image' => 'products/iphone-14-pro.jpg',]);
        Product::create(['category_id' => $handphone->id, 'name' => 'iPhone 15 Pro Max', 'slug' => Str::slug('iPhone 15 Pro Max'), 'description' => 'Layar 6.7" | Chip A17 Pro | 256GB', 'price_per_day' => 180000, 'stock' => 4, 'image' => 'products/iphone-15-pro-max.jpg',]);
        Product::create(['category_id' => $handphone->id, 'name' => 'Samsung Galaxy S23 Ultra', 'slug' => Str::slug('Samsung Galaxy S23 Ultra'), 'description' => 'Layar 6.8" | Snapdragon 8 Gen 2 | 256GB', 'price_per_day' => 165000, 'stock' => 5, 'image' => 'products/samsung-s23-ultra.jpeg',]);
        Product::create(['category_id' => $handphone->id, 'name' => 'Samsung Galaxy S24 Ultra', 'slug' => Str::slug('Samsung Galaxy S24 Ultra'), 'description' => 'Layar 6.8" | Snapdragon 8 Gen 3 | 256GB', 'price_per_day' => 190000, 'stock' => 4, 'image' => 'products/samsung-s24-ultra.jpeg',]);
        Product::create(['category_id' => $handphone->id, 'name' => 'Samsung Galaxy S25 Ultra', 'slug' => Str::slug('Samsung Galaxy S25 Ultra'), 'description' => 'Layar 6.9" | Snapdragon 8 Gen 4 | 512GB', 'price_per_day' => 220000, 'stock' => 3, 'image' => 'products/samsung-s25-ultra.jpeg',]);
        Product::create(['category_id' => $handphone->id, 'name' => 'Samsung Galaxy Z Flip 6', 'slug' => Str::slug('Samsung Galaxy Z Flip 6'), 'description' => 'Layar Lipat 6.7" | Snapdragon 8 Gen 3', 'price_per_day' => 170000, 'stock' => 5, 'image' => 'products/Samsung-Galaxy-z-flip-6.jpg',]);
        Product::create(['category_id' => $handphone->id, 'name' => 'Samsung Galaxy Z Flip 7', 'slug' => Str::slug('Samsung Galaxy Z Flip 7'), 'description' => 'Layar Lipat 6.7" | Snapdragon 8 Gen 4', 'price_per_day' => 200000, 'stock' => 3, 'image' => 'products/Samsung-Galaxy-z-flip-7.jpg',]);
        Product::create(['category_id' => $handphone->id, 'name' => 'Google Pixel 8 Pro', 'slug' => Str::slug('Google Pixel 8 Pro'), 'description' => 'Layar 6.7" | Google Tensor G3 | 256GB', 'price_per_day' => 150000, 'stock' => 4, 'image' => 'products/google-pixel-8pro.jpeg',]);
        Product::create(['category_id' => $handphone->id, 'name' => 'Xiaomi 14T Pro', 'slug' => Str::slug('Xiaomi 14T Pro'), 'description' => 'Layar 6.7" | Snapdragon 15 pro maxragon 8 Gen 4 | 512GB', 'price_per_day' => 140000, 'stock' => 6, 'image' => 'products/xiaomi-14t-pro.jpeg',]);
        Product::create(['category_id' => $handphone->id, 'name' => 'Vivo X100 Pro', 'slug' => Str::slug('Vivo X100 Pro'), 'description' => 'Layar 6.78" | Dimensity 9300 | 512GB', 'price_per_day' => 135000, 'stock' => 5, 'image' => 'products/vivo-x100-pro.jpg',]);
        Product::create(['category_id' => $handphone->id, 'name' => 'Asus ROG Phone 9 Pro', 'slug' => Str::slug('Asus ROG Phone 9 Pro'), 'description' => 'Layar 6.78" | Snapdragon 8 Gen 4 | 512GB', 'price_per_day' => 180000, 'stock' => 3, 'image' => 'products/asus-rog-phone-9-pro.jpeg',]);
        Product::create(['category_id' => $handphone->id, 'name' => 'Oppo Find X8', 'slug' => Str::slug('Oppo Find X8'), 'description' => 'Layar 6.7" | Snapdragon 8 Gen 4 | 256GB', 'price_per_day' => 145000, 'stock' => 4, 'image' => 'products/Oppo-Find-X8.jpg',]);

        // ===================================================================
        // === PRODUK LAPTOP (5 UNIT) - Daftar Baru ===
        // ===================================================================
        Product::create(['category_id' => $laptop->id, 'name' => 'MacBook Pro 2017', 'slug' => Str::slug('MacBook Pro 2017'), 'description' => '13.3" Retina | Core i5 | 8GB RAM | 256GB SSD', 'price_per_day' => 150000, 'stock' => 7, 'image' => 'products/macbook-pro2017.jpeg',]);
        Product::create(['category_id' => $laptop->id, 'name' => 'MacBook Air M1', 'slug' => Str::slug('MacBook Air M1'), 'description' => '13.3" Retina | Chip M1 | 8GB RAM | 256GB SSD', 'price_per_day' => 220000, 'stock' => 6, 'image' => 'products/macbook-air-m1.jpeg',]);
        Product::create(['category_id' => $laptop->id, 'name' => 'MacBook Pro M2', 'slug' => Str::slug('MacBook Pro M2'), 'description' => '13.3" Liquid Retina | Chip M2 | 8GB RAM | 256GB SSD', 'price_per_day' => 260000, 'stock' => 4, 'image' => 'products/macbook-pro-m2.jpeg',]);
        Product::create(['category_id' => $laptop->id, 'name' => 'Acer Nitro V15', 'slug' => Str::slug('Acer Nitro V15'), 'description' => '15.6" FHD 144Hz | Core i5 | RTX 4050 | 16GB RAM', 'price_per_day' => 180000, 'stock' => 8, 'image' => 'products/Acer-Nitro-V15.jpeg',]);
        Product::create(['category_id' => $laptop->id, 'name' => 'Asus ROG Zephyrus G14', 'slug' => Str::slug('Asus ROG Zephyrus G14'), 'description' => '14" QHD 120Hz | Ryzen 9 | RTX 3060', 'price_per_day' => 300000, 'stock' => 3, 'image' => 'products/asus-rog-zephyrus.jpeg',]);
    }
}
