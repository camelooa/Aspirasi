@extends('layout.siswa')

@section('content')
<div class="p-8 bg-gradient-to-br from-blue-50 to-indigo-50 min-h-screen">
    <!-- Welcome Section -->
    <div class="mb-8">
        <h2 class="text-3xl font-bold text-gray-900 mb-2">Selamat Datang, {{ auth()->user()->full_name ?? auth()->user()->name }}!</h2>
        <p class="text-gray-600">Platform untuk menyuarakan aspirasi dan ide-ide konstruktif Anda</p>
    </div>

    <!-- Quick Action Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        <!-- Create Aspirasi Card -->
        <a href="{{ route('siswa.buataspirasi') }}" class="block bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 rounded-lg bg-blue-100 flex items-center justify-center">
                    <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-gray-900">Buat Aspirasi Baru</h3>
                    <p class="text-sm text-gray-600">Sampaikan ide Anda sekarang</p>
                </div>
            </div>
        </a>

        <!-- My Aspirations Card -->
        <a href="{{ route('siswa.aspirasisaya') }}" class="block bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 rounded-lg bg-green-100 flex items-center justify-center">
                    <svg class="w-7 h-7 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-gray-900">Aspirasi Saya</h3>
                    <p class="text-sm text-gray-600">Lihat semua aspirasi Anda</p>
                </div>
            </div>
        </a>

        <!-- Aspirasi Orang Lain Card -->
        <a href="{{ route('siswa.aspirasioranglain') }}" class="block bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 rounded-lg bg-purple-100 flex items-center justify-center">
                    <svg class="w-7 h-7 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-2m0 0l-4 2m4-2v2m5-6a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-gray-900">Aspirasi orang lain</h3>
                    <p class="text-sm text-gray-600">Liat aspirasi orang lain</p>
                </div>
            </div>
        </a>
    </div>

    <!-- Stats Section -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Aspirasi -->
        <div class="bg-white rounded-lg shadow p-6">
            <p class="text-gray-600 text-sm mb-2">Total Aspirasi Saya</p>
            <p class="text-3xl font-bold text-gray-900">{{ $totalAspirasi }}</p>
            <p class="text-xs text-gray-500 mt-3">Total aspirasi dikirim</p>
        </div>

        <!-- Approved Aspirasi -->
        <div class="bg-white rounded-lg shadow p-6">
            <p class="text-gray-600 text-sm mb-2">Aspirasi Disetujui</p>
            <p class="text-3xl font-bold text-green-600">{{ $aspirasiComplete }}</p>
            <p class="text-xs text-gray-500 mt-3">Selesai diproses</p>
        </div>

        <!-- Pending Aspirasi -->
        <div class="bg-white rounded-lg shadow p-6">
            <p class="text-gray-600 text-sm mb-2">Aspirasi Pending</p>
            <p class="text-3xl font-bold text-yellow-600">{{ $aspirasiPending }}</p>
            <p class="text-xs text-gray-500 mt-3">Menunggu verifikasi/proses</p>
        </div>

        <!-- My Rank -->
        <div class="bg-white rounded-lg shadow p-6">
            <p class="text-gray-600 text-sm mb-2">Peringkat Kontributor</p>
            <p class="text-3xl font-bold text-blue-600">#5</p>
            <p class="text-xs text-gray-500 mt-3">Dari 250 siswa aktif</p>
        </div>
    </div>

    <!-- Latest Aspirations Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Recent Aspirasi List -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-bold text-gray-900">Aspirasi Terbaru Saya</h3>
                </div>
                <div class="divide-y divide-gray-200">
                <div class="divide-y divide-gray-200">
                    @forelse($latestAspirasi as $aspirasi)
                    <a href="{{ route('siswa.aspirasi.show', $aspirasi->id) }}" class="block p-6 hover:bg-gray-50 transition cursor-pointer">
                        <div class="flex justify-between items-start mb-2">
                            <h4 class="font-bold text-gray-900">{{ $aspirasi->feedback_title }}</h4>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $aspirasi->status === 'complete' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                {{ ucfirst(str_replace('_', ' ', $aspirasi->status)) }}
                            </span>
                        </div>
                        <p class="text-sm text-gray-600 mb-3">{{ Str::limit($aspirasi->details, 150) }}</p>
                        <div class="flex gap-4 text-xs text-gray-500">
                            <span>📅 {{ $aspirasi->created_at->format('d M Y') }}</span>
                            <span>📂 {{ $aspirasi->kategori->name ?? 'Kategori' }}</span>
                            <span>💬 {{ $aspirasi->komentars->count() }} Komentar</span>
                        </div>
                    </a>
                    @empty
                    <div class="p-6 text-center text-gray-500">Belum ada aspirasi.</div>
                    @endforelse
                </div>
                <div class="px-6 py-3 border-t border-gray-200 bg-gray-50 text-center">
                    <a href="#" class="text-blue-600 hover:text-blue-900 font-medium text-sm">Lihat Semua Aspirasi →</a>
                </div>
            </div>
        </div>

        <!-- Right Sidebar -->
        <div class="space-y-6">
            <!-- Categories -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="font-bold text-gray-900 mb-4">Kategori Populer</h3>
                <div class="space-y-3">
                    <div class="flex items-center justify-between p-2 hover:bg-gray-50 rounded cursor-pointer">
                        <span class="text-sm text-gray-600">Pendidikan</span>
                        <span class="text-xs font-semibold text-gray-700 bg-gray-100 px-2 py-1 rounded">45</span>
                    </div>
                    <div class="flex items-center justify-between p-2 hover:bg-gray-50 rounded cursor-pointer">
                        <span class="text-sm text-gray-600">Infrastruktur</span>
                        <span class="text-xs font-semibold text-gray-700 bg-gray-100 px-2 py-1 rounded">32</span>
                    </div>
                    <div class="flex items-center justify-between p-2 hover:bg-gray-50 rounded cursor-pointer">
                        <span class="text-sm text-gray-600">Kesehatan</span>
                        <span class="text-xs font-semibold text-gray-700 bg-gray-100 px-2 py-1 rounded">28</span>
                    </div>
                    <div class="flex items-center justify-between p-2 hover:bg-gray-50 rounded cursor-pointer">
                        <span class="text-sm text-gray-600">Keamanan</span>
                        <span class="text-xs font-semibold text-gray-700 bg-gray-100 px-2 py-1 rounded">15</span>
                    </div>
                </div>
            </div>

            <!-- Tips -->
            <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg shadow p-6 text-white">
                <h3 class="font-bold mb-3">💡 Tips</h3>
                <ul class="space-y-2 text-sm">
                    <li>✓ Tulislah aspirasi dengan jelas dan terperinci</li>
                    <li>✓ Pilih kategori yang sesuai</li>
                    <li>✓ Berikan solusi atau saran konstruktif</li>
                    <li>✓ Hormati pendapat orang lain</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
