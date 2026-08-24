@extends('layouts.admin')

@section('title', 'Manajemen Galeri Foto')

@section('content')
<div class="space-y-6">
    <div>
        <h1 class="text-2xl font-extrabold text-slate-900">Galeri Foto Kegiatan</h1>
        <p class="text-xs text-slate-500 mt-1">Upload dokumentasi visual dan foto kegiatan divisi.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <!-- Form Upload Foto (4 cols) -->
        <div class="lg:col-span-4">
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-200 space-y-4">
                <h3 class="font-bold text-sm text-slate-900 border-b pb-2">Upload Foto Kegiatan</h3>
                <form action="{{ route('admin.galleries.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <div class="space-y-1">
                        <label class="text-xs font-bold text-slate-700">Judul Kegiatan <span class="text-rose-500">*</span></label>
                        <input type="text" name="title" required class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:bg-white" placeholder="Contoh: Workshop Penulisan Jurnal Scopus">
                    </div>

                    <div class="space-y-1">
                        <label class="text-xs font-bold text-slate-700">Kategori Galeri <span class="text-rose-500">*</span></label>
                        <input type="text" name="category" value="Kegiatan" required class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:bg-white" placeholder="Contoh: Workshop / Pengmas / Seminar">
                    </div>

                    <div class="space-y-1">
                        <label class="text-xs font-bold text-slate-700">File Foto <span class="text-rose-500">*</span></label>
                        <input type="file" name="image" accept="image/*" required class="text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-slate-100 file:text-slate-700 hover:file:bg-slate-200">
                    </div>

                    <div class="space-y-1">
                        <label class="text-xs font-bold text-slate-700">Keterangan / Caption</label>
                        <textarea name="caption" rows="2" class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:bg-white" placeholder="Keterangan singkat tentang foto..."></textarea>
                    </div>

                    <button type="submit" class="w-full py-2.5 rounded-xl bg-theme-primary text-white font-bold text-xs uppercase tracking-wider shadow hover:opacity-90 transition">
                        Upload Foto
                    </button>
                </form>
            </div>
        </div>

        <!-- Grid Foto (8 cols) -->
        <div class="lg:col-span-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                @forelse($galleries as $gal)
                <div class="bg-white rounded-2xl overflow-hidden shadow-sm border border-slate-200 flex flex-col justify-between group">
                    <div>
                        <div class="relative h-36 bg-slate-100">
                            <img src="{{ $gal->image_path }}" alt="" class="w-full h-full object-cover">
                            <div class="absolute top-2 right-2">
                                <span class="px-2 py-0.5 rounded bg-slate-900/80 text-white text-[9px] font-semibold">{{ $gal->category }}</span>
                            </div>
                        </div>
                        <div class="p-3">
                            <h4 class="font-bold text-xs text-slate-800 leading-snug line-clamp-1">{{ $gal->title }}</h4>
                            @if($gal->caption)
                                <p class="text-[10px] text-slate-400 mt-0.5 line-clamp-1">{{ $gal->caption }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="px-3 pb-3 pt-1 flex justify-end border-t border-slate-100">
                        <form action="{{ route('admin.galleries.destroy', $gal->id) }}" method="POST" onsubmit="return confirm('Hapus foto ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-[11px] text-rose-600 hover:underline font-semibold">
                                <i class="fa-regular fa-trash-can mr-1"></i> Hapus
                            </button>
                        </form>
                    </div>
                </div>
                @empty
                <div class="col-span-3 text-center py-16 bg-white rounded-2xl border border-dashed border-slate-300 text-slate-400 text-xs">
                    Belum ada foto galeri yang diunggah.
                </div>
                @endforelse
            </div>

            <div class="mt-6">
                {{ $galleries->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
