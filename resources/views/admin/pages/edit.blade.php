@extends('layouts.admin')

@section('title', 'Edit Halaman - ' . $page->title)

@section('content')
<div class="max-w-5xl space-y-6">
    <div class="flex items-center space-x-3">
        <a href="{{ route('admin.pages.index') }}" class="p-2 rounded-xl bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 transition text-xs">
            <i class="fa-solid fa-arrow-left"></i>
        </a>
        <div>
            <h1 class="text-2xl font-extrabold text-slate-900">Edit Halaman Kustom</h1>
            <p class="text-xs text-slate-500">Perbarui isi konten atau susun blok halaman modular.</p>
        </div>
    </div>

    <form action="{{ route('admin.pages.update', $page->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6" id="pageForm">
        @csrf
        @method('PUT')
        <div class="bg-white rounded-2xl p-6 sm:p-8 shadow-sm border border-slate-200 space-y-6">
            <div class="space-y-1">
                <label class="text-xs font-bold text-slate-700">Judul Halaman <span class="text-rose-500">*</span></label>
                <input type="text" name="title" value="{{ old('title', $page->title) }}" required class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:bg-white">
            </div>

            {{-- Visual Builder & Editor Partial --}}
            @include('admin.pages._builder', [
                'layoutType' => old('layout_type', $page->layout_type ?? 'standard'),
                'pageContent' => old('content', $page->content ?? ''),
                'bannerImage' => $page->banner_image,
                'blocksData' => $page->blocks_data ?? []
            ])

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-4 border-t border-slate-100">
                <div class="space-y-1">
                    <label class="text-xs font-bold text-slate-700">Urutan Tampil</label>
                    <input type="number" name="order_index" value="{{ old('order_index', $page->order_index) }}" class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 border border-slate-200">
                </div>

                <div class="flex items-center space-x-2 pt-6">
                    <input type="checkbox" name="is_published" value="1" id="is_published" {{ old('is_published', $page->is_published) ? 'checked' : '' }} class="rounded text-theme-primary">
                    <label for="is_published" class="text-xs font-bold text-slate-700 cursor-pointer">Publikasikan Halaman Ini</label>
                </div>
            </div>

            <div class="pt-4 border-t flex items-center justify-between">
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-theme-primary text-white font-bold text-xs uppercase tracking-wider shadow hover:opacity-90 transition">
                    Simpan Perubahan
                </button>
                <a href="{{ route('admin.pages.index') }}" class="text-xs text-slate-500 hover:underline">Batal</a>
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

