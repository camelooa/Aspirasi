<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\OtpMail;
use App\Models\User;
use Carbon\Carbon;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Show Login Page
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        // ❌ JANGAN flush / logout di sini
        return view('auth.login');
    }


    /*
    |--------------------------------------------------------------------------
    | Handle Login (Step 1: Validate Password + Send OTP)
    |--------------------------------------------------------------------------
    */
    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // cek credentials TANPA login
        if (!Auth::validate($request->only('email', 'password'))) {
            return back()->withErrors([
                'email' => 'Email atau password salah'
            ])->withInput();
        }

        // ambil user
        $user = User::where('email', $request->email)->first();

        // generate OTP
        $otp = rand(100000, 999999);

        $user->otp_code = $otp;
        $user->otp_expires_at = Carbon::now()->addMinutes(5);
        $user->save();

        // kirim email
        Mail::to($user->email)->send(new OtpMail($otp, $user->username));

        // simpan sementara (BELUM LOGIN)
        session(['otp_user_id' => $user->id]);

        // redirect ke halaman otp
        return redirect()->route('otp.form');
    }


    /*
    |--------------------------------------------------------------------------
    | Logout
    |--------------------------------------------------------------------------
    */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
