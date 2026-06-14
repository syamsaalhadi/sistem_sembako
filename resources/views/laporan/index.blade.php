@extends('layouts.app')

@section('title', 'Laporan Bulanan - Sistem Sembako')
@section('header')
<div>
    <h1 class="text-xl font-bold text-gray-800">Laporan Bulanan</h1>
    <p class="text-xs text-gray-500 font-normal mt-1">Rekapitulasi penjualan dan prediksi</p>
</div>
<div class="text-[11px] text-gray-400 mt-2 md:mt-0 flex items-center">
    <a href="{{ route('dashboard') }}" class="hover:text-blue-500 transition-colors">Dashboard</a>
    <span class="mx-1.5">&rsaquo;</span>
    <span class="text-gray-600 font-medium">Laporan</span>
</div>
@endsection

@section('content')

<!-- Filter Laporan -->
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-6">
    <form action="{{ route('laporan.index') }}" method="GET" class="flex flex-col sm:flex-row gap-4 items-end">
        <div>
            <label for="bulan" class="block text-xs font-semibold text-gray-700 mb-2">Pilih Bulan</label>
            <select name="bulan" id="bulan" class="block w-full sm:w-48 px-4 py-2 border border-gray-200 rounded-lg text-gray-700 bg-gray-50 focus:bg-white focus:ring-2 focus:ring-blue-500 text-sm">
                @for($i=1; $i<=12; $i++)
                    <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}" {{ $bulan == str_pad($i, 2, '0', STR_PAD_LEFT) ? 'selected' : '' }}>
                        {{ date('F', mktime(0, 0, 0, $i, 10)) }}
                    </option>
                @endfor
            </select>
        </div>
        <div>
            <label for="tahun" class="block text-xs font-semibold text-gray-700 mb-2">Pilih Tahun</label>
            <select name="tahun" id="tahun" class="block w-full sm:w-32 px-4 py-2 border border-gray-200 rounded-lg text-gray-700 bg-gray-50 focus:bg-white focus:ring-2 focus:ring-blue-500 text-sm">
                @for($i = date('Y'); $i >= date('Y') - 5; $i--)
                    <option value="{{ $i }}" {{ $tahun == $i ? 'selected' : '' }}>{{ $i }}</option>
                @endfor
            </select>
        </div>
        <div class="flex gap-2 w-full sm:w-auto">
            <button type="submit" class="flex-1 sm:flex-none px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-lg transition-colors shadow-sm flex items-center justify-center">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                Tampilkan
            </button>
            <a href="{{ route('laporan.cetak', ['bulan' => $bulan, 'tahun' => $tahun]) }}" target="_blank" class="flex-1 sm:flex-none px-6 py-2 bg-gray-800 hover:bg-gray-900 text-white text-sm font-semibold rounded-lg transition-colors shadow-sm flex items-center justify-center">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                Cetak
            </a>
        </div>
    </form>
</div>

<!-- Laporan Rekapitulasi -->
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden mb-8">
    <div class="px-6 py-5 border-b border-gray-100">
        <h3 class="text-base font-bold text-gray-800">Rekapitulasi Penjualan ({{ date('F', mktime(0, 0, 0, $bulan, 10)) }} {{ $tahun }})</h3>
    </div>
    <div class="p-0 overflow-x-auto">
        @if($penjualans->count() == 0)
            <p class="text-gray-500 text-center py-10 text-sm">Tidak ada data penjualan pada periode ini.</p>
        @else
            <table class="w-full text-left text-sm">
                <thead>
                    <tr class="bg-gray-50/50 text-gray-600 font-semibold border-b border-gray-100 text-xs uppercase tracking-wider">
                        <th class="py-4 px-6">No</th>
                        <th class="py-4 px-6">Tanggal</th>
                        <th class="py-4 px-6">Nama Barang</th>
                        <th class="py-4 px-6 text-center">Jumlah Terjual</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach($penjualans as $index => $p)
                    <tr class="hover:bg-gray-50">
                        <td class="py-3 px-6 text-gray-500">{{ $index + 1 }}</td>
                        <td class="py-3 px-6 text-gray-800">{{ \Carbon\Carbon::parse($p->tanggal)->format('d/m/Y') }}</td>
                        <td class="py-3 px-6 text-gray-800">{{ $p->barang->nama_barang }}</td>
                        <td class="py-3 px-6 text-center font-medium">{{ $p->jumlah }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="bg-gray-50 font-bold text-gray-800">
                        <td colspan="3" class="py-4 px-6 text-right">Total Terjual Keseluruhan:</td>
                        <td class="py-4 px-6 text-center">{{ $penjualans->sum('jumlah') }}</td>
                    </tr>
                </tfoot>
            </table>
        @endif
    </div>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden mb-6">
    <div class="px-6 py-5 border-b border-gray-100">
        <h3 class="text-base font-bold text-gray-800">Hasil Prediksi ({{ date('F', mktime(0, 0, 0, $bulan, 10)) }} {{ $tahun }})</h3>
    </div>
    <div class="p-0 overflow-x-auto">
        @if($prediksis->count() == 0)
            <p class="text-gray-500 text-center py-10 text-sm">Tidak ada data prediksi pada periode ini.</p>
        @else
            <table class="w-full text-left text-sm">
                <thead>
                    <tr class="bg-gray-50/50 text-gray-600 font-semibold border-b border-gray-100 text-xs uppercase tracking-wider">
                        <th class="py-4 px-6">No</th>
                        <th class="py-4 px-6">Nama Barang</th>
                        <th class="py-4 px-6 text-center">Rekomendasi Tambah Stok</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach($prediksis as $index => $p)
                    <tr class="hover:bg-gray-50">
                        <td class="py-3 px-6 text-gray-500">{{ $index + 1 }}</td>
                        <td class="py-3 px-6 text-gray-800">{{ $p->barang->nama_barang }}</td>
                        <td class="py-3 px-6 text-center font-medium">{{ $p->hasil_prediksi }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>

@endsection
