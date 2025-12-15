@extends('template.header_admin')

@section('titleadmin', 'Edit Perizinan - DPMPTSP Sumatera Selatan')

@section('konten')
    <div class="max-w-5xl mx-auto bg-white shadow-lg p-8 rounded-xl">

        <h1 class="text-3xl font-bold text-gray-800 mb-6">Edit Perizinan</h1>

        <form action="{{ route('perizinan_2.update', $perizinan->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- INFORMASI SURAT --}}
                <div class="col-span-2">
                    <h2 class="text-lg font-semibold text-gray-700 mb-2">Informasi Surat</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Kepada</label>
                            <input type="text" class="w-full border p-2 rounded bg-gray-100"
                                value="Pejabat Fungsional Penata Perizinan Ahli Madya" readonly>
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Perihal</label>
                            <input type="text" class="w-full border p-2 rounded bg-gray-100"
                                value="Permintaan Verifikasi Terkait Permohonan Perizinan Berusaha OSS RBA" readonly>
                        </div>
                    </div>
                </div>

                {{-- TANGGAL PROSES --}}
                <div>
                    <label class="block text-gray-700 font-medium mb-1">Tanggal Proses</label>
                    <input type="date" name="tanggal_proses" class="w-full border p-2 rounded"
                        value="{{ $perizinan->tanggal_proses }}">
                </div>

                {{-- IDENTITAS PETUGAS --}}
                <div class="col-span-2 mt-4">
                    <h2 class="text-lg font-semibold text-gray-700 mb-2">Identitas Back Office</h2>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Nama Petugas</label>
                            <input type="text" class="w-full border p-2 rounded bg-gray-100"
                                value="{{ $perizinan->petugas }}" readonly>
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">NIP</label>
                            <input type="text" class="w-full border p-2 rounded bg-gray-100"
                                value="{{ $perizinan->nip }}" readonly>
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Jabatan</label>
                            <input type="text" class="w-full border p-2 rounded bg-gray-100"
                                value="{{ $perizinan->jabatan }}" readonly>
                        </div>
                    </div>
                </div>

                {{-- DATA PERUSAHAAN --}}
                <div class="col-span-2 mt-4">
                    <h2 class="text-lg font-semibold text-gray-700 mb-2">Data Perusahaan</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Nomor Permohonan</label>
                            <input type="text" name="no_pmh" class="w-full border p-2 rounded"
                                value="{{ $perizinan->no_pmh }}">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Nomor Kegiatan Usaha</label>
                            <input type="text" name="no_keg" class="w-full border p-2 rounded"
                                value="{{ $perizinan->no_keg }}">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Tanggal Permohonan</label>
                            <input type="date" name="tgl_pmh" class="w-full border p-2 rounded"
                                value="{{ $perizinan->tgl_pmh }}">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Jenis Permohonan</label>
                            <select name="jenis_pmh" class="w-full border p-2 rounded">
                                <option value="">-- Pilih --</option>
                                <option value="baru" {{ $perizinan->jenis_pmh == 'baru' ? 'selected' : '' }}>Baru</option>
                                <option value="perubahan" {{ $perizinan->jenis_pmh == 'perubahan' ? 'selected' : '' }}>
                                    Perubahan</option>
                                <option value="perpanjang" {{ $perizinan->jenis_pmh == 'perpanjang' ? 'selected' : '' }}>
                                    Perpanjang</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Nama Perusahaan</label>
                            <input type="text" name="nama_pers" class="w-full border p-2 rounded"
                                value="{{ $perizinan->nama_pers }}">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Jenis Perusahaan</label>
                            <select name="jenis_pers" class="w-full border p-2 rounded">
                                <option value="">-- Pilih --</option>
                                <option value="perorangan" {{ $perizinan->jenis_pers == 'perorangan' ? 'selected' : '' }}>
                                    Perorangan</option>
                                <option value="badan_usaha"
                                    {{ $perizinan->jenis_pers == 'badan_usaha' ? 'selected' : '' }}>Badan Usaha</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Jenis Kegiatan Usaha</label>
                            <select name="jenis_keg" class="w-full border p-2 rounded">
                                <option value="">-- Pilih --</option>
                                <option value="utama" {{ $perizinan->jenis_keg == 'utama' ? 'selected' : '' }}>Utama
                                </option>
                                <option value="pendukung" {{ $perizinan->jenis_keg == 'pendukung' ? 'selected' : '' }}>
                                    Pendukung</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">NIB</label>
                            <input type="text" name="nib" class="w-full border p-2 rounded"
                                value="{{ $perizinan->nib }}">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">NPWP</label>
                            <input type="text" name="npwp" class="w-full border p-2 rounded"
                                value="{{ $perizinan->npwp }}">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Sektor</label>
                            <select name="sektor" class="w-full border p-2 rounded">
                                <option value="">-- Pilih Sektor --</option>
                                @foreach ($sektorPerizinan as $sek)
                                    <option value="{{ $sek->id }}"
                                        {{ $perizinan->sektor == $sek->id ? 'selected' : '' }}>
                                        {{ $sek->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Luas Lahan</label>
                            <input type="text" name="luas" class="w-full border p-2 rounded"
                                value="{{ $perizinan->luas }}">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Skala Usaha</label>
                            <select name="skala" class="w-full border p-2 rounded">
                                <option value="">-- Pilih --</option>
                                <option value="kecil" {{ $perizinan->skala == 'kecil' ? 'selected' : '' }}>Kecil</option>
                                <option value="mikro" {{ $perizinan->skala == 'mikro' ? 'selected' : '' }}>Mikro</option>
                                <option value="besar" {{ $perizinan->skala == 'besar' ? 'selected' : '' }}>Besar</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Risiko</label>
                            <select name="risiko" class="w-full border p-2 rounded">
                                <option value="">-- Pilih --</option>
                                <option value="rendah" {{ $perizinan->risiko == 'rendah' ? 'selected' : '' }}>Rendah
                                </option>
                                <option value="menengah_rendah"
                                    {{ $perizinan->risiko == 'menengah_rendah' ? 'selected' : '' }}>Menengah Rendah
                                </option>
                                <option value="menengah_tinggi"
                                    {{ $perizinan->risiko == 'menengah_tinggi' ? 'selected' : '' }}>Menengah Tinggi
                                </option>
                                <option value="tinggi" {{ $perizinan->risiko == 'tinggi' ? 'selected' : '' }}>Tinggi
                                </option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">KBLI</label>
                            <input type="text" name="kbli" class="w-full border p-2 rounded"
                                value="{{ $perizinan->kbli }}">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Nama Perizinan</label>
                            <input type="text" name="nama_izin" class="w-full border p-2 rounded"
                                value="{{ $perizinan->nama_izin }}">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Penanggung Jawab</label>
                            <input type="text" name="pj_pers" class="w-full border p-2 rounded"
                                value="{{ $perizinan->pj_pers }}">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Alamat Lokasi Usaha</label>
                            <input type="text" name="alamat" class="w-full border p-2 rounded"
                                value="{{ $perizinan->alamat }}">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Kabupaten/Kota</label>
                            <select name="kab" class="w-full border p-2 rounded">
                                <option value="">-- Pilih Kabupaten/Kota --</option>
                                @foreach ($kabkota as $kab)
                                    <option value="{{ $kab->id }}"
                                        {{ $perizinan->kab == $kab->id ? 'selected' : '' }}>
                                        {{ $kab->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">No Telepon</label>
                            <input type="text" name="no_telp" class="w-full border p-2 rounded"
                                value="{{ $perizinan->no_telp }}">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Email</label>
                            <input type="email" name="email" class="w-full border p-2 rounded"
                                value="{{ $perizinan->email }}">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Modal Usaha</label>
                            <input type="text" name="modal" class="w-full border p-2 rounded"
                                value="{{ $perizinan->modal }}">
                        </div>

                    </div>
                </div>

                {{-- DOKUMEN & VERIFIKASI --}}
                <div class="col-span-2 mt-6">
                    <h2 class="text-lg font-semibold text-gray-700 mb-2">Dokumen & Verifikasi</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Dokumen Persyaratan</label>
                            <input type="text" name="dokumen" class="w-full border p-2 rounded"
                                value="{{ $perizinan->dokumen }}">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Jumlah Dokumen</label>
                            <textarea name="jumlah_dok" class="w-full border p-2 rounded" rows="2">{{ $perizinan->jumlah_dok }}</textarea>
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Upload Dokumen Persyaratan</label>
                            <input type="file" name="jenis_dok" class="w-full border p-2 rounded">

                            @if ($perizinan->jenis_dok)
                                <a href="{{ asset('storage/' . $perizinan->jenis_dok) }}" target="_blank"
                                    class="text-blue-600 underline mt-1 inline-block">Lihat file saat ini</a>
                            @endif
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Nomor Surat Verifikasi</label>
                            <input type="text" name="no_verif" class="w-full border p-2 rounded"
                                value="{{ $perizinan->no_verif }}">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Tanggal Verifikasi Teknis</label>
                            <input type="date" name="tgl_verif" class="w-full border p-2 rounded"
                                value="{{ $perizinan->tgl_verif }}">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Upload Dokumen Verifikasi</label>
                            <input type="file" name="dok_verif" class="w-full border p-2 rounded">

                            @if ($perizinan->dok_verif)
                                <a href="{{ asset('storage/' . $perizinan->dok_verif) }}" target="_blank"
                                    class="text-blue-600 underline mt-1 inline-block">Lihat file saat ini</a>
                            @endif
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Status</label>
                            <select name="status" class="w-full border p-2 rounded">
                                <option value="menunggu" {{ $perizinan->status == 'menunggu' ? 'selected' : '' }}>Menunggu
                                </option>
                                <option value="disetujui" {{ $perizinan->status == 'disetujui' ? 'selected' : '' }}>
                                    Disetujui</option>
                                <option value="dikembalikan" {{ $perizinan->status == 'dikembalikan' ? 'selected' : '' }}>
                                    Dikembalikan</option>
                                <option value="ditolak" {{ $perizinan->status == 'ditolak' ? 'selected' : '' }}>Ditolak
                                </option>
                            </select>
                        </div>

                    </div>
                </div>

            </div>

            <div class="mt-6 flex gap-3">
                <a href="{{ route('perizinan_2.index') }}"
                    class="bg-gray-600 hover:bg-gray-700 text-white px-5 py-2 rounded-lg shadow">
                    Kembali
                </a>

                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg shadow">
                    Simpan Data
                </button>
            </div>

        </form>

    </div>
@endsection
