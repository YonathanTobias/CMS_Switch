<section class="py-16 {{ ($block['bg_color'] ?? 'white') === 'slate' ? 'bg-slate-50 border-y border-slate-200' : 'bg-white' }}">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if(!empty($block['title']) || !empty($block['subtitle']))
        <div class="text-center max-w-2xl mx-auto space-y-3 mb-12">
            @if(!empty($block['badge']))
            <div class="inline-flex items-center space-x-2 text-xs font-bold uppercase tracking-wider px-3 py-1 rounded-md text-theme-primary bg-white shadow-sm border border-slate-100">
                <span>{{ $block['badge'] }}</span>
            </div>
            @endif
            @if(!empty($block['title']))
            <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900">{{ $block['title'] }}</h2>
            @endif
            @if(!empty($block['subtitle']))
            <p class="text-xs sm:text-sm text-slate-500 leading-relaxed">{{ $block['subtitle'] }}</p>
            @endif
        </div>
        @endif

        @php
            $cols = (int)($block['columns'] ?? 3);
            $gridClass = $cols === 2 ? 'md:grid-cols-2 max-w-4xl mx-auto' : ($cols === 4 ? 'sm:grid-cols-2 lg:grid-cols-4' : 'md:grid-cols-2 lg:grid-cols-3');
        @endphp

        <div class="grid grid-cols-1 {{ $gridClass }} gap-6">
            @foreach($block['items'] ?? [] as $card)
            <div class="bg-white rounded-2xl p-6 shadow-sm hover:shadow-md transition border border-slate-200 flex flex-col justify-between space-y-4 group">
                <div class="space-y-3">
                    <div class="w-12 h-12 rounded-xl flex items-center justify-center text-xl text-white transition group-hover:scale-110 shadow-sm" style="background-color: var(--color-primary);">
                        <i class="{{ $card['icon'] ?? 'fa-solid fa-star' }}"></i>
                    </div>
                    <h3 class="text-base font-bold text-slate-900 group-hover:text-theme-primary transition">{{ $card['title'] ?? '' }}</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">{{ $card['description'] ?? '' }}</p>
                </div>
                @if(!empty($card['link_url']))
                <a href="{{ $card['link_url'] }}" class="inline-flex items-center text-xs font-bold text-theme-primary hover:underline pt-2">
                    <span>{{ $card['link_text'] ?? 'Pelajari Lebih Lanjut' }}</span> <i class="fa-solid fa-arrow-right ml-1.5 text-[10px]"></i>
                </a>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</section>