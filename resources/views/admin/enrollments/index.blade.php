@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <h2 class="text-3xl font-extrabold text-lpk-teal">Data Pendaftaran Peserta</h2>

    @if(session('success'))
        <div class="p-3 bg-green-100 text-green-700 rounded-lg text-sm">{{ session('success') }}</div>
    @endif

    <div class="bg-white p-6 rounded-3xl shadow-sm border border-lpk-teal/10">
        <table class="w-full text-left">
            <thead>
                <tr class="text-lpk-teal uppercase text-xs font-bold">
                    <th class="p-4">No</th>
                    <th class="p-4">Nama Peserta</th>
                    <th class="p-4">Email</th>
                    <th class="p-4">Kursus</th>
                    <th class="p-4">Status</th>
                    <th class="p-4">Tanggal Daftar</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @forelse($enrollments as $index => $item)
                <tr>
                    <td class="p-4">{{ $index + 1 }}</td>
                    <td class="p-4 font-semibold">{{ $item->peserta->name }}</td>
                    <td class="p-4 text-gray-500">{{ $item->peserta->email }}</td>
                    <td class="p-4">{{ $item->kursus->judul }}</td>
                    <td class="p-4">
                        <span class="text-xs font-bold px-3 py-1 rounded-full {{ $item->status === 'aktif' ? 'bg-lpk-mint text-lpk-teal' : 'bg-gray-100 text-gray-600' }}">
                            {{ ucfirst($item->status) }}
                        </span>
                    </td>
                    <td class="p-4 text-gray-500 text-sm">{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y, H:i') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="p-6 text-center text-gray-400">Belum ada peserta yang mendaftar kursus.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
