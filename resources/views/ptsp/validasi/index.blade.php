@extends('template.header_admin')

@section('titleadmin', 'View Validasi - DPMPTSP Sumatera Selatan')

@section('konten')
    <div class="container mx-auto p-6">

        <h2 class="text-2xl font-bold mb-6 text-gray-800">
            Daftar Permohonan untuk Validasi
        </h2>

        @if ($validasiList->isEmpty())
            <div class="bg-yellow-50 border border-yellow-300 text-yellow-800 p-4 rounded-md">
                Belum Ada Permohonan yang Menunggu Validasi
            </div>
        @else
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">

                @foreach ($validasiList as $validasi)
                    <div class="bg-white shadow-md rounded-xl p-5 border border-gray-200 hover:shadow-lg transition">

                        {{-- Header --}}
                        {{-- <div class="flex items-center mb-4">
                            <div
                                class="w-12 h-12 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center text-xl font-bold">
                                {{ Str::limit($validasi->perizinan->nama_pers ?? 'P', 1, '') }}
                            </div>

                            <div class="ml-4">
                                <p class="text-gray-800 font-semibold text-lg">
                                    {{ $validasi->perizinan->nama_pers ?? '-' }}
                                </p>
                                <p class="text-gray-500 text-sm">
                                    {{ $validasi->perizinan->jenis_pmh ?? 'Tidak Diketahui' }}
                                </p>
                            </div>
                        </div> --}}

                        <div class="flex items-center mb-4">

                            @php
                                $isPerizinan = $validasi->perizinan_id !== null;
                                $data = $isPerizinan ? $validasi->perizinan : $validasi->nonPerizinan;
                            @endphp

                            <div
                                class="w-12 h-12 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center text-xl font-bold">
                                {{ Str::limit($data->nama_pers ?? ($data->nama_pemilik ?? 'N'), 1, '') }}
                            </div>

                            <div class="ml-4">
                                <p class="text-gray-800 font-semibold text-lg">
                                    {{ $data->nama_pers ?? ($data->nama_pemilik ?? '-') }}
                                </p>
                                <p class="text-gray-500 text-sm">
                                    {{ $data->jenis_pmh ?? ($data->jenis_permohonan ?? 'Tidak Diketahui') }}
                                </p>
                            </div>
                        </div>

                        {{-- Detail Info --}}
                        {{-- <div class="space-y-2 text-sm text-gray-700">

                            <p>
                                <span class="font-semibold">No Permohonan: </span>
                                {{ $validasi->perizinan->no_pmh ?? '-' }}
                            </p>

                            <p>
                                <span class="font-semibold">Tanggal Masuk: </span>
                                {{ $validasi->created_at->format('d-m-Y') }}
                            </p>

                        </div> --}}

                        <div class="space-y-2 text-sm text-gray-700">

                            <p>
                                <span class="font-semibold">No Permohonan: </span>
                                {{ $data->no_pmh ?? ($data->no_agenda ?? '-') }}
                            </p>

                            <p>
                                <span class="font-semibold">Tanggal Masuk: </span>
                                {{ $validasi->created_at->format('d-m-Y') }}
                            </p>

                        </div>

                        {{-- Button Aksi --}}
                        {{-- <div class="mt-5">

                            @if ($validasi->perizinan_id)
                                <a href="{{ route('validasi.detail', $validasi->id) }}"
                                    class="block text-center bg-green-500 text-white py-2 rounded-lg font-medium hover:bg-green-600 transition">
                                    Detail Perizinan
                                </a>
                            @else
                                <a href="{{ route('validasi.detail', $validasi->id) }}"
                                    class="block text-center bg-blue-500 text-white py-2 rounded-lg font-medium hover:bg-blue-600 transition">
                                    Detail Non Perizinan
                                </a>
                            @endif

                        </div> --}}

                        <div class="mt-5">
                            <a href="{{ route('validasi.detail', $validasi->id) }}"
                                class="block text-center bg-{{ $isPerizinan ? 'green' : 'blue' }}-500 text-white py-2 rounded-lg font-medium hover:bg-{{ $isPerizinan ? 'green' : 'blue' }}-600 transition">
                                Detail {{ $isPerizinan ? 'Perizinan' : 'Non Perizinan' }}
                            </a>
                        </div>

                    </div>
                @endforeach

            </div>
        @endif

    </div>
@endsection
