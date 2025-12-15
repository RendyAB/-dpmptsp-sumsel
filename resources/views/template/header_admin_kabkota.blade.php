<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/cleave.js@1.6.0/dist/cleave.min.js"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <title>@yield('titleadminkabkota', 'Website Admin Kab/Kota - DPMPTSP Sumatera Selatan')</title>
    <link rel="icon" href="{{ asset('img/logo-dpmptsp.png') }}" type="image/png">
</head>

<body>
    <div class="bg-blue-900 py-4 sticky top-0 z-50">
        <div class="max-w-screen-xl mx-auto px-4 grid grid-cols-3 items-center relative">

            <div>
                <div class="flex-shrink-0">
                    <img src="{{ asset('img/logo-dpmptsp.png') }}" alt="Logo DPMPTSP" class="h-20 md:h-10 inline">
                    <a href="{{ route('kab_kota_dashboard') }}" class="text-white font-bold text-lg">DPMPTSP Sumatera
                        Selatan</a>
                </div>
            </div>

            <!-- Kolom Tengah: Navbar -->
            <div class="flex justify-center gap-14">
                <a href="{{ route('kab_kota_dashboard') }}"
                    class="text-white hover:text-blue-400 font-medium">Dashboard</a>
                <a href="{{ route('investasi_tampil_kabkota') }}"
                    class="text-white hover:text-blue-400 font-medium">Data Investasi</a>
                <a href="{{ route('perizinan_tampil_kabkota') }}"
                    class="text-white hover:text-blue-400 font-medium">Data Perizinan</a>
            </div>

            <!-- Kolom Kanan: Logout -->
            <div class="flex justify-end">
                <form id="logout-form" method="POST" action="{{ route('admin_logout') }}">
                    @csrf
                    <button type="button" onclick="confirmLogout()"
                        class="text-white bg-red-600 hover:bg-red-700 py-2 px-4 rounded-md hover:text-white font-medium">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function confirmLogout() {
            Swal.fire({
                title: 'Yakin Ingin Logout?',
                text: "Kamu Akan Keluar Dari Sesi Admin!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Logout!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('logout-form').submit();
                }
            });
        }
    </script>
    <script>
        AOS.init();
    </script>

    @yield('konten_admin_kabkota')
</body>

</html>
