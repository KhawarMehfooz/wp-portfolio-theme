@extends('layouts.app')

@php
    $service_icon = get_field('service_icon');
    $icon_url = $service_icon['url'] ?? '';
    $is_svg = $icon_url && str_ends_with($icon_url, '.svg');
    $related_projects = get_field('related_projects');
@endphp

@section('content')
    <main>
        <div class="container mx-auto pt-20 md:pt-30 px-3">
            <x-back-link href="/services" label="Back to Services" />

            @if ($is_svg)
                <span class="text-primary [&>svg]:h-12 [&>svg]:w-12 [&>svg]:text-primary [&>svg]:mb-6">
                    {!! file_get_contents($icon_url) !!}
                </span>
            @elseif ($icon_url)
                <img src="{{ $icon_url }}" alt="{{ get_the_title() }}" class="h-12 w-12 mb-6" />
            @endif

            <div class="flex flex-col md:flex-row gap-4 items-start">
                <article class="w-full md:max-w-[60%]">
                    {{-- Service Header --}}
                    <header class="mb-12">
                        <h1 class="font-display text-4xl md:text-5xl font-bold mb-6">{{ the_title() }}</h1>
                        @if (get_the_excerpt())
                            <p class="text-xl text-muted-foreground leading-relaxed">{{ get_the_excerpt() }}</p>
                        @endif
                    </header>

                    {{-- Service Content --}}
                    <div class="prose max-w-none mb-12">
                        {{ the_content() }}
                    </div>

                    {{-- Related Projects --}}
                    @if ($related_projects)
                        <section class="border-t border-border/50 pt-12 my-12" aria-labelledby="related-projects-heading">
                            <h2 id="related-projects-heading" class="font-display text-2xl md:text-3xl font-bold mb-6">
                                Related Projects
                            </h2>
                            <div class="grid md:grid-cols-2 gap-6">
                                @foreach ($related_projects as $project)
                                    <x-project-card :post="$project" />
                                @endforeach
                            </div>
                        </section>
                    @endif
                </article>

                <aside class="w-full md:max-w-[40%] pb-3 md:sticky top-30">
                    @include('forms.contact')
                </aside>
            </div>
        </div>
    </main>
@endsection
