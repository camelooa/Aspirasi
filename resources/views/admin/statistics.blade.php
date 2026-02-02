@extends('layout.admin')

@section('content')
<div class="p-8 bg-blue-50 min-h-screen">
    <!-- Header Section -->
    <div class="mb-8">
        <h2 class="text-3xl font-bold text-gray-900 mb-2">Statistics</h2>
        <p class="text-gray-600">Lihat statistik dan performa platform Aspirasi</p>
    </div>

    <!-- Stats Cards Section -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Feedback Card -->
        <div class="bg-white rounded-lg shadow p-6">
            <p class="text-gray-600 text-sm mb-2">Total feedback</p>
            <p class="text-3xl font-bold text-gray-900">{{ $totalFeedback }}</p>
            <p class="text-xs text-gray-500 mt-3">Total aspirasi masuk</p>
        </div>

        <!-- Total Feedback Complete Card -->
        <div class="bg-white rounded-lg shadow p-6">
            <p class="text-gray-600 text-sm mb-2">Total feedback Complete</p>
            <p class="text-3xl font-bold text-gray-900">{{ $totalCompleted }}</p>
            <p class="text-xs text-gray-500 mt-3">Aspirasi diselesaikan</p>
        </div>

        <!-- Total Aspirasi Complete Card -->
        <div class="bg-white rounded-lg shadow p-6">
            <p class="text-gray-600 text-sm mb-2">Total feedback In Progress</p>
            <p class="text-3xl font-bold text-gray-900">{{ $totalInProgress }}</p>
            <p class="text-xs text-gray-500 mt-3">Aspirasi sedang diproses</p>
        </div>

        <!-- Total Account Card -->
        <div class="bg-white rounded-lg shadow p-6">
            <p class="text-gray-600 text-sm mb-2">Total Users</p>
            <p class="text-3xl font-bold text-gray-900">{{ $totalUsers }}</p>
            <p class="text-xs text-gray-500 mt-3">Pengguna terdaftar</p>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Aspirasi Website Chart -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="mb-6">
                <h3 class="text-lg font-bold text-gray-900">Statistics</h3>
                <p class="text-gray-600 text-sm">Aspirasi Website</p>
            </div>

            <!-- Legend -->
            <div class="flex gap-4 mb-6">
                <div class="flex items-center gap-2">
                    <div class="w-3 h-3 rounded bg-blue-600"></div>
                    <span class="text-sm text-gray-600">Complete</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-3 h-3 rounded bg-yellow-400"></div>
                    <span class="text-sm text-gray-600">In progress</span>
                </div>
            </div>

            <!-- Bar Chart -->
            <div class="flex items-end justify-between h-64 gap-2">
                @foreach($weeklyData as $day)
                <div class="flex flex-col items-center gap-2 flex-1">
                    <div class="w-full flex gap-1 items-end justify-center" style="height: 200px;">
                        @php
                            $maxCount = 20; // Scale chart relative to a rough max, or make dynamic
                            $completeHeight = min(100, ($day['complete'] / $maxCount) * 100);
                            $progressHeight = min(100, ($day['on_progress'] / $maxCount) * 100);
                        @endphp
                        <div class="bg-blue-600 w-1/2" style="height: {{ $completeHeight > 0 ? $completeHeight : 1 }}%;" title="{{ $day['complete'] }} Completed"></div>
                        <div class="bg-yellow-400 w-1/2" style="height: {{ $progressHeight > 0 ? $progressHeight : 1 }}%;" title="{{ $day['on_progress'] }} In Progress"></div>
                    </div>
                    <span class="text-xs text-gray-600 truncate w-full text-center">{{ $day['day_name'] }}</span>
                </div>
                @endforeach
            </div>

            <!-- Y-axis labels -->
            <div class="flex justify-between mt-4 text-xs text-gray-500 px-1">
                <span>0</span>
                <span>10</span>
                <span>20</span>
                <span>40</span>
            </div>
        </div>

        <!-- Browser Usage Chart -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="mb-6">
                <h3 class="text-lg font-bold text-gray-900">Statistics</h3>
                <p class="text-gray-600 text-sm">Browser usage</p>
            </div>

            <div class="flex items-center justify-between">
                <!-- Pie Chart -->
                <div class="relative w-40 h-40">
                    <svg viewBox="0 0 120 120" class="w-full h-full transform -rotate-90">
                        <!-- Chrome segment (majority) -->
                        <circle cx="60" cy="60" r="50" fill="none" stroke="#6366f1" stroke-width="25" stroke-dasharray="188 314" stroke-dashoffset="0" />
                        <!-- Safari segment -->
                        <circle cx="60" cy="60" r="50" fill="none" stroke="#818cf8" stroke-width="25" stroke-dasharray="78 314" stroke-dashoffset="-188" />
                        <!-- Firefox segment -->
                        <circle cx="60" cy="60" r="50" fill="none" stroke="#a78bfa" stroke-width="25" stroke-dasharray="48 314" stroke-dashoffset="-266" />
                    </svg>
                </div>

                <!-- Legend -->
                <div class="space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="bg-indigo-600 text-white rounded px-2 py-1 text-xs font-bold">
                            Chrome
                        </div>
                        <span class="text-sm font-semibold text-gray-900">12,799</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="bg-indigo-400 text-white rounded px-2 py-1 text-xs font-bold">
                            Safari
                        </div>
                        <span class="text-sm font-semibold text-gray-900">5,324</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="bg-purple-400 text-white rounded px-2 py-1 text-xs font-bold">
                            Firefox
                        </div>
                        <span class="text-sm font-semibold text-gray-900">2,811</span>
                    </div>
                </div>
            </div>

            <div class="mt-6 pt-6 border-t border-gray-200">
                <p class="text-xs text-gray-600">This week</p>
                <p class="text-2xl font-bold text-gray-900">229,293</p>
            </div>
        </div>
    </div>

    <!-- Additional Stats Section -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
        <!-- Aspirasi by Category -->
        <!-- Aspirasi by Category -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-4">Aspirasi by Category</h3>
            <div class="space-y-3">
                @forelse($countsByCategory as $count)
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-600">{{ $count->kategori->category_name ?? 'Unknown' }}</span>
                    <span class="text-sm font-semibold text-gray-900">{{ $count->total }}</span>
                </div>
                @empty
                <p class="text-sm text-gray-500">Belum ada data</p>
                @endforelse
            </div>
        </div>

        <!-- User Activity -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-4">User Activity</h3>
            <div class="space-y-3">
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-600">Aktif hari ini</span>
                    <span class="text-sm font-semibold text-gray-900">{{ $activeToday }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-600">Aktif minggu ini</span>
                    <span class="text-sm font-semibold text-gray-900">{{ $activeThisWeek }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-600">Aktif bulan ini</span>
                    <span class="text-sm font-semibold text-gray-900">{{ $activeThisMonth }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-600">Total Users</span>
                    <span class="text-sm font-semibold text-gray-900">{{ $totalUsers }}</span>
                </div>
            </div>
        </div>

        <!-- Response Rate -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-4">Response Rate</h3>
            <div class="space-y-4">
                <div>
                    <div class="flex justify-between mb-2">
                        <span class="text-sm text-gray-600">Aspirasi Dibalas</span>
                        <span class="text-sm font-semibold text-gray-900">{{ $responseRate }}%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-green-500 h-2 rounded-full" style="width: {{ $responseRate }}%"></div>
                    </div>
                </div>
                <div>
                    <div class="flex justify-between mb-2">
                        <span class="text-sm text-gray-600">Feedback Ditinjau</span>
                        <span class="text-sm font-semibold text-gray-900">{{ $reviewedRate }}%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-blue-500 h-2 rounded-full" style="width: {{ $reviewedRate }}%"></div>
                    </div>
                </div>
                <div>
                    <div class="flex justify-between mb-2">
                        <span class="text-sm text-gray-600">Aspirasi Selesai</span>
                        <span class="text-sm font-semibold text-gray-900">{{ $completedRate }}%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-yellow-500 h-2 rounded-full" style="width: {{ $completedRate }}%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
