<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewsItem;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class NewsItemController extends Controller
{
    // Menampilkan daftar berita
    public function index(): View
    {
        $newsItems = NewsItem::latest()->paginate(10);

        return view('admin.news.index', compact('newsItems'));
    }

    // Menampilkan form tambah berita
    public function create(): View
    {
        return view('admin.news.create');
    }

    // Menyimpan berita baru
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'link_url' => 'required|url',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $imagePath = $request->file('image')->store('news_images', 'public');

        NewsItem::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'link_url' => $validated['link_url'],
            'image_path' => $imagePath,
        ]);

        return redirect()
            ->route('admin.news-items.index')
            ->with('success', 'Berita berhasil ditambahkan.');
    }

    // Menampilkan form edit berita
    public function edit(NewsItem $newsItem): View
    {
        return view('admin.news.edit', compact('newsItem'));
    }

    // Memperbarui berita
    public function update(Request $request, NewsItem $newsItem): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'link_url' => 'required|url',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $imagePath = $newsItem->image_path;

        if ($request->hasFile('image')) {
            if ($newsItem->image_path) {
                Storage::disk('public')->delete($newsItem->image_path);
            }

            $imagePath = $request->file('image')->store('news_images', 'public');
        }

        $newsItem->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'link_url' => $validated['link_url'],
            'image_path' => $imagePath,
        ]);

        return redirect()
            ->route('admin.news-items.index')
            ->with('success', 'Berita berhasil diperbarui.');
    }

    // Menghapus berita
    public function destroy(NewsItem $newsItem): RedirectResponse
    {
        if ($newsItem->image_path) {
            Storage::disk('public')->delete($newsItem->image_path);
        }

        $newsItem->delete();

        return redirect()
            ->route('admin.news-items.index')
            ->with('success', 'Berita berhasil dihapus.');
    }
}
