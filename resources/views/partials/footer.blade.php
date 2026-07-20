<footer class="bg-lpk-charcoal text-lpk-bg/80 pt-16 pb-12 border-t border-lpk-teal/20 text-xs">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-12 gap-8 mb-12">
        
        <!-- Branding & Info LPK  -->
        <div class="space-y-4 md:col-span-5">
            <div class="flex items-center space-x-3">
                <div class="w-9 h-9 bg-lpk-gold rounded-xl flex items-center justify-center font-extrabold text-lpk-charcoal text-lg shadow-sm">
                    L
                </div>
                <span class="text-xl font-extrabold tracking-tight text-lpk-bg">LPK <span class="font-normal text-lpk-gold">Karier Sukses</span></span>
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

        <!--  Navigasi -->
        <div class="md:col-span-2">
            <h4 class="text-lpk-gold font-extrabold mb-4 uppercase tracking-widest text-[11px]">Navigasi</h4>
            <ul class="space-y-2.5 font-medium">
                <li><a href="{{ url('/') }}" class="hover:text-lpk-gold transition-colors">Beranda</a></li>
                <li><a href="#" class="hover:text-lpk-gold transition-colors">Semua Kursus</a></li>
                <li><a href="#" class="hover:text-lpk-gold transition-colors">Tentang Kami</a></li>
                <li><a href="#" class="hover:text-lpk-gold transition-colors">Konsultasi Karir</a></li>
            </ul>
        </div>

        <!-- Program Pelatihan -->
        <div class="md:col-span-2">
            <h4 class="text-lpk-gold font-extrabold mb-4 uppercase tracking-widest text-[11px]">Program</h4>
            <ul class="space-y-2.5 font-medium">
                <li><a href="#" class="hover:text-lpk-gold transition-colors">Programming</a></li>
                <li><a href="#" class="hover:text-lpk-gold transition-colors">Desain Grafis</a></li>
                <li><a href="#" class="hover:text-lpk-gold transition-colors">Digital Marketing</a></li>
                <li><a href="#" class="hover:text-lpk-gold transition-colors">Bahasa Asing</a></li>
            </ul>
        </div>

        <!-- Hubungi Kami -->
        <div class="md:col-span-3 space-y-3">
            <h4 class="text-lpk-gold font-extrabold mb-4 uppercase tracking-widest text-[11px]">Hubungi Kami</h4>
            <p class="leading-relaxed font-normal text-lpk-bg/70">
                Jl. Anuang No. 21, Kota Makassar,<br>Sulawesi Selatan, Indonesia.
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
            <a href="#" class="hover:text-lpk-bg transition-colors">Kebijakan Privasi</a>
            <a href="#" class="hover:text-lpk-bg transition-colors">Syarat & Ketentuan</a>
        </div>
    </div>
</footer>