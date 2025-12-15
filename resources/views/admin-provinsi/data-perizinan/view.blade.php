@extends('template.header_admin_provinsi')
@section('titleadminprovinsi', 'View Data Perizinan Admin Provinsi - DPMPTSP Sumatera Selatan')
@section('konten_admin_provinsi')

    <div class="container mx-auto px-4 py-6">

        {{-- Filter dan Export --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8 gap-2">
            <form method="GET" action="{{ route('perizinan_tampil_provinsi') }}" class="flex flex-wrap gap-2">
                <select name="triwulan" class="border p-2 rounded">
                    @for ($i = 1; $i <= 4; $i++)
                        <option value="{{ $i }}" {{ $triwulan == $i ? 'selected' : '' }}>Triwulan
                            {{ $i }}</option>
                    @endfor
                </select>

                <input type="number" name="tahun" value="{{ $tahun }}" class="border p-2 w-24 rounded">

                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Filter
                </button>
            </form>

            <div class="flex flex-row gap-2">
                <a href="{{ route('perizinan_export_excel_provinsi', ['triwulan' => $triwulan, 'tahun' => $tahun]) }}"
                    class="exportBtn bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded text-center">
                    Export Rekap Per-Triwulan
                </a>
                <a href="{{ route('export_rekap_perizinan_tahunan_provinsi', ['tahun' => $tahun]) }}"
                    class="exportBtn bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded text-center">
                    Export Rekap Per-Tahun
                </a>
            </div>
        </div>

        {{-- Judul --}}
        <h2 class="text-xl font-bold mb-6">
            Data Perizinan – Triwulan {{ $triwulan }} Tahun {{ $tahun }}
        </h2>

        {{-- Tabel Cluster Kabupaten/Kota --}}
        <h3 class="text-xl font-bold mb-2">Cluster Kabupaten/Kota</h3>
        <div class="overflow-auto mb-6">
            <table class="table-auto border-collapse w-full border border-gray-300 text-sm">
                <thead class="bg-gray-200 text-center">
                    <tr>
                        <th rowspan="2" class="border border-gray-300 px-2 py-1">NO</th>
                        <th rowspan="2" class="border border-gray-300 px-2 py-1">CLUSTER <br> KABUPATEN/KOTA</th>
                        <th colspan="2" class="border border-gray-300 px-2 py-1">JUMLAH <br> PERIZINAN DAN NON PERIZINAN
                        </th>
                        <th rowspan="2" class="border border-gray-300 px-2 py-1">JUMLAH PERIZINAN <br> DAN NON PERIZINAN
                            <br> PER KABUPATEN/KOTA
                        </th>
                    </tr>
                    <tr>
                        <th class="border border-gray-300 px-2 py-1">Online Single Submission <br> (OSS RBA)</th>
                        <th class="border border-gray-300 px-2 py-1">SI CANTIK <br> (NON OSS RBA)</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                        $totalOss = $totalNonOss = $grandTotal = 0;
                    @endphp
                    @foreach ($kabkotaData as $data)
                        @php
                            $totalOss += $data->oss_rba;
                            $totalNonOss += $data->non_oss_rba;
                            $grandTotal += $data->total;
                        @endphp
                        <tr>
                            <td class="border px-2 py-1 text-center">{{ $no++ }}</td>
                            <td class="border px-2 py-1">{{ $data->nama_kab_kota }}</td>
                            <td class="border px-2 py-1 text-center bg-blue-200">{{ $data->oss_rba }}</td>
                            <td class="border px-2 py-1 text-center bg-orange-300">{{ $data->non_oss_rba }}</td>
                            <td class="border px-2 py-1 text-center">{{ $data->total }}</td>
                        </tr>
                    @endforeach
                    <tr class="bg-green-200 font-bold">
                        <td colspan="2" class="border px-2 py-2 text-right">TOTAL PERIZINAN DAN NON PERIZINAN
                            KABUPATEN/KOTA</td>
                        <td class="border px-2 py-2 text-center">{{ $totalOss }}</td>
                        <td class="border px-2 py-2 text-center">{{ $totalNonOss }}</td>
                        <td class="border px-2 py-2 text-center">{{ $grandTotal }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        {{-- Tabel Jenis Sektor --}}
        <h3 class="text-xl font-bold mb-2">Jenis Sektor</h3>
        <div class="overflow-auto">
            <table class="table-auto border-collapse w-full border border-gray-300 text-sm">
                <thead class="bg-gray-200 text-center">
                    <tr>
                        <th rowspan="2" class="border border-gray-300 px-2 py-1">NO</th>
                        <th rowspan="2" class="border border-gray-300 px-2 py-1">JENIS SEKTOR</th>
                        <th colspan="2" class="border border-gray-300 px-2 py-1">JUMLAH <br> PERIZINAN DAN NON PERIZINAN
                            PER SEKTOR</th>
                        <th rowspan="2" class="border border-gray-300 px-2 py-1">JUMLAH PERIZINAN <br> DAN NON PERIZINAN
                            <br> PER SEKTOR
                        </th>
                    </tr>
                    <tr>
                        <th class="border border-gray-300 px-2 py-1">Online Single Submission <br> (OSS RBA)</th>
                        <th class="border border-gray-300 px-2 py-1">SI CANTIK <br> (NON OSS RBA)</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                        $totalOssSektor = $totalNonOssSektor = $grandTotalSektor = 0;
                    @endphp
                    @foreach ($sektorData as $s)
                        @php
                            $totalOssSektor += $s->oss_rba;
                            $totalNonOssSektor += $s->non_oss_rba;
                            $grandTotalSektor += $s->total;
                        @endphp
                        <tr>
                            <td class="border px-2 py-1 text-center">{{ $no++ }}</td>
                            <td class="border px-2 py-1">{{ $s->nama_sektor }}</td>
                            <td class="border px-2 py-1 text-center bg-blue-200">{{ $s->oss_rba }}</td>
                            <td class="border px-2 py-1 text-center bg-orange-300">{{ $s->non_oss_rba }}</td>
                            <td class="border px-2 py-1 text-center">{{ $s->total }}</td>
                        </tr>
                    @endforeach
                    <tr class="bg-green-200 font-bold">
                        <td colspan="2" class="border px-2 py-2 text-right">TOTAL PERIZINAN DAN NON PERIZINAN PER SEKTOR
                        </td>
                        <td class="border px-2 py-2 text-center">{{ $totalOssSektor }}</td>
                        <td class="border px-2 py-2 text-center">{{ $totalNonOssSektor }}</td>
                        <td class="border px-2 py-2 text-center">{{ $grandTotalSektor }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="mt-10">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-gray-800">Grafik Data Perizinan Per-Kabupaten/Kota</h2>
                <button id="exportDiagramPerizinanProvinsi"
                    class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">
                    Export Diagram ke PDF
                </button>
            </div>

            <div class="mb-14 bg-white shadow-md rounded-2xl p-6">
                <canvas id="barKabKota" class="w-full max-w-8xl mx-auto"></canvas>
            </div>

            <h2 class="text-xl font-bold text-gray-800">Grafik Total Data Perizinan Per-Kabupaten/Kota</h2>
            <div class="mb-14 bg-white shadow-md rounded-2xl p-6">
                <canvas id="lineKabKota" class="w-full max-w-8xl mx-auto"></canvas>
            </div>
        </div>

        <div class="mt-10">
            <h2 class="text-xl font-bold mb-6 text-gray-800">Grafik Data Perizinan Per-Sektor</h2>
            <div class="mb-14 bg-white shadow-md rounded-2xl p-6">
                <canvas id="barSektor" class="w-full max-w-8xl mx-auto"></canvas>
            </div>

            <h2 class="text-xl font-bold mb-6 text-gray-800">Grafik Total Data Perizinan Per-Sektor</h2>
            <div class="mb-14 bg-white shadow-md rounded-2xl p-6">
                <canvas id="lineSektor" class="w-full max-w-8xl mx-auto"></canvas>
            </div>
        </div>

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
        const kabKotaLabels = @json($kabkotaData->pluck('nama_kab_kota'));
        const kabKotaOss = @json($kabkotaData->pluck('oss_rba'));
        const kabKotaNonOss = @json($kabkotaData->pluck('non_oss_rba'));
        const kabKotaTotal = @json($kabkotaData->pluck('total'));

        const sektorLabels = @json($sektorData->pluck('nama_sektor'));
        const sektorOss = @json($sektorData->pluck('oss_rba'));
        const sektorNonOss = @json($sektorData->pluck('non_oss_rba'));
        const sektorTotal = @json($sektorData->pluck('total'));

        // 1. Bar per Kab/Kota
        new Chart(document.getElementById('barKabKota').getContext('2d'), {
            type: 'bar',
            data: {
                labels: kabKotaLabels,
                datasets: [{
                        label: 'OSS RBA',
                        data: kabKotaOss,
                        backgroundColor: '#3b82f6'
                    },
                    {
                        label: 'NON OSS RBA',
                        data: kabKotaNonOss,
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

        // 2. Line total per Kab/Kota
        new Chart(document.getElementById('lineKabKota').getContext('2d'), {
            type: 'line',
            data: {
                labels: kabKotaLabels,
                datasets: [{
                    label: 'Total Perizinan Per-Kabupaten/Kota',
                    data: kabKotaTotal,
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


        // 3. Bar per Sektor
        new Chart(document.getElementById('barSektor').getContext('2d'), {
            type: 'bar',
            data: {
                labels: sektorLabels,
                datasets: [{
                        label: 'OSS RBA',
                        data: sektorOss,
                        backgroundColor: '#3b82f6'
                    },
                    {
                        label: 'NON OSS RBA',
                        data: sektorNonOss,
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

        // 4. Line total per Sektor
        new Chart(document.getElementById('lineSektor').getContext('2d'), {
            type: 'line',
            data: {
                labels: sektorLabels,
                datasets: [{
                    label: 'Total Perizinan Per-Sektor',
                    data: sektorTotal,
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
                    let fileName = "export perizinan.xlsx";
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


        document.getElementById('exportDiagramPerizinanProvinsi').addEventListener('click', function() {
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
            let currentY = margin;

            const charts = [{
                id: 'barKabKota',
                title: 'Grafik Data Perizinan Per-Kabupaten/Kota'
            }, {
                id: 'lineKabKota',
                title: 'Grafik Total Data Perizinan Per-Kabupaten/Kota'
            }, {
                id: 'barSektor',
                title: 'Grafik Data Perizinan Per-Sektor'
            }, {
                id: 'lineSektor',
                title: 'Grafik Total Data Perizinan Per-Sektor'
            }];

            let promiseChain = Promise.resolve();

            charts.forEach((chart, index) => {
                promiseChain = promiseChain.then(() => {
                    const canvas = document.getElementById(chart.id);
                    return html2canvas(canvas, {
                        scale: 2
                    }).then(canvasImg => {
                        const imgData = canvasImg.toDataURL('image/jpeg', 0.75);
                        const pdfWidth = doc.internal.pageSize.getWidth();
                        const pdfHeight = doc.internal.pageSize.getHeight();
                        const imgWidth = pdfWidth - (2 * margin);
                        const imgHeight = (canvasImg.height * imgWidth) / canvasImg.width;

                        if (index > 0) {
                            doc.addPage();
                        }

                        doc.setFontSize(14);
                        doc.text(chart.title, margin, margin + 5);

                        doc.addImage(imgData, 'JPEG', margin, margin + 10, imgWidth,
                            imgHeight);
                    });
                });
            });

            promiseChain.then(() => {
                doc.save('Grafik Data Perizinan Provinsi Sumatera Selatan.pdf');
                overlay.classList.add('hidden');
            });
        });
    </script>
@endsection
