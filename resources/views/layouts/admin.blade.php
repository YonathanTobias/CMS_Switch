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
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            500: '{{ get_setting("theme_primary_color", "#0e7490") }}',
                            600: '{{ get_setting("theme_primary_color", "#0e7490") }}',
                            700: '{{ get_setting("theme_secondary_color", "#0369a1") }}',
                        }
                    }
                }
            }
        }
    </script>
    
    <!-- FontAwesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Quill Editor (WYSIWYG) -->
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>

    <style>
        :root {
            --color-primary: {{ get_setting('theme_primary_color', '#0e7490') }};
        }
        .bg-theme-primary { background-color: var(--color-primary); }
        .text-theme-primary { color: var(--color-primary); }
        .border-theme-primary { border-color: var(--color-primary); }
    </style>
</head>
<body class="bg-slate-100 text-slate-800 font-sans antialiased min-h-screen flex" x-data="{ sidebarOpen: false }">

    <!-- Mobile Sidebar Backdrop -->
    <div x-show="sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 z-40 bg-slate-900/50 backdrop-blur-sm lg:hidden" style="display: none;"></div>

    <!-- Sidebar Navigation -->
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'" class="fixed lg:static inset-y-0 left-0 z-50 w-64 bg-slate-900 text-slate-300 flex flex-col transition-transform duration-200 ease-in-out">
        <!-- Logo / Division Brand Header -->
        <div class="h-20 flex items-center px-6 border-b border-slate-800 bg-slate-950/40">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 rounded-xl flex items-center justify-center text-white font-bold text-lg" style="background-color: var(--color-primary);">
                    <i class="fa-solid fa-hospital-user"></i>
                </div>
                <div class="overflow-hidden">
                    <div class="text-xs uppercase tracking-wider font-bold text-sky-400">Panel CMS Divisi</div>
                    <div class="text-xs font-bold text-white truncate max-w-[140px]">{{ get_setting('division_acronym', 'STIKES') }}</div>
                </div>
            </div>
        </div>

        <!-- Sidebar Menus -->
            <!-- Group: Utama -->
            <div class="space-y-1">
                <div class="px-3 text-[10px] font-bold uppercase tracking-wider text-slate-500 mb-2">Utama</div>
                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-3 py-2.5 rounded-xl transition {{ request()->routeIs('admin.dashboard') ? 'bg-theme-primary text-white font-bold shadow-md' : 'hover:bg-slate-800 text-slate-300' }}">
                    <i class="fa-solid fa-gauge w-5 mr-2"></i> Dashboard
                </a>
                
                @if(Auth::check() && Auth::user()->isSuperAdmin())
                <a href="{{ route('admin.settings.index') }}" class="flex items-center px-3 py-2.5 rounded-xl transition {{ request()->routeIs('admin.settings*') ? 'bg-theme-primary text-white font-bold shadow-md' : 'hover:bg-slate-800 text-amber-400 font-semibold' }}">
                    <i class="fa-solid fa-wand-magic-sparkles w-5 mr-2 text-amber-400"></i> Identitas & Preset Divisi
                </a>
                <a href="{{ route('admin.users.index') }}" class="flex items-center px-3 py-2.5 rounded-xl transition {{ request()->routeIs('admin.users*') ? 'bg-theme-primary text-white font-bold shadow-md' : 'hover:bg-slate-800 text-purple-400 font-semibold' }}">
                    <i class="fa-solid fa-users-gear w-5 mr-2 text-purple-400"></i> Kelola Akun Admin
                </a>
                @endif
            </div>

            <!-- Group: Konten Divisi -->
            <div class="space-y-1">
                <div class="px-3 text-[10px] font-bold uppercase tracking-wider text-slate-500 mb-2">Konten & Informasi</div>
                <a href="{{ route('admin.carousels.index') }}" class="flex items-center px-3 py-2.5 rounded-xl transition {{ request()->routeIs('admin.carousels*') ? 'bg-theme-primary text-white font-bold shadow-md' : 'hover:bg-slate-800 text-slate-300' }}">
                    <i class="fa-solid fa-images w-5 mr-2"></i> Carousel / Slider Banner
                </a>
                <a href="{{ route('admin.menus.index') }}" class="flex items-center px-3 py-2.5 rounded-xl transition {{ request()->routeIs('admin.menus*') ? 'bg-theme-primary text-white font-bold shadow-md' : 'hover:bg-slate-800 text-slate-300' }}">
                    <i class="fa-solid fa-compass w-5 mr-2"></i> Menu Navigasi
                </a>
                <a href="{{ route('admin.posts.index') }}" class="flex items-center px-3 py-2.5 rounded-xl transition {{ request()->routeIs('admin.posts*') ? 'bg-theme-primary text-white font-bold shadow-md' : 'hover:bg-slate-800 text-slate-300' }}">
                    <i class="fa-regular fa-newspaper w-5 mr-2"></i> Berita & Pengumuman
                </a>
                <a href="{{ route('admin.categories.index') }}" class="flex items-center px-3 py-2.5 rounded-xl transition {{ request()->routeIs('admin.categories*') ? 'bg-theme-primary text-white font-bold shadow-md' : 'hover:bg-slate-800 text-slate-300' }}">
                    <i class="fa-solid fa-tags w-5 mr-2"></i> Kategori
                </a>
                <a href="{{ route('admin.services.index') }}" class="flex items-center justify-between px-3 py-2.5 rounded-xl transition {{ request()->routeIs('admin.services*') ? 'bg-theme-primary text-white font-bold shadow-md' : 'hover:bg-slate-800 text-slate-300' }}">
                    <span class="flex items-center"><i class="fa-solid fa-briefcase-medical w-5 mr-2"></i> Layanan</span>
                    @if(get_setting('enable_services', '1') === '0')
                        <span class="px-1.5 py-0.5 rounded text-[9px] font-bold bg-slate-800 text-slate-400 border border-slate-700">Off</span>
                    @endif
                </a>
                <a href="{{ route('admin.team.index') }}" class="flex items-center px-3 py-2.5 rounded-xl transition {{ request()->routeIs('admin.team*') ? 'bg-theme-primary text-white font-bold shadow-md' : 'hover:bg-slate-800 text-slate-300' }}">
                    <i class="fa-solid fa-sitemap w-5 mr-2"></i> Struktur Organisasi
                </a>
                <a href="{{ route('admin.events.index') }}" class="flex items-center px-3 py-2.5 rounded-xl transition {{ request()->routeIs('admin.events*') ? 'bg-theme-primary text-white font-bold shadow-md' : 'hover:bg-slate-800 text-slate-300' }}">
                    <i class="fa-regular fa-calendar-days w-5 mr-2"></i> Agenda Kegiatan
                </a>
                <a href="{{ route('admin.documents.index') }}" class="flex items-center px-3 py-2.5 rounded-xl transition {{ request()->routeIs('admin.documents*') ? 'bg-theme-primary text-white font-bold shadow-md' : 'hover:bg-slate-800 text-slate-300' }}">
                    <i class="fa-solid fa-file-arrow-down w-5 mr-2"></i> Dokumen & Unduhan
                </a>
                <a href="{{ route('admin.galleries.index') }}" class="flex items-center px-3 py-2.5 rounded-xl transition {{ request()->routeIs('admin.galleries*') ? 'bg-theme-primary text-white font-bold shadow-md' : 'hover:bg-slate-800 text-slate-300' }}">
                    <i class="fa-regular fa-images w-5 mr-2"></i> Galeri Foto
                </a>
                <a href="{{ route('admin.pages.index') }}" class="flex items-center px-3 py-2.5 rounded-xl transition {{ request()->routeIs('admin.pages*') ? 'bg-theme-primary text-white font-bold shadow-md' : 'hover:bg-slate-800 text-slate-300' }}">
                    <i class="fa-solid fa-file-lines w-5 mr-2"></i> Halaman Dinamis
                </a>
                <a href="{{ route('admin.messages.index') }}" class="flex items-center justify-between px-3 py-2.5 rounded-xl transition {{ request()->routeIs('admin.messages*') ? 'bg-theme-primary text-white font-bold shadow-md' : 'hover:bg-slate-800 text-slate-300' }}">
                    <span class="flex items-center"><i class="fa-regular fa-envelope w-5 mr-2"></i> Pesan Masuk</span>
                    @php $unread = \App\Models\Message::where('is_read', false)->count(); @endphp
                    @if($unread > 0)
                        <span class="px-2 py-0.5 rounded-full bg-rose-600 text-white text-[10px] font-bold">{{ $unread }}</span>
                    @endif
                </a>
            </div>
        </div>

        <!-- Sidebar Footer -->
        <div class="p-4 border-t border-slate-800 bg-slate-950/50">
            <a href="{{ route('home') }}" target="_blank" class="flex items-center justify-center space-x-2 w-full py-2 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-200 text-xs font-semibold transition border border-slate-700">
                <i class="fa-solid fa-arrow-up-right-from-square text-[11px]"></i>
                <span>Buka Website Divisi</span>
            </a>
        </div>
    </aside>

    <!-- Main Content Area -->
    <div class="flex-grow flex flex-col min-w-0">
        <!-- Top Navbar Header -->
        <header class="h-20 bg-white border-b border-slate-200 flex items-center justify-between px-4 sm:px-8 sticky top-0 z-30 shadow-sm">
            <div class="flex items-center space-x-4">
                <button @click="sidebarOpen = true" class="text-slate-600 lg:hidden p-2 rounded-lg hover:bg-slate-100">
                    <i class="fa-solid fa-bars text-xl"></i>
                </button>
                <div class="hidden sm:block">
                    <div class="text-xs text-slate-500 font-medium">{{ get_setting('parent_institution', 'STIKES Panti Waluya Malang') }}</div>
                    <div class="text-sm font-bold text-slate-900">{{ get_setting('division_name', 'Sistem Informasi Divisi') }}</div>
                </div>
            </div>

            <!-- User Menu -->
            <div class="flex items-center space-x-4" x-data="{ userMenuOpen: false }">
                @if(Auth::check() && Auth::user()->isSuperAdmin())
                <a href="{{ route('admin.settings.index') }}" class="hidden md:inline-flex items-center text-xs px-3 py-1.5 rounded-lg bg-amber-50 text-amber-800 border border-amber-200 hover:bg-amber-100 transition font-semibold">
                    <i class="fa-solid fa-palette mr-1.5 text-amber-600"></i> Mode: {{ get_setting('division_acronym', 'DIVISI') }}
                </a>
                @else
                <span class="hidden md:inline-flex items-center text-xs px-3 py-1.5 rounded-lg bg-sky-50 text-sky-800 border border-sky-200 font-semibold">
                    <i class="fa-solid fa-user-shield mr-1.5 text-sky-600"></i> Admin Divisi
                </span>
                @endif

                <div class="relative">
                    <button @click="userMenuOpen = !userMenuOpen" class="flex items-center space-x-3 p-1.5 rounded-xl hover:bg-slate-100 transition">
                        <div class="w-8 h-8 rounded-full bg-slate-800 text-white flex items-center justify-center text-xs font-bold">
                            {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
                        </div>
                        <div class="text-left hidden sm:block">
                            <div class="text-xs font-bold text-slate-700 leading-tight">{{ Auth::user()->name ?? 'Administrator' }}</div>
                            <div class="text-[10px] text-slate-400 font-semibold">{{ Auth::user()->isSuperAdmin() ? 'Admin IT' : 'Admin Divisi' }}</div>
                        </div>
                        <i class="fa-solid fa-chevron-down text-[10px] text-slate-400"></i>
                    </button>

                    <div x-show="userMenuOpen" @click.outside="userMenuOpen = false" class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg border border-slate-200 py-1.5 z-50 text-xs text-slate-700" style="display: none;">
                        <a href="{{ route('admin.profile') }}" class="block px-4 py-2 hover:bg-slate-50 font-medium">
                            <i class="fa-regular fa-user mr-2 text-slate-400"></i> Profil & Password
                        </a>
                        @if(Auth::check() && Auth::user()->isSuperAdmin())
                        <a href="{{ route('admin.settings.index') }}" class="block px-4 py-2 hover:bg-slate-50 font-medium">
                            <i class="fa-solid fa-sliders mr-2 text-slate-400"></i> Pengaturan Divisi
                        </a>
                        <a href="{{ route('admin.users.index') }}" class="block px-4 py-2 hover:bg-slate-50 font-medium">
                            <i class="fa-solid fa-users-gear mr-2 text-slate-400"></i> Kelola User Admin
                        </a>
                        @endif
                        <div class="border-t border-slate-100 my-1"></div>
                        <form action="{{ route('admin.logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 text-rose-600 hover:bg-rose-50 font-semibold">
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
