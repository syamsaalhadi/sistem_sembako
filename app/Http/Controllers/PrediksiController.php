<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Penjualan;
use App\Models\Prediksi;
use App\Services\FuzzyTsukamotoService;

class PrediksiController extends Controller
{
    protected $fuzzyService;

    public function __construct(FuzzyTsukamotoService $fuzzyService)
    {
        $this->fuzzyService = $fuzzyService;
    }

    public function index()
    {
        $barangs = Barang::all();
        $prediksis = Prediksi::with('barang')->latest()->get();

        // Data Prediksi 6 Bulan Terakhir
        $chartData = [];
        $chartLabels = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = \Carbon\Carbon::now()->subMonths($i);
            $chartLabels[] = $date->translatedFormat('M Y');
            // Untuk demo, kita ambil jumlah total hasil_prediksi di bulan tersebut.
            // Karena periode formatnya "YYYY-MM", kita cari by periode
            $periodeStr = $date->format('Y-m');
            $chartData[] = Prediksi::where('periode', $periodeStr)->sum('hasil_prediksi');
        }

        // Distribusi Status Rekomendasi
        $statusCounts = [
            'Tambah Stok' => 0,
            'Stok Cukup' => 0,
            'Kurangi Stok' => 0
        ];

        // Kita bisa ambil prediksi terbaru per barang untuk menentukan statusnya, atau iterasi dari $prediksis
        foreach ($prediksis as $p) {
            if ($p->barang->stok < $p->hasil_prediksi) {
                $statusCounts['Tambah Stok']++;
            } elseif ($p->barang->stok > ($p->hasil_prediksi * 1.5)) {
                $statusCounts['Kurangi Stok']++;
            } else {
                $statusCounts['Stok Cukup']++;
            }
        }

        return view('prediksi.index', compact('barangs', 'prediksis', 'chartLabels', 'chartData', 'statusCounts'));
    }

    public function hitung(Request $request)
    {
        $request->validate([
            'id_barang' => 'required|exists:barang,id_barang',
            'periode' => 'required|string|max:20'
        ]);

        $barang = Barang::findOrFail($request->id_barang);
        
        $penjualans = Penjualan::where('id_barang', $barang->id_barang)->get();
        if ($penjualans->isEmpty()) {
            return back()->with('error', 'Tidak dapat melakukan prediksi, data penjualan historis kosong.');
        }

        $totalTerjual = $penjualans->sum('jumlah');
        $jumlahTransaksi = $penjualans->count();
        $demand = $totalTerjual / $jumlahTransaksi;

        $stok = $barang->stok;
        $hasilPrediksi = $this->fuzzyService->hitung($demand, $stok);

        Prediksi::create([
            'id_barang' => $barang->id_barang,
            'periode' => $request->periode,
            'hasil_prediksi' => $hasilPrediksi
        ]);

        return back()->with('success', "Prediksi berhasil dihitung untuk {$barang->nama_barang}. Hasil Rekomendasi Stok: {$hasilPrediksi}");
    }

    public function cetak()
    {
        $prediksis = Prediksi::with('barang')->latest()->get();
        return view('prediksi.cetak', compact('prediksis'));
    }

    public function export()
    {
        $prediksis = Prediksi::with('barang')->latest()->get();
        
        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=export_prediksi_" . date('Y-m-d_H-i-s') . ".csv",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $columns = ['No', 'Nama Barang', 'Periode Prediksi', 'Stok Saat Ini (Unit)', 'Rekomendasi Stok (Unit)', 'Status'];

        $callback = function() use($prediksis, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            $no = 1;
            foreach ($prediksis as $p) {
                $status = 'Stok Cukup';
                if ($p->barang->stok < $p->hasil_prediksi) {
                    $status = 'Tambah Stok';
                } elseif ($p->barang->stok > ($p->hasil_prediksi * 1.5)) {
                    $status = 'Kurangi Stok';
                }

                $row = [
                    $no++,
                    $p->barang->nama_barang,
                    $p->periode,
                    $p->barang->stok,
                    $p->hasil_prediksi,
                    $status
                ];
                fputcsv($file, $row);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
