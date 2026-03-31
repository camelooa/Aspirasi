@php
use Illuminate\Support\Str;
@endphp

@extends('layout.siswa')

@section('content')
<div class="px-4 md:px-8 py-8">
	<div class="max-w-7xl mx-auto space-y-6">
		<section class="card p-6 md:p-8 shadow-sm relative overflow-hidden">
			<div class="absolute inset-0 pointer-events-none" style="background: radial-gradient(circle at 16% 24%, rgba(229,164,17,0.10), transparent 45%), radial-gradient(circle at 88% 36%, rgba(29,109,181,0.10), transparent 58%);"></div>
			<div class="relative flex flex-col lg:flex-row lg:items-end lg:justify-between gap-4">
				<div>
					<p class="text-[10px] font-black uppercase tracking-[0.22em] text-gray-400">Siswa · Aspirasi</p>
					<h2 class="font-display text-2xl md:text-3xl font-extrabold tracking-tight text-gray-900 mt-2">Aspirasi Saya</h2>
					<p class="text-sm text-gray-600 mt-2 max-w-2xl">Pantau status aspirasi yang kamu kirim, serta lihat balasan admin ketika tersedia.</p>
				</div>
				<div class="flex flex-wrap items-center gap-2">
					<a href="{{ route('siswa.buataspirasi') }}" class="btn inline-flex items-center gap-2 px-6 py-3 rounded-2xl text-white font-extrabold text-sm shadow-sm">
						<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
						Buat Aspirasi
					</a>
					<a href="{{ route('siswa.dashboard') }}" class="btn-soft inline-flex items-center gap-2 px-6 py-3 rounded-2xl font-extrabold text-sm">
						<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-3 7-4 7 4 2 3v8a1 1 0 01-1 1H4a1 1 0 01-1-1v-8z"/></svg>
						Dashboard
					</a>
				</div>
			</div>
		</section>

		@if(session('success'))
			<section class="card p-5 md:p-6 shadow-sm" style="background: rgba(29,109,181,0.06); border: 1px solid rgba(29,109,181,0.16);">
				<p class="text-[10px] font-black uppercase tracking-[0.22em] text-gray-400">Info</p>
				<p class="text-sm font-extrabold text-gray-900 mt-2">{{ session('success') }}</p>
			</section>
		@endif

		@if(isset($aspirasis) && $aspirasis->isEmpty())
			<section class="card p-10 text-center shadow-sm">
				<p class="font-extrabold text-gray-900">Belum ada aspirasi.</p>
				<p class="text-sm text-gray-600 mt-1">Buat aspirasi pertamamu agar bisa diproses admin.</p>
				<a href="{{ route('siswa.buataspirasi') }}" class="mt-4 inline-flex btn-soft px-6 py-3 rounded-2xl font-extrabold text-sm">Buat Aspirasi</a>
			</section>
		@else
			<section class="space-y-3">
				@foreach($aspirasis as $a)
					@php
						$isComplete = $a->status === 'complete';
						$pillBg = $isComplete ? 'rgba(29,109,181,0.12)' : 'rgba(229,164,17,0.14)';
						$pillBorder = $isComplete ? 'rgba(29,109,181,0.22)' : 'rgba(229,164,17,0.26)';
						$pillText = $isComplete ? 'var(--accent)' : 'var(--navy)';
					@endphp
					<a href="{{ route('siswa.aspirasi.show', $a->id) }}" class="block card p-5 md:p-6 shadow-sm hover:bg-black/[0.01] transition">
						<div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4">
							<div class="min-w-0">
								<p class="text-sm font-extrabold text-gray-900 truncate">{{ $a->feedback_title }}</p>
								<p class="text-sm text-gray-600 mt-2">{{ Str::limit($a->details, 170) }}</p>
								<div class="mt-4 flex flex-wrap items-center gap-2 text-[10px] font-black uppercase tracking-[0.18em] text-gray-400">
									<span class="px-2.5 py-1 rounded-full" style="background: rgba(0,0,0,0.03); border: 1px solid rgba(0,0,0,0.06);">
										{{ optional($a->created_at)->format('d M Y H:i') ?? '-' }}
									</span>
									<span class="px-2.5 py-1 rounded-full" style="background: rgba(0,0,0,0.03); border: 1px solid rgba(0,0,0,0.06);">
										{{ $a->kategori->name ?? 'Lainnya' }}
									</span>
								</div>
							</div>

							<div class="shrink-0 flex md:flex-col md:items-end gap-2">
								<span class="inline-flex px-3 py-1 rounded-full text-[11px] font-black uppercase tracking-[0.18em]" style="background: {{ $pillBg }}; border: 1px solid {{ $pillBorder }}; color: {{ $pillText }};">
									{{ $isComplete ? 'Selesai' : 'Dalam Proses' }}
								</span>
								<span class="inline-flex btn-soft px-4 py-2 rounded-2xl text-[12px] font-extrabold">Lihat Detail</span>
							</div>
						</div>

						@if(!empty($a->admin_response))
							<div class="mt-4 rounded-2xl p-4" style="background: rgba(12,34,64,0.03); border: 1px solid rgba(0,0,0,0.06);">
								<p class="text-[10px] font-black uppercase tracking-[0.18em] text-gray-400">Cuplikan Balasan Admin</p>
								<p class="text-sm text-gray-700 mt-2">{{ Str::limit($a->admin_response, 220) }}</p>
							</div>
						@endif
					</a>
				@endforeach
			</section>
		@endif
	</div>
</div>
@endsection
