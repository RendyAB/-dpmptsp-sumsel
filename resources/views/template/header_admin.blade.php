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
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>@yield('titleadmin', 'Website Admin - DPMPTSP Sumatera Selatan')</title>
    <link rel="icon" href="{{ asset('img/logo-dpmptsp.png') }}" type="image/png">
</head>

<body>
    <div class="bg-blue-900 py-4 sticky top-0 z-50">
        <div class="max-w-screen-xl mx-auto px-4 flex items-center justify-between">

            <!-- Logo + Judul -->
            <div class="flex items-center gap-3">
                <img src="{{ asset('img/logo-dpmptsp.png') }}" alt="Logo DPMPTSP" class="h-10">
                <a href="{{ route('verifikator_test') }}" class="text-white font-bold text-lg whitespace-nowrap">
                    DPMPTSP Sumatera Selatan
                </a>
            </div>

            <!-- Hamburger (Mobile Only) -->
            <button id="menuToggle" class="md:hidden text-white text-3xl focus:outline-none">
                ☰
            </button>

            <!-- Menu -->
            <ul id="menu"
                class="hidden md:flex flex-col md:flex-row items-start md:items-center 
                   gap-6 md:gap-10 text-white font-medium absolute md:static
                   top-16 left-0 w-full md:w-auto bg-blue-900 md:bg-transparent 
                   px-6 md:px-0 py-4 md:py-0">

                <li>
                    <a href="{{ route('verifikator_test') }}" class="hover:text-blue-300 block px-3 py-2">
                        Dashboard
                    </a>
                </li>

                @php
                    $user = Auth::guard('verifikator')->user();
                @endphp

                @if (in_array($user?->role, ['super_admin', 'petugas']))
                    <!-- PROSES VERIFIKASI -->
                    <li class="relative w-full md:w-auto">
                        <button onclick="toggleDropdown('verifikasi-dropdown')"
                            class="hover:text-blue-300 block px-3 py-2 w-full text-left md:text-center">
                            Proses Verifikasi ▾
                        </button>

                        <ul id="verifikasi-dropdown"
                            class="hidden absolute md:absolute left-0 mt-1 bg-white text-black 
                           rounded shadow-lg z-50 w-48">
                            <li><a href="{{ url('perizinan_2/status') }}"
                                    class="block px-4 py-2 hover:bg-blue-200">Semua
                                    Status</a></li>
                            <li><a href="{{ route('perizinan_2.index') }}"
                                    class="block px-4 py-2 hover:bg-blue-200">Perizinan</a></li>
                            <li><a href="{{ route('non_perizinan.index') }}"
                                    class="block px-4 py-2 hover:bg-blue-200">Non
                                    Perizinan</a></li>
                        </ul>
                    </li>
                @endif

                @php
                    $user = Auth::guard('verifikator')->user();
                @endphp

                @if (in_array($user?->role, ['madya_1', 'madya_2', 'madya_3', 'kabid']))
                    <li>
                        <a href="{{ route('perizinan2.validasi') }}" class="hover:text-blue-300 block px-3 py-2">
                            Proses Validasi
                        </a>
                    </li>
                @endif

                <!-- REKAP DATA -->
                {{-- <li class="relative w-full md:w-auto">
                    <button onclick="toggleDropdown('rekap-dropdown')"
                        class="hover:text-blue-300 block px-3 py-2 w-full text-left md:text-center">
                        Rekap Data ▾
                    </button>

                    <ul id="rekap-dropdown"
                        class="hidden absolute left-0 mt-1 bg-white text-black 
                           rounded shadow-lg z-50 w-48">
                        <li><a href="{{ route('rekap.perizinan') }}"
                                class="block px-4 py-2 hover:bg-blue-200">Perizinan</a></li>
                        <li><a href="{{ route('rekap.non_perizinan') }}" class="block px-4 py-2 hover:bg-blue-200">Non
                                Perizinan</a></li>
                    </ul>
                </li> --}}

                @php
                    $user = Auth::guard('verifikator')->user();
                @endphp

                @if (in_array($user?->role, ['super_admin']))
                <li>
                    <a href="{{ route('kelola_user_tampil') }}" class="hover:text-blue-300 block px-3 py-2">
                        Kelola User
                    </a>
                </li>
                @endif

                <!-- Logout Button (Mobile) -->
                <li class="md:hidden mt-4">
                    <button onclick="confirmLogout()"
                        class="text-white bg-red-600 hover:bg-red-700 py-2 px-4 rounded-md font-medium w-full">
                        Logout
                    </button>
                </li>

            </ul>

            <!-- Logout (Desktop) -->
            <div class="hidden md:block">
                <form id="logout-form" method="POST" action="{{ route('admin_logout') }}">
                    @csrf
                    <button type="button" onclick="confirmLogout()"
                        class="text-white bg-red-600 hover:bg-red-700 py-2 px-4 rounded-md font-medium">
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

        const menu = document.getElementById('menu');

        menuToggle.addEventListener('click', () => {
            menu.classList.toggle('hidden');
        });

        function toggleDropdown(id) {
            const dropdown = document.getElementById(id);

            // Tutup dropdown lain
            document.querySelectorAll('ul[id$="-dropdown"]').forEach(el => {
                if (el.id !== id) el.classList.add('hidden');
            });

            // Toggle dropdown saat ini
            dropdown.classList.toggle('hidden');
        }

        // Tutup semua dropdown saat klik di luar
        document.addEventListener('click', function(e) {
            const isDropdownButton = e.target.closest('button[onclick^="toggleDropdown"]');
            const isDropdownMenu = e.target.closest('ul[id$="-dropdown"]');

            if (!isDropdownButton && !isDropdownMenu) {
                document.querySelectorAll('ul[id$="-dropdown"]').forEach(drop => {
                    drop.classList.add('hidden');
                });
            }
        });
    </script>
    <script>
        AOS.init();
    </script>

    @yield('konten')
</body>

</html>
