@extends('layouts.admin')

@section('title', 'Manajemen Layanan Divisi')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-2xl font-extrabold text-slate-900">Layanan & Prosedur Divisi</h1>
            <p class="text-xs text-slate-500 mt-1">Kelola katalog layanan, persyaratan, alur prosedur, dan link unduh formulir.</p>
        </div>
        <a href="{{ route('admin.services.create') }}" class="px-5 py-2.5 rounded-xl bg-theme-primary text-white font-bold text-xs uppercase tracking-wider shadow hover:opacity-90 transition flex items-center">
            <i class="fa-solid fa-plus mr-2"></i> Tambah Layanan Baru
        </a>
    </div>

    <!-- Services Table -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-slate-600">
                <thead class="bg-slate-50 border-b border-slate-200 text-slate-700 font-bold uppercase text-[10px] tracking-wider">
                    <tr>
                        <th class="p-4">Urutan</th>
                        <th class="p-4">Nama Layanan</th>
                        <th class="p-4">Ikon</th>
                        <th class="p-4">Formulir</th>
                        <th class="p-4">Status</th>
                        <th class="p-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($services as $svc)
                    <tr class="hover:bg-slate-50 transition">
                        <td class="p-4 font-bold text-slate-400">#{{ $svc->order_index }}</td>
                        <td class="p-4">
                            <div class="font-bold text-slate-900 leading-snug">{{ $svc->title }}</div>
                            <div class="text-[11px] text-slate-400 mt-0.5 line-clamp-1">{{ $svc->summary }}</div>
                        </td>
                        <td class="p-4">
                            <div class="w-8 h-8 rounded-lg bg-sky-50 text-sky-600 flex items-center justify-center text-sm border border-sky-100">
                                <i class="{{ $svc->icon ?: 'fa-solid fa-bell-concierge' }}"></i>
                            </div>
                        </td>
                        <td class="p-4">
                            @if($svc->download_form_link)
                                <a href="{{ $svc->download_form_link }}" target="_blank" class="text-sky-600 hover:underline flex items-center font-semibold text-[11px]">
                                    <i class="fa-solid fa-file-arrow-down mr-1"></i> Tersedia
                                </a>
                            @else
                                <span class="text-slate-400">-</span>
                            @endif
                        </td>
                        <td class="p-4">
                            @if($svc->is_active)
                                <span class="px-2 py-0.5 rounded-full bg-emerald-50 text-emerald-700 text-[10px] font-bold border border-emerald-200">Aktif</span>
                            @else
                                <span class="px-2 py-0.5 rounded-full bg-slate-100 text-slate-600 text-[10px] font-bold">Non-aktif</span>
                            @endif
                        </td>
                        <td class="p-4 text-right space-x-2">
                            <a href="{{ route('services.detail', $svc->slug) }}" target="_blank" class="p-1.5 rounded-lg text-slate-400 hover:text-slate-700 hover:bg-slate-100 transition" title="Lihat"><i class="fa-regular fa-eye"></i></a>
                            <a href="{{ route('admin.services.edit', $svc->id) }}" class="p-1.5 rounded-lg text-sky-600 hover:bg-sky-50 transition" title="Edit"><i class="fa-regular fa-pen-to-square"></i></a>
                            <form action="{{ route('admin.services.destroy', $svc->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus layanan ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-1.5 rounded-lg text-rose-600 hover:bg-rose-50 transition" title="Hapus"><i class="fa-regular fa-trash-can"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="p-8 text-center text-slate-400">Belum ada layanan yang ditambahkan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
