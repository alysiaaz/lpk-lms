<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'LPK Karier Sukses - Pelatihan Kerja Modern')</title>
    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['"Plus Jakarta Sans"', 'sans-serif'] },
                    colors: {
                        'lpk-teal': '#2f5850',     // Deep Teal (Warna Utama)
                        'lpk-gold': '#d89f30',     // Warm Gold (CTA & Sorotan)
                        'lpk-charcoal': '#1c2826', // Charcoal Slate (Teks Utama)
                        'lpk-bg': '#f8f9f8',       // Crisp Slate White (Latar Belakang)
                        'lpk-mint': '#e3edea',     // Pale Mint (Warna Sekunder/Kartu)
                    }
                }
            }
        }
    </script>
</head>
<body class="font-sans text-lpk-charcoal antialiased bg-lpk-bg min-h-screen flex flex-col justify-between">
    @include('partials.navbar')
    <main class="flex-grow">
        @yield('content')
    </main>
    @include('partials.footer')
</body>
</html>