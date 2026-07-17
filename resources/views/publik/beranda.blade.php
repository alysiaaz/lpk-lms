@extends('layouts.app')
@section('title', 'Beranda - LPK Karier Sukses')
@section('content')
    <!-- 1. HERO SECTION -->
    <section class="relative bg-gradient-to-b from-indigo-900 via-indigo-800 to-slate-900 text-white overflow-hidden py-20 lg:py-28">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
                    <div class="inline-flex items-center space-x-2 px-3 py-1.5 rounded-full bg-indigo-500/20 border border-indigo-400/30 text-amber-300 text-xs font-bold tracking-wide uppercase">
                        <span>🔥 Lembaga Pelatihan Kerja Resmi & Terakreditasi</span>
                    </div>
                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight leading-tight">
                        Tingkatkan Skill, <br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-400 to-amber-200">Siap Kerja Cepat</span> Di Industri Impian.
                    </h1>
                    <p class="text-indigo-200 text-base sm:text-lg max-w-2xl mx-auto lg:mx-0 font-normal leading-relaxed">
                        Kurikulum praktis berstandar industri, diajar oleh praktisi berpengalaman, serta dukungan penyaluran kerja ke ratusan perusahaan mitra.
                    </p>
                    <div class="pt-6 grid grid-cols-3 gap-4 border-t border-indigo-700/50 max-w-lg mx-auto lg:mx-0 text-center lg:text-left">
                        <div><div class="text-2xl sm:text-3xl font-extrabold text-white">2,500+</div><div class="text-xs text-indigo-300 mt-0.5">Alumni Sukses</div></div>
                        <div><div class="text-2xl sm:text-3xl font-extrabold text-amber-400">94%</div><div class="text-xs text-indigo-300 mt-0.5">Tingkat Penyaluran</div></div>
                        <div><div class="text-2xl sm:text-3xl font-extrabold text-white">150+</div><div class="text-xs text-indigo-300 mt-0.5">Mitra Perusahaan</div></div>
                    </div>
                </div>
                <!-- ILUSTRASI MODERN PENGGANTI FOTO -->
                <div class="lg:col-span-5 relative">
                    <div class="relative mx-auto max-w-md lg:max-w-none">
                        <div class="aspect-square rounded-3xl bg-gradient-to-tr from-indigo-600 to-indigo-400 p-1 shadow-2xl rotate-2 opacity-80"></div>
                        <div class="absolute inset-0 bg-slate-900/90 backdrop-blur-xl border border-indigo-500/30 rounded-3xl p-6 flex flex-col justify-between shadow-2xl -rotate-1 transition-transform hover:rotate-0 duration-300">
                            <div class="flex items-center justify-between border-b border-indigo-500/20 pb-4">
                                <div class="flex items-center space-x-3"><div class="w-3 h-3 rounded-full bg-red-500"></div><div class="w-3 h-3 rounded-full bg-yellow-500"></div><div class="w-3 h-3 rounded-full bg-green-500"></div></div>
                                <span class="text-xs font-mono text-indigo-300 bg-indigo-950 px-2.5 py-1 rounded-md border border-indigo-800">🎯 Ready for Work</span>
                            </div>
                            <div class="my-auto py-6 text-center space-y-4">
                                <div class="w-20 h-20 mx-auto rounded-2xl bg-gradient-to-tr from-amber-500 to-amber-300 flex items-center justify-center shadow-lg shadow-amber-500/20 text-slate-900 font-extrabold text-2xl">🚀</div>
                                <div><h3 class="text-lg font-bold text-white">Fullstack Web Development</h3><p class="text-xs text-indigo-300 mt-1">Belajar dari nol hingga siap deploy aplikasi berskala industri.</p></div>
                            </div>
                            <div class="bg-indigo-950/80 p-4 rounded-xl border border-indigo-800/50 space-y-2">
                                <div class="flex justify-between text-xs font-semibold"><span class="text-indigo-200">Progres Kesiapan Kerja</span><span class="text-amber-400">100% Siap</span></div>
                                <div class="w-full bg-indigo-900 h-2 rounded-full overflow-hidden"><div class="bg-gradient-to-r from-amber-500 to-amber-300 h-full w-full rounded-full"></div></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 2. PRODUK / KURSUS UNGGULAN -->
    <section class="py-20 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-12">
                <div>
                    <span class="text-indigo-600 font-extrabold text-xs uppercase tracking-wider bg-indigo-50 px-3 py-1 rounded-full border border-indigo-100">Pilihan Terfavorit</span>
                    <h2 class="text-3xl font-extrabold text-slate-900 mt-3 tracking-tight">Program Kursus Unggulan</h2>
                    <p class="text-slate-500 text-sm mt-2 max-w-xl">Pilih program pelatihan dengan permintaan industri tertinggi saat ini dan mulai bangun portofoliomu.</p>
                </div>
                <a href="#" class="inline-flex items-center space-x-2 text-sm font-bold text-indigo-600 hover:text-indigo-700 mt-4 md:mt-0"><span>Lihat Semua Kursus →</span></a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($kursusUnggulan as $item)
                    <x-kartu-kursus :kursus="$item" />
                @empty
                    <p class="col-span-3 text-center text-slate-400 py-10">Belum ada kursus unggulan di database.</p>
                @endforelse
            </div>
        </div>
    </section>
@endsection