@extends('layouts.admin')

@section('title', 'Tambah Berita / Pengumuman')

@section('content')
<div class="max-w-4xl space-y-6">
    <div class="flex items-center space-x-3">
        <a href="{{ route('admin.posts.index') }}" class="p-2 rounded-xl bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 transition text-xs">
            <i class="fa-solid fa-arrow-left"></i>
        </a>
        <div>
            <h1 class="text-2xl font-extrabold text-slate-900">Tambah Konten Baru</h1>
            <p class="text-xs text-slate-500">Tulis berita kegiatan atau pengumuman edaran divisi.</p>
        </div>
    </div>

    <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6" id="postForm">
        @csrf
        <div class="bg-white rounded-2xl p-6 sm:p-8 shadow-sm border border-slate-200 space-y-6">
            <div class="space-y-1">
                <label class="text-xs font-bold text-slate-700">Judul Konten <span class="text-rose-500">*</span></label>
                <input type="text" name="title" value="{{ old('title') }}" required class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:bg-white" placeholder="Masukkan judul berita/pengumuman...">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="space-y-1">
                    <label class="text-xs font-bold text-slate-700">Jenis Konten <span class="text-rose-500">*</span></label>
                    <select name="type" required class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:bg-white">
                        <option value="berita" {{ old('type') == 'berita' ? 'selected' : '' }}>Berita & Liputan Kegiatan</option>
                        <option value="pengumuman" {{ old('type') == 'pengumuman' ? 'selected' : '' }}>Pengumuman / Surat Edaran</option>
                    </select>
                </div>

                <div class="space-y-1">
                    <label class="text-xs font-bold text-slate-700">Kategori</label>
                    <select name="category_id" class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:bg-white">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="space-y-1">
                <label class="text-xs font-bold text-slate-700">Ringkasan Singkat (Summary)</label>
                <textarea name="summary" rows="2" class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:bg-white" placeholder="Ringkasan 1-2 kalimat untuk preview di kartu beranda...">{{ old('summary') }}</textarea>
            </div>

            <!-- WYSIWYG Content Area -->
            <div class="space-y-1">
                <label class="text-xs font-bold text-slate-700">Isi Konten Lengkap <span class="text-rose-500">*</span></label>
                <input type="hidden" name="content" id="contentInput" value="{{ old('content') }}">
                <div id="editor" class="bg-white rounded-xl min-h-[250px]">
                    {!! old('content') !!}
                </div>
            </div>

            <!-- Thumbnail Upload -->
            <div class="space-y-1 pt-4 border-t border-slate-100">
                <label class="text-xs font-bold text-slate-700">Foto Sampul / Thumbnail</label>
                <input type="file" name="thumbnail" accept="image/*" class="text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-slate-100 file:text-slate-700 hover:file:bg-slate-200">
                <p class="text-[11px] text-slate-400">Format: JPG, PNG, WEBP. Maks 3MB.</p>
            </div>

            <!-- Publication Settings -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 pt-4 border-t border-slate-100">
                <div class="space-y-1">
                    <label class="text-xs font-bold text-slate-700">Tanggal Publikasi</label>
                    <input type="datetime-local" name="published_at" value="{{ old('published_at', now()->format('Y-m-d\TH:i')) }}" class="w-full px-3 py-2 rounded-xl text-xs bg-slate-50 border border-slate-200">
                </div>

                <div class="flex items-center space-x-2 pt-6">
                    <input type="checkbox" name="is_featured" value="1" id="is_featured" {{ old('is_featured') ? 'checked' : '' }} class="rounded text-theme-primary">
                    <label for="is_featured" class="text-xs font-bold text-slate-700 cursor-pointer">Jadikan Sorotan (Featured)</label>
                </div>

                <div class="flex items-center space-x-2 pt-6">
                    <input type="checkbox" name="is_published" value="1" id="is_published" {{ old('is_published', true) ? 'checked' : '' }} class="rounded text-theme-primary">
                    <label for="is_published" class="text-xs font-bold text-slate-700 cursor-pointer">Langsung Terbitkan (Publish)</label>
                </div>
            </div>

            <div class="pt-4 border-t">
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-theme-primary text-white font-bold text-xs uppercase tracking-wider shadow hover:opacity-90 transition">
                    Simpan & Terbitkan Konten
                </button>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        initQuillEditor('#editor', '#contentInput', '#postForm');
    });
</script>
@endpush
