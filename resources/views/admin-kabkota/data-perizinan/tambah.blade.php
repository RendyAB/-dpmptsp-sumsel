@extends('template.header_admin_kabkota')
@section('titleadminkabkota', 'Tambah Data Perizinan Admin Kab/Kota - DPMPTSP Sumatera Selatan')
@section('konten_admin_kabkota')

    <div class="min-h-screen bg-gray-50 flex items-center justify-center py-8">
        <div class="w-full max-w-3xl bg-white rounded-2xl shadow-lg p-8">
            <h2 class="text-2xl font-bold text-center mb-6 text-gray-800">
                Tambah Data Perizinan – Triwulan {{ $triwulan }} Tahun {{ $tahun }}
            </h2>

            <form action="{{ route('perizinan_simpan') }}" method="POST" class="space-y-6">
                @csrf

                {{-- Info jika semua sektor sudah diinput --}}
                @if ($sektor->isEmpty())
                    <div class="text-red-600 font-semibold bg-red-50 border border-red-200 p-4 rounded-md">
                        Semua Sektor Sudah diinput Untuk Triwulan {{ $triwulan }} Tahun {{ $tahun }}.
                    </div>
                @endif

                {{-- Pilih Sektor --}}
                <div>
                    <label for="sektor_perizinan_id"
                        class="block text-sm font-bold text-gray-700 uppercase tracking-wide mb-1">
                        Pilih Sektor
                    </label>
                    <select name="sektor_perizinan_id" id="sektor_perizinan_id"
                        class="w-full border-2 border-gray-400 rounded-md bg-white shadow-sm p-3 focus:border-blue-500 focus:ring focus:ring-blue-200"
                        required>
                        <option value="" disabled selected hidden>-- Pilih Sektor --</option>
                        @foreach ($sektor as $s)
                            <option value="{{ $s->id }}">{{ $s->nama }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- OSS RBA --}}
                <div>
                    <label for="oss_rba" class="block text-sm font-bold text-gray-700 uppercase tracking-wide mb-1">
                        Online Single Submission (OSS RBA)
                    </label>
                    <input type="number" name="oss_rba" id="oss_rba" min="0"
                        class="w-full border-2 border-gray-400 rounded-md bg-white shadow-sm p-3 focus:border-blue-500 focus:ring focus:ring-blue-200"
                        required>
                </div>

                {{-- NON OSS RBA --}}
                <div>
                    <label for="non_oss_rba" class="block text-sm font-bold text-gray-700 uppercase tracking-wide mb-1">
                        SI CANTIK (NON OSS RBA)
                    </label>
                    <input type="number" name="non_oss_rba" id="non_oss_rba" min="0"
                        class="w-full border-2 border-gray-400 rounded-md bg-white shadow-sm p-3 focus:border-blue-500 focus:ring focus:ring-blue-200"
                        required>
                </div>

                {{-- Triwulan --}}
                <div>
                    <label class="block text-sm font-bold text-gray-700 uppercase tracking-wide mb-1">
                        Triwulan
                    </label>
                    <input type="text" value="Triwulan {{ $triwulan }}" readonly
                        class="w-full border-2 border-gray-300 rounded-md bg-gray-100 text-gray-600 p-3 cursor-not-allowed">
                    <input type="hidden" name="triwulan" value="{{ $triwulan }}">
                </div>

                {{-- Tahun --}}
                <div>
                    <label class="block text-sm font-bold text-gray-700 uppercase tracking-wide mb-1">
                        Tahun
                    </label>
                    <input type="text" value="{{ $tahun }}" readonly
                        class="w-full border-2 border-gray-300 rounded-md bg-gray-100 text-gray-600 p-3 cursor-not-allowed">
                    <input type="hidden" name="tahun" value="{{ $tahun }}" min="2000">
                </div>

                {{-- Tombol --}}
                <div class="flex justify-end gap-4 pt-4">
                    <a href="{{ route('perizinan_tampil_kabkota', ['triwulan' => $triwulan, 'tahun' => $tahun]) }}"
                        class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-md shadow">
                        Batal
                    </a>
                    <button type="submit"
                        class="bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-3 rounded-md shadow">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: '{{ session('error') }}',
                confirmButtonColor: '#d33'
            });
        </script>
    @endif

@endsection
