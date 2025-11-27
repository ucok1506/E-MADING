<?php

namespace App\Http\Controllers;

use App\Models\Mading;
use App\Models\User;
use App\Models\Notification;
use App\Models\ActivityLog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SiswaController extends Controller
{
    public function dashboard()
    {
        $userId = auth()->id();
        
        $myArticles = Mading::where('user_id', $userId)->count();
        $pendingArticles = Mading::where('user_id', $userId)->where('status', 'pending')->count();
        $publishedArticles = Mading::where('user_id', $userId)->where('status', 'published')->count();
        $totalLikes = Mading::where('user_id', $userId)->withCount('likes')->get()->sum('likes_count');
        
        $articles = Mading::where('user_id', $userId)
            ->withCount('likes')
            ->latest()
            ->take(5)
            ->get();
            
        $notifications = Notification::where('user_id', $userId)
            ->where('is_read', false)
            ->latest()
            ->take(5)
            ->get();

        return view('siswa.dashboard', compact(
            'myArticles',
            'pendingArticles',
            'publishedArticles',
            'totalLikes',
            'articles',
            'notifications'
        ));
    }

    public function articlesIndex()
    {
        $articles = Mading::where('user_id', auth()->id())
            ->withCount('likes')
            ->latest()
            ->paginate(10);

        return view('siswa.articles.index', compact('articles'));
    }

    public function createArticle()
    {
        $categories = Category::all();
        return view('siswa.articles.create', compact('categories'));
    }

    public function storeArticle(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|max:2048'
        ]);

        $data = $request->all();
        $data['user_id'] = auth()->id();
        $data['author'] = auth()->user()->name;
        $data['status'] = 'pending';

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('articles', 'public');
        }

        $article = Mading::create($data);

        // Notify all admins
        $admins = User::where('role', 'admin')->get();
        foreach ($admins as $admin) {
            Notification::createForUser(
                $admin->id,
                'Artikel Baru Menunggu Persetujuan',
                "Siswa {$article->author} mengirim artikel baru: '{$article->title}'",
                'info'
            );
        }

        // Log activity
        ActivityLog::create([
            'user_id' => auth()->id(),
            'description' => "Membuat artikel baru: {$article->title}"
        ]);

        return redirect()->route('siswa.dashboard')->with('success', 'Artikel berhasil dibuat dan menunggu persetujuan admin.');
    }

    public function editArticle($id)
    {
        $article = Mading::where('user_id', auth()->id())->findOrFail($id);
        $categories = Category::all();
        return view('siswa.articles.edit', compact('article', 'categories'));
    }

    public function updateArticle(Request $request, $id)
    {
        $article = Mading::where('user_id', auth()->id())->findOrFail($id);
        
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|max:2048'
        ]);

        $data = $request->all();
        
        if ($request->hasFile('image')) {
            if ($article->image) {
                Storage::disk('public')->delete($article->image);
            }
            $data['image'] = $request->file('image')->store('articles', 'public');
        }

        $article->update($data);

        return redirect()->route('siswa.articles.index')->with('success', 'Artikel berhasil diperbarui.');
    }

    public function destroyArticle($id)
    {
        $article = Mading::where('user_id', auth()->id())->findOrFail($id);
        
        if ($article->image) {
            Storage::disk('public')->delete($article->image);
        }
        
        $article->delete();

        return back()->with('success', 'Artikel berhasil dihapus.');
    }
}