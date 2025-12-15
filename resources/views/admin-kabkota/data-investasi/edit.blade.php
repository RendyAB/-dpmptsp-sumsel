@extends('template.header_admin_kabkota')
@section('titleadminkabkota', 'Edit Data Investasi Admin Kab/Kota - DPMPTSP Sumatera Selatan')
@section('konten_admin_kabkota')

    <div class="min-h-screen bg-gray-50 flex items-center justify-center py-8">
        <div class="w-full max-w-4xl bg-white rounded-2xl shadow-lg p-8">
            <h2 class="text-2xl font-bold text-center mb-6 text-gray-800">
                Edit Data Investasi – Triwulan {{ $triwulan }} Tahun {{ $tahun }}
            </h2>

            <form action="{{ route('investasi_update', $investasi->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                {{-- Kategori & Sektor --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 uppercase tracking-wide mb-1">
                            Kategori Sektor
                        </label>
                        <select name="kategori_sektor_id" id="kategori_sektor"
                            class="w-full border-2 border-gray-300 rounded-md bg-gray-100 text-gray-600 p-3 cursor-not-allowed"
                            disabled>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach ($kategori as $k)
                                <option value="{{ $k->id }}"
                                    {{ $k->id == $investasi->kategori_sektor_id ? 'selected' : '' }}>
                                    {{ $k->nama }}
                                </option>
                            @endforeach
                        </select>
                        <input type="hidden" name="kategori_sektor_id" value="{{ $investasi->kategori_sektor_id }}">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 uppercase tracking-wide mb-1">
                            Sektor Investasi
                        </label>
                        <select name="sektor_investasi_id" id="sektor_investasi"
                            class="w-full border-2 border-gray-300 rounded-md bg-gray-100 text-gray-600 p-3 cursor-not-allowed"
                            disabled>
                            <option value="">-- Pilih Sektor --</option>
                            @foreach ($sektor as $s)
                                <option value="{{ $s->id }}"
                                    {{ $s->id == $investasi->sektor_investasi_id ? 'selected' : '' }}>
                                    {{ $s->nama }}
                                </option>
                            @endforeach
                        </select>
                        <input type="hidden" name="sektor_investasi_id" value="{{ $investasi->sektor_investasi_id }}">
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
                            <input type="number" name="lkpm_pma" value="{{ old('lkpm_pma', $investasi->lkpm_pma) }}"
                                min="0"
                                class="w-full border-2 border-gray-400 rounded-md bg-white shadow-sm p-3 focus:border-blue-500 focus:ring focus:ring-blue-200"
                                required>
                        </div>

                        <div>
                            <label for="realisasi_pma"
                                class="block text-sm font-bold text-gray-700 uppercase tracking-wide mb-1">
                                Realisasi Investasi
                            </label>
                            <input type="text" id="realisasi_pma" name="realisasi_pma" autocomplete="off"
                                value="{{ old('realisasi_pma', $investasi->realisasi_pma) }}"
                                class="w-full border-2 border-gray-400 rounded-md bg-white shadow-sm p-3 focus:border-blue-500 focus:ring focus:ring-blue-200"
                                required>
                        </div>

                        <div>
                            <label for="tki_pma"
                                class="block text-sm font-bold text-gray-700 uppercase tracking-wide mb-1">
                                TKI PMA
                            </label>
                            <input type="number" name="tki_pma" value="{{ old('tki_pma', $investasi->tki_pma) }}"
                                min="0"
                                class="w-full border-2 border-gray-400 rounded-md bg-white shadow-sm p-3 focus:border-blue-500 focus:ring focus:ring-blue-200"
                                required>
                        </div>

                        <div>
                            <label for="tka_pma"
                                class="block text-sm font-bold text-gray-700 uppercase tracking-wide mb-1">
                                TKA PMA
                            </label>
                            <input type="number" name="tka_pma" value="{{ old('tka_pma', $investasi->tka_pma) }}"
                                min="0"
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
                            <input type="number" name="lkpm_pmdn" value="{{ old('lkpm_pmdn', $investasi->lkpm_pmdn) }}"
                                min="0"
                                class="w-full border-2 border-gray-400 rounded-md bg-white shadow-sm p-3 focus:border-blue-500 focus:ring focus:ring-blue-200"
                                required>
                        </div>

                        <div>
                            <label for="realisasi_pmdn"
                                class="block text-sm font-bold text-gray-700 uppercase tracking-wide mb-1">
                                Realisasi Investasi
                            </label>
                            <input type="text" id="realisasi_pmdn" name="realisasi_pmdn" autocomplete="off"
                                value="{{ old('realisasi_pmdn', $investasi->realisasi_pmdn) }}"
                                class="w-full border-2 border-gray-400 rounded-md bg-white shadow-sm p-3 focus:border-blue-500 focus:ring focus:ring-blue-200"
                                required>
                        </div>

                        <div>
                            <label for="tki_pmdn"
                                class="block text-sm font-bold text-gray-700 uppercase tracking-wide mb-1">
                                TKI PMDN
                            </label>
                            <input type="number" name="tki_pmdn" value="{{ old('tki_pmdn', $investasi->tki_pmdn) }}"
                                min="0"
                                class="w-full border-2 border-gray-400 rounded-md bg-white shadow-sm p-3 focus:border-blue-500 focus:ring focus:ring-blue-200"
                                required>
                        </div>

                        <div>
                            <label for="tka_pmdn"
                                class="block text-sm font-bold text-gray-700 uppercase tracking-wide mb-1">
                                TKA PMDN
                            </label>
                            <input type="number" name="tka_pmdn" value="{{ old('tka_pmdn', $investasi->tka_pmdn) }}"
                                min="0"
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
                            class="w-full border-2 border-gray-400 rounded-md bg-white shadow-sm p-3 focus:border-blue-500 focus:ring focus:ring-blue-200"
                            required>
                            @for ($i = 1; $i <= 4; $i++)
                                <option value="{{ $i }}" {{ $investasi->triwulan == $i ? 'selected' : '' }}>
                                    Triwulan {{ $i }}
                                </option>
                            @endfor
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 uppercase tracking-wide mb-1">
                            Tahun
                        </label>
                        <input type="number" name="tahun" value="{{ $investasi->tahun }}" min="2000"
                            class="w-full border-2 border-gray-400 rounded-md bg-white shadow-sm p-3 focus:border-blue-500 focus:ring focus:ring-blue-200"
                            required>
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
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>

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
