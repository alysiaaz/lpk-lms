@extends('layouts.admin')
@section('page-title', 'Data Pendaftaran')

@section('content')
<div class="space-y-6">
    <div>
        <h2 class="text-2xl font-bold text-admin-text">Data Pendaftaran Peserta</h2>
        <p class="text-sm text-admin-muted mt-1">Semua peserta yang mendaftar ke kursus.</p>
    </div>

    @if(session('success'))
        <div class="p-3 bg-emerald-50 text-emerald-700 border border-emerald-200 rounded-lg text-sm font-medium">{{ session('success') }}</div>
    @endif

    <div class="bg-white rounded-2xl border border-admin-border shadow-sm overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-admin-bg">
                <tr class="text-admin-muted uppercase text-xs font-bold">
                    <th class="px-6 py-3.5">No</th>
                    <th class="px-6 py-3.5">Nama Peserta</th>
                    <th class="px-6 py-3.5">Email</th>
                    <th class="px-6 py-3.5">Kursus</th>
                    <th class="px-6 py-3.5">Status</th>
                    <th class="px-6 py-3.5">Tanggal Daftar</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-admin-border">
                @forelse($enrollments as $index => $item)
                <tr class="hover:bg-admin-bg/60 transition">
                    <td class="px-6 py-4 text-sm text-admin-muted">{{ $index + 1 }}</td>
                    <td class="px-6 py-4 font-semibold text-admin-text text-sm">{{ $item->peserta->name }}</td>
                    <td class="px-6 py-4 text-admin-muted text-sm">{{ $item->peserta->email }}</td>
                    <td class="px-6 py-4 text-sm">{{ $item->kursus->judul }}</td>
                    <td class="px-6 py-4">
                        <span class="text-xs font-bold px-3 py-1 rounded-full {{ $item->status === 'aktif' ? 'bg-emerald-50 text-emerald-700' : 'bg-gray-100 text-gray-600' }}">
                            {{ ucfirst($item->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-admin-muted text-sm">{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y, H:i') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-10 text-center text-admin-muted text-sm">Belum ada peserta yang mendaftar kursus.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
