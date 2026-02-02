<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <header class="bg-white border-b border-gray-200 sticky top-0 z-40">
        <div class="px-8 py-4">
            <!-- Top Row: Logo and User Info -->
            <div class="flex justify-between items-center mb-4">
                <div class="flex items-center gap-2">
                    <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-blue-600 to-blue-700 flex items-center justify-center">
                        <span class="text-white font-bold text-lg">MA</span>
                    </div>
                    <div>
                        <h1 class="text-lg font-bold text-gray-900">Merdeka Aspirasi</h1>
                    </div>
                </div>
                <nav class="flex gap-1 border-b border-gray-200">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 px-4 py-3 hover:text-gray-900 font-medium transition border-b-2 border-transparent hover:border-gray-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-3m0 0l7-4 7 4M5 9v10a1 1 0 001 1h12a1 1 0 001-1V9m-9 11l4-4m-9-8l4 4"></path>
                    </svg>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('admin.feedback') }}" class="flex items-center gap-2 px-4 py-3 text-gray-700 hover:text-gray-900 font-medium transition border-b-2 border-transparent hover:border-gray-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-2m0 0l-4 2m4-2v2m5-6a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    <span>Feedback</span>
                </a>

                <a href="{{ route('admin.statistics') }}" class="flex items-center gap-2 px-4 py-3 text-gray-700 hover:text-gray-900 font-medium transition border-b-2 border-transparent hover:border-gray-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                    <span>Statistics</span>
                </a>

                <a href="{{ route('admin.log') }}" class="flex items-center gap-2 px-4 py-3 {{ request()->routeIs('admin.log') ? 'text-blue-600 border-blue-600' : 'text-gray-700 border-transparent' }} hover:text-gray-900 font-medium transition border-b-2 hover:border-gray-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span>Log</span>
                </a>

                <a href="{{ route('admin.users.index') }}" class="flex items-center gap-2 px-4 py-3 {{ request()->routeIs('admin.users.*') ? 'text-blue-600 border-blue-600' : 'text-gray-700 border-transparent' }} hover:text-gray-900 font-medium transition border-b-2 hover:border-gray-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                    <span>Data User</span>
                </a>
                <div class="flex items-center gap-4 pl-4 border-l border-gray-200">
                    <div class="flex items-center gap-3">
                        <div class="text-right">
                            <p class="text-sm font-medium text-gray-900">{{ auth()->user()->full_name ?? auth()->user()->name }}</p>
                            <p class="text-xs text-gray-500">Administrator</p>
                        </div>
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center text-white font-bold">
                            {{ strtoupper(substr(auth()->user()->full_name ?? auth()->user()->name ?? 'A', 0, 2)) }}
                        </div>
                    </div>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="flex items-center gap-2 px-3 py-2 text-gray-600 hover:text-red-600 hover:bg-red-50 rounded-lg transition" title="Logout">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </header>
    <main>
        @yield('content')
    </main>
</body>
</html>