<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bidang extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'bidang_users')
            ->withPivot('bidang_role_id')
            ->withTimestamps();
    }

    public function programKerjas()
    {
        return $this->hasMany(ProgramKerja::class);
    }

    public function kegiatans()
    {
        return $this->hasMany(Kegiatan::class);
    }
}
