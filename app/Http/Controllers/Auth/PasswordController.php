<?php

namespace App\Http\Controllers\Auth; // Menentukan namespace lokasi file ini

use App\Http\Controllers\Controller; // Mengimpor Controller induk
use Illuminate\Http\RedirectResponse; // Mengimpor tipe data kembalian untuk redirect
use Illuminate\Http\Request;         // Mengimpor class Request untuk menangani input form
use Illuminate\Support\Facades\Auth; // Mengimpor Facade Auth untuk mengambil data user yang login
use Illuminate\Support\Facades\Hash; // Mengimpor Facade Hash untuk mengenkripsi password
use Illuminate\Validation\Rules\Password; // Mengimpor aturan validasi password standar Laravel

class PasswordController extends Controller // Definisi kelas controller
{
    /**
     * Update the user's password.
     * Method ini menangani request PUT/PATCH untuk mengubah password user yang sedang login.
     */
    public function update(Request $request): RedirectResponse // Method menerima Request dan mengembalikan RedirectResponse
    {
        // Validasi input form.
        // Method 'validateWithBag' digunakan agar pesan error masuk ke variabel khusus bernama 'updatePassword'.
        // Ini SANGAT PENTING jika dalam satu halaman ada dua form (misal: Update Profil & Update Password)
        // agar pesan errornya tidak tertukar.
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'], // Wajib diisi, dan rule 'current_password' akan mengecek apakah cocok dengan password lama di database.
            'password' => ['required', Password::defaults(), 'confirmed'], // Wajib, harus memenuhi standar keamanan (panjang/karakter), dan harus cocok dengan field 'password_confirmation'.
        ]);

        $user = Auth::guard('web')->user(); // Mengambil objek user yang sedang login saat ini

        // Pengecekan keamanan (Safety Check)
        if ($user === null) {
            abort(403); // Jika entah bagaimana tidak ada user yang login, batalkan dengan error 403 Forbidden.
        }

        // Melakukan update data user ke database
        $user->update([
            'password' => Hash::make($validated['password']), // Password baru DI-HASH (dienkripsi satu arah) dulu menggunakan Bcrypt/Argon2 sebelum disimpan.
        ]);

        // Mengembalikan user ke halaman sebelumnya (halaman profil)
        // dengan flash message 'status' => 'password-updated' untuk memicu notifikasi sukses di view.
        return back()->with('status', 'password-updated');
    }
}
