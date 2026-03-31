<div class="fixed bottom-6 right-6 z-50 overflow-visible" id="chatbot-container">
    <!-- Chat Bubble -->
    <button id="chatbot-toggle" class="w-14 h-14 rounded-full shadow-lg flex items-center justify-center text-white transition transform hover:scale-110 active:scale-95" style="background: var(--navy);">
        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
        </svg>
    </button>

    <!-- Chat Window -->
    <div id="chatbot-window" class="hidden absolute bottom-16 right-0 w-80 rounded-2xl shadow-2xl overflow-hidden flex flex-col transition-all duration-300 transform scale-95 origin-bottom-right" style="background: var(--card); border: 1px solid rgba(226,221,213,0.95);">
        <!-- Header -->
        <div class="p-4 text-white flex justify-between items-center" style="background: var(--navy);">
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 bg-white/15 rounded-full flex items-center justify-center border border-white/10">
                    <span class="text-lg">🤖</span>
                </div>
                <div>
                    <p class="font-bold text-sm">Bot Merdeka</p>
                    <p class="text-[10px] text-white/70 italic">Online</p>
                </div>
            </div>
            <button id="chatbot-close" class="text-white/70 hover:text-white transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <!-- Messages Area -->
        <div id="chat-messages" class="h-80 overflow-y-auto p-4 space-y-4 flex flex-col" style="background: rgba(0,0,0,0.02);">
            <!-- Bot Welcome -->
            <div class="flex gap-2 items-start max-w-[85%]">
                <div class="w-6 h-6 rounded-full flex-shrink-0 flex items-center justify-center text-[10px]" style="background: rgba(12,34,64,0.08);">🤖</div>
                <div class="p-3 rounded-2xl rounded-tl-none text-sm text-gray-800 shadow-sm leading-relaxed" style="background: var(--card); border: 1px solid rgba(226,221,213,0.85);">
                    Bot: Hi {{ auth()->user()->full_name ?? auth()->user()->name }}! 👋<br>
                    Ada yang bisa saya bantu?<br><br>
                    Masukkan angka berikut untuk lanjut bertanya:<br>
                    1 [ <b>Kirim Aspirasi</b> ]<br>
                    2 [ <b>Aspirasi Saya</b> ]<br>
                    3 [ <b>FAQ Sekolah</b> ]<br>
                    4 [ <b>Info Akademik</b> ]<br>
                    5 [ <b>Panduan App</b> ]<br>
                    6 [ <b>Kontak Admin</b> ]
                </div>
            </div>
        </div>

        <!-- Input Area -->
        <div class="p-4" style="border-top: 1px solid rgba(226,221,213,0.85); background: var(--card);">
            <form id="chat-form" class="flex gap-2">
                <input type="text" id="chat-input" 
                    placeholder="Ketik angka (1-6)..." 
                    class="fi flex-1 px-3 py-2 text-sm focus:outline-none transition"
                    autocomplete="off">
                <button type="submit" class="p-2 text-white rounded-lg transition" style="background: var(--navy);">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                </button>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const toggleBtn = document.getElementById('chatbot-toggle');
    const closeBtn = document.getElementById('chatbot-close');
    const windowEl = document.getElementById('chatbot-window');
    const input = document.getElementById('chat-input');
    const form = document.getElementById('chat-form');
    const messages = document.getElementById('chat-messages');

    // Toggle Chat
    function toggleChat() {
        windowEl.classList.toggle('hidden');
        if (!windowEl.classList.contains('hidden')) {
            windowEl.classList.add('scale-100');
            windowEl.classList.remove('scale-95');
            input.focus();
        } else {
            windowEl.classList.remove('scale-100');
            windowEl.classList.add('scale-95');
        }
    }

    toggleBtn.addEventListener('click', toggleChat);
    closeBtn.addEventListener('click', toggleChat);

    function addMessage(text, isUser = false) {
        const msgDiv = document.createElement('div');
        msgDiv.className = `flex gap-2 items-start ${isUser ? 'flex-row-reverse self-end max-w-[85%]' : 'max-w-[85%]'}`;
        
        msgDiv.innerHTML = `
            ${!isUser ? '<div class="w-6 h-6 rounded-full flex-shrink-0 flex items-center justify-center text-[10px]" style="background: rgba(12,34,64,0.08);">🤖</div>' : ''}
            <div class="${isUser ? 'text-white rounded-tr-none' : 'text-gray-800 rounded-tl-none shadow-sm'} p-3 rounded-2xl text-sm leading-relaxed" style="${isUser ? 'background: var(--navy);' : 'background: var(--card); border: 1px solid rgba(226,221,213,0.85);'}">
                ${text}
            </div>
        `;
        messages.appendChild(msgDiv);
        messages.scrollTop = messages.scrollHeight;
    }

    form.addEventListener('submit', function(e) {
        e.preventDefault();
        const val = input.value.trim();
        if (!val) return;

        addMessage(val, true);
        input.value = '';

        setTimeout(() => {
            switch(val) {
                case '1':
                    addMessage("Mengalihkan ke halaman Buat Aspirasi...");
                    setTimeout(() => window.location.href = "{{ route('siswa.buataspirasi') }}", 1000);
                    break;
                case '2':
                    addMessage("Mengalihkan ke halaman Aspirasi Saya...");
                    setTimeout(() => window.location.href = "{{ route('siswa.aspirasisaya') }}", 1000);
                    break;
                case '3':
                    addMessage("<b>FAQ Sekolah:</b><br>1. <b>Kerahasiaan?</b> Identitas aman, hanya admin yang tahu.<br>2. <b>Lama Respon?</b> Maksimal 3x24 jam kerja.<br>3. <b>Jenis Laporan?</b> Fasilitas, bully, akademik, dll.");
                    break;
                case '4':
                     addMessage("<b>Info Akademik:</b><br>- MASUK: 07.00 WIB<br>- PULANG: 15.00 WIB<br><br><i>Lihat mading sekolah untuk jadwal ujian terbaru.</i>");
                    break;
                case '5':
                    addMessage("<b>Panduan:</b><br>1. Pilih menu 'Buat Aspirasi'<br>2. Isi judul & detail<br>3. Upload foto jika ada<br>4. Kirim & pantau di 'Aspirasi Saya'");
                    break;
                case '6':
                    addMessage("<b>Kontak Admin:</b><br>Email: admin@sekolah.sch.id<br>WA: 0812-3456-7890<br><i>Jam Operasional: 07:00-16:00</i>");
                    break;
                default:
                    addMessage("Maaf, perintah tidak dikenali. Silakan ketik angka <b>1 - 6</b>.");
            }
        }, 500);
    });
});
</script>
