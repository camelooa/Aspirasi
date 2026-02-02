@php
use Illuminate\Support\Str;
@endphp

@extends('layout.siswa')

@section('content')
<div class="p-8">
	<div class="max-w-4xl mx-auto">
		<div class="flex items-center mb-6">
			<h2 class="text-2xl font-bold">Aspirasi Saya</h2>
		</div>

		@if(session('success'))
			<div class="mb-4 p-3 bg-green-50 text-green-700 rounded">{{ session('success') }}</div>
		@endif

		@if(isset($aspirasis) && $aspirasis->isEmpty())
			<div class="p-6 bg-white rounded shadow text-gray-600">Belum ada aspirasi. Buat aspirasi pertama Anda.</div>
		@else
			<div class="space-y-4">
				@foreach($aspirasis as $a)
					<a href="{{ route('siswa.aspirasi.show', $a->id) }}" class="block bg-white p-4 rounded shadow hover:shadow-lg transition flex justify-between">
						<div class="w-3/4">
							<h3 class="font-semibold text-lg">{{ $a->feedback_title }}</h3>
							<p class="text-sm text-gray-600 mt-1">{{ Str::limit($a->details, 150) }}</p>
							<div class="text-xs text-gray-500 mt-2">
								<span>{{ $a->created_at->format('d M Y H:i') }}</span>
							</div>
						</div>
						<div class="text-right w-1/4">
							@if($a->status === 'complete')
								<span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm">Selesai</span>
							@else
								<span class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-sm">Dalam Proses</span>
							@endif

							@if(!empty($a->admin_response))
								<div class="mt-3 text-sm text-gray-700 bg-gray-50 p-2 rounded">Balasan: {{ Str::limit($a->admin_response, 200) }}</div>
							@endif
						</div>
					</a>
				@endforeach
			</div>
		@endif
	</div>
</div>
@endsection
