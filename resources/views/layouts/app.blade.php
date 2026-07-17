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
                        indigo: { 600: '#4F46E5', 700: '#4338CA', 800: '#3730A3', 900: '#312E81' },
                        amber: { 500: '#F59E0B' }
                    }
                }
            }
        }
    </script>
</head>
<body class="font-sans text-slate-800 antialiased bg-slate-50 min-h-screen flex flex-col justify-between">
    @include('partials.navbar')
    <main class="flex-grow">
        @yield('content')
    </main>
    @include('partials.footer')
</body>
</html>