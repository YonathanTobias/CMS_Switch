<section class="py-12 {{ ($block['bg_color'] ?? 'white') === 'slate' ? 'bg-slate-50 border-y border-slate-200' : 'bg-white' }}">
    <div class="{{ ($block['width'] ?? 'standard') === 'narrow' ? 'max-w-3xl' : 'max-w-5xl' }} mx-auto px-4 sm:px-6 lg:px-8 text-xs sm:text-sm text-slate-700 leading-relaxed space-y-4">
        {!! $block['content'] ?? '' !!}
    </div>
</section>