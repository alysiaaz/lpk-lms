@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <h2 class="text-3xl font-extrabold text-lpk-teal">Manajemen Kategori</h2>
        <a href="{{ route('admin.kategori.create') }}" class="bg-lpk-teal text-white px-6 py-2 rounded-xl hover:bg-lpk-gold transition">
            + Tambah Kategori
        </a>
    </div>

    @if(session('success'))
        <div class="p-3 bg-green-100 text-green-700 rounded-lg text-sm">{{ session('success') }}</div>
    @endif

    <div class="bg-white p-6 rounded-3xl shadow-sm border border-lpk-teal/10">
        <table class="w-full text-left">
            <thead>
                <tr class="text-lpk-teal uppercase text-xs font-bold">
                    <th class="p-4">No</th>
                    <th class="p-4">Nama Kategori</th>
                    <th class="p-4">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @forelse($kategoris as $index => $kategori)
                <tr>
                    <td class="p-4">{{ $index + 1 }}</td>
                    <td class="p-4">{{ $kategori->nama }}</td>
                    <td class="p-4 space-x-3">
                        <a href="{{ route('admin.kategori.edit', $kategori->id) }}" class="text-lpk-teal font-bold hover:underline">Edit</a>
                        <form action="{{ route('admin.kategori.destroy', $kategori->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus kategori {{ $kategori->nama }}?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-600 font-bold hover:underline">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="p-6 text-center text-gray-400">Belum ada kategori.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection