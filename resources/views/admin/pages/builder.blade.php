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
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS for Elementor Pro Studio Shell UI -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- GrapesJS Core CSS & JS -->
    <link rel="stylesheet" href="https://unpkg.com/grapesjs/dist/css/grapes.min.css">
    <script src="https://unpkg.com/grapesjs"></script>

    <style>
        :root {
            --color-primary: {{ get_setting('theme_primary_color', '#0e7490') }};
            --color-secondary: {{ get_setting('theme_secondary_color', '#0284c7') }};
            --elementor-pink: #d63384;
            --elementor-dark-pink: #92003b;
            --elementor-panel-bg: #202328;
            --elementor-card-bg: #292d34;
            --elementor-border: #333842;
            --elementor-accent: #71d7f7;
            --elementor-green: #39b54a;
        }

        body {
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif;
            background-color: #17191d;
            color: #d1d5db;
        }

        /* GrapesJS Elementor Dark Theme Customization */
        .gjs-one-bg {
            background-color: var(--elementor-panel-bg) !important;
        }
        .gjs-two-color {
            color: #9ca3af !important;
        }
        .gjs-three-bg {
            background-color: var(--elementor-card-bg) !important;
            color: #f3f4f6 !important;
        }
        .gjs-four-color, .gjs-four-color-h:hover {
            color: var(--elementor-accent) !important;
        }

        /* Block Manager Categories */
        .gjs-category-title {
            background: #17191d !important;
            padding: 10px 14px !important;
            font-size: 10px !important;
            font-weight: 800 !important;
            text-transform: uppercase !important;
            letter-spacing: 0.08em !important;
            color: #94a3b8 !important;
            border-bottom: 1px solid var(--elementor-border) !important;
            border-top: 1px solid var(--elementor-border) !important;
            display: flex !important;
            align-items: center !important;
            justify-content: space-between !important;
            user-select: none !important;
            cursor: pointer !important;
        }
        .gjs-category-title:hover {
            color: #ffffff !important;
            background: #1c1f24 !important;
        }

        /* Block Grid */
        .gjs-blocks-c {
            display: grid !important;
            grid-template-columns: repeat(2, 1fr) !important;
            gap: 8px !important;
            padding: 10px !important;
            background: var(--elementor-panel-bg) !important;
        }

        /* Individual Block Card in Palette */
        .gjs-block {
            width: 100% !important;
            min-height: 84px !important;
            padding: 12px 6px !important;
            background: var(--elementor-card-bg) !important;
            border: 1px solid var(--elementor-border) !important;
            border-radius: 8px !important;
            color: #cbd5e1 !important;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.3) !important;
            transition: all 0.15s ease-in-out !important;
            display: flex !important;
            flex-direction: column !important;
            align-items: center !important;
            justify-content: center !important;
            text-align: center !important;
            margin: 0 !important;
            cursor: grab !important;
            position: relative !important;
        }
        .gjs-block:active {
            cursor: grabbing !important;
        }
        .gjs-block:hover {
            border-color: var(--elementor-pink) !important;
            background: #323740 !important;
            color: #ffffff !important;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(214, 51, 132, 0.2) !important;
        }
        .gjs-block-label {
            font-size: 10px !important;
            font-weight: 700 !important;
            margin-top: 6px !important;
            line-height: 1.25 !important;
            max-width: 95% !important;
            word-break: break-word !important;
        }
        .gjs-block-icon {
            font-size: 20px !important;
            line-height: 1 !important;
            margin-bottom: 2px !important;
        }

        /* Style Manager */
        .gjs-sm-sector .gjs-sm-sector-title {
            background: #17191d !important;
            border-bottom: 1px solid var(--elementor-border) !important;
            color: #e5e7eb !important;
            font-size: 11px !important;
            font-weight: 700 !important;
            padding: 10px 14px !important;
        }
        .gjs-sm-sector .gjs-sm-sector-title:hover {
            background: #1e2228 !important;
        }
        .gjs-sm-property {
            background: var(--elementor-panel-bg) !important;
            border-bottom: 1px solid #272b33 !important;
            padding: 8px 12px !important;
        }
        .gjs-sm-label {
            color: #9ca3af !important;
            font-size: 11px !important;
            font-weight: 600 !important;
        }
        .gjs-field {
            background-color: var(--elementor-card-bg) !important;
            border: 1px solid var(--elementor-border) !important;
            border-radius: 6px !important;
            color: #f3f4f6 !important;
        }
        .gjs-field input, .gjs-field select {
            color: #f3f4f6 !important;
            font-size: 11px !important;
        }

        /* Layer Manager (Navigator) */
        .gjs-layer {
            background: var(--elementor-panel-bg) !important;
            color: #9ca3af !important;
            border-bottom: 1px solid #272b33 !important;
            font-size: 11px !important;
        }
        .gjs-layer:hover, .gjs-layer.gjs-hovered {
            background: #2a2e36 !important;
            color: #ffffff !important;
        }
        .gjs-layer.gjs-selected {
            background: rgba(214, 51, 132, 0.25) !important;
            color: #ffffff !important;
        }

        /* Canvas Frame Background */
        .gjs-cv-canvas {
            background-color: #2b303b !important;
            background-image: radial-gradient(rgba(255, 255, 255, 0.08) 1px, transparent 0) !important;
            background-size: 16px 16px !important;
        }

        /* Custom Scrollbars */
        ::-webkit-scrollbar {
            width: 5px;
            height: 5px;
        }
        ::-webkit-scrollbar-track {
            background: #17191d;
        }
        ::-webkit-scrollbar-thumb {
            background: #374151;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #4b5563;
        }
    </style>
</head>
<body class="h-screen w-screen overflow-hidden flex flex-col bg-[#17191d] text-gray-200 select-none">

    <!-- Top Navigation Header (Elementor Pro Studio Bar) -->
    <header class="h-13 bg-[#1e2228] border-b border-[#303642] flex items-center justify-between px-3.5 z-30 shrink-0">
        <!-- Left: Brand, Quick Menu & Page Title -->
        <div class="flex items-center space-x-2.5">
            <!-- Hamburger Dropdown -->
            <div class="relative">
                <button id="btn-hamburger" class="w-8 h-8 rounded-lg bg-[#282d36] hover:bg-[#343a46] text-gray-300 hover:text-white transition flex items-center justify-center border border-[#373e4b]" title="Menu Elementor">
                    <i class="fa-solid fa-bars text-xs"></i>
                </button>
                <!-- Dropdown Menu -->
                <div id="dropdown-hamburger" class="hidden absolute left-0 top-10 w-64 bg-[#202328] border border-[#333842] rounded-xl shadow-2xl z-50 p-2 space-y-1">
                    <div class="px-3 py-2 border-b border-[#333842] mb-1">
                        <div class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Elementor Studio</div>
                        <div class="text-xs font-semibold text-white truncate">{{ $page->title }}</div>
                    </div>
                    <a href="{{ route('admin.pages.index') }}" class="w-full px-3 py-2 rounded-lg text-xs font-medium text-gray-300 hover:text-white hover:bg-[#2b303a] flex items-center space-x-2.5 transition">
                        <i class="fa-solid fa-arrow-left text-gray-400 w-4"></i>
                        <span>Kembali ke Daftar Halaman</span>
                    </a>
                    <button id="btn-menu-settings" class="w-full px-3 py-2 rounded-lg text-xs font-medium text-gray-300 hover:text-white hover:bg-[#2b303a] flex items-center space-x-2.5 transition text-left">
                        <i class="fa-solid fa-gear text-gray-400 w-4"></i>
                        <span>Pengaturan Halaman</span>
                    </button>
                    <button id="btn-menu-popup" class="w-full px-3 py-2 rounded-lg text-xs font-medium text-amber-300 hover:text-white hover:bg-[#2b303a] flex items-center space-x-2.5 transition text-left">
                        <i class="fa-solid fa-window-restore text-amber-400 w-4"></i>
                        <span>Popup Builder (PRO)</span>
                    </button>
                    <button id="btn-menu-templates" class="w-full px-3 py-2 rounded-lg text-xs font-medium text-gray-300 hover:text-white hover:bg-[#2b303a] flex items-center space-x-2.5 transition text-left">
                        <i class="fa-solid fa-folder-open text-[#d63384] w-4"></i>
                        <span>Buka Template Library</span>
                    </button>
                    <div class="h-px bg-[#333842] my-1"></div>
                    <button id="btn-clear-canvas" class="w-full px-3 py-2 rounded-lg text-xs font-medium text-rose-400 hover:text-rose-300 hover:bg-rose-950/40 flex items-center space-x-2.5 transition text-left">
                        <i class="fa-regular fa-trash-can w-4"></i>
                        <span>Kosongkan Seluruh Kanvas</span>
                    </button>
                </div>
            </div>

            <div class="h-5 w-px bg-[#303642]"></div>

            <!-- Elementor Pro Brand Badge -->
            <div class="flex items-center space-x-2">
                <div class="w-6 h-6 rounded-md bg-gradient-to-tr from-[#92003b] to-[#d63384] text-white font-extrabold text-[11px] flex items-center justify-center shadow-md">
                    E
                </div>
                <div class="flex items-center space-x-1.5">
                    <span class="text-xs font-black text-white tracking-wider">ELEMENTOR</span>
                    <span class="px-1.5 py-0.5 rounded bg-gradient-to-r from-amber-500/20 to-pink-500/20 border border-amber-400/40 text-amber-300 text-[9px] font-black uppercase tracking-wider">PRO</span>
                </div>
                <span class="text-gray-600 hidden sm:inline">|</span>
                <span class="text-xs font-semibold text-gray-300 truncate max-w-[140px] md:max-w-xs hidden sm:inline">{{ $page->title }}</span>
            </div>
        </div>

        <!-- Center: Device Switcher & Quick Add Section -->
        <div class="flex items-center space-x-2">
            <div class="flex items-center bg-[#17191d] p-1 rounded-xl border border-[#303642] shadow-inner">
                <button id="btn-device-desktop" class="px-2.5 py-1.5 rounded-lg text-xs font-bold bg-[#d63384] text-white shadow transition flex items-center space-x-1.5" title="Tampilan Desktop (100%)">
                    <i class="fa-solid fa-desktop text-xs"></i> <span class="hidden md:inline">Desktop</span>
                </button>
                <button id="btn-device-tablet" class="px-2.5 py-1.5 rounded-lg text-xs font-bold text-gray-400 hover:text-white hover:bg-[#252a33] transition flex items-center space-x-1.5" title="Tampilan Tablet (768px)">
                    <i class="fa-solid fa-tablet-screen-button text-xs"></i> <span class="hidden md:inline">Tablet</span>
                </button>
                <button id="btn-device-mobile" class="px-2.5 py-1.5 rounded-lg text-xs font-bold text-gray-400 hover:text-white hover:bg-[#252a33] transition flex items-center space-x-1.5" title="Tampilan Mobile (375px)">
                    <i class="fa-solid fa-mobile-screen-button text-xs"></i> <span class="hidden md:inline">Mobile</span>
                </button>
            </div>

            <!-- Template Library Quick Button -->
            <button id="btn-open-library" class="hidden sm:flex items-center space-x-1.5 px-3 py-1.5 rounded-xl bg-gradient-to-r from-pink-600/20 to-purple-600/20 hover:from-pink-600/30 hover:to-purple-600/30 border border-pink-500/30 text-pink-300 hover:text-white text-xs font-bold transition shadow">
                <i class="fa-solid fa-folder-open text-[#d63384]"></i>
                <span>Templates</span>
            </button>

            <!-- Popup Builder Quick Button (Elementor Pro) -->
            <button id="btn-open-popup-builder" class="hidden md:flex items-center space-x-1.5 px-3 py-1.5 rounded-xl bg-amber-500/10 hover:bg-amber-500/20 border border-amber-500/30 text-amber-300 hover:text-white text-xs font-bold transition shadow">
                <i class="fa-solid fa-window-restore text-amber-400"></i>
                <span>Popup Builder</span>
                <span class="px-1 py-0.2 rounded bg-amber-400/20 text-amber-300 text-[8px] font-black uppercase">PRO</span>
            </button>
        </div>

        <!-- Right: Studio Tools & Publish Button -->
        <div class="flex items-center space-x-2">
            <button id="btn-undo" class="p-2 rounded-lg bg-[#282d36] hover:bg-[#343a46] text-gray-300 hover:text-white transition text-xs border border-[#373e4b]" title="Undo (Ctrl+Z)">
                <i class="fa-solid fa-rotate-left"></i>
            </button>
            <button id="btn-redo" class="p-2 rounded-lg bg-[#282d36] hover:bg-[#343a46] text-gray-300 hover:text-white transition text-xs border border-[#373e4b]" title="Redo (Ctrl+Y)">
                <i class="fa-solid fa-rotate-right"></i>
            </button>
            <button id="btn-open-assets" class="p-2 rounded-lg bg-[#282d36] hover:bg-[#343a46] text-gray-300 hover:text-white transition text-xs border border-[#373e4b]" title="Media Library & Upload">
                <i class="fa-solid fa-photo-film text-sky-400"></i>
            </button>
            <button id="btn-preview" class="p-2 rounded-lg bg-[#282d36] hover:bg-[#343a46] text-gray-300 hover:text-white transition text-xs border border-[#373e4b]" title="Preview Halaman">
                <i class="fa-solid fa-eye"></i>
            </button>

            <div class="h-5 w-px bg-[#303642]"></div>

            <a href="{{ route('page', $page->slug) }}" target="_blank" class="px-2.5 py-1.5 rounded-xl bg-[#282d36] hover:bg-[#343a46] text-gray-300 hover:text-white font-semibold text-xs transition flex items-center space-x-1.5 border border-[#373e4b]">
                <i class="fa-solid fa-arrow-up-right-from-square text-[10px] text-amber-400"></i>
                <span class="hidden lg:inline">Lihat Web</span>
            </a>

            <!-- Save / Publish Button -->
            <button id="btn-save" class="px-4 py-1.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-extrabold text-xs shadow-lg transition flex items-center space-x-1.5 border border-emerald-400/40">
                <i class="fa-solid fa-floppy-disk text-xs"></i>
                <span>Publish</span>
            </button>
        </div>
    </header>

    <!-- Main Studio Workspace Container -->
    <div class="flex-1 flex overflow-hidden relative">

        <!-- LEFT SIDEBAR: Elementor Pro Dock (Widgets + Inspector + Bottom Bar) -->
        <div id="elementor-sidebar" class="w-[330px] bg-[#202328] border-r border-[#303642] flex flex-col shrink-0 z-20 shadow-xl transition-all duration-200">
            
            <!-- Sidebar Sub-Header (Tab Switcher & 9-dots Return) -->
            <div class="p-2.5 bg-[#1a1d22] border-b border-[#303642] flex items-center justify-between shrink-0">
                <!-- Left: Mode Title or Return Button -->
                <div class="flex items-center space-x-2">
                    <button id="btn-nav-elements" class="w-7 h-7 rounded-lg bg-[#282d36] hover:bg-[#343a46] text-gray-300 hover:text-white transition flex items-center justify-center border border-[#373e4b]" title="Semua Widget (9 Dots)">
                        <i class="fa-solid fa-table-cells-large text-xs text-[#d63384]"></i>
                    </button>
                    <span id="sidebar-mode-title" class="text-xs font-extrabold uppercase tracking-wider text-gray-200">ELEMENTS</span>
                </div>

                <!-- Right: Elements vs Global / Settings Tabs -->
                <div class="flex items-center space-x-1">
                    <button id="tab-nav-widgets" class="px-2.5 py-1 rounded-md text-[11px] font-bold bg-[#d63384] text-white transition">Widget</button>
                    <button id="tab-nav-inspector" class="px-2.5 py-1 rounded-md text-[11px] font-bold text-gray-400 hover:text-white hover:bg-[#282d36] transition">Edit Element</button>
                </div>
            </div>

            <!-- VIEW 1: WIDGET PALETTE MODE -->
            <div id="panel-widgets-view" class="flex-1 flex flex-col overflow-hidden">
                <!-- Search Box for Widgets -->
                <div class="p-2.5 bg-[#202328] border-b border-[#303642] shrink-0">
                    <div class="relative">
                        <i class="fa-solid fa-magnifying-glass absolute left-3 top-2.5 text-gray-500 text-xs"></i>
                        <input type="text" id="widget-search-input" placeholder="Cari widget (misal: hero, video, wa, faq)..." class="w-full bg-[#17191d] border border-[#373e4b] rounded-lg pl-8 pr-7 py-1.5 text-xs text-white placeholder-gray-500 focus:outline-none focus:border-[#d63384] transition">
                        <button id="widget-search-clear" class="hidden absolute right-2.5 top-2 text-gray-500 hover:text-white text-xs">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                </div>

                <!-- Drag Helper Banner -->
                <div class="px-3 py-1.5 bg-[#17191d]/60 border-b border-[#292d34] flex items-center justify-between text-[10px] text-gray-400">
                    <span class="flex items-center"><i class="fa-solid fa-hand-pointer mr-1.5 text-pink-400"></i> Drag & drop widget ke kanvas</span>
                    <span class="text-gray-500 font-mono">atau klik widget</span>
                </div>

                <!-- GrapesJS Block Categories Palette -->
                <div id="blocks-container" class="flex-1 overflow-y-auto">
                    <!-- GrapesJS Blocks will be rendered here dynamically -->
                </div>
            </div>

            <!-- VIEW 2: INSPECTOR MODE (Content, Style, Advanced) -->
            <div id="panel-inspector-view" class="flex-1 flex-col overflow-hidden hidden">
                <!-- Inspector Tabs -->
                <div class="flex border-b border-[#303642] bg-[#1a1d22] text-xs font-bold shrink-0">
                    <button id="tab-insp-content" class="flex-1 py-2.5 text-center border-b-2 border-[#d63384] text-[#d63384] transition flex items-center justify-center space-x-1">
                        <i class="fa-solid fa-pen text-xs"></i> <span>Konten</span>
                    </button>
                    <button id="tab-insp-style" class="flex-1 py-2.5 text-center border-b-2 border-transparent text-gray-400 hover:text-white transition flex items-center justify-center space-x-1">
                        <i class="fa-solid fa-paintbrush text-xs"></i> <span>Gaya</span>
                    </button>
                    <button id="tab-insp-advanced" class="flex-1 py-2.5 text-center border-b-2 border-transparent text-gray-400 hover:text-white transition flex items-center justify-center space-x-1">
                        <i class="fa-solid fa-sliders text-xs"></i> <span>Lanjutan</span>
                    </button>
                </div>

                <!-- Inspector Contents Container -->
                <div class="flex-1 overflow-y-auto p-1">
                    <!-- Tab Content: Traits (Attributes, Links, Settings, Photo Chooser) -->
                    <div id="inspector-content-panel" class="p-2 space-y-3">
                        <!-- Dynamic Single Photo Chooser Panel -->
                        <div id="inspector-photo-manager" class="hidden space-y-3"></div>

                        <!-- Dynamic Carousel & Slides Photo Manager Panel -->
                        <div id="inspector-carousel-manager" class="hidden space-y-3"></div>

                        <div id="traits-container"></div>
                        <div id="traits-empty-hint" class="p-4 text-center text-xs text-gray-500 italic">
                            Klik elemen di dalam kanvas untuk mengubah teks, foto, tautan, atau atribut khusus.
                        </div>
                    </div>

                    <!-- Tab Style: CSS Styles (Typography, Dimensions, Colors, Borders, Flex) -->
                    <div id="inspector-style-panel" class="hidden">
                        <div id="styles-panel"></div>
                    </div>

                    <!-- Tab Advanced: Motion Effects, Custom CSS & Layer Tree -->
                    <div id="inspector-advanced-panel" class="hidden p-2 space-y-3">
                        <!-- Custom CSS Editor (Elementor Pro Exclusive) -->
                        <div class="bg-[#17191d] p-3 rounded-xl border border-[#333842] space-y-2">
                            <div class="flex items-center justify-between">
                                <h4 class="text-xs font-bold text-gray-200 uppercase tracking-wider flex items-center">
                                    <i class="fa-brands fa-css3-alt text-amber-400 mr-2 text-sm"></i> Custom CSS
                                </h4>
                                <span class="px-1.5 py-0.5 rounded bg-pink-500/20 text-pink-300 border border-pink-400/30 text-[9px] font-black uppercase">PRO</span>
                            </div>
                            <p class="text-[10px] text-gray-400">Ketik kode CSS untuk elemen yang sedang dipilih:</p>
                            <textarea id="custom-css-editor" rows="4" placeholder="color: #38bdf8;
background-color: #0f172a;
border-radius: 16px;
box-shadow: 0 10px 25px rgba(0,0,0,0.3);" class="w-full bg-[#121417] border border-[#2d323c] rounded-lg p-2.5 text-[11px] font-mono text-cyan-300 focus:outline-none focus:border-[#d63384] resize-y"></textarea>
                            <button id="btn-apply-custom-css" type="button" class="w-full py-1.5 rounded-lg bg-gradient-to-r from-[#92003b] to-[#d63384] hover:opacity-90 text-white font-bold text-[11px] transition flex items-center justify-center space-x-1 shadow">
                                <i class="fa-solid fa-wand-magic-sparkles text-[10px]"></i>
                                <span>Terapkan Custom CSS</span>
                            </button>
                        </div>

                        <!-- Motion Effects (Elementor Pro Exclusive) -->
                        <div class="bg-[#17191d] p-3 rounded-xl border border-[#333842] space-y-2.5">
                            <div class="flex items-center justify-between">
                                <h4 class="text-xs font-bold text-gray-200 uppercase tracking-wider flex items-center">
                                    <i class="fa-solid fa-person-running text-teal-400 mr-2 text-sm"></i> Motion Effects
                                </h4>
                                <span class="px-1.5 py-0.5 rounded bg-pink-500/20 text-pink-300 border border-pink-400/30 text-[9px] font-black uppercase">PRO</span>
                            </div>
                            <div>
                                <label class="text-[11px] font-semibold text-gray-400">Entrance Animation</label>
                                <select id="motion-animation-select" class="w-full mt-1 bg-[#121417] border border-[#333842] rounded-lg px-2.5 py-1.5 text-xs text-white focus:outline-none focus:border-[#d63384]">
                                    <option value="">Default (None)</option>
                                    <option value="hover:-translate-y-2 transition duration-300">Hover Float (Naik saat disentuh)</option>
                                    <option value="hover:scale-105 transition duration-300">Hover Zoom (Membesar halus)</option>
                                    <option value="hover:shadow-2xl transition duration-300">Hover Glow Shadow</option>
                                    <option value="animate-pulse">Pulsing Glow (Denyut)</option>
                                    <option value="animate-bounce">Bounce (Melompat)</option>
                                </select>
                            </div>
                        </div>

                        <!-- DOM Layers Tree -->
                        <div class="bg-[#17191d] p-3 rounded-xl border border-[#333842] space-y-2">
                            <h4 class="text-xs font-bold text-gray-300 uppercase tracking-wider flex items-center">
                                <i class="fa-solid fa-layer-group text-sky-400 mr-2"></i> Lapisan Elemen (DOM Tree)
                            </h4>
                            <div id="layers-panel-container" class="max-h-56 overflow-y-auto rounded-lg border border-[#272b33]">
                                <div id="layers-panel"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ELEMENTOR PRO BOTTOM ACTION BAR -->
            <div class="h-12 bg-[#17191d] border-t border-[#303642] flex items-center justify-between px-2.5 shrink-0">
                <!-- Action Icons -->
                <div class="flex items-center space-x-1">
                    <button id="btn-bottom-settings" class="w-8 h-8 rounded-lg hover:bg-[#282d36] text-gray-400 hover:text-white transition flex items-center justify-center text-xs" title="Pengaturan Halaman (Settings)">
                        <i class="fa-solid fa-gear"></i>
                    </button>
                    <button id="btn-bottom-navigator" class="w-8 h-8 rounded-lg hover:bg-[#282d36] text-gray-400 hover:text-white transition flex items-center justify-center text-xs" title="Navigator (Lapisan DOM)">
                        <i class="fa-solid fa-compass"></i>
                    </button>
                    <button id="btn-bottom-history" class="w-8 h-8 rounded-lg hover:bg-[#282d36] text-gray-400 hover:text-white transition flex items-center justify-center text-xs" title="Riwayat Revisi (History)">
                        <i class="fa-solid fa-clock-rotate-left"></i>
                    </button>
                    <button id="btn-bottom-responsive" class="w-8 h-8 rounded-lg hover:bg-[#282d36] text-gray-400 hover:text-white transition flex items-center justify-center text-xs" title="Responsive Mode">
                        <i class="fa-solid fa-mobile-screen"></i>
                    </button>
                </div>

                <!-- Green Elementor UPDATE / SIMPAN Button -->
                <button id="btn-bottom-update" class="px-4 py-1.5 rounded-lg bg-[#39b54a] hover:bg-[#2fa03f] text-white font-extrabold text-xs shadow-md transition flex items-center space-x-1.5">
                    <i class="fa-solid fa-circle-check text-[10px]"></i>
                    <span>UPDATE</span>
                </button>
            </div>
        </div>

        <!-- CENTER: VISUAL CANVAS WORKSPACE -->
        <div class="flex-1 flex flex-col bg-[#2b303b] overflow-hidden relative">
            <div id="gjs" class="flex-1 w-full h-full"></div>
        </div>

    </div>

    <!-- ELEMENTOR PRO FLOATING NAVIGATOR MODAL -->
    <div id="navigator-modal" class="hidden fixed right-6 bottom-16 w-80 bg-[#202328] border border-[#333842] rounded-2xl shadow-2xl z-40 flex flex-col overflow-hidden max-h-[460px]">
        <div class="px-3.5 py-2.5 bg-[#17191d] border-b border-[#333842] flex items-center justify-between cursor-move">
            <div class="flex items-center space-x-2 text-xs font-bold text-gray-200">
                <i class="fa-solid fa-compass text-[#d63384]"></i>
                <span>Navigator (Lapisan Struktur)</span>
            </div>
            <button id="btn-close-navigator" class="text-gray-400 hover:text-white text-xs">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
        <div class="p-2 overflow-y-auto flex-1">
            <div id="floating-layers-container"></div>
        </div>
    </div>

    <!-- ELEMENTOR PRO TEMPLATE LIBRARY MODAL -->
    <div id="template-library-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/70 backdrop-blur-sm p-4">
        <div class="bg-[#202328] border border-[#333842] rounded-2xl shadow-2xl w-full max-w-5xl h-[85vh] flex flex-col overflow-hidden animate-fade-in">
            <!-- Modal Header -->
            <div class="px-6 py-4 bg-[#17191d] border-b border-[#333842] flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-7 h-7 rounded-lg bg-gradient-to-tr from-[#92003b] to-[#d63384] text-white font-extrabold text-xs flex items-center justify-center">
                        E
                    </div>
                    <div>
                        <h3 class="text-sm font-extrabold text-white tracking-wide flex items-center">
                            <span>ELEMENTOR TEMPLATE LIBRARY</span>
                            <span class="ml-2 px-1.5 py-0.5 rounded bg-amber-400/20 text-amber-300 border border-amber-400/30 text-[9px] font-black uppercase">PRO PRESETS</span>
                        </h3>
                        <p class="text-[11px] text-gray-400">Pilih template blok profesional untuk disisipkan langsung ke halaman web Anda.</p>
                    </div>
                </div>
                <button id="btn-close-library" class="p-2 rounded-lg bg-[#282d36] hover:bg-[#343a46] text-gray-400 hover:text-white transition text-sm">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <!-- Filter Categories Bar -->
            <div class="px-6 py-3 bg-[#1e2228] border-b border-[#303642] flex flex-wrap gap-2 text-xs">
                <button class="tpl-filter-btn px-3 py-1.5 rounded-lg bg-[#d63384] text-white font-bold transition" data-category="all">Semua Template</button>
                <button class="tpl-filter-btn px-3 py-1.5 rounded-lg bg-[#282d36] text-gray-300 hover:text-white font-medium transition" data-category="carousel">🎠 Carousel & Sliders</button>
                <button class="tpl-filter-btn px-3 py-1.5 rounded-lg bg-[#282d36] text-gray-300 hover:text-white font-medium transition" data-category="hero">Hero & Banner</button>
                <button class="tpl-filter-btn px-3 py-1.5 rounded-lg bg-[#282d36] text-gray-300 hover:text-white font-medium transition" data-category="services">Layanan & Fitur</button>
                <button class="tpl-filter-btn px-3 py-1.5 rounded-lg bg-[#282d36] text-gray-300 hover:text-white font-medium transition" data-category="about">Profil & Visi Misi</button>
                <button class="tpl-filter-btn px-3 py-1.5 rounded-lg bg-[#282d36] text-gray-300 hover:text-white font-medium transition" data-category="pricing">Biaya & Pricing</button>
                <button class="tpl-filter-btn px-3 py-1.5 rounded-lg bg-[#282d36] text-gray-300 hover:text-white font-medium transition" data-category="faq">FAQ & Tanya Jawab</button>
                <button class="tpl-filter-btn px-3 py-1.5 rounded-lg bg-[#282d36] text-gray-300 hover:text-white font-medium transition" data-category="cta">Kontak & WhatsApp</button>
            </div>

            <!-- Templates Grid Container -->
            <div class="flex-1 overflow-y-auto p-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 bg-[#17191d]" id="templates-grid">
                <!-- Templates will be rendered by JS -->
            </div>
        </div>
    </div>

    <!-- ELEMENTOR PRO POPUP BUILDER MODAL -->
    <div id="popup-builder-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/75 backdrop-blur-sm p-4">
        <div class="bg-[#202328] border border-[#333842] rounded-2xl shadow-2xl w-full max-w-2xl overflow-hidden flex flex-col">
            <!-- Modal Header -->
            <div class="px-6 py-4 bg-[#17191d] border-b border-[#333842] flex items-center justify-between">
                <div class="flex items-center space-x-2.5">
                    <div class="w-7 h-7 rounded-lg bg-amber-500/20 text-amber-400 border border-amber-500/40 flex items-center justify-center text-xs">
                        <i class="fa-solid fa-window-restore"></i>
                    </div>
                    <div>
                        <h3 class="text-sm font-extrabold text-white tracking-wide flex items-center">
                            <span>POPUP BUILDER</span>
                            <span class="ml-2 px-1.5 py-0.5 rounded bg-pink-500/20 text-pink-300 border border-pink-400/30 text-[9px] font-black uppercase">ELEMENTOR PRO</span>
                        </h3>
                        <p class="text-[11px] text-gray-400">Rancang dan sisipkan modal popup konversi pendaftaran PMB atau pengumuman penting.</p>
                    </div>
                </div>
                <button id="btn-close-popup-builder" class="p-2 rounded-lg bg-[#282d36] hover:bg-[#343a46] text-gray-400 hover:text-white transition text-xs">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <!-- Modal Body: Preset Popups -->
            <div class="p-6 space-y-4 max-h-[70vh] overflow-y-auto bg-[#17191d]">
                <!-- Preset 1: Promo Beasiswa PMB -->
                <div class="p-4 rounded-2xl bg-[#202328] border border-[#333842] flex flex-col sm:flex-row items-center justify-between gap-4 hover:border-amber-400/50 transition">
                    <div class="space-y-1 text-center sm:text-left">
                        <span class="px-2 py-0.5 rounded bg-emerald-500/20 text-emerald-300 border border-emerald-500/30 text-[9px] font-bold uppercase">Lead Generation</span>
                        <h4 class="text-xs sm:text-sm font-extrabold text-white">Popup Promo PMB & Diskon 50% DPP</h4>
                        <p class="text-[11px] text-gray-400">Modal pop-up dengan timer hitung mundur dan formulir nama/nomor WA cepat.</p>
                    </div>
                    <button class="btn-insert-popup-preset px-4 py-2 rounded-xl bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-400 hover:to-amber-500 text-slate-950 font-black text-xs shadow-md transition flex items-center space-x-1.5 shrink-0" data-preset="pmb-lead">
                        <i class="fa-solid fa-circle-plus"></i>
                        <span>Sisipkan Popup</span>
                    </button>
                </div>

                <!-- Preset 2: Pengumuman Darurat / Peringatan Penting -->
                <div class="p-4 rounded-2xl bg-[#202328] border border-[#333842] flex flex-col sm:flex-row items-center justify-between gap-4 hover:border-sky-400/50 transition">
                    <div class="space-y-1 text-center sm:text-left">
                        <span class="px-2 py-0.5 rounded bg-sky-500/20 text-sky-300 border border-sky-500/30 text-[9px] font-bold uppercase">Announcement</span>
                        <h4 class="text-xs sm:text-sm font-extrabold text-white">Popup Pengumuman Libur & Jadwal KRS</h4>
                        <p class="text-[11px] text-gray-400">Modal pengumuman resmi sivitas akademika dengan ikon lonceng informasi.</p>
                    </div>
                    <button class="btn-insert-popup-preset px-4 py-2 rounded-xl bg-[#282d36] hover:bg-[#343a46] text-white font-bold text-xs shadow-md transition flex items-center space-x-1.5 shrink-0 border border-[#373e4b]" data-preset="announcement">
                        <i class="fa-solid fa-circle-plus text-sky-400"></i>
                        <span>Sisipkan Popup</span>
                    </button>
                </div>

                <!-- Preset 3: Konsultasi WhatsApp Cepat -->
                <div class="p-4 rounded-2xl bg-[#202328] border border-[#333842] flex flex-col sm:flex-row items-center justify-between gap-4 hover:border-emerald-400/50 transition">
                    <div class="space-y-1 text-center sm:text-left">
                        <span class="px-2 py-0.5 rounded bg-emerald-500/20 text-emerald-300 border border-emerald-500/30 text-[9px] font-bold uppercase">Direct Support</span>
                        <h4 class="text-xs sm:text-sm font-extrabold text-white">Popup Tombol Chat WhatsApp Mengambang</h4>
                        <p class="text-[11px] text-gray-400">Widget modal interaktif di sudut kanan bawah untuk live chat admisi.</p>
                    </div>
                    <button class="btn-insert-popup-preset px-4 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs shadow-md transition flex items-center space-x-1.5 shrink-0" data-preset="wa-support">
                        <i class="fa-brands fa-whatsapp text-sm"></i>
                        <span>Sisipkan Popup</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- PAGE SETTINGS MODAL -->
    <div id="page-settings-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/70 backdrop-blur-sm p-4">
        <div class="bg-[#202328] border border-[#333842] rounded-2xl shadow-2xl w-full max-w-md overflow-hidden">
            <div class="px-5 py-4 bg-[#17191d] border-b border-[#333842] flex items-center justify-between">
                <h3 class="text-xs font-bold text-white uppercase tracking-wider flex items-center">
                    <i class="fa-solid fa-gear text-sky-400 mr-2"></i> Pengaturan Halaman
                </h3>
                <button id="btn-close-page-settings" class="text-gray-400 hover:text-white text-xs">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <div class="p-5 space-y-4 text-xs">
                <div>
                    <label class="block font-bold text-gray-400 mb-1">Judul Halaman</label>
                    <input type="text" value="{{ $page->title }}" readonly class="w-full bg-[#17191d] border border-[#333842] rounded-xl px-3 py-2 text-white">
                </div>
                <div>
                    <label class="block font-bold text-gray-400 mb-1">URL Slug</label>
                    <input type="text" value="{{ $page->slug }}" readonly class="w-full bg-[#17191d] border border-[#333842] rounded-xl px-3 py-2 text-gray-400 font-mono">
                </div>
                <div>
                    <label class="block font-bold text-gray-400 mb-1">Tipe Layout</label>
                    <span class="inline-block px-2.5 py-1 rounded bg-sky-500/20 text-sky-300 border border-sky-500/30 font-bold uppercase">Elementor Studio (GrapesJS)</span>
                </div>
                <div class="pt-2 border-t border-[#333842] flex justify-end">
                    <a href="{{ route('admin.pages.edit', $page->id) }}" class="px-4 py-2 rounded-xl bg-[#282d36] hover:bg-[#343a46] text-white font-bold transition">
                        Edit Metadata di Admin
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- TOAST NOTIFICATION -->
    <div id="toast" class="fixed bottom-6 right-6 z-50 transform translate-y-24 opacity-0 transition-all duration-300 bg-emerald-600 text-white px-5 py-3 rounded-2xl shadow-2xl flex items-center space-x-3 text-xs font-bold border border-emerald-400">
        <i class="fa-solid fa-circle-check text-base"></i>
        <span id="toast-message">Halaman berhasil disimpan!</span>
    </div>

    @php
        $existingProject = ($page->layout_type === 'grapesjs' && is_array($page->blocks_data)) ? $page->blocks_data : null;
        $existingHtml = $page->content ?? '';
    @endphp

    <!-- GrapesJS Initialization & Elementor Pro Studio Engine -->
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
                        'https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?w=1200&auto=format&fit=crop&q=80',
                        'https://images.unsplash.com/photo-1559839734-2b71ea197ec2?w=600&auto=format&fit=crop&q=80'
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
                            name: 'Dimensi & Ukuran',
                            open: false,
                            buildProps: ['width', 'min-width', 'max-width', 'height', 'min-height', 'margin', 'padding']
                        },
                        {
                            name: 'Warna & Latar Belakang',
                            open: false,
                            buildProps: ['background-color', 'background', 'opacity']
                        },
                        {
                            name: 'Border & Bayangan',
                            open: false,
                            buildProps: ['border', 'border-radius', 'box-shadow']
                        },
                        {
                            name: 'Tata Letak Flexbox / Grid',
                            open: false,
                            buildProps: ['display', 'flex-direction', 'justify-content', 'align-items', 'gap', 'flex-wrap']
                        },
                        {
                            name: 'Efek & Posisi',
                            open: false,
                            buildProps: ['position', 'top', 'bottom', 'left', 'right', 'z-index', 'transition', 'transform']
                        }
                    ]
                },
                traitManager: {
                    appendTo: '#traits-container'
                },
                layerManager: {
                    appendTo: '#layers-panel'
                },
                panels: { defaults: [] },
                canvas: {
                    styles: [
                        'https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap',
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
                    
                    /* Elementor Canvas Hover & Selection Outline Effect */
                    [data-gjs-type]:hover {
                        outline: 1px dashed #71d7f7 !important;
                    }
                    .gjs-selected {
                        outline: 2px solid #d63384 !important;
                    }
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
                    // Default template for empty page with Elementor look
                    editor.setComponents(`
                        <div class="py-20 text-white text-center" style="background: linear-gradient(135deg, var(--color-primary), var(--color-secondary));">
                            <div class="max-w-4xl mx-auto px-4 space-y-4">
                                <span class="px-3 py-1 rounded-full bg-white/20 text-xs font-bold uppercase tracking-wider">Elementor Pro Studio</span>
                                <h1 class="text-4xl font-extrabold">{{ $page->title }}</h1>
                                <p class="text-base text-white/90 max-w-2xl mx-auto">Tarik (drag & drop) widget dari sidebar kiri ke kanvas ini atau buka Template Library untuk menyisipkan layout siap pakai.</p>
                            </div>
                        </div>
                    `);
                @endif
            });

            // ==========================================
            // ELEMENTOR PRO WIDGET PALETTE REGISTRATION
            // ==========================================
            const bm = editor.BlockManager;

            // --- 1. STRUKTUR & TATA LETAK ---
            bm.add('pro-sect-1-col', {
                label: '1 Kolom Penuh',
                category: '1. Struktur & Grid',
                media: '<i class="fa-solid fa-square gjs-block-icon text-sky-400"></i>',
                content: `<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10"><div class="p-8 bg-slate-50 border-2 border-dashed border-slate-300 rounded-2xl text-center text-slate-500 font-medium">Konten Kolom Penuh - Letakkan widget di sini</div></div>`
            });

            bm.add('pro-sect-2-col', {
                label: '2 Kolom (50/50)',
                category: '1. Struktur & Grid',
                media: '<i class="fa-solid fa-table-columns gjs-block-icon text-sky-400"></i>',
                content: `<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                        <div class="p-6 bg-slate-50 border border-slate-200 rounded-2xl text-slate-700">Kolom Kiri</div>
                        <div class="p-6 bg-slate-50 border border-slate-200 rounded-2xl text-slate-700">Kolom Kanan</div>
                    </div>
                </div>`
            });

            bm.add('pro-sect-3-col', {
                label: '3 Kolom Grid',
                category: '1. Struktur & Grid',
                media: '<i class="fa-solid fa-table-cells gjs-block-icon text-sky-400"></i>',
                content: `<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="p-6 bg-white shadow-sm border border-slate-200 rounded-2xl">Kolom 1</div>
                        <div class="p-6 bg-white shadow-sm border border-slate-200 rounded-2xl">Kolom 2</div>
                        <div class="p-6 bg-white shadow-sm border border-slate-200 rounded-2xl">Kolom 3</div>
                    </div>
                </div>`
            });

            bm.add('pro-sect-4-col', {
                label: '4 Kolom Grid',
                category: '1. Struktur & Grid',
                media: '<i class="fa-solid fa-border-all gjs-block-icon text-sky-400"></i>',
                content: `<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
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
                category: '1. Struktur & Grid',
                media: '<i class="fa-solid fa-table-cells-large gjs-block-icon text-sky-400"></i>',
                content: `<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                        <div class="lg:col-span-4 p-6 bg-slate-50 border border-slate-200 rounded-2xl">Sidebar Navigasi</div>
                        <div class="lg:col-span-8 p-6 bg-white shadow-sm border border-slate-200 rounded-2xl">Konten Utama</div>
                    </div>
                </div>`
            });

            bm.add('pro-spacer', {
                label: 'Spacer / Jarak',
                category: '1. Struktur & Grid',
                media: '<i class="fa-solid fa-arrows-up-down gjs-block-icon text-slate-400"></i>',
                content: `<div class="w-full h-12"></div>`
            });

            bm.add('pro-divider', {
                label: 'Garis Divider Bintang',
                category: '1. Struktur & Grid',
                media: '<i class="fa-solid fa-minus gjs-block-icon text-slate-400"></i>',
                content: `<div class="relative flex py-6 items-center"><div class="flex-grow border-t border-slate-200"></div><span class="flex-shrink mx-4 text-theme-primary"><i class="fa-solid fa-star text-xs"></i></span><div class="flex-grow border-t border-slate-200"></div></div>`
            });

            // --- 2. ELEMEN DASAR (BASIC) ---
            bm.add('pro-heading', {
                label: 'Heading / Judul',
                category: '2. Elemen Dasar (Basic)',
                media: '<i class="fa-solid fa-heading gjs-block-icon text-amber-400"></i>',
                content: `<h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight my-4">Judul Bagian Halaman</h2>`
            });

            bm.add('pro-paragraph', {
                label: 'Teks Paragraf',
                category: '2. Elemen Dasar (Basic)',
                media: '<i class="fa-solid fa-paragraph gjs-block-icon text-amber-400"></i>',
                content: `<p class="text-sm sm:text-base text-slate-600 leading-relaxed my-3">Tuliskan uraian kalimat dan paragraf informatif di sini. Anda dapat mengubah teks, ukuran font, perataan, dan warna teks langsung melalui panel inspektur.</p>`
            });

            bm.add('pro-button', {
                label: 'Tombol Aksi (CTA)',
                category: '2. Elemen Dasar (Basic)',
                media: '<i class="fa-solid fa-arrow-pointer gjs-block-icon text-emerald-400"></i>',
                content: `<a href="/layanan" class="inline-flex items-center px-6 py-3 rounded-xl bg-theme-primary text-white font-bold text-xs uppercase tracking-wider shadow-md hover:shadow-lg transition transform hover:-translate-y-0.5"><span>Pelajari Layanan</span> <i class="fa-solid fa-arrow-right ml-2 text-[10px]"></i></a>`
            });

            bm.add('pro-image', {
                label: 'Foto / Gambar',
                category: '2. Elemen Dasar (Basic)',
                media: '<i class="fa-solid fa-image gjs-block-icon text-teal-400"></i>',
                content: `<div class="rounded-2xl overflow-hidden shadow-sm border border-slate-200 my-4"><img src="https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?w=1200&auto=format&fit=crop&q=80" alt="Foto Kampus" class="w-full h-auto object-cover"></div>`
            });

            bm.add('pro-video', {
                label: 'Video YouTube',
                category: '2. Elemen Dasar (Basic)',
                media: '<i class="fa-brands fa-youtube gjs-block-icon text-rose-500"></i>',
                content: `<div class="aspect-video rounded-2xl overflow-hidden shadow-lg border border-slate-200 my-4"><iframe class="w-full h-full" src="https://www.youtube.com/embed/dQw4w9WgXcQ" frameborder="0" allowfullscreen></iframe></div>`
            });

            bm.add('pro-icon-box', {
                label: 'Icon Box',
                category: '2. Elemen Dasar (Basic)',
                media: '<i class="fa-solid fa-cubes-stacked gjs-block-icon text-indigo-400"></i>',
                content: `<div class="p-6 bg-white rounded-2xl border border-slate-200 shadow-sm space-y-3">
                    <div class="w-12 h-12 rounded-xl flex items-center justify-center text-white text-xl shadow" style="background-color: var(--color-primary);"><i class="fa-solid fa-star"></i></div>
                    <h3 class="text-base font-bold text-slate-900">Judul Fitur</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">Deskripsi singkat seputar manfaat dan informasi fitur terkait.</p>
                </div>`
            });

            bm.add('pro-alert', {
                label: 'Alert Box',
                category: '2. Elemen Dasar (Basic)',
                media: '<i class="fa-solid fa-circle-exclamation gjs-block-icon text-amber-400"></i>',
                content: `<div class="p-4 rounded-xl bg-amber-50 border border-amber-200 text-amber-900 flex items-start space-x-3 my-4">
                    <i class="fa-solid fa-circle-info text-amber-600 text-lg mt-0.5"></i>
                    <div><h4 class="text-xs font-bold">Informasi Penting</h4><p class="text-xs text-amber-800 mt-0.5">Silakan baca petunjuk dengan seksama sebelum mengisi formulir.</p></div>
                </div>`
            });

            // --- 3. CAROUSEL & SLIDERS PRO ---
            bm.add('pro-carousel-hero', {
                label: '🎠 Hero Banner Slider',
                category: '3. Carousel & Sliders Pro',
                media: '<i class="fa-solid fa-images gjs-block-icon text-pink-400"></i>',
                content: `<div x-data="{ active: 0, total: 3 }" data-elementor-type="carousel" class="relative w-full h-[480px] overflow-hidden bg-slate-900 group my-6 rounded-3xl shadow-2xl">
                    <!-- Slide 1 -->
                    <div x-show="active === 0" class="carousel-slide absolute inset-0 transition-opacity duration-700">
                        <img src="https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?w=1600&auto=format&fit=crop&q=80" alt="Slide 1" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-r from-slate-950/90 via-slate-900/70 to-transparent flex items-center">
                            <div class="max-w-2xl px-8 sm:px-16 text-white space-y-4">
                                <span class="inline-block px-3 py-1 rounded-full bg-theme-primary text-cyan-200 text-xs font-bold uppercase tracking-wider shadow">AKREDITASI BAIK SEKALI</span>
                                <h2 class="text-3xl sm:text-5xl font-black leading-tight">Pusat Keunggulan Pendidikan Keperawatan & Medis</h2>
                                <p class="text-sm sm:text-base text-slate-200 font-normal leading-relaxed">Mencetak tenaga medis kompeten, beretika tinggi, dan siap diserap di rumah sakit nasional maupun internasional.</p>
                                <div class="pt-2">
                                    <a href="/kontak" class="inline-flex items-center px-6 py-3 rounded-xl bg-theme-primary hover:bg-theme-secondary text-white font-bold text-xs uppercase tracking-wider shadow-xl transition transform hover:-translate-y-0.5">
                                        <span>Daftar Online PMB</span> <i class="fa-solid fa-arrow-right ml-2 text-xs"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Slide 2 -->
                    <div x-show="active === 1" style="display: none;" class="carousel-slide absolute inset-0 transition-opacity duration-700">
                        <img src="https://images.unsplash.com/photo-1584515979956-d9f6e5d09982?w=1600&auto=format&fit=crop&q=80" alt="Slide 2" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-r from-slate-950/90 via-slate-900/70 to-transparent flex items-center">
                            <div class="max-w-2xl px-8 sm:px-16 text-white space-y-4">
                                <span class="inline-block px-3 py-1 rounded-full bg-theme-primary text-cyan-200 text-xs font-bold uppercase tracking-wider shadow">FASILITAS MODERN</span>
                                <h2 class="text-3xl sm:text-5xl font-black leading-tight">Fasilitas Laboratorium Medis & Rumah Sakit Simulasi</h2>
                                <p class="text-sm sm:text-base text-slate-200 font-normal leading-relaxed">Didukung peralatan modern terstandar medis untuk simulasi tindakan gawat darurat dan keperawatan kritis.</p>
                                <div class="pt-2">
                                    <a href="/layanan" class="inline-flex items-center px-6 py-3 rounded-xl bg-theme-primary hover:bg-theme-secondary text-white font-bold text-xs uppercase tracking-wider shadow-xl transition transform hover:-translate-y-0.5">
                                        <span>Jelajahi Lab Medis</span> <i class="fa-solid fa-arrow-right ml-2 text-xs"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Slide 3 -->
                    <div x-show="active === 2" style="display: none;" class="carousel-slide absolute inset-0 transition-opacity duration-700">
                        <img src="https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?w=1600&auto=format&fit=crop&q=80" alt="Slide 3" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-r from-slate-950/90 via-slate-900/70 to-transparent flex items-center">
                            <div class="max-w-2xl px-8 sm:px-16 text-white space-y-4">
                                <span class="inline-block px-3 py-1 rounded-full bg-theme-primary text-cyan-200 text-xs font-bold uppercase tracking-wider shadow">BEASISWA & KERJASAMA</span>
                                <h2 class="text-3xl sm:text-5xl font-black leading-tight">Beasiswa Prestasi & Program Penempatan Kerja Cepat</h2>
                                <p class="text-sm sm:text-base text-slate-200 font-normal leading-relaxed">Dukungan karir penuh melalui jejaring puluhan rumah sakit terkemuka mitra resmi Yayasan Panti Waluya.</p>
                                <div class="pt-2">
                                    <a href="/profil" class="inline-flex items-center px-6 py-3 rounded-xl bg-theme-primary hover:bg-theme-secondary text-white font-bold text-xs uppercase tracking-wider shadow-xl transition transform hover:-translate-y-0.5">
                                        <span>Informasi Beasiswa</span> <i class="fa-solid fa-arrow-right ml-2 text-xs"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button @click="active = (active - 1 + total) % total" class="absolute left-4 top-1/2 -translate-y-1/2 w-11 h-11 rounded-full bg-black/40 hover:bg-black/70 text-white flex items-center justify-center transition border border-white/20 shadow-xl">
                        <i class="fa-solid fa-chevron-left text-sm"></i>
                    </button>
                    <button @click="active = (active + 1) % total" class="absolute right-4 top-1/2 -translate-y-1/2 w-11 h-11 rounded-full bg-black/40 hover:bg-black/70 text-white flex items-center justify-center transition border border-white/20 shadow-xl">
                        <i class="fa-solid fa-chevron-right text-sm"></i>
                    </button>
                    <div class="absolute bottom-6 inset-x-0 flex justify-center space-x-2.5">
                        <button @click="active = 0" :class="active === 0 ? 'w-8 bg-theme-primary' : 'w-2.5 bg-white/50 hover:bg-white'" class="h-2.5 rounded-full transition-all duration-300"></button>
                        <button @click="active = 1" :class="active === 1 ? 'w-8 bg-theme-primary' : 'w-2.5 bg-white/50 hover:bg-white'" class="h-2.5 rounded-full transition-all duration-300"></button>
                        <button @click="active = 2" :class="active === 2 ? 'w-8 bg-theme-primary' : 'w-2.5 bg-white/50 hover:bg-white'" class="h-2.5 rounded-full transition-all duration-300"></button>
                    </div>
                </div>`
            });

            bm.add('pro-image-carousel', {
                label: '🖼️ Image Carousel Gallery',
                category: '3. Carousel & Sliders Pro',
                media: '<i class="fa-solid fa-images gjs-block-icon text-pink-400"></i>',
                content: `<div x-data="{ active: 0, total: 3 }" data-elementor-type="carousel" class="max-w-6xl mx-auto py-8 px-4 my-6">
                    <div class="relative overflow-hidden rounded-3xl border border-slate-200 bg-slate-100 shadow-xl">
                        <!-- Slide 1 -->
                        <div x-show="active === 0" class="carousel-slide aspect-[16/8] relative">
                            <img src="https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?w=1200&auto=format&fit=crop&q=80" alt="Galeri Kampus 1" class="w-full h-full object-cover">
                            <div class="absolute bottom-4 left-4 bg-black/60 backdrop-blur-md px-4 py-2 rounded-xl text-white text-xs font-bold">Laboratorium Keperawatan Kritis</div>
                        </div>
                        <!-- Slide 2 -->
                        <div x-show="active === 1" style="display: none;" class="carousel-slide aspect-[16/8] relative">
                            <img src="https://images.unsplash.com/photo-1584515979956-d9f6e5d09982?w=1200&auto=format&fit=crop&q=80" alt="Galeri Kampus 2" class="w-full h-full object-cover">
                            <div class="absolute bottom-4 left-4 bg-black/60 backdrop-blur-md px-4 py-2 rounded-xl text-white text-xs font-bold">Gedung Pusat Praktik Medis Terpadu</div>
                        </div>
                        <!-- Slide 3 -->
                        <div x-show="active === 2" style="display: none;" class="carousel-slide aspect-[16/8] relative">
                            <img src="https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?w=1200&auto=format&fit=crop&q=80" alt="Galeri Kampus 3" class="w-full h-full object-cover">
                            <div class="absolute bottom-4 left-4 bg-black/60 backdrop-blur-md px-4 py-2 rounded-xl text-white text-xs font-bold">Perpustakaan Digital & Ruang Diskusi</div>
                        </div>
                        <button @click="active = (active - 1 + total) % total" class="absolute left-4 top-1/2 -translate-y-1/2 w-10 h-10 rounded-full bg-black/40 hover:bg-black/70 text-white flex items-center justify-center transition shadow-lg"><i class="fa-solid fa-chevron-left text-xs"></i></button>
                        <button @click="active = (active + 1) % total" class="absolute right-4 top-1/2 -translate-y-1/2 w-10 h-10 rounded-full bg-black/40 hover:bg-black/70 text-white flex items-center justify-center transition shadow-lg"><i class="fa-solid fa-chevron-right text-xs"></i></button>
                    </div>
                    <div class="flex justify-center space-x-2 pt-4">
                        <button @click="active = 0" :class="active === 0 ? 'w-8 bg-theme-primary' : 'w-2 bg-slate-300'" class="h-2 rounded-full transition-all duration-300"></button>
                        <button @click="active = 1" :class="active === 1 ? 'w-8 bg-theme-primary' : 'w-2 bg-slate-300'" class="h-2 rounded-full transition-all duration-300"></button>
                        <button @click="active = 2" :class="active === 2 ? 'w-8 bg-theme-primary' : 'w-2 bg-slate-300'" class="h-2 rounded-full transition-all duration-300"></button>
                    </div>
                </div>`
            });

            bm.add('pro-carousel-testimonials', {
                label: '💬 Testimonial Slider',
                category: '3. Carousel & Sliders Pro',
                media: '<i class="fa-solid fa-comment-dots gjs-block-icon text-pink-400"></i>',
                content: `<div x-data="{ active: 0, total: 3 }" data-elementor-type="carousel" class="max-w-4xl mx-auto py-8 px-4">
                    <div class="relative bg-white rounded-3xl border border-slate-200 p-8 sm:p-12 shadow-xl text-center space-y-6 overflow-hidden">
                        <div class="text-amber-400 text-base space-x-1">
                            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                        </div>
                        <!-- Slide 1 -->
                        <div x-show="active === 0" class="carousel-slide space-y-6">
                            <p class="text-base sm:text-xl text-slate-700 italic font-medium leading-relaxed">“Pendidikan di STIKES Panti Waluya membentuk mentalitas perawat yang penuh empati dan terampil. Laboratorium praktiknya sangat mirip dengan kondisi rumah sakit sebenarnya.”</p>
                            <div class="flex items-center justify-center space-x-4 pt-2">
                                <img src="https://images.unsplash.com/photo-1559839734-2b71ea197ec2?w=150&h=150&fit=crop" class="w-14 h-14 rounded-full object-cover border-2 border-theme-primary shadow-md">
                                <div class="text-left">
                                    <div class="text-sm font-extrabold text-slate-900">Ns. Angela Putri, S.Kep</div>
                                    <div class="text-xs text-theme-primary font-semibold">Alumni Ners - Kepala Rawat Inap RS Panti Nirmala</div>
                                </div>
                            </div>
                        </div>
                        <!-- Slide 2 -->
                        <div x-show="active === 1" style="display: none;" class="carousel-slide space-y-6">
                            <p class="text-base sm:text-xl text-slate-700 italic font-medium leading-relaxed">“Mahasiswa STIKES memiliki kedisiplinan dan kesiapan klinis yang sangat unggul dibandingkan kampus lain saat menjalani stase rotasi medis.”</p>
                            <div class="flex items-center justify-center space-x-4 pt-2">
                                <img src="https://images.unsplash.com/photo-1622253692010-333f2da6031d?w=150&h=150&fit=crop" class="w-14 h-14 rounded-full object-cover border-2 border-theme-primary shadow-md">
                                <div class="text-left">
                                    <div class="text-sm font-extrabold text-slate-900">dr. Antonius Wicaksono</div>
                                    <div class="text-xs text-theme-primary font-semibold">Mitra Pembimbing Praktik Klinis RS Panti Waluyo</div>
                                </div>
                            </div>
                        </div>
                        <!-- Slide 3 -->
                        <div x-show="active === 2" style="display: none;" class="carousel-slide space-y-6">
                            <p class="text-base sm:text-xl text-slate-700 italic font-medium leading-relaxed">“Kurikulum digital health dan SIMRS di kampus sangat aplikatif. Saya langsung diterima kerja sebelum wisuda resmi.”</p>
                            <div class="flex items-center justify-center space-x-4 pt-2">
                                <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=150&h=150&fit=crop" class="w-14 h-14 rounded-full object-cover border-2 border-theme-primary shadow-md">
                                <div class="text-left">
                                    <div class="text-sm font-extrabold text-slate-900">Maria Shinta, A.Md.Kes</div>
                                    <div class="text-xs text-theme-primary font-semibold">Alumni Rekam Medis - Praktisi RS Santo Borromeus</div>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center justify-between pt-4 border-t border-slate-100">
                            <button @click="active = (active - 1 + total) % total" class="px-3.5 py-1.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs flex items-center space-x-1.5 transition">
                                <i class="fa-solid fa-chevron-left text-[10px]"></i> <span>Sebelumnya</span>
                            </button>
                            <div class="flex space-x-2">
                                <button @click="active = 0" :class="active === 0 ? 'w-6 bg-theme-primary' : 'w-2 bg-slate-300'" class="h-2 rounded-full transition-all duration-300"></button>
                                <button @click="active = 1" :class="active === 1 ? 'w-6 bg-theme-primary' : 'w-2 bg-slate-300'" class="h-2 rounded-full transition-all duration-300"></button>
                                <button @click="active = 2" :class="active === 2 ? 'w-6 bg-theme-primary' : 'w-2 bg-slate-300'" class="h-2 rounded-full transition-all duration-300"></button>
                            </div>
                            <button @click="active = (active + 1) % total" class="px-3.5 py-1.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs flex items-center space-x-1.5 transition">
                                <span>Berikutnya</span> <i class="fa-solid fa-chevron-right text-[10px]"></i>
                            </button>
                        </div>
                    </div>
                </div>`
            });

            bm.add('pro-carousel-logos', {
                label: '🏢 Logo Carousel Mitra',
                category: '3. Carousel & Sliders Pro',
                media: '<i class="fa-solid fa-hospital-user gjs-block-icon text-pink-400"></i>',
                content: `<section class="py-10 bg-slate-50 border-y border-slate-200 overflow-hidden my-6">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-4 text-center">
                        <span class="text-xs font-bold text-theme-primary uppercase tracking-wider">Jejaring Rumah Sakit & Institusi Rekanan</span>
                    </div>
                    <div class="flex flex-wrap justify-center items-center gap-4 px-4">
                        <div class="p-4 px-6 bg-white rounded-2xl border border-slate-200 shadow-sm font-extrabold text-slate-700 text-xs sm:text-sm flex items-center space-x-2.5 hover:shadow-md transition">
                            <i class="fa-solid fa-hospital text-rose-500 text-lg"></i> <span>RS Panti Nirmala Malang</span>
                        </div>
                        <div class="p-4 px-6 bg-white rounded-2xl border border-slate-200 shadow-sm font-extrabold text-slate-700 text-xs sm:text-sm flex items-center space-x-2.5 hover:shadow-md transition">
                            <i class="fa-solid fa-hospital text-sky-500 text-lg"></i> <span>RS Panti Waluyo Surakarta</span>
                        </div>
                        <div class="p-4 px-6 bg-white rounded-2xl border border-slate-200 shadow-sm font-extrabold text-slate-700 text-xs sm:text-sm flex items-center space-x-2.5 hover:shadow-md transition">
                            <i class="fa-solid fa-hospital text-emerald-500 text-lg"></i> <span>RS Santo Borromeus Bandung</span>
                        </div>
                        <div class="p-4 px-6 bg-white rounded-2xl border border-slate-200 shadow-sm font-extrabold text-slate-700 text-xs sm:text-sm flex items-center space-x-2.5 hover:shadow-md transition">
                            <i class="fa-solid fa-award text-amber-500 text-lg"></i> <span>Akreditasi LAM-PTKes</span>
                        </div>
                        <div class="p-4 px-6 bg-white rounded-2xl border border-slate-200 shadow-sm font-extrabold text-slate-700 text-xs sm:text-sm flex items-center space-x-2.5 hover:shadow-md transition">
                            <i class="fa-solid fa-globe text-indigo-500 text-lg"></i> <span>Japan Medical Internship</span>
                        </div>
                    </div>
                </section>`
            });

            bm.add('pro-carousel-team', {
                label: '👨‍⚕️ Carousel Dosen & Dokter',
                category: '3. Carousel & Sliders Pro',
                media: '<i class="fa-solid fa-users-viewfinder gjs-block-icon text-pink-400"></i>',
                content: `<div x-data="{
                    idx: 0,
                    members: [
                        { name: 'Dr. Ns. Maria Fransiska, M.Kep', role: 'Kaprodi S1 Keperawatan', img: 'https://images.unsplash.com/photo-1559839734-2b71ea197ec2?w=400&fit=crop' },
                        { name: 'Ns. Albertus Joko, M.Kes', role: 'Dosen Keperawatan Kritis', img: 'https://images.unsplash.com/photo-1622253692010-333f2da6031d?w=400&fit=crop' },
                        { name: 'Bernadetta Rina, S.ST., M.M', role: 'Kepala Lab Medis Terpadu', img: 'https://images.unsplash.com/photo-1594824813580-c1168f121e78?w=400&fit=crop' },
                        { name: 'dr. Hendra Kusuma, Sp.PD', role: 'Dosen Pembimbing Klinis', img: 'https://images.unsplash.com/photo-1537368910025-700350fe46c7?w=400&fit=crop' }
                    ]
                }" class="max-w-7xl mx-auto py-10 px-4">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <span class="text-xs font-bold text-theme-primary uppercase tracking-wider">Tenaga Pendidik & Instruktur</span>
                            <h3 class="text-2xl font-extrabold text-slate-900">Dosen & Praktisi Rumah Sakit</h3>
                        </div>
                        <div class="flex space-x-2">
                            <button @click="idx = Math.max(0, idx - 1)" class="w-9 h-9 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 flex items-center justify-center transition"><i class="fa-solid fa-chevron-left text-xs"></i></button>
                            <button @click="idx = Math.min(members.length - 2, idx + 1)" class="w-9 h-9 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 flex items-center justify-center transition"><i class="fa-solid fa-chevron-right text-xs"></i></button>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                        <template x-for="(m, i) in members" :key="i">
                            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden text-center group hover:shadow-lg transition">
                                <img :src="m.img" class="w-full h-52 object-cover group-hover:scale-105 transition duration-300">
                                <div class="p-4 space-y-1">
                                    <h4 class="text-xs font-extrabold text-slate-900" x-text="m.name"></h4>
                                    <p class="text-[11px] text-theme-primary font-semibold" x-text="m.role"></p>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>`
            });

            // --- 4. ELEMENTOR PRO WIDGETS ---
            bm.add('pro-flipbox', {
                label: '🔄 3D Flip Box',
                category: '4. Elementor Pro Widgets',
                media: '<i class="fa-solid fa-arrows-rotate gjs-block-icon text-pink-400"></i>',
                content: `<div class="group h-80 [perspective:1000px] my-6 max-w-sm mx-auto">
                    <div class="relative h-full w-full rounded-3xl shadow-xl transition-all duration-700 [transform-style:preserve-3d] group-hover:[transform:rotateY(180deg)]">
                        <div class="absolute inset-0 h-full w-full rounded-3xl bg-gradient-to-br from-theme-primary to-theme-secondary p-8 text-white flex flex-col justify-center items-center text-center [backface-visibility:hidden] shadow-lg">
                            <div class="w-16 h-16 rounded-2xl bg-white/20 backdrop-blur-md flex items-center justify-center text-3xl mb-4"><i class="fa-solid fa-user-nurse"></i></div>
                            <h3 class="text-xl font-black mb-2">Program Studi Ners</h3>
                            <p class="text-xs text-white/90">Arahkan kursor / klik untuk melihat rincian akreditasi & prospek karir.</p>
                            <span class="mt-4 px-3 py-1 rounded-full bg-white/20 text-[10px] font-bold uppercase tracking-wider">Hover Saya ➔</span>
                        </div>
                        <div class="absolute inset-0 h-full w-full rounded-3xl bg-slate-900 p-8 text-white flex flex-col justify-center items-center text-center [transform:rotateY(180deg)] [backface-visibility:hidden] shadow-lg space-y-3">
                            <h3 class="text-lg font-bold text-cyan-300">Akreditasi & Prospek</h3>
                            <p class="text-xs text-slate-300 leading-relaxed">Terakreditasi LAM-PTKes Baik Sekali dengan penempatan kerja di RS Rekanan dalam dan luar negeri.</p>
                            <a href="/prodi/ners" class="px-5 py-2.5 rounded-xl bg-theme-primary text-white font-bold text-xs uppercase tracking-wider shadow hover:opacity-90 transition">Pelajari Kurikulum</a>
                        </div>
                    </div>
                </div>`
            });

            bm.add('pro-pricelist', {
                label: '📋 Price List / Daftar Tarif',
                category: '4. Elementor Pro Widgets',
                media: '<i class="fa-solid fa-list-ol gjs-block-icon text-pink-400"></i>',
                content: `<div class="max-w-2xl mx-auto bg-white rounded-2xl border border-slate-200 p-6 sm:p-8 shadow-sm my-6 space-y-4">
                    <h3 class="text-base font-extrabold text-slate-900 border-b border-slate-100 pb-3">Rincian Tarif Administrasi PMB</h3>
                    <div class="space-y-4">
                        <div class="flex items-baseline justify-between text-xs sm:text-sm">
                            <span class="font-bold text-slate-800 shrink-0">Biaya Formulir Pendaftaran PMB</span>
                            <span class="flex-1 mx-3 border-b-2 border-dotted border-slate-300"></span>
                            <span class="font-extrabold text-theme-primary shrink-0">Rp 250.000</span>
                        </div>
                        <div class="flex items-baseline justify-between text-xs sm:text-sm">
                            <span class="font-bold text-slate-800 shrink-0">Uji Tes Kesehatan & Laboratorium</span>
                            <span class="flex-1 mx-3 border-b-2 border-dotted border-slate-300"></span>
                            <span class="font-extrabold text-theme-primary shrink-0">Rp 350.000</span>
                        </div>
                        <div class="flex items-baseline justify-between text-xs sm:text-sm">
                            <span class="font-bold text-slate-800 shrink-0">Seragam Praktek & Jas Almamater (3 Set)</span>
                            <span class="flex-1 mx-3 border-b-2 border-dotted border-slate-300"></span>
                            <span class="font-extrabold text-theme-primary shrink-0">Rp 1.200.000</span>
                        </div>
                        <div class="flex items-baseline justify-between text-xs sm:text-sm">
                            <span class="font-bold text-slate-800 shrink-0">Orientasi Kampus & Modul Medis</span>
                            <span class="flex-1 mx-3 border-b-2 border-dotted border-slate-300"></span>
                            <span class="font-extrabold text-emerald-600 font-bold shrink-0">GRATIS</span>
                        </div>
                    </div>
                </div>`
            });

            bm.add('pro-timeline', {
                label: '📍 Alur Timeline PMB',
                category: '4. Elementor Pro Widgets',
                media: '<i class="fa-solid fa-timeline gjs-block-icon text-pink-400"></i>',
                content: `<section class="py-10 bg-slate-50 my-6 rounded-3xl">
                    <div class="max-w-5xl mx-auto px-4">
                        <div class="text-center mb-8 space-y-2">
                            <span class="text-xs font-bold text-theme-primary uppercase tracking-wider">Tahapan Mudah</span>
                            <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900">Alur Pendaftaran Mahasiswa Baru</h2>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                            <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm space-y-3">
                                <div class="w-10 h-10 rounded-xl bg-theme-primary text-white font-black text-sm flex items-center justify-center shadow">1</div>
                                <h4 class="text-sm font-extrabold text-slate-900">Isi Formulir Online</h4>
                                <p class="text-xs text-slate-600 leading-relaxed">Lengkapi biodata dan unggah scan rapor atau ijazah terakhir.</p>
                            </div>
                            <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm space-y-3">
                                <div class="w-10 h-10 rounded-xl bg-theme-primary text-white font-black text-sm flex items-center justify-center shadow">2</div>
                                <h4 class="text-sm font-extrabold text-slate-900">Verifikasi Berkas</h4>
                                <p class="text-xs text-slate-600 leading-relaxed">Tim admisi memvalidasi dokumen dan kualifikasi calon mahasiswa.</p>
                            </div>
                            <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm space-y-3">
                                <div class="w-10 h-10 rounded-xl bg-theme-primary text-white font-black text-sm flex items-center justify-center shadow">3</div>
                                <h4 class="text-sm font-extrabold text-slate-900">Tes Kesehatan</h4>
                                <p class="text-xs text-slate-600 leading-relaxed">Pemeriksaan fisik dan tes buta warna di klinik rekanan kampus.</p>
                            </div>
                            <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm space-y-3">
                                <div class="w-10 h-10 rounded-xl bg-emerald-600 text-white font-black text-sm flex items-center justify-center shadow">4</div>
                                <h4 class="text-sm font-extrabold text-slate-900">Registrasi Ulang</h4>
                                <p class="text-xs text-slate-600 leading-relaxed">Pembayaran daftar ulang dan resmi diterima sebagai mahasiswa.</p>
                            </div>
                        </div>
                    </div>
                </section>`
            });

            bm.add('pro-social-icons', {
                label: '🌐 Social Icons Bar',
                category: '4. Elementor Pro Widgets',
                media: '<i class="fa-solid fa-share-nodes gjs-block-icon text-pink-400"></i>',
                content: `<div class="py-6 text-center space-y-3 my-4">
                    <div class="text-xs font-bold text-slate-600 uppercase tracking-wider">Ikuti Media Sosial Resmi Kampus</div>
                    <div class="flex justify-center space-x-3">
                        <a href="https://instagram.com" target="_blank" class="w-10 h-10 rounded-full bg-gradient-to-tr from-amber-500 via-rose-500 to-purple-600 text-white flex items-center justify-center shadow hover:scale-110 transition"><i class="fa-brands fa-instagram"></i></a>
                        <a href="https://youtube.com" target="_blank" class="w-10 h-10 rounded-full bg-rose-600 text-white flex items-center justify-center shadow hover:scale-110 transition"><i class="fa-brands fa-youtube"></i></a>
                        <a href="https://tiktok.com" target="_blank" class="w-10 h-10 rounded-full bg-slate-950 text-white flex items-center justify-center shadow hover:scale-110 transition"><i class="fa-brands fa-tiktok"></i></a>
                        <a href="https://facebook.com" target="_blank" class="w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center shadow hover:scale-110 transition"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="https://wa.me/" target="_blank" class="w-10 h-10 rounded-full bg-emerald-500 text-white flex items-center justify-center shadow hover:scale-110 transition"><i class="fa-brands fa-whatsapp text-lg"></i></a>
                    </div>
                </div>`
            });

            bm.add('pro-download-box', {
                label: '📁 Download File PDF',
                category: '4. Elementor Pro Widgets',
                media: '<i class="fa-solid fa-file-pdf gjs-block-icon text-pink-400"></i>',
                content: `<div class="p-5 bg-white rounded-2xl border border-slate-200 shadow-sm flex items-center justify-between my-4 hover:border-theme-primary transition">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center text-2xl border border-rose-200"><i class="fa-solid fa-file-pdf"></i></div>
                        <div>
                            <h4 class="text-xs sm:text-sm font-extrabold text-slate-900">Brosur PMB & Rincian Beasiswa 2026/2027</h4>
                            <p class="text-[11px] text-slate-500">Format PDF - Ukuran berkas 4.2 MB</p>
                        </div>
                    </div>
                    <a href="#" class="px-4 py-2 rounded-xl bg-theme-primary text-white font-bold text-xs uppercase tracking-wider flex items-center space-x-1.5 shadow hover:opacity-90 transition">
                        <i class="fa-solid fa-download text-xs"></i> <span class="hidden sm:inline">Unduh PDF</span>
                    </a>
                </div>`
            });

            bm.add('pro-star-rating', {
                label: '⭐ Star Rating Ulasan',
                category: '4. Elementor Pro Widgets',
                media: '<i class="fa-solid fa-star-half-stroke gjs-block-icon text-pink-400"></i>',
                content: `<div class="p-6 bg-slate-50 rounded-2xl border border-slate-200 text-center space-y-2 my-4 max-w-sm mx-auto">
                    <div class="text-3xl font-black text-slate-900">4.9 <span class="text-xs text-slate-500 font-normal">/ 5.0</span></div>
                    <div class="flex justify-center text-amber-400 text-sm space-x-1">
                        <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                    </div>
                    <p class="text-xs text-slate-600 font-semibold">Berdasarkan 450+ Ulasan Mahasiswa & Alumni Terverifikasi</p>
                </div>`
            });

            bm.add('pro-animated-headline', {
                label: '✨ Animated Headline',
                category: '4. Elementor Pro Widgets',
                media: '<i class="fa-solid fa-wand-magic-sparkles gjs-block-icon text-pink-400"></i>',
                content: `<div class="text-center py-6">
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 leading-tight">
                        Wujudkan Masa Depan Medis <br>
                        <span class="relative inline-block text-theme-primary">
                            <span>Profesional & Unggul</span>
                            <svg class="absolute -bottom-2 left-0 w-full" height="8" viewBox="0 0 200 8" fill="none"><path d="M1 5.5C40 2 160 2 199 5.5" stroke="#d63384" stroke-width="3" stroke-linecap="round"/></svg>
                        </span>
                    </h2>
                </div>`
            });

            bm.add('pro-tabs', {
                label: '📑 Tabs Interaktif',
                category: '4. Elementor Pro Widgets',
                media: '<i class="fa-solid fa-folder-open gjs-block-icon text-pink-400"></i>',
                content: `<div x-data="{ tab: 'tab1' }" class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm my-6">
                    <div class="flex border-b border-slate-200 space-x-2">
                        <button @click="tab = 'tab1'" :class="tab === 'tab1' ? 'border-b-2 border-theme-primary text-theme-primary font-bold' : 'text-slate-500'" class="pb-3 px-4 text-xs font-semibold">Informasi Umum</button>
                        <button @click="tab = 'tab2'" :class="tab === 'tab2' ? 'border-b-2 border-theme-primary text-theme-primary font-bold' : 'text-slate-500'" class="pb-3 px-4 text-xs font-semibold">Syarat & Ketentuan</button>
                        <button @click="tab = 'tab3'" :class="tab === 'tab3' ? 'border-b-2 border-theme-primary text-theme-primary font-bold' : 'text-slate-500'" class="pb-3 px-4 text-xs font-semibold">Unduh Dokumen</button>
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
                category: '4. Elementor Pro Widgets',
                media: '<i class="fa-solid fa-circle-question gjs-block-icon text-pink-400"></i>',
                content: `<div x-data="{ active: 1 }" class="space-y-3 my-6">
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
                category: '4. Elementor Pro Widgets',
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
                    <a href="/kontak" class="w-full py-3 rounded-xl bg-theme-primary text-white font-bold text-xs uppercase tracking-wider block shadow hover:opacity-90 transition">Daftar Sekarang</a>
                </div>`
            });

            bm.add('pro-countdown', {
                label: '⏳ Countdown Timer',
                category: '4. Elementor Pro Widgets',
                media: '<i class="fa-solid fa-clock-rotate-left gjs-block-icon text-pink-400"></i>',
                content: `<div class="p-8 rounded-2xl bg-slate-900 text-white text-center space-y-4 my-6 shadow-xl">
                    <span class="text-xs font-bold text-amber-400 uppercase tracking-wider">Hitung Mundur Penutupan PMB Gelombang I</span>
                    <div class="grid grid-cols-4 gap-3 max-w-md mx-auto">
                        <div class="p-3 bg-white/10 rounded-xl"><div class="text-2xl font-extrabold text-white">14</div><div class="text-[10px] text-slate-300 uppercase">Hari</div></div>
                        <div class="p-3 bg-white/10 rounded-xl"><div class="text-2xl font-extrabold text-white">08</div><div class="text-[10px] text-slate-300 uppercase">Jam</div></div>
                        <div class="p-3 bg-white/10 rounded-xl"><div class="text-2xl font-extrabold text-white">45</div><div class="text-[10px] text-slate-300 uppercase">Menit</div></div>
                        <div class="p-3 bg-white/10 rounded-xl"><div class="text-2xl font-extrabold text-white">20</div><div class="text-[10px] text-slate-300 uppercase">Detik</div></div>
                    </div>
                </div>`
            });

            bm.add('pro-testimonial', {
                label: '💬 Testimonial Ulasan',
                category: '4. Elementor Pro Widgets',
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

            bm.add('pro-progress-bar', {
                label: '📊 Progress Bar Capaian',
                category: '4. Elementor Pro Widgets',
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
                label: '📋 Checklist Keunggulan',
                category: '4. Elementor Pro Widgets',
                media: '<i class="fa-solid fa-list-check gjs-block-icon text-pink-400"></i>',
                content: `<ul class="space-y-2.5 text-xs sm:text-sm text-slate-700 my-4">
                    <li class="flex items-center space-x-2.5"><i class="fa-solid fa-circle-check text-emerald-500 text-sm"></i> <span>Terakreditasi Baik Sekali oleh LAM-PTKes</span></li>
                    <li class="flex items-center space-x-2.5"><i class="fa-solid fa-circle-check text-emerald-500 text-sm"></i> <span>Kerjasama Rumah Sakit & Klinik Internasional</span></li>
                    <li class="flex items-center space-x-2.5"><i class="fa-solid fa-circle-check text-emerald-500 text-sm"></i> <span>Beasiswa Prestasi & KIP-Kuliah Tersedia</span></li>
                </ul>`
            });

            bm.add('pro-form', {
                label: '📝 Form Pendaftaran PMB',
                category: '4. Elementor Pro Widgets',
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
                category: '4. Elementor Pro Widgets',
                media: '<i class="fa-solid fa-map-location-dot gjs-block-icon text-pink-400"></i>',
                content: `<div class="rounded-2xl overflow-hidden shadow-sm border border-slate-200 my-4 h-64"><iframe src="https://maps.google.com/maps?q=STIKES%20Panti%20Waluya%20Malang&t=&z=15&ie=UTF8&iwloc=&output=embed" width="100%" height="100%" frameborder="0" style="border:0;" allowfullscreen="" loading="lazy"></iframe></div>`
            });

            bm.add('pro-team-card', {
                label: '👨‍🏫 Profil Dosen & Tim',
                category: '4. Elementor Pro Widgets',
                media: '<i class="fa-solid fa-user-doctor gjs-block-icon text-pink-400"></i>',
                content: `<div class="p-6 bg-white rounded-2xl border border-slate-200 shadow-sm text-center space-y-3 my-4">
                    <img src="https://images.unsplash.com/photo-1559839734-2b71ea197ec2?w=200&h=200&fit=crop" class="w-20 h-20 rounded-full mx-auto object-cover border-2 border-theme-primary shadow">
                    <div>
                        <h4 class="text-sm font-extrabold text-slate-900">Dr. Ns. Maria Fransiska, M.Kep</h4>
                        <p class="text-xs text-theme-primary font-semibold">Ketua Program Studi Keperawatan</p>
                    </div>
                    <div class="flex justify-center space-x-2 text-slate-400 text-xs">
                        <a href="https://linkedin.com" target="_blank" class="p-1.5 hover:text-sky-600"><i class="fa-brands fa-linkedin"></i></a>
                        <a href="https://wa.me/" target="_blank" class="p-1.5 hover:text-emerald-600"><i class="fa-brands fa-whatsapp"></i></a>
                        <a href="mailto:info@pantiwaluya.ac.id" class="p-1.5 hover:text-rose-600"><i class="fa-solid fa-envelope"></i></a>
                    </div>
                </div>`
            });

            bm.add('pro-wa-cta', {
                label: '💬 WhatsApp Direct Chat',
                category: '4. Elementor Pro Widgets',
                media: '<i class="fa-brands fa-whatsapp gjs-block-icon text-emerald-400"></i>',
                content: `<div class="p-6 rounded-2xl bg-gradient-to-r from-emerald-600 to-teal-700 text-white flex flex-col sm:flex-row items-center justify-between gap-4 my-6 shadow-xl">
                    <div class="space-y-1 text-center sm:text-left">
                        <h3 class="text-base font-extrabold">Konsultasi Langsung via WhatsApp</h3>
                        <p class="text-xs text-emerald-100">Dapatkan respon cepat seputar PMB dan beasiswa kampus.</p>
                    </div>
                    <a href="https://wa.me/628123456789" target="_blank" class="px-5 py-2.5 rounded-xl bg-white text-emerald-700 font-extrabold text-xs shadow-lg hover:bg-emerald-50 transition flex items-center space-x-2 shrink-0">
                        <i class="fa-brands fa-whatsapp text-sm"></i> <span>Hubungi Sekarang</span>
                    </a>
                </div>`
            });

            bm.add('pro-posts-grid', {
                label: '📰 Posts & Berita Grid',
                category: '4. Elementor Pro Widgets',
                media: '<i class="fa-solid fa-newspaper gjs-block-icon text-pink-400"></i>',
                content: `<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 my-4">
                    <div class="flex items-center justify-between mb-8">
                        <div>
                            <span class="text-xs font-bold text-theme-primary uppercase tracking-wider">Kabar Terkini</span>
                            <h3 class="text-2xl font-extrabold text-slate-900">Berita & Informasi Akademik</h3>
                        </div>
                        <a href="/berita" class="text-xs font-bold text-theme-primary hover:underline">Lihat Semua Berita ➔</a>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <article class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm hover:shadow-lg transition group">
                            <div class="h-44 overflow-hidden relative">
                                <img src="https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?w=600&auto=format&fit=crop" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                                <span class="absolute top-3 left-3 px-2 py-0.5 rounded-full bg-theme-primary text-white text-[9px] font-bold uppercase">Akademik</span>
                            </div>
                            <div class="p-5 space-y-2">
                                <div class="text-[11px] text-slate-400 font-semibold"><i class="fa-regular fa-calendar mr-1"></i> 20 Oktober 2026</div>
                                <h4 class="text-sm font-extrabold text-slate-900 line-clamp-2 group-hover:text-theme-primary transition">Pelaksanaan Yudisium dan Pelantikan Profesi Ners Angkatan XVIII</h4>
                                <p class="text-xs text-slate-500 line-clamp-2">Sebanyak 65 mahasiswa profesi Ners resmi dilantik dengan tingkat kelulusan ukom 100%.</p>
                                <a href="/berita" class="inline-block pt-2 text-xs font-bold text-theme-primary">Baca Selengkapnya ➔</a>
                            </div>
                        </article>
                        <article class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm hover:shadow-lg transition group">
                            <div class="h-44 overflow-hidden relative">
                                <img src="https://images.unsplash.com/photo-1584515979956-d9f6e5d09982?w=600&auto=format&fit=crop" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                                <span class="absolute top-3 left-3 px-2 py-0.5 rounded-full bg-emerald-600 text-white text-[9px] font-bold uppercase">Kerjasama</span>
                            </div>
                            <div class="p-5 space-y-2">
                                <div class="text-[11px] text-slate-400 font-semibold"><i class="fa-regular fa-calendar mr-1"></i> 15 Oktober 2026</div>
                                <h4 class="text-sm font-extrabold text-slate-900 line-clamp-2 group-hover:text-theme-primary transition">Penandatanganan MoU Penempatan Kerja Medis di Rumah Sakit Jepang</h4>
                                <p class="text-xs text-slate-500 line-clamp-2">Membuka kesempatan karir global untuk lulusan tenaga keperawatan berlisensi.</p>
                                <a href="/berita" class="inline-block pt-2 text-xs font-bold text-theme-primary">Baca Selengkapnya ➔</a>
                            </div>
                        </article>
                        <article class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm hover:shadow-lg transition group">
                            <div class="h-44 overflow-hidden relative">
                                <img src="https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?w=600&auto=format&fit=crop" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                                <span class="absolute top-3 left-3 px-2 py-0.5 rounded-full bg-purple-600 text-white text-[9px] font-bold uppercase">PMB 2026</span>
                            </div>
                            <div class="p-5 space-y-2">
                                <div class="text-[11px] text-slate-400 font-semibold"><i class="fa-regular fa-calendar mr-1"></i> 10 Oktober 2026</div>
                                <h4 class="text-sm font-extrabold text-slate-900 line-clamp-2 group-hover:text-theme-primary transition">Pembukaan Jalur Bebas Tes dan Beasiswa Prestasi Gelombang I</h4>
                                <p class="text-xs text-slate-500 line-clamp-2">Dapatkan potongan DPP 50% untuk pendaftaran awal mahasiswa baru.</p>
                                <a href="/berita" class="inline-block pt-2 text-xs font-bold text-theme-primary">Baca Selengkapnya ➔</a>
                            </div>
                        </article>
                    </div>
                </div>`
            });

            bm.add('pro-nav-menu', {
                label: '🧭 Nav Menu Bar',
                category: '4. Elementor Pro Widgets',
                media: '<i class="fa-solid fa-bars-staggered gjs-block-icon text-pink-400"></i>',
                content: `<nav class="bg-white border-b border-slate-200 px-4 sm:px-8 py-3 my-4 shadow-sm">
                    <div class="max-w-7xl mx-auto flex items-center justify-between">
                        <a href="/" class="flex items-center space-x-3">
                            <div class="w-9 h-9 rounded-xl bg-theme-primary text-white font-extrabold flex items-center justify-center text-sm shadow">ST</div>
                            <div>
                                <div class="font-extrabold text-xs sm:text-sm text-slate-900 leading-tight">STIKES PANTI WALUYA</div>
                                <div class="text-[10px] text-slate-500">Divisi Pelayanan & Informasi</div>
                            </div>
                        </a>
                        <div class="hidden md:flex items-center space-x-6 text-xs font-bold text-slate-600">
                            <a href="/" class="text-theme-primary">Beranda</a>
                            <a href="/profil" class="hover:text-theme-primary transition">Profil</a>
                            <a href="/layanan" class="hover:text-theme-primary transition">Layanan</a>
                            <a href="/dokumen" class="hover:text-theme-primary transition">Dokumen</a>
                            <a href="/berita" class="hover:text-theme-primary transition">Berita</a>
                            <a href="/kontak" class="hover:text-theme-primary transition">Kontak</a>
                        </div>
                        <div class="flex items-center space-x-3">
                            <a href="/kontak" class="px-4 py-2 rounded-xl bg-theme-primary hover:bg-theme-secondary text-white font-bold text-xs uppercase tracking-wider shadow">PMB Online</a>
                        </div>
                    </div>
                </nav>`
            });

            bm.add('pro-hotspot', {
                label: '📍 Image Hotspot Lab',
                category: '4. Elementor Pro Widgets',
                media: '<i class="fa-solid fa-location-crosshairs gjs-block-icon text-pink-400"></i>',
                content: `<div class="max-w-4xl mx-auto my-8 relative rounded-3xl overflow-hidden shadow-2xl border border-slate-200">
                    <img src="https://images.unsplash.com/photo-1584515979956-d9f6e5d09982?w=1200&auto=format&fit=crop&q=80" alt="Lab Medis" class="w-full h-[400px] object-cover">
                    <div class="absolute inset-0 bg-black/20"></div>
                    <div class="absolute top-1/3 left-1/4 group cursor-pointer">
                        <div class="w-6 h-6 rounded-full bg-pink-500 text-white flex items-center justify-center text-xs font-black shadow-lg animate-pulse border-2 border-white">1</div>
                        <div class="opacity-0 group-hover:opacity-100 transition absolute bottom-8 left-1/2 -translate-x-1/2 w-48 p-2.5 bg-slate-900/95 text-white rounded-xl text-center shadow-xl border border-white/10 pointer-events-none">
                            <div class="font-extrabold text-[11px] text-pink-400">Simulator Pasien ICU</div>
                            <div class="text-[9px] text-slate-300 mt-0.5">Mendeteksi tanda vital dan reaksi farmakologis secara akurat.</div>
                        </div>
                    </div>
                    <div class="absolute top-1/2 right-1/3 group cursor-pointer">
                        <div class="w-6 h-6 rounded-full bg-cyan-500 text-white flex items-center justify-center text-xs font-black shadow-lg animate-pulse border-2 border-white">2</div>
                        <div class="opacity-0 group-hover:opacity-100 transition absolute bottom-8 left-1/2 -translate-x-1/2 w-48 p-2.5 bg-slate-900/95 text-white rounded-xl text-center shadow-xl border border-white/10 pointer-events-none">
                            <div class="font-extrabold text-[11px] text-cyan-400">Ventilator Medis Standar RS</div>
                            <div class="text-[9px] text-slate-300 mt-0.5">Praktik terapi respirasi bantuan napas mekanik untuk mahasiswa ners.</div>
                        </div>
                    </div>
                </div>`
            });

            bm.add('pro-toc', {
                label: '📑 Table of Contents',
                category: '4. Elementor Pro Widgets',
                media: '<i class="fa-solid fa-list-ul gjs-block-icon text-pink-400"></i>',
                content: `<div class="p-6 bg-slate-50 rounded-2xl border border-slate-200 shadow-sm max-w-md mx-auto my-6 space-y-3">
                    <div class="flex items-center justify-between border-b border-slate-200 pb-2">
                        <h4 class="text-xs font-bold text-slate-800 uppercase tracking-wider flex items-center">
                            <i class="fa-solid fa-list-ul text-theme-primary mr-2"></i> Daftar Isi Halaman
                        </h4>
                        <span class="text-[10px] text-slate-400 font-semibold">4 Topik</span>
                    </div>
                    <ul class="space-y-2 text-xs font-semibold text-slate-600">
                        <li><a href="#ringkasan" class="hover:text-theme-primary flex items-center"><i class="fa-solid fa-angle-right text-[10px] text-slate-400 mr-2"></i> 1. Ringkasan & Latar Belakang</a></li>
                        <li><a href="#kurikulum" class="hover:text-theme-primary flex items-center"><i class="fa-solid fa-angle-right text-[10px] text-slate-400 mr-2"></i> 2. Kurikulum & Beban Studi SKS</a></li>
                        <li><a href="#fasilitas" class="hover:text-theme-primary flex items-center"><i class="fa-solid fa-angle-right text-[10px] text-slate-400 mr-2"></i> 3. Fasilitas & Laboratorium Praktik</a></li>
                        <li><a href="#prospek" class="hover:text-theme-primary flex items-center"><i class="fa-solid fa-angle-right text-[10px] text-slate-400 mr-2"></i> 4. Prospek Kerja & Sertifikasi Ukom</a></li>
                    </ul>
                </div>`
            });

            bm.add('pro-login', {
                label: '🔑 Login Portal Sivitas',
                category: '4. Elementor Pro Widgets',
                media: '<i class="fa-solid fa-user-lock gjs-block-icon text-pink-400"></i>',
                content: `<div class="max-w-md mx-auto p-8 bg-white rounded-3xl border border-slate-200 shadow-xl space-y-5 my-8">
                    <div class="text-center space-y-1">
                        <div class="w-12 h-12 rounded-2xl bg-theme-primary text-white flex items-center justify-center text-xl mx-auto shadow"><i class="fa-solid fa-user-lock"></i></div>
                        <h3 class="text-lg font-extrabold text-slate-900 pt-1">Portal Login Sivitas</h3>
                        <p class="text-xs text-slate-500">Masuk untuk mengakses data akademik dan layanan kampus</p>
                    </div>
                    <form class="space-y-3.5">
                        <div>
                            <label class="block text-[11px] font-bold text-slate-700 mb-1">NIM / NIDN / Email</label>
                            <input type="text" placeholder="Masukkan NIM atau email..." class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-slate-200 focus:outline-none focus:border-theme-primary">
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold text-slate-700 mb-1">Password Akun</label>
                            <input type="password" placeholder="••••••••" class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-slate-200 focus:outline-none focus:border-theme-primary">
                        </div>
                        <div class="flex items-center justify-between text-[11px]">
                            <label class="flex items-center text-slate-600"><input type="checkbox" class="mr-1.5 rounded"> Ingat saya</label>
                            <a href="#" class="text-theme-primary font-bold hover:underline">Lupa Password?</a>
                        </div>
                        <button type="button" class="w-full py-3 rounded-xl bg-theme-primary hover:bg-theme-secondary text-white font-extrabold text-xs uppercase tracking-wider shadow-lg transition">Masuk ke Portal</button>
                    </form>
                </div>`
            });

            bm.add('pro-paypal-button', {
                label: '💳 Pembayaran PMB Online',
                category: '4. Elementor Pro Widgets',
                media: '<i class="fa-solid fa-credit-card gjs-block-icon text-pink-400"></i>',
                content: `<div class="max-w-sm mx-auto p-6 bg-slate-900 text-white rounded-3xl border border-slate-800 shadow-xl text-center space-y-4 my-6">
                    <div class="w-12 h-12 rounded-2xl bg-emerald-500/20 text-emerald-400 border border-emerald-500/30 flex items-center justify-center text-xl mx-auto"><i class="fa-solid fa-credit-card"></i></div>
                    <div>
                        <h4 class="text-sm font-extrabold">Pembayaran Online Biaya PMB</h4>
                        <p class="text-xs text-slate-400">Pembayaran terverifikasi otomatis 24 Jam via VA, QRIS, & Kartu Debit</p>
                    </div>
                    <div class="p-3 bg-white/5 rounded-xl border border-white/10 text-xs text-slate-300 flex justify-between font-mono">
                        <span>Total Tagihan:</span>
                        <span class="font-bold text-emerald-400">Rp 250.000</span>
                    </div>
                    <a href="/kontak" class="block w-full py-3 rounded-xl bg-emerald-500 hover:bg-emerald-400 text-slate-950 font-black text-xs uppercase tracking-wider shadow-lg transition">
                        Bayar Sekarang (Checkout)
                    </a>
                </div>`
            });

            bm.add('pro-code-highlight', {
                label: '💻 Code Highlight Box',
                category: '4. Elementor Pro Widgets',
                media: '<i class="fa-solid fa-code gjs-block-icon text-pink-400"></i>',
                content: `<div class="max-w-2xl mx-auto bg-slate-950 text-slate-100 rounded-2xl border border-slate-800 overflow-hidden my-6 shadow-xl font-mono text-xs">
                    <div class="px-4 py-2 bg-slate-900 border-b border-slate-800 flex items-center justify-between">
                        <div class="flex items-center space-x-2">
                            <span class="w-3 h-3 rounded-full bg-rose-500 inline-block"></span>
                            <span class="w-3 h-3 rounded-full bg-amber-500 inline-block"></span>
                            <span class="w-3 h-3 rounded-full bg-emerald-500 inline-block"></span>
                            <span class="text-[11px] text-slate-400 ml-2">api-endpoint.json</span>
                        </div>
                        <span class="text-[10px] text-slate-500 uppercase">JSON / REST</span>
                    </div>
                    <pre class="p-4 overflow-x-auto text-[11px] leading-relaxed text-emerald-400"><code>{
  "institution": "STIKES Panti Waluya Malang",
  "status": "Accredited Grade A",
  "admission_cycle": "2026/2027",
  "api_status": "ONLINE_ACTIVE"
}</code></pre>
                </div>`
            });

            bm.add('pro-breadcrumbs', {
                label: '🧭 Breadcrumbs Jalur',
                category: '4. Elementor Pro Widgets',
                media: '<i class="fa-solid fa-angles-right gjs-block-icon text-pink-400"></i>',
                content: `<div class="py-3 px-4 bg-slate-50 border-y border-slate-200 my-4 text-xs font-semibold text-slate-500">
                    <div class="max-w-7xl mx-auto flex items-center space-x-2">
                        <a href="/" class="hover:text-theme-primary"><i class="fa-solid fa-house text-slate-400 mr-1"></i> Beranda</a>
                        <i class="fa-solid fa-angle-right text-[10px] text-slate-300"></i>
                        <a href="/layanan" class="hover:text-theme-primary">Program Studi</a>
                        <i class="fa-solid fa-angle-right text-[10px] text-slate-300"></i>
                        <span class="text-theme-primary font-bold">Sarjana Keperawatan & Profesi Ners</span>
                    </div>
                </div>`
            });

            bm.add('pro-search-bar', {
                label: '🔍 Search Bar Form',
                category: '4. Elementor Pro Widgets',
                media: '<i class="fa-solid fa-magnifying-glass gjs-block-icon text-pink-400"></i>',
                content: `<div class="max-w-xl mx-auto my-6">
                    <form class="relative flex items-center">
                        <i class="fa-solid fa-magnifying-glass absolute left-4 text-slate-400 text-sm"></i>
                        <input type="text" placeholder="Cari informasi layanan, berkas, atau jadwal kuliah..." class="w-full bg-white border border-slate-300 rounded-2xl pl-11 pr-28 py-3.5 text-xs text-slate-900 shadow-sm focus:outline-none focus:border-theme-primary">
                        <button type="submit" class="absolute right-2 px-5 py-2 rounded-xl bg-theme-primary text-white font-bold text-xs uppercase tracking-wider shadow">Cari</button>
                    </form>
                </div>`
            });

            // --- 5. PRESET KAMPUS STIKES ---
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
                            <a href="#fasilitas" class="px-6 py-3 rounded-xl bg-white text-slate-900 font-bold text-sm shadow-xl hover:bg-slate-100 transition">Mulai Jelajahi</a>
                            <a href="/kontak" class="px-6 py-3 rounded-xl bg-white/20 text-white font-bold text-sm border border-white/30 hover:bg-white/30 transition">Hubungi Kami</a>
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
                                    <a href="/profil" class="px-6 py-2.5 rounded-xl bg-theme-primary text-white font-bold text-xs uppercase tracking-wider shadow">Pelajari Profil Lengkap</a>
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

            // ==========================================
            // LIVE WIDGET SEARCH ENGINE
            // ==========================================
            const widgetSearchInput = document.getElementById('widget-search-input');
            const widgetSearchClear = document.getElementById('widget-search-clear');

            function filterWidgets(query) {
                query = query.toLowerCase().trim();
                const blocks = document.querySelectorAll('#blocks-container .gjs-block');
                const categories = document.querySelectorAll('#blocks-container .gjs-block-category');

                if (!query) {
                    blocks.forEach(b => b.style.display = '');
                    categories.forEach(c => c.style.display = '');
                    widgetSearchClear.classList.add('hidden');
                    return;
                }

                widgetSearchClear.classList.remove('hidden');

                categories.forEach(cat => {
                    let hasVisibleBlock = false;
                    const catBlocks = cat.querySelectorAll('.gjs-block');
                    catBlocks.forEach(b => {
                        const text = b.innerText.toLowerCase();
                        if (text.includes(query)) {
                            b.style.display = '';
                            hasVisibleBlock = true;
                        } else {
                            b.style.display = 'none';
                        }
                    });
                    cat.style.display = hasVisibleBlock ? '' : 'none';
                });
            }

            widgetSearchInput.addEventListener('input', (e) => filterWidgets(e.target.value));
            widgetSearchClear.addEventListener('click', () => {
                widgetSearchInput.value = '';
                filterWidgets('');
                widgetSearchInput.focus();
            });

            // ==========================================
            // SIDEBAR MODE SWITCHER (WIDGETS VS INSPECTOR)
            // ==========================================
            const panelWidgetsView = document.getElementById('panel-widgets-view');
            const panelInspectorView = document.getElementById('panel-inspector-view');
            const sidebarModeTitle = document.getElementById('sidebar-mode-title');
            const btnNavElements = document.getElementById('btn-nav-elements');
            const tabNavWidgets = document.getElementById('tab-nav-widgets');
            const tabNavInspector = document.getElementById('tab-nav-inspector');

            function showWidgetsMode() {
                panelWidgetsView.classList.remove('hidden');
                panelInspectorView.classList.add('hidden');
                sidebarModeTitle.innerText = 'ELEMENTS';
                tabNavWidgets.classList.add('bg-[#d63384]', 'text-white');
                tabNavWidgets.classList.remove('text-gray-400');
                tabNavInspector.classList.remove('bg-[#d63384]', 'text-white');
                tabNavInspector.classList.add('text-gray-400');
            }

            function showInspectorMode() {
                panelWidgetsView.classList.add('hidden');
                panelInspectorView.classList.remove('hidden');
                sidebarModeTitle.innerText = 'EDIT ELEMENT';
                tabNavInspector.classList.add('bg-[#d63384]', 'text-white');
                tabNavInspector.classList.remove('text-gray-400');
                tabNavWidgets.classList.remove('bg-[#d63384]', 'text-white');
                tabNavWidgets.classList.add('text-gray-400');
            }

            btnNavElements.addEventListener('click', showWidgetsMode);
            tabNavWidgets.addEventListener('click', showWidgetsMode);
            tabNavInspector.addEventListener('click', showInspectorMode);

            // ==========================================
            // ELEMENTOR PRO: DYNAMIC PHOTO & CAROUSEL INSPECTOR
            // ==========================================
            function renderPhotoChooser(imgModel, container) {
                const src = imgModel.getAttributes().src || 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?w=800&auto=format&fit=crop&q=80';
                const alt = imgModel.getAttributes().alt || '';

                container.innerHTML = `
                    <div class="bg-[#17191d] p-3.5 rounded-2xl border border-[#333842] space-y-3 shadow-md">
                        <div class="flex items-center justify-between">
                            <h4 class="text-xs font-bold text-gray-200 uppercase tracking-wider flex items-center">
                                <i class="fa-solid fa-image text-pink-400 mr-2 text-sm"></i> Menu Pilih Foto
                            </h4>
                            <span class="px-1.5 py-0.5 rounded bg-pink-500/20 text-pink-300 border border-pink-400/30 text-[9px] font-black uppercase">MEDIA</span>
                        </div>
                        
                        <div class="w-full h-36 rounded-xl bg-[#121417] border border-[#2d323c] overflow-hidden flex items-center justify-center relative group">
                            <img id="insp-img-preview" src="${src}" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition flex items-center justify-center">
                                <span class="text-[11px] font-bold text-white bg-black/60 px-3 py-1 rounded-lg">Klik Tombol di Bawah</span>
                            </div>
                        </div>

                        <button id="btn-insp-choose-image" type="button" class="w-full py-2.5 rounded-xl bg-gradient-to-r from-[#92003b] to-[#d63384] hover:opacity-90 text-white font-extrabold text-xs transition flex items-center justify-center space-x-2 shadow-lg">
                            <i class="fa-solid fa-photo-film text-sm"></i>
                            <span>Pilih Foto dari Media Library / Upload</span>
                        </button>

                        <div>
                            <label class="block text-[11px] font-semibold text-gray-400 mb-1">URL Foto Langsung</label>
                            <input type="text" id="insp-img-url-input" value="${src}" class="w-full bg-[#121417] border border-[#333842] rounded-lg px-2.5 py-1.5 text-xs text-white focus:outline-none focus:border-[#d63384]">
                        </div>

                        <div>
                            <label class="block text-[11px] font-semibold text-gray-400 mb-1">Alt Teks (Deskripsi Gambar)</label>
                            <input type="text" id="insp-img-alt-input" value="${alt}" placeholder="Deskripsi foto..." class="w-full bg-[#121417] border border-[#333842] rounded-lg px-2.5 py-1.5 text-xs text-white focus:outline-none focus:border-[#d63384]">
                        </div>
                    </div>
                `;

                container.classList.remove('hidden');

                const btnChoose = container.querySelector('#btn-insp-choose-image');
                const inputUrl = container.querySelector('#insp-img-url-input');
                const inputAlt = container.querySelector('#insp-img-alt-input');
                const imgPreview = container.querySelector('#insp-img-preview');

                btnChoose.addEventListener('click', () => {
                    editor.AssetManager.open({
                        select(asset, complete) {
                            const newSrc = asset.get('src') || asset.getSrc();
                            imgModel.addAttributes({ src: newSrc });
                            imgPreview.src = newSrc;
                            inputUrl.value = newSrc;
                            editor.AssetManager.close();
                            showToast('Foto berhasil diganti!');
                        }
                    });
                });

                inputUrl.addEventListener('input', (e) => {
                    const val = e.target.value.trim();
                    imgModel.addAttributes({ src: val });
                    imgPreview.src = val;
                });

                inputAlt.addEventListener('input', (e) => {
                    imgModel.addAttributes({ alt: e.target.value });
                });
            }

            function renderCarouselManager(carouselComp, container) {
                let slides = carouselComp.find('.carousel-slide');
                if (slides.length === 0) {
                    slides = carouselComp.find('img');
                }

                let slidesHtml = '';
                slides.forEach((slide, idx) => {
                    let img = (slide.is('image') || slide.get('tagName') === 'img') ? slide : (slide.find('img')[0] || null);
                    let imgSrc = img ? (img.getAttributes().src || 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?w=600&auto=format&fit=crop&q=80') : 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?w=600&auto=format&fit=crop&q=80';

                    slidesHtml += `
                        <div class="bg-[#17191d] p-3 rounded-xl border border-[#333842] space-y-2.5 hover:border-pink-500/40 transition">
                            <div class="flex items-center justify-between">
                                <span class="text-xs font-bold text-white flex items-center">
                                    <i class="fa-solid fa-film text-pink-400 mr-2 text-xs"></i> Slide #${idx + 1}
                                </span>
                                <button type="button" class="btn-activate-carousel-slide px-2.5 py-1 rounded-md bg-[#282d36] hover:bg-theme-primary text-gray-300 hover:text-white text-[10px] font-bold transition flex items-center space-x-1" data-index="${idx}">
                                    <i class="fa-solid fa-eye text-[9px]"></i> <span>Lihat di Kanvas</span>
                                </button>
                            </div>
                            <div class="flex items-center space-x-3">
                                <img src="${imgSrc}" class="w-16 h-12 rounded-lg object-cover border border-[#333842] shrink-0">
                                <div class="flex-1 space-y-1">
                                    <button type="button" class="btn-choose-carousel-slide-photo w-full py-1.5 rounded-lg bg-gradient-to-r from-[#92003b] to-[#d63384] hover:opacity-90 text-white text-[11px] font-bold shadow flex items-center justify-center space-x-1.5" data-index="${idx}">
                                        <i class="fa-solid fa-photo-film text-[10px]"></i>
                                        <span>Pilih Foto Slide #${idx + 1}</span>
                                    </button>
                                    <input type="text" class="input-carousel-slide-url w-full bg-[#121417] border border-[#333842] rounded px-2 py-1 text-[10px] text-gray-300 focus:outline-none focus:border-[#d63384]" data-index="${idx}" value="${imgSrc}" placeholder="URL Foto...">
                                </div>
                            </div>
                        </div>
                    `;
                });

                container.innerHTML = `
                    <div class="bg-[#202328] p-3.5 rounded-2xl border border-pink-500/40 space-y-3 shadow-lg">
                        <div class="flex items-center justify-between border-b border-[#333842] pb-2.5">
                            <div>
                                <h4 class="text-xs font-extrabold text-white tracking-wider flex items-center">
                                    <i class="fa-solid fa-images text-[#d63384] mr-2"></i> PILIH FOTO CAROUSEL
                                </h4>
                                <p class="text-[10px] text-gray-400">Pilih atau ganti gambar untuk setiap slide di bawah:</p>
                            </div>
                            <span class="px-1.5 py-0.5 rounded bg-pink-500/20 text-pink-300 border border-pink-400/30 text-[9px] font-black uppercase">PRO</span>
                        </div>

                        <div class="space-y-2.5 max-h-80 overflow-y-auto">
                            ${slidesHtml}
                        </div>
                    </div>
                `;

                container.classList.remove('hidden');

                container.querySelectorAll('.btn-choose-carousel-slide-photo').forEach(btn => {
                    btn.addEventListener('click', function(e) {
                        e.stopPropagation();
                        const idx = parseInt(this.getAttribute('data-index'));
                        const targetSlide = slides[idx];
                        if (!targetSlide) return;

                        let img = (targetSlide.is('image') || targetSlide.get('tagName') === 'img') ? targetSlide : (targetSlide.find('img')[0] || null);

                        editor.AssetManager.open({
                            select(asset, complete) {
                                const newSrc = asset.get('src') || asset.getSrc();
                                if (img) {
                                    img.addAttributes({ src: newSrc });
                                }
                                editor.AssetManager.close();
                                showToast(`Foto Slide #${idx + 1} berhasil diganti!`);
                                renderCarouselManager(carouselComp, container);
                            }
                        });
                    });
                });

                container.querySelectorAll('.input-carousel-slide-url').forEach(input => {
                    input.addEventListener('change', function() {
                        const idx = parseInt(this.getAttribute('data-index'));
                        const targetSlide = slides[idx];
                        if (!targetSlide) return;
                        let img = (targetSlide.is('image') || targetSlide.get('tagName') === 'img') ? targetSlide : (targetSlide.find('img')[0] || null);
                        if (img) {
                            img.addAttributes({ src: this.value.trim() });
                            showToast(`URL Foto Slide #${idx + 1} diperbarui!`);
                            renderCarouselManager(carouselComp, container);
                        }
                    });
                });

                container.querySelectorAll('.btn-activate-carousel-slide').forEach(btn => {
                    btn.addEventListener('click', function() {
                        const idx = parseInt(this.getAttribute('data-index'));
                        slides.forEach((s, sIdx) => {
                            const sEl = s.getEl();
                            if (sEl) {
                                if (sIdx === idx) {
                                    sEl.style.display = '';
                                } else {
                                    sEl.style.display = 'none';
                                }
                            }
                        });
                        showToast(`Menampilkan Slide #${idx + 1} di kanvas.`);
                    });
                });
            }

            // Auto-switch to Inspector on component selection
            editor.on('component:selected', (model) => {
                if (!model) return;
                showInspectorMode();
                document.getElementById('traits-empty-hint').classList.add('hidden');

                const photoManagerEl = document.getElementById('inspector-photo-manager');
                const carouselManagerEl = document.getElementById('inspector-carousel-manager');
                if (photoManagerEl) {
                    photoManagerEl.classList.add('hidden');
                    photoManagerEl.innerHTML = '';
                }
                if (carouselManagerEl) {
                    carouselManagerEl.classList.add('hidden');
                    carouselManagerEl.innerHTML = '';
                }

                const tagName = (model.get('tagName') || '').toLowerCase();

                // 1. Check if model is an IMG tag or has an IMG child
                if (tagName === 'img' || model.is('image')) {
                    if (photoManagerEl) renderPhotoChooser(model, photoManagerEl);
                } else {
                    const imgChildren = model.find('img');
                    if (imgChildren.length === 1 && photoManagerEl) {
                        renderPhotoChooser(imgChildren[0], photoManagerEl);
                    }
                }

                // 2. Check if model is a Carousel or inside a Carousel
                let carouselComp = null;
                let curr = model;
                while (curr) {
                    const cAttrs = curr.getAttributes() || {};
                    if (cAttrs['data-elementor-type'] === 'carousel' || cAttrs['data-carousel'] || curr.find('.carousel-slide').length > 0 || (cAttrs['x-data'] && cAttrs['x-data'].includes('active') && cAttrs['x-data'].includes('total'))) {
                        carouselComp = curr;
                        break;
                    }
                    curr = curr.parent();
                }

                if (carouselComp && carouselManagerEl) {
                    renderCarouselManager(carouselComp, carouselManagerEl);
                }
            });

            editor.on('component:deselected', () => {
                const photoManagerEl = document.getElementById('inspector-photo-manager');
                const carouselManagerEl = document.getElementById('inspector-carousel-manager');
                if (photoManagerEl) {
                    photoManagerEl.classList.add('hidden');
                    photoManagerEl.innerHTML = '';
                }
                if (carouselManagerEl) {
                    carouselManagerEl.classList.add('hidden');
                    carouselManagerEl.innerHTML = '';
                }
                document.getElementById('traits-empty-hint').classList.remove('hidden');
            });

            // ==========================================
            // INSPECTOR INNER TABS (KONTEN / GAYA / LANJUTAN)
            // ==========================================
            const tabInspContent = document.getElementById('tab-insp-content');
            const tabInspStyle = document.getElementById('tab-insp-style');
            const tabInspAdv = document.getElementById('tab-insp-advanced');

            const inspContentPanel = document.getElementById('inspector-content-panel');
            const inspStylePanel = document.getElementById('inspector-style-panel');
            const inspAdvPanel = document.getElementById('inspector-advanced-panel');

            function resetInspTabs() {
                [tabInspContent, tabInspStyle, tabInspAdv].forEach(t => {
                    t.classList.remove('border-[#d63384]', 'text-[#d63384]');
                    t.classList.add('border-transparent', 'text-gray-400');
                });
                inspContentPanel.classList.add('hidden');
                inspStylePanel.classList.add('hidden');
                inspAdvPanel.classList.add('hidden');
            }

            tabInspContent.addEventListener('click', () => {
                resetInspTabs();
                tabInspContent.classList.add('border-[#d63384]', 'text-[#d63384]');
                tabInspContent.classList.remove('border-transparent', 'text-gray-400');
                inspContentPanel.classList.remove('hidden');
            });

            tabInspStyle.addEventListener('click', () => {
                resetInspTabs();
                tabInspStyle.classList.add('border-[#d63384]', 'text-[#d63384]');
                tabInspStyle.classList.remove('border-transparent', 'text-gray-400');
                inspStylePanel.classList.remove('hidden');
            });

            tabInspAdv.addEventListener('click', () => {
                resetInspTabs();
                tabInspAdv.classList.add('border-[#d63384]', 'text-[#d63384]');
                tabInspAdv.classList.remove('border-transparent', 'text-gray-400');
                inspAdvPanel.classList.remove('hidden');
            });

            // ==========================================
            // TEMPLATE LIBRARY MODAL DATA & HANDLERS
            // ==========================================
            const templatesData = [
                {
                    id: 'tpl-carousel-banner-slider',
                    name: 'Hero Banner Slider / Carousel (3 Slide Medis)',
                    category: 'carousel',
                    tag: 'SLIDER PRO',
                    image: 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?w=600&auto=format&fit=crop&q=80',
                    content: `<div x-data="{ active: 0, total: 3 }" data-elementor-type="carousel" class="relative w-full h-[480px] overflow-hidden bg-slate-900 group my-6 rounded-3xl shadow-2xl">
                        <!-- Slide 1 -->
                        <div x-show="active === 0" class="carousel-slide absolute inset-0 transition-opacity duration-700">
                            <img src="https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?w=1600&auto=format&fit=crop&q=80" alt="Slide 1" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-r from-slate-950/90 via-slate-900/70 to-transparent flex items-center">
                                <div class="max-w-2xl px-8 sm:px-16 text-white space-y-4">
                                    <span class="inline-block px-3 py-1 rounded-full bg-theme-primary text-cyan-200 text-xs font-bold uppercase tracking-wider shadow">AKREDITASI BAIK SEKALI</span>
                                    <h2 class="text-3xl sm:text-5xl font-black leading-tight">Pusat Keunggulan Pendidikan Keperawatan & Medis</h2>
                                    <p class="text-sm sm:text-base text-slate-200 font-normal leading-relaxed">Mencetak tenaga medis kompeten, beretika tinggi, dan siap diserap di rumah sakit nasional maupun internasional.</p>
                                    <div class="pt-2">
                                        <a href="/kontak" class="inline-flex items-center px-6 py-3 rounded-xl bg-theme-primary hover:bg-theme-secondary text-white font-bold text-xs uppercase tracking-wider shadow-xl transition transform hover:-translate-y-0.5">
                                            <span>Daftar Online PMB</span> <i class="fa-solid fa-arrow-right ml-2 text-xs"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Slide 2 -->
                        <div x-show="active === 1" style="display: none;" class="carousel-slide absolute inset-0 transition-opacity duration-700">
                            <img src="https://images.unsplash.com/photo-1584515979956-d9f6e5d09982?w=1600&auto=format&fit=crop&q=80" alt="Slide 2" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-r from-slate-950/90 via-slate-900/70 to-transparent flex items-center">
                                <div class="max-w-2xl px-8 sm:px-16 text-white space-y-4">
                                    <span class="inline-block px-3 py-1 rounded-full bg-theme-primary text-cyan-200 text-xs font-bold uppercase tracking-wider shadow">FASILITAS MODERN</span>
                                    <h2 class="text-3xl sm:text-5xl font-black leading-tight">Fasilitas Laboratorium Medis & Rumah Sakit Simulasi</h2>
                                    <p class="text-sm sm:text-base text-slate-200 font-normal leading-relaxed">Didukung peralatan modern terstandar medis untuk simulasi tindakan gawat darurat dan keperawatan kritis.</p>
                                    <div class="pt-2">
                                        <a href="/layanan" class="inline-flex items-center px-6 py-3 rounded-xl bg-theme-primary hover:bg-theme-secondary text-white font-bold text-xs uppercase tracking-wider shadow-xl transition transform hover:-translate-y-0.5">
                                            <span>Jelajahi Lab Medis</span> <i class="fa-solid fa-arrow-right ml-2 text-xs"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Slide 3 -->
                        <div x-show="active === 2" style="display: none;" class="carousel-slide absolute inset-0 transition-opacity duration-700">
                            <img src="https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?w=1600&auto=format&fit=crop&q=80" alt="Slide 3" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-r from-slate-950/90 via-slate-900/70 to-transparent flex items-center">
                                <div class="max-w-2xl px-8 sm:px-16 text-white space-y-4">
                                    <span class="inline-block px-3 py-1 rounded-full bg-theme-primary text-cyan-200 text-xs font-bold uppercase tracking-wider shadow">BEASISWA & KERJASAMA</span>
                                    <h2 class="text-3xl sm:text-5xl font-black leading-tight">Beasiswa Prestasi & Program Penempatan Kerja Cepat</h2>
                                    <p class="text-sm sm:text-base text-slate-200 font-normal leading-relaxed">Dukungan karir penuh melalui jejaring puluhan rumah sakit terkemuka mitra resmi Yayasan Panti Waluya.</p>
                                    <div class="pt-2">
                                        <a href="/profil" class="inline-flex items-center px-6 py-3 rounded-xl bg-theme-primary hover:bg-theme-secondary text-white font-bold text-xs uppercase tracking-wider shadow-xl transition transform hover:-translate-y-0.5">
                                            <span>Informasi Beasiswa</span> <i class="fa-solid fa-arrow-right ml-2 text-xs"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button @click="active = (active - 1 + total) % total" class="absolute left-4 top-1/2 -translate-y-1/2 w-11 h-11 rounded-full bg-black/40 hover:bg-black/70 text-white flex items-center justify-center transition border border-white/20 shadow-xl">
                            <i class="fa-solid fa-chevron-left text-sm"></i>
                        </button>
                        <button @click="active = (active + 1) % total" class="absolute right-4 top-1/2 -translate-y-1/2 w-11 h-11 rounded-full bg-black/40 hover:bg-black/70 text-white flex items-center justify-center transition border border-white/20 shadow-xl">
                            <i class="fa-solid fa-chevron-right text-sm"></i>
                        </button>
                        <div class="absolute bottom-6 inset-x-0 flex justify-center space-x-2.5">
                            <button @click="active = 0" :class="active === 0 ? 'w-8 bg-theme-primary' : 'w-2.5 bg-white/50 hover:bg-white'" class="h-2.5 rounded-full transition-all duration-300"></button>
                            <button @click="active = 1" :class="active === 1 ? 'w-8 bg-theme-primary' : 'w-2.5 bg-white/50 hover:bg-white'" class="h-2.5 rounded-full transition-all duration-300"></button>
                            <button @click="active = 2" :class="active === 2 ? 'w-8 bg-theme-primary' : 'w-2.5 bg-white/50 hover:bg-white'" class="h-2.5 rounded-full transition-all duration-300"></button>
                        </div>
                    </div>`
                },
                {
                    id: 'tpl-carousel-testimonial-slider',
                    name: 'Testimonial Ulasan Mahasiswa & Alumni (Slider)',
                    category: 'carousel',
                    tag: 'TESTIMONIAL CAROUSEL',
                    image: 'https://images.unsplash.com/photo-1559839734-2b71ea197ec2?w=600&auto=format&fit=crop&q=80',
                    content: `<div x-data="{ active: 0, total: 3 }" data-elementor-type="carousel" class="max-w-4xl mx-auto py-8 px-4">
                        <div class="relative bg-white rounded-3xl border border-slate-200 p-8 sm:p-12 shadow-xl text-center space-y-6 overflow-hidden">
                            <div class="text-amber-400 text-base space-x-1">
                                <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                            </div>
                            <!-- Slide 1 -->
                            <div x-show="active === 0" class="carousel-slide space-y-6">
                                <p class="text-base sm:text-xl text-slate-700 italic font-medium leading-relaxed">“Pendidikan di STIKES Panti Waluya membentuk mentalitas perawat yang penuh empati dan terampil. Laboratorium praktiknya sangat mirip dengan kondisi rumah sakit sebenarnya.”</p>
                                <div class="flex items-center justify-center space-x-4 pt-2">
                                    <img src="https://images.unsplash.com/photo-1559839734-2b71ea197ec2?w=150&h=150&fit=crop" class="w-14 h-14 rounded-full object-cover border-2 border-theme-primary shadow-md">
                                    <div class="text-left">
                                        <div class="text-sm font-extrabold text-slate-900">Ns. Angela Putri, S.Kep</div>
                                        <div class="text-xs text-theme-primary font-semibold">Alumni Ners - Kepala Rawat Inap RS Panti Nirmala</div>
                                    </div>
                                </div>
                            </div>
                            <!-- Slide 2 -->
                            <div x-show="active === 1" style="display: none;" class="carousel-slide space-y-6">
                                <p class="text-base sm:text-xl text-slate-700 italic font-medium leading-relaxed">“Mahasiswa STIKES memiliki kedisiplinan dan kesiapan klinis yang sangat unggul dibandingkan kampus lain saat menjalani stase rotasi medis.”</p>
                                <div class="flex items-center justify-center space-x-4 pt-2">
                                    <img src="https://images.unsplash.com/photo-1622253692010-333f2da6031d?w=150&h=150&fit=crop" class="w-14 h-14 rounded-full object-cover border-2 border-theme-primary shadow-md">
                                    <div class="text-left">
                                        <div class="text-sm font-extrabold text-slate-900">dr. Antonius Wicaksono</div>
                                        <div class="text-xs text-theme-primary font-semibold">Mitra Pembimbing Praktik Klinis RS Panti Waluyo</div>
                                    </div>
                                </div>
                            </div>
                            <!-- Slide 3 -->
                            <div x-show="active === 2" style="display: none;" class="carousel-slide space-y-6">
                                <p class="text-base sm:text-xl text-slate-700 italic font-medium leading-relaxed">“Kurikulum digital health dan SIMRS di kampus sangat aplikatif. Saya langsung diterima kerja sebelum wisuda resmi.”</p>
                                <div class="flex items-center justify-center space-x-4 pt-2">
                                    <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=150&h=150&fit=crop" class="w-14 h-14 rounded-full object-cover border-2 border-theme-primary shadow-md">
                                    <div class="text-left">
                                        <div class="text-sm font-extrabold text-slate-900">Maria Shinta, A.Md.Kes</div>
                                        <div class="text-xs text-theme-primary font-semibold">Alumni Rekam Medis - Praktisi RS Santo Borromeus</div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center justify-between pt-4 border-t border-slate-100">
                                <button @click="active = (active - 1 + total) % total" class="px-3.5 py-1.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs flex items-center space-x-1.5 transition">
                                    <i class="fa-solid fa-chevron-left text-[10px]"></i> <span>Sebelumnya</span>
                                </button>
                                <div class="flex space-x-2">
                                    <button @click="active = 0" :class="active === 0 ? 'w-6 bg-theme-primary' : 'w-2 bg-slate-300'" class="h-2 rounded-full transition-all duration-300"></button>
                                    <button @click="active = 1" :class="active === 1 ? 'w-6 bg-theme-primary' : 'w-2 bg-slate-300'" class="h-2 rounded-full transition-all duration-300"></button>
                                    <button @click="active = 2" :class="active === 2 ? 'w-6 bg-theme-primary' : 'w-2 bg-slate-300'" class="h-2 rounded-full transition-all duration-300"></button>
                                </div>
                                <button @click="active = (active + 1) % total" class="px-3.5 py-1.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs flex items-center space-x-1.5 transition">
                                    <span>Berikutnya</span> <i class="fa-solid fa-chevron-right text-[10px]"></i>
                                </button>
                            </div>
                        </div>
                    </div>`
                },
                {
                    id: 'tpl-hero-healthcare',
                    name: 'Hero Medis & Kampus Kesehatan',
                    category: 'hero',
                    tag: 'HERO SECTION',
                    image: 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?w=600&auto=format&fit=crop&q=80',
                    content: `<div class="relative py-24 bg-gradient-to-br from-slate-900 via-sky-950 to-slate-900 text-white overflow-hidden">
                        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center space-y-6">
                            <span class="px-4 py-1.5 rounded-full bg-theme-primary/30 border border-theme-primary/50 text-cyan-300 text-xs font-bold uppercase tracking-wider">Penerimaan Mahasiswa Baru 2026/2027</span>
                            <h1 class="text-4xl sm:text-6xl font-extrabold tracking-tight">Kembangkan Potensi Tenaga Medis Profesional</h1>
                            <p class="text-base sm:text-lg text-slate-300 max-w-2xl mx-auto">Bergabunglah dengan institusi kesehatan terkemuka di Jawa Timur yang didukung fasilitas laboratorium modern dan kerjasama rumah sakit terkemuka.</p>
                            <div class="flex justify-center gap-4 pt-4">
                                <a href="/kontak" class="px-7 py-3.5 rounded-xl bg-theme-primary hover:bg-theme-secondary text-white font-bold text-sm shadow-xl transition">Daftar Sekarang</a>
                                <a href="#prodi" class="px-7 py-3.5 rounded-xl bg-white/10 hover:bg-white/20 text-white font-bold text-sm border border-white/20 transition">Lihat Pilihan Prodi</a>
                            </div>
                        </div>
                    </div>`
                },
                {
                    id: 'tpl-features-3col',
                    name: '3 Pilar Fasilitas Unggulan',
                    category: 'services',
                    tag: 'SERVICES GRID',
                    image: 'https://images.unsplash.com/photo-1584515979956-d9f6e5d09982?w=600&auto=format&fit=crop&q=80',
                    content: `<section class="py-16 bg-slate-50">
                        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                            <div class="text-center max-w-2xl mx-auto mb-12 space-y-2">
                                <h2 class="text-3xl font-extrabold text-slate-900">Mengapa Memilih Kami?</h2>
                                <p class="text-sm text-slate-600">Keunggulan kompetitif yang dirancang untuk mendukung kelulusan dan karir masa depan.</p>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                                <div class="bg-white p-8 rounded-3xl border border-slate-200 shadow-sm hover:shadow-xl transition space-y-4">
                                    <div class="w-14 h-14 rounded-2xl bg-cyan-100 text-cyan-700 flex items-center justify-center text-2xl"><i class="fa-solid fa-microscope"></i></div>
                                    <h3 class="text-lg font-bold text-slate-900">Lab Medis Mutakhir</h3>
                                    <p class="text-xs text-slate-600 leading-relaxed">Laboratorium keperawatan, rekam medis, dan farmasi dengan simulator berstandar internasional.</p>
                                </div>
                                <div class="bg-white p-8 rounded-3xl border border-slate-200 shadow-sm hover:shadow-xl transition space-y-4">
                                    <div class="w-14 h-14 rounded-2xl bg-emerald-100 text-emerald-700 flex items-center justify-center text-2xl"><i class="fa-solid fa-hospital-user"></i></div>
                                    <h3 class="text-lg font-bold text-slate-900">Jejaring Rumah Sakit</h3>
                                    <p class="text-xs text-slate-600 leading-relaxed">Praktik klinis di rumah sakit tipe A dan B di bawah naungan Yayasan Panti Waluya dan mitra nasional.</p>
                                </div>
                                <div class="bg-white p-8 rounded-3xl border border-slate-200 shadow-sm hover:shadow-xl transition space-y-4">
                                    <div class="w-14 h-14 rounded-2xl bg-purple-100 text-purple-700 flex items-center justify-center text-2xl"><i class="fa-solid fa-award"></i></div>
                                    <h3 class="text-lg font-bold text-slate-900">Akreditasi & Sertifikasi</h3>
                                    <p class="text-xs text-slate-600 leading-relaxed">Program studi terakreditasi resmi LAM-PTKes dengan tingkat kelulusan uji kompetensi di atas 95%.</p>
                                </div>
                            </div>
                        </div>
                    </section>`
                },
                {
                    id: 'tpl-about-vision',
                    name: 'Visi Misi & Sambutan Pimpinan',
                    category: 'about',
                    tag: 'ABOUT US',
                    image: 'https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?w=600&auto=format&fit=crop&q=80',
                    content: `<section class="py-16 bg-white">
                        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                                <div class="lg:col-span-5">
                                    <div class="relative rounded-3xl overflow-hidden shadow-2xl">
                                        <img src="https://images.unsplash.com/photo-1559839734-2b71ea197ec2?w=800&auto=format&fit=crop&q=80" alt="Direktur" class="w-full h-[420px] object-cover">
                                        <div class="absolute bottom-0 inset-x-0 bg-gradient-to-t from-slate-950 via-slate-900/80 to-transparent p-6 text-white">
                                            <div class="font-extrabold text-sm">Ns. Widyawati, M.Kep., Sp.Kep.Mat</div>
                                            <div class="text-xs text-cyan-400">Ketua STIKES Panti Waluya</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="lg:col-span-7 space-y-5">
                                    <span class="text-xs font-bold text-theme-primary uppercase tracking-wider">Komitmen Pendidikan</span>
                                    <h2 class="text-3xl font-extrabold text-slate-900 leading-snug">Menghasilkan Lulusan Berkarakter Kasih dan Kompeten</h2>
                                    <p class="text-sm text-slate-600 leading-relaxed">Dengan semangat pengabdian dan nilai-nilai kemanusiaan, kami mendampingi setiap mahasiswa untuk menguasai ilmu keperawatan dan kesehatan modern secara holistik.</p>
                                    <div class="grid grid-cols-2 gap-4 pt-2">
                                        <div class="p-4 bg-slate-50 rounded-2xl border border-slate-200"><div class="text-2xl font-black text-theme-primary">100%</div><div class="text-xs text-slate-600 font-semibold mt-1">Dosen Berlisensi & S2/S3</div></div>
                                        <div class="p-4 bg-slate-50 rounded-2xl border border-slate-200"><div class="text-2xl font-black text-theme-primary">3 Bulan</div><div class="text-xs text-slate-600 font-semibold mt-1">Rata-rata Waktu Tunggu Kerja</div></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>`
                },
                {
                    id: 'tpl-pricing-table',
                    name: 'Tabel Skema Biaya PMB & Beasiswa',
                    category: 'pricing',
                    tag: 'PRICING TABLE',
                    image: 'https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?w=600&auto=format&fit=crop&q=80',
                    content: `<section class="py-16 bg-slate-50">
                        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                            <div class="text-center max-w-xl mx-auto mb-12 space-y-2">
                                <h2 class="text-3xl font-extrabold text-slate-900">Skema Biaya Pendidikan</h2>
                                <p class="text-sm text-slate-600">Transparan, terjangkau, dan didukung berbagai skema beasiswa penuh maupun parsial.</p>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                                <div class="bg-white p-8 rounded-3xl border border-slate-200 shadow-sm space-y-5 text-center">
                                    <h3 class="text-base font-bold text-slate-800">Jalur Prestasi (PMDK)</h3>
                                    <div class="text-3xl font-black text-slate-900">Bebas DPP <span class="text-xs text-slate-500 font-normal">/ 100%</span></div>
                                    <ul class="text-xs text-slate-600 space-y-2.5 text-left border-y border-slate-100 py-4">
                                        <li><i class="fa-solid fa-check text-emerald-500 mr-2"></i> Nilai Rapor Rata-rata 80+</li>
                                        <li><i class="fa-solid fa-check text-emerald-500 mr-2"></i> Sertifikat Akademik / Olahraga</li>
                                        <li><i class="fa-solid fa-check text-emerald-500 mr-2"></i> Kuota Terbatas 30 Kursi</li>
                                    </ul>
                                    <a href="/kontak" class="block w-full py-2.5 rounded-xl bg-slate-900 text-white font-bold text-xs">Pilih Jalur</a>
                                </div>
                                <div class="bg-white p-8 rounded-3xl border-2 border-theme-primary shadow-xl space-y-5 text-center relative">
                                    <span class="absolute -top-3.5 left-1/2 -translate-x-1/2 bg-theme-primary text-white text-[10px] font-extrabold uppercase px-3 py-1 rounded-full">Favorit</span>
                                    <h3 class="text-base font-bold text-slate-800">Jalur Reguler Gelombang 1</h3>
                                    <div class="text-3xl font-black text-theme-primary">Potongan 50% <span class="text-xs text-slate-500 font-normal">DPP</span></div>
                                    <ul class="text-xs text-slate-600 space-y-2.5 text-left border-y border-slate-100 py-4">
                                        <li><i class="fa-solid fa-check text-emerald-500 mr-2"></i> Bebas Tes Tulis Akademik</li>
                                        <li><i class="fa-solid fa-check text-emerald-500 mr-2"></i> Cicilan Biaya hingga 4x</li>
                                        <li><i class="fa-solid fa-check text-emerald-500 mr-2"></i> Free Jas Almamater & Seragam</li>
                                    </ul>
                                    <a href="/kontak" class="block w-full py-2.5 rounded-xl bg-theme-primary text-white font-bold text-xs shadow-md">Daftar Sekarang</a>
                                </div>
                                <div class="bg-white p-8 rounded-3xl border border-slate-200 shadow-sm space-y-5 text-center">
                                    <h3 class="text-base font-bold text-slate-800">Beasiswa KIP-Kuliah</h3>
                                    <div class="text-3xl font-black text-slate-900">Gratis <span class="text-xs text-slate-500 font-normal">Hingga Lulus</span></div>
                                    <ul class="text-xs text-slate-600 space-y-2.5 text-left border-y border-slate-100 py-4">
                                        <li><i class="fa-solid fa-check text-emerald-500 mr-2"></i> Bantuan Biaya Hidup Bulanan</li>
                                        <li><i class="fa-solid fa-check text-emerald-500 mr-2"></i> Terdaftar di DTKS Kemensos</li>
                                        <li><i class="fa-solid fa-check text-emerald-500 mr-2"></i> Bimbingan Akademik Khusus</li>
                                    </ul>
                                    <a href="/kontak" class="block w-full py-2.5 rounded-xl bg-slate-900 text-white font-bold text-xs">Syarat & Ketentuan</a>
                                </div>
                            </div>
                        </div>
                    </section>`
                },
                {
                    id: 'tpl-faq-full',
                    name: 'FAQ Tanya Jawab Akordeon Lengkap',
                    category: 'faq',
                    tag: 'FAQ ACCORDION',
                    image: 'https://images.unsplash.com/photo-1434030216411-0b793f4b4173?w=600&auto=format&fit=crop&q=80',
                    content: `<section class="py-16 bg-white" x-data="{ activeFaq: 1 }">
                        <div class="max-w-4xl mx-auto px-4 sm:px-6">
                            <div class="text-center mb-10 space-y-2">
                                <span class="text-xs font-bold text-theme-primary uppercase">Pertanyaan Umum</span>
                                <h2 class="text-3xl font-extrabold text-slate-900">Pertanyaan yang Sering Diajukan</h2>
                            </div>
                            <div class="space-y-3">
                                <div class="border border-slate-200 rounded-2xl overflow-hidden shadow-sm">
                                    <button @click="activeFaq = activeFaq === 1 ? null : 1" class="w-full p-5 text-left flex justify-between items-center font-bold text-sm text-slate-900">
                                        <span>Kapan periode pendaftaran mahasiswa baru dibuka?</span>
                                        <i class="fa-solid fa-chevron-down text-xs text-slate-400 transition" :class="{ 'rotate-180': activeFaq === 1 }"></i>
                                    </button>
                                    <div x-show="activeFaq === 1" class="px-5 pb-5 text-xs text-slate-600 leading-relaxed border-t border-slate-100 pt-3">
                                        Pendaftaran dibuka dalam 3 gelombang mulai bulan Januari hingga Agustus setiap tahunnya. Pendaftaran gelombang 1 mendapatkan keuntungan diskon DPP 50%.
                                    </div>
                                </div>
                                <div class="border border-slate-200 rounded-2xl overflow-hidden shadow-sm">
                                    <button @click="activeFaq = activeFaq === 2 ? null : 2" class="w-full p-5 text-left flex justify-between items-center font-bold text-sm text-slate-900">
                                        <span>Apakah lulusan langsung disalurkan kerja?</span>
                                        <i class="fa-solid fa-chevron-down text-xs text-slate-400 transition" :class="{ 'rotate-180': activeFaq === 2 }"></i>
                                    </button>
                                    <div x-show="activeFaq === 2" style="display: none;" class="px-5 pb-5 text-xs text-slate-600 leading-relaxed border-t border-slate-100 pt-3">
                                        Ya, STIKES Panti Waluya memiliki unit Career Center dan kerjasama penyerapan kerja langsung dengan jaringan RS Panti Nirmala, RS Panti Waluyo, RS Santo Borromeus, dan klinik rekanan internasional di Jepang.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>`
                },
                {
                    id: 'tpl-cta-wa',
                    name: 'Banner WhatsApp Official Chat',
                    category: 'cta',
                    tag: 'CALL TO ACTION',
                    image: 'https://images.unsplash.com/photo-1577563908411-5077b6dc7624?w=600&auto=format&fit=crop&q=80',
                    content: `<section class="py-16 bg-slate-950 text-white relative overflow-hidden">
                        <div class="max-w-4xl mx-auto px-4 text-center space-y-6 relative z-10">
                            <div class="w-16 h-16 rounded-3xl bg-emerald-500/20 text-emerald-400 border border-emerald-500/30 flex items-center justify-center text-3xl mx-auto">
                                <i class="fa-brands fa-whatsapp"></i>
                            </div>
                            <h2 class="text-3xl sm:text-4xl font-extrabold">Konsultasikan Pendaftaran Anda Sekarang</h2>
                            <p class="text-sm text-slate-300 max-w-xl mx-auto">Tim Humas dan Admisi STIKES Panti Waluya siap menjawab seluruh pertanyaan Anda mengenai prodi, beasiswa, dan asrama mahasiswa.</p>
                            <div>
                                <a href="https://wa.me/628123456789" target="_blank" class="px-8 py-3.5 rounded-2xl bg-emerald-600 hover:bg-emerald-500 text-white font-extrabold text-sm shadow-xl inline-flex items-center space-x-2 transition transform hover:-translate-y-0.5">
                                    <i class="fa-brands fa-whatsapp text-lg"></i>
                                    <span>Chat dengan Admin Admisi (WhatsApp)</span>
                                </a>
                            </div>
                        </div>
                    </section>`
                }
            ];

            const templateModal = document.getElementById('template-library-modal');
            const templatesGrid = document.getElementById('templates-grid');
            const btnOpenLibrary = document.getElementById('btn-open-library');
            const btnCloseLibrary = document.getElementById('btn-close-library');
            const btnMenuTemplates = document.getElementById('btn-menu-templates');

            function renderTemplates(filter = 'all') {
                templatesGrid.innerHTML = '';
                const filtered = filter === 'all' ? templatesData : templatesData.filter(t => t.category === filter);

                filtered.forEach(item => {
                    const card = document.createElement('div');
                    card.className = 'bg-[#202328] border border-[#333842] rounded-2xl overflow-hidden shadow-lg flex flex-col hover:border-[#d63384] transition group';
                    card.innerHTML = `
                        <div class="h-44 bg-[#17191d] overflow-hidden relative">
                            <img src="${item.image}" alt="${item.name}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                            <span class="absolute top-3 left-3 px-2 py-0.5 rounded bg-black/70 text-cyan-300 border border-cyan-400/30 text-[9px] font-bold uppercase tracking-wider">${item.tag}</span>
                        </div>
                        <div class="p-4 flex-1 flex flex-col justify-between space-y-3">
                            <h4 class="text-xs font-bold text-white group-hover:text-pink-300 transition">${item.name}</h4>
                            <button class="btn-insert-template w-full py-2 rounded-xl bg-gradient-to-r from-[#92003b] to-[#d63384] hover:opacity-90 text-white font-bold text-xs shadow-md transition flex items-center justify-center space-x-1.5" data-id="${item.id}">
                                <i class="fa-solid fa-circle-plus text-xs"></i> <span>Sisipkan Template</span>
                            </button>
                        </div>
                    `;
                    templatesGrid.appendChild(card);
                });

                // Attach click handlers to insert buttons
                document.querySelectorAll('.btn-insert-template').forEach(btn => {
                    btn.addEventListener('click', function() {
                        const tplId = this.getAttribute('data-id');
                        const targetTpl = templatesData.find(t => t.id === tplId);
                        if (targetTpl) {
                            editor.addComponents(targetTpl.content);
                            templateModal.classList.add('hidden');
                            showToast(`Template "${targetTpl.name}" berhasil disisipkan!`);
                        }
                    });
                });
            }

            btnOpenLibrary.addEventListener('click', () => {
                renderTemplates('all');
                templateModal.classList.remove('hidden');
            });
            btnMenuTemplates.addEventListener('click', () => {
                document.getElementById('dropdown-hamburger').classList.add('hidden');
                renderTemplates('all');
                templateModal.classList.remove('hidden');
            });
            btnCloseLibrary.addEventListener('click', () => {
                templateModal.classList.add('hidden');
            });

            // Filter button clicks
            document.querySelectorAll('.tpl-filter-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    document.querySelectorAll('.tpl-filter-btn').forEach(b => {
                        b.classList.remove('bg-[#d63384]', 'text-white', 'font-bold');
                        b.classList.add('bg-[#282d36]', 'text-gray-300', 'font-medium');
                    });
                    this.classList.add('bg-[#d63384]', 'text-white', 'font-bold');
                    this.classList.remove('bg-[#282d36]', 'text-gray-300', 'font-medium');
                    renderTemplates(this.getAttribute('data-category'));
                });
            });

            // ==========================================
            // FLOATING NAVIGATOR MODAL
            // ==========================================
            const navigatorModal = document.getElementById('navigator-modal');
            const btnBottomNav = document.getElementById('btn-bottom-navigator');
            const btnCloseNav = document.getElementById('btn-close-navigator');
            const floatingLayers = document.getElementById('floating-layers-container');

            btnBottomNav.addEventListener('click', () => {
                navigatorModal.classList.toggle('hidden');
                if (!navigatorModal.classList.contains('hidden')) {
                    // Move layer manager into floating container
                    floatingLayers.appendChild(document.getElementById('layers-panel'));
                }
            });
            btnCloseNav.addEventListener('click', () => {
                navigatorModal.classList.add('hidden');
            });

            // ==========================================
            // PAGE SETTINGS MODAL
            // ==========================================
            const pageSettingsModal = document.getElementById('page-settings-modal');
            const btnBottomSettings = document.getElementById('btn-bottom-settings');
            const btnMenuSettings = document.getElementById('btn-menu-settings');
            const btnClosePageSettings = document.getElementById('btn-close-page-settings');

            function openPageSettings() {
                document.getElementById('dropdown-hamburger').classList.add('hidden');
                pageSettingsModal.classList.remove('hidden');
            }
            btnBottomSettings.addEventListener('click', openPageSettings);
            btnMenuSettings.addEventListener('click', openPageSettings);
            btnClosePageSettings.addEventListener('click', () => pageSettingsModal.classList.add('hidden'));

            // ==========================================
            // HAMBURGER DROPDOWN TOGGLE
            // ==========================================
            const btnHamburger = document.getElementById('btn-hamburger');
            const dropdownHamburger = document.getElementById('dropdown-hamburger');

            btnHamburger.addEventListener('click', (e) => {
                e.stopPropagation();
                dropdownHamburger.classList.toggle('hidden');
            });
            document.addEventListener('click', () => {
                dropdownHamburger.classList.add('hidden');
            });

            // ==========================================
            // DEVICE SWITCHER (RESPONSIVE)
            // ==========================================
            const btnDesktop = document.getElementById('btn-device-desktop');
            const btnTablet = document.getElementById('btn-device-tablet');
            const btnMobile = document.getElementById('btn-device-mobile');
            const btnBottomResponsive = document.getElementById('btn-bottom-responsive');

            function resetDeviceBtns() {
                [btnDesktop, btnTablet, btnMobile].forEach(btn => {
                    btn.classList.remove('bg-[#d63384]', 'text-white', 'shadow');
                    btn.classList.add('text-gray-400');
                });
            }

            btnDesktop.addEventListener('click', () => {
                editor.setDevice('Desktop');
                resetDeviceBtns();
                btnDesktop.classList.add('bg-[#d63384]', 'text-white', 'shadow');
                btnDesktop.classList.remove('text-gray-400');
            });

            btnTablet.addEventListener('click', () => {
                editor.setDevice('Tablet');
                resetDeviceBtns();
                btnTablet.classList.add('bg-[#d63384]', 'text-white', 'shadow');
                btnTablet.classList.remove('text-gray-400');
            });

            btnMobile.addEventListener('click', () => {
                editor.setDevice('Mobile');
                resetDeviceBtns();
                btnMobile.classList.add('bg-[#d63384]', 'text-white', 'shadow');
                btnMobile.classList.remove('text-gray-400');
            });

            let currentDeviceCycle = 0;
            btnBottomResponsive.addEventListener('click', () => {
                currentDeviceCycle = (currentDeviceCycle + 1) % 3;
                if (currentDeviceCycle === 0) btnDesktop.click();
                else if (currentDeviceCycle === 1) btnTablet.click();
                else btnMobile.click();
            });

            editor.Devices.add({ id: 'Desktop', name: 'Desktop', width: '' });
            editor.Devices.add({ id: 'Tablet', name: 'Tablet', width: '768px' });
            editor.Devices.add({ id: 'Mobile', name: 'Mobile', width: '375px' });

            // ==========================================
            // ELEMENTOR PRO: CUSTOM CSS ENGINE
            // ==========================================
            const btnApplyCustomCss = document.getElementById('btn-apply-custom-css');
            const customCssEditor = document.getElementById('custom-css-editor');

            btnApplyCustomCss.addEventListener('click', () => {
                const selected = editor.getSelected();
                const cssText = customCssEditor.value.trim();

                if (!cssText) {
                    showToast('Silakan tulis aturan CSS terlebih dahulu.', true);
                    return;
                }

                if (selected) {
                    try {
                        const cleanCss = cssText.replace(/selector\s*\{/g, '').replace(/\}/g, '');
                        const rules = cleanCss.split(';').filter(r => r.trim());
                        const styleObj = {};
                        rules.forEach(rule => {
                            const parts = rule.split(':');
                            if (parts.length >= 2) {
                                const prop = parts[0].trim();
                                const val = parts.slice(1).join(':').trim();
                                if (prop && val) styleObj[prop] = val;
                            }
                        });
                        selected.addStyle(styleObj);
                        showToast('Custom CSS berhasil diterapkan pada elemen terpilih!');
                    } catch (err) {
                        showToast('Format CSS tidak valid.', true);
                    }
                } else {
                    const iframe = editor.Canvas.getFrameEl();
                    const doc = iframe.contentDocument || iframe.contentWindow.document;
                    let customStyleTag = doc.getElementById('pro-live-custom-css');
                    if (!customStyleTag) {
                        customStyleTag = doc.createElement('style');
                        customStyleTag.id = 'pro-live-custom-css';
                        doc.head.appendChild(customStyleTag);
                    }
                    customStyleTag.innerHTML += "\n" + cssText;
                    showToast('Custom CSS global berhasil disuntikkan ke kanvas!');
                }
            });

            // ==========================================
            // ELEMENTOR PRO: MOTION EFFECTS HANDLER
            // ==========================================
            const motionAnimSelect = document.getElementById('motion-animation-select');
            motionAnimSelect.addEventListener('change', (e) => {
                const selected = editor.getSelected();
                const animClass = e.target.value;
                if (!selected) {
                    showToast('Pilih elemen di kanvas untuk menambahkan efek animasi.', true);
                    return;
                }
                if (animClass) {
                    selected.addClass(animClass.split(' '));
                    showToast(`Efek animasi "${animClass}" diterapkan!`);
                }
            });

            // ==========================================
            // ELEMENTOR PRO: POPUP BUILDER ENGINE
            // ==========================================
            const popupBuilderModal = document.getElementById('popup-builder-modal');
            const btnOpenPopupBuilder = document.getElementById('btn-open-popup-builder');
            const btnMenuPopup = document.getElementById('btn-menu-popup');
            const btnClosePopupBuilder = document.getElementById('btn-close-popup-builder');

            function openPopupBuilder() {
                popupBuilderModal.classList.remove('hidden');
            }
            if (btnOpenPopupBuilder) btnOpenPopupBuilder.addEventListener('click', openPopupBuilder);
            if (btnMenuPopup) btnMenuPopup.addEventListener('click', () => {
                document.getElementById('dropdown-hamburger').classList.add('hidden');
                openPopupBuilder();
            });
            if (btnClosePopupBuilder) btnClosePopupBuilder.addEventListener('click', () => {
                popupBuilderModal.classList.add('hidden');
            });

            // Popup Preset Templates Insertion
            const popupPresets = {
                'pmb-lead': `<div x-data="{ openPopup: true }" x-show="openPopup" class="fixed inset-0 z-50 flex items-center justify-center bg-black/70 backdrop-blur-sm p-4">
                    <div @click.away="openPopup = false" class="bg-white rounded-3xl max-w-lg w-full p-8 relative shadow-2xl border-4 border-theme-primary text-center space-y-4">
                        <button @click="openPopup = false" class="absolute top-4 right-4 text-slate-400 hover:text-slate-800 text-lg"><i class="fa-solid fa-xmark"></i></button>
                        <span class="px-3.5 py-1 rounded-full bg-theme-primary text-white text-[10px] font-extrabold uppercase tracking-wider">Promo Terbatas PMB</span>
                        <h3 class="text-2xl font-black text-slate-900 leading-tight">Dapatkan Potongan 50% DPP Gelombang I</h3>
                        <p class="text-xs text-slate-600">Khusus pendaftaran Program Studi Keperawatan & Rekam Medis bulan ini. Isi nama & nomor WhatsApp untuk klaim voucher:</p>
                        <div class="space-y-2 text-left pt-2">
                            <input type="text" placeholder="Nama Lengkap..." class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-slate-200">
                            <input type="text" placeholder="Nomor WhatsApp (0812...)" class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-slate-200">
                            <button type="button" @click="alert('Voucher berhasil diklaim!'); openPopup = false;" class="w-full py-3 rounded-xl bg-theme-primary text-white font-extrabold text-xs uppercase tracking-wider shadow-lg">Klaim Voucher Beasiswa</button>
                        </div>
                    </div>
                </div>`,
                'announcement': `<div x-data="{ showNotice: true }" x-show="showNotice" class="fixed bottom-6 left-6 z-50 max-w-md bg-slate-900 text-white p-5 rounded-2xl shadow-2xl border border-slate-700 flex items-start space-x-3.5">
                    <div class="w-10 h-10 rounded-xl bg-sky-500/20 text-sky-400 border border-sky-500/30 flex items-center justify-center text-lg shrink-0 mt-0.5"><i class="fa-solid fa-bell"></i></div>
                    <div class="flex-1 space-y-1">
                        <h4 class="text-xs font-bold text-sky-400 uppercase tracking-wider">Pengumuman Penting</h4>
                        <p class="text-xs text-slate-300">Batas akhir pengisian KRS Semester Genap sampai 28 Oktober 2026 pukul 23:59 WIB.</p>
                    </div>
                    <button @click="showNotice = false" class="text-slate-400 hover:text-white text-xs"><i class="fa-solid fa-xmark"></i></button>
                </div>`,
                'wa-support': `<div x-data="{ showChat: false }" class="fixed bottom-6 right-6 z-50">
                    <div x-show="showChat" @click.away="showChat = false" class="mb-3 w-80 bg-white rounded-2xl shadow-2xl border border-slate-200 p-4 space-y-3">
                        <div class="flex items-center justify-between border-b border-slate-100 pb-2">
                            <div class="flex items-center space-x-2">
                                <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-ping"></span>
                                <span class="font-extrabold text-xs text-slate-900">Admin Admisi STIKES</span>
                            </div>
                            <button @click="showChat = false" class="text-slate-400 hover:text-slate-700 text-xs"><i class="fa-solid fa-xmark"></i></button>
                        </div>
                        <p class="text-xs text-slate-600">Halo! Ada yang bisa kami bantu seputar pendaftaran mahasiswa baru atau layanan kampus?</p>
                        <a href="https://wa.me/628123456789" target="_blank" class="block w-full py-2.5 rounded-xl bg-emerald-600 text-white font-bold text-xs text-center shadow">Mulai Chat WhatsApp</a>
                    </div>
                    <button @click="showChat = !showChat" class="w-14 h-14 rounded-full bg-emerald-600 hover:bg-emerald-500 text-white flex items-center justify-center text-2xl shadow-2xl transition transform hover:scale-110">
                        <i class="fa-brands fa-whatsapp"></i>
                    </button>
                </div>`
            };

            document.querySelectorAll('.btn-insert-popup-preset').forEach(btn => {
                btn.addEventListener('click', function() {
                    const presetKey = this.getAttribute('data-preset');
                    if (popupPresets[presetKey]) {
                        editor.addComponents(popupPresets[presetKey]);
                        popupBuilderModal.classList.add('hidden');
                        showToast(`Popup "${presetKey}" berhasil disisipkan ke halaman!`);
                    }
                });
            });

            // ==========================================
            // TOP ACTIONS (UNDO, REDO, ASSETS, PREVIEW, CLEAR)
            // ==========================================
            document.getElementById('btn-undo').addEventListener('click', () => editor.UndoManager.undo());
            document.getElementById('btn-redo').addEventListener('click', () => editor.UndoManager.redo());
            document.getElementById('btn-bottom-history').addEventListener('click', () => {
                showToast(`Undo: Ctrl+Z | Redo: Ctrl+Y (${editor.UndoManager.hasUndo() ? 'Ada revisi' : 'Awal'})`);
            });
            document.getElementById('btn-preview').addEventListener('click', () => editor.runCommand('preview'));
            document.getElementById('btn-open-assets').addEventListener('click', () => editor.runCommand('open-assets'));
            document.getElementById('btn-clear-canvas').addEventListener('click', () => {
                if (confirm('Kosongkan seluruh elemen kanvas pada halaman ini?')) {
                    editor.setComponents('');
                    showToast('Kanvas telah dikosongkan.');
                }
            });

            // ==========================================
            // SAVE & PUBLISH VIA AJAX
            // ==========================================
            const btnSave = document.getElementById('btn-save');
            const btnBottomUpdate = document.getElementById('btn-bottom-update');
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

            async function performSave() {
                const saveButtons = [btnSave, btnBottomUpdate];
                saveButtons.forEach(b => {
                    b.disabled = true;
                    b.innerHTML = `<i class="fa-solid fa-spinner fa-spin text-xs"></i> <span>Menyimpan...</span>`;
                });

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
                        showToast(data.message || 'Halaman visual builder berhasil dipublish!');
                    } else {
                        showToast(data.message || 'Gagal menyimpan perubahan.', true);
                    }
                } catch (err) {
                    showToast('Terjadi kesalahan koneksi.', true);
                    console.error(err);
                } finally {
                    btnSave.disabled = false;
                    btnSave.innerHTML = `<i class="fa-solid fa-floppy-disk text-xs"></i> <span>Publish</span>`;
                    btnBottomUpdate.disabled = false;
                    btnBottomUpdate.innerHTML = `<i class="fa-solid fa-circle-check text-[10px]"></i> <span>UPDATE</span>`;
                }
            }

            btnSave.addEventListener('click', performSave);
            btnBottomUpdate.addEventListener('click', performSave);
        });
    </script>
</body>
</html>
