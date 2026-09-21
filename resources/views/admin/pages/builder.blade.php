<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Elementor Pro Studio - {{ $page->title }}</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind CSS for Studio Shell UI -->
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
        
        /* Custom Elementor Pro Dark Theme UI for GrapesJS */
        .gjs-one-bg {
            background-color: #0b0f19 !important;
        }
        .gjs-two-color {
            color: #94a3b8 !important;
        }
        .gjs-three-bg {
            background-color: #111827 !important;
            color: #f8fafc !important;
        }
        .gjs-four-color, .gjs-four-color-h:hover {
            color: #38bdf8 !important;
        }
        .gjs-category-title {
            background: #111827 !important;
            padding: 10px 14px !important;
            font-size: 11px !important;
            font-weight: 800 !important;
            text-transform: uppercase !important;
            letter-spacing: 0.05em !important;
            color: #38bdf8 !important;
            border-bottom: 1px solid #1f2937 !important;
            border-top: 1px solid #1f2937 !important;
        }
        .gjs-blocks-c {
            display: grid !important;
            grid-template-columns: repeat(2, 1fr) !important;
            gap: 8px !important;
            padding: 10px !important;
            background: #0b0f19 !important;
        }
        .gjs-block {
            width: 100% !important;
            min-height: 80px !important;
            padding: 12px 6px !important;
            background: #131c2e !important;
            border: 1px solid #1e293b !important;
            border-radius: 12px !important;
            color: #cbd5e1 !important;
            box-shadow: 0 2px 4px rgba(0,0,0,0.3) !important;
            transition: all 0.2s ease !important;
            display: flex !important;
            flex-direction: column !important;
            align-items: center !important;
            justify-content: center !important;
            text-align: center !important;
            margin: 0 !important;
        }
        .gjs-block:hover {
            border-color: #38bdf8 !important;
            background: #1e293b !important;
            color: #ffffff !important;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(56, 189, 248, 0.15) !important;
        }
        .gjs-block-label {
            font-size: 10.5px !important;
            font-weight: 700 !important;
            margin-top: 8px !important;
            line-height: 1.2 !important;
        }
        .gjs-block-icon {
            font-size: 22px !important;
            line-height: 1 !important;
        }
        .gjs-cv-canvas {
            background-color: #cbd5e1 !important;
        }
        .gjs-sm-sector .gjs-sm-sector-title {
            background: #111827 !important;
            border-bottom: 1px solid #1f2937 !important;
            color: #e2e8f0 !important;
            font-size: 11px !important;
            font-weight: 700 !important;
            padding: 10px 14px !important;
        }
        .gjs-sm-property {
            background: #0b0f19 !important;
            border-bottom: 1px solid #162032 !important;
            padding: 8px 12px !important;
        }
        .gjs-sm-label {
            color: #94a3b8 !important;
            font-size: 11px !important;
            font-weight: 600 !important;
        }
        .gjs-field {
            background-color: #1e293b !important;
            border: 1px solid #334155 !important;
            border-radius: 8px !important;
            color: #f8fafc !important;
        }
        .gjs-field input, .gjs-field select {
            color: #f8fafc !important;
            font-size: 11px !important;
        }
        /* Custom scrollbars */
        ::-webkit-scrollbar {
            width: 5px;
            height: 5px;
        }
        ::-webkit-scrollbar-track {
            background: #0b0f19;
        }
        ::-webkit-scrollbar-thumb {
            background: #334155;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #475569;
        }
    </style>
</head>
<body class="h-screen w-screen overflow-hidden flex flex-col bg-slate-950 text-slate-100 select-none">

    <!-- Top Navigation & Elementor Pro Studio Header -->
    <header class="h-14 bg-slate-950 border-b border-slate-800/80 flex items-center justify-between px-4 z-30 shrink-0">
        <!-- Left: Brand & Page Title -->
        <div class="flex items-center space-x-3">
            <a href="{{ route('admin.pages.index') }}" class="p-2 rounded-xl bg-slate-900 hover:bg-slate-800 text-slate-400 hover:text-white transition text-xs flex items-center space-x-1.5 border border-slate-800" title="Kembali ke Daftar Halaman">
                <i class="fa-solid fa-arrow-left"></i>
                <span class="hidden sm:inline font-semibold">Admin</span>
            </a>
            <div class="h-5 w-px bg-slate-800"></div>
            <div class="flex items-center space-x-2">
                <div class="w-6 h-6 rounded-lg bg-gradient-to-tr from-pink-500 to-rose-500 text-white font-extrabold text-xs flex items-center justify-center shadow">
                    E
                </div>
                <span class="text-xs font-extrabold text-white tracking-wide flex items-center">
                    <span>Elementor Studio</span>
                    <span class="ml-1.5 px-1.5 py-0.5 rounded bg-amber-400/20 text-amber-300 border border-amber-400/30 text-[9px] font-black uppercase">PRO</span>
                </span>
                <span class="text-slate-600">/</span>
                <span class="text-xs font-bold text-slate-300 truncate max-w-[180px] sm:max-w-xs">{{ $page->title }}</span>
            </div>
        </div>

        <!-- Center: Device Switcher & History -->
        <div class="flex items-center space-x-1 bg-slate-900/90 p-1 rounded-xl border border-slate-800">
            <button id="btn-device-desktop" class="px-3 py-1.5 rounded-lg text-xs font-bold bg-sky-500 text-slate-950 shadow transition flex items-center space-x-1.5" title="Tampilan Desktop (100%)">
                <i class="fa-solid fa-desktop text-xs"></i> <span class="hidden md:inline">Desktop</span>
            </button>
            <button id="btn-device-tablet" class="px-3 py-1.5 rounded-lg text-xs font-bold text-slate-400 hover:text-white hover:bg-slate-800 transition flex items-center space-x-1.5" title="Tampilan Tablet (768px)">
                <i class="fa-solid fa-tablet-screen-button text-xs"></i> <span class="hidden md:inline">Tablet</span>
            </button>
            <button id="btn-device-mobile" class="px-3 py-1.5 rounded-lg text-xs font-bold text-slate-400 hover:text-white hover:bg-slate-800 transition flex items-center space-x-1.5" title="Tampilan Mobile (375px)">
                <i class="fa-solid fa-mobile-screen-button text-xs"></i> <span class="hidden md:inline">Mobile</span>
            </button>
        </div>

        <!-- Right: Studio Tools & Save -->
        <div class="flex items-center space-x-2">
            <button id="btn-undo" class="p-2 rounded-lg bg-slate-900 hover:bg-slate-800 text-slate-400 hover:text-white transition text-xs border border-slate-800" title="Undo (Ctrl+Z)">
                <i class="fa-solid fa-rotate-left"></i>
            </button>
            <button id="btn-redo" class="p-2 rounded-lg bg-slate-900 hover:bg-slate-800 text-slate-400 hover:text-white transition text-xs border border-slate-800" title="Redo (Ctrl+Y)">
                <i class="fa-solid fa-rotate-right"></i>
            </button>
            <button id="btn-open-assets" class="px-3 py-1.5 rounded-lg bg-slate-900 hover:bg-slate-800 text-slate-300 hover:text-white transition text-xs font-bold border border-slate-800 flex items-center space-x-1.5" title="Media & Upload Foto">
                <i class="fa-solid fa-photo-film text-sky-400"></i> <span class="hidden lg:inline">Media</span>
            </button>
            <button id="btn-preview" class="p-2 rounded-lg bg-slate-900 hover:bg-slate-800 text-slate-400 hover:text-white transition text-xs border border-slate-800" title="Preview Tampilan">
                <i class="fa-solid fa-eye"></i>
            </button>
            <button id="btn-clear" class="p-2 rounded-lg bg-slate-900 hover:bg-rose-950/60 text-slate-400 hover:text-rose-400 transition text-xs border border-slate-800" title="Kosongkan Kanvas">
                <i class="fa-regular fa-trash-can"></i>
            </button>

            <div class="h-5 w-px bg-slate-800"></div>

            <a href="{{ route('page', $page->slug) }}" target="_blank" class="px-3 py-1.5 rounded-xl bg-slate-900 hover:bg-slate-800 text-slate-300 hover:text-white font-bold text-xs transition flex items-center space-x-1.5 border border-slate-800">
                <i class="fa-solid fa-arrow-up-right-from-square text-[11px] text-amber-400"></i>
                <span class="hidden xl:inline">Lihat Web</span>
            </a>

            <button id="btn-save" class="px-4 py-1.5 rounded-xl bg-emerald-500 hover:bg-emerald-400 text-slate-950 font-extrabold text-xs shadow-lg transition flex items-center space-x-1.5">
                <i class="fa-solid fa-floppy-disk text-xs"></i>
                <span>Simpan</span>
            </button>
        </div>
    </header>

    <!-- Main Workspace Container -->
    <div class="flex-1 flex overflow-hidden relative">
        
        <!-- Left Sidebar: Elementor Pro Widget Palette -->
        <div class="w-80 bg-slate-950 border-r border-slate-800/80 flex flex-col shrink-0 z-20">
            <div class="p-3 bg-slate-900/60 border-b border-slate-800 flex items-center justify-between">
                <span class="text-xs font-bold text-sky-400 uppercase tracking-wider flex items-center">
                    <i class="fa-solid fa-shapes mr-2 text-sm text-pink-500"></i> Widget Palette
                </span>
                <span class="text-[10px] text-slate-400 bg-slate-800 px-2 py-0.5 rounded-md font-semibold">Drag ke Kanvas</span>
            </div>
            
            <!-- Blocks Container -->
            <div id="blocks-container" class="flex-1 overflow-y-auto">
                <!-- GrapesJS Block Categories Will Render Here -->
            </div>
        </div>

        <!-- Center: Visual Canvas -->
        <div class="flex-1 flex flex-col bg-slate-900 overflow-hidden relative">
            <div id="gjs" class="flex-1 w-full h-full"></div>
        </div>

        <!-- Right Sidebar: Elementor Style & Traits & Layers Inspector -->
        <div class="w-80 bg-slate-950 border-l border-slate-800/80 flex flex-col shrink-0 z-20">
            <!-- Tabs Header -->
            <div class="flex border-b border-slate-800 bg-slate-900/80 text-xs font-bold">
                <button id="tab-style" class="flex-1 py-3 text-center border-b-2 border-sky-400 text-sky-400 transition flex items-center justify-center space-x-1.5">
                    <i class="fa-solid fa-paintbrush text-xs"></i> <span>Gaya (Style)</span>
                </button>
                <button id="tab-traits" class="flex-1 py-3 text-center border-b-2 border-transparent text-slate-400 hover:text-slate-200 transition flex items-center justify-center space-x-1.5">
                    <i class="fa-solid fa-sliders text-xs"></i> <span>Pengaturan</span>
                </button>
                <button id="tab-layers" class="flex-1 py-3 text-center border-b-2 border-transparent text-slate-400 hover:text-slate-200 transition flex items-center justify-center space-x-1.5">
                    <i class="fa-solid fa-layer-group text-xs"></i> <span>Lapisan</span>
                </button>
            </div>

            <!-- Panel Contents -->
            <div class="flex-1 overflow-y-auto">
                <div id="styles-panel"></div>
                <div id="traits-panel" class="hidden p-3"></div>
                <div id="layers-panel" class="hidden p-3"></div>
            </div>
        </div>

    </div>

    <!-- Toast Notification -->
    <div id="toast" class="fixed bottom-6 right-6 z-50 transform translate-y-24 opacity-0 transition-all duration-300 bg-emerald-600 text-white px-5 py-3 rounded-2xl shadow-2xl flex items-center space-x-3 text-xs font-bold border border-emerald-400">
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
            const uploadAssetUrl = "{{ route('admin.pages.uploadAsset') }}";

            // Initialize GrapesJS Editor
            const editor = grapesjs.init({
                container: '#gjs',
                height: '100%',
                width: 'auto',
                fromElement: false,
                storageManager: false,
                assetManager: {
                    upload: uploadAssetUrl,
                    uploadName: 'files',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    autoAdd: 1,
                    assets: [
                        'https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?w=1200&auto=format&fit=crop&q=80',
                        'https://images.unsplash.com/photo-1584515979956-d9f6e5d09982?w=1200&auto=format&fit=crop&q=80',
                        'https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?w=1200&auto=format&fit=crop&q=80'
                    ]
                },
                blockManager: {
                    appendTo: '#blocks-container'
                },
                styleManager: {
                    appendTo: '#styles-panel',
                    sectors: [
                        {
                            name: 'Tipografi (Teks & Font)',
                            open: true,
                            buildProps: ['font-family', 'font-size', 'font-weight', 'letter-spacing', 'color', 'line-height', 'text-align', 'text-decoration', 'text-shadow', 'text-transform']
                        },
                        {
                            name: 'Dimensi & Spasi',
                            open: false,
                            buildProps: ['width', 'min-width', 'max-width', 'height', 'min-height', 'margin', 'padding']
                        },
                        {
                            name: 'Warna & Latar Belakang',
                            open: false,
                            buildProps: ['background-color', 'background', 'opacity']
                        },
                        {
                            name: 'Bingkai, Sudut, & Bayangan',
                            open: false,
                            buildProps: ['border', 'border-radius', 'box-shadow']
                        },
                        {
                            name: 'Tata Letak (Flexbox / Grid)',
                            open: false,
                            buildProps: ['display', 'flex-direction', 'justify-content', 'align-items', 'gap', 'flex-wrap']
                        },
                        {
                            name: 'Efek & Transisi',
                            open: false,
                            buildProps: ['transition', 'transform', 'cursor']
                        }
                    ]
                },
                traitManager: {
                    appendTo: '#traits-panel'
                },
                layerManager: {
                    appendTo: '#layers-panel'
                },
                panels: { defaults: [] },
                canvas: {
                    styles: [
                        'https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap',
                        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css',
                        'https://cdn.tailwindcss.com'
                    ],
                    scripts: [
                        'https://cdn.tailwindcss.com',
                        'https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js'
                    ]
                }
            });

            // Set canvas initial custom CSS & JS
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

                // Load existing project or HTML
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

            // ==========================================
            // ELEMENTOR PRO WIDGET PALETTE REGISTRATION
            // ==========================================
            const bm = editor.BlockManager;

            // --- 1. TATA LETAK & GRID ---
            bm.add('pro-sect-1-col', {
                label: '1 Kolom Penuh',
                category: '1. Tata Letak & Grid',
                media: '<i class="fa-solid fa-square gjs-block-icon text-sky-400"></i>',
                content: `<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8"><div class="p-8 bg-slate-50 border border-slate-200 rounded-2xl text-center text-slate-500 font-medium">Konten Kolom Penuh</div></div>`
            });

            bm.add('pro-sect-2-col', {
                label: '2 Kolom (50/50)',
                category: '1. Tata Letak & Grid',
                media: '<i class="fa-solid fa-table-columns gjs-block-icon text-sky-400"></i>',
                content: `<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                        <div class="p-6 bg-slate-50 border border-slate-200 rounded-2xl text-slate-700">Kolom Kiri</div>
                        <div class="p-6 bg-slate-50 border border-slate-200 rounded-2xl text-slate-700">Kolom Kanan</div>
                    </div>
                </div>`
            });

            bm.add('pro-sect-3-col', {
                label: '3 Kolom Grid',
                category: '1. Tata Letak & Grid',
                media: '<i class="fa-solid fa-table-cells gjs-block-icon text-sky-400"></i>',
                content: `<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="p-6 bg-white shadow-sm border border-slate-200 rounded-2xl">Kolom 1</div>
                        <div class="p-6 bg-white shadow-sm border border-slate-200 rounded-2xl">Kolom 2</div>
                        <div class="p-6 bg-white shadow-sm border border-slate-200 rounded-2xl">Kolom 3</div>
                    </div>
                </div>`
            });

            bm.add('pro-sect-4-col', {
                label: '4 Kolom Grid',
                category: '1. Tata Letak & Grid',
                media: '<i class="fa-solid fa-border-all gjs-block-icon text-sky-400"></i>',
                content: `<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <div class="p-5 bg-slate-50 border border-slate-200 rounded-xl text-center font-semibold text-slate-700">Kolom 1</div>
                        <div class="p-5 bg-slate-50 border border-slate-200 rounded-xl text-center font-semibold text-slate-700">Kolom 2</div>
                        <div class="p-5 bg-slate-50 border border-slate-200 rounded-xl text-center font-semibold text-slate-700">Kolom 3</div>
                        <div class="p-5 bg-slate-50 border border-slate-200 rounded-xl text-center font-semibold text-slate-700">Kolom 4</div>
                    </div>
                </div>`
            });

            bm.add('pro-sect-asym', {
                label: 'Sidebar (30/70)',
                category: '1. Tata Letak & Grid',
                media: '<i class="fa-solid fa-table-cells-large gjs-block-icon text-sky-400"></i>',
                content: `<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                        <div class="lg:col-span-4 p-6 bg-slate-50 border border-slate-200 rounded-2xl">Sidebar Navigasi</div>
                        <div class="lg:col-span-8 p-6 bg-white shadow-sm border border-slate-200 rounded-2xl">Konten Utama</div>
                    </div>
                </div>`
            });

            bm.add('pro-spacer', {
                label: 'Spacer / Jarak',
                category: '1. Tata Letak & Grid',
                media: '<i class="fa-solid fa-arrows-up-down gjs-block-icon text-slate-400"></i>',
                content: `<div class="w-full h-12"></div>`
            });

            // --- 2. ELEMEN DASAR ---
            bm.add('pro-heading', {
                label: 'Heading / Judul',
                category: '2. Elemen Dasar',
                media: '<i class="fa-solid fa-heading gjs-block-icon text-amber-400"></i>',
                content: `<h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight my-4">Judul Bagian Halaman</h2>`
            });

            bm.add('pro-paragraph', {
                label: 'Teks Paragraf',
                category: '2. Elemen Dasar',
                media: '<i class="fa-solid fa-paragraph gjs-block-icon text-amber-400"></i>',
                content: `<p class="text-sm sm:text-base text-slate-600 leading-relaxed my-3">Tuliskan uraian kalimat dan paragraf informatif di sini. Anda dapat mengubah teks, ukuran font, perataan, dan warna teks langsung melalui panel inspektur.</p>`
            });

            bm.add('pro-button', {
                label: 'Tombol Aksi (CTA)',
                category: '2. Elemen Dasar',
                media: '<i class="fa-solid fa-arrow-pointer gjs-block-icon text-emerald-400"></i>',
                content: `<a href="#" class="inline-flex items-center px-6 py-3 rounded-xl bg-theme-primary text-white font-bold text-xs uppercase tracking-wider shadow-md hover:shadow-lg transition transform hover:-translate-y-0.5"><span>Pelajari Selengkapnya</span> <i class="fa-solid fa-arrow-right ml-2 text-[10px]"></i></a>`
            });

            bm.add('pro-image', {
                label: 'Foto / Gambar',
                category: '2. Elemen Dasar',
                media: '<i class="fa-solid fa-image gjs-block-icon text-teal-400"></i>',
                content: `<div class="rounded-2xl overflow-hidden shadow-sm border border-slate-200 my-4"><img src="https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?w=1200&auto=format&fit=crop&q=80" alt="Foto Kampus" class="w-full h-auto object-cover"></div>`
            });

            bm.add('pro-video', {
                label: 'Video YouTube',
                category: '2. Elemen Dasar',
                media: '<i class="fa-brands fa-youtube gjs-block-icon text-rose-500"></i>',
                content: `<div class="aspect-video rounded-2xl overflow-hidden shadow-lg border border-slate-200 my-4"><iframe class="w-full h-full" src="https://www.youtube.com/embed/dQw4w9WgXcQ" frameborder="0" allowfullscreen></iframe></div>`
            });

            bm.add('pro-icon-box', {
                label: 'Icon Box',
                category: '2. Elemen Dasar',
                media: '<i class="fa-solid fa-cubes-stacked gjs-block-icon text-indigo-400"></i>',
                content: `<div class="p-6 bg-white rounded-2xl border border-slate-200 shadow-sm space-y-3">
                    <div class="w-12 h-12 rounded-xl flex items-center justify-center text-white text-xl shadow" style="background-color: var(--color-primary);"><i class="fa-solid fa-star"></i></div>
                    <h3 class="text-base font-bold text-slate-900">Judul Fitur</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">Deskripsi singkat seputar manfaat dan informasi fitur terkait.</p>
                </div>`
            });

            bm.add('pro-divider', {
                label: 'Garis Divider Bintang',
                category: '2. Elemen Dasar',
                media: '<i class="fa-solid fa-minus gjs-block-icon text-slate-400"></i>',
                content: `<div class="relative flex py-6 items-center"><div class="flex-grow border-t border-slate-200"></div><span class="flex-shrink mx-4 text-theme-primary"><i class="fa-solid fa-star text-xs"></i></span><div class="flex-grow border-t border-slate-200"></div></div>`
            });

            bm.add('pro-alert', {
                label: 'Alert Box',
                category: '2. Elemen Dasar',
                media: '<i class="fa-solid fa-circle-exclamation gjs-block-icon text-amber-400"></i>',
                content: `<div class="p-4 rounded-xl bg-amber-50 border border-amber-200 text-amber-900 flex items-start space-x-3 my-4">
                    <i class="fa-solid fa-circle-info text-amber-600 text-lg mt-0.5"></i>
                    <div><h4 class="text-xs font-bold">Informasi Penting</h4><p class="text-xs text-amber-800 mt-0.5">Silakan baca petunjuk dengan seksama sebelum mengisi formulir.</p></div>
                </div>`
            });

            // --- 3. ELEMENTOR PRO WIDGETS ---
            bm.add('pro-tabs', {
                label: '📑 Tabs Interaktif',
                category: '3. Elementor Pro Widgets',
                media: '<i class="fa-solid fa-folder-open gjs-block-icon text-pink-400"></i>',
                content: `<div x-data="{ tab: 'tab1' }" class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm my-6">
                    <div class="flex border-b border-slate-200 space-x-2">
                        <button @click="tab = 'tab1'" :class="tab === 'tab1' ? 'border-b-2 border-theme-primary text-theme-primary font-bold' : 'text-slate-500'" class="pb-3 px-4 text-xs">Informasi Umum</button>
                        <button @click="tab = 'tab2'" :class="tab === 'tab2' ? 'border-b-2 border-theme-primary text-theme-primary font-bold' : 'text-slate-500'" class="pb-3 px-4 text-xs">Syarat & Ketentuan</button>
                        <button @click="tab = 'tab3'" :class="tab === 'tab3' ? 'border-b-2 border-theme-primary text-theme-primary font-bold' : 'text-slate-500'" class="pb-3 px-4 text-xs">Unduh Dokumen</button>
                    </div>
                    <div class="pt-4 text-xs sm:text-sm text-slate-600 leading-relaxed">
                        <div x-show="tab === 'tab1'">Isi konten tab pertama mengenai informasi umum dan jadwal kegiatan.</div>
                        <div x-show="tab === 'tab2'" style="display: none;">Daftar berkas persyaratan yang wajib dipenuhi oleh pemohon.</div>
                        <div x-show="tab === 'tab3'" style="display: none;">Tautan download formulir dan template dokumen resmi.</div>
                    </div>
                </div>`
            });

            bm.add('pro-accordion', {
                label: '❓ FAQ Akordeon',
                category: '3. Elementor Pro Widgets',
                media: '<i class="fa-solid fa-circle-question gjs-block-icon text-pink-400"></i>',
                content: `<div x-data="{ active: null }" class="space-y-3 my-6">
                    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                        <button @click="active = active === 1 ? null : 1" class="w-full p-4 text-left flex items-center justify-between font-bold text-xs sm:text-sm text-slate-900">
                            <span class="flex items-center"><i class="fa-solid fa-circle-question text-theme-primary mr-2.5"></i> Bagaimana alur pengajuan permohonan layanan?</span>
                            <i class="fa-solid fa-chevron-down text-xs text-slate-400 transition" :class="{ 'rotate-180': active === 1 }"></i>
                        </button>
                        <div x-show="active === 1" class="p-4 pt-1 text-xs sm:text-sm text-slate-600 border-t border-slate-100">Pemohon mengisi formulir online lalu menunggu verifikasi tim kami dalam 1-2 hari kerja.</div>
                    </div>
                    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                        <button @click="active = active === 2 ? null : 2" class="w-full p-4 text-left flex items-center justify-between font-bold text-xs sm:text-sm text-slate-900">
                            <span class="flex items-center"><i class="fa-solid fa-circle-question text-theme-primary mr-2.5"></i> Kemana menghubungi jika terjadi kendala teknis?</span>
                            <i class="fa-solid fa-chevron-down text-xs text-slate-400 transition" :class="{ 'rotate-180': active === 2 }"></i>
                        </button>
                        <div x-show="active === 2" class="p-4 pt-1 text-xs sm:text-sm text-slate-600 border-t border-slate-100" style="display: none;">Anda dapat menghubungi layanan helpdesk WhatsApp resmi kami atau datang langsung ke ruang divisi.</div>
                    </div>
                </div>`
            });

            bm.add('pro-pricing', {
                label: '🏷️ Pricing / Rincian Biaya',
                category: '3. Elementor Pro Widgets',
                media: '<i class="fa-solid fa-tags gjs-block-icon text-pink-400"></i>',
                content: `<div class="max-w-md mx-auto bg-white rounded-3xl border-2 border-theme-primary p-8 shadow-xl text-center space-y-5 my-6 relative">
                    <span class="absolute -top-3.5 left-1/2 -translate-x-1/2 bg-theme-primary text-white text-[10px] font-extrabold uppercase tracking-wider px-3.5 py-1 rounded-full shadow">Paling Populer</span>
                    <h3 class="text-xl font-extrabold text-slate-900">Paket Reguler PMB</h3>
                    <div class="text-3xl font-extrabold text-theme-primary">Rp 2.500.000 <span class="text-xs text-slate-500 font-normal">/ semester</span></div>
                    <ul class="text-xs text-slate-600 space-y-2.5 text-left border-y border-slate-100 py-5">
                        <li class="flex items-center"><i class="fa-solid fa-check text-emerald-500 mr-2"></i> Akses Laboratorium Lengkap</li>
                        <li class="flex items-center"><i class="fa-solid fa-check text-emerald-500 mr-2"></i> Modul Pembelajaran Digital</li>
                        <li class="flex items-center"><i class="fa-solid fa-check text-emerald-500 mr-2"></i> Sertifikasi Kompetensi Resmi</li>
                    </ul>
                    <a href="#" class="w-full py-3 rounded-xl bg-theme-primary text-white font-bold text-xs uppercase tracking-wider block shadow hover:opacity-90 transition">Daftar Sekarang</a>
                </div>`
            });

            bm.add('pro-testimonial', {
                label: '💬 Testimonial Ulasan',
                category: '3. Elementor Pro Widgets',
                media: '<i class="fa-solid fa-quote-left gjs-block-icon text-pink-400"></i>',
                content: `<div class="p-6 bg-white rounded-2xl border border-slate-200 shadow-sm space-y-4 my-6">
                    <div class="flex text-amber-400 text-xs space-x-1">
                        <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                    </div>
                    <p class="text-xs sm:text-sm text-slate-600 italic">"Pelayanan di kampus STIKES sangat cepat dan ramah. Fasilitas laboratoriumnya sangat lengkap dan modern untuk menunjang praktik medis!"</p>
                    <div class="flex items-center space-x-3 pt-2 border-t border-slate-100">
                        <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=100&h=100&fit=crop" alt="Avatar" class="w-10 h-10 rounded-full object-cover border">
                        <div>
                            <div class="text-xs font-bold text-slate-900">Siti Nurhaliza</div>
                            <div class="text-[11px] text-slate-500">Alumni Sarjana Keperawatan</div>
                        </div>
                    </div>
                </div>`
            });

            bm.add('pro-countdown', {
                label: '⏳ Countdown Timer',
                category: '3. Elementor Pro Widgets',
                media: '<i class="fa-solid fa-clock-rotate-left gjs-block-icon text-pink-400"></i>',
                content: `<div class="p-8 rounded-2xl bg-slate-900 text-white text-center space-y-4 my-6">
                    <span class="text-xs font-bold text-amber-400 uppercase tracking-wider">Hitung Mundur Penutupan PMB</span>
                    <div class="grid grid-cols-4 gap-3 max-w-md mx-auto">
                        <div class="p-3 bg-white/10 rounded-xl"><div class="text-2xl font-extrabold text-white">14</div><div class="text-[10px] text-slate-300 uppercase">Hari</div></div>
                        <div class="p-3 bg-white/10 rounded-xl"><div class="text-2xl font-extrabold text-white">08</div><div class="text-[10px] text-slate-300 uppercase">Jam</div></div>
                        <div class="p-3 bg-white/10 rounded-xl"><div class="text-2xl font-extrabold text-white">45</div><div class="text-[10px] text-slate-300 uppercase">Menit</div></div>
                        <div class="p-3 bg-white/10 rounded-xl"><div class="text-2xl font-extrabold text-white">20</div><div class="text-[10px] text-slate-300 uppercase">Detik</div></div>
                    </div>
                </div>`
            });

            bm.add('pro-progress-bar', {
                label: '📊 Progress Bar',
                category: '3. Elementor Pro Widgets',
                media: '<i class="fa-solid fa-bars-progress gjs-block-icon text-pink-400"></i>',
                content: `<div class="space-y-3 my-6">
                    <div>
                        <div class="flex justify-between text-xs font-bold text-slate-700 mb-1"><span>Tingkat Kelulusan Uji Kompetensi</span><span>98%</span></div>
                        <div class="w-full bg-slate-200 rounded-full h-2.5 overflow-hidden"><div class="bg-theme-primary h-2.5 rounded-full" style="width: 98%"></div></div>
                    </div>
                    <div>
                        <div class="flex justify-between text-xs font-bold text-slate-700 mb-1"><span>Keterserapan Kerja Lulusan</span><span>94%</span></div>
                        <div class="w-full bg-slate-200 rounded-full h-2.5 overflow-hidden"><div class="bg-emerald-500 h-2.5 rounded-full" style="width: 94%"></div></div>
                    </div>
                </div>`
            });

            bm.add('pro-icon-list', {
                label: '📋 Checklist Icon List',
                category: '3. Elementor Pro Widgets',
                media: '<i class="fa-solid fa-list-check gjs-block-icon text-pink-400"></i>',
                content: `<ul class="space-y-2.5 text-xs sm:text-sm text-slate-700 my-4">
                    <li class="flex items-center space-x-2.5"><i class="fa-solid fa-circle-check text-emerald-500 text-sm"></i> <span>Terakreditasi Baik Sekali oleh LAM-PTKes</span></li>
                    <li class="flex items-center space-x-2.5"><i class="fa-solid fa-circle-check text-emerald-500 text-sm"></i> <span>Kerjasama Rumah Sakit & Klinik Internasional</span></li>
                    <li class="flex items-center space-x-2.5"><i class="fa-solid fa-circle-check text-emerald-500 text-sm"></i> <span>Beasiswa Prestasi & KIP-Kuliah Tersedia</span></li>
                </ul>`
            });

            bm.add('pro-form', {
                label: '📝 Form Pendaftaran',
                category: '3. Elementor Pro Widgets',
                media: '<i class="fa-solid fa-square-envelope gjs-block-icon text-pink-400"></i>',
                content: `<form class="p-6 bg-slate-50 rounded-2xl border border-slate-200 space-y-4 my-6">
                    <h3 class="text-sm font-bold text-slate-900">Formulir Kontak & Permohonan</h3>
                    <div class="space-y-1"><label class="text-[11px] font-bold text-slate-600">Nama Lengkap</label><input type="text" placeholder="Masukkan nama..." class="w-full px-3 py-2 text-xs rounded-xl border border-slate-200 bg-white"></div>
                    <div class="space-y-1"><label class="text-[11px] font-bold text-slate-600">Nomor WhatsApp</label><input type="text" placeholder="0812..." class="w-full px-3 py-2 text-xs rounded-xl border border-slate-200 bg-white"></div>
                    <div class="space-y-1"><label class="text-[11px] font-bold text-slate-600">Pesan / Pertanyaan</label><textarea rows="3" placeholder="Tuliskan pesan..." class="w-full px-3 py-2 text-xs rounded-xl border border-slate-200 bg-white"></textarea></div>
                    <button type="button" class="w-full py-2.5 rounded-xl bg-theme-primary text-white font-bold text-xs uppercase tracking-wider shadow">Kirim Formulir</button>
                </form>`
            });

            bm.add('pro-maps', {
                label: '🗺️ Google Maps Embed',
                category: '3. Elementor Pro Widgets',
                media: '<i class="fa-solid fa-map-location-dot gjs-block-icon text-pink-400"></i>',
                content: `<div class="rounded-2xl overflow-hidden shadow-sm border border-slate-200 my-4 h-64"><iframe src="https://maps.google.com/maps?q=STIKES%20Panti%20Waluya%20Malang&t=&z=15&ie=UTF8&iwloc=&output=embed" width="100%" height="100%" frameborder="0" style="border:0;" allowfullscreen="" loading="lazy"></iframe></div>`
            });

            bm.add('pro-team-card', {
                label: '👨‍🏫 Profil Dosen / Tim',
                category: '3. Elementor Pro Widgets',
                media: '<i class="fa-solid fa-user-doctor gjs-block-icon text-pink-400"></i>',
                content: `<div class="p-6 bg-white rounded-2xl border border-slate-200 shadow-sm text-center space-y-3 my-4">
                    <img src="https://images.unsplash.com/photo-1559839734-2b71ea197ec2?w=200&h=200&fit=crop" class="w-20 h-20 rounded-full mx-auto object-cover border-2 border-theme-primary shadow">
                    <div>
                        <h4 class="text-sm font-extrabold text-slate-900">Dr. Ns. Maria Fransiska, M.Kep</h4>
                        <p class="text-xs text-theme-primary font-semibold">Ketua Program Studi Keperawatan</p>
                    </div>
                    <div class="flex justify-center space-x-2 text-slate-400 text-xs">
                        <a href="#" class="p-1.5 hover:text-sky-600"><i class="fa-brands fa-linkedin"></i></a>
                        <a href="#" class="p-1.5 hover:text-emerald-600"><i class="fa-brands fa-whatsapp"></i></a>
                        <a href="#" class="p-1.5 hover:text-rose-600"><i class="fa-solid fa-envelope"></i></a>
                    </div>
                </div>`
            });

            // --- 4. PRESET KOMPONEN KAMPUS STIKES ---
            bm.add('tpl-hero', {
                label: '🎓 Hero Banner Utama',
                category: '4. Preset Kampus STIKES',
                media: '<i class="fa-solid fa-wand-magic-sparkles gjs-block-icon text-amber-400"></i>',
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
                category: '4. Preset Kampus STIKES',
                media: '<i class="fa-solid fa-grip gjs-block-icon text-amber-400"></i>',
                content: `<section class="py-16 bg-slate-50 border-y border-slate-200">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="text-center max-w-2xl mx-auto space-y-2 mb-12">
                            <span class="text-xs font-bold text-theme-primary uppercase tracking-wider">Fasilitas</span>
                            <h2 class="text-3xl font-extrabold text-slate-900">Layanan Prima Divisi</h2>
                            <p class="text-sm text-slate-500">Berbagai solusi digital dan administrasi terpadu untuk kebutuhan kampus.</p>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="p-6 bg-white rounded-2xl border border-slate-200 shadow-sm space-y-3 hover:shadow-md transition">
                                <div class="w-12 h-12 rounded-xl flex items-center justify-center text-white text-xl shadow" style="background-color: var(--color-primary);"><i class="fa-solid fa-laptop-code"></i></div>
                                <h3 class="text-base font-bold text-slate-900">Portal Akademik Terpadu</h3>
                                <p class="text-xs text-slate-600 leading-relaxed">Sistem informasi untuk kemudahan pengelolaan data nilai dan kartu rencana studi.</p>
                            </div>
                            <div class="p-6 bg-white rounded-2xl border border-slate-200 shadow-sm space-y-3 hover:shadow-md transition">
                                <div class="w-12 h-12 rounded-xl flex items-center justify-center text-white text-xl shadow" style="background-color: var(--color-primary);"><i class="fa-solid fa-network-wired"></i></div>
                                <h3 class="text-base font-bold text-slate-900">Jaringan Internet Cepat</h3>
                                <p class="text-xs text-slate-600 leading-relaxed">Akses Wi-Fi berkecepatan tinggi yang mencakup seluruh ruang kelas dan laboratorium.</p>
                            </div>
                            <div class="p-6 bg-white rounded-2xl border border-slate-200 shadow-sm space-y-3 hover:shadow-md transition">
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
                category: '4. Preset Kampus STIKES',
                media: '<i class="fa-solid fa-columns gjs-block-icon text-amber-400"></i>',
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
                label: '🔢 Statistik Angka Capaian',
                category: '4. Preset Kampus STIKES',
                media: '<i class="fa-solid fa-chart-simple gjs-block-icon text-amber-400"></i>',
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
                label: '📱 Call to Action WhatsApp',
                category: '4. Preset Kampus STIKES',
                media: '<i class="fa-solid fa-bullhorn gjs-block-icon text-emerald-400"></i>',
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

            editor.Devices.add({ id: 'Desktop', name: 'Desktop', width: '' });
            editor.Devices.add({ id: 'Tablet', name: 'Tablet', width: '768px' });
            editor.Devices.add({ id: 'Mobile', name: 'Mobile', width: '375px' });

            // TOP TOOLBAR ACTION HANDLERS
            document.getElementById('btn-undo').addEventListener('click', () => editor.UndoManager.undo());
            document.getElementById('btn-redo').addEventListener('click', () => editor.UndoManager.redo());
            document.getElementById('btn-preview').addEventListener('click', () => editor.runCommand('preview'));
            document.getElementById('btn-open-assets').addEventListener('click', () => editor.runCommand('open-assets'));
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
                toast.classList.remove('translate-y-24', 'opacity-0');
                setTimeout(() => {
                    toast.classList.add('translate-y-24', 'opacity-0');
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
