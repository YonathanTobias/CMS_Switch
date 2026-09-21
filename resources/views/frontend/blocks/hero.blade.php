<div class="relative py-16 lg:py-24 overflow-hidden text-white" style="background: linear-gradient(135deg, var(--color-primary), var(--color-secondary));">
    <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#fff_1px,transparent_1px)] [background-size:16px_16px]"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="max-w-3xl space-y-5 {{ ($block['align'] ?? 'left') === 'center' ? 'mx-auto text-center' : '' }}">
            @if(!empty($block['badge']))
            <div class="inline-flex items-center space-x-2 bg-white/15 backdrop-blur-md px-3.5 py-1.5 rounded-full text-xs font-semibold tracking-wide uppercase border border-white/20">
                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span>
                <span>{{ $block['badge'] }}</span>
            </div>
            @endif

            @if(!empty($block['title']))
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight leading-tight drop-shadow-sm">
                {{ $block['title'] }}
            </h1>
            @endif

            @if(!empty($block['subtitle']))
            <p class="text-base sm:text-lg text-slate-100/90 leading-relaxed font-normal">
                {{ $block['subtitle'] }}
            </p>
            @endif

            @if(!empty($block['button1_text']) || !empty($block['button2_text']))
            <div class="flex flex-wrap gap-4 pt-4 {{ ($block['align'] ?? 'left') === 'center' ? 'justify-center' : '' }}">
                @if(!empty($block['button1_text']))
                <a href="{{ $block['button1_link'] ?? '#' }}" class="px-6 py-3 rounded-xl bg-white text-slate-900 font-bold text-sm shadow-lg hover:bg-slate-100 transition transform hover:-translate-y-0.5 flex items-center">
                    <span>{{ $block['button1_text'] }}</span> <i class="fa-solid fa-arrow-right ml-2 text-xs"></i>
                </a>
                @endif
                @if(!empty($block['button2_text']))
                <a href="{{ $block['button2_link'] ?? '#' }}" class="px-6 py-3 rounded-xl bg-white/15 backdrop-blur-md text-white font-semibold text-sm border border-white/30 hover:bg-white/25 transition flex items-center">
                    <span>{{ $block['button2_text'] }}</span>
                </a>
                @endif
            </div>
            @endif
        </div>
    </div>
</div>