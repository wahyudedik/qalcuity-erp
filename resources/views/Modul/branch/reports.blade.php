@extends('layouts.app')

@section('title', 'Laporan Cabang')

@section('breadcrumb')
    <nav class="flex" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="{{ route('dashboard') }}"
                    class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                    <svg class="w-3 h-3 mr-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path
                            d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                    </svg>
                    Dashboard
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 9 4-4-4-4" />
                    </svg>
                    <a href="{{ route('branches.index') }}"
                        class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2 dark:text-gray-400 dark:hover:text-white">Cabang</a>
                </div>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 9 4-4-4-4" />
                    </svg>
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">Laporan</span>
                </div>
            </li>
        </ol>
    </nav>
@endsection

@section('page-title', 'Laporan Cabang')
@section('page-subtitle', 'Visualisasi dan analisis data cabang')

@section('content')
    <!-- Filter Section -->
    <div class="bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 dark:bg-gray-800 p-4 sm:p-6 mb-4">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Filter Laporan</h3>

        <form method="GET" action="{{ route('branches.reports') }}" class="space-y-4 md:space-y-0 md:flex md:space-x-4">
            <div class="w-full md:w-1/3">
                <label for="city" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kota</label>
                <select id="city" name="city"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                    <option value="">Semua Kota</option>
                    @foreach ($cities as $city)
                        <option value="{{ $city }}"
                            {{ isset($filters['city']) && $filters['city'] == $city ? 'selected' : '' }}>{{ $city }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="w-full md:w-1/3">
                <label for="province" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Provinsi</label>
                <select id="province" name="province"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                    <option value="">Semua Provinsi</option>
                    @foreach ($provinces as $province)
                        <option value="{{ $province }}"
                            {{ isset($filters['province']) && $filters['province'] == $province ? 'selected' : '' }}>
                            {{ $province }}</option>
                    @endforeach
                </select>
            </div>

            <div class="w-full md:w-1/3">
                <label for="is_active" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                <select id="is_active" name="is_active"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                    <option value="">Semua Status</option>
                    <option value="1"
                        {{ isset($filters['is_active']) && $filters['is_active'] == '1' ? 'selected' : '' }}>Aktif</option>
                    <option value="0"
                        {{ isset($filters['is_active']) && $filters['is_active'] == '0' ? 'selected' : '' }}>Tidak Aktif
                    </option>
                </select>
            </div>

            <div class="flex items-end">
                <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                    Filter
                </button>

                @if (!empty(array_filter($filters)))
                    <a href="{{ route('branches.reports') }}"
                        class="ml-3 text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
                        Reset
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Summary Cards -->
    <div class="grid grid-cols-1 gap-4 mb-4 md:grid-cols-3">
        <div class="bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 dark:bg-gray-800 p-4 sm:p-6">
            <div class="flex items-center justify-between">
                <div class="flex-shrink-0">
                    <span
                        class="text-2xl font-bold leading-none text-gray-900 sm:text-3xl dark:text-white">{{ $totalBranches }}</span>
                    <h3 class="text-base font-light text-gray-500 dark:text-gray-400">Total Cabang</h3>
                </div>
                <div
                    class="flex items-center justify-center flex-shrink-0 w-12 h-12 ml-5 rounded-full bg-blue-100 dark:bg-blue-900">
                    <svg class="w-6 h-6 text-blue-600 dark:text-blue-300" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M3 5a2 2 0 012-2h10a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V5zm11 1H6v8l4-2 4 2V6z"
                            clip-rule="evenodd"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 dark:bg-gray-800 p-4 sm:p-6">
            <div class="flex items-center justify-between">
                <div class="flex-shrink-0">
                    <span
                        class="text-2xl font-bold leading-none text-gray-900 sm:text-3xl dark:text-white">{{ $activeBranches }}</span>
                    <h3 class="text-base font-light text-gray-500 dark:text-gray-400">Cabang Aktif</h3>
                </div>
                <div
                    class="flex items-center justify-center flex-shrink-0 w-12 h-12 ml-5 rounded-full bg-green-100 dark:bg-green-900">
                    <svg class="w-6 h-6 text-green-600 dark:text-green-300" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 dark:bg-gray-800 p-4 sm:p-6">
            <div class="flex items-center justify-between">
                <div class="flex-shrink-0">
                    <span
                        class="text-2xl font-bold leading-none text-gray-900 sm:text-3xl dark:text-white">{{ $totalUsers }}</span>
                    <h3 class="text-base font-light text-gray-500 dark:text-gray-400">Total Pengguna</h3>
                </div>
                <div
                    class="flex items-center justify-center flex-shrink-0 w-12 h-12 ml-5 rounded-full bg-purple-100 dark:bg-purple-900">
                    <svg class="w-6 h-6 text-purple-600 dark:text-purple-300" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z">
                        </path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts -->
    <div class="grid grid-cols-1 gap-4 mb-4 xl:grid-cols-2">
        <div class="bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 dark:bg-gray-800 p-4 sm:p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Distribusi Cabang per Provinsi</h3>
            </div>
            <!-- Tambahkan class untuk dark mode -->
            <div id="province-chart" class="h-80 province-chart"></div>
        </div>

        <div class="bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 dark:bg-gray-800 p-4 sm:p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Distribusi Status Cabang</h3>
            </div>
            <!-- Tambahkan class untuk dark mode -->
            <div id="status-chart" class="h-80 status-chart"></div>
        </div>
    </div>

    <!-- Branch List -->
    <div class="bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 dark:bg-gray-800 p-4 sm:p-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Daftar Cabang</h3>
            <div class="flex space-x-2">
                <button id="export-pdf" type="button"
                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:ring-red-200 dark:focus:ring-red-900">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v3.586l-1.293-1.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V8z"
                            clip-rule="evenodd"></path>
                    </svg>
                    Export PDF
                </button>
                <button id="export-excel" type="button"
                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-green-600 rounded-lg hover:bg-green-700 focus:ring-4 focus:ring-green-200 dark:focus:ring-green-900">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm2 10a1 1 0 01-1-1V8a1 1 0 012 0v3a1 1 0 01-1 1zm3 0a1 1 0 01-1-1V8a1 1 0 012 0v3a1 1 0 01-1 1z"
                            clip-rule="evenodd"></path>
                    </svg>
                    Export Excel
                </button>
            </div>
        </div>

        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-4 py-3">Nama</th>
                        <th scope="col" class="px-4 py-3">Kode</th>
                        <th scope="col" class="px-4 py-3">Kota</th>
                        <th scope="col" class="px-4 py-3">Provinsi</th>
                        <th scope="col" class="px-4 py-3">Status</th>
                        <th scope="col" class="px-4 py-3">Pengguna</th>
                        <th scope="col" class="px-4 py-3">Manager</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($branches as $branch)
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                            <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <a href="{{ route('branches.show', $branch->id) }}"
                                    class="text-primary-600 hover:text-primary-900 dark:text-primary-400 dark:hover:text-primary-300">
                                    {{ $branch->name }}
                                </a>
                            </td>
                            <td class="px-4 py-3">{{ $branch->code }}</td>
                            <td class="px-4 py-3">{{ $branch->city ?? 'N/A' }}</td>
                            <td class="px-4 py-3">{{ $branch->province ?? 'N/A' }}</td>
                            <td class="px-4 py-3">
                                @if ($branch->is_active)
                                    <span
                                        class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-md dark:bg-green-900 dark:text-green-300">Aktif</span>
                                @else
                                    <span
                                        class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-md dark:bg-red-900 dark:text-red-300">Tidak
                                        Aktif</span>
                                @endif
                            </td>
                            <td class="px-4 py-3">{{ $branch->users_count ?? 0 }}</td>
                            <td class="px-4 py-3">{{ $branch->manager_name ?? 'N/A' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-3 text-center">
                                Tidak ada cabang yang ditemukan dengan filter yang diterapkan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($branches->hasPages())
            <div class="mt-4">
                <x-pagination :paginator="$branches" entityName="Cabang" />
            </div>
        @endif
    </div>

    @push('styles')
        <style>
            /* Custom styling untuk tooltip ApexCharts */
            .apexcharts-tooltip {
                color: var(--tw-prose-body) !important;
                background: var(--tw-prose-pre-bg) !important;
                border: 1px solid var(--tw-prose-hr) !important;
                font-size: 12px !important;
                font-family: 'Inter', sans-serif !important;
                z-index: 50 !important;
            }

            .apexcharts-tooltip-title {
                background: var(--tw-prose-pre-bg) !important;
                border-bottom: 1px solid var(--tw-prose-hr) !important;
                font-weight: 600 !important;
            }

            /* Dark mode chart patcher */
            .dark .apexcharts-text tspan {
                fill: #e5e7eb !important;
            }

            .dark .apexcharts-legend-text {
                color: #e5e7eb !important;
            }

            .dark .apexcharts-tooltip {
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.5) !important;
            }

            /* Ensure yaxis labels visible in dark mode */
            .dark .apexcharts-yaxis-label tspan,
            .dark .apexcharts-xaxis-label tspan {
                fill: #e5e7eb !important;
            }
        </style>
    @endpush

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Deteksi dark mode
                const isDarkMode = document.documentElement.classList.contains('dark');

                // Warna untuk dark mode dan light mode
                const textColor = isDarkMode ? '#e5e7eb' : '#374151';
                const borderColor = isDarkMode ? '#4b5563' : '#e5e7eb';
                const tooltipBackgroundColor = isDarkMode ? '#1f2937' : '#ffffff';

                // Province chart
                const provinceData = @json($provinceStats);

                const provinceLabels = Object.keys(provinceData);
                const provinceValues = Object.values(provinceData);

                const provinceOptions = {
                    series: [{
                        name: 'Cabang',
                        data: provinceValues
                    }],
                    chart: {
                        type: 'bar',
                        height: 350,
                        fontFamily: 'Inter, sans-serif',
                        toolbar: {
                            show: false
                        },
                        // Tambahkan background untuk chart
                        background: isDarkMode ? '#1f2937' : '',
                        foreColor: textColor // Warna teks default
                    },
                    plotOptions: {
                        bar: {
                            horizontal: false,
                            columnWidth: '55%',
                            borderRadius: 2
                        },
                    },
                    dataLabels: {
                        enabled: false
                    },
                    colors: ['#3b82f6'],
                    xaxis: {
                        categories: provinceLabels,
                        labels: {
                            style: {
                                fontSize: '12px',
                                fontWeight: 500,
                                colors: Array(provinceLabels.length).fill(textColor)
                            }
                        },
                        axisBorder: {
                            color: borderColor
                        },
                        axisTicks: {
                            color: borderColor
                        }
                    },
                    yaxis: {
                        title: {
                            // text: 'Jumlah Cabang',
                            style: {
                                fontSize: '14px',
                                fontWeight: 500,
                                color: textColor
                            }
                        },
                        labels: {
                            style: {
                                fontSize: '12px',
                                fontWeight: 500,
                                colors: [textColor]
                            }
                        }
                    },
                    grid: {
                        borderColor: borderColor,
                        strokeDashArray: 4,
                        yaxis: {
                            lines: {
                                show: true
                            }
                        }
                    },
                    fill: {
                        opacity: 1
                    },
                    tooltip: {
                        theme: isDarkMode ? 'dark' : 'light',
                        y: {
                            formatter: function(val) {
                                return val + " cabang"
                            }
                        },
                        // Tambahkan styling untuk tooltip
                        style: {
                            fontSize: '12px',
                            fontFamily: 'Inter, sans-serif'
                        },
                        // Pastikan warna teks kontras
                        custom: function({
                            series,
                            seriesIndex,
                            dataPointIndex,
                            w
                        }) {
                            const value = series[seriesIndex][dataPointIndex];
                            const label = provinceLabels[dataPointIndex];

                            return `<div class="p-2" style="background: ${tooltipBackgroundColor}; color: ${textColor}; border: 1px solid ${borderColor}; border-radius: 4px;">
                                <span class="font-semibold">${label}</span>: <span>${value} cabang</span>
                            </div>`;
                        }
                    }
                };

                const provinceChart = new ApexCharts(document.querySelector("#province-chart"), provinceOptions);
                provinceChart.render();

                // Status chart
                const statusOptions = {
                    series: [{{ $activeBranches }}, {{ $inactiveBranches }}],
                    chart: {
                        type: 'donut',
                        height: 350,
                        fontFamily: 'Inter, sans-serif',
                        toolbar: {
                            show: false
                        },
                        // Tambahkan background untuk chart
                        background: isDarkMode ? '#1f2937' : '',
                        foreColor: textColor // Warna teks default
                    },
                    labels: ['Aktif', 'Tidak Aktif'],
                    colors: ['#10B981', '#EF4444'],
                    legend: {
                        position: 'bottom',
                        fontWeight: 500,
                        offsetY: 10,
                        labels: {
                            colors: textColor
                        },
                        itemMargin: {
                            horizontal: 10,
                            vertical: 5
                        }
                    },
                    dataLabels: {
                        enabled: true,
                        style: {
                            fontSize: '14px',
                            fontWeight: 500,
                            fontFamily: 'Inter, sans-serif',
                            colors: [textColor, textColor] // Ensure text visibility in pie segments
                        },
                        dropShadow: {
                            enabled: true,
                            blur: 3,
                            opacity: 0.8
                        }
                    },
                    plotOptions: {
                        pie: {
                            donut: {
                                size: '70%',
                                labels: {
                                    show: true,
                                    total: {
                                        show: false,
                                        showAlways: false,
                                        label: 'Jumlah Cabang',
                                        fontSize: '16px',
                                        fontWeight: 600,
                                        color: textColor
                                    },
                                    value: {
                                        fontSize: '22px',
                                        fontWeight: 700,
                                        color: textColor,
                                        formatter: function(w) {
                                            return w.globals.seriesTotals.reduce((a, b) => a + b, 0);
                                        }
                                    }
                                }
                            }
                        }
                    },
                    stroke: {
                        width: 2,
                        colors: isDarkMode ? ['#1f2937'] : ['#ffffff']
                    },
                    responsive: [{
                        breakpoint: 480,
                        options: {
                            chart: {
                                width: 280
                            },
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }],
                    tooltip: {
                        enabled: true,
                        theme: isDarkMode ? 'dark' : 'light',
                        fillSeriesColor: true,
                        style: {
                            fontSize: '12px',
                            fontFamily: 'Inter, sans-serif'
                        },
                        // Pastikan warna teks kontras
                        custom: function({
                            series,
                            seriesIndex,
                            dataPointIndex,
                            w
                        }) {
                            const value = series[seriesIndex];
                            const label = w.globals.labels[seriesIndex];
                            const color = w.globals.colors[seriesIndex];

                            return `<div class="p-2" style="background: ${tooltipBackgroundColor}; color: ${textColor}; border: 1px solid ${borderColor}; border-radius: 4px;">
                                <div class="flex items-center">
                                    <span class="inline-block w-3 h-3 mr-1.5" style="background:${color}"></span>
                                    <span class="font-semibold">${label}</span>: <span>${value} cabang</span>
                                </div>
                            </div>`;
                        }
                    }
                };

                const statusChart = new ApexCharts(document.querySelector("#status-chart"), statusOptions);
                statusChart.render();

                // Pastikan ini ada di bagian script di reports.blade.php
                document.getElementById('export-pdf').addEventListener('click', function() {
                    // Ambil semua parameter filter yang ada di URL saat ini
                    const currentParams = new URLSearchParams(window.location.search);
                    window.location.href = "{{ route('branches.reports.export-pdf') }}?" + currentParams
                        .toString();
                });

                document.getElementById('export-excel').addEventListener('click', function() {
                    // Ambil semua parameter filter yang ada di URL saat ini
                    const currentParams = new URLSearchParams(window.location.search);
                    window.location.href = "{{ route('branches.reports.export-excel') }}?" + currentParams
                        .toString();
                });

                // Theme switcher listener untuk memperbarui chart saat tema berubah
                const themeMediaQuery = window.matchMedia('(prefers-color-scheme: dark)');
                themeMediaQuery.addEventListener('change', () => {
                    window.location.reload(); // Refresh halaman untuk memperbarui chart
                });

                // Tangani dark mode toggle manual jika ada
                const darkModeToggle = document.getElementById('theme-toggle');
                if (darkModeToggle) {
                    darkModeToggle.addEventListener('click', () => {
                        setTimeout(() => {
                            window.location
                                .reload(); // Refresh setelah sedikit delay untuk memungkinkan tema berubah
                        }, 100);
                    });
                }
            });
        </script>
    @endpush
@endsection
