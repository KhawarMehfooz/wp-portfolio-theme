@extends('layouts.app')
@php
    $service_icon = get_field('service_icon');
    $icon_url = $service_icon['url'] ?? '';
    $is_svg = $icon_url && str_ends_with($icon_url, '.svg');
@endphp
@section('content')
    <main class="border-b border-border/50">
        <div class=" mx-auto max-w-4xl pt-20 px-6">
            <a class="inline-flex items-center gap-2 text-sm text-muted-foreground hover:text-primary transition-colors mb-8"
                href="/services"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-arrow-left w-4 h-4">
                    <path d="m12 19-7-7 7-7"></path>
                    <path d="M19 12H5"></path>
                </svg>Back to Services</a>
            @if ($is_svg)
                <span class=" text-primary [&>svg]:h-12 [&>svg]:w-12 [&>svg]:text-primary [&>svg]:mb-6">
                    {!! file_get_contents($icon_url) !!}
                </span>

            @else
                <img src="{{ $icon_url }}" alt="{{ $social['social_label'] }}" class="h-5 w-5" />
            @endif

            <h1 class="font-display text-4xl md:text-5xl font-bold mb-6">{{ the_title() }}</h1>
            <p class="text-xl text-muted-foreground leading-relaxed mb-12">{{ get_the_excerpt() }}</p>
            <div class="mb-7">{{ the_content() }}</div>
        </div>
    </main>
@endsection