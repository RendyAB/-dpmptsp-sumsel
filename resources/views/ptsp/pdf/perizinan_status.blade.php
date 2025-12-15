@php
    // Fungsi format tanggal Indonesia
    function tglIndo($tanggal)
    {
        if (!$tanggal) {
            return '-';
        }
        $bulan = [
            1 => 'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember',
        ];
        $tgl = date('j', strtotime($tanggal));
        $bln = $bulan[(int) date('n', strtotime($tanggal))];
        $thn = date('Y', strtotime($tanggal));
        return $tgl . ' ' . $bln . ' ' . $thn;
    }
@endphp

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <style>
        @page {
            margin: 0.5cm;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 9.5pt;
            line-height: 1.1;
        }

        .kop {
            text-align: center;
            border-bottom: 4px solid #000;
            padding-bottom: 15px;
            margin-bottom: 10px;
        }

        .kop img {
            float: left;
            width: 55px;
            transform: translateX(65px);
        }

        .kop h2,
        .kop h3,
        .kop p {
            margin: 0;
            line-height: 1.1;
            font-size: 10pt;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            line-height: 1.1;
            font-size: 9.5pt;
        }

        td {
            vertical-align: top;
            padding: 1px 2px;
        }

        th {
            font-size: 10pt;
        }

        .section-title {
            margin-top: 8px;
            font-weight: bold;
            font-size: 9.5pt;
        }

        a {
            color: blue;
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <!-- KOP SURAT -->
    {{-- <div class="kop">
        <img src="{{ assets('../assets/logo') }}" alt="logo">
        <h2>PEMERINTAH PROVINSI SUMATERA SELATAN</h2>
        <h3>DINAS PENANAMAN MODAL DAN PELAYANAN TERPADU SATU PINTU</h3>
        <p>Jalan Jenderal Sudirman Km. 4,5 No. 90 Palembang, Provinsi Sumatera Selatan</p>
        <p>Telp. 0711-411007 Fax. 0711-411199 Kode Pos 30128</p>
    </div> --}}
    <div class="kop" style="text-align:center;">
        <img src="{{ $logo_base64 }}" alt="logo" style="width:55px; margin-bottom:10px;">
        <h2>PEMERINTAH PROVINSI SUMATERA SELATAN</h2>
        <h3>DINAS PENANAMAN MODAL DAN PELAYANAN TERPADU SATU PINTU</h3>
        <p>Jalan Jenderal Sudirman Km. 4,5 No. 90 Palembang, Provinsi Sumatera Selatan</p>
        <p>Telp. 0711-411007 Fax. 0711-411199 Kode Pos 30128</p>
    </div>


    <h3 style="text-align:center; font-size:10pt; margin:5px 0;">
        Formulir Lembar Verifikasi Proses Perizinan
    </h3>

    <!-- BAGIAN KEPADA -->
    <table>
        <tr>
            <td style="width:170px;">Kepada</td>
            <td>: {{ $data['kepada'] ?? '-' }}</td>
        </tr>
        <tr>
            <td>Perihal</td>
            <td>: {{ $data['perihal'] ?? '-' }}</td>
        </tr>
        <tr>
            <td>Tanggal Proses</td>
            <td>: {{ $data['tanggal_proses'] ?? '-' }}</td>
        </tr>
    </table>

    <!-- IDENTITAS PETUGAS -->
    <p class="section-title">Identitas Petugas Back Office:</p>
    <table>
        <tr>
            <td style="width:230px;">Nama</td>
            <td>: {{ $data['petugas'] ?? '-' }}</td>
        </tr>
        <tr>
            <td>NIP</td>
            <td>: {{ $data['nip'] ?? '-' }}</td>
        </tr>
        <tr>
            <td>Jabatan</td>
            <td>: {{ $data['jabatan'] ?? '-' }}</td>
        </tr>
    </table>

    <!-- DATA PERUSAHAAN -->
    <p class="section-title">Data Perusahaan:</p>
    <table>
        @foreach ([
        'no_pmh' => 'Nomor Permohonan',
        'no_keg' => 'Nomor Kegiatan Usaha',
        'tgl_pmh' => 'Tanggal Permohonan',
        'jenis_pmh' => 'Jenis Permohonan',
        'nama_pers' => 'Nama Perusahaan',
        'jenis_pers' => 'Jenis Perusahaan',
        'jenis_keg' => 'Jenis Kegiatan Usaha',
        'nib' => 'NIB',
        'npwp' => 'NPWP',
        'sektor' => 'Sektor',
        'luas' => 'Luas Lahan',
        'skala' => 'Skala Usaha',
        'risiko' => 'Risiko',
        'kbli' => 'KBLI',
        'nama_izin' => 'Nama Perizinan',
        'pj_pers' => 'Penanggung Jawab',
        'alamat' => 'Alamat Lokasi Usaha',
        'kab' => 'Kabupaten/Kota',
        'no_telp' => 'No Telepon',
        'email' => 'Email',
        'modal' => 'Modal Usaha',
    ] as $field => $label)
            <tr>
                <td style="width:230px;">{{ $label }}</td>
                <td>: {{ $data[$field] ?? '-' }}</td>
            </tr>
        @endforeach
    </table>

    <!-- CATATAN ADMINISTRASI -->
    <p class="section-title">Catatan Administrasi:</p>
    <table>
        <tr>
            <td style="width:230px;">Dokumen Persyaratan</td>
            <td>: {{ $data['dokumen'] ?? '-' }}</td>
        </tr>
        <tr>
            <td>Jumlah Dokumen Persyaratan</td>
            <td>: {{ $data['jumlah_dok'] ?? '-' }}</td>
        </tr>

        <tr>
            <td>Jenis Dokumen Persyaratan</td>
            <td>:
                @if (!empty($data['jenis_dok']))
                    <a href="/formulir-perizinan/uploads/perizinan/{{ $data['jenis_dok'] }}" target="_blank">Lihat
                        Dokumen</a>
                @else
                    Belum ada
                @endif
            </td>
        </tr>

        <tr>
            <td>Nomor Surat Verifikasi</td>
            <td>: {{ $data['no_verif'] ?? '-' }}</td>
        </tr>
        <tr>
            <td>Tanggal Verifikasi Teknis</td>
            <td>: {{ $data['tgl_verif'] ?? '-' }}</td>
        </tr>

        <tr>
            <td>Dokumen Verifikasi Teknis</td>
            <td>:
                @if (!empty($data['dok_verif']))
                    <a href="/formulir-perizinan/uploads/perizinan/{{ $data['dok_verif'] }}" target="_blank">Lihat
                        Dokumen</a>
                @else
                    Belum ada
                @endif
            </td>
        </tr>

        <tr>
            <td>Status Proses</td>
            <td>: {{ $data['status'] ?? '-' }}</td>
        </tr>
        <tr>
            <td>Keterangan Status</td>
            <td>: {{ $data['ket_status'] ?? '-' }}</td>
        </tr>
        <tr>
            <td>Tanggal Terbit Izin</td>
            <td>: {{ tglIndo($data['tgl_terbit'] ?? null) }}</td>
        </tr>
    </table>

    <!-- NB + TTD -->
    <table style="margin-top:10px;">
        <tr>
            <td style="width:60%; vertical-align:top;">
                <div style="border:1px solid #000; padding:4px; font-size:9pt;">
                    <b>NB:</b> Berdasarkan UU No.10/2020, meterai Rp10.000 berlaku untuk surat perjanjian,
                    surat keterangan, surat pernyataan, atau surat sejenis beserta rangkapnya.
                </div>
            </td>

            <td style="width:40%; text-align:center; font-size:9.5pt; line-height:1;">
                Palembang, {{ tglIndo($data['tanggal_proses'] ?? null) }}
                <p style="margin:0;">Yang Membuat,</p>
                <div style="height:45px;"></div>
                <p style="margin:0;">{{ $data['petugas'] ?? '-' }}</p>
                <p style="margin:0;">{{ $data['nip'] ?? '-' }}</p>
            </td>
        </tr>
    </table>

    <!-- PARAF -->
    <table border="1" cellspacing="0" cellpadding="4"
        style="width:100%; text-align:center; margin-top:10px; font-size:9pt; border-collapse:collapse;">
        <tr>
            <th colspan="4">PARAF</th>
        </tr>
        <tr>
            <th colspan="3">PENATA PERIZINAN AHLI MADYA</th>
            <th>KOORDINATOR PENATA PERIZINAN</th>
        </tr>
        <tr>
            <td>Novi Widyastuti, SP., M.Si</td>
            <td>Ardi, SE., M.M</td>
            <td>Kusmaneti, S.E., M.Si</td>
            <td>Hendang Irawan, SE., M.Si</td>
        </tr>
        <tr>
            <td><img src="{{ $ttd1_base64 }}" width="60"></td>
            <td><img src="{{ $ttd2_base64 }}" width="60"></td>
            <td><img src="{{ $ttd3_base64 }}" width="60"></td>
            <td><img src="{{ $ttd4_base64 }}" width="60"></td>
        </tr>
    </table>

    <!-- CATATAN BO -->
    <div style="margin-top:8px; font-size:8.5pt;">
        <b>Catatan Penting Back Office BO:</b><br>
        * Lampirkan dokumen perizinan dan Non Perizinan yang sudah diproses sebanyak 2 rangkap.<br>
        ** Teliti Penomoran Izin dan Non Izin ...<br>
        *** dst…
    </div>

</body>

</html>
