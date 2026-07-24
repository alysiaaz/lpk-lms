<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sertifikat Kompetensi - {{ $kursus->judul }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Plus+Jakarta+Sans:wght@400;600;700&display=swap');
        .font-serif { font-family: 'Playfair Display', serif; }
        .font-sans { font-family: 'Plus Jakarta Sans', sans-serif; }
        @media print {
            @page { size: A4 landscape; margin: 0; }
            body { -webkit-print-color-adjust: exact; print-color-adjust: exact; background-color: white !important; }
            .no-print { display: none !important; }
            .print-area { width: 100vw; height: 100vh; display: flex; align-items: center; justify-content: center; margin: 0; padding: 0; }
            .certificate-box { box-shadow: none !important; border: 12px solid #16332C !important; }
        }
    </style>
</head>
<body class="bg-gray-100 font-sans min-h-screen flex flex-col items-center justify-center p-4">

    <!-- Tombol Navigasi -->
    <div class="no-print mb-8 flex gap-4">
        <a href="{{ route('peserta.kursus') }}" class="px-5 py-2.5 bg-gray-500 text-white font-semibold rounded-lg hover:bg-gray-600 transition">&larr; Kembali</a>
        <button onclick="window.print()" class="px-5 py-2.5 bg-[#16332C] text-white font-semibold rounded-lg hover:bg-[#20463C] transition shadow-lg">🖨️ Cetak Sertifikat & Nilai</button>
    </div>

    <!-- Area Sertifikat Model B -->
    <div class="print-area w-full max-w-5xl">
        <div class="certificate-box relative bg-white w-full aspect-[1.414/1] md:h-[700px] border-[12px] border-[#16332C] p-10 flex flex-col justify-between shadow-2xl overflow-hidden">
            
            <!-- Header -->
            <div class="text-center">
                <div class="w-12 h-12 bg-[#d89f30] rounded-lg mx-auto flex items-center justify-center text-white font-extrabold text-2xl mb-2">LK</div>
                <h1 class="text-3xl font-serif font-bold text-[#16332C] uppercase tracking-wider">Sertifikat Kompetensi & Hasil Belajar</h1>
                <p class="text-xs text-gray-500 tracking-[0.2em]">LPK KARIER SUKSES</p>
            </div>

            <!-- Konten Utama -->
            <div class="text-center my-auto">
                <p class="text-sm text-gray-600 mb-1">Diberikan kepada:</p>
                <h2 class="text-4xl font-serif font-bold text-[#d89f30] mb-3 italic">{{ $user->name }}</h2>
                <p class="text-sm text-gray-600 max-w-2xl mx-auto leading-relaxed mb-6">
                    Telah dinyatakan <strong class="text-emerald-700">KOMPETEN</strong> dan menyelesaikan seluruh rangkaian kegiatan pelatihan pada program <strong class="text-[#16332C]">{{ $kursus->judul }}</strong>.
                </p>

                <!-- Kotak Transkrip Nilai Ringkas -->
                <div class="max-w-md mx-auto bg-gray-50 border border-gray-200 rounded-xl p-4 grid grid-cols-2 gap-4 text-left shadow-sm">
                    <div>
                        <p class="text-[11px] text-gray-500 uppercase font-bold">Predikat Kelulusan</p>
                        <p class="text-sm font-bold text-[#16332C]">Sangat Memuaskan</p>
                    </div>
                    <div>
                        <p class="text-[11px] text-gray-500 uppercase font-bold">Nilai Evaluasi Akhir</p>
                        <p class="text-sm font-extrabold text-[#d89f30]">{{ $skor }} / 100</p>
                    </div>
                </div>
            </div>

            <!-- Footer Tanda Tangan -->
            <div class="flex justify-between items-end px-6">
                <div class="text-left">
                    <p class="text-xs text-gray-500">Diterbitkan di Makassar</p>
                    <p class="text-xs font-bold text-[#16332C]">{{ $tanggal_lulus }}</p>
                </div>
                <div class="text-center">
                    <p class="font-serif italic text-xl text-[#16332C] border-b border-gray-400 pb-1 px-6">Tim Asesor Penguji</p>
                    <p class="font-bold text-[10px] text-gray-500 uppercase tracking-wider mt-1">Authorized Signature</p>
                </div>
            </div>

        </div>
    </div>

    <script>
        window.onload = function() { setTimeout(() => window.print(), 1000); }
    </script>
</body>
</html>