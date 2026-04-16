<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;

    protected $table = 'kegiatans';

    protected $fillable = [
        'program_kerja_id',
        'bidang_id',
        'nama_kegiatan',
        'slug',
        'deskripsi',
        'lokasi',
        'foto',
        'tanggal_mulai',
        'tanggal_selesai',
        'anggaran',
        'status',
        'created_by',
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
    ];

    public function programKerja()
    {
        return $this->belongsTo(ProgramKerja::class);
    }

    public function bidang()
    {
        return $this->belongsTo(Bidang::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
