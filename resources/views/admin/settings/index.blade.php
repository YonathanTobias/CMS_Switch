@extends('layouts.admin')

@section('title', 'Identitas & Pengaturan Divisi')

@section('content')
<div class="space-y-8" x-data="{ activeTab: 'presets' }">
    <div>
        <h1 class="text-2xl font-extrabold text-slate-900">Konfigurasi Identitas & Preset Divisi</h1>
        <p class="text-xs text-slate-500 mt-1">Ubah identitas sistem ini menjadi divisi mana pun di STIKES Panti Waluya dengan 1-klik preset atau sesuaikan secara manual.</p>
    </div>

    <!-- Navigation Tabs -->
    <div class="flex flex-wrap gap-2 border-b border-slate-200 pb-3 text-xs font-bold">
        <button @click="activeTab = 'presets'" :class="activeTab === 'presets' ? 'bg-amber-500 text-slate-950 shadow' : 'bg-white text-slate-600 hover:bg-slate-50'" class="px-4 py-2 rounded-xl transition flex items-center">
            <i class="fa-solid fa-wand-magic-sparkles mr-2 text-slate-950"></i> 1-Click Preset Switcher
        </button>
        <button @click="activeTab = 'general'" :class="activeTab === 'general' ? 'bg-theme-primary text-white shadow' : 'bg-white text-slate-600 hover:bg-slate-50'" class="px-4 py-2 rounded-xl transition flex items-center">
            <i class="fa-solid fa-id-card mr-2"></i> Identitas & Penamaan
        </button>
        <button @click="activeTab = 'branding'" :class="activeTab === 'branding' ? 'bg-theme-primary text-white shadow' : 'bg-white text-slate-600 hover:bg-slate-50'" class="px-4 py-2 rounded-xl transition flex items-center">
            <i class="fa-solid fa-palette mr-2"></i> Visual & Warna Tema
        </button>
        <button @click="activeTab = 'profile'" :class="activeTab === 'profile' ? 'bg-theme-primary text-white shadow' : 'bg-white text-slate-600 hover:bg-slate-50'" class="px-4 py-2 rounded-xl transition flex items-center">
            <i class="fa-solid fa-compass mr-2"></i> Visi, Misi & Tentang
        </button>
        <button @click="activeTab = 'highlight'" :class="activeTab === 'highlight' ? 'bg-theme-primary text-white shadow' : 'bg-white text-slate-600 hover:bg-slate-50'" class="px-4 py-2 rounded-xl transition flex items-center">
            <i class="fa-solid fa-star mr-2"></i> Kotak Sorotan Beranda
        </button>
        <button @click="activeTab = 'contact'" :class="activeTab === 'contact' ? 'bg-theme-primary text-white shadow' : 'bg-white text-slate-600 hover:bg-slate-50'" class="px-4 py-2 rounded-xl transition flex items-center">
            <i class="fa-solid fa-location-dot mr-2"></i> Kontak & Peta
        </button>
        <button @click="activeTab = 'stats'" :class="activeTab === 'stats' ? 'bg-theme-primary text-white shadow' : 'bg-white text-slate-600 hover:bg-slate-50'" class="px-4 py-2 rounded-xl transition flex items-center">
            <i class="fa-solid fa-chart-simple mr-2"></i> Statistik Beranda
        </button>
        <button @click="activeTab = 'features'" :class="activeTab === 'features' ? 'bg-purple-600 text-white shadow' : 'bg-white text-slate-600 hover:bg-slate-50'" class="px-4 py-2 rounded-xl transition flex items-center">
            <i class="fa-solid fa-flask mr-2 text-amber-400"></i> Fitur Tambahan & Lab
        </button>
    </div>

    <!-- TAB 1: 1-CLICK PRESET SWITCHER -->
    <div x-show="activeTab === 'presets'" class="space-y-6">
        <div class="bg-amber-50 border border-amber-200 rounded-2xl p-4 sm:p-6 text-amber-900 text-xs">
            <div class="flex items-start space-x-3">
                <i class="fa-solid fa-lightbulb text-amber-600 text-lg mt-0.5"></i>
                <div class="space-y-1">
                    <span class="font-bold text-sm block">Fitur Master Preset Switcher Divisi</span>
                    <p class="leading-relaxed">
                        Pilih salah satu preset divisi di bawah ini untuk langsung mengubah seluruh profil, nama divisi, visi misi, warna tema website, kontak, dan statistik beranda secara instan.
                    </p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($presets as $key => $preset)
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-200 flex flex-col justify-between space-y-4 hover:shadow-md transition">
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-2">
                            <div class="w-8 h-8 rounded-xl flex items-center justify-center text-white text-sm shadow-sm" style="background-color: {{ $preset['color'] }};">
                                <i class="{{ $preset['icon'] ?? 'fa-solid fa-hospital-user' }}"></i>
                            </div>
                            <span class="px-2.5 py-1 rounded-full text-[10px] font-extrabold uppercase text-white" style="background-color: {{ $preset['color'] }};">
                                {{ $preset['badge'] }}
                            </span>
                        </div>
                        <div class="w-6 h-6 rounded-full border-2 border-slate-200" style="background-color: {{ $preset['color'] }};" title="Warna Tema"></div>
                    </div>

                    <h3 class="font-bold text-base text-slate-900 leading-snug">{{ $preset['name'] }}</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">{{ $preset['description'] }}</p>
                    
                    <div class="p-3 bg-slate-50 rounded-xl border border-slate-100 text-[11px] text-slate-600 space-y-1">
                        <div><strong class="text-slate-800">Email:</strong> {{ $preset['settings']['contact_email'] }}</div>
                        <div><strong class="text-slate-800">Ruangan:</strong> {{ $preset['settings']['contact_room'] }}</div>
                    </div>
                </div>

                <form action="{{ route('admin.settings.preset') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menerapkan preset divisi ini? Seluruh pengaturan identitas akan diubah.');">
                    @csrf
                    <input type="hidden" name="preset_key" value="{{ $key }}">
                    <button type="submit" class="w-full py-2.5 rounded-xl text-white font-bold text-xs uppercase tracking-wider shadow hover:opacity-90 transition flex items-center justify-center space-x-2" style="background-color: {{ $preset['color'] }};">
                        <i class="fa-solid fa-wand-magic-sparkles text-xs"></i>
                        <span>Terapkan Preset Ini</span>
                    </button>
                </form>
            </div>
            @endforeach
        </div>
    </div>

    <!-- MAIN FORM FOR MANUAL CONFIGURATION -->
    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <!-- TAB 2: IDENTITAS & PENAMAAN -->
        <div x-show="activeTab === 'general'" class="bg-white rounded-2xl p-6 sm:p-8 shadow-sm border border-slate-200 space-y-6">
            <h3 class="text-base font-bold text-slate-900 border-b pb-3">Identitas & Penamaan Divisi</h3>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div class="space-y-1 sm:col-span-2">
                    <label class="text-xs font-bold text-slate-700">Nama Lengkap Divisi <span class="text-rose-500">*</span></label>
                    <input type="text" name="division_name" value="{{ old('division_name', $settings['division_name'] ?? '') }}" required class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:bg-white" placeholder="Contoh: Lembaga Penelitian dan Pengabdian kepada Masyarakat (LPPM)">
                </div>

                <div class="space-y-1">
                    <label class="text-xs font-bold text-slate-700">Nama Singkat / Header</label>
                    <input type="text" name="division_short_name" value="{{ old('division_short_name', $settings['division_short_name'] ?? '') }}" class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:bg-white" placeholder="Contoh: LPPM STIKES Panti Waluya">
                </div>

                <div class="space-y-1">
                    <label class="text-xs font-bold text-slate-700">Akronim / Singkatan Singkat</label>
                    <input type="text" name="division_acronym" value="{{ old('division_acronym', $settings['division_acronym'] ?? '') }}" class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:bg-white" placeholder="Contoh: LPPM / BIMA / FARMASI">
                </div>

                <div class="space-y-1 sm:col-span-2">
                    <label class="text-xs font-bold text-slate-700">Motto / Slogan Divisi</label>
                    <input type="text" name="division_tagline" value="{{ old('division_tagline', $settings['division_tagline'] ?? '') }}" class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:bg-white" placeholder="Contoh: Mendorong Riset & Pengabdian Berbasis Pelayanan Kesehatan Holistik">
                </div>

                <div class="space-y-1 sm:col-span-2">
                    <label class="text-xs font-bold text-slate-700">Tipe / Kategori Divisi <span class="text-rose-500">*</span></label>
                    <select name="division_type" class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:bg-white">
                        <option value="lembaga" {{ ($settings['division_type'] ?? '') == 'lembaga' ? 'selected' : '' }}>Lembaga / Pusat Riset (LPPM / LPM)</option>
                        <option value="biro" {{ ($settings['division_type'] ?? '') == 'biro' ? 'selected' : '' }}>Biro / Bagian Kemahasiswaan (BIMA / BAAK)</option>
                        <option value="prodi" {{ ($settings['division_type'] ?? '') == 'prodi' ? 'selected' : '' }}>🎓 Program Studi (Prodi Keperawatan / Farmasi / Kebidanan)</option>
                        <option value="upt" {{ ($settings['division_type'] ?? '') == 'upt' ? 'selected' : '' }}>Unit Pelaksana Teknis (UPT Perpustakaan / Lab)</option>
                    </select>
                    <p class="text-[11px] text-slate-400">Jika memilih **Program Studi**, beranda otomatis menampilkan blok khusus Visi, Misi, Jenjang, Akreditasi, dan Profil Lulusan.</p>
                </div>

                <!-- Khusus Program Studi (Prodi) Fields -->
                <div class="sm:col-span-2 p-4 bg-sky-50/60 rounded-2xl border border-sky-100 space-y-4">
                    <div class="flex items-center space-x-2 text-sky-800 font-bold text-xs">
                        <i class="fa-solid fa-graduation-cap text-sky-600"></i>
                        <span>Pengaturan Khusus Program Studi (Prodi)</span>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="space-y-1">
                            <label class="text-xs font-bold text-slate-700">Jenjang & Gelar Kelulusan</label>
                            <input type="text" name="prodi_degree" value="{{ old('prodi_degree', $settings['prodi_degree'] ?? '') }}" class="w-full px-4 py-2 rounded-xl text-xs bg-white border border-slate-200" placeholder="Contoh: Sarjana Terapan (S.Tr.Kep) & Ners">
                        </div>

                        <div class="space-y-1">
                            <label class="text-xs font-bold text-slate-700">Status Akreditasi</label>
                            <input type="text" name="prodi_accreditation" value="{{ old('prodi_accreditation', $settings['prodi_accreditation'] ?? '') }}" class="w-full px-4 py-2 rounded-xl text-xs bg-white border border-slate-200" placeholder="Contoh: Terakreditasi Baik Sekali (LAM-PTKes)">
                        </div>

                        <div class="space-y-1 sm:col-span-2">
                            <label class="text-xs font-bold text-slate-700">Profil Lulusan Utama</label>
                            <input type="text" name="prodi_graduate_profile" value="{{ old('prodi_graduate_profile', $settings['prodi_graduate_profile'] ?? '') }}" class="w-full px-4 py-2 rounded-xl text-xs bg-white border border-slate-200" placeholder="Contoh: Perawat Klinis RS, Perawat Komunitas Geriatri, Edukator Kesehatan">
                        </div>
                    </div>
                </div>

                <!-- Fitur Layanan On/Off Switch -->
                <div class="sm:col-span-2 p-4 sm:p-5 bg-slate-50 rounded-2xl border border-slate-200 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div class="space-y-1 max-w-xl">
                        <label class="text-xs font-bold text-slate-900 flex items-center">
                            <i class="fa-solid fa-briefcase-medical text-sky-600 mr-2"></i> Switch Fitur "Layanan Kami / Layanan Divisi"
                        </label>
                        <p class="text-[11px] text-slate-500 leading-relaxed">
                            Pilih apakah website menampilkan modul dan menu <strong>"Layanan"</strong>. Jika dinonaktifkan, menu navigasi Layanan dan kartu layanan di beranda akan otomatis disembunyikan.
                        </p>
                    </div>
                    <div class="flex-shrink-0">
                        <select name="enable_services" class="w-full sm:w-auto px-4 py-2.5 rounded-xl text-xs font-bold bg-white border border-slate-300 focus:outline-none focus:ring-2 focus:ring-sky-500 shadow-sm">
                            <option value="1" {{ ($settings['enable_services'] ?? '1') !== '0' ? 'selected' : '' }}>✅ Aktif (Tampilkan Layanan)</option>
                            <option value="0" {{ ($settings['enable_services'] ?? '1') === '0' ? 'selected' : '' }}>❌ Nonaktif (Sembunyikan)</option>
                        </select>
                    </div>
                </div>

                <div class="space-y-1 sm:col-span-2">
                    <label class="text-xs font-bold text-slate-700">Institusi Induk</label>
                    <input type="text" name="parent_institution" value="{{ old('parent_institution', $settings['parent_institution'] ?? 'STIKES Panti Waluya Malang') }}" class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:bg-white">
                </div>
            </div>

            <div class="pt-4 border-t">
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-theme-primary text-white font-bold text-xs uppercase tracking-wider shadow hover:opacity-90 transition">
                    Simpan Pengaturan
                </button>
            </div>
        </div>

        <!-- TAB 3: VISUAL & WARNA TEMA -->
        <div x-show="activeTab === 'branding'" class="bg-white rounded-2xl p-6 sm:p-8 shadow-sm border border-slate-200 space-y-6" style="display: none;">
            <h3 class="text-base font-bold text-slate-900 border-b pb-3">Visual Branding & Palet Warna Website</h3>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                <!-- Color 1: Primary -->
                <div class="space-y-2 p-4 bg-slate-50 rounded-xl border border-slate-200">
                    <label class="text-xs font-bold text-slate-700 block">Warna Utama (Primary)</label>
                    <div class="flex items-center space-x-3">
                        <input type="color" name="theme_primary_color" value="{{ old('theme_primary_color', $settings['theme_primary_color'] ?? '#0e7490') }}" class="w-12 h-10 rounded-lg cursor-pointer border-0 bg-transparent">
                        <span class="text-xs font-mono font-bold text-slate-600">{{ $settings['theme_primary_color'] ?? '#0e7490' }}</span>
                    </div>
                    <p class="text-[11px] text-slate-500">Warna untuk tombol utama, header hero, dan badge.</p>
                </div>

                <!-- Color 2: Secondary -->
                <div class="space-y-2 p-4 bg-slate-50 rounded-xl border border-slate-200">
                    <label class="text-xs font-bold text-slate-700 block">Warna Sekunder (Secondary)</label>
                    <div class="flex items-center space-x-3">
                        <input type="color" name="theme_secondary_color" value="{{ old('theme_secondary_color', $settings['theme_secondary_color'] ?? '#0369a1') }}" class="w-12 h-10 rounded-lg cursor-pointer border-0 bg-transparent">
                        <span class="text-xs font-mono font-bold text-slate-600">{{ $settings['theme_secondary_color'] ?? '#0369a1' }}</span>
                    </div>
                    <p class="text-[11px] text-slate-500">Warna gradien samping pada banner hero.</p>
                </div>

                <!-- Color 3: Accent -->
                <div class="space-y-2 p-4 bg-slate-50 rounded-xl border border-slate-200">
                    <label class="text-xs font-bold text-slate-700 block">Warna Aksen</label>
                    <div class="flex items-center space-x-3">
                        <input type="color" name="theme_accent_color" value="{{ old('theme_accent_color', $settings['theme_accent_color'] ?? '#059669') }}" class="w-12 h-10 rounded-lg cursor-pointer border-0 bg-transparent">
                        <span class="text-xs font-mono font-bold text-slate-600">{{ $settings['theme_accent_color'] ?? '#059669' }}</span>
                    </div>
                    <p class="text-[11px] text-slate-500">Warna sorotan untuk info positif & WhatsApp.</p>
                </div>
            </div>

            <!-- Banner Text -->
            <div class="space-y-4 pt-4 border-t">
                <h4 class="text-xs font-bold text-slate-800 uppercase tracking-wider">Teks Banner Beranda (Hero Banner)</h4>
                <div class="space-y-4">
                    <div class="space-y-1">
                        <label class="text-xs font-bold text-slate-700">Judul Utama Banner</label>
                        <input type="text" name="hero_banner_title" value="{{ old('hero_banner_title', $settings['hero_banner_title'] ?? '') }}" class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:bg-white">
                    </div>

                    <div class="space-y-1">
                        <label class="text-xs font-bold text-slate-700">Subjudul / Deskripsi Banner</label>
                        <textarea name="hero_banner_subtitle" rows="2" class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:bg-white">{{ old('hero_banner_subtitle', $settings['hero_banner_subtitle'] ?? '') }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Upload Logo -->
            <div class="space-y-2 pt-4 border-t">
                <label class="text-xs font-bold text-slate-700">Upload Logo Divisi (Opsional)</label>
                <div class="flex items-center space-x-4">
                    @if(!empty($settings['logo_url']))
                        <img src="{{ $settings['logo_url'] }}" alt="Logo" class="w-12 h-12 object-contain bg-slate-100 p-1 rounded-lg border">
                    @endif
                    <input type="file" name="logo" accept="image/*" class="text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-slate-100 file:text-slate-700 hover:file:bg-slate-200">
                </div>
            </div>

            <div class="pt-4 border-t">
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-theme-primary text-white font-bold text-xs uppercase tracking-wider shadow hover:opacity-90 transition">
                    Simpan Perubahan Visual
                </button>
            </div>
        </div>

        <!-- TAB 4: VISI, MISI & TENTANG -->
        <div x-show="activeTab === 'profile'" class="bg-white rounded-2xl p-6 sm:p-8 shadow-sm border border-slate-200 space-y-6" style="display: none;">
            <h3 class="text-base font-bold text-slate-900 border-b pb-3">Profil, Visi & Misi Divisi</h3>

            <div class="space-y-4">
                <div class="space-y-1">
                    <label class="text-xs font-bold text-slate-700">Judul Tentang Kami</label>
                    <input type="text" name="about_title" value="{{ old('about_title', $settings['about_title'] ?? 'Tentang Kami') }}" class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:bg-white">
                </div>

                <div class="space-y-1">
                    <label class="text-xs font-bold text-slate-700">Deskripsi Lengkap / Sejarah Singkat Divisi</label>
                    <textarea name="about_description" rows="5" class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:bg-white">{{ old('about_description', $settings['about_description'] ?? '') }}</textarea>
                </div>

                <div class="space-y-1">
                    <label class="text-xs font-bold text-slate-700">Visi Divisi</label>
                    <textarea name="vision" rows="3" class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:bg-white">{{ old('vision', $settings['vision'] ?? '') }}</textarea>
                </div>

                <div class="space-y-1">
                    <label class="text-xs font-bold text-slate-700">Misi Divisi (Dapat dibuat poin 1, 2, 3)</label>
                    <textarea name="mission" rows="6" class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:bg-white">{{ old('mission', $settings['mission'] ?? '') }}</textarea>
                </div>
            </div>

            <div class="pt-4 border-t">
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-theme-primary text-white font-bold text-xs uppercase tracking-wider shadow hover:opacity-90 transition">
                    Simpan Visi Misi
                </button>
            </div>
        </div>

        <!-- TAB: KOTAK SOROTAN BERANDA (HIGHLIGHT BOX) -->
        <div x-show="activeTab === 'highlight'" class="bg-white rounded-2xl p-6 sm:p-8 shadow-sm border border-slate-200 space-y-6" style="display: none;">
            <div class="border-b pb-3">
                <h3 class="text-base font-bold text-slate-900">Kotak Sorotan Beranda (Highlight Box)</h3>
                <p class="text-xs text-slate-500 mt-1">Sesuaikan judul, deskripsi, 4 poin keunggulan, ikon, dan tombol pada kartu sorotan beranda di samping profil singkat.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div class="space-y-1 sm:col-span-2">
                    <label class="text-xs font-bold text-slate-700">Judul Kotak Sorotan</label>
                    <input type="text" name="info_box_title" value="{{ old('info_box_title', $settings['info_box_title'] ?? (get_setting('enable_services', '1') !== '0' ? 'Layanan Terpadu & Mudah Diakses' : 'Pusat Informasi & Komunikasi')) }}" class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:bg-white" placeholder="Contoh: Pusat Informasi & Komunikasi">
                </div>

                <div class="space-y-1 sm:col-span-2">
                    <label class="text-xs font-bold text-slate-700">Deskripsi Singkat</label>
                    <textarea name="info_box_description" rows="3" class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:bg-white" placeholder="Keterangan singkat mengenai layanan atau pusat informasi...">{{ old('info_box_description', $settings['info_box_description'] ?? 'Akses berita terkini, pengumuman resmi, agenda kegiatan akademik, dan unduhan dokumen terpadu di ' . get_setting('division_short_name', 'Divisi') . '.') }}</textarea>
                </div>

                <div class="space-y-1 sm:col-span-2">
                    <label class="text-xs font-bold text-slate-700">Ikon FontAwesome Kotak Sorotan</label>
                    <input type="text" name="info_box_icon" value="{{ old('info_box_icon', $settings['info_box_icon'] ?? 'fa-solid fa-circle-info') }}" class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:bg-white" placeholder="Contoh: fa-solid fa-circle-info atau fa-solid fa-hand-holding-medical">
                </div>
            </div>

            <!-- 4 Poin Keunggulan / Checklist -->
            <div class="space-y-4 pt-4 border-t">
                <h4 class="text-xs font-bold text-slate-800 uppercase tracking-wider">4 Poin Checklist Keunggulan</h4>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="space-y-1">
                        <label class="text-xs font-bold text-slate-700">Poin 1</label>
                        <input type="text" name="info_box_point_1" value="{{ old('info_box_point_1', $settings['info_box_point_1'] ?? (get_setting('enable_services', '1') !== '0' ? 'Alur Prosedur Jelas' : 'Informasi Resmi Terkini')) }}" class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 border border-slate-200">
                    </div>
                    <div class="space-y-1">
                        <label class="text-xs font-bold text-slate-700">Poin 2</label>
                        <input type="text" name="info_box_point_2" value="{{ old('info_box_point_2', $settings['info_box_point_2'] ?? (get_setting('enable_services', '1') !== '0' ? 'Formulir Siap Download' : 'Unduhan Dokumen & Formulir')) }}" class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 border border-slate-200">
                    </div>
                    <div class="space-y-1">
                        <label class="text-xs font-bold text-slate-700">Poin 3</label>
                        <input type="text" name="info_box_point_3" value="{{ old('info_box_point_3', $settings['info_box_point_3'] ?? (get_setting('enable_services', '1') !== '0' ? 'Bantuan & Konsultasi Ramah' : 'Agenda & Kegiatan Aktif')) }}" class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 border border-slate-200">
                    </div>
                    <div class="space-y-1">
                        <label class="text-xs font-bold text-slate-700">Poin 4</label>
                        <input type="text" name="info_box_point_4" value="{{ old('info_box_point_4', $settings['info_box_point_4'] ?? (get_setting('enable_services', '1') !== '0' ? 'Pelayanan Cepat & Akurat' : 'Layanan Kontak Responsif')) }}" class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 border border-slate-200">
                    </div>
                </div>
            </div>

            <!-- Tombol Aksi -->
            <div class="space-y-4 pt-4 border-t">
                <h4 class="text-xs font-bold text-slate-800 uppercase tracking-wider">Tombol Aksi Kotak Sorotan</h4>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="space-y-3 p-4 bg-slate-50 rounded-xl border border-slate-200">
                        <span class="text-xs font-bold text-slate-800 block">Tombol Utama (Kiri)</span>
                        <div class="space-y-1">
                            <label class="text-[11px] text-slate-600">Teks Tombol 1</label>
                            <input type="text" name="info_box_btn1_text" value="{{ old('info_box_btn1_text', $settings['info_box_btn1_text'] ?? (get_setting('enable_services', '1') !== '0' ? 'Buka Daftar Layanan' : 'Profil Lengkap')) }}" class="w-full px-3 py-2 rounded-lg text-xs bg-white border border-slate-200">
                        </div>
                        <div class="space-y-1">
                            <label class="text-[11px] text-slate-600">Tautan Tombol 1 (URL)</label>
                            <input type="text" name="info_box_btn1_link" value="{{ old('info_box_btn1_link', $settings['info_box_btn1_link'] ?? (get_setting('enable_services', '1') !== '0' ? '/layanan' : '/profil')) }}" class="w-full px-3 py-2 rounded-lg text-xs bg-white border border-slate-200">
                        </div>
                    </div>

                    <div class="space-y-3 p-4 bg-slate-50 rounded-xl border border-slate-200">
                        <span class="text-xs font-bold text-slate-800 block">Tombol Kedua (Kanan)</span>
                        <div class="space-y-1">
                            <label class="text-[11px] text-slate-600">Teks Tombol 2</label>
                            <input type="text" name="info_box_btn2_text" value="{{ old('info_box_btn2_text', $settings['info_box_btn2_text'] ?? 'Hubungi Kami') }}" class="w-full px-3 py-2 rounded-lg text-xs bg-white border border-slate-200">
                        </div>
                        <div class="space-y-1">
                            <label class="text-[11px] text-slate-600">Tautan Tombol 2 (URL)</label>
                            <input type="text" name="info_box_btn2_link" value="{{ old('info_box_btn2_link', $settings['info_box_btn2_link'] ?? '/kontak') }}" class="w-full px-3 py-2 rounded-lg text-xs bg-white border border-slate-200">
                        </div>
                    </div>
                </div>
            </div>

            <div class="pt-4 border-t">
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-theme-primary text-white font-bold text-xs uppercase tracking-wider shadow hover:opacity-90 transition">
                    Simpan Kotak Sorotan
                </button>
            </div>
        </div>

        <!-- TAB 5: KONTAK & PETA -->
        <div x-show="activeTab === 'contact'" class="bg-white rounded-2xl p-6 sm:p-8 shadow-sm border border-slate-200 space-y-6" style="display: none;">
            <h3 class="text-base font-bold text-slate-900 border-b pb-3">Informasi Kontak & Lokasi Kantor</h3>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div class="space-y-1">
                    <label class="text-xs font-bold text-slate-700">Email Resmi</label>
                    <input type="email" name="contact_email" value="{{ old('contact_email', $settings['contact_email'] ?? '') }}" class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:bg-white">
                </div>

                <div class="space-y-1">
                    <label class="text-xs font-bold text-slate-700">Telepon Kantor</label>
                    <input type="text" name="contact_phone" value="{{ old('contact_phone', $settings['contact_phone'] ?? '') }}" class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:bg-white">
                </div>

                <div class="space-y-1">
                    <label class="text-xs font-bold text-slate-700">WhatsApp Layanan</label>
                    <input type="text" name="contact_whatsapp" value="{{ old('contact_whatsapp', $settings['contact_whatsapp'] ?? '') }}" class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:bg-white">
                </div>

                <div class="space-y-1">
                    <label class="text-xs font-bold text-slate-700">Jam Operasional Layanan</label>
                    <input type="text" name="operating_hours" value="{{ old('operating_hours', $settings['operating_hours'] ?? 'Senin - Jumat: 08.00 - 16.00 WIB') }}" class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:bg-white">
                </div>

                <div class="space-y-1 sm:col-span-2">
                    <label class="text-xs font-bold text-slate-700">Ruangan / Lokasi Kampus</label>
                    <input type="text" name="contact_room" value="{{ old('contact_room', $settings['contact_room'] ?? '') }}" class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:bg-white" placeholder="Contoh: Gedung Rektorat Lt. 2">
                </div>

                <div class="space-y-1 sm:col-span-2">
                    <label class="text-xs font-bold text-slate-700">Alamat Lengkap Kampus</label>
                    <input type="text" name="contact_address" value="{{ old('contact_address', $settings['contact_address'] ?? 'Jl. Yulius Usman No. 62, Kasin, Kec. Klojen, Kota Malang') }}" class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:bg-white">
                </div>

                <div class="space-y-1 sm:col-span-2">
                    <label class="text-xs font-bold text-slate-700">Google Maps Embed URL</label>
                    <input type="text" name="google_maps_embed" value="{{ old('google_maps_embed', $settings['google_maps_embed'] ?? '') }}" class="w-full px-4 py-2.5 rounded-xl text-xs bg-slate-50 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:bg-white">
                </div>
            </div>

            <!-- Social Media -->
            <div class="space-y-4 pt-4 border-t">
                <h4 class="text-xs font-bold text-slate-800 uppercase tracking-wider">Media Sosial</h4>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div class="space-y-1">
                        <label class="text-xs font-bold text-slate-700">Instagram</label>
                        <input type="text" name="social_instagram" value="{{ old('social_instagram', $settings['social_instagram'] ?? '') }}" class="w-full px-4 py-2 rounded-xl text-xs bg-slate-50 border border-slate-200" placeholder="https://instagram.com/...">
                    </div>
                    <div class="space-y-1">
                        <label class="text-xs font-bold text-slate-700">Facebook</label>
                        <input type="text" name="social_facebook" value="{{ old('social_facebook', $settings['social_facebook'] ?? '') }}" class="w-full px-4 py-2 rounded-xl text-xs bg-slate-50 border border-slate-200" placeholder="https://facebook.com/...">
                    </div>
                    <div class="space-y-1">
                        <label class="text-xs font-bold text-slate-700">YouTube</label>
                        <input type="text" name="social_youtube" value="{{ old('social_youtube', $settings['social_youtube'] ?? '') }}" class="w-full px-4 py-2 rounded-xl text-xs bg-slate-50 border border-slate-200" placeholder="https://youtube.com/...">
                    </div>
                </div>
            </div>

            <div class="pt-4 border-t">
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-theme-primary text-white font-bold text-xs uppercase tracking-wider shadow hover:opacity-90 transition">
                    Simpan Kontak & Alamat
                </button>
            </div>
        </div>

        <!-- TAB 6: STATISTIK BERANDA -->
        <div x-show="activeTab === 'stats'" class="bg-white rounded-2xl p-6 sm:p-8 shadow-sm border border-slate-200 space-y-6" style="display: none;">
            <h3 class="text-base font-bold text-slate-900 border-b pb-3">Statistik Ringkas di Beranda</h3>
            <p class="text-xs text-slate-500">Angka pencapaian atau statistik yang ditampilkan pada kartu floating beranda.</p>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- Stat 1 -->
                <div class="p-4 bg-slate-50 rounded-xl border border-slate-200 space-y-3">
                    <span class="text-xs font-bold text-slate-700 block">Statistik 1</span>
                    <input type="text" name="stat_1_number" value="{{ old('stat_1_number', $settings['stat_1_number'] ?? '100+') }}" placeholder="Angka (misal: 120+)" class="w-full px-3 py-2 rounded-lg text-xs bg-white border border-slate-200">
                    <input type="text" name="stat_1_label" value="{{ old('stat_1_label', $settings['stat_1_label'] ?? 'Publikasi Ilmiah') }}" placeholder="Label (misal: Publikasi Ilmiah)" class="w-full px-3 py-2 rounded-lg text-xs bg-white border border-slate-200">
                </div>

                <!-- Stat 2 -->
                <div class="p-4 bg-slate-50 rounded-xl border border-slate-200 space-y-3">
                    <span class="text-xs font-bold text-slate-700 block">Statistik 2</span>
                    <input type="text" name="stat_2_number" value="{{ old('stat_2_number', $settings['stat_2_number'] ?? '50+') }}" placeholder="Angka (misal: 45+)" class="w-full px-3 py-2 rounded-lg text-xs bg-white border border-slate-200">
                    <input type="text" name="stat_2_label" value="{{ old('stat_2_label', $settings['stat_2_label'] ?? 'Pengabdian Masyarakat') }}" placeholder="Label" class="w-full px-3 py-2 rounded-lg text-xs bg-white border border-slate-200">
                </div>

                <!-- Stat 3 -->
                <div class="p-4 bg-slate-50 rounded-xl border border-slate-200 space-y-3">
                    <span class="text-xs font-bold text-slate-700 block">Statistik 3</span>
                    <input type="text" name="stat_3_number" value="{{ old('stat_3_number', $settings['stat_3_number'] ?? '25+') }}" placeholder="Angka (misal: 25+)" class="w-full px-3 py-2 rounded-lg text-xs bg-white border border-slate-200">
                    <input type="text" name="stat_3_label" value="{{ old('stat_3_label', $settings['stat_3_label'] ?? 'HKI & Paten') }}" placeholder="Label" class="w-full px-3 py-2 rounded-lg text-xs bg-white border border-slate-200">
                </div>

                <!-- Stat 4 -->
                <div class="p-4 bg-slate-50 rounded-xl border border-slate-200 space-y-3">
                    <span class="text-xs font-bold text-slate-700 block">Statistik 4</span>
                    <input type="text" name="stat_4_number" value="{{ old('stat_4_number', $settings['stat_4_number'] ?? '15+') }}" placeholder="Angka (misal: 15+)" class="w-full px-3 py-2 rounded-lg text-xs bg-white border border-slate-200">
                    <input type="text" name="stat_4_label" value="{{ old('stat_4_label', $settings['stat_4_label'] ?? 'Mitra Kerjasama') }}" placeholder="Label" class="w-full px-3 py-2 rounded-lg text-xs bg-white border border-slate-200">
                </div>
            </div>

            <div class="pt-4 border-t">
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-theme-primary text-white font-bold text-xs uppercase tracking-wider shadow hover:opacity-90 transition">
                    Simpan Statistik
                </button>
            </div>
        </div>

        <!-- TAB 7: FITUR TAMBAHAN & LAB (ON / OFF SWITCH) -->
        <div x-show="activeTab === 'features'" class="bg-white rounded-2xl p-6 sm:p-8 shadow-sm border border-slate-200 space-y-6" style="display: none;">
            <div class="flex items-center justify-between border-b pb-4">
                <div>
                    <h3 class="text-base font-bold text-slate-900 flex items-center">
                        <i class="fa-solid fa-flask mr-2 text-purple-600"></i> Fitur Eksperimental & Laboratorium CMS
                    </h3>
                    <p class="text-xs text-slate-500 mt-0.5">Aktifkan atau nonaktifkan modul fitur lanjutan sesuai kebutuhan operasional website.</p>
                </div>
                <span class="px-2.5 py-1 rounded-full bg-rose-50 text-rose-700 text-[10px] font-extrabold uppercase border border-rose-200 flex items-center">
                    <i class="fa-solid fa-shield-halved mr-1.5 text-xs"></i> Khusus Admin IT (Super Admin)
                </span>
            </div>

            <!-- Feature 1: Visual Page Builder (GrapesJS / Elementor Mode) -->
            <div class="p-5 sm:p-6 rounded-2xl bg-gradient-to-br from-slate-50 to-purple-50/40 border border-slate-200 space-y-4">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 rounded-2xl bg-purple-600 text-white flex items-center justify-center text-xl shrink-0 shadow-sm">
                            <i class="fa-solid fa-wand-magic-sparkles"></i>
                        </div>
                        <div>
                            <div class="flex items-center space-x-2">
                                <h4 class="text-sm font-extrabold text-slate-900">Visual Page Builder (Elementor Mode)</h4>
                                <span class="px-2 py-0.5 rounded bg-amber-100 text-amber-800 text-[9px] font-black uppercase">GrapesJS Studio</span>
                            </div>
                            <p class="text-xs text-slate-600 mt-1 max-w-xl leading-relaxed">
                                Mengaktifkan tombol <strong>"Studio"</strong> dan kanvas visual *drag-and-drop* pada menu Halaman Kustom (<code class="text-purple-700 bg-purple-100/50 px-1 py-0.5 rounded">/admin/pages</code>). Jika dinonaktifkan (OFF), panel admin akan kembali bersih hanya menampilkan editor klasik.
                            </p>
                        </div>
                    </div>

                    <!-- Toggle Switch -->
                    <div class="flex items-center space-x-3 shrink-0">
                        <input type="hidden" name="feature_page_builder_enabled" value="0">
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="feature_page_builder_enabled" value="1" {{ old('feature_page_builder_enabled', $settings['feature_page_builder_enabled'] ?? '0') == '1' ? 'checked' : '' }} class="sr-only peer">
                            <div class="w-14 h-7 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[4px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-purple-600"></div>
                        </label>
                        <span class="text-xs font-bold {{ old('feature_page_builder_enabled', $settings['feature_page_builder_enabled'] ?? '0') == '1' ? 'text-purple-700' : 'text-slate-400' }}">
                            {{ old('feature_page_builder_enabled', $settings['feature_page_builder_enabled'] ?? '0') == '1' ? 'AKTIF (ON)' : 'NONAKTIF (OFF)' }}
                        </span>
                    </div>
                </div>

                <div class="p-3 bg-white rounded-xl border border-purple-100 text-[11px] text-slate-600 flex items-center space-x-2">
                    <i class="fa-solid fa-circle-info text-purple-600"></i>
                    <span>Default: <strong>Nonaktif (OFF)</strong>. Anda dapat mengaktifkannya kapan saja di masa depan.</span>
                </div>
            </div>

            <div class="pt-4 border-t">
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-purple-600 hover:bg-purple-700 text-white font-bold text-xs uppercase tracking-wider shadow transition">
                    Simpan Pengaturan Fitur
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
