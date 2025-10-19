<footer class="bg-gray-800 text-white">
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

            {{-- Kolom 1: Tentang DigiRent --}}
            <div>
                <h3 class="text-2xl font-bold mb-2">DigiRent</h3>
                <p class="text-gray-400 max-w-md">
                    Platform penyewaan gadget terdepan di Purwokerto. Kami menyediakan kemudahan dan akses ke teknologi
                    terkini.
                </p>
            </div>

            {{-- Kolom 2: Kontak --}}
            <div>
                <h4 class="text-lg font-semibold mb-4 tracking-wider uppercase">Contact Us</h4>
                <ul class="space-y-3 text-gray-400">
                    <li class="flex items-center">
                        <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                            </path>
                        </svg>
                        <span>0882-2149-8209 (Arvan Murbiyanto)</span>
                    </li>
                    <li class="flex items-center">
                        <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                            </path>
                        </svg>
                        <span>0813-2737-9540 (Zidane Maulana)</span>
                    </li>
                </ul>
            </div>

            {{-- Kolom 3: Informasi --}}
            <div>
                <h4 class="text-lg font-semibold mb-4 tracking-wider uppercase">Informasi</h4>
                <ul class="space-y-2 inline-block text-left">
                    <li>
                        <a href="{{ route('terms.show') }}"
                            class="text-gray-400 hover:text-purple-400 hover:underline transition-colors duration-200">
                            Syarat & Ketentuan
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('privacy.show') }}"
                            class="text-gray-400 hover:text-purple-400 hover:underline transition-colors duration-200">
                            Kebijakan Privasi
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="mt-8 border-t border-gray-700 pt-8 text-center">
            <p class="text-base text-gray-400">&copy; {{ date('Y') }} DigiRent. All Rights Reserved.</p>
        </div>
    </div>
</footer>
