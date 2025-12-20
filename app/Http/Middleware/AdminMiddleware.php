<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Fix: Simpan user ke variabel dulu untuk validasi PHPStan
        /** @var \App\Models\User|null $user */
        $user = Auth::user();

        // Cek apakah $user ADA (tidak null) DAN role-nya 'admin'
        if ($user && $user->role === 'admin') {
            return $next($request);
        }

        // Jika tidak, arahkan kembali ke halaman utama
        return redirect('/');
    }
}
