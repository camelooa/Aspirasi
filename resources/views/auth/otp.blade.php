<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Verifikasi OTP - Merdeka Aspirasi</title>
    <!-- Use Tailwind via CDN for simplicity, keeping in line with the current tech stack -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass-effect {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 min-h-screen flex items-center justify-center p-4">
    <!-- Background Decorations -->
    <div class="fixed top-0 left-0 w-full h-full overflow-hidden -z-10 pointer-events-none">
        <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] bg-blue-400 opacity-10 rounded-full blur-[100px]"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] bg-purple-400 opacity-10 rounded-full blur-[100px]"></div>
    </div>

    <div class="w-full max-w-md">
        <!-- Logo/Brand -->
        <div class="text-center mb-10">
            <div class="inline-flex items-center justify-center p-3 bg-white rounded-3xl shadow-xl mb-6 ring-1 ring-gray-100">
                <img src="{{ asset('img/logo.jpg') }}" alt="Logo" class="w-16 h-16 rounded-2xl object-cover">
            </div>
            <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Verifikasi OTP</h1>
            <p class="text-gray-500 mt-2 font-medium">Masukkan kode 6 digit yang dikirim ke email Anda.</p>
        </div>

        <!-- OTP Card -->
        <div class="glass-effect rounded-[2.5rem] shadow-2xl p-10 relative overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-blue-500 to-indigo-600"></div>
            
            @if(session('error'))
                <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-xl flex items-center gap-3">
                    <svg class="w-5 h-5 text-red-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="text-sm font-semibold text-red-700 leading-tight">{{ session('error') }}</span>
                </div>
            @endif

            <form action="{{ route('otp.verify') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-2 ml-1">KODE OTP</label>
                    <div class="relative group">
                         <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400 group-focus-within:text-blue-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </div>
                        <input type="text" name="otp" placeholder="123456" maxlength="6"
                            class="block w-full pl-11 pr-4 text-center tracking-[0.5em] py-4 bg-white/50 border border-gray-100 rounded-2xl text-gray-900 text-2xl font-bold placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all">
                    </div>
                </div>

                <div class="pt-4">
                    <button type="submit" 
                        class="w-full py-4 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white rounded-2xl font-bold text-lg shadow-lg hover:shadow-xl transform transition-all active:scale-[0.98]">
                        Verifikasi Masuk
                    </button>
                </div>
            </form>
            
            <div class="mt-6 text-center">
                <form action="{{ route('login') }}" method="GET">
                    <button type="submit" class="text-sm text-gray-400 font-bold hover:text-blue-600 transition-colors">
                        &larr; Kembali ke Login
                    </button>
                </form>
            </div>
        </div>
        
        <p class="text-center text-gray-500 text-sm mt-8 font-medium">
            &copy; {{ date('Y') }} Merdeka Aspirasi Team. 
        </p>
    </div>
</body>
</html>
