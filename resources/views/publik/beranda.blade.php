@extends('layouts.app')
@section('title', 'Beranda - LPK Karier Sukses')

@section('content')
    <!-- HERO SECTION -->
    <section class="py-12 lg:py-20 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                
                <!-- Sisi Kiri-->
                <div class="lg:col-span-6 space-y-6 text-center lg:text-left">
                    <div class="inline-flex items-center space-x-2 px-3.5 py-1.5 rounded-full bg-lpk-mint border border-lpk-teal/20 text-lpk-teal text-xs font-extrabold tracking-wide uppercase">
                        <span class="w-2 h-2 rounded-full bg-lpk-gold animate-pulse"></span>
                        <span>Penerimaan Peserta Baru 2026</span>
                    </div>
                    
                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight text-lpk-teal leading-[1.15]">
                        Ubah Ambisi Menjadi <br>
                        <span class="relative inline-block text-lpk-charcoal">
                            Keahlian Nyata.
                            <span class="absolute bottom-1 left-0 w-full h-3 bg-lpk-gold/40 -z-10 transform -rotate-1"></span>
                        </span>
                    </h1>
                    
                    <p class="text-lpk-charcoal/80 text-base sm:text-lg max-w-xl mx-auto lg:mx-0 leading-relaxed font-normal">
                        Lembaga Pelatihan Kerja dengan kurikulum intensif berstandar industri. Kami membekalimu dengan keterampilan praktis, portofolio kuat, serta penyaluran kerja langsung.
                    </p>

                    <div class="pt-2 flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4">
                        <a href="{{ url('/kursus') }}" class="w-full sm:w-auto text-center bg-lpk-gold hover:bg-opacity-90 text-lpk-charcoal font-extrabold px-8 py-4 rounded-full shadow-md transition-transform transform hover:-translate-y-0.5">
                            Jelajahi Program →
                        </a>
                    </div>

                    <!-- Mini Statistik Hero -->
                    <div class="pt-8 grid grid-cols-3 gap-4 border-t border-lpk-teal/15 max-w-md mx-auto lg:mx-0 text-left">
                        <div>
                            <div class="text-2xl sm:text-3xl font-extrabold text-lpk-teal">95%</div>
                            <div class="text-[11px] text-lpk-charcoal/70 font-semibold mt-0.5">Tingkat Kelulusan</div>
                        </div>
                        <div>
                            <div class="text-2xl sm:text-3xl font-extrabold text-lpk-teal">2,500+</div>
                            <div class="text-[11px] text-lpk-charcoal/70 font-semibold mt-0.5">Alumni Bekerja</div>
                        </div>
                        <div>
                            <div class="text-2xl sm:text-3xl font-extrabold text-lpk-gold">★ 4.7</div>
                            <div class="text-[11px] text-lpk-charcoal/70 font-semibold mt-0.5">Rating Peserta</div>
                        </div>
                    </div>
                </div>

                <!-- Sisi Kanan -->
                <div class="lg:col-span-6 relative">
                    <div class="grid grid-cols-2 gap-4 items-center">
                        <!-- Kiri Kolase -->
                        <div class="space-y-4">
                            <div class="bg-lpk-mint p-6 rounded-3xl border border-lpk-teal/10 aspect-[4/5] flex flex-col justify-between relative overflow-hidden group shadow-sm">
                                <span class="bg-lpk-teal text-lpk-bg text-[10px] font-extrabold px-2.5 py-1 rounded-full w-max">PRAKTEK NYATA</span>
                                <div>
                                    <div class="text-3xl mb-1">💻</div>
                                    <h4 class="font-bold text-lpk-teal text-sm">Lab Komputer & Coding Intensif</h4>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Kanan Kolase -->
                        <div class="space-y-4 pt-8">
                            <div class="bg-lpk-teal text-lpk-bg p-6 rounded-3xl aspect-[4/5] flex flex-col justify-between shadow-lg relative overflow-hidden">
                                <div class="absolute -right-10 -top-10 w-32 h-32 bg-lpk-gold/20 rounded-full blur-xl"></div>
                                <span class="text-lpk-gold text-xs font-mono">#Karier</span>
                                <div>
                                    <div class="text-3xl mb-2">🎓</div>
                                    <h4 class="font-extrabold text-lg leading-snug">Siap Kerja Dalam 3 Bulan Pelatihan</h4>
                                    <p class="text-lpk-bg/70 text-[11px] mt-2">Dukungan karir dan penyaluran kerja selamanya.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- BLOK KEUNGGULAN / STATISTIK -->
    <section class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-lpk-teal rounded-[2.5rem] p-8 sm:p-14 text-lpk-bg shadow-xl grid grid-cols-1 lg:grid-cols-12 gap-8 items-center relative overflow-hidden">
                <!-- Elemen Dekoratif -->
                <div class="absolute right-0 bottom-0 w-96 h-96 bg-lpk-gold/10 rounded-full blur-3xl pointer-events-none"></div>

                <div class="lg:col-span-6 space-y-4">
                    <span class="text-lpk-gold text-xs font-extrabold tracking-widest uppercase">MENGAPA MEMILIH KAMI?</span>
                    <h2 class="text-3xl sm:text-4xl font-extrabold tracking-tight leading-tight">
                        Peluang Tepat Mengubah Mimpi Menjadi Pencapaian Tanpa Batas.
                    </h2>
                    <p class="text-lpk-bg/80 text-sm leading-relaxed max-w-lg">
                        Didirikan dengan fokus pada keahlian praktis, LPK Karier Sukses menjembatani kesenjangan antara dunia pendidikan dengan kebutuhan nyata industri masa kini.
                    </p>
                </div>

                <div class="lg:col-span-6 grid grid-cols-2 gap-6 pt-4 lg:pt-0">
                    <div class="bg-lpk-charcoal/40 backdrop-blur-md p-6 rounded-3xl border border-lpk-bg/10">
                        <div class="text-4xl sm:text-5xl font-extrabold text-lpk-gold mb-2">30%</div>
                        <p class="text-xs text-lpk-bg/80 font-medium">Lebih cepat diserap dunia kerja dibanding pendidikan konvensional.</p>
                    </div>
                    <div class="bg-lpk-charcoal/40 backdrop-blur-md p-6 rounded-3xl border border-lpk-bg/10">
                        <div class="text-4xl sm:text-5xl font-extrabold text-lpk-bg mb-2">95%</div>
                        <p class="text-xs text-lpk-bg/80 font-medium">Alumni menilai kurikulum kami sangat relevan dengan industri.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- KATALOG KURSUS UNGGULAN -->
    <section class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-12">
                <div>
                    <span class="text-lpk-teal font-extrabold text-xs uppercase tracking-widest bg-lpk-mint px-3.5 py-1.5 rounded-full">Katalog Pelatihan</span>
                    <h2 class="text-3xl font-extrabold text-lpk-teal mt-3 tracking-tight">Program Kursus Unggulan</h2>
                    <p class="text-lpk-charcoal/70 text-sm mt-2 max-w-xl">Pilih program pelatihan yang dirancang khusus untuk mempercepat karir profesionalmu.</p>
                </div>
                <a href="{{ url('/kursus') }}" class="inline-flex items-center space-x-2 text-sm font-bold text-lpk-teal hover:text-lpk-gold mt-4 md:mt-0 transition-colors">
                    <span>Lihat Semua Program →</span>
                </a>
            </div>

            <!-- Grid Kartu Kursus -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($kursusUnggulan as $item)
                    <x-kartu-kursus :kursus="$item" />
                @empty
                    <div class="col-span-3 text-center py-12 bg-lpk-mint rounded-3xl border border-dashed border-lpk-teal/20">
                        <p class="text-lpk-charcoal/60 font-semibold">Belum ada data kursus unggulan.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection