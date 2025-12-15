@extends('template.header_admin_kabkota')
@section('titleadminkabkota', 'Dashboard Admin Kab/Kota - DPMPTSP Sumatera Selatan')
@section('konten_admin_kabkota')

    <div class="relative h-[90.6vh] w-full">
        <img src="{{ asset('img/ampera.jpg') }}" class="h-full w-full object-cover" alt="Background">

        <div class="absolute inset-0 bg-white/25 backdrop-blur-sm"></div>

        <div class="absolute inset-0 flex flex-col items-center justify-center text-center px-2">
            @php
                $nama_kab_kota = auth('admin')->user()->kabKota->nama ?? null;

                $logoMap = [
                    'Kota Palembang' => 'img/logo-palembang.png',
                    'Kota Pagar Alam' => 'img/logo-pagaralam.png',
                    'Kota Lubuk Linggau' => 'img/logo-lahat.png',
                    'Kota Prabumulih' => 'img/logo-prabumulih.png',
                    'Kabupaten Banyuasin' => 'img/logo-banyuasin.png',
                    'Kabupaten Empat Lawang' => 'img/logo-empatlawang.png',
                    'Kabupaten Lahat' => 'img/logo-lahat.png',
                    'Kabupaten Muara Enim' => 'img/logo-muaraenim.png',
                    'Kabupaten Musi Banyuasin' => 'img/logo-musibanyuasin.png',
                    'Kabupaten Musi Rawas' => 'img/logo-musirawas.png',
                    'Kabupaten Musi Rawas Utara' => 'img/logo-muratara.png',
                    'Kabupaten Ogan Ilir' => 'img/logo-oganilir.png',
                    'Kabupaten Ogan Komering Ilir' => 'img/logo-oki.png',
                    'Kabupaten Ogan Komering Ulu' => 'img/logo-oku.png',
                    'Kabupaten Ogan Komering Ulu Selatan' => 'img/logo-okuselatan.png',
                    'Kabupaten Ogan Komering Ulu Timur' => 'img/logo-okutimur.png',
                    'Kabupaten Penukal Abab Lematang Ilir' => 'img/logo-pali.png',
                ];

                $logo = $logoMap[$nama_kab_kota] ?? 'img/logo-dpmptsp.png';
            @endphp

            <img src="{{ asset($logo) }}" alt="Logo {{ $nama_kab_kota ?? 'DPMPTSP' }}" class="mx-auto mb-6 h-60"
                data-aos="fade-down" data-aos-duration="2000">

            <h1 class="text-3xl font-bold text-white" data-aos="fade-up" data-aos-duration="2000">
                Selamat Datang di Dashboard Admin DPMPTSP <br> {{ $nama_kab_kota ?? 'Kabupaten/Kota' }}
            </h1>
        </div>
    </div>

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Login Berhasil',
                text: '{{ session('success') }}',
                confirmButtonColor: '#3085d6'
            });
        </script>
    @endif

@endsection
