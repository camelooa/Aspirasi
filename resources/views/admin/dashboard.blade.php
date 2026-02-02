@extends('layout.admin')

@section('content')
        <!-- PAGE CONTENT -->
        <div class="p-8">
            <!-- GREETING BANNER -->
            <div class="bg-gradient-to-r from-slate-900 to-slate-800 rounded-2xl p-8 mb-8 text-white">
                <div class="flex justify-between items-start">
                    <div>
                        <h2 class="text-3xl font-bold mb-2 text-black">Halo, {{ auth()->user()->full_name ?? auth()->user()->name ?? 'Administrator' }} 👋</h2>
                    </div>
                </div>
            </div>

            <!-- STATS GRID -->
            <div class="grid grid-cols-4 gap-6 mb-8">
                <div class="bg-white rounded-lg border border-gray-200 p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 rounded-lg bg-blue-100 flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m0 0l8 4m-8-4v10l8 4m0-10l8 4m-8-4v10"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="text-3xl font-bold text-gray-900">{{ $totalCompleted }}</p>
                    <p class="text-sm text-gray-500 mt-1">Total Aspirasi Siswa</p>
                </div>


                <div class="bg-white rounded-lg border border-gray-200 p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 rounded-lg bg-amber-100 flex items-center justify-center">
                            <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="text-3xl font-bold text-gray-900">{{ $totalInProgress }}</p>
                    <p class="text-sm text-gray-500 mt-1">Sedang Diproses</p>
                </div>
                </div>
            <!-- ASPIRASI SECTIONS -->
            <div class="grid grid-cols-2 gap-8">
                <!-- COMPLETED ASPIRATIONS -->
                <div class="bg-white rounded-lg border border-gray-200 p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-bold text-gray-900">Aspirasi Selesai</h3>
                        <a href="{{ route('admin.feedback') }}" class="text-sm text-blue-600 hover:text-blue-700 font-medium">Lihat Semua →</a>
                    </div>

                    <div class="space-y-4">
                        @forelse($completedAspirations as $aspirasi)
                        <div class="flex items-start gap-4 p-4 hover:bg-gray-50 rounded-lg transition">
                            <div class="w-10 h-10 rounded-lg bg-emerald-100 flex items-center justify-center flex-shrink-0 mt-1">
                                <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="font-medium text-gray-900 truncate">{{ $aspirasi->feedback_title }}</p>
                                <p class="text-sm text-gray-500 line-clamp-1">{{ $aspirasi->details }}</p>
                            </div>
                        </div>
                        @empty
                        <p class="text-gray-500 text-center py-4">Belum ada aspirasi selesai.</p>
                        @endforelse
                    </div>
                </div>

                <!-- IN PROGRESS ASPIRATIONS -->
                <div class="bg-white rounded-lg border border-gray-200 p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-bold text-gray-900">Akselerasi Proses</h3>
                        <a href="{{ route('admin.feedback') }}" class="text-sm text-blue-600 hover:text-blue-700 font-medium">Lihat Semua →</a>
                    </div>

                    <div class="space-y-4">
                        @forelse($inProgressAspirations as $aspirasi)
                        <div class="flex items-start gap-4 p-4 hover:bg-gray-50 rounded-lg transition">
                            <div class="w-10 h-10 rounded-lg bg-amber-100 flex items-center justify-center flex-shrink-0 mt-1">
                                <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="font-medium text-gray-900 truncate">{{ $aspirasi->feedback_title }}</p>
                                <p class="text-sm text-gray-500 line-clamp-1">{{ $aspirasi->details }}</p>
                            </div>
                        </div>
                        @empty
                        <p class="text-gray-500 text-center py-4">Belum ada aspirasi diproses.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
@endsection
