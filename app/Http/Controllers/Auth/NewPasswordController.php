<?php

namespace App\Http\Controllers\Auth; // Menentukan namespace agar kelas ini dapat diload oleh Laravel

use App\Http\Controllers\Controller; // Mengimpor Controller dasar
use App\Models\User;                 // Mengimpor Model User
use Illuminate\Auth\Events\PasswordReset; // Mengimpor Event yang dipicu saat password berhasil direset
use Illuminate\Http\RedirectResponse; // Tipe data kembalian untuk redirect
use Illuminate\Http\Request;         // Class Request untuk menangani input form
use Illuminate\Support\Facades\Hash; // Facade untuk melakukan hashing password (enkripsi satu arah)
use Illuminate\Support\Facades\Password; // Facade Password Broker untuk logika reset token
use Illuminate\Support\Str;          // Helper untuk manipulasi string (random string)
use Illuminate\Validation\Rules;     // Aturan validasi password default Laravel
use Illuminate\View\View;            // Tipe data kembalian untuk tampilan (view)

class NewPasswordController extends Controller // Definisi kelas controller
{
    /**
     * Display the password reset view.
     */
    public function create(Request $request): View // Method untuk menampilkan form reset password
    {
        // Mengembalikan view 'auth.reset-password' dan mengirimkan objek $request
        // $request dikirim agar view bisa mengambil 'token' dan 'email' dari URL
        return view('auth.reset-password', ['request' => $request]);
    }

    /**
     * Handle an incoming new password request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse // Method untuk memproses simpan password baru (POST)
    {
        $validated = $request->validate([ // Validasi input dari form
            'token' => ['required'], // Token reset password (hidden field) wajib ada
            'email' => ['required', 'email'], // Email wajib dan harus format email valid
            'password' => ['required', 'confirmed', Rules\Password::defaults()], // Password wajib, harus cocok dengan konfirmasi, dan memenuhi aturan keamanan default
        ]);

        //

        /** @var string $status */
        // Password::reset bertugas memverifikasi token dan email di tabel 'password_resets'
        $status = Password::reset(
            [ // Array kredensial yang akan divalidasi oleh Password Broker
                'email' => $validated['email'], // Email user
                'password' => $validated['password'], // Password baru
                'password_confirmation' => $validated['password'], // Konfirmasi password (opsional di beberapa versi, tapi baik disertakan)
                'token' => $validated['token'], // Token unik yang dikirim via email
            ],
            // Closure (fungsi anonim) ini HANYA dijalankan jika Token & Email VALID
            function (User $user) use ($validated): void {
                $user->forceFill([ // Mengupdate atribut user secara paksa (mengabaikan $fillable)
                    'password' => Hash::make($validated['password']), // Meng-hash password baru sebelum disimpan
                    'remember_token' => Str::random(60), // Mengganti remember_token untuk logout dari sesi lain (keamanan)
                ])->save(); // Simpan perubahan ke database

                event(new PasswordReset($user)); // Memicu event PasswordReset (berguna untuk log atau notifikasi email sukses)
            }
        );

        // Mengecek hasil status dari Password::reset
        return $status === Password::PASSWORD_RESET // Jika statusnya SUKSES (Password::PASSWORD_RESET)
            ? redirect() // Mulai redirect
            ->route('login') // Arahkan pengguna ke halaman login
            ->with('status', __($status))      // ✅ TANPA CAST: Kirim pesan sukses (diterjemahkan) ke session
            : back() // JIKA GAGAL (Token expired atau email salah): Kembali ke halaman sebelumnya
            ->withInput(['email' => $validated['email']]) // Kembalikan input email agar user tidak perlu ketik ulang
            ->withErrors(['email' => __($status)]); // ✅ TANPA CAST: Kirim pesan error (diterjemahkan) untuk field email
    }
}
