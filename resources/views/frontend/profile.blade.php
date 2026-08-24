@extends('layouts.frontend')

@section('title', 'Profil & Struktur - ' . get_setting('division_short_name', 'Divisi'))

@section('content')
<!-- Page Header -->
<div class="py-14 text-white" style="background: linear-gradient(135deg, var(--color-primary), var(--color-secondary));">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl space-y-2">
            <div class="text-xs uppercase tracking-wider font-semibold text-slate-200">Profil Resmi</div>
            <h1 class="text-3xl sm:text-4xl font-extrabold">{{ get_setting('division_name', 'Profil Divisi') }}</h1>
            <p class="text-sm sm:text-base text-slate-100/90">{{ get_setting('division_tagline') }}</p>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Tentang & Sejarah/Deskripsi -->
    <div class="bg-white rounded-2xl p-8 shadow-sm border border-slate-200 space-y-6 mb-12">
        <div class="flex items-center space-x-3 pb-4 border-b border-slate-100">
            <div class="w-10 h-10 rounded-xl bg-sky-50 text-theme-primary flex items-center justify-center text-lg">
                <i class="fa-solid fa-hospital-user"></i>
            </div>
            <h2 class="text-xl font-bold text-slate-900">{{ get_setting('about_title', 'Tentang Kami') }}</h2>
        </div>
        <div class="prose max-w-none text-slate-600 text-sm sm:text-base leading-relaxed whitespace-pre-line">
            {{ get_setting('about_description') }}
        </div>
    </div>

    <!-- Visi & Misi Grid -->
    <div class="grid grid-cols-1 md:grid-cols-12 gap-8 mb-12">
        <!-- Visi -->
        <div class="md:col-span-5 bg-white rounded-2xl p-8 shadow-sm border border-slate-200 flex flex-col justify-between">
            <div class="space-y-4">
                <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-xl">
                    <i class="fa-solid fa-compass"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-900">Visi Divisi</h3>
                <p class="text-sm text-slate-700 leading-relaxed italic bg-emerald-50/60 p-4 rounded-xl border border-emerald-100">
                    "{{ get_setting('vision') }}"
                </p>
            </div>
        </div>

        <!-- Misi -->
        <div class="md:col-span-7 bg-white rounded-2xl p-8 shadow-sm border border-slate-200 space-y-4">
            <div class="w-12 h-12 rounded-xl bg-sky-50 text-theme-primary flex items-center justify-center text-xl">
                <i class="fa-solid fa-bullseye"></i>
            </div>
            <h3 class="text-lg font-bold text-slate-900">Misi Divisi</h3>
            <div class="text-sm text-slate-600 leading-relaxed whitespace-pre-line space-y-2">
                {{ get_setting('mission') }}
            </div>
        </div>
    </div>

    <!-- Struktur Organisasi / Team Members -->
    <div class="bg-white rounded-2xl p-8 shadow-sm border border-slate-200 space-y-8">
        <div class="text-center max-w-2xl mx-auto space-y-2">
            <h2 class="text-2xl font-bold text-slate-900">Struktur Organisasi</h2>
            <p class="text-xs sm:text-sm text-slate-500">Personalia yang mengelola dan bertanggung jawab atas operasional {{ get_setting('division_short_name') }}.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse($teamMembers as $tm)
            <div class="bg-slate-50 rounded-2xl p-6 text-center border border-slate-200/80 space-y-3">
                <div class="w-28 h-28 mx-auto rounded-full bg-slate-200 overflow-hidden border-2 border-theme-primary shadow-sm">
                    @if($tm->photo)
                        <img src="{{ $tm->photo }}" alt="{{ $tm->name }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-slate-400 bg-slate-100 text-4xl">
                            <i class="fa-solid fa-user"></i>
                        </div>
                    @endif
                </div>
                <div>
                    <h3 class="font-bold text-sm text-slate-900 leading-tight">{{ $tm->name }}</h3>
                    <div class="text-xs font-semibold text-theme-primary mt-1">{{ $tm->position }}</div>
                    @if($tm->identifier)
                        <div class="text-[11px] text-slate-400 mt-0.5">{{ $tm->identifier }}</div>
                    @endif
                </div>
                @if($tm->bio)
                    <p class="text-xs text-slate-500 line-clamp-3 leading-relaxed">{{ $tm->bio }}</p>
                @endif
                @if($tm->email)
                    <div class="pt-2 border-t border-slate-200">
                        <a href="mailto:{{ $tm->email }}" class="text-xs text-slate-600 hover:text-theme-primary transition truncate block">
                            <i class="fa-regular fa-envelope mr-1 text-sky-600"></i> {{ $tm->email }}
                        </a>
                    </div>
                @endif
            </div>
            @empty
            <div class="col-span-4 text-center py-12 text-slate-400 text-sm">
                Belum ada data susunan struktur organisasi yang ditambahkan.
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
