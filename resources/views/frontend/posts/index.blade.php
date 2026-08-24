@extends('layouts.frontend')

@section('title', 'Berita & Pengumuman - ' . get_setting('division_short_name', 'Divisi'))

@section('content')
<!-- Header -->
<div class="py-14 text-white" style="background: linear-gradient(135deg, var(--color-primary), var(--color-secondary));">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl space-y-2">
            <div class="text-xs uppercase tracking-wider font-semibold text-slate-200">Kabar & Publikasi</div>
            <h1 class="text-3xl sm:text-4xl font-extrabold">Berita & Pengumuman</h1>
            <p class="text-sm sm:text-base text-slate-100/90">Informasi terbaru, edaran resmi, dan dokumentasi kegiatan divisi.</p>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Filter and Search Bar -->
    <div class="bg-white rounded-2xl p-4 sm:p-6 shadow-sm border border-slate-200 mb-10">
        <form action="{{ route('posts') }}" method="GET" class="flex flex-col md:flex-row gap-4 justify-between items-center">
            <!-- Tabs Type -->
            <div class="flex space-x-2 w-full md:w-auto">
                <a href="{{ route('posts') }}" class="px-4 py-2 rounded-xl text-xs font-bold transition {{ !request('type') ? 'bg-theme-primary text-white shadow' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}">
                    Semua
                </a>
                <a href="{{ route('posts', ['type' => 'berita']) }}" class="px-4 py-2 rounded-xl text-xs font-bold transition {{ request('type') == 'berita' ? 'bg-theme-primary text-white shadow' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}">
                    Berita
                </a>
                <a href="{{ route('posts', ['type' => 'pengumuman']) }}" class="px-4 py-2 rounded-xl text-xs font-bold transition {{ request('type') == 'pengumuman' ? 'bg-theme-primary text-white shadow' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}">
                    Pengumuman
                </a>
            </div>

            <!-- Search input -->
            <div class="flex items-center space-x-2 w-full md:w-80">
                @if(request('type'))
                    <input type="hidden" name="type" value="{{ request('type') }}">
                @endif
                <div class="relative w-full">
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari judul berita..." class="w-full pl-9 pr-4 py-2 rounded-xl text-xs bg-slate-50 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:bg-white">
                    <i class="fa-solid fa-magnifying-glass absolute left-3 top-2.5 text-slate-400 text-xs"></i>
                </div>
                <button type="submit" class="px-4 py-2 rounded-xl bg-slate-900 text-white text-xs font-bold hover:bg-slate-800 transition">
                    Cari
                </button>
            </div>
        </form>
    </div>

    <!-- Posts Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($posts as $post)
        <article class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition border border-slate-200 flex flex-col justify-between group">
            <div>
                <div class="relative h-48 bg-slate-100 overflow-hidden">
                    @if($post->thumbnail)
                        <img src="{{ $post->thumbnail }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-slate-300" style="background: linear-gradient(135deg, #0f172a, var(--color-primary));">
                            <i class="fa-solid fa-newspaper text-4xl text-white/30"></i>
                        </div>
                    @endif
                    <div class="absolute top-3 left-3">
                        <span class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider text-white {{ $post->type == 'pengumuman' ? 'bg-amber-600' : 'bg-sky-600' }}">
                            {{ $post->type }}
                        </span>
                    </div>
                </div>

                <div class="p-6 space-y-3">
                    <div class="flex items-center text-xs text-slate-400 space-x-3">
                        <span><i class="fa-regular fa-calendar mr-1"></i> {{ $post->published_at ? $post->published_at->translatedFormat('d M Y') : $post->created_at->format('d M Y') }}</span>
                        @if($post->category)
                            <span>•</span>
                            <span class="text-sky-600 font-medium">{{ $post->category->name }}</span>
                        @endif
                    </div>

                    <h3 class="text-base font-bold text-slate-900 group-hover:text-theme-primary transition leading-snug line-clamp-2">
                        <a href="{{ route('posts.detail', $post->slug) }}">{{ $post->title }}</a>
                    </h3>

                    <p class="text-xs text-slate-600 line-clamp-2 leading-relaxed">
                        {{ $post->summary ?: Str::limit(strip_tags($post->content), 100) }}
                    </p>
                </div>
            </div>

            <div class="px-6 pb-6 pt-2 border-t border-slate-100 flex items-center justify-between text-xs">
                <span class="text-slate-400"><i class="fa-regular fa-eye mr-1"></i> {{ $post->views_count }} views</span>
                <a href="{{ route('posts.detail', $post->slug) }}" class="font-bold text-theme-primary flex items-center hover:underline">
                    Baca Selengkapnya <i class="fa-solid fa-arrow-right ml-1.5 text-[10px]"></i>
                </a>
            </div>
        </article>
        @empty
        <div class="col-span-3 text-center py-16 bg-white rounded-2xl border border-dashed border-slate-300 text-slate-400">
            <i class="fa-regular fa-folder-open text-4xl mb-3"></i>
            <p class="text-base font-semibold text-slate-700">Tidak ada artikel atau pengumuman yang ditemukan.</p>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-10">
        {{ $posts->links() }}
    </div>
</div>
@endsection
