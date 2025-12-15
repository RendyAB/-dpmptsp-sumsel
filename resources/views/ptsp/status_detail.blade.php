@extends('template.header_admin')

@section('titleadmin', 'Detail Status - DPMPTSP Sumatera Selatan')

@section('konten')

<div class="max-w-7xl mx-auto py-8 px-4">

    <!-- Header -->
    <div class="text-center mb-10">
        <h1 class="text-3xl font-bold text-gray-800">
            Status: <span class="capitalize">{{ $status }}</span>
        </h1>
        <p class="text-gray-500 mt-2">Daftar Data Berdasarkan Status Permohonan</p>
    </div>

    <!-- Jika kosong -->
    @if ($list->isEmpty())
        <div class="bg-white shadow rounded-lg p-8 text-center">
            <p class="text-gray-500 text-lg">Belum Ada Data dengan Status Ini</p>
        </div>
    @else

        <!-- Grid Card -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

            @foreach ($list as $item)
                <div class="bg-white shadow-md rounded-xl p-6 border border-gray-200 hover:shadow-lg transition">

                    <!-- Judul -->
                    <h2 class="text-xl font-semibold text-gray-800 mb-3 leading-tight">
                        @if ($item->jenis_data === 'perizinan')
                            {{ $item->nama_pers }}
                        @else
                            {{ $item->nama_pemilik ?? 'Non Perizinan' }}
                        @endif
                    </h2>

                    <!-- Info -->
                    <div class="space-y-1 text-sm text-gray-700">
                        
                        <p>
                            <span class="font-medium">Jenis Data:</span>
                            <span class="capitalize">{{ str_replace('_', ' ', $item->jenis_data) }}</span>
                        </p>

                        <p>
                            <span class="font-medium">Status:</span>
                            <span class="capitalize
                                @if ($item->status == 'disetujui') text-green-600
                                @elseif ($item->status == 'menunggu') text-yellow-600
                                @elseif ($item->status == 'ditolak') text-red-600
                                @else text-orange-600 @endif
                            ">
                                {{ $item->status }}
                            </span>
                        </p>

                        <p>
                            <span class="font-medium">Nomor Permohonan:</span>
                            {{ $item->no_pmh ?? ($item->no_agenda ?? '-') }}
                        </p>

                    </div>

                    <!-- Tombol Aksi -->
                    <div class="mt-5 flex flex-wrap gap-2">

                        @if ($item->jenis_data === 'perizinan')
                            <a href="{{ route('perizinan_2.edit', $item->id) }}"
                                class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm rounded-lg shadow">
                                Detail Perizinan
                            </a>

                            <a href="{{ route('perizinan2.generate', ['id' => $item->id]) }}"
                                class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm rounded-lg shadow">
                                PDF
                            </a>

                        @else
                            <a href="{{ route('non_perizinan.edit', $item->id) }}"
                                class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm rounded-lg shadow">
                                Detail Non Perizinan
                            </a>

                            <a href="{{ route('non_perizinan.generate', ['id' => $item->id]) }}"
                                class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm rounded-lg shadow">
                                PDF
                            </a>
                        @endif
                    </div>

                </div>
            @endforeach

        </div>
    @endif
</div>

@endsection
