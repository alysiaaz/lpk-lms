<!DOCTYPE html>
<html lang="id">
<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: { extend: { colors: { 'lpk-teal': '#006D77', 'lpk-gold': '#E29578', 'lpk-bg': '#EDF6F9' } } }
        }
    </script>
</head>
<body class="bg-lpk-bg flex">
    <!-- Sidebar -->
    <aside class="w-64 bg-lpk-teal min-h-screen text-white p-6">
        <h2 class="text-2xl font-bold mb-10">LPK Karier Sukses</h2>
        <nav class="space-y-4">
            <a href="{{ route('admin.dashboard') }}" class="block p-3 hover:bg-lpk-gold rounded-xl">Dashboard</a>
            <a href="{{ route('admin.kategori.index') }}" class="block p-3 hover:bg-lpk-gold rounded-xl">Kategori</a>
            <a href="{{ route('admin.kursus.index') }}" class="block p-3 hover:bg-lpk-gold rounded-xl">Kursus</a>
            <a href="{{ route('admin.enrollment.index') }}" class="block p-3 hover:bg-lpk-gold rounded-xl">Enrollments</a>
            <a href="{{ route('admin.settings.edit') }}" class="block p-3 hover:bg-lpk-gold rounded-xl">Edit Tentang Kami</a>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-8">
        @yield('content')
    </main>
</body>
</html>