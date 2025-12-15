@extends('template.header_admin')

@section('titleadmin', 'Detail Validasi Non-Perizinan - DPMPTSP Sumatera Selatan')

@section('konten')

    <div class="max-w-5xl mx-auto bg-white shadow-lg p-8 rounded-xl">

        <h1 class="text-3xl font-bold text-gray-800 mb-6 border-b pb-3">
            Form Validasi Non Perizinan (Read-Only)
        </h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            {{-- NOMOR AGENDA --}}
            <div>
                <label class="block font-medium mb-1 text-gray-700">Nomor Agenda</label>
                <input type="text" class="w-full border p-2 rounded bg-gray-100" value="{{ $non->no_agenda }}" readonly
                    disabled>
            </div>

            {{-- NOMOR SURAT --}}
            <div>
                <label class="block font-medium mb-1 text-gray-700">Nomor Surat</label>
                <input type="text" class="w-full border p-2 rounded bg-gray-100" value="{{ $non->no_surat }}" readonly
                    disabled>
            </div>

            {{-- PERIHAL --}}
            <div>
                <label class="block font-medium mb-1 text-gray-700">Perihal</label>
                <input type="text" class="w-full border p-2 rounded bg-gray-100" value="{{ $non->perihal }}" readonly
                    disabled>
            </div>

            {{-- TANGGAL PERMOHONAN --}}
            <div>
                <label class="block font-medium mb-1 text-gray-700">Tanggal Permohonan</label>
                <input type="text" class="w-full border p-2 rounded bg-gray-100" value="{{ $non->tgl_pmh }}" readonly
                    disabled>
            </div>

            {{-- TANGGAL TERIMA --}}
            <div>
                <label class="block font-medium mb-1 text-gray-700">Tanggal Terima</label>
                <input type="text" class="w-full border p-2 rounded bg-gray-100" value="{{ $non->tgl_terima }}" readonly
                    disabled>
            </div>

            {{-- JENIS PERMOHONAN --}}
            <div>
                <label class="block font-medium mb-1 text-gray-700">Jenis Permohonan</label>
                <input type="text" class="w-full border p-2 rounded bg-gray-100" value="{{ $non->jenis_pmh }}" readonly
                    disabled>
            </div>

            {{-- NAMA PEMILIK --}}
            <div>
                <label class="block font-medium mb-1 text-gray-700">Nama Pemilik</label>
                <input type="text" class="w-full border p-2 rounded bg-gray-100" value="{{ $non->nama_pemilik }}"
                    readonly disabled>
            </div>

            {{-- NAMA KAPAL --}}
            <div>
                <label class="block font-medium mb-1 text-gray-700">Nama Kapal</label>
                <input type="text" class="w-full border p-2 rounded bg-gray-100" value="{{ $non->nama_kapal }}" readonly
                    disabled>
            </div>

            {{-- JENIS PERUSAHAAN --}}
            <div>
                <label class="block font-medium mb-1 text-gray-700">Jenis Perusahaan</label>
                <input type="text" class="w-full border p-2 rounded bg-gray-100" value="{{ $non->jenis_pers }}" readonly
                    disabled>
            </div>

            {{-- JENIS KEGIATAN USAHA --}}
            <div>
                <label class="block font-medium mb-1 text-gray-700">Jenis Kegiatan Usaha</label>
                <input type="text" class="w-full border p-2 rounded bg-gray-100" value="{{ $non->jenis_keg }}" readonly
                    disabled>
            </div>

            {{-- NIB --}}
            <div>
                <label class="block font-medium mb-1 text-gray-700">NIB</label>
                <input type="text" class="w-full border p-2 rounded bg-gray-100" value="{{ $non->nib }}" readonly
                    disabled>
            </div>

            {{-- NPWP --}}
            <div>
                <label class="block font-medium mb-1 text-gray-700">NPWP</label>
                <input type="text" class="w-full border p-2 rounded bg-gray-100" value="{{ $non->npwp }}" readonly
                    disabled>
            </div>

            {{-- NIK --}}
            <div>
                <label class="block font-medium mb-1 text-gray-700">NIK</label>
                <input type="text" class="w-full border p-2 rounded bg-gray-100" value="{{ $non->nik }}" readonly
                    disabled>
            </div>

            {{-- SEKTOR --}}
            <div>
                <label class="block font-medium mb-1 text-gray-700">Sektor</label>
                <input type="text" class="w-full border p-2 rounded bg-gray-100" value="{{ $non->sektor }}" readonly
                    disabled>
            </div>

            {{-- SKALA USAHA --}}
            <div>
                <label class="block font-medium mb-1 text-gray-700">Skala Usaha</label>
                <input type="text" class="w-full border p-2 rounded bg-gray-100" value="{{ $non->skala }}" readonly
                    disabled>
            </div>

            {{-- RISIKO --}}
            <div>
                <label class="block font-medium mb-1 text-gray-700">Risiko</label>
                <input type="text" class="w-full border p-2 rounded bg-gray-100" value="{{ $non->risiko }}" readonly
                    disabled>
            </div>

            {{-- KBLI --}}
            <div>
                <label class="block font-medium mb-1 text-gray-700">KBLI</label>
                <input type="text" class="w-full border p-2 rounded bg-gray-100" value="{{ $non->kbli }}" readonly
                    disabled>
            </div>

            {{-- ALAMAT --}}
            <div class="col-span-2">
                <label class="block font-medium mb-1 text-gray-700">Alamat Lokasi Usaha</label>
                <input type="text" class="w-full border p-2 rounded bg-gray-100" value="{{ $non->alamat_lokasi }}"
                    readonly disabled>
            </div>

            {{-- KAB/KOTA --}}
            <div>
                <label class="block font-medium mb-1 text-gray-700">Kabupaten/Kota</label>
                <input type="text" class="w-full border p-2 rounded bg-gray-100" value="{{ $non->kab }}" readonly
                    disabled>
            </div>

            {{-- TELEPON --}}
            <div>
                <label class="block font-medium mb-1 text-gray-700">No Telepon</label>
                <input type="text" class="w-full border p-2 rounded bg-gray-100" value="{{ $non->no_telp }}" readonly
                    disabled>
            </div>

            {{-- EMAIL --}}
            <div>
                <label class="block font-medium mb-1 text-gray-700">Email</label>
                <input type="text" class="w-full border p-2 rounded bg-gray-100" value="{{ $non->email }}" readonly
                    disabled>
            </div>

            {{-- INVESTASI --}}
            <div>
                <label class="block font-medium mb-1 text-gray-700">Investasi</label>
                <input type="text" class="w-full border p-2 rounded bg-gray-100" value="{{ $non->investasi }}" readonly
                    disabled>
            </div>

            {{-- DOKUMEN PERSYARATAN --}}
            <div class="col-span-2">
                <label class="block font-medium mb-1 text-gray-700">Dokumen Persyaratan</label>
                <input type="text" class="w-full border p-2 rounded bg-gray-100" value="{{ $non->dokumen }}" readonly
                    disabled>
            </div>

            {{-- JENIS DOK --}}
            <div>
                <label class="block font-medium mb-1 text-gray-700">Jenis Dokumen</label>
                <input type="text" class="w-full border p-2 rounded bg-gray-100" value="{{ $non->jenis_dok }}" readonly
                    disabled>
            </div>

            {{-- NOMOR VERIF --}}
            <div>
                <label class="block font-medium mb-1 text-gray-700">Nomor Surat Verifikasi Teknis</label>
                <input type="text" class="w-full border p-2 rounded bg-gray-100" value="{{ $non->no_verif }}"
                    readonly disabled>
            </div>

            {{-- TANGGAL VERIF --}}
            <div>
                <label class="block font-medium mb-1 text-gray-700">Tanggal Verifikasi Teknis</label>
                <input type="text" class="w-full border p-2 rounded bg-gray-100" value="{{ $non->tgl_verif }}"
                    readonly disabled>
            </div>

            {{-- DOKUMEN VERIF --}}
            <div>
                <label class="block font-medium mb-1 text-gray-700">Dokumen Verifikasi Teknis</label>
                <input type="text" class="w-full border p-2 rounded bg-gray-100" value="{{ $non->dok_verif }}"
                    readonly disabled>
            </div>

            {{-- CATATAN --}}
            <div class="col-span-2">
                <label class="block font-medium mb-1 text-gray-700">Catatan</label>
                <textarea name="catatan" rows="3" class="w-full border p-3 rounded" placeholder="Tuliskan catatan..."></textarea>
            </div>

        </div>

        {{-- BUTTONS --}}
        <div class="flex gap-4 mt-6">

            <form action="{{ route('nonperizinan.validasi.approve', $validasi->id) }}" method="POST">
                @csrf
                <button class="bg-green-600 text-white px-5 py-2 rounded-lg hover:bg-green-700">
                    Setuju
                </button>
            </form>

            <form action="{{ route('nonperizinan.validasi.revisi', $validasi->id) }}" method="POST">
                @csrf
                <button class="bg-yellow-500 text-white px-5 py-2 rounded-lg hover:bg-yellow-600">
                    Kembalikan
                </button>
            </form>

            <form action="{{ route('nonperizinan.validasi.reject', $validasi->id) }}" method="POST">
                @csrf
                <button class="bg-red-600 text-white px-5 py-2 rounded-lg hover:bg-red-700">
                    Tolak
                </button>
            </form>

        </div>

    </div>

@endsection
