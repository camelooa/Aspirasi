@extends('layout.admin')

@section('content')
<div class="p-4 md:p-8 space-y-8 bg-gray-50 min-h-screen">
    <!-- Header/Greeting -->
    <div class="relative overflow-hidden rounded-3xl bg-gray-900 p-8 md:p-12 text-white shadow-2xl">
        <div class="absolute right-0 top-0 w-64 h-64 bg-blue-600 bg-opacity-20 filter blur-3xl -mr-20 -mt-20"></div>
        <div class="absolute left-0 bottom-0 w-64 h-64 bg-indigo-600 bg-opacity-10 filter blur-3xl -ml-20 -mb-20"></div>
        
        <div class="relative z-10 flex flex-col md:flex-row justify-between items-center gap-6">
            <div class="text-center md:text-left">
                <h2 class="text-3xl md:text-4xl font-black tracking-tight mb-2">
                    Halo, <span class="text-blue-400">{{ auth()->user()->username ?? 'Administrator' }}</span> 👋
                </h2>
                <p class="text-gray-400 font-medium max-w-md">Panel manajemen aspirasi. Pantau dan tanggapi setiap masukan dari siswa dengan cepat.</p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('admin.feedback') }}" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-2xl font-bold transition-all transform active:scale-95 shadow-lg">
                    Kelola Feedback
                </a>
            </div>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Card -->
        <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow group">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 rounded-2xl bg-blue-50 group-hover:bg-blue-100 flex items-center justify-center transition-colors">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                </div>
                <span class="text-[10px] font-black text-blue-600 bg-blue-50 px-2 py-1 rounded-lg uppercase tracking-tight">Total</span>
            </div>
            <p class="text-4xl font-black text-gray-900 leading-none mb-1">{{ $totalFeedback }}</p>
            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Aspirasi Masuk</p>
        </div>

        <!-- Selesai Card -->
        <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow group">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 rounded-2xl bg-emerald-50 group-hover:bg-emerald-100 flex items-center justify-center transition-colors">
                    <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <span class="text-[10px] font-black text-emerald-600 bg-emerald-50 px-2 py-1 rounded-lg uppercase tracking-tight">Selesai</span>
            </div>
            <p class="text-4xl font-black text-emerald-600 leading-none mb-1">{{ $totalCompleted }}</p>
            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Berhasil Ditangani</p>
        </div>

        <!-- Proses Card -->
        <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow group">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 rounded-2xl bg-amber-50 group-hover:bg-amber-100 flex items-center justify-center transition-colors">
                    <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <span class="text-[10px] font-black text-amber-600 bg-amber-50 px-2 py-1 rounded-lg uppercase tracking-tight">Proses</span>
            </div>
            <p class="text-4xl font-black text-amber-600 leading-none mb-1">{{ $totalInProgress }}</p>
            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Masih Ditinjau</p>
        </div>

        <!-- Users Card -->
        <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow group">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 rounded-2xl bg-purple-50 group-hover:bg-purple-100 flex items-center justify-center transition-colors">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </div>
                <span class="text-[10px] font-black text-purple-600 bg-purple-50 px-2 py-1 rounded-lg uppercase tracking-tight">Akun</span>
            </div>
            <p class="text-4xl font-black text-purple-600 leading-none mb-1">{{ $totalUsers }}</p>
            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Total Pengguna</p>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Weekly Activity -->
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8">
            <div class="flex flex-col sm:flex-row justify-between items-start mb-8 gap-4">
                <div>
                    <h3 class="text-lg font-black text-gray-900 uppercase tracking-tighter">Aktivitas Mingguan</h3>
                    <p class="text-sm text-gray-400 font-medium">Statistik aspirasi 7 hari terakhir</p>
                </div>
                <!-- Legend -->
                <div class="flex gap-4">
                    <div class="flex items-center gap-2">
                        <div class="w-3 h-3 rounded-full bg-blue-600"></div>
                        <span class="text-[10px] font-bold text-gray-500 uppercase">Selesai</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-3 h-3 rounded-full bg-amber-400"></div>
                        <span class="text-[10px] font-bold text-gray-500 uppercase">Proses</span>
                    </div>
                </div>
            </div>

            <!-- Bar Chart -->
            <div class="flex items-end justify-between h-64 gap-2 sm:gap-4 px-2">
                @php
                    $maxVal = max(5, ...array_values(array_map(fn($d) => $d['complete'] + $d['on_progress'], $weeklyData)));
                @endphp
                @foreach($weeklyData as $day)
                <div class="flex flex-col items-center gap-3 flex-1 group">
                    <div class="w-full flex gap-1 items-end justify-center h-48 relative">
                        @php
                            $compPerc = ($day['complete'] / $maxVal) * 100;
                            $progPerc = ($day['on_progress'] / $maxVal) * 100;
                        @endphp
                        <div class="bg-blue-600 w-full max-w-[12px] rounded-t-lg transition-all group-hover:bg-blue-700 relative" style="height: {{ max(1, $compPerc) }}%;" title="{{ $day['complete'] }} Selesai">
                             @if($day['complete'] > 0)
                                <span class="absolute -top-6 left-1/2 -translate-x-1/2 text-[10px] font-black text-blue-600 opacity-0 group-hover:opacity-100 transition-opacity">{{ $day['complete'] }}</span>
                             @endif
                        </div>
                        <div class="bg-amber-400 w-full max-w-[12px] rounded-t-lg transition-all group-hover:bg-amber-500 relative" style="height: {{ max(1, $progPerc) }}%;" title="{{ $day['on_progress'] }} Proses">
                             @if($day['on_progress'] > 0)
                                <span class="absolute -top-6 left-1/2 -translate-x-1/2 text-[10px] font-black text-amber-600 opacity-0 group-hover:opacity-100 transition-opacity">{{ $day['on_progress'] }}</span>
                             @endif
                        </div>
                    </div>
                    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-tighter truncate w-full text-center">{{ substr($day['day_name'], 0, 3) }}</span>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Response Rates -->
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8">
            <h3 class="text-lg font-black text-gray-900 uppercase tracking-tighter mb-8">Efektivitas Pelayanan</h3>
            <div class="space-y-8">
                <div>
                    <div class="flex justify-between items-end mb-3">
                        <span class="text-xs font-black text-gray-400 uppercase tracking-widest">Tingkat Respon Admin</span>
                        <p class="text-2xl font-black text-gray-900">{{ $responseRate }}%</p>
                    </div>
                    <div class="w-full bg-gray-50 rounded-full h-3 overflow-hidden">
                        <div class="bg-emerald-500 h-full rounded-full transition-all duration-1000 shadow-[0_0_10px_rgba(16,185,129,0.3)]" style="width: {{ $responseRate }}%"></div>
                    </div>
                </div>
                <div>
                    <div class="flex justify-between items-end mb-3">
                        <span class="text-xs font-black text-gray-400 uppercase tracking-widest">Feedback Dalam Peninjauan</span>
                        <p class="text-2xl font-black text-gray-900">{{ $reviewedRate }}%</p>
                    </div>
                    <div class="w-full bg-gray-50 rounded-full h-3 overflow-hidden">
                        <div class="bg-blue-500 h-full rounded-full transition-all duration-1000 shadow-[0_0_10px_rgba(59,130,246,0.3)]" style="width: {{ $reviewedRate }}%"></div>
                    </div>
                </div>
                <div>
                    <div class="flex justify-between items-end mb-3">
                        <span class="text-xs font-black text-gray-400 uppercase tracking-widest">Penyelesaian Keluhan</span>
                        <p class="text-2xl font-black text-gray-900">{{ $completedRate }}%</p>
                    </div>
                    <div class="w-full bg-gray-50 rounded-full h-3 overflow-hidden">
                        <div class="bg-amber-400 h-full rounded-full transition-all duration-1000 shadow-[0_0_10px_rgba(251,191,36,0.3)]" style="width: {{ $completedRate }}%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Category & Activity -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
         <!-- Aspirasi by Category -->
         <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8 overflow-hidden h-fit">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-black text-gray-900 uppercase tracking-tighter">Kategori Populer</h3>
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
            </div>
            <div class="space-y-3 max-h-[280px] overflow-y-auto pr-2 custom-scrollbar">
                @forelse($countsByCategory as $count)
                <div class="flex justify-between items-center p-4 bg-gray-50 rounded-2xl hover:bg-gray-100 transition-all group">
                    <span class="text-sm font-bold text-gray-600 group-hover:text-blue-600">{{ $count->kategori->name ?? 'Lainnya' }}</span>
                    <span class="px-3 py-1 bg-white rounded-xl text-xs font-black text-gray-900 shadow-sm border border-gray-100">{{ $count->total }}</span>
                </div>
                @empty
                <div class="text-center py-12 text-gray-400 italic text-sm">Belum ada data kategori.</div>
                @endforelse
            </div>
        </div>

        <!-- User Activity -->
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8 h-fit">
             <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-black text-gray-900 uppercase tracking-tighter">Aktivitas User</h3>
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
            </div>
            <div class="space-y-4">
                <div class="flex justify-between items-center p-5 bg-gradient-to-r from-blue-50 to-transparent border-l-4 border-blue-500 rounded-r-2xl">
                    <div>
                        <span class="text-[10px] font-black text-blue-600 uppercase tracking-widest">Hari Ini</span>
                        <p class="text-sm font-bold text-gray-500">User Aktif</p>
                    </div>
                    <span class="text-2xl font-black text-gray-900">{{ $activeToday }}</span>
                </div>
                <div class="flex justify-between items-center p-5 bg-gradient-to-r from-indigo-50 to-transparent border-l-4 border-indigo-500 rounded-r-2xl">
                    <div>
                        <span class="text-[10px] font-black text-indigo-600 uppercase tracking-widest">Minggu Ini</span>
                        <p class="text-sm font-bold text-gray-500">User Berpartisipasi</p>
                    </div>
                    <span class="text-2xl font-black text-gray-900">{{ $activeThisWeek }}</span>
                </div>
                <div class="flex justify-between items-center p-5 bg-gradient-to-r from-purple-50 to-transparent border-l-4 border-purple-500 rounded-r-2xl">
                    <div>
                        <span class="text-[10px] font-black text-purple-600 uppercase tracking-widest">Bulan Ini</span>
                        <p class="text-sm font-bold text-gray-500">Reach Dashboard</p>
                    </div>
                    <span class="text-2xl font-black text-gray-900">{{ $activeThisMonth }}</span>
                </div>
            </div>
        </div>

        <!-- Recent Actions Quick Link -->
        <div class="bg-gradient-to-br from-indigo-600 via-blue-700 to-blue-800 rounded-3xl shadow-lg p-8 text-white flex flex-col justify-between relative overflow-hidden group">
            <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-white opacity-5 rounded-full group-hover:scale-150 transition-transform duration-700"></div>
            <div class="relative z-10">
                <div class="w-12 h-12 rounded-2xl bg-white bg-opacity-20 flex items-center justify-center mb-6">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <h3 class="text-xl font-black uppercase tracking-tighter mb-2">Butuh Bantuan?</h3>
                <p class="text-blue-100 text-sm font-medium leading-relaxed">Cari aspirasi spesifik atau filter berdasarkan status untuk pengelolaan yang lebih efisien.</p>
            </div>
            <a href="{{ route('admin.feedback') }}" class="relative z-10 mt-8 flex items-center justify-center gap-2 py-4 bg-white text-blue-700 rounded-2xl font-black transition-all hover:bg-blue-50 active:scale-95 shadow-xl">
                CARI FEEDBACK
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
            </a>
        </div>
    </div>

    <!-- Recent Lists -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Selesai List -->
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-8 py-6 border-b border-gray-50 flex justify-between items-center bg-gray-50/30">
                <div class="flex items-center gap-3">
                    <div class="w-2 h-2 rounded-full bg-emerald-500"></div>
                    <h3 class="text-sm font-black text-gray-900 uppercase tracking-widest">Aspirasi Selesai</h3>
                </div>
                <span class="text-[10px] font-bold text-gray-400">3 TERBARU</span>
            </div>
            <div class="divide-y divide-gray-50">
                @forelse($completedAspirations as $aspirasi)
                <div class="p-6 hover:bg-blue-50/30 transition-colors group cursor-pointer" onclick="window.location='{{ route('admin.feedback.show', $aspirasi->id) }}'">
                    <div class="flex items-center gap-4">
                        <div class="flex-shrink-0 w-12 h-12 rounded-2xl bg-emerald-50 flex items-center justify-center text-emerald-600 group-hover:scale-110 transition-transform shadow-sm">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <div class="min-w-0 flex-1">
                            <p class="font-bold text-gray-900 group-hover:text-blue-600 transition-colors truncate text-base">{{ $aspirasi->feedback_title }}</p>
                            <p class="text-xs text-gray-400 line-clamp-1 mt-1 font-medium">{{ $aspirasi->details }}</p>
                        </div>
                        <svg class="w-5 h-5 text-gray-300 group-hover:text-blue-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4"></path></svg>
                    </div>
                </div>
                @empty
                <div class="p-16 text-center text-gray-400 font-medium italic text-sm">Belum ada aspirasi selesai.</div>
                @endforelse
            </div>
        </div>

        <!-- Proses List -->
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-8 py-6 border-b border-gray-50 flex justify-between items-center bg-gray-50/30">
                <div class="flex items-center gap-3">
                    <div class="w-2 h-2 rounded-full bg-amber-500 animate-pulse"></div>
                    <h3 class="text-sm font-black text-gray-900 uppercase tracking-widest">Perlu Tindakan</h3>
                </div>
                <span class="text-[10px] font-bold text-gray-400">PENTING</span>
            </div>
            <div class="divide-y divide-gray-50">
                @forelse($inProgressAspirations as $aspirasi)
                <div class="p-6 hover:bg-blue-50/30 transition-colors group cursor-pointer" onclick="window.location='{{ route('admin.feedback.show', $aspirasi->id) }}'">
                    <div class="flex items-center gap-4">
                        <div class="flex-shrink-0 w-12 h-12 rounded-2xl bg-amber-50 flex items-center justify-center text-amber-600 group-hover:scale-110 transition-transform shadow-sm">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div class="min-w-0 flex-1">
                            <p class="font-bold text-gray-900 group-hover:text-blue-600 transition-colors truncate text-base">{{ $aspirasi->feedback_title }}</p>
                            <p class="text-xs text-gray-400 line-clamp-1 mt-1 font-medium">{{ $aspirasi->details }}</p>
                        </div>
                        <svg class="w-5 h-5 text-gray-300 group-hover:text-amber-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </div>
                </div>
                @empty
                <div class="p-16 text-center text-gray-400 font-medium italic text-sm">
                    <p class="mb-2">Semua tertangani! 🎉</p>
                    <p class="text-[10px] text-gray-300 not-italic uppercase tracking-widest font-black">Good Job, Admin!</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<style>
.custom-scrollbar::-webkit-scrollbar {
    width: 6px;
}
.custom-scrollbar::-webkit-scrollbar-track {
    background: transparent;
}
.custom-scrollbar::-webkit-scrollbar-thumb {
    background: #e5e7eb;
    border-radius: 10px;
}
.custom-scrollbar::-webkit-scrollbar-thumb:hover {
    background: #d1d5db;
}
</style>
@endsection
