<?php // Tag pembuka untuk memulai eksekusi kode PHP.

namespace App\Models; // Menentukan namespace agar kelas ini dikenali berada dalam folder App\Models.

// use Illuminate\Contracts\Auth\MustVerifyEmail; // Baris ini dikomentari (non-aktif): opsi interface untuk fitur verifikasi email.
use Illuminate\Database\Eloquent\Factories\HasFactory; // Mengimpor trait HasFactory untuk membuat data dummy (factory) pengguna.
use Illuminate\Foundation\Auth\User as Authenticatable; // Mengimpor kelas dasar User yang mendukung sistem otentikasi Laravel.
use Illuminate\Notifications\Notifiable; // Mengimpor trait Notifiable untuk mengirim notifikasi (seperti email reset password).

class User extends Authenticatable // Mendefinisikan kelas 'User' yang bertindak sebagai model otentikasi utama aplikasi.
{ // Kurung kurawal pembuka untuk memulai blok kode kelas User.
    /** @use HasFactory<\Database\Factories\UserFactory> */ // Komentar PHPDoc untuk memberi tahu IDE tentang Factory yang digunakan.
    use HasFactory, Notifiable; // Mengaktifkan trait HasFactory dan Notifiable di dalam kelas ini.

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */ // Komentar blok yang menjelaskan variabel $fillable di bawah ini.
    protected $fillable = [ // Properti '$fillable' menentukan daftar kolom yang aman untuk diisi secara massal (mass assignment).
        'name', // Mengizinkan kolom 'name' (nama lengkap pengguna) untuk diisi.
        'email', // Mengizinkan kolom 'email' (alamat email pengguna) untuk diisi.
        'password', // Mengizinkan kolom 'password' (kata sandi) untuk diisi.
        'google_id', // Mengizinkan kolom 'google_id' (ID unik login Google) untuk diisi.
        'role', // Mengizinkan kolom 'role' (peran pengguna, misal: admin atau user) untuk diisi.
        'phone', // Mengizinkan kolom 'phone' (nomor telepon) untuk diisi.
        'address', // Mengizinkan kolom 'address' (alamat lengkap) untuk diisi.
    ]; // Penutup array untuk properti $fillable.

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */ // Komentar blok yang menjelaskan variabel $hidden di bawah ini.
    protected $hidden = [ // Properti '$hidden' menyembunyikan data sensitif saat objek user diubah menjadi JSON/Array.
        'password', // Menyembunyikan kolom 'password' agar tidak bocor di respon API.
        'remember_token', // Menyembunyikan kolom 'remember_token' demi keamanan sesi login.
    ]; // Penutup array untuk properti $hidden.

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */ // Komentar blok yang menjelaskan fungsi casting tipe data di bawah ini.
    protected function casts(): array // Mendefinisikan metode 'casts' untuk mengubah tipe data kolom secara otomatis.
    { // Pembuka blok fungsi casts.
        return [ // Mengembalikan array konfigurasi casting.
            'email_verified_at' => 'datetime', // Mengonversi 'email_verified_at' menjadi objek datetime PHP secara otomatis.
            'password' => 'hashed', // Memastikan password otomatis di-hash (dienkripsi) saat disimpan atau diubah.
        ]; // Penutup array pengembalian nilai fungsi.
    } // Penutup blok fungsi casts.

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<\App\Models\Booking, $this>
     */ // Komentar PHPDoc menjelaskan bahwa fungsi ini mengembalikan relasi HasMany ke model Booking.
    public function bookings() // Mendefinisikan metode bernama 'bookings' untuk relasi database.
    { // Pembuka blok fungsi bookings.
        return $this->hasMany(Booking::class); // Mengembalikan definisi relasi bahwa satu User dapat memiliki banyak Booking (One-to-Many).
    } // Penutup blok fungsi bookings.
} // Kurung kurawal penutup untuk mengakhiri blok kode kelas User.
