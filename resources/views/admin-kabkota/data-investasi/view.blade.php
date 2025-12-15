@extends('template.header_admin_kabkota')
@section('titleadminkabkota', 'View Data Investasi Admin Kab/Kota - DPMPTSP Sumatera Selatan')
@section('konten_admin_kabkota')

    <div class="container mx-auto px-4 py-6">

        {{-- Filter dan Tambah --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8 gap-2">
            <form method="GET" action="{{ route('investasi_tampil_kabkota') }}" class="flex flex-wrap gap-2">
                <select name="triwulan" class="border p-2 rounded">
                    @for ($i = 1; $i <= 4; $i++)
                        <option value="{{ $i }}" {{ $triwulan == $i ? 'selected' : '' }}>Triwulan
                            {{ $i }}</option>
                    @endfor
                </select>

                <input type="number" name="tahun" value="{{ $tahun }}" min="2000"
                    class="border p-2 rounded w-24">

                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                    Filter
                </button>
            </form>

            <div class="flex justify-end gap-5">
                {{-- Tombol Export --}}
                <a href="{{ route('investasi_export_excel_kabkota', ['triwulan' => $triwulan, 'tahun' => $tahun]) }}"
                    class="exportBtn bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                    Export Rekap Per-Triwulan
                </a>

                <a href="{{ route('export_rekap_investasi_tahunan_kabkota', ['tahun' => $tahun]) }}"
                    class="exportBtn bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                    Export Rekap Per-Tahun
                </a>

                <a href="{{ route('investasi_create', ['triwulan' => $triwulan, 'tahun' => $tahun]) }}"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-center">
                    + Tambah Investasi
                </a>
            </div>
        </div>

        {{-- Judul --}}
        <h2 class="text-xl font-bold mb-4">
            Data Investasi – {{ $nama_kab_kota }} – Triwulan {{ $triwulan }} Tahun {{ $tahun }}
        </h2>

        {{-- Tabel --}}
        <div class="overflow-auto mb-4">
            <table class="table-auto border-collapse w-full border border-gray-300 text-sm">
                <thead>
                    <tr class="bg-gray-200 text-center">
                        <th rowspan="2" class="border border-gray-300 px-2 py-1">NO</th>
                        <th rowspan="2" class="border border-gray-300 px-2 py-1">SEKTOR</th>
                        <th colspan="4" class="border border-gray-300 px-2 py-1">PMA</th>
                        <th colspan="4" class="border border-gray-300 px-2 py-1">PMDN</th>
                        <th rowspan="2" class="border border-gray-300 px-2 py-1">Σ LKPM</th>
                        <th rowspan="2" class="border border-gray-300 px-2 py-1">REALISASI PMA + PMDN
                            TW.{{ $triwulan }} TH.{{ $tahun }}</th>
                        <th rowspan="2" class="border border-gray-300 px-2 py-1">Σ TKI</th>
                        <th rowspan="2" class="border border-gray-300 px-2 py-1">Σ TKA</th>
                        <th rowspan="2" class="border border-gray-300 px-2 py-1">AKSI</th>
                    </tr>
                    <tr class="bg-gray-200 text-center">
                        <th class="border border-gray-300 px-2 py-1">Σ LKPM</th>
                        <th class="border border-gray-300 px-2 py-1">REALISASI INVESTASI (Rp)</th>
                        <th class="border border-gray-300 px-2 py-1">Σ TKI</th>
                        <th class="border border-gray-300 px-2 py-1">Σ TKA</th>
                        <th class="border border-gray-300 px-2 py-1">Σ LKPM</th>
                        <th class="border border-gray-300 px-2 py-1">REALISASI INVESTASI (Rp)</th>
                        <th class="border border-gray-300 px-2 py-1">Σ TKI</th>
                        <th class="border border-gray-300 px-2 py-1">Σ TKA</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                        $grandPmaLkpm = $grandPmaRealisasi = $grandPmaTki = $grandPmaTka = 0;
                        $grandPmdnLkpm = $grandPmdnRealisasi = $grandPmdnTki = $grandPmdnTka = 0;
                    @endphp

                    @foreach ($kategori as $kat)
                        <tr class="font-bold">
                            <td colspan="15" class="border px-2 py-1">{{ strtoupper($kat->nama) }}</td>
                        </tr>

                        @php
                            $totalPmaLkpm = $totalPmaRealisasi = $totalPmaTki = $totalPmaTka = 0;
                            $totalPmdnLkpm = $totalPmdnRealisasi = $totalPmdnTki = $totalPmdnTka = 0;
                        @endphp

                        @foreach ($kat->sektorInvestasi as $sektor)
                            @php
                                $pma = $sektor->investasi->firstWhere(
                                    'kab_kota_id',
                                    auth('admin')->user()->kab_kota_id,
                                );
                                $pmaLkpm = $pma->lkpm_pma ?? 0;
                                $pmdnLkpm = $pma->lkpm_pmdn ?? 0;
                                $pmaRealisasi = $pma->realisasi_pma ?? 0;
                                $pmdnRealisasi = $pma->realisasi_pmdn ?? 0;
                                $pmaTki = $pma->tki_pma ?? 0;
                                $pmdnTki = $pma->tki_pmdn ?? 0;
                                $pmaTka = $pma->tka_pma ?? 0;
                                $pmdnTka = $pma->tka_pmdn ?? 0;

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
                                <td class="border px-2 py-1 text-center">{{ $no++ }}</td>
                                <td class="border px-2 py-1">{{ $sektor->nama }}</td>
                                <td class="border px-2 py-1 text-center bg-yellow-200">{{ $pmaLkpm }}</td>
                                <td class="border px-2 py-1 text-right bg-yellow-200">
                                    {{ number_format($pmaRealisasi, 2, ',', '.') }}</td>
                                <td class="border px-2 py-1 text-center bg-yellow-200">{{ $pmaTki }}</td>
                                <td class="border px-2 py-1 text-center bg-yellow-200">{{ $pmaTka }}</td>
                                <td class="border px-2 py-1 text-center">{{ $pmdnLkpm }}</td>
                                <td class="border px-2 py-1 text-right">{{ number_format($pmdnRealisasi, 2, ',', '.') }}
                                </td>
                                <td class="border px-2 py-1 text-center">{{ $pmdnTki }}</td>
                                <td class="border px-2 py-1 text-center">{{ $pmdnTka }}</td>
                                <td class="border px-2 py-1 text-center bg-blue-200">{{ $lkpm }}</td>
                                <td class="border px-2 py-1 text-right bg-blue-200">
                                    {{ number_format($realisasi, 2, ',', '.') }}</td>
                                <td class="border px-2 py-1 text-center bg-blue-200">{{ $tki }}</td>
                                <td class="border px-2 py-1 text-center bg-blue-200">{{ $tka }}</td>
                                <td class="border px-2 py-1 text-center">
                                    @if ($pma)
                                        <a href="{{ route('investasi_edit', ['id' => $pma->id, 'triwulan' => $triwulan, 'tahun' => $tahun]) }}"
                                            class="text-blue-600 hover:underline">Edit</a>

                                        <form id="delete-form-investasi-{{ $pma->id }}"
                                            action="{{ route('investasi_destroy', $pma->id) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="text-red-600 hover:underline ml-2"
                                                onclick="confirmDeleteInvestasi({{ $pma->id }})">
                                                Hapus
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-yellow-600 italic">Belum Ada Data</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach

                        <tr class="bg-gray-200 font-bold">
                            <td colspan="2" class="text-right border px-2 py-1">JUMLAH {{ strtoupper($kat->nama) }}</td>
                            <td class="border px-2 py-1 text-center">{{ $totalPmaLkpm }}</td>
                            <td class="border px-2 py-1 text-right">{{ number_format($totalPmaRealisasi, 2, ',', '.') }}
                            </td>
                            <td class="border px-2 py-1 text-center">{{ $totalPmaTki }}</td>
                            <td class="border px-2 py-1 text-center">{{ $totalPmaTka }}</td>
                            <td class="border px-2 py-1 text-center">{{ $totalPmdnLkpm }}</td>
                            <td class="border px-2 py-1 text-right">{{ number_format($totalPmdnRealisasi, 2, ',', '.') }}
                            </td>
                            <td class="border px-2 py-1 text-center">{{ $totalPmdnTki }}</td>
                            <td class="border px-2 py-1 text-center">{{ $totalPmdnTka }}</td>
                            <td class="border px-2 py-1 text-center">{{ $totalPmaLkpm + $totalPmdnLkpm }}</td>
                            <td class="border px-2 py-1 text-right">
                                {{ number_format($totalPmaRealisasi + $totalPmdnRealisasi, 2, ',', '.') }}</td>
                            <td class="border px-2 py-1 text-center">{{ $totalPmaTki + $totalPmdnTki }}</td>
                            <td class="border px-2 py-1 text-center">{{ $totalPmaTka + $totalPmdnTka }}</td>
                            <td class="border px-2 py-1"></td>
                        </tr>
                    @endforeach

                    <tr class="bg-green-200 font-bold">
                        <td colspan="2" class="text-right border px-2 py-2">TOTAL KESELURUHAN</td>
                        <td class="border px-2 py-2 text-center">{{ $grandPmaLkpm }}</td>
                        <td class="border px-2 py-2 text-right">{{ number_format($grandPmaRealisasi, 2, ',', '.') }}</td>
                        <td class="border px-2 py-2 text-center">{{ $grandPmaTki }}</td>
                        <td class="border px-2 py-2 text-center">{{ $grandPmaTka }}</td>
                        <td class="border px-2 py-2 text-center">{{ $grandPmdnLkpm }}</td>
                        <td class="border px-2 py-2 text-right">{{ number_format($grandPmdnRealisasi, 2, ',', '.') }}</td>
                        <td class="border px-2 py-2 text-center">{{ $grandPmdnTki }}</td>
                        <td class="border px-2 py-2 text-center">{{ $grandPmdnTka }}</td>
                        <td class="border px-2 py-2 text-center">{{ $grandPmaLkpm + $grandPmdnLkpm }}</td>
                        <td class="border px-2 py-2 text-right">
                            {{ number_format($grandPmaRealisasi + $grandPmdnRealisasi, 2, ',', '.') }}</td>
                        <td class="border px-2 py-2 text-center">{{ $grandPmaTki + $grandPmdnTki }}</td>
                        <td class="border px-2 py-2 text-center">{{ $grandPmaTka + $grandPmdnTka }}</td>
                        <td class="border px-2 py-2"></td>
                    </tr>
                </tbody>
            </table>
        </div>

        {{-- Chart Sektor --}}
        @if ($kategori->count() > 0)
            <div class="mt-14">
                <div class="flex items-center justify-between mb-4">
                    <form method="GET" action="{{ route('investasi_tampil_kabkota') }}"
                        class="flex items-center justify-between mb-8">
                        <div class="flex gap-2">
                            <select name="kategori" class="border p-2 rounded">
                                <option value="">-- Semua Sektor --</option>
                                <option value="Sektor Primer"
                                    {{ request('kategori') == 'Sektor Primer' ? 'selected' : '' }}>
                                    Primer
                                </option>
                                <option value="Sektor Sekunder"
                                    {{ request('kategori') == 'Sektor Sekunder' ? 'selected' : '' }}>
                                    Sekunder</option>
                                <option value="Sektor Tersier"
                                    {{ request('kategori') == 'Sektor Tersier' ? 'selected' : '' }}>
                                    Tersier
                                </option>
                            </select>

                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                                Filter
                            </button>
                        </div>
                    </form>

                    <button id="exportDiagramInvestasiKabKota"
                        class="bg-red-600 hover:bg-red-700 text-white mb-8 px-4 py-2 rounded">
                        Export Diagram ke PDF
                    </button>
                </div>

                <h2 class="text-xl font-bold mb-6 text-gray-800">Grafik Data Investasi Per-Sektor</h2>
                <div class="mb-14 bg-white shadow-md rounded-2xl p-6">
                    <canvas id="barChart" class="w-full max-w-8xl mx-auto"></canvas>
                </div>

                <h2 class="text-xl font-bold mb-6 text-gray-800">Grafik Total Data Investasi Per-Sektor</h2>
                <div class="mb-14 bg-white shadow-md rounded-2xl p-6">
                    <canvas id="lineChart" class="w-full max-w-8xl mx-auto"></canvas>
                </div>

            </div>
        @endif

        {{-- Overlay Loading --}}
        <div id="loadingOverlay"
            class="hidden fixed inset-0 bg-gray-800 bg-opacity-30 z-50 flex items-center justify-center">
            <div role="status">
                <svg aria-hidden="true" class="w-12 h-12 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
                    viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M100 50.5908C100 78.2051 77.6142 100.591
                                                                    50 100.591C22.3858 100.591 0 78.2051
                                                                    0 50.5908C0 22.9766 22.3858 0.59082
                                                                    50 0.59082C77.6142 0.59082 100 22.9766
                                                                    100 50.5908ZM9.08144 50.5908C9.08144
                                                                    73.1895 27.4013 91.5094 50 91.5094C72.5987
                                                                    91.5094 90.9186 73.1895 90.9186 50.5908C90.9186
                                                                    27.9921 72.5987 9.67226 50 9.67226C27.4013
                                                                    9.67226 9.08144 27.9921 9.08144 50.5908Z"
                        fill="currentColor" />
                    <path d="M93.9676 39.0409C96.393 38.4038
                                                                    97.8624 35.9116 97.0079 33.5539C95.2932
                                                                    28.8227 92.871 24.3692 89.8167 20.348C85.8452
                                                                    15.1192 80.8826 10.7238 75.2124 7.41289C69.5422
                                                                    4.10194 63.2754 1.94025 56.7698 1.05124C51.7666
                                                                    0.367541 46.6976 0.446843 41.7345 1.27873C39.2613
                                                                    1.69328 37.813 4.19778 38.4501 6.62326C39.0873
                                                                    9.04874 41.5694 10.4717 44.0505 10.1071C47.8511
                                                                    9.54855 51.7191 9.52689 55.5402 10.0491C60.8642
                                                                    10.7766 65.9928 12.5457 70.6331 15.2552C75.2735
                                                                    17.9648 79.3347 21.5619 82.5849 25.841C84.9175
                                                                    28.9121 86.7997 32.2913 88.1811 35.8758C89.083
                                                                    38.2158 91.5421 39.6781 93.9676 39.0409Z"
                        fill="currentFill" />
                </svg>
                <span class="text-white text-sm font-normal leading-snug">Loading...</span>
            </div>
        </div>

    </div>

    <script>
        // Konfirmasi hapus
        function confirmDeleteInvestasi(id) {
            Swal.fire({
                title: 'Yakin Ingin Menghapus?',
                text: "Data yang dihapus tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-investasi-' + id).submit();
                }
            });
        }

        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @endif

        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: "{{ session('error') }}",
                confirmButtonText: 'OK'
            });
        @endif
    </script>

    <script>
        const sektorLabels = @json($kategori->flatMap(fn($kat) => $kat->sektorInvestasi->pluck('nama')));
        const realisasiData = @json(
            $kategori->flatMap(fn($kat) => $kat->sektorInvestasi->map(fn($s) => optional($s->investasi->first())->realisasi_pma +
                        optional($s->investasi->first())->realisasi_pmdn ??
                        0)));

        const pmaData = @json($kategori->flatMap(fn($kat) => $kat->sektorInvestasi->map(fn($s) => optional($s->investasi->first())->realisasi_pma ?? 0)));

        const pmdnData = @json($kategori->flatMap(fn($kat) => $kat->sektorInvestasi->map(fn($s) => optional($s->investasi->first())->realisasi_pmdn ?? 0)));

        new Chart(document.getElementById('barChart').getContext('2d'), {
            type: 'bar',
            data: {
                labels: sektorLabels,
                datasets: [{
                        label: 'Realisasi Investasi PMA (Rp)',
                        data: pmaData,
                        backgroundColor: '#3b82f6'
                    },
                    {
                        label: 'Realisasi Investasi PMDN (Rp)',
                        data: pmdnData,
                        backgroundColor: '#f97316'
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true
                    },
                    tooltip: {
                        enabled: true
                    }
                },
                interaction: {
                    mode: 'index',
                    intersect: false,
                    axis: 'x'
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: value => new Intl.NumberFormat('id-ID').format(value)
                        }
                    }
                }
            }
        });

        new Chart(document.getElementById('lineChart').getContext('2d'), {
            type: 'line',
            data: {
                labels: sektorLabels,
                datasets: [{
                    label: 'Total Realisasi Investasi (Rp)',
                    data: realisasiData,
                    fill: true,
                    borderColor: '#3b82f6',
                    tension: 0.3,
                    backgroundColor: (context) => {
                        const chart = context.chart;
                        const {
                            ctx,
                            chartArea
                        } = chart;
                        if (!chartArea) {
                            return;
                        }
                        const gradient = ctx.createLinearGradient(0, chartArea.bottom, 0, chartArea
                            .top);
                        gradient.addColorStop(0.5,
                            'rgba(59, 130, 246, 0.2)');
                        gradient.addColorStop(1, 'rgba(59, 130, 246, 0.6)');
                        return gradient;
                    },
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true
                    },
                    tooltip: {
                        enabled: true
                    }
                },
                interaction: {
                    mode: 'index',
                    intersect: false,
                    axis: 'x'
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: value => new Intl.NumberFormat('id-ID').format(value)
                        }
                    }
                }
            }
        });

        const overlay = document.getElementById('loadingOverlay');

        document.querySelectorAll('.exportBtn').forEach(btn => {
            btn.addEventListener('click', async (e) => {
                e.preventDefault();
                overlay.classList.remove('hidden');

                const url = btn.getAttribute('href');

                try {
                    const response = await fetch(url);

                    const disposition = response.headers.get('Content-Disposition');
                    let fileName = "export investasi.xlsx";
                    if (disposition && disposition.indexOf('filename=') !== -1) {
                        const matches = /filename[^;=\n]*=((['"]).*?\2|[^;\n]*)/.exec(disposition);
                        if (matches != null && matches[1]) {
                            fileName = matches[1].replace(/['"]/g, '');
                        }
                    }

                    const blob = await response.blob();
                    const link = document.createElement("a");
                    link.href = window.URL.createObjectURL(blob);
                    link.download = fileName;
                    document.body.appendChild(link);
                    link.click();
                    link.remove();
                } catch (err) {
                    alert("Gagal Export File!");
                    console.error(err);
                } finally {
                    overlay.classList.add('hidden');
                }
            });
        });

        document.getElementById('exportDiagramInvestasiKabKota').addEventListener('click', function() {
            overlay.classList.remove('hidden');
            const {
                jsPDF
            } = window.jspdf;
            const doc = new jsPDF({
                orientation: 'landscape',
                unit: 'mm',
                format: 'a4',
                compress: true
            });
            const margin = 10;
            const judulYOffset = 10;

            const barChartTitle = "Grafik Data Investasi Per-Sektor";
            const lineChartTitle = "Grafik Total Data Investasi Per-Sektor";

            // Bar Chart
            const barCanvas = document.getElementById('barChart');
            html2canvas(barCanvas, {
                scale: 2
            }).then(barCanvasImg => {
                const barImgData = barCanvasImg.toDataURL('image/jpeg', 0.75);
                const pdfWidth = doc.internal.pageSize.getWidth();
                const barImgWidth = pdfWidth - (2 * margin);
                const barImgHeight = (barCanvasImg.height * barImgWidth) / barCanvasImg.width;

                doc.setFontSize(14);
                doc.text(barChartTitle, margin, margin + judulYOffset);

                doc.addImage(barImgData, 'JPEG', margin, margin + judulYOffset + 5, barImgWidth,
                    barImgHeight);

                doc.addPage();

                // Line Chart
                const lineCanvas = document.getElementById('lineChart');
                html2canvas(lineCanvas, {
                    scale: 2
                }).then(lineCanvasImg => {
                    const lineImgData = lineCanvasImg.toDataURL('image/jpeg', 0.75);
                    const lineImgWidth = pdfWidth - (2 * margin);
                    const lineImgHeight = (lineCanvasImg.height * lineImgWidth) / lineCanvasImg
                        .width;

                    doc.setFontSize(14);
                    doc.text(lineChartTitle, margin, margin + judulYOffset);

                    doc.addImage(lineImgData, 'JPEG', margin, margin + judulYOffset + 5,
                        lineImgWidth, lineImgHeight);

                    doc.save('Grafik Data Investasi {{ $nama_kab_kota }}.pdf');
                    overlay.classList.add('hidden');
                });
            });
        });
    </script>
    <script>
        const chartData = @json(
            $kategori->map(function ($kat) {
                return [
                    'kategori' => $kat->nama_kategori,
                    'total_realisasi' => $kat->sektorInvestasi->sum(function ($s) {
                        return $s->investasi->sum('realisasi_pma') + $s->investasi->sum('realisasi_pmdn');
                    }),
                ];
            }));

        console.log(chartData);
    </script>
@endsection
