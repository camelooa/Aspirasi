<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <title>Admin - Merdeka Aspirasi</title>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-gray-100 antialiased">
    <header class="bg-white border-b border-gray-200 sticky top-0 z-40 shadow-sm">
        <div class="px-4 md:px-8 py-4">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                <!-- Logo & Brand -->
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 md:w-12 md:h-12 rounded-2xl flex items-center justify-center overflow-hidden ring-1 ring-gray-100 shadow-sm">
                        <img src="{{ asset('img/logo.jpg') }}" alt="Logo" class="w-full h-full object-cover">
                    </div>
                    <div>
                        <h1 class="text-base md:text-lg font-extrabold text-gray-900 leading-none">Merdeka Aspirasi</h1>
                        <p class="text-[10px] font-bold text-blue-600 uppercase tracking-widest mt-1">Admin Panel</p>
                    </div>
                </div>

                <!-- Navigation & User -->
                <nav class="flex flex-wrap items-center gap-1">
                    <div class="flex flex-wrap items-center gap-1 md:pr-4 md:border-r border-gray-100">
                        <x-nav-link-admin href="{{ route('admin.dashboard') }}" :active="request()->routeIs('admin.dashboard')" icon="M3 12l2-3m0 0l7-4 7 4M5 9v10a1 1 0 001 1h12a1 1 0 001-1V9m-9 11l4-4m-9-8l4 4">Dashboard</x-nav-link-admin>
                        <x-nav-link-admin href="{{ route('admin.feedback') }}" :active="request()->routeIs('admin.feedback*')" icon="M7 8h10M7 12h4m1 8l-4-2m0 0l-4 2m4-2v2m5-6a2 2 0 11-4 0 2 2 0 014 0z">Feedback</x-nav-link-admin>
                        <x-nav-link-admin href="{{ route('admin.log') }}" :active="request()->routeIs('admin.log')" icon="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z">Activity</x-nav-link-admin>
                        <x-nav-link-admin href="{{ route('admin.category-assignments.index') }}" :active="request()->routeIs('admin.category-assignments.*')" icon="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01">Penugasan</x-nav-link-admin>
                        <x-nav-link-admin href="{{ route('admin.users.index') }}" :active="request()->routeIs('admin.users.*')" icon="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">Users</x-nav-link-admin>
                    </div>

                    <!-- User Section -->
                    <div class="flex items-center gap-4 pl-4">
                        <div class="hidden md:block text-right">
                            <p class="text-sm font-bold text-gray-900">{{ auth()->user()->full_name ?? auth()->user()->name }}</p>
                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Administrator</p>
                        </div>
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-600 to-indigo-600 flex items-center justify-center text-white font-extrabold shadow-sm">
                            {{ strtoupper(substr(auth()->user()->full_name ?? auth()->user()->name ?? 'A', 0, 2)) }}
                        </div>
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="p-2.5 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-xl transition duration-300" title="Logout">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                </svg>
                            </button>
                        </form>
                    </div>
                </nav>
            </div>
        </div>
    </header>

    @php
        // Helper component for cleaner links
        if (!function_exists('navLinkAdmin')) {
            // Note: In a real project, this would be a Blade component.
        }
    @endphp

    <main class="min-h-screen">
        @yield('content')
    </main>
</body>
</html>