<header class="sticky top-0 z-50 bg-lpk-bg/90 backdrop-blur-md border-b border-lpk-teal/10 transition-all">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
        <!-- Logo -->
        <a href="{{ url('/') }}" class="flex items-center space-x-3">
            <div class="w-10 h-10 bg-lpk-teal rounded-xl flex items-center justify-center font-extrabold text-lpk-bg text-xl shadow-md">
                L
            </div>
            <span class="text-xl font-extrabold tracking-tight text-lpk-teal">LPK <span class="font-normal text-lpk-charcoal">Karier Sukses</span></span>
        </a>

        <!-- Menu Navigasi -->
        <nav class="hidden md:flex items-center space-x-8 text-sm font-semibold text-lpk-charcoal/80">
            <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'text-lpk-teal font-bold border-b-2 border-lpk-gold pb-1' : 'hover:text-lpk-teal transition-colors' }}">
                Beranda
            </a>
            <a href="{{ url('/kursus') }}" class="{{ request()->is('kursus*') ? 'text-lpk-teal font-bold border-b-2 border-lpk-gold pb-1' : 'hover:text-lpk-teal transition-colors' }}">
                Semua Kursus
            </a>
            <a href="{{ url('/tentang') }}" class="{{ request()->is('tentang*') ? 'text-lpk-teal font-bold border-b-2 border-lpk-gold pb-1' : 'hover:text-lpk-teal transition-colors' }}">
                Tentang Kami
            </a>

            {{-- Menu tambahan khusus peserta yang sudah login --}}
            @auth
                @if(auth()->user()->role === 'peserta')
                    <a href="{{ route('peserta.kursus') }}" class="{{ request()->routeIs('peserta.kursus') ? 'text-lpk-teal font-bold border-b-2 border-lpk-gold pb-1' : 'hover:text-lpk-teal transition-colors' }}">
                        Kursus Saya
                    </a>
                @endif
            @endauth
        </nav>

        <div class="flex items-center space-x-4">
            @guest
                <!-- Jika Belum Login -->
                <a href="{{ route('login') }}" class="text-sm font-bold text-lpk-teal hover:opacity-80 transition-opacity px-3 py-2">
                    Masuk
                </a>
                <a href="{{ route('register') }}" class="bg-lpk-gold hover:bg-opacity-90 text-lpk-charcoal text-sm font-extrabold px-6 py-2.5 rounded-full shadow-sm transition-all transform hover:-translate-y-0.5">
                    Daftar Sekarang
                </a>
            @else
                <!-- Jika Sudah Login -->
                <a href="{{ url('/dashboard') }}" class="bg-lpk-teal text-lpk-bg hover:bg-lpk-charcoal text-xs font-extrabold px-5 py-2.5 rounded-full shadow-sm transition-all flex items-center space-x-2">
                    <span> Dasbor Saya</span>
                </a>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="text-xs font-bold text-red-600 hover:underline px-2 py-2">
                        Keluar
                    </button>
                </form>
            @endguest
        </div>
    </div>
</header>