<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;

class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'alamat',
        'foto',
        'no_tlp',
        'profesi',
        'suku',
        'role',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function canAccessPanel(Panel $panel): bool
    {
        // Hanya role admin yang boleh masuk panel admin
        return in_array($this->role, ['admin', 'ketua', 'wakil_ketua', 'sekretaris', 'bendahara']);
    }

    public function institusi()
    {
        return $this->belongsTo(\App\Models\Institusi::class, 'institusi_id', 'id_institusi');
    }

    public function bidangs()
    {
        return $this->belongsToMany(Bidang::class, 'bidang_users')
            ->withPivot('bidang_role_id')
            ->withTimestamps();
    }

    public function bidangRoles()
    {
        return $this->belongsToMany(BidangRole::class, 'bidang_users', 'user_id', 'bidang_role_id')
            ->withPivot('bidang_id')
            ->withTimestamps();
    }

    public function hasBidangRole($bidangId, string $roleSlug): bool
    {
        return $this->bidangRoles()
            ->where('bidang_users.bidang_id', $bidangId)
            ->where('bidang_roles.slug', $roleSlug)
            ->exists();
    }

    public function createdProgramKerjas()
    {
        return $this->hasMany(ProgramKerja::class, 'created_by');
    }

    public function createdKegiatans()
    {
        return $this->hasMany(Kegiatan::class, 'created_by');
    }
}
