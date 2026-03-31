@extends('layout.admin')

@section('content')
@php
    $weeklyTotals = array_map(fn($d) => ($d['complete'] ?? 0) + ($d['on_progress'] ?? 0), $weeklyData);
    $weeklyMax = max(5, ...array_values($weeklyTotals));
    $topCategories = $countsByCategory->sortByDesc('total')->take(8);
@endphp

<div class="px-4 md:px-8 py-8">
    <div class="max-w-7xl mx-auto space-y-6">

        <!-- Header Row -->
        <section class="grid grid-cols-1 lg:grid-cols-12 gap-6">
            <div class="lg:col-span-7">
                <div class="card p-6 md:p-8 shadow-sm relative overflow-hidden">
                    <div class="absolute inset-0 pointer-events-none" style="background: radial-gradient(circle at 20% 15%, rgba(229,164,17,0.08), transparent 45%), radial-gradient(circle at 85% 30%, rgba(29,109,181,0.08), transparent 55%);"></div>
                    <div class="relative">
                        <p class="text-[10px] font-black uppercase tracking-[0.22em] text-gray-400">Dashboard Admin</p>
                        <h2 class="font-display text-2xl md:text-3xl font-extrabold tracking-tight text-gray-900 mt-2">
                            Ringkasan hari ini untuk <span style="color: var(--navy);">{{ auth()->user()->username ?? 'Administrator' }}</span>
                        </h2>
                        <p class="text-sm text-gray-600 mt-2 max-w-xl">Pantau aspirasi, cek performa respon, dan lihat antrian tindakan dalam satu tempat.</p>

                        <div class="mt-5 flex flex-wrap gap-2">
                            <a href="{{ route('admin.feedback') }}" class="btn inline-flex items-center gap-2 px-5 py-3 rounded-2xl text-white font-bold text-sm shadow-sm">
                                Kelola Feedback
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                            </a>
                            <a href="{{ route('admin.users.index') }}" class="btn-soft inline-flex items-center gap-2 px-5 py-3 rounded-2xl font-bold text-sm">
                                Manajemen User
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-4-4h-1m-4 6H2v-2a4 4 0 014-4h4m6-6a4 4 0 11-8 0 4 4 0 018 0zm6 2a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            </a>
                        </div>

                        <div class="mt-6 grid grid-cols-2 sm:grid-cols-4 gap-3">
                            <div class="rounded-2xl p-4" style="background: rgba(12,34,64,0.03); border: 1px solid rgba(12,34,64,0.06);">
                                <p class="text-[10px] font-black uppercase tracking-[0.18em] text-gray-400">Masuk</p>
                                <p class="font-display text-2xl font-extrabold text-gray-900 mt-1">{{ $totalFeedback }}</p>
                            </div>
                            <div class="rounded-2xl p-4" style="background: rgba(29,109,181,0.06); border: 1px solid rgba(29,109,181,0.14);">
                                <p class="text-[10px] font-black uppercase tracking-[0.18em] text-gray-400">Selesai</p>
                                <p class="font-display text-2xl font-extrabold text-gray-900 mt-1">{{ $totalCompleted }}</p>
                            </div>
                            <div class="rounded-2xl p-4" style="background: rgba(229,164,17,0.08); border: 1px solid rgba(229,164,17,0.18);">
                                <p class="text-[10px] font-black uppercase tracking-[0.18em] text-gray-400">Diproses</p>
                                <p class="font-display text-2xl font-extrabold text-gray-900 mt-1">{{ $totalInProgress }}</p>
                            </div>
                            <div class="rounded-2xl p-4" style="background: rgba(12,34,64,0.03); border: 1px solid rgba(12,34,64,0.06);">
                                <p class="text-[10px] font-black uppercase tracking-[0.18em] text-gray-400">Pengguna</p>
                                <p class="font-display text-2xl font-extrabold text-gray-900 mt-1">{{ $totalUsers }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-5">
                <div class="card p-6 md:p-8 shadow-sm h-full">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <p class="text-[10px] font-black uppercase tracking-[0.22em] text-gray-400">Kinerja</p>
                            <h3 class="font-display text-lg font-extrabold tracking-tight text-gray-900 mt-2">Kualitas Respon Admin</h3>
                            <p class="text-sm text-gray-600 mt-1">Ringkasan dari aktivitas pengelolaan aspirasi.</p>
                        </div>

                        <div class="shrink-0">
                            @php
                                $deg = max(0, min(100, $responseRate)) * 3.6;
                            @endphp
                            <div class="relative w-24 h-24 rounded-full" style="background: conic-gradient(var(--accent) {{ $deg }}deg, rgba(0,0,0,0.06) 0);">
                                <div class="absolute inset-[10px] rounded-full bg-white border border-black/[0.06] flex items-center justify-center">
                                    <div class="text-center">
                                        <p class="font-display text-xl font-extrabold text-gray-900 leading-none">{{ $responseRate }}%</p>
                                        <p class="text-[10px] font-black uppercase tracking-[0.18em] text-gray-400 mt-1">Respon</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 space-y-5">
                        <div>
                            <div class="flex items-end justify-between">
                                <p class="text-[11px] font-black uppercase tracking-[0.18em] text-gray-400">Ditinjau</p>
                                <p class="font-display text-lg font-extrabold text-gray-900">{{ $reviewedRate }}%</p>
                            </div>
                            <div class="mt-2 h-2 rounded-full overflow-hidden" style="background: rgba(0,0,0,0.06);">
                                <div class="h-full rounded-full" style="width: {{ $reviewedRate }}%; background: var(--navy);"></div>
                            </div>
                        </div>

                        <div>
                            <div class="flex items-end justify-between">
                                <p class="text-[11px] font-black uppercase tracking-[0.18em] text-gray-400">Selesai</p>
                                <p class="font-display text-lg font-extrabold text-gray-900">{{ $completedRate }}%</p>
                            </div>
                            <div class="mt-2 h-2 rounded-full overflow-hidden" style="background: rgba(0,0,0,0.06);">
                                <div class="h-full rounded-full" style="width: {{ $completedRate }}%; background: var(--amber);"></div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 grid grid-cols-3 gap-2">
                        <div class="rounded-2xl p-3 text-center" style="background: rgba(12,34,64,0.03); border: 1px solid rgba(12,34,64,0.06);">
                            <p class="text-[10px] font-black uppercase tracking-[0.18em] text-gray-400">Hari ini</p>
                            <p class="font-display text-xl font-extrabold text-gray-900 mt-1">{{ $activeToday }}</p>
                        </div>
                        <div class="rounded-2xl p-3 text-center" style="background: rgba(29,109,181,0.04); border: 1px solid rgba(29,109,181,0.12);">
                            <p class="text-[10px] font-black uppercase tracking-[0.18em] text-gray-400">Minggu</p>
                            <p class="font-display text-xl font-extrabold text-gray-900 mt-1">{{ $activeThisWeek }}</p>
                        </div>
                        <div class="rounded-2xl p-3 text-center" style="background: rgba(229,164,17,0.06); border: 1px solid rgba(229,164,17,0.16);">
                            <p class="text-[10px] font-black uppercase tracking-[0.18em] text-gray-400">Bulan</p>
                            <p class="font-display text-xl font-extrabold text-gray-900 mt-1">{{ $activeThisMonth }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Weekly + Categories -->
        <section class="grid grid-cols-1 lg:grid-cols-12 gap-6">
            <div class="lg:col-span-7">
                <div class="card p-6 md:p-8 shadow-sm">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <p class="text-[10px] font-black uppercase tracking-[0.22em] text-gray-400">7 Hari Terakhir</p>
                            <h3 class="font-display text-lg font-extrabold tracking-tight text-gray-900 mt-2">Denyut Mingguan</h3>
                            <p class="text-sm text-gray-600 mt-1">Perbandingan selesai vs proses per hari.</p>
                        </div>
                        <div class="hidden sm:flex items-center gap-3">
                            <div class="flex items-center gap-2">
                                <span class="w-2.5 h-2.5 rounded" style="background: var(--accent);"></span>
                                <span class="text-[10px] font-black uppercase tracking-[0.18em] text-gray-400">Selesai</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="w-2.5 h-2.5 rounded" style="background: var(--amber);"></span>
                                <span class="text-[10px] font-black uppercase tracking-[0.18em] text-gray-400">Proses</span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 space-y-3">
                        @foreach($weeklyData as $day)
                            @php
                                $complete = $day['complete'] ?? 0;
                                $progress = $day['on_progress'] ?? 0;
                                $total = $complete + $progress;
                                $cW = $weeklyMax > 0 ? (($complete / $weeklyMax) * 100) : 0;
                                $pW = $weeklyMax > 0 ? (($progress / $weeklyMax) * 100) : 0;
                            @endphp
                            <div class="flex items-center gap-4">
                                <div class="w-14">
                                    <p class="text-[10px] font-black uppercase tracking-[0.18em] text-gray-400">{{ substr($day['day_name'], 0, 3) }}</p>
                                </div>
                                <div class="flex-1">
                                    <div class="h-3 rounded-full overflow-hidden" style="background: rgba(0,0,0,0.06);">
                                        <div class="h-full" style="width: {{ $cW }}%; background: var(--accent); float:left;"></div>
                                        <div class="h-full" style="width: {{ $pW }}%; background: var(--amber); float:left;"></div>
                                    </div>
                                </div>
                                <div class="w-20 text-right">
                                    <p class="font-display text-sm font-extrabold text-gray-900">{{ $total }}</p>
                                    <p class="text-[10px] font-black uppercase tracking-[0.18em] text-gray-400">Total</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="lg:col-span-5">
                <div class="card p-6 md:p-8 shadow-sm h-full">
                    <p class="text-[10px] font-black uppercase tracking-[0.22em] text-gray-400">Kategori</p>
                    <h3 class="font-display text-lg font-extrabold tracking-tight text-gray-900 mt-2">Paling Sering Dilaporkan</h3>
                    <p class="text-sm text-gray-600 mt-1">Distribusi aspirasi berdasarkan kategori.</p>

                    <div class="mt-6 space-y-3">
                        @forelse($topCategories as $count)
                            @php
                                $pct = $totalFeedback > 0 ? round(($count->total / $totalFeedback) * 100) : 0;
                            @endphp
                            <div class="rounded-2xl p-4" style="background: rgba(12,34,64,0.03); border: 1px solid rgba(12,34,64,0.06);">
                                <div class="flex items-start justify-between gap-4">
                                    <div class="min-w-0">
                                        <p class="text-sm font-extrabold text-gray-900 truncate">{{ $count->kategori->name ?? 'Lainnya' }}</p>
                                        <p class="text-[10px] font-black uppercase tracking-[0.18em] text-gray-400 mt-1">{{ $count->total }} laporan</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="font-display text-lg font-extrabold text-gray-900">{{ $pct }}%</p>
                                    </div>
                                </div>
                                <div class="mt-3 h-2 rounded-full overflow-hidden" style="background: rgba(0,0,0,0.06);">
                                    <div class="h-full rounded-full" style="width: {{ $pct }}%; background: var(--navy);"></div>
                                </div>
                            </div>
                        @empty
                            <div class="rounded-2xl p-10 text-center text-gray-600" style="background: rgba(12,34,64,0.03); border: 1px solid rgba(12,34,64,0.06);">
                                Belum ada data kategori.
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </section>

        <!-- Queue -->
        <section class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="card overflow-hidden shadow-sm">
                <div class="px-6 py-5 border-b border-black/[0.04] flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full" style="background: var(--amber);"></span>
                        <p class="text-[11px] font-black uppercase tracking-[0.22em] text-gray-400">Perlu Tindakan</p>
                    </div>
                    <a href="{{ route('admin.feedback') }}" class="text-[11px] font-black uppercase tracking-[0.18em]" style="color: var(--accent);">Lihat semua</a>
                </div>
                <div class="divide-y divide-black/[0.04]">
                    @forelse($inProgressAspirations as $aspirasi)
                        <a href="{{ route('admin.feedback.show', $aspirasi->id) }}" class="block px-6 py-5 hover:bg-black/[0.02] transition">
                            <p class="text-sm font-extrabold text-gray-900">{{ $aspirasi->feedback_title }}</p>
                            <p class="text-sm text-gray-600 mt-1 line-clamp-2">{{ $aspirasi->details }}</p>
                            <div class="mt-3 flex items-center justify-between">
                                <span class="inline-flex px-3 py-1 rounded-full text-[11px] font-black uppercase tracking-[0.18em]" style="background: rgba(229,164,17,0.15); color: var(--navy); border: 1px solid rgba(229,164,17,0.25);">On progress</span>
                                <span class="text-[11px] font-bold text-gray-400">{{ optional($aspirasi->created_at)->format('d M Y') }}</span>
                            </div>
                        </a>
                    @empty
                        <div class="px-6 py-12 text-center">
                            <p class="text-gray-600 font-bold">Semua tertangani!</p>
                            <p class="text-[10px] font-black uppercase tracking-[0.18em] text-gray-400 mt-1">Tidak ada item perlu tindakan</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <div class="card overflow-hidden shadow-sm">
                <div class="px-6 py-5 border-b border-black/[0.04] flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full" style="background: var(--accent);"></span>
                        <p class="text-[11px] font-black uppercase tracking-[0.22em] text-gray-400">Selesai</p>
                    </div>
                    <a href="{{ route('admin.feedback') }}" class="text-[11px] font-black uppercase tracking-[0.18em]" style="color: var(--accent);">Lihat semua</a>
                </div>
                <div class="divide-y divide-black/[0.04]">
                    @forelse($completedAspirations as $aspirasi)
                        <a href="{{ route('admin.feedback.show', $aspirasi->id) }}" class="block px-6 py-5 hover:bg-black/[0.02] transition">
                            <p class="text-sm font-extrabold text-gray-900">{{ $aspirasi->feedback_title }}</p>
                            <p class="text-sm text-gray-600 mt-1 line-clamp-2">{{ $aspirasi->details }}</p>
                            <div class="mt-3 flex items-center justify-between">
                                <span class="inline-flex px-3 py-1 rounded-full text-[11px] font-black uppercase tracking-[0.18em]" style="background: rgba(29,109,181,0.12); color: var(--accent); border: 1px solid rgba(29,109,181,0.22);">Complete</span>
                                <span class="text-[11px] font-bold text-gray-400">{{ optional($aspirasi->created_at)->format('d M Y') }}</span>
                            </div>
                        </a>
                    @empty
                        <div class="px-6 py-12 text-center">
                            <p class="text-gray-600 font-bold">Belum ada aspirasi selesai.</p>
                            <p class="text-[10px] font-black uppercase tracking-[0.18em] text-gray-400 mt-1">Mulai dari antrian proses</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>
    </div>
</div>

@endsection