@extends('template.header_admin')

@section('titleadmin', 'View User - DPMPTSP Sumatera Selatan')

@section('konten')
    <div class="max-w-6xl mx-auto bg-white shadow-lg p-8 rounded-xl">

        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-2xl font-bold text-gray-800">Kelola User</h1>

            <a href="{{ route('kelola_user_create') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-lg shadow-md transition">
                + Tambah User
            </a>
        </div>

        <!-- Table Wrapper -->
        <div class="overflow-hidden border border-gray-200 rounded-lg shadow-sm">
            <table class="w-full text-sm text-gray-700">
                <thead class="bg-gray-100 text-gray-600 border-b border-gray-300">
                    <tr>
                        <th class="p-3 text-center">No</th>
                        <th class="p-3">Username</th>
                        <th class="p-3">Role / Jabatan</th>
                        <th class="p-3">Nama Petugas</th>
                        <th class="p-3 text-center">NIP</th>
                        <th class="p-3 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($kelola_user as $no => $data)
                        <tr class="hover:bg-gray-50 transition border-b">
                            <td class="p-3 text-center">{{ $no + 1 }}</td>
                            <td class="p-3">{{ $data->username }}</td>
                            <td class="p-3">{{ $data->role }}</td>
                            <td class="p-3">{{ $data->nama_petugas }}</td>
                            <td class="p-3 text-center">{{ $data->nip }}</td>

                            <td class="p-3 text-center">
                                <div class="flex items-center justify-center gap-2">

                                    {{-- Tombol Edit --}}
                                    {{-- <a href="{{ route('kelola_user_edit', $data->id) }}"
                                        class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded-md text-xs shadow">
                                        Edit
                                    </a> --}}

                                    {{-- Tombol Hapus --}}
                                    <form id="delete-form-{{ $data->id }}"
                                        action="{{ route('kelola_user_destroy', $data->id) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" onclick="confirmDelete({{ $data->id }})"
                                            class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded-md text-sm shadow">
                                            Hapus
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="p-5 text-center text-gray-500">
                                Tidak Ada Data User
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

    <script>
        function confirmDelete(id) {
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
