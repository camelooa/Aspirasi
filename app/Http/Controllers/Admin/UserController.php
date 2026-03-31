<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'full_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'nis' => ['nullable', 'string', 'max:64', 'unique:users,nis'],
            'kelas' => ['nullable', 'string', 'max:64'],
            'roles' => ['required', Rule::in(['admin', 'siswa', 'super_admin'])],
            'password' => ['required', 'string', 'min:4', 'confirmed'],
        ]);

        User::create([
            'username' => $request->username,
            'full_name' => $request->full_name,
            'email' => $request->email,
            'nis' => $request->nis,
            'kelas' => $request->kelas,
            'roles' => $request->roles,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Akun berhasil ditambahkan.');
    }
}
