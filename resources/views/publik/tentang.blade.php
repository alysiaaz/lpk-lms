@extends('layouts.app')
@section('title', 'Tentang LPK Karier Sukses')

@section('content')
<div class="py-16 bg-lpk-bg">
    <div class="max-w-4xl mx-auto px-6 space-y-12">
        
        <!-- Header -->
        <div class="text-center space-y-4">
            <h1 class="text-4xl font-extrabold text-lpk-teal tracking-tight">Tentang Kami</h1>
            <p class="text-lpk-charcoal/70 max-w-2xl mx-auto">LPK Karier Sukses adalah lembaga pelatihan digital di Kota Makassar yang berkomitmen menjembatani talenta muda dengan kebutuhan industri modern.</p>
        </div>

        <!-- Visi & Misi -->
        <div class="grid md:grid-cols-2 gap-8">
            <div class="bg-white p-8 rounded-3xl border shadow-sm">
                <h2 class="text-xl font-bold text-lpk-teal mb-4">Visi Kami</h2>
                <p class="text-sm text-lpk-charcoal/80 leading-relaxed">Menjadi lembaga pelatihan digital terdepan di Indonesia Timur yang mencetak SDM unggul dan siap kerja di kancah global.</p>
            </div>
            <div class="bg-white p-8 rounded-3xl border shadow-sm">
                <h2 class="text-xl font-bold text-lpk-teal mb-4">Misi Kami</h2>
                <ul class="text-sm text-lpk-charcoal/80 space-y-2 list-disc list-inside">
                    <li>Kurikulum berbasis kebutuhan industri.</li>
                    <li>Mentorship praktisi berpengalaman.</li>
                    <li>Program penyaluran kerja berkelanjutan.</li>
                </ul>
            </div>
        </div>

        <!-- Lokasi -->
        <div class="bg-lpk-teal text-white p-10 rounded-[2.5rem] text-center shadow-xl">
            <h2 class="text-2xl font-bold mb-4">Lokasi Kami</h2>
            <p class="text-lpk-bg/80">Jl. Anuang 21</p>
            <p class="text-lpk-bg/80">Sulawesi Selatan, Indonesia</p>
        </div>
    </div>
</div>
@endsection