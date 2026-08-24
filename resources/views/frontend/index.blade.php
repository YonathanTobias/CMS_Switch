@extends('layouts.frontend')

@section('title', get_setting('division_short_name', 'Beranda Divisi'))

@section('content')
<!-- Hero Section with Carousel Support -->
@if(isset($carousels) && $carousels->count() > 0)
<section class="relative overflow-hidden text-white bg-slate-950" 
         x-data="{ 
            activeSlide: 0, 
            slidesCount: {{ $carousels->count() }},
            autoplayTimer: null,
            startAutoplay() {
                this.autoplayTimer = setInterval(() => {
                    this.activeSlide = (this.activeSlide + 1) % this.slidesCount;
                }, 5000);
            },
            stopAutoplay() {
                clearInterval(this.autoplayTimer);
            }
         }" 
         x-init="startAutoplay()"
         @mouseenter="stopAutoplay()"
         @mouseleave="startAutoplay()">
    
    <!-- Slides Wrapper -->
    <div class="relative min-h-[480px] sm:min-h-[540px] lg:min-h-[580px] flex items-center">
        @foreach($carousels as $index => $slide)
        <div x-show="activeSlide === {{ $index }}" 
             x-transition:enter="transition ease-out duration-700"
             x-transition:enter-start="opacity-0 transform scale-105"
             x-transition:enter-end="opacity-100 transform scale-100"
             x-transition:leave="transition ease-in duration-500"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="absolute inset-0 w-full h-full"
             style="display: {{ $index === 0 ? 'block' : 'none' }};">
            
            <!-- Slide Background Image -->
            <img src="{{ $slide->image_path }}" alt="{{ $slide->title }}" class="absolute inset-0 w-full h-full object-cover">
            
            <!-- Gradient Overlay -->
            <div class="absolute inset-0 bg-gradient-to-r from-slate-950/90 via-slate-950/70 to-transparent"></div>
            <div class="absolute inset-0 bg-black/30"></div>

            <!-- Slide Content -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full flex items-center relative z-10 py-20">
                <div class="max-w-2xl space-y-6">
                    <div class="inline-flex items-center space-x-2 bg-white/20 backdrop-blur-md px-3.5 py-1.5 rounded-full text-xs font-semibold tracking-wide uppercase border border-white/30 text-white">
                        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span>
                        <span>{{ get_setting('parent_institution', 'STIKES Panti Waluya') }}</span>
                    </div>

                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight leading-tight text-white drop-shadow-md">
                        {{ $slide->title }}
                    </h1>

                    @if($slide->subtitle)
                    <p class="text-base sm:text-lg text-slate-100 max-w-xl leading-relaxed drop-shadow">
                        {{ $slide->subtitle }}
                    </p>
                    @endif

                    <div class="flex flex-wrap gap-4 pt-2">
                        @if($slide->button_text && $slide->button_link)
                        <a href="{{ $slide->button_link }}" class="px-6 py-3 rounded-xl bg-theme-primary text-white font-bold text-sm shadow-xl hover:opacity-90 transition flex items-center transform hover:-translate-y-0.5">
                            {{ $slide->button_text }} <i class="fa-solid fa-arrow-right ml-2 text-xs"></i>
                        </a>
                        @endif
                        <a href="{{ route('services') }}" class="px-6 py-3 rounded-xl bg-white/15 backdrop-blur-md text-white font-semibold text-sm border border-white/30 hover:bg-white/25 transition flex items-center">
                            <i class="fa-solid fa-list-check mr-2"></i> Layanan Divisi
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Navigation Arrows -->
    @if($carousels->count() > 1)
    <button @click="activeSlide = (activeSlide - 1 + slidesCount) % slidesCount" class="absolute left-4 top-1/2 -translate-y-1/2 z-20 w-11 h-11 rounded-full bg-black/40 hover:bg-black/70 text-white backdrop-blur-md flex items-center justify-center transition border border-white/20">
        <i class="fa-solid fa-chevron-left text-sm"></i>
    </button>
    <button @click="activeSlide = (activeSlide + 1) % slidesCount" class="absolute right-4 top-1/2 -translate-y-1/2 z-20 w-11 h-11 rounded-full bg-black/40 hover:bg-black/70 text-white backdrop-blur-md flex items-center justify-center transition border border-white/20">
        <i class="fa-solid fa-chevron-right text-sm"></i>
    </button>

    <!-- Pagination Dots -->
    <div class="absolute bottom-6 left-1/2 -translate-x-1/2 z-20 flex space-x-2 bg-black/40 backdrop-blur-md px-3 py-1.5 rounded-full border border-white/10">
        @foreach($carousels as $index => $slide)
        <button @click="activeSlide = {{ $index }}" 
                :class="activeSlide === {{ $index }} ? 'w-8 bg-white' : 'w-2.5 bg-white/50 hover:bg-white/80'" 
                class="h-2.5 rounded-full transition-all duration-300"></button>
        @endforeach
    </div>
    @endif
</section>
@else
<!-- Default Hero Section (When no carousel slides are added) -->
<section class="relative overflow-hidden text-white py-20 lg:py-28" style="background: linear-gradient(135deg, var(--color-primary), var(--color-secondary));">
    <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#fff_1px,transparent_1px)] [background-size:16px_16px]"></div>
    <div class="absolute -right-20 -bottom-20 w-96 h-96 bg-white/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            <div class="lg:col-span-8 space-y-6">
                <div class="inline-flex items-center space-x-2 bg-white/15 backdrop-blur-md px-3.5 py-1.5 rounded-full text-xs font-semibold tracking-wide uppercase border border-white/20">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span>
                    <span>{{ get_setting('parent_institution', 'STIKES Panti Waluya Malang') }}</span>
                </div>

                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight leading-tight">
                    {{ get_setting('hero_banner_title', get_setting('division_name', 'Website Resmi Divisi')) }}
                </h1>

                <p class="text-base sm:text-lg text-slate-100/90 max-w-2xl leading-relaxed font-normal">
                    {{ get_setting('hero_banner_subtitle', get_setting('division_tagline', 'Mewujudkan layanan akademik dan kesehatan unggul berlandaskan kasih.')) }}
                </p>

                <div class="flex flex-wrap gap-4 pt-4">
                    <a href="{{ route('services') }}" class="px-6 py-3 rounded-xl bg-white text-slate-900 font-bold text-sm shadow-lg hover:bg-slate-100 hover:shadow-xl transition transform hover:-translate-y-0.5 flex items-center">
                        <i class="fa-solid fa-list-check mr-2 text-sky-600"></i> Jelajahi Layanan
                    </a>
                    <a href="{{ route('profile') }}" class="px-6 py-3 rounded-xl bg-white/15 backdrop-blur-md text-white font-semibold text-sm border border-white/30 hover:bg-white/25 transition flex items-center">
                        <i class="fa-solid fa-circle-info mr-2"></i> Profil & Visi Misi
                    </a>
                    <a href="{{ route('documents') }}" class="px-6 py-3 rounded-xl bg-white/15 backdrop-blur-md text-white font-semibold text-sm border border-white/30 hover:bg-white/25 transition flex items-center">
                        <i class="fa-solid fa-file-arrow-down mr-2"></i> Pusat Unduhan
                    </a>
                </div>
            </div>

            <div class="lg:col-span-4">
                <div class="bg-white/10 backdrop-blur-xl border border-white/20 rounded-2xl p-6 shadow-2xl space-y-4">
                    <div class="flex items-center space-x-3 pb-4 border-b border-white/20">
                        <div class="w-10 h-10 rounded-xl bg-white text-slate-900 flex items-center justify-center font-bold">
                            <i class="fa-solid fa-building-columns text-theme-primary"></i>
                        </div>
                        <div>
                            <div class="text-xs uppercase tracking-wider text-slate-200 font-medium">Info Divisi</div>
                            <div class="font-bold text-white text-sm">{{ get_setting('division_acronym', 'DIVISI') }}</div>
                        </div>
                    </div>

                    <div class="space-y-3 text-xs text-slate-100">
                        <div class="flex items-center justify-between py-1 border-b border-white/10">
                            <span class="text-slate-300"><i class="fa-regular fa-clock mr-1.5"></i> Jam Layanan:</span>
                            <span class="font-medium">{{ get_setting('operating_hours', '08.00 - 16.00 WIB') }}</span>
                        </div>
                        <div class="flex items-center justify-between py-1 border-b border-white/10">
                            <span class="text-slate-300"><i class="fa-solid fa-location-dot mr-1.5"></i> Lokasi:</span>
                            <span class="font-medium">{{ get_setting('contact_room', 'Gedung Rektorat') }}</span>
                        </div>
                        <div class="flex items-center justify-between py-1">
                            <span class="text-slate-300"><i class="fa-solid fa-envelope mr-1.5"></i> Email:</span>
                            <span class="font-medium">{{ get_setting('contact_email', 'info@pantiwaluya.ac.id') }}</span>
                        </div>
                    </div>

                    <a href="{{ route('contact') }}" class="w-full mt-2 py-2.5 rounded-xl bg-emerald-500 hover:bg-emerald-600 text-white font-bold text-xs uppercase tracking-wider text-center block transition shadow">
                        <i class="fa-brands fa-whatsapp mr-1.5"></i> Hubungi / Konsultasi
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endif


@php
    $isProdi = get_setting('division_type') === 'prodi' || \Illuminate\Support\Str::contains(strtolower(get_setting('division_name')), ['prodi', 'program studi']);
@endphp

@if($isProdi)
<!-- Dedicated Prodi Vision & Mission Section (Khusus Program Studi) -->
<section class="py-16 lg:py-24 bg-gradient-to-b from-slate-50 to-white border-b border-slate-200/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto space-y-3 mb-16">
            <div class="inline-flex items-center space-x-2 text-xs font-bold uppercase tracking-wider px-3.5 py-1.5 rounded-full text-white shadow-sm" style="background-color: var(--color-primary);">
                <i class="fa-solid fa-graduation-cap"></i>
                <span>Visi & Misi Program Studi</span>
            </div>
            <h2 class="text-2xl sm:text-4xl font-extrabold text-slate-900 leading-tight">
                Arah Pendidikan & Komitmen Mutu Lulusan
            </h2>
            <p class="text-xs sm:text-base text-slate-600">
                Mencetak lulusan tenaga kesehatan yang unggul, profesional, beretika, dan berkarakter kasih.
            </p>

            <!-- Status Akreditasi & Jenjang Badges -->
            <div class="flex flex-wrap justify-center gap-2 pt-2">
                @if(get_setting('prodi_degree'))
                <span class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-bold bg-sky-50 text-sky-800 border border-sky-200">
                    <i class="fa-solid fa-award text-sky-600 mr-1.5"></i> Jenjang: {{ get_setting('prodi_degree') }}
                </span>
                @endif
                @if(get_setting('prodi_accreditation'))
                <span class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-bold bg-emerald-50 text-emerald-800 border border-emerald-200">
                    <i class="fa-solid fa-circle-check text-emerald-600 mr-1.5"></i> {{ get_setting('prodi_accreditation') }}
                </span>
                @endif
            </div>
        </div>

        <!-- Vision & Mission Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-stretch mb-12">
            <!-- Visi Card (5 cols) -->
            <div class="lg:col-span-5 bg-white rounded-3xl p-8 shadow-sm border border-slate-200/90 flex flex-col justify-between relative overflow-hidden group hover:shadow-md transition">
                <div class="absolute top-0 right-0 w-32 h-32 bg-sky-500/10 rounded-full blur-2xl group-hover:scale-125 transition duration-500"></div>
                
                <div class="space-y-6 relative z-10">
                    <div class="flex items-center space-x-3">
                        <div class="w-12 h-12 rounded-2xl flex items-center justify-center text-white text-xl shadow" style="background-color: var(--color-primary);">
                            <i class="fa-solid fa-compass"></i>
                        </div>
                        <div>
                            <div class="text-[11px] uppercase tracking-wider text-slate-400 font-bold">Visi Keunggulan</div>
                            <h3 class="text-xl font-black text-slate-900">Visi Program Studi</h3>
                        </div>
                    </div>

                    <blockquote class="text-sm sm:text-base text-slate-700 leading-relaxed italic bg-slate-50 p-6 rounded-2xl border-l-4" style="border-left-color: var(--color-primary);">
                        "{{ get_setting('vision', 'Menjadi Program Studi terkemuka yang menghasilkan lulusan unggul, kompeten, dan berkarakter kasih pada tahun 2030.') }}"
                    </blockquote>
                </div>

                <div class="pt-6 border-t border-slate-100 mt-6 relative z-10 flex items-center justify-between text-xs text-slate-500">
                    <span class="flex items-center"><i class="fa-solid fa-shield-heart text-rose-500 mr-1.5"></i> Berkarakter Kasih</span>
                    <span class="font-bold text-slate-700">{{ get_setting('division_short_name') }}</span>
                </div>
            </div>

            <!-- Misi Card (7 cols) -->
            <div class="lg:col-span-7 bg-white rounded-3xl p-8 shadow-sm border border-slate-200/90 flex flex-col justify-between relative overflow-hidden group hover:shadow-md transition">
                <div class="space-y-6">
                    <div class="flex items-center space-x-3">
                        <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-xl shadow-sm border border-emerald-100">
                            <i class="fa-solid fa-bullseye"></i>
                        </div>
                        <div>
                            <div class="text-[11px] uppercase tracking-wider text-slate-400 font-bold">Tri Dharma Perguruan Tinggi</div>
                            <h3 class="text-xl font-black text-slate-900">Misi Program Studi</h3>
                        </div>
                    </div>

                    <div class="space-y-3">
                        @php
                            $missions = explode("\n", get_setting('mission', "1. Menyelenggarakan pendidikan berkualitas berbasis kurikulum OBE.\n2. Melaksanakan penelitian ilmiah aplikatif.\n3. Melaksanakan pengabdian masyarakat berkelanjutan."));
                        @endphp
                        @foreach($missions as $m)
                            @if(trim($m))
                            <div class="flex items-start space-x-3 bg-slate-50/80 p-3.5 rounded-xl border border-slate-100 hover:bg-slate-100/80 transition">
                                <div class="w-6 h-6 rounded-lg flex items-center justify-center text-white text-xs font-bold flex-shrink-0 mt-0.5" style="background-color: var(--color-primary);">
                                    <i class="fa-solid fa-check text-[10px]"></i>
                                </div>
                                <div class="text-xs sm:text-sm text-slate-700 leading-relaxed font-medium">
                                    {{ preg_replace('/^\d+\.\s*/', '', trim($m)) }}
                                </div>
                            </div>
                            @endif
                        @endforeach
                    </div>
                </div>

                <div class="pt-4 border-t border-slate-100 mt-6 flex items-center justify-between">
                    <a href="{{ route('profile') }}" class="text-xs font-bold text-theme-primary hover:underline flex items-center">
                        Lihat Struktur Dosen & Kurikulum Lengkap <i class="fa-solid fa-arrow-right ml-1.5 text-[10px]"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Profil Lulusan / Kompetensi Unggulan Card -->
        @if(get_setting('prodi_graduate_profile'))
        <div class="bg-gradient-to-r from-slate-900 via-slate-800 to-slate-900 rounded-3xl p-6 sm:p-8 text-white shadow-lg border border-slate-700/60">
            <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
                <div class="space-y-2 max-w-2xl">
                    <div class="inline-flex items-center space-x-2 bg-white/10 px-3 py-1 rounded-full text-xs font-semibold uppercase text-amber-400">
                        <i class="fa-solid fa-user-graduate"></i>
                        <span>Profil Lulusan Utama</span>
                    </div>
                    <h3 class="text-lg sm:text-xl font-extrabold text-white">Prospek & Peran Lulusan</h3>
                    <p class="text-xs sm:text-sm text-slate-300 leading-relaxed">
                        {{ get_setting('prodi_graduate_profile') }}
                    </p>
                </div>
                @if(get_setting('enable_services', '1') !== '0')
                <a href="{{ route('services') }}" class="px-6 py-3 rounded-xl bg-white text-slate-950 font-bold text-xs uppercase tracking-wider shadow hover:bg-slate-100 transition flex-shrink-0 flex items-center">
                    <i class="fa-solid fa-book-open mr-2 text-sky-600"></i> Layanan Mahasiswa
                </a>
                @else
                <a href="{{ route('contact') }}" class="px-6 py-3 rounded-xl bg-white text-slate-950 font-bold text-xs uppercase tracking-wider shadow hover:bg-slate-100 transition flex-shrink-0 flex items-center">
                    <i class="fa-solid fa-paper-plane mr-2 text-sky-600"></i> Hubungi Kami
                </a>
                @endif
            </div>
        </div>
        @endif
    </div>
</section>
@else
<!-- Standard About & Vision Mission Preview for Units / Institutions -->
<section class="py-16 lg:py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            <div class="lg:col-span-6 space-y-6">
                <div class="inline-flex items-center space-x-2 text-xs font-bold uppercase tracking-wider px-3 py-1 rounded-md text-theme-primary bg-slate-100">
                    <i class="fa-solid fa-circle-info"></i>
                    <span>Mengenal Divisi Kami</span>
                </div>

                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 leading-tight">
                    {{ get_setting('about_title', 'Tentang Kami') }}
                </h2>

                <p class="text-sm sm:text-base text-slate-600 leading-relaxed">
                    {{ get_setting('about_description', 'Unit penggerak kegiatan akademik dan pelayanan di STIKES Panti Waluya Malang.') }}
                </p>

                <!-- Vision Card -->
                <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm space-y-2 border-l-4" style="border-left-color: var(--color-primary);">
                    <h3 class="text-sm font-bold text-slate-900 flex items-center">
                        <i class="fa-solid fa-bullseye mr-2 text-theme-primary"></i> Visi Utama
                    </h3>
                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed italic">
                        "{{ get_setting('vision', 'Menjadi pusat layanan dan keunggulan akademik yang inovatif dan berkarakter kasih.') }}"
                    </p>
                </div>

                <div>
                    <a href="{{ route('profile') }}" class="inline-flex items-center text-sm font-bold text-theme-primary hover:underline">
                        Baca Profil & Struktur Organisasi Lengkap <i class="fa-solid fa-arrow-right ml-2 text-xs"></i>
                    </a>
                </div>
            </div>

            <!-- Right Box: Services or Info Highlight Banner -->
            <div class="lg:col-span-6">
                @if(get_setting('enable_services', '1') !== '0')
                <div class="bg-gradient-to-br from-slate-900 to-slate-800 rounded-3xl p-8 text-white shadow-xl relative overflow-hidden">
                    <div class="absolute -top-10 -right-10 w-48 h-48 bg-sky-500/20 rounded-full blur-2xl"></div>
                    <div class="relative z-10 space-y-6">
                        <div class="w-12 h-12 rounded-xl bg-white/10 flex items-center justify-center text-xl text-sky-400">
                            <i class="fa-solid fa-hand-holding-medical"></i>
                        </div>
                        <h3 class="text-xl font-bold">Layanan Terpadu & Mudah Diakses</h3>
                        <p class="text-xs text-slate-300 leading-relaxed">
                            Kami menyediakan alur prosedur, panduan teknis, pengurusan administrasi, dan konsultasi online bagi mahasiswa, dosen, serta mitra kesehatan.
                        </p>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-2">
                            <div class="flex items-center space-x-2 text-xs text-slate-200">
                                <i class="fa-solid fa-check text-emerald-400"></i>
                                <span>Alur Prosedur Jelas</span>
                            </div>
                            <div class="flex items-center space-x-2 text-xs text-slate-200">
                                <i class="fa-solid fa-check text-emerald-400"></i>
                                <span>Formulir Siap Download</span>
                            </div>
                            <div class="flex items-center space-x-2 text-xs text-slate-200">
                                <i class="fa-solid fa-check text-emerald-400"></i>
                                <span>Bantuan & Konsultasi Ramah</span>
                            </div>
                            <div class="flex items-center space-x-2 text-xs text-slate-200">
                                <i class="fa-solid fa-check text-emerald-400"></i>
                                <span>Pelayanan Cepat & Akurat</span>
                            </div>
                        </div>
                        <div class="pt-4">
                            <a href="{{ route('services') }}" class="px-5 py-2.5 rounded-xl bg-theme-primary text-white text-xs font-bold uppercase tracking-wider inline-flex items-center shadow hover:opacity-90 transition">
                                Buka Daftar Layanan <i class="fa-solid fa-chevron-right ml-2 text-[10px]"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @else
                <div class="bg-gradient-to-br from-slate-900 to-slate-800 rounded-3xl p-8 text-white shadow-xl relative overflow-hidden">
                    <div class="absolute -top-10 -right-10 w-48 h-48 bg-sky-500/20 rounded-full blur-2xl"></div>
                    <div class="relative z-10 space-y-6">
                        <div class="w-12 h-12 rounded-xl bg-white/10 flex items-center justify-center text-xl text-sky-400">
                            <i class="fa-solid fa-circle-info"></i>
                        </div>
                        <h3 class="text-xl font-bold">Pusat Informasi & Komunikasi</h3>
                        <p class="text-xs text-slate-300 leading-relaxed">
                            Akses berita terkini, pengumuman resmi, agenda kegiatan akademik, dan unduhan dokumen terpadu di {{ get_setting('division_short_name') }}.
                        </p>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-2">
                            <div class="flex items-center space-x-2 text-xs text-slate-200">
                                <i class="fa-solid fa-check text-emerald-400"></i>
                                <span>Informasi Resmi Terkini</span>
                            </div>
                            <div class="flex items-center space-x-2 text-xs text-slate-200">
                                <i class="fa-solid fa-check text-emerald-400"></i>
                                <span>Unduhan Dokumen & Formulir</span>
                            </div>
                            <div class="flex items-center space-x-2 text-xs text-slate-200">
                                <i class="fa-solid fa-check text-emerald-400"></i>
                                <span>Agenda & Kegiatan Aktif</span>
                            </div>
                            <div class="flex items-center space-x-2 text-xs text-slate-200">
                                <i class="fa-solid fa-check text-emerald-400"></i>
                                <span>Layanan Kontak Responsif</span>
                            </div>
                        </div>
                        <div class="pt-4 flex gap-3">
                            <a href="{{ route('profile') }}" class="px-5 py-2.5 rounded-xl bg-theme-primary text-white text-xs font-bold uppercase tracking-wider inline-flex items-center shadow hover:opacity-90 transition">
                                Profil Lengkap <i class="fa-solid fa-chevron-right ml-2 text-[10px]"></i>
                            </a>
                            <a href="{{ route('contact') }}" class="px-5 py-2.5 rounded-xl bg-white/10 hover:bg-white/20 text-white text-xs font-bold uppercase tracking-wider inline-flex items-center transition border border-white/20">
                                Hubungi Kami
                            </a>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endif

<!-- Division Services Grid -->
@if(get_setting('enable_services', '1') !== '0' && $services->count() > 0)
<section class="py-16 bg-slate-100/70 border-y border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto space-y-3 mb-12">
            <div class="inline-flex items-center space-x-2 text-xs font-bold uppercase tracking-wider px-3 py-1 rounded-md text-theme-primary bg-white shadow-sm">
                <i class="fa-solid fa-list-check"></i>
                <span>Layanan Kami</span>
            </div>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900">Layanan yang Kami Sediakan</h2>
            <p class="text-xs sm:text-sm text-slate-500">Temukan berbagai layanan dan fasilitas yang disediakan oleh {{ get_setting('division_short_name', 'Divisi') }} untuk Anda.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($services as $svc)
            <div class="bg-white rounded-2xl p-6 shadow-sm hover:shadow-md transition border border-slate-200 flex flex-col justify-between group">
                <div class="space-y-4">
                    <div class="w-12 h-12 rounded-xl flex items-center justify-center text-xl text-white transition group-hover:scale-110" style="background-color: var(--color-primary);">
                        <i class="{{ $svc->icon ?: 'fa-solid fa-briefcase-medical' }}"></i>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 group-hover:text-theme-primary transition">{{ $svc->title }}</h3>
                    <p class="text-xs text-slate-600 leading-relaxed line-clamp-3">
                        {{ $svc->summary ?: Str::limit(strip_tags($svc->description), 120) }}
                    </p>
                </div>

                <div class="pt-6 border-t border-slate-100 mt-4 flex items-center justify-between">
                    <a href="{{ route('services.detail', $svc->slug) }}" class="text-xs font-bold text-theme-primary flex items-center group-hover:underline">
                        Lihat Alur & Syarat <i class="fa-solid fa-arrow-right ml-1.5 text-[10px]"></i>
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-10">
            <a href="{{ route('services') }}" class="inline-flex items-center px-6 py-3 rounded-xl bg-white border border-slate-300 font-bold text-xs text-slate-700 hover:bg-slate-50 shadow-sm transition">
                Lihat Seluruh Layanan <i class="fa-solid fa-arrow-right ml-2 text-xs"></i>
            </a>
        </div>
    </div>
</section>
@endif

<!-- News & Announcements Section -->
<section class="py-16 lg:py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-12 gap-4">
            <div class="space-y-2 max-w-xl">
                <div class="inline-flex items-center space-x-2 text-xs font-bold uppercase tracking-wider px-3 py-1 rounded-md text-theme-primary bg-slate-100">
                    <i class="fa-regular fa-newspaper"></i>
                    <span>Informasi Terkini</span>
                </div>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900">Berita & Pengumuman Terbaru</h2>
                <p class="text-xs sm:text-sm text-slate-500">Ikuti kegiatan, pengumuman resmi, dan kabar terkini dari divisi kami.</p>
            </div>
            <div class="flex space-x-2">
                <a href="{{ route('posts', ['type' => 'berita']) }}" class="px-4 py-2 rounded-lg bg-slate-100 hover:bg-slate-200 text-xs font-bold text-slate-700 transition">Berita</a>
                <a href="{{ route('posts', ['type' => 'pengumuman']) }}" class="px-4 py-2 rounded-lg bg-slate-100 hover:bg-slate-200 text-xs font-bold text-slate-700 transition">Pengumuman</a>
                <a href="{{ route('posts') }}" class="px-4 py-2 rounded-lg bg-theme-primary text-white text-xs font-bold transition">Semua Berita</a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($latestPosts as $post)
            <article class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition border border-slate-200 flex flex-col justify-between group">
                <div>
                    <!-- Post Thumbnail -->
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
                                {{ $post->type == 'pengumuman' ? 'Pengumuman' : 'Berita' }}
                            </span>
                        </div>
                    </div>

                    <!-- Post Body -->
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
                    <span class="text-slate-400"><i class="fa-regular fa-eye mr-1"></i> {{ $post->views_count }} pembaca</span>
                    <a href="{{ route('posts.detail', $post->slug) }}" class="font-bold text-theme-primary flex items-center hover:underline">
                        Baca Selengkapnya <i class="fa-solid fa-arrow-right ml-1.5 text-[10px]"></i>
                    </a>
                </div>
            </article>
            @empty
            <div class="col-span-3 text-center py-12 bg-white rounded-2xl border border-dashed border-slate-300 text-slate-400">
                <i class="fa-regular fa-folder-open text-3xl mb-2"></i>
                <p class="text-sm">Belum ada berita atau pengumuman yang dipublikasikan saat ini.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Upcoming Agenda & Download Center Preview -->
<section class="py-16 bg-slate-900 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
            <!-- Agenda List (Col 7) -->
            <div class="lg:col-span-7 space-y-6">
                <div class="flex justify-between items-center">
                    <div>
                        <div class="text-xs uppercase tracking-wider text-sky-400 font-bold mb-1">Agenda & Jadwal</div>
                        <h2 class="text-2xl font-bold">Kegiatan yang Akan Datang</h2>
                    </div>
                    <a href="{{ route('events') }}" class="text-xs text-slate-300 hover:text-white font-medium flex items-center">
                        Lihat Semua Agenda <i class="fa-solid fa-chevron-right ml-1.5 text-[10px]"></i>
                    </a>
                </div>

                <div class="space-y-4">
                    @forelse($upcomingEvents as $evt)
                    <div class="bg-slate-800/80 border border-slate-700/80 rounded-xl p-4 sm:p-5 flex items-start space-x-4 hover:border-sky-500 transition">
                        <!-- Date Badge -->
                        <div class="w-14 h-14 rounded-xl bg-slate-700 text-center flex flex-col justify-center flex-shrink-0 border border-slate-600">
                            <span class="text-xs font-bold uppercase text-sky-400">{{ $evt->start_date->format('M') }}</span>
                            <span class="text-lg font-black text-white leading-tight">{{ $evt->start_date->format('d') }}</span>
                        </div>

                        <!-- Event Info -->
                        <div class="flex-grow space-y-1">
                            <h3 class="text-sm sm:text-base font-bold text-white hover:text-sky-400 transition">
                                <a href="{{ route('events.detail', $evt->slug) }}">{{ $evt->title }}</a>
                            </h3>
                            <div class="flex flex-wrap items-center gap-3 text-xs text-slate-400">
                                <span><i class="fa-regular fa-clock text-sky-400 mr-1"></i> {{ $evt->start_date->format('H:i') }} WIB</span>
                                @if($evt->location)
                                    <span><i class="fa-solid fa-location-dot text-rose-400 mr-1"></i> {{ $evt->location }}</span>
                                @endif
                            </div>
                        </div>

                        @if($evt->registration_link)
                            <a href="{{ $evt->registration_link }}" target="_blank" class="px-3 py-1.5 rounded-lg bg-sky-600 hover:bg-sky-500 text-white font-bold text-xs flex-shrink-0 hidden sm:inline-block">
                                Daftar Kegiatan
                            </a>
                        @endif
                    </div>
                    @empty
                    <div class="p-6 rounded-xl bg-slate-800/50 border border-slate-800 text-center text-slate-400 text-xs">
                        Belum ada jadwal kegiatan mendatang saat ini.
                    </div>
                    @endforelse
                </div>
            </div>

            <!-- Download Shortcuts (Col 5) -->
            <div class="lg:col-span-5 space-y-6">
                <div class="flex justify-between items-center">
                    <div>
                        <div class="text-xs uppercase tracking-wider text-emerald-400 font-bold mb-1">Pusat Unduhan</div>
                        <h2 class="text-2xl font-bold">Buku Panduan & Formulir</h2>
                    </div>
                    <a href="{{ route('documents') }}" class="text-xs text-slate-300 hover:text-white font-medium flex items-center">
                        Lihat Semua Berkas <i class="fa-solid fa-chevron-right ml-1.5 text-[10px]"></i>
                    </a>
                </div>

                <div class="bg-slate-800/60 border border-slate-700/60 rounded-2xl p-4 sm:p-6 space-y-3">
                    @forelse($latestDocuments as $doc)
                    <div class="p-3 rounded-xl bg-slate-800 hover:bg-slate-700/80 transition flex items-center justify-between border border-slate-700/50">
                        <div class="flex items-center space-x-3 overflow-hidden pr-2">
                            <div class="w-8 h-8 rounded-lg bg-rose-500/20 text-rose-400 flex items-center justify-center text-xs font-bold flex-shrink-0">
                                <i class="fa-solid fa-file-pdf"></i>
                            </div>
                            <div class="truncate">
                                <div class="text-xs font-bold text-slate-200 truncate">{{ $doc->title }}</div>
                                <div class="text-[10px] text-slate-400">{{ $doc->file_type }} • {{ $doc->file_size }}</div>
                            </div>
                        </div>
                        <a href="{{ route('documents.download', $doc->id) }}" class="p-2 rounded-lg bg-slate-700 hover:bg-emerald-600 text-slate-200 hover:text-white transition text-xs flex-shrink-0" title="Unduh Dokumen">
                            <i class="fa-solid fa-download"></i>
                        </a>
                    </div>
                    @empty
                    <div class="text-center py-6 text-xs text-slate-400">
                        Belum ada dokumen yang diunggah saat ini.
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Team & Organization Preview -->
@if($teamMembers->count() > 0 || get_setting('organization_chart_image'))
<section class="py-16 lg:py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto space-y-3 mb-12">
            <div class="inline-flex items-center space-x-2 text-xs font-bold uppercase tracking-wider px-3 py-1 rounded-md text-theme-primary bg-slate-100">
                <i class="fa-solid fa-sitemap"></i>
                <span>Struktur & Tim</span>
            </div>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900">Struktur Organisasi</h2>
            <p class="text-xs sm:text-sm text-slate-500">Personalia yang siap mendukung dan melayani kebutuhan Anda di {{ get_setting('division_short_name', 'Divisi') }}.</p>
        </div>

        @if($teamMembers->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($teamMembers as $tm)
            <div class="bg-slate-50 rounded-2xl p-6 text-center border border-slate-200/80 hover:shadow-md transition space-y-3">
                <div class="w-24 h-24 mx-auto rounded-full bg-slate-200 overflow-hidden border-2 border-theme-primary shadow-sm">
                    @if($tm->photo)
                        <img src="{{ $tm->photo }}" alt="{{ $tm->name }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-slate-400 bg-slate-100 text-3xl">
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
                @if($tm->email)
                    <div class="pt-2 border-t border-slate-200">
                        <a href="mailto:{{ $tm->email }}" class="text-xs text-slate-500 hover:text-theme-primary transition truncate block">
                            <i class="fa-regular fa-envelope mr-1"></i> {{ $tm->email }}
                        </a>
                    </div>
                @endif
            </div>
            @endforeach
        </div>
        @endif

        <div class="text-center mt-10 flex flex-wrap justify-center gap-3">
            <a href="{{ route('profile') }}#struktur" class="inline-flex items-center px-6 py-3 rounded-xl bg-theme-primary text-white font-bold text-xs uppercase tracking-wider shadow hover:opacity-90 transition">
                Lihat Seluruh Personil <i class="fa-solid fa-arrow-right ml-2 text-xs"></i>
            </a>
            @if(get_setting('organization_chart_image'))
            <a href="{{ route('profile') }}#struktur" class="inline-flex items-center px-5 py-3 rounded-xl bg-slate-100 border border-slate-300 font-bold text-xs text-slate-700 hover:bg-slate-200 shadow-sm transition">
                <i class="fa-solid fa-diagram-project mr-2 text-theme-primary"></i> Buka Bagan Diagram
            </a>
            @endif
        </div>
    </div>
</section>
@endif
@endsection
