<x-app-layout>
    <x-slot name="header">
        {{-- PERUBAHAN #1: Teks header diubah jadi 'text-indigo-800' --}}
        <h2 class="font-semibold text-xl font-bold text-indigo-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-indigo-100 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    {{ __("Selamat datang! Kelola semua penyewaan Anda di sini.") }}
                </div>
            </div>

            {{--
              KOTAK 2: "Pesanan Saya" (Selalu Putih + Aksen Indigo)
            --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold mb-6">Pesanan Saya</h3>

                    {{-- Wrapper tabel dengan shadow dan rounded --}}
                    <div class="overflow-x-auto shadow-md rounded-lg">
                        <table class="min-w-full bg-white">
                            {{-- HEADER TABEL: Aksen 'indigo-100' --}}
                            <thead class="bg-indigo-100">
                                <tr>
                                    <th class="py-3 px-4 text-left text-xs font-medium text-indigo-800 uppercase tracking-wider">Produk</th>
                                    <th class="py-3 px-4 text-left text-xs font-medium text-indigo-800 uppercase tracking-wider">Tanggal Sewa</th>
                                    <th class="py-3 px-4 text-left text-xs font-medium text-indigo-800 uppercase tracking-wider">Total Harga</th>
                                    <th class="py-3 px-4 text-center text-xs font-medium text-indigo-800 uppercase tracking-wider">Status</th>
                                    <th class="py-3 px-4 text-center text-xs font-medium text-indigo-800 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse ($bookings as $booking)
                                    <tr class="hover:bg-gray-50">
                                        <td class="py-4 px-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $booking->product->name }}</td>
                                        {{--
                                          CATATAN: Ini bergantung pada perbaikan Model 'Booking'
                                          yang kita lakukan sebelumnya ($casts)
                                        --}}
                                        <td class="py-4 px-4 whitespace-nowrap text-sm text-gray-700">{{ $booking->start_date->format('d M Y') }} - {{ $booking->end_date->format('d M Y') }}</td>
                                        <td class="py-4 px-4 whitespace-nowrap text-sm text-gray-700">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</td>
                                        <td class="py-4 px-4 whitespace-nowrap text-center">
                                            @if($booking->status == 'confirmed')
                                                <span class="bg-green-200 text-green-800 font-semibold py-1 px-3 rounded-full text-xs">
                                                    Dikonfirmasi
                                                </span>
                                            @elseif($booking->status == 'pending')
                                                <span class="bg-yellow-200 text-yellow-800 font-semibold py-1 px-3 rounded-full text-xs">
                                                    Belum Bayar
                                                </span>
                                            @else
                                                <span class="bg-gray-200 text-gray-800 font-semibold py-1 px-3 rounded-full text-xs">
                                                    {{ ucfirst($booking->status) }}
                                                </span>
                                            @endif
                                        </td>
                                        <td class="py-4 px-4 whitespace-nowrap text-center text-sm font-medium">
                                            <a href="{{ route('booking.show', $booking) }}" class="text-indigo-600 hover:text-indigo-900">
                                                Lihat Detail
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-10 text-gray-500">
                                            Anda belum memiliki pesanan.
                                        </td>
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
