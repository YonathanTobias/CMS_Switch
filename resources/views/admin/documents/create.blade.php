@extends('layouts.admin')

@section('title', 'Tambah Dokumen Baru')

@section('content')
<div class="max-w-4xl space-y-6">
    <div class="flex items-center space-x-3">
        <a href="{{ route('admin.documents.index') }}" class="p-2 rounded-xl bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 transition text-xs">
            <i class="fa-solid fa-arrow-left"></i>
        </a>
        <div>
            <h1 class="text-2xl font-extrabold text-slate-900">Tambah Dokumen Baru</h1>
            <p class="text-xs text-slate-500">Unggah berkas panduan, form permohonan, SOP, atau sematkan tautan Google Drive.</p>
        </div>
    </div>

    <form action="{{ route('admin.documents.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6"
          x-data="{ sourceType: '{{ old('source_type', 'file') }}' }">
        @csrf
        <div class="bg-white rounded-2xl p-6 sm:p-8 shadow-sm border border-slate-200 space-y-6">
            <div class="space-y-1">
                <label class="text-xs font-bold text-slate-700">Nama / Judul Dokumen <span class="text-rose-500">*</span></label>
                <input type="text" name="title" value="{{ old('title') }}" required class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:bg-white" placeholder="Contoh: Formulir Pengajuan Kaji Etik Penelitian (KEPK)">
            </div>

            <div class="space-y-1">
                <label class="text-xs font-bold text-slate-700">Kategori Dokumen</label>
                <select name="category_id" class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:bg-white">
                    <option value="">-- Pilih Kategori Dokumen --</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="space-y-1">
                <label class="text-xs font-bold text-slate-700">Deskripsi / Catatan Dokumen <span class="text-slate-400 font-normal">(Opsional)</span></label>
                <textarea name="description" rows="3" class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:bg-white" placeholder="Keterangan singkat peruntukan berkas ini...">{{ old('description') }}</textarea>
            </div>

            <!-- Pilihan Sumber Berkas (Upload File vs Google Drive) -->
            <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200 space-y-3">
                <label class="text-xs font-extrabold text-slate-800 uppercase tracking-wider block">Pilih Sumber Berkas Dokumen</label>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <label @click="sourceType = 'file'" :class="sourceType === 'file' ? 'border-sky-500 bg-sky-50/50 ring-2 ring-sky-500/20 shadow-sm' : 'border-slate-200 bg-white hover:border-slate-300'" class="flex items-start p-4 rounded-xl border cursor-pointer transition">
                        <input type="radio" name="source_type" value="file" :checked="sourceType === 'file'" class="mt-0.5 text-sky-600 focus:ring-sky-500">
                        <div class="ml-3">
                            <span class="block text-xs font-bold text-slate-800 flex items-center">
                                <i class="fa-solid fa-file-arrow-up mr-1.5 text-sky-600"></i> Upload File Komputer
                            </span>
                            <span class="block text-[11px] text-slate-500 mt-1 leading-relaxed">
                                Unggah langsung file dari perangkat Anda (PDF, Word, Excel, ZIP maks 25MB).
                            </span>
                        </div>
                    </label>

                    <label @click="sourceType = 'gdrive'" :class="sourceType === 'gdrive' ? 'border-sky-500 bg-sky-50/50 ring-2 ring-sky-500/20 shadow-sm' : 'border-slate-200 bg-white hover:border-slate-300'" class="flex items-start p-4 rounded-xl border cursor-pointer transition">
                        <input type="radio" name="source_type" value="gdrive" :checked="sourceType === 'gdrive'" class="mt-0.5 text-sky-600 focus:ring-sky-500">
                        <div class="ml-3">
                            <span class="block text-xs font-bold text-slate-800 flex items-center">
                                <i class="fa-brands fa-google-drive mr-1.5 text-amber-500"></i> Tautan Google Drive / Cloud
                            </span>
                            <span class="block text-[11px] text-slate-500 mt-1 leading-relaxed">
                                Tempel link Google Drive tanpa batasan ukuran file hosting server.
                            </span>
                        </div>
                    </label>
                </div>
            </div>

            <!-- Bagian A: Upload Berkas Komputer -->
            <div x-show="sourceType === 'file'" class="space-y-1 pt-2">
                <label class="text-xs font-bold text-slate-700">Pilih Berkas Dokumen <span class="text-rose-500">*</span></label>
                <input type="file" name="document_file" :required="sourceType === 'file'" class="text-xs text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-slate-100 file:text-slate-700 hover:file:bg-slate-200">
                <p class="text-[11px] text-slate-400">Mendukung file: PDF, DOC, DOCX, XLS, XLSX, PPT, ZIP. Maks 25MB.</p>
            </div>

            <!-- Bagian B: Tautan Google Drive -->
            <div x-show="sourceType === 'gdrive'" class="space-y-4 pt-2">
                <div class="space-y-1">
                    <label class="text-xs font-bold text-slate-700">Link / URL Google Drive <span class="text-rose-500">*</span></label>
                    <input type="url" name="gdrive_url" value="{{ old('gdrive_url') }}" :required="sourceType === 'gdrive'" class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:bg-white" placeholder="https://drive.google.com/file/d/... atau https://docs.google.com/...">
                    <p class="text-[11px] text-slate-400">Pastikan hak akses link Google Drive diatur ke <em>"Siapa saja yang memiliki link (Anyone with the link)"</em>.</p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="space-y-1">
                        <label class="text-xs font-bold text-slate-700">Format Dokumen di Drive</label>
                        <select name="custom_file_type" class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:bg-white">
                            <option value="GDRIVE">Google Drive (Folder/File)</option>
                            <option value="PDF">PDF Document</option>
                            <option value="DOCX">Word Document</option>
                            <option value="XLSX">Excel Spreadsheet</option>
                            <option value="PPTX">PowerPoint Presentation</option>
                            <option value="LINK">Link Cloud / Web Eksternal</option>
                        </select>
                    </div>

                    <div class="space-y-1">
                        <label class="text-xs font-bold text-slate-700">Keterangan Ukuran (Opsional)</label>
                        <input type="text" name="custom_file_size" value="{{ old('custom_file_size') }}" class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:bg-white" placeholder="Contoh: Google Drive atau 15 MB">
                    </div>
                </div>
            </div>

            <div class="flex items-center space-x-2 pt-4 border-t border-slate-100">
                <input type="checkbox" name="is_published" value="1" id="is_published" {{ old('is_published', true) ? 'checked' : '' }} class="rounded text-theme-primary">
                <label for="is_published" class="text-xs font-bold text-slate-700 cursor-pointer">Publikasikan Dokumen di Halaman Unduhan</label>
            </div>

            <div class="pt-4 border-t">
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-theme-primary text-white font-bold text-xs uppercase tracking-wider shadow hover:opacity-90 transition">
                    Simpan Dokumen
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
