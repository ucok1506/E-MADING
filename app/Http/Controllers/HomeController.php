<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Kategori;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $query = Artikel::where('status', 'publish')
            ->with(['kategori', 'user'])
            ->withCount('likes');

        // Search functionality
        if ($request->filled('q')) {
            $searchTerm = $request->get('q');
            $query->where(function($q) use ($searchTerm) {
                $q->where('judul', 'like', "%{$searchTerm}%")
                  ->orWhere('isi', 'like', "%{$searchTerm}%");
            });
        }

        // Category filter
        if ($request->filled('kategori')) {
            $query->where('id_kategori', $request->get('kategori'));
        }

        // Sorting functionality
        $sort = $request->get('sort', 'terbaru');
        switch ($sort) {
            case 'terlama':
                $query->orderBy('tanggal', 'asc');
                break;
            case 'terpopuler':
                $query->orderBy('likes_count', 'desc');
                break;
            case 'judul_az':
                $query->orderBy('judul', 'asc');
                break;
            case 'judul_za':
                $query->orderBy('judul', 'desc');
                break;
            default: // terbaru
                $query->orderBy('tanggal', 'desc');
        }

        $artikel = $query->paginate(9)->appends($request->query());
        $kategori = Kategori::all();

        return view('home', compact('artikel', 'kategori'));
    }

    public function show($id)
    {
        $artikel = Artikel::with(['kategori', 'user', 'likes'])
            ->withCount('likes')
            ->findOrFail($id);

        $isLiked = false;
        if (auth()->check()) {
            $isLiked = $artikel->isLikedBy(auth()->user());
        }

        return view('artikel.show', compact('artikel', 'isLiked'));
    }

    public function search(Request $request)
    {
        $searchTerm = $request->get('q');
        $kategori = Kategori::all();
        
        $query = Artikel::where('status', 'publish')
            ->with(['kategori', 'user'])
            ->withCount('likes');

        if ($searchTerm) {
            $query->where(function($q) use ($searchTerm) {
                $q->where('judul', 'like', "%{$searchTerm}%")
                  ->orWhere('isi', 'like', "%{$searchTerm}%")
                  ->orWhereHas('user', function($q) use ($searchTerm) {
                      $q->where('nama', 'like', "%{$searchTerm}%");
                  })
                  ->orWhereHas('kategori', function($q) use ($searchTerm) {
                      $q->where('nama_kategori', 'like', "%{$searchTerm}%");
                  });
            });
        }

        // Category filter
        if ($request->filled('kategori')) {
            $query->where('id_kategori', $request->get('kategori'));
        }

        // Sorting
        $sort = $request->get('sort', 'terbaru');
        switch ($sort) {
            case 'terlama':
                $query->orderBy('tanggal', 'asc');
                break;
            case 'terpopuler':
                $query->orderBy('likes_count', 'desc');
                break;
            case 'judul_az':
                $query->orderBy('judul', 'asc');
                break;
            case 'judul_za':
                $query->orderBy('judul', 'desc');
                break;
            default:
                $query->orderBy('tanggal', 'desc');
        }

        $artikel = $query->paginate(9)->appends($request->query());

        return view('search', compact('searchTerm', 'kategori', 'artikel'));
    }

    public function kategori(Request $request, $id)
    {
        $kategori_selected = Kategori::findOrFail($id);
        $kategori = Kategori::all();
        
        $query = Artikel::where('status', 'publish')
            ->where('id_kategori', $id)
            ->with(['kategori', 'user'])
            ->withCount('likes');

        // Search within category
        if ($request->filled('q')) {
            $searchTerm = $request->get('q');
            $query->where(function($q) use ($searchTerm) {
                $q->where('judul', 'like', "%{$searchTerm}%")
                  ->orWhere('isi', 'like', "%{$searchTerm}%");
            });
        }

        // Sorting
        $sort = $request->get('sort', 'terbaru');
        switch ($sort) {
            case 'terlama':
                $query->orderBy('tanggal', 'asc');
                break;
            case 'terpopuler':
                $query->orderBy('likes_count', 'desc');
                break;
            case 'judul_az':
                $query->orderBy('judul', 'asc');
                break;
            case 'judul_za':
                $query->orderBy('judul', 'desc');
                break;
            default:
                $query->orderBy('tanggal', 'desc');
        }

        $artikel = $query->paginate(9)->appends($request->query());

        return view('kategori', compact('kategori_selected', 'kategori', 'artikel'));
    }
}