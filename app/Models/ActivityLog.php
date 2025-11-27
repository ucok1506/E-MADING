<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    protected $fillable = [
        'user_id',
        'description',
        'ip_address',
        'user_agent'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function log($description, $userId = null)
    {
        return self::create([
            'user_id' => $userId ?? auth()->id(),
            'description' => $description,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent()
        ]);
    }
}