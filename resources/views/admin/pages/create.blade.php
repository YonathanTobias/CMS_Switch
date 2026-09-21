@extends('layouts.admin')

@section('title', 'Tambah Halaman Kustom')

@section('content')
<div class="max-w-4xl space-y-6">
    <div class="flex items-center space-x-3">
        <a href="{{ route('admin.pages.index') }}" class="p-2 rounded-xl bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 transition text-xs">
            <i class="fa-solid fa-arrow-left"></i>
        </a>
        <div>
            <h1 class="text-2xl font-extrabold text-slate-900">Tambah Halaman Kustom</h1>
            <p class="text-xs text-slate-500">Buat konten dinamis baru untuk website divisi.</p>
        </div>
    </div>

    <form action="{{ route('admin.pages.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6" id="pageForm">
        @csrf
        <div class="bg-white rounded-2xl p-6 sm:p-8 shadow-sm border border-slate-200 space-y-6">
            <div class="space-y-1">
                <label class="text-xs font-bold text-slate-700">Judul Halaman <span class="text-rose-500">*</span></label>
                <input type="text" name="title" value="{{ old('title') }}" required class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:bg-white" placeholder="Contoh: Roadmap Penelitian & Pengmas 2025-2030">
            </div>

            <div class="space-y-1">
                <label class="text-xs font-bold text-slate-700">Isi Konten Halaman <span class="text-rose-500">*</span></label>
                <input type="hidden" name="content" id="contentInput" value="{{ old('content') }}">
                <div id="editor" class="bg-white rounded-xl min-h-[300px]">
                    {!! old('content') !!}
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-4 border-t border-slate-100">
                <div class="space-y-1">
                    <label class="text-xs font-bold text-slate-700">Banner Gambar Atas (Opsional)</label>
                    <input type="file" name="banner_image" accept="image/*" class="text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-slate-100 file:text-slate-700 hover:file:bg-slate-200">
                </div>

                <div class="space-y-1">
                    <label class="text-xs font-bold text-slate-700">Urutan Tampil</label>
                    <input type="number" name="order_index" value="{{ old('order_index', 0) }}" class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 border border-slate-200">
                </div>
            </div>

            <div class="flex items-center space-x-2 pt-2">
                <input type="checkbox" name="is_published" value="1" id="is_published" {{ old('is_published', true) ? 'checked' : '' }} class="rounded text-theme-primary">
                <label for="is_published" class="text-xs font-bold text-slate-700 cursor-pointer">Publikasikan Halaman Ini</label>
            </div>

            <div class="pt-4 border-t">
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-theme-primary text-white font-bold text-xs uppercase tracking-wider shadow hover:opacity-90 transition">
                    Simpan Halaman
                </button>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        initQuillEditor('#editor', '#contentInput', '#pageForm');
    });
</script>
@endpush
