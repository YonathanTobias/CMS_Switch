<section class="py-16 {{ ($block['bg_color'] ?? 'white') === 'slate' ? 'bg-slate-50 border-y border-slate-200' : 'bg-white' }}">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        @if(!empty($block['title']) || !empty($block['subtitle']))
        <div class="text-center space-y-3 mb-12">
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

        <div class="relative border-l-2 border-slate-200 ml-4 sm:ml-6 space-y-8 pl-6 sm:pl-8">
            @foreach($block['steps'] ?? [] as $i => $step)
            <div class="relative group">
                <div class="absolute -left-[35px] sm:-left-[43px] top-0 w-8 h-8 rounded-full flex items-center justify-center font-bold text-xs text-white shadow-md ring-4 ring-white" style="background-color: var(--color-primary);">
                    {{ $step['number'] ?? ($i + 1) }}
                </div>
                <div class="bg-slate-50 rounded-2xl p-5 border border-slate-200 hover:border-slate-300 transition shadow-sm">
                    <h3 class="text-sm sm:text-base font-bold text-slate-900">{{ $step['title'] ?? '' }}</h3>
                    <p class="text-xs text-slate-600 leading-relaxed mt-2">{{ $step['description'] ?? '' }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>