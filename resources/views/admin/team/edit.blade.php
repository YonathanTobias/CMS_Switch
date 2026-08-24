@extends('layouts.admin')

@section('title', 'Edit Personil - ' . $member->name)

@section('content')
<div class="max-w-4xl space-y-6">
    <div class="flex items-center space-x-3">
        <a href="{{ route('admin.team.index') }}" class="p-2 rounded-xl bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 transition text-xs">
            <i class="fa-solid fa-arrow-left"></i>
        </a>
        <div>
            <h1 class="text-2xl font-extrabold text-slate-900">Edit Personil Organisasi</h1>
            <p class="text-xs text-slate-500">Perbarui data personalia struktur organisasi.</p>
        </div>
    </div>

    <form action="{{ route('admin.team.update', $member->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')
        <div class="bg-white rounded-2xl p-6 sm:p-8 shadow-sm border border-slate-200 space-y-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="space-y-1">
                    <label class="text-xs font-bold text-slate-700">Nama Lengkap <span class="text-rose-500">*</span></label>
                    <input type="text" name="name" value="{{ old('name', $member->name) }}" required class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:bg-white">
                </div>

                <div class="space-y-1">
                    <label class="text-xs font-bold text-slate-700">Gelar / Kualifikasi</label>
                    <input type="text" name="title_degree" value="{{ old('title_degree', $member->title_degree) }}" class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:bg-white">
                </div>

                <div class="space-y-1">
                    <label class="text-xs font-bold text-slate-700">Jabatan di Divisi <span class="text-rose-500">*</span></label>
                    <input type="text" name="position" value="{{ old('position', $member->position) }}" required class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:bg-white">
                </div>

                <div class="space-y-1">
                    <label class="text-xs font-bold text-slate-700">Nomor Induk (NIDN / NIP)</label>
                    <input type="text" name="identifier" value="{{ old('identifier', $member->identifier) }}" class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:bg-white">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="space-y-1">
                    <label class="text-xs font-bold text-slate-700">Email Resmi</label>
                    <input type="email" name="email" value="{{ old('email', $member->email) }}" class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 border border-slate-200">
                </div>

                <div class="space-y-1">
                    <label class="text-xs font-bold text-slate-700">No. Telepon / WhatsApp</label>
                    <input type="text" name="phone" value="{{ old('phone', $member->phone) }}" class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 border border-slate-200">
                </div>
            </div>

            <div class="space-y-1">
                <label class="text-xs font-bold text-slate-700">Biografi Singkat / Bidang Keahlian</label>
                <textarea name="bio" rows="3" class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:bg-white">{{ old('bio', $member->bio) }}</textarea>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-4 border-t border-slate-100">
                <div class="space-y-2">
                    <label class="text-xs font-bold text-slate-700">Foto Profil</label>
                    <div class="flex items-center space-x-3">
                        @if($member->photo)
                            <img src="{{ $member->photo }}" alt="" class="w-12 h-12 rounded-full object-cover border">
                        @endif
                        <input type="file" name="photo" accept="image/*" class="text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-slate-100 file:text-slate-700 hover:file:bg-slate-200">
                    </div>
                </div>

                <div class="space-y-1">
                    <label class="text-xs font-bold text-slate-700">Urutan Tampil</label>
                    <input type="number" name="order_index" value="{{ old('order_index', $member->order_index) }}" class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 border border-slate-200">
                </div>
            </div>

            <div class="pt-4 border-t flex items-center justify-between">
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-theme-primary text-white font-bold text-xs uppercase tracking-wider shadow hover:opacity-90 transition">
                    Perbarui Data Personil
                </button>
                <a href="{{ route('admin.team.index') }}" class="text-xs text-slate-500 hover:underline">Batal</a>
            </div>
        </div>
    </form>
</div>
@endsection
