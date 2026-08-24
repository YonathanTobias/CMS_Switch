@extends('layouts.frontend')

@section('title', $event->title . ' - ' . get_setting('division_short_name', 'Divisi'))

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <!-- Breadcrumb -->
    <div class="flex items-center space-x-2 text-xs text-slate-500 mb-6">
        <a href="{{ route('home') }}" class="hover:text-theme-primary">Beranda</a>
        <span>/</span>
        <a href="{{ route('events') }}" class="hover:text-theme-primary">Agenda</a>
        <span>/</span>
        <span class="text-slate-700 truncate max-w-xs sm:max-w-md">{{ $event->title }}</span>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
        <!-- Main Event (8 cols) -->
        <div class="lg:col-span-8 space-y-6">
            <div class="bg-white rounded-2xl p-6 sm:p-8 shadow-sm border border-slate-200 space-y-6">
                <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 leading-tight">
                    {{ $event->title }}
                </h1>

                <!-- Event Key Details Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 bg-slate-50 p-4 rounded-xl border border-slate-100 text-xs text-slate-700">
                    <div class="flex items-start space-x-3">
                        <i class="fa-regular fa-calendar text-sky-600 text-base mt-0.5"></i>
                        <div>
                            <span class="font-bold block text-slate-900">Tanggal Pelaksanaan:</span>
                            <span>{{ $event->start_date->translatedFormat('l, d F Y') }}</span>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <i class="fa-regular fa-clock text-sky-600 text-base mt-0.5"></i>
                        <div>
                            <span class="font-bold block text-slate-900">Waktu:</span>
                            <span>{{ $event->start_date->format('H:i') }} WIB @if($event->end_date) - {{ $event->end_date->format('H:i') }} WIB @endif</span>
                        </div>
                    </div>
                    @if($event->location)
                    <div class="flex items-start space-x-3 sm:col-span-2">
                        <i class="fa-solid fa-location-dot text-rose-600 text-base mt-0.5"></i>
                        <div>
                            <span class="font-bold block text-slate-900">Tempat / Lokasi:</span>
                            <span>{{ $event->location }}</span>
                        </div>
                    </div>
                    @endif
                </div>

                @if($event->poster)
                <div class="rounded-xl overflow-hidden shadow">
                    <img src="{{ $event->poster }}" alt="{{ $event->title }}" class="w-full h-auto">
                </div>
                @endif

                <!-- Description -->
                <div class="space-y-3">
                    <h3 class="text-base font-bold text-slate-900">Deskripsi & Informasi Kegiatan</h3>
                    <div class="prose max-w-none text-slate-600 text-sm leading-relaxed whitespace-pre-line">
                        {{ $event->description }}
                    </div>
                </div>

                @if($event->registration_link)
                <div class="pt-4 border-t border-slate-100">
                    <a href="{{ $event->registration_link }}" target="_blank" class="px-6 py-3 rounded-xl bg-theme-primary text-white font-bold text-xs uppercase tracking-wider inline-flex items-center shadow hover:opacity-90 transition">
                        <i class="fa-solid fa-link mr-2"></i> Buka Tautan Registrasi / Pendaftaran
                    </a>
                </div>
                @endif
            </div>
        </div>

        <!-- Sidebar (4 cols) -->
        <div class="lg:col-span-4 space-y-6">
            @if($otherEvents->count() > 0)
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-200 space-y-4">
                <h3 class="font-bold text-slate-900 text-sm border-b pb-3">Agenda Lainnya</h3>
                <div class="space-y-3">
                    @foreach($otherEvents as $oth)
                    <a href="{{ route('events.detail', $oth->slug) }}" class="block group">
                        <div class="text-[11px] text-slate-400">{{ $oth->start_date->translatedFormat('d M Y') }}</div>
                        <div class="text-xs font-bold text-slate-800 group-hover:text-theme-primary transition leading-snug line-clamp-2">{{ $oth->title }}</div>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
