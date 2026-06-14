@extends('layouts.app')

@section('title', 'Data Barang - Sistem Sembako')
@section('header', 'Data Barang')

@section('content')

<!-- Form Input Data Barang -->
<div class="bg-white rounded-xl md:rounded-2xl shadow-sm border border-gray-100 p-4 md:p-6 mb-4 md:mb-8 relative">
    <div class="flex items-center mb-4 md:mb-6">
        <div class="w-1 h-5 md:h-6 bg-blue-600 rounded-full mr-2 md:mr-3"></div>
        <h3 class="text-sm md:text-lg font-bold text-gray-800">Form Input Data Barang</h3>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 md:gap-8">
        <div class="lg:col-span-2">
            @php $isEdit = isset($barangEdit); @endphp
            <form action="{{ $isEdit ? route('barang.update', $barangEdit->id_barang) : route('barang.store') }}" method="POST">
                @csrf
                @if($isEdit)
                    @method('PUT')
                @endif
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 md:gap-6 mb-4 md:mb-6">
                    <div>
                        <label for="nama_barang" class="block text-[11px] md:text-xs font-semibold text-gray-700 mb-1.5 md:mb-2">Nama Barang <span class="text-red-500">*</span></label>
                        <input type="text" id="nama_barang" name="nama_barang" value="{{ old('nama_barang', $isEdit ? $barangEdit->nama_barang : '') }}" class="block w-full px-3 md:px-4 py-2.5 md:py-3 border border-gray-200 rounded-lg md:rounded-xl text-gray-700 bg-gray-50 focus:bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors text-xs md:text-sm" required placeholder="Masukkan nama barang">
                    </div>
                    <div>
                        <label for="stok" class="block text-[11px] md:text-xs font-semibold text-gray-700 mb-1.5 md:mb-2">Stok Saat Ini <span class="text-red-500">*</span></label>
                        <input type="number" id="stok" name="stok" value="{{ old('stok', $isEdit ? $barangEdit->stok : 0) }}" min="0" class="block w-full px-3 md:px-4 py-2.5 md:py-3 border border-gray-200 rounded-lg md:rounded-xl text-gray-700 bg-gray-50 focus:bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors text-xs md:text-sm" required placeholder="Masukkan jumlah stok">
                    </div>
                </div>

                <div class="flex flex-wrap gap-2 md:gap-3 mt-3 md:mt-4">
                    <button type="submit" class="px-4 md:px-6 py-2 md:py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-xs md:text-sm font-semibold rounded-lg transition-colors shadow-sm">
                        {{ $isEdit ? 'Ubah' : 'Simpan' }}
                    </button>
                    @if($isEdit)
                        <a href="{{ route('barang.index') }}" class="px-4 md:px-6 py-2 md:py-2.5 bg-gray-500 hover:bg-gray-600 text-white text-xs md:text-sm font-semibold rounded-lg transition-colors shadow-sm">
                            Batal
                        </a>
                    @else
                        <button type="reset" class="px-4 md:px-6 py-2 md:py-2.5 bg-gray-200 hover:bg-gray-300 text-gray-700 text-xs md:text-sm font-semibold rounded-lg transition-colors shadow-sm">
                            Batal
                        </button>
                    @endif
                </div>
            </form>
        </div>

        <!-- Petunjuk Box -->
        <div class="bg-blue-50/50 border border-blue-100 rounded-lg md:rounded-xl p-4 md:p-5">
            <div class="flex items-center mb-2 md:mb-3">
                <div class="w-5 h-5 md:w-6 md:h-6 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center mr-2">
                    <svg class="w-3 h-3 md:w-4 md:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h4 class="font-semibold text-blue-800 text-xs md:text-sm">Petunjuk</h4>
            </div>
            <p class="text-[11px] md:text-xs text-blue-700 leading-relaxed">
                Gunakan form di samping untuk menambahkan data barang baru. Pilih data pada tabel untuk mengubah atau menghapus data barang.
            </p>
        </div>
    </div>
</div>

<!-- Daftar Data Barang -->
<div class="bg-white rounded-xl md:rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="px-4 md:px-6 py-4 md:py-5 border-b border-gray-100 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
        <h3 class="text-sm md:text-base font-bold text-gray-800">Daftar Data Barang</h3>
        <form action="{{ route('barang.index') }}" method="GET" class="flex items-center gap-2 md:gap-3">
            <div class="relative flex-1 sm:flex-none">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama barang..." class="block w-full sm:w-auto pl-8 md:pl-10 pr-3 md:pr-4 py-1.5 md:py-2 border border-gray-200 rounded-lg text-xs md:text-sm bg-gray-50 focus:bg-white focus:ring-2 focus:ring-blue-500">
                <div class="absolute inset-y-0 left-0 pl-2.5 md:pl-3 flex items-center pointer-events-none">
                    <svg class="h-3.5 w-3.5 md:h-4 md:w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
            </div>
            <button type="submit" class="hidden"></button>
        </form>
    </div>
    <div class="p-0 overflow-x-auto">
        @if($barangs->count() == 0)
            <p class="text-gray-500 text-center py-8 md:py-10 text-xs md:text-sm">Belum ada data barang.</p>
        @else
            <table class="w-full text-left text-xs md:text-sm min-w-[450px]">
                <thead>
                    <tr class="bg-gray-50/50 text-gray-500 font-medium border-b border-gray-100 text-[10px] md:text-xs uppercase tracking-wider">
                        <th class="py-3 md:py-4 px-3 md:px-6">No</th>
                        <th class="py-3 md:py-4 px-3 md:px-6">Nama Barang</th>
                        <th class="py-3 md:py-4 px-3 md:px-6 text-center">Stok Saat Ini</th>
                        <th class="py-3 md:py-4 px-3 md:px-6 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach($barangs as $index => $barang)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="py-3 md:py-4 px-3 md:px-6 text-gray-500">{{ $barangs->firstItem() + $index }}</td>
                        <td class="py-3 md:py-4 px-3 md:px-6 text-gray-800 font-medium">{{ $barang->nama_barang }}</td>
                        <td class="py-3 md:py-4 px-3 md:px-6 text-center font-medium">{{ $barang->stok }}</td>
                        <td class="py-3 md:py-4 px-3 md:px-6 text-center">
                            <div class="flex items-center justify-center gap-1.5 md:gap-2">
                                <a href="{{ route('barang.index', ['edit' => $barang->id_barang]) }}" class="inline-flex items-center justify-center w-7 h-7 md:w-8 md:h-8 bg-blue-100 hover:bg-blue-200 text-blue-600 rounded transition-colors">
                                    <svg class="w-3.5 h-3.5 md:w-4 md:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                </a>
                                <form action="{{ route('barang.destroy', $barang->id_barang) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus barang ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center justify-center w-7 h-7 md:w-8 md:h-8 bg-red-100 hover:bg-red-200 text-red-600 rounded transition-colors">
                                        <svg class="w-3.5 h-3.5 md:w-4 md:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
            </table>
            <div class="px-6 py-4 border-t border-gray-100 flex items-center justify-between text-xs text-gray-500">
                <div>Menampilkan {{ $barangs->firstItem() }} - {{ $barangs->lastItem() }} dari {{ $barangs->total() }} data</div>
                <div class="flex gap-1">
                    @if ($barangs->onFirstPage())
                        <span class="px-3 py-1.5 border border-gray-200 rounded text-gray-400 bg-gray-50 cursor-not-allowed">&lt; Sebelumnya</span>
                    @else
                        <a href="{{ $barangs->previousPageUrl() }}" class="px-3 py-1.5 border border-gray-200 rounded text-gray-600 hover:bg-gray-50">&lt; Sebelumnya</a>
                    @endif
                    
                    @foreach ($barangs->getUrlRange(1, $barangs->lastPage()) as $page => $url)
                        @if ($page == $barangs->currentPage())
                            <span class="px-3 py-1.5 border border-blue-600 bg-blue-600 text-white rounded font-medium">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="px-3 py-1.5 border border-gray-200 rounded text-gray-600 hover:bg-gray-50">{{ $page }}</a>
                        @endif
                    @endforeach

                    @if ($barangs->hasMorePages())
                        <a href="{{ $barangs->nextPageUrl() }}" class="px-3 py-1.5 border border-gray-200 rounded text-gray-600 hover:bg-gray-50">Berikutnya &gt;</a>
                    @else
                        <span class="px-3 py-1.5 border border-gray-200 rounded text-gray-400 bg-gray-50 cursor-not-allowed">Berikutnya &gt;</span>
                    @endif
                </div>
            </div>
        @endif
    </div>
</div>

@endsection
