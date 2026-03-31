@extends('layout.admin')

@section('content')
@php
    $statusLabel = ucfirst(str_replace('_', ' ', $feedback->status));
    $statusPillStyle = match ($feedback->status) {
        'complete' => 'background: rgba(29,109,181,0.12); color: var(--accent); border: 1px solid rgba(29,109,181,0.22);',
        'on_progress' => 'background: rgba(229,164,17,0.14); color: var(--navy); border: 1px solid rgba(229,164,17,0.25);',
        default => 'background: rgba(0,0,0,0.04); color: #334155; border: 1px solid rgba(0,0,0,0.08);',
    };
@endphp

<div class="px-4 md:px-8 py-8">
    <div class="max-w-7xl mx-auto space-y-6">
        <!-- Header / Case title -->
        <section class="card p-6 md:p-8 shadow-sm relative overflow-hidden">
            <div class="absolute inset-0 pointer-events-none" style="background: radial-gradient(circle at 18% 18%, rgba(229,164,17,0.10), transparent 45%), radial-gradient(circle at 85% 35%, rgba(29,109,181,0.10), transparent 55%);"></div>
            <div class="relative">
                <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-4">
                    <div>
                        <a href="{{ route('admin.feedback') }}" class="inline-flex items-center gap-2 text-[11px] font-black uppercase tracking-[0.18em] text-gray-500 hover:text-gray-900 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                            Kembali ke daftar
                        </a>

                        <p class="mt-3 text-[10px] font-black uppercase tracking-[0.22em] text-gray-400">Detail Aspirasi</p>
                        <h2 class="font-display text-2xl md:text-3xl font-extrabold tracking-tight text-gray-900 mt-2">
                            {{ $feedback->feedback_title ?? 'Aspirasi' }}
                        </h2>
                        <p class="text-sm text-gray-600 mt-2 max-w-2xl">Lihat laporan, lampiran, dan histori balasan admin dalam satu tampilan.</p>
                    </div>

                    <div class="flex items-center gap-2">
                        <span class="inline-flex items-center px-3.5 py-2 rounded-full text-[11px] font-black uppercase tracking-[0.18em]" style="{{ $statusPillStyle }}">{{ $statusLabel }}</span>
                    </div>
                </div>

                <div class="mt-6 grid grid-cols-1 sm:grid-cols-3 gap-3">
                    <div class="rounded-2xl p-4" style="background: rgba(12,34,64,0.03); border: 1px solid rgba(12,34,64,0.06);">
                        <p class="text-[10px] font-black uppercase tracking-[0.18em] text-gray-400">Pengirim</p>
                        <p class="text-sm font-extrabold text-gray-900 mt-1">{{ $feedback->user->full_name ?? $feedback->user->username ?? 'Anonymous' }}</p>
                    </div>
                    <div class="rounded-2xl p-4" style="background: rgba(0,0,0,0.03); border: 1px solid rgba(0,0,0,0.06);">
                        <p class="text-[10px] font-black uppercase tracking-[0.18em] text-gray-400">Kategori</p>
                        <p class="text-sm font-extrabold text-gray-900 mt-1">{{ $feedback->kategori->name ?? 'Uncategorized' }}</p>
                    </div>
                    <div class="rounded-2xl p-4" style="background: rgba(29,109,181,0.08); border: 1px solid rgba(29,109,181,0.16);">
                        <p class="text-[10px] font-black uppercase tracking-[0.18em] text-gray-400">Dibuat</p>
                        <p class="text-sm font-extrabold text-gray-900 mt-1">{{ optional($feedback->created_at)->format('d F Y, H:i') ?? '-' }}</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="grid grid-cols-1 lg:grid-cols-12 gap-6">
            <!-- Main case file -->
            <div class="lg:col-span-8 space-y-6">
                <div class="card p-6 md:p-8 shadow-sm">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 rounded-2xl flex items-center justify-center text-[12px] font-extrabold text-white shrink-0" style="background: linear-gradient(165deg, var(--navy-deep) 0%, var(--navy) 55%, #163D6B 100%);">
                            {{ strtoupper(substr($feedback->user->full_name ?? $feedback->user->username ?? 'U', 0, 2)) }}
                        </div>
                        <div class="min-w-0">
                            <p class="text-[10px] font-black uppercase tracking-[0.22em] text-gray-400">Isi Laporan</p>
                            <p class="text-gray-900 font-extrabold mt-2">{{ $feedback->feedback_title ?? 'Aspirasi' }}</p>
                            <p class="text-gray-700 leading-relaxed whitespace-pre-line mt-3">{{ $feedback->details }}</p>
                        </div>
                    </div>

                    @if($feedback->image)
                        <div class="mt-6">
                            <p class="text-[10px] font-black uppercase tracking-[0.22em] text-gray-400 mb-2">Lampiran</p>
                            <img src="{{ asset('storage/' . $feedback->image) }}" alt="Lampiran" class="rounded-2xl max-h-96 w-full object-cover border border-black/[0.06]">
                        </div>
                    @endif
                </div>

                <div class="card p-6 md:p-8 shadow-sm">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <p class="text-[10px] font-black uppercase tracking-[0.22em] text-gray-400">Tanggapan Admin</p>
                            <h3 class="font-display text-lg font-extrabold tracking-tight text-gray-900 mt-2">Balasan Resmi</h3>
                            <p class="text-sm text-gray-600 mt-1">{{ !empty($feedback->admin_response) ? ('Terakhir diperbarui ' . (optional($feedback->updated_at)->format('d F Y, H:i') ?? '-')) : 'Belum ada balasan.' }}</p>
                        </div>

                        <span class="inline-flex items-center px-3 py-1.5 rounded-full text-[11px] font-black uppercase tracking-[0.18em]" style="background: rgba(12,34,64,0.03); border: 1px solid rgba(12,34,64,0.06); color: var(--navy);">Admin</span>
                    </div>

                    @if(!empty($feedback->admin_response))
                        <div class="mt-5 rounded-2xl p-5" style="background: rgba(29,109,181,0.05); border: 1px solid rgba(29,109,181,0.14);">
                            <p class="italic text-gray-800 leading-relaxed whitespace-pre-line">“{{ $feedback->admin_response }}”</p>
                        </div>
                    @else
                        <div class="mt-5 rounded-2xl p-5" style="background: rgba(0,0,0,0.03); border: 1px solid rgba(0,0,0,0.06);">
                            <p class="text-gray-600">Tulis balasan dari panel di samping untuk menanggapi aspirasi ini.</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Action panel -->
            <div class="lg:col-span-4 space-y-6">
                <div class="card p-6 md:p-8 shadow-sm">
                    <p class="text-[10px] font-black uppercase tracking-[0.22em] text-gray-400">Status</p>
                    <h3 class="font-display text-lg font-extrabold tracking-tight text-gray-900 mt-2">Update Progres</h3>
                    <p class="text-sm text-gray-600 mt-1">Pastikan status sesuai kondisi saat ini.</p>

                    <form action="{{ route('admin.feedback.status', $feedback->id) }}" method="POST" class="mt-5 space-y-3">
                        @csrf
                        <select name="status" class="fi w-full px-4 py-3 text-[13.5px] text-gray-900 font-semibold">
                            <option value="on_progress" {{ $feedback->status == 'on_progress' ? 'selected' : '' }}>On Progress</option>
                            <option value="complete" {{ $feedback->status == 'complete' ? 'selected' : '' }}>Complete</option>
                        </select>
                        <button type="submit" class="btn w-full py-3 rounded-2xl text-white font-extrabold text-sm">Simpan Status</button>
                    </form>
                </div>

                <div class="card p-6 md:p-8 shadow-sm">
                    <p class="text-[10px] font-black uppercase tracking-[0.22em] text-gray-400">Balasan</p>
                    <h3 class="font-display text-lg font-extrabold tracking-tight text-gray-900 mt-2">Kirim Tanggapan</h3>
                    <p class="text-sm text-gray-600 mt-1">Tanggapan akan terlihat di detail aspirasi.</p>

                    <form action="{{ route('admin.feedback.reply', $feedback->id) }}" method="POST" class="mt-5 space-y-3">
                        @csrf
                        <textarea name="admin_response" rows="7" class="fi w-full px-4 py-3 text-[13.5px] text-gray-900 font-semibold" placeholder="Tulis tanggapan resmi...">{{ $feedback->admin_response }}</textarea>
                        <button type="submit" class="w-full py-3 rounded-2xl text-white font-extrabold text-sm" style="background: var(--accent);">Kirim Balasan</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
