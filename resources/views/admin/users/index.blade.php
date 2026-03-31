@extends('layout.admin')

@section('content')
<div class="px-4 md:px-8 py-8">
    <div class="max-w-7xl mx-auto space-y-6">

        <section class="grid grid-cols-1 lg:grid-cols-12 gap-6">
            <div class="lg:col-span-8">
                <div class="card p-6 md:p-8 shadow-sm relative overflow-hidden">
                    <div class="absolute inset-0 pointer-events-none" style="background: radial-gradient(circle at 20% 18%, rgba(12,34,64,0.08), transparent 45%), radial-gradient(circle at 85% 35%, rgba(29,109,181,0.10), transparent 55%);"></div>
                    <div class="relative">
                        <p class="text-[10px] font-black uppercase tracking-[0.22em] text-gray-400">Admin · Users</p>
                        <h2 class="font-display text-2xl md:text-3xl font-extrabold tracking-tight text-gray-900 mt-2">Manajemen Akun</h2>
                        <p class="text-sm text-gray-600 mt-2 max-w-xl">Buat akun baru dan pantau daftar pengguna yang terdaftar.</p>

                        <div class="mt-5 flex flex-wrap items-center gap-3">
                            <div class="rounded-2xl px-4 py-3" style="background: rgba(12,34,64,0.03); border: 1px solid rgba(12,34,64,0.06);">
                                <p class="text-[10px] font-black uppercase tracking-[0.18em] text-gray-400">Total</p>
                                <p class="font-display text-xl font-extrabold text-gray-900 mt-1">{{ $users->total() }}</p>
                            </div>
                            <div class="rounded-2xl px-4 py-3" style="background: rgba(229,164,17,0.10); border: 1px solid rgba(229,164,17,0.18);">
                                <p class="text-[10px] font-black uppercase tracking-[0.18em] text-gray-400">Halaman</p>
                                <p class="font-display text-xl font-extrabold text-gray-900 mt-1">{{ $users->currentPage() }} / {{ $users->lastPage() }}</p>
                            </div>
                        </div>

                        <div class="mt-6">
                            <a href="{{ route('admin.users.create') }}" class="btn inline-flex items-center gap-2 px-6 py-3 rounded-2xl text-white font-extrabold text-sm shadow-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                Tambah Akun
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-4">
                @if(session('success'))
                    <div class="card p-6 md:p-8 shadow-sm" style="background: rgba(29,109,181,0.06); border: 1px solid rgba(29,109,181,0.16);">
                        <p class="text-[10px] font-black uppercase tracking-[0.22em] text-gray-400">Berhasil</p>
                        <p class="text-sm font-extrabold text-gray-900 mt-2">{{ session('success') }}</p>
                    </div>
                @else
                    <div class="card p-6 md:p-8 shadow-sm h-full">
                        <p class="text-[10px] font-black uppercase tracking-[0.22em] text-gray-400">Tips</p>
                        <h3 class="font-display text-lg font-extrabold tracking-tight text-gray-900 mt-2">Gunakan Username Unik</h3>
                        <p class="text-sm text-gray-600 mt-1">Akun admin dan siswa memakai pola login yang sama, jadi pastikan username tidak duplikat.</p>
                    </div>
                @endif
            </div>
        </section>

        <section class="space-y-3">
            @forelse($users as $u)
                @php
                    $isAdmin = in_array($u->roles, ['admin', 'super_admin'], true);
                    $rolePillStyle = $isAdmin
                        ? 'background: rgba(229,164,17,0.14); color: var(--navy); border: 1px solid rgba(229,164,17,0.25);'
                        : 'background: rgba(29,109,181,0.12); color: var(--accent); border: 1px solid rgba(29,109,181,0.22);';
                @endphp

                <div class="card p-5 md:p-6 shadow-sm">
                    <div class="flex flex-col md:flex-row md:items-center gap-4">
                        <div class="flex items-center gap-3 min-w-0 flex-1">
                            <div class="w-11 h-11 rounded-2xl flex items-center justify-center text-[12px] font-extrabold text-white shrink-0" style="background: linear-gradient(165deg, var(--navy-deep) 0%, var(--navy) 55%, #163D6B 100%);">
                                {{ strtoupper(substr($u->full_name ?? $u->name ?? 'U', 0, 2)) }}
                            </div>

                            <div class="min-w-0">
                                <div class="flex flex-wrap items-center gap-2">
                                    <p class="text-sm font-extrabold text-gray-900 truncate">{{ $u->full_name ?? $u->name }}</p>
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-[11px] font-black uppercase tracking-[0.18em]" style="{{ $rolePillStyle }}">{{ ucfirst($u->roles) }}</span>
                                </div>
                                <div class="mt-2 flex flex-wrap items-center gap-2 text-[11px] font-bold text-gray-500">
                                    <span class="inline-flex items-center gap-2 rounded-full px-3 py-1" style="background: rgba(0,0,0,0.03); border: 1px solid rgba(0,0,0,0.06);">
                                        @{{ $u->username }}
                                    </span>
                                    <span class="inline-flex items-center gap-2 rounded-full px-3 py-1" style="background: rgba(29,109,181,0.08); border: 1px solid rgba(29,109,181,0.16);">
                                        {{ $u->email ?: '-' }}
                                    </span>
                                    <span class="inline-flex items-center gap-2 rounded-full px-3 py-1" style="background: rgba(12,34,64,0.03); border: 1px solid rgba(12,34,64,0.06);">
                                        Terdaftar: {{ $u->created_at ? $u->created_at->format('d M Y') : '-' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="card p-10 text-center text-gray-600 shadow-sm">
                    <p class="font-extrabold text-gray-900">Belum ada user terdaftar.</p>
                    <p class="text-sm text-gray-600 mt-1">Klik “Tambah Akun” untuk membuat akun admin atau siswa.</p>
                </div>
            @endforelse
        </section>

        <section class="flex justify-end">
            <div class="card px-3 py-2 shadow-sm">
                {{ $users->links() }}
            </div>
        </section>
    </div>
</div>
@endsection
