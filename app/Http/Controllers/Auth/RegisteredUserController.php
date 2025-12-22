<?php

namespace App\Http\Controllers\Auth; // Menentukan namespace lokasi file ini

use App\Http\Controllers\Controller; // Mengimpor Controller induk
use App\Models\User;                 // Mengimpor Model User untuk berinteraksi dengan tabel users
use Illuminate\Auth\Events\Registered; // Mengimpor Event 'Registered' (biasanya untuk memicu kirim email verifikasi)
use Illuminate\Http\RedirectResponse; // Tipe data kembalian untuk redirect
use Illuminate\Http\Request;         // Class Request untuk menangani input form
use Illuminate\Support\Facades\Auth; // Facade Auth untuk manajemen login user
use Illuminate\Support\Facades\Hash; // Facade Hash untuk mengenkripsi password
use Illuminate\Validation\Rules;     // Aturan validasi bawaan Laravel
use Illuminate\View\View;            // Tipe data kembalian untuk view

class RegisteredUserController extends Controller // Definisi kelas controller
{
    /**
     * Display the registration view.
     */
    public function create(): View // Method untuk menampilkan halaman form registrasi
    {
        return view('auth.register'); // Mengembalikan file view 'resources/views/auth/register.blade.php'
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse // Method untuk memproses data pendaftaran (POST)
    {
        // 1. Validasi Input
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'], // Nama wajib, string, maks 255 karakter
            'email' => [
                'required', // Email wajib
                'string',   // Harus berupa string
                'lowercase', // Otomatis diubah jadi huruf kecil sebelum validasi unik
                'email',    // Harus format email yang valid (@ dan domain)
                'max:255',  // Maks panjang
                'unique:' . User::class, // Cek ke tabel users: Email tidak boleh kembar/sudah terdaftar
            ],
            'password' => ['required', 'confirmed', Rules\Password::defaults()], // Password wajib, harus cocok dengan field 'password_confirmation', dan sesuai aturan keamanan standar
        ]);

        // 2. Simpan Data User Baru ke Database
        $user = User::create([
            'name' => $validated['name'], // Ambil nama yang sudah tervalidasi
            'email' => $validated['email'], // Ambil email yang sudah tervalidasi
            'password' => Hash::make($validated['password']), // ✅ FIX: Password di-hash (enkripsi) sebelum disimpan
        ]);

        // 3. Trigger Event Pendaftaran
        // Ini akan memicu listener lain, misalnya mengirim Email Verifikasi ke user
        event(new Registered($user));

        // 4. Login Otomatis
        // Setelah daftar, user langsung masuk (login) tanpa perlu input kredensial lagi
        Auth::login($user);

        // 5. Redirect
        // Arahkan user ke halaman dashboard (atau halaman tujuan awal)
        return redirect(route('dashboard', absolute: false));
    }
}
