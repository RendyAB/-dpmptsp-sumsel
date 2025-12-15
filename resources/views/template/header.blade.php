<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>@yield('title', 'Website DPMPTSP Sumatera Selatan')</title>
    <link rel="icon" href="{{ asset('img/logo-dpmptsp.png') }}" type="image/png">
</head>

<body class="flex flex-col min-h-screen">
    <!-- HEADER NAV -->
    <nav class="bg-blue-900 sticky top-0 z-50">
        <div class="container mx-auto flex flex-wrap justify-center md:justify-between items-center gap-4 px-4 py-3">
            <div class="flex-shrink-0">
                <img src="{{ asset('img/logo-dpmptsp.png') }}" alt="Logo DPMPTSP" class="h-20 md:h-10 inline">
                <a href="/" class="text-white font-bold text-lg">DPMPTSP Sumatera Selatan</a>
            </div>
            <div class="flex flex-wrap gap-10 justify-center md:justify-end">
                <a href="/" class="text-white hover:text-blue-400 font-medium">Beranda</a>
                <a href="#kontak" class="text-white hover:text-blue-400 font-medium">Kontak</a>
                <a href="/login-admin" class="text-white hover:text-blue-400 font-medium">Login Admin</a>
            </div>
        </div>
    </nav>

    <!-- CONTENT -->
    <main class="flex-grow">
        @yield('konten')
    </main>

    <footer class="bg-black text-white py-10">
        <div class="container mx-auto flex flex-col md:flex-row md:justify-between gap-8 px-4" data-aos="fade-up"
            data-aos-duration="1500">
            <div class="flex justify-center md:justify-start">
                <img src="{{ asset('img/logo-dpmptsp.png') }}" alt="Logo DPMPTSP" class="h-20 md:h-24">
            </div>

            <div class="text-center md:text-left">
                <h3 class="text-lg font-semibold mb-3">Navigasi</h3>
                <ul class="space-y-2">
                    <li><a href="#dpmptsp" class="hover:text-gray-300 transition">Tentang Kami</a></li>
                    <li><a href="#visi-misi" class="hover:text-gray-300 transition">Visi Misi</a></li>
                    <li><a href="#total-penanaman-modal" class="hover:text-gray-300 transition">Total Penanaman
                            Modal</a></li>
                </ul>
            </div>

            <div class="text-center md:text-left" id="kontak">
                <h3 class="text-lg font-semibold mb-3">Kontak</h3>
                <p class="mb-2">Telp: 0813-6969-1182</p>
                <p class="w-auto">
                    Alamat: JL. Jenderal Sudirman KM. 4,5 No. 90, Suka Bangun, Kec. Sukarami, Kota Palembang, Sumatera
                    Selatan
                </p>
            </div>
        </div>
    </footer>

    <script>
        AOS.init();
    </script>
</body>

</html>
