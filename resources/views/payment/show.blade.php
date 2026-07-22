@extends('layouts.app')
@section('title', 'Pembayaran - ' . $order->kode_order)

@section('content')
<div class="max-w-2xl mx-auto px-6 py-12">
    <div class="bg-white rounded-2xl border border-lpk-mint shadow-sm p-8 text-center">
        <p class="text-sm text-lpk-charcoal/60">Order #{{ $order->kode_order }}</p>
        <h1 class="text-2xl font-extrabold text-lpk-charcoal mt-1">{{ $order->kursus->judul }}</h1>
        <p class="text-3xl font-extrabold text-lpk-gold mt-4">Rp {{ number_format($order->total, 0, ',', '.') }}</p>

        <div class="mt-8 flex flex-col items-center">
            <p class="text-sm font-semibold text-lpk-charcoal mb-3">Scan QRIS untuk membayar</p>

            <!-- QRIS statis (dummy, belum terhubung payment gateway asli) -->
            <div class="w-56 h-56 bg-white border-2 border-lpk-teal rounded-2xl p-3 shadow-sm">
                <svg viewBox="0 0 100 100" class="w-full h-full">
                    <rect width="100" height="100" fill="white"/>
                    <rect x="5" y="5" width="20" height="20" fill="#1c2826"/>
                    <rect x="10" y="10" width="10" height="10" fill="white"/>
                    <rect x="75" y="5" width="20" height="20" fill="#1c2826"/>
                    <rect x="80" y="10" width="10" height="10" fill="white"/>
                    <rect x="5" y="75" width="20" height="20" fill="#1c2826"/>
                    <rect x="10" y="80" width="10" height="10" fill="white"/>
                    <rect x="35" y="10" width="5" height="5" fill="#1c2826"/>
                    <rect x="45" y="15" width="5" height="5" fill="#1c2826"/>
                    <rect x="55" y="10" width="5" height="5" fill="#1c2826"/>
                    <rect x="35" y="35" width="5" height="5" fill="#1c2826"/>
                    <rect x="45" y="40" width="5" height="5" fill="#1c2826"/>
                    <rect x="55" y="35" width="5" height="5" fill="#1c2826"/>
                    <rect x="65" y="45" width="5" height="5" fill="#1c2826"/>
                    <rect x="30" y="55" width="5" height="5" fill="#1c2826"/>
                    <rect x="40" y="60" width="5" height="5" fill="#1c2826"/>
                    <rect x="60" y="60" width="5" height="5" fill="#1c2826"/>
                    <rect x="70" y="65" width="5" height="5" fill="#1c2826"/>
                    <rect x="35" y="75" width="5" height="5" fill="#1c2826"/>
                    <rect x="55" y="80" width="5" height="5" fill="#1c2826"/>
                    <rect x="65" y="75" width="5" height="5" fill="#1c2826"/>
                </svg>
            </div>
        </div>

        <div class="mt-8 pt-6 border-t border-lpk-mint text-left">
            <p class="text-sm font-semibold text-lpk-charcoal mb-2">Atau transfer ke Virtual Account</p>
            <div class="bg-lpk-mint/60 rounded-xl px-4 py-3 flex justify-between items-center">
                <div>
                    <p class="text-xs text-lpk-charcoal/60">Bank BCA Virtual Account</p>
                    <p class="font-bold text-lpk-teal text-lg tracking-wider">8808{{ str_pad($order->id, 10, '0', STR_PAD_LEFT) }}</p>
                </div>
            </div>
        </div>

        <form action="{{ route('payment.confirm', $order) }}" method="POST" class="mt-8">
            @csrf
            <button type="submit" class="w-full bg-lpk-gold text-white font-bold py-3 rounded-lg hover:bg-lpk-gold/90 transition shadow-sm">
                Saya Sudah Bayar
            </button>
            <p class="text-xs text-lpk-charcoal/50 mt-2">*Simulasi pembayaran — klik ini untuk melanjutkan proses enroll</p>
        </form>
    </div>
</div>
@endsection