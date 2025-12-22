<section class="space-y-6"> {{-- Wrapper utama (section) dengan jarak vertikal antar elemen sebesar 6 satuan. --}}
    <header> {{-- Bagian header untuk judul dan deskripsi fitur hapus akun. --}}
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100"> {{-- Judul dengan font medium, ukuran besar,
            warna adaptif (dark/light). --}}
            {{ __('Delete Account') }} {{-- Teks "Delete Account" yang mendukung terjemahan. --}}
        </h2> {{-- Penutup tag h2. --}}

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400"> {{-- Paragraf deskripsi dengan margin atas kecil dan
            teks abu-abu. --}}
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
            {{-- Teks peringatan bahwa data akan hilang permanen. --}}
        </p> {{-- Penutup tag p. --}}
    </header> {{-- Penutup header. --}}

    <x-danger-button {{-- Komponen tombol bahaya (biasanya warna merah). --}} x-data="" {{-- Inisialisasi Alpine.js
        (kosong karena hanya butuh event click sederhana). --}}
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')" {{-- Event Click: Mencegah aksi default,
        lalu memicu modal dengan nama 'confirm-user-deletion' untuk terbuka.
        --}}>{{ __('Delete Account') }}</x-danger-button> {{-- Teks tombol pemicu modal. --}}

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable> {{-- Komponen Modal:
        Dinamai sesuai dispatch, otomatis muncul jika ada error di 'userDeletion', dan bisa menerima fokus keyboard.
        --}}
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6"> {{-- Form konfirmasi: Method POST, aksi
            ke route penghapusan profil, padding 6. --}}
            @csrf {{-- Token keamanan CSRF (Wajib untuk form POST). --}}
            @method('delete') {{-- Method Spoofing: Mengubah method POST menjadi DELETE agar dikenali oleh Router
            Laravel. --}}

            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100"> {{-- Judul di dalam modal (Konfirmasi
                ulang). --}}
                {{ __('Are you sure you want to delete your account?') }} {{-- Pertanyaan "Apakah Anda yakin?". --}}
            </h2> {{-- Penutup tag h2. --}}

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400"> {{-- Penjelasan tambahan di dalam modal. --}}
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                {{-- Instruksi memasukkan password untuk konfirmasi akhir. --}}
            </p> {{-- Penutup tag p. --}}

            <div class="mt-6"> {{-- Wrapper input password dengan margin atas. --}}
                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" /> {{-- Label input:
                'sr-only' berarti hanya terbaca oleh screen reader (tersembunyi secara visual). --}}

                <x-text-input {{-- Komponen input teks (password). --}} id="password" {{-- ID elemen. --}}
                    name="password" {{-- Nama field yang dikirim ke server. --}} type="password" {{-- Tipe input
                    password (teks tersembunyi). --}} class="mt-1 block w-3/4" {{-- Styling: Margin atas, block, lebar
                    75%. --}} placeholder="{{ __('Password') }}" {{-- Placeholder teks. --}} /> {{-- Self-closing tag
                input. --}}

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" /> {{-- Menampilkan pesan
                error validasi khusus bag 'userDeletion' jika password salah. --}}
            </div> {{-- Penutup div input. --}}

            <div class="mt-6 flex justify-end"> {{-- Container tombol aksi: Margin atas, Flexbox rata kanan. --}}
                <x-secondary-button x-on:click="$dispatch('close')"> {{-- Tombol 'Cancel': Menggunakan Alpine.js untuk
                    menutup modal ($dispatch close). --}}
                    {{ __('Cancel') }} {{-- Teks tombol batal. --}}
                </x-secondary-button> {{-- Penutup tombol sekunder. --}}

                <x-danger-button class="ms-3"> {{-- Tombol 'Delete Account' (Merah): Tombol submit form sebenarnya. --}}
                    {{ __('Delete Account') }} {{-- Teks tombol hapus. --}}
                </x-danger-button> {{-- Penutup tombol bahaya. --}}
            </div> {{-- Penutup container tombol. --}}
        </form> {{-- Penutup form. --}}
    </x-modal> {{-- Penutup komponen modal. --}}
</section> {{-- Penutup section utama. --}}