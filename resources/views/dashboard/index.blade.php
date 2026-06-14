@extends('layouts.app')

@section('title', 'Dashboard - Sistem Sembako')
@section('header', 'Dashboard')

@section('content')
    <!-- Welcome Banner -->
    <div
        class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
        <div>
            <h2 class="text-xl font-bold text-blue-800 mb-1">Selamat datang, Admin!</h2>
            <p class="text-sm text-gray-500">Berikut ringkasan informasi sistem prediksi dan rekomendasi stok.</p>
        </div>
        <div class="mt-4 md:mt-0 flex gap-3 text-sm text-gray-600 font-medium">
            <div class="flex items-center px-4 py-2 bg-gray-50 rounded-lg border border-gray-100">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                {{ \Carbon\Carbon::now()->translatedFormat('d M Y') }}
            </div>
            <div class="flex items-center px-4 py-2 bg-gray-50 rounded-lg border border-gray-100">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                {{ \Carbon\Carbon::now()->format('H:i:s') }}
            </div>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        <!-- Card 1 -->
        <div class="bg-blue-50/40 rounded-2xl p-5 border border-blue-100 flex items-start gap-4">
            <div
                class="w-12 h-12 rounded-full bg-white shadow-sm text-blue-500 flex items-center justify-center flex-shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                </svg>
            </div>
            <div>
                <h3 class="text-sm font-semibold text-gray-700 mb-1">Total Data Barang</h3>
                <p class="text-2xl font-bold text-gray-900 mb-1">{{ $totalBarang }}</p>
                <p class="text-[11px] text-gray-500 mb-3">Barang terdaftar</p>
                <a href="{{ route('barang.index') }}"
                    class="text-xs text-blue-600 font-semibold hover:text-blue-700 flex items-center">
                    Lihat Detail <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3">
                        </path>
                    </svg>
                </a>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="bg-green-50/40 rounded-2xl p-5 border border-green-100 flex items-start gap-4">
            <div
                class="w-12 h-12 rounded-full bg-white shadow-sm text-green-500 flex items-center justify-center flex-shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
                    </path>
                </svg>
            </div>
            <div>
                <h3 class="text-sm font-semibold text-gray-700 mb-1">Total Penjualan</h3>
                <p class="text-2xl font-bold text-gray-900 mb-1">{{ $totalPenjualan }}</p>
                <p class="text-[11px] text-gray-500 mb-3">Transaksi (Bulan ini)</p>
                <a href="{{ route('penjualan.index') }}"
                    class="text-xs text-green-600 font-semibold hover:text-green-700 flex items-center">
                    Lihat Detail <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3">
                        </path>
                    </svg>
                </a>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="bg-yellow-50/40 rounded-2xl p-5 border border-yellow-100 flex items-start gap-4">
            <div
                class="w-12 h-12 rounded-full bg-white shadow-sm text-yellow-500 flex items-center justify-center flex-shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                </svg>
            </div>
            <div>
                <h3 class="text-sm font-semibold text-gray-700 mb-1">Prediksi Terbaru</h3>
                <p class="text-2xl font-bold text-gray-900 mb-1">
                    {{ \App\Models\Prediksi::whereDate('created_at', today())->count() }}</p>
                <p class="text-[11px] text-gray-500 mb-3">Prediksi (Hari ini)</p>
                <a href="{{ route('prediksi.index') }}"
                    class="text-xs text-yellow-600 font-semibold hover:text-yellow-700 flex items-center">
                    Lihat Detail <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3">
                        </path>
                    </svg>
                </a>
            </div>
        </div>

        <!-- Card 4 -->
        <div class="bg-purple-50/40 rounded-2xl p-5 border border-purple-100 flex items-start gap-4">
            <div
                class="w-12 h-12 rounded-full bg-white shadow-sm text-purple-500 flex items-center justify-center flex-shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                    </path>
                </svg>
            </div>
            <div>
                @php
                    $stokRendah = \App\Models\Barang::where('stok', '<', 50)->count();
                @endphp
                <h3 class="text-sm font-semibold text-gray-700 mb-1">Stok Rendah</h3>
                <p class="text-2xl font-bold text-gray-900 mb-1">{{ $stokRendah }}</p>
                <p class="text-[11px] text-gray-500 mb-3">Barang perlu restock</p>
                <a href="{{ route('barang.index') }}"
                    class="text-xs text-purple-600 font-semibold hover:text-purple-700 flex items-center">
                    Lihat Detail <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3">
                        </path>
                    </svg>
                </a>
            </div>
        </div>
    </div>

    <!-- Chart and Table Row -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
        <!-- Chart -->
        <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-base font-bold text-gray-800">Ringkasan Penjualan (6 Bulan Terakhir)</h3>
                <button class="text-gray-400 hover:text-gray-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z">
                        </path>
                    </svg>
                </button>
            </div>
            <div class="relative h-64">
                <canvas id="salesChart"></canvas>
            </div>
            <div class="mt-4 flex justify-center items-center text-xs text-gray-500 gap-2">
                <div class="w-3 h-3 rounded-full bg-blue-500"></div> Total Penjualan
            </div>
        </div>

        <!-- Prediksi Terbaru -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex flex-col">
            <h3 class="text-base font-bold text-gray-800 mb-4">Prediksi Terbaru</h3>
            <div class="overflow-x-auto flex-1">
                <table class="w-full text-left text-xs">
                    <thead>
                        <tr class="text-gray-500 font-semibold border-b border-gray-100">
                            <th class="py-2">No</th>
                            <th class="py-2">Nama Barang</th>
                            <th class="py-2 text-center">Prediksi Permintaan</th>
                            <th class="py-2 text-center">Rekomendasi Stok</th>
                            <th class="py-2 text-right">Tgl Prediksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($prediksiTerbaru as $index => $p)
                            <tr>
                                <td class="py-3 text-gray-500">{{ $index + 1 }}</td>
                                <td class="py-3 text-gray-800 font-medium">{{ $p->barang->nama_barang }}</td>
                                <td class="py-3 text-center">{{ $p->hasil_prediksi }}</td>
                                <td class="py-3 text-center text-gray-800 font-bold bg-gray-50">{{ $p->hasil_prediksi }}</td>
                                <td class="py-3 text-right text-gray-500">{{ $p->created_at->format('d/m/Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-6 text-center text-gray-400">Belum ada data prediksi.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-4 flex justify-end">
                <a href="{{ route('prediksi.index') }}"
                    class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold rounded-lg transition-colors">
                    Lihat Semua &rarr;
                </a>
            </div>
        </div>
    </div>

    <!-- Bottom Row -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        <!-- Stok Barang Rendah -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex flex-col">
            <h3 class="text-base font-bold text-gray-800 mb-4">Stok Barang Rendah</h3>
            <div class="overflow-x-auto flex-1 bg-gray-50/50 rounded-xl">
                <table class="w-full text-left text-xs">
                    <thead>
                        <tr class="text-gray-500 font-semibold border-b border-gray-100 bg-gray-50">
                            <th class="py-3 px-4">No</th>
                            <th class="py-3 px-4">Nama Barang</th>
                            <th class="py-3 px-4 text-center">Stok Saat Ini</th>
                            <th class="py-3 px-4 text-center">Minimum Stok</th>
                            <th class="py-3 px-4 text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse(\App\Models\Barang::where('stok', '<', 50)->take(3)->get() as $index => $barang)
                            <tr class="bg-white">
                                <td class="py-3 px-4 text-gray-500">{{ $index + 1 }}</td>
                                <td class="py-3 px-4 text-gray-800 font-medium">{{ $barang->nama_barang }}</td>
                                <td class="py-3 px-4 text-center">{{ $barang->stok }}</td>
                                <td class="py-3 px-4 text-center">50</td>
                                <td class="py-3 px-4 text-center">
                                    <span
                                        class="px-2 py-1 rounded text-[10px] font-bold bg-red-50 text-red-600 border border-red-100">
                                        Rendah
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr class="bg-white">
                                <td colspan="5" class="py-6 text-center text-gray-400">Tidak ada barang dengan stok rendah.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-4 flex justify-end">
                <a href="{{ route('barang.index') }}"
                    class="px-4 py-2 border border-gray-200 hover:bg-gray-50 text-gray-600 text-xs font-semibold rounded-lg transition-colors">
                    Lihat Semua &rarr;
                </a>
            </div>
        </div>

        <!-- Akses Cepat -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex flex-col">
            <h3 class="text-base font-bold text-gray-800 mb-4">Akses Cepat</h3>
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                <a href="{{ route('barang.index') }}"
                    class="flex flex-col items-center justify-center p-4 border border-gray-100 rounded-xl hover:bg-gray-50 transition-colors">
                    <div class="w-10 h-10 rounded-full bg-gray-50 text-gray-600 flex items-center justify-center mb-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                    <span class="text-xs font-medium text-gray-700">Data Barang</span>
                </a>
                <a href="{{ route('penjualan.index') }}"
                    class="flex flex-col items-center justify-center p-4 border border-gray-100 rounded-xl hover:bg-gray-50 transition-colors">
                    <div class="w-10 h-10 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center mb-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
                            </path>
                        </svg>
                    </div>
                    <span class="text-xs font-medium text-gray-700">Data Penjualan</span>
                </a>
                <a href="{{ route('prediksi.index') }}"
                    class="flex flex-col items-center justify-center p-4 border border-gray-100 rounded-xl hover:bg-gray-50 transition-colors">
                    <div class="w-10 h-10 rounded-full bg-yellow-50 text-yellow-600 flex items-center justify-center mb-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                    </div>
                    <span class="text-[10px] text-center font-medium text-gray-700">Prediksi &<br>Rekomendasi</span>
                </a>
                <a href="{{ route('laporan.index') }}"
                    class="flex flex-col items-center justify-center p-4 border border-gray-100 rounded-xl hover:bg-gray-50 transition-colors">
                    <div class="w-10 h-10 rounded-full bg-gray-50 text-gray-600 flex items-center justify-center mb-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                    </div>
                    <span class="text-xs font-medium text-gray-700">Laporan</span>
                </a>
                <a href="{{ route('fuzzy.index') }}"
                    class="flex flex-col items-center justify-center p-4 border border-gray-100 rounded-xl hover:bg-gray-50 transition-colors">
                    <div class="w-10 h-10 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center mb-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                        </svg>
                    </div>
                    <span class="text-[10px] text-center font-medium text-gray-700">Aturan Fuzzy</span>
                </a>
                <a href="{{ route('pengguna.index') }}"
                    class="flex flex-col items-center justify-center p-4 border border-gray-100 rounded-xl hover:bg-gray-50 transition-colors">
                    <div class="w-10 h-10 rounded-full bg-gray-50 text-gray-600 flex items-center justify-center mb-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                            </path>
                        </svg>
                    </div>
                    <span class="text-xs font-medium text-gray-700">Pengguna</span>
                </a>
                <a href="{{ route('pengaturan.index') }}"
                    class="flex flex-col items-center justify-center p-4 border border-gray-100 rounded-xl hover:bg-gray-50 transition-colors">
                    <div class="w-10 h-10 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center mb-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                            </path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <span class="text-xs font-medium text-gray-700">Pengaturan</span>
                </a>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ctx = document.getElementById('salesChart').getContext('2d');
            const salesChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: {!! json_encode($salesLabels) !!},
                    datasets: [{
                        label: 'Total Penjualan',
                        data: {!! json_encode($salesData) !!},
                        borderColor: '#3b82f6',
                        backgroundColor: 'rgba(59, 130, 246, 0.1)',
                        borderWidth: 2,
                        pointBackgroundColor: '#fff',
                        pointBorderColor: '#3b82f6',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: '#f3f4f6',
                                drawBorder: false
                            },
                            ticks: {
                                stepSize: 200
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });
        });
    </script>
@endsection