<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Artikel extends Model
{
    use HasFactory;

    protected $table = 'artikel';
    protected $primaryKey = 'id_artikel';

    protected $fillable = [
        'judul',
        'isi',
        'tanggal',
        'id_user',
        'id_kategori',
        'foto',
        'status',
    ];

    protected $casts = [
        'tanggal' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }

    public function likes()
    {
        return $this->hasMany(Like::class, 'id_artikel');
    }

    public function likesCount()
    {
        return $this->likes()->count();
    }

    public function isLikedBy($user)
    {
        if (!$user) return false;
        return $this->likes()->where('id_user', $user->id_user)->exists();
    }

    public function approval()
    {
        return $this->hasOne(ArticleApproval::class, 'id_artikel', 'id_artikel');
    }
}