<header class="sticky top-0 z-50 bg-lpk-bg/90 backdrop-blur-md border-b border-lpk-teal/10 transition-all">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
        <!-- Logo -->
        <a href="{{ url('/') }}" class="flex items-center space-x-3">
            <div class="w-10 h-10 bg-lpk-teal rounded-xl flex items-center justify-center font-extrabold text-lpk-bg text-xl shadow-md">
                L
            </div>
            <span class="text-xl font-extrabold tracking-tight text-lpk-teal">LPK <span class="font-normal text-lpk-charcoal">Karier Sukses</span></span>
        </a>

        <!-- Navigasi -->
        <nav class="hidden md:flex items-center space-x-8 text-sm font-semibold text-lpk-charcoal/80">
            <a href="{{ url('/') }}" class="text-lpk-teal font-bold border-b-2 border-lpk-gold pb-1">Beranda</a>
            <a href="#" class="hover:text-lpk-teal transition-colors">Semua Kursus</a>
            <a href="#" class="hover:text-lpk-teal transition-colors">Tentang Kami</a>
        </nav>

        <!-- Action -->
        <div class="flex items-center space-x-4">
            <a href="#" class="text-sm font-bold text-lpk-teal hover:opacity-80 transition-opacity px-3 py-2">Masuk</a>
            <a href="#" class="bg-lpk-gold hover:bg-opacity-90 text-lpk-charcoal text-sm font-extrabold px-6 py-2.5 rounded-full shadow-sm transition-all transform hover:-translate-y-0.5">
                Daftar Sekarang
            </a>
        </div>
    </div>
</header>