@extends('layouts.admin')

@section('title', 'Edit Slide Carousel Banner')

@section('content')
<div class="max-w-4xl space-y-6">
    <div class="flex items-center space-x-3">
        <a href="{{ route('admin.carousels.index') }}" class="p-2 rounded-xl bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 transition text-xs">
            <i class="fa-solid fa-arrow-left"></i>
        </a>
        <div>
            <h1 class="text-2xl font-extrabold text-slate-900">Edit Slide Carousel Banner</h1>
            <p class="text-xs text-slate-500">Perbarui gambar, teks, atau tautan slide banner.</p>
        </div>
    </div>

    <form action="{{ route('admin.carousels.update', $carousel->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')
        <div class="bg-white rounded-2xl p-6 sm:p-8 shadow-sm border border-slate-200 space-y-6">
            <div class="space-y-1">
                <label class="text-xs font-bold text-slate-700">Judul Slide Banner <span class="text-rose-500">*</span></label>
                <input type="text" name="title" value="{{ old('title', $carousel->title) }}" required class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:bg-white">
            </div>

            <div class="space-y-1">
                <label class="text-xs font-bold text-slate-700">Subjudul / Deskripsi Banner</label>
                <textarea name="subtitle" rows="3" class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:bg-white">{{ old('subtitle', $carousel->subtitle) }}</textarea>
            </div>

            <div class="space-y-2 pt-4 border-t border-slate-100">
                <label class="text-xs font-bold text-slate-700">Ganti File Gambar Banner</label>
                <div class="flex items-center space-x-4 mb-2">
                    <img src="{{ $carousel->image_path }}" alt="" class="w-32 h-16 object-cover rounded-xl border">
                    <span class="text-xs text-slate-400">Gambar saat ini</span>
                </div>
                <input type="file" name="image" accept="image/*" class="text-xs text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-slate-100 file:text-slate-700 hover:file:bg-slate-200">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-4 border-t border-slate-100">
                <div class="space-y-1">
                    <label class="text-xs font-bold text-slate-700">Teks Tombol Aksi (CTA Button)</label>
                    <input type="text" name="button_text" value="{{ old('button_text', $carousel->button_text) }}" class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 border border-slate-200">
                </div>

                <div class="space-y-1">
                    <label class="text-xs font-bold text-slate-700">Tautan Tombol (URL)</label>
                    <input type="text" name="button_link" value="{{ old('button_link', $carousel->button_link) }}" class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 border border-slate-200">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-4 border-t border-slate-100">
                <div class="space-y-1">
                    <label class="text-xs font-bold text-slate-700">Urutan Tampil (Sort Order)</label>
                    <input type="number" name="order_index" value="{{ old('order_index', $carousel->order_index) }}" class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 border border-slate-200">
                </div>

                <div class="flex items-center space-x-2 pt-6">
                    <input type="checkbox" name="is_active" value="1" id="is_active" {{ old('is_active', $carousel->is_active) ? 'checked' : '' }} class="rounded text-theme-primary">
                    <label for="is_active" class="text-xs font-bold text-slate-700 cursor-pointer">Slide Aktif & Tampil di Beranda</label>
                </div>
            </div>

            <div class="pt-4 border-t flex items-center justify-between">
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-theme-primary text-white font-bold text-xs uppercase tracking-wider shadow hover:opacity-90 transition">
                    Simpan Perubahan
                </button>
                <a href="{{ route('admin.carousels.index') }}" class="text-xs text-slate-500 hover:underline">Batal</a>
            </div>
        </div>
    </form>
</div>
@endsection
