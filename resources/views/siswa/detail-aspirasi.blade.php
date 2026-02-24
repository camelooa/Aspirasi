@php
use Illuminate\Support\Str;
@endphp

@extends('layout.siswa')

@section('content')
<div class="min-h-screen py-8 bg-cyan-50">
    <div class="max-w-6xl mx-auto px-4">
        <a href="javascript:history.back()" class="text-blue-600 hover:text-blue-900 mb-4 inline-block">← Kembali</a>

            <!-- Center: Aspirasi Detail -->
            <div class="lg:col-span-3">
                <div class="max-w-4xl mx-auto">
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
                                <p class="font-semibold text-gray-900">{{ $aspirasi->admin->full_name ?? $aspirasi->admin->username ?? 'Tim Merdeka Aspirasi' }}</p>
                            </div>
                            <p class="text-gray-700 ml-14">{{ $aspirasi->admin_response }}</p>
                        </div>
                    @endif
                </div>
                </div>
            </div>
    </div>
</div>
@endsection
