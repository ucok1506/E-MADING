<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }
    
    public function showRegister()
    {
        return view('register');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            $user = Auth::user();
            
            if ($user->role === 'admin') {
                return redirect()->intended(route('admin.dashboard'));
            } elseif ($user->role === 'guru') {
                return redirect()->intended(route('guru.dashboard'));
            } elseif ($user->role === 'siswa') {
                return redirect()->intended(route('siswa.dashboard'));
            }
            
            return redirect()->route('dashboard');
        }

        return back()->withErrors(['username' => 'Username atau password salah.'])->withInput($request->except('password'));
    }
    
    public function register(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|in:siswa,guru'
        ]);

        $user = User::create([
            'nama' => $request->nama,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'role' => $request->role
        ]);

        Auth::login($user);
        
        if ($user->role === 'guru') {
            return redirect()->route('guru.dashboard');
        } else {
            return redirect()->route('siswa.dashboard');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('login');
    }
}