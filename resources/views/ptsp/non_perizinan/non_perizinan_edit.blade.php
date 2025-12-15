@extends('template.header_admin')

@section('titleadmin', 'Edit Non-Perizinan - DPMPTSP Sumatera Selatan')

@section('konten')
    <div class="max-w-5xl mx-auto bg-white shadow-lg p-8 rounded-xl">

        <h1 class="text-3xl font-bold text-gray-800 mb-6">Edit Non Perizinan</h1>

        <form action="{{ route('non_perizinan.update', $non->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- GRID UTAMA --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- KEPADA & PERIHAL --}}
                <div class="col-span-2">
                    <h2 class="text-lg font-semibold text-gray-700 mb-2">Informasi Surat</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-gray-700 mb-1 font-medium">Kepada</label>
                            <input type="text" name="kepada" class="w-full border p-2 rounded bg-gray-100"
                                value="{{ old('kepada', $non->kepada) }}" readonly>
                        </div>

                        <div>
                            <label class="block text-gray-700 mb-1 font-medium">Perihal</label>
                            <input type="text" name="perihal" class="w-full border p-2 rounded bg-gray-100"
                                value="{{ old('perihal', $non->perihal) }}" readonly>
                        </div>
                    </div>
                </div>

                {{-- TANGGAL PROSES --}}
                <div>
                    <label class="block text-gray-700 mb-1 font-medium">Tanggal Proses</label>
                    <input type="date" name="tanggal_proses" class="w-full border p-2 rounded"
                        value="{{ old('tanggal_proses', $non->tanggal_proses) }}">
                </div>

                {{-- IDENTITAS PETUGAS --}}
                <div class="col-span-2">
                    <h2 class="text-lg font-semibold text-gray-700 mb-2">Identitas Back Office</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-gray-700 mb-1 font-medium">Nama Petugas</label>
                            <input type="text" name="petugas" class="w-full border p-2 rounded bg-gray-100"
                                value="{{ old('petugas', $petugas) }}" readonly>
                        </div>

                        <div>
                            <label class="block text-gray-700 mb-1 font-medium">NIP</label>
                            <input type="text" name="nip" class="w-full border p-2 rounded bg-gray-100"
                                value="{{ old('nip', $nip) }}" readonly>
                        </div>

                        <div>
                            <label class="block text-gray-700 mb-1 font-medium">Jabatan</label>
                            <input type="text" name="jabatan" class="w-full border p-2 rounded bg-gray-100"
                                value="{{ old('jabatan', $jabatan) }}" readonly>
                        </div>
                    </div>
                </div>

                {{-- DATA PERUSAHAAN --}}
                <div class="col-span-2 mt-4">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">No. Agenda</label>
                            <input type="text" name="no_agenda" class="w-full border p-2 rounded"
                                value="{{ old('no_agenda', $non->no_agenda) }}">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">No. Surat</label>
                            <input type="text" name="no_surat" class="w-full border p-2 rounded"
                                value="{{ old('no_surat', $non->no_surat) }}">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Jenis Izin</label>
                            <input type="text" name="jenis_izin" class="w-full border p-2 rounded"
                                value="{{ old('jenis_izin', $non->jenis_izin) }}">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">No. Izin</label>
                            <input type="text" name="no_izin" class="w-full border p-2 rounded"
                                value="{{ old('no_izin', $non->no_izin) }}">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Nama Kapal</label>
                            <input type="text" name="nama_kapal" class="w-full border p-2 rounded"
                                value="{{ old('nama_kapal', $non->nama_kapal) }}">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">NIB</label>
                            <input type="text" name="nib" class="w-full border p-2 rounded"
                                value="{{ old('nib', $non->nib) }}">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">ID Izin</label>
                            <input type="text" name="id_izin" class="w-full border p-2 rounded"
                                value="{{ old('id_izin', $non->id_izin) }}">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Tanggal Permohonan</label>
                            <input type="date" name="tgl_pmh" class="w-full border p-2 rounded"
                                value="{{ old('tgl_pmh', $non->tgl_pmh) }}">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Tanggal Terima</label>
                            <input type="date" name="tgl_terima" class="w-full border p-2 rounded"
                                value="{{ old('tgl_terima', $non->tgl_terima) }}">
                        </div>

                        <!-- Dropdown Jenis Permohonan -->
                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Jenis Permohonan</label>
                            <select name="jenis_pmh" class="w-full border p-2 rounded">
                                <option value="">-- Pilih --</option>
                                <option value="baru" {{ old('jenis_pmh', $non->jenis_pmh) == 'baru' ? 'selected' : '' }}>
                                    Baru</option>
                                <option value="perubahan"
                                    {{ old('jenis_pmh', $non->jenis_pmh) == 'perubahan' ? 'selected' : '' }}>
                                    Perubahan
                                </option>
                                <option value="perpanjang"
                                    {{ old('jenis_pmh', $non->jenis_pmh) == 'perpanjang' ? 'selected' : '' }}>Perpanjang
                                </option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Cek Fisik</label>
                            <input type="text" name="cek_fisik" class="w-full border p-2 rounded"
                                value="{{ old('cek_fisik', $non->cek_fisik) }}">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">ID OSS</label>
                            <input type="text" name="id_oss" class="w-full border p-2 rounded"
                                value="{{ old('id_oss', $non->id_oss) }}">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">ID Proyek</label>
                            <input type="text" name="id_proyek" class="w-full border p-2 rounded"
                                value="{{ old('id_proyek', $non->id_proyek) }}">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Nama Pemilik</label>
                            <input type="text" name="nama_pemilik" class="w-full border p-2 rounded"
                                value="{{ old('nama_pemilik', $non->nama_pemilik) }}">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">No. Usaha</label>
                            <input type="text" name="no_usaha" class="w-full border p-2 rounded"
                                value="{{ old('no_usaha', $non->no_usaha) }}">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Tanggal Izin</label>
                            <input type="date" name="tgl_izin" class="w-full border p-2 rounded"
                                value="{{ old('tgl_izin', $non->tgl_izin) }}">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Alamat</label>
                            <textarea name="alamat" class="w-full border p-2 rounded">{{ old('alamat', $non->alamat) }}</textarea>
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">NPWP</label>
                            <input type="text" name="npwp" class="w-full border p-2 rounded"
                                value="{{ old('npwp', $non->npwp) }}">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">NIK</label>
                            <input type="text" name="nik" class="w-full border p-2 rounded"
                                value="{{ old('nik', $non->nik) }}">
                        </div>

                        <!-- Dropdown Jenis Perusahaan -->
                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Jenis Perusahaan</label>
                            <select name="jenis_pers" class="w-full border p-2 rounded">
                                <option value="">-- Pilih --</option>
                                <option value="perorangan"
                                    {{ old('jenis_pers', $non->jenis_pers) == 'perorangan' ? 'selected' : '' }}>Perorangan
                                </option>
                                <option value="badan_usaha"
                                    {{ old('jenis_pers', $non->jenis_pers) == 'badan_usaha' ? 'selected' : '' }}>Badan
                                    Usaha
                                </option>
                            </select>
                        </div>

                        <!-- Dropdown Jenis Kegiatan Usaha -->
                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Jenis Kegiatan Usaha</label>
                            <select name="jenis_keg" class="w-full border p-2 rounded">
                                <option value="">-- Pilih --</option>
                                <option value="utama"
                                    {{ old('jenis_keg', $non->jenis_keg) == 'utama' ? 'selected' : '' }}>
                                    Utama</option>
                                <option value="pendukung"
                                    {{ old('jenis_keg', $non->jenis_keg) == 'pendukung' ? 'selected' : '' }}>Pendukung
                                </option>
                            </select>
                        </div>

                        <!-- Dropdown Sektor -->
                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Sektor</label>
                            <select name="sektor" class="w-full border p-2 rounded">
                                <option value="">-- Pilih Sektor --</option>
                                @foreach ($sektorPerizinan as $sek)
                                    <option value="{{ $sek->id }}"
                                        {{ old('sektor', $non->sektor) == $sek->id ? 'selected' : '' }}>
                                        {{ $sek->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Dropdown Skala Usaha -->
                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Skala Usaha</label>
                            <select name="skala" class="w-full border p-2 rounded">
                                <option value="">-- Pilih --</option>
                                <option value="mikro" {{ old('skala', $non->skala) == 'mikro' ? 'selected' : '' }}>Mikro
                                </option>
                                <option value="kecil" {{ old('skala', $non->skala) == 'kecil' ? 'selected' : '' }}>Kecil
                                </option>
                                <option value="besar" {{ old('skala', $non->skala) == 'besar' ? 'selected' : '' }}>Besar
                                </option>
                            </select>
                        </div>

                        <!-- Dropdown Risiko -->
                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Risiko</label>
                            <select name="risiko" class="w-full border p-2 rounded">
                                <option value="">-- Pilih --</option>
                                <option value="rendah" {{ old('risiko', $non->risiko) == 'rendah' ? 'selected' : '' }}>
                                    Rendah
                                </option>
                                <option value="menengah_rendah"
                                    {{ old('risiko', $non->risiko) == 'menengah_rendah' ? 'selected' : '' }}>Menengah
                                    Rendah
                                </option>
                                <option value="menengah_tinggi"
                                    {{ old('risiko', $non->risiko) == 'menengah_tinggi' ? 'selected' : '' }}>Menengah
                                    Tinggi
                                </option>
                                <option value="tinggi" {{ old('risiko', $non->risiko) == 'tinggi' ? 'selected' : '' }}>
                                    Tinggi
                                </option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">KBLI</label>
                            <input type="text" name="kbli" class="w-full border p-2 rounded"
                                value="{{ old('kbli', $non->kbli) }}">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Alamat Lokasi</label>
                            <textarea name="alamat_lokasi" class="w-full border p-2 rounded">{{ old('alamat_lokasi', $non->alamat_lokasi) }}</textarea>
                        </div>

                        <!-- Dropdown Kabupaten/Kota -->
                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Kabupaten/Kota</label>
                            <select name="kab" class="w-full border p-2 rounded">
                                <option value="">-- Pilih Kabupaten/Kota --</option>
                                @foreach ($kabkota as $kab)
                                    <option value="{{ $kab->id }}"
                                        {{ old('kab', $non->kab) == $kab->id ? 'selected' : '' }}>
                                        {{ $kab->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">No. Telepon</label>
                            <input type="text" name="no_telp" class="w-full border p-2 rounded"
                                value="{{ old('no_telp', $non->no_telp) }}">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Email</label>
                            <input type="email" name="email" class="w-full border p-2 rounded"
                                value="{{ old('email', $non->email) }}">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Investasi</label>
                            <input type="number" step="0.01" name="investasi" class="w-full border p-2 rounded"
                                value="{{ old('investasi', $non->investasi) }}">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Dokumen</label>
                            <input type="text" name="dokumen" class="w-full border p-2 rounded"
                                value="{{ old('dokumen', $non->dokumen) }}">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Jumlah Dokumen</label>
                            <input type="text" name="jumlah_dok" class="w-full border p-2 rounded"
                                value="{{ old('jumlah_dok', $non->jumlah_dok) }}">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Jenis Dokumen</label>
                            <input type="text" name="jenis_dok" class="w-full border p-2 rounded"
                                value="{{ old('jenis_dok', $non->jenis_dok) }}">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">No. Verifikasi</label>
                            <input type="text" name="no_verif" class="w-full border p-2 rounded"
                                value="{{ old('no_verif', $non->no_verif) }}">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Tanggal Verifikasi</label>
                            <input type="date" name="tgl_verif" class="w-full border p-2 rounded"
                                value="{{ old('tgl_verif', $non->tgl_verif) }}">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Dokumen Verifikasi</label>
                            <input type="text" name="dok_verif" class="w-full border p-2 rounded"
                                value="{{ old('dok_verif', $non->dok_verif) }}">
                        </div>

                        <!-- Dropdown Status -->
                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Status</label>
                            <select name="status" class="w-full border p-2 rounded">
                                <option value="menunggu"
                                    {{ old('status', $non->status) == 'menunggu' ? 'selected' : '' }}>
                                    Menunggu</option>
                                <option value="disetujui"
                                    {{ old('status', $non->status) == 'disetujui' ? 'selected' : '' }}>
                                    Disetujui</option>
                                <option value="dikembalikan"
                                    {{ old('status', $non->status) == 'dikembalikan' ? 'selected' : '' }}>Dikembalikan
                                </option>
                                <option value="ditolak" {{ old('status', $non->status) == 'ditolak' ? 'selected' : '' }}>
                                    Ditolak
                                </option>
                            </select>
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-gray-700 font-medium mb-1">Catatan</label>
                            <textarea name="catatan" class="w-full border p-2 rounded">{{ old('catatan', $non->catatan) }}</textarea>
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Tanggal Terbit</label>
                            <input type="date" name="tgl_terbit" class="w-full border p-2 rounded"
                                value="{{ old('tgl_terbit', $non->tgl_terbit) }}">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Keterangan Status</label>
                            <input type="text" name="ket_status" class="w-full border p-2 rounded"
                                value="{{ old('ket_status', $non->ket_status) }}">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">PDF File (opsional)</label>
                            <input type="file" name="pdf_file" class="w-full border p-2 rounded">
                            <p class="text-sm text-gray-600 mt-1">Kosongkan jika tidak ingin mengganti file.</p>
                        </div>

                    </div>

                    <div class="mt-6 flex gap-3">
                        <a href="{{ route('non_perizinan.index') }}"
                            class="bg-gray-600 hover:bg-gray-700 text-white px-5 py-2 rounded-lg shadow">
                            Kembali
                        </a>

                        <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg shadow">
                            Simpan Data
                        </button>
                    </div>

        </form>
    </div>
@endsection
