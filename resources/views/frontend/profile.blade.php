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

    @php
        $chartImage = get_setting('organization_chart_image');
        $displayMode = get_setting('organization_display_mode', 'both');
    @endphp

    <!-- Struktur Organisasi / Team Members Section -->
    <div id="struktur" class="bg-white rounded-2xl p-6 sm:p-10 shadow-sm border border-slate-200 space-y-8" x-data="{
        activeTab: 'chart',
        lightboxOpen: false,
        lightboxImage: '{{ $chartImage }}'
    }">
        <div class="text-center max-w-2xl mx-auto space-y-2">
            <div class="inline-flex items-center space-x-2 text-xs font-bold uppercase tracking-wider px-3.5 py-1 rounded-full text-theme-primary bg-slate-100">
                <i class="fa-solid fa-sitemap"></i>
                <span>Struktur Organisasi</span>
            </div>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900">Susunan Pengurus & Personalia</h2>
            <p class="text-xs sm:text-sm text-slate-500">Personalia yang mengelola dan bertanggung jawab atas operasional {{ get_setting('division_short_name') }}.</p>
        </div>

        @if($chartImage && $displayMode === 'tab')
            <!-- Mode Tab Switch: Bagan Diagram vs Personil -->
            <div class="flex justify-center border-b border-slate-200">
                <div class="inline-flex p-1 rounded-xl bg-slate-100 space-x-1">
                    <button @click="activeTab = 'chart'" :class="activeTab === 'chart' ? 'bg-white text-slate-900 font-bold shadow-sm' : 'text-slate-600 hover:text-slate-900'" class="px-5 py-2 rounded-lg text-xs transition flex items-center">
                        <i class="fa-solid fa-diagram-project mr-2 text-theme-primary"></i> Bagan Struktur (Diagram)
                    </button>
                    <button @click="activeTab = 'members'" :class="activeTab === 'members' ? 'bg-white text-slate-900 font-bold shadow-sm' : 'text-slate-600 hover:text-slate-900'" class="px-5 py-2 rounded-lg text-xs transition flex items-center">
                        <i class="fa-solid fa-users mr-2 text-theme-primary"></i> Personil & Pejabat ({{ $teamMembers->count() }})
                    </button>
                </div>
            </div>
        @endif

        <!-- 1. Bagan Struktur Diagram Card -->
        @if($chartImage && ($displayMode === 'both' || $displayMode === 'chart_only' || $displayMode === 'tab'))
            <div x-show="activeTab === 'chart' || '{{ $displayMode }}' !== 'tab'" class="space-y-4">
                <div class="p-4 sm:p-6 bg-slate-50 rounded-2xl border border-slate-200/80 text-center space-y-4">
                    <div class="flex flex-col sm:flex-row justify-between items-center gap-3">
                        <div class="flex items-center space-x-2 text-xs font-bold text-slate-800">
                            <i class="fa-solid fa-diagram-project text-theme-primary"></i>
                            <span>Diagram Bagan Struktur Organisasi</span>
                        </div>
                        <button @click="lightboxOpen = true" type="button" class="px-4 py-2 rounded-xl bg-white border border-slate-300 hover:bg-slate-100 text-slate-700 font-bold text-xs shadow-sm transition flex items-center">
                            <i class="fa-solid fa-expand mr-1.5 text-sky-600"></i> Perbesar Gambar Penuh
                        </button>
                    </div>

                    <!-- Chart Image with Lightbox Trigger -->
                    <div class="relative group cursor-pointer rounded-xl overflow-hidden bg-white p-3 border border-slate-200 shadow-sm" @click="lightboxOpen = true">
                        <img src="{{ $chartImage }}" alt="Bagan Struktur Organisasi {{ get_setting('division_name') }}" class="w-full max-h-[600px] object-contain mx-auto transition duration-300 group-hover:scale-[1.01]" loading="lazy" decoding="async">
                        <div class="absolute inset-0 bg-slate-950/40 opacity-0 group-hover:opacity-100 transition flex items-center justify-center text-white font-bold text-xs gap-2 backdrop-blur-[2px]">
                            <i class="fa-solid fa-magnifying-glass-plus text-lg"></i> Klik untuk Melihat Ukuran Penuh
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- 2. Grid Kartu Personil & Pejabat -->
        @if($displayMode === 'both' || $displayMode === 'members_only' || $displayMode === 'tab')
            <div x-show="activeTab === 'members' || '{{ $displayMode }}' !== 'tab'" class="space-y-4">
                @if($chartImage && $displayMode === 'both')
                    <div class="pt-4 border-t border-slate-100 flex items-center space-x-2 text-sm font-bold text-slate-800">
                        <i class="fa-solid fa-users text-theme-primary"></i>
                        <span>Daftar Personil & Pejabat Organisasi</span>
                    </div>
                @endif

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @forelse($teamMembers as $tm)
                    <div class="bg-slate-50 rounded-2xl p-6 text-center border border-slate-200/80 space-y-3 hover:shadow-md transition">
                        <div class="w-28 h-28 mx-auto rounded-full bg-slate-200 overflow-hidden border-2 border-theme-primary shadow-sm">
                            @if($tm->photo)
                                <img src="{{ $tm->photo }}" alt="{{ $tm->name }}" class="w-full h-full object-cover" loading="lazy" decoding="async">
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
        @endif

        <!-- Lightbox Zoom Modal -->
        <div x-show="lightboxOpen" 
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 z-50 bg-slate-950/90 flex flex-col items-center justify-center p-4 sm:p-6" 
             style="display: none;"
             @keydown.escape.window="lightboxOpen = false">
            <div class="w-full max-w-6xl flex justify-between items-center text-white pb-3 border-b border-white/20 mb-3">
                <div class="font-bold text-sm flex items-center">
                    <i class="fa-solid fa-sitemap mr-2 text-theme-primary"></i> Bagan Struktur Organisasi
                </div>
                <div class="flex items-center space-x-2">
                    <a :href="lightboxImage" target="_blank" class="px-3 py-1.5 rounded-lg bg-white/20 hover:bg-white/30 text-xs font-bold text-white transition flex items-center">
                        <i class="fa-solid fa-arrow-down mr-1.5"></i> Unduh Asli
                    </a>
                    <button @click="lightboxOpen = false" class="p-1.5 rounded-lg bg-white/20 hover:bg-rose-600 text-white transition text-sm">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
            </div>
            <div class="w-full max-w-6xl max-h-[85vh] overflow-auto flex items-center justify-center bg-slate-900 rounded-2xl p-2">
                <img :src="lightboxImage" alt="Bagan Struktur Organisasi" class="max-w-full max-h-[80vh] object-contain rounded">
            </div>
        </div>
    </div>
</div>
@endsection
