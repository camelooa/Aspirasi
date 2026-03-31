@extends('layout.siswa')

@section('content')
<div class="px-4 md:px-8 py-8">
    <div class="max-w-7xl mx-auto space-y-6">
        <section class="card p-6 md:p-8 shadow-sm relative overflow-hidden">
            <div class="absolute inset-0 pointer-events-none" style="background: radial-gradient(circle at 16% 24%, rgba(229,164,17,0.10), transparent 45%), radial-gradient(circle at 88% 36%, rgba(29,109,181,0.10), transparent 58%);"></div>
            <div class="relative flex flex-col lg:flex-row lg:items-end lg:justify-between gap-4">
                <div>
                    <p class="text-[10px] font-black uppercase tracking-[0.22em] text-gray-400">Siswa · Buat Aspirasi</p>
                    <h1 class="font-display text-2xl md:text-3xl font-extrabold tracking-tight text-gray-900 mt-2">Tulis Aspirasi Baru</h1>
                    <p class="text-sm text-gray-600 mt-2 max-w-2xl">Jelaskan masalah/masukan dengan ringkas dan jelas. Lampirkan foto bila perlu.</p>
                </div>
                <div class="flex flex-wrap items-center gap-2">
                    <a href="{{ route('siswa.aspirasisaya') }}" class="btn-soft px-6 py-3 rounded-2xl font-extrabold text-sm">Aspirasi Saya</a>
                    <a href="{{ route('siswa.dashboard') }}" class="btn-soft px-6 py-3 rounded-2xl font-extrabold text-sm">Dashboard</a>
                </div>
            </div>
        </section>

        @if($errors->any())
            <section class="card p-5 md:p-6 shadow-sm" style="background: rgba(239,68,68,0.06); border: 1px solid rgba(239,68,68,0.16);">
                <p class="text-[10px] font-black uppercase tracking-[0.22em] text-gray-400">Perlu Diperbaiki</p>
                <p class="text-sm font-extrabold mt-2" style="color: #991B1B;">Periksa kembali input kamu:</p>
                <ul class="mt-2 text-sm" style="color: #991B1B;">
                    @foreach($errors->all() as $error)
                        <li>- {{ $error }}</li>
                    @endforeach
                </ul>
            </section>
        @endif

        <section class="card shadow-sm p-6 md:p-8">
            <form action="{{ route('siswa.aspirasi.store') }}" method="POST" enctype="multipart/form-data" id="feedbackForm">
                @csrf

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                    <div class="lg:col-span-8 space-y-6">
                        <div>
                            <label class="block text-[11px] font-black uppercase tracking-[0.18em] text-gray-400 mb-2">Judul Aspirasi</label>
                            <input type="text" name="feedback_title" placeholder="Contoh: Perbaikan kursi kelas" value="{{ old('feedback_title') }}" class="fi w-full px-4 py-3 text-[13.5px] font-semibold text-gray-900" required>
                        </div>

                        <div>
                            <label class="block text-[11px] font-black uppercase tracking-[0.18em] text-gray-400 mb-2">Detail Aspirasi</label>
                            <textarea name="details" id="details" rows="10" placeholder="Ceritakan masalah/masukan kamu secara ringkas tapi jelas..." class="fi w-full px-4 py-3 text-[13.5px] font-semibold text-gray-900">{{ old('details') }}</textarea>
                            <div class="mt-2 text-[11px] font-bold text-gray-500" id="charCount">0 karakter</div>
                        </div>
                    </div>

                    <aside class="lg:col-span-4">
                        <div class="card p-5 md:p-6 shadow-sm" style="background: rgba(12,34,64,0.03);">
                            <p class="text-[10px] font-black uppercase tracking-[0.22em] text-gray-400">Pengaturan</p>

                            <div class="mt-4">
                                <label class="block text-[11px] font-black uppercase tracking-[0.18em] text-gray-400 mb-2">Kategori</label>
                                <select name="category_id" class="fi w-full px-4 py-3 bg-white text-[13.5px] font-semibold text-gray-900" required>
                                    <option value="">Pilih kategori</option>
                                    @foreach($kategoris as $k)
                                        <option value="{{ $k->id }}" @selected(old('category_id') == $k->id)>{{ $k->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mt-5">
                                <label class="block text-[11px] font-black uppercase tracking-[0.18em] text-gray-400 mb-2">Lampiran Foto (Opsional)</label>
                                <input type="file" name="image" accept="image/*" class="block w-full text-sm text-gray-700" style="accent-color: var(--accent);">
                                <p class="text-[11px] text-gray-500 mt-2">Format gambar umum (.jpg, .png) disarankan.</p>
                            </div>

                            <div class="mt-6 flex flex-col gap-2">
                                <button type="submit" class="btn inline-flex items-center justify-center gap-2 px-5 py-3 rounded-2xl text-white font-extrabold text-sm shadow-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                    Kirim Aspirasi
                                </button>
                                <a href="{{ route('siswa.dashboard') }}" class="btn-soft text-center px-5 py-3 rounded-2xl font-extrabold text-sm">Batal</a>
                            </div>
                        </div>
                    </aside>
                </div>
            </form>
        </section>
    </div>

    <script>
        (function(){
            var details = document.getElementById('details');
            var counter = document.getElementById('charCount');
            if(!details || !counter) return;
            function updateCount(){
                var len = details.value.length;
                counter.textContent = len + ' karakter';
            }
            details.addEventListener('input', updateCount);
            updateCount();
        })();
    </script>
</div>
@endsection
