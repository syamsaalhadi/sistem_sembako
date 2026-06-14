<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak Laporan - {{ date('F', mktime(0, 0, 0, $bulan, 10)) }} {{ $tahun }}</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; color: #333; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #333; padding-bottom: 10px; }
        .header h1 { margin: 0; font-size: 18px; }
        .header p { margin: 5px 0 0 0; color: #666; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 30px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f5f5f5; font-weight: bold; }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .font-bold { font-weight: bold; }
    </style>
</head>
<body onload="window.print()">
    <div class="header">
        <h1>SISTEM PREDIKSI & REKOMENDASI STOK SEMBAKO</h1>
        <p>Laporan Bulanan: {{ date('F', mktime(0, 0, 0, $bulan, 10)) }} {{ $tahun }}</p>
    </div>

    <h3>A. Rekapitulasi Penjualan</h3>
    @if($penjualans->count() == 0)
        <p>Tidak ada data penjualan pada periode ini.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th class="text-center" width="5%">No</th>
                    <th width="20%">Tanggal</th>
                    <th>Nama Barang</th>
                    <th class="text-center" width="20%">Jumlah Terjual</th>
                </tr>
            </thead>
            <tbody>
                @foreach($penjualans as $index => $p)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ \Carbon\Carbon::parse($p->tanggal)->format('d/m/Y') }}</td>
                    <td>{{ $p->barang->nama_barang }}</td>
                    <td class="text-center">{{ $p->jumlah }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" class="text-right font-bold">Total Terjual Keseluruhan:</td>
                    <td class="text-center font-bold">{{ $penjualans->sum('jumlah') }}</td>
                </tr>
            </tfoot>
        </table>
    @endif

    <h3>B. Hasil Prediksi & Rekomendasi</h3>
    @if($prediksis->count() == 0)
        <p>Tidak ada data prediksi pada periode ini.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th class="text-center" width="5%">No</th>
                    <th>Nama Barang</th>
                    <th class="text-center" width="30%">Rekomendasi Tambah Stok</th>
                </tr>
            </thead>
            <tbody>
                @foreach($prediksis as $index => $p)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $p->barang->nama_barang }}</td>
                    <td class="text-center">{{ $p->hasil_prediksi }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <div style="margin-top: 50px; text-align: right;">
        <p>Dicetak pada: {{ date('d/m/Y H:i') }}</p>
    </div>
</body>
</html>
