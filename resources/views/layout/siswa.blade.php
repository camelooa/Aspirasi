<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700;800&family=DM+Sans:ital,opsz,wght@0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;1,9..40,400&display=swap" rel="stylesheet">
    <title>Merdeka Aspirasi - Siswa</title>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        display: ['"Sora"', 'sans-serif'],
                        body: ['"DM Sans"', 'sans-serif'],
                    },
                    colors: {
                        navy: {
                            900: '#071525',
                            800: '#0C2240',
                            700: '#112F55',
                            600: '#163D6B',
                        },
                        sand: {
                            50: '#FDFBF7',
                            100: '#F7F3EB',
                            200: '#EDE7DA',
                        },
                    }
                }
            }
        }
    </script>

    <style>
        :root {
            --navy: #0C2240;
            --navy-deep: #071525;
            --amber: #E5A411;
            --bg: #F4F1EB;
            --card: #FFFFFF;
            --text: #0F172A;
            --muted: #64748B;
            --dim: #94A3B8;
            --border: #E2DDD5;
            --border-h: #CBD5E1;
            --accent: #1D6DB5;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--bg);
            color: var(--text);
        }

        .cross-bg {
            background-image:
                linear-gradient(rgba(0,0,0,0.018) 1px, transparent 1px),
                linear-gradient(90deg, rgba(0,0,0,0.018) 1px, transparent 1px);
            background-size: 28px 28px;
        }

        .card {
            background: var(--card);
            border: 1px solid rgba(226,221,213,0.95);
            border-radius: 16px;
        }

        .fi {
            border: 1.5px solid var(--border);
            border-left: 3.5px solid var(--border);
            border-radius: 12px;
            transition: all .28s ease;
            background: var(--card);
        }
        .fi:hover { border-color: var(--border-h); border-left-color: var(--border-h); }
        .fi:focus {
            border-color: var(--accent);
            border-left-color: var(--amber);
            box-shadow: 0 0 0 3px rgba(29,109,181,.07);
            outline: none;
        }

        .btn {
            background: var(--navy);
            transition: all .28s cubic-bezier(.16,1,.3,1);
        }
        .btn:hover {
            background: var(--navy-deep);
            transform: translateY(-1px);
            box-shadow: 0 10px 26px rgba(7,21,37,.18);
        }
        .btn:active {
            transform: translateY(0) scale(.985);
            box-shadow: 0 4px 12px rgba(7,21,37,.14);
        }

        .btn-soft {
            background: rgba(12,34,64,0.06);
            color: var(--navy);
            border: 1px solid rgba(12,34,64,0.12);
            transition: all .22s ease;
        }
        .btn-soft:hover { background: rgba(12,34,64,0.1); }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                animation-duration: .01ms !important;
                transition-duration: .01ms !important;
            }
        }

        ::-webkit-scrollbar { width: 5px; }
        ::-webkit-scrollbar-track { background: var(--bg); }
        ::-webkit-scrollbar-thumb { background: var(--border); border-radius: 3px; }
    </style>
</head>
<body class="min-h-screen antialiased">
    <header class="sticky top-0 z-40 border-b border-black/[0.04] bg-white/75 backdrop-blur">
        <div class="max-w-7xl mx-auto px-4 md:px-8 py-4">
            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-5">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 md:w-12 md:h-12 rounded-2xl overflow-hidden ring-1 ring-black/[0.05] shadow-sm bg-white">
                        <img src="{{ asset('img/logo.jpg') }}" alt="Logo" class="w-full h-full object-cover">
                    </div>
                    <div>
                        <h1 class="font-display text-base md:text-lg font-extrabold text-gray-900 leading-none tracking-tight">Merdeka Aspirasi</h1>
                        <p class="text-[10px] font-bold uppercase tracking-[0.18em] mt-1" style="color: var(--accent);">Siswa</p>
                    </div>
                </div>

                <nav class="flex flex-wrap items-center gap-2">
                    <div class="flex flex-wrap items-center gap-1.5 lg:pr-4 lg:border-r border-black/[0.05]">
                        <x-nav-link-siswa href="{{ route('siswa.dashboard') }}" :active="request()->routeIs('siswa.dashboard')" icon="M3 12l2-3m0 0l7-4 7 4M5 9v10a1 1 0 001 1h12a1 1 0 001-1V9m-9 11l4-4m-9-8l4 4">Dashboard</x-nav-link-siswa>
                        <x-nav-link-siswa href="{{ route('siswa.aspirasisaya') }}" :active="request()->routeIs('siswa.aspirasisaya') || request()->routeIs('siswa.aspirasi.show')" icon="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4a1 1 0 011-1h16a1 1 0 011 1v2.757a1 1 0 01-.105.447l-3.423 5.134a1 1 0 00-.105.447v2.757a1 1 0 01-1 1h-10a1 1 0 01-1-1v-2.757a1 1 0 00-.105-.447L3.106 7.204A1 1 0 013 6.757V4z">Aspirasi Saya</x-nav-link-siswa>
                    </div>

                    <div class="flex items-center gap-4 lg:pl-4">
                        <div class="hidden lg:block text-right">
                            <p class="text-sm font-bold text-gray-900 leading-none">{{ auth()->user()->full_name ?? auth()->user()->name }}</p>
                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.18em] mt-1">Siswa</p>
                        </div>
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center text-white font-extrabold shadow-sm" style="background: linear-gradient(165deg, #071525 0%, #0C2240 55%, #163D6B 100%);">
                            {{ strtoupper(substr(auth()->user()->full_name ?? auth()->user()->name ?? 'A', 0, 2)) }}
                        </div>
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="p-2.5 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-xl transition duration-200" title="Logout">
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

    <main class="cross-bg min-h-[calc(100vh-76px)]">
        @yield('content')
    </main>
</body>
</html>