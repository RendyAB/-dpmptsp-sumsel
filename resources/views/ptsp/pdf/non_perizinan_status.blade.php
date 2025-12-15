@php
    // Akses data aman
    function val($data, $field)
    {
        return htmlspecialchars($data[$field] ?? '-', ENT_QUOTES, 'UTF-8');
    }

    // Konversi gambar ke Base64 (Laravel path)
    function imgToBase64($path)
    {
        if (!file_exists($path)) {
            return '';
        }
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $dataImg = file_get_contents($path);
        return 'data:image/' . $type . ';base64,' . base64_encode($dataImg);
    }

    // Format tanggal Indonesia
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
        return "$tgl $bln $thn";
    }

    // Path asset tanda tangan & logo
    $logo = imgToBase64(public_path('assets/logo.png'));
    $ttd1 = imgToBase64(public_path('assets/ttd1.png'));
    $ttd2 = imgToBase64(public_path('assets/ttd2.png'));
    $ttd3 = imgToBase64(public_path('assets/ttd3.png'));
    $ttd4 = imgToBase64(public_path('assets/ttd4.png'));
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

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 9.5pt;
        }

        td {
            vertical-align: top;
            padding: 2px 3px;
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
    <div class="kop">
        <img src="{{ $logo }}" alt="logo">
        <h2>PEMERINTAH PROVINSI SUMATERA SELATAN</h2>
        <h3>DINAS PENANAMAN MODAL DAN PELAYANAN TERPADU SATU PINTU</h3>
        <p>Jalan Jenderal Sudirman Km. 4,5 No. 90 Palembang, Provinsi Sumatera Selatan</p>
        <p>Telp. 0711-411007 Fax. 0711-411199 Kode Pos 30128</p>
    </div>

    <h3 style="text-align:center; font-size:10pt; margin:5px 0;">
        Formulir Lembar Verifikasi Proses Perizinan Non-OSS RBA
    </h3>

    <!-- BAGIAN KEPADA -->
    <table>
        <tr>
            <td style="width:170px;">Kepada</td>
            <td>: {{ val($data, 'kepada') }}</td>
        </tr>
        <tr>
            <td>Perihal</td>
            <td>: {{ val($data, 'perihal') }}</td>
        </tr>
        <tr>
            <td>Tanggal Proses</td>
            <td>: {{ val($data, 'tanggal_proses') }}</td>
        </tr>
    </table>

    <!-- IDENTITAS PETUGAS -->
    <p class="section-title">Identitas Petugas Back Office:</p>
    <table>
        <tr>
            <td style="width:230px;">Nama</td>
            <td>: {{ val($data, 'petugas') }}</td>
        </tr>
        <tr>
            <td>NIP</td>
            <td>: {{ val($data, 'nip') }}</td>
        </tr>
        <tr>
            <td>Jabatan</td>
            <td>: {{ val($data, 'jabatan') }}</td>
        </tr>
    </table>

    <!-- DATA PERUSAHAAN -->
    <p class="section-title">Data Perusahaan:</p>
    <table>
        <tr>
            <td style="width:50%; vertical-align:top;">
                <table>
                    <tr>
                        <td style="width:200px;">Nomor Agenda</td>
                        <td>: {{ val($data, 'no_agenda') }}</td>
                    </tr>
                    <tr>
                        <td>Nomor Surat</td>
                        <td>: {{ val($data, 'no_surat') }}</td>
                    </tr>
                    <tr>
                        <td>Jenis Izin</td>
                        <td>: {{ val($data, 'jenis_izin') }}</td>
                    </tr>
                    <tr>
                        <td>Nomor Izin</td>
                        <td>: {{ val($data, 'no_izin') }}</td>
                    </tr>
                    <tr>
                        <td>Nama Kapal</td>
                        <td>: {{ val($data, 'nama_kapal') }}</td>
                    </tr>
                    <tr>
                        <td>NIB</td>
                        <td>: {{ val($data, 'nib') }}</td>
                    </tr>
                    <tr>
                        <td>ID Izin OSS</td>
                        <td>: {{ val($data, 'id_izin') }}</td>
                    </tr>
                    <tr>
                        <td>Tgl Permohonan</td>
                        <td>: {{ val($data, 'tgl_pmh') }}</td>
                    </tr>
                    <tr>
                        <td>Tgl Tanda Terima</td>
                        <td>: {{ val($data, 'tgl_terima') }}</td>
                    </tr>
                    <tr>
                        <td>Jenis Permohonan</td>
                        <td>: {{ val($data, 'jenis_pmh') }}</td>
                    </tr>
                    <tr>
                        <td>Cek Fisik</td>
                        <td>: {{ val($data, 'cek_fisik') }}</td>
                    </tr>
                    <tr>
                        <td>ID OSS</td>
                        <td>: {{ val($data, 'id_oss') }}</td>
                    </tr>
                    <tr>
                        <td>ID Proyek OSS</td>
                        <td>: {{ val($data, 'id_proyek') }}</td>
                    </tr>
                    <tr>
                        <td>Nama Pemilik</td>
                        <td>: {{ val($data, 'nama_pemilik') }}</td>
                    </tr>
                    <tr>
                        <td>No Izin Usaha</td>
                        <td>: {{ val($data, 'no_usaha') }}</td>
                    </tr>
                </table>
            </td>

            <td style="width:50%; vertical-align:top;">
                <table>
                    <tr>
                        <td style="width:200px;">Tanggal Izin Usaha</td>
                        <td>: {{ val($data, 'tgl_izin') }}</td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>: {{ val($data, 'alamat') }}</td>
                    </tr>
                    <tr>
                        <td>NPWP</td>
                        <td>: {{ val($data, 'npwp') }}</td>
                    </tr>
                    <tr>
                        <td>NIK</td>
                        <td>: {{ val($data, 'nik') }}</td>
                    </tr>
                    <tr>
                        <td>Jenis Perusahaan</td>
                        <td>: {{ val($data, 'jenis_pers') }}</td>
                    </tr>
                    <tr>
                        <td>Jenis Kegiatan</td>
                        <td>: {{ val($data, 'jenis_keg') }}</td>
                    </tr>
                    <tr>
                        <td>Sektor</td>
                        <td>: {{ val($data, 'sektor') }}</td>
                    </tr>
                    <tr>
                        <td>Skala Usaha</td>
                        <td>: {{ val($data, 'skala') }}</td>
                    </tr>
                    <tr>
                        <td>Risiko</td>
                        <td>: {{ val($data, 'risiko') }}</td>
                    </tr>
                    <tr>
                        <td>KBLI - Uraian</td>
                        <td>: {{ val($data, 'kbli') }}</td>
                    </tr>
                    <tr>
                        <td>Alamat Lokasi Usaha</td>
                        <td>: {{ val($data, 'alamat_lokasi') }}</td>
                    </tr>
                    <tr>
                        <td>Kab/Kota</td>
                        <td>: {{ val($data, 'kab') }}</td>
                    </tr>
                    <tr>
                        <td>No Telp</td>
                        <td>: {{ val($data, 'no_telp') }}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>: {{ val($data, 'email') }}</td>
                    </tr>
                    <tr>
                        <td>Nilai Investasi</td>
                        <td>: Rp. {{ val($data, 'investasi') }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <!-- CATATAN ADMINISTRASI -->
    <p class="section-title">Catatan Administrasi:</p>
    <table>
        <tr>
            <td style="width:230px;">Dokumen Persyaratan</td>
            <td>: {{ val($data, 'dokumen') }}</td>
        </tr>
        <tr>
            <td>Jumlah Dokumen</td>
            <td>: {{ val($data, 'jumlah_dok') }}</td>
        </tr>

        <tr>
            <td>Jenis Dokumen Persyaratan</td>
            <td>:
                @if (!empty($data['jenis_dok']))
                    <a href="{{ asset('uploads/non_perizinan/' . $data['jenis_dok']) }}" target="_blank">Lihat
                        Dokumen</a>
                @else
                    Belum ada
                @endif
            </td>
        </tr>

        <tr>
            <td>Nomor Surat Verifikasi</td>
            <td>: {{ val($data, 'no_verif') }}</td>
        </tr>
        <tr>
            <td>Tanggal Verifikasi Teknis</td>
            <td>: {{ val($data, 'tgl_verif') }}</td>
        </tr>

        <tr>
            <td>Dokumen Verifikasi Teknis</td>
            <td>:
                @if (!empty($data['dok_verif']))
                    <a href="{{ asset('uploads/non_perizinan/' . $data['dok_verif']) }}" target="_blank">Lihat
                        Dokumen</a>
                @else
                    Belum ada
                @endif
            </td>
        </tr>

        <tr>
            <td>Status Proses</td>
            <td>: {{ val($data, 'status') }}</td>
        </tr>
        <tr>
            <td>Keterangan Status</td>
            <td>: {{ val($data, 'ket_status') }}</td>
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

            <td style="width:40%; text-align:center;">
                Palembang, {{ tglIndo($data['tanggal_proses']) }}<br>
                Yang Membuat,<br><br><br><br>
                {{ val($data, 'petugas') }}<br>
                {{ val($data, 'nip') }}
            </td>
        </tr>
    </table>

    <!-- PARAF -->
    <table border="1" cellspacing="0" cellpadding="4"
        style="margin-top:10px; text-align:center; border-collapse:collapse;">
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
            <td><img src="{{ $ttd1 }}" width="60"></td>
            <td><img src="{{ $ttd2 }}" width="60"></td>
            <td><img src="{{ $ttd3 }}" width="60"></td>
            <td><img src="{{ $ttd4 }}" width="60"></td>
        </tr>
    </table>

    <!-- CATATAN BO -->
    <div style="margin-top:8px; font-size:8.5pt;">
        <b>Catatan Penting Back Office BO:</b><br>
        * Lampirkan dokumen perizinan & non perizinan sebanyak 2 rangkap.<br>
        ** Teliti penomoran izin sesuai format.<br>
        *** Untuk sektor kelautan/perikanan wajib lampirkan dokumen dari SIMKADA + OSS RBA.<br>
        **** Lampirkan dokumen yang sudah terverifikasi OSS RBA sebanyak 2 rangkap.<br>
        ***** Rekap triwulan ditutup setiap tanggal 1 bulan berikutnya.
    </div>

</body>

</html>
