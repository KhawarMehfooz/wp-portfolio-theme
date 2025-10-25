@extends('layouts.app')

@php
    $service_icon = get_field('service_icon');
    $icon_url = $service_icon['url'] ?? '';
    $is_svg = $icon_url && str_ends_with($icon_url, '.svg');

    $related_projects = get_field('related_projects');
@endphp

@section('content')
    <main>
        <div class="container mx-auto pt-20 px-3">

            {{-- Back Link --}}
            <a href="/services"
                class="khwr-no-underline inline-flex items-center gap-2 text-sm text-muted-foreground hover:text-primary transition-colors mb-8">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-arrow-left w-4 h-4">
                    <path d="m12 19-7-7 7-7"></path>
                    <path d="M19 12H5"></path>
                </svg>
                Back to Services
            </a>

            {{-- Service Icon --}}
            @if ($is_svg)
                <span class="text-primary [&>svg]:h-12 [&>svg]:w-12 [&>svg]:text-primary [&>svg]:mb-6">
                    {!! file_get_contents($icon_url) !!}
                </span>
            @elseif ($icon_url)
                <img src="{{ $icon_url }}" alt="{{ get_the_title() }}" class="h-12 w-12 mb-6" />
            @endif

            <div class="flex flex-col md:flex-row gap-4 items-start">
                <div class="w-full md:max-w-[60%]">
                    {{-- Service Title & Content --}}
                    <h1 class="font-display text-4xl md:text-5xl font-bold mb-6">{{ the_title() }}</h1>
                    <p class="text-xl text-muted-foreground leading-relaxed mb-12">{{ get_the_excerpt() }}</p>
                    <div class="mb-12 prose max-w-none">{{ the_content() }}</div>

                    {{-- Related Projects --}}
                    @if ($related_projects)
                        <div class="container border-t border-border/50 pt-12 my-12">
                            <h2 class="font-display text-2xl md:text-3xl font-bold mb-6">Related Projects</h2>

                            <div class="grid md:grid-cols-2 gap-6">
                                @foreach ($related_projects as $project)
                                    <a href="{{ get_permalink($project->ID) }}"
                                        class="khwr-no-underline group block p-8 border border-dashed-subtle-default hover:border-primary transition-all duration-300 hover:shadow-lg hover:shadow-primary/5">

                                        {{-- Project Header --}}
                                        <div class="flex items-center justify-between mb-4">
                                            <span
                                                class="text-xs font-medium text-primary bg-secondary border-dashed-subtle-default px-2 py-1">
                                                @php
                                                    $terms = get_the_terms($project->ID, 'project_category');
                                                    if ($terms && !is_wp_error($terms)) {
                                                        echo esc_html($terms[0]->name);
                                                    }
                                                @endphp
                                            </span>

                                            <span class="text-xs text-muted-foreground">
                                                @php
                                                    $project_date = get_field('project_date', $project->ID);
                                                    if ($project_date) {
                                                        echo date('Y', strtotime($project_date));
                                                    }
                                                @endphp
                                            </span>
                                        </div>

                                        {{-- Title --}}
                                        <h3
                                            class="font-display text-xl font-semibold mb-3 group-hover:text-primary transition-colors">
                                            {!! html_entity_decode(get_the_title($project->ID)) !!}
                                        </h3>

                                        {{-- Excerpt --}}
                                        <p class="text-muted-foreground text-sm leading-relaxed mb-4">
                                            @php
                                                $excerpt = has_excerpt($project->ID)
                                                    ? get_the_excerpt($project->ID)
                                                    : wp_trim_words(
                                                        strip_tags(get_post_field('post_content', $project->ID)),
                                                        25,
                                                        '...',
                                                    );
                                                echo esc_html($excerpt);
                                            @endphp
                                        </p>

                                        {{-- Learn More --}}
                                        <div class="flex items-center gap-2 text-sm font-medium text-primary">
                                            Learn More
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-arrow-right w-4 h-4 group-hover:translate-x-1 transition-transform">
                                                <path d="M5 12h14"></path>
                                                <path d="m12 5 7 7-7 7"></path>
                                            </svg>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                <div class="w-full md:max-w-[40%] pb-3 md:sticky top-20">
                    @include('forms.contact')
                </div>
            </div>

        </div>
    </main>
@endsection
