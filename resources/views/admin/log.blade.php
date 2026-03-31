@extends('layout.admin')

@section('content')
<div class="px-4 md:px-8 py-8">
    <div class="max-w-7xl mx-auto space-y-6">
        <section class="grid grid-cols-1 lg:grid-cols-12 gap-6">
            <div class="lg:col-span-8">
                <div class="card p-6 md:p-8 shadow-sm relative overflow-hidden">
                    <div class="absolute inset-0 pointer-events-none" style="background: radial-gradient(circle at 18% 22%, rgba(12,34,64,0.08), transparent 45%), radial-gradient(circle at 88% 35%, rgba(229,164,17,0.10), transparent 55%);"></div>
                    <div class="relative">
                        <p class="text-[10px] font-black uppercase tracking-[0.22em] text-gray-400">Admin · Activity</p>
                        <h2 class="font-display text-2xl md:text-3xl font-extrabold tracking-tight text-gray-900 mt-2">Log Aktivitas</h2>
                        <p class="text-sm text-gray-600 mt-2 max-w-xl">Ringkasan seluruh aspirasi yang tercatat di sistem.</p>

                        <div class="mt-5 flex flex-wrap items-center gap-3">
                            <div class="rounded-2xl px-4 py-3" style="background: rgba(12,34,64,0.03); border: 1px solid rgba(12,34,64,0.06);">
                                <p class="text-[10px] font-black uppercase tracking-[0.18em] text-gray-400">Total</p>
                                <p class="font-display text-xl font-extrabold text-gray-900 mt-1">{{ $logs->total() }}</p>
                            </div>
                            <div class="rounded-2xl px-4 py-3" style="background: rgba(29,109,181,0.08); border: 1px solid rgba(29,109,181,0.16);">
                                <p class="text-[10px] font-black uppercase tracking-[0.18em] text-gray-400">Halaman</p>
                                <p class="font-display text-xl font-extrabold text-gray-900 mt-1">{{ $logs->currentPage() }} / {{ $logs->lastPage() }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filters (visual only) -->
            <div class="lg:col-span-4">
                <div class="card p-6 md:p-8 shadow-sm h-full">
                    <p class="text-[10px] font-black uppercase tracking-[0.22em] text-gray-400">Filter</p>
                    <h3 class="font-display text-lg font-extrabold tracking-tight text-gray-900 mt-2">Penyaring Cepat</h3>
                    <p class="text-sm text-gray-600 mt-1">Panel ringkas untuk pengelompokan data.</p>

                    <div class="mt-5 space-y-4">
                        <div>
                            <label class="block text-[11px] font-black uppercase tracking-[0.18em] text-gray-400 mb-2">Pencarian</label>
                            <input type="text" placeholder="Cari nama pengguna atau pesan..." class="fi w-full px-4 py-3 text-[13.5px] text-gray-900 font-semibold">
                        </div>
                        <div>
                            <label class="block text-[11px] font-black uppercase tracking-[0.18em] text-gray-400 mb-2">Kategori</label>
                            <select class="fi w-full px-4 py-3 text-[13.5px] text-gray-900 font-semibold">
                                <option value="">Semua Kategori</option>
                                <option value="pendidikan">Pendidikan</option>
                                <option value="infrastruktur">Infrastruktur</option>
                                <option value="kesehatan">Kesehatan</option>
                                <option value="keamanan">Keamanan</option>
                                <option value="lainnya">Lainnya</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-[11px] font-black uppercase tracking-[0.18em] text-gray-400 mb-2">Status</label>
                            <select class="fi w-full px-4 py-3 text-[13.5px] text-gray-900 font-semibold">
                                <option value="">Semua Status</option>
                                <option value="pending">Pending</option>
                                <option value="on_progress">Sedang Diproses</option>
                                <option value="complete">Selesai</option>
                            </select>
                        </div>
                        <button type="button" class="btn-soft w-full px-6 py-3 rounded-2xl font-extrabold text-sm">Terapkan</button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Log list -->
        <section class="space-y-3">
            @forelse($logs as $index => $log)
                @php
                    $statusLabel = ucfirst(str_replace('_', ' ', $log->status));
                    $statusPillStyle = match ($log->status) {
                        'complete' => 'background: rgba(29,109,181,0.12); color: var(--accent); border: 1px solid rgba(29,109,181,0.22);',
                        'on_progress' => 'background: rgba(229,164,17,0.14); color: var(--navy); border: 1px solid rgba(229,164,17,0.25);',
                        default => 'background: rgba(0,0,0,0.04); color: #334155; border: 1px solid rgba(0,0,0,0.08);',
                    };
                @endphp

                <div class="card p-5 md:p-6 shadow-sm">
                    <div class="flex flex-col md:flex-row md:items-start gap-4">
                        <div class="flex items-start gap-3 min-w-0 flex-1">
                            <div class="w-12 h-12 rounded-2xl flex items-center justify-center text-[12px] font-extrabold text-white shrink-0" style="background: linear-gradient(165deg, var(--navy-deep) 0%, var(--navy) 55%, #163D6B 100%);">
                                {{ strtoupper(substr($log->user->full_name ?? $log->user->username ?? 'U', 0, 2)) }}
                            </div>
                            <div class="min-w-0">
                                <div class="flex flex-wrap items-center gap-2">
                                    <p class="text-sm font-extrabold text-gray-900 truncate">{{ $log->feedback_title }}</p>
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-[11px] font-black uppercase tracking-[0.18em]" style="{{ $statusPillStyle }}">{{ $statusLabel }}</span>
                                </div>
                                <div class="mt-2 flex flex-wrap items-center gap-2 text-[11px] font-bold text-gray-500">
                                    <span class="inline-flex items-center gap-2 rounded-full px-3 py-1" style="background: rgba(12,34,64,0.03); border: 1px solid rgba(12,34,64,0.06);">
                                        <span class="w-1.5 h-1.5 rounded-full" style="background: var(--navy); opacity: .35;"></span>
                                        {{ $log->user->full_name ?? $log->user->username ?? 'Anonymous' }}
                                    </span>
                                    <span class="inline-flex items-center gap-2 rounded-full px-3 py-1" style="background: rgba(0,0,0,0.03); border: 1px solid rgba(0,0,0,0.06);">
                                        {{ $log->kategori->name ?? 'Lainnya' }}
                                    </span>
                                    <span class="inline-flex items-center gap-2 rounded-full px-3 py-1" style="background: rgba(0,0,0,0.03); border: 1px solid rgba(0,0,0,0.06);">
                                        #{{ ($logs->firstItem() ?? 0) + $index }}
                                    </span>
                                    <span class="inline-flex items-center gap-2 rounded-full px-3 py-1" style="background: rgba(29,109,181,0.08); border: 1px solid rgba(29,109,181,0.16);">
                                        {{ optional($log->created_at)->format('d M Y - H:i') ?? '-' }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center gap-2 md:justify-end">
                            <button type="button" class="btn-soft px-4 py-2.5 rounded-2xl text-[12px] font-extrabold">Lihat</button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="card p-10 text-center text-gray-600 shadow-sm">
                    <p class="font-extrabold text-gray-900">Belum ada log aktivitas.</p>
                    <p class="text-sm text-gray-600 mt-1">Aktivitas akan muncul saat ada aspirasi masuk.</p>
                </div>
            @endforelse
        </section>

        <!-- Pagination -->
        <section class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <p class="text-sm text-gray-600">
                Menampilkan {{ $logs->firstItem() ?? 0 }} hingga {{ $logs->lastItem() ?? 0 }} dari {{ $logs->total() }} log aktivitas
            </p>
            <div class="card px-3 py-2 shadow-sm">
                {{ $logs->links() }}
            </div>
        </section>
    </div>
</div>
@endsection
