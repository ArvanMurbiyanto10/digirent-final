<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

// TAMBAHKAN USE STATEMENTS INI
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
     * (Fungsi 'store' ini tidak akan kita pakai lagi, tapi biarkan saja)
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


    // --- TAMBAHKAN DUA FUNGSI BARU DI BAWAH INI ---

    /**
     * Redirect the user to the Google authentication page.
     */
    public function redirectToGoogle(): RedirectResponse
    {
        // Fungsi ini akan mengarahkan pengguna ke halaman login Google
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
                Auth::login($user);
                return redirect()->intended(route('dashboard', absolute: false));
            }

            // 4. Jika pengguna TIDAK ditemukan, buat akun baru
            $newUser = User::create([
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'password' => Hash::make(Str::random(24)), // Buat password acak (tidak akan dipakai)
                'role' => 'user', // Set role default
            ]);

            // 5. Loginkan pengguna baru
            Auth::login($newUser);
            return redirect()->intended(route('dashboard', absolute: false));

        } catch (\Exception $e) {
            // Jika ada error, kembali ke login
            return redirect()->route('login')->with('error', 'Login dengan Google gagal, coba lagi.');
        }
    }
}
