<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold text-gray-800">
            {{ __('Riwayat Pesanan Saya') }}
        </h2>
    </x-slot>

    @push('styles')
    <style>
        .booking-card {
            transition: all 0.3s ease;
            border-left: 5px solid transparent;
        }
        .booking-card.status-pending { border-left-color: #f59e0b; } /* Kuning */
        .booking-card.status-confirmed { border-left-color: #10b981; } /* Hijau */
        .booking-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
    </style>
    @endpush

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="space-y-6">

                {{-- Loop untuk setiap pesanan --}}
                @forelse ($bookings as $booking)
                    <div class="booking-card bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6 flex flex-col md:flex-row items-start md:items-center gap-6 status-{{ $booking->status }}">

                        {{-- BAGIAN FOTO PRODUK --}}
                        @if($booking->product->image)
                            <img src="{{ asset('storage/' . $booking->product->image) }}" alt="{{ $booking->product->name }}" class="w-full md:w-32 h-32 object-cover rounded-md flex-shrink-0">
                        @else
                            <div class="w-full md:w-32 h-32 bg-gray-200 dark:bg-gray-700 rounded-md flex-shrink-0 flex items-center justify-center text-gray-500">?</div>
                        @endif

                        {{-- Detail Pesanan --}}
                        <div class="flex-grow">
                            <div class="flex justify-between items-start">
                                <div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Pesanan #{{ $booking->id }}</p>
                                    <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100">{{ $booking->product->name }}</h3>
                                </div>
                                @if ($booking->status == 'pending')
                                    <span class="bg-yellow-200 text-yellow-800 font-semibold py-1 px-3 rounded-full text-xs whitespace-nowrap">Belum Bayar</span>
                                @elseif ($booking->status == 'confirmed')
                                    <span class="bg-green-200 text-green-800 font-semibold py-1 px-3 rounded-full text-xs whitespace-nowrap">Sudah Dibayar</span>
                                @else
                                    <span class="bg-gray-200 text-gray-800 font-semibold py-1 px-3 rounded-full text-xs whitespace-nowrap">{{ ucfirst($booking->status) }}</span>
                                @endif
                            </div>
                            <div class="mt-4 grid grid-cols-1 sm:grid-cols-3 gap-4 text-sm text-gray-600 dark:text-gray-300 border-t dark:border-gray-700 pt-4">
                                <div>
                                    <p class="font-semibold">Mulai Sewa:</p>
                                    <p>{{ $booking->start_date->format('d M Y, H:i') }}</p>
                                </div>
                                <div>
                                    <p class="font-semibold">Selesai Sewa:</p>
                                    <p>{{ $booking->end_date->format('d M Y, H:i') }}</p>
                                </div>
                                <div>
                                    <p class="font-semibold">Total Bayar:</p>
                                    <p>Rp {{ number_format($booking->total_price) }}</p>
                                </div>
                            </div>
                        </div>

                        {{-- Tombol Aksi --}}
                        <div class="w-full md:w-auto text-center md:text-right flex-shrink-0 mt-4 md:mt-0">
                            <a href="{{ route('booking.show', $booking) }}" class="inline-block bg-indigo-600 text-white font-semibold py-2 px-5 rounded-lg hover:bg-indigo-700 transition-colors">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-10 text-center text-gray-500 dark:text-gray-400">
                            <p>Anda belum memiliki riwayat pesanan.</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
