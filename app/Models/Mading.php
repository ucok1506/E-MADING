<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mading extends Model
{
    protected $fillable = [
        'title',
        'content',
        'author',
        'image',
        'user_id',
        'category_id',
        'views',
        'is_featured',
        'status',
        'excerpt',
        'attachments',
        'published_at'
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'views' => 'integer',
        'attachments' => 'array',
        'published_at' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function isLikedBy($user)
    {
        if (!$user) return false;
        return $this->likes()->where('user_id', $user->id)->exists();
    }

    public function likesCount()
    {
        return $this->likes()->count();
    }

    public function isPublished()
    {
        return $this->status === 'published';
    }

    public function isDraft()
    {
        return $this->status === 'draft';
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }
}
