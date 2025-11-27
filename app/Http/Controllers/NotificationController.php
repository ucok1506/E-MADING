<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function getRecent()
    {
        $notifications = Notification::where('id_user', auth()->user()->id_user)
            ->orderBy('tanggal', 'desc')
            ->limit(10)
            ->get();
            
        return response()->json(['notifications' => $notifications]);
    }
    
    public function getUnreadCount()
    {
        $count = Notification::where('id_user', auth()->user()->id_user)
            ->where('is_read', false)
            ->count();
            
        return response()->json(['count' => $count]);
    }
    
    public function markAsRead($id)
    {
        Notification::where('id_notification', $id)
            ->where('id_user', auth()->user()->id_user)
            ->update(['is_read' => true]);
            
        return response()->json(['success' => true]);
    }
    
    public function markAllAsRead()
    {
        Notification::where('id_user', auth()->user()->id_user)
            ->update(['is_read' => true]);
            
        return response()->json(['success' => true]);
    }
}