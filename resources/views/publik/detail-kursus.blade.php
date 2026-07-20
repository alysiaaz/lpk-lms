@extends('layouts.app')
@section('title', $kursus->judul . 'LPK Karier Sukses')

@section('content')
@extends('layouts.app')
@section('title', $kursus->judul . ' - LPK Karier Sukses')

@section('content')
    <!-- HEADER DETAIL KURSUS -->
    <section class="bg-lpk-teal text-lpk-bg py-16 border-b border-lpk-teal/20 relative overflow-hidden">
        <div class="absolute right-0 top-0 w-96 h-96 bg-lpk-gold/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="max-w-3xl space-y-4">
                <div class="flex items-center space-x-3">
                    <span class="bg-lpk-gold text-lpk-charcoal font-extrabold text-xs px-3 py-1 rounded-full uppercase tracking-wider">
                        {{ $kursus->kategori->nama ?? 'Umum' }}
                    </span>
                    <span class="text-lpk-mint text-xs font-semibold">● Program Terakreditasi</span>
                </div>
                <h1 class="text-3xl sm:text-5xl font-extrabold tracking-tight leading-tight">{{ $kursus->judul }}</h1>
                <p class="text-lpk-bg/80 text-sm sm:text-base leading-relaxed font-normal">{{ $kursus->deskripsi }}</p>
                
                <div class="pt-4 flex flex-wrap items-center gap-6 text-xs font-semibold text-lpk-mint">
                    <span class="flex items-center">👥 <strong class="text-lpk-gold ml-1.5">{{ $kursus->peserta_count }}</strong> Siswa Terdaftar</span>
                    <span>⌛ Estimasi Waktu: <strong class="text-lpk-bg">3 Bulan Intensif</strong></span>
                    <span>🎓 Sertifikat: <strong class="text-lpk-bg">Resmi LPK & Industri</strong></span>
                </div>
            </div>
        </div>
    </section>

    <!-- KONTEN SILABUS & CALL TO ACTION -->
    <section class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-12 gap-12">
            
            <!-- Kiri: Penjelasan & Silabus (8 Col) -->
            <div class="lg:col-span-8 space-y-8">
                <!-- Tentang Program -->
                <div class="bg-lpk-mint p-8 rounded-3xl border border-lpk-teal/10 space-y-4 shadow-sm">
                    <h3 class="text-xl font-extrabold text-lpk-teal">Tentang Program Pelatihan Ini</h3>
                    <p class="text-lpk-charcoal/80 text-sm leading-relaxed font-normal">
                        Program ini dirancang khusus dari nol hingga tahap mahir (ready-to-work). Kamu akan belajar teori fundamental sekaligus mengerjakan proyek nyata yang biasa dihadapi di dunia kerja. Semua materi disesuaikan dengan standar kompetensi kerja nasional dan global.
                    </p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                        <div class="flex items-start space-x-3 text-xs text-lpk-charcoal font-semibold">
                            <span class="text-lpk-teal font-extrabold text-base">✓</span>
                            <span>Akses materi selamanya & pembaruan kurikulum</span>
                        </div>
                        <div class="flex items-start space-x-3 text-xs text-lpk-charcoal font-semibold">
                            <span class="text-lpk-teal font-extrabold text-base">✓</span>
                            <span>Sesi mentoring langsung bersama praktisi</span>
                        </div>
                        <div class="flex items-start space-x-3 text-xs text-lpk-charcoal font-semibold">
                            <span class="text-lpk-teal font-extrabold text-base">✓</span>
                            <span>Review portofolio & simulasi interview kerja</span>
                        </div>
                        <div class="flex items-start space-x-3 text-xs text-lpk-charcoal font-semibold">
                            <span class="text-lpk-teal font-extrabold text-base">✓</span>
                            <span>Prioritas penyaluran ke 150+ perusahaan mitra</span>
                        </div>
                    </div>
                </div>

                <!-- Silabus Singkat (Simulasi) -->
                <div class="space-y-4">
                    <h3 class="text-xl font-extrabold text-lpk-teal">Kurikulum & Modul Belajar</h3>
                    <div class="space-y-3">
                        <div class="bg-lpk-bg p-5 rounded-2xl border border-lpk-teal/15 flex items-center justify-between font-bold text-sm text-lpk-charcoal shadow-sm">
                            <span>Modul 1: Pengenalan Fundamental & Tools Industri</span>
                            <span class="text-xs text-lpk-teal font-semibold">1 Minggu</span>
                        </div>
                        <div class="bg-lpk-bg p-5 rounded-2xl border border-lpk-teal/15 flex items-center justify-between font-bold text-sm text-lpk-charcoal shadow-sm">
                            <span>Modul 2: Implementasi Praktis & Pemecahan Masalah</span>
                            <span class="text-xs text-lpk-teal font-semibold">4 Minggu</span>
                        </div>
                        <div class="bg-lpk-bg p-5 rounded-2xl border border-lpk-teal/15 flex items-center justify-between font-bold text-sm text-lpk-charcoal shadow-sm">
                            <span>Modul 3: Proyek Akhir (Capstone Project) & Mentoring</span>
                            <span class="text-xs text-lpk-teal font-semibold">4 Minggu</span>
                        </div>
                        <div class="bg-lpk-bg p-5 rounded-2xl border border-lpk-teal/15 flex items-center justify-between font-bold text-sm text-lpk-charcoal shadow-sm">
                            <span>Modul 4: Persiapan Karir & Penyaluran Kerja</span>
                            <span class="text-xs text-lpk-teal font-semibold">3 Minggu</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kanan: Kartu Pendaftaran Floating (4 Col) -->
            <div class="lg:col-span-4">
                <div class="bg-lpk-teal text-lpk-bg p-6 sm:p-8 rounded-3xl sticky top-28 shadow-xl space-y-6 border border-lpk-gold/20">
                    <div>
                        <span class="text-lpk-gold text-xs font-bold uppercase tracking-wider">Status Kelas</span>
                        <div class="text-2xl font-extrabold text-lpk-bg mt-1">Pendaftaran Buka</div>
                        <p class="text-lpk-mint/80 text-xs mt-1">Kuota terbatas untuk menjaga kualitas mentoring.</p>
                    </div>

                    <hr class="border-lpk-bg/15">

                    <div class="space-y-3 text-xs text-lpk-bg/80 font-medium">
                        <div class="flex justify-between"><span>Metode Belajar</span><strong class="text-lpk-bg">Online & Offline (Hybrid)</strong></div>
                        <div class="flex justify-between"><span>Tingkat Kesiapan</span><strong class="text-lpk-gold">Siap Kerja (Siap Praktek)</strong></div>
                        <div class="flex justify-between"><span>Sertifikat</span><strong class="text-lpk-bg">Termasuk</strong></div>
                    </div>

                    <div class="pt-2">
                        <a href="{{ url('/register') }}" class="w-full block text-center bg-lpk-gold hover:bg-opacity-90 text-lpk-charcoal font-extrabold py-4 rounded-2xl text-sm transition-all shadow-md transform hover:-translate-y-0.5">
                            Daftar Program Sekarang 🚀
                        </a>
                        <p class="text-[11px] text-center text-lpk-mint/70 mt-3 font-normal">Akses langsung ke grup peserta & materi pratinjau.</p>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection