@extends('layouts.app')

@section('title', 'Prediksi & Rekomendasi - Sistem Sembako')
@section('header')
<div>
    <h1 class="text-xl font-bold text-gray-800">Prediksi & Rekomendasi</h1>
    <p class="text-xs text-gray-500 font-normal mt-1">Hasil prediksi penjualan dan rekomendasi stok barang</p>
</div>
@endsection

@section('content')

<!-- Form & Info Row -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
    <!-- Form Prediksi -->
    <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex flex-col justify-center">
        <form action="{{ route('prediksi.hitung') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
                <!-- Periode -->
                <div>
                    <label for="periode" class="block text-xs font-semibold text-gray-700 mb-2">Periode Prediksi</label>
                    <input type="month" id="periode" name="periode" value="{{ date('Y-m') }}" class="block w-full px-4 py-3 border border-gray-200 rounded-xl text-gray-700 bg-gray-50 focus:bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors text-sm" required>
                </div>

                <!-- Barang -->
                <div>
                    <label for="id_barang" class="block text-xs font-semibold text-gray-700 mb-2">Pilih Barang</label>
                    <select id="id_barang" name="id_barang" class="block w-full px-4 py-3 border border-gray-200 rounded-xl text-gray-700 bg-gray-50 focus:bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors text-sm" required>
                        <option value="">-- Pilih Barang --</option>
                        @foreach($barangs as $barang)
                            <option value="{{ $barang->id_barang }}">
                                {{ $barang->nama_barang }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Tombol Proses -->
                <div>
                    <button type="submit" class="w-full px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-xl transition-colors shadow-sm flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                        Proses Prediksi
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Info Card -->
    <div class="bg-blue-50/40 border border-blue-100 rounded-2xl p-6 flex flex-col justify-center">
        <div class="flex items-center mb-3">
            <div class="w-6 h-6 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center mr-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <h4 class="font-semibold text-blue-800 text-sm">Informasi</h4>
        </div>
        <p class="text-xs text-blue-700 leading-relaxed pl-8">
            Prediksi dihitung menggunakan data penjualan historis dengan metode logika fuzzy Tsukamoto.
        </p>
    </div>
</div>

<!-- Summary Cards -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
    <!-- Card 1 -->
    <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 flex items-start gap-4">
        <div class="w-12 h-12 rounded-full bg-blue-50 text-blue-500 flex items-center justify-center flex-shrink-0">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
        </div>
        <div>
            <h3 class="text-[11px] font-semibold text-gray-500 mb-1">Total Prediksi Penjualan</h3>
            <p class="text-2xl font-bold text-gray-900 mb-1">{{ \App\Models\Prediksi::count() }}</p>
            <p class="text-[10px] text-gray-400 mb-2">Total histori prediksi</p>
            <a href="#" class="text-[10px] text-blue-600 font-semibold hover:text-blue-700 flex items-center">
                Lihat Detail <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
            </a>
        </div>
    </div>

    <!-- Card 2 -->
    <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 flex items-start gap-4">
        <div class="w-12 h-12 rounded-full bg-green-50 text-green-500 flex items-center justify-center flex-shrink-0">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
        </div>
        <div>
            <h3 class="text-[11px] font-semibold text-gray-500 mb-1">Rata-rata Prediksi</h3>
            <p class="text-2xl font-bold text-gray-900 mb-1">
                {{ \App\Models\Prediksi::avg('hasil_prediksi') ? number_format(\App\Models\Prediksi::avg('hasil_prediksi'), 0) : '0' }}
            </p>
            <p class="text-[10px] text-gray-400 mb-2">Unit per rekomendasi</p>
            <a href="#" class="text-[10px] text-green-600 font-semibold hover:text-green-700 flex items-center">
                Lihat Detail <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
            </a>
        </div>
    </div>

    <!-- Card 3 -->
    <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 flex items-start gap-4">
        <div class="w-12 h-12 rounded-full bg-yellow-50 text-yellow-500 flex items-center justify-center flex-shrink-0">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
        </div>
        <div>
            <h3 class="text-[11px] font-semibold text-gray-500 mb-1">Total Rekomendasi Stok</h3>
            <p class="text-2xl font-bold text-gray-900 mb-1">{{ \App\Models\Prediksi::sum('hasil_prediksi') }}</p>
            <p class="text-[10px] text-gray-400 mb-2">Total unit yang disarankan</p>
            <a href="#" class="text-[10px] text-yellow-600 font-semibold hover:text-yellow-700 flex items-center">
                Lihat Detail <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
            </a>
        </div>
    </div>

    <!-- Card 4 -->
    <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 flex items-start gap-4">
        <div class="w-12 h-12 rounded-full bg-purple-50 text-purple-500 flex items-center justify-center flex-shrink-0">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
        </div>
        <div>
            <h3 class="text-[11px] font-semibold text-gray-500 mb-1">Barang Diprediksi</h3>
            <p class="text-2xl font-bold text-gray-900 mb-1">{{ \App\Models\Prediksi::distinct('id_barang')->count('id_barang') }}</p>
            <p class="text-[10px] text-gray-400 mb-2">Total jenis barang</p>
            <a href="#" class="text-[10px] text-purple-600 font-semibold hover:text-purple-700 flex items-center">
                Lihat Detail <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
            </a>
        </div>
    </div>
</div>

<!-- Hasil Prediksi Table -->
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden mb-6 flex flex-col">
    <div class="px-6 py-5 border-b border-gray-100">
        <h3 class="text-base font-bold text-gray-800">Hasil Prediksi Penjualan & Rekomendasi Stok</h3>
    </div>
    <div class="flex-1 overflow-x-auto">
        <table class="w-full text-left text-sm min-w-[700px]">
            <thead>
                <tr class="bg-gray-50/50 text-gray-500 font-semibold border-b border-gray-100 text-xs">
                    <th class="py-4 px-6 text-center">No</th>
                    <th class="py-4 px-6">Nama Barang</th>
                    <th class="py-4 px-6 text-center">Periode Prediksi</th>
                    <th class="py-4 px-6 text-center">Stok Saat Ini (Unit)</th>
                    <th class="py-4 px-6 text-center">Rekomendasi Stok (Unit)</th>
                    <th class="py-4 px-6 text-center">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($prediksis as $index => $p)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="py-4 px-6 text-center text-gray-500">{{ $index + 1 }}</td>
                    <td class="py-4 px-6 text-gray-800 font-medium">{{ $p->barang->nama_barang }}</td>
                    <td class="py-4 px-6 text-center text-gray-600">{{ $p->periode }}</td>
                    <td class="py-4 px-6 text-center text-gray-600">{{ $p->barang->stok }}</td>
                    <td class="py-4 px-6 text-center text-gray-800 font-bold bg-blue-50/30">{{ $p->hasil_prediksi }}</td>
                    <td class="py-4 px-6 text-center">
                        @if($p->barang->stok < $p->hasil_prediksi)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-[11px] font-bold bg-green-50 text-green-700 border border-green-100">
                                Tambah Stok
                            </span>
                        @elseif($p->barang->stok > ($p->hasil_prediksi * 1.5))
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-[11px] font-bold bg-yellow-50 text-yellow-700 border border-yellow-100">
                                Kurangi Stok
                            </span>
                        @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-[11px] font-bold bg-blue-50 text-blue-700 border border-blue-100">
                                Stok Cukup
                            </span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="py-10 text-center text-gray-400 text-sm">Belum ada history hasil prediksi penjualan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Charts & Legends -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
    <!-- Line Chart -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
        <h3 class="text-base font-bold text-gray-800 mb-4">Ringkasan Prediksi Penjualan (6 Bulan)</h3>
        <div class="relative h-48">
            <canvas id="prediksiChart"></canvas>
        </div>
        <div class="mt-4 flex justify-center items-center text-xs text-gray-500 gap-2">
            <div class="w-3 h-3 rounded-full bg-blue-500"></div> Total Prediksi Penjualan (Unit)
        </div>
    </div>

    <!-- Pie Chart -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex flex-col items-center">
        <h3 class="text-base font-bold text-gray-800 mb-4 self-start">Distribusi Status Rekomendasi</h3>
        <div class="relative h-40 w-full flex justify-center">
            <canvas id="statusChart"></canvas>
            <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                <span class="text-2xl font-bold text-gray-800">{{ $prediksis->count() }}<br><span class="text-[10px] text-gray-500 font-normal">Barang</span></span>
            </div>
        </div>
        <div class="mt-4 w-full flex flex-col gap-2 text-xs">
            <div class="flex justify-between items-center">
                <div class="flex items-center gap-2 text-gray-600"><div class="w-2.5 h-2.5 rounded-full bg-blue-500"></div> Tambah Stok</div>
                <span class="font-medium text-gray-800">{{ $statusCounts['Tambah Stok'] }}</span>
            </div>
            <div class="flex justify-between items-center">
                <div class="flex items-center gap-2 text-gray-600"><div class="w-2.5 h-2.5 rounded-full bg-green-500"></div> Stok Cukup</div>
                <span class="font-medium text-gray-800">{{ $statusCounts['Stok Cukup'] }}</span>
            </div>
            <div class="flex justify-between items-center">
                <div class="flex items-center gap-2 text-gray-600"><div class="w-2.5 h-2.5 rounded-full bg-yellow-500"></div> Kurangi Stok</div>
                <span class="font-medium text-gray-800">{{ $statusCounts['Kurangi Stok'] }}</span>
            </div>
        </div>
    </div>

    <!-- Keterangan Status & Export -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex flex-col justify-between">
        <div>
            <h3 class="text-base font-bold text-gray-800 mb-4">Keterangan Status</h3>
            <div class="space-y-4">
                <div class="flex items-start gap-3 text-xs">
                    <span class="px-2 py-1 rounded bg-green-50 text-green-700 font-semibold border border-green-100 whitespace-nowrap">Tambah Stok</span>
                    <span class="text-gray-600">Stok saat ini tidak mencukupi rekomendasi, disarankan menambah stok.</span>
                </div>
                <div class="flex items-start gap-3 text-xs">
                    <span class="px-2 py-1 rounded bg-blue-50 text-blue-700 font-semibold border border-blue-100 whitespace-nowrap">Stok Cukup</span>
                    <span class="text-gray-600">Stok saat ini cukup untuk memenuhi kebutuhan rekomendasi.</span>
                </div>
                <div class="flex items-start gap-3 text-xs">
                    <span class="px-2 py-1 rounded bg-yellow-50 text-yellow-700 font-semibold border border-yellow-100 whitespace-nowrap">Kurangi Stok</span>
                    <span class="text-gray-600">Stok saat ini berlebih jauh dari rekomendasi, disarankan mengurangi stok / tidak restock.</span>
                </div>
            </div>
        </div>
        <div class="mt-6 flex flex-col sm:flex-row gap-3">
            <a href="{{ route('prediksi.export') }}" class="flex-1 px-4 py-2.5 bg-white border border-gray-200 hover:bg-gray-50 text-gray-700 text-sm font-semibold rounded-xl transition-colors flex items-center justify-center">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                Export Excel
            </a>
            <a href="{{ route('prediksi.cetak') }}" target="_blank" class="flex-1 px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-xl transition-colors flex items-center justify-center shadow-sm">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                Cetak Laporan
            </a>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Prediksi Chart
        const ctxPrediksi = document.getElementById('prediksiChart').getContext('2d');
        new Chart(ctxPrediksi, {
            type: 'line',
            data: {
                labels: {!! json_encode($chartLabels) !!},
                datasets: [{
                    label: 'Total Prediksi',
                    data: {!! json_encode($chartData) !!},
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
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: '#f3f4f6', drawBorder: false },
                        ticks: { stepSize: 50 }
                    },
                    x: {
                        grid: { display: false }
                    }
                }
            }
        });

        // Status Chart (Doughnut)
        const ctxStatus = document.getElementById('statusChart').getContext('2d');
        new Chart(ctxStatus, {
            type: 'doughnut',
            data: {
                labels: ['Tambah Stok', 'Stok Cukup', 'Kurangi Stok'],
                datasets: [{
                    data: [
                        {{ $statusCounts['Tambah Stok'] }}, 
                        {{ $statusCounts['Stok Cukup'] }}, 
                        {{ $statusCounts['Kurangi Stok'] }}
                    ],
                    backgroundColor: ['#3b82f6', '#22c55e', '#eab308'],
                    borderWidth: 0,
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '75%',
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.label || '';
                                if (label) { label += ': '; }
                                label += context.raw + ' Barang';
                                return label;
                            }
                        }
                    }
                }
            }
        });
    });
</script>

@endsection
