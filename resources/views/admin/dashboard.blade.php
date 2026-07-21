@extends('layouts.admin')
@section('page-title', 'Dashboard')

@section('content')
<div class="mb-6">
    <h2 class="text-2xl font-bold text-admin-text">Ringkasan</h2>
    <p class="text-sm text-admin-muted mt-1">Statistik singkat aktivitas platform hari ini.</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <div class="bg-white p-6 rounded-2xl border border-admin-border shadow-sm">
        <div class="flex items-center justify-between mb-4">
            <p class="text-sm font-medium text-admin-muted">Total Kursus</p>
            <div class="w-10 h-10 rounded-xl bg-admin-accent-light flex items-center justify-center text-admin-accent">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20M4 4.5A2.5 2.5 0 0 1 6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15Z"/>
                </svg>
            </div>
        </div>
        <h3 class="text-3xl font-extrabold text-admin-text">{{ $totalKursus }}</h3>
    </div>

    <div class="bg-white p-6 rounded-2xl border border-admin-border shadow-sm">
        <div class="flex items-center justify-between mb-4">
            <p class="text-sm font-medium text-admin-muted">Total Peserta</p>
            <div class="w-10 h-10 rounded-xl bg-amber-50 flex items-center justify-center text-amber-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2M9 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8Zm7 4h5m0 0-2-2m2 2-2 2"/>
                </svg>
            </div>
        </div>
        <h3 class="text-3xl font-extrabold text-admin-text">{{ $totalPeserta }}</h3>
    </div>

    <div class="bg-white p-6 rounded-2xl border border-admin-border shadow-sm">
        <div class="flex items-center justify-between mb-4">
            <p class="text-sm font-medium text-admin-muted">Total Kategori</p>
            <div class="w-10 h-10 rounded-xl bg-emerald-50 flex items-center justify-center text-emerald-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.59 13.41 11 3.83A2 2 0 0 0 9.59 3.24L4 3a1 1 0 0 0-1 1l.24 5.59a2 2 0 0 0 .58 1.41l9.59 9.59a2 2 0 0 0 2.83 0l4.35-4.35a2 2 0 0 0 0-2.83Z"/>
                </svg>
            </div>
        </div>
        <h3 class="text-3xl font-extrabold text-admin-text">{{ $totalKategori }}</h3>
    </div>
</div>
@endsection
