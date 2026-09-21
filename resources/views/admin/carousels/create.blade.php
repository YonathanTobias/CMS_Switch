@extends('layouts.admin')

@section('title', 'Tambah Slide Carousel Banner')

@section('content')
<div class="max-w-4xl space-y-6">
    <div class="flex items-center space-x-3">
        <a href="{{ route('admin.carousels.index') }}" class="p-2 rounded-xl bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 transition text-xs">
            <i class="fa-solid fa-arrow-left"></i>
        </a>
        <div>
            <h1 class="text-2xl font-extrabold text-slate-900">Tambah Slide Carousel Banner</h1>
            <p class="text-xs text-slate-500">Unggah gambar banner promosi, pengumuman utama, atau informasi penting.</p>
        </div>
    </div>

    <form action="{{ route('admin.carousels.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        <div class="bg-white rounded-2xl p-6 sm:p-8 shadow-sm border border-slate-200 space-y-6">
            
            <!-- File Gambar Banner Utama -->
            <div class="space-y-2">
                <label class="text-xs font-bold text-slate-700">File Gambar Banner <span class="text-rose-500">*</span></label>
                <input type="file" name="image" accept="image/*" required class="text-xs text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-slate-100 file:text-slate-700 hover:file:bg-slate-200">
                <div class="p-3 bg-sky-50 rounded-xl border border-sky-100 flex items-start space-x-2.5">
                    <i class="fa-solid fa-circle-info text-sky-600 text-xs mt-0.5"></i>
                    <p class="text-[11px] text-sky-800 leading-relaxed">
                        <strong>Tips Desain:</strong> Rekomendasi resolusi <strong>1920 x 700 / 800 px</strong> (Landscape HD). File otomatis dikompres format WebP agar loading super cepat.
                    </p>
                </div>
            </div>

            <!-- Teks Overlay Section -->
            <div class="space-y-4 pt-4 border-t border-slate-100">
                <div class="space-y-1">
                    <label class="text-xs font-bold text-slate-700">Judul Slide Banner <span class="text-slate-400 font-normal">(Opsional)</span></label>
                    <input type="text" name="title" value="{{ old('title') }}" class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:bg-white" placeholder="Contoh: Selamat Datang di Website Resmi SPMI STIKES (Kosongkan jika banner poster Canva/Photoshop)">
                    <p class="text-[11px] text-slate-400">Jika diisi, judul akan muncul di atas banner. Jika dikosongkan, gambar banner akan tampil 100% utuh dan jernih tanpa tulisan sistem.</p>
                </div>

                <div class="space-y-1">
                    <label class="text-xs font-bold text-slate-700">Subjudul / Keterangan Singkat <span class="text-slate-400 font-normal">(Opsional)</span></label>
                    <textarea name="subtitle" rows="3" class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:bg-white" placeholder="Keterangan singkat yang muncul di bawah judul slide...">{{ old('subtitle') }}</textarea>
                </div>
            </div>

            <!-- Tombol & Tautan -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-4 border-t border-slate-100">
                <div class="space-y-1">
                    <label class="text-xs font-bold text-slate-700">Teks Tombol Aksi <span class="text-slate-400 font-normal">(Opsional)</span></label>
                    <input type="text" name="button_text" value="{{ old('button_text') }}" class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 border border-slate-200" placeholder="Contoh: Pelajari Selengkapnya">
                </div>

                <div class="space-y-1">
                    <label class="text-xs font-bold text-slate-700">Tautan / Target URL <span class="text-slate-400 font-normal">(Opsional)</span></label>
                    <input type="text" name="button_link" value="{{ old('button_link') }}" class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 border border-slate-200" placeholder="https://... atau /berita atau /layanan">
                    <p class="text-[11px] text-slate-400">Jika banner tidak memiliki judul, seluruh area gambar banner otomatis bisa diklik menuju link ini.</p>
                </div>
            </div>

            <!-- Urutan & Status -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-4 border-t border-slate-100">
                <div class="space-y-1">
                    <label class="text-xs font-bold text-slate-700">Urutan Tampil (Sort Order)</label>
                    <input type="number" name="order_index" value="{{ old('order_index', 0) }}" class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 border border-slate-200">
                </div>

                <div class="flex items-center space-x-2 pt-6">
                    <input type="checkbox" name="is_active" value="1" id="is_active" {{ old('is_active', true) ? 'checked' : '' }} class="rounded text-theme-primary">
                    <label for="is_active" class="text-xs font-bold text-slate-700 cursor-pointer">Slide Aktif & Tampil di Beranda</label>
                </div>
            </div>

            <div class="pt-4 border-t">
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-theme-primary text-white font-bold text-xs uppercase tracking-wider shadow hover:opacity-90 transition">
                    Simpan Slide Carousel
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
