<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', get_setting('division_short_name', 'Divisi STIKES Panti Waluya')) - {{ get_setting('parent_institution', 'STIKES Panti Waluya Malang') }}</title>
    <meta name="description" content="{{ get_setting('division_tagline', 'Website Resmi Divisi STIKES Panti Waluya Malang') }}">
    
    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="{{ asset('js/frontend.js') }}"></script>
    
    <!-- FontAwesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Custom Separated Stylesheet -->
    <link rel="stylesheet" href="{{ asset('css/frontend.css') }}">
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Dynamic Theme Color Variables -->
    <style>
        :root {
            --color-primary: {{ get_setting('theme_primary_color', '#0e7490') }};
            --color-secondary: {{ get_setting('theme_secondary_color', '#0369a1') }};
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 font-sans antialiased flex flex-col min-h-screen">

    <!-- Topbar Info -->
    <div class="bg-slate-900 text-slate-300 text-xs py-2 px-4 border-b border-slate-800">
        <div class="max-w-7xl mx-auto flex flex-col sm:flex-row justify-between items-center gap-2">
            <div class="flex items-center space-x-4">
                <span class="flex items-center"><i class="fa-solid fa-graduation-cap text-sky-400 mr-1.5"></i> {{ get_setting('parent_institution', 'STIKES Panti Waluya Malang') }}</span>
                <span class="hidden md:inline-block text-slate-600">|</span>
                <span class="hidden md:flex items-center"><i class="fa-regular fa-envelope text-sky-400 mr-1.5"></i> {{ get_setting('contact_email', 'info@pantiwaluya.ac.id') }}</span>
                <span class="hidden lg:flex items-center"><i class="fa-solid fa-phone text-sky-400 mr-1.5"></i> {{ get_setting('contact_phone', '(0341) 569275') }}</span>
            </div>
            <div class="flex items-center space-x-3">
                @if(get_setting('social_instagram'))
                    <a href="{{ get_setting('social_instagram') }}" target="_blank" class="hover:text-pink-400 transition" title="Instagram"><i class="fa-brands fa-instagram"></i></a>
                @endif
                @if(get_setting('social_facebook'))
                    <a href="{{ get_setting('social_facebook') }}" target="_blank" class="hover:text-blue-400 transition" title="Facebook"><i class="fa-brands fa-facebook"></i></a>
                @endif
                @if(get_setting('social_youtube'))
                    <a href="{{ get_setting('social_youtube') }}" target="_blank" class="hover:text-red-400 transition" title="YouTube"><i class="fa-brands fa-youtube"></i></a>
                @endif
                <a href="{{ route('admin.login') }}" class="text-xs bg-slate-800 hover:bg-slate-700 text-slate-200 px-2.5 py-1 rounded transition border border-slate-700 ml-2">
                    <i class="fa-solid fa-lock text-[10px] mr-1"></i> Admin CMS
                </a>
            </div>
        </div>
    </div>

    <!-- Main Navigation Header -->
    <header class="bg-white sticky top-0 z-50 shadow-sm border-b border-slate-200" x-data="{ mobileMenuOpen: false }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo & Division Title -->
                <a href="{{ route('home') }}" class="flex items-center space-x-3 group">
                    <div class="w-12 h-12 rounded-xl flex items-center justify-center text-white shadow-md transition group-hover:scale-105" style="background: linear-gradient(135deg, var(--color-primary), var(--color-secondary));">
                        @if(get_setting('logo_url'))
                            <img src="{{ get_setting('logo_url') }}" alt="Logo" class="w-10 h-10 object-contain">
                        @else
                            <i class="{{ get_setting('division_icon', 'fa-solid fa-hospital-user') }} text-2xl"></i>
                        @endif
                    </div>
                    <div>
                        <div class="text-xs uppercase tracking-wider font-semibold text-slate-500">{{ get_setting('parent_institution', 'STIKES Panti Waluya') }}</div>
                        <div class="text-lg font-bold text-slate-900 leading-tight group-hover:text-theme-primary transition">{{ get_setting('division_short_name', 'Divisi Kampus') }}</div>
                    </div>
                </a>

                @php
                    $navItems = get_nav_menus();
                    $enableServices = get_setting('enable_services', '1') !== '0';
                @endphp

                <!-- Desktop Menu -->
                <nav class="hidden lg:flex items-center space-x-1 font-medium text-sm text-slate-700">
                    @foreach($navItems as $nav)
                        @if($nav->url === '/layanan' && !$enableServices)
                            @continue
                        @endif
                        @php
                            $path = ltrim($nav->url, '/');
                            $hasChildren = isset($nav->children) && $nav->children->count() > 0;
                            $isActive = ($nav->url === '/' && request()->is('/')) || ($nav->url !== '/' && $path && (request()->is($path) || request()->is($path . '/*')));
                        @endphp

                        @if($hasChildren)
                            <div class="relative" x-data="{ dropdownOpen: false }" @mouseenter="dropdownOpen = true" @mouseleave="dropdownOpen = false">
                                <button @click="dropdownOpen = !dropdownOpen" type="button" class="px-3 py-2 rounded-lg hover:text-theme-primary transition flex items-center space-x-1 {{ $isActive ? 'text-theme-primary font-bold bg-slate-100' : '' }}">
                                    <span>{{ $nav->label }}</span>
                                    <i class="fa-solid fa-chevron-down text-[10px] ml-1 opacity-70 transition-transform duration-200" :class="{ 'rotate-180': dropdownOpen }"></i>
                                </button>
                                <div x-show="dropdownOpen" 
                                     x-transition:enter="transition ease-out duration-150"
                                     x-transition:enter-start="opacity-0 translate-y-1"
                                     x-transition:enter-end="opacity-100 translate-y-0"
                                     x-transition:leave="transition ease-in duration-100"
                                     x-transition:leave-start="opacity-100 translate-y-0"
                                     x-transition:leave-end="opacity-0 translate-y-1"
                                     class="absolute top-full left-0 mt-1 min-w-[220px] bg-white rounded-xl shadow-xl border border-slate-200/80 py-2 z-50 divide-y divide-slate-50" 
                                     style="display: none;">
                                    @foreach($nav->children as $child)
                                        @if($child->url === '/layanan' && !$enableServices)
                                            @continue
                                        @endif
                                        @php
                                            $childPath = ltrim($child->url, '/');
                                            $isChildActive = ($child->url === '/' && request()->is('/')) || ($child->url !== '/' && $childPath && (request()->is($childPath) || request()->is($childPath . '/*')));
                                        @endphp
                                        <a href="{{ $child->url }}" target="{{ $child->target ?? '_self' }}" class="block px-4 py-2 text-xs font-semibold text-slate-700 hover:bg-slate-50 hover:text-theme-primary transition {{ $isChildActive ? 'text-theme-primary bg-slate-50 font-bold' : '' }}">
                                            {{ $child->label }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @else
                            <a href="{{ $nav->url }}" target="{{ $nav->target ?? '_self' }}" class="px-3 py-2 rounded-lg hover:text-theme-primary transition {{ $isActive ? 'text-theme-primary font-bold bg-slate-100' : '' }}">
                                {{ $nav->label }}
                            </a>
                        @endif
                    @endforeach
                    
                    <a href="{{ route('contact') }}" class="ml-3 inline-flex items-center text-white px-4 py-2 rounded-lg shadow-sm hover:opacity-90 transition font-medium text-xs tracking-wide uppercase" style="background-color: var(--color-primary);">
                        <i class="fa-solid fa-paper-plane mr-2"></i> Hubungi Kami
                    </a>
                </nav>

                <!-- Mobile Menu Button -->
                <div class="flex items-center lg:hidden">
                    <button @click="mobileMenuOpen = !mobileMenuOpen" type="button" class="text-slate-600 hover:text-slate-900 p-2 rounded-lg focus:outline-none">
                        <i class="fa-solid fa-bars text-xl" x-show="!mobileMenuOpen"></i>
                        <i class="fa-solid fa-xmark text-xl" x-show="mobileMenuOpen" style="display: none;"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu Dropdown -->
        <div class="lg:hidden border-t border-slate-200 bg-white" x-show="mobileMenuOpen" x-transition style="display: none;">
            <div class="px-4 pt-3 pb-6 space-y-1 text-sm font-medium">
                @foreach($navItems as $nav)
                    @if($nav->url === '/layanan' && !$enableServices)
                        @continue
                    @endif
                    @php
                        $path = ltrim($nav->url, '/');
                        $hasChildren = isset($nav->children) && $nav->children->count() > 0;
                        $isActive = ($nav->url === '/' && request()->is('/')) || ($nav->url !== '/' && $path && (request()->is($path) || request()->is($path . '/*')));
                    @endphp

                    @if($hasChildren)
                        <div x-data="{ subOpen: false }" class="space-y-1">
                            <button @click="subOpen = !subOpen" type="button" class="w-full flex items-center justify-between px-3 py-2 rounded-md hover:bg-slate-100 text-left {{ $isActive ? 'text-theme-primary font-bold bg-slate-50' : '' }}">
                                <span>{{ $nav->label }}</span>
                                <i class="fa-solid fa-chevron-down text-xs text-slate-400 transition-transform" :class="{ 'rotate-180 text-theme-primary': subOpen }"></i>
                            </button>
                            <div x-show="subOpen" x-transition class="pl-4 space-y-1 border-l-2 border-slate-100 ml-3 my-1" style="display: none;">
                                @foreach($nav->children as $child)
                                    @if($child->url === '/layanan' && !$enableServices)
                                        @continue
                                    @endif
                                    <a href="{{ $child->url }}" target="{{ $child->target ?? '_self' }}" class="block px-3 py-1.5 rounded-md text-xs text-slate-600 hover:bg-slate-100 hover:text-theme-primary">
                                        {{ $child->label }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <a href="{{ $nav->url }}" target="{{ $nav->target ?? '_self' }}" class="block px-3 py-2 rounded-md hover:bg-slate-100 {{ $isActive ? 'text-theme-primary font-bold bg-slate-50' : '' }}">
                            {{ $nav->label }}
                        </a>
                    @endif
                @endforeach
            </div>
        </div>
    </header>

    <!-- Flash Notification Alerts -->
    @if(session('success'))
        <div class="max-w-7xl mx-auto px-4 mt-4 w-full">
            <div class="bg-emerald-50 border-l-4 border-emerald-500 p-4 rounded-r-lg text-emerald-800 text-sm flex items-center justify-between shadow-sm">
                <div class="flex items-center"><i class="fa-solid fa-circle-check mr-2 text-emerald-600 text-lg"></i> {{ session('success') }}</div>
            </div>
        </div>
    @endif
    @if(session('error'))
        <div class="max-w-7xl mx-auto px-4 mt-4 w-full">
            <div class="bg-rose-50 border-l-4 border-rose-500 p-4 rounded-r-lg text-rose-800 text-sm flex items-center justify-between shadow-sm">
                <div class="flex items-center"><i class="fa-solid fa-circle-exclamation mr-2 text-rose-600 text-lg"></i> {{ session('error') }}</div>
            </div>
        </div>
    @endif

    <!-- Main Content Body -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-slate-900 text-slate-300 pt-16 pb-8 border-t border-slate-800 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 pb-12 border-b border-slate-800">
                <!-- Col 1: Identity -->
                <div class="space-y-4">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 rounded-lg flex items-center justify-center text-white font-bold" style="background-color: var(--color-primary);">
                            @if(get_setting('logo_url'))
                                <img src="{{ get_setting('logo_url') }}" alt="Logo" class="w-8 h-8 object-contain">
                            @else
                                <i class="{{ get_setting('division_icon', 'fa-solid fa-hospital-user') }} text-lg"></i>
                            @endif
                        </div>
                        <div>
                            <div class="font-bold text-white leading-snug">{{ get_setting('division_short_name', 'Divisi STIKES') }}</div>
                            <div class="text-xs text-slate-400">{{ get_setting('parent_institution', 'STIKES Panti Waluya Malang') }}</div>
                        </div>
                    </div>
                    <p class="text-xs text-slate-400 leading-relaxed">
                        {{ get_setting('division_tagline', 'Mewujudkan layanan akademik dan kesehatan unggul berlandaskan kasih.') }}
                    </p>
                    <div class="flex items-center space-x-3 pt-2">
                        @if(get_setting('social_instagram'))
                            <a href="{{ get_setting('social_instagram') }}" target="_blank" class="w-8 h-8 rounded-full bg-slate-800 hover:bg-pink-600 flex items-center justify-center text-white text-xs transition"><i class="fa-brands fa-instagram"></i></a>
                        @endif
                        @if(get_setting('social_facebook'))
                            <a href="{{ get_setting('social_facebook') }}" target="_blank" class="w-8 h-8 rounded-full bg-slate-800 hover:bg-blue-600 flex items-center justify-center text-white text-xs transition"><i class="fa-brands fa-facebook"></i></a>
                        @endif
                        @if(get_setting('social_youtube'))
                            <a href="{{ get_setting('social_youtube') }}" target="_blank" class="w-8 h-8 rounded-full bg-slate-800 hover:bg-red-600 flex items-center justify-center text-white text-xs transition"><i class="fa-brands fa-youtube"></i></a>
                        @endif
                    </div>
                </div>

                <!-- Col 2: Quick Links -->
                <div>
                    <h3 class="text-sm font-semibold text-white uppercase tracking-wider mb-4">Tautan Penting</h3>
                    <ul class="space-y-2.5 text-xs text-slate-400">
                        <li><a href="{{ route('profile') }}" class="hover:text-white transition flex items-center"><i class="fa-solid fa-chevron-right text-[10px] mr-2 text-sky-500"></i> Tentang & Struktur Organisasi</a></li>
                        @if(get_setting('enable_services', '1') !== '0')
                        <li><a href="{{ route('services') }}" class="hover:text-white transition flex items-center"><i class="fa-solid fa-chevron-right text-[10px] mr-2 text-sky-500"></i> Layanan & Prosedur</a></li>
                        @endif
                        <li><a href="{{ route('posts', ['type' => 'pengumuman']) }}" class="hover:text-white transition flex items-center"><i class="fa-solid fa-chevron-right text-[10px] mr-2 text-sky-500"></i> Pengumuman Resmi</a></li>
                        <li><a href="{{ route('events') }}" class="hover:text-white transition flex items-center"><i class="fa-solid fa-chevron-right text-[10px] mr-2 text-sky-500"></i> Agenda & Jadwal Kegiatan</a></li>
                        <li><a href="{{ route('documents') }}" class="hover:text-white transition flex items-center"><i class="fa-solid fa-chevron-right text-[10px] mr-2 text-sky-500"></i> Download Dokumen & Formulir</a></li>
                    </ul>
                </div>

                <!-- Col 3: Layanan & Jam Operasional -->
                <div>
                    <h3 class="text-sm font-semibold text-white uppercase tracking-wider mb-4">Jam Pelayanan</h3>
                    <div class="space-y-3 text-xs text-slate-400">
                        <div class="flex items-start space-x-2.5">
                            <i class="fa-regular fa-clock text-sky-400 mt-0.5"></i>
                            <div>
                                <span class="font-medium text-slate-200 block">Waktu Operasional:</span>
                                <span>{{ get_setting('operating_hours', 'Senin - Jumat: 08.00 - 16.00 WIB') }}</span>
                            </div>
                        </div>
                        <div class="flex items-start space-x-2.5">
                            <i class="fa-solid fa-door-open text-sky-400 mt-0.5"></i>
                            <div>
                                <span class="font-medium text-slate-200 block">Ruangan / Kantor:</span>
                                <span>{{ get_setting('contact_room', 'Gedung Rektorat') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Col 4: Kontak Kantor -->
                <div>
                    <h3 class="text-sm font-semibold text-white uppercase tracking-wider mb-4">Informasi Kontak</h3>
                    <div class="space-y-2.5 text-xs text-slate-400">
                        <p class="flex items-start space-x-2.5">
                            <i class="fa-solid fa-location-dot text-sky-400 mt-0.5"></i>
                            <span>{{ get_setting('contact_address', 'Jl. Yulius Usman No. 62, Kota Malang') }}</span>
                        </p>
                        <p class="flex items-center space-x-2.5">
                            <i class="fa-regular fa-envelope text-sky-400"></i>
                            <span>{{ get_setting('contact_email', 'info@pantiwaluya.ac.id') }}</span>
                        </p>
                        <p class="flex items-center space-x-2.5">
                            <i class="fa-solid fa-phone text-sky-400"></i>
                            <span>{{ get_setting('contact_phone', '(0341) 569275') }}</span>
                        </p>
                        @if(get_setting('contact_whatsapp'))
                            <p class="flex items-center space-x-2.5">
                                <i class="fa-brands fa-whatsapp text-emerald-400"></i>
                                <span>{{ get_setting('contact_whatsapp') }}</span>
                            </p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Bottom Copyright -->
            <div class="pt-8 flex flex-col sm:flex-row justify-between items-center text-xs text-slate-500 gap-4">
                <p>&copy; {{ date('Y') }} {{ get_setting('division_name', 'Divisi STIKES Panti Waluya') }}. Hak Cipta Dilindungi.</p>
                <p>Website Resmi {{ get_setting('parent_institution', 'STIKES Panti Waluya Malang') }}</p>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
