<?php

namespace App\Http\Controllers\Auth; // Menentukan lokasi namespace file ini dalam struktur aplikasi

use App\Http\Controllers\Controller; // Mengimpor base Controller Laravel
use Illuminate\Http\RedirectResponse; // Mengimpor tipe data kembalian untuk redirect
use Illuminate\Http\Request;         // Mengimpor class Request (data input dari user)
use Illuminate\Support\Facades\Auth; // Mengimpor Facade Auth untuk mengakses data user yang login

class EmailVerificationNotificationController extends Controller // Definisi kelas controller
{
    /**
     * Send a new email verification notification.
     * Method ini menangani request POST untuk mengirim ulang email verifikasi.
     */
    public function store(Request $request): RedirectResponse // Method 'store' menerima Request dan mengembalikan RedirectResponse
    {
        // Mengambil data pengguna yang sedang login saat ini menggunakan guard 'web'
        $user = Auth::guard('web')->user();

        // Pengecekan keamanan tambahan (Safety Check)
        // Meskipun route ini biasanya dilindungi middleware 'auth', kita pastikan user tidak null
        if ($user === null) {
            abort(403); // Jika tidak ada user login, batalkan proses dengan error 403 Forbidden
        }

        // Mengecek apakah user ini SEBENARNYA sudah melakukan verifikasi email
        if ($user->hasVerifiedEmail()) {
            // Jika sudah terverifikasi, tidak perlu kirim email lagi.
            // Langsung arahkan ke dashboard (atau halaman yang ingin dituju sebelumnya)
            return redirect()->intended(route('dashboard', absolute: false));
        }

        // Jika belum terverifikasi, kirim notifikasi verifikasi email
        // Method ini bawaan trait 'MustVerifyEmail' pada model User
        $user->sendEmailVerificationNotification();

        // Kembalikan user ke halaman sebelumnya (halaman verify-email)
        // dengan membawa flash message 'status' => 'verification-link-sent'
        // Pesan ini akan memicu alert sukses di file view 'auth/verify-email.blade.php'
        return back()->with('status', 'verification-link-sent');
    }
}
