<table>
    <thead>
        <tr>
            <th colspan="14" style="text-align:right; font-weight:bold; font-size:18px;">
                REALISASI INVESTASI PER SUB SEKTOR
            </th>
        </tr>
        <tr>
            <th colspan="14" style="text-align:right; font-weight:bold; font-size:18px;">
                {{ strtoupper($nama_wilayah) }}
            </th>
        </tr>
        <tr>
            <th colspan="14" style="text-align:right; font-weight:bold; font-size:18px;">
                TAHUN {{ $tahun }}
            </th>
        </tr>
        <tr></tr>
        <tr>
            <th rowspan="2">NO</th>
            <th rowspan="2">SEKTOR</th>
            <th colspan="4">PMA</th>
            <th colspan="4">PMDN</th>
            <th rowspan="2">Σ LKPM</th>
            <th rowspan="2">REALISASI PMA + PMDN TH.{{ $tahun }}</th>
            <th rowspan="2">Σ TKI</th>
            <th rowspan="2">Σ TKA</th>
        </tr>
        <tr>
            <th>Σ LKPM</th>
            <th>REALISASI (Rp)</th>
            <th>Σ TKI</th>
            <th>Σ TKA</th>
            <th>Σ LKPM</th>
            <th>REALISASI (Rp)</th>
            <th>Σ TKI</th>
            <th>Σ TKA</th>
        </tr>
    </thead>
    <tbody>
        @php
            $no = 1;
            $grandPmaLkpm = $grandPmaRealisasi = $grandPmaTki = $grandPmaTka = 0;
            $grandPmdnLkpm = $grandPmdnRealisasi = $grandPmdnTki = $grandPmdnTka = 0;
        @endphp

        @foreach ($kategori as $kat)
            <tr>
                <td colspan="14" style="font-weight:bold;">{{ strtoupper($kat->nama) }}</td>
            </tr>

            @php
                $totalPmaLkpm = $totalPmaRealisasi = $totalPmaTki = $totalPmaTka = 0;
                $totalPmdnLkpm = $totalPmdnRealisasi = $totalPmdnTki = $totalPmdnTka = 0;
            @endphp

            @foreach ($kat->sektorInvestasi as $sektor)
                @php
                    $pmaLkpm = $sektor->investasi->sum('lkpm_pma');
                    $pmdnLkpm = $sektor->investasi->sum('lkpm_pmdn');
                    $pmaRealisasi = $sektor->investasi->sum('realisasi_pma');
                    $pmdnRealisasi = $sektor->investasi->sum('realisasi_pmdn');
                    $pmaTki = $sektor->investasi->sum('tki_pma');
                    $pmdnTki = $sektor->investasi->sum('tki_pmdn');
                    $pmaTka = $sektor->investasi->sum('tka_pma');
                    $pmdnTka = $sektor->investasi->sum('tka_pmdn');

                    $lkpm = $pmaLkpm + $pmdnLkpm;
                    $realisasi = $pmaRealisasi + $pmdnRealisasi;
                    $tki = $pmaTki + $pmdnTki;
                    $tka = $pmaTka + $pmdnTka;

                    $totalPmaLkpm += $pmaLkpm;
                    $totalPmaRealisasi += $pmaRealisasi;
                    $totalPmaTki += $pmaTki;
                    $totalPmaTka += $pmaTka;

                    $totalPmdnLkpm += $pmdnLkpm;
                    $totalPmdnRealisasi += $pmdnRealisasi;
                    $totalPmdnTki += $pmdnTki;
                    $totalPmdnTka += $pmdnTka;

                    $grandPmaLkpm += $pmaLkpm;
                    $grandPmaRealisasi += $pmaRealisasi;
                    $grandPmaTki += $pmaTki;
                    $grandPmaTka += $pmaTka;

                    $grandPmdnLkpm += $pmdnLkpm;
                    $grandPmdnRealisasi += $pmdnRealisasi;
                    $grandPmdnTki += $pmdnTki;
                    $grandPmdnTka += $pmdnTka;
                @endphp
                <tr>
                    <td style="text-align:center">{{ $no++ }}</td>
                    <td>{{ $sektor->nama }}</td>
                    <td style="text-align:center;">{{ $pmaLkpm }}</td>
                    <td style="text-align:right;">{{ number_format($pmaRealisasi, 2, ',', '.') }}</td>
                    <td style="text-align:center;">{{ $pmaTki }}</td>
                    <td style="text-align:center;">{{ $pmaTka }}</td>
                    <td style="text-align:center;">{{ $pmdnLkpm }}</td>
                    <td style="text-align:right;">{{ number_format($pmdnRealisasi, 2, ',', '.') }}</td>
                    <td style="text-align:center;">{{ $pmdnTki }}</td>
                    <td style="text-align:center;">{{ $pmdnTka }}</td>
                    <td style="text-align:center;">{{ $lkpm }}</td>
                    <td style="text-align:right;">{{ number_format($realisasi, 2, ',', '.') }}</td>
                    <td style="text-align:center;">{{ $tki }}</td>
                    <td style="text-align:center;">{{ $tka }}</td>
                </tr>
            @endforeach

            <tr style="font-weight:bold; background-color:#f0f0f0;">
                <td colspan="2" style="text-align:right;">JUMLAH {{ strtoupper($kat->nama) }}</td>
                <td style="text-align:center;">{{ $totalPmaLkpm }}</td>
                <td style="text-align:right;">{{ number_format($totalPmaRealisasi, 2, ',', '.') }}</td>
                <td style="text-align:center;">{{ $totalPmaTki }}</td>
                <td style="text-align:center;">{{ $totalPmaTka }}</td>
                <td style="text-align:center;">{{ $totalPmdnLkpm }}</td>
                <td style="text-align:right;">{{ number_format($totalPmdnRealisasi, 2, ',', '.') }}</td>
                <td style="text-align:center;">{{ $totalPmdnTki }}</td>
                <td style="text-align:center;">{{ $totalPmdnTka }}</td>
                <td style="text-align:center;">{{ $totalPmaLkpm + $totalPmdnLkpm }}</td>
                <td style="text-align:right;">
                    {{ number_format($totalPmaRealisasi + $totalPmdnRealisasi, 2, ',', '.') }}</td>
                <td style="text-align:center;">{{ $totalPmaTki + $totalPmdnTki }}</td>
                <td style="text-align:center;">{{ $totalPmaTka + $totalPmdnTka }}</td>
            </tr>
        @endforeach

        <tr style="font-weight:bold; background-color:#d0f0d0;">
            <td colspan="2" style="text-align:right;">TOTAL KESELURUHAN</td>
            <td style="text-align:center;">{{ $grandPmaLkpm }}</td>
            <td style="text-align:right;">{{ number_format($grandPmaRealisasi, 2, ',', '.') }}</td>
            <td style="text-align:center;">{{ $grandPmaTki }}</td>
            <td style="text-align:center;">{{ $grandPmaTka }}</td>
            <td style="text-align:center;">{{ $grandPmdnLkpm }}</td>
            <td style="text-align:right;">{{ number_format($grandPmdnRealisasi, 2, ',', '.') }}</td>
            <td style="text-align:center;">{{ $grandPmdnTki }}</td>
            <td style="text-align:center;">{{ $grandPmdnTka }}</td>
            <td style="text-align:center;">{{ $grandPmaLkpm + $grandPmdnLkpm }}</td>
            <td style="text-align:right;">{{ number_format($grandPmaRealisasi + $grandPmdnRealisasi, 2, ',', '.') }}
            </td>
            <td style="text-align:center;">{{ $grandPmaTki + $grandPmdnTki }}</td>
            <td style="text-align:center;">{{ $grandPmaTka + $grandPmdnTka }}</td>
        </tr>
    </tbody>
</table>
