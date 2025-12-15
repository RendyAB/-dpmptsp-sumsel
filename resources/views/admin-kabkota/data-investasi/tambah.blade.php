@extends('template.header_admin_kabkota')
@section('titleadminkabkota', 'Tambah Data Investasi Admin Kab/Kota - DPMPTSP Sumatera Selatan')
@section('konten_admin_kabkota')

    <div class="min-h-screen bg-gray-50 flex items-center justify-center py-8">
        <div class="w-full max-w-4xl bg-white rounded-2xl shadow-lg p-8">
            <h2 class="text-2xl font-bold text-center mb-6 text-gray-800">
                Tambah Data Investasi – Triwulan {{ $triwulan }} Tahun {{ $tahun }}
            </h2>

            <form action="{{ route('investasi_simpan') }}" method="POST" class="space-y-6">
                @csrf

                {{-- Kategori & Sektor --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 uppercase tracking-wide mb-1">
                            Kategori Sektor
                        </label>
                        <select name="kategori_sektor_id" id="kategori_sektor"
                            class="w-full border-2 border-gray-400 rounded-md bg-white shadow-sm p-3 focus:border-blue-500 focus:ring focus:ring-blue-200"
                            required>
                            <option value="" disabled selected hidden>-- Pilih Kategori --</option>
                            @foreach ($kategori as $k)
                                <option value="{{ $k->id }}">{{ $k->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 uppercase tracking-wide mb-1">
                            Sektor Investasi
                        </label>
                        <select name="sektor_investasi_id" id="sektor_investasi"
                            class="w-full border-2 border-gray-400 rounded-md bg-white shadow-sm p-3 focus:border-blue-500 focus:ring focus:ring-blue-200"
                            required>
                            <option value="" disabled selected hidden>-- Pilih Sektor --</option>
                        </select>
                    </div>
                </div>

                {{-- PMA --}}
                <div>
                    <h3 class="text-lg font-semibold text-gray-700 mb-2 text-center">PMA</h3>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div>
                            <label for="lkpm_pma"
                                class="block text-sm font-bold text-gray-700 uppercase tracking-wide mb-1">
                                LKPM PMA
                            </label>
                            <input type="number" name="lkpm_pma" min="0"
                                class="w-full border-2 border-gray-400 rounded-md bg-white shadow-sm p-3 focus:border-blue-500 focus:ring focus:ring-blue-200"
                                required>
                        </div>

                        <div>
                            <label for="realisasi_pma"
                                class="block text-sm font-bold text-gray-700 uppercase tracking-wide mb-1">
                                Realisasi Investasi
                            </label>
                            <input type="text" id="realisasi_pma" name="realisasi_pma" autocomplete="off"
                                class="w-full border-2 border-gray-400 rounded-md bg-white shadow-sm p-3 focus:border-blue-500 focus:ring focus:ring-blue-200"
                                required>
                        </div>

                        <div>
                            <label for="tki_pma"
                                class="block text-sm font-bold text-gray-700 uppercase tracking-wide mb-1">
                                TKI PMA
                            </label>
                            <input type="number" name="tki_pma" min="0"
                                class="w-full border-2 border-gray-400 rounded-md bg-white shadow-sm p-3 focus:border-blue-500 focus:ring focus:ring-blue-200"
                                required>
                        </div>

                        <div>
                            <label for="tka_pma"
                                class="block text-sm font-bold text-gray-700 uppercase tracking-wide mb-1">
                                TKA PMA
                            </label>
                            <input type="number" name="tka_pma" min="0"
                                class="w-full border-2 border-gray-400 rounded-md bg-white shadow-sm p-3 focus:border-blue-500 focus:ring focus:ring-blue-200"
                                required>
                        </div>
                    </div>
                </div>

                {{-- PMDN --}}
                <div>
                    <h3 class="text-lg font-semibold text-gray-700 mb-2 text-center">PMDN</h3>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div>
                            <label for="lkpm_pmdn"
                                class="block text-sm font-bold text-gray-700 uppercase tracking-wide mb-1">
                                LKPM PMDN
                            </label>
                            <input type="number" name="lkpm_pmdn" min="0"
                                class="w-full border-2 border-gray-400 rounded-md bg-white shadow-sm p-3 focus:border-blue-500 focus:ring focus:ring-blue-200"
                                required>
                        </div>

                        <div>
                            <label for="realisasi_pmdn"
                                class="block text-sm font-bold text-gray-700 uppercase tracking-wide mb-1">
                                Realisasi Investasi
                            </label>
                            <input type="text" id="realisasi_pmdn" name="realisasi_pmdn" autocomplete="off"
                                class="w-full border-2 border-gray-400 rounded-md bg-white shadow-sm p-3 focus:border-blue-500 focus:ring focus:ring-blue-200"
                                required>
                        </div>

                        <div>
                            <label for="tki_pmdn"
                                class="block text-sm font-bold text-gray-700 uppercase tracking-wide mb-1">
                                TKI PMDN
                            </label>
                            <input type="number" name="tki_pmdn" min="0"
                                class="w-full border-2 border-gray-400 rounded-md bg-white shadow-sm p-3 focus:border-blue-500 focus:ring focus:ring-blue-200"
                                required>
                        </div>

                        <div>
                            <label for="tka_pmdn"
                                class="block text-sm font-bold text-gray-700 uppercase tracking-wide mb-1">
                                TKA PMDN
                            </label>
                            <input type="number" name="tka_pmdn" min="0"
                                class="w-full border-2 border-gray-400 rounded-md bg-white shadow-sm p-3 focus:border-blue-500 focus:ring focus:ring-blue-200"
                                required>
                        </div>
                    </div>
                </div>

                {{-- Triwulan & Tahun --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 uppercase tracking-wide mb-1">
                            Triwulan
                        </label>
                        <select name="triwulan"
                            class="w-full border-2 border-gray-300 rounded-md bg-gray-100 text-gray-600 p-3 cursor-not-allowed"
                            disabled>
                            @for ($i = 1; $i <= 4; $i++)
                                <option value="{{ $i }}" {{ $i == $triwulan ? 'selected' : '' }}>
                                    Triwulan {{ $i }}
                                </option>
                            @endfor
                        </select>
                        <input type="hidden" name="triwulan" value="{{ $triwulan }}">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 uppercase tracking-wide mb-1">
                            Tahun
                        </label>
                        <input type="text" value="{{ $tahun }}" readonly
                            class="w-full border-2 border-gray-300 rounded-md bg-gray-100 text-gray-600 p-3 cursor-not-allowed">
                        <input type="hidden" name="tahun" value="{{ $tahun }}" min="2000">
                    </div>
                </div>

                {{-- Tombol --}}
                <div class="flex justify-end gap-4 pt-4">
                    <a href="{{ route('investasi_tampil_kabkota', ['triwulan' => $triwulan, 'tahun' => $tahun]) }}"
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

    {{-- AJAX untuk dinamis sektor berdasarkan kategori --}}
    <script>
        $('#kategori_sektor').on('change', function() {
            const kategoriID = $(this).val();
            if (kategoriID) {
                $.get('/get-sektor/' + kategoriID, function(data) {
                    $('#sektor_investasi').empty().append(
                        '<option value="" disabled selected hidden>-- Pilih Sektor --</option>');
                    data.forEach(function(item) {
                        if (!@json($sektorSudahAda).includes(item.id)) {
                            $('#sektor_investasi').append(
                                `<option value="${item.id}">${item.nama}</option>`
                            );
                        }
                    });
                });
            } else {
                $('#sektor_investasi').html(
                    '<option value="" disabled selected hidden>-- Pilih Sektor --</option>');
            }
        });
    </script>

    {{-- Cleave.js --}}
    <script>
        new Cleave('#realisasi_pma', {
            numeral: true,
            numeralThousandsGroupStyle: 'thousand',
            delimiter: '.',
            numeralDecimalMark: ','
        });

        new Cleave('#realisasi_pmdn', {
            numeral: true,
            numeralThousandsGroupStyle: 'thousand',
            delimiter: '.',
            numeralDecimalMark: ','
        });
    </script>

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
