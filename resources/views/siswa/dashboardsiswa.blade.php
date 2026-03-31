@extends('layout.siswa')

@section('content')
@php
    use Illuminate\Support\Str;
    $displayName = auth()->user()->username ?? auth()->user()->full_name ?? auth()->user()->name ?? 'Siswa';
@endphp

<div class="px-4 md:px-8 py-8">
    <div class="max-w-7xl mx-auto space-y-6">
        <!-- Header -->
        <section class="flex flex-col md:flex-row md:items-end md:justify-between gap-4">
            <div>
                <p class="text-[10px] font-black uppercase tracking-[0.22em] text-gray-400">Siswa</p>
                <h2 class="font-display text-2xl md:text-3xl font-extrabold tracking-tight text-gray-900 mt-2">Dashboard</h2>
                <p class="text-sm text-gray-600 mt-2">
                    Halo, <span class="font-extrabold" style="color: var(--accent);">{{ $displayName }}</span>. Pantau status aspirasi dan cek balasan admin.
                </p>
            </div>

            <div class="flex flex-wrap items-center gap-2">
                <a href="{{ route('siswa.buataspirasi') }}" class="btn inline-flex items-center gap-2 px-6 py-3 rounded-2xl text-white font-extrabold text-sm shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Buat Aspirasi
                </a>
                <a href="{{ route('siswa.aspirasisaya') }}" class="btn-soft inline-flex items-center gap-2 px-6 py-3 rounded-2xl font-extrabold text-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5h6a2 2 0 012 2v12a2 2 0 01-2 2H9a2 2 0 01-2-2V7a2 2 0 012-2zm0 4h6m-6 4h6m-6 4h3"/></svg>
                    Aspirasi Saya
                </a>
            </div>
        </section>

        <!-- Summary -->
        <section class="card p-6 shadow-sm">
            <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-2">
                <div>
                    <p class="text-[10px] font-black uppercase tracking-[0.22em] text-gray-400">Ringkasan</p>
                    <h3 class="font-display text-lg font-extrabold text-gray-900 tracking-tight mt-2">Status Aspirasi</h3>
                </div>
                <a href="{{ route('siswa.aspirasisaya') }}" class="text-[11px] font-black uppercase tracking-[0.22em]" style="color: var(--accent);">Lihat Riwayat</a>
            </div>

            <div class="mt-5 grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div class="p-4 rounded-2xl" style="background: rgba(0,0,0,0.02); border: 1px solid rgba(0,0,0,0.06);">
                    <p class="text-[10px] font-black uppercase tracking-[0.22em] text-gray-400">Total</p>
                    <p class="text-3xl font-extrabold text-gray-900 leading-none mt-2">{{ $totalAspirasi }}</p>
                </div>
                <div class="p-4 rounded-2xl" style="background: rgba(0,0,0,0.02); border: 1px solid rgba(0,0,0,0.06);">
                    <p class="text-[10px] font-black uppercase tracking-[0.22em] text-gray-400">Dalam Proses</p>
                    <p class="text-3xl font-extrabold text-gray-900 leading-none mt-2">{{ $aspirasiPending }}</p>
                </div>
                <div class="p-4 rounded-2xl" style="background: rgba(0,0,0,0.02); border: 1px solid rgba(0,0,0,0.06);">
                    <p class="text-[10px] font-black uppercase tracking-[0.22em] text-gray-400">Selesai</p>
                    <p class="text-3xl font-extrabold text-gray-900 leading-none mt-2">{{ $aspirasiComplete }}</p>
                </div>
            </div>

            @if(($aspirasiPending ?? 0) > 0)
                <div class="mt-4 text-sm text-gray-600">
                    Kamu punya <span class="font-extrabold text-gray-900">{{ $aspirasiPending }}</span> aspirasi yang masih dalam proses.
                    <a href="{{ route('siswa.aspirasisaya') }}" class="font-extrabold" style="color: var(--accent);">Cek status</a>
                </div>
            @endif
        </section>

        <!-- Latest -->
        <section class="card shadow-sm overflow-hidden">
            <div class="px-6 py-5 border-b border-black/[0.04] flex flex-col sm:flex-row sm:items-end sm:justify-between gap-3">
                <div>
                    <p class="text-[10px] font-black uppercase tracking-[0.22em] text-gray-400">Terbaru</p>
                    <h3 class="font-display text-lg font-extrabold text-gray-900 tracking-tight mt-2">Aspirasi Terakhir</h3>
                </div>
                <a href="{{ route('siswa.aspirasisaya') }}" class="text-[11px] font-black uppercase tracking-[0.22em]" style="color: var(--accent);">Lihat Semua</a>
            </div>

            <div class="divide-y divide-black/[0.04]">
                @forelse($latestAspirasi as $aspirasi)
                    @php
                        $isComplete = $aspirasi->status === 'complete';
                        $pillBg = $isComplete ? 'rgba(29,109,181,0.12)' : 'rgba(229,164,17,0.14)';
                        $pillBorder = $isComplete ? 'rgba(29,109,181,0.22)' : 'rgba(229,164,17,0.26)';
                        $pillText = $isComplete ? 'var(--accent)' : 'var(--navy)';
                    @endphp
                    <a href="{{ route('siswa.aspirasi.show', $aspirasi->id) }}" class="block p-6 hover:bg-black/[0.02] transition">
                        <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-3">
                            <div class="min-w-0">
                                <p class="text-sm font-extrabold text-gray-900 truncate">{{ $aspirasi->feedback_title }}</p>
                                <p class="text-sm text-gray-600 mt-2">{{ Str::limit($aspirasi->details, 150) }}</p>
                            </div>
                            <div class="shrink-0">
                                <span class="inline-flex px-3 py-1 rounded-full text-[11px] font-black uppercase tracking-[0.18em]" style="background: {{ $pillBg }}; border: 1px solid {{ $pillBorder }}; color: {{ $pillText }};">
                                    {{ $isComplete ? 'Selesai' : 'Dalam Proses' }}
                                </span>
                            </div>
                        </div>

                        <div class="mt-4 flex flex-wrap items-center gap-2 text-[10px] font-black uppercase tracking-[0.18em] text-gray-400">
                            <span class="px-2.5 py-1 rounded-full" style="background: rgba(0,0,0,0.03); border: 1px solid rgba(0,0,0,0.06);">
                                {{ optional($aspirasi->created_at)->format('d M Y') ?? '-' }}
                            </span>
                            <span class="px-2.5 py-1 rounded-full" style="background: rgba(0,0,0,0.03); border: 1px solid rgba(0,0,0,0.06);">
                                {{ $aspirasi->kategori->name ?? 'Lainnya' }}
                            </span>
                        </div>
                    </a>
                @empty
                    <div class="p-10 text-center">
                        <p class="font-extrabold text-gray-900">Belum ada aspirasi.</p>
                        <p class="text-sm text-gray-600 mt-1">Mulai dengan mengirim aspirasi pertama kamu.</p>
                        <a href="{{ route('siswa.buataspirasi') }}" class="mt-4 inline-flex btn-soft px-6 py-3 rounded-2xl font-extrabold text-sm">Buat Aspirasi</a>
                    </div>
                @endforelse
            </div>
        </section>
    </div>
</div>
@endsection
