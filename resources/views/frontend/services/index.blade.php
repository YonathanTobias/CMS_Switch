@extends('layouts.frontend')

@section('title', 'Katalog Layanan - ' . get_setting('division_short_name', 'Divisi'))

@section('content')
<!-- Header -->
<div class="py-14 text-white" style="background: linear-gradient(135deg, var(--color-primary), var(--color-secondary));">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl space-y-2">
            <div class="text-xs uppercase tracking-wider font-semibold text-slate-200">Layanan & Prosedur</div>
            <h1 class="text-3xl sm:text-4xl font-extrabold">Katalog Layanan Divisi</h1>
            <p class="text-sm sm:text-base text-slate-100/90">Daftar layanan, panduan SOP, dan persyaratan administrasi di {{ get_setting('division_short_name') }}.</p>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($services as $svc)
        <div class="bg-white rounded-2xl p-6 shadow-sm hover:shadow-md transition border border-slate-200 flex flex-col justify-between group">
            <div class="space-y-4">
                <div class="w-14 h-14 rounded-2xl flex items-center justify-center text-2xl text-white transition group-hover:scale-105" style="background-color: var(--color-primary);">
                    <i class="{{ $svc->icon ?: 'fa-solid fa-briefcase-medical' }}"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-900 group-hover:text-theme-primary transition">{{ $svc->title }}</h3>
                <p class="text-xs text-slate-600 leading-relaxed line-clamp-3">
                    {{ $svc->summary ?: Str::limit(strip_tags($svc->description), 130) }}
                </p>
            </div>

            <div class="pt-6 border-t border-slate-100 mt-6 flex items-center justify-between">
                <a href="{{ route('services.detail', $svc->slug) }}" class="text-xs font-bold text-theme-primary flex items-center group-hover:underline">
                    Lihat Prosedur & Syarat <i class="fa-solid fa-arrow-right ml-1.5 text-[10px]"></i>
                </a>
            </div>
        </div>
        @empty
        <div class="col-span-3 text-center py-16 bg-white rounded-2xl border border-dashed border-slate-300 text-slate-400">
            <i class="fa-solid fa-concierge-bell text-4xl mb-3"></i>
            <p class="text-base font-semibold text-slate-700">Belum ada layanan yang ditambahkan.</p>
        </div>
        @endforelse
    </div>
</div>
@endsection
