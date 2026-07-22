@extends('layouts.admin')
@section('page-title', 'Voucher')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-admin-text">Voucher</h1>
            <p class="text-sm text-admin-muted">Kelola kode diskon untuk peserta</p>
        </div>
        <a href="{{ route('admin.vouchers.create') }}" class="inline-flex items-center gap-2 bg-admin-accent text-white px-5 py-2.5 rounded-lg font-semibold text-sm hover:bg-admin-accent-dark transition shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14M5 12h14"/></svg>
            Tambah Voucher
        </a>
    </div>

    @if(session('success'))
        <div class="p-3 bg-emerald-50 text-emerald-700 border border-emerald-200 rounded-lg text-sm font-medium">{{ session('success') }}</div>
    @endif

    <div class="bg-white rounded-2xl border border-admin-border shadow-sm overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-admin-bg text-admin-muted uppercase text-xs font-bold">
                <tr>
                    <th class="px-6 py-3.5">Kode</th>
                    <th class="px-6 py-3.5">Tipe</th>
                    <th class="px-6 py-3.5">Nilai</th>
                    <th class="px-6 py-3.5">Kuota</th>
                    <th class="px-6 py-3.5">Berlaku Sampai</th>
                    <th class="px-6 py-3.5">Status</th>
                    <th class="px-6 py-3.5">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-admin-border">
                @forelse($vouchers as $v)
                <tr class="hover:bg-admin-bg/60 transition">
                    <td class="px-6 py-4 font-semibold text-admin-text text-sm">{{ $v->kode }}</td>
                    <td class="px-6 py-4 text-sm text-admin-muted capitalize">{{ $v->tipe }}</td>
                    <td class="px-6 py-4 text-sm text-admin-text">
                        {{ $v->tipe === 'persen' ? $v->nilai.'%' : 'Rp'.number_format($v->nilai, 0, ',', '.') }}
                    </td>
                    <td class="px-6 py-4 text-sm text-admin-muted">
                        {{ $v->kuota ?? 'Tak terbatas' }} <span class="text-xs">({{ $v->terpakai }} terpakai)</span>
                    </td>
                    <td class="px-6 py-4 text-sm text-admin-muted">{{ $v->berlaku_sampai?->format('d M Y') ?? '-' }}</td>
                    <td class="px-6 py-4 text-sm">
                        <span class="inline-block px-2.5 py-1 rounded-full text-xs font-bold uppercase
                            {{ $v->aktif ? 'bg-emerald-50 text-emerald-700' : 'bg-red-50 text-red-700' }}">
                            {{ $v->aktif ? 'Aktif' : 'Nonaktif' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 space-x-3">
                        <a href="{{ route('admin.vouchers.edit', $v) }}" class="text-admin-accent font-semibold hover:underline text-sm">
                            Edit
                        </a>
                        <form action="{{ route('admin.vouchers.destroy', $v) }}" method="POST" class="inline" onsubmit="return confirm('Hapus voucher {{ $v->kode }}?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-600 font-semibold hover:underline text-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-10 text-center text-admin-muted text-sm">Belum ada voucher.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $vouchers->links() }}
</div>
@endsection