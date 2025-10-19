<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-xl font-bold text-gray-800">
            {{ __('Admin Dashboard - Kelola Pesanan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    @if (session('success'))
                        <div class="bg-green-100 dark:bg-green-900/50 border-l-4 border-green-500 text-green-700 dark:text-green-300 p-4 mb-6" role="alert">
                            <p>{{ session('success') }}</p>
                        </div>
                    @endif

                    <h3 class="text-2xl font-bold mb-6">Daftar Semua Pesanan Masuk</h3>

                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white dark:bg-gray-800">
                            <thead class="bg-gray-100 dark:bg-gray-700">
                                <tr>
                                    <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                    <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Penyewa</th>
                                    <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Produk</th>
                                    <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mulai Sewa</th>
                                    <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Selesai Sewa</th>
                                    <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                                    <th class="py-3 px-4 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="py-3 px-4 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse ($bookings as $booking)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50">
                                        <td class="py-4 px-4 whitespace-nowrap">#{{ $booking->id }}</td>
                                        <td class="py-4 px-4 whitespace-nowrap">{{ $booking->user->name }}</td>
                                        <td class="py-4 px-4 whitespace-nowrap">{{ $booking->product->name }}</td>
                                        <td class="py-4 px-4 whitespace-nowrap text-sm text-gray-500">{{ $booking->start_date->format('d M Y, H:i') }}</td>
                                        <td class="py-4 px-4 whitespace-nowrap text-sm text-gray-500">{{ $booking->end_date->format('d M Y, H:i') }}</td>
                                        <td class="py-4 px-4 whitespace-nowrap">Rp {{ number_format($booking->total_price) }}</td>
                                        <td class="py-4 px-4 whitespace-nowrap text-center">
                                            @if ($booking->status == 'pending')
                                                <span class="bg-yellow-200 text-yellow-800 font-semibold py-1 px-3 rounded-full text-xs">
                                                    Belum Bayar
                                                </span>
                                            @elseif ($booking->status == 'confirmed')
                                                <span class="bg-green-200 text-green-800 font-semibold py-1 px-3 rounded-full text-xs">
                                                    Sudah Bayar
                                                </span>
                                            @else
                                                <span class="bg-gray-200 text-gray-800 font-semibold py-1 px-3 rounded-full text-xs">
                                                    {{ ucfirst($booking->status) }}
                                                </span>
                                            @endif
                                        </td>
                                        <td class="py-4 px-4 whitespace-nowrap text-center">
                                            {{-- Tampilkan tombol hanya jika status 'pending' --}}
                                            @if ($booking->status == 'pending')
                                                <form action="{{ route('admin.bookings.confirm', $booking->id) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-1 px-3 rounded-md text-sm">
                                                        Konfirmasi Bayar
                                                    </button>
                                                </form>
                                            @else
                                                -
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center py-10 text-gray-500">Belum ada pesanan yang masuk.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
