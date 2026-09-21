<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Visual Builder - {{ $page->title }}</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind CSS for Studio UI -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- GrapesJS Core CSS & JS -->
    <link rel="stylesheet" href="https://unpkg.com/grapesjs/dist/css/grapes.min.css">
    <script src="https://unpkg.com/grapesjs"></script>

    <style>
        :root {
            --color-primary: {{ get_setting('theme_primary_color', '#0e7490') }};
            --color-secondary: {{ get_setting('theme_secondary_color', '#0284c7') }};
        }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        /* Custom GrapesJS Theme Overrides */
        .gjs-one-bg {
            background-color: #0f172a !important;
        }
        .gjs-two-color {
            color: #94a3b8 !important;
        }
        .gjs-three-bg {
            background-color: #1e293b !important;
            color: #f8fafc !important;
        }
        .gjs-four-color, .gjs-four-color-h:hover {
            color: #38bdf8 !important;
        }
        .gjs-pn-btn.gjs-pn-active {
            background-color: #38bdf8 !important;
            color: #0f172a !important;
        }
        .gjs-block {
            user-select: none;
            min-height: 75px !important;
            padding: 10px !important;
            background: #1e293b !important;
            border: 1px solid #334155 !important;
            border-radius: 12px !important;
            color: #cbd5e1 !important;
            box-shadow: 0 1px 3px rgba(0,0,0,0.2) !important;
            transition: all 0.2s ease !important;
            display: flex !important;
            flex-direction: column !important;
            align-items: center !important;
            justify-content: center !important;
            text-align: center !important;
        }
        .gjs-block:hover {
            border-color: #38bdf8 !important;
            color: #ffffff !important;
            transform: translateY(-2px);
            background: #334155 !important;
        }
        .gjs-block-label {
            font-size: 11px !important;
            font-weight: 600 !important;
            margin-top: 6px !important;
        }
        .gjs-block svg, .gjs-block i {
            font-size: 20px !important;
        }
        .gjs-cv-canvas {
            background-color: #e2e8f0 !important;
        }
    </style>
</head>
<body class="h-screen w-screen overflow-hidden flex flex-col bg-slate-900 text-slate-100">

    <!-- Top Navigation & Studio Toolbar -->
    <header class="h-14 bg-slate-950 border-b border-slate-800 flex items-center justify-between px-4 z-30 shrink-0">
        <!-- Left: Back & Title -->
        <div class="flex items-center space-x-3">
            <a href="{{ route('admin.pages.index') }}" class="p-2 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-300 hover:text-white transition text-xs flex items-center space-x-1.5" title="Kembali ke Daftar Halaman">
                <i class="fa-solid fa-arrow-left"></i>
                <span class="hidden sm:inline font-semibold">Admin</span>
            </a>
            <div class="h-5 w-px bg-slate-800"></div>
            <div class="flex items-center space-x-2">
                <span class="px-2 py-0.5 rounded bg-sky-950 text-sky-400 border border-sky-800 text-[10px] font-extrabold uppercase tracking-wider">Visual Studio</span>
                <span class="text-xs font-bold text-white truncate max-w-[200px] sm:max-w-xs">{{ $page->title }}</span>
            </div>
        </div>

        <!-- Center: Device Switcher & History Controls -->
        <div class="flex items-center space-x-1 bg-slate-900 p-1 rounded-xl border border-slate-800">
            <button id="btn-device-desktop" class="px-3 py-1.5 rounded-lg text-xs font-semibold bg-sky-500 text-slate-950 shadow transition flex items-center space-x-1.5" title="Tampilan Desktop">
                <i class="fa-solid fa-desktop text-xs"></i> <span class="hidden md:inline">Desktop</span>
            </button>
            <button id="btn-device-tablet" class="px-3 py-1.5 rounded-lg text-xs font-semibold text-slate-400 hover:text-white hover:bg-slate-800 transition flex items-center space-x-1.5" title="Tampilan Tablet">
                <i class="fa-solid fa-tablet-screen-button text-xs"></i> <span class="hidden md:inline">Tablet</span>
            </button>
            <button id="btn-device-mobile" class="px-3 py-1.5 rounded-lg text-xs font-semibold text-slate-400 hover:text-white hover:bg-slate-800 transition flex items-center space-x-1.5" title="Tampilan Mobile">
                <i class="fa-solid fa-mobile-screen-button text-xs"></i> <span class="hidden md:inline">Mobile</span>
            </button>
        </div>

        <!-- Right: Actions & Save -->
        <div class="flex items-center space-x-2">
            <button id="btn-undo" class="p-2 rounded-lg bg-slate-900 hover:bg-slate-800 text-slate-400 hover:text-white transition text-xs" title="Undo (Ctrl+Z)">
                <i class="fa-solid fa-rotate-left"></i>
            </button>
            <button id="btn-redo" class="p-2 rounded-lg bg-slate-900 hover:bg-slate-800 text-slate-400 hover:text-white transition text-xs" title="Redo (Ctrl+Y)">
                <i class="fa-solid fa-rotate-right"></i>
            </button>
            <button id="btn-preview" class="p-2 rounded-lg bg-slate-900 hover:bg-slate-800 text-slate-400 hover:text-white transition text-xs" title="Preview Tampilan">
                <i class="fa-solid fa-eye"></i>
            </button>
            <button id="btn-clear" class="p-2 rounded-lg bg-slate-900 hover:bg-rose-950/60 text-slate-400 hover:text-rose-400 transition text-xs" title="Kosongkan Kanvas">
                <i class="fa-regular fa-trash-can"></i>
            </button>

            <div class="h-5 w-px bg-slate-800"></div>

            <a href="{{ route('page', $page->slug) }}" target="_blank" class="px-3 py-1.5 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-300 hover:text-white font-bold text-xs transition flex items-center space-x-1.5">
                <i class="fa-solid fa-arrow-up-right-from-square text-[11px]"></i>
                <span class="hidden lg:inline">Lihat Halaman</span>
            </a>

            <button id="btn-save" class="px-4 py-1.5 rounded-xl bg-emerald-500 hover:bg-emerald-400 text-slate-950 font-bold text-xs shadow-lg transition flex items-center space-x-1.5">
                <i class="fa-solid fa-floppy-disk text-xs"></i>
                <span>Simpan Halaman</span>
            </button>
        </div>
    </header>

    <!-- Main Workspace Container -->
    <div class="flex-1 flex overflow-hidden relative">
        
        <!-- Left Sidebar: Block Catalog -->
        <div class="w-72 bg-slate-950 border-r border-slate-800 flex flex-col shrink-0 z-20">
            <div class="p-3.5 border-b border-slate-800 flex items-center justify-between">
                <span class="text-xs font-bold text-sky-400 uppercase tracking-wider flex items-center">
                    <i class="fa-solid fa-cubes mr-2 text-sm"></i> Katalog Blok
                </span>
                <span class="text-[10px] text-slate-400">Drag & Drop ke Kanvas</span>
            </div>
            <div id="blocks-container" class="flex-1 overflow-y-auto p-3 space-y-2">
                <!-- GrapesJS will render blocks here -->
            </div>
        </div>

        <!-- Center: Visual Editor Canvas -->
        <div class="flex-1 flex flex-col bg-slate-800 overflow-hidden relative">
            <div id="gjs" class="flex-1 w-full h-full"></div>
        </div>

        <!-- Right Sidebar: Style & Trait & Layers Manager -->
        <div class="w-80 bg-slate-950 border-l border-slate-800 flex flex-col shrink-0 z-20">
            <!-- Tabs Header -->
            <div class="flex border-b border-slate-800 bg-slate-900/60 text-xs font-bold">
                <button id="tab-style" class="flex-1 py-3 text-center border-b-2 border-sky-400 text-sky-400 transition flex items-center justify-center space-x-1.5">
                    <i class="fa-solid fa-paintbrush text-xs"></i> <span>Gaya (Style)</span>
                </button>
                <button id="tab-traits" class="flex-1 py-3 text-center border-b-2 border-transparent text-slate-400 hover:text-slate-200 transition flex items-center justify-center space-x-1.5">
                    <i class="fa-solid fa-sliders text-xs"></i> <span>Opsi (Traits)</span>
                </button>
                <button id="tab-layers" class="flex-1 py-3 text-center border-b-2 border-transparent text-slate-400 hover:text-slate-200 transition flex items-center justify-center space-x-1.5">
                    <i class="fa-solid fa-layer-group text-xs"></i> <span>Lapisan</span>
                </button>
            </div>

            <!-- Panel Contents -->
            <div class="flex-1 overflow-y-auto">
                <div id="styles-panel" class="p-3"></div>
                <div id="traits-panel" class="p-3 hidden"></div>
                <div id="layers-panel" class="p-3 hidden"></div>
            </div>
        </div>

    </div>

    <!-- Toast Notification -->
    <div id="toast" class="fixed bottom-6 right-6 z-50 transform translate-y-20 opacity-0 transition-all duration-300 bg-emerald-600 text-white px-5 py-3 rounded-2xl shadow-2xl flex items-center space-x-3 text-xs font-bold">
        <i class="fa-solid fa-circle-check text-base"></i>
        <span id="toast-message">Halaman berhasil disimpan!</span>
    </div>

    @php
        $existingProject = ($page->layout_type === 'grapesjs' && is_array($page->blocks_data)) ? $page->blocks_data : null;
        $existingHtml = $page->content ?? '';
    @endphp

    <!-- GrapesJS Initialization Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const saveUrl = "{{ route('admin.pages.builder.save', $page->id) }}";

            // Initialize GrapesJS Editor
            const editor = grapesjs.init({
                container: '#gjs',
                height: '100%',
                width: 'auto',
                fromElement: false,
                storageManager: false, // We handle saving via AJAX
                blockManager: {
                    appendTo: '#blocks-container'
                },
                styleManager: {
                    appendTo: '#styles-panel',
                    sectors: [
                        {
                            name: 'Tipografi (Teks & Font)',
                            open: true,
                            buildProps: ['font-family', 'font-size', 'font-weight', 'letter-spacing', 'color', 'line-height', 'text-align', 'text-decoration']
                        },
                        {
                            name: 'Dimensi & Spasi',
                            open: false,
                            buildProps: ['width', 'min-width', 'max-width', 'height', 'margin', 'padding']
                        },
                        {
                            name: 'Latar Belakang (Background)',
                            open: false,
                            buildProps: ['background-color', 'background', 'opacity']
                        },
                        {
                            name: 'Bingkai & Sudut (Border)',
                            open: false,
                            buildProps: ['border', 'border-radius', 'box-shadow']
                        },
                        {
                            name: 'Tata Letak (Flexbox / Grid)',
                            open: false,
                            buildProps: ['display', 'flex-direction', 'justify-content', 'align-items', 'gap']
                        }
                    ]
                },
                traitManager: {
                    appendTo: '#traits-panel'
                },
                layerManager: {
                    appendTo: '#layers-panel'
                },
                panels: { defaults: [] }, // We use custom top bar and custom sidebar panels
                canvas: {
                    styles: [
                        'https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap',
                        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css',
                        'https://cdn.tailwindcss.com'
                    ],
                    scripts: [
                        'https://cdn.tailwindcss.com'
                    ]
                }
            });

            // Set canvas initial custom CSS for theme colors and styling
            editor.on('load', () => {
                const iframe = editor.Canvas.getFrameEl();
                const doc = iframe.contentDocument || iframe.contentWindow.document;
                const styleEl = doc.createElement('style');
                styleEl.innerHTML = `
                    :root {
                        --color-primary: {{ get_setting('theme_primary_color', '#0e7490') }};
                        --color-secondary: {{ get_setting('theme_secondary_color', '#0284c7') }};
                    }
                    body {
                        font-family: 'Plus Jakarta Sans', sans-serif;
                        color: #1e293b;
                        background-color: #ffffff;
                        margin: 0;
                        padding: 0;
                    }
                    .text-theme-primary { color: var(--color-primary); }
                    .bg-theme-primary { background-color: var(--color-primary); }
                `;
                doc.head.appendChild(styleEl);

                // Load existing content if available
                @if($existingProject && !empty($existingProject['components']))
                    editor.setComponents(@json($existingProject['components']));
                    if (@json($existingProject['styles'])) {
                        editor.setStyle(@json($existingProject['styles']));
                    }
                @elseif(!empty($existingHtml))
                    editor.setComponents(`{!! addslashes($existingHtml) !!}`);
                @else
                    // Default template for empty page
                    editor.setComponents(`
                        <div class="py-20 text-white text-center" style="background: linear-gradient(135deg, var(--color-primary), var(--color-secondary));">
                            <div class="max-w-4xl mx-auto px-4 space-y-4">
                                <span class="px-3 py-1 rounded-full bg-white/20 text-xs font-bold uppercase tracking-wider">Halaman Baru</span>
                                <h1 class="text-4xl font-extrabold">{{ $page->title }}</h1>
                                <p class="text-base text-white/90 max-w-2xl mx-auto">Klik dua kali pada teks ini untuk mulai mengedit atau drag blok baru dari sidebar kiri.</p>
                            </div>
                        </div>
                    `);
                @endif
            });

            // DEFINE CUSTOM BLOCKS (ELEMENTOR-STYLE)
            const bm = editor.BlockManager;

            // --- KATEGORI: GRID & LAYOUT ---
            bm.add('sect-1-col', {
                label: '1 Kolom Penuh',
                category: 'Tata Letak / Grid',
                attributes: { class: 'fa-solid fa-square' },
                content: `<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8"><div class="p-6 bg-slate-50 border border-slate-200 rounded-2xl text-center text-slate-500">Konten Kolom 1</div></div>`
            });

            bm.add('sect-2-col', {
                label: '2 Kolom (50/50)',
                category: 'Tata Letak / Grid',
                attributes: { class: 'fa-solid fa-table-columns' },
                content: `<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="p-6 bg-slate-50 border border-slate-200 rounded-2xl text-slate-700">Kolom Kiri</div>
                        <div class="p-6 bg-slate-50 border border-slate-200 rounded-2xl text-slate-700">Kolom Kanan</div>
                    </div>
                </div>`
            });

            bm.add('sect-3-col', {
                label: '3 Kolom Grid',
                category: 'Tata Letak / Grid',
                attributes: { class: 'fa-solid fa-table-cells' },
                content: `<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="p-6 bg-white shadow-sm border border-slate-200 rounded-2xl">Kolom 1</div>
                        <div class="p-6 bg-white shadow-sm border border-slate-200 rounded-2xl">Kolom 2</div>
                        <div class="p-6 bg-white shadow-sm border border-slate-200 rounded-2xl">Kolom 3</div>
                    </div>
                </div>`
            });

            bm.add('sect-4-col', {
                label: '4 Kolom Grid',
                category: 'Tata Letak / Grid',
                attributes: { class: 'fa-solid fa-border-all' },
                content: `<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <div class="p-4 bg-slate-50 border border-slate-200 rounded-xl">Kolom 1</div>
                        <div class="p-4 bg-slate-50 border border-slate-200 rounded-xl">Kolom 2</div>
                        <div class="p-4 bg-slate-50 border border-slate-200 rounded-xl">Kolom 3</div>
                        <div class="p-4 bg-slate-50 border border-slate-200 rounded-xl">Kolom 4</div>
                    </div>
                </div>`
            });

            // --- KATEGORI: ELEMEN DASAR ---
            bm.add('el-heading', {
                label: 'Heading / Judul',
                category: 'Elemen Dasar',
                attributes: { class: 'fa-solid fa-heading' },
                content: `<h2 class="text-3xl font-extrabold text-slate-900 tracking-tight my-3">Judul Seksi Baru</h2>`
            });

            bm.add('el-paragraph', {
                label: 'Teks Paragraf',
                category: 'Elemen Dasar',
                attributes: { class: 'fa-solid fa-paragraph' },
                content: `<p class="text-sm sm:text-base text-slate-600 leading-relaxed my-2">Tuliskan uraian paragraf informatif di sini. Anda dapat mengubah teks, ukuran font, perataan, dan warna teks langsung melalui panel inspektur.</p>`
            });

            bm.add('el-button', {
                label: 'Tombol Aksi (CTA)',
                category: 'Elemen Dasar',
                attributes: { class: 'fa-solid fa-square-arrow-up-right' },
                content: `<a href="#" class="inline-flex items-center px-6 py-3 rounded-xl bg-theme-primary text-white font-bold text-xs uppercase tracking-wider shadow hover:opacity-90 transition"><span>Klik Disini</span> <i class="fa-solid fa-arrow-right ml-2 text-[10px]"></i></a>`
            });

            bm.add('el-image', {
                label: 'Gambar / Foto',
                category: 'Elemen Dasar',
                attributes: { class: 'fa-regular fa-image' },
                content: `<div class="rounded-2xl overflow-hidden shadow border border-slate-200 my-4"><img src="https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?w=1200&auto=format&fit=crop&q=80" alt="Foto Kampus" class="w-full h-auto object-cover"></div>`
            });

            bm.add('el-video', {
                label: 'Embed Video YouTube',
                category: 'Elemen Dasar',
                attributes: { class: 'fa-brands fa-youtube text-rose-500' },
                content: `<div class="aspect-video rounded-2xl overflow-hidden shadow-lg border border-slate-200 my-4"><iframe class="w-full h-full" src="https://www.youtube.com/embed/dQw4w9WgXcQ" frameborder="0" allowfullscreen></iframe></div>`
            });

            bm.add('el-divider', {
                label: 'Garis Pembatas',
                category: 'Elemen Dasar',
                attributes: { class: 'fa-solid fa-minus' },
                content: `<hr class="my-8 border-t border-slate-200" />`
            });

            // --- KATEGORI: PRESET KAMPUS STIKES ---
            bm.add('tpl-hero', {
                label: '🌟 Hero Banner Utama',
                category: '✨ Preset Komponen Kampus',
                attributes: { class: 'fa-solid fa-wand-magic-sparkles text-amber-400' },
                content: `<div class="relative py-20 lg:py-28 overflow-hidden text-white" style="background: linear-gradient(135deg, var(--color-primary), var(--color-secondary));">
                    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-5 relative z-10">
                        <div class="inline-flex items-center space-x-2 bg-white/20 backdrop-blur-md px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider border border-white/20">
                            <span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span>
                            <span>Layanan Unggulan STIKES</span>
                        </div>
                        <h1 class="text-3xl sm:text-5xl font-extrabold tracking-tight leading-tight">Pusat Layanan & Informasi Terpadu</h1>
                        <p class="text-base sm:text-lg text-slate-100 max-w-2xl mx-auto font-normal leading-relaxed">Memberikan kemudahan akses dan transparansi layanan prima untuk seluruh sivitas akademika.</p>
                        <div class="flex flex-wrap justify-center gap-4 pt-4">
                            <a href="#" class="px-6 py-3 rounded-xl bg-white text-slate-900 font-bold text-sm shadow-xl hover:bg-slate-100 transition">Mulai Jelajahi</a>
                            <a href="#" class="px-6 py-3 rounded-xl bg-white/20 text-white font-bold text-sm border border-white/30 hover:bg-white/30 transition">Hubungi Kami</a>
                        </div>
                    </div>
                </div>`
            });

            bm.add('tpl-services', {
                label: '🗂️ Grid Kartu Layanan',
                category: '✨ Preset Komponen Kampus',
                attributes: { class: 'fa-solid fa-grip' },
                content: `<section class="py-16 bg-slate-50 border-y border-slate-200">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="text-center max-w-2xl mx-auto space-y-2 mb-12">
                            <span class="text-xs font-bold text-theme-primary uppercase tracking-wider">Fasilitas</span>
                            <h2 class="text-3xl font-extrabold text-slate-900">Layanan Prima Divisi</h2>
                            <p class="text-sm text-slate-500">Berbagai solusi digital dan administrasi terpadu untuk kebutuhan kampus.</p>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="p-6 bg-white rounded-2xl border border-slate-200 shadow-sm space-y-3">
                                <div class="w-12 h-12 rounded-xl flex items-center justify-center text-white text-xl shadow" style="background-color: var(--color-primary);"><i class="fa-solid fa-laptop-code"></i></div>
                                <h3 class="text-base font-bold text-slate-900">Portal Akademik Terpadu</h3>
                                <p class="text-xs text-slate-600 leading-relaxed">Sistem informasi untuk kemudahan pengelolaan data nilai dan kartu rencana studi.</p>
                            </div>
                            <div class="p-6 bg-white rounded-2xl border border-slate-200 shadow-sm space-y-3">
                                <div class="w-12 h-12 rounded-xl flex items-center justify-center text-white text-xl shadow" style="background-color: var(--color-primary);"><i class="fa-solid fa-network-wired"></i></div>
                                <h3 class="text-base font-bold text-slate-900">Jaringan Internet Cepat</h3>
                                <p class="text-xs text-slate-600 leading-relaxed">Akses Wi-Fi berkecepatan tinggi yang mencakup seluruh ruang kelas dan laboratorium.</p>
                            </div>
                            <div class="p-6 bg-white rounded-2xl border border-slate-200 shadow-sm space-y-3">
                                <div class="w-12 h-12 rounded-xl flex items-center justify-center text-white text-xl shadow" style="background-color: var(--color-primary);"><i class="fa-solid fa-shield-halved"></i></div>
                                <h3 class="text-base font-bold text-slate-900">Keamanan & Layanan Helpdesk</h3>
                                <p class="text-xs text-slate-600 leading-relaxed">Pendampingan teknis dan respon cepat terhadap kendala sistem setiap hari kerja.</p>
                            </div>
                        </div>
                    </div>
                </section>`
            });

            bm.add('tpl-two-col', {
                label: '⚖️ Dua Kolom (Media & Teks)',
                category: '✨ Preset Komponen Kampus',
                attributes: { class: 'fa-solid fa-columns' },
                content: `<section class="py-16 bg-white">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
                            <div class="lg:col-span-6 space-y-4">
                                <span class="text-xs font-bold text-theme-primary uppercase tracking-wider">Tentang Program</span>
                                <h2 class="text-3xl font-extrabold text-slate-900 leading-tight">Meningkatkan Standar Pendidikan dan Kesehatan</h2>
                                <p class="text-sm text-slate-600 leading-relaxed">Kami berdedikasi menciptakan ekosistem kampus yang inovatif dengan menghadirkan sarana prasarana modern bagi seluruh civitas akademika.</p>
                                <div class="pt-2">
                                    <a href="#" class="px-6 py-2.5 rounded-xl bg-theme-primary text-white font-bold text-xs uppercase tracking-wider shadow">Pelajari Lebih Lanjut</a>
                                </div>
                            </div>
                            <div class="lg:col-span-6">
                                <div class="rounded-3xl overflow-hidden shadow-xl border border-slate-200">
                                    <img src="https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?w=800&auto=format&fit=crop&q=80" alt="Ilustrasi" class="w-full h-80 object-cover">
                                </div>
                            </div>
                        </div>
                    </div>
                </section>`
            });

            bm.add('tpl-stats', {
                label: '📊 Statistik & Angka Kunci',
                category: '✨ Preset Komponen Kampus',
                attributes: { class: 'fa-solid fa-chart-simple' },
                content: `<section class="py-12 bg-slate-900 text-white border-y border-slate-800">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
                            <div class="p-6 rounded-2xl bg-white/5 border border-white/10 space-y-1">
                                <div class="text-3xl font-extrabold text-sky-400">1.500+</div>
                                <div class="text-xs text-slate-300 font-semibold uppercase tracking-wider">Mahasiswa Aktif</div>
                            </div>
                            <div class="p-6 rounded-2xl bg-white/5 border border-white/10 space-y-1">
                                <div class="text-3xl font-extrabold text-sky-400">99.5%</div>
                                <div class="text-xs text-slate-300 font-semibold uppercase tracking-wider">Kepuasan Sivitas</div>
                            </div>
                            <div class="p-6 rounded-2xl bg-white/5 border border-white/10 space-y-1">
                                <div class="text-3xl font-extrabold text-sky-400">24 Jam</div>
                                <div class="text-xs text-slate-300 font-semibold uppercase tracking-wider">Akses Layanan Online</div>
                            </div>
                            <div class="p-6 rounded-2xl bg-white/5 border border-white/10 space-y-1">
                                <div class="text-3xl font-extrabold text-sky-400">Grade A</div>
                                <div class="text-xs text-slate-300 font-semibold uppercase tracking-wider">Akreditasi Mutu</div>
                            </div>
                        </div>
                    </div>
                </section>`
            });

            bm.add('tpl-cta', {
                label: '🚀 Call to Action WhatsApp',
                category: '✨ Preset Komponen Kampus',
                attributes: { class: 'fa-solid fa-bullhorn text-orange-400' },
                content: `<section class="py-14 bg-slate-950 text-white relative overflow-hidden text-center">
                    <div class="max-w-4xl mx-auto px-4 space-y-5 relative z-10">
                        <span class="px-3 py-1 rounded-full bg-white/10 text-emerald-400 text-xs font-bold uppercase tracking-wider">Hubungi Langsung</span>
                        <h2 class="text-3xl font-extrabold">Ada Kendala atau Butuh Bantuan Cepat?</h2>
                        <p class="text-sm text-slate-300 max-w-xl mx-auto">Tim kami siap melayani pertanyaan dan permohonan Anda setiap hari kerja.</p>
                        <div class="pt-2">
                            <a href="https://wa.me/628123456789" target="_blank" class="px-7 py-3.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-sm shadow-xl inline-flex items-center space-x-2">
                                <i class="fa-brands fa-whatsapp text-lg"></i> <span>Chat WhatsApp Official</span>
                            </a>
                        </div>
                    </div>
                </section>`
            });

            // DEVICE SWITCHER HANDLERS
            const btnDesktop = document.getElementById('btn-device-desktop');
            const btnTablet = document.getElementById('btn-device-tablet');
            const btnMobile = document.getElementById('btn-device-mobile');

            function resetDeviceBtns() {
                [btnDesktop, btnTablet, btnMobile].forEach(btn => {
                    btn.classList.remove('bg-sky-500', 'text-slate-950', 'shadow');
                    btn.classList.add('text-slate-400');
                });
            }

            btnDesktop.addEventListener('click', () => {
                editor.setDevice('Desktop');
                resetDeviceBtns();
                btnDesktop.classList.add('bg-sky-500', 'text-slate-950', 'shadow');
                btnDesktop.classList.remove('text-slate-400');
            });

            btnTablet.addEventListener('click', () => {
                editor.setDevice('Tablet');
                resetDeviceBtns();
                btnTablet.classList.add('bg-sky-500', 'text-slate-950', 'shadow');
                btnTablet.classList.remove('text-slate-400');
            });

            btnMobile.addEventListener('click', () => {
                editor.setDevice('Mobile');
                resetDeviceBtns();
                btnMobile.classList.add('bg-sky-500', 'text-slate-950', 'shadow');
                btnMobile.classList.remove('text-slate-400');
            });

            // Set up GrapesJS Devices
            editor.Devices.add({ id: 'Desktop', name: 'Desktop', width: '' });
            editor.Devices.add({ id: 'Tablet', name: 'Tablet', width: '768px' });
            editor.Devices.add({ id: 'Mobile', name: 'Mobile', width: '375px' });

            // TOP TOOLBAR ACTION HANDLERS
            document.getElementById('btn-undo').addEventListener('click', () => editor.UndoManager.undo());
            document.getElementById('btn-redo').addEventListener('click', () => editor.UndoManager.redo());
            document.getElementById('btn-preview').addEventListener('click', () => {
                editor.runCommand('preview');
            });
            document.getElementById('btn-clear').addEventListener('click', () => {
                if (confirm('Kosongkan seluruh kanvas halaman ini?')) {
                    editor.setComponents('');
                }
            });

            // RIGHT SIDEBAR TAB SWITCHING
            const tabStyle = document.getElementById('tab-style');
            const tabTraits = document.getElementById('tab-traits');
            const tabLayers = document.getElementById('tab-layers');

            const stylesPanel = document.getElementById('styles-panel');
            const traitsPanel = document.getElementById('traits-panel');
            const layersPanel = document.getElementById('layers-panel');

            function resetTabs() {
                [tabStyle, tabTraits, tabLayers].forEach(t => {
                    t.classList.remove('border-sky-400', 'text-sky-400');
                    t.classList.add('border-transparent', 'text-slate-400');
                });
                stylesPanel.classList.add('hidden');
                traitsPanel.classList.add('hidden');
                layersPanel.classList.add('hidden');
            }

            tabStyle.addEventListener('click', () => {
                resetTabs();
                tabStyle.classList.add('border-sky-400', 'text-sky-400');
                tabStyle.classList.remove('border-transparent', 'text-slate-400');
                stylesPanel.classList.remove('hidden');
            });

            tabTraits.addEventListener('click', () => {
                resetTabs();
                tabTraits.classList.add('border-sky-400', 'text-sky-400');
                tabTraits.classList.remove('border-transparent', 'text-slate-400');
                traitsPanel.classList.remove('hidden');
            });

            tabLayers.addEventListener('click', () => {
                resetTabs();
                tabLayers.classList.add('border-sky-400', 'text-sky-400');
                tabLayers.classList.remove('border-transparent', 'text-slate-400');
                layersPanel.classList.remove('hidden');
            });

            // SAVE VIA AJAX
            const btnSave = document.getElementById('btn-save');
            const toast = document.getElementById('toast');
            const toastMsg = document.getElementById('toast-message');

            function showToast(message, isError = false) {
                toastMsg.innerText = message;
                toast.classList.remove('bg-emerald-600', 'bg-rose-600');
                toast.classList.add(isError ? 'bg-rose-600' : 'bg-emerald-600');
                toast.classList.remove('translate-y-20', 'opacity-0');
                setTimeout(() => {
                    toast.classList.add('translate-y-20', 'opacity-0');
                }, 3500);
            }

            btnSave.addEventListener('click', async function() {
                const originalText = btnSave.innerHTML;
                btnSave.disabled = true;
                btnSave.innerHTML = `<i class="fa-solid fa-spinner fa-spin text-xs"></i> <span>Menyimpan...</span>`;

                try {
                    const html = editor.getHtml();
                    const css = editor.getCss();
                    const components = JSON.stringify(editor.getComponents());
                    const styles = JSON.stringify(editor.getStyle());

                    const response = await fetch(saveUrl, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            html: html,
                            css: css,
                            components: components,
                            styles: styles
                        })
                    });

                    const data = await response.json();
                    if (response.ok) {
                        showToast(data.message || 'Halaman berhasil disimpan!');
                    } else {
                        showToast('Gagal menyimpan perubahan.', true);
                    }
                } catch (err) {
                    showToast('Terjadi kesalahan jaringan.', true);
                    console.error(err);
                } finally {
                    btnSave.disabled = false;
                    btnSave.innerHTML = originalText;
                }
            });
        });
    </script>
</body>
</html>
