<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Kategori;
use App\Models\Like;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        // Statistik untuk user
        $stats = [
            'total_articles' => Artikel::where('id_user', $user->id_user)->count(),
            'published_articles' => Artikel::where('id_user', $user->id_user)->where('status', 'publish')->count(),
            'draft_articles' => Artikel::where('id_user', $user->id_user)->where('status', 'draft')->count(),
            'total_likes' => Like::whereHas('artikel', function($q) use ($user) {
                $q->where('id_user', $user->id_user);
            })->count()
        ];
        
        // Artikel terbaru user
        $recent_articles = Artikel::where('id_user', $user->id_user)
            ->with(['kategori'])
            ->withCount('likes')
            ->orderBy('tanggal', 'desc')
            ->limit(5)
            ->get();

        return view('dashboard.index', compact('stats', 'recent_articles'));
    }
}