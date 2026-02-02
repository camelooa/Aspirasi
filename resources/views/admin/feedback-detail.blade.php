@extends('layout.admin')

@section('content')
<div class="p-8">
    <div class="mb-6">
        <a href="{{ route('admin.feedback') }}" class="text-blue-600 hover:text-blue-800 flex items-center gap-2 mb-4">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali ke Daftar Feedback
        </a>
        <h2 class="text-3xl font-bold text-gray-900">Detail Aspirasi</h2>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-lg shadow p-6">
                <!-- User Info -->
                <div class="flex items-center gap-4 mb-6">
                    <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center text-blue-700 font-bold text-lg">
                        {{ substr($feedback->user->name ?? 'U', 0, 2) }}
                    </div>
                    <div>
                        <h3 class="font-bold text-lg text-gray-900">{{ $feedback->user->name ?? 'Anonymous' }}</h3>
                        <p class="text-sm text-gray-500">{{ $feedback->created_at->format('d F Y, H:i') }}</p>
                    </div>
                    <span class="ml-auto px-3 py-1 rounded-full text-xs font-medium {{ $feedback->status === 'complete' ? 'bg-green-100 text-green-800' : ($feedback->status === 'on_progress' ? 'bg-blue-100 text-blue-800' : 'bg-yellow-100 text-yellow-800') }}">
                        {{ ucfirst(str_replace('_', ' ', $feedback->status)) }}
                    </span>
                </div>

                <!-- Content -->
                <div class="mb-6">
                    <h4 class="text-xl font-bold text-gray-900 mb-2">{{ $feedback->feedback_title }}</h4>
                    <div class="inline-block px-3 py-1 bg-gray-100 rounded-full text-sm text-gray-600 mb-4">
                        {{ $feedback->kategori->category_name ?? 'Uncategorized' }}
                    </div>
                    <p class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $feedback->details }}</p>
                </div>

                <!-- Image if exists -->
                @if($feedback->image)
                <div class="mb-6">
                    <img src="{{ asset('storage/' . $feedback->image) }}" alt="Lampiran" class="rounded-lg max-h-96 w-full object-cover">
                </div>
                @endif
            </div>

            <!-- Comments Section -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="font-bold text-gray-900 mb-4">Komentar ({{ $feedback->komentars->count() }})</h3>
                <div class="space-y-4">
                    @forelse($feedback->komentars as $komentar)
                    <div class="flex gap-3">
                        <div class="w-8 h-8 rounded-full bg-gray-100 flex-shrink-0 flex items-center justify-center text-xs font-bold text-gray-600">
                            {{ substr($komentar->user->name ?? 'U', 0, 2) }}
                        </div>
                        <div class="flex-1 bg-gray-50 rounded-lg p-3">
                            <div class="flex justify-between items-start mb-1">
                                <span class="font-bold text-sm text-gray-900">{{ $komentar->user->name ?? 'User' }}</span>
                                <span class="text-xs text-gray-500">{{ $komentar->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="text-sm text-gray-700">{{ $komentar->komentar }}</p>
                        </div>
                    </div>
                    @empty
                    <p class="text-gray-500 text-sm">Belum ada komentar.</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Sidebar / Admin Response -->
        <div class="lg:col-span-1 space-y-6">
            <!-- Status Update -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="font-bold text-gray-900 mb-4">Update Status</h3>
                <form action="{{ route('admin.feedback.status', $feedback->id) }}" method="POST">
                    @csrf
                    <div class="space-y-3">
                        <select name="status" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500">
                            <option value="on_progress" {{ $feedback->status == 'on_progress' ? 'selected' : '' }}>On Progress</option>
                            <option value="complete" {{ $feedback->status == 'complete' ? 'selected' : '' }}>Complete</option>
                        </select>
                        <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition">Update Status</button>
                    </div>
                </form>
            </div>

            <!-- Admin Reply -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="font-bold text-gray-900 mb-4">Balasan Admin</h3>
                <form action="{{ route('admin.feedback.reply', $feedback->id) }}" method="POST">
                    @csrf
                    <div class="space-y-3">
                        <textarea name="admin_response" rows="5" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500" placeholder="Tulis tanggapan remsi...">{{ $feedback->admin_response }}</textarea>
                        <button type="submit" class="w-full bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-700 transition">Kirim Balasan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
