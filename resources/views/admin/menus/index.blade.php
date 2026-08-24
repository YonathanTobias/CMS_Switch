@extends('layouts.admin')

@section('title', 'Kelola Menu Navigasi')

@section('content')
<div class="space-y-6" x-data="{
    selectedPredefined: '',
    menuLabel: '',
    menuUrl: '',
    applyPredefined(url, label) {
        this.menuUrl = url;
        if (!this.menuLabel) {
            this.menuLabel = label;
        }
    }
}">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-2xl font-extrabold text-slate-900">Kelola Menu Navigasi</h1>
            <p class="text-xs text-slate-500 mt-1">Atur susunan, nama, tautan, dan urutan menu navbar di bagian atas website publik.</p>
        </div>
        <form action="{{ route('admin.menus.reset') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin me-reset seluruh menu navigasi ke susunan standar bawaan?');">
            @csrf
            <button type="submit" class="px-4 py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs uppercase tracking-wider transition border border-slate-300 flex items-center shadow-sm">
                <i class="fa-solid fa-rotate-left mr-2 text-slate-500"></i> Reset ke Menu Standar
            </button>
        </form>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
        <!-- Col 1: Table of Existing Menus (7 cols) -->
        <div class="lg:col-span-7 bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden space-y-4 p-6">
            <div class="flex items-center justify-between border-b pb-3">
                <h2 class="text-base font-bold text-slate-900 flex items-center">
                    <i class="fa-solid fa-list mr-2 text-theme-primary"></i> Daftar Menu Aktif
                </h2>
                <span class="text-xs text-slate-400 font-medium">{{ $menus->count() }} Item Menu</span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs text-slate-600">
                    <thead class="bg-slate-50 border-b border-slate-200 text-slate-700 font-bold uppercase text-[10px] tracking-wider">
                        <tr>
                            <th class="p-3 w-16">Urutan</th>
                            <th class="p-3">Nama Menu (Label)</th>
                            <th class="p-3">Tautan URL</th>
                            <th class="p-3 text-center">Status</th>
                            <th class="p-3 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($menus as $m)
                        <tr class="hover:bg-slate-50 transition {{ $m->parent_id ? 'bg-slate-50/50' : '' }}">
                            <td class="p-3 font-bold text-slate-500">#{{ $m->order_index }}</td>
                            <td class="p-3">
                                <div class="font-bold text-slate-900 flex items-center">
                                    @if($m->parent_id)
                                        <span class="text-slate-400 font-mono mr-1.5 pl-2">↳</span>
                                        <span class="px-1.5 py-0.5 rounded text-[9px] font-semibold bg-sky-50 text-sky-700 border border-sky-200 mr-1.5">Submenu: {{ $m->parent->label ?? 'Induk' }}</span>
                                    @endif
                                    <span>{{ $m->label }}</span>
                                    @if($m->target === '_blank')
                                        <i class="fa-solid fa-arrow-up-right-from-square ml-1.5 text-[10px] text-slate-400" title="Buka di tab baru"></i>
                                    @endif
                                </div>
                            </td>
                            <td class="p-3 font-mono text-[11px] text-slate-500 truncate max-w-[150px]">
                                {{ $m->url }}
                            </td>
                            <td class="p-3 text-center">
                                @if($m->is_active)
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800">Aktif</span>
                                @else
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-slate-100 text-slate-500">Nonaktif</span>
                                @endif
                            </td>
                            <td class="p-3 text-right space-x-1">
                                <a href="{{ route('admin.menus.edit', $m->id) }}" class="p-1.5 rounded-lg text-sky-600 hover:bg-sky-50 transition" title="Edit"><i class="fa-regular fa-pen-to-square"></i></a>
                                <form action="{{ route('admin.menus.destroy', $m->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus item menu ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-1.5 rounded-lg text-rose-600 hover:bg-rose-50 transition" title="Hapus"><i class="fa-regular fa-trash-can"></i></button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="p-6 text-center text-slate-400">Belum ada item menu. Klik tombol "Reset ke Menu Standar" atau tambahkan menu baru di samping.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Col 2: Add New Menu Form (5 cols) -->
        <div class="lg:col-span-5 bg-white rounded-2xl p-6 shadow-sm border border-slate-200 space-y-6">
            <h2 class="text-base font-bold text-slate-900 border-b pb-3 flex items-center">
                <i class="fa-solid fa-plus-circle mr-2 text-theme-primary"></i> Tambah Item Menu Baru
            </h2>

            <!-- Quick Picker Box -->
            <div class="p-4 bg-sky-50/70 rounded-xl border border-sky-100 space-y-2">
                <label class="text-[11px] font-bold uppercase tracking-wider text-sky-900 block">Pilih Cepat Halaman Tujuan</label>
                <select x-model="selectedPredefined" @change="
                    const opt = $event.target.options[$event.target.selectedIndex];
                    if (opt.value) {
                        applyPredefined(opt.value, opt.dataset.label);
                    }
                " class="w-full px-3 py-2 rounded-lg text-xs bg-white border border-sky-200 focus:outline-none focus:ring-2 focus:ring-sky-500">
                    <option value="">-- Pilih Halaman Bawaan / Custom Page --</option>
                    <optgroup label="Halaman Utama Sistem">
                        @foreach($predefinedRoutes as $pr)
                            <option value="{{ $pr['url'] }}" data-label="{{ $pr['label'] }}">{{ $pr['label'] }} ({{ $pr['url'] }})</option>
                        @endforeach
                    </optgroup>
                    @if($pages->count() > 0)
                    <optgroup label="Halaman Dinamis (Custom Pages)">
                        @foreach($pages as $pg)
                            <option value="{{ route('page', $pg->slug, false) }}" data-label="{{ $pg->title }}">{{ $pg->title }} (/halaman/{{ $pg->slug }})</option>
                        @endforeach
                    </optgroup>
                    @endif
                </select>
                <p class="text-[10px] text-sky-700">Pilih salah satu untuk mengisi Label & URL otomatis, atau ketik manual di bawah.</p>
            </div>

            <!-- Form -->
            <form action="{{ route('admin.menus.store') }}" method="POST" class="space-y-4">
                @csrf

                <div class="space-y-1">
                    <label class="text-xs font-bold text-slate-700">Posisi Menu / Induk Dropdown</label>
                    <select name="parent_id" class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:bg-white">
                        <option value="">-- Menu Utama (Navbar Teratas) --</option>
                        @foreach($parentMenus as $pm)
                            <option value="{{ $pm->id }}">↳ Jadikan Submenu dari: {{ $pm->label }}</option>
                        @endforeach
                    </select>
                    <p class="text-[10px] text-slate-400">Pilih induk jika ingin menjadikannya dropdown submenu bertingkat.</p>
                </div>

                <div class="space-y-1">
                    <label class="text-xs font-bold text-slate-700">Nama Menu (Label Tampil) <span class="text-rose-500">*</span></label>
                    <input type="text" name="label" x-model="menuLabel" required class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:bg-white" placeholder="Contoh: Kurikulum / Lab Komputer / SPMI">
                </div>

                <div class="space-y-1">
                    <label class="text-xs font-bold text-slate-700">Tautan URL <span class="text-rose-500">*</span></label>
                    <input type="text" name="url" x-model="menuUrl" required class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:bg-white" placeholder="Contoh: /profil atau https://google.com">
                    <p class="text-[11px] text-slate-400">Gunakan tanda <code>/</code> untuk halaman internal (contoh: <code>/profil</code>) atau URL lengkap dengan <code>https://</code> untuk link luar.</p>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-1">
                        <label class="text-xs font-bold text-slate-700">Target Tautan</label>
                        <select name="target" class="w-full px-3 py-2 rounded-xl text-xs bg-slate-50 border border-slate-200">
                            <option value="_self">Tab Sama (_self)</option>
                            <option value="_blank">Tab Baru (_blank)</option>
                        </select>
                    </div>

                    <div class="space-y-1">
                        <label class="text-xs font-bold text-slate-700">Nomor Urutan</label>
                        <input type="number" name="order_index" value="{{ ($menus->max('order_index') ?? 0) + 1 }}" class="w-full px-3 py-2 rounded-xl text-xs bg-slate-50 border border-slate-200">
                    </div>
                </div>

                <div class="pt-2">
                    <label class="flex items-center space-x-2 text-xs font-bold text-slate-700 cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" checked class="rounded border-slate-300 text-theme-primary focus:ring-sky-500">
                        <span>Aktifkan Menu Ini di Navbar</span>
                    </label>
                </div>

                <div class="pt-4 border-t">
                    <button type="submit" class="w-full py-2.5 rounded-xl bg-theme-primary text-white font-bold text-xs uppercase tracking-wider shadow hover:opacity-90 transition">
                        Tambah ke Navbar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
