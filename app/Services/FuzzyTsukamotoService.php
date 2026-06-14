<?php

namespace App\Services;

class FuzzyTsukamotoService
{
    public function hitung(float $demand, int $stok): float
    {
        // 1. Fuzzifikasi
        $uDemandRendah = $this->demandRendah($demand);
        $uDemandSedang = $this->demandSedang($demand);
        $uDemandTinggi = $this->demandTinggi($demand);

        $uStokRendah = $this->stokRendah($stok);
        $uStokSedang = $this->stokSedang($stok);
        $uStokTinggi = $this->stokTinggi($stok);

        // 2. Inferensi (Rule Base)
        $rules = [];
        
        // R1: IF Demand Rendah AND Stok Tinggi THEN Kurangi
        $alpha1 = min($uDemandRendah, $uStokTinggi);
        $z1 = $this->zKurangi($alpha1);
        $rules[] = ['alpha' => $alpha1, 'z' => $z1];

        // R2: IF Demand Rendah AND Stok Sedang THEN Kurangi
        $alpha2 = min($uDemandRendah, $uStokSedang);
        $z2 = $this->zKurangi($alpha2);
        $rules[] = ['alpha' => $alpha2, 'z' => $z2];

        // R3: IF Demand Sedang AND Stok Sedang THEN Pertahankan
        $alpha3 = min($uDemandSedang, $uStokSedang);
        $z3 = $this->zPertahankan($alpha3);
        $rules[] = ['alpha' => $alpha3, 'z' => $z3];

        // R4: IF Demand Sedang AND Stok Rendah THEN Tambah
        $alpha4 = min($uDemandSedang, $uStokRendah);
        $z4 = $this->zTambah($alpha4);
        $rules[] = ['alpha' => $alpha4, 'z' => $z4];

        // R5: IF Demand Tinggi AND Stok Rendah THEN Tambah
        $alpha5 = min($uDemandTinggi, $uStokRendah);
        $z5 = $this->zTambah($alpha5);
        $rules[] = ['alpha' => $alpha5, 'z' => $z5];

        // R6: IF Demand Tinggi AND Stok Sedang THEN Tambah
        $alpha6 = min($uDemandTinggi, $uStokSedang);
        $z6 = $this->zTambah($alpha6);
        $rules[] = ['alpha' => $alpha6, 'z' => $z6];

        // R7: IF Demand Tinggi AND Stok Tinggi THEN Pertahankan
        $alpha7 = min($uDemandTinggi, $uStokTinggi);
        $z7 = $this->zPertahankan($alpha7);
        $rules[] = ['alpha' => $alpha7, 'z' => $z7];

        // R8: IF Demand Rendah AND Stok Rendah THEN Pertahankan
        $alpha8 = min($uDemandRendah, $uStokRendah);
        $z8 = $this->zPertahankan($alpha8);
        $rules[] = ['alpha' => $alpha8, 'z' => $z8];

        // 3. Defuzzifikasi (Weighted Average)
        $totalAlphaZ = 0;
        $totalAlpha = 0;

        foreach ($rules as $rule) {
            $totalAlphaZ += ($rule['alpha'] * $rule['z']);
            $totalAlpha += $rule['alpha'];
        }

        if ($totalAlpha == 0) {
            return 0; // Hindari pembagian dengan nol
        }

        return round($totalAlphaZ / $totalAlpha, 2);
    }

    // --- Fungsi Keanggotaan Demand (Permintaan) ---
    private function demandRendah($x) {
        if ($x <= 0) return 1;
        if ($x >= 30) return 0;
        return (30 - $x) / 30;
    }

    private function demandSedang($x) {
        if ($x <= 15 || $x >= 45) return 0;
        if ($x > 15 && $x <= 30) return ($x - 15) / 15;
        if ($x > 30 && $x < 45) return (45 - $x) / 15;
        return 0;
    }

    private function demandTinggi($x) {
        if ($x <= 30) return 0;
        if ($x >= 60) return 1;
        return ($x - 30) / 30;
    }

    // --- Fungsi Keanggotaan Stok (Persediaan) ---
    private function stokRendah($y) {
        if ($y <= 0) return 1;
        if ($y >= 50) return 0;
        return (50 - $y) / 50;
    }

    private function stokSedang($y) {
        if ($y <= 25 || $y >= 75) return 0;
        if ($y > 25 && $y <= 50) return ($y - 25) / 25;
        if ($y > 50 && $y < 75) return (75 - $y) / 25;
        return 0;
    }

    private function stokTinggi($y) {
        if ($y <= 50) return 0;
        if ($y >= 100) return 1;
        return ($y - 50) / 50;
    }

    // --- Output Z (Crisp) ---
    private function zKurangi($alpha) {
        return 50 - ($alpha * 50);
    }

    private function zPertahankan($alpha) {
        // Berdasarkan PRD: Pertahankan 25 - 75 (gunakan titik tengah)
        return 50; 
    }

    private function zTambah($alpha) {
        return 50 + ($alpha * 50);
    }
}
