<table>
    <thead>
        <tr>
            <td colspan="5">CLUSTER JENIS SEKTOR DATA PERIZINAN DAN NON PERIZINAN {{ strtoupper($nama_wilayah) }}</td>
        </tr>
        <tr>
            <td colspan="5">PTSP - DPMPTSP PROVINSI SUMATERA SELATAN</td>
        </tr>
        <tr>
            <td colspan="5">TRIWULAN {{ $triwulan }} TAHUN {{ $tahun }}</td>
        </tr>
        <tr></tr>

        <tr>
            <th rowspan="2" style="border:1px solid #000; text-align:center;">NO</th>
            <th rowspan="2" style="border:1px solid #000; text-align:center;">JENIS SEKTOR</th>
            <th colspan="2" style="border:1px solid #000; text-align:center;">
                JUMLAH PERIZINAN DAN NON PERIZINAN
            </th>
            <th rowspan="2" style="border:1px solid #000; text-align:center;">
                JUMLAH PERIZINAN DAN NON PERIZINAN PER SEKTOR
            </th>
        </tr>
        <tr>
            <th style="border:1px solid #000; text-align:center;">Online Single Submission (OSS RBA)</th>
            <th style="border:1px solid #000; text-align:center;">SI CANTIK (NON OSS RBA)</th>
        </tr>
    </thead>
    <tbody>
        @php
            $no = 1;
            $totalOss = $totalNonOss = $grandTotal = 0;
        @endphp

        @foreach ($perizinan as $p)
            @php
                $totalOss += $p->oss_rba;
                $totalNonOss += $p->non_oss_rba;
                $grandTotal += $p->total;
            @endphp
            <tr>
                <td style="border:1px solid #000; text-align:center;">{{ $no++ }}</td>
                <td style="border:1px solid #000;">{{ strtoupper($p->sektor) }}</td>
                <td style="border:1px solid #000; text-align:center; background-color:#cce5ff;">{{ $p->oss_rba }}</td>
                <td style="border:1px solid #000; text-align:center; background-color:#f7c59f;">{{ $p->non_oss_rba }}
                </td>
                <td style="border:1px solid #000; text-align:center;">{{ $p->total }}</td>
            </tr>
        @endforeach

        <tr style="font-weight:bold; background-color:#d4edda;">
            <td colspan="2" style="text-align:right; border:1px solid #000;">TOTAL PERIZINAN DAN NON PERIZINAN PER
                SEKTOR</td>
            <td style="text-align:center; border:1px solid #000;">{{ $totalOss }}</td>
            <td style="text-align:center; border:1px solid #000;">{{ $totalNonOss }}</td>
            <td style="text-align:center; border:1px solid #000;">{{ $grandTotal }}</td>
        </tr>
    </tbody>
</table>
