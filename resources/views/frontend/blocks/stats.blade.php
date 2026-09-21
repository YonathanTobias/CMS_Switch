<section class="py-12 bg-slate-900 text-white border-y border-slate-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
            @foreach($block['items'] ?? [] as $st)
            <div class="p-6 rounded-2xl bg-white/5 border border-white/10 backdrop-blur-sm space-y-2">
                @if(!empty($st['icon']))
                <div class="text-2xl text-sky-400 mb-1"><i class="{{ $st['icon'] }}"></i></div>
                @endif
                <div class="text-3xl sm:text-4xl font-extrabold text-white">{{ $st['number'] ?? '0' }}</div>
                <div class="text-xs text-slate-300 font-semibold uppercase tracking-wider">{{ $st['label'] ?? '' }}</div>
            </div>
            @endforeach
        </div>
    </div>
</section>