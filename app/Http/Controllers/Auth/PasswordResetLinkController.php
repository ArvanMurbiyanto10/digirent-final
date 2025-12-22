<?php

namespace App\Http\Controllers\Auth; // Menentukan namespace lokasi file ini

use App\Http\Controllers\Controller; // Mengimpor Controller induk
use Illuminate\Http\RedirectResponse; // Mengimpor tipe data kembalian untuk redirect
use Illuminate\Http\Request;         // Mengimpor class Request untuk menangani input form
use Illuminate\Support\Facades\Password; // Mengimpor Facade Password (Broker) untuk menangani logika reset password
use Illuminate\View\View;            // Mengimpor tipe data kembalian untuk view

class PasswordResetLinkController extends Controller // Definisi kelas controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View // Method untuk menampilkan halaman form "Lupa Password"
    {
        return view('auth.forgot-password'); // Mengembalikan view 'resources/views/auth/forgot-password.blade.php'
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse // Method untuk memproses pengiriman link (POST)
    {
        // Validasi input: Pastikan kolom email diisi dan formatnya benar-benar email
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        // Kami akan mengirimkan tautan setel ulang kata sandi ke pengguna ini.
        // Setelah kami mencoba mengirim tautan, kami akan memeriksa responsnya
        // untuk melihat pesan apa yang perlu kami tunjukkan kepada pengguna.

        // Method sendResetLink melakukan beberapa hal sekaligus:
        // 1. Mengecek apakah email ada di tabel 'users'.
        // 2. Membuat token unik dan menyimpannya di tabel 'password_resets'.
        // 3. Mengirim email notifikasi berisi link reset ke user.
        $status = Password::sendResetLink(
            $request->only('email') // Mengambil hanya data email dari input form
        );

        // Mengecek status hasil operasi di atas
        return $status == Password::RESET_LINK_SENT // Jika statusnya SUKSES (Link berhasil dikirim)
            ? back()->with('status', __($status)) // Kembali ke halaman form dengan pesan sukses (flash message)
            : back()->withInput($request->only('email')) // JIKA GAGAL (Misal: Email tidak terdaftar di sistem)
            ->withErrors(['email' => __($status)]); // Kembali dengan input email lama dan tampilkan pesan error pada field email
    }
}
