@extends('template.header_admin')

@section('titleadmin', 'View Perizinan - DPMPTSP Sumatera Selatan')

@section('konten')
    <div class="max-w-6xl mx-auto bg-white shadow-lg p-6 rounded-xl">

        <form method="GET" class="mb-5">
            <div class="flex items-center gap-3">
                <select name="status" onchange="window.location='{{ route('perizinan_2.index') }}?status=' + this.value"
                    class="border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-900">

                    <option value="">Semua</option>
                    <option value="menunggu" {{ request('status') == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                    <option value="disetujui" {{ request('status') == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                    <option value="dikembalikan" {{ request('status') == 'dikembalikan' ? 'selected' : '' }}>Dikembalikan
                    </option>
                    <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                </select>
            </div>
        </form>
        
        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Data Perizinan</h1>
            <a href="{{ route('perizinan_2.create') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow">
                + Tambah Perizinan
            </a>
        </div>

        <!-- Tabel -->
        <div class="overflow-x-auto rounded-lg border border-gray-200">
            <table class="w-full text-sm text-gray-700">
                <thead class="bg-gray-100 text-gray-700 border-b border-gray-300">
                    <tr>
                        <th class="p-3 text-center font-bold">No</th>
                        <th class="p-3 font-bold">Kepada</th>
                        <th class="p-3 font-bold">Perihal</th>
                        <th class="p-3 font-bold">Petugas</th>
                        <th class="p-3 font-bold">NIP</th>
                        <th class="p-3 font-bold">Jabatan</th>
                        <th class="p-3 font-bold">Status</th>
                        <th class="p-3 text-center font-bold">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($data as $row)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="p-3 text-center border-t">{{ $loop->iteration }}</td>
                            <td class="p-3 border-t">{{ $row->kepada }}</td>
                            <td class="p-3 border-t">{{ $row->perihal }}</td>
                            <td class="p-3 border-t">{{ $row->petugas }}</td>
                            <td class="p-3 border-t">{{ $row->nip }}</td>
                            <td class="p-3 border-t">{{ $row->jabatan }}</td>

                            <td class="p-3 border-t font-bold">
                                @if ($row->status == 'disetujui')
                                    <span class="text-green-600">Disetujui</span>
                                @elseif ($row->status == 'menunggu')
                                    <span class="text-yellow-600">Menunggu</span>
                                @else
                                    <span class="text-red-600">{{ ucfirst($row->status) }}</span>
                                @endif
                            </td>

                            <td class="p-3 border-t text-center flex gap-2 justify-center">

                                <a href="{{ route('perizinan_2.edit', $row->id) }}"
                                    class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded-md text-sm shadow">
                                    Edit
                                </a>

                                <form id="delete-form-{{ $row->id }}"
                                    action="{{ route('perizinan_2.destroy', $row->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button"
                                        class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded-md text-sm shadow"
                                        onclick="confirmDeletePerizinan({{ $row->id }})">
                                        Hapus
                                    </button>
                                </form>

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="p-4 text-center text-gray-500">
                                Tidak Ada Data Perizinan
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

    <script>
        function confirmDeletePerizinan(id) {
            Swal.fire({
                title: 'Yakin Ingin Menghapus?',
                text: "Data yang dihapus tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`delete-form-${id}`).submit();
                }
            });
        }

        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @endif
    </script>
@endsection
