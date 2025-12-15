@extends('template.header_admin_kabkota')
@section('titleadminkabkota', 'Edit Data Perizinan Admin Kab/Kota - DPMPTSP Sumatera Selatan')
@section('konten_admin_kabkota')

    <div class="min-h-screen bg-gray-50 flex items-center justify-center py-8">
        <div class="w-full max-w-3xl bg-white rounded-2xl shadow-lg p-8">
            <h2 class="text-2xl font-bold text-center mb-6 text-gray-800">
                Edit Data Perizinan – Triwulan {{ $triwulan }} Tahun {{ $tahun }}
            </h2>

            <form action="{{ route('perizinan_update', $sektor->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <input type="hidden" name="triwulan_lama" value="{{ $triwulan }}">
                <input type="hidden" name="tahun_lama" value="{{ $tahun }}">

                {{-- Sektor --}}
                <div>
                    <label for="sektor_perizinan_id"
                        class="block text-sm font-bold text-gray-700 uppercase tracking-wide mb-1">
                        Sektor
                    </label>
                    <select name="sektor_perizinan_id" id="sektor_perizinan_id"
                        class="w-full border-2 border-gray-300 rounded-md bg-gray-100 text-gray-600 p-3 cursor-not-allowed"
                        disabled>
                        @foreach ($sektor_list as $s)
                            <option value="{{ $s->id }}" {{ $sektor->id == $s->id ? 'selected' : '' }}>
                                {{ $s->nama }}
                            </option>
                        @endforeach
                    </select>
                    <input type="hidden" name="sektor_perizinan_id" value="{{ $sektor->id }}">
                </div>

                {{-- OSS RBA --}}
                <div>
                    <label for="oss_rba" class="block text-sm font-bold text-gray-700 uppercase tracking-wide mb-1">
                        Online Single Submission (OSS RBA)
                    </label>
                    <input type="number" name="oss_rba" id="oss_rba" min="0"
                        class="w-full border-2 border-gray-400 rounded-md bg-white shadow-sm p-3 focus:border-blue-500 focus:ring focus:ring-blue-200"
                        value="{{ $oss->jumlah ?? 0 }}" required>
                </div>

                {{-- NON OSS RBA --}}
                <div>
                    <label for="non_oss_rba" class="block text-sm font-bold text-gray-700 uppercase tracking-wide mb-1">
                        SI CANTIK (NON OSS RBA)
                    </label>
                    <input type="number" name="non_oss_rba" id="non_oss_rba" min="0"
                        class="w-full border-2 border-gray-400 rounded-md bg-white shadow-sm p-3 focus:border-blue-500 focus:ring focus:ring-blue-200"
                        value="{{ $nonOss->jumlah ?? 0 }}" required>
                </div>

                {{-- Triwulan --}}
                <div>
                    <label for="triwulan" class="block text-sm font-bold text-gray-700 uppercase tracking-wide mb-1">
                        Triwulan
                    </label>
                    <select name="triwulan" id="triwulan"
                        class="w-full border-2 border-gray-400 rounded-md bg-white shadow-sm p-3 focus:border-blue-500 focus:ring focus:ring-blue-200"
                        required>
                        @for ($i = 1; $i <= 4; $i++)
                            <option value="{{ $i }}" {{ $triwulan == $i ? 'selected' : '' }}>
                                Triwulan {{ $i }}
                            </option>
                        @endfor
                    </select>
                </div>

                {{-- Tahun --}}
                <div>
                    <label for="tahun" class="block text-sm font-bold text-gray-700 uppercase tracking-wide mb-1">
                        Tahun
                    </label>
                    <input type="number" name="tahun" id="tahun"
                        class="w-full border-2 border-gray-400 rounded-md bg-white shadow-sm p-3 focus:border-blue-500 focus:ring focus:ring-blue-200"
                        value="{{ $tahun }}" min="2000" required>
                </div>

                {{-- Tombol --}}
                <div class="flex justify-end gap-4 pt-4">
                    <a href="{{ route('perizinan_tampil_kabkota', ['triwulan' => $triwulan, 'tahun' => $tahun]) }}"
                        class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-md shadow">
                        Batal
                    </a>
                    <button type="submit"
                        class="bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-3 rounded-md shadow">
                        Update
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
