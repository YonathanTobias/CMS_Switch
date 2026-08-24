@extends('layouts.admin')

@section('title', 'Edit Agenda - ' . $event->title)

@section('content')
<div class="max-w-4xl space-y-6">
    <div class="flex items-center space-x-3">
        <a href="{{ route('admin.events.index') }}" class="p-2 rounded-xl bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 transition text-xs">
            <i class="fa-solid fa-arrow-left"></i>
        </a>
        <div>
            <h1 class="text-2xl font-extrabold text-slate-900">Edit Agenda Kegiatan</h1>
            <p class="text-xs text-slate-500">Perbarui jadwal, lokasi, atau poster acara.</p>
        </div>
    </div>

    <form action="{{ route('admin.events.update', $event->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')
        <div class="bg-white rounded-2xl p-6 sm:p-8 shadow-sm border border-slate-200 space-y-6">
            <div class="space-y-1">
                <label class="text-xs font-bold text-slate-700">Nama / Judul Kegiatan <span class="text-rose-500">*</span></label>
                <input type="text" name="title" value="{{ old('title', $event->title) }}" required class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:bg-white">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="space-y-1">
                    <label class="text-xs font-bold text-slate-700">Waktu Mulai <span class="text-rose-500">*</span></label>
                    <input type="datetime-local" name="start_date" value="{{ old('start_date', $event->start_date ? $event->start_date->format('Y-m-d\TH:i') : '') }}" required class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 border border-slate-200">
                </div>

                <div class="space-y-1">
                    <label class="text-xs font-bold text-slate-700">Waktu Selesai (Opsional)</label>
                    <input type="datetime-local" name="end_date" value="{{ old('end_date', $event->end_date ? $event->end_date->format('Y-m-d\TH:i') : '') }}" class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 border border-slate-200">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="space-y-1">
                    <label class="text-xs font-bold text-slate-700">Tempat / Lokasi</label>
                    <input type="text" name="location" value="{{ old('location', $event->location) }}" class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 border border-slate-200">
                </div>

                <div class="space-y-1">
                    <label class="text-xs font-bold text-slate-700">Link Pendaftaran / Registrasi</label>
                    <input type="text" name="registration_link" value="{{ old('registration_link', $event->registration_link) }}" class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 border border-slate-200">
                </div>
            </div>

            <div class="space-y-1">
                <label class="text-xs font-bold text-slate-700">Deskripsi & Rincian Agenda</label>
                <textarea name="description" rows="4" class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:bg-white">{{ old('description', $event->description) }}</textarea>
            </div>

            <div class="space-y-2 pt-4 border-t border-slate-100">
                <label class="text-xs font-bold text-slate-700">Poster / Banner Kegiatan</label>
                <div class="flex items-center space-x-3">
                    @if($event->poster)
                        <img src="{{ $event->poster }}" alt="" class="w-16 h-16 object-cover rounded-xl border">
                    @endif
                    <input type="file" name="poster" accept="image/*" class="text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-slate-100 file:text-slate-700 hover:file:bg-slate-200">
                </div>
            </div>

            <div class="flex items-center space-x-2 pt-2">
                <input type="checkbox" name="is_active" value="1" id="is_active" {{ old('is_active', $event->is_active) ? 'checked' : '' }} class="rounded text-theme-primary">
                <label for="is_active" class="text-xs font-bold text-slate-700 cursor-pointer">Agenda Aktif & Tampil di Kalender</label>
            </div>

            <div class="pt-4 border-t flex items-center justify-between">
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-theme-primary text-white font-bold text-xs uppercase tracking-wider shadow hover:opacity-90 transition">
                    Simpan Perubahan
                </button>
                <a href="{{ route('admin.events.index') }}" class="text-xs text-slate-500 hover:underline">Batal</a>
            </div>
        </div>
    </form>
</div>
@endsection
