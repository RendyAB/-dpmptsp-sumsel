@extends('template.header_admin')

@section('titleadmin', 'Semua Status - DPMPTSP Sumatera Selatan')

@section('konten')

    <div class="max-w-7xl mx-auto py-10">

        <h1 class="text-4xl font-bold text-center mb-10 tracking-wide text-gray-800">
            Rekap Status Perizinan
        </h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">

            @foreach ($statusList as $key => $label)
                <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition p-8 flex flex-col justify-between">

                    {{-- Label Status --}}
                    <div>
                        <p class="text-lg font-bold text-gray-800 mb-2">{{ $label }}</p>

                        {{-- Jumlah Data --}}
                        <p class="text-5xl font-bold text-gray-800">
                            {{ $statusCounts[$key] ?? 0 }}
                        </p>
                    </div>

                    {{-- Tombol Detail --}}
                    <div class="mt-6">
                        <a href="{{ route('perizinan.status.detail', $key) }}"
                            class="block text-center bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-lg font-semibold transition">
                            Lihat Detail
                        </a>
                    </div>

                </div>
            @endforeach

        </div>
    </div>

@endsection
