@extends('layouts.app')
@section('title', $ujian->judul . ' - LPK Karier Sukses')

@section('content')
<div class="py-12 bg-lpk-bg min-h-screen">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

        <!-- Tombol Kembali -->
        <div>
            <a href="{{ route('peserta.materi.index', $ujian->kursus_id) }}" class="text-sm font-bold text-lpk-teal hover:underline">&larr; Kembali ke Daftar Materi</a>
        </div>

        <!-- Header Ujian -->
        <div class="bg-white rounded-3xl p-8 border border-lpk-teal/10 shadow-sm space-y-4">
            <div class="flex items-center gap-2">
                <span class="inline-block bg-lpk-gold/30 text-lpk-charcoal font-extrabold text-xs px-3 py-1 rounded-full uppercase tracking-wider border border-lpk-gold">
                    {{ $ujian->tipe === 'pre-test' ? '📝 Pre-Test' : '🎓 Post-Test' }}
                </span>
                <span class="text-xs font-bold text-gray-500">⏱️ Durasi: {{ $ujian->waktu_menit }} Menit</span>
            </div>
            <h1 class="text-3xl font-extrabold text-lpk-teal">{{ $ujian->judul }}</h1>
            @if($ujian->deskripsi)
                <p class="text-sm text-lpk-charcoal/70 leading-relaxed">{{ $ujian->deskripsi }}</p>
            @endif
        </div>

        <!-- Notifikasi & Hasil Skor (Jika sudah pernah dikerjakan) -->
        @if(session('success'))
            <div class="bg-green-100 border border-green-300 text-green-800 p-6 rounded-3xl text-center space-y-2 shadow-sm">
                <p class="text-2xl font-extrabold">🎉 {{ session('success') }}</p>
                <p class="text-sm">Kamu bisa meneruskan pembelajaran atau mengerjakan ulang jika ingin memperbaiki nilai.</p>
            </div>
        @elseif($nilai)
            <div class="bg-lpk-mint/50 border border-lpk-teal/20 p-6 rounded-3xl flex items-center justify-between gap-4 shadow-sm">
                <div>
                    <p class="text-xs font-bold uppercase tracking-wider text-lpk-teal">Status Ujian</p>
                    <p class="text-sm font-semibold text-lpk-charcoal">Kamu sudah mengerjakan ujian ini sebelumnya.</p>
                </div>
                <div class="bg-white px-6 py-3 rounded-2xl border border-lpk-teal/10 text-center shrink-0">
                    <p class="text-xs text-gray-400 font-bold uppercase">Skor Kamu</p>
                    <p class="text-2xl font-black text-lpk-teal">{{ $nilai->skor }} <span class="text-xs font-normal text-gray-500">/ 100</span></p>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-50 border border-red-200 text-red-600 p-4 rounded-2xl text-sm font-semibold">
                {{ session('error') }}
            </div>
        @endif

        <!-- Form Soal Ujian -->
        <form action="{{ route('peserta.ujian.submit', $ujian->id) }}" method="POST" class="space-y-6">
            @csrf
            
            @forelse($ujian->soals as $soal)
                <div class="bg-white rounded-3xl border border-lpk-teal/10 p-6 sm:p-8 shadow-sm space-y-6">
                    <!-- Pertanyaan -->
                    <div class="flex items-start gap-4">
                        <span class="shrink-0 bg-lpk-mint text-lpk-teal font-extrabold text-sm w-9 h-9 rounded-full flex items-center justify-center border border-lpk-teal/20">{{ $loop->iteration }}</span>
                        <h3 class="text-base sm:text-lg font-bold text-lpk-teal pt-1">{{ $soal->pertanyaan }}</h3>
                    </div>

                    <!-- Pilihan Ganda (Opsi) -->
                    <div class="space-y-3 sm:pl-13">
                        @foreach($soal->opsis as $opsi)
                            <label class="flex items-center gap-3.5 p-4 rounded-2xl border border-gray-200 hover:border-lpk-teal hover:bg-lpk-mint/20 cursor-pointer transition group">
                                <input type="radio" name="soal_{{ $soal->id }}" value="{{ $opsi->id }}" class="w-4 h-4 text-lpk-teal focus:ring-lpk-teal border-gray-300" required>
                                <span class="text-sm font-medium text-lpk-charcoal group-hover:text-lpk-teal transition">{{ $opsi->teks_pilihan }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
            @empty
                <div class="bg-white rounded-3xl border border-lpk-teal/10 p-12 text-center space-y-3">
                    <p class="text-4xl">📋</p>
                    <p class="font-bold text-lpk-teal text-lg">Soal Ujian Belum Dibuat</p>
                    <p class="text-sm text-gray-500">Instruktur atau admin belum menambahkan butir soal untuk ujian ini.</p>
                </div>
            @endforelse

            @if($ujian->soals->isNotEmpty())
                <div class="flex justify-end pt-4">
                    <button type="submit" class="bg-lpk-teal hover:bg-opacity-90 text-white font-extrabold text-sm px-8 py-4 rounded-full shadow-md hover:shadow-lg transition-all flex items-center gap-2">
                        <span>Kumpulkan Jawaban</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </button>
                </div>
            @endif
        </form>

    </div>
</div>
@endsection