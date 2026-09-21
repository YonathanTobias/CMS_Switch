{{-- Modular Block Builder Component --}}
@php
    $initialBlocks = old('blocks_json') ? json_decode(old('blocks_json'), true) : ($blocksData ?? []);
    if (!is_array($initialBlocks)) {
        $initialBlocks = [];
    }
    $initialLayout = old('layout_type', $layoutType ?? 'standard');
@endphp

<div x-data="pageBuilder({
    initialLayout: @js($initialLayout),
    initialBlocks: @js($initialBlocks)
})" class="space-y-6">

    <!-- Hidden Fields -->
    <input type="hidden" name="layout_type" :value="layoutType">
    <input type="hidden" name="blocks_json" :value="JSON.stringify(blocks)">

    <!-- Layout Type Selector -->
    @if(get_setting('feature_page_builder_enabled', '0') == '1')
    <div class="bg-slate-50 p-4 rounded-2xl border border-slate-200">
        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-3">
            <i class="fa-solid fa-layer-group text-theme-primary mr-1.5"></i> Mode Tampilan Halaman
        </label>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
            <button type="button" @click="layoutType = 'standard'"
                :class="layoutType === 'standard' ? 'border-theme-primary bg-white shadow-md text-slate-900 ring-2 ring-sky-500/20' : 'border-slate-200 bg-white/60 text-slate-600 hover:bg-white'"
                class="p-4 rounded-xl border text-left transition flex items-start space-x-3.5 group">
                <div :class="layoutType === 'standard' ? 'bg-theme-primary text-white' : 'bg-slate-100 text-slate-500'"
                    class="w-9 h-9 rounded-lg flex items-center justify-center text-sm shrink-0 transition">
                    <i class="fa-solid fa-file-lines"></i>
                </div>
                <div>
                    <div class="text-xs font-bold">Editor Teks Klasik</div>
                    <div class="text-[11px] text-slate-500 mt-0.5 leading-snug">Satu halaman standar dengan banner atas dan format artikel WYSIWYG editor.</div>
                </div>
            </button>

            <button type="button" @click="layoutType = 'blocks'"
                :class="layoutType === 'blocks' ? 'border-theme-primary bg-white shadow-md text-slate-900 ring-2 ring-sky-500/20' : 'border-slate-200 bg-white/60 text-slate-600 hover:bg-white'"
                class="p-4 rounded-xl border text-left transition flex items-start space-x-3.5 group">
                <div :class="layoutType === 'blocks' ? 'bg-theme-primary text-white' : 'bg-slate-100 text-slate-500'"
                    class="w-9 h-9 rounded-lg flex items-center justify-center text-sm shrink-0 transition">
                    <i class="fa-solid fa-cubes"></i>
                </div>
                <div>
                    <div class="text-xs font-bold flex items-center">
                        <span>Visual Block Builder</span>
                        <span class="ml-2 px-1.5 py-0.5 rounded bg-amber-100 text-amber-800 text-[9px] font-extrabold uppercase">Elementor Style</span>
                    </div>
                    <div class="text-[11px] text-slate-500 mt-0.5 leading-snug">Susun halaman modular (Hero, Grid Layanan, Dua Kolom, Accordion FAQ, Timeline, Stats, CTA).</div>
                </div>
            </button>
        </div>
    </div>
    @endif

    <!-- STANDARD EDITOR CONTAINER -->
    <div x-show="layoutType === 'standard'" class="space-y-6">
        <div class="space-y-1">
            <label class="text-xs font-bold text-slate-700">Isi Konten Halaman <span class="text-rose-500">*</span></label>
            <input type="hidden" name="content" id="contentInput" value="{{ old('content', $pageContent ?? '') }}">
            <div id="editor" class="bg-white rounded-xl min-h-[300px]">
                {!! old('content', $pageContent ?? '') !!}
            </div>
        </div>

        <div class="space-y-2 pt-4 border-t border-slate-100">
            <label class="text-xs font-bold text-slate-700">Banner Gambar Atas (Opsional)</label>
            <div class="flex items-center space-x-3">
                @if(!empty($bannerImage))
                    <img src="{{ $bannerImage }}" alt="" class="w-16 h-12 object-cover rounded-lg border">
                @endif
                <input type="file" name="banner_image" accept="image/*" class="text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-slate-100 file:text-slate-700 hover:file:bg-slate-200">
            </div>
        </div>
    </div>

    <!-- MODULAR BLOCK BUILDER CONTAINER -->
    <div x-show="layoutType === 'blocks'" class="space-y-6">
        
        <!-- Block Palette / Selector Toolbar -->
        <div class="bg-slate-900 text-white p-5 rounded-2xl shadow-sm space-y-3">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-xs font-bold uppercase tracking-wider text-sky-400 flex items-center">
                        <i class="fa-solid fa-plus-circle mr-1.5"></i> Tambah Blok Komponen Baru
                    </h3>
                    <p class="text-[11px] text-slate-400">Pilih komponen di bawah untuk menambahkan seksi ke halaman ini.</p>
                </div>
                <div class="text-xs font-semibold px-2.5 py-1 rounded-full bg-slate-800 text-slate-300 border border-slate-700">
                    <span x-text="blocks.length"></span> Blok Aktif
                </div>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-8 gap-2 pt-2">
                <button type="button" @click="addBlock('hero')" class="p-2.5 rounded-xl bg-slate-800 hover:bg-sky-600 transition text-center flex flex-col items-center space-y-1.5 border border-slate-700">
                    <i class="fa-solid fa-image text-base text-sky-400"></i>
                    <span class="text-[11px] font-bold">Hero Banner</span>
                </button>
                <button type="button" @click="addBlock('two_column')" class="p-2.5 rounded-xl bg-slate-800 hover:bg-sky-600 transition text-center flex flex-col items-center space-y-1.5 border border-slate-700">
                    <i class="fa-solid fa-columns text-base text-emerald-400"></i>
                    <span class="text-[11px] font-bold">Dua Kolom</span>
                </button>
                <button type="button" @click="addBlock('cards_grid')" class="p-2.5 rounded-xl bg-slate-800 hover:bg-sky-600 transition text-center flex flex-col items-center space-y-1.5 border border-slate-700">
                    <i class="fa-solid fa-grip text-base text-amber-400"></i>
                    <span class="text-[11px] font-bold">Grid Kartu</span>
                </button>
                <button type="button" @click="addBlock('accordion')" class="p-2.5 rounded-xl bg-slate-800 hover:bg-sky-600 transition text-center flex flex-col items-center space-y-1.5 border border-slate-700">
                    <i class="fa-solid fa-circle-question text-base text-indigo-400"></i>
                    <span class="text-[11px] font-bold">FAQ Akordeon</span>
                </button>
                <button type="button" @click="addBlock('timeline')" class="p-2.5 rounded-xl bg-slate-800 hover:bg-sky-600 transition text-center flex flex-col items-center space-y-1.5 border border-slate-700">
                    <i class="fa-solid fa-timeline text-base text-rose-400"></i>
                    <span class="text-[11px] font-bold">Linimasa / Alur</span>
                </button>
                <button type="button" @click="addBlock('stats')" class="p-2.5 rounded-xl bg-slate-800 hover:bg-sky-600 transition text-center flex flex-col items-center space-y-1.5 border border-slate-700">
                    <i class="fa-solid fa-chart-simple text-base text-teal-400"></i>
                    <span class="text-[11px] font-bold">Statistik</span>
                </button>
                <button type="button" @click="addBlock('cta')" class="p-2.5 rounded-xl bg-slate-800 hover:bg-sky-600 transition text-center flex flex-col items-center space-y-1.5 border border-slate-700">
                    <i class="fa-solid fa-bullhorn text-base text-orange-400"></i>
                    <span class="text-[11px] font-bold">CTA & WA</span>
                </button>
                <button type="button" @click="addBlock('rich_text')" class="p-2.5 rounded-xl bg-slate-800 hover:bg-sky-600 transition text-center flex flex-col items-center space-y-1.5 border border-slate-700">
                    <i class="fa-solid fa-paragraph text-base text-violet-400"></i>
                    <span class="text-[11px] font-bold">Teks Bebas</span>
                </button>
            </div>
        </div>

        <!-- Canvas / Block List -->
        <div class="space-y-4">
            <template x-if="blocks.length === 0">
                <div class="text-center py-12 px-4 rounded-2xl border-2 border-dashed border-slate-300 bg-slate-50 space-y-3">
                    <div class="w-12 h-12 mx-auto rounded-full bg-slate-200 text-slate-500 flex items-center justify-center text-xl">
                        <i class="fa-solid fa-cubes-stacked"></i>
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-slate-700">Belum Ada Blok Halaman</h4>
                        <p class="text-[11px] text-slate-500 max-w-sm mx-auto mt-1">Klik salah satu tombol blok di atas untuk mulai menambahkan elemen dan menyusun halaman.</p>
                    </div>
                </div>
            </template>

            <template x-for="(block, index) in blocks" :key="block._id || index">
                <div class="bg-white rounded-2xl border border-slate-300 shadow-sm overflow-hidden transition hover:border-slate-400">
                    
                    <!-- Block Header / Controls -->
                    <div class="px-5 py-3.5 bg-slate-50 border-b border-slate-200 flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <span class="w-6 h-6 rounded-md bg-slate-200 text-slate-700 font-bold text-[11px] flex items-center justify-center" x-text="index + 1"></span>
                            <div class="flex items-center space-x-2">
                                <i :class="getBlockIcon(block.type)" class="text-sm text-theme-primary"></i>
                                <span class="text-xs font-bold text-slate-800" x-text="getBlockLabel(block.type)"></span>
                            </div>
                        </div>

                        <div class="flex items-center space-x-1.5">
                            <!-- Move Up -->
                            <button type="button" @click="moveUp(index)" :disabled="index === 0"
                                class="p-1.5 rounded-lg text-slate-500 hover:bg-slate-200 hover:text-slate-800 disabled:opacity-30 disabled:pointer-events-none transition text-xs" title="Pindah ke Atas">
                                <i class="fa-solid fa-arrow-up"></i>
                            </button>
                            <!-- Move Down -->
                            <button type="button" @click="moveDown(index)" :disabled="index === blocks.length - 1"
                                class="p-1.5 rounded-lg text-slate-500 hover:bg-slate-200 hover:text-slate-800 disabled:opacity-30 disabled:pointer-events-none transition text-xs" title="Pindah ke Bawah">
                                <i class="fa-solid fa-arrow-down"></i>
                            </button>
                            <!-- Duplicate -->
                            <button type="button" @click="duplicateBlock(index)"
                                class="p-1.5 rounded-lg text-slate-500 hover:bg-slate-200 hover:text-slate-800 transition text-xs" title="Duplikasi Blok">
                                <i class="fa-regular fa-copy"></i>
                            </button>
                            <!-- Delete -->
                            <button type="button" @click="removeBlock(index)"
                                class="p-1.5 rounded-lg text-rose-500 hover:bg-rose-50 transition text-xs" title="Hapus Blok">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Block Form Fields -->
                    <div class="p-5 space-y-4">

                        {{-- TYPE: HERO --}}
                        <template x-if="block.type === 'hero'">
                            <div class="space-y-4">
                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                                    <div class="space-y-1 sm:col-span-2">
                                        <label class="text-[11px] font-bold text-slate-600">Judul Hero <span class="text-rose-500">*</span></label>
                                        <input type="text" x-model="block.title" class="w-full px-3 py-2 rounded-xl text-xs bg-slate-50 border border-slate-200 focus:bg-white focus:outline-none focus:ring-1 focus:ring-sky-500" placeholder="Contoh: Selamat Datang di Divisi Inovasi">
                                    </div>
                                    <div class="space-y-1">
                                        <label class="text-[11px] font-bold text-slate-600">Badge Atas</label>
                                        <input type="text" x-model="block.badge" class="w-full px-3 py-2 rounded-xl text-xs bg-slate-50 border border-slate-200 focus:bg-white focus:outline-none focus:ring-1 focus:ring-sky-500" placeholder="Contoh: Layanan Unggulan">
                                    </div>
                                </div>
                                <div class="space-y-1">
                                    <label class="text-[11px] font-bold text-slate-600">Subjudul / Deskripsi Pendek</label>
                                    <textarea x-model="block.subtitle" rows="2" class="w-full px-3 py-2 rounded-xl text-xs bg-slate-50 border border-slate-200 focus:bg-white focus:outline-none focus:ring-1 focus:ring-sky-500" placeholder="Deskripsi singkat seputar tujuan atau ringkasan layanan..."></textarea>
                                </div>
                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                                    <div class="space-y-1">
                                        <label class="text-[11px] font-bold text-slate-600">Perataan Teks</label>
                                        <select x-model="block.align" class="w-full px-3 py-2 rounded-xl text-xs bg-slate-50 border border-slate-200 focus:bg-white">
                                            <option value="left">Rata Kiri</option>
                                            <option value="center">Rata Tengah (Center)</option>
                                        </select>
                                    </div>
                                    <div class="space-y-1">
                                        <label class="text-[11px] font-bold text-slate-600">Teks Tombol 1</label>
                                        <input type="text" x-model="block.button1_text" class="w-full px-3 py-2 rounded-xl text-xs bg-slate-50 border border-slate-200" placeholder="Contoh: Pelajari Lebih Lanjut">
                                    </div>
                                    <div class="space-y-1">
                                        <label class="text-[11px] font-bold text-slate-600">Link URL Tombol 1</label>
                                        <input type="text" x-model="block.button1_link" class="w-full px-3 py-2 rounded-xl text-xs bg-slate-50 border border-slate-200" placeholder="https://... atau #">
                                    </div>
                                </div>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                    <div class="space-y-1">
                                        <label class="text-[11px] font-bold text-slate-600">Teks Tombol 2 (Opsional)</label>
                                        <input type="text" x-model="block.button2_text" class="w-full px-3 py-2 rounded-xl text-xs bg-slate-50 border border-slate-200" placeholder="Contoh: Hubungi Kami">
                                    </div>
                                    <div class="space-y-1">
                                        <label class="text-[11px] font-bold text-slate-600">Link URL Tombol 2</label>
                                        <input type="text" x-model="block.button2_link" class="w-full px-3 py-2 rounded-xl text-xs bg-slate-50 border border-slate-200" placeholder="https://... atau #">
                                    </div>
                                </div>
                            </div>
                        </template>

                        {{-- TYPE: TWO COLUMN --}}
                        <template x-if="block.type === 'two_column'">
                            <div class="space-y-4">
                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                                    <div class="space-y-1 sm:col-span-2">
                                        <label class="text-[11px] font-bold text-slate-600">Judul Seksi</label>
                                        <input type="text" x-model="block.title" class="w-full px-3 py-2 rounded-xl text-xs bg-slate-50 border border-slate-200 focus:bg-white" placeholder="Judul bagian...">
                                    </div>
                                    <div class="space-y-1">
                                        <label class="text-[11px] font-bold text-slate-600">Badge</label>
                                        <input type="text" x-model="block.badge" class="w-full px-3 py-2 rounded-xl text-xs bg-slate-50 border border-slate-200 focus:bg-white" placeholder="Contoh: Profil">
                                    </div>
                                </div>
                                <div class="space-y-1">
                                    <label class="text-[11px] font-bold text-slate-600">Teks Konten</label>
                                    <textarea x-model="block.content" rows="4" class="w-full px-3 py-2 rounded-xl text-xs bg-slate-50 border border-slate-200 focus:bg-white" placeholder="Tuliskan uraian informasi detail..."></textarea>
                                </div>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                    <div class="space-y-1">
                                        <label class="text-[11px] font-bold text-slate-600">URL Gambar (Image URL)</label>
                                        <input type="text" x-model="block.image_url" class="w-full px-3 py-2 rounded-xl text-xs bg-slate-50 border border-slate-200" placeholder="https://domain.com/foto.jpg">
                                    </div>
                                    <div class="space-y-1">
                                        <label class="text-[11px] font-bold text-slate-600">Embed Video YouTube (Opsional)</label>
                                        <input type="text" x-model="block.youtube_url" class="w-full px-3 py-2 rounded-xl text-xs bg-slate-50 border border-slate-200" placeholder="https://www.youtube.com/embed/...">
                                    </div>
                                </div>
                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                                    <div class="space-y-1">
                                        <label class="text-[11px] font-bold text-slate-600">Posisi Teks</label>
                                        <select x-model="block.layout" class="w-full px-3 py-2 rounded-xl text-xs bg-slate-50 border border-slate-200">
                                            <option value="left">Teks Kiri, Media Kanan</option>
                                            <option value="right">Media Kiri, Teks Kanan</option>
                                        </select>
                                    </div>
                                    <div class="space-y-1">
                                        <label class="text-[11px] font-bold text-slate-600">Teks Tombol Aksi</label>
                                        <input type="text" x-model="block.button_text" class="w-full px-3 py-2 rounded-xl text-xs bg-slate-50 border border-slate-200" placeholder="Contoh: Selengkapnya">
                                    </div>
                                    <div class="space-y-1">
                                        <label class="text-[11px] font-bold text-slate-600">Link URL Tombol</label>
                                        <input type="text" x-model="block.button_link" class="w-full px-3 py-2 rounded-xl text-xs bg-slate-50 border border-slate-200" placeholder="https://...">
                                    </div>
                                </div>
                            </div>
                        </template>

                        {{-- TYPE: CARDS GRID --}}
                        <template x-if="block.type === 'cards_grid'">
                            <div class="space-y-4">
                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                                    <div class="space-y-1 sm:col-span-2">
                                        <label class="text-[11px] font-bold text-slate-600">Judul Seksi</label>
                                        <input type="text" x-model="block.title" class="w-full px-3 py-2 rounded-xl text-xs bg-slate-50 border border-slate-200" placeholder="Contoh: Layanan & Fasilitas Kami">
                                    </div>
                                    <div class="space-y-1">
                                        <label class="text-[11px] font-bold text-slate-600">Jumlah Kolom</label>
                                        <select x-model="block.columns" class="w-full px-3 py-2 rounded-xl text-xs bg-slate-50 border border-slate-200">
                                            <option value="2">2 Kolom</option>
                                            <option value="3">3 Kolom</option>
                                            <option value="4">4 Kolom</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="space-y-1">
                                    <label class="text-[11px] font-bold text-slate-600">Subjudul</label>
                                    <input type="text" x-model="block.subtitle" class="w-full px-3 py-2 rounded-xl text-xs bg-slate-50 border border-slate-200" placeholder="Deskripsi pengantar seksi kartu...">
                                </div>

                                <!-- Cards Items Repeater -->
                                <div class="space-y-2 pt-2">
                                    <div class="flex items-center justify-between">
                                        <label class="text-[11px] font-bold text-slate-700 uppercase tracking-wider">Daftar Kartu (<span x-text="block.items?.length || 0"></span>)</label>
                                        <button type="button" @click="addCardItem(block)" class="px-2.5 py-1 rounded-lg bg-amber-50 text-amber-700 hover:bg-amber-100 font-bold text-[11px] transition flex items-center space-x-1">
                                            <i class="fa-solid fa-plus text-[10px]"></i> <span>Tambah Kartu</span>
                                        </button>
                                    </div>
                                    <div class="space-y-2.5">
                                        <template x-for="(item, cIdx) in (block.items || [])" :key="cIdx">
                                            <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-200 space-y-2.5 relative">
                                                <button type="button" @click="removeCardItem(block, cIdx)" class="absolute top-2.5 right-2.5 text-rose-500 hover:text-rose-700 text-xs" title="Hapus Item">
                                                    <i class="fa-solid fa-xmark"></i>
                                                </button>
                                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-2 pr-6">
                                                    <div class="space-y-0.5">
                                                        <label class="text-[10px] font-semibold text-slate-500">Ikon FontAwesome</label>
                                                        <input type="text" x-model="item.icon" class="w-full px-2.5 py-1.5 rounded-lg text-xs bg-white border border-slate-200" placeholder="fa-solid fa-graduation-cap">
                                                    </div>
                                                    <div class="space-y-0.5 sm:col-span-2">
                                                        <label class="text-[10px] font-semibold text-slate-500">Judul Kartu</label>
                                                        <input type="text" x-model="item.title" class="w-full px-2.5 py-1.5 rounded-lg text-xs bg-white border border-slate-200" placeholder="Judul box...">
                                                    </div>
                                                </div>
                                                <div class="space-y-0.5">
                                                    <label class="text-[10px] font-semibold text-slate-500">Deskripsi Singkat</label>
                                                    <textarea x-model="item.description" rows="2" class="w-full px-2.5 py-1.5 rounded-lg text-xs bg-white border border-slate-200" placeholder="Keterangan singkat..."></textarea>
                                                </div>
                                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                                                    <input type="text" x-model="item.link_text" class="w-full px-2.5 py-1.5 rounded-lg text-xs bg-white border border-slate-200" placeholder="Teks Link (Pelajari Lebih Lanjut)">
                                                    <input type="text" x-model="item.link_url" class="w-full px-2.5 py-1.5 rounded-lg text-xs bg-white border border-slate-200" placeholder="URL Link (https://...)">
                                                </div>
                                            </div>
                                        </template>
                                    </div>
                                </div>
                            </div>
                        </template>

                        {{-- TYPE: ACCORDION FAQ --}}
                        <template x-if="block.type === 'accordion'">
                            <div class="space-y-4">
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                    <div class="space-y-1">
                                        <label class="text-[11px] font-bold text-slate-600">Judul Seksi FAQ</label>
                                        <input type="text" x-model="block.title" class="w-full px-3 py-2 rounded-xl text-xs bg-slate-50 border border-slate-200" placeholder="Contoh: Pertanyaan yang Sering Diajukan">
                                    </div>
                                    <div class="space-y-1">
                                        <label class="text-[11px] font-bold text-slate-600">Badge</label>
                                        <input type="text" x-model="block.badge" class="w-full px-3 py-2 rounded-xl text-xs bg-slate-50 border border-slate-200" placeholder="Contoh: FAQ / Tanya Jawab">
                                    </div>
                                </div>
                                <div class="space-y-1">
                                    <label class="text-[11px] font-bold text-slate-600">Subjudul</label>
                                    <input type="text" x-model="block.subtitle" class="w-full px-3 py-2 rounded-xl text-xs bg-slate-50 border border-slate-200" placeholder="Keterangan seputar FAQ...">
                                </div>

                                <!-- Accordion Items Repeater -->
                                <div class="space-y-2 pt-2">
                                    <div class="flex items-center justify-between">
                                        <label class="text-[11px] font-bold text-slate-700 uppercase tracking-wider">Daftar Pertanyaan & Jawaban (<span x-text="block.items?.length || 0"></span>)</label>
                                        <button type="button" @click="addAccordionItem(block)" class="px-2.5 py-1 rounded-lg bg-indigo-50 text-indigo-700 hover:bg-indigo-100 font-bold text-[11px] transition flex items-center space-x-1">
                                            <i class="fa-solid fa-plus text-[10px]"></i> <span>Tambah FAQ</span>
                                        </button>
                                    </div>
                                    <div class="space-y-2.5">
                                        <template x-for="(acc, aIdx) in (block.items || [])" :key="aIdx">
                                            <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-200 space-y-2 relative">
                                                <button type="button" @click="removeAccordionItem(block, aIdx)" class="absolute top-2.5 right-2.5 text-rose-500 hover:text-rose-700 text-xs" title="Hapus Item">
                                                    <i class="fa-solid fa-xmark"></i>
                                                </button>
                                                <div class="space-y-0.5 pr-6">
                                                    <label class="text-[10px] font-semibold text-slate-500">Pertanyaan / Judul</label>
                                                    <input type="text" x-model="acc.title" class="w-full px-2.5 py-1.5 rounded-lg text-xs bg-white border border-slate-200 font-semibold" placeholder="Contoh: Bagaimana prosedur pengajuan surat keterangan?">
                                                </div>
                                                <div class="space-y-0.5">
                                                    <label class="text-[10px] font-semibold text-slate-500">Jawaban / Isi</label>
                                                    <textarea x-model="acc.content" rows="3" class="w-full px-2.5 py-1.5 rounded-lg text-xs bg-white border border-slate-200" placeholder="Tuliskan jawaban detail di sini..."></textarea>
                                                </div>
                                            </div>
                                        </template>
                                    </div>
                                </div>
                            </div>
                        </template>

                        {{-- TYPE: TIMELINE --}}
                        <template x-if="block.type === 'timeline'">
                            <div class="space-y-4">
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                    <div class="space-y-1">
                                        <label class="text-[11px] font-bold text-slate-600">Judul Seksi Alur</label>
                                        <input type="text" x-model="block.title" class="w-full px-3 py-2 rounded-xl text-xs bg-slate-50 border border-slate-200" placeholder="Contoh: Alur & Prosedur Pendaftaran">
                                    </div>
                                    <div class="space-y-1">
                                        <label class="text-[11px] font-bold text-slate-600">Badge</label>
                                        <input type="text" x-model="block.badge" class="w-full px-3 py-2 rounded-xl text-xs bg-slate-50 border border-slate-200" placeholder="Contoh: Panduan Alur">
                                    </div>
                                </div>
                                <div class="space-y-1">
                                    <label class="text-[11px] font-bold text-slate-600">Subjudul</label>
                                    <input type="text" x-model="block.subtitle" class="w-full px-3 py-2 rounded-xl text-xs bg-slate-50 border border-slate-200" placeholder="Penjelasan singkat alur proses...">
                                </div>

                                <!-- Timeline Steps Repeater -->
                                <div class="space-y-2 pt-2">
                                    <div class="flex items-center justify-between">
                                        <label class="text-[11px] font-bold text-slate-700 uppercase tracking-wider">Tahapan Alur (<span x-text="block.steps?.length || 0"></span>)</label>
                                        <button type="button" @click="addTimelineStep(block)" class="px-2.5 py-1 rounded-lg bg-rose-50 text-rose-700 hover:bg-rose-100 font-bold text-[11px] transition flex items-center space-x-1">
                                            <i class="fa-solid fa-plus text-[10px]"></i> <span>Tambah Langkah</span>
                                        </button>
                                    </div>
                                    <div class="space-y-2.5">
                                        <template x-for="(step, sIdx) in (block.steps || [])" :key="sIdx">
                                            <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-200 space-y-2 relative">
                                                <button type="button" @click="removeTimelineStep(block, sIdx)" class="absolute top-2.5 right-2.5 text-rose-500 hover:text-rose-700 text-xs" title="Hapus Langkah">
                                                    <i class="fa-solid fa-xmark"></i>
                                                </button>
                                                <div class="grid grid-cols-1 sm:grid-cols-4 gap-2 pr-6">
                                                    <div class="space-y-0.5">
                                                        <label class="text-[10px] font-semibold text-slate-500">Nomor Urut</label>
                                                        <input type="text" x-model="step.number" class="w-full px-2.5 py-1.5 rounded-lg text-xs bg-white border border-slate-200 text-center font-bold" :placeholder="sIdx + 1">
                                                    </div>
                                                    <div class="space-y-0.5 sm:col-span-3">
                                                        <label class="text-[10px] font-semibold text-slate-500">Judul Langkah</label>
                                                        <input type="text" x-model="step.title" class="w-full px-2.5 py-1.5 rounded-lg text-xs bg-white border border-slate-200 font-semibold" placeholder="Contoh: Mengisi Formulir Online">
                                                    </div>
                                                </div>
                                                <div class="space-y-0.5">
                                                    <label class="text-[10px] font-semibold text-slate-500">Keterangan / Instruksi</label>
                                                    <textarea x-model="step.description" rows="2" class="w-full px-2.5 py-1.5 rounded-lg text-xs bg-white border border-slate-200" placeholder="Rincian yang harus dilakukan..."></textarea>
                                                </div>
                                            </div>
                                        </template>
                                    </div>
                                </div>
                            </div>
                        </template>

                        {{-- TYPE: STATS --}}
                        <template x-if="block.type === 'stats'">
                            <div class="space-y-4">
                                <div class="flex items-center justify-between">
                                    <label class="text-[11px] font-bold text-slate-700 uppercase tracking-wider">Item Angka Statistik (<span x-text="block.items?.length || 0"></span>)</label>
                                    <button type="button" @click="addStatItem(block)" class="px-2.5 py-1 rounded-lg bg-teal-50 text-teal-700 hover:bg-teal-100 font-bold text-[11px] transition flex items-center space-x-1">
                                        <i class="fa-solid fa-plus text-[10px]"></i> <span>Tambah Statistik</span>
                                    </button>
                                </div>
                                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3">
                                    <template x-for="(st, stIdx) in (block.items || [])" :key="stIdx">
                                        <div class="p-3 rounded-xl bg-slate-50 border border-slate-200 space-y-2 relative">
                                            <button type="button" @click="removeStatItem(block, stIdx)" class="absolute top-2 right-2 text-rose-500 hover:text-rose-700 text-xs">
                                                <i class="fa-solid fa-xmark"></i>
                                            </button>
                                            <div class="space-y-1">
                                                <label class="text-[10px] font-semibold text-slate-500">Ikon FontAwesome</label>
                                                <input type="text" x-model="st.icon" class="w-full px-2 py-1.5 rounded-lg text-xs bg-white border border-slate-200" placeholder="fa-solid fa-users">
                                            </div>
                                            <div class="space-y-1">
                                                <label class="text-[10px] font-semibold text-slate-500">Angka / Nilai</label>
                                                <input type="text" x-model="st.number" class="w-full px-2 py-1.5 rounded-lg text-xs bg-white border border-slate-200 font-extrabold text-theme-primary" placeholder="150+ / 98%">
                                            </div>
                                            <div class="space-y-1">
                                                <label class="text-[10px] font-semibold text-slate-500">Label Keterangan</label>
                                                <input type="text" x-model="st.label" class="w-full px-2 py-1.5 rounded-lg text-xs bg-white border border-slate-200" placeholder="Mahasiswa Aktif">
                                            </div>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </template>

                        {{-- TYPE: CTA & WA --}}
                        <template x-if="block.type === 'cta'">
                            <div class="space-y-4">
                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                                    <div class="space-y-1 sm:col-span-2">
                                        <label class="text-[11px] font-bold text-slate-600">Judul Utama CTA</label>
                                        <input type="text" x-model="block.title" class="w-full px-3 py-2 rounded-xl text-xs bg-slate-50 border border-slate-200" placeholder="Contoh: Butuh Bantuan Terkait Layanan Kami?">
                                    </div>
                                    <div class="space-y-1">
                                        <label class="text-[11px] font-bold text-slate-600">Badge</label>
                                        <input type="text" x-model="block.badge" class="w-full px-3 py-2 rounded-xl text-xs bg-slate-50 border border-slate-200" placeholder="Contoh: Konsultasi Gratis">
                                    </div>
                                </div>
                                <div class="space-y-1">
                                    <label class="text-[11px] font-bold text-slate-600">Deskripsi</label>
                                    <textarea x-model="block.description" rows="2" class="w-full px-3 py-2 rounded-xl text-xs bg-slate-50 border border-slate-200" placeholder="Hubungi tim kami untuk konsultasi dan panduan lebih lanjut..."></textarea>
                                </div>
                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                                    <div class="space-y-1">
                                        <label class="text-[11px] font-bold text-slate-600">Nomor WhatsApp</label>
                                        <input type="text" x-model="block.whatsapp_number" class="w-full px-3 py-2 rounded-xl text-xs bg-slate-50 border border-slate-200" placeholder="Contoh: 08123456789">
                                    </div>
                                    <div class="space-y-1">
                                        <label class="text-[11px] font-bold text-slate-600">Teks Tombol Tambahan</label>
                                        <input type="text" x-model="block.button_text" class="w-full px-3 py-2 rounded-xl text-xs bg-slate-50 border border-slate-200" placeholder="Contoh: Ajukan Tiket">
                                    </div>
                                    <div class="space-y-1">
                                        <label class="text-[11px] font-bold text-slate-600">Link URL Tombol</label>
                                        <input type="text" x-model="block.button_link" class="w-full px-3 py-2 rounded-xl text-xs bg-slate-50 border border-slate-200" placeholder="https://...">
                                    </div>
                                </div>
                            </div>
                        </template>

                        {{-- TYPE: RICH TEXT --}}
                        <template x-if="block.type === 'rich_text'">
                            <div class="space-y-4">
                                <div class="space-y-1">
                                    <label class="text-[11px] font-bold text-slate-600">Lebar Konten</label>
                                    <select x-model="block.width" class="w-full px-3 py-2 rounded-xl text-xs bg-slate-50 border border-slate-200">
                                        <option value="standard">Lebar Standar (Max-W 5xl)</option>
                                        <option value="narrow">Ramping / Narrow (Max-W 3xl - cocok untuk artikel)</option>
                                    </select>
                                </div>
                                <div class="space-y-1">
                                    <label class="text-[11px] font-bold text-slate-600">Konten HTML / Teks</label>
                                    <textarea x-model="block.content" rows="6" class="w-full px-3 py-2 rounded-xl text-xs bg-slate-50 border border-slate-200 font-mono" placeholder="<p>Tuliskan teks paragraf atau kode HTML...</p>"></textarea>
                                </div>
                            </div>
                        </template>

                    </div>
                </div>
            </template>
        </div>
    </div>
</div>

<script>
function pageBuilder(config) {
    return {
        layoutType: config.initialLayout || 'standard',
        blocks: config.initialBlocks || [],

        init() {
            // Ensure each block has unique ID for key tracking
            this.blocks = this.blocks.map(b => ({
                ...b,
                _id: b._id || ('b_' + Math.random().toString(36).substr(2, 9))
            }));
        },

        getBlockIcon(type) {
            const map = {
                'hero': 'fa-solid fa-image',
                'two_column': 'fa-solid fa-columns',
                'cards_grid': 'fa-solid fa-grip',
                'accordion': 'fa-solid fa-circle-question',
                'timeline': 'fa-solid fa-timeline',
                'stats': 'fa-solid fa-chart-simple',
                'cta': 'fa-solid fa-bullhorn',
                'rich_text': 'fa-solid fa-paragraph'
            };
            return map[type] || 'fa-solid fa-cube';
        },

        getBlockLabel(type) {
            const map = {
                'hero': 'Hero Banner Utama',
                'two_column': 'Dua Kolom (Teks & Media)',
                'cards_grid': 'Grid Kartu Fitur / Layanan',
                'accordion': 'FAQ / Tanya Jawab Akordeon',
                'timeline': 'Linimasa / Alur Tahapan',
                'stats': 'Statistik & Angka Kunci',
                'cta': 'Call to Action & WhatsApp',
                'rich_text': 'Teks Bebas / HTML'
            };
            return map[type] || 'Blok Kustom';
        },

        addBlock(type) {
            let newBlock = {
                _id: 'b_' + Math.random().toString(36).substr(2, 9),
                type: type,
                title: '',
                badge: '',
                bg_color: 'white'
            };

            if (type === 'hero') {
                newBlock.title = 'Selamat Datang di Portal Kami';
                newBlock.subtitle = 'Layanan prima dan komprehensif untuk seluruh sivitas akademika.';
                newBlock.align = 'left';
                newBlock.button1_text = 'Pelajari Lebih Lanjut';
                newBlock.button1_link = '#';
                newBlock.badge = 'Informasi Resmi';
            } else if (type === 'two_column') {
                newBlock.title = 'Tentang Layanan Kami';
                newBlock.content = 'Tuliskan deskripsi lengkap mengenai layanan, fasilitas, atau program kerja di sini.';
                newBlock.layout = 'left';
                newBlock.button_text = 'Lihat Panduan';
                newBlock.button_link = '#';
                newBlock.image_url = 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?w=800&auto=format&fit=crop&q=80';
            } else if (type === 'cards_grid') {
                newBlock.title = 'Fasilitas & Layanan Unggulan';
                newBlock.subtitle = 'Berbagai kemudahan dan akses prima yang kami sediakan.';
                newBlock.columns = '3';
                newBlock.items = [
                    { icon: 'fa-solid fa-stethoscope', title: 'Layanan Medis', description: 'Pelayanan terpadu dengan standar kesehatan profesional.', link_text: 'Detail', link_url: '#' },
                    { icon: 'fa-solid fa-graduation-cap', title: 'Akademik & Riset', description: 'Dukungan penuh untuk penelitian dan pengabdian masyarakat.', link_text: 'Detail', link_url: '#' },
                    { icon: 'fa-solid fa-hand-holding-heart', title: 'Konsultasi & Bimbingan', description: 'Pendampingan sivitas akademika secara ramah dan solutif.', link_text: 'Detail', link_url: '#' }
                ];
            } else if (type === 'accordion') {
                newBlock.title = 'Pertanyaan yang Sering Diajukan (FAQ)';
                newBlock.subtitle = 'Temukan jawaban cepat untuk pertanyaan seputar layanan kami.';
                newBlock.badge = 'Tanya Jawab';
                newBlock.items = [
                    { title: 'Bagaimana cara mengajukan permohonan layanan?', content: 'Anda dapat mengisi formulir pengajuan online atau datang langsung ke ruang administrasi pada jam kerja.' },
                    { title: 'Berapa lama estimasi waktu pemrosesan dokumen?', content: 'Rata-rata pemrosesan memakan waktu 1-3 hari kerja setelah berkas dinyatakan lengkap.' }
                ];
            } else if (type === 'timeline') {
                newBlock.title = 'Alur & Tahapan Proses';
                newBlock.subtitle = 'Langkah mudah mengikuti prosedur layanan.';
                newBlock.steps = [
                    { number: '1', title: 'Registrasi & Pengisian Berkas', description: 'Lengkapi formulir permohonan dan unggah dokumen pendukung.' },
                    { number: '2', title: 'Verifikasi oleh Tim Divisi', description: 'Petugas melakukan peninjauan kelengkapan dan validitas data.' },
                    { number: '3', title: 'Penerbitan & Konfirmasi Selesai', description: 'Dokumen disahkan dan dikirimkan ke pemohon.' }
                ];
            } else if (type === 'stats') {
                newBlock.items = [
                    { icon: 'fa-solid fa-users', number: '1,200+', label: 'Mahasiswa Terlayani' },
                    { icon: 'fa-solid fa-award', number: '99%', label: 'Kepuasan Layanan' },
                    { icon: 'fa-solid fa-clock-rotate-left', number: '24 Jam', label: 'Respon Cepat' },
                    { icon: 'fa-solid fa-shield-halved', number: '100%', label: 'Standar Terakreditasi' }
                ];
            } else if (type === 'cta') {
                newBlock.title = 'Ada Pertanyaan atau Butuh Konsultasi?';
                newBlock.description = 'Tim kami siap membantu Anda setiap hari kerja pukul 08.00 - 15.00 WIB.';
                newBlock.badge = 'Hubungi Kami';
                newBlock.whatsapp_number = '628123456789';
                newBlock.button_text = 'Kirim Email';
                newBlock.button_link = 'mailto:info@stikespantiwaluya.ac.id';
            } else if (type === 'rich_text') {
                newBlock.width = 'standard';
                newBlock.content = '<p>Tuliskan uraian paragraf bebas atau kode HTML di sini.</p>';
            }

            this.blocks.push(newBlock);
        },

        removeBlock(index) {
            if (confirm('Hapus blok ini?')) {
                this.blocks.splice(index, 1);
            }
        },

        duplicateBlock(index) {
            const clone = JSON.parse(JSON.stringify(this.blocks[index]));
            clone._id = 'b_' + Math.random().toString(36).substr(2, 9);
            this.blocks.splice(index + 1, 0, clone);
        },

        moveUp(index) {
            if (index > 0) {
                const temp = this.blocks[index];
                this.blocks[index] = this.blocks[index - 1];
                this.blocks[index - 1] = temp;
            }
        },

        moveDown(index) {
            if (index < this.blocks.length - 1) {
                const temp = this.blocks[index];
                this.blocks[index] = this.blocks[index + 1];
                this.blocks[index + 1] = temp;
            }
        },

        // Nested item helpers
        addCardItem(block) {
            if (!block.items) block.items = [];
            block.items.push({
                icon: 'fa-solid fa-star',
                title: 'Item Baru',
                description: 'Deskripsi item layanan...',
                link_text: 'Pelajari Lebih Lanjut',
                link_url: '#'
            });
        },
        removeCardItem(block, idx) {
            block.items.splice(idx, 1);
        },

        addAccordionItem(block) {
            if (!block.items) block.items = [];
            block.items.push({
                title: 'Pertanyaan Baru',
                content: 'Jawaban detail pertanyaan...'
            });
        },
        removeAccordionItem(block, idx) {
            block.items.splice(idx, 1);
        },

        addTimelineStep(block) {
            if (!block.steps) block.steps = [];
            block.steps.push({
                number: (block.steps.length + 1).toString(),
                title: 'Langkah ' + (block.steps.length + 1),
                description: 'Instruksi pada langkah ini...'
            });
        },
        removeTimelineStep(block, idx) {
            block.steps.splice(idx, 1);
        },

        addStatItem(block) {
            if (!block.items) block.items = [];
            block.items.push({
                icon: 'fa-solid fa-star',
                number: '100+',
                label: 'Statistik Baru'
            });
        },
        removeStatItem(block, idx) {
            block.items.splice(idx, 1);
        }
    };
}
</script>
