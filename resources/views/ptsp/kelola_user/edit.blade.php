@extends('template.header_admin')

@section('titleadmin', 'Edit User - DPMPTSP Sumatera Selatan')

@section('konten')
    <div class="p-6">

        <h1 class="text-2xl font-bold mb-6">Edit Data User</h1>

        {{-- FORM --}}
        <form action="{{ route('kelola_user_update', $kelola_user->id) }}" method="POST"
            class="bg-white shadow-md rounded-lg p-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                {{-- Username --}}
                <div>
                    <label class="block font-medium mb-1">Username</label>
                    <input type="text" name="username" value="{{ $kelola_user->username }}"
                        class="w-full border rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-900">
                </div>

                {{-- Password --}}
                <div>
                    <label class="block font-medium mb-1">Password</label>
                    <div class="relative">
                        <input id="password" type="password" name="password" value="{{ $kelola_user->password }}"
                            class="w-full border rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-900 cursor-not-allowed" readonly>
                        <button type="button" onclick="togglePassword()"
                            class="absolute inset-y-0 right-3 flex items-center text-gray-500 hover:text-gray-700">
                            <svg id="icon-eye" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                class="w-5 h-5">
                                <path d="M10 12.5a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z" />
                                <path fill-rule="evenodd"
                                    d="M.664 10.59a1.651 1.651 0 0 1 0-1.186A10.004 10.004 0 0 1 10 3c4.257 0 7.893 2.66 9.336 6.41.147.381.146.804 0 1.186A10.004 10.004 0 0 1 10 17c-4.257 0-7.893-2.66-9.336-6.41ZM14 10a4 4 0 1 1-8 0 4 4 0 0 1 8 0Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- Role --}}
                <div>
                    <label class="block font-medium mb-1">Role</label>
                    <select name="role"
                        class="w-full border rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-900">

                        <option value="">-- Pilih Role --</option>

                        <option value="petugas" @if (isset($kelola_user) && $kelola_user->role == 'petugas') selected @endif>
                            Petugas
                        </option>

                        <option value="madya_1" @if (isset($kelola_user) && $kelola_user->role == 'madya_1') selected @endif>
                            Ahli Madya 1
                        </option>

                        <option value="madya_2" @if (isset($kelola_user) && $kelola_user->role == 'madya_2') selected @endif>
                            Ahli Madya 2
                        </option>

                        <option value="madya_3" @if (isset($kelola_user) && $kelola_user->role == 'madya_3') selected @endif>
                            Ahli Madya 3
                        </option>

                        <option value="kabid" @if (isset($kelola_user) && $kelola_user->role == 'kabid') selected @endif>
                            Kepala Bidang
                        </option>

                    </select>
                </div>

                {{-- Nama Petugas --}}
                <div>
                    <label class="block font-medium mb-1">Nama Petugas</label>
                    <input type="text" name="nama_petugas" value="{{ $kelola_user->nama_petugas }}"
                        class="w-full border rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-900">
                </div>

                {{-- NIP --}}
                <div>
                    <label class="block font-medium mb-1">NIP</label>
                    <input type="text" name="nip" value="{{ $kelola_user->nip }}"
                        class="w-full border rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-900">
                </div>

            </div>

            {{-- Tombol --}}
            <div class="mt-6 flex gap-3">
                <a href="{{ route('kelola_user_tampil') }}"
                    class="bg-gray-600 hover:bg-gray-700 text-white px-5 py-2 rounded-lg shadow">
                    Kembali
                </a>

                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg shadow">
                    Update User
                </button>
            </div>

        </form>
    </div>

    <script>
        function togglePassword() {
            const input = document.getElementById('password');
            const icon = document.getElementById('icon-eye');

            if (input.type === "password") {
                input.type = "text";
                icon.classList.add("text-green-600");
            } else {
                input.type = "password";
                icon.classList.remove("text-green-600");
            }
        }
    </script>
@endsection
