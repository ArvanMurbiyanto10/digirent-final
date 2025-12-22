<?php

namespace App\Http\Controllers\Auth; // Menentukan namespace agar kelas ini dikenali oleh autoload Laravel

use App\Http\Controllers\Controller; // Mengimpor Controller induk
use App\Http\Requests\Auth\LoginRequest; // Mengimpor Request khusus untuk validasi login
use App\Models\User; // Mengimpor Model User untuk berinteraksi dengan database users
use Illuminate\Http\RedirectResponse; // Tipe data kembalian untuk redirect
use Illuminate\Http\Request; // Class Request standar
use Illuminate\Support\Facades\Auth; // Facade Auth untuk manajemen login/logout
use Illuminate\View\View; // Tipe data kembalian untuk View
use Laravel\Socialite\Facades\Socialite; // Facade Socialite untuk login Google

class AuthenticatedSessionController extends Controller // Definisi kelas Controller
{
    /**
     * Display the login view.
     * FUNGSI INI YANG SEBELUMNYA HILANG
     */
    public function create(): View // Method untuk menampilkan halaman login
    {
        return view('auth.login'); // Mengembalikan view 'resources/views/auth/login.blade.php'
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse // Method untuk memproses login manual (POST)
    {
        $request->authenticate(); // Menjalankan validasi kredensial (email & password)

        $request->session()->regenerate(); // Membuat ulang ID session untuk mencegah serangan Session Fixation

        return redirect()->intended(route('dashboard', absolute: false)); // Redirect user ke halaman yang dituju (atau dashboard)
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse // Method untuk Logout
    {
        Auth::guard('web')->logout(); // Melakukan logout pada guard 'web' (default user)

        $request->session()->invalidate(); // Menghapus semua data session saat ini

        $request->session()->regenerateToken(); // Membuat ulang token CSRF untuk keamanan form berikutnya

        return redirect('/'); // Redirect user kembali ke halaman utama (Home)
    }

    // --- FUNGSI GOOGLE AUTH ---

    /**
     * Redirect the user to the Google authentication page.
     */
    public function redirectToGoogle(): \Symfony\Component\HttpFoundation\RedirectResponse|\Illuminate\Http\RedirectResponse // Method untuk mengarahkan ke Google
    {
        return Socialite::driver('google')->redirect(); // Menggunakan driver Google untuk redirect ke halaman izin akun Google
    }

    /**
     * Obtain the user information from Google.
     */
    public function handleGoogleCallback(): RedirectResponse // Method callback setelah user login di Google
    {
        try { // Blok try-catch untuk menangani jika proses gagal
            /** @var \Laravel\Socialite\Two\User $user */
            $user = Socialite::driver('google')->user(); // Mengambil data user (email, nama, id) dari Google

            // Cek 1: Apakah user ini sudah pernah login Google sebelumnya? (Cek google_id)
            $finduser = User::where('google_id', $user->id)->first();

            if ($finduser) { // Jika user ditemukan berdasarkan google_id
                Auth::login($finduser); // Login user tersebut secara manual
                return redirect()->intended(route('dashboard', absolute: false)); // Redirect ke dashboard
            } else { // Jika user belum pernah login via Google
                // Cek 2: Apakah email dari Google ini sudah terdaftar di database (dari register manual)?
                $existingUser = User::where('email', $user->email)->first();

                if ($existingUser) { // Jika email sudah ada (Account Linking)
                    $existingUser->update([ // Update user tersebut
                        'google_id' => $user->id // Tambahkan google_id agar login berikutnya langsung terdeteksi
                    ]);
                    Auth::login($existingUser); // Login user tersebut
                } else { // Jika benar-benar user baru (Register via Google)
                    $newUser = User::create([ // Buat user baru di database
                        'name' => $user->name, // Ambil nama dari Google
                        'email' => $user->email, // Ambil email dari Google
                        'google_id' => $user->id, // Simpan ID Google
                        'password' => encrypt('123456dummy') // Buat password acak (karena kolom password tidak boleh null)
                    ]);
                    Auth::login($newUser); // Login user baru tersebut
                }

                return redirect()->intended(route('dashboard', absolute: false)); // Redirect ke dashboard
            }
        } catch (\Exception $e) { // Jika terjadi error (misal user membatalkan login)
            return redirect()->route('login')->with('error', 'Login gagal!'); // Redirect ke halaman login dengan pesan error
        }
    }
}
