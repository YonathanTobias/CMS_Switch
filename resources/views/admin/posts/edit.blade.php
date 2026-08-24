@extends('layouts.admin')

@section('title', 'Edit Konten - ' . $post->title)

@section('content')
<div class="max-w-4xl space-y-6">
    <div class="flex items-center space-x-3">
        <a href="{{ route('admin.posts.index') }}" class="p-2 rounded-xl bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 transition text-xs">
            <i class="fa-solid fa-arrow-left"></i>
        </a>
        <div>
            <h1 class="text-2xl font-extrabold text-slate-900">Edit Konten</h1>
            <p class="text-xs text-slate-500">Perbarui rincian berita atau pengumuman.</p>
        </div>
    </div>

    <form action="{{ route('admin.posts.update', $post->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6" id="postForm">
        @csrf
        @method('PUT')
        <div class="bg-white rounded-2xl p-6 sm:p-8 shadow-sm border border-slate-200 space-y-6">
            <div class="space-y-1">
                <label class="text-xs font-bold text-slate-700">Judul Konten <span class="text-rose-500">*</span></label>
                <input type="text" name="title" value="{{ old('title', $post->title) }}" required class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:bg-white">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="space-y-1">
                    <label class="text-xs font-bold text-slate-700">Jenis Konten <span class="text-rose-500">*</span></label>
                    <select name="type" required class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:bg-white">
                        <option value="berita" {{ old('type', $post->type) == 'berita' ? 'selected' : '' }}>Berita & Liputan Kegiatan</option>
                        <option value="pengumuman" {{ old('type', $post->type) == 'pengumuman' ? 'selected' : '' }}>Pengumuman / Surat Edaran</option>
                    </select>
                </div>

                <div class="space-y-1">
                    <label class="text-xs font-bold text-slate-700">Kategori</label>
                    <select name="category_id" class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:bg-white">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id', $post->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="space-y-1">
                <label class="text-xs font-bold text-slate-700">Ringkasan Singkat (Summary)</label>
                <textarea name="summary" rows="2" class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:bg-white">{{ old('summary', $post->summary) }}</textarea>
            </div>

            <!-- WYSIWYG Content Area -->
            <div class="space-y-1">
                <label class="text-xs font-bold text-slate-700">Isi Konten Lengkap <span class="text-rose-500">*</span></label>
                <input type="hidden" name="content" id="contentInput" value="{{ old('content', $post->content) }}">
                <div id="editor" class="bg-white rounded-xl min-h-[250px]">
                    {!! old('content', $post->content) !!}
                </div>
            </div>

            <!-- Thumbnail Upload -->
            <div class="space-y-2 pt-4 border-t border-slate-100">
                <label class="text-xs font-bold text-slate-700">Foto Sampul / Thumbnail</label>
                <div class="flex items-center space-x-4">
                    @if($post->thumbnail)
                        <img src="{{ $post->thumbnail }}" alt="" class="w-16 h-16 object-cover rounded-xl border">
                    @endif
                    <input type="file" name="thumbnail" accept="image/*" class="text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-slate-100 file:text-slate-700 hover:file:bg-slate-200">
                </div>
            </div>

            <!-- Publication Settings -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 pt-4 border-t border-slate-100">
                <div class="space-y-1">
                    <label class="text-xs font-bold text-slate-700">Tanggal Publikasi</label>
                    <input type="datetime-local" name="published_at" value="{{ old('published_at', $post->published_at ? $post->published_at->format('Y-m-d\TH:i') : '') }}" class="w-full px-3 py-2 rounded-xl text-xs bg-slate-50 border border-slate-200">
                </div>

                <div class="flex items-center space-x-2 pt-6">
                    <input type="checkbox" name="is_featured" value="1" id="is_featured" {{ old('is_featured', $post->is_featured) ? 'checked' : '' }} class="rounded text-theme-primary">
                    <label for="is_featured" class="text-xs font-bold text-slate-700 cursor-pointer">Jadikan Sorotan (Featured)</label>
                </div>

                <div class="flex items-center space-x-2 pt-6">
                    <input type="checkbox" name="is_published" value="1" id="is_published" {{ old('is_published', $post->is_published) ? 'checked' : '' }} class="rounded text-theme-primary">
                    <label for="is_published" class="text-xs font-bold text-slate-700 cursor-pointer">Status Terbit (Publish)</label>
                </div>
            </div>

            <div class="pt-4 border-t flex items-center justify-between">
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-theme-primary text-white font-bold text-xs uppercase tracking-wider shadow hover:opacity-90 transition">
                    Simpan Perubahan
                </button>
                <a href="{{ route('admin.posts.index') }}" class="text-xs text-slate-500 hover:underline">Batal</a>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var quill = new Quill('#editor', {
            theme: 'snow',
            modules: {
                toolbar: [
                    [{ 'header': [1, 2, 3, false] }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    ['link', 'blockquote', 'code-block'],
                    ['clean']
                ]
            }
        });

        var form = document.getElementById('postForm');
        form.onsubmit = function() {
            var contentInput = document.getElementById('contentInput');
            contentInput.value = quill.root.innerHTML;
        };
    });
</script>
@endpush
