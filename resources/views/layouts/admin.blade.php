<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') · LPK Karier Sukses</title>

    <!-- Font khusus Admin: Inter (beda dengan Plus Jakarta Sans di web publik) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['"Inter"', 'sans-serif'] },
                    colors: {
                        'admin-navy':   '#16332C', // Turunan gelap dari teal publik (#2f5850), bukan warna asing
                        'admin-navy-2': '#20463C', // Hover/active di sidebar
                        'admin-accent': '#d89f30', // Warm Gold - sama persis dgn warna CTA di web publik
                        'admin-accent-dark': '#b9841f',
                        'admin-accent-light': '#fbf1de',
                        'admin-bg':     '#f7f8f6', // Senada dgn lpk-bg publik (#f8f9f8)
                        'admin-text':   '#1c2826', // Sama dgn lpk-charcoal publik
                        'admin-muted':  '#6b7280',
                        'admin-border': '#e4e6e1',
                    }
                }
            }
        }
    </script>
</head>
<body class="font-sans antialiased bg-admin-bg text-admin-text min-h-screen flex">

    <!-- Sidebar -->
    <aside class="w-72 bg-admin-navy min-h-screen text-slate-300 flex flex-col fixed inset-y-0 left-0">
        <div class="px-6 py-6 border-b border-white/10">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-admin-accent flex items-center justify-center text-white font-extrabold text-lg">
                    LK
                </div>
                <div>
                    <p class="text-white font-bold leading-tight">LPK Karier Sukses</p>
                    <p class="text-xs text-slate-400 tracking-wide uppercase">Admin Panel</p>
                </div>
            </div>
        </div>

        <nav class="flex-1 px-4 py-6 space-y-1 overflow-y-auto">
            <p class="px-3 text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-2">Menu Utama</p>

            <a href="{{ route('admin.dashboard') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition
                      {{ request()->routeIs('admin.dashboard') ? 'bg-admin-accent text-white shadow-sm' : 'text-slate-300 hover:bg-admin-navy-2 hover:text-white' }}">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 13h4v8H3v-8Zm7-9h4v17h-4V4Zm7 5h4v12h-4V9Z"/>
                </svg>
                Dashboard
            </a>

            <a href="{{ route('admin.kategori.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition
                      {{ request()->routeIs('admin.kategori.*') ? 'bg-admin-accent text-white shadow-sm' : 'text-slate-300 hover:bg-admin-navy-2 hover:text-white' }}">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.59 13.41 11 3.83A2 2 0 0 0 9.59 3.24L4 3a1 1 0 0 0-1 1l.24 5.59a2 2 0 0 0 .58 1.41l9.59 9.59a2 2 0 0 0 2.83 0l4.35-4.35a2 2 0 0 0 0-2.83Z"/>
                    <circle cx="7.5" cy="7.5" r="1.2" fill="currentColor" stroke="none"/>
                </svg>
                Kategori
            </a>

            <a href="{{ route('admin.kursus.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition
                      {{ request()->routeIs('admin.kursus.*') ? 'bg-admin-accent text-white shadow-sm' : 'text-slate-300 hover:bg-admin-navy-2 hover:text-white' }}">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20M4 4.5A2.5 2.5 0 0 1 6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15Z"/>
                </svg>
                Kursus
            </a>

            <a href="{{ route('admin.enrollment.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition
                      {{ request()->routeIs('admin.enrollment.*') ? 'bg-admin-accent text-white shadow-sm' : 'text-slate-300 hover:bg-admin-navy-2 hover:text-white' }}">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2M9 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8Zm7 4h5m0 0-2-2m2 2-2 2"/>
                </svg>
                Enrollments
            </a>

            <p class="px-3 text-[11px] font-bold text-slate-500 uppercase tracking-wider mt-6 mb-2">Pengaturan</p>

            <a href="{{ route('admin.settings.edit') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition
                      {{ request()->routeIs('admin.settings.*') ? 'bg-admin-accent text-white shadow-sm' : 'text-slate-300 hover:bg-admin-navy-2 hover:text-white' }}">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.32 4.32a1.5 1.5 0 0 1 3.36 0l.1.5a1.5 1.5 0 0 0 2.19 1.02l.45-.25a1.5 1.5 0 0 1 2.05 2.05l-.25.45a1.5 1.5 0 0 0 1.02 2.2l.5.09a1.5 1.5 0 0 1 0 3.36l-.5.1a1.5 1.5 0 0 0-1.02 2.19l.25.45a1.5 1.5 0 0 1-2.05 2.05l-.45-.25a1.5 1.5 0 0 0-2.2 1.02l-.09.5a1.5 1.5 0 0 1-3.36 0l-.1-.5a1.5 1.5 0 0 0-2.19-1.02l-.45.25a1.5 1.5 0 0 1-2.05-2.05l.25-.45a1.5 1.5 0 0 0-1.02-2.2l-.5-.09a1.5 1.5 0 0 1 0-3.36l.5-.1a1.5 1.5 0 0 0 1.02-2.19l-.25-.45a1.5 1.5 0 0 1 2.05-2.05l.45.25a1.5 1.5 0 0 0 2.2-1.02l.09-.5Z"/>
                    <circle cx="12" cy="12" r="3"/>
                </svg>
                Edit Tentang Kami
            </a>
        </nav>

        <div class="px-4 py-4 border-t border-white/10">
            <a href="{{ route('profile.edit') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition
                      {{ request()->routeIs('profile.edit') ? 'bg-admin-accent text-white shadow-sm' : 'text-slate-300 hover:bg-admin-navy-2 hover:text-white' }}">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <circle cx="12" cy="8" r="4"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 20c0-4 4-6 8-6s8 2 8 6"/>
                </svg>
                Profil Saya
            </a>
            <a href="{{ route('beranda') }}" target="_blank"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-slate-400 hover:bg-admin-navy-2 hover:text-white transition">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H5a2 2 0 0 0-2 2v11a2 2 0 0 0 2 2h11a2 2 0 0 0 2-2v-5M15 3h6v6M10 14 21 3"/>
                </svg>
                Lihat Situs Publik
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-slate-400 hover:bg-red-500/10 hover:text-red-400 transition">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4M16 17l5-5-5-5M21 12H9"/>
                    </svg>
                    Keluar
                </button>
            </form>
        </div>
    </aside>

    <!-- Main -->
    <div class="flex-1 flex flex-col ml-72 min-h-screen">
        <!-- Topbar -->
        <header class="h-16 bg-white border-b border-admin-border flex items-center justify-between px-8 sticky top-0 z-10">
            <div>
                <p class="text-xs text-admin-muted">Admin Panel</p>
                <h1 class="text-base font-bold text-admin-text">@yield('page-title', 'Dashboard')</h1>
            </div>
            <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 group">
                <div class="w-9 h-9 rounded-full bg-admin-accent-light text-admin-accent flex items-center justify-center font-bold text-sm group-hover:ring-2 group-hover:ring-admin-accent/30 transition">
                    {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                </div>
                <div class="text-sm text-left">
                    <p class="font-semibold text-admin-text leading-tight group-hover:text-admin-accent transition">{{ auth()->user()->name ?? 'Admin' }}</p>
                    <p class="text-xs text-admin-muted leading-tight">Lihat profil</p>
                </div>
            </a>
        </header>

        <main class="flex-1 p-8">
            @yield('content')
        </main>
    </div>
</body>
</html>
