<?php

namespace App\Http\Controllers\Auth; // Menentukan namespace lokasi file ini

use App\Http\Controllers\Controller; // Mengimpor Controller induk
use Illuminate\Auth\Events\Verified; // Mengimpor Event 'Verified' yang akan dipicu setelah sukses verifikasi
use Illuminate\Contracts\Auth\MustVerifyEmail; // Interface untuk memastikan model User mendukung verifikasi email
use Illuminate\Foundation\Auth\EmailVerificationRequest; // Request khusus yang otomatis memvalidasi tanda tangan (signature) URL
use Illuminate\Http\RedirectResponse; // Tipe data kembalian untuk redirect
use Illuminate\Support\Facades\Auth; // Facade Auth untuk manajemen user

class VerifyEmailController extends Controller // Definisi kelas controller
{
    /**
     * Mark the authenticated user's email address as verified.
     * Method ini menggunakan __invoke (Single Action Controller)
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse // Menerima Request khusus yang sudah memvalidasi ID dan Hash di URL
    {
        // Mengambil data pengguna yang sedang login saat ini
        $user = Auth::guard('web')->user();

        // Pengecekan keamanan (Safety Check)
        // Memastikan user tidak null
        if ($user === null) {
            abort(403); // Jika tidak ada user, tolak akses (Forbidden)
        }

        // Cek Logika: Apakah email user ini SUDAH terverifikasi sebelumnya?
        // (Misal: User mengklik link di email dua kali)
        if ($user->hasVerifiedEmail()) {
            // Jika sudah, langsung redirect ke dashboard (intended = halaman tujuan awal)
            // Tambahkan parameter query '?verified=1' untuk memicu pesan sukses di frontend
            return redirect()
                ->intended(route('dashboard', absolute: false) . '?verified=1');
        }

        // Inti Proses Verifikasi:
        // 1. Cek apakah model User mengimplementasikan interface MustVerifyEmail (wajib verifikasi).
        // 2. Jalankan markEmailAsVerified() -> Ini akan mengisi kolom 'email_verified_at' di database dengan waktu sekarang.
        if (
            $user instanceof MustVerifyEmail
            && $user->markEmailAsVerified()
        ) {
            // Jika database berhasil diupdate, picu Event 'Verified'.
            // Event ini berguna jika Anda ingin mengirim email "Selamat Datang" setelah verifikasi.
            event(new Verified($user)); // ✅ PHPStan sekarang AMAN
        }

        // Setelah semua proses selesai, redirect user ke dashboard
        // dengan parameter '?verified=1'
        return redirect()
            ->intended(route('dashboard', absolute: false) . '?verified=1');
    }
}
