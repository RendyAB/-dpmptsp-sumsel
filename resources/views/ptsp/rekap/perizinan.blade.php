@extends('template.header_admin')

@section('titleadmin', 'Rekap Perizinan - DPMPTSP Sumatera Selatan')

@section('konten')
<div class="max-w-7xl mx-auto px-4 py-8">

    {{-- PAGE HEADER --}}
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Data Perizinan</h1>
        <p class="text-gray-500 text-sm mt-1">Menampilkan seluruh data perizinan tanpa filter.</p>
    </div>

    {{-- TABLE WRAPPER --}}
    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">

        {{-- TABLE HEADER BAR --}}
        <div class="px-6 py-4 border-b bg-gray-50 flex items-center justify-between">
            <h2 class="text-lg font-semibold text-gray-800">Daftar Permohonan</h2>
        </div>

        {{-- TABLE --}}
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gray-100 text-gray-700 font-semibold border-b text-left">
                        <th class="px-6 py-3">No</th>
                        <th class="px-6 py-3">Nomor PMH</th>
                        <th class="px-6 py-3">NIB</th>
                        <th class="px-6 py-3">Nama Perusahaan</th>
                        <th class="px-6 py-3">Kab/Kota</th>
                        <th class="px-6 py-3">Tanggal Permohonan</th>
                        <th class="px-6 py-3">Tanggal Terbit</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($perizinan as $p)
                        <tr class="border-b hover:bg-blue-50 transition-colors even:bg-gray-50">
                            <td class="px-6 py-3">{{ $loop->iteration }}</td>

                            <td class="px-6 py-3">
                                <span class="font-bold text-blue-600">
                                    {{ $p->no_pmh }}
                                </span>
                            </td>

                            <td class="px-6 py-3">{{ $p->nib }}</td>
                            <td class="px-6 py-3">{{ $p->nama_pers }}</td>
                            <td class="px-6 py-3">{{ $p->kab }}</td>
                            <td class="px-6 py-3">{{ $p->tgl_pmh }}</td>
                            <td class="px-6 py-3">{{ $p->tgl_terbit }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-6 text-center text-gray-500 italic">
                                Tidak ada data perizinan ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- PAGINATION --}}
        <div class="px-6 py-4 border-t bg-gray-50">
            {{ $perizinan->links('pagination::tailwind') }}
        </div>

    </div>

</div>
@endsection
