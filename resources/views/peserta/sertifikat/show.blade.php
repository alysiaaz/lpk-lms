<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sertifikat - {{ $kursus->judul }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Plus+Jakarta+Sans:wght@400;600;700&display=swap');
        
        .font-serif { font-family: 'Playfair Display', serif; }
        .font-sans { font-family: 'Plus Jakarta Sans', sans-serif; }

        /* Konfigurasi Khusus Mode Cetak (Print) */
        @media print {
            @page { 
                size: A4 landscape; /* Memaksa kertas Landscape */
                margin: 0; 
            }
            body { 
                -webkit-print-color-adjust: exact; 
                print-color-adjust: exact; 
                background-color: white !important; 
            }
            /* Sembunyikan elemen yang tidak perlu diprint (tombol, dll) */
            .no-print { display: none !important; }
            
            /* Pusatkan sertifikat di tengah kertas */
            .print-area { 
                width: 100vw; 
                height: 100vh; 
                display: flex; 
                align-items: center; 
                justify-content: center; 
                margin: 0;
                padding: 0;
            }
            /* Menghilangkan shadow saat diprint agar lebih bersih */
            .certificate-box {
                box-shadow: none !important;
                border: 12px solid #16332C !important;
            }
        }
    </style>
</head>
<body class="bg-gray-100 font-sans min-h-screen flex flex-col items-center justify-center p-4">

    <!-- Tombol Navigasi (Sembunyi saat diprint) -->
    <div class="no-print mb-8 flex gap-4">
        <a href="{{ route('peserta.kursus') }}" class="px-5 py-2.5 bg-gray-500 text-white font-semibold rounded-lg hover:bg-gray-600 transition">
            &larr; Kembali
        </a>
        <button onclick="window.print()" class="px-5 py-2.5 bg-[#16332C] text-white font-semibold rounded-lg hover:bg-[#20463C] transition flex items-center gap-2 shadow-lg">
            <span>🖨️</span> Cetak / Simpan PDF
        </button>
    </div>

    <!-- Area Sertifikat -->
    <div class="print-area w-full max-w-5xl">
        <!-- Bingkai Luar -->
        <div class="certificate-box relative bg-white w-full aspect-[1.414/1] md:h-[700px] border-[12px] border-[#16332C] p-12 flex flex-col items-center justify-center text-center shadow-2xl overflow-hidden">
            
            <!-- Ornamen Sudut -->
            <div class="absolute top-0 left-0 w-40 h-40 border-t-[10px] border-l-[10px] border-[#d89f30] m-6"></div>
            <div class="absolute bottom-0 right-0 w-40 h-40 border-b-[10px] border-r-[10px] border-[#d89f30] m-6"></div>

            <!-- Logo -->
            <div class="w-16 h-16 bg-[#d89f30] rounded-xl flex items-center justify-center text-white font-extrabold text-3xl mb-6">
                LK
            </div>

            <!-- Header -->
            <h1 class="text-4xl md:text-5xl font-serif font-bold text-[#16332C] mb-2 uppercase tracking-widest">Sertifikat Penyelesaian</h1>
            <p class="text-gray-500 font-semibold tracking-[0.3em] mb-12">LPK KARIER SUKSES</p>

            <!-- Konten -->
            <p class="text-lg text-gray-700 mb-3">Diberikan dengan penuh kebanggaan kepada:</p>
            <h2 class="text-5xl md:text-6xl font-serif font-bold text-[#d89f30] mb-8 italic">{{ $user->name }}</h2>
            <p class="text-lg text-gray-700 max-w-3xl mx-auto leading-relaxed mb-16">
                Atas keberhasilannya menyelesaikan seluruh materi pelatihan, praktik, dan evaluasi dengan baik pada program kursus keahlian 
                <strong class="text-[#16332C] text-xl">{{ $kursus->judul }}</strong>.
            </p>

            <!-- Footer / Tanda Tangan -->
            <div class="w-full max-w-4xl flex justify-between items-end px-12 mt-auto">
                <!-- Tanggal -->
                <div class="text-center">
                    <p class="text-gray-600 mb-4 border-b-2 border-gray-400 pb-2 px-8 inline-block">Makassar, {{ $tanggal_lulus }}</p>
                    <p class="font-bold text-[#16332C] uppercase tracking-wider text-sm">Tanggal Diterbitkan</p>
                </div>
                
                <!-- Badge Lulus -->
                <div class="w-28 h-28 bg-amber-50 border-4 border-[#d89f30] rounded-full flex items-center justify-center flex-col shadow-inner absolute left-1/2 -translate-x-1/2 bottom-12">
                    <span class="text-sm font-bold text-[#d89f30] tracking-wider mb-1">LULUS</span>
                    <span class="text-3xl">🏆</span>
                </div>

                <!-- TTD -->
                <div class="text-center">
                    <p class="font-serif italic text-3xl text-[#16332C] mb-2 border-b-2 border-gray-400 pb-1 px-8 inline-block">Pimpinan Utama</p>
                    <p class="font-bold text-[#16332C] uppercase tracking-wider text-sm">Direktur LPK</p>
                </div>
            </div>

        </div>
    </div>

    <!-- Script Pemicu Print Otomatis -->
    <script>
        window.onload = function() {
            setTimeout(function() {
                window.print();
            }, 1000); // Otomatis muncul dialog print 1 detik setelah halaman siap
        }
    </script>
</body>
</html>