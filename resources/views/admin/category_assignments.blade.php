@extends('layout.admin')

@section('content')
<div class="px-4 md:px-8 py-8">
    <div class="max-w-7xl mx-auto space-y-6">
        <section class="card p-6 md:p-8 shadow-sm relative overflow-hidden">
            <div class="absolute inset-0 pointer-events-none" style="background: radial-gradient(circle at 18% 22%, rgba(229,164,17,0.10), transparent 45%), radial-gradient(circle at 85% 35%, rgba(29,109,181,0.10), transparent 55%);"></div>
            <div class="relative flex flex-col lg:flex-row lg:items-end lg:justify-between gap-4">
                <div>
                    <p class="text-[10px] font-black uppercase tracking-[0.22em] text-gray-400">Admin · Penugasan</p>
                    <h2 class="font-display text-2xl md:text-3xl font-extrabold tracking-tight text-gray-900 mt-2">Penugasan & Personil</h2>
                    <p class="text-sm text-gray-600 mt-2 max-w-2xl">Kelola penanggung jawab dan email kategori untuk memastikan notifikasi aspirasi tepat sasaran.</p>
                </div>
                <div class="flex items-center gap-2">
                    <button type="button" onclick="openCreatePersonModal()" class="btn inline-flex items-center gap-2 px-6 py-3 rounded-2xl text-white font-extrabold text-sm shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        Tambah Personil
                    </button>
                </div>
            </div>
        </section>

        @if(session('success'))
            <section class="card p-5 md:p-6 shadow-sm" style="background: rgba(29,109,181,0.06); border: 1px solid rgba(29,109,181,0.16);">
                <p class="text-[10px] font-black uppercase tracking-[0.22em] text-gray-400">Berhasil</p>
                <p class="text-sm font-extrabold text-gray-900 mt-2">{{ session('success') }}</p>
            </section>
        @endif

        <section class="grid grid-cols-1 lg:grid-cols-12 gap-6">
            <!-- Personnel -->
            <div class="lg:col-span-7 space-y-3">
                <div class="card p-5 md:p-6 shadow-sm">
                    <p class="text-[10px] font-black uppercase tracking-[0.22em] text-gray-400">Personil</p>
                    <h3 class="font-display text-lg font-extrabold tracking-tight text-gray-900 mt-2">Penanggung Jawab</h3>
                    <p class="text-sm text-gray-600 mt-1">Atur profil personil dan penugasan kategori mereka.</p>
                </div>

                @forelse($penanggungJawabs as $pj)
                    <div class="card p-5 md:p-6 shadow-sm">
                        <div class="flex flex-col md:flex-row md:items-start gap-4">
                            <div class="flex items-start gap-3 min-w-0 flex-1">
                                <div class="h-12 w-12 rounded-2xl flex items-center justify-center text-white font-extrabold shrink-0" style="background: linear-gradient(165deg, var(--navy-deep) 0%, var(--navy) 55%, #163D6B 100%);">
                                    {{ strtoupper(substr($pj->nama, 0, 1)) }}
                                </div>

                                <div class="min-w-0">
                                    <p class="text-sm font-extrabold text-gray-900 truncate">{{ $pj->nama }}</p>
                                    <p class="text-sm text-gray-600 mt-1">{{ $pj->jabatan ?: '-' }}</p>

                                    <div class="mt-3 flex flex-wrap gap-2">
                                        @forelse($pj->kategoris as $kat)
                                            <span class="px-3 py-1 rounded-full text-[11px] font-black uppercase tracking-[0.18em]" style="background: rgba(0,0,0,0.03); border: 1px solid rgba(0,0,0,0.06); color: #334155;">
                                                {{ $kat->name }}
                                            </span>
                                        @empty
                                            <span class="text-sm text-gray-500">Belum ada penugasan kategori.</span>
                                        @endforelse
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center gap-2 md:justify-end">
                                <button type="button" onclick="openAssignModal('{{ $pj->id }}', '{{ $pj->nama }}')" class="btn-soft px-4 py-2.5 rounded-2xl text-[12px] font-extrabold">Atur Penugasan</button>
                                <button type="button" onclick="openEditPersonModal('{{ $pj->id }}', '{{ $pj->nama }}', '{{ $pj->jabatan }}')" class="px-4 py-2.5 rounded-2xl text-[12px] font-extrabold" style="background: rgba(229,164,17,0.14); border: 1px solid rgba(229,164,17,0.25); color: var(--navy);" title="Edit Profil">Edit</button>
                                <form action="{{ route('admin.category-assignments.destroy-person', $pj->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus personil ini? Semua kategorinya akan kehilangan penanggung jawab.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-4 py-2.5 rounded-2xl text-[12px] font-extrabold" style="background: rgba(239,68,68,0.10); border: 1px solid rgba(239,68,68,0.20); color: #991B1B;" title="Hapus Personil">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Assignment Modal -->
                    <div id="assign-modal-{{ $pj->id }}" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                        <div class="flex items-center justify-center min-h-screen px-4 py-10">
                            <div class="fixed inset-0 transition-opacity bg-gray-900 bg-opacity-60 backdrop-blur-sm" aria-hidden="true" onclick="closeAssignModal('{{ $pj->id }}')"></div>
                            <div class="relative w-full max-w-xl">
                                <div class="card overflow-hidden shadow-2xl" style="border-radius: 24px;">
                                    <form action="{{ route('admin.category-assignments.update-assignments', $pj->id) }}" method="POST">
                                        @csrf
                                        <div class="p-6 md:p-8 bg-white">
                                            <div class="flex items-start justify-between gap-4">
                                                <div>
                                                    <p class="text-[10px] font-black uppercase tracking-[0.22em] text-gray-400">Penugasan</p>
                                                    <h3 class="font-display text-xl font-extrabold tracking-tight text-gray-900 mt-2">Atur Kategori</h3>
                                                    <p class="text-sm text-gray-600 mt-1">{{ $pj->nama }}</p>
                                                </div>
                                                <button type="button" onclick="closeAssignModal('{{ $pj->id }}')" class="btn-soft p-2.5 rounded-2xl" aria-label="Tutup">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                                </button>
                                            </div>

                                            <div class="mt-5 rounded-2xl p-4" style="background: rgba(29,109,181,0.06); border: 1px solid rgba(29,109,181,0.16);">
                                                <p class="text-[11px] font-bold text-gray-700">Kategori terpilih akan mengirim notifikasi email ke personil ini.</p>
                                            </div>

                                            <div class="mt-5 space-y-2 max-h-72 overflow-y-auto pr-1">
                                                @foreach($categories as $category)
                                                    <label class="flex items-center gap-3 p-4 rounded-2xl cursor-pointer hover:bg-black/[0.02] transition" style="border: 1px solid rgba(0,0,0,0.06);">
                                                        <input type="checkbox" name="category_ids[]" value="{{ $category->id }}" {{ $pj->kategoris->contains($category->id) ? 'checked' : '' }} class="w-5 h-5" style="accent-color: var(--accent);">
                                                        <span class="text-sm font-extrabold text-gray-900">{{ $category->name }}</span>
                                                    </label>
                                                @endforeach
                                            </div>
                                        </div>

                                        <div class="p-6 bg-black/[0.02] border-t border-black/[0.06] flex flex-col sm:flex-row-reverse gap-2">
                                            <button type="submit" class="btn px-6 py-3 rounded-2xl text-white font-extrabold text-sm">Simpan</button>
                                            <button type="button" onclick="closeAssignModal('{{ $pj->id }}')" class="btn-soft px-6 py-3 rounded-2xl font-extrabold text-sm">Batal</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="card p-10 text-center shadow-sm">
                        <p class="font-extrabold text-gray-900">Belum ada personil yang terdaftar.</p>
                        <p class="text-sm text-gray-600 mt-1">Tambahkan personil untuk mulai mengatur penugasan kategori.</p>
                        <button type="button" onclick="openCreatePersonModal()" class="mt-4 btn-soft px-6 py-3 rounded-2xl font-extrabold text-sm">Tambah Personil</button>
                    </div>
                @endforelse
            </div>

            <!-- Category management -->
            <div class="lg:col-span-5 space-y-3">
                <div class="card p-5 md:p-6 shadow-sm">
                    <p class="text-[10px] font-black uppercase tracking-[0.22em] text-gray-400">Kategori</p>
                    <h3 class="font-display text-lg font-extrabold tracking-tight text-gray-900 mt-2">Email Bersama</h3>
                    <p class="text-sm text-gray-600 mt-1">Kelola alamat email notifikasi untuk setiap kategori.</p>
                </div>

                @foreach($categories as $category)
                    <div class="card p-5 md:p-6 shadow-sm">
                        <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-3">
                            <div class="min-w-0">
                                <p class="text-sm font-extrabold text-gray-900 truncate">{{ $category->name }}</p>
                                <p class="text-sm text-gray-600 mt-1 break-all">{{ $category->email ?: 'Belum diatur' }}</p>
                            </div>
                            <div class="flex items-center gap-2">
                                <button type="button" onclick="openEditCategoryModal('{{ $category->id }}', '{{ $category->name }}', '{{ $category->email }}')" class="btn-soft px-4 py-2.5 rounded-2xl text-[12px] font-extrabold">Edit Email</button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </div>
</div>

<!-- Create Person Modal -->
<div id="createPersonModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4 py-10">
        <div class="fixed inset-0 transition-opacity bg-gray-900 bg-opacity-60 backdrop-blur-sm" onclick="closeCreatePersonModal()"></div>
        <div class="relative w-full max-w-xl">
            <div class="card overflow-hidden shadow-2xl" style="border-radius: 24px;">
                <form action="{{ route('admin.category-assignments.store-person') }}" method="POST">
                    @csrf
                    <div class="p-6 md:p-8 bg-white">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <p class="text-[10px] font-black uppercase tracking-[0.22em] text-gray-400">Personil</p>
                                <h3 class="font-display text-xl font-extrabold tracking-tight text-gray-900 mt-2">Tambah Personil</h3>
                                <p class="text-sm text-gray-600 mt-1">Masukkan nama dan jabatan (opsional).</p>
                            </div>
                            <button type="button" onclick="closeCreatePersonModal()" class="btn-soft p-2.5 rounded-2xl" aria-label="Tutup">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            </button>
                        </div>

                        <div class="mt-5 space-y-4">
                            <div>
                                <label class="block text-[11px] font-black uppercase tracking-[0.18em] text-gray-400 mb-2">Nama Lengkap</label>
                                <input type="text" name="nama" required placeholder="Contoh: Budi Santoso" class="fi w-full px-4 py-3 text-[13.5px] text-gray-900 font-semibold">
                            </div>
                            <div>
                                <label class="block text-[11px] font-black uppercase tracking-[0.18em] text-gray-400 mb-2">Jabatan (Opsional)</label>
                                <input type="text" name="jabatan" placeholder="Contoh: Wakasek Kesiswaan" class="fi w-full px-4 py-3 text-[13.5px] text-gray-900 font-semibold">
                            </div>
                        </div>
                    </div>
                    <div class="p-6 bg-black/[0.02] border-t border-black/[0.06] flex flex-col sm:flex-row-reverse gap-2">
                        <button type="submit" class="btn px-6 py-3 rounded-2xl text-white font-extrabold text-sm">Tambah</button>
                        <button type="button" onclick="closeCreatePersonModal()" class="btn-soft px-6 py-3 rounded-2xl font-extrabold text-sm">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Person Modal -->
<div id="editPersonModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4 py-10">
        <div class="fixed inset-0 transition-opacity bg-gray-900 bg-opacity-60 backdrop-blur-sm" onclick="closeEditPersonModal()"></div>
        <div class="relative w-full max-w-xl">
            <div class="card overflow-hidden shadow-2xl" style="border-radius: 24px;">
                <form id="editPersonForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="p-6 md:p-8 bg-white">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <p class="text-[10px] font-black uppercase tracking-[0.22em] text-gray-400">Personil</p>
                                <h3 class="font-display text-xl font-extrabold tracking-tight text-gray-900 mt-2">Edit Personil</h3>
                                <p class="text-sm text-gray-600 mt-1">Perbarui nama dan jabatan.</p>
                            </div>
                            <button type="button" onclick="closeEditPersonModal()" class="btn-soft p-2.5 rounded-2xl" aria-label="Tutup">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            </button>
                        </div>

                        <div class="mt-5 space-y-4">
                            <div>
                                <label class="block text-[11px] font-black uppercase tracking-[0.18em] text-gray-400 mb-2">Nama Lengkap</label>
                                <input type="text" name="nama" id="edit_pj_nama" required class="fi w-full px-4 py-3 text-[13.5px] text-gray-900 font-semibold">
                            </div>
                            <div>
                                <label class="block text-[11px] font-black uppercase tracking-[0.18em] text-gray-400 mb-2">Jabatan (Opsional)</label>
                                <input type="text" name="jabatan" id="edit_pj_jabatan" class="fi w-full px-4 py-3 text-[13.5px] text-gray-900 font-semibold">
                            </div>
                        </div>
                    </div>
                    <div class="p-6 bg-black/[0.02] border-t border-black/[0.06] flex flex-col sm:flex-row-reverse gap-2">
                        <button type="submit" class="btn px-6 py-3 rounded-2xl text-white font-extrabold text-sm">Simpan</button>
                        <button type="button" onclick="closeEditPersonModal()" class="btn-soft px-6 py-3 rounded-2xl font-extrabold text-sm">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Category Modal -->
<div id="editCategoryModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4 py-10">
        <div class="fixed inset-0 transition-opacity bg-gray-900 bg-opacity-60 backdrop-blur-sm" onclick="closeEditCategoryModal()"></div>
        <div class="relative w-full max-w-xl">
            <div class="card overflow-hidden shadow-2xl" style="border-radius: 24px;">
                <form id="editCategoryForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="p-6 md:p-8 bg-white">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <p class="text-[10px] font-black uppercase tracking-[0.22em] text-gray-400">Kategori</p>
                                <h3 class="font-display text-xl font-extrabold tracking-tight text-gray-900 mt-2">Edit Email</h3>
                                <p id="edit_kat_name_display" class="text-sm font-extrabold text-gray-600 mt-1"></p>
                            </div>
                            <button type="button" onclick="closeEditCategoryModal()" class="btn-soft p-2.5 rounded-2xl" aria-label="Tutup">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            </button>
                        </div>

                        <div class="mt-5 space-y-3">
                            <div>
                                <label class="block text-[11px] font-black uppercase tracking-[0.18em] text-gray-400 mb-2">Email Bersama</label>
                                <input type="email" name="email" id="edit_kat_email" required placeholder="kategori@sekolah.sch.id" class="fi w-full px-4 py-3 text-[13.5px] text-gray-900 font-semibold">
                            </div>
                            <div class="rounded-2xl p-4" style="background: rgba(229,164,17,0.10); border: 1px solid rgba(229,164,17,0.18);">
                                <p class="text-[11px] font-bold text-gray-700">Email ini menerima notifikasi aspirasi baru untuk kategori terkait.</p>
                            </div>
                        </div>
                    </div>
                    <div class="p-6 bg-black/[0.02] border-t border-black/[0.06] flex flex-col sm:flex-row-reverse gap-2">
                        <button type="submit" class="btn px-6 py-3 rounded-2xl text-white font-extrabold text-sm">Simpan</button>
                        <button type="button" onclick="closeEditCategoryModal()" class="btn-soft px-6 py-3 rounded-2xl font-extrabold text-sm">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function openAssignModal(id, name) {
        document.getElementById('assign-modal-' + id).classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }
    function closeAssignModal(id) {
        document.getElementById('assign-modal-' + id).classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }
    function openCreatePersonModal() {
        document.getElementById('createPersonModal').classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }
    function closeCreatePersonModal() {
        document.getElementById('createPersonModal').classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }
    function openEditPersonModal(id, nama, jabatan) {
        document.getElementById('editPersonForm').action = '/admin/category-assignments/person/' + id;
        document.getElementById('edit_pj_nama').value = nama;
        document.getElementById('edit_pj_jabatan').value = jabatan;
        document.getElementById('editPersonModal').classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }
    function closeEditPersonModal() {
        document.getElementById('editPersonModal').classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }
    function openEditCategoryModal(id, name, email) {
        document.getElementById('editCategoryForm').action = '/admin/category-assignments/category/' + id;
        document.getElementById('edit_kat_name_display').textContent = name;
        document.getElementById('edit_kat_email').value = email === 'Belum diatur' ? '' : email;
        document.getElementById('editCategoryModal').classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }
    function closeEditCategoryModal() {
        document.getElementById('editCategoryModal').classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }
</script>
@endsection
