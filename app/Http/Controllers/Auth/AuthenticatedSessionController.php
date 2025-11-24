<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// TAMBAHKAN USE STATEMENTS INI
use Illuminate\View\View;
use Laravel\Socialite\Facades\Socialite;

// <- Dihapus dari kode Anda, tapi tidak apa-apa jika ada
// <- Dihapus dari kode Anda, tapi tidak apa-apa jika ada

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();

        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    // --- FUNGSI GOOGLE AUTH ---

    /**
     * Redirect the user to the Google authentication page.
     */
    public function redirectToGoogle(): RedirectResponse
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from Google.
     */
    public function handleGoogleCallback(): RedirectResponse
    {
        try {
            // 1. Ambil data pengguna dari Google
            $googleUser = Socialite::driver('google')->user();

            // 2. Cari pengguna di database kita berdasarkan email
            $user = User::where('email', $googleUser->getEmail())->first();

            // 3. Jika pengguna ditemukan, langsung loginkan
            if ($user) {
                // Opsional: Update google_id jika Anda menambahkannya di masa depan
                // $user->update(['google_id' => $googleUser->getId()]);

                Auth::login($user);

                return redirect()->intended(route('dashboard', absolute: false));
            }

            // 4. Jika pengguna TIDAK ditemukan, buat akun baru
            $newUser = User::create([
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'email_verified_at' => now(), // Email Google sudah pasti terverifikasi

                // --- INI PERBAIKAN UTAMANYA ---
                'password' => null, // Set password ke NULL
                // ---------------------------------

                'role' => 'user', // Set role default
            ]);

            // 5. Loginkan pengguna baru
            Auth::login($newUser);

            return redirect()->intended(route('dashboard', absolute: false));

        } catch (\Exception $e) {
            // Jika ada error, kembali ke login
            // dd($e->getMessage()); // Uncomment ini untuk debugging jika perlu
            return redirect()->route('login')->with('error', 'Login dengan Google gagal, coba lagi.');
        }
    }
}
