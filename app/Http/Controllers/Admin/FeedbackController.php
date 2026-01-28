<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\aspirasi;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function index()
    {
        $feedbacks = aspirasi::with('user', 'category')
            ->paginate(10);

        return view('admin.feedback', [
            'feedbacks' => $feedbacks
        ]);
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
