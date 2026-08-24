@extends('layouts.admin')

@section('title', 'Kelola Akun Administrator')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-2xl font-extrabold text-slate-900">Kelola Akun Pengguna & Admin</h1>
            <p class="text-xs text-slate-500 mt-1">Khusus Super User (Admin IT): Tambah atau ubah hak akses Admin Divisi dan Admin IT.</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <!-- Form Tambah User (4 cols) -->
        <div class="lg:col-span-4">
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-200 space-y-4">
                <h3 class="font-bold text-sm text-slate-900 border-b pb-2">Tambah Akun Admin Baru</h3>
                <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="space-y-1">
                        <label class="text-xs font-bold text-slate-700">Nama Pengguna <span class="text-rose-500">*</span></label>
                        <input type="text" name="name" required class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:bg-white" placeholder="Contoh: Admin Divisi LPPM">
                    </div>

                    <div class="space-y-1">
                        <label class="text-xs font-bold text-slate-700">Alamat Email <span class="text-rose-500">*</span></label>
                        <input type="email" name="email" required class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:bg-white" placeholder="nama@pantiwaluya.ac.id">
                    </div>

                    <div class="space-y-1">
                        <label class="text-xs font-bold text-slate-700">Role / Hak Akses <span class="text-rose-500">*</span></label>
                        <select name="role" required class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:bg-white">
                            <option value="division_admin">Admin Divisi (Kelola Konten Saja)</option>
                            <option value="super_admin">Admin IT / Super User (Akses Penuh + Preset)</option>
                        </select>
                        <p class="text-[11px] text-slate-400 mt-1">Admin Divisi tidak dapat mengubah konfigurasi preset & identitas divisi.</p>
                    </div>

                    <div class="space-y-1">
                        <label class="text-xs font-bold text-slate-700">Kata Sandi <span class="text-rose-500">*</span></label>
                        <input type="password" name="password" required class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:bg-white" placeholder="Min. 6 karakter">
                    </div>

                    <button type="submit" class="w-full py-2.5 rounded-xl bg-theme-primary text-white font-bold text-xs uppercase tracking-wider shadow hover:opacity-90 transition">
                        Buat Akun Admin
                    </button>
                </form>
            </div>
        </div>

        <!-- Tabel Daftar User (8 cols) -->
        <div class="lg:col-span-8">
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs text-slate-600">
                        <thead class="bg-slate-50 border-b border-slate-200 text-slate-700 font-bold uppercase text-[10px] tracking-wider">
                            <tr>
                                <th class="p-4">Nama & Email</th>
                                <th class="p-4">Role / Hak Akses</th>
                                <th class="p-4">Terdaftar</th>
                                <th class="p-4 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse($users as $u)
                            <tr class="hover:bg-slate-50 transition">
                                <td class="p-4">
                                    <div class="font-bold text-slate-900">{{ $u->name }}</div>
                                    <div class="text-[11px] text-slate-400">{{ $u->email }}</div>
                                </td>
                                <td class="p-4">
                                    @if($u->isSuperAdmin())
                                        <span class="px-2.5 py-1 rounded-full bg-purple-50 text-purple-700 border border-purple-200 font-bold text-[10px]">
                                            <i class="fa-solid fa-crown mr-1 text-purple-600"></i> Admin IT (Super User)
                                        </span>
                                    @else
                                        <span class="px-2.5 py-1 rounded-full bg-sky-50 text-sky-700 border border-sky-200 font-bold text-[10px]">
                                            <i class="fa-solid fa-user-gear mr-1 text-sky-600"></i> Admin Divisi
                                        </span>
                                    @endif
                                </td>
                                <td class="p-4 text-[11px]">
                                    {{ $u->created_at->format('d M Y') }}
                                </td>
                                <td class="p-4 text-right">
                                    @if($u->id !== auth()->id())
                                    <form action="{{ route('admin.users.destroy', $u->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus akun ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-1.5 rounded-lg text-rose-600 hover:bg-rose-50 transition" title="Hapus"><i class="fa-regular fa-trash-can"></i></button>
                                    </form>
                                    @else
                                    <span class="text-[11px] text-slate-400 italic">Akun Anda</span>
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
</div>
@endsection
