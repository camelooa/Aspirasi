@extends('layout.admin')

@section('content')
<div class="px-4 md:px-8 py-8">
    <div class="max-w-7xl mx-auto space-y-6">
        <!-- Header -->
        <section class="grid grid-cols-1 lg:grid-cols-12 gap-6">
            <div class="lg:col-span-8">
                <div class="card p-6 md:p-8 shadow-sm relative overflow-hidden">
                    <div class="absolute inset-0 pointer-events-none" style="background: radial-gradient(circle at 25% 15%, rgba(29,109,181,0.10), transparent 45%), radial-gradient(circle at 85% 35%, rgba(229,164,17,0.10), transparent 55%);"></div>
                    <div class="relative">
                        <p class="text-[10px] font-black uppercase tracking-[0.22em] text-gray-400">Admin · Feedback</p>
                        <h2 class="font-display text-2xl md:text-3xl font-extrabold tracking-tight text-gray-900 mt-2">Pusat Aspirasi Masuk</h2>
                        <p class="text-sm text-gray-600 mt-2 max-w-xl">Cari, tinjau, balas, dan ubah status aspirasi tanpa kehilangan konteks.</p>

                        <div class="mt-5 flex flex-wrap items-center gap-3">
                            <div class="rounded-2xl px-4 py-3" style="background: rgba(12,34,64,0.03); border: 1px solid rgba(12,34,64,0.06);">
                                <p class="text-[10px] font-black uppercase tracking-[0.18em] text-gray-400">Total</p>
                                <p class="font-display text-xl font-extrabold text-gray-900 mt-1">{{ $feedbacks->total() }}</p>
                            </div>
                            @if(request('status'))
                                <div class="rounded-2xl px-4 py-3" style="background: rgba(229,164,17,0.10); border: 1px solid rgba(229,164,17,0.18);">
                                    <p class="text-[10px] font-black uppercase tracking-[0.18em] text-gray-400">Filter</p>
                                    <p class="text-sm font-extrabold text-gray-900 mt-1">{{ ucfirst(str_replace('_', ' ', request('status'))) }}</p>
                                </div>
                            @endif
                            @if(request('search'))
                                <div class="rounded-2xl px-4 py-3" style="background: rgba(29,109,181,0.08); border: 1px solid rgba(29,109,181,0.16);">
                                    <p class="text-[10px] font-black uppercase tracking-[0.18em] text-gray-400">Pencarian</p>
                                    <p class="text-sm font-extrabold text-gray-900 mt-1">“{{ request('search') }}”</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-4">
                <div class="card p-6 md:p-8 shadow-sm h-full">
                    <p class="text-[10px] font-black uppercase tracking-[0.22em] text-gray-400">Filter</p>
                    <h3 class="font-display text-lg font-extrabold tracking-tight text-gray-900 mt-2">Temukan Cepat</h3>
                    <p class="text-sm text-gray-600 mt-1">Gunakan pencarian dan status.</p>

                    <form action="{{ route('admin.feedback') }}" method="GET" class="mt-5 space-y-4">
                        <div>
                            <label class="block text-[11px] font-black uppercase tracking-[0.18em] text-gray-400 mb-2">Pencarian</label>
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul / isi aspirasi..." class="fi w-full px-4 py-3 text-[13.5px] text-gray-900 font-semibold">
                        </div>
                        <div>
                            <label class="block text-[11px] font-black uppercase tracking-[0.18em] text-gray-400 mb-2">Status</label>
                            <select name="status" class="fi w-full px-4 py-3 text-[13.5px] text-gray-900 font-semibold" onchange="this.form.submit()">
                                <option value="">Semua Status</option>
                                <option value="on_progress" {{ request('status') == 'on_progress' ? 'selected' : '' }}>Pending / On Progress</option>
                                <option value="complete" {{ request('status') == 'complete' ? 'selected' : '' }}>Selesai</option>
                            </select>
                        </div>
                        <div class="flex items-center gap-2">
                            <button type="submit" class="btn flex-1 px-6 py-3 rounded-2xl text-white font-extrabold text-sm">Cari</button>
                            <a href="{{ route('admin.feedback') }}" class="btn-soft px-5 py-3 rounded-2xl font-extrabold text-sm">Reset</a>
                        </div>
                    </form>
                </div>
            </div>
        </section>

        <!-- List -->
        <section class="grid grid-cols-1 lg:grid-cols-12 gap-6">
            <div class="lg:col-span-12 space-y-3">
                @forelse($feedbacks as $feedback)
                    @php
                        $statusLabel = ucfirst(str_replace('_', ' ', $feedback->status));
                        $statusPillStyle = match ($feedback->status) {
                            'complete' => 'background: rgba(29,109,181,0.12); color: var(--accent); border: 1px solid rgba(29,109,181,0.22);',
                            'on_progress' => 'background: rgba(229,164,17,0.14); color: var(--navy); border: 1px solid rgba(229,164,17,0.25);',
                            default => 'background: rgba(0,0,0,0.04); color: #334155; border: 1px solid rgba(0,0,0,0.08);',
                        };
                    @endphp

                    <div class="card p-5 md:p-6 shadow-sm">
                        <div class="flex flex-col md:flex-row md:items-center gap-4">
                            <div class="flex items-center gap-3 min-w-0 flex-1">
                                <div class="w-11 h-11 rounded-2xl flex items-center justify-center text-[12px] font-extrabold text-white shrink-0" style="background: linear-gradient(165deg, var(--navy-deep) 0%, var(--navy) 55%, #163D6B 100%);">
                                    {{ strtoupper(substr($feedback->user->full_name ?? $feedback->user->username ?? 'U', 0, 2)) }}
                                </div>

                                <div class="min-w-0">
                                    <div class="flex flex-wrap items-center gap-2">
                                        <a href="{{ route('admin.feedback.show', $feedback->id) }}" class="text-base font-extrabold text-gray-900 hover:underline truncate">
                                            {{ $feedback->feedback_title ?? 'Aspirasi' }}
                                        </a>
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-[11px] font-black uppercase tracking-[0.18em]" style="{{ $statusPillStyle }}">{{ $statusLabel }}</span>
                                    </div>

                                    <p class="text-sm text-gray-600 mt-1 line-clamp-2">{{ \Illuminate\Support\Str::limit($feedback->details, 140) }}</p>

                                    <div class="mt-3 flex flex-wrap items-center gap-2 text-[11px] font-bold text-gray-500">
                                        <span class="inline-flex items-center gap-2 rounded-full px-3 py-1" style="background: rgba(12,34,64,0.03); border: 1px solid rgba(12,34,64,0.06);">
                                            <span class="w-1.5 h-1.5 rounded-full" style="background: var(--navy); opacity: .35;"></span>
                                            {{ $feedback->user->full_name ?? $feedback->user->username ?? 'Anonymous' }}
                                        </span>
                                        <span class="inline-flex items-center gap-2 rounded-full px-3 py-1" style="background: rgba(0,0,0,0.03); border: 1px solid rgba(0,0,0,0.06);">
                                            {{ $feedback->kategori->name ?? 'Uncategorized' }}
                                        </span>
                                        <span class="inline-flex items-center gap-2 rounded-full px-3 py-1" style="background: rgba(0,0,0,0.03); border: 1px solid rgba(0,0,0,0.06);">
                                            {{ optional($feedback->created_at)->format('d M Y') ?? '-' }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center gap-2 md:justify-end">
                                <a href="{{ route('admin.feedback.show', $feedback->id) }}" class="btn-soft px-4 py-2.5 rounded-2xl text-[12px] font-extrabold">Detail</a>
                                <form action="{{ route('admin.feedback.status', $feedback->id) }}" method="POST" class="inline">
                                    @csrf
                                    <input type="hidden" name="status" value="complete">
                                    <button type="submit" class="px-4 py-2.5 rounded-2xl text-[12px] font-extrabold" style="background: rgba(29,109,181,0.10); color: var(--accent); border: 1px solid rgba(29,109,181,0.20);">Tandai selesai</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="card p-10 text-center text-gray-600 shadow-sm">
                        <p class="font-extrabold text-gray-900">Belum ada feedback.</p>
                        <p class="text-sm text-gray-600 mt-1">Coba ubah filter atau tunggu laporan masuk.</p>
                    </div>
                @endforelse
            </div>
        </section>

        <!-- Pagination -->
        <section class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <p class="text-sm text-gray-600">
                Menampilkan {{ $feedbacks->firstItem() ?? 0 }} hingga {{ $feedbacks->lastItem() ?? 0 }} dari {{ $feedbacks->total() }} feedback
            </p>
            <div class="card px-3 py-2 shadow-sm">
                {{ $feedbacks->links() }}
            </div>
        </section>
    </div>
</div>
@endsection
