@extends('layouts.admin')
@section('page-title', 'Silabus Kursus')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <div>
            <a href="{{ route('admin.kursus.index') }}" class="text-sm text-admin-accent font-medium hover:underline">&larr; Kembali ke Daftar Kursus</a>
            <h1 class="text-2xl font-bold text-admin-text mt-1">Silabus: {{ $kursus->judul }}</h1>
        </div>
        <a href="{{ route('admin.kursus.modul.create', $kursus->id) }}" class="inline-flex items-center gap-2 bg-admin-accent text-white px-5 py-2.5 rounded-lg font-semibold text-sm hover:bg-admin-accent-dark transition shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14M5 12h14"/></svg>
            Tambah Modul
        </a>
    </div>

    @if(session('success'))
        <div class="p-3 bg-emerald-50 text-emerald-700 border border-emerald-200 rounded-lg text-sm font-medium">{{ session('success') }}</div>
    @endif

    <div class="bg-white rounded-2xl border border-admin-border shadow-sm overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-admin-bg text-admin-muted uppercase text-xs font-bold">
                <tr>
                    <th class="px-6 py-3.5">Urutan</th>
                    <th class="px-6 py-3.5">Judul Modul</th>
                    <th class="px-6 py-3.5">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-admin-border">
                @forelse($moduls as $modul)
                <tr class="hover:bg-admin-bg/60 transition">
                    <td class="px-6 py-4 text-sm text-admin-muted">{{ $modul->urutan }}</td>
                    <td class="px-6 py-4 font-semibold text-admin-text text-sm">{{ $modul->judul_modul }}</td>
                    <td class="px-6 py-4 space-x-3">
                        <a href="{{ route('admin.kursus.modul.materi.index', [$kursus->id, $modul->id]) }}" class="text-admin-accent font-semibold hover:underline text-sm">
                            Materi
                        </a>
                        <a href="{{ route('admin.kursus.modul.edit', [$kursus->id, $modul->id]) }}" class="text-admin-accent font-semibold hover:underline text-sm">
                            Edit
                        </a>
                        <form action="{{ route('admin.kursus.modul.destroy', [$kursus->id, $modul->id]) }}" method="POST" class="inline" onsubmit="return confirm('Hapus modul {{ $modul->judul_modul }}?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-600 font-semibold hover:underline text-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="px-6 py-10 text-center text-admin-muted text-sm">Belum ada modul untuk kursus ini.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
