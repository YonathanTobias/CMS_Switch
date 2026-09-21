@extends('layouts.frontend')

@section('title', 'Pusat Unduhan - ' . get_setting('division_short_name', 'Divisi'))

@section('content')
<!-- Header -->
<div class="py-14 text-white" style="background: linear-gradient(135deg, var(--color-primary), var(--color-secondary));">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl space-y-2">
            <div class="text-xs uppercase tracking-wider font-semibold text-slate-200">Repository & Berkas</div>
            <h1 class="text-3xl sm:text-4xl font-extrabold">Pusat Unduhan Dokumen</h1>
            <p class="text-sm sm:text-base text-slate-100/90">Buku pedoman, SOP, formulir permohonan, dan surat keputusan resmi divisi.</p>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Search & Filter -->
    <div class="bg-white rounded-2xl p-4 sm:p-6 shadow-sm border border-slate-200 mb-8">
        <form action="{{ route('documents') }}" method="GET" class="flex flex-col sm:flex-row gap-4 justify-between items-center">
            <!-- Filter Categories -->
            <div class="flex flex-wrap gap-2 w-full sm:w-auto">
                <a href="{{ route('documents') }}" class="px-3.5 py-1.5 rounded-lg text-xs font-bold transition {{ !request('kategori') ? 'bg-theme-primary text-white shadow' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}">
                    Semua Kategori
                </a>
                @foreach($categories as $cat)
                <a href="{{ route('documents', ['kategori' => $cat->slug]) }}" class="px-3.5 py-1.5 rounded-lg text-xs font-bold transition {{ request('kategori') == $cat->slug ? 'bg-theme-primary text-white shadow' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}">
                    {{ $cat->name }} ({{ $cat->documents_count }})
                </a>
                @endforeach
            </div>

            <!-- Search input -->
            <div class="relative w-full sm:w-72">
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama berkas..." class="w-full pl-9 pr-4 py-2 rounded-xl text-xs bg-slate-50 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:bg-white">
                <i class="fa-solid fa-magnifying-glass absolute left-3 top-2.5 text-slate-400 text-xs"></i>
            </div>
        </form>
    </div>

    <!-- Documents List Table / Cards -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="divide-y divide-slate-200">
            @forelse($documents as $doc)
            <div class="p-5 sm:p-6 hover:bg-slate-50 transition flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    @php
                        $isUrl = str_starts_with($doc->file_path, 'http');
                    @endphp
                    <div class="w-12 h-12 rounded-xl flex items-center justify-center text-xl flex-shrink-0 border 
                        @if($doc->file_type == 'GDRIVE') bg-amber-50 text-amber-600 border-amber-200
                        @elseif($doc->file_type == 'PDF') bg-rose-50 text-rose-600 border-rose-100
                        @elseif(in_array($doc->file_type, ['DOC', 'DOCX'])) bg-blue-50 text-blue-600 border-blue-100
                        @elseif(in_array($doc->file_type, ['XLS', 'XLSX'])) bg-emerald-50 text-emerald-600 border-emerald-100
                        @elseif(in_array($doc->file_type, ['PPT', 'PPTX'])) bg-orange-50 text-orange-600 border-orange-100
                        @elseif(in_array($doc->file_type, ['ZIP', 'RAR'])) bg-purple-50 text-purple-600 border-purple-100
                        @else bg-slate-50 text-slate-600 border-slate-200 @endif">
                        
                        @if($doc->file_type == 'GDRIVE')
                            <i class="fa-brands fa-google-drive"></i>
                        @elseif($doc->file_type == 'PDF')
                            <i class="fa-solid fa-file-pdf"></i>
                        @elseif(in_array($doc->file_type, ['DOC', 'DOCX']))
                            <i class="fa-solid fa-file-word"></i>
                        @elseif(in_array($doc->file_type, ['XLS', 'XLSX']))
                            <i class="fa-solid fa-file-excel"></i>
                        @elseif(in_array($doc->file_type, ['PPT', 'PPTX']))
                            <i class="fa-solid fa-file-powerpoint"></i>
                        @elseif(in_array($doc->file_type, ['ZIP', 'RAR']))
                            <i class="fa-solid fa-file-zipper"></i>
                        @else
                            <i class="fa-solid fa-file-lines"></i>
                        @endif
                    </div>

                    <div class="space-y-1">
                        <h3 class="text-sm sm:text-base font-bold text-slate-900 leading-snug">{{ $doc->title }}</h3>
                        @if($doc->description)
                            <p class="text-xs text-slate-500 leading-relaxed max-w-2xl">{{ $doc->description }}</p>
                        @endif
                        <div class="flex flex-wrap items-center gap-3 text-xs text-slate-400 pt-1">
                            @if($doc->category)
                                <span class="px-2 py-0.5 rounded bg-slate-100 text-slate-600 text-[10px] font-semibold">{{ $doc->category->name }}</span>
                            @endif
                            <span><i class="fa-solid fa-hard-drive mr-1"></i> {{ $doc->file_size ?: 'Unknown' }}</span>
                            <span><i class="fa-solid fa-download mr-1"></i> {{ $doc->downloads_count }} kali diunduh</span>
                            <span><i class="fa-regular fa-calendar mr-1"></i> Diperbarui {{ $doc->updated_at->translatedFormat('d M Y') }}</span>
                        </div>
                    </div>
                </div>

                <div class="flex-shrink-0 self-end sm:self-center">
                    <a href="{{ route('documents.download', $doc->id) }}" {{ $isUrl ? 'target=_blank rel=noopener' : '' }} class="px-4 py-2.5 rounded-xl bg-theme-primary text-white font-bold text-xs inline-flex items-center shadow hover:opacity-90 transition">
                        @if($isUrl)
                            <i class="fa-solid fa-arrow-up-right-from-square mr-2"></i> Buka / Unduh
                        @else
                            <i class="fa-solid fa-download mr-2"></i> Unduh Berkas
                        @endif
                    </a>
                </div>
            </div>
            @empty
            <div class="text-center py-16 text-slate-400">
                <i class="fa-regular fa-folder-open text-4xl mb-3"></i>
                <p class="text-sm font-semibold">Tidak ada dokumen yang ditemukan.</p>
            </div>
            @endforelse
        </div>
    </div>

    <div class="mt-8">
        {{ $documents->links() }}
    </div>
</div>
@endsection
