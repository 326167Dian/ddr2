<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramKerja extends Model
{
    use HasFactory;

    protected $table = 'program_kerjas';

    protected $fillable = [
        'bidang_id',
        'nama_program',
        'slug',
        'deskripsi',
        'tujuan',
        'periode',
        'status',
        'created_by',
    ];

    public function bidang()
    {
        return $this->belongsTo(Bidang::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function kegiatans()
    {
        return $this->hasMany(Kegiatan::class);
    }
}
