<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Merdeka Aspirasi - Student Dashboard</title>
</head>
<body class="bg-gray-100 antialiased">
    <header class="bg-white border-b border-gray-200 sticky top-0 z-40">
        <div class="px-8 py-4">
            <!-- Top Row: Logo and User Info -->
            <div class="flex justify-between items-center">
                <div class="flex items-center gap-2">
                    <div class="w-12 h-12 rounded-lg flex items-center justify-center overflow-hidden">
                        <img src="{{ asset('img/logo.jpg') }}" alt="Logo" class="w-full h-full object-cover">
                    </div>
                    <div>
                        <h1 class="text-lg font-bold text-gray-900">Merdeka Aspirasi</h1>
                    </div>
                </div>
                <nav class="flex gap-1 items-center">
                    <a href="{{ route('siswa.dashboard') }}" class="flex items-center gap-2 px-4 py-3 text-gray-700 hover:text-gray-900 font-medium transition border-b-2 border-transparent hover:border-gray-300">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-3m0 0l7-4 7 4M5 9v10a1 1 0 001 1h12a1 1 0 001-1V9m-9 11l4-4m-9-8l4 4"></path>
                        </svg>
                        <span>Dashboard</span>
                    </a>

                    <a href="{{ route('siswa.aspirasisaya') }}" class="flex items-center gap-2 px-4 py-3 text-gray-700 hover:text-gray-900 font-medium transition border-b-2 border-transparent hover:border-gray-300">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4a1 1 0 011-1h16a1 1 0 011 1v2.757a1 1 0 01-.105.447l-3.423 5.134a1 1 0 00-.105.447v2.757a1 1 0 01-1 1h-10a1 1 0 01-1-1v-2.757a1 1 0 00-.105-.447L3.106 7.204A1 1 0 013 6.757V4z"></path>
                        </svg>
                        <span>Aspirasi Saya</span>
                    </a>

                    <div class="flex items-center gap-4 pl-4 border-l border-gray-200">
                        <div class="text-right">
                            <p class="text-sm font-medium text-gray-900">{{ auth()->user()->full_name ?? auth()->user()->name }}</p>
                            <p class="text-xs text-gray-500">Siswa</p>
                        </div>
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center text-white font-bold">
                            {{ strtoupper(substr(auth()->user()->full_name ?? auth()->user()->name ?? 'A', 0, 2)) }}
                        </div>
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="ml-2 text-gray-500 hover:text-red-600 transition">
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
    <main>
        @yield('content')
    </main>

    @include('partials.chatbot')
</body>
</html>