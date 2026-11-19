<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - CMS {{ get_setting('division_acronym', 'Divisi') }} STIKES Panti Waluya</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        theme: {
                            primary: 'var(--color-primary)'
                        }
                    }
                }
            }
        }
    </script>
    <script>
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
    <script src="{{ asset('js/admin.js') }}"></script>
    
    <!-- FontAwesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Custom Separated Admin Stylesheet -->
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Quill Editor (WYSIWYG) -->
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>

    <!-- Dynamic Theme Color Variables -->
    <style>
        :root {
            --color-primary: {{ get_setting('theme_primary_color', '#0e7490') }};
        }
    </style>
</head>
<body class="bg-slate-100 dark:bg-slate-950 text-slate-800 dark:text-slate-200 font-sans antialiased min-h-screen flex" x-data="{ sidebarOpen: false, isDark: document.documentElement.classList.contains('dark'), toggleDark() { this.isDark = !this.isDark; if(this.isDark) { document.documentElement.classList.add('dark'); localStorage.theme = 'dark'; } else { document.documentElement.classList.remove('dark'); localStorage.theme = 'light'; } } }">

    <!-- Mobile Sidebar Backdrop -->
    <div x-show="sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 z-40 bg-slate-900/50 backdrop-blur-sm lg:hidden" style="display: none;"></div>

    <!-- Sidebar Navigation -->
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'" class="fixed lg:static inset-y-0 left-0 z-50 w-64 bg-slate-900 border-r border-slate-800/90 text-slate-300 flex flex-col justify-between select-none shadow-2xl transition-transform duration-200 ease-in-out">
        
        <!-- Top Section: Brand Header -->
        <div class="h-20 flex items-center justify-between px-5 border-b border-slate-800/80 bg-slate-950/60 backdrop-blur-md shrink-0">
            <div class="flex items-center space-x-3 overflow-hidden">
                <div class="w-10 h-10 rounded-xl flex items-center justify-center text-white font-bold text-lg shadow-md shrink-0 ring-2 ring-white/10" style="background-color: var(--color-primary);">
                    @if(get_setting('logo_url'))
                        <img src="{{ get_setting('logo_url') }}" alt="Logo" class="w-8 h-8 object-contain">
                    @else
                        <i class="{{ get_setting('division_icon', 'fa-solid fa-hospital-user') }}"></i>
                    @endif
                </div>
                <div class="overflow-hidden">
                    <div class="flex items-center space-x-1.5">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                        <span class="text-[10px] uppercase tracking-wider font-extrabold text-sky-400">Panel CMS Divisi</span>
                    </div>
                    <div class="text-xs font-bold text-white truncate max-w-[145px]" title="{{ get_setting('division_name', 'STIKES Panti Waluya') }}">{{ get_setting('division_acronym', 'STIKES') }}</div>
                </div>
            </div>

            <!-- Close button for mobile -->
            <button @click="sidebarOpen = false" class="text-slate-400 hover:text-white lg:hidden p-1.5 rounded-lg hover:bg-slate-800 focus:outline-none" aria-label="Tutup Menu">
                <i class="fa-solid fa-xmark text-lg"></i>
            </button>
        </div>

        <!-- Middle Section: Scrollable Nav Menus -->
        <div class="flex-1 overflow-y-auto px-3.5 py-4 space-y-6 sidebar-scroll">

            <!-- Group 1: Ringkasan & Utama -->
            <div class="space-y-1">
                <div class="px-3 text-[10px] font-extrabold uppercase tracking-wider text-slate-500 mb-2 flex items-center space-x-1.5">
                    <i class="fa-solid fa-chart-pie text-[9px] text-slate-600"></i>
                    <span>Ringkasan</span>
                </div>
                
                <a href="{{ route('admin.dashboard') }}" class="group relative flex items-center px-3 py-2 rounded-xl text-xs font-semibold transition-all duration-150 {{ request()->routeIs('admin.dashboard') ? 'bg-theme-primary text-white font-bold shadow-lg shadow-theme-primary/25' : 'text-slate-400 hover:text-white hover:bg-slate-800/80 hover:translate-x-0.5' }}">
                    @if(request()->routeIs('admin.dashboard'))
                        <span class="absolute left-0 top-2 bottom-2 w-1 rounded-r-full bg-white"></span>
                    @endif
                    <div class="w-7 h-7 rounded-lg flex items-center justify-center mr-2.5 transition {{ request()->routeIs('admin.dashboard') ? 'bg-white/20 text-white' : 'bg-slate-800 text-slate-400 group-hover:text-white group-hover:bg-slate-700/80' }}">
                        <i class="fa-solid fa-gauge text-xs"></i>
                    </div>
                    <span>Dashboard</span>
                </a>
            </div>

            <!-- Group 2: Konten & Publikasi -->
            <div class="space-y-1">
                <div class="px-3 text-[10px] font-extrabold uppercase tracking-wider text-slate-500 mb-2 flex items-center space-x-1.5">
                    <i class="fa-regular fa-newspaper text-[9px] text-slate-600"></i>
                    <span>Konten & Publikasi</span>
                </div>

                <a href="{{ route('admin.posts.index') }}" class="group relative flex items-center px-3 py-2 rounded-xl text-xs font-semibold transition-all duration-150 {{ request()->routeIs('admin.posts*') ? 'bg-theme-primary text-white font-bold shadow-lg shadow-theme-primary/25' : 'text-slate-400 hover:text-white hover:bg-slate-800/80 hover:translate-x-0.5' }}">
                    @if(request()->routeIs('admin.posts*'))
                        <span class="absolute left-0 top-2 bottom-2 w-1 rounded-r-full bg-white"></span>
                    @endif
                    <div class="w-7 h-7 rounded-lg flex items-center justify-center mr-2.5 transition {{ request()->routeIs('admin.posts*') ? 'bg-white/20 text-white' : 'bg-slate-800 text-slate-400 group-hover:text-white group-hover:bg-slate-700/80' }}">
                        <i class="fa-regular fa-newspaper text-xs"></i>
                    </div>
                    <span>Berita & Pengumuman</span>
                </a>

                <a href="{{ route('admin.categories.index') }}" class="group relative flex items-center px-3 py-2 rounded-xl text-xs font-semibold transition-all duration-150 {{ request()->routeIs('admin.categories*') ? 'bg-theme-primary text-white font-bold shadow-lg shadow-theme-primary/25' : 'text-slate-400 hover:text-white hover:bg-slate-800/80 hover:translate-x-0.5' }}">
                    @if(request()->routeIs('admin.categories*'))
                        <span class="absolute left-0 top-2 bottom-2 w-1 rounded-r-full bg-white"></span>
                    @endif
                    <div class="w-7 h-7 rounded-lg flex items-center justify-center mr-2.5 transition {{ request()->routeIs('admin.categories*') ? 'bg-white/20 text-white' : 'bg-slate-800 text-slate-400 group-hover:text-white group-hover:bg-slate-700/80' }}">
                        <i class="fa-solid fa-tags text-xs"></i>
                    </div>
                    <span>Kategori</span>
                </a>

                @if(Auth::check() && Auth::user()->canManageFullContent())
                <a href="{{ route('admin.events.index') }}" class="group relative flex items-center px-3 py-2 rounded-xl text-xs font-semibold transition-all duration-150 {{ request()->routeIs('admin.events*') ? 'bg-theme-primary text-white font-bold shadow-lg shadow-theme-primary/25' : 'text-slate-400 hover:text-white hover:bg-slate-800/80 hover:translate-x-0.5' }}">
                    @if(request()->routeIs('admin.events*'))
                        <span class="absolute left-0 top-2 bottom-2 w-1 rounded-r-full bg-white"></span>
                    @endif
                    <div class="w-7 h-7 rounded-lg flex items-center justify-center mr-2.5 transition {{ request()->routeIs('admin.events*') ? 'bg-white/20 text-white' : 'bg-slate-800 text-slate-400 group-hover:text-white group-hover:bg-slate-700/80' }}">
                        <i class="fa-regular fa-calendar-days text-xs"></i>
                    </div>
                    <span>Agenda Kegiatan</span>
                </a>

                <a href="{{ route('admin.documents.index') }}" class="group relative flex items-center px-3 py-2 rounded-xl text-xs font-semibold transition-all duration-150 {{ request()->routeIs('admin.documents*') ? 'bg-theme-primary text-white font-bold shadow-lg shadow-theme-primary/25' : 'text-slate-400 hover:text-white hover:bg-slate-800/80 hover:translate-x-0.5' }}">
                    @if(request()->routeIs('admin.documents*'))
                        <span class="absolute left-0 top-2 bottom-2 w-1 rounded-r-full bg-white"></span>
                    @endif
                    <div class="w-7 h-7 rounded-lg flex items-center justify-center mr-2.5 transition {{ request()->routeIs('admin.documents*') ? 'bg-white/20 text-white' : 'bg-slate-800 text-slate-400 group-hover:text-white group-hover:bg-slate-700/80' }}">
                        <i class="fa-solid fa-file-arrow-down text-xs"></i>
                    </div>
                    <span>Dokumen & Unduhan</span>
                </a>

                <a href="{{ route('admin.galleries.index') }}" class="group relative flex items-center px-3 py-2 rounded-xl text-xs font-semibold transition-all duration-150 {{ request()->routeIs('admin.galleries*') ? 'bg-theme-primary text-white font-bold shadow-lg shadow-theme-primary/25' : 'text-slate-400 hover:text-white hover:bg-slate-800/80 hover:translate-x-0.5' }}">
                    @if(request()->routeIs('admin.galleries*'))
                        <span class="absolute left-0 top-2 bottom-2 w-1 rounded-r-full bg-white"></span>
                    @endif
                    <div class="w-7 h-7 rounded-lg flex items-center justify-center mr-2.5 transition {{ request()->routeIs('admin.galleries*') ? 'bg-white/20 text-white' : 'bg-slate-800 text-slate-400 group-hover:text-white group-hover:bg-slate-700/80' }}">
                        <i class="fa-regular fa-images text-xs"></i>
                    </div>
                    <span>Galeri Foto</span>
                </a>
                @endif
            </div>

            @if(Auth::check() && Auth::user()->canManageFullContent())
            <!-- Group 3: Tampilan Website -->
            <div class="space-y-1">
                <div class="px-3 text-[10px] font-extrabold uppercase tracking-wider text-slate-500 mb-2 flex items-center space-x-1.5">
                    <i class="fa-solid fa-desktop text-[9px] text-slate-600"></i>
                    <span>Tampilan Website</span>
                </div>

                <a href="{{ route('admin.carousels.index') }}" class="group relative flex items-center px-3 py-2 rounded-xl text-xs font-semibold transition-all duration-150 {{ request()->routeIs('admin.carousels*') ? 'bg-theme-primary text-white font-bold shadow-lg shadow-theme-primary/25' : 'text-slate-400 hover:text-white hover:bg-slate-800/80 hover:translate-x-0.5' }}">
                    @if(request()->routeIs('admin.carousels*'))
                        <span class="absolute left-0 top-2 bottom-2 w-1 rounded-r-full bg-white"></span>
                    @endif
                    <div class="w-7 h-7 rounded-lg flex items-center justify-center mr-2.5 transition {{ request()->routeIs('admin.carousels*') ? 'bg-white/20 text-white' : 'bg-slate-800 text-slate-400 group-hover:text-white group-hover:bg-slate-700/80' }}">
                        <i class="fa-solid fa-images text-xs"></i>
                    </div>
                    <span>Carousel / Banner</span>
                </a>

                <a href="{{ route('admin.menus.index') }}" class="group relative flex items-center px-3 py-2 rounded-xl text-xs font-semibold transition-all duration-150 {{ request()->routeIs('admin.menus*') ? 'bg-theme-primary text-white font-bold shadow-lg shadow-theme-primary/25' : 'text-slate-400 hover:text-white hover:bg-slate-800/80 hover:translate-x-0.5' }}">
                    @if(request()->routeIs('admin.menus*'))
                        <span class="absolute left-0 top-2 bottom-2 w-1 rounded-r-full bg-white"></span>
                    @endif
                    <div class="w-7 h-7 rounded-lg flex items-center justify-center mr-2.5 transition {{ request()->routeIs('admin.menus*') ? 'bg-white/20 text-white' : 'bg-slate-800 text-slate-400 group-hover:text-white group-hover:bg-slate-700/80' }}">
                        <i class="fa-solid fa-compass text-xs"></i>
                    </div>
                    <span>Menu Navigasi</span>
                </a>

                <a href="{{ route('admin.pages.index') }}" class="group relative flex items-center px-3 py-2 rounded-xl text-xs font-semibold transition-all duration-150 {{ request()->routeIs('admin.pages*') ? 'bg-theme-primary text-white font-bold shadow-lg shadow-theme-primary/25' : 'text-slate-400 hover:text-white hover:bg-slate-800/80 hover:translate-x-0.5' }}">
                    @if(request()->routeIs('admin.pages*'))
                        <span class="absolute left-0 top-2 bottom-2 w-1 rounded-r-full bg-white"></span>
                    @endif
                    <div class="w-7 h-7 rounded-lg flex items-center justify-center mr-2.5 transition {{ request()->routeIs('admin.pages*') ? 'bg-white/20 text-white' : 'bg-slate-800 text-slate-400 group-hover:text-white group-hover:bg-slate-700/80' }}">
                        <i class="fa-solid fa-file-lines text-xs"></i>
                    </div>
                    <span class="flex-1">Halaman Dinamis</span>
                    @if(get_setting('feature_page_builder_enabled', '0') == '1')
                        <span class="px-1.5 py-0.5 rounded text-[9px] font-extrabold bg-purple-500/20 text-purple-300 border border-purple-500/30">Studio</span>
                    @endif
                </a>
            </div>

            <!-- Group 4: Layanan & Interaksi -->
            <div class="space-y-1">
                <div class="px-3 text-[10px] font-extrabold uppercase tracking-wider text-slate-500 mb-2 flex items-center space-x-1.5">
                    <i class="fa-solid fa-hospital-user text-[9px] text-slate-600"></i>
                    <span>Layanan & Interaksi</span>
                </div>

                <a href="{{ route('admin.services.index') }}" class="group relative flex items-center justify-between px-3 py-2 rounded-xl text-xs font-semibold transition-all duration-150 {{ request()->routeIs('admin.services*') ? 'bg-theme-primary text-white font-bold shadow-lg shadow-theme-primary/25' : 'text-slate-400 hover:text-white hover:bg-slate-800/80 hover:translate-x-0.5' }}">
                    <div class="flex items-center">
                        @if(request()->routeIs('admin.services*'))
                            <span class="absolute left-0 top-2 bottom-2 w-1 rounded-r-full bg-white"></span>
                        @endif
                        <div class="w-7 h-7 rounded-lg flex items-center justify-center mr-2.5 transition {{ request()->routeIs('admin.services*') ? 'bg-white/20 text-white' : 'bg-slate-800 text-slate-400 group-hover:text-white group-hover:bg-slate-700/80' }}">
                            <i class="fa-solid fa-briefcase-medical text-xs"></i>
                        </div>
                        <span>Layanan Divisi</span>
                    </div>
                    @if(get_setting('enable_services', '1') === '0')
                        <span class="px-1.5 py-0.5 rounded text-[9px] font-bold bg-slate-800 text-slate-400 border border-slate-700">Off</span>
                    @endif
                </a>

                <a href="{{ route('admin.team.index') }}" class="group relative flex items-center px-3 py-2 rounded-xl text-xs font-semibold transition-all duration-150 {{ request()->routeIs('admin.team*') ? 'bg-theme-primary text-white font-bold shadow-lg shadow-theme-primary/25' : 'text-slate-400 hover:text-white hover:bg-slate-800/80 hover:translate-x-0.5' }}">
                    @if(request()->routeIs('admin.team*'))
                        <span class="absolute left-0 top-2 bottom-2 w-1 rounded-r-full bg-white"></span>
                    @endif
                    <div class="w-7 h-7 rounded-lg flex items-center justify-center mr-2.5 transition {{ request()->routeIs('admin.team*') ? 'bg-white/20 text-white' : 'bg-slate-800 text-slate-400 group-hover:text-white group-hover:bg-slate-700/80' }}">
                        <i class="fa-solid fa-sitemap text-xs"></i>
                    </div>
                    <span>Struktur Organisasi</span>
                </a>

                <a href="{{ route('admin.messages.index') }}" class="group relative flex items-center justify-between px-3 py-2 rounded-xl text-xs font-semibold transition-all duration-150 {{ request()->routeIs('admin.messages*') ? 'bg-theme-primary text-white font-bold shadow-lg shadow-theme-primary/25' : 'text-slate-400 hover:text-white hover:bg-slate-800/80 hover:translate-x-0.5' }}">
                    <div class="flex items-center">
                        @if(request()->routeIs('admin.messages*'))
                            <span class="absolute left-0 top-2 bottom-2 w-1 rounded-r-full bg-white"></span>
                        @endif
                        <div class="w-7 h-7 rounded-lg flex items-center justify-center mr-2.5 transition {{ request()->routeIs('admin.messages*') ? 'bg-white/20 text-white' : 'bg-slate-800 text-slate-400 group-hover:text-white group-hover:bg-slate-700/80' }}">
                            <i class="fa-regular fa-envelope text-xs"></i>
                        </div>
                        <span>Pesan Masuk</span>
                    </div>
                    @php $unread = \App\Models\Message::where('is_read', false)->count(); @endphp
                    @if($unread > 0)
                        <span class="px-2 py-0.5 rounded-full bg-rose-600 text-white text-[10px] font-bold shadow">{{ $unread }}</span>
                    @endif
                </a>
            </div>
            @endif

            <!-- Group 5: Pengaturan Sistem -->
            <div class="space-y-1 pt-2 border-t border-slate-800/60">
                <div class="px-3 text-[10px] font-extrabold uppercase tracking-wider text-amber-500/90 mb-2 flex items-center space-x-1.5">
                    <i class="fa-solid fa-shield-halved text-[9px] text-amber-500"></i>
                    <span>Administrasi & Sistem</span>
                </div>

                <a href="{{ route('admin.settings.index') }}" class="group relative flex items-center px-3 py-2 rounded-xl text-xs font-semibold transition-all duration-150 {{ request()->routeIs('admin.settings*') ? 'bg-theme-primary text-white font-bold shadow-lg shadow-theme-primary/25' : 'text-slate-400 hover:text-amber-300 hover:bg-slate-800/80 hover:translate-x-0.5' }}">
                    @if(request()->routeIs('admin.settings*'))
                        <span class="absolute left-0 top-2 bottom-2 w-1 rounded-r-full bg-white"></span>
                    @endif
                    <div class="w-7 h-7 rounded-lg flex items-center justify-center mr-2.5 transition {{ request()->routeIs('admin.settings*') ? 'bg-white/20 text-white' : 'bg-slate-800 text-amber-400 group-hover:bg-amber-500/20 group-hover:text-amber-300' }}">
                        <i class="fa-solid fa-sliders text-xs"></i>
                    </div>
                    <span>{{ (Auth::check() && Auth::user()->isSuperAdmin()) ? 'Identitas & Preset' : 'Pengaturan Website' }}</span>
                </a>

                @if(Auth::check() && Auth::user()->isSuperAdmin())
                <a href="{{ route('admin.users.index') }}" class="group relative flex items-center px-3 py-2 rounded-xl text-xs font-semibold transition-all duration-150 {{ request()->routeIs('admin.users*') ? 'bg-theme-primary text-white font-bold shadow-lg shadow-theme-primary/25' : 'text-slate-400 hover:text-purple-300 hover:bg-slate-800/80 hover:translate-x-0.5' }}">
                    @if(request()->routeIs('admin.users*'))
                        <span class="absolute left-0 top-2 bottom-2 w-1 rounded-r-full bg-white"></span>
                    @endif
                    <div class="w-7 h-7 rounded-lg flex items-center justify-center mr-2.5 transition {{ request()->routeIs('admin.users*') ? 'bg-white/20 text-white' : 'bg-slate-800 text-purple-400 group-hover:bg-purple-500/20 group-hover:text-purple-300' }}">
                        <i class="fa-solid fa-users-gear text-xs"></i>
                    </div>
                    <span>Kelola Akun Admin</span>
                </a>
                @endif
            </div>

        </div>

        <!-- Bottom Section: Sidebar Footer -->
        <div class="p-3 border-t border-slate-800/80 bg-slate-950/70 shrink-0 space-y-2">
            <a href="{{ route('home') }}" target="_blank" class="flex items-center justify-center space-x-2 w-full py-2.5 rounded-xl bg-slate-800/90 hover:bg-slate-700 text-slate-200 text-xs font-semibold transition-all border border-slate-700/80 shadow-sm group">
                <i class="fa-solid fa-arrow-up-right-from-square text-[11px] text-sky-400 group-hover:scale-110 transition"></i>
                <span>Lihat Website Divisi</span>
            </a>
            <div class="flex items-center justify-between px-2 pt-1 text-[10px] text-slate-500">
                <span>CMS v2.4 • STIKES</span>
                <span class="flex items-center"><span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-1"></span> Siap</span>
            </div>
        </div>
    </aside>

    <!-- Main Content Area -->
    <div class="flex-grow flex flex-col min-w-0">
        <!-- Top Navbar Header -->
        <header class="h-20 bg-white dark:bg-slate-900 border-b border-slate-200 dark:border-slate-800 flex items-center justify-between px-4 sm:px-8 sticky top-0 z-30 shadow-sm transition-colors duration-150">
            <div class="flex items-center space-x-4">
                <button @click="sidebarOpen = true" class="text-slate-600 dark:text-slate-300 lg:hidden p-2 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-sky-500 focus-visible:ring-2 focus-visible:ring-sky-500 focus-visible:ring-offset-2 dark:focus-visible:ring-offset-slate-900" aria-label="Buka Menu Sidebar">
                    <i class="fa-solid fa-bars text-xl"></i>
                </button>
                <div class="hidden sm:block">
                    <div class="text-xs text-slate-500 dark:text-slate-400 font-medium">{{ get_setting('parent_institution', 'STIKES Panti Waluya Malang') }}</div>
                    <div class="text-sm font-bold text-slate-900 dark:text-white">{{ get_setting('division_name', 'Sistem Informasi Divisi') }}</div>
                </div>
            </div>

            <!-- User Menu & Dark Mode Toggle -->
            <div class="flex items-center space-x-3" x-data="{ userMenuOpen: false }">
                <!-- Theme Toggle -->
                <button @click="toggleDark()" type="button" class="w-9 h-9 rounded-xl flex items-center justify-center text-slate-600 hover:text-slate-900 dark:text-amber-400 dark:hover:text-amber-300 hover:bg-slate-100 dark:hover:bg-slate-800 border border-slate-200 dark:border-slate-700 transition shadow-sm focus:outline-none focus:ring-2 focus:ring-sky-500 focus-visible:ring-2 focus-visible:ring-sky-500 focus-visible:ring-offset-2 dark:focus-visible:ring-offset-slate-900" title="Ganti Mode Gelap / Terang" aria-label="Toggle Theme">
                    <i class="fa-solid fa-sun text-sm text-amber-400" x-show="isDark" style="display: none;"></i>
                    <i class="fa-solid fa-moon text-sm text-slate-600" x-show="!isDark"></i>
                </button>

                @if(Auth::check() && Auth::user()->isSuperAdmin())
                <a href="{{ route('admin.settings.index') }}" class="hidden md:inline-flex items-center text-xs px-3 py-1.5 rounded-lg bg-amber-50 text-amber-800 dark:bg-amber-950/50 dark:text-amber-300 border border-amber-200 dark:border-amber-800 hover:bg-amber-100 dark:hover:bg-amber-900/40 transition font-semibold">
                    <i class="fa-solid fa-palette mr-1.5 text-amber-600 dark:text-amber-400"></i> Mode: {{ get_setting('division_acronym', 'DIVISI') }}
                </a>
                @else
                <span class="hidden md:inline-flex items-center text-xs px-3 py-1.5 rounded-lg bg-sky-50 text-sky-800 dark:bg-sky-950/50 dark:text-sky-300 border border-sky-200 dark:border-sky-800 font-semibold">
                    <i class="fa-solid fa-user-shield mr-1.5 text-sky-600 dark:text-sky-400"></i> Admin
                </span>
                @endif

                <div class="relative">
                    <button @click="userMenuOpen = !userMenuOpen" class="flex items-center space-x-3 p-1.5 rounded-xl hover:bg-slate-100 dark:hover:bg-slate-800 transition">
                        <div class="w-8 h-8 rounded-full bg-slate-800 dark:bg-slate-700 text-white flex items-center justify-center text-xs font-bold ring-2 ring-slate-700 dark:ring-slate-600">
                            {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
                        </div>
                        <div class="text-left hidden sm:block">
                            <div class="text-xs font-bold text-slate-700 dark:text-slate-200 leading-tight">{{ Auth::user()->name ?? 'Administrator' }}</div>
                            <div class="text-[10px] text-slate-400 font-semibold">{{ Auth::check() ? Auth::user()->role_badge : 'Admin' }}</div>
                        </div>
                        <i class="fa-solid fa-chevron-down text-[10px] text-slate-400"></i>
                    </button>

                    <div x-show="userMenuOpen" @click.outside="userMenuOpen = false" class="absolute right-0 mt-2 w-48 bg-white dark:bg-slate-900 rounded-xl shadow-xl border border-slate-200 dark:border-slate-800 py-1.5 z-50 text-xs text-slate-700 dark:text-slate-200" style="display: none;">
                        <a href="{{ route('admin.profile') }}" class="block px-4 py-2 hover:bg-slate-50 dark:hover:bg-slate-800 font-medium">
                            <i class="fa-regular fa-user mr-2 text-slate-400"></i> Profil & Password
                        </a>
                        <a href="{{ route('admin.settings.index') }}" class="block px-4 py-2 hover:bg-slate-50 dark:hover:bg-slate-800 font-medium">
                            <i class="fa-solid fa-sliders mr-2 text-slate-400"></i> Pengaturan Divisi
                        </a>
                        @if(Auth::check() && Auth::user()->isSuperAdmin())
                        <a href="{{ route('admin.users.index') }}" class="block px-4 py-2 hover:bg-slate-50 dark:hover:bg-slate-800 font-medium">
                            <i class="fa-solid fa-users-gear mr-2 text-slate-400"></i> Kelola User Admin
                        </a>
                        @endif
                        <div class="border-t border-slate-100 dark:border-slate-800 my-1"></div>
                        <form action="{{ route('admin.logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 text-rose-600 dark:text-rose-400 hover:bg-rose-50 dark:hover:bg-rose-950/40 font-semibold">
                                <i class="fa-solid fa-arrow-right-from-bracket mr-2"></i> Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        <!-- Flash Message Alerts -->
        @if(session('success'))
        <div class="px-4 sm:px-8 mt-6">
            <div class="bg-emerald-50 border-l-4 border-emerald-500 p-4 rounded-r-xl text-emerald-800 text-xs font-medium flex items-center justify-between shadow-sm">
                <div class="flex items-center"><i class="fa-solid fa-circle-check mr-2 text-emerald-600 text-base"></i> {{ session('success') }}</div>
            </div>
        </div>
        @endif
        @if(session('error'))
        <div class="px-4 sm:px-8 mt-6">
            <div class="bg-rose-50 border-l-4 border-rose-500 p-4 rounded-r-xl text-rose-800 text-xs font-medium flex items-center justify-between shadow-sm">
                <div class="flex items-center"><i class="fa-solid fa-circle-exclamation mr-2 text-rose-600 text-base"></i> {{ session('error') }}</div>
            </div>
        </div>
        @endif
        @if($errors->any())
        <div class="px-4 sm:px-8 mt-6">
            <div class="bg-rose-50 border-l-4 border-rose-500 p-4 rounded-r-xl text-rose-800 text-xs font-medium shadow-sm space-y-1">
                <div class="font-bold flex items-center"><i class="fa-solid fa-triangle-exclamation mr-2"></i> Terdapat beberapa kesalahan:</div>
                <ul class="list-disc pl-5 space-y-0.5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif

        <!-- Main Body -->
        <main class="flex-grow p-4 sm:p-8">
            @yield('content')
        </main>
    </div>

    @stack('scripts')
</body>
</html>
