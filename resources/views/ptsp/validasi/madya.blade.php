<table class="table-auto w-full border">
    <thead>
        <tr class="bg-gray-200">
            <th class="px-2 py-1 border">No</th>
            <th class="px-2 py-1 border">No Permohonan</th>
            <th class="px-2 py-1 border">Nama Pemohon</th>
            <th class="px-2 py-1 border">Jenis Permohonan</th>
            <th class="px-2 py-1 border">Tanggal</th>
            <th class="px-2 py-1 border">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($validasiList as $index => $v)
            <tr>
                <td class="px-2 py-1 border">{{ $index + 1 }}</td>
                <td class="px-2 py-1 border">{{ $v->perizinan->no_pmh }}</td>
                <td class="px-2 py-1 border">{{ $v->perizinan->nama_pers }}</td>
                <td class="px-2 py-1 border">{{ $v->perizinan->jenis_pmh }}</td>
                <td class="px-2 py-1 border">{{ $v->created_at->format('d-m-Y') }}</td>
                <td class="px-2 py-1 border">
                    <a href="{{ route('validasi.madya1.show', $v->id) }}" class="text-blue-500 hover:underline">Lihat /
                        Validasi</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
