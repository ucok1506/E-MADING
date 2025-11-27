<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Kategori;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard(Request $request)
    {
        $totalArticles = Artikel::count();
        $pendingArticles = Artikel::where('status', 'draft')->count();
        $publishedArticles = Artikel::where('status', 'publish')->count();
        $totalUsers = User::count();
        
        // Article management with search and sorting
        $query = Artikel::with(['user', 'kategori'])->withCount('likes');

        // Search functionality
        if ($request->filled('search')) {
            $searchTerm = $request->get('search');
            $query->where(function($q) use ($searchTerm) {
                $q->where('judul', 'like', "%{$searchTerm}%")
                  ->orWhere('isi', 'like', "%{$searchTerm}%")
                  ->orWhereHas('user', function($q) use ($searchTerm) {
                      $q->where('nama', 'like', "%{$searchTerm}%");
                  });
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->get('status'));
        }

        // Sorting
        $sort = $request->get('sort', 'terbaru');
        switch ($sort) {
            case 'terlama':
                $query->orderBy('tanggal', 'asc');
                break;
            case 'judul_az':
                $query->orderBy('judul', 'asc');
                break;
            case 'judul_za':
                $query->orderBy('judul', 'desc');
                break;
            case 'terpopuler':
                $query->orderBy('likes_count', 'desc');
                break;
            default:
                $query->orderBy('tanggal', 'desc');
        }

        $articles = $query->paginate(10)->appends($request->query());

        return view('admin.dashboard', compact(
            'totalArticles',
            'pendingArticles', 
            'publishedArticles',
            'totalUsers',
            'articles'
        ));
    }

    public function approveArticle($id)
    {
        $article = Mading::findOrFail($id);
        $article->update(['status' => 'published']);
        
        // Create notification for student
        Notification::createForUser(
            $article->user_id,
            'Artikel Disetujui',
            "Artikel '{$article->title}' telah disetujui dan dipublikasikan.",
            'success'
        );
        
        // Log activity
        ActivityLog::create([
            'user_id' => auth()->id(),
            'description' => "Menyetujui artikel: {$article->title}"
        ]);

        return back()->with('success', 'Artikel berhasil disetujui.');
    }

    public function rejectArticle($id)
    {
        $article = Mading::findOrFail($id);
        $article->update(['status' => 'rejected']);
        
        // Create notification for student
        Notification::createForUser(
            $article->user_id,
            'Artikel Ditolak',
            "Artikel '{$article->title}' ditolak. Silakan perbaiki dan kirim ulang.",
            'warning'
        );

        return back()->with('success', 'Artikel berhasil ditolak.');
    }
}