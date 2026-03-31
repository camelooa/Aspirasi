@extends('layout.admin')

@section('content')
<div class="px-4 md:px-8 py-8">
    <div class="max-w-3xl mx-auto space-y-6">
        <section class="card p-6 md:p-8 shadow-sm relative overflow-hidden">
            <div class="absolute inset-0 pointer-events-none" style="background: radial-gradient(circle at 20% 18%, rgba(229,164,17,0.10), transparent 45%), radial-gradient(circle at 85% 35%, rgba(29,109,181,0.10), transparent 55%);"></div>
            <div class="relative flex items-start gap-4">
                <a href="{{ route('admin.users.index') }}" class="btn-soft p-3 rounded-2xl" aria-label="Kembali">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                </a>
                <div class="min-w-0">
                    <p class="text-[10px] font-black uppercase tracking-[0.22em] text-gray-400">Users · Create</p>
                    <h2 class="font-display text-2xl md:text-3xl font-extrabold tracking-tight text-gray-900 mt-2">Tambah Akun</h2>
                    <p class="text-sm text-gray-600 mt-2">Buat akun baru untuk admin atau siswa.</p>
                </div>
            </div>
        </section>

        <section class="card overflow-hidden shadow-sm">
            <form action="{{ route('admin.users.store') }}" method="POST" class="p-6 md:p-8 space-y-5">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-[11px] font-black uppercase tracking-[0.18em] text-gray-400 mb-2">Nama Lengkap</label>
                        <input type="text" name="full_name" value="{{ old('full_name') }}" required class="fi w-full px-4 py-3 text-[13.5px] text-gray-900 font-semibold">
                        @error('full_name') <p class="text-red-600 text-[12px] font-semibold mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-[11px] font-black uppercase tracking-[0.18em] text-gray-400 mb-2">Username</label>
                        <input type="text" name="username" value="{{ old('username') }}" required class="fi w-full px-4 py-3 text-[13.5px] text-gray-900 font-semibold">
                        @error('username') <p class="text-red-600 text-[12px] font-semibold mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div>
                    <label class="block text-[11px] font-black uppercase tracking-[0.18em] text-gray-400 mb-2">Role</label>
                    <select name="roles" required class="fi w-full px-4 py-3 text-[13.5px] text-gray-900 font-semibold">
                        <option value="siswa">Siswa</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-[11px] font-black uppercase tracking-[0.18em] text-gray-400 mb-2">Password</label>
                        <input type="password" name="password" required class="fi w-full px-4 py-3 text-[13.5px] text-gray-900 font-semibold">
                        @error('password') <p class="text-red-600 text-[12px] font-semibold mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-[11px] font-black uppercase tracking-[0.18em] text-gray-400 mb-2">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" required class="fi w-full px-4 py-3 text-[13.5px] text-gray-900 font-semibold">
                    </div>
                </div>

                <div class="pt-1 flex items-center gap-2">
                    <button type="submit" class="btn flex-1 py-3.5 rounded-2xl text-white font-extrabold text-sm">Simpan Akun</button>
                    <a href="{{ route('admin.users.index') }}" class="btn-soft px-6 py-3.5 rounded-2xl font-extrabold text-sm">Batal</a>
                </div>
            </form>
        </section>
    </div>
</div>
@endsection
