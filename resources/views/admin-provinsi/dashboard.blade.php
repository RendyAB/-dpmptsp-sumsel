@extends('template.header_admin_provinsi')
@section('titleadminprovinsi', 'Dashboard Admin Provinsi - DPMPTSP Sumatera Selatan')
@section('konten_admin_provinsi')

    <div class="relative h-[90.6vh] w-full">
        <img src="{{ asset('img/ampera.jpg') }}" class="h-full w-full object-cover" alt="Background">

        <div class="absolute inset-0 bg-white/25 backdrop-blur-sm"></div>

        <div class="absolute inset-0 flex flex-col items-center justify-center text-center px-2">
            <img src="{{ asset('img/logo-dpmptsp.png') }}" alt="Logo DPMPTSP Sumsel" class="mx-auto mb-6 h-60"
                data-aos="fade-down" data-aos-duration="2000">
            <h1 class="text-3xl font-bold text-white" data-aos="fade-up" data-aos-duration="2000">Selamat Datang di
                Dashboard Admin DPMPTSP <br> Provinsi Sumatera
                Selatan
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
