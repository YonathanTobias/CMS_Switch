@extends('layouts.admin')

@section('title', 'Manajemen Berita & Pengumuman')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-2xl font-extrabold text-slate-900">Berita & Pengumuman</h1>
            <p class="text-xs text-slate-500 mt-1">Kelola artikel publikasi, rilis berita, dan edaran pengumuman divisi.</p>
        </div>
        <a href="{{ route('admin.posts.create') }}" class="px-5 py-2.5 rounded-xl bg-theme-primary text-white font-bold text-xs uppercase tracking-wider shadow hover:opacity-90 transition flex items-center">
            <i class="fa-solid fa-plus mr-2"></i> Tambah Konten Baru
        </a>
    </div>

    <!-- Filters & Search -->
    <div class="bg-white rounded-2xl p-4 shadow-sm border border-slate-200 flex flex-col sm:flex-row justify-between items-center gap-4">
        <div class="flex space-x-2 w-full sm:w-auto">
            <a href="{{ route('admin.posts.index') }}" class="px-3.5 py-1.5 rounded-lg text-xs font-bold transition {{ !request('type') ? 'bg-slate-900 text-white' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}">
                Semua ({{ \App\Models\Post::count() }})
            </a>
            <a href="{{ route('admin.posts.index', ['type' => 'berita']) }}" class="px-3.5 py-1.5 rounded-lg text-xs font-bold transition {{ request('type') == 'berita' ? 'bg-slate-900 text-white' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}">
                Berita ({{ \App\Models\Post::where('type', 'berita')->count() }})
            </a>
            <a href="{{ route('admin.posts.index', ['type' => 'pengumuman']) }}" class="px-3.5 py-1.5 rounded-lg text-xs font-bold transition {{ request('type') == 'pengumuman' ? 'bg-slate-900 text-white' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}">
                Pengumuman ({{ \App\Models\Post::where('type', 'pengumuman')->count() }})
            </a>
        </div>

        <form action="{{ route('admin.posts.index') }}" method="GET" class="relative w-full sm:w-64">
            @if(request('type'))
                <input type="hidden" name="type" value="{{ request('type') }}">
            @endif
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari judul..." class="w-full pl-9 pr-4 py-2 rounded-xl text-xs bg-slate-50 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:bg-white">
            <i class="fa-solid fa-magnifying-glass absolute left-3 top-2.5 text-slate-400 text-xs"></i>
        </form>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-slate-600">
                <thead class="bg-slate-50 border-b border-slate-200 text-slate-700 font-bold uppercase text-[10px] tracking-wider">
                    <tr>
                        <th class="p-4">Konten</th>
                        <th class="p-4">Tipe & Kategori</th>
                        <th class="p-4">Tanggal Publikasi</th>
                        <th class="p-4">Status</th>
                        <th class="p-4">Views</th>
                        <th class="p-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($posts as $post)
                    <tr class="hover:bg-slate-50 transition">
                        <td class="p-4 flex items-center space-x-3">
                            <div class="w-12 h-12 rounded-lg bg-slate-100 overflow-hidden flex-shrink-0 border">
                                @if($post->thumbnail)
                                    <img src="{{ $post->thumbnail }}" alt="" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-slate-300"><i class="fa-regular fa-image text-lg"></i></div>
                                @endif
                            </div>
                            <div class="max-w-xs sm:max-w-sm">
                                <div class="font-bold text-slate-900 leading-snug line-clamp-1">{{ $post->title }}</div>
                                <div class="text-[11px] text-slate-400 mt-0.5 line-clamp-1">{{ $post->summary }}</div>
                            </div>
                        </td>
                        <td class="p-4">
                            <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase text-white {{ $post->type == 'pengumuman' ? 'bg-amber-600' : 'bg-sky-600' }}">
                                {{ $post->type }}
                            </span>
                            <div class="text-[11px] text-slate-500 mt-1">{{ $post->category ? $post->category->name : 'Tanpa Kategori' }}</div>
                        </td>
                        <td class="p-4">
                            <div>{{ $post->published_at ? $post->published_at->translatedFormat('d M Y') : '-' }}</div>
                            <div class="text-[10px] text-slate-400">{{ $post->published_at ? $post->published_at->format('H:i') : '' }} WIB</div>
                        </td>
                        <td class="p-4">
                            @if($post->is_published)
                                <span class="px-2 py-0.5 rounded-full bg-emerald-50 text-emerald-700 text-[10px] font-bold border border-emerald-200">Terbit</span>
                            @else
                                <span class="px-2 py-0.5 rounded-full bg-slate-100 text-slate-600 text-[10px] font-bold">Draft</span>
                            @endif
                        </td>
                        <td class="p-4 font-semibold">{{ $post->views_count }}</td>
                        <td class="p-4 text-right space-x-2">
                            <a href="{{ route('posts.detail', $post->slug) }}" target="_blank" class="p-1.5 rounded-lg text-slate-400 hover:text-slate-700 hover:bg-slate-100 transition" title="Lihat"><i class="fa-regular fa-eye"></i></a>
                            <a href="{{ route('admin.posts.edit', $post->id) }}" class="p-1.5 rounded-lg text-sky-600 hover:bg-sky-50 transition" title="Edit"><i class="fa-regular fa-pen-to-square"></i></a>
                            <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus konten ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-1.5 rounded-lg text-rose-600 hover:bg-rose-50 transition" title="Hapus"><i class="fa-regular fa-trash-can"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="p-8 text-center text-slate-400">Belum ada konten berita atau pengumuman.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-6">
        {{ $posts->links() }}
    </div>
</div>
@endsection
