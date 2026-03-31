<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\aspirasi as AspirasiModel;
use App\Models\User;
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

        // Send email notification to admins (and category email if set)
        $category = Kategori::find($data['category_id']);
        $categoryEmail = $category?->email;

        $adminEmails = User::query()
            ->whereIn('roles', ['admin', 'super_admin'])
            ->whereNotNull('email')
            ->pluck('email')
            ->filter()
            ->unique()
            ->values()
            ->all();

        $to = $categoryEmail;
        $bcc = $adminEmails;

        if (!$to && count($bcc) > 0) {
            $to = array_shift($bcc);
        }

        if ($to) {
            try {
                Mail::to($to)->bcc($bcc)->send(new AspirasiCreatedMail($asp));
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
