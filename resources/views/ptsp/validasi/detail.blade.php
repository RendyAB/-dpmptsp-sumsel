@extends('template.header_admin')

@section('titleadmin', 'Detail Validasi Perizinan - DPMPTSP Sumatera Selatan')

@section('konten')
    <div class="max-w-5xl mx-auto bg-white shadow-lg p-8 rounded-xl">

        <h1 class="text-3xl font-bold text-gray-800 mb-6 border-b pb-3">Detail Perizinan (Read-Only)</h1>

        {{-- FORM DIUBAH MENJADI DIV KARENA HANYA UNTUK TAMPILAN READ-ONLY --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <div class="col-span-2">
                <h2 class="text-lg font-semibold text-gray-700 mb-2">Informasi Surat</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Kepada</label>
                        <input type="text" name="kepada" class="w-full border p-2 rounded bg-gray-100 cursor-not-allowed"
                            value="Pejabat Fungsional Penata Perizinan Ahli Madya" readonly disabled maxlength="100">
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Perihal</label>
                        <input type="text" name="perihal"
                            class="w-full border p-2 rounded bg-gray-100 cursor-not-allowed"
                            value="Permintaan Verifikasi Terkait Permohonan Perizinan Berusaha OSS RBA" readonly disabled
                            maxlength="150">
                    </div>
                </div>
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Tanggal Proses</label>
                <input type="date" name="tanggal_proses" class="w-full border p-2 rounded bg-gray-100 cursor-not-allowed"
                    value="{{ $perizinan->tanggal_proses }}" readonly disabled>
            </div>

            <div class="col-span-2 mt-4">
                <h2 class="text-lg font-semibold text-gray-700 mb-2">Identitas Back Office</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Nama Petugas</label>
                        <input type="text" name="petugas"
                            class="w-full border p-2 rounded bg-gray-100 cursor-not-allowed"
                            value="{{ $perizinan->petugas }}" readonly disabled maxlength="50">
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-1">NIP</label>
                        <input type="text" name="nip"
                            class="w-full border p-2 rounded bg-gray-100 cursor-not-allowed" value="{{ $perizinan->nip }}"
                            readonly disabled maxlength="20">
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Jabatan</label>
                        <input type="text" name="jabatan"
                            class="w-full border p-2 rounded bg-gray-100 cursor-not-allowed"
                            value="{{ $perizinan->jabatan }}" readonly disabled maxlength="50">
                    </div>
                </div>
            </div>

            <div class="col-span-2 mt-4">
                <h2 class="text-lg font-semibold text-gray-700 mb-2">Data Perusahaan</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Nomor Permohonan</label>
                        <input type="text" name="no_pmh"
                            class="w-full border p-2 rounded bg-gray-100 cursor-not-allowed"
                            value="{{ $perizinan->no_pmh }}" readonly disabled maxlength="30">
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Nomor Kegiatan Usaha</label>
                        <input type="text" name="no_keg"
                            class="w-full border p-2 rounded bg-gray-100 cursor-not-allowed"
                            value="{{ $perizinan->no_keg }}" readonly disabled maxlength="30">
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Tanggal Permohonan</label>
                        <input type="date" name="tgl_pmh"
                            class="w-full border p-2 rounded bg-gray-100 cursor-not-allowed"
                            value="{{ $perizinan->tgl_pmh }}" readonly disabled>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Jenis Permohonan</label>
                        <select name="jenis_pmh" class="w-full border p-2 rounded bg-gray-100 cursor-not-allowed" disabled>
                            <option value="">-- Pilih --</option>
                            <option value="baru" {{ $perizinan->jenis_pmh == 'baru' ? 'selected' : '' }}>Baru</option>
                            <option value="perubahan" {{ $perizinan->jenis_pmh == 'perubahan' ? 'selected' : '' }}>Perubahan
                            </option>
                            <option value="perpanjang" {{ $perizinan->jenis_pmh == 'perpanjang' ? 'selected' : '' }}>
                                Perpanjang
                            </option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Nama Perusahaan</label>
                        <input type="text" name="nama_pers"
                            class="w-full border p-2 rounded bg-gray-100 cursor-not-allowed"
                            value="{{ $perizinan->nama_pers }}" readonly disabled maxlength="100">
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Jenis Perusahaan</label>
                        <select name="jenis_pers" class="w-full border p-2 rounded bg-gray-100 cursor-not-allowed" disabled>
                            <option value="">-- Pilih --</option>
                            <option value="perorangan" {{ $perizinan->jenis_pers == 'perorangan' ? 'selected' : '' }}>
                                Perorangan</option>
                            <option value="badan_usaha" {{ $perizinan->jenis_pers == 'badan_usaha' ? 'selected' : '' }}>
                                Badan
                                Usaha</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Jenis Kegiatan Usaha</label>
                        <select name="jenis_keg" class="w-full border p-2 rounded bg-gray-100 cursor-not-allowed" disabled>
                            <option value="">-- Pilih --</option>
                            <option value="utama" {{ $perizinan->jenis_keg == 'utama' ? 'selected' : '' }}>Utama</option>
                            <option value="pendukung" {{ $perizinan->jenis_keg == 'pendukung' ? 'selected' : '' }}>
                                Pendukung
                            </option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Nomor Induk Berusaha (NIB)</label>
                        <input type="text" name="nib"
                            class="w-full border p-2 rounded bg-gray-100 cursor-not-allowed" value="{{ $perizinan->nib }}"
                            readonly disabled maxlength="50">
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-1">NPWP</label>
                        <input type="text" name="npwp"
                            class="w-full border p-2 rounded bg-gray-100 cursor-not-allowed" value="{{ $perizinan->npwp }}"
                            readonly disabled maxlength="30">
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Sektor</label>
                        <select name="sektor" class="w-full border p-2 rounded bg-gray-100 cursor-not-allowed" disabled>
                            <option value="">-- Pilih Sektor --</option>
                            @foreach ($sektorPerizinan as $sek)
                                <option value="{{ $sek->id }}"
                                    {{ $perizinan->sektor == $sek->id ? 'selected' : '' }}>
                                    {{ $sek->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Luas Lahan</label>
                        <input type="text" name="luas"
                            class="w-full border p-2 rounded bg-gray-100 cursor-not-allowed"
                            value="{{ $perizinan->luas }}" readonly disabled maxlength="20">
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Skala Usaha</label>
                        <select name="skala" class="w-full border p-2 rounded bg-gray-100 cursor-not-allowed" disabled>
                            <option value="">-- Pilih --</option>
                            <option value="kecil" {{ $perizinan->skala == 'kecil' ? 'selected' : '' }}>Kecil</option>
                            <option value="mikro" {{ $perizinan->skala == 'mikro' ? 'selected' : '' }}>Mikro</option>
                            <option value="besar" {{ $perizinan->skala == 'besar' ? 'selected' : '' }}>Besar</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Risiko</label>
                        <select name="risiko" class="w-full border p-2 rounded bg-gray-100 cursor-not-allowed" disabled>
                            <option value="">-- Pilih --</option>
                            <option value="rendah" {{ $perizinan->risiko == 'rendah' ? 'selected' : '' }}>Rendah</option>
                            <option value="menengah_rendah"
                                {{ $perizinan->risiko == 'menengah_rendah' ? 'selected' : '' }}>
                                Menengah Rendah</option>
                            <option value="menengah_tinggi"
                                {{ $perizinan->risiko == 'menengah_tinggi' ? 'selected' : '' }}>
                                Menengah Tinggi</option>
                            <option value="tinggi" {{ $perizinan->risiko == 'tinggi' ? 'selected' : '' }}>Tinggi</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-1">KBLI</label>
                        <input type="text" name="kbli"
                            class="w-full border p-2 rounded bg-gray-100 cursor-not-allowed"
                            value="{{ $perizinan->kbli }}" readonly disabled maxlength="50">
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Nama Perizinan</label>
                        <input type="text" name="nama_izin"
                            class="w-full border p-2 rounded bg-gray-100 cursor-not-allowed"
                            value="{{ $perizinan->nama_izin }}" readonly disabled maxlength="100">
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Penanggung Jawab Perusahaan</label>
                        <input type="text" name="pj_pers"
                            class="w-full border p-2 rounded bg-gray-100 cursor-not-allowed"
                            value="{{ $perizinan->pj_pers }}" readonly disabled maxlength="50">
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Alamat Lokasi Usaha</label>
                        <input type="text" name="alamat"
                            class="w-full border p-2 rounded bg-gray-100 cursor-not-allowed"
                            value="{{ $perizinan->alamat }}" readonly disabled maxlength="150">
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Kabupaten/Kota</label>
                        <select name="kab" class="w-full border p-2 rounded bg-gray-100 cursor-not-allowed" disabled>
                            <option value="">-- Pilih Kabupaten/Kota --</option>
                            @foreach ($kabkota as $kab)
                                <option value="{{ $kab->id }}" {{ $perizinan->kab == $kab->id ? 'selected' : '' }}>
                                    {{ $kab->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-1">No Telepon</label>
                        <input type="text" name="no_telp"
                            class="w-full border p-2 rounded bg-gray-100 cursor-not-allowed"
                            value="{{ $perizinan->no_telp }}" readonly disabled maxlength="20">
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Email</label>
                        <input type="email" name="email"
                            class="w-full border p-2 rounded bg-gray-100 cursor-not-allowed"
                            value="{{ $perizinan->email }}" readonly disabled maxlength="50">
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Modal Usaha</label>
                        <input type="text" name="modal"
                            class="w-full border p-2 rounded bg-gray-100 cursor-not-allowed"
                            value="{{ $perizinan->modal }}" readonly disabled maxlength="50">
                    </div>

                </div>
            </div>

            <div class="col-span-2 mt-6">
                <h2 class="text-lg font-semibold text-gray-700 mb-2">Dokumen & Verifikasi</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Dokumen Persyaratan</label>
                        <input type="text" name="dokumen"
                            class="w-full border p-2 rounded bg-gray-100 cursor-not-allowed"
                            value="{{ $perizinan->dokumen }}" readonly disabled maxlength="100">
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Jumlah Dokumen</label>
                        <textarea name="jumlah_dok" class="w-full border p-2 rounded bg-gray-100 cursor-not-allowed" rows="2" readonly
                            disabled maxlength="200">{{ $perizinan->jumlah_dok }}</textarea>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Jenis Dokumen Persyaratan</label>
                        {{-- Mengubah input type="file" menjadi tampilan teks/link --}}
                        <input type="text" class="w-full border p-2 rounded bg-gray-100 cursor-not-allowed"
                            value="{{ $perizinan->jenis_dok ? 'File tersedia' : 'Tidak ada file' }}" readonly disabled>
                        @if ($perizinan->jenis_dok)
                            <a href="{{ asset('storage/' . $perizinan->jenis_dok) }}" target="_blank"
                                class="text-blue-600 underline mt-1 block">Lihat file saat ini</a>
                        @endif
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Nomor Surat Verifikasi</label>
                        <input type="text" name="no_verif"
                            class="w-full border p-2 rounded bg-gray-100 cursor-not-allowed"
                            value="{{ $perizinan->no_verif }}" readonly disabled maxlength="50">
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Tanggal Verifikasi Teknis</label>
                        <input type="date" name="tgl_verif"
                            class="w-full border p-2 rounded bg-gray-100 cursor-not-allowed"
                            value="{{ $perizinan->tgl_verif }}" readonly disabled>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Dokumen Verifikasi</label>
                        {{-- Mengubah input type="file" menjadi tampilan teks/link --}}
                        <input type="text" class="w-full border p-2 rounded bg-gray-100 cursor-not-allowed"
                            value="{{ $perizinan->dok_verif ? 'File tersedia' : 'Tidak Ada File' }}" readonly disabled>
                        @if ($perizinan->dok_verif)
                            <a href="{{ asset('storage/' . $perizinan->dok_verif) }}" target="_blank"
                                class="text-blue-600 underline mt-1 block">Lihat file saat ini</a>
                        @endif
                    </div>
                    {{-- <div>
                <label class="block text-gray-700 font-medium mb-1">Catatan</label>
                <input type="text" name="catatan" class="w-full border p-2 rounded bg-gray-100 "
                    value="{{ $perizinan->catatan }}">
            </div> --}}
                    <div>
                        <h3 class="font-bold mb-2">Catatan</h3>
                        <ul>
                            @foreach ($validasiLogs as $log)
                                <input type="text" class="w-full border p-2 rounded bg-gray-100"
                                    value="{{ $log->catatan }}">
                            @endforeach
                        </ul>

                    </div>
                </div>
            </div>


            <div class="flex gap-4 mt-2">

                <form action="{{ route('perizinan2.validasi.approve', $validasi->id) }}" method="POST">
                    @csrf
                    <button class="bg-green-600 text-white px-5 py-2 rounded-lg hover:bg-green-700">
                        Setuju
                    </button>
                </form>

                <form action="{{ route('perizinan2.validasi.revisi', $validasi->id) }}" method="POST">
                    @csrf
                    <button class="bg-yellow-500 text-white px-5 py-2 rounded-lg hover:bg-yellow-600">
                        Kembalikan
                    </button>
                </form>

                <form action="{{ route('perizinan2.validasi.reject', $validasi->id) }}" method="POST">
                    @csrf
                    <button class="bg-red-600 text-white px-5 py-2 rounded-lg hover:bg-red-700">
                        Tolak
                    </button>
                </form>

            </div>

        </div>
    @endsection
