<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak Prediksi & Rekomendasi Stok</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; color: #333; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #333; padding-bottom: 10px; }
        .header h1 { margin: 0 0 5px 0; font-size: 18px; }
        .header p { margin: 0; color: #666; }
        table { w-full: 100%; width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f8fafc; font-weight: bold; }
        .text-center { text-align: center; }
        .footer { margin-top: 30px; text-align: right; font-size: 11px; color: #666; }
        @media print {
            .no-print { display: none; }
        }
    </style>
</head>
<body onload="window.print()">

    <div class="no-print" style="margin-bottom: 20px;">
        <button onclick="window.print()" style="padding: 8px 16px; background: #2563eb; color: white; border: none; border-radius: 4px; cursor: pointer;">Cetak Sekarang</button>
        <button onclick="window.close()" style="padding: 8px 16px; background: #e5e7eb; color: #374151; border: none; border-radius: 4px; cursor: pointer; margin-left: 8px;">Tutup</button>
    </div>

    <div class="header">
        <h1>Laporan Prediksi & Rekomendasi Stok Barang</h1>
        <p>Sistem Sembako (Fuzzy Tsukamoto)</p>
        <p>Tanggal Cetak: {{ \Carbon\Carbon::now()->translatedFormat('d F Y H:i:s') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th>Nama Barang</th>
                <th class="text-center">Periode Prediksi</th>
                <th class="text-center">Stok Saat Ini (Unit)</th>
                <th class="text-center">Rekomendasi Stok (Unit)</th>
                <th class="text-center">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($prediksis as $index => $p)
                @php
                    $status = 'Stok Cukup';
                    if($p->barang->stok < $p->hasil_prediksi) {
                        $status = 'Tambah Stok';
                    } elseif($p->barang->stok > ($p->hasil_prediksi * 1.5)) {
                        $status = 'Kurangi Stok';
                    }
                @endphp
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $p->barang->nama_barang }}</td>
                    <td class="text-center">{{ $p->periode }}</td>
                    <td class="text-center">{{ $p->barang->stok }}</td>
                    <td class="text-center"><strong>{{ $p->hasil_prediksi }}</strong></td>
                    <td class="text-center">{{ $status }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Belum ada data prediksi.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>Dicetak oleh: {{ Auth::user()->username ?? 'Administrator' }}</p>
    </div>

</body>
</html>
