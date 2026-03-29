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
        .ent-left { animation: entLeft .7s cubic-bezier(.16,1,.3,1) both; }
        .ent-left-d1 { animation-delay: .08s; }
        .ent-left-d2 { animation-delay: .2s; }
        @keyframes entUp {
            from { opacity: 0; transform: translateY(24px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        @keyframes entLeft {
            from { opacity: 0; transform: translateX(-18px); }
            to   { opacity: 1; transform: translateX(0); }
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

        /* ── Mobile: hide left panel ── */
        @media (max-width: 1023px) {
            .panel-left { display: none; }
        }

        /* ── Scrollbar ── */
        ::-webkit-scrollbar { width: 5px; }
        ::-webkit-scrollbar-track { background: var(--bg); }
        ::-webkit-scrollbar-thumb { background: var(--border); border-radius: 3px; }
    </style>
</head>

<body class="min-h-screen">
    <div class="flex min-h-screen">

        <!-- ═══════════════════════════════════════════
             LEFT PANEL — Pure Visual
             ═══════════════════════════════════════════ -->
        <aside class="panel-left w-[40%] min-w-[420px] max-w-[620px] relative overflow-hidden flex-shrink-0"
               style="background: linear-gradient(165deg, #071525 0%, #0C2240 45%, #163D6B 100%);">

            <!-- Dot grid -->
            <div class="absolute inset-0 dot-grid"></div>

            <!-- Decorative circles -->
            <div class="absolute -top-[18%] -right-[12%] w-[520px] h-[520px] rounded-full border border-white/[0.04]" aria-hidden="true"></div>
            <div class="absolute -top-[8%] -right-[4%] w-[380px] h-[380px] rounded-full border border-white/[0.03]" aria-hidden="true"></div>
            <div class="absolute -bottom-[22%] -left-[14%] w-[460px] h-[460px] rounded-full border border-white/[0.04]" aria-hidden="true"></div>

            <!-- Spinning dashed ring (decorative) -->
            <div class="ring-spin absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[420px] h-[420px] rounded-full border border-dashed border-white/[0.035]" aria-hidden="true"></div>

            <!-- Ambient glow spots -->
            <div class="absolute top-[30%] left-[20%] w-80 h-80 rounded-full blur-[100px]" style="background: rgba(29,109,181,0.1);" aria-hidden="true"></div>
            <div class="absolute bottom-[25%] right-[15%] w-64 h-64 rounded-full blur-[80px]" style="background: rgba(229,164,17,0.05);" aria-hidden="true"></div>

            <!-- Centered content -->
            <div class="relative z-10 flex flex-col items-center justify-center h-full px-12">

                <!-- Brand mark -->
                <div class="ent-left mb-10">
                    <div class="w-14 h-14 rounded-2xl bg-white/[0.07] backdrop-blur border border-white/[0.08] overflow-hidden shadow-lg shadow-black/20">
                        <img src="{{ asset('img/logo.jpg') }}" alt="Logo" class="w-full h-full object-cover">
                    </div>
                </div>

                <!-- Headline -->
                <div class="ent-left ent-left-d1 text-center max-w-[380px]">
                    <h2 class="font-display text-[30px] xl:text-[34px] font-bold text-white leading-[1.3] mb-5 tracking-tight">
                        Laporkan masalah<br>
                        <span style="color: #E5A411;">sarana & prasarana</span>
                    </h2>
                    <p class="text-blue-200/40 text-sm leading-relaxed">
                        Sampaikan keluhan kerusakan fasilitas secara terstruktur. Tim terkait akan menindaklanjuti laporan Anda dengan cepat.
                    </p>
                </div>

            <!-- Bottom brand -->
            <div class="absolute bottom-8 left-9 xl:left-12 ent-left ent-left-d2">
                <span class="font-display font-semibold text-white/[0.25] text-[12px] tracking-tight">Merdeka Aspirasi</span>
            </div>
        </aside>

        <!-- ═══════════════════════════════════════════
             RIGHT PANEL — Login Form
             ═══════════════════════════════════════════ -->
        <section class="flex-1 flex items-center justify-center p-5 sm:p-10 relative cross-bg">

            <div class="w-full max-w-[370px] relative z-10">

                <!-- Mobile-only brand header -->
                <div class="lg:hidden text-center mb-8 ent">
                    <div class="inline-flex items-center gap-2.5">
                        <div class="w-9 h-9 rounded-xl overflow-hidden border border-gray-200 shadow-sm">
                            <img src="{{ asset('img/logo.jpg') }}" alt="Logo" class="w-full h-full object-cover">
                        </div>
                        <span class="font-display font-semibold text-gray-800 text-sm">Merdeka Aspirasi</span>
                    </div>
                </div>

                <!-- Heading -->
                <div class="mb-7 ent ent-d1">
                    <h1 class="font-display text-[25px] font-bold text-gray-900 leading-tight tracking-tight">Masuk ke akun Anda</h1>
                </div>

                <!-- Error alert -->
                @if ($errors->any())
                    <div class="err-shake mb-5 p-3.5 rounded-xl flex items-start gap-3 ent ent-d1" style="background: #FEF2F2; border: 1px solid rgba(239,68,68,0.15);">
                        <div class="w-5 h-5 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5" style="background: rgba(239,68,68,0.1);">
                            <i data-lucide="x" class="w-3 h-3" style="color: #EF4444;"></i>
                        </div>
                        <span class="text-[12px] font-medium leading-relaxed" style="color: #B91C1C;">{{ $errors->first() }}</span>
                    </div>
                @endif

                <!-- Form -->
                <form action="{{ route('login.process') }}" method="POST" class="space-y-4.5 ent ent-d2" novalidate>
                    @csrf

                    <!-- Email -->
                    <div class="ig">
                        <label for="email" class="block text-[11px] font-semibold text-gray-500 mb-1.5 ml-0.5 uppercase tracking-wider">Email Address</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-3.5 flex items-center pointer-events-none">
                                <i data-lucide="at-sign" class="fi-ic w-[16px] h-[16px] text-gray-400"></i>
                            </div>
                            <input id="email" type="email" name="email"
                                   placeholder="nama@sekolah.id"
                                   value="{{ old('email') }}"
                                   autocomplete="email"
                                   class="fi w-full pl-10 pr-4 py-3 text-[13.5px] text-gray-900 font-medium">
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="ig">
                        <label for="password" class="block text-[11px] font-semibold text-gray-500 mb-1.5 ml-0.5 uppercase tracking-wider">Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-3.5 flex items-center pointer-events-none">
                                <i data-lucide="key-round" class="fi-ic w-[16px] h-[16px] text-gray-400"></i>
                            </div>
                            <input id="password" type="password" name="password"
                                   placeholder="Masukkan password"
                                   autocomplete="current-password"
                                   class="fi w-full pl-10 pr-11 py-3 text-[13.5px] text-gray-900 font-medium">
                            <button type="button" id="pwToggle" class="pw-tog absolute inset-y-0 right-3 flex items-center text-gray-400" aria-label="Tampilkan password">
                                <i data-lucide="eye" id="eyeOpen" class="w-4 h-4"></i>
                                <i data-lucide="eye-off" id="eyeClosed" class="w-4 h-4 hidden"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Submit -->
                    <div class="pt-1.5">
                        <button type="submit" class="btn w-full py-3.5 rounded-xl text-white font-semibold text-[13.5px] flex items-center justify-center gap-2 tracking-wide">
                            <span>Masuk</span>
                            <i data-lucide="log-in" class="w-4 h-4"></i>
                        </button>
                    </div>
                </form>

                <!-- Divider -->
                <div class="my-7 ent ent-d3" style="height: 1px; background: linear-gradient(90deg, transparent, var(--border), transparent);"></div>

            </div>
        </section>
    </div>

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