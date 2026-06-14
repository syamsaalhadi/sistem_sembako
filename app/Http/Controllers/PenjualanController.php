<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penjualan;
use App\Models\Barang;
use Illuminate\Support\Facades\DB;

class PenjualanController extends Controller
{
    public function index(Request $request)
    {
        $query = Penjualan::with('barang')->latest();
        
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->whereHas('barang', function($q) use ($search) {
                $q->where('nama_barang', 'like', '%' . $search . '%');
            });
        }
        
        $penjualans = $query->paginate(5)->withQueryString();
        return view('penjualan.index', compact('penjualans'));
    }

    public function create()
    {
        $barangs = Barang::all();
        return view('penjualan.create', compact('barangs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_barang' => 'required|exists:barang,id_barang',
            'jumlah' => 'required|integer|min:1',
            'tanggal' => 'required|date'
        ]);

        try {
            DB::transaction(function () use ($request) {
                $barang = Barang::findOrFail($request->id_barang);
                
                if ($barang->stok < $request->jumlah) {
                    throw new \Exception('Stok barang tidak mencukupi.');
                }

                Penjualan::create($request->all());

                $barang->stok -= $request->jumlah;
                $barang->save();
            });

            return redirect()->route('penjualan.index')->with('success', 'Transaksi penjualan berhasil disimpan.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $penjualan = Penjualan::findOrFail($id);
        
        DB::transaction(function () use ($penjualan) {
            $barang = Barang::findOrFail($penjualan->id_barang);
            $barang->stok += $penjualan->jumlah;
            $barang->save();

            $penjualan->delete();
        });

        return redirect()->route('penjualan.index')->with('success', 'Transaksi penjualan berhasil dihapus.');
    }
}
