@extends('layouts.frontend')

@section('title', 'Galeri Dokumentasi - ' . get_setting('division_short_name', 'Divisi'))

@section('content')
<!-- Header -->
<div class="py-14 text-white" style="background: linear-gradient(135deg, var(--color-primary), var(--color-secondary));">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl space-y-2">
            <div class="text-xs uppercase tracking-wider font-semibold text-slate-200">Dokumentasi & Foto</div>
            <h1 class="text-3xl sm:text-4xl font-extrabold">Galeri Kegiatan Divisi</h1>
            <p class="text-sm sm:text-base text-slate-100/90">Rekam jejak visual dari berbagai program kerja, workshop, dan pengabdian divisi.</p>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @forelse($galleries as $gal)
        <div class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition border border-slate-200 group">
            <div class="relative h-48 bg-slate-100 overflow-hidden">
                <img src="{{ $gal->image_path }}" alt="{{ $gal->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300" loading="lazy" decoding="async">
                <div class="absolute top-2 right-2">
                    <span class="px-2 py-0.5 rounded-md bg-slate-900/80 text-white text-[10px] font-semibold backdrop-blur-sm">
                        {{ $gal->category }}
                    </span>
                </div>
            </div>
            <div class="p-4 space-y-1">
                <h3 class="font-bold text-xs sm:text-sm text-slate-900 leading-snug line-clamp-2">{{ $gal->title }}</h3>
                @if($gal->caption)
                    <p class="text-[11px] text-slate-500 line-clamp-2">{{ $gal->caption }}</p>
                @endif
            </div>
        </div>
        @empty
        <div class="col-span-4 text-center py-16 bg-white rounded-2xl border border-dashed border-slate-300 text-slate-400">
            <i class="fa-regular fa-images text-4xl mb-3"></i>
            <p class="text-sm font-semibold">Belum ada foto kegiatan di galeri.</p>
        </div>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $galleries->links() }}
    </div>
</div>
@endsection
