<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BidangUser extends Model
{
    protected $table = 'bidang_users';

    protected $fillable = [
        'user_id',
        'bidang_id',
        'bidang_role_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bidang()
    {
        return $this->belongsTo(Bidang::class);
    }

    public function role()
    {
        return $this->belongsTo(BidangRole::class, 'bidang_role_id');
    }
}
