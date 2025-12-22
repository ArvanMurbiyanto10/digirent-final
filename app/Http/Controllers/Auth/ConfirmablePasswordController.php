<?php

namespace App\Http\Controllers\Auth; // Namespace standar untuk controller autentikasi

use App\Http\Controllers\Controller; // Mengimpor base Controller
use Illuminate\Http\RedirectResponse; // Tipe data kembalian untuk redirect
use Illuminate\Http\Request;         // Class Request untuk menangani input
use Illuminate\Support\Facades\Auth; // Facade Auth untuk manajemen user login
use Illuminate\Validation\ValidationException; // Exception untuk menangani error validasi
use Illuminate\View\View;            // Tipe data kembalian untuk tampilan (view)

class ConfirmablePasswordController extends Controller // Definisi kelas controller
{
    /**
     * Show the confirm password view.
     */
    public function show(): View // Method untuk menampilkan halaman konfirmasi password
    {
        return view('auth.confirm-password'); // Mengembalikan file view 'resources/views/auth/confirm-password.blade.php'
    }

    /**
     * Confirm the user's password.
     */
    public function store(Request $request): RedirectResponse // Method untuk memproses konfirmasi password (POST)
    {
        // ✅ VALIDASI DULU
        $validated = $request->validate([ // Memvalidasi input dari form
            'password' => ['required', 'string'], // Password wajib diisi dan harus berupa string
        ]);

        $user = Auth::guard('web')->user(); // Mendapatkan data user yang sedang login saat ini

        if ($user === null) { // Pengecekan keamanan: Jika entah bagaimana user tidak login
            abort(403); // Batalkan proses dan tampilkan error 403 Forbidden
        }

        // Mengecek apakah password yang diinput cocok dengan kredensial user saat ini
        if (! Auth::guard('web')->validate([
            'email' => $user->email, // Menggunakan email dari user yang sedang login
            'password' => $validated['password'], // ✅ INI FIX UTAMA: Menggunakan password yang sudah divalidasi dari input form
        ])) {
            // Jika validasi kredensial gagal (password salah):
            throw ValidationException::withMessages([ // Lempar exception validasi
                'password' => __('auth.password'), // Tampilkan pesan error standar 'password salah'
            ]);
        }

        // Jika password benar: Simpan timestamp konfirmasi ke dalam session
        // Middleware 'password.confirm' akan mengecek session ini nantinya
        $request->session()->put('auth.password_confirmed_at', time());

        // Redirect user ke halaman yang tadinya ingin mereka akses (intended), atau ke dashboard jika tidak ada
        return redirect()->intended(route('dashboard', absolute: false));
    }
}
