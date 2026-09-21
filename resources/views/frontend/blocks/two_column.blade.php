<section class="py-16 {{ ($block['bg_color'] ?? 'white') === 'slate' ? 'bg-slate-50 border-y border-slate-200' : 'bg-white' }}">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
            <div class="lg:col-span-6 space-y-4 {{ ($block['layout'] ?? 'left') === 'right' ? 'lg:order-2' : '' }}">
                @if(!empty($block['badge']))
                <div class="inline-flex items-center space-x-2 text-xs font-bold uppercase tracking-wider px-3 py-1 rounded-md text-theme-primary bg-slate-100">
                    <span>{{ $block['badge'] }}</span>
                </div>
                @endif
                @if(!empty($block['title']))
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 leading-tight">{{ $block['title'] }}</h2>
                @endif
                @if(!empty($block['content']))
                <div class="text-xs sm:text-sm text-slate-600 leading-relaxed space-y-3">
                    {!! nl2br(e($block['content'])) !!}
                </div>
                @endif
                @if(!empty($block['button_text']))
                <div class="pt-2">
                    <a href="{{ $block['button_link'] ?? '#' }}" class="px-5 py-2.5 rounded-xl bg-theme-primary text-white text-xs font-bold uppercase tracking-wider inline-flex items-center shadow hover:opacity-90 transition">
                        <span>{{ $block['button_text'] }}</span> <i class="fa-solid fa-arrow-right ml-2 text-[10px]"></i>
                    </a>
                </div>
                @endif
            </div>

            <div class="lg:col-span-6 {{ ($block['layout'] ?? 'left') === 'right' ? 'lg:order-1' : '' }}">
                @if(!empty($block['image_url']))
                <div class="rounded-3xl overflow-hidden shadow-lg border border-slate-200">
                    <img src="{{ $block['image_url'] }}" alt="{{ $block['title'] ?? '' }}" class="w-full h-80 object-cover">
                </div>
                @elseif(!empty($block['youtube_url']))
                <div class="aspect-video rounded-3xl overflow-hidden shadow-lg border border-slate-200">
                    <iframe src="{{ $block['youtube_url'] }}" class="w-full h-full" frameborder="0" allowfullscreen></iframe>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>