@extends('layouts.app')

@section('title', 'Edit Barang - Sistem Sembako')
@section('header', 'Edit Barang')

@section('content')
<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden max-w-2xl mx-auto">
    <div class="px-6 py-5 border-b border-gray-100 bg-gray-50 flex justify-between items-center">
        <h3 class="text-lg font-semibold text-gray-800">Form Edit Barang</h3>
        <a href="{{ route('barang.index') }}" class="text-sm text-gray-500 hover:text-gray-700">Kembali</a>
    </div>
    
    <div class="p-6">
        <form action="{{ route('barang.update', $barang->id_barang) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-5">
                <label for="nama_barang" class="block text-sm font-medium text-gray-700 mb-1">Nama Barang</label>
                <input type="text" id="nama_barang" name="nama_barang" value="{{ old('nama_barang', $barang->nama_barang) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm" required>
            </div>

            <div class="mb-6">
                <label for="stok" class="block text-sm font-medium text-gray-700 mb-1">Stok</label>
                <input type="number" id="stok" name="stok" value="{{ old('stok', $barang->stok) }}" min="0" class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm" required>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="px-5 py-2.5 bg-yellow-600 hover:bg-yellow-700 text-white text-sm font-medium rounded-lg transition-colors shadow-sm">
                    Update Barang
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
