@php
    $isAdmin = auth()->user()->role === 'admin';
    $labelClass = $isAdmin ? 'block text-sm font-semibold text-admin-text mb-1.5' : 'block text-xs font-bold text-lpk-charcoal mb-1';
    $inputClass = $isAdmin
        ? 'w-full border border-admin-border p-2.5 rounded-lg focus:ring-2 focus:ring-red-400 focus:border-red-400 outline-none'
        : 'w-full px-4 py-3 bg-lpk-bg text-lpk-charcoal text-sm font-medium rounded-2xl border border-red-200 focus:outline-none focus:border-red-400';
    $dangerButtonClass = $isAdmin
        ? 'bg-red-50 hover:bg-red-100 text-red-600 px-6 py-2.5 rounded-lg font-semibold text-sm transition'
        : 'bg-red-600 hover:bg-red-700 text-white font-extrabold px-6 py-3 rounded-2xl text-sm transition-all shadow-md';
    $headingClass = $isAdmin ? 'text-lg font-bold text-red-600' : 'text-lg font-extrabold text-red-600';
    $subClass = $isAdmin ? 'mt-1 text-sm text-admin-muted' : 'mt-1 text-xs text-lpk-charcoal/70 font-medium';
    $errorClass = 'text-red-600 text-xs mt-1 font-semibold';
@endphp

<section class="space-y-5">
    <header>
        <h2 class="{{ $headingClass }}">{{ __('Hapus Akun') }}</h2>
        <p class="{{ $subClass }}">{{ __('Setelah akun dihapus, semua data terkait akan hilang secara permanen. Unduh data yang ingin kamu simpan sebelum melanjutkan.') }}</p>
    </header>

    <form method="post" action="{{ route('profile.destroy') }}" class="space-y-4" onsubmit="return confirm('Yakin ingin menghapus akun ini? Tindakan ini tidak bisa dibatalkan.')">
        @csrf
        @method('delete')

        <div class="max-w-sm">
            <label for="password" class="{{ $labelClass }}">Masukkan password untuk konfirmasi</label>
            <input id="password" name="password" type="password" class="{{ $inputClass }}" placeholder="Password">
            @error('password', 'userDeletion') <p class="{{ $errorClass }}">{{ $message }}</p> @enderror
        </div>

        <button type="submit" class="{{ $dangerButtonClass }}">{{ __('Hapus Akun Saya') }}</button>
    </form>
</section>
