@php
use Illuminate\Support\Str;
@endphp

@extends('layout.siswa')

@section('content')
<div class="px-4 md:px-8 py-8">
    @php
        $isComplete = $aspirasi->status === 'complete';
        $pillBg = $isComplete ? 'rgba(29,109,181,0.12)' : 'rgba(229,164,17,0.14)';
        $pillBorder = $isComplete ? 'rgba(29,109,181,0.22)' : 'rgba(229,164,17,0.26)';
        $pillText = $isComplete ? 'var(--accent)' : 'var(--navy)';
    @endphp

    <div class="max-w-7xl mx-auto space-y-6">
        <!-- Hero -->
        <section class="card p-6 md:p-8 shadow-sm relative overflow-hidden">
            <div class="absolute inset-0 pointer-events-none" style="background: radial-gradient(circle at 16% 24%, rgba(229,164,17,0.10), transparent 45%), radial-gradient(circle at 88% 36%, rgba(29,109,181,0.10), transparent 58%);"></div>
            <div class="relative flex flex-col gap-4">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                    <a href="javascript:history.back()" class="inline-flex items-center gap-2 btn-soft px-5 py-3 rounded-2xl font-extrabold text-sm w-fit">
                        <span aria-hidden="true">←</span>
                        Kembali
                    </a>
                    <span class="inline-flex px-3 py-1 rounded-full text-[11px] font-black uppercase tracking-[0.18em] w-fit" style="background: {{ $pillBg }}; border: 1px solid {{ $pillBorder }}; color: {{ $pillText }};">
                        {{ $isComplete ? 'Selesai' : 'Dalam Proses' }}
                    </span>
                </div>

                <div>
                    <p class="text-[10px] font-black uppercase tracking-[0.22em] text-gray-400">Siswa · Detail Aspirasi</p>
                    <h1 class="font-display text-2xl md:text-3xl font-extrabold tracking-tight text-gray-900 mt-2">{{ $aspirasi->feedback_title }}</h1>

                    <div class="mt-4 flex flex-wrap gap-2 text-[10px] font-black uppercase tracking-[0.18em] text-gray-400">
                        <span class="px-3 py-1 rounded-full" style="background: rgba(0,0,0,0.03); border: 1px solid rgba(0,0,0,0.06);">
                            {{ $aspirasi->kategori->name ?? 'Lainnya' }}
                        </span>
                        <span class="px-3 py-1 rounded-full" style="background: rgba(0,0,0,0.03); border: 1px solid rgba(0,0,0,0.06);">
                            {{ optional($aspirasi->created_at)->format('d M Y H:i') ?? '-' }}
                        </span>
                    </div>
                </div>
            </div>
        </section>

        <section class="grid grid-cols-1 lg:grid-cols-12 gap-6">
            <div class="lg:col-span-8 space-y-6">
                <div class="card shadow-sm p-6 md:p-8">
                    <p class="text-[10px] font-black uppercase tracking-[0.22em] text-gray-400">Detail</p>
                    <div class="mt-4">
                        <p class="text-gray-700 whitespace-pre-line leading-relaxed">{{ $aspirasi->details }}</p>
                    </div>

                    @if($aspirasi->image)
                        <div class="mt-6">
                            <p class="text-[10px] font-black uppercase tracking-[0.22em] text-gray-400">Lampiran</p>
                            <div class="mt-3 rounded-2xl overflow-hidden border border-black/[0.06] bg-white">
                                <img src="{{ asset('storage/' . $aspirasi->image) }}" alt="Aspirasi image" class="w-full max-h-[520px] object-contain">
                            </div>
                        </div>
                    @endif
                </div>

                @if(!empty($aspirasi->admin_response))
                    <div class="card shadow-sm p-6 md:p-8">
                        <div class="flex items-start gap-4">
                            <div class="h-12 w-12 rounded-2xl flex items-center justify-center text-white font-extrabold shrink-0" style="background: linear-gradient(165deg, var(--navy-deep) 0%, var(--navy) 55%, #163D6B 100%);">
                                AD
                            </div>
                            <div class="min-w-0">
                                <p class="text-sm font-extrabold text-gray-900">{{ $aspirasi->admin->full_name ?? $aspirasi->admin->username ?? 'Tim Merdeka Aspirasi' }}</p>
                                <p class="text-[10px] font-black uppercase tracking-[0.22em] text-gray-400 mt-1">Balasan Admin</p>
                            </div>
                        </div>
                        <div class="mt-5 rounded-2xl p-4" style="background: rgba(12,34,64,0.03); border: 1px solid rgba(0,0,0,0.06);">
                            <p class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $aspirasi->admin_response }}</p>
                        </div>
                    </div>
                @endif
            </div>

            <aside class="lg:col-span-4 space-y-6">
                <div class="card shadow-sm p-6">
                    <p class="text-[10px] font-black uppercase tracking-[0.22em] text-gray-400">Pengirim</p>
                    <div class="mt-4 flex items-start gap-3">
                        <div class="h-12 w-12 rounded-2xl flex items-center justify-center text-white font-extrabold shrink-0" style="background: linear-gradient(165deg, var(--navy-deep) 0%, var(--navy) 55%, #163D6B 100%);">
                            {{ strtoupper(substr($aspirasi->user->full_name ?? $aspirasi->user->name ?? 'U', 0, 2)) }}
                        </div>
                        <div class="min-w-0">
                            <p class="text-sm font-extrabold text-gray-900 truncate">{{ $aspirasi->user->full_name ?? $aspirasi->user->name }}</p>
                            <p class="text-sm text-gray-600 truncate mt-1">{{ $aspirasi->kategori->name ?? 'Lainnya' }}</p>
                        </div>
                    </div>
                </div>

                <div class="card shadow-sm p-6" style="background: rgba(229,164,17,0.08); border: 1px solid rgba(229,164,17,0.16);">
                    <p class="text-[10px] font-black uppercase tracking-[0.22em] text-gray-400">Status</p>
                    <p class="text-sm font-extrabold text-gray-900 mt-2">{{ $isComplete ? 'Selesai' : 'Dalam Proses' }}</p>
                    <p class="text-sm text-gray-700 mt-2">Jika sudah ada balasan admin, kamu akan melihatnya di panel “Balasan Admin”.</p>
                </div>
            </aside>
        </section>
    </div>
</div>
@endsection
