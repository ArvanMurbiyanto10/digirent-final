<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Konfirmasi & Pembayaran
        </h2>
    </x-slot>

    {{-- Script for Midtrans Snap --}}
    @push('scripts')
    <script type="text/javascript"
      src="https://app.sandbox.midtrans.com/snap/snap.js"
      data-client-key="{{ config('midtrans.client_key') }}"></script>
    @endpush

    <div class="py-12 bg-gray-50">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 md:p-8 text-gray-900">

                    <h1 class="text-3xl font-bold text-center mb-2">Satu Langkah Lagi!</h1>
                    <p class="text-center text-gray-500 mb-8">Pesanan Anda berhasil dibuat. Silakan selesaikan pembayaran untuk mengonfirmasi pesanan Anda.</p>

                    {{-- Order Receipt Details --}}
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 space-y-4 mb-8">
                        <div class="flex justify-between">
                            <span class="font-semibold text-gray-500">No. Pesanan</span>
                            <span class="font-bold text-gray-800">#{{ $booking->id }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="font-semibold text-gray-500">Nama Penyewa</span>
                            <span class="font-bold text-gray-800">{{ $booking->user->name }}</span>
                        </div>
                        <hr>
                        <div class="flex justify-between">
                            <span class="font-semibold text-gray-500">Produk</span>
                            <span class="font-bold text-gray-800">{{ $booking->product->name }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="font-semibold text-gray-500">Tanggal Mulai</span>
                            <span class="font-medium text-gray-800">{{ $booking->start_date->format('d M Y, H:i') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="font-semibold text-gray-500">Tanggal Selesai</span>
                            <span class="font-medium text-gray-800">{{ $booking->end_date->format('d M Y, H:i') }}</span>
                        </div>
                        <hr>
                        <div class="flex justify-between text-xl">
                            <span class="font-bold text-gray-800">Total Pembayaran</span> 
                            <span class="font-bold text-purple-600">Rp {{ number_format($booking->total_price) }}</span>
                        </div>
                    </div>

                    {{-- Payment Button --}}
                    <div class="text-center">
                        <button id="pay-button" class="w-full md:w-auto inline-block bg-purple-600 text-white text-lg font-semibold py-3 px-12 rounded-lg shadow-md hover:bg-purple-700 transition-colors duration-300">
                            Bayar Sekarang
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- JavaScript to call Midtrans popup --}}
    @push('scripts')
    <script type="text/javascript">
      var payButton = document.getElementById('pay-button');
      payButton.addEventListener('click', function () {
        window.snap.pay('{{ $snapToken }}', {
          onSuccess: function(result){
            // INI ADALAH BAGIAN YANG MEMPERBAIKINYA
            window.location.href = '{{ route("booking.success", $booking) }}';
          },
          onPending: function(result){
            alert("Menunggu pembayaran!");
          },
          onError: function(result){
            alert("Pembayaran gagal!");
          },
          onClose: function(){
            alert('Anda menutup jendela pembayaran.');
          }
        });
      });
    </script>
    @endpush
</x-app-layout>
