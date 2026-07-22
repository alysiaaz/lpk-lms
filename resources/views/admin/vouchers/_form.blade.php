<div class="bg-white rounded-2xl border border-admin-border shadow-sm p-6 space-y-5">
    <div>
        <label class="block text-sm font-semibold text-admin-text mb-1.5">Kode Voucher</label>
        <input type="text" name="kode" value="{{ old('kode', $voucher?->kode ?? '') }}"
            class="w-full border border-admin-border rounded-lg px-4 py-2.5 text-sm text-admin-text focus:outline-none focus:ring-2 focus:ring-admin-accent"
            placeholder="cth. MENTOR20" required>
        @error('kode') <p class="text-red-600 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
    </div>

    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-semibold text-admin-text mb-1.5">Tipe Diskon</label>
            <select name="tipe" class="w-full border border-admin-border rounded-lg px-4 py-2.5 text-sm text-admin-text focus:outline-none focus:ring-2 focus:ring-admin-accent" required>
                <option value="persen" {{ old('tipe', $voucher?->tipe ?? '') === 'persen' ? 'selected' : '' }}>Persen (%)</option>
                <option value="nominal" {{ old('tipe', $voucher?->tipe ?? '') === 'nominal' ? 'selected' : '' }}>Nominal (Rp)</option>
            </select>
            @error('tipe') <p class="text-red-600 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-semibold text-admin-text mb-1.5">Nilai</label>
            <input type="number" name="nilai" value="{{ old('nilai', $voucher?->nilai ?? '') }}"
                class="w-full border border-admin-border rounded-lg px-4 py-2.5 text-sm text-admin-text focus:outline-none focus:ring-2 focus:ring-admin-accent" required>
            @error('nilai') <p class="text-red-600 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
        </div>
    </div>

    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-semibold text-admin-text mb-1.5">Kuota</label>
            <input type="number" name="kuota" value="{{ old('kuota', $voucher?->kuota ?? '') }}"
                class="w-full border border-admin-border rounded-lg px-4 py-2.5 text-sm text-admin-text focus:outline-none focus:ring-2 focus:ring-admin-accent"
                placeholder="Kosongkan jika tak terbatas">
            @error('kuota') <p class="text-red-600 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-semibold text-admin-text mb-1.5">Minimal Pembelian</label>
            <input type="number" name="min_pembelian" value="{{ old('min_pembelian', $voucher?->min_pembelian ?? 0) }}"
                class="w-full border border-admin-border rounded-lg px-4 py-2.5 text-sm text-admin-text focus:outline-none focus:ring-2 focus:ring-admin-accent">
            @error('min_pembelian') <p class="text-red-600 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
        </div>
    </div>

    <div>
        <label class="block text-sm font-semibold text-admin-text mb-1.5">Berlaku Sampai</label>
        <input type="date" name="berlaku_sampai" value="{{ old('berlaku_sampai', $voucher?->berlaku_sampai?->format('Y-m-d') ?? '') }}"
            class="w-full border border-admin-border rounded-lg px-4 py-2.5 text-sm text-admin-text focus:outline-none focus:ring-2 focus:ring-admin-accent">
        @error('berlaku_sampai') <p class="text-red-600 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
    </div>

    <label class="inline-flex items-center gap-2 cursor-pointer">
        <input type="checkbox" name="aktif" value="1" {{ old('aktif', $voucher?->aktif ?? true) ? 'checked' : '' }}
            class="w-4 h-4 rounded border-admin-border text-admin-accent focus:ring-admin-accent">
        <span class="text-sm font-medium text-admin-text">Aktifkan voucher</span>
    </label>
</div>