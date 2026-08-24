@extends('layouts.admin')

@section('title', 'Edit Menu Navigasi - ' . $menu->label)

@section('content')
<div class="max-w-2xl space-y-6" x-data="{
    menuLabel: '{{ addslashes($menu->label) }}',
    menuUrl: '{{ addslashes($menu->url) }}',
    applyPredefined(url, label) {
        this.menuUrl = url;
    }
}">
    <!-- Header -->
    <div class="flex items-center space-x-3">
        <a href="{{ route('admin.menus.index') }}" class="p-2 rounded-xl bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 transition text-xs">
            <i class="fa-solid fa-arrow-left"></i>
        </a>
        <div>
            <h1 class="text-2xl font-extrabold text-slate-900">Edit Item Menu Navigasi</h1>
            <p class="text-xs text-slate-500">Perbarui label, tautan tujuan, urutan, atau target menu.</p>
        </div>
    </div>

    <!-- Edit Form -->
    <div class="bg-white rounded-2xl p-6 sm:p-8 shadow-sm border border-slate-200 space-y-6">
        <!-- Quick Picker Box -->
        <div class="p-4 bg-sky-50/70 rounded-xl border border-sky-100 space-y-2">
            <label class="text-[11px] font-bold uppercase tracking-wider text-sky-900 block">Pilih Cepat Ganti Halaman Tujuan</label>
            <select @change="
                const opt = $event.target.options[$event.target.selectedIndex];
                if (opt.value) {
                    applyPredefined(opt.value, opt.dataset.label);
                }
            " class="w-full px-3 py-2 rounded-lg text-xs bg-white border border-sky-200 focus:outline-none focus:ring-2 focus:ring-sky-500">
                <option value="">-- Pilih Halaman Bawaan / Custom Page --</option>
                <optgroup label="Halaman Utama Sistem">
                    @foreach($predefinedRoutes as $pr)
                        <option value="{{ $pr['url'] }}" data-label="{{ $pr['label'] }}" {{ $menu->url == $pr['url'] ? 'selected' : '' }}>{{ $pr['label'] }} ({{ $pr['url'] }})</option>
                    @endforeach
                </optgroup>
                @if($pages->count() > 0)
                <optgroup label="Halaman Dinamis (Custom Pages)">
                    @foreach($pages as $pg)
                        <option value="{{ route('page', $pg->slug, false) }}" data-label="{{ $pg->title }}" {{ $menu->url == route('page', $pg->slug, false) ? 'selected' : '' }}>{{ $pg->title }} (/halaman/{{ $pg->slug }})</option>
                    @endforeach
                </optgroup>
                @endif
            </select>
        </div>

        <form action="{{ route('admin.menus.update', $menu->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div class="space-y-1">
                <label class="text-xs font-bold text-slate-700">Posisi Menu / Induk Dropdown</label>
                <select name="parent_id" class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:bg-white">
                    <option value="">-- Menu Utama (Navbar Teratas) --</option>
                    @foreach($parentMenus as $pm)
                        <option value="{{ $pm->id }}" {{ $menu->parent_id == $pm->id ? 'selected' : '' }}>↳ Jadikan Submenu dari: {{ $pm->label }}</option>
                    @endforeach
                </select>
                <p class="text-[10px] text-slate-400">Pilih induk jika ingin menjadikannya dropdown submenu bertingkat.</p>
            </div>

            <div class="space-y-1">
                <label class="text-xs font-bold text-slate-700">Nama Menu (Label Tampil) <span class="text-rose-500">*</span></label>
                <input type="text" name="label" x-model="menuLabel" required class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:bg-white">
            </div>

            <div class="space-y-1">
                <label class="text-xs font-bold text-slate-700">Tautan URL <span class="text-rose-500">*</span></label>
                <input type="text" name="url" x-model="menuUrl" required class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:bg-white">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-1">
                    <label class="text-xs font-bold text-slate-700">Target Tautan</label>
                    <select name="target" class="w-full px-3 py-2 rounded-xl text-xs bg-slate-50 border border-slate-200">
                        <option value="_self" {{ $menu->target == '_self' ? 'selected' : '' }}>Tab Sama (_self)</option>
                        <option value="_blank" {{ $menu->target == '_blank' ? 'selected' : '' }}>Tab Baru (_blank)</option>
                    </select>
                </div>

                <div class="space-y-1">
                    <label class="text-xs font-bold text-slate-700">Nomor Urutan</label>
                    <input type="number" name="order_index" value="{{ old('order_index', $menu->order_index) }}" required class="w-full px-3 py-2 rounded-xl text-xs bg-slate-50 border border-slate-200">
                </div>
            </div>

            <div class="pt-2">
                <label class="flex items-center space-x-2 text-xs font-bold text-slate-700 cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" {{ $menu->is_active ? 'checked' : '' }} class="rounded border-slate-300 text-theme-primary focus:ring-sky-500">
                    <span>Aktifkan Menu Ini di Navbar</span>
                </label>
            </div>

            <div class="pt-4 border-t flex items-center justify-between">
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-theme-primary text-white font-bold text-xs uppercase tracking-wider shadow hover:opacity-90 transition">
                    Simpan Perubahan
                </button>
                <a href="{{ route('admin.menus.index') }}" class="text-xs text-slate-500 hover:underline">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
