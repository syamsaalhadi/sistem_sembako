<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Penjualan;
use App\Models\Prediksi;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBarang = Barang::count();
        $totalPenjualan = Penjualan::count();
        $prediksiTerbaru = Prediksi::with('barang')->latest()->take(5)->get();

        // Data Penjualan 6 Bulan Terakhir
        $salesData = [];
        $salesLabels = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = \Carbon\Carbon::now()->subMonths($i);
            $salesLabels[] = $date->translatedFormat('M Y');
            $salesData[] = Penjualan::whereMonth('tanggal', $date->month)
                                    ->whereYear('tanggal', $date->year)
                                    ->sum('jumlah');
        }

        return view('dashboard.index', compact('totalBarang', 'totalPenjualan', 'prediksiTerbaru', 'salesLabels', 'salesData'));
    }
}
