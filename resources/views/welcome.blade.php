@extends('template.header')
@section('title', 'Beranda - DPMPTSP Sumatera Selatan')
@section('konten')

    <div class="relative h-[50vh] w-full" data-aos="fade-down" data-aos-duration="1500">
        <img src="img/logo-1.jpeg" class="h-full w-full object-cover" alt="Banner DPMPTSP">

        <div class="absolute inset-0 bg-black bg-opacity-40"></div>

        <div class="absolute inset-0 flex flex-col items-center justify-center text-center px-4">
            <h1 class="text-3xl md:text-4xl font-bold text-white mb-2 drop-shadow" data-aos="fade-right" data-aos-duration="1500">
                Selamat Datang di DPMPTSP Sumatera Selatan
            </h1>
            <p class="text-white text-base md:text-lg drop-shadow" data-aos="fade-left" data-aos-duration="1500">
                Pusat Pelayanan Perizinan dan Penanaman Modal Terpadu Satu Pintu
            </p>
        </div>
    </div>

    <div class="p-8 container mx-auto">

        <form method="GET" action="{{ route('welcome') }}" class="mb-6 flex gap-4 items-center justify-center w-full"
            data-aos="fade-up" data-aos-duration="1500">
            <select name="triwulan" class="border p-2 rounded">
                <option value="" disabled selected hidden>-- Pilih Triwulan --</option>
                @for ($i = 1; $i <= 4; $i++)
                    <option value="{{ $i }}" {{ request('triwulan') == $i ? 'selected' : '' }}>
                        Triwulan {{ $i }}
                    </option>
                @endfor
            </select>

            <input type="number" name="tahun" placeholder="Tahun" class="border p-2 rounded w-32"
                value="{{ request('tahun') ?? date('Y') }}">

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Filter
            </button>
        </form>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-14 scroll-mt-24" id="total-penanaman-modal">
            <div class="p-6 bg-blue-100 rounded-lg shadow text-center" data-aos="fade-right" data-aos-duration="1500">
                <div class="text-blue-600 mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mx-auto" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8c1.104 0 2 .896 2 2s-.896 2-2 2-2-.896-2-2 .896-2 2-2zM12 12v2m0 4v2m0 0h-2m2 0h2m4-2v2m-8-2v2M4 6h16M4 6L2 12h20L20 6" />
                    </svg>
                </div>
                <h3 class="text-lg font-semibold mb-1">Total Realisasi PMA</h3>
                <p class="text-2xl font-bold text-gray-800">
                    Rp {{ number_format($totalPmaRealisasi, 2, ',', '.') }}
                </p>
            </div>

            <div class="p-6 bg-orange-100 rounded-lg shadow text-center" data-aos="fade-up" data-aos-duration="1500">
                <div class="text-orange-600 mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mx-auto" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 10h18M3 6h18M4 14h16M5 18h14" />
                    </svg>
                </div>
                <h3 class="text-lg font-semibold mb-1">Total Realisasi PMDN</h3>
                <p class="text-2xl font-bold text-gray-800">
                    Rp {{ number_format($totalPmdnRealisasi, 2, ',', '.') }}
                </p>
            </div>

            <div class="p-6 bg-green-100 rounded-lg shadow text-center" data-aos="fade-left" data-aos-duration="1500">
                <div class="text-green-600 mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mx-auto" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 12h.01M12 12h.01M16 12h.01M9 16h6M4 6h16" />
                    </svg>
                </div>
                <h3 class="text-lg font-semibold mb-1">Total Perizinan</h3>
                <p class="text-2xl font-bold text-gray-800">
                    {{ number_format($totalPerizinan, 0, ',', '.') }}
                </p>
            </div>
        </div>

        <div class="mb-14 bg-white shadow-md rounded-2xl p-6" data-aos="fade-down" data-aos-duration="1500">
            <h2 class="text-xl font-bold mb-6 text-gray-800">Grafik Investasi PMA Per-Kabupaten/Kota</h2>
            <canvas id="pmaChart" class="w-full max-w-4xl mx-auto"></canvas>
        </div>

        <div class="mb-14 bg-white shadow-md rounded-2xl p-6" data-aos="fade-right" data-aos-duration="1500">
            <h2 class="text-xl font-bold mb-6 text-gray-800">Grafik Investasi PMDN Per-Kabupaten/Kota</h2>
            <canvas id="pmdnChart" class="w-full max-w-4xl mx-auto"></canvas>
        </div>

        <div class="mb-14 bg-white shadow-md rounded-2xl p-6" data-aos="fade-left" data-aos-duration="1500">
            <h2 class="text-xl font-bold mb-6 text-gray-800">Grafik Perizinan Per-Kabupaten/Kota</h2>
            <canvas id="perizinanChart" class="w-full max-w-4xl mx-auto"></canvas>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-12 mb-12 scroll-mt-24" id="visi-misi">
            <div class="p-6 bg-white border-l-4 border-blue-500 rounded-lg shadow hover:shadow-md transition"
                data-aos="fade-right" data-aos-duration="1500">
                <h3 class="text-2xl text-center font-bold mb-3 text-blue-700 gap-2">
                    Visi
                </h3>
                <p class="text-gray-700 leading-relaxed text-justify">
                    Provinsi Tujuan Investasi Utama Berbasis Sumber Daya Lokal yang Berdaya Saing Guna Mendukung Sumatera
                    Selatan Maju Untuk Semua.
                </p>
            </div>

            <div class="p-6 bg-white border-l-4 border-green-500 rounded-lg shadow hover:shadow-md transition"
                data-aos="fade-left" data-aos-duration="1500">
                <h3 class="text-2xl text-center font-bold mb-3 text-green-700 gap-2">
                    Misi
                </h3>
                <p class="text-gray-700 leading-relaxed text-justify">
                    1. Mendorong Terciptanya Iklim Investasi yang Berdaya Saing; <br>
                    2. Meningkatkan Investasi yang Berbasis Sumber Daya Lokal; dan <br>
                    3. Meningkatkan Kualitas Pelayanan Perizinan dan Non Perizinan.
                </p>
            </div>
        </div>

        <div class="col-span-2 flex justify-center mb-12">
            <div class="p-6 bg-white border-l-4 border-orange-500 rounded-lg shadow hover:shadow-md transition w-full md:w-1/2"
                data-aos="fade-down" data-aos-duration="1500">
                <h3 class="text-2xl text-center font-bold mb-3 text-orange-500 gap-2">
                    Motto
                </h3>
                <p class="text-gray-700 leading-relaxed text-center">
                    TOP (TERINTEGRASI, OPTIMAL DAN PRIMA)
                </p>
            </div>
        </div>

        <div class="mb-12 p-6 bg-gray-50 border border-gray-200 rounded-lg shadow hover:shadow-md transition scroll-mt-24"
            data-aos="fade-up" data-aos-duration="1500" id="dpmptsp">
            <h3 class="text-2xl font-bold mb-3 text-gray-800 flex items-center gap-2">
                Apa itu DPMPTSP?
            </h3>
            <p class="text-gray-700 leading-relaxed text-justify">
                Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu (DPMPTSP) adalah lembaga pemerintah daerah
                yang bertugas memberikan pelayanan perizinan dan penanaman modal secara cepat, mudah, dan terpadu.
                Dengan sistem satu pintu, DPMPTSP menyederhanakan proses perizinan usaha, pembangunan, dan
                investasi, serta memfasilitasi promosi dan koordinasi lintas instansi agar masyarakat dapat
                mengurus izin tanpa birokrasi yang rumit.
            </p>
        </div>


        <div class="flex justify-center mb-10" data-aos="zoom-in" data-aos-duration="1500">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4949.48910136541!2d104.737225!3d-2.960236!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e3b756e5108909b%3A0x45d92444b18cb38b!2sDinas%20Penanaman%20Modal%20dan%20Pelayanan%20Terpadu%20Satu%20Pintu%20Provinsi%20Sumatera%20Selatan!5e1!3m2!1sid!2sid!4v1754226710036!5m2!1sid!2sid"
                width="800" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>

        <div class="mb-10 bg-white shadow-md rounded-2xl p-6" data-aos="fade-right" data-aos-duration="1500">
            <h2 class="text-xl font-bold mb-4">STATISTIK KUNJUNGAN WEBSITE</h2>
            <div class="grid grid-cols-1 md:grid-cols-5 gap-4 text-center">

                <div class="p-4 border rounded">
                    <p class="text-sm text-gray-500">Hari Ini</p>
                    <p class="text-2xl font-bold mt-1">{{ $statistik['today'] }}</p>
                </div>

                <div class="p-4 border rounded">
                    <p class="text-sm text-gray-500">Minggu Ini</p>
                    <p class="text-2xl font-bold mt-1">{{ $statistik['this_week'] }}</p>
                </div>

                <div class="p-4 border rounded">
                    <p class="text-sm text-gray-500">Bulan Ini</p>
                    <p class="text-2xl font-bold mt-1">{{ $statistik['this_month'] }}</p>
                </div>

                <div class="p-4 border rounded">
                    <p class="text-sm text-gray-500">Tahun Ini</p>
                    <p class="text-2xl font-bold mt-1">{{ $statistik['this_year'] }}</p>
                </div>

                <div class="p-4 border rounded">
                    <p class="text-sm text-gray-500">Total Kunjungan</p>
                    <p class="text-2xl font-bold mt-1">{{ $statistik['total'] }}</p>
                </div>
            </div>
        </div>

        <div class="mb-10 bg-white shadow-md rounded-2xl p-6" data-aos="fade-left" data-aos-duration="1500">
            <h2 class="text-xl font-bold mb-4">Grafik Kunjungan (7 Hari Terakhir)</h2>
            <canvas id="visitChart" class="w-full max-w-2xl mx-auto"></canvas>
        </div>

    </div>

    <script>
        const pmaLabels = {!! json_encode(array_keys($pmaPerDaerah)) !!};
        const pmaData = {!! json_encode(array_values($pmaPerDaerah)) !!};
        const pmdnLabels = {!! json_encode(array_keys($pmdnPerDaerah)) !!};
        const pmdnData = {!! json_encode(array_values($pmdnPerDaerah)) !!};
        const perizinanLabels = {!! json_encode(array_keys($perizinanPerDaerah)) !!};
        const perizinanData = {!! json_encode(array_values($perizinanPerDaerah)) !!};

        // Grafik PMA
        new Chart(document.getElementById('pmaChart').getContext('2d'), {
            type: 'bar',
            data: {
                labels: pmaLabels,
                datasets: [{
                    label: 'Realisasi Investasi PMA (Rp)',
                    data: pmaData,
                    backgroundColor: '#3b82f6'
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

        // Grafik PMDN
        new Chart(document.getElementById('pmdnChart').getContext('2d'), {
            type: 'bar',
            data: {
                labels: pmdnLabels,
                datasets: [{
                    label: 'Realisasi Investasi PMDN (Rp)',
                    data: pmdnData,
                    backgroundColor: '#f97316'
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

        // Grafik Perizinan
        new Chart(document.getElementById('perizinanChart').getContext('2d'), {
            type: 'bar',
            data: {
                labels: perizinanLabels,
                datasets: [{
                    label: 'Total Perizinan Per-Kabupaten/Kota',
                    data: perizinanData,
                    backgroundColor: '#10b981'
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
    </script>
    <script>
        const labels = @json($labels);
        const dataKunjungan = @json($dataKunjungan);

        const data = {
            labels: labels,
            datasets: [{
                label: 'Jumlah Kunjungan',
                data: dataKunjungan,
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
                    const gradient = ctx.createLinearGradient(0, chartArea.bottom, 0, chartArea.top);
                    gradient.addColorStop(0.5,
                        'rgba(59, 130, 246, 0.2)');
                    gradient.addColorStop(1, 'rgba(59, 130, 246, 0.6)');
                    return gradient;
                },
            }]
        };

        const config = {
            type: 'line',
            data: data,
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
        };

        new Chart(
            document.getElementById('visitChart'),
            config
        );
    </script>
@endsection
