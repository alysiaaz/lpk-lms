@php
    $isAdmin = auth()->user()->role === 'admin';
    $labelClass = $isAdmin ? 'block text-sm font-semibold text-admin-text mb-1.5' : 'block text-xs font-bold text-lpk-charcoal mb-1';
    $inputClass = $isAdmin
        ? 'w-full border border-admin-border p-2.5 rounded-lg focus:ring-2 focus:ring-admin-accent focus:border-admin-accent outline-none'
        : 'w-full px-4 py-3 bg-lpk-bg text-lpk-charcoal text-sm font-medium rounded-2xl border border-lpk-teal/20 focus:outline-none focus:border-lpk-teal';
    $buttonClass = $isAdmin
        ? 'bg-admin-accent text-white px-6 py-2.5 rounded-lg font-semibold text-sm hover:bg-admin-accent-dark transition'
        : 'bg-lpk-teal hover:bg-lpk-charcoal text-lpk-bg font-extrabold px-6 py-3 rounded-2xl text-sm transition-all shadow-md';
    $ghostButtonClass = $isAdmin
        ? 'bg-admin-bg text-admin-muted px-4 py-2 rounded-lg font-semibold text-xs hover:bg-red-50 hover:text-red-600 transition'
        : 'bg-lpk-bg text-lpk-charcoal/70 px-4 py-2 rounded-xl font-bold text-xs hover:bg-red-50 hover:text-red-600 transition border border-lpk-teal/10';
    $headingClass = $isAdmin ? 'text-lg font-bold text-admin-text' : 'text-lg font-extrabold text-lpk-teal';
    $subClass = $isAdmin ? 'mt-1 text-sm text-admin-muted' : 'mt-1 text-xs text-lpk-charcoal/70 font-medium';
    $errorClass = 'text-red-600 text-xs mt-1 font-semibold';
    $ringClass = $isAdmin ? 'ring-admin-border' : 'ring-lpk-teal/15';
@endphp

<section>
    <header>
        <h2 class="{{ $headingClass }}">{{ __('Informasi Profil') }}</h2>
        <p class="{{ $subClass }}">{{ __('Perbarui foto, nama, dan alamat email akunmu.') }}</p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-5" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <!-- Foto Profil -->
        <div class="flex items-center gap-5">
            <img src="{{ $user->avatarUrl() }}" alt="Foto profil {{ $user->name }}"
                 class="w-16 h-16 rounded-full object-cover ring-2 {{ $ringClass }}"
                 id="avatar-preview">

            <div class="space-y-2">
                <label class="{{ $ghostButtonClass }} inline-block cursor-pointer">
                    Ganti Foto
                    <input type="file" name="avatar" id="avatar-input" accept="image/*" class="hidden">
                </label>
                <p id="avatar-filename" class="text-[11px] {{ $isAdmin ? 'text-admin-muted' : 'text-lpk-charcoal/50' }}"></p>
                @error('avatar') <p class="{{ $errorClass }}">{{ $message }}</p> @enderror
                <p class="text-[11px] {{ $isAdmin ? 'text-admin-muted' : 'text-lpk-charcoal/50' }}">JPG/PNG, maks 2MB.</p>
            </div>
        </div>

        <script>
            (function () {
                var input = document.getElementById('avatar-input');
                var preview = document.getElementById('avatar-preview');
                var filenameLabel = document.getElementById('avatar-filename');
                if (!input || !preview) return;

                input.addEventListener('change', function () {
                    if (!this.files || !this.files[0]) return;
                    var file = this.files[0];
                    preview.src = URL.createObjectURL(file);
                    if (filenameLabel) filenameLabel.textContent = file.name;
                });
            })();
        </script>

        <div>
            <label for="name" class="{{ $labelClass }}">Nama</label>
            <input id="name" name="name" type="text" class="{{ $inputClass }}" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
            @error('name') <p class="{{ $errorClass }}">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="email" class="{{ $labelClass }}">Email</label>
            <input id="email" name="email" type="email" class="{{ $inputClass }}" value="{{ old('email', $user->email) }}" required autocomplete="username">
            @error('email') <p class="{{ $errorClass }}">{{ $message }}</p> @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 {{ $isAdmin ? 'text-admin-text' : 'text-lpk-charcoal' }}">
                        {{ __('Alamat email kamu belum diverifikasi.') }}
                        <button form="send-verification" class="underline text-sm font-semibold {{ $isAdmin ? 'text-admin-accent hover:text-admin-accent-dark' : 'text-lpk-teal hover:text-lpk-gold' }}">
                            {{ __('Klik di sini untuk kirim ulang email verifikasi.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-semibold text-sm text-emerald-600">
                            {{ __('Link verifikasi baru telah dikirim ke email kamu.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4 pt-1">
            <button type="submit" class="{{ $buttonClass }}">{{ __('Simpan') }}</button>

            @if (session('status') === 'profile-updated')
                <p class="text-sm text-emerald-600 font-semibold">{{ __('Tersimpan.') }}</p>
            @endif
            @if (session('status') === 'avatar-removed')
                <p class="text-sm text-emerald-600 font-semibold">{{ __('Foto profil dihapus.') }}</p>
            @endif
        </div>
    </form>

    @if ($user->avatar)
        <form method="post" action="{{ route('profile.avatar.destroy') }}" class="mt-3" onsubmit="return confirm('Hapus foto profil? Akan diganti dengan avatar inisial.')">
            @csrf
            @method('delete')
            <button type="submit" class="text-xs font-bold text-red-500 hover:underline">Hapus foto profil</button>
        </form>
    @endif
</section>
