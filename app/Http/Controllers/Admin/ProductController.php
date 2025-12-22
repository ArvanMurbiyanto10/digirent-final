<?php

namespace App\Http\Controllers\Admin; // Menentukan namespace agar kelas ini bisa dipanggil oleh Laravel

use App\Http\Controllers\Controller; // Mengimpor Controller induk
use App\Models\Category;             // Mengimpor Model Category untuk dropdown pilihan
use App\Models\Product;              // Mengimpor Model Product untuk manipulasi data produk
use Illuminate\Http\Request;         // Mengimpor class Request untuk menangani input form
use Illuminate\Support\Facades\Storage; // Mengimpor Facade Storage untuk menghapus/upload file
use Illuminate\Support\Str;          // Mengimpor Helper Str untuk manipulasi string (membuat slug)
use Illuminate\View\View;            // Tipe data kembalian View
use Illuminate\Http\RedirectResponse; // Tipe data kembalian Redirect

class ProductController extends Controller // Definisi kelas Controller
{
    // Menampilkan halaman daftar produk
    public function index(): View
    {
        $products = Product::with('category') // Eager loading: Ambil data kategori sekaligus (mencegah N+1 query problem)
            ->latest()                        // Urutkan berdasarkan yang paling baru dibuat
            ->get();                          // Eksekusi query dan ambil semua data

        return view('admin.products.index', compact('products')); // Tampilkan view index dengan data products
    }

    // Menampilkan halaman form tambah produk
    public function create(): View
    {
        $categories = Category::all(); // Ambil semua kategori untuk ditampilkan di dropdown <select>

        return view('admin.products.create', compact('categories')); // Tampilkan view create
    }

    // Menyimpan produk baru ke database
    public function store(Request $request): RedirectResponse
    {
        // Validasi input form
        $validated = $request->validate([
            'name' => 'required|string|max:255', // Nama wajib, string, maks 255
            'category_id' => 'required|exists:categories,id', // Kategori harus ada di tabel categories
            'price_per_day' => 'required|numeric|min:0', // Harga harus angka dan tidak boleh minus
            'stock' => 'required|integer|min:0', // Stok harus bilangan bulat
            'description' => 'required|string', // Deskripsi wajib
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048', // Gambar wajib, format tertentu, maks 2MB
        ]);

        // Upload gambar ke folder 'storage/app/public/products'
        $imagePath = $request->file('image')->store('products', 'public');

        // Simpan data ke database
        Product::create([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']), // ✅ FIX: Generate slug otomatis dari nama (misal: "iPhone 15" -> "iphone-15")
            'category_id' => $validated['category_id'],
            'price_per_day' => $validated['price_per_day'],
            'stock' => $validated['stock'],
            'description' => $validated['description'],
            'image' => $imagePath, // Simpan path gambar hasil upload
        ]);

        return redirect() // Redirect kembali
            ->route('admin.products.index') // Ke halaman index produk
            ->with('success', 'Produk baru berhasil ditambahkan.'); // Pesan sukses
    }

    // Menampilkan halaman edit produk
    public function edit(Product $product): View // Route Model Binding: Otomatis cari produk berdasarkan ID di URL
    {
        $categories = Category::all(); // Ambil semua kategori untuk dropdown

        return view('admin.products.edit', compact('product', 'categories')); // Kirim data produk dan kategori ke view
    }

    // Memperbarui data produk (Update)
    public function update(Request $request, Product $product): RedirectResponse
    {
        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price_per_day' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', // Gambar bersifat OPTIONAL (nullable) saat edit
        ]);

        $data = $validated; // Salin data validasi ke array baru
        $data['slug'] = Str::slug($validated['name']); // ✅ FIX: Update slug jika nama berubah

        // Hapus 'image' dari array $data sementara, karena kita butuh logika khusus
        unset($data['image']);

        // Cek jika user mengupload gambar baru
        if ($request->hasFile('image')) {
            // Jika ada gambar lama, hapus dulu dari penyimpanan
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }

            // Upload gambar baru dan masukkan path-nya ke array $data
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        // Update record di database dengan array $data yang sudah diproses
        $product->update($data);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    // Menghapus produk (Delete)
    public function destroy(Product $product): RedirectResponse
    {
        // Cek apakah produk punya gambar, jika ya, hapus fisiknya
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        // Hapus data dari database
        $product->delete();

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produk berhasil dihapus.');
    }
}
