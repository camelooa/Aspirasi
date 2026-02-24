<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Carbon\Carbon;

class OtpController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Show OTP Form
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        return view('auth.otp'); // ← pastikan file: resources/views/auth/otp.blade.php
    }


    /*
    |--------------------------------------------------------------------------
    | Verify OTP
    |--------------------------------------------------------------------------
    */
    public function verify(Request $request)
    {
        $request->validate([
            'otp' => ['required', 'digits:6'],
        ]);

        $userId = session('otp_user_id');

        if (!$userId) {
            return redirect()->route('login')->with('error', 'Session expired');
        }

        $user = User::find($userId);

        if (!$user) {
            return redirect()->route('login');
        }

        // cek OTP
        if (
            $user->otp_code != $request->otp ||
            Carbon::now()->gt($user->otp_expires_at)
        ) {
            return back()->with('error', 'OTP salah atau kadaluarsa');
        }

        // login user
        Auth::login($user);

        // hapus session otp
        session()->forget('otp_user_id');

        // redirect sesuai role
        return match ($user->roles) {
            'admin', 'super_admin' => redirect()->route('admin.dashboard'),
            'siswa'               => redirect()->route('siswa.dashboard'),
            default               => redirect()->route('login'),
        };
    }
}
