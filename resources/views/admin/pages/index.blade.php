@extends('layouts.admin')

@section('title', 'Manajemen Halaman Dinamis')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-2xl font-extrabold text-slate-900">Halaman Kustom Dinamis</h1>
            <p class="text-xs text-slate-500 mt-1">Buat halaman informasi khusus tambahan (misal: Roadmap Penelitian, Sejarah, Panduan Lab).</p>
        </div>
        <a href="{{ route('admin.pages.create') }}" class="px-5 py-2.5 rounded-xl bg-theme-primary text-white font-bold text-xs uppercase tracking-wider shadow hover:opacity-90 transition flex items-center">
            <i class="fa-solid fa-plus mr-2"></i> Tambah Halaman Baru
        </a>
    </div>

    <!-- Pages Table -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-slate-600">
                <thead class="bg-slate-50 border-b border-slate-200 text-slate-700 font-bold uppercase text-[10px] tracking-wider">
                    <tr>
                        <th class="p-4">Urutan</th>
                        <th class="p-4">Judul Halaman</th>
                        <th class="p-4">URL Slug</th>
                        <th class="p-4">Status</th>
                        <th class="p-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($pages as $pg)
                    <tr class="hover:bg-slate-50 transition">
                        <td class="p-4 font-bold text-slate-400">#{{ $pg->order_index }}</td>
                        <td class="p-4">
                            <div class="font-bold text-slate-900">{{ $pg->title }}</div>
                            @if(get_setting('feature_page_builder_enabled', '0') == '1')
                                @if(($pg->layout_type ?? 'standard') === 'grapesjs')
                                    <span class="inline-flex items-center space-x-1 text-[9px] font-bold uppercase tracking-wider text-purple-700 bg-purple-50 px-2 py-0.5 rounded border border-purple-200 mt-0.5">
                                        <i class="fa-solid fa-wand-magic-sparkles text-[8px]"></i> <span>Visual Drag & Drop (GrapesJS)</span>
                                    </span>
                                @elseif(($pg->layout_type ?? 'standard') === 'blocks')
                                    <span class="inline-flex items-center space-x-1 text-[9px] font-bold uppercase tracking-wider text-amber-700 bg-amber-50 px-2 py-0.5 rounded border border-amber-200 mt-0.5">
                                        <i class="fa-solid fa-cubes text-[8px]"></i> <span>Block Builder ({{ count($pg->blocks_data ?? []) }} Blok)</span>
                                    </span>
                                @else
                                    <span class="inline-flex items-center space-x-1 text-[9px] font-bold uppercase tracking-wider text-slate-500 bg-slate-100 px-2 py-0.5 rounded mt-0.5">
                                        <i class="fa-solid fa-file-lines text-[8px]"></i> <span>Klasik</span>
                                    </span>
                                @endif
                            @endif
                        </td>
                        <td class="p-4 font-mono text-[11px] text-sky-600">/halaman/{{ $pg->slug }}</td>
                        <td class="p-4">
                            @if($pg->is_published)
                                <span class="px-2 py-0.5 rounded-full bg-emerald-50 text-emerald-700 text-[10px] font-bold border border-emerald-200">Terbit</span>
                            @else
                                <span class="px-2 py-0.5 rounded-full bg-slate-100 text-slate-600 text-[10px] font-bold">Draft</span>
                            @endif
                        </td>
                        <td class="p-4 text-right space-x-1.5">
                            @if(get_setting('feature_page_builder_enabled', '0') == '1')
                            <a href="{{ route('admin.pages.builder', $pg->id) }}" class="px-2.5 py-1.5 rounded-lg bg-amber-50 text-amber-700 hover:bg-amber-100 border border-amber-200 text-xs font-bold transition inline-flex items-center space-x-1" title="Buka Drag & Drop Visual Builder (GrapesJS)">
                                <i class="fa-solid fa-wand-magic-sparkles text-[10px]"></i> <span class="hidden md:inline">Studio</span>
                            </a>
                            @endif
                            <a href="{{ route('page', $pg->slug) }}" target="_blank" class="p-1.5 rounded-lg text-slate-400 hover:text-slate-700 hover:bg-slate-100 transition" title="Lihat"><i class="fa-regular fa-eye"></i></a>
                            <a href="{{ route('admin.pages.edit', $pg->id) }}" class="p-1.5 rounded-lg text-sky-600 hover:bg-sky-50 transition" title="Edit Form"><i class="fa-regular fa-pen-to-square"></i></a>
                            <form action="{{ route('admin.pages.destroy', $pg->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus halaman ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-1.5 rounded-lg text-rose-600 hover:bg-rose-50 transition" title="Hapus"><i class="fa-regular fa-trash-can"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="p-8 text-center text-slate-400">Belum ada halaman kustom yang dibuat.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
