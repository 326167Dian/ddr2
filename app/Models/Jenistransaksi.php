<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisTransaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_transaksi',
        'tipe_transaksi',
    ];

    public function jurnalKas()
    {
        return $this->hasMany(JurnalKas::class, 'jenis_transaksi_id');
    }
}
