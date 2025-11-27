<?php

namespace App\Http\Controllers;

use App\Models\Mading;
use App\Models\User;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();
        $recent_articles = Mading::where('user_id', $user->id)
                                ->orderBy('created_at', 'desc')
                                ->limit(6)
                                ->get();
        
        return view('guru.dashboard', compact('recent_articles'));
    }
}