@extends('layouts.frontend')

@section('title', $post->title . ' - ' . get_setting('division_short_name', 'Divisi'))

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <!-- Breadcrumb -->
    <div class="flex items-center space-x-2 text-xs text-slate-500 mb-6">
        <a href="{{ route('home') }}" class="hover:text-theme-primary">Beranda</a>
        <span>/</span>
        <a href="{{ route('posts', ['type' => $post->type]) }}" class="hover:text-theme-primary capitalize">{{ $post->type }}</a>
        <span>/</span>
        <span class="text-slate-700 truncate max-w-xs sm:max-w-md">{{ $post->title }}</span>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
        <!-- Main Article (8 cols) -->
        <article class="lg:col-span-8 space-y-6">
            <!-- Article Header -->
            <div class="space-y-3">
                <div class="flex flex-wrap items-center gap-2">
                    <span class="px-2.5 py-1 rounded-md text-[10px] font-bold uppercase tracking-wider text-white {{ $post->type == 'pengumuman' ? 'bg-amber-600' : 'bg-sky-600' }}">
                        {{ $post->type }}
                    </span>
                    @if($post->category)
                        <span class="px-2.5 py-1 rounded-md text-[10px] font-bold bg-slate-100 text-slate-700">
                            {{ $post->category->name }}
                        </span>
                    @endif
                </div>

                <h1 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-slate-900 leading-tight">
                    {{ $post->title }}
                </h1>

                <div class="flex items-center text-xs text-slate-500 space-x-4 pt-1 pb-4 border-b border-slate-200">
                    <span><i class="fa-regular fa-calendar mr-1"></i> {{ $post->published_at ? $post->published_at->translatedFormat('d F Y, H:i') : $post->created_at->translatedFormat('d F Y') }} WIB</span>
                    <span><i class="fa-regular fa-eye mr-1"></i> {{ $post->views_count }} views</span>
                    <span><i class="fa-regular fa-user mr-1"></i> Oleh {{ $post->user ? $post->user->name : 'Admin' }}</span>
                </div>
            </div>

            <!-- Featured Image -->
            @if($post->thumbnail)
            <div class="rounded-2xl overflow-hidden shadow-md max-h-[480px]">
                <img src="{{ $post->thumbnail }}" alt="{{ $post->title }}" class="w-full h-full object-cover" decoding="async">
            </div>
            @endif

            <!-- Article Content -->
            <div class="bg-white rounded-2xl p-6 sm:p-8 shadow-sm border border-slate-200">
                <div class="prose max-w-none text-slate-700 leading-relaxed text-sm sm:text-base space-y-4">
                    {!! $post->content !!}
                </div>
            </div>
        </article>

        <!-- Sidebar (4 cols) -->
        <aside class="lg:col-span-4 space-y-6">
            <!-- Related Posts -->
            @if($relatedPosts->count() > 0)
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-200 space-y-4">
                <h3 class="font-bold text-slate-900 text-sm border-b pb-3 flex items-center">
                    <i class="fa-regular fa-newspaper mr-2 text-theme-primary"></i> Artikel Terkait
                </h3>
                <div class="space-y-4">
                    @foreach($relatedPosts as $rel)
                    <a href="{{ route('posts.detail', $rel->slug) }}" class="block group">
                        <div class="text-xs text-slate-400 mb-1">{{ $rel->published_at ? $rel->published_at->translatedFormat('d M Y') : '' }}</div>
                        <div class="text-xs font-bold text-slate-800 group-hover:text-theme-primary transition leading-snug line-clamp-2">{{ $rel->title }}</div>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Categories -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-200 space-y-3">
                <h3 class="font-bold text-slate-900 text-sm border-b pb-3">Kategori Artikel</h3>
                <div class="space-y-1 text-xs">
                    @foreach($categories as $cat)
                    <a href="{{ route('posts', ['kategori' => $cat->slug]) }}" class="flex justify-between items-center py-1.5 px-2 rounded-lg hover:bg-slate-50 text-slate-700 hover:text-theme-primary transition">
                        <span>{{ $cat->name }}</span>
                        <span class="px-2 py-0.5 rounded-full bg-slate-100 text-[10px] font-bold text-slate-500">{{ $cat->posts_count }}</span>
                    </a>
                    @endforeach
                </div>
            </div>
        </aside>
    </div>
</div>
@endsection
