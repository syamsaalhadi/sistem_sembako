@extends('layouts.app')

@section('title', 'Input Penjualan - Sistem Sembako')
@section('header', 'Input Transaksi Penjualan')

@section('content')
<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden max-w-2xl mx-auto">
    <div class="px-6 py-5 border-b border-gray-100 bg-gray-50 flex justify-between items-center">
        <h3 class="text-lg font-semibold text-gray-800">Form Penjualan Barang</h3>
        <a href="{{ route('penjualan.index') }}" class="text-sm text-gray-500 hover:text-gray-700">Kembali</a>
    </div>
    
    <div class="p-6">
        @if($barangs->isEmpty())
            <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-4">
                <div class="flex">
                    <div class="ml-3">
                        <p class="text-sm text-yellow-700">
                            Tidak ada barang tersedia. Silakan tambahkan data barang terlebih dahulu.
                        </p>
                    </div>
                </div>
            </div>
        @else
            <form action="{{ route('penjualan.store') }}" method="POST">
                @csrf
                
                <div class="mb-5">
                    <label for="id_barang" class="block text-sm font-medium text-gray-700 mb-1">Pilih Barang</label>
                    <select id="id_barang" name="id_barang" class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm bg-white" required>
                        <option value="">-- Pilih Barang --</option>
                        @foreach($barangs as $barang)
                            <option value="{{ $barang->id_barang }}" {{ old('id_barang') == $barang->id_barang ? 'selected' : '' }}>
                                {{ $barang->nama_barang }} (Stok Tersedia: {{ $barang->stok }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-5">
                    <label for="jumlah" class="block text-sm font-medium text-gray-700 mb-1">Jumlah Terjual</label>
                    <input type="number" id="jumlah" name="jumlah" value="{{ old('jumlah', 1) }}" min="1" class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
                </div>

                <div class="mb-6">
                    <label for="tanggal" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Transaksi</label>
                    <input type="date" id="tanggal" name="tanggal" value="{{ old('tanggal', date('Y-m-d')) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors shadow-sm">
                        Simpan Transaksi
                    </button>
                </div>
            </form>
        @endif
    </div>
</div>
@endsection
