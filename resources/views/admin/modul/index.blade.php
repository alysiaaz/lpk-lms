@extends('layouts.admin')
@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <div>
            <a href="{{ route('admin.kursus.index') }}" class="text-sm text-lpk-teal hover:underline">&larr; Kembali ke Daftar Kursus</a>
            <h1 class="text-3xl font-extrabold text-lpk-teal mt-1">Silabus: {{ $kursus->judul }}</h1>
        </div>
        <a href="{{ route('admin.kursus.modul.create', $kursus->id) }}" class="bg-lpk-teal text-white px-6 py-3 rounded-xl font-bold hover:bg-lpk-gold transition">
            + Tambah Modul
        </a>
    </div>

    @if(session('success'))
        <div class="p-3 bg-green-100 text-green-700 rounded-lg text-sm">{{ session('success') }}</div>
    @endif

    <div class="bg-white rounded-3xl shadow-sm border border-lpk-teal/10 overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-lpk-bg text-lpk-teal uppercase text-xs font-bold">
                <tr>
                    <th class="px-6 py-4">Urutan</th>
                    <th class="px-6 py-4">Judul Modul</th>
                    <th class="px-6 py-4">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-lpk-bg">
                @forelse($moduls as $modul)
                <tr class="hover:bg-lpk-bg/50 transition">
                    <td class="px-6 py-4">{{ $modul->urutan }}</td>
                    <td class="px-6 py-4 font-semibold">{{ $modul->judul_modul }}</td>
                    <td class="px-6 py-4 space-x-3">
                        <a href="{{ route('admin.kursus.modul.edit', [$kursus->id, $modul->id]) }}" class="text-lpk-teal font-bold hover:underline text-sm">
                            Edit
                        </a>
                        <form action="{{ route('admin.kursus.modul.destroy', [$kursus->id, $modul->id]) }}" method="POST" class="inline" onsubmit="return confirm('Hapus modul {{ $modul->judul_modul }}?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-600 font-bold hover:underline text-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="px-6 py-8 text-center text-gray-400">Belum ada modul untuk kursus ini.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
