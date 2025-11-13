<x-app-layout>
    <x-slot name="header">
        {{--
          PERBAIKAN #1:
          Kembalikan ke format <x-slot> yang benar.
          Teks diubah menjadi 'text-white' agar menyatu dengan header bar indigo.
        --}}
        <h2 class="font-semibold text-xl font-bold text-indigo-800">
            {{ __('Kelola Berita') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{--
              PERBAIKAN #2: Kotak luar diubah menjadi selalu PUTIH
            --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                {{--
                  PERBAIKAN #3: Teks di dalam kotak menjadi selalu HITAM/ABU
                --}}
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-2xl font-bold">Daftar Berita</h3>
                        {{-- Tombol "Tambah" --}}
                        <a href="{{ route('admin.news-items.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-md shadow-md transition duration-300">
                            + Tambah Berita Baru
                        </a>
                    </div>

                    @if (session('success'))
                        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                            <p>{{ session('success') }}</p>
                        </div>
                    @endif

                    {{--
                      PERBAIKAN #4: Wrapper tabel diberi shadow dan rounded
                    --}}
                    <div class="overflow-x-auto shadow-md rounded-lg">
                        <table class="min-w-full bg-white">
                            {{--
                              PERBAIKAN #5: Header tabel diberi aksen INDIGO-100
                            --}}
                            <thead class="bg-indigo-100">
                                <tr>
                                    {{-- Teks header diberi aksen INDIGO-800 --}}
                                    <th class="py-3 px-4 text-left text-xs font-medium text-indigo-800 uppercase tracking-wider">Gambar</th>
                                    <th class="py-3 px-4 text-left text-xs font-medium text-indigo-800 uppercase tracking-wider">Judul</th>
                                    <th class="py-3 px-4 text-left text-xs font-medium text-indigo-800 uppercase tracking-wider">Link</th>
                                    <th class="py-3 px-4 text-center text-xs font-medium text-indigo-800 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            {{--
                              PERBAIKAN #6: Body tabel dibuat selalu cerah
                            --}}
                            <tbody class="divide-y divide-gray-200">
                                @forelse ($newsItems as $item)
                                    <tr class="hover:bg-gray-50">
                                        <td class="py-4 px-4 whitespace-nowrap">
                                            {{-- Pastikan Storage::url() digunakan jika image_path adalah path relatif --}}
                                            <img src="{{ Storage::url($item->image_path) }}" alt="{{ $item->title }}" class="h-12 w-20 object-cover rounded shadow-sm">
                                        </td>
                                        <td class="py-4 px-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $item->title }}</td>
                                        <td class="py-4 px-4 whitespace-nowrap text-sm text-gray-700">
                                            <a href="{{ $item->link_url }}" target="_blank" class="text-indigo-600 hover:text-indigo-900 hover:underline">{{ Str::limit($item->link_url, 35) }}</a>
                                        </td>
                                        <td class="py-4 px-4 whitespace-nowrap text-center text-sm font-medium">
                                            {{--
                                              PERBAIKAN #7: Tombol Edit/Hapus disamakan (menjadi link teks)
                                            --}}
                                            <a href="{{ route('admin.news-items.edit', $item) }}" class="text-indigo-600 hover:text-indigo-900 font-medium">Edit</a>

                                            <span class="text-gray-300 mx-1">|</span>

                                            <form action="{{ route('admin.news-items.destroy', $item) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus berita ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900 font-medium">
                                                    Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">Belum ada berita.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-6">
                        {{ $newsItems->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
