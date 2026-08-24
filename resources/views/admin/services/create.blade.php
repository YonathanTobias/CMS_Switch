@extends('layouts.admin')

@section('title', 'Tambah Layanan Divisi')

@section('content')
<div class="max-w-4xl space-y-6">
    <div class="flex items-center space-x-3">
        <a href="{{ route('admin.services.index') }}" class="p-2 rounded-xl bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 transition text-xs">
            <i class="fa-solid fa-arrow-left"></i>
        </a>
        <div>
            <h1 class="text-2xl font-extrabold text-slate-900">Tambah Layanan Baru</h1>
            <p class="text-xs text-slate-500">Buat layanan baru beserta SOP dan berkas persyaratannya.</p>
        </div>
    </div>

    <form action="{{ route('admin.services.store') }}" method="POST" class="space-y-6">
        @csrf
        <div class="bg-white rounded-2xl p-6 sm:p-8 shadow-sm border border-slate-200 space-y-6">
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div class="space-y-1 sm:col-span-2">
                    <label class="text-xs font-bold text-slate-700">Nama Layanan <span class="text-rose-500">*</span></label>
                    <input type="text" name="title" value="{{ old('title') }}" required class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:bg-white" placeholder="Contoh: Layanan Kaji Etik Penelitian (KEPK)">
                </div>

                <div class="space-y-1">
                    <label class="text-xs font-bold text-slate-700">Ikon FontAwesome</label>
                    <input type="text" name="icon" value="{{ old('icon', 'fa-solid fa-briefcase-medical') }}" class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 border border-slate-200" placeholder="fa-solid fa-certificate">
                </div>
            </div>

            <div class="space-y-1">
                <label class="text-xs font-bold text-slate-700">Ringkasan Layanan (Singkat)</label>
                <textarea name="summary" rows="2" class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:bg-white" placeholder="Ringkasan 1-2 kalimat...">{{ old('summary') }}</textarea>
            </div>

            <div class="space-y-1">
                <label class="text-xs font-bold text-slate-700">Deskripsi Lengkap Layanan</label>
                <textarea name="description" rows="4" class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:bg-white">{{ old('description') }}</textarea>
            </div>

            <div class="space-y-1">
                <label class="text-xs font-bold text-slate-700">Persyaratan Berkas / Administrasi</label>
                <textarea name="requirements" rows="4" class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:bg-white" placeholder="1. Surat pengantar&#10;2. Lembar proposal..."></textarea>
            </div>

            <div class="space-y-1">
                <label class="text-xs font-bold text-slate-700">Alur Prosedur Pelayanan</label>
                <textarea name="procedure" rows="4" class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:bg-white" placeholder="1. Pemohon mengajukan berkas...&#10;2. Tim verifikasi..."></textarea>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 pt-4 border-t border-slate-100">
                <div class="space-y-1 sm:col-span-2">
                    <label class="text-xs font-bold text-slate-700">Link Unduh Formulir Terkait (Opsional)</label>
                    <input type="text" name="download_form_link" value="{{ old('download_form_link') }}" class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 border border-slate-200" placeholder="https://drive.google.com/... atau URL dokumen">
                </div>

                <div class="space-y-1">
                    <label class="text-xs font-bold text-slate-700">Urutan Tampil</label>
                    <input type="number" name="order_index" value="{{ old('order_index', 0) }}" class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 border border-slate-200">
                </div>
            </div>

            <div class="flex items-center space-x-2 pt-2">
                <input type="checkbox" name="is_active" value="1" id="is_active" {{ old('is_active', true) ? 'checked' : '' }} class="rounded text-theme-primary">
                <label for="is_active" class="text-xs font-bold text-slate-700 cursor-pointer">Layanan Aktif & Tampil di Web</label>
            </div>

            <div class="pt-4 border-t">
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-theme-primary text-white font-bold text-xs uppercase tracking-wider shadow hover:opacity-90 transition">
                    Simpan Layanan
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
