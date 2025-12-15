<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <link rel="icon" href="{{ asset('img/logo-dpmptsp.png') }}" type="image/png">
    <title>Login Admin Kab/Kota - DPMPTSP Sumatera Selatan</title>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    {{-- Card Login --}}
    <div class="bg-white shadow-lg rounded-3xl p-8 w-full max-w-md" data-aos="fade-down" data-aos-duration="1500">
        {{-- Logo --}}
        <div class="flex justify-center mb-4">
            <img src="{{ asset('img/logo-dpmptsp.png') }}" alt="Logo" class="h-32">
        </div>
        {{-- Judul --}}
        <h2 class="text-2xl font-bold text-center mb-6">
            <span class="text-green-600">DPMPTPSP-SUMSEL</span><br>
            <span class="text-gray-700">LOGIN ADMIN KABUPATEN/KOTA</span>
        </h2>

        <form method="POST" action="{{ route('admin_login_submit') }}" class="space-y-4">
            @csrf
            <input type="hidden" name="source" value="kab_kota">

            {{-- Username --}}
            <div class="mb-4">
                <label class="block text-gray-700 mb-1 font-bold">Username</label>
                <input type="text" name="username" required autocomplete="off" placeholder="Masukkan Username"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-700">
            </div>

            {{-- Password + Toggle --}}
            <div class="mb-6">
                <label class="block text-gray-700 mb-1 font-bold">Password</label>
                <div class="relative">
                    <input type="password" id="password" name="password" required autocomplete="off"
                        placeholder="Masukkan Password"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-700 pr-12">
                    <button type="button" onclick="togglePassword(this)"
                        class="absolute top-1/2 right-3 transform -translate-y-1/2 text-gray-500 hover:text-gray-700 transition"
                        id="togglePasswordBtn">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                            <path d="M10 12.5a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z" />
                            <path fill-rule="evenodd"
                                d="M.664 10.59a1.651 1.651 0 0 1 0-1.186A10.004 10.004 0 0 1 10 3c4.257 0 7.893 2.66 9.336 6.41.147.381.146.804 0 1.186A10.004 10.004 0 0 1 10 17c-4.257 0-7.893-2.66-9.336-6.41ZM14 10a4 4 0 1 1-8 0 4 4 0 0 1 8 0Z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-gray-600 mb-1 text-center font-bold">CAPTCHA</label>
                <div class="flex items-center justify-center space-x-4">
                    <img src="{{ captcha_src('flat') }}" id="captcha-image" class="h-16 w-auto rounded border">
                    <button type="button" id="reload"
                        class="text-green-600 hover:text-green-700 text-2xl font-bold">↻</button>
                </div>
                <input type="text" name="captcha" placeholder="Masukkan Kode di Atas"
                    class="w-full mt-3 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-700 text-center">
                @error('captcha')
                    @if ($message === 'Kode Captcha Harus diisi')
                        <div
                            class="mt-2 w-full text-sm text-center px-4 py-2 rounded-lg bg-yellow-100 text-yellow-700 border border-yellow-300">
                            {{ $message }}
                        </div>
                    @elseif ($message === 'Kode Captcha yang Anda Masukkan Salah')
                        <div
                            class="mt-2 w-full text-sm text-center px-4 py-2 rounded-lg bg-red-100 text-red-700 border border-red-300">
                            {{ $message }}
                        </div>
                    @else
                        <div
                            class="mt-2 w-full text-sm text-center px-4 py-2 rounded-lg bg-red-100 text-red-700 border border-red-300">
                            {{ $message }}
                        </div>
                    @endif
                @enderror
            </div>

            {{-- Button --}}
            <button type="submit"
                class=" w-full bg-green-700 hover:bg-green-800 text-white font-semibold py-2 rounded-lg">
                LOGIN
            </button><br>
            <a href="/"
                class="text-center block w-full bg-green-700 hover:bg-green-800 text-white font-semibold py-2 rounded-lg">
                KEMBALI KE BERANDA
            </a>

        </form>
    </div>

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Login Gagal',
                text: '{{ session('error') }}',
                confirmButtonColor: '#d33'
            });
        </script>
    @endif

    {{-- Toggle Password --}}
    <script>
        function togglePassword(button) {
            const passwordInput = document.getElementById('password');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                button.classList.remove('text-gray-500');
                button.classList.add('text-green-600');
            } else {
                passwordInput.type = 'password';
                button.classList.remove('text-green-600');
                button.classList.add('text-gray-500');
            }
        }

        document.getElementById('reload').addEventListener('click', function() {
            fetch('{{ route('reload.captcha') }}', {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    document.getElementById('captcha-image').src = data.captcha + '?' + Date.now();
                });
        });
        AOS.init();
    </script>

</body>

</html>
