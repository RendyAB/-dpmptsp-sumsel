@extends('template.header_admin')

@section('titleadmin', 'Tambah Perizinan - DPMPTSP Sumatera Selatan')

@section('konten')
    <div class="max-w-5xl mx-auto bg-white shadow-lg p-8 rounded-xl">

        <h1 class="text-3xl font-bold text-gray-800 mb-6">Tambah Perizinan</h1>

        <form action="{{ route('perizinan_2.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- GRID UTAMA --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- KEPADA & PERIHAL --}}
                <div class="col-span-2">
                    <h2 class="text-lg font-semibold text-gray-700 mb-2">Informasi Surat</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-gray-700 mb-1 font-medium">Kepada</label>
                            <input type="text" name="kepada" class="w-full border p-2 rounded bg-gray-100"
                                value="Pejabat Fungsional Penata Perizinan Ahli Madya" readonly>
                        </div>

                        <div>
                            <label class="block text-gray-700 mb-1 font-medium">Perihal</label>
                            <input type="text" name="perihal" class="w-full border p-2 rounded bg-gray-100"
                                value="Permintaan Verifikasi Terkait Permohonan Perizinan Berusaha OSS RBA" readonly>
                        </div>
                    </div>
                </div>

                {{-- TANGGAL PROSES --}}
                <div>
                    <label class="block text-gray-700 mb-1 font-medium">Tanggal Proses</label>
                    <input type="date" name="tanggal_proses" class="w-full border p-2 rounded">
                </div>

                {{-- IDENTITAS PETUGAS --}}
                <div class="col-span-2">
                    <h2 class="text-lg font-semibold text-gray-700 mb-2">Identitas Back Office</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-gray-700 mb-1 font-medium">Nama Petugas</label>
                            <input type="text" name="petugas" class="w-full border p-2 rounded bg-gray-100"
                                value="{{ $petugas }}" readonly>
                        </div>

                        <div>
                            <label class="block text-gray-700 mb-1 font-medium">NIP</label>
                            <input type="text" name="nip" class="w-full border p-2 rounded bg-gray-100"
                                value="{{ $nip }}" readonly>
                        </div>

                        <div>
                            <label class="block text-gray-700 mb-1 font-medium">Jabatan</label>
                            <input type="text" name="jabatan" class="w-full border p-2 rounded bg-gray-100"
                                value="{{ $jabatan }}" readonly>
                        </div>
                    </div>
                </div>

                {{-- DATA PERUSAHAAN --}}
                <div class="col-span-2 mt-4">
                    <h2 class="text-lg font-semibold text-gray-700 mb-2">Data Perusahaan</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Nomor Permohonan</label>
                            <input type="text" name="no_pmh" class="w-full border p-2 rounded">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Nomor Kegiatan Usaha</label>
                            <input type="text" name="no_keg" class="w-full border p-2 rounded">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Tanggal Permohonan</label>
                            <input type="date" name="tgl_pmh" class="w-full border p-2 rounded">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Jenis Permohonan</label>
                            <select name="jenis_pmh" class="w-full border p-2 rounded">
                                <option value="">-- Pilih --</option>
                                <option value="baru">Baru</option>
                                <option value="perubahan">Perubahan</option>
                                <option value="perpanjang">Perpanjang</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Nama Perusahaan</label>
                            <input type="text" name="nama_pers" class="w-full border p-2 rounded">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Jenis Perusahaan</label>
                            <select name="jenis_pers" class="w-full border p-2 rounded">
                                <option value="">-- Pilih --</option>
                                <option value="perorangan">Perorangan</option>
                                <option value="badan_usaha">Badan Usaha</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Jenis Kegiatan Usaha</label>
                            <select name="jenis_keg" class="w-full border p-2 rounded">
                                <option value="">-- Pilih --</option>
                                <option value="utama">Utama</option>
                                <option value="pendukung">Pendukung</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Nomor Induk Berusaha (NIB)</label>
                            <input type="text" name="nib" class="w-full border p-2 rounded">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">NPWP</label>
                            <input type="text" name="npwp" class="w-full border p-2 rounded">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Sektor</label>
                            <select name="sektor" class="w-full border p-2 rounded">
                                <option value="">-- Pilih Sektor --</option>
                                @foreach ($sektorPerizinan as $sek)
                                    <option value="{{ $sek->id }}">{{ $sek->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Luas Lahan</label>
                            <input type="text" name="luas" class="w-full border p-2 rounded">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Skala Usaha</label>
                            <select name="skala" class="w-full border p-2 rounded">
                                <option value="">-- Pilih --</option>
                                <option value="kecil">Kecil</option>
                                <option value="mikro">Mikro</option>
                                <option value="besar">Besar</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Risiko</label>
                            <select name="risiko" class="w-full border p-2 rounded">
                                <option value="">-- Pilih --</option>
                                <option value="rendah">Rendah</option>
                                <option value="menengah_rendah">Menengah Rendah</option>
                                <option value="menengah_tinggi">Menengah Tinggi</option>
                                <option value="tinggi">Tinggi</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">KBLI</label>
                            <input type="text" name="kbli" class="w-full border p-2 rounded">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Nama Perizinan</label>
                            <input type="text" name="nama_izin" class="w-full border p-2 rounded">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Penanggung Jawab</label>
                            <input type="text" name="pj_pers" class="w-full border p-2 rounded">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Alamat Lokasi Usaha</label>
                            <input type="text" name="alamat" class="w-full border p-2 rounded">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Kabupaten/Kota</label>
                            <select name="kab" class="w-full border p-2 rounded">
                                <option value="">-- Pilih Kabupaten/Kota --</option>
                                @foreach ($kabkota as $kab)
                                    <option value="{{ $kab->id }}">{{ $kab->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">No Telepon</label>
                            <input type="text" name="no_telp" class="w-full border p-2 rounded">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Email</label>
                            <input type="email" name="email" class="w-full border p-2 rounded">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Modal Usaha</label>
                            <input type="text" name="modal" class="w-full border p-2 rounded">
                        </div>

                    </div>
                </div>

                {{-- PERSYARATAN --}}
                <div class="col-span-2 mt-6">
                    <h2 class="text-lg font-semibold text-gray-700 mb-2">Dokumen & Verifikasi</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Dokumen Persyaratan</label>
                            <input type="text" name="dokumen" class="w-full border p-2 rounded">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Jumlah Dokumen</label>
                            <textarea name="jumlah_dok" rows="2" class="w-full border p-2 rounded">{{ old('jumlah_dok') }}</textarea>
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Upload Jenis Dokumen</label>
                            <input type="file" name="jenis_dok" class="w-full border p-2 rounded">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Nomor Surat Verifikasi</label>
                            <input type="text" name="no_verif" class="w-full border p-2 rounded">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Tanggal Verifikasi Teknis</label>
                            <input type="date" name="tgl_verif" class="w-full border p-2 rounded">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Dokumen Verifikasi</label>
                            <input type="file" name="dok_verif" class="w-full border p-2 rounded">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Status</label>
                            <select name="status" class="w-full border p-2 rounded">
                                <option value="menunggu">Menunggu</option>
                                <option value="disetujui">Disetujui</option>
                                <option value="dikembalikan">Dikembalikan</option>
                                <option value="ditolak">Ditolak</option>
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
