@extends('layout.admin')

@section('content')
<div class="p-8">
    <!-- Header Section -->
    <div class="mb-8">
        <h2 class="text-3xl font-bold text-gray-900 mb-2">Feedback</h2>
        <p class="text-gray-600">Kelola dan lihat feedback dari pengguna</p>
    </div>

    <!-- Filter and Search Section -->
    <div class="mb-6">
        <form action="{{ route('admin.feedback') }}" method="GET" class="flex gap-4">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari feedback..." class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            <select name="status" class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" onchange="this.form.submit()">
                <option value="">Semua Status</option>
                <option value="on_progress" {{ request('status') == 'on_progress' ? 'selected' : '' }}>Pending/On Progress</option>
                <option value="complete" {{ request('status') == 'complete' ? 'selected' : '' }}>Selesai</option>
            </select>
            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">Cari</button>
        </form>
    </div>

    <!-- Feedback Table Section -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Pengguna</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Pesan</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Tanggal</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($feedbacks as $feedback)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-sm font-medium text-blue-700">
                                {{ substr($feedback->user->full_name ?? $feedback->user->username ?? 'U', 0, 2) }}
                            </div>
                            <a href="{{ route('admin.feedback.show', $feedback->id) }}" class="hover:text-blue-600 hover:underline">
                                <span class="text-sm font-medium text-gray-900">{{ $feedback->user->full_name ?? $feedback->user->username ?? 'Anonymous' }}</span>
                            </a>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600">
                        <a href="{{ route('admin.feedback.show', $feedback->id) }}" class="hover:text-blue-600 hover:underline">
                            {{ Str::limit($feedback->details, 50) }}
                        </a>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $feedback->created_at->format('d M Y') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $feedback->status === 'complete' ? 'bg-green-100 text-green-800' : ($feedback->status === 'on_progress' ? 'bg-blue-100 text-blue-800' : 'bg-yellow-100 text-yellow-800') }}">
                            {{ ucfirst(str_replace('_', ' ', $feedback->status)) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        <form action="{{ route('admin.feedback.status', $feedback->id) }}" method="POST" class="inline">
                            @csrf
                            <input type="hidden" name="status" value="complete">
                            <button type="submit" class="text-blue-600 hover:text-blue-900 font-medium mr-3">Tandai Selesai</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">Belum ada feedback.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6 flex justify-between items-center">
        <p class="text-sm text-gray-600">
            Menampilkan {{ $feedbacks->firstItem() ?? 0 }} hingga {{ $feedbacks->lastItem() ?? 0 }} dari {{ $feedbacks->total() }} feedback
        </p>
        <div class="flex gap-2">
            {{ $feedbacks->links() }}
        </div>
    </div>
</div>
@endsection
