@props(['kursus'])
<div class="bg-white rounded-2xl border border-slate-100 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between overflow-hidden group">
    <div>
        <div class="h-48 bg-gradient-to-tr from-indigo-600 to-blue-500 relative p-6 flex items-end justify-between overflow-hidden">
            <div class="absolute -right-6 -bottom-6 w-32 h-32 bg-white/10 rounded-full blur-xl group-hover:scale-150 transition-transform duration-500"></div>
            <span class="relative z-10 bg-white/90 backdrop-blur-sm text-indigo-900 font-bold text-xs px-3 py-1 rounded-lg shadow-sm">{{ $kursus->kategori->nama ?? 'Umum' }}</span>
            <span class="relative z-10 bg-amber-500 text-slate-900 font-extrabold text-xs px-2.5 py-1 rounded-md shadow-sm">★ Unggulan</span>
        </div>
        <div class="p-6">
            <h3 class="font-bold text-lg text-slate-900 group-hover:text-indigo-600 transition-colors line-clamp-1">
                <a href="#">{{ $kursus->judul }}</a>
            </h3>
            <p class="text-slate-500 text-xs mt-2 leading-relaxed line-clamp-2">{{ $kursus->deskripsi }}</p>
            <div class="mt-4 flex items-center space-x-4 text-xs font-semibold text-slate-400">
                <span>👥 {{ $kursus->peserta_count ?? 0 }} Peserta Terdaftar</span>
            </div>
        </div>
    </div>
    <div class="p-6 pt-0 mt-auto">
        <hr class="border-slate-100 mb-4">
        <div class="flex items-center justify-between">
            <div>
                <span class="block text-[10px] uppercase font-bold text-slate-400">Status</span>
                <span class="text-sm font-extrabold text-emerald-600">Pendaftaran Buka</span>
            </div>
            <a href="#" class="bg-slate-900 hover:bg-indigo-600 text-white text-xs font-bold px-4 py-2.5 rounded-xl transition-colors shadow-sm">Lihat Detail</a>
        </div>
    </div>
</div>