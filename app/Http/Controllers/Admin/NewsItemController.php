<?php

namespace App\Http\Controllers\Admin; // Menentukan namespace agar kelas ini dapat diload oleh Laravel

use App\Http\Controllers\Controller; // Mengimpor Controller dasar Laravel
use App\Models\NewsItem;             // Mengimpor Model NewsItem untuk interaksi database
use Illuminate\Http\Request;         // Mengimpor class Request untuk menangani input form
use Illuminate\Http\RedirectResponse; // Mengimpor tipe data kembalian untuk redirect
use Illuminate\View\View;            // Mengimpor tipe data kembalian untuk view
use Illuminate\Support\Facades\Storage; // Mengimpor Facade Storage untuk manajemen file

class NewsItemController extends Controller // Definisi kelas Controller
{
    // Menampilkan daftar berita
    public function index(): View // Method index untuk halaman utama admin berita
    {
        $newsItems = NewsItem::latest() // Query: Ambil data diurutkan dari yang terbaru
            ->paginate(10);             // Batasi 10 data per halaman (pagination)

        return view('admin.news.index', compact('newsItems')); // Tampilkan view dan kirim data $newsItems
    }

    // Menampilkan form tambah berita
    public function create(): View // Method create untuk menampilkan form
    {
        return view('admin.news.create'); // Mengembalikan view form tambah berita
    }

    // Menyimpan berita baru
    public function store(Request $request): RedirectResponse // Method store untuk memproses data form
    {
        $validated = $request->validate([ // Validasi input dari user
            'title' => 'required|string|max:255', // Judul wajib, string, maks 255 karakter
            'description' => 'required|string',   // Deskripsi wajib diisi
            'link_url' => 'required|url',         // Link harus format URL yang valid
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048', // Gambar wajib, format tertentu, maks 2MB
        ]);

        // Upload gambar ke folder 'public/news_images' dan ambil path-nya
        $imagePath = $request->file('image')->store('news_images', 'public');

        NewsItem::create([ // Simpan data ke database menggunakan Mass Assignment
            'title' => $validated['title'],             // Ambil judul dari data tervalidasi
            'description' => $validated['description'], // Ambil deskripsi
            'link_url' => $validated['link_url'],       // Ambil link URL
            'image_path' => $imagePath,                 // Simpan path gambar yang baru diupload
        ]);

        return redirect() // Kembalikan respon redirect
            ->route('admin.news-items.index') // Arahkan kembali ke daftar berita
            ->with('success', 'Berita berhasil ditambahkan.'); // Kirim pesan flash session sukses
    }

    // Menampilkan form edit berita
    public function edit(NewsItem $newsItem): View // Menggunakan Route Model Binding (otomatis cari ID)
    {
        return view('admin.news.edit', compact('newsItem')); // Tampilkan form edit dengan data berita
    }

    // Memperbarui berita
    public function update(Request $request, NewsItem $newsItem): RedirectResponse // Method update
    {
        $validated = $request->validate([ // Validasi input update
            'title' => 'required|string|max:255', // Aturan judul sama seperti create
            'description' => 'required|string',   // Aturan deskripsi sama
            'link_url' => 'required|url',         // Aturan link sama
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048', // Gambar BOLEH KOSONG (nullable) saat edit
        ]);

        $imagePath = $newsItem->image_path; // Default: Gunakan path gambar lama

        if ($request->hasFile('image')) { // Cek: Apakah user mengupload gambar baru?
            if ($newsItem->image_path) { // Cek: Apakah ada gambar lama di database?
                Storage::disk('public')->delete($newsItem->image_path); // Hapus gambar lama dari penyimpanan fisik
            }

            // Upload gambar baru dan update variabel $imagePath
            $imagePath = $request->file('image')->store('news_images', 'public');
        }

        $newsItem->update([ // Update record di database
            'title' => $validated['title'],             // Update judul
            'description' => $validated['description'], // Update deskripsi
            'link_url' => $validated['link_url'],       // Update link
            'image_path' => $imagePath,                 // Update path gambar (lama atau baru)
        ]);

        return redirect() // Redirect kembali
            ->route('admin.news-items.index') // Ke halaman index
            ->with('success', 'Berita berhasil diperbarui.'); // Pesan sukses
    }

    // Menghapus berita
    public function destroy(NewsItem $newsItem): RedirectResponse // Method delete
    {
        if ($newsItem->image_path) { // Cek apakah berita ini punya file gambar
            Storage::disk('public')->delete($newsItem->image_path); // Hapus file gambar dari folder penyimpanan
        }

        $newsItem->delete(); // Hapus data dari database

        return redirect() // Redirect kembali
            ->route('admin.news-items.index') // Ke halaman index
            ->with('success', 'Berita berhasil dihapus.'); // Pesan sukses
    }
}
