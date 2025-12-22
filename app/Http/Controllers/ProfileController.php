<?php

namespace App\Http\Controllers; // Menentukan namespace lokasi file ini

use App\Http\Requests\ProfileUpdateRequest; // Import Request khusus yang berisi aturan validasi profil
use Illuminate\Http\RedirectResponse; // Import tipe data kembalian Redirect
use Illuminate\Http\Request; // Import class Request standar
use Illuminate\Support\Facades\Auth; // Import Facade Auth untuk manajemen user login
use Illuminate\Support\Facades\Redirect; // Import Facade Redirect
use Illuminate\View\View; // Import tipe data View

class ProfileController extends Controller // Definisi kelas controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View // Method menampilkan halaman form edit profil
    {
        // Mengambil objek user yang sedang login menggunakan guard 'web'
        $user = Auth::guard('web')->user();

        // Pengecekan keamanan (Safety Check) untuk Static Analysis (seperti PHPStan)
        if ($user === null) {
            abort(403); // Jika tidak ada user login, tolak akses
        }

        // Tampilkan view 'resources/views/profile/edit.blade.php'
        // Kirim data user ke view tersebut
        return view('profile.edit', [
            'user' => $user,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse // Method memproses update (menggunakan Custom Request untuk validasi)
    {
        // Ambil user yang sedang login
        $user = Auth::guard('web')->user();

        // Safety check user null
        if ($user === null) {
            abort(403);
        }

        // Mengisi model user dengan data yang SUDAH divalidasi oleh ProfileUpdateRequest.
        // Fungsi 'fill' hanya memperbarui atribut di memori (belum disimpan ke database).
        $user->fill($request->validated());

        // Cek Logika: Apakah kolom 'email' berubah (isDirty)?
        if ($user->isDirty('email')) {
            // Jika email berubah, kita harus membatalkan status verifikasi email sebelumnya.
            // User harus memverifikasi ulang email barunya nanti.
            $user->email_verified_at = null;
        }

        // Simpan perubahan ke database
        $user->save();

        // Redirect kembali ke halaman edit profil dengan pesan sukses 'profile-updated'
        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse // Method menghapus akun
    {
        // Validasi Password sebelum hapus.
        // 'validateWithBag' digunakan karena biasanya fitur hapus akun ada di dalam MODAL
        // di halaman yang sama dengan edit profil. Kita butuh 'bag' error terpisah ('userDeletion')
        // agar pesan error password salah tidak muncul di form edit profil.
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'], // Password wajib dan harus sesuai password saat ini
        ]);

        // Ambil user
        $user = Auth::guard('web')->user();

        // Safety check
        if ($user === null) {
            abort(403);
        }

        // Logout user terlebih dahulu demi keamanan
        Auth::logout();

        // Hapus data user dari database
        $user->delete();

        // Invalidate session (hapus semua data sesi)
        $request->session()->invalidate();
        // Regenerate token CSRF untuk keamanan sesi berikutnya (sebagai tamu)
        $request->session()->regenerateToken();

        // Redirect mantan user ke halaman utama (Homepage)
        return Redirect::to('/');
    }
}
