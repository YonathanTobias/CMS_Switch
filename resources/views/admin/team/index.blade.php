@extends('layouts.admin')

@section('title', 'Struktur Organisasi & Tim')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-2xl font-extrabold text-slate-900">Struktur Organisasi & Tim</h1>
            <p class="text-xs text-slate-500 mt-1">Kelola data pimpinan, ketua prodi/unit, koordinator, staf, dan dosen.</p>
        </div>
        <a href="{{ route('admin.team.create') }}" class="px-5 py-2.5 rounded-xl bg-theme-primary text-white font-bold text-xs uppercase tracking-wider shadow hover:opacity-90 transition flex items-center">
            <i class="fa-solid fa-plus mr-2"></i> Tambah Personil Organisasi
        </a>
    </div>

    <!-- Team Members Table -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-slate-600">
                <thead class="bg-slate-50 border-b border-slate-200 text-slate-700 font-bold uppercase text-[10px] tracking-wider">
                    <tr>
                        <th class="p-4">Urutan</th>
                        <th class="p-4">Foto & Nama</th>
                        <th class="p-4">Jabatan</th>
                        <th class="p-4">NIDN / NIP</th>
                        <th class="p-4">Kontak</th>
                        <th class="p-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($members as $tm)
                    <tr class="hover:bg-slate-50 transition">
                        <td class="p-4 font-bold text-slate-400">#{{ $tm->order_index }}</td>
                        <td class="p-4 flex items-center space-x-3">
                            <div class="w-10 h-10 rounded-full bg-slate-200 overflow-hidden flex-shrink-0 border border-slate-300">
                                @if($tm->photo)
                                    <img src="{{ $tm->photo }}" alt="" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-slate-400"><i class="fa-solid fa-user"></i></div>
                                @endif
                            </div>
                            <div>
                                <div class="font-bold text-slate-900">{{ $tm->name }}</div>
                                @if($tm->title_degree)
                                    <div class="text-[11px] text-slate-500">{{ $tm->title_degree }}</div>
                                @endif
                            </div>
                        </td>
                        <td class="p-4 font-semibold text-theme-primary">{{ $tm->position }}</td>
                        <td class="p-4 font-mono text-[11px]">{{ $tm->identifier ?: '-' }}</td>
                        <td class="p-4 text-[11px]">
                            @if($tm->email)<div><i class="fa-regular fa-envelope text-slate-400 mr-1"></i> {{ $tm->email }}</div>@endif
                            @if($tm->phone)<div><i class="fa-solid fa-phone text-slate-400 mr-1"></i> {{ $tm->phone }}</div>@endif
                        </td>
                        <td class="p-4 text-right space-x-2">
                            <a href="{{ route('admin.team.edit', $tm->id) }}" class="p-1.5 rounded-lg text-sky-600 hover:bg-sky-50 transition" title="Edit"><i class="fa-regular fa-pen-to-square"></i></a>
                            <form action="{{ route('admin.team.destroy', $tm->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus data personil ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-1.5 rounded-lg text-rose-600 hover:bg-rose-50 transition" title="Hapus"><i class="fa-regular fa-trash-can"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="p-8 text-center text-slate-400">Belum ada personil atau susunan struktur organisasi yang ditambahkan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
