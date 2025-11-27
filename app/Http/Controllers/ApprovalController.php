<?php

namespace App\Http\Controllers;

use App\Models\ArticleApproval;
use App\Models\Artikel;
use App\Models\Notification;
use Illuminate\Http\Request;

class ApprovalController extends Controller
{
    public function index()
    {
        // Check for draft articles without approval records and create them
        $draftArticles = Artikel::where('status', 'draft')
            ->whereDoesntHave('approval')
            ->get();
            
        foreach ($draftArticles as $artikel) {
            ArticleApproval::create([
                'id_artikel' => $artikel->id_artikel,
                'id_user' => $artikel->id_user,
                'status' => 'pending',
                'tanggal_submit' => $artikel->tanggal ?? now()
            ]);
        }
        
        $approvals = ArticleApproval::with(['artikel', 'user'])
            ->where('status', 'pending')
            ->whereHas('artikel', function($query) {
                $query->where('status', 'draft');
            })
            ->orderBy('tanggal_submit', 'desc')
            ->get();
            
        return view('admin.approvals', compact('approvals'));
    }
    
    public function approve($id)
    {
        try {
            // Cari approval berdasarkan id_artikel
            $approval = ArticleApproval::where('id_artikel', $id)->first();
            if (!$approval) {
                // Jika tidak ada approval, langsung update artikel
                $artikel = Artikel::find($id);
                if (!$artikel) {
                    return response()->json(['success' => false, 'message' => 'Artikel tidak ditemukan'], 404);
                }
                
                $artikel->update(['status' => 'publish']);
                
                return response()->json(['success' => true, 'message' => 'Artikel berhasil disetujui']);
            }
            
            $artikel = $approval->artikel;
            if (!$artikel) {
                return response()->json(['success' => false, 'message' => 'Artikel tidak ditemukan'], 404);
            }
            
            // Update approval
            $approval->update([
                'status' => 'approved',
                'tanggal_review' => now(),
                'id_admin' => auth()->user()->id_user
            ]);
            
            // Update artikel status
            $artikel->update(['status' => 'publish']);
            
            return response()->json(['success' => true, 'message' => 'Artikel berhasil disetujui']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
    
    public function reject(Request $request, $id)
    {
        try {
            $approval = ArticleApproval::where('id_artikel', $id)->first();
            if (!$approval) {
                return response()->json(['success' => false, 'message' => 'Approval tidak ditemukan'], 404);
            }
            
            $artikel = $approval->artikel;
            if (!$artikel) {
                return response()->json(['success' => false, 'message' => 'Artikel tidak ditemukan'], 404);
            }
            
            // Update approval
            $approval->update([
                'status' => 'rejected',
                'tanggal_review' => now(),
                'id_admin' => auth()->user()->id_user,
                'alasan_penolakan' => $request->alasan
            ]);
            
            // Notifikasi ke penulis
            Notification::create([
                'id_user' => $approval->id_user,
                'title' => 'Artikel Ditolak',
                'message' => "Artikel '{$artikel->judul}' ditolak. Alasan: " . $request->alasan,
                'is_read' => false
            ]);
            
            return response()->json(['success' => true, 'message' => 'Artikel berhasil ditolak']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}