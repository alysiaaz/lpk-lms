@extends('layouts.app')
@section('title', 'Pengaturan Konten')

@section('content')
<div class="py-12 bg-lpk-bg min-h-screen">
    <div class="max-w-3xl mx-auto px-6">
        <div class="bg-white p-8 rounded-[2rem] shadow-lg border border-lpk-teal/10">
            <h1 class="text-2xl font-extrabold text-lpk-teal mb-6">Kelola Konten Halaman</h1>
            
            <form action="{{ route('admin.settings.update') }}" method="POST" class="space-y-6">
                @csrf @method('PUT')
                
                <div>
                    <label class="block text-xs font-bold text-lpk-charcoal mb-2">Visi Kami</label>
                    <textarea name="tentang_visi" rows="3" class="w-full p-4 rounded-2xl bg-lpk-bg border border-lpk-teal/20 focus:border-lpk-teal outline-none">{{ $settings['tentang_visi'] ?? '' }}</textarea>
                </div>

                <div>
                    <label class="block text-xs font-bold text-lpk-charcoal mb-2">Misi Kami</label>
                    <textarea name="tentang_misi" rows="4" class="w-full p-4 rounded-2xl bg-lpk-bg border border-lpk-teal/20 focus:border-lpk-teal outline-none">{{ $settings['tentang_misi'] ?? '' }}</textarea>
                </div>

                <button type="submit" class="w-full bg-lpk-teal text-lpk-bg py-3 rounded-2xl font-extrabold hover:bg-lpk-charcoal transition">
                    Simpan Perubahan
                </button>
            </form>
        </div>
    </div>
</div>
@endsection