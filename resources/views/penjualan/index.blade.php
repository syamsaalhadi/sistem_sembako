@extends('layouts.app')

@section('title', 'Data Penjualan - Sistem Sembako')
@section('header')
    <div>
        <h1 class="text-xl font-bold text-gray-800">Input Penjualan</h1>
        <p class="text-xs text-gray-500 font-normal mt-1">Catat transaksi penjualan barang</p>
    </div>
    <div class="text-[11px] text-gray-400 mt-2 md:mt-0 flex items-center">
        <a href="{{ route('dashboard') }}" class="hover:text-blue-500 transition-colors">Dashboard</a>
        <span class="mx-1.5">&rsaquo;</span>
        <span class="text-gray-600">Data Penjualan</span>
        <span class="mx-1.5">&rsaquo;</span>
        <span class="text-gray-600 font-medium">Input Penjualan</span>
    </div>
@endsection

@section('content')

    <!-- Form Input Penjualan -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 mb-6">
        <div class="px-6 py-4 border-b border-gray-100 flex items-center">
            <div class="w-1 h-5 bg-blue-600 rounded-full mr-3"></div>
            <h3 class="text-sm font-bold text-gray-800">Form Input Penjualan</h3>
        </div>
        <div class="p-6">
            @if(\App\Models\Barang::count() == 0)
                <div class="bg-yellow-50 border border-yellow-200 text-yellow-800 p-4 rounded-xl text-sm mb-4">
                    Harap tambahkan data barang terlebih dahulu sebelum menginput penjualan.
                </div>
            @else
                <form id="form-penjualan" action="{{ route('penjualan.store') }}" method="POST">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                        <!-- Nama Barang -->
                        <div>
                            <label for="id_barang" class="block text-xs font-semibold text-gray-800 mb-2">Nama Barang <span
                                    class="text-red-500">*</span></label>
                            <select id="id_barang" name="id_barang"
                                class="block w-full px-4 py-2.5 border border-gray-200 rounded-lg text-gray-700 bg-gray-50 focus:bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors text-sm"
                                required>
                                <option value="">-- Pilih Barang --</option>
                                @foreach(\App\Models\Barang::all() as $barang)
                                    <option value="{{ $barang->id_barang }}">
                                        {{ $barang->nama_barang }}
                                    </option>
                                @endforeach
                            </select>
                            <div
                                class="mt-2 flex items-center text-[10px] text-blue-600 bg-blue-50/50 p-2 rounded border border-blue-100">
                                <svg class="w-3.5 h-3.5 mr-1.5 flex-shrink-0" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Pilih barang dari daftar yang tersedia
                            </div>
                        </div>

                        <!-- Jumlah Terjual -->
                        <div>
                            <label for="jumlah" class="block text-xs font-semibold text-gray-800 mb-2">Jumlah Terjual <span
                                    class="text-red-500">*</span></label>
                            <div class="relative flex items-center">
                                <input type="number" id="jumlah" name="jumlah" min="1"
                                    class="block w-full px-4 py-2.5 border border-gray-200 rounded-l-lg text-gray-700 bg-gray-50 focus:bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors text-sm"
                                    required placeholder="Masukkan jumlah terjual">
                                <span
                                    class="inline-flex items-center px-4 py-2.5 rounded-r-lg border border-l-0 border-gray-200 bg-gray-50 text-gray-500 text-sm">
                                    Pcs
                                </span>
                            </div>
                            <div
                                class="mt-2 flex items-center text-[10px] text-blue-600 bg-blue-50/50 p-2 rounded border border-blue-100">
                                <svg class="w-3.5 h-3.5 mr-1.5 flex-shrink-0" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Masukkan jumlah barang yang terjual
                            </div>
                        </div>

                        <!-- Tanggal Transaksi -->
                        <div>
                            <label for="tanggal" class="block text-xs font-semibold text-gray-800 mb-2">Tanggal Transaksi <span
                                    class="text-red-500">*</span></label>
                            <div class="relative">
                                <input type="date" id="tanggal" name="tanggal" value="{{ date('Y-m-d') }}"
                                    class="block w-full px-4 py-2.5 border border-gray-200 rounded-lg text-gray-700 bg-gray-50 focus:bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors text-sm"
                                    required>
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                            <div
                                class="mt-2 flex items-center text-[10px] text-blue-600 bg-blue-50/50 p-2 rounded border border-blue-100">
                                <svg class="w-3.5 h-3.5 mr-1.5 flex-shrink-0" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Pilih tanggal transaksi penjualan
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-wrap gap-3">
                        <button type="submit"
                            class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-lg transition-colors shadow-sm flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4">
                                </path>
                            </svg>
                            Simpan
                        </button>
                        <button type="reset"
                            class="px-6 py-2.5 bg-white hover:bg-gray-50 text-gray-700 border border-gray-200 text-sm font-semibold rounded-lg transition-colors flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                                </path>
                            </svg>
                            Reset
                        </button>
                        <button type="submit" name="simpan_baru" value="1"
                            class="px-6 py-2.5 bg-green-600 hover:bg-green-700 text-white text-sm font-semibold rounded-lg transition-colors shadow-sm flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Simpan & Baru
                        </button>
                    </div>
                </form>
            @endif
        </div>
    </div>

    <!-- Daftar Penjualan -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <h3 class="text-base font-bold text-gray-800">Daftar Penjualan</h3>
            <form action="{{ route('penjualan.index') }}" method="GET" class="flex items-center gap-3 w-full sm:w-auto">
                <div class="relative flex-1 sm:flex-none">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama barang..."
                        class="block w-full sm:w-64 pl-10 pr-4 py-2 border border-gray-200 rounded-lg text-sm bg-gray-50 focus:bg-white focus:ring-2 focus:ring-blue-500">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                </div>
                <button type="submit"
                    class="px-4 py-2 bg-white border border-gray-200 hover:bg-gray-50 text-gray-700 text-sm font-semibold rounded-lg transition-colors flex items-center flex-shrink-0">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z">
                        </path>
                    </svg>
                    Filter
                </button>
                <a href="#"
                    class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-lg transition-colors shadow-sm flex items-center flex-shrink-0">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Tambah Penjualan
                </a>
            </form>
        </div>
        <div class="p-0 overflow-x-auto">
            @if($penjualans->count() == 0)
                <p class="text-gray-500 text-center py-10 text-sm">Belum ada data penjualan.</p>
            @else
                <table class="w-full text-center text-sm min-w-[700px]">
                    <thead>
                        <tr class="bg-gray-50/50 text-gray-600 font-semibold border-b border-gray-100 text-xs">
                            <th class="py-4 px-6">No</th>
                            <th class="py-4 px-6">Tanggal Transaksi</th>
                            <th class="py-4 px-6">Nama Barang</th>
                            <th class="py-4 px-6">Jumlah Terjual</th>
                            <th class="py-4 px-6">Satuan</th>
                            <th class="py-4 px-6 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach($penjualans as $index => $penjualan)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="py-3 px-6 text-gray-500">{{ $penjualans->firstItem() + $index }}</td>
                                <td class="py-3 px-6 text-gray-600">
                                    {{ \Carbon\Carbon::parse($penjualan->tanggal)->format('d/m/Y') }}</td>
                                <td class="py-3 px-6 text-gray-800 font-medium">{{ $penjualan->barang->nama_barang }}</td>
                                <td class="py-3 px-6 text-gray-800 font-medium">{{ $penjualan->jumlah }}</td>
                                <td class="py-3 px-6 text-gray-500">Pcs</td>
                                <td class="py-3 px-6 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="#"
                                            class="inline-flex items-center justify-center w-8 h-8 bg-blue-100 hover:bg-blue-200 text-blue-600 rounded transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                                </path>
                                            </svg>
                                        </a>
                                        <form action="{{ route('penjualan.destroy', $penjualan->id_penjualan) }}" method="POST"
                                            class="inline-block"
                                            onsubmit="return confirm('Yakin ingin membatalkan transaksi penjualan ini? (Stok akan dikembalikan)');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="inline-flex items-center justify-center w-8 h-8 bg-red-100 hover:bg-red-200 text-red-600 rounded transition-colors">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                    </path>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="px-6 py-4 border-t border-gray-100 flex items-center justify-between text-xs text-gray-500">
                    <div>Menampilkan {{ $penjualans->firstItem() }} - {{ $penjualans->lastItem() }} dari
                        {{ $penjualans->total() }} data</div>
                    <div class="flex gap-1">
                        @if ($penjualans->onFirstPage())
                            <span
                                class="px-3 py-1.5 border border-gray-200 rounded text-gray-400 bg-gray-50 cursor-not-allowed">&lt;
                                Sebelumnya</span>
                        @else
                            <a href="{{ $penjualans->previousPageUrl() }}"
                                class="px-3 py-1.5 border border-gray-200 rounded text-gray-600 hover:bg-gray-50">&lt;
                                Sebelumnya</a>
                        @endif

                        @foreach ($penjualans->getUrlRange(1, $penjualans->lastPage()) as $page => $url)
                            @if ($page == $penjualans->currentPage())
                                <span
                                    class="px-3 py-1.5 border border-blue-600 bg-blue-600 text-white rounded font-medium">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}"
                                    class="px-3 py-1.5 border border-gray-200 rounded text-gray-600 hover:bg-gray-50">{{ $page }}</a>
                            @endif
                        @endforeach

                        @if ($penjualans->hasMorePages())
                            <a href="{{ $penjualans->nextPageUrl() }}"
                                class="px-3 py-1.5 border border-gray-200 rounded text-gray-600 hover:bg-gray-50">Berikutnya
                                &gt;</a>
                        @else
                            <span
                                class="px-3 py-1.5 border border-gray-200 rounded text-gray-400 bg-gray-50 cursor-not-allowed">Berikutnya
                                &gt;</span>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>

@endsection