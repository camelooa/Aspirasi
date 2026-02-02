@extends('layout.admin')

@section('content')
<div class="p-8 bg-gray-50 min-h-screen">
    <!-- Header Section -->
    <div class="mb-8">
        <h2 class="text-3xl font-bold text-gray-900 mb-2">Log Aktivitas</h2>
        <p class="text-gray-600">Daftar lengkap aspirasi yang telah dikirimkan</p>
    </div>

    <!-- Filter and Search Section -->
    <div class="mb-6 flex flex-col md:flex-row gap-4">
        <input type="text" placeholder="Cari nama pengguna atau pesan..." class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        <select class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 md:w-48">
            <option value="">Semua Kategori</option>
            <option value="pendidikan">Pendidikan</option>
            <option value="infrastruktur">Infrastruktur</option>
            <option value="kesehatan">Kesehatan</option>
            <option value="keamanan">Keamanan</option>
            <option value="lainnya">Lainnya</option>
        </select>
        <select class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 md:w-40">
            <option value="">Semua Status</option>
            <option value="pending">Pending</option>
            <option value="on_progress">Sedang Diproses</option>
            <option value="complete">Selesai</option>
        </select>
    </div>

    <!-- Logs Table Section -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">No</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Pengguna</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Judul Aspirasi</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Kategori</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Tanggal Kirim</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($logs as $index => $log)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $logs->firstItem() + $index }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-sm font-medium text-blue-700">
                                    {{ substr($log->user->name ?? 'User', 0, 2) }}
                                </div>
                                <span class="text-sm font-medium text-gray-900">{{ $log->user->name ?? 'Anonymous' }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $log->feedback_title }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $log->kategori->category_name ?? 'Lainnya' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $log->status === 'complete' ? 'bg-green-100 text-green-800' : ($log->status === 'on_progress' ? 'bg-blue-100 text-blue-800' : 'bg-yellow-100 text-yellow-800') }}">
                                {{ ucfirst(str_replace('_', ' ', $log->status)) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $log->created_at->format('d M Y - H:i') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <button class="text-blue-600 hover:text-blue-900 font-medium">Lihat</button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-4 text-center text-gray-500">Belum ada log aktivitas.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <div class="mt-6 flex justify-between items-center">
    <!-- Pagination -->
    <div class="mt-6 flex justify-between items-center">
        <p class="text-sm text-gray-600">
            Menampilkan {{ $logs->firstItem() ?? 0 }} hingga {{ $logs->lastItem() ?? 0 }} dari {{ $logs->total() }} log aktivitas
        </p>
        <div class="flex gap-2">
            {{ $logs->links() }}
        </div>
    </div>
    </div>
</div>
@endsection
