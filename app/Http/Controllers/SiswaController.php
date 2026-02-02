<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\aspirasi as AspirasiModel;

class SiswaController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $totalAspirasi = $user->aspirasis()->count();
        $aspirasiComplete = $user->aspirasis()->where('status', 'complete')->count();
        $aspirasiPending = $user->aspirasis()->where('status', 'on_progress')->count();
        
        $latestAspirasi = $user->aspirasis()
            ->with(['kategori', 'komentars'])
            ->latest()
            ->take(3)
            ->get();

        return view('siswa.dashboardsiswa', [
            'user' => $user,
            'totalAspirasi' => $totalAspirasi,
            'aspirasiComplete' => $aspirasiComplete,
            'aspirasiPending' => $aspirasiPending,
            'latestAspirasi' => $latestAspirasi,
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

        return redirect()->route('siswa.aspirasisaya')->with('success', 'Aspirasi berhasil dikirim');
    }

    // show aspirasi from other users
    public function aspirasioranglain()
    {
        // fetch all aspirasi except current user's
        $aspirasis = AspirasiModel::where('user_id', '!=', auth()->user()->id)
            ->latest()
            ->get();

        return view('siswa.pageaspirasioranglain', [
            'aspirasis' => $aspirasis,
            'user' => Auth::user()
        ]);
    }

    // show aspirasi detail with comments
    public function showAspirasi($id)
    {
        $aspirasi = AspirasiModel::with(['user', 'kategori', 'komentars.user'])->findOrFail($id);

        return view('siswa.detail-aspirasi', [
            'aspirasi' => $aspirasi,
            'user' => Auth::user()
        ]);
    }
}
