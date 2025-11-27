<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ArticleApproval extends Model
{
    protected $table = 'article_approvals';
    protected $primaryKey = 'id_approval';

    protected $fillable = [
        'id_artikel',
        'id_user',
        'id_admin',
        'status',
        'alasan_penolakan',
        'tanggal_submit',
        'tanggal_review'
    ];

    protected $casts = [
        'tanggal_submit' => 'datetime',
        'tanggal_review' => 'datetime',
    ];

    public function artikel(): BelongsTo
    {
        return $this->belongsTo(Artikel::class, 'id_artikel', 'id_artikel');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function admin(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_admin', 'id_user');
    }
}