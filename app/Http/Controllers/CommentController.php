<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\komentar;
use App\Models\aspirasi;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, $aspirasiId)
    {
        $request->validate([
            'komentar' => 'required|string|max:1000',
        ]);

        $aspirasi = aspirasi::findOrFail($aspirasiId);

        // Optional: Check if user is allowed to comment (e.g., only own aspirasi or logic?)
        // For now, allow any auth user (student) to comment? 
        // Usually students can comment on their own or generic open discussions. 
        // Let's assume open for authorized users.

        komentar::create([
            'aspirasi_id' => $aspirasi->id,
            'user_id' => Auth::id(),
            'komentar' => $request->komentar,
        ]);

        return back()->with('success', 'Komentar berhasil ditambahkan.');
    }
}
