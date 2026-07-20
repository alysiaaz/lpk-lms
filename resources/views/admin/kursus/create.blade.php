<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kursus Baru - Admin LPK</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
</head>
<body class="bg-slate-100 text-slate-800 antialiased p-8">
    <div class="max-w-2xl mx-auto bg-white p-8 rounded-3xl border border-slate-200 shadow-sm space-y-6">
        <div class="flex items-center justify-between border-b border-slate-100 pb-4">
            <h1 class="text-xl font-extrabold text-slate-900">Tambah Program Pelatihan Baru</h1>
            <a href="{{ route('admin.kursus.index') }}" class="text-xs font-bold text-slate-500 hover:text-slate-900">← Kembali</a>
        </div>

        @if($errors->any())
            <div class="bg-red-50 text-red-600 p-4 rounded-2xl text-xs font-bold">
                ● {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('admin.kursus.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Judul Program Pelatihan</label>
                <input type="text" name="judul" value="{{ old('judul') }}" required placeholder="Contoh: Master UI/UX Design dengan Figma" 
                       class="w-full px-4 py-3 bg-slate-50 text-slate-800 text-sm font-medium rounded-2xl border border-slate-200 focus:outline-none focus:border-indigo-600">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Kategori Program</label>
                <select name="kategori_id" required class="w-full px-4 py-3 bg-slate-50 text-slate-800 text-sm font-medium rounded-2xl border border-slate-200 focus:outline-none focus:border-indigo-600">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($kategoris as $kat)
                        <option value="{{ $kat->id }}">{{ $kat->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Deskripsi & Silabus Singkat</label>
                <textarea name="deskripsi" rows="5" required placeholder="Jelaskan apa yang akan dipelajari dalam program ini..." 
                          class="w-full px-4 py-3 bg-slate-50 text-slate-800 text-sm font-medium rounded-2xl border border-slate-200 focus:outline-none focus:border-indigo-600">{{ old('deskripsi') }}</textarea>
            </div>

            <div class="pt-4 flex justify-end space-x-3">
                <a href="{{ route('admin.kursus.index') }}" class="px-6 py-3 bg-slate-100 hover:bg-slate-200 text-slate-600 text-sm font-bold rounded-2xl transition-colors">Batal</a>
                <button type="submit" class="px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-bold rounded-2xl shadow-md transition-all">Simpan Kursus 🚀</button>
            </div>
        </form>
    </div>
</body>
</html>