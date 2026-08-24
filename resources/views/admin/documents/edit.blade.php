@extends('layouts.admin')

@section('title', 'Edit Dokumen - ' . $document->title)

@section('content')
<div class="max-w-4xl space-y-6">
    <div class="flex items-center space-x-3">
        <a href="{{ route('admin.documents.index') }}" class="p-2 rounded-xl bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 transition text-xs">
            <i class="fa-solid fa-arrow-left"></i>
        </a>
        <div>
            <h1 class="text-2xl font-extrabold text-slate-900">Edit Dokumen</h1>
            <p class="text-xs text-slate-500">Perbarui rincian berkas atau unggah berkas revisi.</p>
        </div>
    </div>

    <form action="{{ route('admin.documents.update', $document->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')
        <div class="bg-white rounded-2xl p-6 sm:p-8 shadow-sm border border-slate-200 space-y-6">
            <div class="space-y-1">
                <label class="text-xs font-bold text-slate-700">Nama / Judul Dokumen <span class="text-rose-500">*</span></label>
                <input type="text" name="title" value="{{ old('title', $document->title) }}" required class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:bg-white">
            </div>

            <div class="space-y-1">
                <label class="text-xs font-bold text-slate-700">Kategori Dokumen</label>
                <select name="category_id" class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:bg-white">
                    <option value="">-- Pilih Kategori Dokumen --</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id', $document->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="space-y-1">
                <label class="text-xs font-bold text-slate-700">Deskripsi / Catatan Dokumen</label>
                <textarea name="description" rows="3" class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:bg-white">{{ old('description', $document->description) }}</textarea>
            </div>

            <div class="space-y-2 pt-4 border-t border-slate-100">
                <label class="text-xs font-bold text-slate-700">Ganti Berkas (Opsional)</label>
                <div class="text-xs text-slate-500 mb-2">Berkas saat ini: <span class="font-mono font-bold">{{ $document->file_type }} ({{ $document->file_size }})</span></div>
                <input type="file" name="document_file" class="text-xs text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-slate-100 file:text-slate-700 hover:file:bg-slate-200">
            </div>

            <div class="flex items-center space-x-2 pt-2">
                <input type="checkbox" name="is_published" value="1" id="is_published" {{ old('is_published', $document->is_published) ? 'checked' : '' }} class="rounded text-theme-primary">
                <label for="is_published" class="text-xs font-bold text-slate-700 cursor-pointer">Publikasikan Dokumen di Halaman Unduhan</label>
            </div>

            <div class="pt-4 border-t flex items-center justify-between">
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-theme-primary text-white font-bold text-xs uppercase tracking-wider shadow hover:opacity-90 transition">
                    Simpan Perubahan
                </button>
                <a href="{{ route('admin.documents.index') }}" class="text-xs text-slate-500 hover:underline">Batal</a>
            </div>
        </div>
    </form>
</div>
@endsection
