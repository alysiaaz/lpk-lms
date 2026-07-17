<footer class="bg-slate-900 text-slate-400 py-12 border-t border-slate-800 text-xs">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
        <div class="space-y-4 md:col-span-2">
            <div class="flex items-center space-x-2 text-white">
                <div class="w-8 h-8 bg-indigo-600 rounded-lg flex items-center justify-center font-bold text-white text-md">L</div>
                <span class="text-lg font-bold">LPK Karier Sukses</span>
            </div>
            <p class="max-w-sm text-slate-400 leading-relaxed">Lembaga Pelatihan Kerja terdepan yang berfokus pada pengembangan keterampilan digital dan penyaluran kerja profesional.</p>
        </div>
        <div>
            <h4 class="text-white font-bold mb-3 uppercase tracking-wider">Navigasi</h4>
            <ul class="space-y-2">
                <li><a href="{{ url('/') }}" class="hover:text-white transition-colors">Beranda</a></li>
                <li><a href="#" class="hover:text-white transition-colors">Semua Kursus</a></li>
            </ul>
        </div>
        <div>
            <h4 class="text-white font-bold mb-3 uppercase tracking-wider">Hubungi Kami</h4>
            <p class="leading-relaxed">Jl. Pendidikan No. 123, Kota Makassar, Sulawesi Selatan.<br>Email: info@lpk-karier.id</p>
        </div>
    </div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-8 border-t border-slate-800/80 text-center sm:flex sm:justify-between sm:text-left">
        <p>&copy; {{ date('Y') }} LPK Karier Sukses. All rights reserved.</p>
    </div>
</footer>