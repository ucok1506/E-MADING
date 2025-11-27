<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Like extends Model
{
    use HasFactory;

    protected $table = 'like';
    protected $primaryKey = 'id_like';

    protected $fillable = [
        'id_artikel',
        'id_user',
    ];

    public function artikel()
    {
        return $this->belongsTo(Artikel::class, 'id_artikel');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}