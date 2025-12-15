<table>
    <tr>
        <td colspan="5">CLUSTER KABUPATEN/KOTA DAN JENIS SEKTOR</td>
    </tr>
    <tr>
        <td colspan="5">PTSP - DPMPTSP PROVINSI SUMATERA SELATAN</td>
    </tr>
    <tr>
        <td colspan="5">TRIWULAN {{ $triwulan }} TAHUN {{ $tahun }}</td>
    </tr>
    <tr></tr>

    <thead>
        <tr>
            <th rowspan="2" style="border:1px solid #000; text-align:center;">NO</th>
            <th rowspan="2" style="border:1px solid #000; text-align:center;">CLUSTER <br> KABUPATEN/KOTA</th>
            <th colspan="2" style="border:1px solid #000; text-align:center;">JUMLAH PERIZINAN DAN NON PERIZINAN</th>
            <th rowspan="2" style="border:1px solid #000; text-align:center;">JUMLAH PERIZINAN <br> DAN NON PERIZINAN
                <br>
                PER KABUPATEN/KOTA
            </th>
        </tr>
        <tr>
            <th style="border:1px solid #000; text-align:center;">Online Single Submission <br> (OSS RBA)</th>
            <th style="border:1px solid #000; text-align:center;">SI CANTIK <br> (NON OSS RBA)</th>
        </tr>
    </thead>

    @php
        $no = 1;
        $total_oss = 0;
        $total_non_oss = 0;
    @endphp
    @foreach ($kabkotaData as $data)
        <tr>
            <td style="border:1px solid #000; text-align:center;">{{ $no++ }}</td>
            <td>{{ $data->nama_kab_kota }}</td>
            <td style="border:1px solid #000; text-align:center; background-color:#cce5ff;">{{ $data->oss_rba }}</td>
            <td style="border:1px solid #000; text-align:center; background-color:#f7c59f;">{{ $data->non_oss_rba }}
            </td>
            <td style="border:1px solid #000; text-align:center;">{{ $data->total }}</td>
        </tr>
        @php
            $total_oss += $data->oss_rba;
            $total_non_oss += $data->non_oss_rba;
        @endphp
    @endforeach

    <!-- TOTAL -->
    <tr>
        <td colspan="2" style="border:1px solid #000; text-align:right;"><strong>TOTAL PERIZINAN DAN NON PERIZINAN
                KABUPATEN/KOTA</strong></td>
        <td style="border:1px solid #000; text-align:center;"><strong>{{ $total_oss }}</strong></td>
        <td style="border:1px solid #000; text-align:center;"><strong>{{ $total_non_oss }}</strong></td>
        <td style="border:1px solid #000; text-align:center;"><strong>{{ $total_oss + $total_non_oss }}</strong></td>
    </tr>

    <tr></tr>

    <!-- SEKTOR HEADER -->
    <thead>
        <tr>
            <th rowspan="2" style="border:1px solid #000; text-align:center;">NO</th>
            <th rowspan="2" style="border:1px solid #000; text-align:center;">JENIS SEKTOR</th>
            <th colspan="2" style="border:1px solid #000; text-align:center;">JUMLAH PERIZINAN DAN NON PERIZINAN PER
                SEKTOR</th>
            <th rowspan="2" style="border:1px solid #000; text-align:center;">JUMLAH PERIZINAN <br> DAN NON PERIZINAN
                <br>
                PER SEKTOR
            </th>
        </tr>
        <tr>
            <th style="border:1px solid #000; text-align:center;">Online Single Submission <br> (OSS RBA)</th>
            <th style="border:1px solid #000; text-align:center;">SI CANTIK <br> (NON OSS RBA)</th>
        </tr>
    </thead>

    @php
        $no = 1;
        $sektor_oss = 0;
        $sektor_non_oss = 0;
    @endphp
    @foreach ($sektorData as $sektor)
        <tr>
            <td style="border:1px solid #000; text-align:center;">{{ $no++ }}</td>
            <td>{{ $sektor->nama_sektor }}</td>
            <td style="border:1px solid #000; text-align:center; background-color:#cce5ff;">{{ $sektor->oss_rba }}</td>
            <td style="border:1px solid #000; text-align:center; background-color:#f7c59f;">{{ $sektor->non_oss_rba }}
            </td>
            <td style="border:1px solid #000; text-align:center;">{{ $sektor->total }}</td>
        </tr>
        @php
            $sektor_oss += $sektor->oss_rba;
            $sektor_non_oss += $sektor->non_oss_rba;
        @endphp
    @endforeach

    <!-- TOTAL SEKTOR -->
    <tr>
        <td colspan="2" style="border:1px solid #000; text-align:right;"><strong>TOTAL PERIZINAN DAN NON PERIZINAN
                PER SEKTOR</strong></td>
        <td style="border:1px solid #000; text-align:center;"><strong>{{ $sektor_oss }}</strong></td>
        <td style="border:1px solid #000; text-align:center;"><strong>{{ $sektor_non_oss }}</strong></td>
        <td style="border:1px solid #000; text-align:center;"><strong>{{ $sektor_oss + $sektor_non_oss }}</strong></td>
    </tr>
</table>
