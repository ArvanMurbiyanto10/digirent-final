<?php

namespace App\Http\Controllers\Auth; // Menentukan namespace lokasi file ini

use App\Http\Controllers\Controller; // Mengimpor kelas Controller utama
use Illuminate\Http\RedirectResponse; // Mengimpor tipe data return untuk redirect
use Illuminate\Http\Request;         // Mengimpor class Request
use Illuminate\Support\Facades\Auth; // Mengimpor Facade Auth untuk manajemen user login
use Illuminate\View\View;            // Mengimpor tipe data return untuk view

class EmailVerificationPromptController extends Controller // Definisi kelas controller
{
    /**
     * Display the email verification prompt.
     * Method __invoke dipanggil otomatis ketika route controller ini diakses.
     */
    public function __invoke(Request $request): RedirectResponse|View // Method ini bisa mengembalikan Redirect (jika sudah verify) atau View (jika belum)
    {
        // Mengambil objek user yang sedang login saat ini
        $user = Auth::guard('web')->user();

        // Pengecekan keamanan ekstra (Safety Check)
        // Memastikan variabel $user tidak null (walaupun biasanya sudah dicek di middleware 'auth')
        if ($user === null) {
            abort(403); // Jika tidak ada user login, batalkan dengan error 403 Forbidden
        }

        // Cek Logika: Apakah user ini SUDAH memverifikasi emailnya?
        if ($user->hasVerifiedEmail()) {
            // Jika SUDAH terverifikasi, jangan tampilkan halaman prompt.
            // Redirect user ke halaman yang ingin mereka tuju (intended) atau default ke 'dashboard'.
            return redirect()->intended(route('dashboard', absolute: false));
        }

        // Jika BELUM terverifikasi, tampilkan view 'auth.verify-email'.
        // Halaman ini biasanya berisi pesan: "Link verifikasi telah dikirim, silakan cek inbox Anda."
        return view('auth.verify-email');
    }
}
