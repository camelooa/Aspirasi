<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\aspirasi;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function index()
    {
        $query = aspirasi::with('user', 'kategori');

        // Search
        if (request('search')) {
            $search = request('search');
            $query->where(function($q) use ($search) {
                $q->where('feedback_title', 'like', "%{$search}%")
                  ->orWhere('details', 'like', "%{$search}%")
                  ->orWhereHas('user', function($subQ) use ($search) {
                      $subQ->where('username', 'like', "%{$search}%")
                           ->orWhere('name', 'like', "%{$search}%");
                  });
            });
        }

        // Filter Status
        if (request('status')) {
            $query->where('status', request('status'));
        }

        $feedbacks = $query->latest()->paginate(10)->withQueryString();

        return view('admin.feedback', [
            'feedbacks' => $feedbacks
        ]);
    }

    public function show($id)
    {
        $feedback = aspirasi::with(['user', 'kategori', 'komentars.user'])->findOrFail($id);
        return view('admin.feedback-detail', compact('feedback'));
    }

    public function reply(Request $request, $id)
    {
        $aspirasi = aspirasi::findOrFail($id);
        
        $request->validate([
            'admin_response' => 'required|string'
        ]);

        $aspirasi->update([
            'admin_response' => $request->admin_response,
            'status' => 'complete' // Optionally mark as complete when replied? Or let them choose. Let's keep status separate but defaulting to complete is common. I'll just update response. 
            // Actually, usually a reply means it's being addressed. Let's just update response.
        ]);

        return back()->with('success', 'Balasan berhasil dikirim.');
    }

    public function updateStatus(Request $request, $id)
    {
        $aspirasi = aspirasi::findOrFail($id);
        
        $request->validate([
            'status' => 'required|in:complete,on_progress'
        ]);

        $aspirasi->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Status updated successfully');
    }
}
