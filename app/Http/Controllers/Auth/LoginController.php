<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    // show login page
    public function index()
    {
        // Clear any stale session data when viewing login page
        if (Auth::check()) {
            Auth::logout();
            Session::flush();
        }
        return view('auth.login');
    }

    // handle login
    public function login(Request $request)
    {
        // Flush any previous session data
        $request->session()->flush();
        
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        // IMPORTANT: explicitly set field
        if (Auth::attempt([
            'username' => $credentials['username'],
            'password' => $credentials['password'],
        ])) {

            // Regenerate session ID after successful login
            $request->session()->regenerate();

            $user = Auth::user();

            // role redirect
            if (in_array($user->roles, ['admin', 'super_admin'])) {
                return redirect()->route('admin.dashboard');
            }
            if ($user->roles === 'siswa') {
                return redirect()->route('siswa.dashboard');
            }
            return redirect()->route('login');
        }

        return back()->withErrors([
            'username' => 'Username atau password salah',
        ])->withInput();
    }

    // logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
