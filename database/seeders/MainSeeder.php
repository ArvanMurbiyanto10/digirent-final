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
        Schema::disableForeignKeyConstraints();
        Product::truncate();
        Category::truncate();
        User::truncate();0
        Schema::enableForeignKeyConstraints();

        // 1. Buat User Admin
        User::create([
            'name' => 'Admin DigiRent',
            'email' => 'arvan12aa@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // 2. Buat Kategori
        $handphone = Category::create(['name' => 'Handphone', 'slug' => 'handphone']);
        $laptop = Category::create(['name' => 'Laptop', 'slug' => 'laptop']);

        // === PRODUK HANDPHONE (15 UNIT) ===
        Product::create([
            'category_id' => $handphone->id, 'name' => 'iPhone XR', 'slug' => Str::slug('iPhone XR'),
            'description' => 'Smartphone andal dengan layar Liquid Retina HD dan performa A12 Bionic.',
            'specifications' => ['Layar' => '6.1" Liquid Retina HD', 'Chip' => 'A12 Bionic', 'Kamera' => '12MP Wide', 'Penyimpanan' => '64GB', 'Face ID' => 'Ya'],
            'price_per_day' => 75000, 'stock' => 10, 'image' => 'products/iphone-xr.jpg',
        ]);
        Product::create([
            'category_id' => $handphone->id, 'name' => 'iPhone 11', 'slug' => Str::slug('iPhone 11'),
            'description' => 'Dilengkapi sistem kamera ganda (Ultra Wide) dan Chip A13 Bionic yang powerful.',
            'specifications' => ['Layar' => '6.1" Liquid Retina HD', 'Chip' => 'A13 Bionic', 'Kamera' => 'Dual 12MP (Wide, Ultra Wide)', 'Penyimpanan' => '128GB', 'Video' => '4K 60fps'],
            'price_per_day' => 85000, 'stock' => 8, 'image' => 'products/iphone-11.jpg',
        ]);
        Product::create([
            'category_id' => $handphone->id, 'name' => 'iPhone 13', 'slug' => Str::slug('iPhone 13'),
            'description' => 'Layar Super Retina XDR yang cerah dengan Chip A15 Bionic super cepat dan mode Sinematik.',
            'specifications' => ['Layar' => '6.1" Super Retina XDR', 'Chip' => 'A15 Bionic', 'Kamera' => 'Dual 12MP Pro System', 'Penyimpanan' => '128GB', 'Fitur' => 'Mode Sinematik'],
            'price_per_day' => 100000, 'stock' => 7, 'image' => 'products/iphone-13.jpg',
        ]);
        Product::create([
            'category_id' => $handphone->id, 'name' => 'iPhone 14 Pro', 'slug' => Str::slug('iPhone 14 Pro'),
            'description' => 'Memperkenalkan Dynamic Island, kamera utama 48MP, dan Chip A16 Bionic.',
            'specifications' => ['Layar' => '6.1" Super Retina XDR', 'Fitur Layar' => 'Dynamic Island', 'Chip' => 'A16 Bionic', 'Kamera Utama' => '48MP ProRAW', 'Penyimpanan' => '256GB'],
            'price_per_day' => 135000, 'stock' => 5, 'image' => 'products/iphone-14-pro.jpg',
        ]);
        Product::create([
            'category_id' => $handphone->id, 'name' => 'iPhone 15 Pro Max', 'slug' => Str::slug('iPhone 15 Pro Max'),
            'description' => 'Ditempa dari titanium, dengan Chip A17 Pro pengubah game, dan tombol Tindakan.',
            'specifications' => ['Layar' => '6.7" Super Retina XDR', 'Chip' => 'A17 Pro', 'Material' => 'Titanium', 'Kamera Utama' => '48MP', 'Zoom Optik' => '5x Telefoto', 'Penyimpanan' => '256GB'],
            'price_per_day' => 180000, 'stock' => 4, 'image' => 'products/iphone-15-pro-max.jpg',
        ]);
        Product::create([
            'category_id' => $handphone->id, 'name' => 'Samsung Galaxy S23 Ultra', 'slug' => Str::slug('Samsung Galaxy S23 Ultra'),
            'description' => 'Kamera 200MP revolusioner, S Pen terintegrasi, dan performa gaming terbaik.',
            'specifications' => ['Layar' => '6.8" Dynamic AMOLED 2X', 'Chip' => 'Snapdragon 8 Gen 2 for Galaxy', 'Kamera Utama' => '200MP', 'Stylus' => 'S Pen Built-in', 'Penyimpanan' => '256GB'],
            'price_per_day' => 165000, 'stock' => 5, 'image' => 'products/samsung-s23-ultra.jpeg',
        ]);
        Product::create([
            'category_id' => $handphone->id, 'name' => 'Samsung Galaxy S24 Ultra', 'slug' => Str::slug('Samsung Galaxy S24 Ultra'),
            'description' => 'Era baru AI seluler dengan Galaxy AI, S Pen, dan frame titanium yang kokoh.',
            'specifications' => ['Layar' => '6.8" Dynamic AMOLED 2X', 'Chip' => 'Snapdragon 8 Gen 3 for Galaxy', 'Fitur AI' => 'Galaxy AI', 'Material' => 'Titanium', 'Kamera Utama' => '200MP', 'Penyimpanan' => '256GB'],
            'price_per_day' => 190000, 'stock' => 4, 'image' => 'products/samsung-s24-ultra.jpeg',
        ]);
        Product::create([
            'category_id' => $handphone->id, 'name' => 'Samsung Galaxy S25 Ultra', 'slug' => Str::slug('Samsung Galaxy S25 Ultra'),
            'description' => 'Kekuatan masa depan dengan chip terbaru dan peningkatan kamera signifikan.',
            'specifications' => ['Layar' => '6.9" Dynamic AMOLED 2X', 'Chip' => 'Snapdragon 8 Gen 4', 'Kamera Utama' => '200MP ISOCELL Sensor', 'Penyimpanan' => '512GB', 'Baterai' => '5.500 mAh'],
            'price_per_day' => 220000, 'stock' => 3, 'image' => 'products/samsung-s25-ultra.jpeg',
        ]);
        Product::create([
            'category_id' => $handphone->id, 'name' => 'Samsung Galaxy Z Flip 6', 'slug' => Str::slug('Samsung Galaxy Z Flip 6'),
            'description' => 'Ponsel lipat ringkas dengan layar cover lebih besar dan performa andal.',
            'specifications' => ['Layar Utama' => '6.7" Foldable Dynamic AMOLED', 'Layar Cover' => '3.4" Super AMOLED', 'Chip' => 'Snapdragon 8 Gen 3', 'Penyimpanan' => '256GB', 'Ketahanan' => 'IPX8 Water Resistant'],
            'price_per_day' => 170000, 'stock' => 5, 'image' => 'products/Samsung-Galaxy-z-flip-6.jpg',
        ]);
        Product::create([
            'category_id' => $handphone->id, 'name' => 'Samsung Galaxy Z Flip 7', 'slug' => Str::slug('Samsung Galaxy Z Flip 7'),
            'description' => 'Desain lebih tipis, engsel tanpa celah, dan ditenagai chipset tercanggih.',
            'specifications' => ['Layar Utama' => '6.7" Foldable Dynamic AMOLED', 'Chip' => 'Snapdragon 8 Gen 4', 'Penyimpanan' => '512GB', 'Engsel' => 'Ironflex Hinge', 'Kamera' => '50MP Wide'],
            'price_per_day' => 200000, 'stock' => 3, 'image' => 'products/Samsung-Galaxy-z-flip-7.jpg',
        ]);
        Product::create([
            'category_id' => $handphone->id, 'name' => 'Google Pixel 8 Pro', 'slug' => Str::slug('Google Pixel 8 Pro'),
            'description' => 'Kamera pintar dengan fitur AI canggih dari Google Tensor G3.',
            'specifications' => ['Layar' => '6.7" Super Actua display', 'Chip' => 'Google Tensor G3', 'Fitur Kamera' => 'Best Take, Magic Editor', 'Penyimpanan' => '256GB', 'Keamanan' => 'Titan M2 Chip'],
            'price_per_day' => 150000, 'stock' => 4, 'image' => 'products/google-pixel-8pro.jpeg',
        ]);
        Product::create([
            'category_id' => $handphone->id, 'name' => 'Xiaomi 14T Pro', 'slug' => Str::slug('Xiaomi 14T Pro'),
            'description' => 'Performa flagship dengan kamera hasil kolaborasi bersama Leica.',
            'specifications' => ['Layar' => '6.7" CrystalRes AMOLED', 'Chip' => 'Snapdragon 8 Gen 4', 'Kamera' => 'Leica optical lens', 'Penyimpanan' => '512GB', 'Charging' => '120W HyperCharge'],
            'price_per_day' => 140000, 'stock' => 6, 'image' => 'products/xiaomi-14t-pro.jpeg',
        ]);
        Product::create([
            'category_id' => $handphone->id, 'name' => 'Vivo X100 Pro', 'slug' => Str::slug('Vivo X100 Pro'),
            'description' => 'Kemampuan fotografi profesional dengan lensa ZEISS APO Super-Telephoto.',
            'specifications' => ['Layar' => '6.78" LTPO AMOLED', 'Chip' => 'Dimensity 9300', 'Kamera' => 'ZEISS APO Super-Telephoto', 'Penyimpanan' => '512GB', 'Sensor' => '1-inch Sony IMX989'],
            'price_per_day' => 135000, 'stock' => 5, 'image' => 'products/vivo-x100-pro.jpg',
        ]);
        Product::create([
            'category_id' => $handphone->id, 'name' => 'Asus ROG Phone 9 Pro', 'slug' => Str::slug('Asus ROG Phone 9 Pro'),
            'description' => 'Smartphone gaming terbaik dengan sistem pendingin dan performa ekstrem.',
            'specifications' => ['Layar' => '6.78" AMOLED 165Hz', 'Chip' => 'Snapdragon 8 Gen 4', 'Fitur Gaming' => 'AirTrigger buttons', 'Penyimpanan' => '512GB', 'Baterai' => '6.000 mAh'],
            'price_per_day' => 180000, 'stock' => 3, 'image' => 'products/asus-rog-phone-9-pro.jpeg',
        ]);
        Product::create([
            'category_id' => $handphone->id, 'name' => 'Oppo Find X8', 'slug' => Str::slug('Oppo Find X8'),
            'description' => 'Desain premium dengan kemampuan kamera flagship dari Hasselblad.',
            'specifications' => ['Layar' => '6.7" AMOLED QHD+', 'Chip' => 'Snapdragon 8 Gen 4', 'Kamera' => 'Hasselblad Camera for Mobile', 'Penyimpanan' => '256GB', 'Desain' => 'Ceramic Body'],
            'price_per_day' => 145000, 'stock' => 4, 'image' => 'products/Oppo-Find-X8.jpg',
        ]);

        // === PRODUK LAPTOP (5 UNIT) ===
        Product::create([
            'category_id' => $laptop->id, 'name' => 'MacBook Pro 2017', 'slug' => Str::slug('MacBook Pro 2017'),
            'description' => 'Laptop andal untuk produktivitas sehari-hari dengan layar Retina yang tajam.',
            'specifications' => ['Layar' => '13.3" Retina Display', 'Prosesor' => 'Intel Core i5', 'Memori' => '8GB RAM', 'Penyimpanan' => '256GB SSD', 'Port' => '2x Thunderbolt 3'],
            'price_per_day' => 150000, 'stock' => 7, 'image' => 'products/macbook-pro2017.jpeg',
        ]);
        Product::create([
            'category_id' => $laptop->id, 'name' => 'MacBook Air M1', 'slug' => Str::slug('MacBook Air M1'),
            'description' => 'Tipis, ringan, dan super cepat berkat kekuatan chip Apple M1.',
            'specifications' => ['Layar' => '13.3" Retina Display', 'Chip' => 'Apple M1 (8-core CPU, 7-core GPU)', 'Memori' => '8GB unified memory', 'Penyimpanan' => '256GB SSD', 'Baterai' => 'Hingga 18 jam'],
            'price_per_day' => 220000, 'stock' => 6, 'image' => 'products/macbook-air-m1.jpeg',
        ]);
        Product::create([
            'category_id' => $laptop->id, 'name' => 'MacBook Pro M2', 'slug' => Str::slug('MacBook Pro M2'),
            'description' => 'Performa level pro untuk para profesional kreatif dengan chip Apple M2.',
            'specifications' => ['Layar' => '13.3" Liquid Retina', 'Chip' => 'Apple M2 (8-core CPU, 10-core GPU)', 'Memori' => '8GB unified memory', 'Penyimpanan' => '256GB SSD', 'Fitur' => 'Touch Bar & Touch ID'],
            'price_per_day' => 260000, 'stock' => 4, 'image' => 'products/macbook-pro-m2.jpeg',
        ]);
        Product::create([
            'category_id' => $laptop->id, 'name' => 'Acer Nitro V15', 'slug' => Str::slug('Acer Nitro V15'),
            'description' => 'Laptop gaming dengan refresh rate tinggi dan kartu grafis NVIDIA RTX.',
            'specifications' => ['Layar' => '15.6" FHD 144Hz IPS', 'Prosesor' => 'Intel Core i5', 'Grafis' => 'NVIDIA GeForce RTX 4050', 'Memori' => '16GB DDR5 RAM', 'Penyimpanan' => '512GB NVMe SSD'],
            'price_per_day' => 180000, 'stock' => 8, 'image' => 'products/Acer-Nitro-V15.jpeg',
        ]);
        Product::create([
            'category_id' => $laptop->id, 'name' => 'Asus ROG Zephyrus G14', 'slug' => Str::slug('Asus ROG Zephyrus G14'),
            'description' => 'Kombinasi sempurna antara portabilitas dan performa gaming kelas atas.',
            'specifications' => ['Layar' => '14" QHD 120Hz', 'Prosesor' => 'AMD Ryzen 9', 'Grafis' => 'NVIDIA GeForce RTX 3060', 'Fitur' => 'AniMe Matrix Display', 'Memori' => '16GB DDR4 RAM'],
            'price_per_day' => 300000, 'stock' => 3, 'image' => 'products/asus-rog-zephyrus.jpeg',
        ]);
    }
}
