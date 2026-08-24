@extends('layouts.frontend')

@section('title', 'Agenda Kegiatan - ' . get_setting('division_short_name', 'Divisi'))

@section('content')
<!-- Header -->
<div class="py-14 text-white" style="background: linear-gradient(135deg, var(--color-primary), var(--color-secondary));">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl space-y-2">
            <div class="text-xs uppercase tracking-wider font-semibold text-slate-200">Jadwal & Agenda</div>
            <h1 class="text-3xl sm:text-4xl font-extrabold">Agenda & Kalender Kegiatan</h1>
            <p class="text-sm sm:text-base text-slate-100/90">Daftar seminar, lokakarya, deadline hibah, dan jadwal kegiatan resmi divisi.</p>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-12">
    <!-- Upcoming Events -->
    <div class="space-y-6">
        <h2 class="text-xl font-bold text-slate-900 flex items-center">
            <i class="fa-regular fa-calendar-check mr-2 text-theme-primary"></i> Kegiatan Mendatang
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @forelse($upcomingEvents as $evt)
            <div class="bg-white rounded-2xl p-6 shadow-sm hover:shadow-md transition border border-slate-200 flex items-start space-x-5">
                <div class="w-16 h-16 rounded-2xl bg-slate-900 text-white text-center flex flex-col justify-center flex-shrink-0 shadow">
                    <span class="text-xs font-bold uppercase text-sky-400">{{ $evt->start_date->format('M') }}</span>
                    <span class="text-2xl font-black leading-none">{{ $evt->start_date->format('d') }}</span>
                </div>

                <div class="flex-grow space-y-2">
                    <h3 class="font-bold text-base text-slate-900 hover:text-theme-primary transition leading-snug">
                        <a href="{{ route('events.detail', $evt->slug) }}">{{ $evt->title }}</a>
                    </h3>

                    <div class="space-y-1 text-xs text-slate-500">
                        <div class="flex items-center"><i class="fa-regular fa-clock text-sky-600 mr-2"></i> {{ $evt->start_date->format('H:i') }} WIB @if($evt->end_date) - {{ $evt->end_date->format('H:i') }} WIB @endif</div>
                        @if($evt->location)
                            <div class="flex items-center"><i class="fa-solid fa-location-dot text-rose-500 mr-2"></i> {{ $evt->location }}</div>
                        @endif
                    </div>

                    <div class="pt-2 flex items-center space-x-3 text-xs">
                        <a href="{{ route('events.detail', $evt->slug) }}" class="font-bold text-theme-primary hover:underline">
                            Detail Agenda <i class="fa-solid fa-arrow-right ml-1 text-[10px]"></i>
                        </a>
                        @if($evt->registration_link)
                            <a href="{{ $evt->registration_link }}" target="_blank" class="px-2.5 py-1 rounded bg-sky-600 hover:bg-sky-700 text-white font-semibold text-[11px]">
                                Daftar Sekarang
                            </a>
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-2 text-center py-12 bg-white rounded-2xl border border-dashed border-slate-300 text-slate-400 text-sm">
                Tidak ada jadwal kegiatan mendatang saat ini.
            </div>
            @endforelse
        </div>

        <div class="mt-6">
            {{ $upcomingEvents->links() }}
        </div>
    </div>
</div>
@endsection
