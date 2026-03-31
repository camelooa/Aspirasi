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

        /* Details/summary (dropdown) */
        summary::-webkit-details-marker { display: none; }
    </style>
</head>
<body class="min-h-screen antialiased">
    <header class="sticky top-0 z-40 border-b border-black/[0.04] bg-white/75 backdrop-blur shadow-sm">
        <div class="max-w-7xl mx-auto px-4 md:px-8 py-4">
            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-5">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 md:w-10 md:h-10 rounded-2xl overflow-hidden ring-1 ring-black/[0.05] shadow-sm bg-white">
                        <img src="{{ asset('img/logo.jpg') }}" alt="Logo" class="w-full h-full object-cover">
                    </div>
                    <div>
                        <h1 class="font-display text-base md:text-lg font-extrabold text-gray-900 leading-none tracking-tight">Merdeka Aspirasi</h1>
                        <p class="text-[10px] font-bold uppercase tracking-[0.18em] mt-1" style="color: var(--accent);">Siswa</p>
                    </div>
                </div>

                <nav class="flex flex-wrap items-center gap-2">
                    <div class="flex flex-wrap items-center gap-1.5 lg:pr-4 lg:border-r border-black/[0.05]">
                        <x-nav-link-siswa href="{{ route('siswa.dashboard') }}" :active="request()->routeIs('siswa.dashboard')" icon="M3 9.75L12 4l9 5.75V20a1 1 0 01-1 1h-5v-6a2 2 0 00-2-2h-2a2 2 0 00-2 2v6H4a1 1 0 01-1-1V9.75z">Dashboard</x-nav-link-siswa>
                        <x-nav-link-siswa href="{{ route('siswa.aspirasisaya') }}" :active="request()->routeIs('siswa.aspirasisaya') || request()->routeIs('siswa.aspirasi.show')" icon="M9 5h6a2 2 0 012 2v12a2 2 0 01-2 2H9a2 2 0 01-2-2V7a2 2 0 012-2zm0 4h6m-6 4h6m-6 4h3">Aspirasi Saya</x-nav-link-siswa>
                    </div>

                    <div class="flex items-center gap-3 lg:pl-4">
                        <!-- Notifications (responses) -->
                        <a href="{{ route('siswa.aspirasisaya') }}" class="relative p-2.5 text-slate-500 hover:text-slate-900 hover:bg-black/[0.03] rounded-xl transition-colors duration-150 ease-out" title="Notifikasi">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 10-12 0v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0a3 3 0 01-6 0m6 0H9" />
                            </svg>
                            <span class="absolute -top-0.5 -right-0.5 min-w-[18px] h-[18px] px-1 rounded-full text-[10px] leading-[18px] font-extrabold text-white text-center bg-red-600">
                                {{ $siswaNotificationCount ?? 0 }}
                            </span>
                        </a>

                        <!-- User dropdown -->
                        <details class="relative">
                            <summary class="list-none cursor-pointer flex items-center gap-3 rounded-2xl px-2 py-1.5 hover:bg-black/[0.03] transition-colors duration-150 ease-out">
                                <div class="w-9 h-9 rounded-full flex items-center justify-center text-white font-extrabold shadow-sm" style="background: linear-gradient(165deg, #071525 0%, #0C2240 55%, #163D6B 100%);">
                                    {{ strtoupper(substr(auth()->user()->full_name ?? auth()->user()->name ?? 'A', 0, 2)) }}
                                </div>
                                <div class="hidden lg:block leading-tight">
                                    <p class="text-[13px] font-bold text-slate-700">{{ auth()->user()->full_name ?? auth()->user()->name }}</p>
                                    <p class="text-[11px] font-semibold text-slate-400">Siswa</p>
                                </div>
                                <svg class="hidden lg:block w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </summary>

                            <div class="absolute right-0 mt-2 w-56 card shadow-sm p-2 z-50">
                                <a href="#" onclick="return false;" class="flex items-center gap-2 px-3 py-2 rounded-xl text-sm font-semibold text-slate-700 hover:bg-black/[0.03] transition-colors duration-150 ease-out">
                                    <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                    Profile
                                </a>
                                <a href="#" onclick="return false;" class="flex items-center gap-2 px-3 py-2 rounded-xl text-sm font-semibold text-slate-700 hover:bg-black/[0.03] transition-colors duration-150 ease-out">
                                    <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100 4m0-4a2 2 0 110 4m12-4a2 2 0 100 4m0-4a2 2 0 110 4M6 12H4m2 0a2 2 0 104 0m-4 0a2 2 0 114 0m10 0h2m-2 0a2 2 0 104 0m-4 0a2 2 0 114 0M12 20v-2m0 2a2 2 0 100-4m0 4a2 2 0 110-4"/></svg>
                                    Pengaturan
                                </a>
                                <div class="my-1 h-px bg-black/[0.06]"></div>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-full flex items-center gap-2 px-3 py-2 rounded-xl text-sm font-semibold text-red-600 hover:bg-red-50 transition-colors duration-150 ease-out">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                        Keluar
                                    </button>
                                </form>
                            </div>
                        </details>
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