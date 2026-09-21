@extends('layouts.frontend')

@section('title', $page->title . ' - ' . get_setting('division_short_name', 'Divisi'))

@section('content')
@if(($page->layout_type ?? 'standard') === 'blocks' && !empty($page->blocks_data))
    {{-- Modular Block Builder Layout --}}
    <div class="space-y-0">
        @foreach($page->blocks_data as $block)
            @if(!empty($block['type']))
                @includeIf('frontend.blocks.' . $block['type'], ['block' => $block])
            @endif
        @endforeach
    </div>
@else
    {{-- Standard Classic Layout --}}
    <div class="py-14 text-white" style="background: linear-gradient(135deg, var(--color-primary), var(--color-secondary));">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl space-y-2">
                <h1 class="text-3xl sm:text-4xl font-extrabold">{{ $page->title }}</h1>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="bg-white rounded-2xl p-6 sm:p-10 shadow-sm border border-slate-200">
            @if($page->banner_image)
            <div class="rounded-xl overflow-hidden mb-8 shadow-sm max-h-96">
                <img src="{{ $page->banner_image }}" alt="{{ $page->title }}" class="w-full h-full object-cover">
            </div>
            @endif

            <div class="prose max-w-none text-slate-700 leading-relaxed text-sm sm:text-base space-y-4">
                {!! $page->content !!}
            </div>
        </div>
    </div>
@endif
@endsection

