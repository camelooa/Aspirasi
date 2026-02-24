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
                        {{ substr($feedback->user->full_name ?? $feedback->user->username ?? 'U', 0, 2) }}
                    </div>
                    <div>
                        <h3 class="font-bold text-lg text-gray-900">{{ $feedback->user->full_name ?? $feedback->user->username ?? 'Anonymous' }}</h3>
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
                        {{ $feedback->kategori->name ?? 'Uncategorized' }}
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

            <!-- Admin Response Section (Main Content) -->
            @if(!empty($feedback->admin_response))
            <div class="bg-indigo-50 border-l-4 border-indigo-500 rounded-lg shadow-sm p-6">
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-700 font-bold">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-900">Tanggapan Resmi Admin</h3>
                        <p class="text-xs text-gray-500">Dibalas pada {{ $feedback->updated_at->format('d F Y, H:i') }}</p>
                    </div>
                </div>
                <div class="bg-white rounded-lg p-4 border border-indigo-100 italic text-gray-700 leading-relaxed whitespace-pre-line">
                    "{{ $feedback->admin_response }}"
                </div>
            </div>
            @endif
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
