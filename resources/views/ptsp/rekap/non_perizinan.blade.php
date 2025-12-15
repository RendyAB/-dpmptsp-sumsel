@extends('template.header_admin')

@section('titleadmin', 'Rekap Non-Perizinan - DPMPTSP Sumatera Selatan')

@section('konten')
    <div class="container mx-auto px-4 py-6">

        <h2 class="text-2xl font-bold mb-4">Rekap Non Perizinan</h2>

        <!-- Table Container -->
        <div class="bg-white shadow-md rounded border overflow-x-auto">
            <table class="min-w-full text-sm text-left">
                <thead class="bg-gray-100 border-b">
                    <tr>
                        <th class="px-4 py-3">No</th>
                        <th class="px-4 py-3">Nama Pemohon</th>
                        <th class="px-4 py-3">Nama Perizinan</th>
                        <th class="px-4 py-3">Kab/Kota</th>
                        <th class="px-4 py-3">Status Validasi</th>
                        <th class="px-4 py-3">Current Level</th>
                        <th class="px-4 py-3">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($perizinan as $p)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-3">
                                {{ ($perizinan->currentPage() - 1) * $perizinan->perPage() + $loop->iteration }}
                            </td>

                            <td class="px-4 py-3">{{ $p->nama_pemohon ?? '-' }}</td>

                            <td class="px-4 py-3">{{ $p->nama_perizinan ?? '-' }}</td>

                            <td class="px-4 py-3">{{ $p->kab ?? '-' }}</td>

                            <td class="px-4 py-3">
                                @php
                                    $status = $p->status_validasi;
                                    $badge = 'bg-gray-500';
                                    if ($status === 'revisi') {
                                        $badge = 'bg-yellow-500';
                                    }
                                    if ($status === 'ditolak') {
                                        $badge = 'bg-red-600';
                                    }
                                    if ($status === null) {
                                        $badge = 'bg-gray-400';
                                    }
                                @endphp

                                <span class="text-white px-3 py-1 rounded {{ $badge }}">
                                    {{ $status ?? 'Belum divalidasi' }}
                                </span>
                            </td>

                            <td class="px-4 py-3">
                                {{ $p->current_level ?? '-' }}
                            </td>


                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-5 text-center text-gray-500">
                                Tidak ada data non perizinan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $perizinan->links() }}
        </div>

    </div>
@endsection
