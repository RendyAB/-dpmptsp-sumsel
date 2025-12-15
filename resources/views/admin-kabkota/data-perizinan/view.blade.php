@extends('template.header_admin_kabkota')
@section('titleadminkabkota', 'View Data Perizinan Admin Kab/Kota - DPMPTSP Sumatera Selatan')
@section('konten_admin_kabkota')

    <div class="container mx-auto px-4 py-6">

        {{-- Filter dan Tambah --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8 gap-2">
            <form method="GET" action="{{ route('perizinan_tampil_kabkota') }}" class="flex flex-wrap gap-2">
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
                <a href="{{ route('perizinan_export_excel_kabkota', ['triwulan' => $triwulan, 'tahun' => $tahun]) }}"
                    class="exportBtn bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                    Export Rekap Per-Triwulan
                </a>

                <a href="{{ route('export_rekap_perizinan_tahunan_kabkota', ['tahun' => $tahun]) }}"
                    class="exportBtn bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                    Export Rekap Per-Tahun
                </a>
                <a href="{{ route('perizinan_create', ['triwulan' => $triwulan, 'tahun' => $tahun]) }}"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-center">
                    + Tambah Perizinan
                </a>
            </div>
        </div>

        {{-- Judul --}}
        <h2 class="text-xl font-bold mb-4">
            Data Perizinan – {{ $nama_kab_kota }} – Triwulan {{ $triwulan }} Tahun {{ $tahun }}
        </h2>

        {{-- Tabel --}}
        <div class="overflow-auto mb-4">
            <table class="table-auto border-collapse w-full border border-gray-300 text-sm">
                <thead>
                    <tr class="bg-gray-200 text-center">
                        <th rowspan="2" class="border border-gray-300 px-2 py-1">NO</th>
                        <th rowspan="2" class="border border-gray-300 px-2 py-1">JENIS SEKTOR</th>
                        <th colspan="2" class="border border-gray-300 px-2 py-1">
                            JUMLAH PERIZINAN DAN NON PERIZINAN <br> CLUSTER KABUPATEN/KOTA
                        </th>
                        <th rowspan="2" class="border border-gray-300 px-2 py-1">
                            JUMLAH PERIZINAN DAN NON PERIZINAN <br> PER SEKTOR
                        </th>
                        <th rowspan="2" class="border border-gray-300 px-2 py-1">AKSI</th>
                    </tr>
                    <tr class="bg-gray-200 text-center">
                        <th class="border border-gray-300 px-2 py-1">Online Single Submission (OSS RBA)</th>
                        <th class="border border-gray-300 px-2 py-1">SI CANTIK (NON OSS RBA)</th>
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
                            <td class="border px-2 py-1 text-center">{{ $no++ }}</td>
                            <td class="border px-2 py-1">{{ $p->sektor }}</td>
                            <td class="border px-2 py-1 text-center bg-blue-200">{{ $p->oss_rba }}</td>
                            <td class="border px-2 py-1 text-center bg-orange-300">{{ $p->non_oss_rba }}</td>
                            <td class="border px-2 py-1 text-center">{{ $p->total }}</td>
                            <td class="border px-2 py-1 text-center">
                                @if ($p->oss_rba > 0 || $p->non_oss_rba > 0)
                                    <a href="{{ route('perizinan_edit', [
                                        'sektor_id' => $p->sektor_id,
                                        'triwulan' => $triwulan,
                                        'tahun' => $tahun,
                                    ]) }}"
                                        class="text-blue-600 hover:underline">Edit</a>

                                    <form id="delete-form-perizinan-{{ $p->sektor_id }}"
                                        action="{{ route('perizinan_destroy', [
                                            'sektor_id' => $p->sektor_id,
                                            'triwulan' => $triwulan,
                                            'tahun' => $tahun,
                                        ]) }}"
                                        method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="text-red-600 hover:underline ml-2"
                                            onclick="confirmDeletePerizinan({{ $p->sektor_id }})">
                                            Hapus
                                        </button>
                                    </form>
                                @else
                                    <span class="text-yellow-600 italic">Belum Ada Data</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach

                    <tr class="bg-green-200 font-bold">
                        <td colspan="2" class="text-right border px-2 py-2">JUMLAH PERIZINAN DAN NON PERIZINAN PER SEKTOR
                        </td>
                        <td class="border px-2 py-2 text-center">{{ $totalOss }}</td>
                        <td class="border px-2 py-2 text-center">{{ $totalNonOss }}</td>
                        <td class="border px-2 py-2 text-center">{{ $grandTotal }}</td>
                        <td class="border px-2 py-2"></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="mt-10">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-gray-800">Grafik Data Perizinan Per-Sektor</h2>
                <button id="exportDiagramPerizinanKabKota" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">
                    Export Diagram ke PDF
                </button>
            </div>
            <div class="mb-14 bg-white shadow-md rounded-2xl p-6">
                <canvas id="barChart" class="w-full max-w-8xl mx-auto"></canvas>
            </div>
            <h2 class="text-xl font-bold mb-6 text-gray-800">Grafik Total Data Perizinan Per-Sektor</h2>
            <div class="mb-14 bg-white shadow-md rounded-2xl p-6">
                <canvas id="lineChart" class="w-full max-w-8xl mx-auto"></canvas>
            </div>
        </div>

        {{-- Overlay Loading --}}
        <div id="loadingOverlay" class="hidden fixed inset-0 bg-gray-800 bg-opacity-30 z-50 flex items-center justify-center">
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
                                        9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor" />
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
                                        38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill" />
                </svg>
                <span class="text-white text-sm font-normal leading-snug">Loading...</span>
            </div>
        </div>
    </div>

    <script>
        function confirmDeletePerizinan(sektorId) {
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
                    document.getElementById('delete-form-perizinan-' + sektorId).submit();
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
        const sektorLabels = @json($perizinan->pluck('sektor'));
        const ossData = @json($perizinan->pluck('oss_rba'));
        const nonOssData = @json($perizinan->pluck('non_oss_rba'));
        const totalData = @json($perizinan->pluck('total'));

        // Chart Bar
        new Chart(document.getElementById('barChart').getContext('2d'), {
            type: 'bar',
            data: {
                labels: sektorLabels,
                datasets: [{
                        label: 'OSS RBA',
                        data: ossData,
                        backgroundColor: '#3b82f6'
                    },
                    {
                        label: 'NON OSS RBA',
                        data: nonOssData,
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

        // Chart Line
        new Chart(document.getElementById('lineChart').getContext('2d'), {
            type: 'line',
            data: {
                labels: sektorLabels,
                datasets: [{
                    label: 'Total Perizinan',
                    data: totalData,
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


        document.getElementById('exportDiagramPerizinanKabKota').addEventListener('click', function() {
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

            const barChartTitle = "Grafik Data Perizinan Per-Sektor";
            const lineChartTitle = "Grafik Total Data Perizinan Per-Sektor";

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

                    doc.save('Grafik Data Perizinan {{ $nama_kab_kota }}.pdf');
                    overlay.classList.add('hidden');
                });
            });
        });
    </script>
@endsection
