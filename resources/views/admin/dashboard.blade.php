@extends('layouts.admin')

@section('title', 'Dashboard Overview')

@section('content')
<div class="space-y-8">
    <!-- Welcome Division Card -->
    <div class="bg-gradient-to-r from-slate-900 via-slate-800 to-slate-900 rounded-3xl p-6 sm:p-8 text-white shadow-xl flex flex-col md:flex-row justify-between items-start md:items-center gap-6 border border-slate-700/50">
        <div class="space-y-2">
            <div class="inline-flex items-center space-x-2 bg-white/10 px-3 py-1 rounded-full text-xs font-semibold uppercase text-sky-400">
                <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                <span>Mode Aktif: {{ get_setting('division_acronym', 'DIVISI') }}</span>
            </div>
            <h1 class="text-2xl sm:text-3xl font-extrabold">{{ get_setting('division_name', 'Divisi STIKES Panti Waluya') }}</h1>
            <p class="text-xs sm:text-sm text-slate-300 max-w-2xl">{{ get_setting('division_tagline', 'Kelola seluruh informasi, berita, layanan, dan dokumen divisi dari satu dashboard terpadu.') }}</p>
        </div>

        <div class="flex flex-wrap gap-3 flex-shrink-0">
            @if(Auth::check() && Auth::user()->isSuperAdmin())
            <a href="{{ route('admin.settings.index') }}" class="px-5 py-2.5 rounded-xl bg-amber-500 hover:bg-amber-600 text-slate-950 font-bold text-xs uppercase tracking-wider transition shadow flex items-center">
                <i class="fa-solid fa-wand-magic-sparkles mr-2"></i> Kustom / Ganti Preset Divisi
            </a>
            @endif
            <a href="{{ route('home') }}" target="_blank" class="px-5 py-2.5 rounded-xl bg-white/15 hover:bg-white/25 text-white font-bold text-xs uppercase tracking-wider transition border border-white/20 flex items-center">
                <i class="fa-solid fa-eye mr-2"></i> Pratinjau Web
            </a>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-200 flex items-center justify-between">
            <div>
                <div class="text-xs text-slate-500 font-bold uppercase tracking-wider">Berita & Info</div>
                <div class="text-2xl font-black text-slate-900 mt-1">{{ $stats['posts_count'] }}</div>
            </div>
            <div class="w-12 h-12 rounded-xl bg-sky-50 text-sky-600 flex items-center justify-center text-xl">
                <i class="fa-regular fa-newspaper"></i>
            </div>
        </div>

        <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-200 flex items-center justify-between">
            <div>
                <div class="text-xs text-slate-500 font-bold uppercase tracking-wider">Layanan Divisi</div>
                <div class="text-2xl font-black text-slate-900 mt-1">{{ $stats['services_count'] }}</div>
            </div>
            <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-xl">
                <i class="fa-solid fa-briefcase-medical"></i>
            </div>
        </div>

        <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-200 flex items-center justify-between">
            <div>
                <div class="text-xs text-slate-500 font-bold uppercase tracking-wider">Agenda Kegiatan</div>
                <div class="text-2xl font-black text-slate-900 mt-1">{{ $stats['events_count'] }}</div>
            </div>
            <div class="w-12 h-12 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center text-xl">
                <i class="fa-regular fa-calendar-days"></i>
            </div>
        </div>

        <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-200 flex items-center justify-between">
            <div>
                <div class="text-xs text-slate-500 font-bold uppercase tracking-wider">Pusat Unduhan</div>
                <div class="text-2xl font-black text-slate-900 mt-1">{{ $stats['documents_count'] }}</div>
            </div>
            <div class="w-12 h-12 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center text-xl">
                <i class="fa-solid fa-file-arrow-down"></i>
            </div>
        </div>
    </div>

    <!-- Tables & Recent Items Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <!-- Recent Posts (7 cols) -->
        <div class="lg:col-span-7 bg-white rounded-2xl p-6 shadow-sm border border-slate-200 space-y-4">
            <div class="flex justify-between items-center pb-2 border-b border-slate-100">
                <h3 class="font-bold text-sm text-slate-900 flex items-center">
                    <i class="fa-regular fa-newspaper mr-2 text-theme-primary"></i> Berita & Pengumuman Terbaru
                </h3>
                <a href="{{ route('admin.posts.index') }}" class="text-xs font-bold text-theme-primary hover:underline">Semua &rarr;</a>
            </div>

            <div class="divide-y divide-slate-100">
                @forelse($recentPosts as $post)
                <div class="py-3 flex items-center justify-between gap-4">
                    <div class="overflow-hidden">
                        <div class="flex items-center space-x-2">
                            <span class="px-2 py-0.5 rounded text-[9px] font-bold uppercase tracking-wider text-white {{ $post->type == 'pengumuman' ? 'bg-amber-600' : 'bg-sky-600' }}">{{ $post->type }}</span>
                            <span class="text-xs font-bold text-slate-800 truncate">{{ $post->title }}</span>
                        </div>
                        <div class="text-[11px] text-slate-400 mt-1">{{ $post->published_at ? $post->published_at->translatedFormat('d M Y') : '' }} • {{ $post->views_count }} views</div>
                    </div>
                    <a href="{{ route('admin.posts.edit', $post->id) }}" class="p-1.5 rounded-lg text-slate-400 hover:text-slate-700 hover:bg-slate-100 transition text-xs">
                        <i class="fa-regular fa-pen-to-square"></i>
                    </a>
                </div>
                @empty
                <div class="py-6 text-center text-xs text-slate-400">Belum ada konten berita.</div>
                @endforelse
            </div>
        </div>

        <!-- Recent Messages (5 cols) -->
        <div class="lg:col-span-5 bg-white rounded-2xl p-6 shadow-sm border border-slate-200 space-y-4">
            <div class="flex justify-between items-center pb-2 border-b border-slate-100">
                <h3 class="font-bold text-sm text-slate-900 flex items-center">
                    <i class="fa-regular fa-envelope mr-2 text-emerald-600"></i> Pesan & Pertanyaan Masuk
                </h3>
                <a href="{{ route('admin.messages.index') }}" class="text-xs font-bold text-theme-primary hover:underline">Semua &rarr;</a>
            </div>

            <div class="divide-y divide-slate-100">
                @forelse($recentMessages as $msg)
                <div class="py-3 flex items-start justify-between gap-3">
                    <div class="overflow-hidden space-y-0.5">
                        <div class="flex items-center space-x-2">
                            @if(!$msg->is_read)
                                <span class="w-2 h-2 rounded-full bg-rose-500 flex-shrink-0"></span>
                            @endif
                            <span class="text-xs font-bold text-slate-800 truncate">{{ $msg->name }}</span>
                        </div>
                        <div class="text-[11px] font-semibold text-slate-600 truncate">{{ $msg->subject }}</div>
                        <div class="text-[10px] text-slate-400">{{ $msg->created_at->diffForHumans() }}</div>
                    </div>
                    <a href="{{ route('admin.messages.show', $msg->id) }}" class="px-2.5 py-1 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold transition flex-shrink-0">
                        Buka
                    </a>
                </div>
                @empty
                <div class="py-6 text-center text-xs text-slate-400">Belum ada pesan masuk.</div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
