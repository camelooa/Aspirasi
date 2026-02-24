<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Mail\OtpMail;
use App\Models\User;
use Carbon\Carbon;

class LoginController extends Controller
{
    // tampilkan form
    public function index()
    {
        return view('auth.login');
    }

    // proses login (INI TEMPAT Auth::attempt)
    // proses login (validasi email & password -> kirim OTP)
    public function login(Request $request)
    {
        \Illuminate\Support\Facades\Log::info('Login attempt for: ' . $request->email);

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            \Illuminate\Support\Facades\Log::info('User not found: ' . $request->email);
            return back()->with('error', 'Email atau password salah');
        }

        if (!Hash::check($request->password, $user->password)) {
            \Illuminate\Support\Facades\Log::info('Password mismatch for: ' . $request->email);
            return back()->with('error', 'Email atau password salah');
        }

        if ($user && Hash::check($request->password, $user->password)) {
            \Illuminate\Support\Facades\Log::info('Credentials valid. Generating OTP.');
            // Generate OTP
            $otp = rand(100000, 999999);
            $user->otp = $otp;
            $user->otp_expires_at = Carbon::now()->addMinutes(5);
            $user->save();

            // Send Email
            try {
                \Illuminate\Support\Facades\Log::info('Sending email to: ' . $user->email);
                Mail::to($user->email)->send(new OtpMail($otp, $user->username));
                \Illuminate\Support\Facades\Log::info('Email sent successfully.');
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error('Mail error: ' . $e->getMessage());
                return back()->with('error', 'Gagal mengirim email OTP: ' . $e->getMessage());
            }

            // Store user id in session for verification
            $request->session()->put('auth_otp_user_id', $user->id);
            $request->session()->save(); // Force save
            \Illuminate\Support\Facades\Log::info('Session set. Redirecting to OTP verify.');

            return redirect()->route('otp.verify');
        }

        return back()->with('error', 'Email atau password salah');
    }

    public function verifyOtpIndex()
    {
        if (!session()->has('auth_otp_user_id')) {
            return redirect()->route('login');
        }
        return view('auth.otp');
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|numeric|digits:6',
        ]);

        if (!session()->has('auth_otp_user_id')) {
            return redirect()->route('login');
        }

        $userId = session()->get('auth_otp_user_id');
        $user = User::find($userId);

        if (!$user) {
            return redirect()->route('login')->with('error', 'User tidak ditemukan.');
        }

        if ($user->otp !== $request->otp) {
            return back()->with('error', 'Kode OTP salah.');
        }

        if (Carbon::now()->greaterThan($user->otp_expires_at)) {
            return back()->with('error', 'Kode OTP sudah kadaluarsa. Silakan login ulang.');
        }

        // OTP Valid -> Login User
        Auth::login($user);
        
        // Clear OTP & Session
        $user->otp = null;
        $user->otp_expires_at = null;
        $user->save();
        $request->session()->forget('auth_otp_user_id');
        $request->session()->regenerate();

        // Redirect based on role
        if (in_array($user->roles, ['admin', 'super_admin'])) {
            return redirect()->route('admin.dashboard');
        }
        if ($user->roles === 'siswa') {
            return redirect()->route('siswa.dashboard');
        }

        return redirect('/');
    }

    // logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
