@extends('layouts.app')
@section('title', 'Tentang Kami')

@php
    $sejarah = \App\Models\Setting::where('key', 'tentang_sejarah')->value('value');
    $visi = \App\Models\Setting::where('key', 'tentang_visi')->value('value');
    $misi = \App\Models\Setting::where('key', 'tentang_misi')->value('value');
    $keunggulanRaw = \App\Models\Setting::where('key', 'tentang_keunggulan')->value('value');
    $keunggulanList = $keunggulanRaw ? array_filter(array_map('trim', explode("\n", $keunggulanRaw))) : [];
    $alamat = \App\Models\Setting::where('key', 'tentang_alamat')->value('value');
    $telepon = \App\Models\Setting::where('key', 'tentang_telepon')->value('value');
    $email = \App\Models\Setting::where('key', 'tentang_email')->value('value');
    $jamOperasional = \App\Models\Setting::where('key', 'tentang_jam_operasional')->value('value');
@endphp

@section('content')
<div class="py-16 bg-lpk-bg">
    <div class="max-w-4xl mx-auto px-6 space-y-12">
        <h1 class="text-4xl font-extrabold text-lpk-teal text-center">Tentang Kami</h1>

        <!-- SEJARAH -->
        <div class="bg-white p-8 rounded-3xl border shadow-sm">
            <h2 class="text-xl font-bold text-lpk-teal mb-4">Sejarah Kami</h2>
            <p class="text-sm text-lpk-charcoal/80 leading-relaxed">
                {{ $sejarah ?? 'Profil lembaga belum diatur oleh admin.' }}
            </p>
        </div>

        <!-- VISI MISI -->
        <div class="grid md:grid-cols-2 gap-8">
            <div class="bg-white p-8 rounded-3xl border shadow-sm">
                <h2 class="text-xl font-bold text-lpk-teal mb-4">Visi Kami</h2>
                <p class="text-sm text-lpk-charcoal/80 leading-relaxed">
                    {{ $visi ?? 'Visi belum diatur oleh admin.' }}
                </p>
            </div>
            <div class="bg-white p-8 rounded-3xl border shadow-sm">
                <h2 class="text-xl font-bold text-lpk-teal mb-4">Misi Kami</h2>
                <p class="text-sm text-lpk-charcoal/80 leading-relaxed">
                    {{ $misi ?? 'Misi belum diatur oleh admin.' }}
                </p>
            </div>
        </div>

        <!-- KEUNGGULAN -->
        @if(count($keunggulanList) > 0)
        <div class="bg-white p-8 rounded-3xl border shadow-sm">
            <h2 class="text-xl font-bold text-lpk-teal mb-6 text-center">Kenapa Memilih Kami?</h2>
            <div class="grid sm:grid-cols-2 gap-4">
                @foreach($keunggulanList as $poin)
                <div class="flex items-start gap-3 bg-lpk-mint/40 rounded-2xl p-4">
                    <span class="text-lpk-teal font-extrabold">✓</span>
                    <span class="text-sm text-lpk-charcoal/90">{{ $poin }}</span>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- KONTAK & LOKASI -->
        @if($alamat || $telepon || $email || $jamOperasional)
        <div class="bg-lpk-teal text-lpk-bg p-8 sm:p-10 rounded-3xl shadow-sm">
            <h2 class="text-xl font-bold mb-6">Kontak & Lokasi</h2>
            <div class="grid sm:grid-cols-2 gap-6 text-sm">
                @if($alamat)
                <div>
                    <p class="font-bold uppercase text-xs tracking-wider text-lpk-gold mb-1">Alamat</p>
                    <p class="leading-relaxed">{{ $alamat }}</p>
                </div>
                @endif
                @if($jamOperasional)
                <div>
                    <p class="font-bold uppercase text-xs tracking-wider text-lpk-gold mb-1">Jam Operasional</p>
                    <p class="leading-relaxed">{{ $jamOperasional }}</p>
                </div>
                @endif
                @if($telepon)
                <div>
                    <p class="font-bold uppercase text-xs tracking-wider text-lpk-gold mb-1">Telepon / WhatsApp</p>
                    <p class="leading-relaxed">{{ $telepon }}</p>
                </div>
                @endif
                @if($email)
                <div>
                    <p class="font-bold uppercase text-xs tracking-wider text-lpk-gold mb-1">Email</p>
                    <p class="leading-relaxed">{{ $email }}</p>
                </div>
                @endif
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
