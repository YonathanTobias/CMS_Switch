@extends('layouts.admin')

@section('title', 'Kelola Akun Administrator')

@section('content')
<div class="space-y-6" x-data="{ editModal: false, editUser: { id: '', name: '', email: '', role: 'admin' }, editAction: '' }">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-2xl font-extrabold text-slate-900 dark:text-white">Kelola Akun Pengguna & Admin</h1>
            <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Khusus Super Admin: Kelola hak akses Super Admin dan Admin.</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <!-- Form Tambah User (4 cols) -->
        <div class="lg:col-span-4">
            <div class="bg-white dark:bg-slate-900 rounded-2xl p-6 shadow-sm border border-slate-200 dark:border-slate-800 space-y-4">
                <h3 class="font-bold text-sm text-slate-900 dark:text-white border-b dark:border-slate-800 pb-2">Tambah Akun Admin Baru</h3>
                <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="space-y-1">
                        <label class="text-xs font-bold text-slate-700 dark:text-slate-300">Nama Pengguna <span class="text-rose-500">*</span></label>
                        <input type="text" name="name" required class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:bg-white dark:focus:bg-slate-900" placeholder="Contoh: Admin Kemahasiswaan / Prodi">
                    </div>

                    <div class="space-y-1">
                        <label class="text-xs font-bold text-slate-700 dark:text-slate-300">Alamat Email <span class="text-rose-500">*</span></label>
                        <input type="email" name="email" required class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:bg-white dark:focus:bg-slate-900" placeholder="nama@pantiwaluya.ac.id">
                    </div>

                    <div class="space-y-1">
                        <label class="text-xs font-bold text-slate-700 dark:text-slate-300">Role / Hak Akses <span class="text-rose-500">*</span></label>
                        <select name="role" required class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:bg-white dark:focus:bg-slate-900">
                            <option value="admin">Admin (Semua Fitur Kecuali Preset Switcher & Kelola Admin)</option>
                            <option value="super_admin">Super Admin (Akses Penuh Seluruh Fitur)</option>
                        </select>
                        <div class="text-[11px] text-slate-400 mt-1.5 space-y-0.5 leading-relaxed">
                            <p>• <strong>Admin:</strong> Akses penuh seluruh konten & pengaturan kecuali 1-Click Preset Switcher & Kelola Admin.</p>
                            <p>• <strong>Super Admin:</strong> Akses penuh termasuk 1-Click Preset Switcher & Kelola Admin.</p>
                        </div>
                    </div>

                    <div class="space-y-1">
                        <label class="text-xs font-bold text-slate-700 dark:text-slate-300">Kata Sandi <span class="text-rose-500">*</span></label>
                        <input type="password" name="password" required class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:bg-white dark:focus:bg-slate-900" placeholder="Min. 6 karakter">
                    </div>

                    <button type="submit" class="w-full py-2.5 rounded-xl bg-theme-primary text-white font-bold text-xs uppercase tracking-wider shadow hover:opacity-90 transition">
                        Buat Akun Admin
                    </button>
                </form>
            </div>
        </div>

        <!-- Tabel Daftar User (8 cols) -->
        <div class="lg:col-span-8">
            <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-800 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs text-slate-600 dark:text-slate-300">
                        <thead class="bg-slate-50 dark:bg-slate-800/60 border-b border-slate-200 dark:border-slate-800 text-slate-700 dark:text-slate-300 font-bold uppercase text-[10px] tracking-wider">
                            <tr>
                                <th class="p-4">Nama & Email</th>
                                <th class="p-4">Role / Hak Akses</th>
                                <th class="p-4">Terdaftar</th>
                                <th class="p-4 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                            @forelse($users as $u)
                            <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/40 transition">
                                <td class="p-4">
                                    <div class="font-bold text-slate-900 dark:text-white">{{ $u->name }}</div>
                                    <div class="text-[11px] text-slate-400">{{ $u->email }}</div>
                                </td>
                                <td class="p-4">
                                    @if($u->isSuperAdmin())
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full bg-purple-50 text-purple-700 border border-purple-200 font-bold text-[10px]">
                                            <i class="fa-solid fa-crown mr-1.5 text-purple-600"></i> Super Admin
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full bg-sky-50 text-sky-700 border border-sky-200 font-bold text-[10px]">
                                            <i class="fa-solid fa-user-gear mr-1.5 text-sky-600"></i> Admin
                                        </span>
                                    @endif
                                </td>
                                <td class="p-4 text-[11px]">
                                    {{ $u->created_at->format('d M Y') }}
                                </td>
                                <td class="p-4 text-right space-x-1">
                                    <button type="button"
                                        @click="editUser = { id: '{{ $u->id }}', name: '{{ addslashes($u->name) }}', email: '{{ addslashes($u->email) }}', role: '{{ $u->isSuperAdmin() ? 'super_admin' : 'admin' }}' }; editAction = '{{ route('admin.users.update', $u->id) }}'; editModal = true"
                                        class="p-1.5 rounded-lg text-sky-600 hover:bg-sky-50 dark:hover:bg-sky-950/50 transition"
                                        title="Edit Akun / Ubah Role">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                    </button>
                                    @if($u->id !== auth()->id())
                                    <form action="{{ route('admin.users.destroy', $u->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus akun ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-1.5 rounded-lg text-rose-600 hover:bg-rose-50 dark:hover:bg-rose-950/50 transition" title="Hapus"><i class="fa-regular fa-trash-can"></i></button>
                                    </form>
                                    @else
                                    <span class="text-[11px] text-slate-400 italic ml-1">Akun Anda</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="p-8 text-center text-slate-400">Belum ada data akun.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-6">
                {{ $users->links() }}
            </div>
        </div>
    </div>

    <!-- Modal Edit User -->
    <div x-show="editModal" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/60 backdrop-blur-sm p-4" style="display: none;">
        <div @click.outside="editModal = false" class="bg-white dark:bg-slate-900 rounded-2xl max-w-md w-full p-6 shadow-2xl border border-slate-200 dark:border-slate-800 space-y-4">
            <div class="flex items-center justify-between border-b dark:border-slate-800 pb-3">
                <h3 class="font-bold text-sm text-slate-900 dark:text-white">Edit Akun & Role Admin</h3>
                <button type="button" @click="editModal = false" class="text-slate-400 hover:text-slate-600"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <form :action="editAction" method="POST" class="space-y-4">
                @csrf
                @method('PUT')
                <div class="space-y-1">
                    <label class="text-xs font-bold text-slate-700 dark:text-slate-300">Nama Pengguna <span class="text-rose-500">*</span></label>
                    <input type="text" name="name" x-model="editUser.name" required class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 focus:outline-none focus:ring-2 focus:ring-sky-500">
                </div>

                <div class="space-y-1">
                    <label class="text-xs font-bold text-slate-700 dark:text-slate-300">Alamat Email <span class="text-rose-500">*</span></label>
                    <input type="email" name="email" x-model="editUser.email" required class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 focus:outline-none focus:ring-2 focus:ring-sky-500">
                </div>

                <div class="space-y-1">
                    <label class="text-xs font-bold text-slate-700 dark:text-slate-300">Role / Hak Akses <span class="text-rose-500">*</span></label>
                    <select name="role" x-model="editUser.role" required class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 focus:outline-none focus:ring-2 focus:ring-sky-500">
                        <option value="admin">Admin (Semua Fitur Kecuali Preset Switcher & Kelola Admin)</option>
                        <option value="super_admin">Super Admin (Akses Penuh Seluruh Fitur)</option>
                    </select>
                </div>

                <div class="space-y-1">
                    <label class="text-xs font-bold text-slate-700 dark:text-slate-300">Kata Sandi Baru <span class="text-slate-400 font-normal">(Kosongkan jika tidak diubah)</span></label>
                    <input type="password" name="password" class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 focus:outline-none focus:ring-2 focus:ring-sky-500" placeholder="Min. 6 karakter">
                </div>

                <div class="flex justify-end gap-2 pt-2">
                    <button type="button" @click="editModal = false" class="px-4 py-2 rounded-xl bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 text-xs font-bold">Batal</button>
                    <button type="submit" class="px-5 py-2 rounded-xl bg-theme-primary text-white text-xs font-bold shadow hover:opacity-90 transition">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
