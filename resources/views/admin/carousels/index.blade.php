@extends('layouts.admin')

@section('title', 'Manajemen Carousel & Banner Slider')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-2xl font-extrabold text-slate-900">Carousel & Banner Slider</h1>
            <p class="text-xs text-slate-500 mt-1">Kelola slide banner interaktif yang tampil di bagian paling atas halaman beranda divisi.</p>
        </div>
        <a href="{{ route('admin.carousels.create') }}" class="px-5 py-2.5 rounded-xl bg-theme-primary text-white font-bold text-xs uppercase tracking-wider shadow hover:opacity-90 transition flex items-center">
            <i class="fa-solid fa-plus mr-2"></i> Tambah Slide Banner
        </a>
    </div>

    <!-- Carousels Table -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-slate-600">
                <thead class="bg-slate-50 border-b border-slate-200 text-slate-700 font-bold uppercase text-[10px] tracking-wider">
                    <tr>
                        <th class="p-4">Urutan</th>
                        <th class="p-4">Banner & Judul Slide</th>
                        <th class="p-4">Tombol Aksi (CTA)</th>
                        <th class="p-4">Status</th>
                        <th class="p-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($carousels as $item)
                    <tr class="hover:bg-slate-50 transition">
                        <td class="p-4 font-bold text-slate-400">#{{ $item->order_index }}</td>
                        <td class="p-4 flex items-center space-x-3">
                            <div class="w-20 h-12 rounded-lg bg-slate-100 overflow-hidden flex-shrink-0 border">
                                <img src="{{ $item->image_path }}" alt="" class="w-full h-full object-cover">
                            </div>
                            <div class="max-w-xs sm:max-w-md">
                                <div class="font-bold text-slate-900 leading-snug">{{ $item->title }}</div>
                                @if($item->subtitle)
                                    <div class="text-[11px] text-slate-400 mt-0.5 line-clamp-1">{{ $item->subtitle }}</div>
                                @endif
                            </div>
                        </td>
                        <td class="p-4">
                            @if($item->button_text)
                                <div class="font-bold text-slate-800 text-xs">{{ $item->button_text }}</div>
                                <div class="text-[10px] text-sky-600 font-mono truncate max-w-xs">{{ $item->button_link }}</div>
                            @else
                                <span class="text-slate-400">-</span>
                            @endif
                        </td>
                        <td class="p-4">
                            @if($item->is_active)
                                <span class="px-2 py-0.5 rounded-full bg-emerald-50 text-emerald-700 text-[10px] font-bold border border-emerald-200">Aktif</span>
                            @else
                                <span class="px-2 py-0.5 rounded-full bg-slate-100 text-slate-600 text-[10px] font-bold">Non-aktif</span>
                            @endif
                        </td>
                        <td class="p-4 text-right space-x-2">
                            <a href="{{ route('admin.carousels.edit', $item->id) }}" class="p-1.5 rounded-lg text-sky-600 hover:bg-sky-50 transition" title="Edit"><i class="fa-regular fa-pen-to-square"></i></a>
                            <form action="{{ route('admin.carousels.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus slide banner ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-1.5 rounded-lg text-rose-600 hover:bg-rose-50 transition" title="Hapus"><i class="fa-regular fa-trash-can"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="p-8 text-center text-slate-400">
                            <i class="fa-regular fa-images text-3xl mb-2 block"></i>
                            Belum ada slide carousel banner yang ditambahkan. Banner beranda akan menggunakan background default tema divisi.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
