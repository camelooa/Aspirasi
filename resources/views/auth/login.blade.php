<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Merdeka Aspirasi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700;800&family=DM+Sans:ital,opsz,wght@0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;1,9..40,400&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>

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
                        slate2: {
                            750: '#293548',
                        }
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

        body { font-family: 'DM Sans', sans-serif; background: var(--bg); }

        /* ── Dot grid ── */
        .dot-grid {
            background-image: radial-gradient(rgba(255,255,255,0.05) 1px, transparent 1px);
            background-size: 22px 22px;
        }

        /* ── Cross pattern (right panel) ── */
        .cross-bg {
            background-image:
                linear-gradient(rgba(0,0,0,0.018) 1px, transparent 1px),
                linear-gradient(90deg, rgba(0,0,0,0.018) 1px, transparent 1px);
            background-size: 28px 28px;
        }

        /* ── Decorative ring slow rotation ── */
        .ring-spin {
            animation: ringSpin 50s linear infinite;
        }
        @keyframes ringSpin {
            to { transform: rotate(360deg); }
        }

        /* ── Glow pulse ── */
        .glow-pulse {
            animation: glowPulse 6s ease-in-out infinite;
        }
        @keyframes glowPulse {
            0%, 100% { opacity: .6; transform: scale(1); }
            50% { opacity: 1; transform: scale(1.08); }
        }

        /* ── Entrance animations ── */
        .ent { animation: entUp .65s cubic-bezier(.16,1,.3,1) both; }
        .ent-d1 { animation-delay: .1s; }
        .ent-d2 { animation-delay: .22s; }
        .ent-d3 { animation-delay: .34s; }
        .ent-d4 { animation-delay: .46s; }
        @keyframes entUp {
            from { opacity: 0; transform: translateY(24px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* ── Input: left-border accent ── */
        .fi {
            border: 1.5px solid var(--border);
            border-left: 3.5px solid var(--border);
            border-radius: 10px;
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
        .fi::placeholder { color: #B8B2A8; }

        .ig label { transition: color .25s; }
        .ig:focus-within label { color: var(--accent) !important; }
        .ig:focus-within .fi-ic { color: var(--accent) !important; }
        .fi-ic { transition: color .25s; }

        /* ── Button ── */
        .btn {
            background: var(--navy);
            transition: all .28s cubic-bezier(.16,1,.3,1);
        }
        .btn:hover {
            background: var(--navy-deep);
            transform: translateY(-1.5px);
            box-shadow: 0 8px 24px rgba(7,21,37,.22);
        }
        .btn:active {
            transform: translateY(0) scale(.985);
            box-shadow: 0 3px 10px rgba(7,21,37,.18);
        }

        /* ── Password toggle ── */
        .pw-tog { transition: color .2s; cursor: pointer; }
        .pw-tog:hover { color: var(--accent); }

        /* ── Error shake ── */
        .err-shake { animation: shake .42s ease; }
        @keyframes shake {
            0%,100% { transform: translateX(0); }
            20% { transform: translateX(-6px); }
            40% { transform: translateX(6px); }
            60% { transform: translateX(-3px); }
            80% { transform: translateX(3px); }
        }

        /* ── Back link ── */
        .back-link:hover .back-arrow { transform: translateX(-3px); }
        .back-arrow { transition: transform .2s ease; }

        /* ── Reduced motion ── */
        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                animation-duration: .01ms !important;
                transition-duration: .01ms !important;
            }
        }

        /* ── Scrollbar ── */
        ::-webkit-scrollbar { width: 5px; }
        ::-webkit-scrollbar-track { background: var(--bg); }
        ::-webkit-scrollbar-thumb { background: var(--border); border-radius: 3px; }
    </style>
</head>

<body class="min-h-screen">
    <section class="min-h-screen flex items-center justify-center p-5 sm:p-10 relative cross-bg">
        <div class="w-full max-w-[440px] relative z-10">
            <div class="ent rounded-[26px] shadow-sm" style="background: var(--card); border: 1px solid var(--border);">
                <div class="p-7 sm:p-9">
                    <!-- Brand header -->
                    <div class="flex items-center gap-3">
                        <div class="w-11 h-11 rounded-2xl overflow-hidden ring-1 ring-black/[0.06] shadow-sm bg-white">
                            <img src="{{ asset('img/logo.jpg') }}" alt="Logo" class="w-full h-full object-cover">
                        </div>
                        <div class="min-w-0">
                            <p class="font-display font-extrabold text-gray-900 leading-none tracking-tight">Merdeka Aspirasi</p>
                            <p class="text-[11px] font-bold mt-1" style="color: var(--muted);">Laporkan masalah sarana & prasarana</p>
                        </div>
                    </div>

                    <!-- Heading -->
                    <div class="mt-8 ent ent-d1">
                        <h1 class="font-display text-[24px] sm:text-[26px] font-bold text-gray-900 leading-tight tracking-tight">Masuk ke akun Anda</h1>
                    </div>

                    <!-- Error alert -->
                    @if ($errors->any())
                        <div class="err-shake mt-5 p-3.5 rounded-xl flex items-start gap-3 ent ent-d1" style="background: #FEF2F2; border: 1px solid rgba(239,68,68,0.15);">
                            <div class="w-5 h-5 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5" style="background: rgba(239,68,68,0.1);">
                                <i data-lucide="x" class="w-3 h-3" style="color: #EF4444;"></i>
                            </div>
                            <span class="text-[12px] font-medium leading-relaxed" style="color: #B91C1C;">{{ $errors->first() }}</span>
                        </div>
                    @endif

                    <!-- Form -->
                    <form action="{{ route('login.process') }}" method="POST" class="mt-6 space-y-5 sm:space-y-6 ent ent-d2" novalidate>
                        @csrf

                        <!-- Email -->
                        <div class="ig">
                            <label for="email" class="block text-[11px] font-semibold text-gray-500 mb-2 ml-0.5 uppercase tracking-wider">Email Address</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-3.5 flex items-center pointer-events-none">
                                    <i data-lucide="at-sign" class="fi-ic w-[16px] h-[16px] text-gray-400"></i>
                                </div>
                                <input id="email" type="email" name="email"
                                       placeholder="nama@sekolah.id"
                                       value="{{ old('email') }}"
                                       autocomplete="email"
                                       class="fi w-full pl-10 pr-4 py-3.5 text-[13.5px] text-gray-900 font-medium">
                            </div>
                        </div>

                        <!-- Password -->
                        <div class="ig">
                            <label for="password" class="block text-[11px] font-semibold text-gray-500 mb-2 ml-0.5 uppercase tracking-wider">Password</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-3.5 flex items-center pointer-events-none">
                                    <i data-lucide="key-round" class="fi-ic w-[16px] h-[16px] text-gray-400"></i>
                                </div>
                                <input id="password" type="password" name="password"
                                       placeholder="Masukkan password"
                                       autocomplete="current-password"
                                       class="fi w-full pl-10 pr-11 py-3.5 text-[13.5px] text-gray-900 font-medium">
                                <button type="button" id="pwToggle" class="pw-tog absolute inset-y-0 right-3 flex items-center text-gray-400" aria-label="Tampilkan password">
                                    <i data-lucide="eye" id="eyeOpen" class="w-4 h-4"></i>
                                    <i data-lucide="eye-off" id="eyeClosed" class="w-4 h-4 hidden"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Submit -->
                        <div class="pt-2">
                            <button type="submit" class="btn w-full py-3.5 rounded-xl text-white font-semibold text-[13.5px] flex items-center justify-center gap-2 tracking-wide">
                                <span>Masuk</span>
                                <i data-lucide="log-in" class="w-4 h-4"></i>
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Footer divider -->
                <div class="px-7 sm:px-9 pb-7 sm:pb-9">
                    <div class="mt-8 ent ent-d3" style="height: 1px; background: linear-gradient(90deg, transparent, var(--border), transparent);"></div>
                    <p class="mt-5 text-center text-[12px] font-semibold" style="color: var(--dim);">© {{ date('Y') }} Merdeka Aspirasi</p>
                </div>
            </div>
        </div>
    </section>

    <script>
        lucide.createIcons();

        /* Toggle visibilitas password */
        const pwToggle  = document.getElementById('pwToggle');
        const pwInput   = document.getElementById('password');
        const eyeOpen   = document.getElementById('eyeOpen');
        const eyeClosed = document.getElementById('eyeClosed');

        pwToggle.addEventListener('click', () => {
            const show = pwInput.type === 'password';
            pwInput.type = show ? 'text' : 'password';
            eyeOpen.classList.toggle('hidden', show);
            eyeClosed.classList.toggle('hidden', !show);
            pwToggle.setAttribute('aria-label', show ? 'Sembunyikan password' : 'Tampilkan password');
        });

        /* Auto-focus email */
        window.addEventListener('load', () => {
            const el = document.getElementById('email');
            if (el && !el.value) setTimeout(() => el.focus(), 850);
        });
    </script>
</body>
</html>