<section class="py-16 {{ ($block['bg_color'] ?? 'slate') === 'white' ? 'bg-white' : 'bg-slate-50 border-y border-slate-200' }}">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        @if(!empty($block['title']) || !empty($block['subtitle']))
        <div class="text-center space-y-3 mb-10">
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

        <div class="space-y-3" x-data="{ activeAcc: null }">
            @foreach($block['items'] ?? [] as $idx => $acc)
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden transition">
                <button @click="activeAcc = activeAcc === {{ $idx }} ? null : {{ $idx }}" type="button" class="w-full p-5 text-left flex items-center justify-between space-x-4 font-bold text-sm text-slate-900 hover:text-theme-primary transition">
                    <span class="flex items-center"><i class="fa-solid fa-circle-question text-theme-primary mr-3 text-base"></i> {{ $acc['title'] ?? '' }}</span>
                    <i class="fa-solid fa-chevron-down text-xs text-slate-400 transition-transform duration-200" :class="{ 'rotate-180': activeAcc === {{ $idx }} }"></i>
                </button>
                <div x-show="activeAcc === {{ $idx }}" x-collapse class="px-5 pb-5 pt-1 text-xs sm:text-sm text-slate-600 leading-relaxed border-t border-slate-100">
                    {!! nl2br(e($acc['content'] ?? '')) !!}
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>