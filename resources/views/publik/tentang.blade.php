@extends('layouts.app')
@section('title', 'Tentang Kami')

@section('content')
<div class="py-16 bg-lpk-bg">
    <div class="max-w-4xl mx-auto px-6 space-y-12">
        <h1 class="text-4xl font-extrabold text-lpk-teal text-center">Tentang Kami</h1>

        <div class="grid md:grid-cols-2 gap-8">
            <div class="bg-white p-8 rounded-3xl border shadow-sm">
                <h2 class="text-xl font-bold text-lpk-teal mb-4">Visi Kami</h2>
                <p class="text-sm text-lpk-charcoal/80 leading-relaxed">
                    {{ \App\Models\Setting::where('key', 'tentang_visi')->first()->value ?? 'Visi belum diatur oleh admin.' }}
                </p>
            </div>
            <div class="bg-white p-8 rounded-3xl border shadow-sm">
                <h2 class="text-xl font-bold text-lpk-teal mb-4">Misi Kami</h2>
                <p class="text-sm text-lpk-charcoal/80 leading-relaxed">
                    {{ \App\Models\Setting::where('key', 'tentang_misi')->first()->value ?? 'Misi belum diatur oleh admin.' }}
                </p>
            </div>
        </div>
    </div>
</div>
@endsection