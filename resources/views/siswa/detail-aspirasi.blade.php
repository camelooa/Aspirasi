@php
use Illuminate\Support\Str;
@endphp

@extends('layout.siswa')

@section('content')
<div class="min-h-screen py-8 bg-cyan-50">
    <div class="max-w-6xl mx-auto px-4">
        <a href="javascript:history.back()" class="text-blue-600 hover:text-blue-900 mb-4 inline-block">← Kembali</a>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Left: Aspirasi Detail -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow p-6">
                    <!-- Header -->
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold">
                            {{ strtoupper(substr($aspirasi->user->full_name ?? $aspirasi->user->name ?? 'U', 0, 2)) }}
                        </div>
                        <div>
                            <p class="font-semibold text-gray-900">{{ $aspirasi->user->full_name ?? $aspirasi->user->name }}</p>
                            <p class="text-sm text-gray-500">{{ $aspirasi->kategori->name ?? 'Uncategorized' }}</p>
                        </div>
                    </div>

                    <!-- Title & Content -->
                    <div class="border-t border-gray-200 pt-4">
                        <h2 class="text-xl font-bold text-gray-900 mb-2">{{ $aspirasi->feedback_title }}</h2>
                        <p class="text-gray-700 whitespace-pre-line mb-4">{{ $aspirasi->details }}</p>
                        
                        <div class="text-sm text-gray-500">
                            <span>📅 {{ $aspirasi->created_at->format('d M Y H:i') }}</span>
                        </div>

                        @if($aspirasi->image)
                            <div class="mt-4">
                                <img src="{{ asset('storage/' . $aspirasi->image) }}" alt="Aspirasi image" class="max-h-64 rounded-lg">
                            </div>
                        @endif

                        <!-- Status Badge -->
                        <div class="mt-4">
                            @if($aspirasi->status === 'complete')
                                <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm">Selesai</span>
                            @else
                                <span class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-sm">Dalam Proses</span>
                            @endif
                        </div>
                    </div>

                    <!-- Admin Response -->
                    @if(!empty($aspirasi->admin_response))
                        <div class="border-t border-gray-200 pt-4 mt-4">
                            <div class="flex items-center gap-4 mb-3">
                                <div class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center text-red-600 font-bold text-sm">
                                    ADMIN
                                </div>
                                <p class="font-semibold text-gray-900">Admin name</p>
                            </div>
                            <p class="text-gray-700 ml-14">{{ $aspirasi->admin_response }}</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Right: Comment Section -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Comment Section</h3>

                <div class="space-y-4 max-h-96 overflow-y-auto">
                    @if($aspirasi->komentars->isEmpty())
                        <p class="text-gray-500 text-sm">Belum ada komentar</p>
                    @else
                        @foreach($aspirasi->komentars as $comment)
                            <div class="flex gap-3">
                                <div class="w-8 h-8 rounded-full bg-gray-300 flex items-center justify-center text-gray-700 font-bold text-xs flex-shrink-0">
                                    {{ strtoupper(substr($comment->user->full_name ?? $comment->user->name ?? 'U', 0, 2)) }}
                                </div>
                                <div class="flex-1">
                                    <p class="font-semibold text-sm text-gray-900">{{ $comment->user->full_name ?? $comment->user->name }}</p>
                                    <p class="text-sm text-gray-600">{{ $comment->komentar }}</p>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>

                <!-- Add Comment Form -->
                <div class="border-t border-gray-200 pt-4 mt-4">
                    <form action="{{ route('siswa.aspirasi.comment', $aspirasi->id) }}" method="POST" class="space-y-2">
                        @csrf
                        <textarea name="komentar" placeholder="Tambahkan komentar..." rows="3" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                        <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition">Kirim Komentar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
