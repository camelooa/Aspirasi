@extends('layout.siswa')

@section('content')
@php
    use Illuminate\Support\Str;
    $displayName = auth()->user()->username ?? auth()->user()->full_name ?? auth()->user()->name ?? 'Siswa';
@endphp

<div class="px-4 md:px-8 py-8">
    <div class="max-w-7xl mx-auto space-y-6">
        <!-- Hero -->
        <section class="card p-6 md:p-10 shadow-sm relative overflow-hidden">
            <div class="absolute inset-0 pointer-events-none" style="background: radial-gradient(circle at 16% 24%, rgba(229,164,17,0.12), transparent 45%), radial-gradient(circle at 88% 36%, rgba(29,109,181,0.10), transparent 58%);"></div>
            <div class="relative flex flex-col lg:flex-row lg:items-end lg:justify-between gap-6">
                <div class="max-w-2xl">
                    <p class="text-[10px] font-black uppercase tracking-[0.22em] text-gray-400">Siswa · Dashboard</p>
                    <h2 class="font-display text-2xl md:text-3xl font-extrabold tracking-tight text-gray-900 mt-2">
                        Halo, <span style="color: var(--accent);">{{ $displayName }}</span>
                    </h2>
                    <p class="text-sm text-gray-600 mt-2">Kirim aspirasi yang jelas dan mudah ditindaklanjuti. Kamu bisa memantau status serta balasan admin langsung dari sini.</p>
                </div>
                <div class="flex flex-wrap items-center gap-2">
                    <a href="{{ route('siswa.buataspirasi') }}" class="btn inline-flex items-center gap-2 px-6 py-3 rounded-2xl text-white font-extrabold text-sm shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        Buat Aspirasi
                    </a>
                    <a href="{{ route('siswa.aspirasisaya') }}" class="btn-soft inline-flex items-center gap-2 px-6 py-3 rounded-2xl font-extrabold text-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7 12a5 5 0 1010 0 5 5 0 00-10 0z"/></svg>
                        Aspirasi Saya
                    </a>
                </div>
            </div>
        </section>

        <!-- Stats -->
        <section class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="card p-6 shadow-sm">
                <p class="text-[10px] font-black uppercase tracking-[0.22em] text-gray-400">Total Aspirasi</p>
                <p class="text-4xl font-extrabold text-gray-900 leading-none mt-2">{{ $totalAspirasi }}</p>
                <div class="w-10 h-1 mt-4 rounded-full" style="background: var(--navy);"></div>
            </div>
            <div class="card p-6 shadow-sm">
                <p class="text-[10px] font-black uppercase tracking-[0.22em] text-gray-400">Selesai</p>
                <p class="text-4xl font-extrabold text-gray-900 leading-none mt-2">{{ $aspirasiComplete }}</p>
                <div class="w-10 h-1 mt-4 rounded-full" style="background: rgba(29,109,181,0.75);"></div>
            </div>
            <div class="card p-6 shadow-sm">
                <p class="text-[10px] font-black uppercase tracking-[0.22em] text-gray-400">Dalam Proses</p>
                <p class="text-4xl font-extrabold text-gray-900 leading-none mt-2">{{ $aspirasiPending }}</p>
                <div class="w-10 h-1 mt-4 rounded-full" style="background: rgba(229,164,17,0.85);"></div>
            </div>
        </section>

        <!-- Content -->
        <section class="grid grid-cols-1 lg:grid-cols-12 gap-6">
            <div class="lg:col-span-8">
                <div class="card shadow-sm overflow-hidden">
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
                </div>
            </div>

            <aside class="lg:col-span-4 space-y-6">
                <div class="card p-6 shadow-sm">
                    <p class="text-[10px] font-black uppercase tracking-[0.22em] text-gray-400">Kategori</p>
                    <h3 class="font-display text-lg font-extrabold tracking-tight text-gray-900 mt-2">Paling Sering Dilaporkan</h3>
                    <div class="mt-4 space-y-2">
                        @forelse($popularKategoris as $kategori)
                            <div class="flex items-center justify-between gap-3 p-3 rounded-2xl" style="background: rgba(0,0,0,0.02); border: 1px solid rgba(0,0,0,0.06);">
                                <p class="text-sm font-extrabold text-gray-900 truncate">{{ $kategori->name }}</p>
                                <span class="shrink-0 px-3 py-1 rounded-full text-[11px] font-black" style="background: rgba(12,34,64,0.08); border: 1px solid rgba(12,34,64,0.12); color: var(--navy);">{{ $kategori->aspirasis_count }}</span>
                            </div>
                        @empty
                            <p class="text-sm text-gray-600">Belum ada kategori tersedia.</p>
                        @endforelse
                    </div>
                </div>

                <div class="card p-6 shadow-sm relative overflow-hidden" style="background: linear-gradient(165deg, var(--navy-deep) 0%, var(--navy) 55%, #163D6B 100%);">
                    <div class="absolute inset-0 pointer-events-none" style="background: radial-gradient(circle at 18% 20%, rgba(229,164,17,0.22), transparent 52%);"></div>
                    <div class="relative text-white">
                        <p class="text-[10px] font-black uppercase tracking-[0.22em]" style="color: rgba(229,164,17,0.95);">Tips</p>
                        <h3 class="font-display text-lg font-extrabold tracking-tight mt-2">Aspirasi yang bagus</h3>
                        <div class="mt-4 space-y-3 text-sm text-white/75">
                            <p><span class="font-extrabold" style="color: rgba(229,164,17,0.95);">01</span> Gunakan judul yang spesifik dan singkat.</p>
                            <p><span class="font-extrabold" style="color: rgba(229,164,17,0.95);">02</span> Sertakan lokasi/waktu kejadian bila relevan.</p>
                            <p><span class="font-extrabold" style="color: rgba(229,164,17,0.95);">03</span> Tulis sopan dan fokus pada solusi.</p>
                        </div>
                    </div>
                </div>
            </aside>
        </section>
    </div>
</div>
@endsection
