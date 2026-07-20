<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Kursus - Admin LPK</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
</head>
<body class="bg-slate-100 text-slate-800 antialiased flex min-h-screen">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-slate-900 text-white flex flex-col justify-between hidden md:flex shrink-0">
        <div class="p-6">
            <div class="flex items-center space-x-3 mb-8">
                <div class="w-8 h-8 bg-indigo-600 rounded-lg flex items-center justify-center font-bold text-lg">A</div>
                <span class="font-bold tracking-wider uppercase text-sm">Admin LPK</span>
            </div>
            <nav class="space-y-2 text-sm font-medium">
                <a href="{{ url('/admin/dashboard') }}" class="flex items-center space-x-3 text-slate-400 hover:bg-slate-800 hover:text-white px-4 py-3 rounded-xl transition-colors">
                    <span>📊</span><span>Dashboard</span>
                </a>
                <a href="{{ url('/admin/kursus') }}" class="flex items-center space-x-3 bg-indigo-600/20 text-indigo-400 px-4 py-3 rounded-xl font-bold">
                    <span>📚</span><span>Kelola Kursus</span>
                </a>
            </nav>
        </div>
        <div class="p-6 border-t border-slate-800">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full text-left text-red-400 hover:text-red-300 text-sm font-bold flex items-center space-x-2">
                    <span>🚪</span><span>Keluar Akun</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- KONTEN UTAMA -->
    <main class="flex-1 flex flex-col overflow-x-hidden">
        <header class="bg-white h-20 border-b border-slate-200 px-8 flex items-center justify-between">
            <h1 class="text-xl font-extrabold text-slate-800">Manajemen Program Pelatihan</h1>
            <a href="{{ route('admin.kursus.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold px-5 py-2.5 rounded-xl text-sm shadow-md transition-all">
                + Tambah Kursus Baru
            </a>
        </header>

        <div class="p-8 space-y-6">
            <!-- Notifikasi Sukses -->
            @if(session('success'))
                <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-6 py-4 rounded-2xl font-bold text-sm shadow-sm">
                    ✓ {{ session('success') }}
                </div>
            @endif

            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse text-sm">
                        <thead>
                            <tr class="bg-slate-50 text-slate-400 text-xs uppercase border-b border-slate-100">
                                <th class="py-4 px-6 font-bold">Judul Program</th>
                                <th class="py-4 px-6 font-bold">Kategori</th>
                                <th class="py-4 px-6 font-bold">Peserta Terdaftar</th>
                                <th class="py-4 px-6 font-bold text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 font-medium text-slate-700">
                            @forelse($kursus as $item)
                            <tr class="hover:bg-slate-50/80 transition-colors">
                                <td class="py-4 px-6 font-bold text-slate-900">{{ $item->judul }}</td>
                                <td class="py-4 px-6"><span class="bg-indigo-50 text-indigo-600 px-3 py-1 rounded-full text-xs font-bold">{{ $item->kategori->nama ?? 'Umum' }}</span></td>
                                <td class="py-4 px-6"><span class="font-extrabold text-slate-900">{{ $item->peserta_count }}</span> Siswa</td>
                                <td class="py-4 px-6 text-right space-x-2">
                                    <a href="{{ route('admin.kursus.edit', $item->id) }}" class="bg-amber-500 hover:bg-amber-600 text-white px-3 py-1.5 rounded-lg text-xs font-bold transition-colors">Edit</a>
                                    <form action="{{ route('admin.kursus.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus kursus ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1.5 rounded-lg text-xs font-bold transition-colors">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="py-12 text-center text-slate-400">Belum ada program kursus. Klik tombol "+ Tambah Kursus Baru" di atas.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</body>
</html>