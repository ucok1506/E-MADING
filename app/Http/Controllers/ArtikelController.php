<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Kategori;
use App\Models\Like;
use App\Models\Notification;
use App\Models\ArticleApproval;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class ArtikelController extends Controller
{
    public function create()
    {
        try {
            $kategori = Kategori::all();
            return view('artikel.create', compact('kategori'));
        } catch (\Exception $e) {
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'judul' => 'required|max:255',
                'isi' => 'required',
                'id_kategori' => 'nullable|exists:kategori,id_kategori',
                'foto' => 'nullable|image|max:2048'
            ]);
            
            // Pastikan ada kategori default
            $kategori = Kategori::first();
            if (!$kategori) {
                $kategori = Kategori::create([
                    'nama_kategori' => 'Umum'
                ]);
            }
            $kategoriId = $request->id_kategori ?? $kategori->id_kategori;

            $data = [
                'judul' => $request->judul,
                'isi' => $request->isi,
                'tanggal' => Carbon::now(),
                'id_user' => auth()->user()->id_user,
                'id_kategori' => $kategoriId,
                'status' => (auth()->user()->role === 'admin' || auth()->user()->role === 'guru') ? 'publish' : 'draft'
            ];

            if ($request->hasFile('foto')) {
                $file = $request->file('foto');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads'), $filename);
                $data['foto'] = $filename;
            }

            $artikel = Artikel::create($data);

            // Create approval record for siswa and guru
            if (auth()->user()->role === 'siswa' || auth()->user()->role === 'guru') {
                ArticleApproval::create([
                    'id_artikel' => $artikel->id_artikel,
                    'id_user' => auth()->user()->id_user,
                    'status' => 'pending',
                    'tanggal_submit' => now()
                ]);

                // Create notification for admin
                $admins = \App\Models\User::where('role', 'admin')->get();
                foreach ($admins as $admin) {
                    Notification::create([
                        'id_user' => $admin->id_user,
                        'title' => 'Artikel Menunggu Persetujuan',
                        'message' => auth()->user()->nama . " mengirim artikel '{$artikel->judul}' untuk disetujui",
                        'is_read' => false
                    ]);
                }
            }

            return redirect()->route('dashboard')->with('success', 'Artikel berhasil dibuat.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Gagal membuat artikel: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $artikel = Artikel::where('id_user', auth()->user()->id_user)->findOrFail($id);
        
        // Cek apakah artikel bisa diedit (draft atau ditolak)
        $approval = ArticleApproval::where('id_artikel', $artikel->id_artikel)->first();
        if ($artikel->status === 'publish' && (!$approval || $approval->status !== 'rejected')) {
            return redirect()->back()->with('error', 'Artikel yang sudah publish tidak bisa diedit.');
        }
        
        $kategori = Kategori::all();
        return view('artikel.edit', compact('artikel', 'kategori'));
    }

    public function update(Request $request, $id)
    {
        $artikel = Artikel::where('id_user', auth()->user()->id_user)->findOrFail($id);
        
        $request->validate([
            'judul' => 'required|max:255',
            'isi' => 'required',
            'id_kategori' => 'required|exists:kategori,id_kategori',
            'foto' => 'nullable|image|max:2048'
        ]);

        $data = [
            'judul' => $request->judul,
            'isi' => $request->isi,
            'id_kategori' => $request->id_kategori,
            'status' => 'draft' // Reset to draft when updated
        ];

        if ($request->hasFile('foto')) {
            if ($artikel->foto && file_exists(public_path('uploads/' . $artikel->foto))) {
                unlink(public_path('uploads/' . $artikel->foto));
            }
            $file = $request->file('foto');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename);
            $data['foto'] = $filename;
        }

        $artikel->update($data);

        // Update or create new approval record
        $approval = ArticleApproval::where('id_artikel', $artikel->id_artikel)->first();
        $wasRejected = $approval && $approval->status === 'rejected';
        
        if ($approval) {
            $approval->update([
                'status' => 'pending',
                'tanggal_submit' => now(),
                'alasan_penolakan' => null,
                'tanggal_review' => null,
                'id_admin' => null
            ]);
        } else {
            ArticleApproval::create([
                'id_artikel' => $artikel->id_artikel,
                'id_user' => auth()->user()->id_user,
                'status' => 'pending',
                'tanggal_submit' => now()
            ]);
        }

        // Notify admin
        $admins = \App\Models\User::where('role', 'admin')->get();
        if ($wasRejected) {
            $message = auth()->user()->nama . " telah mengedit artikel yang ditolak '{$artikel->judul}' dan mengirim ulang untuk review";
            $title = 'Artikel Ditolak Telah Diedit';
        } else {
            $message = auth()->user()->nama . " memperbarui artikel '{$artikel->judul}' untuk direview ulang";
            $title = 'Artikel Diperbarui';
        }
            
        foreach ($admins as $admin) {
            Notification::create([
                'id_user' => $admin->id_user,
                'title' => $title,
                'message' => $message,
                'is_read' => false
            ]);
        }

        return redirect()->route('dashboard')->with('success', 'Artikel berhasil diperbarui dan dikirim untuk review ulang.');
    }

    public function destroy($id)
    {
        // Admin bisa hapus semua artikel, user lain hanya artikel sendiri
        if (auth()->user()->role === 'admin') {
            $artikel = Artikel::findOrFail($id);
        } else {
            $artikel = Artikel::where('id_user', auth()->user()->id_user)->findOrFail($id);
        }
        
        // Delete approval record
        ArticleApproval::where('id_artikel', $artikel->id_artikel)->delete();
        
        // Delete likes
        Like::where('id_artikel', $artikel->id_artikel)->delete();
        
        // Delete photo
        if ($artikel->foto && file_exists(public_path('uploads/' . $artikel->foto))) {
            unlink(public_path('uploads/' . $artikel->foto));
        }
        
        $artikel->delete();

        return back()->with('success', 'Artikel berhasil dihapus.');
    }

    public function like($id)
    {
        if (!auth()->check()) {
            return response()->json(['success' => false, 'message' => 'Login required']);
        }

        $artikel = Artikel::findOrFail($id);
        $userId = auth()->user()->id_user;
        
        $existingLike = Like::where('id_artikel', $id)->where('id_user', $userId)->first();
        
        if ($existingLike) {
            $existingLike->delete();
            $liked = false;
        } else {
            Like::create([
                'id_artikel' => $id,
                'id_user' => $userId
            ]);
            $liked = true;
        }
        
        $likesCount = $artikel->likes()->count();
        
        return response()->json([
            'success' => true,
            'liked' => $liked,
            'likes_count' => $likesCount
        ]);
    }
}