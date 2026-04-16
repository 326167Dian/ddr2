<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Institusi extends Model
{
    protected $table = 'institusis';
    protected $primaryKey = 'id_institusi';
    protected $fillable = ['nm_institusi', 'keterangan'];

    public function users()
    {
        return $this->hasMany(\App\Models\User::class, 'institusi_id', 'id_institusi');
    }
}
