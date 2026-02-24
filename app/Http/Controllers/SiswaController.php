<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\aspirasi as AspirasiModel;
use App\Mail\AspirasiCreatedMail;

class SiswaController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $totalAspirasi = $user->aspirasis()->count();
        $aspirasiComplete = $user->aspirasis()->where('status', 'complete')->count();
        $aspirasiPending = $user->aspirasis()->where('status', 'on_progress')->count();
        
        $latestAspirasi = $user->aspirasis()
            ->with(['kategori'])
            ->latest()
            ->take(3)
            ->get();

        $popularKategoris = Kategori::withCount('aspirasis')
            ->orderBy('aspirasis_count', 'desc')
            ->take(4)
            ->get();

        return view('siswa.dashboardsiswa', [
            'user' => $user,
            'totalAspirasi' => $totalAspirasi,
            'aspirasiComplete' => $aspirasiComplete,
            'aspirasiPending' => $aspirasiPending,
            'latestAspirasi' => $latestAspirasi,
            'popularKategoris' => $popularKategoris,
        ]);
    }

    // show aspirasi history for authenticated siswa
    public function aspirasisaya()
    {
        $aspirasis = Auth::user() ? Auth::user()->aspirasis()->latest()->get() : collect();

        return view('siswa.aspirasisaya', [
            'aspirasis' => $aspirasis,
            'user' => Auth::user()
        ]);
    }

    // show create aspirasi form
    public function buataspirasi()
    {
        $kategoris = Kategori::all();
        return view('siswa.buataspirasi', [
            'kategoris' => $kategoris,
        ]);
    }

    // store aspirasi
    public function storeAspirasi(Request $request)
    {
        $data = $request->validate([
            'category_id' => ['required', 'exists:kategoris,id'],
            'feedback_title' => ['required', 'string', 'max:255'],
            'details' => ['required', 'string'],
            'image' => ['nullable', 'image', 'max:2048'],
        ]);

        $asp = new AspirasiModel();
        $asp->user_id = Auth::id();
        $asp->category_id = $data['category_id'];
        $asp->feedback_title = $data['feedback_title'];
        $asp->details = $data['details'];
        $asp->location = '-'; // Default value as field is removed from form but required in DB
        $asp->status = 'on_progress';

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('aspirasis', 'public');
            $asp->image = $path;
        }

        $asp->save();

        // Send email notification to category email
        $category = Kategori::find($data['category_id']);
        
        $recipient = $category->email;

        if ($recipient) {
            try {
                Mail::to($recipient)->send(new AspirasiCreatedMail($asp));
            } catch (\Exception $e) {
                // Log error but don't fail the aspiration creation
                \Log::error('Failed to send aspiration email: ' . $e->getMessage());
            }
        }

        return redirect()->route('siswa.aspirasisaya')->with('success', 'Aspirasi berhasil dikirim');
    }


    public function showAspirasi($id)
    {
        $aspirasi = AspirasiModel::where('user_id', Auth::id())
            ->with(['user', 'kategori', 'admin'])
            ->findOrFail($id);

        return view('siswa.detail-aspirasi', [
            'aspirasi' => $aspirasi,
            'user' => Auth::user()
        ]);
    }
}
