<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Companysetting extends Model
{
    protected $table = 'companysettings';

    protected $fillable = [
        'logo',
        'nama_organisasi',
        'email',
        'no_tlp',
        'alamat',
        'deskripsi',
    ];
}
