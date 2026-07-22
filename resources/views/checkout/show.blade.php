@extends('layouts.app')
@section('title', 'Checkout - ' . $kursus->judul)

@section('content')
<div class="max-w-5xl mx-auto px-6 py-12">
    <h1 class="text-2xl font-extrabold text-lpk-charcoal mb-8">Ringkasan Pesanan</h1>

    @if(session('success'))
        <div class="p-4 bg-emerald-50 text-emerald-700 border border-emerald-200 rounded-xl text-sm font-medium mb-6">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Detail kursus -->
        <div class="md:col-span-2 bg-white rounded-2xl border border-lpk-mint shadow-sm p-6">
            <div class="flex gap-4">
                <img src="{{ $kursus->thumbnail ? asset('storage/' . $kursus->thumbnail) : 'https://via.placeholder.com/120' }}"
                     alt="{{ $kursus->judul }}" class="w-28 h-28 rounded-xl object-cover shrink-0">
                <div>
                    <h2 class="text-lg font-bold text-lpk-charcoal">{{ $kursus->judul }}</h2>
                    <p class="text-sm text-lpk-charcoal/60 mt-1">{{ Str::limit($kursus->deskripsi ?? '', 120) }}</p>
                    <p class="text-lpk-gold font-bold mt-3">Rp {{ number_format($kursus->harga, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>

        <!-- Ringkasan & voucher -->
        <div class="bg-white rounded-2xl border border-lpk-mint shadow-sm p-6 h-fit">
            <h3 class="font-bold text-lpk-charcoal mb-4">Ringkasan</h3>

            <div class="space-y-2 text-sm">
                <div class="flex justify-between text-lpk-charcoal/70">
                    <span>Subtotal</span>
                    <span>Rp {{ number_format($kursus->harga, 0, ',', '.') }}</span>
                </div>

                @if($voucher)
                <div class="flex justify-between text-emerald-600">
                    <span>Diskon ({{ $voucher->kode }})</span>
                    <span>- Rp {{ number_format($diskon, 0, ',', '.') }}</span>
                </div>
                @endif
            </div>

            <div class="border-t border-lpk-mint mt-4 pt-4 flex justify-between items-center">
                <span class="font-bold text-lpk-charcoal">Total Akhir</span>
                <span class="font-extrabold text-lpk-gold text-lg">Rp {{ number_format($total, 0, ',', '.') }}</span>
            </div>

            <!-- Form voucher -->
            <div class="mt-6">
                <p class="text-sm font-semibold text-lpk-charcoal mb-2">Punya voucher?</p>

                @if($voucher)
                    <div class="flex items-center justify-between bg-lpk-mint/60 rounded-lg px-3 py-2">
                        <span class="text-sm font-semibold text-lpk-teal">{{ $voucher->kode }} terpasang</span>
                        <form action="{{ route('checkout.voucher.remove') }}" method="POST">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-xs text-red-600 font-semibold hover:underline">Hapus</button>
                        </form>
                    </div>
                @else
                    <form action="{{ route('checkout.voucher.apply') }}" method="POST" class="flex gap-2">
                        @csrf
                        <input type="hidden" name="kursus_id" value="{{ $kursus->id }}">
                        <input type="text" name="kode" placeholder="cth. MENTOR20"
                               class="flex-1 border border-lpk-mint rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-lpk-teal">
                        <button type="submit" class="bg-lpk-teal text-white text-sm font-semibold px-4 py-2 rounded-lg hover:bg-lpk-teal/90 transition">
                            Gunakan
                        </button>
                    </form>
                    @error('kode') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                    @if(session('voucher_error'))
                        <p class="text-red-600 text-xs mt-1">{{ session('voucher_error') }}</p>
                    @endif
                @endif
            </div>

            <!-- Checkout -->
            <form action="{{ route('checkout.store', $kursus) }}" method="POST" class="mt-6">
                @csrf
                <button type="submit" class="w-full bg-lpk-gold text-white font-bold py-3 rounded-lg hover:bg-lpk-gold/90 transition shadow-sm">
                    Checkout
                </button>
            </form>
        </div>
    </div>
</div>
@endsection