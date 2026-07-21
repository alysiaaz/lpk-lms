@php $isAdmin = auth()->user()->role === 'admin'; @endphp
@extends($isAdmin ? 'layouts.admin' : 'layouts.app')
@section('title', 'Profil Saya - LPK Karier Sukses')
@section('page-title', 'Profil Saya')

@section('content')
<div class="{{ $isAdmin ? '' : 'py-12 bg-lpk-bg min-h-screen px-4 sm:px-6 lg:px-8' }}">
<div class="max-w-3xl mx-auto space-y-6">

    @unless($isAdmin)
        <div class="space-y-1">
            <h1 class="text-3xl font-extrabold text-lpk-teal">Profil Saya</h1>
            <p class="text-sm text-lpk-charcoal/70">Kelola informasi akun dan keamanan login kamu.</p>
        </div>
    @endunless

    <div class="{{ $isAdmin ? 'bg-white p-6 sm:p-8 rounded-2xl border border-admin-border shadow-sm' : 'bg-white p-6 sm:p-8 rounded-3xl border border-lpk-teal/10 shadow-sm' }}">
        <div class="max-w-xl">
            @include('profile.partials.update-profile-information-form')
        </div>
    </div>

    <div class="{{ $isAdmin ? 'bg-white p-6 sm:p-8 rounded-2xl border border-admin-border shadow-sm' : 'bg-white p-6 sm:p-8 rounded-3xl border border-lpk-teal/10 shadow-sm' }}">
        <div class="max-w-xl">
            @include('profile.partials.update-password-form')
        </div>
    </div>

    <div class="{{ $isAdmin ? 'bg-white p-6 sm:p-8 rounded-2xl border border-red-100 shadow-sm' : 'bg-white p-6 sm:p-8 rounded-3xl border border-red-100 shadow-sm' }}">
        <div class="max-w-xl">
            @include('profile.partials.delete-user-form')
        </div>
    </div>

</div>
</div>
@endsection
