<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use Illuminate\Http\Request;

class UserArtikelController extends Controller
{
    public function index()
    {
        $artikels = Artikel::where('id_user', auth()->user()->id_user)
            ->with(['kategori', 'approval'])
            ->withCount('likes')
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('artikel.index', compact('artikels'));
    }
}