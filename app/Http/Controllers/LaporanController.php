<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penjualan;
use App\Models\Prediksi;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $bulan = $request->input('bulan', date('m'));
        $tahun = $request->input('tahun', date('Y'));
        
        $penjualans = Penjualan::with('barang')
            ->whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->latest()
            ->get();
            
        $periodeStr = $tahun . '-' . str_pad($bulan, 2, '0', STR_PAD_LEFT);
        $prediksis = Prediksi::with('barang')
            ->where('periode', $periodeStr)
            ->latest()
            ->get();

        return view('laporan.index', compact('penjualans', 'prediksis', 'bulan', 'tahun'));
    }

    public function cetak(Request $request)
    {
        $bulan = $request->input('bulan', date('m'));
        $tahun = $request->input('tahun', date('Y'));
        
        $penjualans = Penjualan::with('barang')
            ->whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->latest()
            ->get();
            
        $periodeStr = $tahun . '-' . str_pad($bulan, 2, '0', STR_PAD_LEFT);
        $prediksis = Prediksi::with('barang')
            ->where('periode', $periodeStr)
            ->latest()
            ->get();

        return view('laporan.cetak', compact('penjualans', 'prediksis', 'bulan', 'tahun'));
    }
}
