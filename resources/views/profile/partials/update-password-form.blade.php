@php
    $isAdmin = auth()->user()->role === 'admin';
    $labelClass = $isAdmin ? 'block text-sm font-semibold text-admin-text mb-1.5' : 'block text-xs font-bold text-lpk-charcoal mb-1';
    $inputClass = $isAdmin
        ? 'w-full border border-admin-border p-2.5 rounded-lg focus:ring-2 focus:ring-admin-accent focus:border-admin-accent outline-none'
        : 'w-full px-4 py-3 bg-lpk-bg text-lpk-charcoal text-sm font-medium rounded-2xl border border-lpk-teal/20 focus:outline-none focus:border-lpk-teal';
    $buttonClass = $isAdmin
        ? 'bg-admin-accent text-white px-6 py-2.5 rounded-lg font-semibold text-sm hover:bg-admin-accent-dark transition'
        : 'bg-lpk-teal hover:bg-lpk-charcoal text-lpk-bg font-extrabold px-6 py-3 rounded-2xl text-sm transition-all shadow-md';
    $headingClass = $isAdmin ? 'text-lg font-bold text-admin-text' : 'text-lg font-extrabold text-lpk-teal';
    $subClass = $isAdmin ? 'mt-1 text-sm text-admin-muted' : 'mt-1 text-xs text-lpk-charcoal/70 font-medium';
    $errorClass = 'text-red-600 text-xs mt-1 font-semibold';
@endphp

<section>
    <header>
        <h2 class="{{ $headingClass }}">{{ __('Ubah Password') }}</h2>
        <p class="{{ $subClass }}">{{ __('Pastikan akunmu memakai password yang panjang dan acak agar tetap aman.') }}</p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-5">
        @csrf
        @method('put')

        <div>
            <label for="update_password_current_password" class="{{ $labelClass }}">Password Saat Ini</label>
            <input id="update_password_current_password" name="current_password" type="password" class="{{ $inputClass }}" autocomplete="current-password">
            @error('current_password', 'updatePassword') <p class="{{ $errorClass }}">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="update_password_password" class="{{ $labelClass }}">Password Baru</label>
            <input id="update_password_password" name="password" type="password" class="{{ $inputClass }}" autocomplete="new-password">
            @error('password', 'updatePassword') <p class="{{ $errorClass }}">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="update_password_password_confirmation" class="{{ $labelClass }}">Konfirmasi Password</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="{{ $inputClass }}" autocomplete="new-password">
            @error('password_confirmation', 'updatePassword') <p class="{{ $errorClass }}">{{ $message }}</p> @enderror
        </div>

        <div class="flex items-center gap-4 pt-1">
            <button type="submit" class="{{ $buttonClass }}">{{ __('Simpan') }}</button>

            @if (session('status') === 'password-updated')
                <p class="text-sm text-emerald-600 font-semibold">{{ __('Tersimpan.') }}</p>
            @endif
        </div>
    </form>
</section>
