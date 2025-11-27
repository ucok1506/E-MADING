<?php

namespace App\Http\Controllers;

use App\Models\Mading;
use App\Models\Like;
use Illuminate\Http\Request;

class MadingController extends Controller
{
    public function index()
    {
        $articles = Mading::where('status', 'published')
            ->with(['category', 'user'])
            ->withCount('likes')
            ->latest()
            ->paginate(10);

        return view('mading.index', compact('articles'));
    }

    public function show($id)
    {
        $mading = Mading::with(['category', 'user', 'likes'])
            ->withCount('likes')
            ->findOrFail($id);
        
        // Increment view count
        $mading->increment('views');
        
        $isLiked = false;
        if (auth()->check()) {
            $isLiked = $mading->likes()->where('user_id', auth()->id())->exists();
        }

        return view('mading.show', compact('mading', 'isLiked'));
    }

    public function likeById($id)
    {
        if (!auth()->check()) {
            return response()->json(['success' => false, 'message' => 'Login required']);
        }

        $mading = Mading::findOrFail($id);
        $userId = auth()->id();
        
        $existingLike = Like::where('mading_id', $id)->where('user_id', $userId)->first();
        
        if ($existingLike) {
            $existingLike->delete();
            $liked = false;
        } else {
            Like::create([
                'mading_id' => $id,
                'user_id' => $userId
            ]);
            $liked = true;
        }
        
        $likesCount = $mading->likes()->count();
        
        return response()->json([
            'success' => true,
            'liked' => $liked,
            'likes_count' => $likesCount
        ]);
    }

    public function store(Request $request)
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
        $data['status'] = auth()->user()->role === 'admin' ? 'published' : 'pending';

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('articles', 'public');
        }

        Mading::create($data);

        return redirect()->back()->with('success', 'Artikel berhasil dibuat.');
    }
}