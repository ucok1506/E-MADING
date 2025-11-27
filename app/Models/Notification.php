<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Notification extends Model
{
    use HasFactory;

    protected $table = 'notifications';
    protected $primaryKey = 'id_notification';

    protected $fillable = [
        'id_user',
        'title',
        'message',
        'type',
        'is_read'
    ];

    protected $casts = [
        'is_read' => 'boolean'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public static function createForUser($userId, $title, $message, $type = 'info')
    {
        return self::create([
            'id_user' => $userId,
            'title' => $title,
            'message' => $message,
            'type' => $type
        ]);
    }

    public function markAsRead()
    {
        $this->update(['is_read' => true]);
    }
}