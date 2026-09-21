<section class="py-14 bg-slate-950 text-white relative overflow-hidden">
    <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#fff_1px,transparent_1px)] [background-size:16px_16px]"></div>
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center space-y-6">
        @if(!empty($block['badge']))
        <div class="inline-flex items-center space-x-2 bg-white/10 px-3 py-1 rounded-full text-xs font-semibold uppercase tracking-wider text-emerald-400 border border-white/10">
            <span>{{ $block['badge'] }}</span>
        </div>
        @endif
        @if(!empty($block['title']))
        <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold tracking-tight leading-tight">{{ $block['title'] }}</h2>
        @endif
        @if(!empty($block['description']))
        <p class="text-sm sm:text-base text-slate-300 max-w-2xl mx-auto leading-relaxed">{{ $block['description'] }}</p>
        @endif
        <div class="flex flex-wrap justify-center gap-4 pt-2">
            @if(!empty($block['button_text']))
            <a href="{{ $block['button_link'] ?? '#' }}" class="px-6 py-3 rounded-xl bg-theme-primary text-white font-bold text-sm shadow-xl hover:opacity-90 transition flex items-center transform hover:-translate-y-0.5">
                <span>{{ $block['button_text'] }}</span> <i class="fa-solid fa-arrow-right ml-2 text-xs"></i>
            </a>
            @endif
            @if(!empty($block['whatsapp_number']))
            @php
                $waNum = preg_replace('/[^0-9]/', '', $block['whatsapp_number']);
            @endphp
            <a href="https://wa.me/{{ $waNum }}" target="_blank" class="px-6 py-3 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-sm shadow-xl transition flex items-center">
                <i class="fa-brands fa-whatsapp mr-2 text-base"></i> Hubungi WhatsApp
            </a>
            @endif
        </div>
    </div>
</section>