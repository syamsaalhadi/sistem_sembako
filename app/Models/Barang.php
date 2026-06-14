<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'barang';
    protected $primaryKey = 'id_barang';
    
    protected $fillable = [
        'nama_barang',
        'stok',
    ];

    public function penjualan()
    {
        return $this->hasMany(Penjualan::class, 'id_barang', 'id_barang');
    }

    public function prediksi()
    {
        return $this->hasMany(Prediksi::class, 'id_barang', 'id_barang');
    }
}
