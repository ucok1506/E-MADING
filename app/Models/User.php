<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory;

    protected $table = 'users';
    protected $primaryKey = 'id_user';

    protected $fillable = [
        'nama',
        'username',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    public function artikel()
    {
        return $this->hasMany(Artikel::class, 'id_user');
    }

    public function likes()
    {
        return $this->hasMany(Like::class, 'id_user');
    }

    public function articleApprovals()
    {
        return $this->hasMany(ArticleApproval::class, 'id_user', 'id_user');
    }

    public function logAktivitas()
    {
        return $this->hasMany(LogAktivitas::class, 'id_user');
    }
    
}