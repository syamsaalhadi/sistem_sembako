@extends('layouts.app')

@section('title', 'Aturan Fuzzy - Sistem Sembako')
@section('header')
<div>
    <h1 class="text-xl font-bold text-gray-800">Aturan Fuzzy Tsukamoto</h1>
    <p class="text-xs text-gray-500 font-normal mt-1">Dokumentasi parameter dan rule base sistem</p>
</div>
<div class="text-[11px] text-gray-400 mt-2 md:mt-0 flex items-center">
    <a href="{{ route('dashboard') }}" class="hover:text-blue-500 transition-colors">Dashboard</a>
    <span class="mx-1.5">&rsaquo;</span>
    <span class="text-gray-600 font-medium">Aturan Fuzzy</span>
</div>
@endsection

@section('content')

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
    <!-- Fungsi Keanggotaan Demand -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
        <div class="flex items-center mb-4">
            <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center text-blue-600 mr-4">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            </div>
            <div>
                <h3 class="text-lg font-bold text-gray-800">Fungsi Keanggotaan: Permintaan (Demand)</h3>
                <p class="text-xs text-gray-500">Variabel input berdasarkan rata-rata jumlah terjual</p>
            </div>
        </div>
        <div class="space-y-4">
            <div class="p-4 border border-gray-100 rounded-xl bg-gray-50/50">
                <div class="flex justify-between items-center mb-2">
                    <span class="font-semibold text-gray-700">Rendah</span>
                    <span class="text-xs font-mono text-gray-500 bg-white px-2 py-1 rounded border border-gray-200">0 - 30</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-1.5">
                    <div class="bg-blue-400 h-1.5 rounded-full" style="width: 30%"></div>
                </div>
            </div>
            <div class="p-4 border border-gray-100 rounded-xl bg-gray-50/50">
                <div class="flex justify-between items-center mb-2">
                    <span class="font-semibold text-gray-700">Sedang</span>
                    <span class="text-xs font-mono text-gray-500 bg-white px-2 py-1 rounded border border-gray-200">15 - 45</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-1.5 flex">
                    <div class="h-1.5" style="width: 15%"></div>
                    <div class="bg-blue-500 h-1.5 rounded-full" style="width: 30%"></div>
                </div>
            </div>
            <div class="p-4 border border-gray-100 rounded-xl bg-gray-50/50">
                <div class="flex justify-between items-center mb-2">
                    <span class="font-semibold text-gray-700">Tinggi</span>
                    <span class="text-xs font-mono text-gray-500 bg-white px-2 py-1 rounded border border-gray-200">30 - 60+</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-1.5 flex">
                    <div class="h-1.5" style="width: 30%"></div>
                    <div class="bg-blue-600 h-1.5 rounded-full" style="width: 70%"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Fungsi Keanggotaan Stok -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
        <div class="flex items-center mb-4">
            <div class="w-10 h-10 rounded-xl bg-green-50 flex items-center justify-center text-green-600 mr-4">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
            </div>
            <div>
                <h3 class="text-lg font-bold text-gray-800">Fungsi Keanggotaan: Persediaan (Stok)</h3>
                <p class="text-xs text-gray-500">Variabel input berdasarkan jumlah stok saat ini</p>
            </div>
        </div>
        <div class="space-y-4">
            <div class="p-4 border border-gray-100 rounded-xl bg-gray-50/50">
                <div class="flex justify-between items-center mb-2">
                    <span class="font-semibold text-gray-700">Rendah</span>
                    <span class="text-xs font-mono text-gray-500 bg-white px-2 py-1 rounded border border-gray-200">0 - 50</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-1.5">
                    <div class="bg-green-400 h-1.5 rounded-full" style="width: 50%"></div>
                </div>
            </div>
            <div class="p-4 border border-gray-100 rounded-xl bg-gray-50/50">
                <div class="flex justify-between items-center mb-2">
                    <span class="font-semibold text-gray-700">Sedang</span>
                    <span class="text-xs font-mono text-gray-500 bg-white px-2 py-1 rounded border border-gray-200">25 - 75</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-1.5 flex">
                    <div class="h-1.5" style="width: 25%"></div>
                    <div class="bg-green-500 h-1.5 rounded-full" style="width: 50%"></div>
                </div>
            </div>
            <div class="p-4 border border-gray-100 rounded-xl bg-gray-50/50">
                <div class="flex justify-between items-center mb-2">
                    <span class="font-semibold text-gray-700">Tinggi</span>
                    <span class="text-xs font-mono text-gray-500 bg-white px-2 py-1 rounded border border-gray-200">50 - 100+</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-1.5 flex">
                    <div class="h-1.5" style="width: 50%"></div>
                    <div class="bg-green-600 h-1.5 rounded-full" style="width: 50%"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Rule Base (Matriks Aturan) -->
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="px-6 py-5 border-b border-gray-100 flex items-center">
        <div class="w-1 h-5 bg-purple-600 rounded-full mr-3"></div>
        <h3 class="text-base font-bold text-gray-800">Rule Base (Matriks Aturan)</h3>
    </div>
    <div class="p-0 overflow-x-auto">
        <table class="w-full text-center text-sm">
            <thead>
                <tr class="bg-gray-50/50 text-gray-600 font-semibold border-b border-gray-100 text-xs">
                    <th class="py-4 px-6 border-r border-gray-100">Rule</th>
                    <th class="py-4 px-6 border-r border-gray-100">IF Permintaan (Demand)</th>
                    <th class="py-4 px-6 border-r border-gray-100">AND Persediaan (Stok)</th>
                    <th class="py-4 px-6">THEN Rekomendasi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="py-3 px-6 text-gray-500 font-medium border-r border-gray-100">R1</td>
                    <td class="py-3 px-6 text-gray-600 border-r border-gray-100">Rendah</td>
                    <td class="py-3 px-6 text-gray-600 border-r border-gray-100">Tinggi</td>
                    <td class="py-3 px-6"><span class="px-3 py-1 bg-red-100 text-red-700 rounded-full text-xs font-semibold">Kurangi Stok</span></td>
                </tr>
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="py-3 px-6 text-gray-500 font-medium border-r border-gray-100">R2</td>
                    <td class="py-3 px-6 text-gray-600 border-r border-gray-100">Rendah</td>
                    <td class="py-3 px-6 text-gray-600 border-r border-gray-100">Sedang</td>
                    <td class="py-3 px-6"><span class="px-3 py-1 bg-red-100 text-red-700 rounded-full text-xs font-semibold">Kurangi Stok</span></td>
                </tr>
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="py-3 px-6 text-gray-500 font-medium border-r border-gray-100">R3</td>
                    <td class="py-3 px-6 text-gray-600 border-r border-gray-100">Sedang</td>
                    <td class="py-3 px-6 text-gray-600 border-r border-gray-100">Sedang</td>
                    <td class="py-3 px-6"><span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-semibold">Pertahankan</span></td>
                </tr>
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="py-3 px-6 text-gray-500 font-medium border-r border-gray-100">R4</td>
                    <td class="py-3 px-6 text-gray-600 border-r border-gray-100">Sedang</td>
                    <td class="py-3 px-6 text-gray-600 border-r border-gray-100">Rendah</td>
                    <td class="py-3 px-6"><span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-semibold">Tambah Stok</span></td>
                </tr>
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="py-3 px-6 text-gray-500 font-medium border-r border-gray-100">R5</td>
                    <td class="py-3 px-6 text-gray-600 border-r border-gray-100">Tinggi</td>
                    <td class="py-3 px-6 text-gray-600 border-r border-gray-100">Rendah</td>
                    <td class="py-3 px-6"><span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-semibold">Tambah Stok</span></td>
                </tr>
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="py-3 px-6 text-gray-500 font-medium border-r border-gray-100">R6</td>
                    <td class="py-3 px-6 text-gray-600 border-r border-gray-100">Tinggi</td>
                    <td class="py-3 px-6 text-gray-600 border-r border-gray-100">Sedang</td>
                    <td class="py-3 px-6"><span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-semibold">Tambah Stok</span></td>
                </tr>
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="py-3 px-6 text-gray-500 font-medium border-r border-gray-100">R7</td>
                    <td class="py-3 px-6 text-gray-600 border-r border-gray-100">Tinggi</td>
                    <td class="py-3 px-6 text-gray-600 border-r border-gray-100">Tinggi</td>
                    <td class="py-3 px-6"><span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-semibold">Pertahankan</span></td>
                </tr>
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="py-3 px-6 text-gray-500 font-medium border-r border-gray-100">R8</td>
                    <td class="py-3 px-6 text-gray-600 border-r border-gray-100">Rendah</td>
                    <td class="py-3 px-6 text-gray-600 border-r border-gray-100">Rendah</td>
                    <td class="py-3 px-6"><span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-semibold">Pertahankan</span></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@endsection
