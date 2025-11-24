<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // <-- Merapikan use statement untuk PDF

class BookingController extends Controller
{
    public function create(Product $product)
    {
        return view('booking.create', compact('product'));
    }

    public function store(Request $request)
    {
        // 1. Validasi input
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'start_date' => 'required|date_format:Y-m-d H:i|after_or_equal:now',
            'end_date' => 'required|date_format:Y-m-d H:i|after:start_date',
        ]);

        // 2. Simpan booking ke database
        $product = Product::findOrFail($request->product_id);
        $user = Auth::user();
        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date);
        $durationInHours = $startDate->diffInHours($endDate);
        $durationInDays = $durationInHours > 0 ? ceil($durationInHours / 24) : 1;
        $totalPrice = $durationInDays * $product->price_per_day;

        $booking = Booking::create([
            'user_id' => $user->id,
            'product_id' => $product->id,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'total_price' => $totalPrice,
            'status' => 'pending',
            // snap_token masih null di sini, itu normal
        ]);

        $booking->load('user', 'product');

        // 3. Konfigurasi Midtrans
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = config('midtrans.is_production');
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        // 4. Siapkan data transaksi untuk Midtrans
        $params = [
            'transaction_details' => [
                'order_id' => $booking->id.'-'.time(),
                'gross_amount' => $booking->total_price,
            ],
            'customer_details' => [
                'first_name' => $user->name,
                'email' => $user->email,
            ],
        ];

        // 5. Dapatkan Snap Token
        try {
            $snapToken = \Midtrans\Snap::getSnapToken($params);
        } catch (\Exception $e) {
            // Jika gagal, hapus booking yang baru dibuat agar tidak jadi "sampah"
            $booking->delete();

            return redirect()->back()->withErrors(['msg' => 'Gagal terhubung dengan Midtrans: '.$e->getMessage()]);
        }

        // 6. SIMPAN TOKEN KE DATABASE (INI YANG PALING PENTING)
        $booking->snap_token = $snapToken;
        $booking->save();

        // 7. Arahkan ke halaman checkout
        // Halaman 'booking.checkout' ini akan langsung menampilkan pop-up bayar
        // (Asumsi di file checkout.blade.php Anda ada script snap.pay())
        return view('booking.checkout', compact('booking', 'snapToken'));
    }

    public function show(Booking $booking)
    {
        if (auth()->id() !== $booking->user_id) {
            abort(403);
        }
        $booking->load('product', 'user');

        $whatsappNumber = '6285175394607';
        $message = "Halo Admin DigiRent,\n\nSaya ingin menanyakan pesanan berikut:\nNo. Pesanan: *#{$booking->id}*\nProduk: *{$booking->product->name}*";
        $whatsappLink = 'https://wa.me/'.$whatsappNumber.'?text='.urlencode($message);

        return view('booking.show', compact('booking', 'whatsappLink'));
    }

    public function paymentSuccess(Booking $booking)
    {
        if (auth()->id() !== $booking->user_id) {
            abort(403);
        }

        if ($booking->status == 'pending') {
            $booking->status = 'confirmed';
            $booking->save();
        }

        $booking->load('product', 'user');

        $whatsappNumber = '6285175394607';
        $message = "Halo Admin DigiRent,\n\nSaya sudah berhasil melakukan pembayaran untuk pesanan berikut dan ingin melanjutkan proses sewa:\n\n*Detail Pesanan*\nNo. Pesanan: *#{$booking->id}*\nProduk: *{$booking->product->name}*\n\nTerima kasih.";
        $whatsappLink = 'https://wa.me/'.$whatsappNumber.'?text='.urlencode($message);

        return view('booking.success', compact('booking', 'whatsappLink'));
    }

    public function downloadInvoice(Booking $booking)
    {
        if (auth()->id() != $booking->user_id) {
            abort(403, 'Unauthorized action.');
        }

        $booking->load('user', 'product');

        $startDate = $booking->start_date;
        $endDate = $booking->end_date;
        $durationInDays = ceil($startDate->diffInHours($endDate) / 24);

        $data = [
            'booking' => $booking,
            'durationInDays' => $durationInDays,
        ];

        $pdf = Pdf::loadView('booking.invoice_pdf', $data); // Menggunakan Pdf:: facade
        $filename = 'invoice-digirent-'.$booking->id.'.pdf';

        return $pdf->download($filename);
    }
}
