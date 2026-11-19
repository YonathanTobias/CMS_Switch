@extends('layouts.admin')

@section('title', 'Manajemen Layanan Divisi')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-2xl font-extrabold text-slate-900 dark:text-white">Layanan & Prosedur Divisi</h1>
            <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Kelola katalog layanan, persyaratan, alur prosedur, dan link unduh formulir.</p>
        </div>
        <a href="{{ route('admin.services.create') }}" class="px-5 py-2.5 rounded-xl bg-theme-primary text-white font-bold text-xs uppercase tracking-wider shadow hover:opacity-90 transition flex items-center">
            <i class="fa-solid fa-plus mr-2"></i> Tambah Layanan Baru
        </a>
    </div>

    <!-- Global Feature ON/OFF Switch Card -->
    <div class="p-5 rounded-2xl border transition-all {{ $featureEnabled ? 'bg-white dark:bg-slate-900 border-emerald-200 dark:border-emerald-900/60 shadow-sm' : 'bg-slate-100/80 dark:bg-slate-900/60 border-slate-300 dark:border-slate-800' }}">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div class="flex items-start space-x-3.5">
                <div class="w-11 h-11 rounded-xl flex items-center justify-center text-lg shrink-0 shadow-sm {{ $featureEnabled ? 'bg-emerald-600 text-white' : 'bg-slate-300 dark:bg-slate-800 text-slate-500' }}">
                    <i class="fa-solid fa-briefcase-medical"></i>
                </div>
                <div>
                    <div class="flex items-center space-x-2">
                        <h3 class="text-sm font-extrabold text-slate-900 dark:text-white">Status Modul Layanan Divisi di Website Publik</h3>
                        @if($featureEnabled)
                            <span class="px-2 py-0.5 rounded-full bg-emerald-100 dark:bg-emerald-950/60 text-emerald-700 dark:text-emerald-300 text-[10px] font-extrabold uppercase border border-emerald-200 dark:border-emerald-800">Aktif (ON)</span>
                        @else
                            <span class="px-2 py-0.5 rounded-full bg-rose-100 dark:bg-rose-950/60 text-rose-700 dark:text-rose-300 text-[10px] font-extrabold uppercase border border-rose-200 dark:border-rose-800">Nonaktif (OFF)</span>
                        @endif
                    </div>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-1 max-w-2xl leading-relaxed">
                        @if($featureEnabled)
                            Menu <strong>"Layanan"</strong> di navbar, seksi Layanan di beranda, dan halaman katalog <code class="text-emerald-600 font-semibold">/layanan</code> saat ini <strong>ditampilkan</strong> kepada pengunjung.
                        @else
                            Modul Layanan saat ini <strong>disembunyikan</strong> dari seluruh halaman publik (Navbar, Beranda, Footer, dan halaman <code class="text-rose-600 font-semibold">/layanan</code>).
                        @endif
                    </p>
                </div>
            </div>

            <!-- 1-Click Switch Form -->
            <form action="{{ route('admin.services.toggleFeature') }}" method="POST" class="flex items-center space-x-3 shrink-0">
                @csrf
                <input type="hidden" name="enable_services" value="{{ $featureEnabled ? '0' : '1' }}">
                <label class="relative inline-flex items-center cursor-pointer" title="Klik untuk {{ $featureEnabled ? 'Menonaktifkan' : 'Mengaktifkan' }} Fitur Layanan Divisi">
                    <input type="checkbox" onchange="this.form.submit()" {{ $featureEnabled ? 'checked' : '' }} class="sr-only peer">
                    <div class="w-14 h-7 bg-slate-300 dark:bg-slate-700 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-emerald-500 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[4px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-emerald-600"></div>
                </label>
                <span class="text-xs font-extrabold {{ $featureEnabled ? 'text-emerald-600 dark:text-emerald-400' : 'text-slate-500 dark:text-slate-400' }}">
                    {{ $featureEnabled ? 'ON' : 'OFF' }}
                </span>
            </form>
        </div>
    </div>

    <!-- Services Table -->
    <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-800 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-slate-600 dark:text-slate-300">
                <thead class="bg-slate-50 dark:bg-slate-800/60 border-b border-slate-200 dark:border-slate-800 text-slate-700 dark:text-slate-300 font-bold uppercase text-[10px] tracking-wider">
                    <tr>
                        <th class="p-4">Urutan</th>
                        <th class="p-4">Nama Layanan</th>
                        <th class="p-4">Ikon</th>
                        <th class="p-4">Formulir</th>
                        <th class="p-4">Status Item</th>
                        <th class="p-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                    @forelse($services as $svc)
                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/40 transition">
                        <td class="p-4 font-bold text-slate-400">#{{ $svc->order_index }}</td>
                        <td class="p-4">
                            <div class="font-bold text-slate-900 dark:text-white leading-snug">{{ $svc->title }}</div>
                            <div class="text-[11px] text-slate-400 mt-0.5 line-clamp-1">{{ $svc->summary }}</div>
                        </td>
                        <td class="p-4">
                            <div class="w-8 h-8 rounded-lg bg-sky-50 dark:bg-sky-950/60 text-sky-600 dark:text-sky-400 flex items-center justify-center text-sm border border-sky-100 dark:border-sky-900">
                                <i class="{{ $svc->icon ?: 'fa-solid fa-bell-concierge' }}"></i>
                            </div>
                        </td>
                        <td class="p-4">
                            @if($svc->download_form_link)
                                <a href="{{ $svc->download_form_link }}" target="_blank" class="text-sky-600 hover:underline flex items-center font-semibold text-[11px]">
                                    <i class="fa-solid fa-file-arrow-down mr-1"></i> Tersedia
                                </a>
                            @else
                                <span class="text-slate-400">-</span>
                            @endif
                        </td>
                        <td class="p-4">
                            <form action="{{ route('admin.services.toggleStatus', $svc->id) }}" method="POST" class="inline-flex items-center space-x-2">
                                @csrf
                                <label class="relative inline-flex items-center cursor-pointer" title="Klik untuk ubah status layanan ini">
                                    <input type="checkbox" onchange="this.form.submit()" {{ $svc->is_active ? 'checked' : '' }} class="sr-only peer">
                                    <div class="w-9 h-5 bg-slate-300 dark:bg-slate-700 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-emerald-500"></div>
                                </label>
                                @if($svc->is_active)
                                    <span class="px-2 py-0.5 rounded-full bg-emerald-50 dark:bg-emerald-950/50 text-emerald-700 dark:text-emerald-300 text-[10px] font-bold border border-emerald-200 dark:border-emerald-800">Aktif</span>
                                @else
                                    <span class="px-2 py-0.5 rounded-full bg-slate-100 dark:bg-slate-800 text-slate-500 text-[10px] font-bold">Nonaktif</span>
                                @endif
                            </form>
                        </td>
                        <td class="p-4 text-right space-x-2">
                            <a href="{{ route('services.detail', $svc->slug) }}" target="_blank" class="p-1.5 rounded-lg text-slate-400 hover:text-slate-700 hover:bg-slate-100 transition" title="Lihat"><i class="fa-regular fa-eye"></i></a>
                            <a href="{{ route('admin.services.edit', $svc->id) }}" class="p-1.5 rounded-lg text-sky-600 hover:bg-sky-50 transition" title="Edit"><i class="fa-regular fa-pen-to-square"></i></a>
                            <form action="{{ route('admin.services.destroy', $svc->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus layanan ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-1.5 rounded-lg text-rose-600 hover:bg-rose-50 transition" title="Hapus"><i class="fa-regular fa-trash-can"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="p-8 text-center text-slate-400">Belum ada layanan yang ditambahkan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
