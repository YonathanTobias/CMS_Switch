@extends('layouts.frontend')

@section('title', $service->title . ' - ' . get_setting('division_short_name', 'Divisi'))

@section('content')
<!-- Header -->
<div class="py-14 text-white" style="background: linear-gradient(135deg, var(--color-primary), var(--color-secondary));">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl space-y-3">
            <div class="flex items-center space-x-2 text-xs uppercase tracking-wider text-slate-200">
                <a href="{{ route('services') }}" class="hover:underline">Layanan</a>
                <span>/</span>
                <span>Detail Layanan</span>
            </div>
            <h1 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold">{{ $service->title }}</h1>
            @if($service->summary)
                <p class="text-sm sm:text-base text-slate-100/90 leading-relaxed">{{ $service->summary }}</p>
            @endif
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <!-- Main Content (8 cols) -->
        <div class="lg:col-span-8 space-y-8">
            <!-- Deskripsi Layanan -->
            @if($service->description)
            <div class="bg-white rounded-2xl p-8 shadow-sm border border-slate-200 space-y-4">
                <h2 class="text-lg font-bold text-slate-900 flex items-center">
                    <i class="fa-solid fa-circle-info mr-2 text-theme-primary"></i> Deskripsi Layanan
                </h2>
                <div class="prose max-w-none text-slate-600 text-sm leading-relaxed whitespace-pre-line">
                    {{ $service->description }}
                </div>
            </div>
            @endif

            <!-- Persyaratan -->
            @if($service->requirements)
            <div class="bg-white rounded-2xl p-8 shadow-sm border border-slate-200 space-y-4">
                <h2 class="text-lg font-bold text-slate-900 flex items-center">
                    <i class="fa-solid fa-list-check mr-2 text-emerald-600"></i> Persyaratan Berkas / Administrasi
                </h2>
                <div class="prose max-w-none text-slate-600 text-sm leading-relaxed whitespace-pre-line bg-slate-50 p-4 rounded-xl border border-slate-100">
                    {{ $service->requirements }}
                </div>
            </div>
            @endif

            <!-- Alur & Prosedur -->
            @if($service->procedure)
            <div class="bg-white rounded-2xl p-8 shadow-sm border border-slate-200 space-y-4">
                <h2 class="text-lg font-bold text-slate-900 flex items-center">
                    <i class="fa-solid fa-route mr-2 text-sky-600"></i> Alur Prosedur Pelayanan
                </h2>
                <div class="prose max-w-none text-slate-600 text-sm leading-relaxed whitespace-pre-line">
                    {{ $service->procedure }}
                </div>
            </div>
            @endif

            <!-- Form Download if available -->
            @if($service->download_form_link)
            <div class="bg-sky-50 border border-sky-200 rounded-2xl p-6 flex flex-col sm:flex-row items-center justify-between gap-4">
                <div class="space-y-1 text-center sm:text-left">
                    <h4 class="font-bold text-slate-900 text-sm">Formulir / Dokumen Pengajuan</h4>
                    <p class="text-xs text-slate-600">Unduh formulir permohonan untuk melengkapi berkas persyaratan.</p>
                </div>
                <a href="{{ $service->download_form_link }}" target="_blank" class="px-5 py-2.5 rounded-xl bg-theme-primary text-white font-bold text-xs shadow hover:opacity-90 transition flex-shrink-0 flex items-center">
                    <i class="fa-solid fa-file-arrow-down mr-2"></i> Unduh Formulir
                </a>
            </div>
            @endif
        </div>

        <!-- Sidebar (4 cols) -->
        <div class="lg:col-span-4 space-y-6">
            <!-- Quick Help Box -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-200 space-y-4">
                <h3 class="font-bold text-slate-900 text-sm border-b pb-3">Butuh Bantuan Layanan?</h3>
                <p class="text-xs text-slate-600 leading-relaxed">
                    Jika Anda memiliki pertanyaan seputar prosedur atau kendala pengajuan layanan ini, silakan hubungi tim administrasi divisi.
                </p>
                <div class="space-y-2 text-xs text-slate-700">
                    <div><i class="fa-regular fa-envelope text-sky-600 mr-2"></i> {{ get_setting('contact_email') }}</div>
                    <div><i class="fa-solid fa-phone text-sky-600 mr-2"></i> {{ get_setting('contact_phone') }}</div>
                    <div><i class="fa-solid fa-door-open text-sky-600 mr-2"></i> {{ get_setting('contact_room') }}</div>
                </div>
                <a href="{{ route('contact') }}" class="w-full py-2.5 rounded-xl bg-emerald-500 hover:bg-emerald-600 text-white font-bold text-xs uppercase tracking-wider text-center block transition">
                    <i class="fa-brands fa-whatsapp mr-1.5"></i> Hubungi Kami
                </a>
            </div>

            <!-- Other Services -->
            @if($otherServices->count() > 0)
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-200 space-y-4">
                <h3 class="font-bold text-slate-900 text-sm border-b pb-3">Layanan Lainnya</h3>
                <div class="space-y-3">
                    @foreach($otherServices as $other)
                    <a href="{{ route('services.detail', $other->slug) }}" class="block group">
                        <div class="text-xs font-bold text-slate-800 group-hover:text-theme-primary transition">{{ $other->title }}</div>
                        <div class="text-[11px] text-slate-400 mt-0.5 line-clamp-1">{{ $other->summary ?: strip_tags($other->description) }}</div>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
