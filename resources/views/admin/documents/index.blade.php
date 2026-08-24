@extends('layouts.admin')

@section('title', 'Manajemen Dokumen & Unduhan')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-2xl font-extrabold text-slate-900">Pusat Unduhan Dokumen</h1>
            <p class="text-xs text-slate-500 mt-1">Upload formulir, buku pedoman, SOP, dan file unduhan untuk sivitas akademika.</p>
        </div>
        <a href="{{ route('admin.documents.create') }}" class="px-5 py-2.5 rounded-xl bg-theme-primary text-white font-bold text-xs uppercase tracking-wider shadow hover:opacity-90 transition flex items-center">
            <i class="fa-solid fa-cloud-arrow-up mr-2"></i> Upload Dokumen Baru
        </a>
    </div>

    <!-- Documents Table -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-slate-600">
                <thead class="bg-slate-50 border-b border-slate-200 text-slate-700 font-bold uppercase text-[10px] tracking-wider">
                    <tr>
                        <th class="p-4">Dokumen</th>
                        <th class="p-4">Kategori</th>
                        <th class="p-4">Tipe & Ukuran</th>
                        <th class="p-4">Download</th>
                        <th class="p-4">Status</th>
                        <th class="p-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($documents as $doc)
                    <tr class="hover:bg-slate-50 transition">
                        <td class="p-4 flex items-center space-x-3">
                            <div class="w-9 h-9 rounded-lg bg-rose-50 text-rose-600 flex items-center justify-center text-sm font-bold flex-shrink-0 border border-rose-100">
                                @if($doc->file_type == 'PDF')
                                    <i class="fa-solid fa-file-pdf"></i>
                                @else
                                    <i class="fa-solid fa-file-lines"></i>
                                @endif
                            </div>
                            <div class="max-w-xs sm:max-w-md">
                                <div class="font-bold text-slate-900 leading-snug">{{ $doc->title }}</div>
                                <div class="text-[11px] text-slate-400 mt-0.5 line-clamp-1">{{ $doc->description }}</div>
                            </div>
                        </td>
                        <td class="p-4">
                            <span class="px-2 py-0.5 rounded bg-slate-100 text-slate-600 font-semibold text-[10px]">
                                {{ $doc->category ? $doc->category->name : 'Umum' }}
                            </span>
                        </td>
                        <td class="p-4 font-mono text-[11px]">
                            {{ $doc->file_type }} ({{ $doc->file_size }})
                        </td>
                        <td class="p-4 font-semibold text-slate-700">
                            {{ $doc->downloads_count }}x
                        </td>
                        <td class="p-4">
                            @if($doc->is_published)
                                <span class="px-2 py-0.5 rounded-full bg-emerald-50 text-emerald-700 text-[10px] font-bold border border-emerald-200">Aktif</span>
                            @else
                                <span class="px-2 py-0.5 rounded-full bg-slate-100 text-slate-600 text-[10px] font-bold">Draft</span>
                            @endif
                        </td>
                        <td class="p-4 text-right space-x-2">
                            <a href="{{ route('documents.download', $doc->id) }}" class="p-1.5 rounded-lg text-slate-400 hover:text-slate-700 hover:bg-slate-100 transition" title="Unduh"><i class="fa-solid fa-download"></i></a>
                            <a href="{{ route('admin.documents.edit', $doc->id) }}" class="p-1.5 rounded-lg text-sky-600 hover:bg-sky-50 transition" title="Edit"><i class="fa-regular fa-pen-to-square"></i></a>
                            <form action="{{ route('admin.documents.destroy', $doc->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus dokumen ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-1.5 rounded-lg text-rose-600 hover:bg-rose-50 transition" title="Hapus"><i class="fa-regular fa-trash-can"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="p-8 text-center text-slate-400">Belum ada dokumen yang diunggah.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-6">
        {{ $documents->links() }}
    </div>
</div>
@endsection
