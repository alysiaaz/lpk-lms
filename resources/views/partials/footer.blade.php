<footer class="bg-lpk-charcoal text-lpk-bg/80 pt-16 pb-12 border-t border-lpk-teal/20 text-xs">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-12 gap-8 mb-12">
        
        <!-- Kolom 1: Branding & Info LPK (5 Col) -->
        <div class="space-y-4 md:col-span-5">
            <div class="flex items-center space-x-3">
                <div class="w-9 h-9 bg-lpk-gold rounded-xl flex items-center justify-center font-extrabold text-lpk-charcoal text-lg shadow-sm">
                    L
                </div>
                <span class="text-xl font-extrabold tracking-tight text-lpk-bg">LPK <span class="font-normal text-lpk-gold">Karier</span></span>
            </div>
            <p class="max-w-sm text-lpk-bg/70 leading-relaxed font-normal text-sm">
                Lembaga Pelatihan Kerja dengan kurikulum intensif berbasis industri. Membekali peserta dengan keterampilan praktis untuk mewujudkan karir masa depan yang cerah.
            </p>
            <div class="pt-2 flex flex-wrap gap-2">
                <span class="inline-block px-3 py-1 bg-lpk-teal/40 border border-lpk-teal rounded-full text-[11px] font-semibold text-lpk-mint">
                    ✓ Terakreditasi Resmi
                </span>
                <span class="inline-block px-3 py-1 bg-lpk-teal/40 border border-lpk-teal rounded-full text-[11px] font-semibold text-lpk-mint">
                    ✓ Penyaluran Kerja
                </span>
            </div>
        </div>

        <!-- Kolom 2: Navigasi (2 Col) -->
        <div class="md:col-span-2">
            <h4 class="text-lpk-gold font-extrabold mb-4 uppercase tracking-widest text-[11px]">Navigasi</h4>
            <ul class="space-y-2.5 font-medium">
                <li><a href="{{ url('/') }}" class="hover:text-lpk-gold transition-colors">Beranda</a></li>
                <li><a href="{{ url('/kursus') }}" class="hover:text-lpk-gold transition-colors">Semua Kursus</a></li>
                <li><a href="{{ url('/tentang') }}" class="hover:text-lpk-gold transition-colors">Tentang Kami</a></li>
                <li><a href="{{ url('/register') }}" class="hover:text-lpk-gold transition-colors">Daftar Akun</a></li>
            </ul>
        </div>

        <!-- Kolom 3: Program Pelatihan (2 Col) -->
        <div class="md:col-span-2">
            <h4 class="text-lpk-gold font-extrabold mb-4 uppercase tracking-widest text-[11px]">Program</h4>
            <ul class="space-y-2.5 font-medium">
                <li><a href="{{ url('/kursus?kategori=programming') }}" class="hover:text-lpk-gold transition-colors">Programming</a></li>
                <li><a href="{{ url('/kursus?kategori=desain-grafis') }}" class="hover:text-lpk-gold transition-colors">Desain Grafis</a></li>
                <li><a href="{{ url('/kursus?kategori=digital-marketing') }}" class="hover:text-lpk-gold transition-colors">Digital Marketing</a></li>
                <li><a href="{{ url('/kursus') }}" class="hover:text-lpk-gold transition-colors font-bold text-lpk-mint">Lihat Semua →</a></li>
            </ul>
        </div>

        <!-- Kolom 4: Hubungi Kami (3 Col) -->
        <div class="md:col-span-3 space-y-3">
            <h4 class="text-lpk-gold font-extrabold mb-4 uppercase tracking-widest text-[11px]">Hubungi Kami</h4>
            <p class="leading-relaxed font-normal text-lpk-bg/70">
                Jl. Anuang 21, Kota Makassar,<br>Sulawesi Selatan, Indonesia.
            </p>
            <div class="pt-1 space-y-1.5 text-lpk-bg font-medium">
                <p class="flex items-center"><span class="mr-2">📧</span> alys@lpk-karier.id</p>
                <p class="flex items-center"><span class="mr-2">📞</span> +62 812-1122-3344</p>
            </div>
        </div>

    </div>

    <!-- Garis Bawah & Copyright -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-8 border-t border-lpk-bg/10 flex flex-col sm:flex-row items-center justify-between text-lpk-bg/60 font-medium">
        <p>&copy; {{ date('Y') }} LPK Karier Sukses. All rights reserved.</p>
        <div class="space-x-6 mt-4 sm:mt-0">
            <a href="{{ url('/tentang') }}" class="hover:text-lpk-bg transition-colors">Kebijakan Privasi</a>
            <a href="{{ url('/tentang') }}" class="hover:text-lpk-bg transition-colors">Syarat & Ketentuan</a>
        </div>
    </div>
</footer>